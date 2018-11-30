<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Contants]].
 *
 * @see Contants
 */
class ContantsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Contants[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Contants|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
