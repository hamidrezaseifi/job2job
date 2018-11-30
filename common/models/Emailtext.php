<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_emailtext".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $texttype
 * @property integer $status
 */
class Emailtext extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_emailtext';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['status'], 'integer'],
            [['title'], 'string', 'max' => 200],
            [['texttype'], 'string', 'max' => 45],
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
            'text' => Yii::t('app', 'Text'),
            'texttype' => Yii::t('app', 'Texttype'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return EmailtextQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmailtextQuery(get_called_class());
    }
}
