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
     * @return Worktimemodel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Worktimemodel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
