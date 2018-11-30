<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_uploadedfiles".
 *
 * @property integer $id
 * @property string $file
 * @property integer $status
 * @property string $upload_date
 * @property integer $userid
 */
class Uploadedfiles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_uploadedfiles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file', 'upload_date', 'userid'], 'required'],
            [['status', 'userid'], 'integer'],
            [['upload_date'], 'safe'],
            [['file'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'file' => Yii::t('app', 'File'),
            'status' => Yii::t('app', 'Status'),
            'upload_date' => Yii::t('app', 'Upload Date'),
            'userid' => Yii::t('app', 'Userid'),
        ];
    }

    /**
     * @inheritdoc
     * @return UploadedfilesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UploadedfilesQuery(get_called_class());
    }
}
