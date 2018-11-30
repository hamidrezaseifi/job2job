<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%companytype}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $status
 */
class Companytype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%companytype}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status'], 'integer'],
            [['title'], 'string', 'max' => 45],
        ];
    }

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
     * @return CompanytypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CompanytypeQuery(get_called_class());
    }
}
