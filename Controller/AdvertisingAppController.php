<?php

App::uses('AppController', 'Controller');

class AdvertisingAppController extends AppController {

	public $helpers = array(
		'Html',
		'Form',
		'Session',
		'Js' => array('Jquery'),
		'Paginator',
		'Text',
		'Advertising.Tools',
	);
	public $components = array(
		'Email',
		'Paginator',
		'RequestHandler',
		'Session',
	);

	public function beforeFilter() {
		parent::beforeFilter();
		if (Configure::read('debug') > 1) {
			$this->Auth->allow();
		}
	}

	public function isAuthorized() {
		return true;
	}

	public function beforeRender() {
		parent::beforeRender();
		if (isset($this->params['prefix']) && $this->params['prefix'] == 'admin') {
			if ($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
			} else {
				$this->layout = 'admin';
			}

			if (isset($this->Auth->loginRedirect)) {
				$this->set('loginredirect', $this->Auth->loginRedirect);
			}
		}
	}

}
