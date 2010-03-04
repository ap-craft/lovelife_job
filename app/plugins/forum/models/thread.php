<?php
class Thread extends ForumAppModel {

	var $name = 'Thread';
	var $useTable = 'threads';
	
    var $validate = array(
        'name' => array(
            'required' => VALID_NOT_EMPTY
        ),
        'description' => array(
            'required' => VALID_NOT_EMPTY
        ),
        'password' => array(
            'alphaNumeric' => array('rule' => array('alphaNumeric')),
			'required' => VALID_NOT_EMPTY
        ),
        'magic_number' => array(
        	'wrong_answer' => array('rule' => array('check_answer')),
        )
    );
	
    function updateDate($id){
    	if(isset($id)){
    		$this->query("update {$this->useTable} set modified = now() where id = {$id}");
    	}
    }
}
?>