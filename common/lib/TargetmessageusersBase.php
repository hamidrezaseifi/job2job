<?php

namespace common\lib;

use Yii;

/**
 * This is the model class for table "j2j_targetmessageusers".
 *
 * @property integer $userid
 * @property integer $status
 *
 * @property Users $user
 */
class TargetmessageusersBase extends \common\models\Targetmessageusers
{
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userid' => 'Userid',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UsersBase::className(), ['id' => 'userid']);
    }

    
}
