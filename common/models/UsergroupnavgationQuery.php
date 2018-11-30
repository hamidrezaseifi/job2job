<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Usergroupnavgation]].
 *
 * @see Usergroupnavgation
 */
class UsergroupnavgationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Usergroupnavgation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Usergroupnavgation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
