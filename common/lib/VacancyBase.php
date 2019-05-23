<?php

namespace common\lib;

class VacancyBase extends \common\models\Vacancy
{

    public static function find()
    {
        return new VacancyQueryBase(get_called_class());
    }
    
    
    /**
     *
     * @inheritdoc
     * @return BranchQueryBase the active branches.
     */
    public static function allActiveKeyList($addInitial = true) {
        $query = VacancyBase::findAll (['status' => 1] );
        
        $items = $addInitial ? [ 0 => ''] : [];
        foreach ( $query as $item ) {
            
            $items [$item->id] = $item->title;
        }
        
        return $items;
    }
}
