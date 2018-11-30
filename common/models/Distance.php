<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_distance".
 *
 * @property string $title
 * @property integer $status
 */
class Distance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_distance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status'], 'integer'],
            [['title'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => Yii::t('app', 'Title'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return DistanceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DistanceQuery(get_called_class());
    }
}
