<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Postcode]].
 *
 * @see Postcode
 */
class PostcodeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Postcode[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Postcode|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
