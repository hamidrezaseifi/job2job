<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_vacancy".
 *
 * @property integer $id
 * @property string $title
 * @property integer $status
 *
 * @property Jobposition[] $jobpositions
 */
class Vacancy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_vacancy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status'], 'integer'],
            [['title'], 'string', 'max' => 55],
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
    public function getJobpositions()
    {
        return $this->hasMany(Jobposition::className(), ['vacancy' => 'id']);
    }

    /**
     * @inheritdoc
     * @return VacancyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VacancyQuery(get_called_class());
    }
}
