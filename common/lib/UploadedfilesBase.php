<?php

namespace common\lib;

use Yii;
use common\models\UploadedfilesQuery;


class UploadedfilesBase extends \common\models\Uploadedfiles
{


    /**
     * @inheritdoc
     * @return UploadedfilesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UploadedfilesQuery(get_called_class());
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
    	return $this->hasOne(UsersBase::className(), ['id' => 'userid'])->one();
    }
    
}
