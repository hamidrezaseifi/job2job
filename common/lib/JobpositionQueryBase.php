<?php

namespace common\lib;

/**
 * This is the ActiveQuery class for [[Jobposition]].
 *
 * @see Jobposition
 */
class JobpositionQueryBase extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return JobpositionBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return JobpositionBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
