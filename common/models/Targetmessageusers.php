<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_targetmessageusers".
 *
 * @property integer $userid
 * @property integer $status
 *
 * @property Users $user
 */
class Targetmessageusers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_targetmessageusers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid'], 'required'],
            [['userid', 'status'], 'integer'],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userid' => Yii::t('app', 'Userid'),
            'status' => Yii::t('app', 'Status'),
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
     * @return TargetmessageusersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TargetmessageusersQuery(get_called_class());
    }
}
