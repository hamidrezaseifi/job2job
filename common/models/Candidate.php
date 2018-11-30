<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_candidate".
 *
 * @property integer $userid
 * @property string $title
 * @property string $title2
 * @property string $nationality
 * @property string $photo
 * @property string $email
 * @property string $homenumber
 * @property string $street
 * @property string $pcode
 * @property string $city
 * @property string $country
 * @property string $address1
 * @property string $cellphone
 * @property string $tel
 * @property string $reachability
 * @property string $contacttime
 * @property integer $employment
 * @property string $availability
 * @property integer $branch
 * @property integer $jobtype
 * @property string $availablefrom
 * @property string $desiredjobpcode
 * @property string $desiredjobcity
 * @property string $desiredjobcountry
 * @property integer $desiredjobregion
 * @property string $coverletter
 * @property string $createdate
 * @property string $updatedate
 *
 * @property Users $user
 */
class Candidate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_candidate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'email', 'branch', 'jobtype'], 'required'],
            [['userid', 'employment', 'branch', 'jobtype', 'desiredjobregion'], 'integer'],
            [['availablefrom', 'createdate', 'updatedate'], 'safe'],
            [['coverletter'], 'string'],
            [['title', 'homenumber'], 'string', 'max' => 15],
            [['title2', 'nationality', 'street', 'pcode', 'city', 'country', 'cellphone', 'tel', 'reachability', 'contacttime', 'availability', 'desiredjobpcode', 'desiredjobcity', 'desiredjobcountry'], 'string', 'max' => 45],
            [['photo', 'address1'], 'string', 'max' => 200],
            [['email'], 'string', 'max' => 100],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userid' => Yii::t('app', 'Userid'),
            'title' => Yii::t('app', 'Title'),
            'title2' => Yii::t('app', 'Title2'),
            'nationality' => Yii::t('app', 'Nationality'),
            'photo' => Yii::t('app', 'Photo'),
            'email' => Yii::t('app', 'Email'),
            'homenumber' => Yii::t('app', 'Homenumber'),
            'street' => Yii::t('app', 'Street'),
            'pcode' => Yii::t('app', 'Pcode'),
            'city' => Yii::t('app', 'City'),
            'country' => Yii::t('app', 'Country'),
            'address1' => Yii::t('app', 'Address1'),
            'cellphone' => Yii::t('app', 'Cellphone'),
            'tel' => Yii::t('app', 'Tel'),
            'reachability' => Yii::t('app', 'Reachability'),
            'contacttime' => Yii::t('app', 'Contacttime'),
            'employment' => Yii::t('app', 'Employment'),
            'availability' => Yii::t('app', 'Availability'),
            'branch' => Yii::t('app', 'Branch'),
            'jobtype' => Yii::t('app', 'Jobtype'),
            'availablefrom' => Yii::t('app', 'Availablefrom'),
            'desiredjobpcode' => Yii::t('app', 'Desiredjobpcode'),
            'desiredjobcity' => Yii::t('app', 'Desiredjobcity'),
            'desiredjobcountry' => Yii::t('app', 'Desiredjobcountry'),
            'desiredjobregion' => Yii::t('app', 'Desiredjobregion'),
            'coverletter' => Yii::t('app', 'Coverletter'),
            'createdate' => Yii::t('app', 'Createdate'),
            'updatedate' => Yii::t('app', 'Updatedate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'userid']);
    }

    /**
     * @inheritdoc
     * @return CandidateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CandidateQuery(get_called_class());
    }
}
