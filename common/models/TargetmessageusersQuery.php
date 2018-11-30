<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Targetmessageusers]].
 *
 * @see Targetmessageusers
 */
class TargetmessageusersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Targetmessageusers[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Targetmessageusers|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
