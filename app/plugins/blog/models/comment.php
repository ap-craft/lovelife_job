<?php
class Comment extends BlogAppModel {

	var $name = 'Comment';
	var $useTable = 'comments';
	var $feed = true; 
    var $validate = array(
        'name' => array(
            'required' => VALID_NOT_EMPTY
        ),
        'body' => array(
            'required' => VALID_NOT_EMPTY
        ),
        'magic_number' => array(
        	'wrong_answer' => array('rule' => array('check_answer')),
        )
    );
    
    var $belongsTo = array(
		'Article' =>
			array('className'  => 'Article',
					'conditions' => '',
					'order'      => '',
					'foreignKey' => 'article_id'
			)
    );
    
    function accept($id = 0){
    	$this->query('update comments set accepted = 1 where id = ' . $id);
    }

    function deny($id = 0){
    	$this->query('update comments set accepted = 0 where id = ' . $id);
    }
}
?>