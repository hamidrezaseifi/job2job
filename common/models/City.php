<?php

namespace common\models;

use Yii;

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
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'country'], 'required'],
            [['status'], 'integer'],
            [['name', 'country'], 'string', 'max' => 50],
            [['country'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country' => 'title']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'country' => Yii::t('app', 'Country'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

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
     * @return CityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CityQuery(get_called_class());
    }
}
