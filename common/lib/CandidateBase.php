<?php
namespace common\lib;

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
 * @property string $coverletter
 * @property string $createdate
 * @property string $updatedate
 */
class CandidateBase extends \common\models\Candidate
{

    protected $_user = false;

    protected $_jobtype = false;

    protected $_branch = false;

    /**
     *
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
            'updatedate' => Yii::t('app', 'Updatedate')
        ];
    }

    public static function find()
    {
        return new CandidateQueryBase(get_called_class());
    }

    public function user()
    {
        if (! $this->_user) {
            $this->_user = UsersBase::findOne(
                [
                    'id' => $this->userid
                ]);
        }

        return $this->_user;
    }

    public function fullname()
    {
        if (! $this->_user) {
            $this->_user = UsersBase::findOne(
                [
                    'id' => $this->userid
                ]);
        }
        $name = $this->title;
        $name .= strlen($name) > 0 ? ' ' : '';
        $name .= $this->_user->fullname();
        return $name;
    }

    public function getJobtype()
    {
        if (! $this->_jobtype) {
            $this->_jobtype = JobtypeBase::findOne(
                [
                    'id' => $this->jobtype
                ]);
        }

        return $this->_jobtype;
    }

    public function getBranch()
    {
        if (! $this->$_branch) {
            $this->$_branch = BranchBase::findOne(
                [
                    'id' => $this->branch
                ]);
        }

        return $this->$_branch;
    }
}
