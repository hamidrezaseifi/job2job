<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_jobpositionseen".
 *
 * @property integer $id
 * @property integer $jobpos
 * @property string $ip
 * @property integer $seenuserid
 * @property string $createdate
 *
 * @property Jobposition $jobpos0
 */
class Jobpositionseen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_jobpositionseen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jobpos', 'ip', 'createdate'], 'required'],
            [['jobpos', 'seenuserid'], 'integer'],
            [['createdate'], 'safe'],
            [['ip'], 'string', 'max' => 45],
            [['jobpos'], 'exist', 'skipOnError' => true, 'targetClass' => Jobposition::className(), 'targetAttribute' => ['jobpos' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'jobpos' => Yii::t('app', 'Jobpos'),
            'ip' => Yii::t('app', 'Ip'),
            'seenuserid' => Yii::t('app', 'Seenuserid'),
            'createdate' => Yii::t('app', 'Createdate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobpos0()
    {
        return $this->hasOne(Jobposition::className(), ['id' => 'jobpos']);
    }

    /**
     * @inheritdoc
     * @return JobpositionseenQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JobpositionseenQuery(get_called_class());
    }
}
