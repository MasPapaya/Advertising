<?php

/**
 * BlocksAdvertisements Controller
 *
 * @property BlocksAdvertisement $BlocksAdvertisement
 */
class BlocksAdvertisementsController extends AdvertisingAppController {

	
	public $uses = array('Advertising.BlocksAdvertisement');
	public function beforeFilter() {
		parent::beforeFilter();
//		$this->Auth->deny();
		///$this->Auth->allow('public_show','show','register_click');
		$this->Auth->allow();
		
		
		
	}
	
	

	/**
	 * cargamos componentes
	 * @var type
	 */
	public $components = array(
		'Resources.ResourcesHandler' => array(
			'Entity' => array(
				'alias' => 'advertising',
				'folder' => 'advertising'
			),
		),
	);

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this->set('blocksAdvertisements', $this->paginate());
	}

	/**
	 * method para cargar los anuncios de un bloque
	 * 
	 * @param type $block
	 * @throws MethodNotAllowedException
	 */
	public function admin_advertisements($block) {
		if (!isset($block) || is_null($block) || empty($block)) {
			throw new MethodNotAllowedException();
		}		
		$this->BlocksAdvertisement->bindModel(array('belongsTo' => array('Block')));
		$this->BlocksAdvertisement->bindModel(array('hasMany' => array('Click', 'Impression')));
		$this->paginate = array(
			'recursive' => 1,
			'fields' => array('Advertisement.*'),
			'limit' => 10,
//			'order' => array(),
			'conditions' => array(
				'BlocksAdvertisement.block_id' => $block,
			),
			'joins' => array(
				array(
					'alias' => 'Advertisements',
					'table' => 'advertisements',
					'type' => 'INNER',
					'conditions' => array(
						'Advertisements.deleted = '.'"'.Configure::read('zero_datetime').'"',
					),
				),
			)
		);
		
				
		$this->set('advertisements', $this->paginate());
	}

	/**
	 * methods para cargar los bloques a los que esta asociado un anuncio
	 * 
	 * @param type $advertisements
	 * @throws MethodNotAllowedException
	 */
	public function admin_blocks($advertisements) {

		if (!isset($advertisements) || is_null($advertisements) || empty($advertisements)) {
			throw new MethodNotAllowedException();
		}

		$this->BlocksAdvertisement->bindModel(array('belongsTo' => array('Block')));
		$this->BlocksAdvertisement->bindModel(array('hasMany' => array('Click', 'Impression')));
		$this->paginate = array(
			'recursive' => 1,
			'fields' => array('Block.*'),
			'limit' => 10,
//			'order' => array(),
			'conditions' => array(
				'BlocksAdvertisement.advertisement_id' => $advertisements,
			)
		);
//
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
		if (!$this->BlocksAdvertisement->exists($id)) {
			throw new NotFoundException(__d('advertising', 'Invalid blocks advertisement'));
		}
		$options = array('conditions' => array('BlocksAdvertisement.' . $this->BlocksAdvertisement->primaryKey => $id));
		$this->set('blocksAdvertisement', $this->BlocksAdvertisement->find('first', $options));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->BlocksAdvertisement->create();
			if ($this->BlocksAdvertisement->save($this->request->data)) {
				$this->Session->setFlash(__d('advertising', 'The blocks advertisement has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('advertising', 'The blocks advertisement could not be saved. Please, try again.'));
			}
		}
		$blocks = $this->BlocksAdvertisement->Block->find('list');
		$advertisements = $this->BlocksAdvertisement->Advertisement->find('list');
		$this->set(compact('blocks', 'advertisements'));
	}

	/**
	 * admin_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		if (!$this->BlocksAdvertisement->exists($id)) {
			throw new NotFoundException(__d('advertising', 'Invalid blocks advertisement'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->BlocksAdvertisement->save($this->request->data)) {
				$this->Session->setFlash(__d('advertising', 'The blocks advertisement has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('advertising', 'The blocks advertisement could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('BlocksAdvertisement.' . $this->BlocksAdvertisement->primaryKey => $id));
			$this->request->data = $this->BlocksAdvertisement->find('first', $options);
		}
		$blocks = $this->BlocksAdvertisement->Block->find('list');
		$advertisements = $this->BlocksAdvertisement->Advertisement->find('list');
		$this->set(compact('blocks', 'advertisements'));
	}

	/**
	 * admin_delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		$this->BlocksAdvertisement->id = $id;
		if (!$this->BlocksAdvertisement->exists()) {
			throw new NotFoundException(__d('advertising', 'Invalid blocks advertisement'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->BlocksAdvertisement->delete()) {
			$this->Session->setFlash(__d('advertising', 'Blocks advertisement deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__d('advertising', 'Blocks advertisement was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * muestra informacion de los click que ha obtenido  un anuncio en un bloque
	 * 
	 * @param type $id
	 */
	public function admin_clicks($id = null) {
		$this->BlocksAdvertisement->id = $id;
		if (!$this->BlocksAdvertisement->exists()) {
			throw new NotFoundException(__d('advertising', 'Invalid blocks advertisement'));
		}

		$this->loadModel('ViewClick');

		$this->paginate = array(
			'limit' => 10,
			'order' => array('ViewClick.creation_date' => 'DESC'),
			'conditions' => array(
				'ViewClick.blocks_advertisement_id' => $id,
			)
		);

		$this->set('clicks', $this->paginate('ViewClick'));
	}

	public function admin_impressions($id = null) {
		$this->BlocksAdvertisement->id = $id;
		if (!$this->BlocksAdvertisement->exists()) {
			throw new NotFoundException(__d('advertising', 'Invalid blocks advertisement'));
		}

		$this->loadModel('ViewImpression');

		$this->paginate = array(
			'limit' => 10,
			'order' => array('ViewImpression.creation_date' => 'DESC'),
			'conditions' => array(
				'ViewImpression.blocks_advertisement_id' => $id,
			)
		);

		$this->set('impressions', $this->paginate('ViewImpression'));
	}

	/**
	 * registra los clicks que obtiene un anuncio dentro de un bloque
	 * 
	 * @param type $block_advertisement_id
	 * @throws NotFoundException
	 */
	public function register_click($block_advertisement_id = null) {
		$this->loadModel('Advertising.ViewBlocksAdvertisement');
		$this->loadModel('Advertising.Click');

		$BlocksAdvertisement = $this->ViewBlocksAdvertisement->find('first', array(
			'conditions' => array(
				'ViewBlocksAdvertisement.id' => $block_advertisement_id,
			)
			));

		if (empty($BlocksAdvertisement)) {
			throw new NotFoundException(__d('advertising', 'Invalid blocks advertisement'));
		}

		$this->Click->create();
		$this->Click->save(array(
			'Click' => array(
				'ip' => $this->request->clientIp(),
				'user_agent' => $this->request->header('User-Agent'),
				'blocks_advertisement_id' => $block_advertisement_id,
				'create' => date('Y-m-d H:i:s'),
			)
		));

		$this->redirect($BlocksAdvertisement['ViewBlocksAdvertisement']['advertisement_url']);
		$this->layout = 'advertising';
	}

	/**
	 * Imprime los anuncios de un bloque
	 * 
	 * @param type $id
	 * @throws NotFoundException
	 */
	public function show($id = null, $lang = null, $return = false) {
		$this->loadModel('Advertising.ViewBlocksAdvertisement');
		$this->loadModel('Language');

		$this->BlocksAdvertisement->Block->id = $id;
		if (!$this->BlocksAdvertisement->Block->exists()) {
			throw new NotFoundException(__d('advertising', 'Invalid blocks advertisement - not existent'));
		}

		// CONSULTAMOS EL LENGUAGE
		$language = $this->Language->find('first', array(
			'condition' => array(
				'Language.code' => $lang,
			)
			));

		// SI EL EL LENGUAGE EXISTE SE AGREGA A LA CONDICION
		if (!empty($language)) {
			$conditions_viewbloksad = array(
				'ViewBlocksAdvertisement.block_id' => $id,
				'ViewBlocksAdvertisement.language_id' => $language['Language']['id'],
			);
		} else {
			$conditions_viewbloksad = array(
				'ViewBlocksAdvertisement.block_id' => $id,
			);
		}

		// consultamos la existencia del bloque
		$nBA = $this->ViewBlocksAdvertisement->find('count', array(
			'conditions' => $conditions_viewbloksad
			));

		$this->layout = 'advertising';

		if ($nBA == 0) {
			$this->view = 'show_empty';
			return false;
		}

		// consultamos la información 
		$block = $this->BlocksAdvertisement->Block->read();


		// se verifica si el bloque permite visualizar mas de un solo anuncio a la ves
		if ($block['Block']['multiple']) {

			App::import('Core', 'ConnectionManager');
			$dataSource = ConnectionManager::getDataSource('default');

			// consultamos si hay bloques publicados aleaotiamente
			// Ajustamos la consulta para mysql y para postgreesql
			switch ($dataSource->config['datasource']) {
				case 'Database/Mysql':
					$BlocksAdvertisement = $this->ViewBlocksAdvertisement->find('all', array(
						'order' => array('RAND()'),
						'conditions' => $conditions_viewbloksad
						));
					break;
				case 'Database/Postgres':
					$BlocksAdvertisement = $this->ViewBlocksAdvertisement->find('all', array(
						'order' => array('RANDOM()'),
						'conditions' => $conditions_viewbloksad
						));
					break;
			}

			if (!empty($BlocksAdvertisement)) {

				//variable para almacenar la cantidad de anuncios a mostrar
				$ad_visibles = 0;

				foreach ($BlocksAdvertisement as $key => $advertisement) {
					//consulto el recurso del anuncio
					$BlocksAdvertisement[$key]['ViewBlocksAdvertisement']['Resource'] = $this->ResourcesHandler->Read($advertisement['ViewBlocksAdvertisement']['advertisement_id'], 'first', array(
						'conditions' => array(
							'not' => array(
								'ViewResourceGroup.group_type_id ' => null
							)
						)
						));

					// los anuncios que no tengan recursos no se publican por tanto no se guardan el registro de impresion
					if (!empty($BlocksAdvertisement[$key]['ViewBlocksAdvertisement']['Resource'])) {
						$ad_visibles++;

						// si el bloque es estatico y el bloque tiene preestablecido mostrar un numero de anuncios, comienza
						// eliminar los anuncios que no caben en el bloque
						if ($block['Block']['block_type'] == '1' && $block['Block']['ad_number_visible'] < $ad_visibles) { //1 = static
							// eliminacion de anuncio 
							unset($BlocksAdvertisement[$key]);
						} else {

							//se guarda un registro de impresion
							$this->BlocksAdvertisement->Impression->create();
							$this->BlocksAdvertisement->Impression->save(array(
								'Impression' => array(
									'ip' => $this->request->clientIp(),
									'user_agent' => $this->request->header('User-Agent'),
									'blocks_advertisement_id' => $advertisement['ViewBlocksAdvertisement']['id'],
									'create' => date('Y-m-d H:i:s'),
								)
							));
						}
					} else {
						// eliminacion de anuncio 
						unset($BlocksAdvertisement[$key]);
					}
				}
			}
		} else {

			// consulta al azar de los anuncios de un bloque
			$BlocksAdvertisement = $this->ViewBlocksAdvertisement->findRandom($conditions_viewbloksad);

			$BlocksAdvertisement['ViewBlocksAdvertisement']['Resource'] = $this->ResourcesHandler->Read($BlocksAdvertisement['ViewBlocksAdvertisement']['advertisement_id'], 'first', array(
				'conditions' => array(
					'not' => array(
						'ViewResourceGroup.group_type_id ' => null
					)
				)
				));
			// los anuncios que no tengan recursos no se publican por tanto no se guardan el registro de impresion
			if (!empty($BlocksAdvertisement['ViewBlocksAdvertisement']['Resource'])) {
				$this->BlocksAdvertisement->Impression->create();
				$this->BlocksAdvertisement->Impression->save(array(
					'Impression' => array(
						'ip' => $this->request->clientIp(),
						'user_agent' => $this->request->header('User-Agent'),
						'blocks_advertisement_id' => $BlocksAdvertisement['ViewBlocksAdvertisement']['id'],
						'create' => date('Y-m-d H:i:s'),
					)
				));
			} else {
				$this->view = 'show_empty';
				return false;
			}
		}

		//desabilitamos los archivos js y css del plugin de recursos que abren la modal administrativa
//		$this->ResourcesTool->renderFiles = false;
		//se pasan los anuncios y el bloque a la vista

		$this->set(compact('BlocksAdvertisement', 'block'));
	}

	public function public_show($id = null, $lang = null, $return = null) {
		$this->loadModel('Advertising.ViewBlocksAdvertisement');
		$this->loadModel('Advertising.Block');
		$this->loadModel('Impression');

		$this->loadModel('Language');

		$this->Block->id = $id;
		if (!$this->Block->exists()) {
			throw new NotFoundException(__d('advertising', 'Invalid blocks advertisement - not existent'));
		}

		// CONSULTAMOS EL LENGUAGE
		$language = $this->Language->find('first', array(
			'condition' => array(
				'Language.code' => $lang,
			)
			));

		// SI EL EL LENGUAGE EXISTE SE AGREGA A LA CONDICION
		if (!empty($language)) {
			$conditions_viewbloksad = array(
				'ViewBlocksAdvertisement.block_id' => $id,
				'ViewBlocksAdvertisement.language_id' => $language['Language']['id'],
			);
		} else {
			$conditions_viewbloksad = array(
				'ViewBlocksAdvertisement.block_id' => $id,
			);
		}

		// consultamos la existencia del bloque
		$nBA = $this->ViewBlocksAdvertisement->find('count', array(
			'conditions' => $conditions_viewbloksad
			));

		$this->layout = 'advertising';

		if ($nBA == 0) {
			$this->view = 'show_empty';
			return false;
		}

		// consultamos la información 
		$block = $this->Block->read();

		// se verifica si el bloque permite visualizar mas de un solo anuncio a la ves
		if ($block['Block']['multiple']) {

			App::import('Core', 'ConnectionManager');
			$dataSource = ConnectionManager::getDataSource('default');

			// consultamos si hay bloques publicados aleaotiamente
			// Ajustamos la consulta para mysql y para postgreesql
			switch ($dataSource->config['datasource']) {
				case 'Database/Mysql':
					$BlocksAdvertisement = $this->ViewBlocksAdvertisement->find('all', array(
						'order' => array('RAND()'),
						'conditions' => $conditions_viewbloksad
						));
					break;
				case 'Database/Postgres':
					$BlocksAdvertisement = $this->ViewBlocksAdvertisement->find('all', array(
						'order' => array('RANDOM()'),
						'conditions' => $conditions_viewbloksad
						));
					break;
			}

			if (!empty($BlocksAdvertisement)) {
				//variable para almacenar la cantidad de anuncios a mostrar
				$ad_visibles = 0;
				foreach ($BlocksAdvertisement as $key => $advertisement) {
					//consulto el recurso del anuncio
					$BlocksAdvertisement[$key]['ViewBlocksAdvertisement']['Resource'] = $this->ResourcesHandler->Read($advertisement['ViewBlocksAdvertisement']['advertisement_id'], 'first', array(
						'conditions' => array(
							'not' => array(
								'ViewResourceGroup.group_type_id ' => null
							)
						)
						));

					// los anuncios que no tengan recursos no se publican por tanto no se guardan el registro de impresion
					if (!empty($BlocksAdvertisement[$key]['ViewBlocksAdvertisement']['Resource'])) {
						$ad_visibles++;

						// si el bloque es estatico y el bloque tiene preestablecido mostrar un numero de anuncios, comienza
						// eliminar los anuncios que no caben en el bloque
						if ($block['Block']['block_type'] == '1' && $block['Block']['ad_number_visible'] < $ad_visibles) { //1 = static
							// eliminacion de anuncio 
							unset($BlocksAdvertisement[$key]);
						} else {

							//se guarda un registro de impresion
							$this->Impression->create();
							$this->Impression->save(array(
								'Impression' => array(
									'ip' => $this->request->clientIp(),
									'user_agent' => $this->request->header('User-Agent'),
									'blocks_advertisement_id' => $advertisement['ViewBlocksAdvertisement']['id'],
									'create' => date('Y-m-d H:i:s'),
								)
							));
						}
					} else {
						// eliminacion de anuncio 
						unset($BlocksAdvertisement[$key]);
					}
				}
			}
		} else {

			// consulta al azar de los anuncios de un bloque
			$BlocksAdvertisement = $this->ViewBlocksAdvertisement->findRandom($conditions_viewbloksad);

			$BlocksAdvertisement['ViewBlocksAdvertisement']['Resource'] = $this->ResourcesHandler->Read($BlocksAdvertisement['ViewBlocksAdvertisement']['advertisement_id'], 'first', array(
				'conditions' => array(
					'not' => array(
						'ViewResourceGroup.group_type_id ' => null
					)
				)
				));
			// los anuncios que no tengan recursos no se publican por tanto no se guardan el registro de impresion
			if (!empty($BlocksAdvertisement['ViewBlocksAdvertisement']['Resource'])) {
				$this->BlocksAdvertisement->Impression->create();
				$this->BlocksAdvertisement->Impression->save(array(
					'Impression' => array(
						'ip' => $this->request->clientIp(),
						'user_agent' => $this->request->header('User-Agent'),
						'blocks_advertisement_id' => $BlocksAdvertisement['ViewBlocksAdvertisement']['id'],
						'create' => date('Y-m-d H:i:s'),
					)
				));
			} else {
				$this->view = 'show_empty';
				return false;
			}
		}

		//desabilitamos los archivos js y css del plugin de recursos que abren la modal administrativa
//		$this->ResourcesTool->renderFiles = false;
		//se pasan los anuncios y el bloque a la vista

		if (!$return) {
			$this->set(compact('BlocksAdvertisement', 'block'));
		} else {
			return $BlocksAdvertisement;
		}
	}

}
