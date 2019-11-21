<?php

namespace common\lib;

use Yii;
use common\models\Userpermission;

class UsersBase extends \common\models\Users
{
	const UserTypeBackend = 1;
	const UserTypeCompany = 2;
	const UserTypeCandidate = 3;
	
	const UserStatusActive = 1;
	const UserStatusDeactive = 2;
	const UserStatusDeleted = 3;
	const UserStatusApprove = 4;
	
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'uname' => Yii::t('app', 'Benutzname'),
            'password_hash' => Yii::t('app', 'Kennwort'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'fname' => Yii::t('app', 'Vorname'),
            'lname' => Yii::t('app', 'Nachname'),
        	'bdate' => Yii::t('app', 'Geburtsdatum'),
        	'isbackend' => Yii::t('app', 'Isbackend'),
            'createdate' => Yii::t('app', 'Created'),
            'updatedate' => Yii::t('app', 'Last Update'),
            'group' => Yii::t('app', 'Gruppe'),
            'permission' => Yii::t('app', 'Zugriff'),
            'receive_backend_email' => Yii::t('app', 'E-Mail von job2job erhalten'),
        	'status' => Yii::t('app', 'Status'),
        ];
    }

    public static function statusTitleByStatus($status)
    {
    	switch ($status)
    	{
    		case self::UserStatusActive : return \Yii::t('app', 'Aktiv');
    		case self::UserStatusDeactive : return \Yii::t('app', 'Deactive');
    		case self::UserStatusDeleted : return \Yii::t('app', 'Deleted');
    		case self::UserStatusApprove : return \Yii::t('app', 'Approve request');
    	}
    	return '';
    }
    
    public static function userTypeTitle($type)
    {
    	switch ($type)
    	{
    		case self::UserTypeBackend : return \Yii::t('app', 'Backend');
    		case self::UserTypeCompany : return \Yii::t('app', 'Company');
    		case self::UserTypeCandidate : return \Yii::t('app', 'Job Seeker');
    		//case 1 : return \Yii::t('app', 'Aktiv');
    	}
    	return '';
    }

    public function load($data, $formName = null)
    {
    
    	$res = parent::load($data, $formName);
    	if(count($data) && ($this->updatedate == null || !$this->updatedate ))
    		$this->updatedate = date("Y-m-d H:i:s");
    	return $res;
    }
    
    public function fullname()
    {
        
        return $this->lname . ', ' . $this->fname;
    }
    
    public function statusTitle()
    {
        
        return UsersBase::statusTitleByStatus($this->status);
    }
    
    public static function allActiveBackend()
    {
    	$userdatalist = UsersBase::find()->where(['status' => self::UserStatusActive , 'usertype' => self::UserTypeBackend])->all();
    	$list = array();
    	foreach ($userdatalist as $model)
    	{
    		$list[$model->id] = $model->lname . ', ' . $model->fname ;
    	}
    	return$list;
    }

    public function company()
    {
    	$pdmModel = $this->personalDecisionMaker();
    	if($pdmModel)
    	{
    		$company = CompanyBase::find()->where(['id' => $pdmModel->companyid])->one();
    		 
    		return $company == null ? false : $company;
    	}
    	return false;
    }
    
    public function candidate()
    {
    	return CandidateBase::find()->where(['userid' => $this->id])->one();
    }
    
    public function isCompany(){
        return $this->usertype == self::UserTypeCompany;
    }
    
    public function isCandidate(){
        return $this->usertype == self::UserTypeCandidate;
    }
    
    public function personalDecisionMaker()
    {
        return PersonaldecisionmakerBase::find()->where(['userid' => $this->id])->one();
    }
    
    public function getPermission()
    {
        return Userpermission::find()->where(['id' => $this->permission])->one();
    }
}
