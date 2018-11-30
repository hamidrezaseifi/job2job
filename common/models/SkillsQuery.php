<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Skills]].
 *
 * @see Skills
 */
class SkillsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Skills[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Skills|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
