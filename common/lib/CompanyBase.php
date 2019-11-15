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
     *
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'companyname' => Yii::t('app', 'Firmenname'),
            'companytype' => Yii::t('app', 'Unternehmer-Typ'),
            'founddate' => Yii::t('app', 'Gründungsdatum'),
            'homenumber' => Yii::t('app', 'Homenumber'),
            'street' => Yii::t('app', 'Street'),
            'city' => Yii::t('app', 'City'),
            'postcode' => Yii::t('app', 'Postcode'),
            'adress1' => Yii::t('app', 'Adress1'),
            'taxid' => Yii::t('app', 'Steuer-ID'),
            'homepage' => Yii::t('app', 'Homepage'),
            'logo' => Yii::t('app', 'Logo'),
            'employeecountindex' => Yii::t('app', 'Employeecountindex'),
            'isjob2job' => Yii::t('app', 'Isjob2job'),
            'status' => Yii::t('app', 'Status'),
            'createdate' => Yii::t('app', 'Createdate'),
            'updatedate' => Yii::t('app', 'Updatedate')
        ];
    }

    public static function find()
    {
        return new CompanyQueryBase(get_called_class());
    }
    
    public static function findJob2job()
    {
        return CompanyBase::find()->where(['isjob2job' => 1])->one();
    }
    
    public function personalDecisionMakerList()
    {
        $list = PersonaldecisionmakerBase::find()->where([
            'companyid' => $this->id
        ])->all();
        $out = array();
        foreach ($list as $item) {
            $index = ($item->isdeputy ? 1 : 0);
            $out[$index] = $item;
        }

        return $out;
    }

    public function connectedCompanies()
    {
        return ConnectedcompanyBase::find()->where([
            'companyid' => $this->id
        ])->all();
    }

    public function getType()
    {
        return CompanytypeBase::findOne([
            'id' => $this->companytype
        ]);
    }
}
