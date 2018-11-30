<?php

namespace common\models;

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
 * @property string $createdate
 * @property string $updatedate
 *
 * @property Users $user
 */
class Personaldecisionmaker extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_personaldecisionmaker';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'companyid', 'email', 'createdate'], 'required'],
            [['userid', 'companyid', 'isdeputy'], 'integer'],
            [['createdate', 'updatedate'], 'safe'],
            [['title'], 'string', 'max' => 15],
            [['title2', 'cellphone', 'tel', 'reachability', 'contacttime'], 'string', 'max' => 45],
            [['email'], 'string', 'max' => 100],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userid' => Yii::t('app', 'Userid'),
            'companyid' => Yii::t('app', 'Companyid'),
            'title' => Yii::t('app', 'Title'),
            'title2' => Yii::t('app', 'Title2'),
            'email' => Yii::t('app', 'Email'),
            'cellphone' => Yii::t('app', 'Cellphone'),
            'tel' => Yii::t('app', 'Tel'),
            'reachability' => Yii::t('app', 'Reachability'),
            'contacttime' => Yii::t('app', 'Contacttime'),
            'isdeputy' => Yii::t('app', 'Isdeputy'),
            'createdate' => Yii::t('app', 'Createdate'),
            'updatedate' => Yii::t('app', 'Updatedate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'userid']);
    }

    /**
     * @inheritdoc
     * @return PersonaldecisionmakerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PersonaldecisionmakerQuery(get_called_class());
    }
}
