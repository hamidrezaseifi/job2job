<?php

namespace common\helper;

use Yii;
use yii\base\Widget;
use common\helper\BrainHelper;


class BrainRadioBoxRenderer extends Widget
{
	public $name;
	public $value;
	public $id_prefix;
	public $items;
	public $input_attributes;
	
	public function init() {
	
		parent::init();
		if ($this->name === null) {
			$this->name = '';
		}
		if ($this->value === null) {
			$this->value = '';
		}
		if ($this->id_prefix === null) {
			$this->id_prefix = '';
		}
		if ($this->items === null) {
		    $this->items = array();
		}
		if ($this->input_attributes === null) {
		    $this->input_attributes = array();
		}
		
	
	}
	
	public function run() {
	
		$body = '';
		
		$attr = '';
		foreach ($this->input_attributes as $ia_key => $ia_value){
		    $attr .= ' ' . $ia_key . '="' . $ia_value . '" ';
		}
		
		foreach ($this->items as $key => $listvalue)
		{
		    $id = $this->id_prefix . str_replace(' ', '_', $key);
		    $body .= '		<div class="custom-control custom-radio custom-control-inline">';
		    $body .= '		<input type="radio" id="' . $id . '" name="' . $this->name . '" ' . $attr . ' class="custom-control-input" ' . BrainHelper::getCheckedFromValue($key , $this->value) . ' value="' . $key . '">';
		    $body .= '		<label class="custom-control-label" for="' . $id . '">' . $listvalue . '</label>';
            $body .= '		</div>';

		}				  
						 
				
		return $body;
	}

}

