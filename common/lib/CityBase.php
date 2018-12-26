<?php

namespace common\lib;

use Yii;
use common\helper\BrainHelper;
use common\models\Country;
use common\models\Postcode;

/**
 * This is the model class for table "j2j_city".
 *
 * @property string $name
 * @property string $country
 * @property integer $status
 *
 * @property Country $country0
 * @property Postcode[] $postcodes
 */
class CityBase extends \common\models\City
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry0()
    {
        return $this->hasOne(Country::className(), ['title' => 'country']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostcodes()
    {
        return $this->hasMany(Postcode::className(), ['city' => 'name']);
    }

    /**
     * @inheritdoc
     * @return CityQueryBase the active query used by this AR class.
     */
    public static function find()
    {
        return new CityQueryBase(get_called_class());
    }
    
    public static function add($countryName, $cityName)
    {
    	if(!$countryName) return ;
    	if(!$cityName) return ;
    	CountryBase::add($countryName);
     	$city = CityBase::findOne(['name' => $cityName, 'country' => $countryName]);
   	 
    	if($city == null)
    	{
    		$city = new CityBase();
    		$data = array('CityBase' => array());
    		$data['CityBase']['name'] = $cityName;
    		$data['CityBase']['country'] = $countryName;
    		$data['CityBase']['status'] = 1;
    		$city->load($data);
    		$city->save(false);
    	}
    }
    
    public static function allCities($key = false)
    {
    	$cities = CityBase::find()->where(['status' => 1])->orderBy('name')->all();
    	if($key)
    	{
    		return BrainHelper::mapTranslate($cities, 'name', 'country');
    	}
    	return BrainHelper::mapTranslate($cities, 'name', 'name');
    }
}
