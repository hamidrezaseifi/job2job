<?php
namespace common\lib;

use Yii;
use common\helper\BrainStaticList;

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
            'title' => Yii::t('app', 'Anrde'),
            'title2' => Yii::t('app', 'Titel'),
            'nationality' => Yii::t('app', 'Staatsangehörigkeit'),
            'photo' => Yii::t('app', 'Bild'),
            'email' => Yii::t('app', 'E-Mail'),
            'homenumber' => Yii::t('app', 'Hausnr.'),
            'street' => Yii::t('app', 'Straße'),
            'pcode' => Yii::t('app', 'PLZ.'),
            'city' => Yii::t('app', 'Ort'),
            'country' => Yii::t('app', 'Land'),
            'address1' => Yii::t('app', 'Zusätzliche Adresse'),
            'cellphone' => Yii::t('app', 'Handy'),
            'tel' => Yii::t('app', 'Telefone'),
            'reachability' => Yii::t('app', 'Erreichbarkeit'),
            'contacttime' => Yii::t('app', 'Kontakt-Zeit'),
            'employment' => Yii::t('app', 'Beschäftigung'),
            'availability' => Yii::t('app', 'Verfügbarkeit'),
            'branch' => Yii::t('app', 'Branche'),
            'availablefrom' => Yii::t('app', 'Verfügbar ab'),
            'desiredjobpcode' => Yii::t('app', 'Gewünschter Job PLZ.'),
            'desiredjobcity' => Yii::t('app', 'Gewünschter Job Ort'),
            'desiredjobcountry' => Yii::t('app', 'Gewünschter Job Land'),
            'desiredjobregion' => Yii::t('app', 'Gewünschter Job Region'),
            'coverletter' => Yii::t('app', 'Motivationsschreiben'),
            'workpermission' => Yii::t('app', 'Arbeitserlaubnis'),
            'workpermissionlimit' => Yii::t('app', 'Arbeitserlaubnis bis'),
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
    
    public function availabilityTitle() {
        $accessableList = BrainStaticList::accessableList();
        return $accessableList[$this->availability];
    }
}
