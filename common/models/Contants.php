<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%contants}}".
 *
 * @property integer $id
 * @property string $value
 * @property string $language
 * @property string $const_type
 */
class Contants extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contants}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value', 'language', 'const_type'], 'required'],
            [['value'], 'string', 'max' => 100],
            [['language'], 'string', 'max' => 55],
            [['const_type'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'value' => Yii::t('app', 'Value'),
            'language' => Yii::t('app', 'Language'),
            'const_type' => Yii::t('app', 'Const Type'),
        ];
    }

    /**
     * @inheritdoc
     * @return ContantsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContantsQuery(get_called_class());
    }
}
