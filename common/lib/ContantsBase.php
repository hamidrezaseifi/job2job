<?php

namespace common\lib;

use Yii;

/**
 * This is the model class for table "{{%contants}}".
 *
 * @property integer $id
 * @property string $value
 * @property string $language
 * @property string $const_type
 */
class ContantsBase extends \common\models\Contants
{
    

    /**
     * @inheritdoc
     * @return ContantsQueryBase the active query used by this AR class.
     */
    public static function find()
    {
        return new ContantsQueryBase(get_called_class());
    }
}
