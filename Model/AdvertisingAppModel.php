<?php

App::uses('AppModel', 'Model');

class AdvertisingAppModel extends AppModel {

	public function beforeFind($queryData) {
		if ($this->hasField('deleted')) {
			if (!empty($queryData['conditions'])) {
				if ($this->alias != 'Advertisement') {
					$queryData['conditions'] = array_merge_recursive($queryData['conditions'], array($this->alias . '.deleted' => '"' . Configure::write('zero_datetime') . '"'));
				}
			}
		}

		return $queryData;
	}

	public function beforeValidate($options = array()) {
		if ($this->hasField('deleted') && isset($this->data[$this->alias]['deleted'])) {
//			$this->data[$this->alias]['deleted'] = date('Y-m-d H:i:s',strtotime($this->data[$this->alias]['deleted']));
		}

		if ($this->hasField('published') && isset($this->data[$this->alias]['published'])) {
//			$this->data[$this->alias]['published'] = date('Y-m-d H:i:s',strtotime($this->data[$this->alias]['published']));
		}

		return true;
	}

}