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
     * @return CandidatefavoriteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CandidatefavoriteQueryBase(get_called_class());
    }
}
