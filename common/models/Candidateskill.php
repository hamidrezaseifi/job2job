<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j2j_candidateskill".
 *
 * @property integer $candidateid
 * @property string $skill
 * @property string $created
 */
class Candidateskill extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j2j_candidateskill';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['candidateid', 'skill', 'created'], 'required'],
            [['candidateid'], 'integer'],
            [['created'], 'safe'],
            [['skill'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'candidateid' => Yii::t('app', 'Candidateid'),
            'skill' => Yii::t('app', 'Skill'),
            'created' => Yii::t('app', 'Created'),
        ];
    }

    /**
     * @inheritdoc
     * @return CandidateskillQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CandidateskillQuery(get_called_class());
    }
}
