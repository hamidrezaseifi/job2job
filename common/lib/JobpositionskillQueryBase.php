<?php

namespace common\lib;

/**
 * This is the ActiveQuery class for [[Jobpositionskill]].
 *
 * @see Jobpositionskill
 */
class JobpositionskillQueryBase extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return JobpositionskillBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return JobpositionskillBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
