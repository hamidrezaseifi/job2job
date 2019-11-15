<?php

namespace common\lib;

use Yii;

/**
 * This is the model class for table "j2j_personaldecisionmaker".
 *
 * @property integer $userid
 * @property integer $companyid
 * @property string $title
 * @property string $title2
 * @property string $email
 * @property string $cellphone
 * @property string $tel
 * @property string $reachability
 * @property string $contacttime
 * @property integer $isdeputy
 * @property integer $status
 * @property string $createdate
 * @property string $updatedate
 *
 * @property Users $user
 */

class PersonaldecisionmakerBase extends \common\models\Personaldecisionmaker
{
	
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
           	'id' => Yii::t('app', 'ID'),
            'userid' => Yii::t('app', 'Userid'),
            'companyid' => Yii::t('app', 'Companyid'),
            'title' => Yii::t('app', 'Anrede'),
            'title2' => Yii::t('app', 'Titel'),
            'email' => Yii::t('app', 'Email'),
            'cellphone' => Yii::t('app', 'Cellphone'),
            'tel' => Yii::t('app', 'Tel'),
            'reachability' => Yii::t('app', 'Reachability'),
            'contacttime' => Yii::t('app', 'Contacttime'),
            'bdate' => Yii::t('app', 'Bdate'),
            'isdeputy' => Yii::t('app', 'Stellvertreter'),
            'status' => Yii::t('app', 'Status'),
            'createdate' => Yii::t('app', 'Createdate'),
            'updatedate' => Yii::t('app', 'Updatedate'),
        ];
    }

    /**
     * @inheritdoc
     * @return PersonaldecisionmakerQueryBase the active query used by this AR class.
     */
    public static function find()
    {
        return new PersonaldecisionmakerQueryBase(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
    	return UsersBase::find()->where(['id' => $this->userid])->one();
    }
    
     /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
    	return $this->hasOne(UsersBase::className(), ['id' => 'userid']);
    }
    
/**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
    	return CompanyBase::find()->where(['id' => $this->companyid])->one();
    }
}
