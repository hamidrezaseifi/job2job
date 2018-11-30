<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Connectedcompany]].
 *
 * @see Connectedcompany
 */
class ConnectedcompanyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Connectedcompany[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Connectedcompany|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
