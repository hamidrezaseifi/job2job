<?php

namespace common\lib;

/**
 * This is the ActiveQuery class for [[Personaldecisionmaker]].
 *
 * @see Personaldecisionmaker
 */
class PersonaldecisionmakerQueryBase extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PersonaldecisionmakerBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PersonaldecisionmakerBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
