<?php

namespace common\lib;

/**
 * This is the ActiveQuery class for [[Vacancy]].
 *
 * @see Vacancy
 */
class VacancyQueryBase extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return VacancyBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return VacancyBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
