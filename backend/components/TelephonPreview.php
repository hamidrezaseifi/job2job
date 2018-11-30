<?php

namespace backend\components;


use yii;
use yii\base\Widget;

class TelephonPreview extends Widget
{
	public $telephone;
	public $name;
	public $id;
	public $class;
	public $label;
	private $telephonParts = array();
	
	public function init() {
		
		parent::init();
		
		if ($this->telephone === null) {
			$this->telephone = '--';
		}
		if ($this->name === null) {
			$this->name = false;
		}
		if ($this->id === null) {
			$this->id = false;
		}
		if ($this->class === null) {
			$this->class = false;
		}
		if ($this->label === null) {
			$this->label = false;
		}
		
		$this->telephonParts = explode('-', $this->telephone);
		
		
	}
	
	public function run() {
		
		return $this->render('tel/index' , 
				[
					'telephonParts'	=> $this->telephonParts , 
					'name' 			=> $this->name , 
					'id' 			=> $this->id,
					'class' 		=> $this->class,
					'label' 		=> $this->label,
				]
		);
	}

}

