<?php

namespace common\lib;

/**
 * This is the ActiveQuery class for [[Worktimemodel]].
 *
 * @see Worktimemodel
 */
class WorktimemodelQueryBase extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return WorktimemodelBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return WorktimemodelBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
