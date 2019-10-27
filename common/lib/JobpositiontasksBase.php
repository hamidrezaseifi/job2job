<?php

namespace common\lib;

use Yii;

/**
 * This is the model class for table "j2j_jobpositiontasks".
 *
 * @property int $id
 * @property int $jobid
 * @property string $task
 * @property string $createdate
 * @property string $updatedate
 */
class JobpositiontasksBase extends \common\models\Jobpositiontasks
{

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'jobid' => Yii::t('app', 'Jobid'),
            'task' => Yii::t('app', 'Task'),
            'createdate' => Yii::t('app', 'Createdate'),
            'updatedate' => Yii::t('app', 'Updatedate'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return JobpositiontasksQueryBase the active query used by this AR class.
     */
    public static function find()
    {
        return new JobpositiontasksQueryBase(get_called_class());
    }
    
    public  static function findAllJobTasks($jobid){
        $selectedJobTask = JobpositiontasksBase::find()->select(['task'])->where(['jobid' => $jobid])->all();
        $list = [];
        foreach ($selectedJobTask as $model){
            $list[] = $model->task;
        }
        return $list;
    }
}
