<?php

namespace common\lib;

/**
 * This is the ActiveQuery class for [[Candidateskill]].
 *
 * @see Candidateskill
 */
class CandidateskillQueryBase extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Candidateskill[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Candidateskill|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
