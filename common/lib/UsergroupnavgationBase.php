<?php

namespace common\lib;

use Yii;

/**
 * This is the model class for table "j2j_usergroupnavgation".
 *
 * @property integer $groupid
 * @property integer $navigationid
 * @property integer $readright
 * @property integer $editright
 * @property integer $deleteright
 * @property integer $printright
 * @property integer $status
 * @property string $createdate
 *
 * @property Usergroup $group
 * @property Navigation $navigation
 */
class UsergroupnavgationBase extends \common\models\UserGroupNavgation
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'groupid' => Yii::t('app', 'Groupid'),
            'navigationid' => Yii::t('app', 'Navigationid'),
            'readright' => Yii::t('app', 'Readright'),
            'editright' => Yii::t('app', 'Editright'),
            'deleteright' => Yii::t('app', 'Deleteright'),
            'printright' => Yii::t('app', 'Printright'),
            'status' => Yii::t('app', 'Status'),
            'createdate' => Yii::t('app', 'Createdate'),
        ];
    }

}
