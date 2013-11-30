<?php

/**
 * CakePHP FlashComponent
 * @author developer3
 */
class FlashComponent extends Component {

	public $components = array(
		'Session'
	);
	
	public function initialize(Controller $controller) {
		$controller->helpers[] = 'Advertising.Flash';
	}

	public function startup(Controller $controller) {
		
	}

	public function beforeRender(Controller $controller) {
		
	}

	public function shutDown(Controller $controller) {
		
	}

//	public function beforeRedirect($controller, $url, $status = null, $exit = true) {
//		
//	}
	
	public function set($message,$element = 'default',$params = array(),$key = 'default'){
		
		if(!$this->Session->check('Flash.'.$key)){
			$this->Session->write('Flash.'.$key,array());
		}
		
		$flash_messages = $this->Session->read('Flash.'.$key);
		$flash_messages[] = array(
				'message'	=> $message,
				'element'	=> $element,
				'params'	=> $params
			);
		
		$this->Session->write('Flash.'.$key,$flash_messages);
	}
}