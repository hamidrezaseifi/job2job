<?php

namespace common\lib;

use Yii;

/**
 * This is the model class for table "j2j_backlog".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $logdesc
 * @property string $logdate
 *
 * @property Users $user
 */
class BacklogBase extends \common\models\Backlog
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
            'logdate' => Yii::t('app', 'Logdate'),
        ];
    }
	

    /**
     * @inheritdoc
     * @return BacklogQueryBase the active query used by this AR class.
     */
    public static function find()
    {
        return new BacklogQueryBase(get_called_class());
    }
    
    public static function addLog($log, $user)
    {
    	$model = new BacklogBase();
    	$model->logdesc = $log;
    	$model->logdate = date('Y-m-d H:i:s');
    	$model->userid = $user;
    	$model->save(false);
    }
}
