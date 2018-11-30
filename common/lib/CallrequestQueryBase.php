<?php

namespace common\lib;

/**
 * This is the ActiveQuery class for [[Callrequest]].
 *
 * @see Callrequest
 */
class CallrequestQueryBase extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Callrequest[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Callrequest|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
