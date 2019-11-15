<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Contactmessage]].
 *
 * @see Contactmessage
 */
class ContactmessageQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Contactmessage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Contactmessage|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
