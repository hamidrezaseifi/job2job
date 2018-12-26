<?php

namespace common\lib;

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
class JobpositionskillBase extends \common\models\Jobpositionskill
{
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJob()
    {
        return $this->hasOne(JobpositionBase::className(), ['id' => 'jobid']);
    }

    /**
     * @inheritdoc
     * @return JobpositionskillQueryBase the active query used by this AR class.
     */
    public static function find()
    {
    	return new JobpositionskillQueryBase(get_called_class());
    }
}
