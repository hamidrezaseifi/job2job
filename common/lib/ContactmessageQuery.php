<?php

namespace common\lib;

/**
 * This is the ActiveQuery class for [[Contactmessage]].
 *
 * @see Contactmessage
 */
class ContactmessageQueryBase extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ContactmessageBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ContactmessageBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
