<?php

namespace common\models;

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
 * @property integer $vacancy
 * @property integer $worktype
 * @property integer $userid
 * @property integer $status
 * @property string $createdate
 * @property string $updatedate
 *
 * @property Company $company
 * @property Users $user
 * @property Vacancy $vacancy0
 * @property Jobpositionskill[] $jobpositionskills
 */
class Jobposition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_jobposition';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['companyid', 'title', 'subtitle', 'postcode', 'city', 'country', 'jobstartdate', 'showdate', 'expiredate', 'createdate', 'updatedate'], 'required'],
            [['companyid', 'duration', 'extends', 'jobtype', 'vacancy', 'worktype', 'userid', 'status'], 'integer'],
            [['comments'], 'string'],
            [['jobstartdate', 'showdate', 'expiredate', 'createdate', 'updatedate'], 'safe'],
            [['title', 'city', 'country'], 'string', 'max' => 80],
            [['subtitle'], 'string', 'max' => 500],
            [['postcode'], 'string', 'max' => 20],
            [['companyid'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['companyid' => 'id']],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userid' => 'id']],
            [['vacancy'], 'exist', 'skipOnError' => true, 'targetClass' => Vacancy::className(), 'targetAttribute' => ['vacancy' => 'id']],
        ];
    }

    /**
     * @inheritdoc
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
            'jobtype' => Yii::t('app', 'Jobtype'),
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
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'companyid']);
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
    public function getJobpositionskills()
    {
        return $this->hasMany(Jobpositionskill::className(), ['jobid' => 'id']);
    }

    /**
     * @inheritdoc
     * @return JobpositionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JobpositionQuery(get_called_class());
    }
}
