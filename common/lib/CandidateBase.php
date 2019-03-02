<?php
namespace common\lib;

use Yii;

/**
 * This is the model class for table "j2j_candidate".
 *
 * @property int $userid
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
 * @property int $employment
 * @property string $availability
 * @property int $branch
 * @property string $availablefrom
 * @property string $desiredjobpcode
 * @property string $desiredjobcity
 * @property string $desiredjobcountry
 * @property int $desiredjobregion
 * @property string $coverletter
 * @property int $workpermission
 * @property string $workpermissionlimit
 * @property string $createdate
 * @property string $updatedate
 *
 * @property Users $user
 */
class CandidateBase extends \common\models\Candidate
{

    public static $WORK_PERMISSION_NO = 0;
    public static $WORK_PERMISSION_PERMANENT = 1;
    public static $WORK_PERMISSION_LIMITED = 2;
        
    protected $_user = false;

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
            'availablefrom' => Yii::t('app', 'Availablefrom'),
            'desiredjobpcode' => Yii::t('app', 'Desiredjobpcode'),
            'desiredjobcity' => Yii::t('app', 'Desiredjobcity'),
            'desiredjobcountry' => Yii::t('app', 'Desiredjobcountry'),
            'desiredjobregion' => Yii::t('app', 'Desiredjobregion'),
            'coverletter' => Yii::t('app', 'Coverletter'),
            'workpermission' => Yii::t('app', 'Workpermission'),
            'workpermissionlimit' => Yii::t('app', 'Workpermissionlimit'),
            'createdate' => Yii::t('app', 'Createdate'),
            'updatedate' => Yii::t('app', 'Updatedate'),
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
    
    public function workPermissionsTitles()
    {
        return [
            0 => Yii::t('app', 'Keine'),
            1 => Yii::t('app', 'Unberfristet'),
            2 => Yii::t('app', 'Berfristet'),
        ];
    }
    
    public function workPermissionTitle()
    {
        return $this->workPermissionsTitles()[$this->workpermission];
    }
}
