<?php

App::uses('AdvertisingAppController', 'Advertising.Controller');

/**
 * Description of BackAppController
 *
 * @author developer3
 */
abstract class BackAppController extends AdvertisingAppController {

    public $components = array(
	'Resources.ResourcesHandler'
    );

    //put your code here
    public function beforeFilter() {
	parent::beforeFilter();
	if (isset($this->Auth)) {
	    $this->Auth->deny();
	}
    }

    public function isAuthorized() {
	return true;
    }

    public function beforeRender() {
	parent::beforeRender();
	if ($this->RequestHandler->isAjax()) {
	    $this->layout = 'ajax';
	} else {
	    $this->layout = 'admin';
	}
    }

}