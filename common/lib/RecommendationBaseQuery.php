<?php

namespace common\lib;


/**
 * This is the ActiveQuery class for [[Recommendation]].
 *
 * @see Recommendation
 */
class RecommendationBaseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RecommendationBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RecommendationBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
