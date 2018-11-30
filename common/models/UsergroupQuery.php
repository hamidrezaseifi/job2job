<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Usergroup]].
 *
 * @see Usergroup
 */
class UsergroupQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Usergroup[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Usergroup|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
