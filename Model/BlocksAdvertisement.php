<?php
App::uses('AdvertisingAppModel', 'Advertising.Model');
/**
 * BlocksAdvertisement Model
 *
 * @property Block $Block
 * @property Advertisement $Advertisement
 * @property Click $Click
 * @property Impression $Impression
 */
class BlocksAdvertisement extends AdvertisingAppModel{

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Block' => array(
			'className' => 'Block',
			'foreignKey' => 'block_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Advertisement' => array(
			'className' => 'Advertisement',
			'foreignKey' => 'advertisement_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Click' => array(
			'className' => 'Click',
			'foreignKey' => 'blocks_advertisement_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Impression' => array(
			'className' => 'Impression',
			'foreignKey' => 'blocks_advertisement_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
}
