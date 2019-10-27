<?php

namespace common\helper;

use Yii;
use yii\base\Widget;
use common\helper\BrainHelper;


class BrainCheckBoxBoxRenderer extends Widget
{
	public $name;
	public $value;
	public $id_prefix;
	public $name_prefix;
	public $items;
	
	public function init() {
	
		parent::init();
		if ($this->name === null) {
			$this->name = '';
		}
		if ($this->value === null) {
			$this->value = array();
		}
		if ($this->id_prefix === null) {
			$this->id_prefix = '';
		}
		if ($this->items === null) {
			$this->items = array();
		}
		
	
	}
	
	public function run() {
	
		$body = '';
		
		foreach ($this->items as $key => $listvalue)
		{
			$key = trim($key);
			$id = $this->id_prefix . str_replace(' ', '_', $key);
			
			$body .= '		<div class="custom-control custom-checkbox custom-control-inline">';
			$body .= '		<input type="checkbox" class="custom-control-input" id="' . $id . '"  name="' . $this->name . '[' . $key . ']" ' . BrainHelper::getCheckedFromValue($key , $this->value) . ' value="' . $key . '">';
			$body .= '		<label class="custom-control-label" for="' . $id . '">' . $listvalue . '</label>';
			$body .= '		</div>';
		}				  
		
		return $body;
	}

}

