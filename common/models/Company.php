<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_company".
 *
 * @property integer $id
 * @property string $companyname
 * @property integer $companytype
 * @property string $founddate
 * @property string $homenumber
 * @property string $street
 * @property string $city
 * @property string $pcode
 * @property string $adress1
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
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['companyname'], 'required'],
            [['companytype', 'employeecountindex', 'isjob2job', 'status'], 'integer'],
            [['founddate', 'createdate', 'updatedate'], 'safe'],
            [['companyname'], 'string', 'max' => 80],
            [['homenumber', 'pcode'], 'string', 'max' => 15],
            [['street', 'city'], 'string', 'max' => 45],
            [['adress1', 'homepage', 'logo'], 'string', 'max' => 200],
            [['taxid'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'companyname' => Yii::t('app', 'Companyname'),
            'companytype' => Yii::t('app', 'Companytype'),
            'founddate' => Yii::t('app', 'Founddate'),
            'homenumber' => Yii::t('app', 'Homenumber'),
            'street' => Yii::t('app', 'Street'),
            'city' => Yii::t('app', 'City'),
            'pcode' => Yii::t('app', 'Pcode'),
            'adress1' => Yii::t('app', 'Adress1'),
            'taxid' => Yii::t('app', 'Taxid'),
            'homepage' => Yii::t('app', 'Homepage'),
            'logo' => Yii::t('app', 'Logo'),
            'employeecountindex' => Yii::t('app', 'Employeecountindex'),
            'isjob2job' => Yii::t('app', 'Isjob2job'),
            'status' => Yii::t('app', 'Status'),
            'createdate' => Yii::t('app', 'Createdate'),
            'updatedate' => Yii::t('app', 'Updatedate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConnectedcompanies()
    {
        return $this->hasMany(Connectedcompany::className(), ['companyid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobpositions()
    {
        return $this->hasMany(Jobposition::className(), ['companyid' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CompanyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CompanyQuery(get_called_class());
    }
}
