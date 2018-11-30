<?php

namespace common\models;

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
class Languages extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'j2j_languages';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
				[['id', 'title', 'baseurl'], 'required'],
				[['index', 'status'], 'integer'],
				[['createdate', 'updatedate'], 'safe'],
				[['id', 'title', 'baseurl'], 'string', 'max' => 45],
				[['photourl'], 'string', 'max' => 200],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
				'id' => Yii::t('app', 'ID'),
				'index' => Yii::t('app', 'Index'),
				'title' => Yii::t('app', 'Title'),
				'photourl' => Yii::t('app', 'Photourl'),
				'baseurl' => Yii::t('app', 'Baseurl'),
				'status' => Yii::t('app', 'Status'),
				'createdate' => Yii::t('app', 'Createdate'),
				'updatedate' => Yii::t('app', 'Updatedate'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getNavigations()
	{
		return $this->hasMany(Navigation::className(), ['language' => 'id']);
	}

	/**
	 * @inheritdoc
	 * @return LanguagesQuery the active query used by this AR class.
	 */
	public static function find()
	{
		return new LanguagesQuery(get_called_class());
	}
}
