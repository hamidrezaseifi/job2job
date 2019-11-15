<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_users".
 *
 * @property integer $id
 * @property string $uname
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $auth_key
 * @property string $fname
 * @property string $lname
 * @property string $bdate
 * @property integer $usertype
 * @property integer $group
 * @property integer $permission
 * @property integer $receive_backend_email
 * @property integer $status
 * @property string $createdate
 * @property string $updatedate
 *
 * @property Application[] $applications
 * @property Backmessage[] $backmessages
 * @property Candidatefavorite[] $candidatefavorites
 * @property Jobposition[] $jobpos
 * @property Candidatejobapply[] $candidatejobapplies
 * @property Jobposition[] $jobpos0
 * @property Jobposition[] $jobpositions
 * @property Personaldecisionmaker $personaldecisionmaker
 * @property Targetmessageusers $targetmessageusers
 * @property Usergroup $group0
 * @property Userpermission $permission0
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uname', 'fname', 'lname', 'password_hash'], 'required'],
            [['bdate', 'createdate', 'updatedate'], 'safe'],
            [['usertype', 'group', 'permission', 'receive_backend_email', 'status'], 'integer'],
            [['uname', 'fname', 'lname'], 'string', 'max' => 45],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['group'], 'exist', 'skipOnError' => true, 'targetClass' => Usergroup::className(), 'targetAttribute' => ['group' => 'id']],
            [['permission'], 'exist', 'skipOnError' => true, 'targetClass' => Userpermission::className(), 'targetAttribute' => ['permission' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'uname' => Yii::t('app', 'Uname'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'fname' => Yii::t('app', 'Fname'),
            'lname' => Yii::t('app', 'Lname'),
            'bdate' => Yii::t('app', 'Bdate'),
            'usertype' => Yii::t('app', 'Usertype'),
            'group' => Yii::t('app', 'Group'),
            'permission' => Yii::t('app', 'Permission'),
            'receive_backend_email' => Yii::t('app', 'Receive Backend Email'),
            'status' => Yii::t('app', 'Status'),
            'createdate' => Yii::t('app', 'Createdate'),
            'updatedate' => Yii::t('app', 'Updatedate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackmessages()
    {
        return $this->hasMany(Backmessage::className(), ['userid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCandidatefavorites()
    {
        return $this->hasMany(Candidatefavorite::className(), ['userid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobpos()
    {
        return $this->hasMany(Jobposition::className(), ['id' => 'jobposid'])->viaTable('j2j_candidatefavorite', ['userid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCandidatejobapplies()
    {
        return $this->hasMany(Candidatejobapply::className(), ['userid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobpos0()
    {
        return $this->hasMany(Jobposition::className(), ['id' => 'jobposid'])->viaTable('j2j_candidatejobapply', ['userid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobpositions()
    {
        return $this->hasMany(Jobposition::className(), ['userid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaldecisionmaker()
    {
        return $this->hasOne(Personaldecisionmaker::className(), ['userid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTargetmessageusers()
    {
        return $this->hasOne(Targetmessageusers::className(), ['userid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup0()
    {
        return $this->hasOne(Usergroup::className(), ['id' => 'group']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermission0()
    {
        return $this->hasOne(Userpermission::className(), ['id' => 'permission']);
    }

    /**
     * @inheritdoc
     * @return UsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersQuery(get_called_class());
    }
}
