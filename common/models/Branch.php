<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_branch".
 *
 * @property integer $id
 * @property string $title
 * @property string $shortcut
 * @property string $image
 * @property string $logo
 * @property integer $status
 * @property string $created
 * @property string $updated
 *
 * @property Jobposition[] $jobpositions
 */
class Branch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_branch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'status'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['title'], 'string', 'max' => 80],
            [['shortcut'], 'string', 'max' => 45],
            [['image', 'logo'], 'string', 'max' => 200],
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
            'shortcut' => Yii::t('app', 'Shortcut'),
            'image' => Yii::t('app', 'Image'),
            'logo' => Yii::t('app', 'Logo'),
            'status' => Yii::t('app', 'Status'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobpositions()
    {
        return $this->hasMany(Jobposition::className(), ['branch' => 'id']);
    }
}
