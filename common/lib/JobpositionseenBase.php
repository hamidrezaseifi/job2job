<?php

namespace common\lib;

use Yii;


class JobpositionseenBase extends \common\models\Jobpositionseen
{
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'jobpos' => Yii::t('app', 'Jobpos'),
            'ip' => Yii::t('app', 'Ip'),
            'seenuserid' => Yii::t('app', 'Seenuserid'),
            'createdate' => Yii::t('app', 'Createdate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobposition()
    {
        return $this->hasOne(JobpositionBase::className(), ['id' => 'jobpos']);
    }

    /**
     * @inheritdoc
     * @return JobpositionseenQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JobpositionseenQueryBase(get_called_class());
    }
}
