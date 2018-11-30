<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%jobtype}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $menutitle
 * @property integer $status
 */
class Jobtype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%jobtype}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status'], 'integer'],
            [['title', 'menutitle'], 'string', 'max' => 85],
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
            'menutitle' => Yii::t('app', 'Menutitle'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return JobtypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JobtypeQuery(get_called_class());
    }
}
