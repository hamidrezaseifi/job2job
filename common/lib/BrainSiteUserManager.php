<?php

namespace common\lib;

use Yii;

class BrainSiteUserManager
{

	public static function getGroupID()
	{
		return Yii::$app->user->identity->group0->id;
	}

	public static function getGroupTitle()
	{
		return Yii::$app->user->identity->group0->title;
	}
	
	public static function getPermission()
	{
		return Yii::$app->user->identity->permission;
	}
	
	public static function getAllowedNavigationList()
	{
		$list = array();
		
		if(Yii::$app->user->identity->permission != 1)
		{
			$data_list = UserGroupNavgationBase::find()->select(['navigationid'])->where(['and',['groupid'=>Yii::$app->user->identity->group0->id],['or','readright=1','editright=1','deleteright=1','printright=1']])->all();
			foreach($data_list as $data)
				$list[] = $data->navigationid;
		}
		else 
		{
			$data_list = NavigationBase::find()->select(['id'])->where(['status' => 1])->all();
			foreach($data_list as $data)
				$list[] = $data->id;
		}

		return $list;
		
	}

	
}