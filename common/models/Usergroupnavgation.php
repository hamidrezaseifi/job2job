<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_usergroupnavgation".
 *
 * @property integer $groupid
 * @property integer $navigationid
 * @property integer $readright
 * @property integer $editright
 * @property integer $deleteright
 * @property integer $printright
 * @property integer $status
 * @property string $createdate
 *
 * @property Usergroup $group
 * @property Navigation $navigation
 */
class Usergroupnavgation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_usergroupnavgation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['groupid', 'navigationid', 'createdate'], 'required'],
            [['groupid', 'navigationid', 'readright', 'editright', 'deleteright', 'printright', 'status'], 'integer'],
            [['createdate'], 'safe'],
            [['groupid'], 'exist', 'skipOnError' => true, 'targetClass' => Usergroup::className(), 'targetAttribute' => ['groupid' => 'id']],
            [['navigationid'], 'exist', 'skipOnError' => true, 'targetClass' => Navigation::className(), 'targetAttribute' => ['navigationid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'groupid' => Yii::t('app', 'Groupid'),
            'navigationid' => Yii::t('app', 'Navigationid'),
            'readright' => Yii::t('app', 'Readright'),
            'editright' => Yii::t('app', 'Editright'),
            'deleteright' => Yii::t('app', 'Deleteright'),
            'printright' => Yii::t('app', 'Printright'),
            'status' => Yii::t('app', 'Status'),
            'createdate' => Yii::t('app', 'Createdate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Usergroup::className(), ['id' => 'groupid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNavigation()
    {
        return $this->hasOne(Navigation::className(), ['id' => 'navigationid']);
    }

    /**
     * @inheritdoc
     * @return UsergroupnavgationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsergroupnavgationQuery(get_called_class());
    }
}
