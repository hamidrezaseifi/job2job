<?php

namespace common\lib;

use Yii;

/**
 * This is the model class for table "j2j_callrequest".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $tel
 * @property string $name
 * @property string $message
 * @property integer $status
 * @property string $createdate
 */
class CallrequestBase extends \common\models\Callrequest
{
   
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'userid' => Yii::t('app', 'Userid'),
            'tel' => Yii::t('app', 'Tel'),
            'name' => Yii::t('app', 'Name'),
            'message' => Yii::t('app', 'Message'),
            'status' => Yii::t('app', 'Status'),
            'createdate' => Yii::t('app', 'Createdate'),
        ];
    }

    /**
     * @inheritdoc
     * @return CallrequestQueryBase the active query used by this AR class.
     */
    public static function find()
    {
        return new CallrequestQueryBase(get_called_class());
    }
}
