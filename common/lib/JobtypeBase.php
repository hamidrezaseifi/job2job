<?php

namespace common\lib;

use Yii;

/**
 * This is the model class for table "{{%jobtype}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $menutitle
 * @property integer $status
 */
class JobtypeBase extends \common\models\Jobtype
{
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'menutitle' => Yii::t('app', 'Menutitle'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public static function find()
    {
    	return new JobtypeQueryBase(get_called_class());
    }
}
