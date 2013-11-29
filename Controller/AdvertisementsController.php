<?php

App::uses('AdvertisingAppController', 'Advertising.Controller');

/**
 * Advertisements Controller
 *
 * @property Advertisement $Advertisement
 */
class AdvertisementsController extends AdvertisingAppController {

	/**
	 * cargamos componentes
	 * @var type
	 */
	public $components = array();

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
		if (CakePlugin::loaded('Resources')) {
			Cache::write('Resources_configurations', array(
				'Entity' => array(
					'alias' => 'advertising',
					'folder' => 'advertising'
				),
			));
		}
	}

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
//		$this->paginate = array();
		$this->Advertisement->recursive = 0;

		if ($this->authuser['Group']['name'] == 'superadmin' || $this->authuser['Group']['name'] == 'admin') {
			$this->paginate();
		} else {
			$this->paginate = array(
				'conditions' => array('Advertisement.user_id ' => $this->authuser['id']),
			);
		}


		$this->set('advertisements', $this->paginate());
		if (CakePlugin::loaded('Resources')) {
			$this->helpers[] = 'Resources.Frame';
		}
	}

	/**
	 * admin_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		if (!$this->Advertisement->exists($id)) {
			throw new NotFoundException(__d('publicity', 'Invalid advertisement'));
		}
		$options = array('conditions' => array('Advertisement.' . $this->Advertisement->primaryKey => $id));
		$this->set('advertisement', $this->Advertisement->find('first', $options));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Advertisement->create();
			if (empty($this->request->data['Advertisement']['user_id'])) {
				if($this->authuser['Group']['name'] == 'blogger' ){
					$this->request->data['Advertisement']['user_id']=$this->authuser['id'];
				}
			}
			if ($this->save_advertisement_blocks($this->request->data)) {
				$this->redirect(array('action' => 'index'));
			}
		}
		$this->loadModel('Language');
		$this->loadModel('User');
		$languages = $this->Language->find('list');
		$users = $this->User->find('list', array(
			'fields' => array('User.id', 'User.username'),
			'conditions' => array(
				'User.banned' => Configure::read('zero_datetime'),
				'User.deleted' => Configure::read('zero_datetime'),
			)
			));
		$blocks = $this->Advertisement->Block->find('list');
		$this->set(compact('blocks', 'users', 'languages'));

		if ($this->authuser['Group']['name'] == 'superadmin' || $this->authuser['Group']['name'] == 'admin') {
			$this->set('user_enable', true);
		} else {
			$this->set('user_enable', false);
		}
	}

	/**
	 * admin_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		if (!$this->Advertisement->exists($id)) {
			throw new NotFoundException(__d('publicity', 'Invalid advertisement'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {

			if ($this->save_advertisement_blocks($this->request->data)) {
				$this->redirect(array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Advertisement.' . $this->Advertisement->primaryKey => $id));
			$this->request->data = $this->Advertisement->find('first', $options);
		}

		$this->loadModel('Language');
		$this->loadModel('User');
		$languages = $this->Language->find('list');
		$users = $this->User->find('list', array(
			'fields' => array('User.id', 'User.username'),
			'conditions' => array(
				'User.banned' => Configure::read('zero_datetime'),
				'User.deleted' => Configure::read('zero_datetime'),
			)
			));
		$blocks = $this->Advertisement->Block->find('list');
		$this->set(compact('blocks', 'users', 'languages'));
		if ($this->authuser['Group']['name'] == 'superadmin' || $this->authuser['Group']['name'] == 'admin') {
			$this->set('user_enable', true);
		} else {
			$this->set('user_enable', false);
		}
	}

	/**
	 * admin_delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		$this->Advertisement->id = $id;
		if (!$this->Advertisement->exists()) {
			throw new NotFoundException(__d('publicity', 'Invalid advertisement'));
		}

		$this->request->onlyAllow('post', 'delete');

		if ($this->Advertisement->updateAll(array('Advertisement.deleted' => "'" . date('Y-m-d H:i:s') . "'"), array('Advertisement.id' => $id))) {
			$this->Session->setFlash(__d('publicity', 'Advertisement deleted'), 'flash/success');
		} else {
			$this->Session->setFlash(__d('publicity', 'Advertisement was not deleted'), 'flash/error');
		}
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * permite habilitar un anuncio
	 * 
	 * @param type $id
	 * @throws NotFoundException
	 */
	public function admin_published($id = null) {

		$this->Advertisement->id = $id;
		if (!$this->Advertisement->exists()) {
			throw new NotFoundException(__d('publicity', 'Invalid Advertisement'));
		}

		$this->autoRender = false;

		$Advertisement = $this->Advertisement->read(null, $id);

		if ($Advertisement['Advertisement']['published'] == Configure::read('zero_datetime')) {
			$this->Advertisement->updateAll(array('Advertisement.published' => "'" . date('Y-m-d H:i:s') . "'"), array('Advertisement.id' => $id));
		} else {
			$this->Advertisement->updateAll(array('Advertisement.published' => '"' . Configure::read('zero_datetime') . '"'), array('Advertisement.id' => $id));
		}
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * permite guardar un anuncio y si trae bloques para asignar se valida que se pueda guardar en el bloque
	 * 
	 * @param type $data
	 * @return boolean
	 */
	private function save_advertisement_blocks($data) {
		//guardo el anuncio
		if ($this->Advertisement->save(array('Advertisement' => $data['Advertisement']))) {

			// verifico si enviaron bloques para agregar el anuncio
			if (!empty($data['Block']['Block'])) {
				$blocks_save = false;
				$blocks_for_Advertisement = array();

				//itero sobre los bloques para poder guardarlos
				foreach ($data['Block']['Block'] as $key => $block_id) {

					// consulto la información sobre el bloque
					$block = $this->Advertisement->Block->find('first', array(
						'recursive' => -1,
						'conditions' => array(
							'Block.id' => $block_id
						)
						));
					//verifico si existe el bloque
					if (!empty($block)) {

						//compruebo si el tamaño del anuncio cabe en el bloque
						if ($data['Advertisement']['width'] <= $block['Block']['width']) {
							if ($data['Advertisement']['height'] <= $block['Block']['height']) {

								$BlocksAdvertisement = $this->Advertisement->BlocksAdvertisement->find('first', array(
									'recursive' => -1,
									'conditions' => array(
										'BlocksAdvertisement.block_id' => $block_id,
										'BlocksAdvertisement.advertisement_id' => $this->Advertisement->id,
									)
									));

								//verifico si el registro ya existe para no duplicar datos
								if (empty($BlocksAdvertisement)) {
									//guardo el anuncio dentro del bloque
									$this->Advertisement->BlocksAdvertisement->create();
									$status = $this->Advertisement->BlocksAdvertisement->save(array(
										'BlocksAdvertisement' => array(
											'block_id' => $block_id,
											'advertisement_id' => $this->Advertisement->id
										)
										));
									$this->Session->setFlash(__d('publicity', 'The advertisement has been saved'), 'flash/success');
								} else {
									$status = true;
								}

								if ($status) {
									// guardamos los bloques que guardaron el anuncio para una revision posterior
									$blocks_for_Advertisement[] = $block_id;
									$blocks_save = true;
									$this->Session->setFlash(__d('publicity', 'The Advertisement has been saved in block %s ', $block['Block']['name']), 'flash/success');
								} else {
									//borramos el grupo elegido de los datos provenientes del formulario
//										unset($this->request->data['Block']['Block'][$key]);
									$this->Session->setFlash(__d('publicity', 'The advertisement has been saved, but the block "%s" does not allow the size of the Advertisement', $block['Block']['name']), 'flash/success');
								}
							} else {
								//borramos el grupo elegido de los datos provenientes del formulario
//										unset($this->request->data['Block']['Block'][$key]);
								$this->Session->setFlash(__d('publicity', 'The Advertisement height exceeds the limit of the block( %s ) ', $block['Block']['name']), 'flash/error');
							}
						} else {
							//borramos el grupo elegido de los datos provenientes del formulario
//										unset($this->request->data['Block']['Block'][$key]);
							$this->Session->setFlash(__d('publicity', 'The Advertisement width exceeds the limit of the block( %s )', $block['Block']['name']), 'flash/error');
						}
					} else {
						//borramos el grupo elegido de los datos provenientes del formulario
//						unset($this->request->data['Block']['Block'][$key]);
						$this->Session->setFlash(__d('publicity', 'The block does not exist'), 'flash/error');
					}
				}

				if (!$blocks_save && !isset($data['Advertisement']['id'])) {
					//en caso de que sea un anuncio nuevo y no se haya guardado
					//en ningun bloque por validacion, se borra y se deja en el formulario
					$this->Advertisement->delete();
				} else {

					//eliminamos los anuncios pertenecientes a otros grupos que no hayan elegido los usuarios
					$this->DeleteModelsTogether((int) $this->Advertisement->id, $blocks_for_Advertisement);
				}
				return $blocks_save;
			} else {

				$this->DeleteModelsTogether((int) $this->Advertisement->id);
				return true;
			}
		} else {
			$this->Session->setFlash(__d('publicity', 'The advertisement could not be saved. Please, try again.'), 'flash/error');
			return false;
		}
	}

	/**
	 * consultamos los datos agregados a los bloques para elliminar los otros bloques
	 * 
	 * @param type $Advertisement
	 * @param array $blocks
	 */
	private function DeleteModelsTogether($Advertisement, array $blocks = array()) {
		$this->loadModel('BlocksAdvertisement');
		/**
		 * consultamos todos los bloques en los que esta el anuncio
		 */
		$BlocksAdvertisement = $this->BlocksAdvertisement->find('all', array(
			'recursive' => -1,
			'conditions' => array(
				'BlocksAdvertisement.advertisement_id' => (int) $Advertisement,
			)
			));

		//iteramos sobre los bloques
		foreach ($BlocksAdvertisement as $data) {
			$exist = false;

			//iteramos sobre los bloques elegidos para borra el anuncio del bloque no elegido			
			foreach ($blocks as $block) {
				if ($data['BlocksAdvertisement']['block_id'] == $block) {
					$exist = true;
				}
			}

			if ($exist) {
				$exist = false;
			} else {

				//eliminamos el anuncio de un bloque
				$this->BlocksAdvertisement->delete($data['BlocksAdvertisement']['id']);
			}
		}
	}

}
