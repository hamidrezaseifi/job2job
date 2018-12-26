<?php

namespace common\lib;

/**
 * This is the ActiveQuery class for [[Backlog]].
 *
 * @see Backlog
 */
class BacklogQueryBase extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return BacklogBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BacklogBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
