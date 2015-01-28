<?php
class comment{
private $_db,
		$_data;


public function create($fields = array()) {
		if($this->_db->insert('comment', $fields)) {
			throw new Exception('There was a problem uploading this comment.');
		}
	}



}