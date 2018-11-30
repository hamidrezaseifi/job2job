<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_backmessage".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $title
 * @property string $message
 * @property string $words
 * @property integer $status
 * @property string $createdate
 *
 * @property Users $user
 */
class BackMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_backmessage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid'], 'required'],
            [['userid', 'status'], 'integer'],
            [['createdate'], 'safe'],
            [['title'], 'string', 'max' => 100],
            [['message'], 'string', 'max' => 400],
            [['words'], 'string', 'max' => 200],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => 'Userid',
            'title' => 'Title',
            'message' => 'Message',
            'words' => 'Words',
            'status' => 'Status',
            'createdate' => 'Createdate',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'userid']);
    }

    /**
     * @inheritdoc
     * @return BackMessageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BackMessageQuery(get_called_class());
    }
}
