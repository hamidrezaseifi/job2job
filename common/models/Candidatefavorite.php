<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_candidatefavorite".
 *
 * @property integer $userid
 * @property integer $jobposid
 * @property string $createdate
 *
 * @property Jobposition $jobpos
 * @property Users $user
 */
class Candidatefavorite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_candidatefavorite';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'jobposid', 'createdate'], 'required'],
            [['userid', 'jobposid'], 'integer'],
            [['createdate'], 'safe'],
            [['jobposid'], 'exist', 'skipOnError' => true, 'targetClass' => Jobposition::className(), 'targetAttribute' => ['jobposid' => 'id']],
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
            'jobposid' => Yii::t('app', 'Jobposid'),
            'createdate' => Yii::t('app', 'Createdate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobpos()
    {
        return $this->hasOne(Jobposition::className(), ['id' => 'jobposid']);
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
     * @return CandidatefavoriteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CandidatefavoriteQuery(get_called_class());
    }
}
