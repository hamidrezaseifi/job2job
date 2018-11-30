<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_navigation".
 *
 * @property integer $id
 * @property integer $parentid
 * @property string $app
 * @property string $language
 * @property string $title
 * @property string $url
 * @property string $image
 * @property integer $position
 * @property string $createdate
 * @property string $updatedate
 * @property integer $status
 *
 * @property Languages $language0
 * @property Usergroupnavgation[] $usergroupnavgations
 * @property Usergroup[] $groups
 */
class Navigation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_navigation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parentid', 'position', 'status'], 'integer'],
            [['title'], 'required'],
            [['createdate', 'updatedate'], 'safe'],
            [['app', 'language', 'title', 'url'], 'string', 'max' => 45],
            [['image'], 'string', 'max' => 200],
            [['language'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['language' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parentid' => Yii::t('app', 'Parentid'),
            'app' => Yii::t('app', 'App'),
            'language' => Yii::t('app', 'Language'),
            'title' => Yii::t('app', 'Title'),
            'url' => Yii::t('app', 'Url'),
            'image' => Yii::t('app', 'Image'),
            'position' => Yii::t('app', 'Position'),
            'createdate' => Yii::t('app', 'Createdate'),
            'updatedate' => Yii::t('app', 'Updatedate'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage0()
    {
        return $this->hasOne(Languages::className(), ['id' => 'language']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsergroupnavgations()
    {
        return $this->hasMany(UserGroupNavgation::className(), ['navigationid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(UserGroup::className(), ['id' => 'groupid'])->viaTable('j2j_usergroupnavgation', ['navigationid' => 'id']);
    }

    /**
     * @inheritdoc
     * @return NavigationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NavigationQuery(get_called_class());
    }
}
