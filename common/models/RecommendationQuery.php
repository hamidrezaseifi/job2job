<?php

namespace common\models;

use common\models\Recommendation;

/**
 * This is the ActiveQuery class for [[Recommendation]].
 *
 * @see Recommendation
 */
class RecommendationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Recommendation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Recommendation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
