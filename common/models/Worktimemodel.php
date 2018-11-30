<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_worktimemodel".
 *
 * @property integer $id
 * @property string $title
 * @property integer $status
 */
class Worktimemodel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_worktimemodel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status'], 'integer'],
            [['title'], 'string', 'max' => 50],
        ];
    }

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
        return new WorktimemodelQuery(get_called_class());
    }
}
