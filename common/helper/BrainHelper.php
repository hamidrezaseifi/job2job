<?php

namespace common\helper;

use Yii;
use yii\base\InvalidParamException;


class BrainHelper 
{

	public static function dateGermanToEnglish($idate)
	{
		if($idate == '' || $idate == null) return $idate;
				
		$formatter = \Yii::$app->formatter;
		$formatter->timeZone = 'UTC';
		return $formatter->asDate($idate, 'php:Y-m-d');
		
	}
	
	public static function dateEnglishToGerman($idate)
	{
		if(!$idate || $idate == '' || $idate == null) return $idate;
		
		$idate .= strlen($idate) == 10 ? ' 00:00:00' : '';
		
		$formatter = \Yii::$app->formatter;
		$formatter->timeZone = 'UTC';
		return $formatter->asDate($idate, 'php:d.m.Y H:i');
		
	}
	
	public static function dateAddEnglish($idate , $add , $fromgerman = true , $togerman = true)
	{
		if($idate == '' || $idate == null) return $idate;
		
		$outformat = $togerman ? 'd.m.Y' : 'Y-m-d H:i:s';
	
		$formatter = \Yii::$app->formatter;
		$formatter->timeZone = 'UTC';
		return $formatter->asDate($idate, 'php:'.$outformat);
	}
	
	/**
	 * Builds a map (key-value pairs) from a multidimensional array or an array of objects.
	 * The `$from` and `$to` parameters specify the key names or property names to set up the map.
	 * Optionally, one can further group the map according to a grouping field `$group`.
	 *
	 * For example,
	 *
	 * ```php
	 * $array = [
	 *     ['id' => '123', 'name' => 'aaa', 'class' => 'x'],
	 *     ['id' => '124', 'name' => 'bbb', 'class' => 'x'],
	 *     ['id' => '345', 'name' => 'ccc', 'class' => 'y'],
	 * ];
	 *
	 * $result = ArrayHelper::map($array, 'id', 'name');
	 * // the result is:
	 * // [
	 * //     '123' => 'aaa',
	 * //     '124' => 'bbb',
	 * //     '345' => 'ccc',
	 * // ]
	 *
	 * $result = ArrayHelper::map($array, 'id', 'name', 'class');
	 * // the result is:
	 * // [
	 * //     'x' => [
	 * //         '123' => 'aaa',
	 * //         '124' => 'bbb',
	 * //     ],
	 * //     'y' => [
	 * //         '345' => 'ccc',
	 * //     ],
	 * // ]
	 * ```
	 *
	 * @param array $array
	 * @param string $from
	 * @param string $to
	 * @param string $group
	 * @return array
	 */
	public static function mapTranslate($array, $from, $to, $mapvalue = true, $mapkey = false)
	{
		$result = [];
		foreach ($array as $element) {
			$key = static::getValue($element, $from);
			$key = $mapkey ? Yii::t('app', $key) : $key;
			$value = static::getValue($element, $to);
			$value = $mapvalue ? Yii::t('app', $value) : $value;
			
			$result[$key] = $value;
			
		}
	
		return $result;
	}
	
	/**
	 * Retrieves the value of an array element or object property with the given key or property name.
	 * If the key does not exist in the array or object, the default value will be returned instead.
	 *
	 * The key may be specified in a dot format to retrieve the value of a sub-array or the property
	 * of an embedded object. In particular, if the key is `x.y.z`, then the returned value would
	 * be `$array['x']['y']['z']` or `$array->x->y->z` (if `$array` is an object). If `$array['x']`
	 * or `$array->x` is neither an array nor an object, the default value will be returned.
	 * Note that if the array already has an element `x.y.z`, then its value will be returned
	 * instead of going through the sub-arrays. So it is better to be done specifying an array of key names
	 * like `['x', 'y', 'z']`.
	 *
	 * Below are some usage examples,
	 *
	 * ```php
	 * // working with array
	 * $username = \yii\helpers\ArrayHelper::getValue($_POST, 'username');
	 * // working with object
	 * $username = \yii\helpers\ArrayHelper::getValue($user, 'username');
	 * // working with anonymous function
	 * $fullName = \yii\helpers\ArrayHelper::getValue($user, function ($user, $defaultValue) {
	 *     return $user->firstName . ' ' . $user->lastName;
	 * });
	 * // using dot format to retrieve the property of embedded object
	 * $street = \yii\helpers\ArrayHelper::getValue($users, 'address.street');
	 * // using an array of keys to retrieve the value
	 * $value = \yii\helpers\ArrayHelper::getValue($versions, ['1.0', 'date']);
	 * ```
	 *
	 * @param array|object $array array or object to extract value from
	 * @param string|array $key key name of the array element, an array of keys or property name of the object,
	 * or an anonymous function returning the value. The anonymous function signature should be:
	 * `function($array, $defaultValue)`.
	 * The possibility to pass an array of keys is available since version 2.0.4.
	 * @param mixed $default the default value to be returned if the specified array key does not exist. Not used when
	 * getting value from an object.
	 * @return mixed the value of the element if found, default value otherwise
	 * @throws InvalidParamException if $array is neither an array nor an object.
	 */
	public static function getValue($array, $key, $default = null)
	{
		if ($key instanceof \Closure) {
			return $key($array, $default);
		}
	
		if (is_array($key)) {
			$lastKey = array_pop($key);
			foreach ($key as $keyPart) {
				$array = static::getValue($array, $keyPart);
			}
			$key = $lastKey;
		}
	
		if (is_array($array) && (isset($array[$key]) || array_key_exists($key, $array)) ) {
			return $array[$key];
		}
	
		if (($pos = strrpos($key, '.')) !== false) {
			$array = static::getValue($array, substr($key, 0, $pos), $default);
			$key = substr($key, $pos + 1);
		}
	
		if (is_object($array)) {
			// this is expected to fail if the property does not exist, or __get() is not implemented
			// it is not reliably possible to check whether a property is accessable beforehand
			return $array->$key;
		} elseif (is_array($array)) {
			return (isset($array[$key]) || array_key_exists($key, $array)) ? $array[$key] : $default;
		} else {
			return $default;
		}
	}
	
	public static function getCheckedFromValue($value , $check)
	{
		if(is_string($check))
		{
			return ($value == $check) ? ' checked="checked" ' : '';
		}
		else 
		{
				if(is_numeric($check))
				{
					$check = strval($check);
					$value = strval($value);
						
					return ($value == $check) ? ' checked="checked" ' : '';
				}
				else 
				{
					if(is_array($check))
					{
						return ( in_array($value, $check) ) ? ' checked="checked" ' : '';
					}
				}
			
		}
		return '';
	}
}

