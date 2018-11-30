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
 * @property string $pcode
 * @property string $city
 * @property string $country
 * @property string $address
 * @property string $cellphone
 * @property string $tel
 * @property string $reachability
 * @property string $contacttime
 * @property integer $employment
 * @property string $availability
 * @property integer $jobtype
 * @property string $availablefrom
 * @property string $desiredjobpcode
 * @property string $desiredjobcity
 * @property string $desiredjobcountry
 * @property integer $desiredjobregion
 * @property integer $desiredjobtimetype
 * @property string $coverletter
 * @property string $createdate
 * @property string $updatedate
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
            [['userid', 'email', 'createdate'], 'required'],
            [['userid', 'employment', 'jobtype', 'desiredjobregion', 'desiredjobtimetype'], 'integer'],
            [['availablefrom', 'createdate', 'updatedate'], 'safe'],
            [['coverletter'], 'string'],
            [['title'], 'string', 'max' => 15],
            [['title2', 'nationality', 'pcode', 'city', 'country', 'cellphone', 'tel', 'reachability', 'contacttime', 'availability', 'desiredjobpcode', 'desiredjobcity', 'desiredjobcountry'], 'string', 'max' => 45],
            [['photo', 'address'], 'string', 'max' => 200],
            [['email'], 'string', 'max' => 100],
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
            'pcode' => Yii::t('app', 'Pcode'),
            'city' => Yii::t('app', 'City'),
            'country' => Yii::t('app', 'Country'),
            'address' => Yii::t('app', 'Address'),
            'cellphone' => Yii::t('app', 'Cellphone'),
            'tel' => Yii::t('app', 'Tel'),
            'reachability' => Yii::t('app', 'Reachability'),
            'contacttime' => Yii::t('app', 'Contacttime'),
            'employment' => Yii::t('app', 'Employment'),
            'availability' => Yii::t('app', 'Availability'),
            'jobtype' => Yii::t('app', 'Jobtype'),
            'availablefrom' => Yii::t('app', 'Availablefrom'),
            'desiredjobpcode' => Yii::t('app', 'Desiredjobpcode'),
            'desiredjobcity' => Yii::t('app', 'Desiredjobcity'),
            'desiredjobcountry' => Yii::t('app', 'Desiredjobcountry'),
            'desiredjobregion' => Yii::t('app', 'Desiredjobregion'),
            'desiredjobtimetype' => Yii::t('app', 'Desiredjobtimetype'),
            'coverletter' => Yii::t('app', 'Coverletter'),
            'createdate' => Yii::t('app', 'Createdate'),
            'updatedate' => Yii::t('app', 'Updatedate'),
        ];
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
