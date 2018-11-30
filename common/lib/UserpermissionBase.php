<?php

namespace common\lib;

use Yii;

/**
 * This is the model class for table "j2j_userpermission".
 *
 * @property integer $id
 * @property string $title
 * @property integer $status
 *
 * @property Users[] $users
 */
class UserpermissionBase extends \common\models\Userpermission
{


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

}
