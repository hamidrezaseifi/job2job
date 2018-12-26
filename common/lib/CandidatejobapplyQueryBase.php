<?php

namespace common\lib;

/**
 * This is the ActiveQuery class for [[Candidatejobapply]].
 *
 * @see Candidatejobapply
 */
class CandidatejobapplyQueryBase extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CandidatejobapplyBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CandidatejobapplyBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
