<?php

namespace backend\components;


use yii;
use yii\base\Widget;
use common\lib\SkillsSearchBase;

class SkillsTreeView extends Widget
{
	public $viewid;
	public $viewclass;
	public $viewstyle;
	public $columns;
	
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
		
		
	}
	
	public function run() {
		
		$searchModel = new SkillsSearchBase();
		
		$this->columns = array();
		$this->columns[] = array('label'=>$searchModel->attributeLabels()['title'] , 'attribute' =>array());
		
		
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
				
		$body .= $this->render('skilltree/header' , ['columns' => $this->columns ,]);
		
		$body .= '<tbody>';
		$body .= $this->renderParent(0 , 0 , false);
		
		
		$body .= '</tbody>';
		$body .= '</table>';
		
		return $body;
	}
	
	private function renderParent($parentid , $level , $disabled)
	{
		$dataProvider = SkillsSearchBase::find()->where(['parentid' => $parentid])->all();
		$body = '';
		
		foreach ($dataProvider as $model)
		{
			$tools = array();
				
			if($level == 0)
			{
				$tools[] = 'addchild';
			}
			
			if($parentid > 0)
			{
				$tools[] = 'edit';
				$tools[] = 'delete';
			}
				
			$disabledrender = $disabled | $model->status == 0;
			$body .= $this->render('skilltree/body' , [ 'model' => $model , 'level' => $level ,
			'disabled' => $disabledrender , 'tools' => $tools ]);
			$body .= $this->renderParent($model->id , $level + 1 , $disabledrender);
		}
		
		return $body;
	}

}

