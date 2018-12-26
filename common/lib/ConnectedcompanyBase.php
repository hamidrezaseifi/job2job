<?php

namespace common\lib;

use Yii;

/**
 * This is the model class for table "j2j_connectedcompany".
 *
 * @property integer $id
 * @property integer $companyid
 * @property string $name
 * @property integer $status
 *
 * @property Company $company
 */
class ConnectedcompanyBase extends \common\models\Connectedcompany
{
    

	/**
	 * @inheritdoc
	 * @return ConnectedcompanyQueryBase the active query used by this AR class.
	 */
	public static function find()
	{
		return new ConnectedcompanyQueryBase(get_called_class());
	}
}
