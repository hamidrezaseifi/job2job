<?php

namespace common\lib;

/**
 * This is the ActiveQuery class for [[City]].
 *
 * @see City
 */
class CityQueryBase extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CityBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CityBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
