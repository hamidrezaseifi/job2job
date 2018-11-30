<?php

namespace backend\components;


use yii;
use yii\base\Widget;

class BrainNavbar extends Widget
{
	public $items;
	public $navid;
	public $navclass;
	public $navstyle;
	
	public function init() {
		
		parent::init();
		if ($this->items === null) {
			$this->items = array();
		}
		if ($this->navid === null) {
			$this->navid = 'dvbrainnavbar';
		}
		if ($this->navclass === null) {
			$this->navclass = '';
		}
		if ($this->navstyle === null) {
			$this->navstyle = '';
		}
		
	}
	
	public function run() {
		
		return $this->render('nav/index' , ['items'=> $this->items , 'navid' => $this->navid , 
				'navclass' => $this->navclass , 'navstyle' => $this->navstyle ,
		]);
	}

}

