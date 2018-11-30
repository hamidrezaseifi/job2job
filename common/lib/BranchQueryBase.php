<?php

namespace common\lib;

/**
 * This is the ActiveQuery class for [[Branch]].
 *
 * @see Branch
 */
class BranchQueryBase extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return BranchQueryBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BranchQueryBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
