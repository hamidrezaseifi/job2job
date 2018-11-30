<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Userpermission]].
 *
 * @see Userpermission
 */
class UserpermissionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Userpermission[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Userpermission|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
