<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_contactmessage".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $title
 * @property string $message
 * @property string $createdate
 */
class Contactmessage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'j2j_contactmessage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'title'], 'required'],
            [['message'], 'string'],
            [['createdate'], 'safe'],
            [['name', 'email'], 'string', 'max' => 100],
            [['title'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'title' => Yii::t('app', 'Title'),
            'message' => Yii::t('app', 'Message'),
            'createdate' => Yii::t('app', 'Createdate'),
        ];
    }
 
    /**
     * {@inheritdoc}
     * @return ContactmessageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContactmessageQuery(get_called_class());
    }
}
