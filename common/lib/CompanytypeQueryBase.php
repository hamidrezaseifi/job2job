<?php

namespace common\lib;

/**
 * This is the ActiveQuery class for [[Companytype]].
 *
 * @see Companytype
 */
class CompanytypeQueryBase extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Companytype[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Companytype|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
