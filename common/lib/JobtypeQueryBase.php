<?php

namespace common\lib;

/**
 * This is the ActiveQuery class for [[Jobtype]].
 *
 * @see Jobtype
 */
class JobtypeQueryBase extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return JobtypeBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return JobtypeBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
