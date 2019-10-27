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
    
    public static function findAllJobIdsForSkills($skills)
    {
        $skillIdListModels = JobpositionskillBase::find()->where(['in', 'skill', $skills])->select(['jobid'])->distinct()->all();
        
        $skillIdList = [];
        foreach($skillIdListModels as $skillIdListModel){
            $skillIdList[] = $skillIdListModel->jobid;
        }
        
        return $skillIdList;
    }
    
    public  static function findAllJobSkills($jobid){
        $selectedJobTask = JobpositionskillBase::find()->where(['jobid' => $jobid])->all();
        $list = [];
        foreach ($selectedJobTask as $model){
            $list[] = $model->skill;
        }
        return $list;
    }
}
