<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Candidatejobapply]].
 *
 * @see Candidatejobapply
 */
class CandidatejobapplyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Candidatejobapply[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Candidatejobapply|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
