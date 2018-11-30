<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Frontlog]].
 *
 * @see Frontlog
 */
class FrontlogQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Frontlog[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Frontlog|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
