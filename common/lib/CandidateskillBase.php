<?php

namespace common\lib;

use Yii;

/**
 * This is the model class for table "{{%candidateskill}}".
 *
 * @property integer $userid
 * @property string $skill
 */
class CandidateskillBase extends \common\models\Candidateskill
{
    
	public static function find()
	{
		return new CandidateskillQueryBase(get_called_class());
	}
}
