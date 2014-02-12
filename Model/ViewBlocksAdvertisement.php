<?php

App::uses('AdvertisingAppModel', 'Advertising.Model');
/**
 * ViewBlocksAdvertisement Model
 *
 */
class ViewBlocksAdvertisement extends AdvertisingAppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';
	
	
	/**
	 * consulta aleatoria de anuncios por bloque.
	 * NOTA: solo devuelve un registro
	 * 
	 * @param type $block_id
	 * @return type
	 */
	public function findRandom($conditions_viewbloksad = array() ){		
		App::import('Core', 'ConnectionManager');
		$dataSource = ConnectionManager::getDataSource('default');
		
		switch ($dataSource->config['datasource']){
			case 'Database/Mysql':
					return $this->find('first', array(
						'order'=>array('RAND()'),
						'conditions' => $conditions_viewbloksad
					));
				break;
			
			case 'Database/Postgres':
					return $this->find('first', array(
						'order'=>array('RANDOM()'),
						'conditions' => $conditions_viewbloksad
					));
				break;
		}
	}

}
