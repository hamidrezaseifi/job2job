<?php

namespace common\lib;

use Yii;

/**
 * This is the model class for table "{{%companytype}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $status
 */
class CompanytypeBase extends \common\models\Companytype
{

	public static function find()
	{
		return new CompanytypeQueryBase(get_called_class());
	} 
}
