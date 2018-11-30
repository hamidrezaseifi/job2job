<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_connectedcompany".
 *
 * @property integer $id
 * @property integer $companyid
 * @property string $name
 * @property integer $status
 *
 * @property Company $company
 */
class Connectedcompany extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_connectedcompany';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['companyid', 'name'], 'required'],
            [['companyid', 'status'], 'integer'],
            [['name'], 'string', 'max' => 55],
            [['companyid'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['companyid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'companyid' => Yii::t('app', 'Companyid'),
            'name' => Yii::t('app', 'Name'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'companyid']);
    }

    /**
     * @inheritdoc
     * @return ConnectedcompanyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ConnectedcompanyQuery(get_called_class());
    }
}
