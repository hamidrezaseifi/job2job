<?php

namespace common\lib;

use Yii;
use common\models\Users;

/**
 * This is the model class for table "j2j_company".
 *
 * @property integer $id
 * @property string $companyname
 * @property integer $companytype
 * @property string $founddate
 * @property string $adress
 * @property string $taxid
 * @property string $homepage
 * @property string $logo
 * @property integer $employeecountindex
 * @property integer $isjob2job
 * @property integer $status
 * @property string $createdate
 * @property string $updatedate
 *
 * @property Connectedcompany[] $connectedcompanies
 * @property Jobposition[] $jobpositions
 */
class CompanyBase extends \common\models\Company
{
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'pdmid' => Yii::t('app', 'Pdmid'),
            'companyname' => Yii::t('app', 'Firmenname'),
            'companytype' => Yii::t('app', 'Geschäftsform'),
            'founddate' => Yii::t('app', 'Gründungsdatum'),
            'email' => Yii::t('app', 'Email'),
            'adress' => Yii::t('app', 'Adress'),
            'taxid' => Yii::t('app', 'Steuer-ID'),
            'homepage' => Yii::t('app', 'Homepage'),
            'logo' => Yii::t('app', 'Logo'),
            'employeecountindex' => Yii::t('app', 'Anzahl der Mitarbeiter'),
           	'isjob2job' => Yii::t('app', 'Job2job Unternehmer'),
        	'status' => Yii::t('app', 'Status'),
            'createdate' => Yii::t('app', 'Created At'),
            'updatedate' => Yii::t('app', 'Updated At'),
        ];
    }

    public static function find()
    {
    	return new CompanyQueryBase(get_called_class());
    }

    public function personalDecisionMakerList()
    {
    	$list =  PersonaldecisionmakerBase::find()->where(['companyid' => $this->id])->all();
    	$out = array();
    	foreach ($list as $item)
    	{
    		$index = ($item->isdeputy ? 1 : 0);
    		$out[$index] = $item;
    	}
    	 
    	return $out;
    }

    public function connectedCompanies()
    {
    	return ConnectedcompanyBase::find()->where(['companyid' => $this->id])->all();
    }

    public function getType()
    {
    	return CompanytypeBase::findOne(['id' => $this->companytype]);
    }
    
}
