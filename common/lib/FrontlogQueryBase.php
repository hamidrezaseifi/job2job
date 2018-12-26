<?php

namespace common\lib;

/**
 * This is the ActiveQuery class for [[Frontlog]].
 *
 * @see Frontlog
 */
class FrontlogQueryBase extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return FrontlogBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return FrontlogBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
