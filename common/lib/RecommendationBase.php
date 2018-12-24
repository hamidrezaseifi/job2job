<?php

namespace common\lib;

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
class RecommendationBase extends \common\models\Recommendation
{

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
     * @return RecommendationBaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RecommendationBaseQuery(get_called_class());
    }
}
