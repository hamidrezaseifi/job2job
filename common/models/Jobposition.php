<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_jobposition".
 *
 * @property int $id
 * @property int $companyid
 * @property string $title
 * @property string $subtitle
 * @property string $postcode
 * @property string $city
 * @property string $country
 * @property string $comments
 * @property string $jobstartdate
 * @property int $duration
 * @property int $extends
 * @property string $showdate
 * @property string $expiredate
 * @property int $branch
 * @property int $vacancy
 * @property int $worktype
 * @property int $userid
 * @property int $status
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
 * @property Jobpositionskill[] $jobpositionskills
 * @property Jobpositiontasks[] $jobpositiontasks
 */
class Jobposition extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'j2j_jobposition';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['companyid', 'title', 'subtitle', 'postcode', 'city', 'jobstartdate', 'showdate', 'expiredate', 'branch'], 'required'],
            [['companyid', 'duration', 'extends', 'branch', 'vacancy', 'worktype', 'userid', 'status'], 'integer'],
            [['comments'], 'string'],
            [['jobstartdate', 'showdate', 'expiredate'], 'safe'],
            [['title', 'city', 'country'], 'string', 'max' => 80],
            [['subtitle'], 'string', 'max' => 500],
            [['postcode'], 'string', 'max' => 20],
            [['companyid'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['companyid' => 'id']],
            [['branch'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch' => 'id']],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userid' => 'id']],
            [['vacancy'], 'exist', 'skipOnError' => true, 'targetClass' => Vacancy::className(), 'targetAttribute' => ['vacancy' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'companyid' => Yii::t('app', 'Companyid'),
            'title' => Yii::t('app', 'Title'),
            'subtitle' => Yii::t('app', 'Subtitle'),
            'postcode' => Yii::t('app', 'Postcode'),
            'city' => Yii::t('app', 'City'),
            'country' => Yii::t('app', 'Country'),
            'comments' => Yii::t('app', 'Comments'),
            'jobstartdate' => Yii::t('app', 'Jobstartdate'),
            'duration' => Yii::t('app', 'Duration'),
            'extends' => Yii::t('app', 'Extends'),
            'showdate' => Yii::t('app', 'Showdate'),
            'expiredate' => Yii::t('app', 'Expiredate'),
            'branch' => Yii::t('app', 'Branch'),
            'vacancy' => Yii::t('app', 'Vacancy'),
            'worktype' => Yii::t('app', 'Worktype'),
            'userid' => Yii::t('app', 'Userid'),
            'status' => Yii::t('app', 'Status'),
            'createdate' => Yii::t('app', 'Createdate'),
            'updatedate' => Yii::t('app', 'Updatedate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCandidatefavorites()
    {
        return $this->hasMany(Candidatefavorite::className(), ['jobposid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['id' => 'userid'])->viaTable('j2j_candidatefavorite', ['jobposid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCandidatejobapplies()
    {
        return $this->hasMany(Candidatejobapply::className(), ['jobposid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers0()
    {
        return $this->hasMany(Users::className(), ['id' => 'userid'])->viaTable('j2j_candidatejobapply', ['jobposid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'companyid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch0()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'userid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacancy0()
    {
        return $this->hasOne(Vacancy::className(), ['id' => 'vacancy']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobpositionseens()
    {
        return $this->hasMany(Jobpositionseen::className(), ['jobpos' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobpositionskills()
    {
        return $this->hasMany(Jobpositionskill::className(), ['jobid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobpositiontasks()
    {
        return $this->hasMany(Jobpositiontasks::className(), ['jobid' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return JobpositionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JobpositionQuery(get_called_class());
    }
}
