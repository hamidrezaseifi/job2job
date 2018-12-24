<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_recommendation".
 *
 * @property int $id
 * @property int $iscandidate
 * @property string $title
 * @property string $recommendation
 * @property string $updated
 */
class Recommendation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'j2j_recommendation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iscandidate'], 'integer'],
            [['title'], 'required'],
            [['recommendation'], 'string'],
            [['updated'], 'safe'],
            [['title'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'iscandidate' => Yii::t('app', 'Iscandidate'),
            'title' => Yii::t('app', 'Title'),
            'recommendation' => Yii::t('app', 'Recommendation'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return RecommendationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RecommendationQuery(get_called_class());
    }
}
