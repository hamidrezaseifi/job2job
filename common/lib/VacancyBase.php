<?php

namespace common\lib;

class VacancyBase extends \common\models\Vacancy
{

    public static function find()
    {
        return new VacancyQueryBase(get_called_class());
    }
}
