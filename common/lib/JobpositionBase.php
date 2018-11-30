<?php

namespace common\lib;

use Yii;

/**
 * This is the model class for table "j2j_jobposition".
 *
 * @property integer $id
 * @property integer $companyid
 * @property string $title
 * @property string $subtitle
 * @property string $postcode
 * @property string $city
 * @property string $country
 * @property string $comments
 * @property string $jobstartdate
 * @property integer $duration
 * @property integer $extends
 * @property string $showdate
 * @property string $expiredate
 * @property integer $jobtype
 * @property integer $status
 * @property string $createdate
 * @property string $updatedate
 *
 * @property Company $company
 * @property Jobpositionskill[] $jobpositionskills
 * @property Skills[] $skills
 */
class JobpositionBase extends \common\models\Jobposition
{
	public $allskill;
	
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'companyid' => Yii::t('app', 'Companyid'),
            'title' => Yii::t('app', 'Titel'),
            'subtitle' => Yii::t('app', 'Subtitel'),
            'postcode' => Yii::t('app', 'Postleitzahl'),
            'city' => Yii::t('app', 'Ort'),
            'country' => Yii::t('app', 'Land'),
            'comments' => Yii::t('app', 'Beschreibung'),
            'jobstartdate' => Yii::t('app', 'Job-Beginn'),
            'duration' => Yii::t('app', 'Job-Dauer'),
            'extends' => Yii::t('app', 'Verlängerung möglich'),
            'showdate' => Yii::t('app', 'Showdate'),
            'expiredate' => Yii::t('app', 'Gültigkeit'),
            'jobtype' => Yii::t('app', 'Hauptkategorie'),
            'vacancy' => Yii::t('app', 'Vakanz'),
            'worktype' => Yii::t('app', 'Arbeitszeitmodel'),
            'status' => Yii::t('app', 'Status'),
            'createdate' => Yii::t('app', 'Createdate'),
            'updatedate' => Yii::t('app', 'Updatedate'),
        		];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
    	return $this->hasOne(UsersBase::className(), ['id' => 'userid']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
    	return $this->hasOne(CompanyBase::className(), ['id' => 'companyid'])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkills()
    {
    	return JobpositionskillBase::findAll(['jobid' => $this->id]);
    }
    
    
}
