<?php

namespace common\lib;

use Yii;

class UsergroupBase extends \common\models\Usergroup
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
            'createdate' => Yii::t('app', 'Create'),
            'updatedate' => Yii::t('app', 'Last Update'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
    	return [
    			[['title', 'updatedate'], 'required'],
    			[['status'], 'integer'],
    			//[['createdate', 'updatedate'], 'safe'],
    			[['title'], 'string', 'max' => 45],
    	];
    }

    public function load($data, $formName = null)
    {
    	 
    	$res = parent::load($data, $formName);
    	if(count($data))
    		$this->updatedate = date("Y-m-d H:i:s");
    	return $res;
    }

    public static function statusTitle($status)
    {
    	switch ($status)
    	{
    		case 1 : return \Yii::t('app', 'Active');
    		case 2 : return \Yii::t('app', 'Deactive');
    		case 3 : return \Yii::t('app', 'Deleted');
    		//case 1 : return \Yii::t('app', 'active');
    	}
    	return '';
    }
    
}
