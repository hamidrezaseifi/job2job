<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_frontlog".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $logdesc
 * @property integer $iscandidate
 * @property string $logdate
 *
 * @property Users $user
 */
class Frontlog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_frontlog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'logdate'], 'required'],
            [['userid', 'iscandidate'], 'integer'],
            [['logdate'], 'safe'],
            [['logdesc'], 'string', 'max' => 2000],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userid' => 'id']],
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
            'logdesc' => Yii::t('app', 'Logdesc'),
            'iscandidate' => Yii::t('app', 'Iscandidate'),
            'logdate' => Yii::t('app', 'Logdate'),
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
     * @return FrontlogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FrontlogQuery(get_called_class());
    }
}
