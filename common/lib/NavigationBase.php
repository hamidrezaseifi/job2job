<?php

namespace common\lib;

use Yii;

/**
 * This is the model class for table "j2j_navigation".
 *
 * @property integer $id
 * @property integer $parentid
 * @property string $app
 * @property string $language
 * @property string $title
 * @property string $url
 * @property string $image
 * @property integer $position
 * @property string $createdate
 * @property string $updatedate
 * @property integer $status
 *
 * @property Languages $language0
 * @property Usergroupnavgation[] $usergroupnavgations
 * @property Usergroup[] $groups
 */
class NavigationBase extends \common\models\Navigation
{
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parentid' => Yii::t('app', 'Parentid'),
            'app' => Yii::t('app', 'App'),
            'language' => Yii::t('app', 'Language'),
            'title' => Yii::t('app', 'Title'),
            'url' => Yii::t('app', 'Url'),
            'image' => Yii::t('app', 'Image'),
            'position' => Yii::t('app', 'Position'),
            'createdate' => Yii::t('app', 'Createdate'),
            'updatedate' => Yii::t('app', 'Updatedate'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public static function listNavigation($language , $app , $parentid = 0 , $allowed_group = false)
    {
    	//print_r($allowed_group);
    	
    	$list = array();
    	$modelList = NavigationBase::find()->where(['parentid' => $parentid , 'status' => 1 , 'language' => $language , 'app' => $app , 'id' => $allowed_group])->orderBy(['position' => SORT_ASC])->all();

    	if($modelList)
    	{
    		foreach ($modelList as $model)
    		{
    		//	if($allowed_group && is_array($allowed_group) && !in_array($model->id, $allowed_group))
    		//		continue;
    			
    			$item = array('label' => $model->title , 'id' => $model->id , 'url' => $model->url , 
    					'image' => $model->image , 'id' => $model->id , 'parent' => $model->parentid ,
    			'onclick' => $model->onclick ,);
    			 
    			$item['childs'] = NavigationBase::listNavigation($language , $app , $model->id , $allowed_group);
    			 
    			$list[] = $item;
    		}
    	}
    	return $list;
    	 
    }

    public static function listFrontNavigation($language , $parentid = 0 , $allowed_group = false)
    {
    	//print_r($allowed_group);
    	 
    	$list = array();
    	$modelList = NavigationBase::find()->where(['parentid' => $parentid , 'status' => 1 , 'language' => $language , 'app' => 'frontend' , /* 'id' => $allowed_group */])->orderBy(['position' => SORT_ASC])->all();
    
    	if($modelList)
    	{
    		foreach ($modelList as $model)
    		{
    			//	if($allowed_group && is_array($allowed_group) && !in_array($model->id, $allowed_group))
    			//		continue;
    			$id = 'dv' . strtolower(trim(str_replace(' ', '_', $model->title)));
    
    			$item = array('label' => $model->title , 'divid' => $id , 'id' => $model->id , 'url' => $model->url ,
    					'image' => $model->image , 'id' => $model->id , 'parent' => $model->parentid ,
    			'onclick' => $model->onclick ,);
    
    			$item['childs'] = NavigationBase::listFrontNavigation($language , $model->id , $allowed_group);
    
    			$list[] = $item;
    		}
    	}
    	return $list;
    
    }
    
    public static function listFrontRightNavigation($language , $parentid = 0)
    {
    	//print_r($allowed_group);
    	 
    	$list = array();
    	$modelList = NavigationBase::find()->where(['parentid' => $parentid , 'status' => 1 , 'language' => $language , 'app' => 'frontright' , /* 'id' => $allowed_group */])->orderBy(['position' => SORT_ASC])->all();
    
    	if($modelList)
    	{
    		foreach ($modelList as $model)
    		{
    			//	if($allowed_group && is_array($allowed_group) && !in_array($model->id, $allowed_group))
    			//		continue;
    			$id = 'dv' . strtolower(trim(str_replace(' ', '_', $model->title)));
    
    			$item = array('label' => $model->title , 'divid' => $id , 'id' => $model->id , 'url' => $model->url ,
    					'image' => $model->image , 'id' => $model->id , 'parent' => $model->parentid ,
    			'onclick' => $model->onclick , );
    
    			$item['childs'] = NavigationBase::listFrontRightNavigation($language , $model->id);
    
    			$list[] = $item;
    		}
    	}
    	return $list;
    
    }
    
    public static function allID()
    {
    	$list = array();
    	$modelList = NavigationBase::find()->orderBy(['id' => SORT_ASC])->all();
    
    	if($modelList)
    	{
    		foreach ($modelList as $model)
    		{   
    			$list[] = $model->id;
    		}
    	}
    	return $list;
    
    }

}
