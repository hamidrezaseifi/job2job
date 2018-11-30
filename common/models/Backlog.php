<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_backlog".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $logdesc
 * @property string $logdate
 *
 * @property Users $user
 */
class Backlog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_backlog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'logdate'], 'required'],
            [['userid'], 'integer'],
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
     * @return BacklogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BacklogQuery(get_called_class());
    }
}
