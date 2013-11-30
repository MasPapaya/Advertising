<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP FlashHelper
 * @author developer3
 */
class FlashHelper extends AppHelper {

	public $helpers = array('Session');

	public function __construct(View $View, $settings = array()) {
		parent::__construct($View, $settings);
	}

	public function beforeRender($viewFile) {
		
	}

	public function afterRender($viewFile) {
		
	}

	public function beforeLayout($viewLayout) {
		
	}

	public function afterLayout($viewLayout) {
		
	}
	
	public function Messages($key = 'default',$attrs = array()){
		$out = false;
		if($this->Session->check('Flash.'.$key)){
			$flash_messages = $this->Session->read('Flash.'.$key);
			CakeSession::delete('Flash.'.$key);
			foreach ($flash_messages as $flash){
				if (!empty($attrs)) {
					$flash = array_merge($flash, $attrs);
				} 
				$out .= $this->GetMessages($key, $flash);
			}
		}
		return $out;
	}
	
	private function GetMessages($key,$flash){
		$out = false;
		if ($flash['element'] === 'default'){
			$class = 'message';
			if (!empty($flash['params']['class'])){
				$class = $flash['params']['class'];
			}
			$out = '<div id="' . $key . 'Message" class="' . $class . '">' . $flash['message'] . '</div>';
		} elseif (!$flash['element']){
			$out = $flash['message'];
		} else {
			$options = array();
			if (isset($flash['params']['plugin'])){
				$options['plugin'] = $flash['params']['plugin'];
			}
			$tmpVars = $flash['params'];
			$tmpVars['message'] = $flash['message'];
			$out = $this->_View->element($flash['element'], $tmpVars, $options);
		}
		return $out;
	}

}
