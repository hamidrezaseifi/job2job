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
		
	
	}
	
	public function run() {
	
		$body = '';
		
		$body .= '	<ul class="radiostyle">';
				
		foreach ($this->items as $key => $listvalue)
		{
			$id = $this->id_prefix . str_replace(' ', '_', $key);
		$body .= '		<li>';
		$body .= '			<input class="radiostyle" type="radio" id="' . $id . '" name="' . $this->name . '" ' . BrainHelper::getCheckedFromValue($key , $this->value) . ' value="' . $key . '">';
		$body .= '			<label for="' . $id . '">' . $listvalue . '</label>';
		$body .= '			<span class="check"><span class="inside"></span></span>';
		$body .= '		</li>';
		}				  
						  
		$body .= '	</ul>';
				
		return $body;
	}

}

