<?php

namespace common\lib;

use Yii;

/**
 * This is the model class for table "{{%skills}}".
 *
 * @property integer $id
 * @property integer $parentid
 * @property string $title
 * @property integer $status
 *
 * @property Applicationskill[] $applicationskills
 * @property Application[] $applications
 * @property Jobpositionskill[] $jobpositionskills
 * @property Jobposition[] $jobs
 */
class SkillsBase extends \common\models\Skills
{
    const StatusDeactive = 0;
    const StatusActive = 1;
    const StatusNotApproved = 2;
    
    

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parentid' => Yii::t('app', 'Parent Skill'),
            'title' => Yii::t('app', 'Title'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public static function allTree($parentid = 0 , $checkStatus = false)
    {
		$list = array();  
		if($checkStatus)
		{
    		$modelList = SkillsBase::find()->where(['parentid' => $parentid , 'status' => 1])->all();
		}
		else 
		{
			$modelList = SkillsBase::find()->where(['parentid' => $parentid])->all();
		}
    	if($modelList)
    	{
    		foreach ($modelList as $model)
    		{
    			$item = array('title' => $model->title , 'id' => $model->id , 'patent' => $model->parentid , );
    			
    			$item['childs'] = SkillsBase::allTree($model->id);
    			
    			$list[] = $item;
    		}
    	}
    	return $list;
    }
    
    public static function skillParentPath($id)
    {
    	$model = SkillsBase::findOne(['id' => $id]);
    	if(!$model)
    		return '';
    	$parentpath = SkillsBase::skillParentPath($model->parentid) . '/' . $model->title;
    	return $parentpath;
    }
    
    public static function statusTitle($status)
    {
    	switch ($status)
    	{
    		case self::StatusActive : return Yii::t('app', 'Active');
    		case self::StatusDeactive : return Yii::t('app', 'Deactive');
    		case self::StatusNotApproved : return Yii::t('app', 'Not Approved');
    	}
    	
    	return Yii::t('app', 'Unknwon!');
    	
    }
    
    public static function listChilds($id)
    {
        $list = array();
        $listData = SkillsBase::find()->select(['id'])->where(['parentid' => $id])->all();
        foreach($listData as $data)
        {
            $list[$data->id] = $data->id;
            $listSubData = SkillsBase::listChilds($data->id);
            foreach($listSubData as $subdata)
            {
                $list[$subdata] = $subdata;
            }
        }
        
        return $list;
    }
    
    public static function allChilds($id)
    {
        $list = array();
        $listData = SkillsBase::find()->select(['id', 'title'])->where(['parentid' => $id])->all();
        foreach($listData as $data)
        {
            $list[$data->id] = $data->title;
        }
        
        return $list;
    }
    
}
