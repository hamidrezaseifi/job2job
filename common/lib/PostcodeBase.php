<?php

namespace common\lib;

use Yii;
use common\helper\BrainHelper;

/**
 * This is the model class for table "j2j_postcode".
 *
 * @property integer $code
 * @property string $city
 * @property integer $status
 *
 * @property City $city0
 */
class PostcodeBase extends \common\models\Postcode
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity0()
    {
        return $this->hasOne(CityBase::className(), ['name' => 'city']);
    }

    /**
     * @inheritdoc
     * @return PostcodeQueryBase the active query used by this AR class.
     */
    public static function find()
    {
        return new PostcodeQueryBase(get_called_class());
    }
    
    public static function add($countryName, $cityName, $pcode)
    {
    	if(!$countryName) return ;
    	if(!$cityName) return ;
    	if(!$pcode) return ;
    	
    	CountryBase::add($countryName);
    	CityBase::add($countryName, $cityName);
    	$code = PostcodeBase::findOne(['code' => $pcode]);
    	
    	if($code == null)
    	{
    		$code = new PostcodeBase();
    		$data = array('PostcodeBase' => array());
    		$data['PostcodeBase']['city'] = $cityName;
    		$data['PostcodeBase']['code'] = $pcode;
    		$data['PostcodeBase']['status'] = 1;
    		$code->load($data);
    		$code->save(false);
    	}
    }
    
    public static function allPostcodes($key = false)
    {
    	$codes = PostcodeBase::find()->where(['status' => 1])->orderBy('city asc, code asc')->all();
    	if($key)
    	{
    		return BrainHelper::mapTranslate($codes, 'code', 'city');
    	}
    	return BrainHelper::mapTranslate($codes, 'code', 'code');
    }
}
