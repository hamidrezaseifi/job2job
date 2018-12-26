<?php

namespace common\lib;

use Yii;

/**
 * This is the model class for table "j2j_distance".
 *
 * @property string $title
 * @property integer $status
 */
class DistanceBase extends \common\models\Distance
{
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => Yii::t('app', 'Title'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return DistanceQueryBase the active query used by this AR class.
     */
    public static function find()
    {
        return new DistanceQueryBase(get_called_class());
    }
}
