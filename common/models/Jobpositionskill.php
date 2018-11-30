<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_jobpositionskill".
 *
 * @property integer $jobid
 * @property string $skill
 * @property string $created
 *
 * @property Jobposition $job
 */
class Jobpositionskill extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_jobpositionskill';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jobid', 'skill', 'created'], 'required'],
            [['jobid'], 'integer'],
            [['created'], 'safe'],
            [['skill'], 'string', 'max' => 100],
            [['jobid'], 'exist', 'skipOnError' => true, 'targetClass' => Jobposition::className(), 'targetAttribute' => ['jobid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'jobid' => Yii::t('app', 'Jobid'),
            'skill' => Yii::t('app', 'Skill'),
            'created' => Yii::t('app', 'Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJob()
    {
        return $this->hasOne(Jobposition::className(), ['id' => 'jobid']);
    }

    /**
     * @inheritdoc
     * @return JobpositionskillQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JobpositionskillQuery(get_called_class());
    }
}
