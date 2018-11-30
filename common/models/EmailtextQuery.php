<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Emailtext]].
 *
 * @see Emailtext
 */
class EmailtextQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Emailtext[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Emailtext|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
