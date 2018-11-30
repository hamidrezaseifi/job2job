<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Distance]].
 *
 * @see Distance
 */
class DistanceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Distance[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Distance|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
