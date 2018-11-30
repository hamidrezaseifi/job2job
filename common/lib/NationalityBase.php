<?php

namespace common\lib;

use Yii;

/**
 * This is the model class for table "j2j_nationality".
 *
 * @property string $title
 * @property integer $status
 */
class NationalityBase extends \common\models\Nationality
{

	public static function find()
	{
		return new NationalityQueryBase(get_called_class());
	}
}
