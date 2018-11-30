<?php

namespace common\helper;

use Yii;
use common\lib\ContantsBase;
use common\lib\NationalityBase;
use common\lib\CountryBase;
use common\lib\DistanceBase;
use common\lib\CompanytypeBase;
use common\lib\WorktimemodelBase;
use common\lib\JobtypeBase;
use common\lib\VacancyBase;


class BrainStaticList
{
	
	public static function janeinList($notitle = true)
	{
		if($notitle)
		{
			return array('' => '', 1 => Yii::t('app', 'Ja') , 0 => Yii::t('app', 'Nein'));
		}
		else 
		{
			return array(1 => Yii::t('app', 'Ja') , 0 => Yii::t('app', 'Nein'));
		}
		
	}
	
	public static function titleList($notitle = true)
	{
		if($notitle)
		{
			return array('' => '', Yii::t('app', 'Herr') => Yii::t('app', 'Herr') , Yii::t('app', 'Frau') => Yii::t('app', 'Frau'));
		}
		else 
		{
			return array(Yii::t('app', 'Herr') => Yii::t('app', 'Herr') , Yii::t('app', 'Frau') => Yii::t('app', 'Frau'));
		}
		
	}
	
	public static function title2List()
	{
		$titles =  ContantsBase::findAll(['const_type' => 'title2']);
		$titles_array = array('' => '');
		$titles_array = array_merge($titles_array , BrainHelper::mapTranslate($titles, 'value', 'value'));
		
		return $titles_array;
	}
	
	public static function nationalityList($germanfirst = false)
	{
		$nationalities = NationalityBase::findAll(['status' => 1]);
		$item_array = array('' => '');
		$item_array_temp = array_merge($item_array, BrainHelper::mapTranslate($nationalities, 'title', 'title'));
		if($germanfirst)
		{
			unset($item_array_temp['']);
			unset($item_array_temp['deutsch']);
			$item_array = array('' => '' , 'deutsch' => 'deutsch' , );
			$item_array = array_merge($item_array , $item_array_temp);
		}
		else
		{
			$item_array = $item_array_temp;
		}
		
		return $item_array;
	}
	
	public static function countryList($germanfirst = false)
	{
		$countries = CountryBase::findAll(['status' => 1]);
		$item_array = array('' => '');
		$item_array_temp = array_merge($item_array, BrainHelper::mapTranslate($countries, 'title', 'title'));
		
		if($germanfirst)
		{
			unset($item_array_temp['']);
			unset($item_array_temp['Deutschland']);
			$item_array = array('' => '' , 'Deutschland' => 'Deutschland' , );
			$item_array = array_merge($item_array , $item_array_temp);
		}
		else 
		{
			$item_array = $item_array_temp;
		}
		return $item_array;
	}
	
	public static function distanceList()
	{
		$distances =  DistanceBase::findAll(['status' => 1]);
		$item_array = BrainHelper::mapTranslate($distances, 'title', 'title'); 
		$item_array[0] = '';
		ksort($item_array);
		return $item_array;
	}
	
	public static function companyTypeList()
	{
		$companytypes =  CompanytypeBase::findAll(['status' => 1]);
		$item_array = BrainHelper::mapTranslate($companytypes, 'id', 'title');
		$item_array[0] = '';
		ksort($item_array);
		
		return $item_array;
	}
	
	public static function workTypeList($notype = false, $notypetitle = '')
	{
		$worktypes =  WorktimemodelBase::find()->where(['status' => 1])->orderBy(['title' => 'asc'])->all();
		$item_array = BrainHelper::mapTranslate($worktypes, 'id', 'title');
		$item_array[0] = $notypetitle;
		asort($item_array);
		
		return $item_array;
	}
	
	public static function jobTypeList($notype = false, $notypetitle = '')
	{
		$jobypes =  JobtypeBase::findAll(['status' => 1]);
		$item_array = BrainHelper::mapTranslate($jobypes, 'id', 'title');
		if($notype)
		{
			$item_array[0] = $notypetitle;
		}
		ksort($item_array);
		
		return $item_array;
	}
	
	public static function reachabilityList()
	{
		return array(Yii::t('app', 'Telefon') => Yii::t('app', 'Telefon') , Yii::t('app', 'E-Mail') => Yii::t('app', 'E-Mail'));
	}
	
	public static function employeementList()
	{
		return array(1 => Yii::t('app', 'Aktuell beschäftigt') , 0 => Yii::t('app', 'Aktuell nicht beschäftigt'));
	}

	public static function accessableList()
	{
		return array(Yii::t('app', 'Aktuell nicht verfügber') => Yii::t('app', 'Aktuell nicht verfügber') , Yii::t('app', 'Verfügber') => Yii::t('app', 'Verfügber'));
	}

	public static function vacancyList($novacancy = true, $novacancytitle = '')
	{
		$vacancies =  VacancyBase::findAll(['status' => 1]);
		$item_array = BrainHelper::mapTranslate($vacancies, 'id', 'title');
		if($novacancy)
		{
			$item_array[0] = $novacancytitle;
		}
		ksort($item_array);
		
		return $item_array;
	}

	public static function employeeCountList()
	{
		$employeecount_array = array(0 => Yii::t('app', 'nicht eingestellt'), 1 => '1 - 50' , 2 => '51 - 100' , 3 => Yii::t('app', 'Über 100'), );
		
		return $employeecount_array;
	}
	
	
	
}

