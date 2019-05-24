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
 * @property integer $branch
 * @property integer $vacancy
 * @property integer $worktype
 * @property integer $userid
 * @property integer $status
 * @property string $createdate
 * @property string $updatedate
 *
 * @property Candidatefavorite[] $candidatefavorites
 * @property Users[] $users
 * @property Candidatejobapply[] $candidatejobapplies
 * @property Users[] $users0
 * @property Company $company
 * @property Branch $branch0
 * @property Users $user
 * @property Vacancy $vacancy0
 * @property Jobpositionseen[] $jobpositionseens
 * @property JobpositionskillBase[] $jobpositionskills
 * @property JobpositiontasksBase[] $jobpositiontasks
 */
class JobpositionBase extends \common\models\Jobposition
{
	public $allskill;
	public $jobCount;
	
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
            'branch' => Yii::t('app', 'Branch'),
            'vacancy' => Yii::t('app', 'Vakanz'),
            'worktype' => Yii::t('app', 'Arbeitszeitmodel'),
            'status' => Yii::t('app', 'Status'),
            'createdate' => Yii::t('app', 'Createdate'),
            'updatedate' => Yii::t('app', 'Updatedate'),
        		];
    }

    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['companyid', 'title', 'subtitle', 'postcode', 'city', 'jobstartdate', 'showdate', 'expiredate', 'branch', 'vacancy', 'worktype'], 'required'],
            [['duration', 'extends', 'status'], 'integer'],
            [['companyid', 'branch', 'vacancy', 'worktype', 'userid'], 'integer', 'integerOnly'=>true, 'min'=>1],
            [['comments'], 'string'],
            [['jobstartdate', 'showdate', 'expiredate'], 'safe'],
            [['title', 'city', 'country'], 'string', 'min' => 3, 'max' => 80],
            [['subtitle'], 'string', 'max' => 500],
            [['postcode'], 'string', 'max' => 20],
            [['companyid'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyBase::className(), 'targetAttribute' => ['companyid' => 'id']],
            [['branch'], 'exist', 'skipOnError' => true, 'targetClass' => BranchBase::className(), 'targetAttribute' => ['branch' => 'id']],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => UsersBase::className(), 'targetAttribute' => ['userid' => 'id']],
            [['vacancy'], 'exist', 'skipOnError' => true, 'targetClass' => VacancyBase::className(), 'targetAttribute' => ['vacancy' => 'id']],
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
    public function isCompanyJob2Job()
    {
        $comp = $this->getCompany();
        return $comp ? $comp->isjob2job : 0;
    }

/**
     * @return \yii\db\ActiveQuery
     */
    public function getSkills()
    {
    	return JobpositionskillBase::findAll(['jobid' => $this->id]);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkillsAsStringList()
    {
        $skillModels = JobpositionskillBase::findAll(['jobid' => $this->id]);
        $skills = [];
        
        foreach ($skillModels as $skillModel) {
            $skills[] = $skillModel->skill;
        }
        
        return $skills;
    }
    
    /**
     * @inheritdoc
     * @return JobpositionQueryBase the active query used by this AR class.
     */
    public static function find()
    {
        return new JobpositionQueryBase(get_called_class());
    }
    
    public static function allRegions()
    {
         $models = JobpositionBase::find()->select(['city', 'country'])->distinct()->orderBy(['country' => SORT_ASC, 'city' => SORT_ASC])->all();
        
         $regions = [];
         
         foreach ($models as $model){
             if(!isset($regions[$model->country])){
                 $regions[$model->country] = [];
             }
             $regions[$model->country][] = $model->city;
         }
         
         return $regions;
    }
    
    public function getBranch()
    {
        return $this->hasOne(BranchBase::className(), ['id' => 'branch']);
    }
    
    public function getWorktype()
    {
        return $this->hasOne(WorktimemodelBase::className(), ['id' => 'worktype']);
    }
    
    public function getJobpositiontasks()
    {
        return $this->hasMany(JobpositiontasksBase::className(), ['jobid' => 'id'])->all();
    }

    public function getJobpositionskills()
    {
        return $this->hasMany(JobpositionskillBase::className(), ['jobid' => 'id'])->all();
    }
    
}
