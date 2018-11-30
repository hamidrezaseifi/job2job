<?php

namespace common\lib;

use Yii;
use common\lib\CountryQueryBase;
use common\helper\BrainHelper;

/**
 * This is the model class for table "{{%country}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $status
 */
class CountryBase extends \common\models\Country
{
   

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return CountryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CountryQueryBase(get_called_class());
    }

    public static function add($countryName)
    {
    	if(!$countryName) return ;
    	$country = CountryBase::findOne(['title' => $countryName]);
    	 
    	if($country == null)
    	{
    		$country = new CountryBase();
    		$data = array('CountryBase' => array());
    		$data['CountryBase']['title'] = $cityName;
    		$data['CountryBase']['status'] = 1;
    		$country->load($data);
    		$country->save(false);
    		
    	}
    }
    
    public static function allCountries()
    {
    	$country = CountryBase::find()->where(['status' => 1])->orderBy('title')->all();
    	return BrainHelper::mapTranslate($country, 'title', 'title');
    }
    
}
