<?php

namespace common\lib;

use Yii;

/**
 * This is the model class for table "j2j_emailtext".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $texttype
 * @property integer $status
 */
class EmailtextBase extends \common\models\Emailtext
{
   
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Titel'),
        	'text' => Yii::t('app', 'Inhalt'),
            'texttype' => Yii::t('app', 'Texttype'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

}
