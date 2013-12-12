<?php

/**
 * CakePHP FlashComponent
 * @author developer3
 */
class AdvertisementsComponent extends Component {

	public $components = array(
		'Session', 'RequestHandler',
	);
	public $Controller;

	public function __construct(\ComponentCollection $collection, $settings = array()) {
//	parent::__construct($collection, $settings);
		$this->Controller = $collection->getController();
		$this->ResourcesHandler = $collection->load('Resources.ResourcesHandler', array(
			'Entity' => array(
				'alias' => 'advertising',
				'folder' => 'advertising'
			),
			));
	}

	public function initialize(Controller $controller) {
		$this->controller = $controller;
	}

	public function startup(Controller $controller) {
		
	}

	public function beforeRender(Controller $controller) {
		
	}

	public function shutDown(Controller $controller) {
		
	}

	public function setAdvertisements($id = null, $lang = null, $return_block = false) {
		$this->Controller->loadModel('Advertising.ViewBlocksAdvertisement');
		$this->Controller->loadModel('BlocksAdvertisement');
		$this->Controller->loadModel('Block');
		$this->Controller->loadModel('Language');
		$this->Controller->loadModel('Impression');

		$this->Controller->Block->id = $id;
		if (!$this->Controller->Block->exists()) {
			throw new NotFoundException(__d('advertising', 'Invalid blocks advertisement - not existent'));
		}

//	// CONSULTAMOS EL LENGUAGE
		$language = $this->Controller->Language->find('first', array(
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
		$nBA = $this->Controller->ViewBlocksAdvertisement->find('count', array(
			'conditions' => $conditions_viewbloksad
			));

		if ($nBA == 0) {
			return false;
		}

		// consultamos la información 
		$block = $this->Controller->Block->read();

		// se verifica si el bloque permite visualizar mas de un solo anuncio a la ves
		if ($block['Block']['multiple']) {

			App::import('Core', 'ConnectionManager');
			$dataSource = ConnectionManager::getDataSource('default');

			// consultamos si hay bloques publicados aleaotiamente
			// Ajustamos la consulta para mysql y para postgreesql
			switch ($dataSource->config['datasource']) {
				case 'Database/Mysql':
					$BlocksAdvertisement = $this->Controller->ViewBlocksAdvertisement->find('all', array(
						'order' => array('RAND()'),
						'conditions' => $conditions_viewbloksad
						));
					break;
				case 'Database/Postgres':
					$BlocksAdvertisement = $this->Controller->ViewBlocksAdvertisement->find('all', array(
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
							$this->Controller->Impression->create();
							$this->Controller->Impression->save(array(
								'Impression' => array(
									'ip' => $this->Controller->request->clientIp(),
									'user_agent' => $this->Controller->request->header('User-Agent'),
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
						'ip' => $this->Controller->request->clientIp(),
						'user_agent' => $this->Controller->request->header('User-Agent'),
						'blocks_advertisement_id' => $BlocksAdvertisement['ViewBlocksAdvertisement']['id'],
						'create' => date('Y-m-d H:i:s'),
					)
				));
			} else {
				return false;
			}
		}

		if ($return_block) {
			return array_merge($BlocksAdvertisement, $block);
		} else {
			return array_merge($BlocksAdvertisement);
		}
	}

}
