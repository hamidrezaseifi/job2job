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
    public static function allActiveKeyList() {
        $query = VacancyBase::findAll (['status' => 1] );
        
        $items = array ();
        foreach ( $query as $item ) {
            
            $items [$item->id] = $item->title;
        }
        
        return $items;
    }
}
