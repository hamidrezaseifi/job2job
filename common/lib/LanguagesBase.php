<?php

namespace common\lib;

use Yii;

/**
 * This is the model class for table "j2j_languages".
 *
 * @property string $id
 * @property integer $index
 * @property string $title
 * @property string $photourl
 * @property string $baseurl
 * @property integer $status
 * @property string $createdate
 * @property string $updatedate
 *
 * @property Navigation[] $navigations
 */
class LanguagesBase extends \common\models\Languages
{
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'index' => Yii::t('app', 'Index'),
        	'title' => Yii::t('app', 'Title'),
            'photourl' => Yii::t('app', 'Photo Url'),
            'baseurl' => Yii::t('app', 'Base Url'),
        	'status' => Yii::t('app', 'Status'),
            'createdate' => Yii::t('app', 'Createdate'),
            'updatedate' => Yii::t('app', 'Updatedate'),
        ];
    }

}
