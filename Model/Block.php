<?php

App::uses('AppModel', 'Model');

/**
 * Block Model
 *
 * @property Advertisement $Advertisement
 */
class Block extends AdvertisingAppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'id';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
	'name' => array(
	    'notempty' => array(
		'rule' => array('notempty'),
	    //'message' => 'Your custom message here',
	    //'allowEmpty' => false,
	    //'required' => false,
	    //'last' => false, // Stop validation after this rule
	    //'on' => 'create', // Limit validation to 'create' or 'update' operations
	    ),
	),
	'alias' => array(
	    'notempty' => array(
		'rule' => array('notempty'),
	    //'message' => 'Your custom message here',
	    //'allowEmpty' => false,
	    //'required' => false,
	    //'last' => false, // Stop validation after this rule
	    //'on' => 'create', // Limit validation to 'create' or 'update' operations
	    ),
	    'unique' => array(
		'rule' => 'IsUnique',
		'message' => 'Alias already exists',
	    //'allowEmpty' => false,
	    //'required' => false,
	    //'last' => false, // Stop validation after this rule
	    //'on' => 'create', // Limit validation to 'create' or 'update' operations
	    ),
	),
	'multiple' => array(
	    'boolean' => array(
		'rule' => array('boolean'),
	    //'message' => 'Your custom message here',
	    //'allowEmpty' => false,
	    //'required' => false,
	    //'last' => false, // Stop validation after this rule
	    //'on' => 'create', // Limit validation to 'create' or 'update' operations
	    ),
	),
	'height' => array(
	    'notempty' => array(
		'rule' => array('notempty'),
	    //'message' => 'Your custom message here',
	    //'allowEmpty' => false,
	    //'required' => false,
	    //'last' => false, // Stop validation after this rule
	    //'on' => 'create', // Limit validation to 'create' or 'update' operations
	    ),
	),
	'width' => array(
	    'notempty' => array(
		'rule' => array('notempty'),
	    //'message' => 'Your custom message here',
	    //'allowEmpty' => false,
	    //'required' => false,
	    //'last' => false, // Stop validation after this rule
	    //'on' => 'create', // Limit validation to 'create' or 'update' operations
	    ),
	),
//		'published' => array(
//			'datetime' => array(
//				'rule' => array('datetime'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
	'orientation' => array(
	    'notempty' => array(
		'rule' => array('notempty'),
	    //'message' => 'Your custom message here',
	    //'allowEmpty' => false,
	    //'required' => false,
	    //'last' => false, // Stop validation after this rule
	    //'on' => 'create', // Limit validation to 'create' or 'update' operations
	    ),
	),
	'type_animation' => array(
	    'notempty' => array(
		'rule' => array('notempty'),
	    //'message' => 'Your custom message here',
	    //'allowEmpty' => false,
	    //'required' => false,
	    //'last' => false, // Stop validation after this rule
	    //'on' => 'create', // Limit validation to 'create' or 'update' operations
	    ),
	),
	'transition_time' => array(
	    'notempty' => array(
		'rule' => array('notempty'),
	    //'message' => 'Your custom message here',
	    //'allowEmpty' => false,
	    //'required' => false,
	    //'last' => false, // Stop validation after this rule
	    //'on' => 'create', // Limit validation to 'create' or 'update' operations
	    ),
	),
	'ad_number_visible' => array(
	    'notempty' => array(
		'rule' => array('notempty'),
	    //'message' => 'Your custom message here',
	    //'allowEmpty' => false,
	    //'required' => false,
	    //'last' => false, // Stop validation after this rule
	    //'on' => 'create', // Limit validation to 'create' or 'update' operations
	    ),
	),
    );
	
	
	public $hasMany = array(
		'BlocksAdvertisement' => array(
			'className' => 'BlocksAdvertisement',
			'foreignKey' => 'block_id',
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

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
	'Advertisement' => array(
	    'className' => 'Advertisement',
	    'joinTable' => 'blocks_advertisements',
	    'foreignKey' => 'block_id',
	    'associationForeignKey' => 'advertisement_id',
	    'unique' => 'keepExisting',
	    'conditions' => '',
	    'fields' => '',
	    'order' => '',
	    'limit' => '',
	    'offset' => '',
	    'finderQuery' => '',
	    'deleteQuery' => '',
	    'insertQuery' => ''
	)
    );

}
