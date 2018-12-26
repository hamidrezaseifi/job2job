<?php

namespace common\lib;

use Yii;

/**
 * This is the model class for table "j2j_frontlog".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $logdesc
 * @property integer $iscandidate
 * @property string $logdate
 *
 * @property Users $user
 */
class FrontlogBase extends \common\models\Frontlog
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'userid' => Yii::t('app', 'Userid'),
            'logdesc' => Yii::t('app', 'Logdesc'),
            'iscandidate' => Yii::t('app', 'Iscandidate'),
            'logdate' => Yii::t('app', 'Logdate'),
        ];
    }


    /**
     * @inheritdoc
     * @return FrontlogQueryBase the active query used by this AR class.
     */
    public static function find()
    {
        return new FrontlogQueryBase(get_called_class());
    }
    
    public static function addLog($log, $user, $iscandidate)
    {
    	$model = new FrontlogBase();
    	$model->logdesc = $log;
    	$model->logdate = date('Y-m-d H:i:s');
    	$model->userid = $user;
    	$model->iscandidate = $iscandidate;
    	$model->save(false);
    	 
    }
}
