<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_userpermission".
 *
 * @property integer $id
 * @property string $title
 * @property integer $status
 *
 * @property Users[] $users
 */
class Userpermission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_userpermission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'status'], 'integer'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['permission' => 'id']);
    }

    /**
     * @inheritdoc
     * @return UserpermissionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserpermissionQuery(get_called_class());
    }
}
