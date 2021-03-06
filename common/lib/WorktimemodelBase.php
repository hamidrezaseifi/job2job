<?php

namespace common\lib;

use Yii;

/**
 * This is the model class for table "j2j_worktimemodel".
 *
 * @property integer $id
 * @property string $title
 * @property integer $status
 */
class WorktimemodelBase extends \common\models\Worktimemodel
{
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return WorktimemodelQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WorktimemodelQueryBase(get_called_class());
    }
}
