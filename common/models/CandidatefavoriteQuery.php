<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Candidatefavorite]].
 *
 * @see Candidatefavorite
 */
class CandidatefavoriteQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Candidatefavorite[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Candidatefavorite|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
