<?php
class Post extends ForumAppModel {

	var $name = 'Post';
	var $useTable = 'posts';
	
    var $validate = array(
        'name' => array(
            'required' => VALID_NOT_EMPTY
        ),
        'body' => array(
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
	
    function delAll($thread_id = 0){
    	
    	if($thread_id == 0)
    		return false;
    	
    	$this->query('delete from posts where thread_id = ' . $thread_id);
    	
    }
}
?>