<?php

App::uses('AdvertisingAppController', 'Advertising.Controller');

/**
 * Blocks Controller
 *
 * @property Block $Block
 */
class BlocksController extends AdvertisingAppController {

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
	}

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this->Block->recursive = 0;
		$this->set('blocks', $this->paginate());
	}

	/**
	 * admin_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		if (!$this->Block->exists($id)) {
			throw new NotFoundException(__d('publicity', 'Invalid block'));
		}
		$options = array('conditions' => array('Block.' . $this->Block->primaryKey => $id));
		$this->set('block', $this->Block->find('first', $options));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Block->create();

//			$this->Block->set($this->request->data);
//			$this->Block->validates();

			if ($this->Block->save($this->request->data)) {
				$this->Session->setFlash(__d('publicity', 'The block has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('publicity', 'The block could not be saved. Please, try again.'), 'flash/error');
			}
		}
		$advertisements = $this->Block->Advertisement->find('list');
		$this->set(compact('advertisements'));
	}

	/**
	 * admin_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		if (!$this->Block->exists($id)) {
			throw new NotFoundException(__d('publicity', 'Invalid block'));
		}
		$this->loadModel('Advertising.Advertisement');
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Block->save($this->request->data)) {
				$this->Session->setFlash(__d('publicity', 'The block has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('publicity', 'The block could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('Block.' . $this->Block->primaryKey => $id));
			$this->request->data = $this->Block->find('first', $options);
		}
		$advertisements = $this->Advertisement->find('list');
		$this->set(compact('advertisements'));
	}

	/**
	 * admin_delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		$this->Block->id = $id;
		if (!$this->Block->exists()) {
			throw new NotFoundException(__d('publicity', 'Invalid block'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Block->delete()) {
			$this->Session->setFlash(__d('publicity', 'Block deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__d('publicity', 'Block was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * permite habilitar un anuncio
	 * 
	 * @param type $id
	 * @throws NotFoundException
	 */
	public function admin_published($id = null) {

		$this->Block->id = $id;
		if (!$this->Block->exists()) {
			throw new NotFoundException(__d('publicity', 'Invalid Block'));
		}
		$this->autoRender = false;
		$Advertisement = $this->Block->read(null, $id);
		if ($Advertisement['Block']['published'] == Configure::read('zero_datetime')) {
			$this->Block->updateAll(array('Block.published' => "'" . date('Y-m-d H:i:s') . "'"), array('Block.id' => $id));
		} else {
			$this->Block->updateAll(array('Block.published' => '"' . Configure::read('zero_datetime') . '"'), array('Block.id' => $id));
		}
		$this->redirect(array('action' => 'index'));
	}

	public function admin_get_code($id = null) {
		$this->Block->id = $id;
		if (!$this->Block->exists()) {
			throw new NotFoundException(__d('publicity', 'Invalid Block'));
		}
//		$block = $this->Block->read(array('Block.id','Block.height','Block.width','Block.orientation','Block.ad_number_visible','Block.multiple'));
		$block = $this->Block->find('first', array(
			'recursive' => -1,
			'fields' => array('Block.id', 'Block.height', 'Block.width', 'Block.orientation', 'Block.ad_number_visible', 'Block.multiple', 'Block.block_type'),
			'conditions' => array(
				'Block.id' => $id
			)
			));

		$this->set(compact('block'));
	}

}
