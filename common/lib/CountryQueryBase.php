<?php

namespace common\lib;

/**
 * This is the ActiveQuery class for [[Country]].
 *
 * @see Country
 */
class CountryQueryBase extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CountryBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CountryBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
