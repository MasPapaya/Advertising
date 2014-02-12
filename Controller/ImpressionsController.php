<?php
App::uses('AdvertisingAppController', 'Advertising.Controller');
/**
 * Impressions Controller
 *
 * @property Impression $Impression
 */
class ImpressionsController extends AdvertisingAppController {

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Impression->recursive = 0;
		$this->set('impressions', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Impression->exists($id)) {
			throw new NotFoundException(__d('advertising','Invalid impression'));
		}
		$options = array('conditions' => array('Impression.' . $this->Impression->primaryKey => $id));
		$this->set('impression', $this->Impression->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add(){
		if ($this->request->is('post')){
			$this->Impression->create();
			if ($this->Impression->save($this->request->data)) {
				$this->Session->setFlash(__d('advertising','The impression has been saved'),'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('advertising','The impression could not be saved. Please, try again.'),'flash/error');
			}
		}
		$blocksAdvertisements = $this->Impression->BlocksAdvertisement->find('list');
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
		if (!$this->Impression->exists($id)) {
			throw new NotFoundException(__d('advertising','Invalid impression'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Impression->save($this->request->data)) {
				$this->Session->setFlash(__d('advertising','The impression has been saved'),'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('advertising','The impression could not be saved. Please, try again.'),'flash/error');
			}
		} else {
			$options = array('conditions' => array('Impression.' . $this->Impression->primaryKey => $id));
			$this->request->data = $this->Impression->find('first', $options);
		}
		$blocksAdvertisements = $this->Impression->BlocksAdvertisement->find('list');
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
		$this->Impression->id = $id;
		if (!$this->Impression->exists()) {
			throw new NotFoundException(__d('advertising','Invalid impression'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Impression->delete()) {
			$this->Session->setFlash(__d('advertising','Impression deleted'),'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__d('advertising','Impression was not deleted'),'flash/error');
		$this->redirect(array('action' => 'index'));
	}
}
