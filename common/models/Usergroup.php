<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_usergroup".
 *
 * @property integer $id
 * @property string $title
 * @property integer $status
 * @property string $createdate
 * @property string $updatedate
 *
 * @property Usergroupnavgation[] $usergroupnavgations
 * @property Navigation[] $navigations
 * @property Users[] $users
 */
class Usergroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_usergroup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'createdate', 'updatedate'], 'required'],
            [['status'], 'integer'],
            [['createdate', 'updatedate'], 'safe'],
            [['title'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'status' => Yii::t('app', 'Status'),
            'createdate' => Yii::t('app', 'Createdate'),
            'updatedate' => Yii::t('app', 'Updatedate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsergroupnavgations()
    {
        return $this->hasMany(Usergroupnavgation::className(), ['groupid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNavigations()
    {
        return $this->hasMany(Navigation::className(), ['id' => 'navigationid'])->viaTable('j2j_usergroupnavgation', ['groupid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['group' => 'id']);
    }

    /**
     * @inheritdoc
     * @return UsergroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsergroupQuery(get_called_class());
    }
}
