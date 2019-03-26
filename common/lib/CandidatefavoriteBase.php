<?php

namespace common\lib;

use Yii;

/**
 * This is the model class for table "j2j_candidatefavorite".
 *
 * @property integer $userid
 * @property integer $jobposid
 * @property string $createdate
 *
 * @property Jobposition $jobpos
 * @property Users $user
 */
class CandidatefavoriteBase extends \common\models\Candidatefavorite
{
    /**
     * @inheritdoc
     * @return CandidatefavoriteQueryBase the active query used by this AR class.
     */
    public static function find()
    {
        return new CandidatefavoriteQueryBase(get_called_class());
    }
    
    public static function isFavorite ($userid, $jobid)
    {
        $model = CandidatefavoriteBase::findOne(['userid' => $userid, 'jobposid' => $jobid]);
        
        return $model && isset($model->createdate);
    }
    
    public static function listAlljobfav($userid)
    {
        
        $allfav = CandidatefavoriteBase::findAll(['userid' => $userid]);
        $list = [];
        foreach($allfav as $fav){
            $list[] = $fav->jobposid;
        }
        
        return $list;
    }
}
