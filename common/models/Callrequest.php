<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_callrequest".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $tel
 * @property string $name
 * @property string $message
 * @property integer $status
 * @property string $createdate
 */
class Callrequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_callrequest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'status'], 'integer'],
            [['tel', 'name', 'message', 'createdate'], 'required'],
            [['createdate'], 'safe'],
            [['tel'], 'string', 'max' => 45],
            [['name'], 'string', 'max' => 100],
            [['message'], 'string', 'max' => 2000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'userid' => Yii::t('app', 'Userid'),
            'tel' => Yii::t('app', 'Tel'),
            'name' => Yii::t('app', 'Name'),
            'message' => Yii::t('app', 'Message'),
            'status' => Yii::t('app', 'Status'),
            'createdate' => Yii::t('app', 'Createdate'),
        ];
    }

    /**
     * @inheritdoc
     * @return CallrequestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CallrequestQuery(get_called_class());
    }
}
