<?php

namespace common\models;

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
class Jobpositiontasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'j2j_jobpositiontasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jobid', 'task'], 'required'],
            [['jobid'], 'integer'],
            [['task'], 'string', 'max' => 4000],
        ];
    }

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
     * @return JobpositiontasksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JobpositiontasksQuery(get_called_class());
    }
}
