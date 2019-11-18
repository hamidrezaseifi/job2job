<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%skills}}".
 *
 * @property integer $id
 * @property integer $parentid
 * @property string $title
 * @property integer $status
 * @property string $createdate
 * @property string $updatedate
 *
 * @property Jobpositionskill[] $jobpositionskills
 * @property Jobposition[] $jobs
 */
class Skills extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%skills}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parentid', 'status'], 'integer'],
            [['title', 'createdate', 'updatedate'], 'required'],
            [['createdate', 'updatedate'], 'safe'],
            [['title'], 'string', 'max' => 80],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parentid' => Yii::t('app', 'Parentid'),
            'title' => Yii::t('app', 'Title'),
            'status' => Yii::t('app', 'Status'),
            'createdate' => Yii::t('app', 'Createdate'),
            'updatedate' => Yii::t('app', 'Updatedate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobpositionskills()
    {
        return $this->hasMany(Jobpositionskill::className(), ['skillid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobs()
    {
        return $this->hasMany(Jobposition::className(), ['id' => 'jobid'])->viaTable('{{%jobpositionskill}}', ['skillid' => 'id']);
    }

    /**
     * @inheritdoc
     * @return SkillsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SkillsQuery(get_called_class());
    }
}
