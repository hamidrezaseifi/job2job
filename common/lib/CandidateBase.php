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
 * @property integer $desiredjobtimetype
 * @property string $coverletter
 * @property string $createdate
 * @property string $updatedate
 */
class CandidateBase extends \common\models\Candidate
{
	protected $_user = false;
	protected $_jobtype = false;
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
				'userid' => Yii::t('app', 'Userid'),
				'title' => Yii::t('app', 'Anrede'),
				'title2' => Yii::t('app', 'Titel'),
				'nationality' => Yii::t('app', 'Staatsangehörigkeit'),
				'photo' => Yii::t('app', 'Bewerbungsfoto'),
				'email' => Yii::t('app', 'E-Mail'),
				'pcode' => Yii::t('app', 'Postleitzahl'),
				'city' => Yii::t('app', 'Stadt'),
				'country' => Yii::t('app', 'Land'),
				'address' => Yii::t('app', 'Straße,Hausnummer'),
				'cellphone' => Yii::t('app', 'Mobiltelefon'),
				'tel' => Yii::t('app', 'Festnetznummer'),
				'reachability' => Yii::t('app', 'Erreichbarkeit'),
				'contacttime' => Yii::t('app', 'Wann dürfen wir Sie kontaktieren?'),
				'employment' => Yii::t('app', 'Beschäftigung'),
				'availability' => Yii::t('app', 'Verfügbarkeit'),
				'jobtype' => Yii::t('app', 'Job-Sorte'),
				'availablefrom' => Yii::t('app', 'Verfügbar ab.'),
				'desiredjobpcode' => Yii::t('app', 'gewünschte Postleitzahl'),
				'desiredjobcity' => Yii::t('app', 'gewünschte Stadt'),
				'desiredjobcountry' => Yii::t('app', 'gewünschtes Land'),
				'desiredjobregion' => Yii::t('app', 'gewünschter Umkreis'),
				'desiredjobtimetype' => Yii::t('app', 'gewünschtes Arbeitszeitmodel'),
				'coverletter' => Yii::t('app', 'Anschreiben'),
				'createdate' => Yii::t('app', 'Created At'),
				'updatedate' => Yii::t('app', 'Updated At'),
		];
	}
	
	public static function find()
	{
		return new CandidateQueryBase(get_called_class());
	}

	public function user()
	{
		if(!$this->_user)
		{
			$this->_user = UsersBase::findOne(['id' => $this->userid]);
		}
	
		return $this->_user;
	}

	public function fullname()
	{
		if(!$this->_user)
		{
			$this->_user = UsersBase::findOne(['id' => $this->userid]);
		}
		$name = $this->title;
		$name .= strlen($name) > 0 ? ' ' : '';
		$name .= $this->_user->fullname();
		return $name;
	}
	
	public function getJobtype()
	{
		if(!$this->_jobtype)
		{
			$this->_jobtype = JobtypeBase::findOne(['id' => $this->jobtype]);
		}
	
		return $this->_jobtype;
	}
	
	public function getDesiredjobtimetype()
	{
		if($this->desiredjobtimetype > 0)
		{
			return WorktimemodelBase::findOne(['id' => $this->desiredjobtimetype])->title;
		}
		
		return '';
	}
}
