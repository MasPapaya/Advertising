<?php
/**
 * Clicks Controller
 *
 * @property Click $Click
 */
class ClicksController extends AdvertisingAppController {

	public $uses = array('Advertising.Click');

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
		$this->Click->recursive = 0;
		$this->set('clicks', $this->paginate());
	}

	/**
	 * admin_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		if (!$this->Click->exists($id)) {
			throw new NotFoundException(__d('publicity', 'Invalid click'));
		}
		$options = array('conditions' => array('Click.' . $this->Click->primaryKey => $id));
		$this->set('click', $this->Click->find('first', $options));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Click->create();
			if ($this->Click->save($this->request->data)) {
				$this->Session->setFlash(__d('publicity', 'The click has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('publicity', 'The click could not be saved. Please, try again.'), 'flash/error');
			}
		}
		$blocksAdvertisements = $this->Click->BlocksAdvertisement->find('list');
		$this->set(compact('blocksAdvertisements'));
	}

	/**
	 * admin_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		if (!$this->Click->exists($id)) {
			throw new NotFoundException(__d('publicity', 'Invalid click'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Click->save($this->request->data)) {
				$this->Session->setFlash(__d('publicity', 'The click has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('publicity', 'The click could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('Click.' . $this->Click->primaryKey => $id));
			$this->request->data = $this->Click->find('first', $options);
		}
		$blocksAdvertisements = $this->Click->BlocksAdvertisement->find('list');
		$this->set(compact('blocksAdvertisements'));
	}

	/**
	 * admin_delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		$this->Click->id = $id;
		if (!$this->Click->exists()) {
			throw new NotFoundException(__d('publicity', 'Invalid click'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Click->delete()) {
			$this->Session->setFlash(__d('publicity', 'Click deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__d('publicity', 'Click was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}

}
