<?php

namespace common\lib;

/**
 * This is the ActiveQuery class for [[Jobpositionseen]].
 *
 * @see Jobpositionseen
 */
class JobpositionseenQueryBase extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return JobpositionseenBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return JobpositionseenBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
