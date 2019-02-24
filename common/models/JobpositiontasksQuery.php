<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Jobpositiontasks]].
 *
 * @see Jobpositiontasks
 */
class JobpositiontasksQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Jobpositiontasks[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Jobpositiontasks|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
