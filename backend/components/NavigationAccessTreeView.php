<?php

namespace backend\components;


use yii;
use yii\base\Widget;
use common\lib\SkillsSearchBase;
use common\lib\NavigationBase;
use common\lib\UsergroupnavgationBase;

class NavigationAccessTreeView extends Widget
{
	public $viewid;
	public $viewclass;
	public $viewstyle;
	public $columns;
	public $allow_edit;
	public $groupid;
	
	public function init() {
		
		parent::init();
		if ($this->viewid === null) {
			$this->viewid = 'dvbrainskilltree';
		}
		if ($this->viewclass === null) {
			$this->viewclass = '';
		}
		if ($this->viewstyle === null) {
			$this->viewstyle = '';
		}
		
		if ($this->allow_edit === null) {
			$this->allow_edit = false;
		}
		
		
	}
	
	public function run() {
		
		
		$this->columns = array(); //NavigationBase
		$this->columns[] = array('label'=> \Yii::t('app', 'Navigation') , 'attribute' =>array());
		$this->columns[] = array('label'=> \Yii::t('app', 'Language') , 'attribute' =>array(
			'class' => 'tree_nav_access'
		));
		$this->columns[] = array('label'=> \Yii::t('app', 'Read') , 'attribute' =>array(
				'class' => 'tree_nav_access'
		));
		$this->columns[] = array('label'=> \Yii::t('app', 'Edit') , 'attribute' =>array(
				'class' => 'tree_nav_access'
		));
		$this->columns[] = array('label'=> \Yii::t('app', 'Delete') , 'attribute' =>array(
				'class' => 'tree_nav_access'
		));
		$this->columns[] = array('label'=> \Yii::t('app', 'Print') , 'attribute' =>array(
				'class' => 'tree_nav_access'
		));
		
		
		$viewidattr = '';
		if($this->viewid != '')
		{
			$viewidattr = ' id="' . $this->viewid . '_wrapper" ';
		}
		
		$viewclassattr = '';
		if($this->viewclass != '')
			$viewclassattr = ' class="' . $this->viewclass . '" ';
		
		$viewstyleattr = '';
		if($this->viewstyle != '')
			$viewstyleattr = ' style="' . $this->viewstyle . '" ';
		
		$body = '<table ' . $viewidattr . $viewclassattr  . $viewstyleattr . '>';
				
		$body .= $this->render('navaccesstree/header' , ['columns' => $this->columns ,]);
		
		$body .= '<tbody>';
		$body .= $this->renderParent(0 , 0);
		
		
		$body .= '</tbody>';
		$body .= '</table>';
		
		return $body;
	}
	
	private function renderParent($parentid , $level)
	{
		$dataProvider = NavigationBase::find()->where(['parentid' => $parentid])->all();
		$body = '';
		
		foreach ($dataProvider as $model)
		{
			$accessModel = UsergroupnavgationBase::findOne(['groupid' => $this->groupid , 'navigationid' => $model->id]);
			$body .= $this->render('navaccesstree/body' , [ 'model' => $model , 'level' => $level ,
			'allow_edit' => $this->allow_edit , 'accessModel' => $accessModel ]);
			$body .= $this->renderParent($model->id , $level + 1);
		}
		
		return $body;
	}

}

