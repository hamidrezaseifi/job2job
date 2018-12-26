<?php

namespace common\lib;

/**
 * This is the ActiveQuery class for [[Candidatefavorite]].
 *
 * @see Candidatefavorite
 */
class CandidatefavoriteQueryBase extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CandidatefavoriteBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CandidatefavoriteBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
