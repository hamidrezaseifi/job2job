<?php

namespace common\lib;

use Yii;

/**
 * This is the model class for table "j2j_backmessage".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $title
 * @property string $message
 * @property integer $status
 */
class BackMessageBase extends \common\models\BackMessage
{
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'userid' => Yii::t('app', 'Userid'),
            'title' => Yii::t('app', 'Title'),
            'message' => Yii::t('app', 'Message'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

}
