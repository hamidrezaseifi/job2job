<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_postcode".
 *
 * @property integer $code
 * @property string $city
 * @property integer $status
 *
 * @property City $city0
 */
class Postcode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_postcode';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'city'], 'required'],
            [['code', 'status'], 'integer'],
            [['city'], 'string', 'max' => 50],
            [['city'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city' => 'name']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'code' => Yii::t('app', 'Code'),
            'city' => Yii::t('app', 'City'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity0()
    {
        return $this->hasOne(City::className(), ['name' => 'city']);
    }

    /**
     * @inheritdoc
     * @return PostcodeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostcodeQuery(get_called_class());
    }
}
