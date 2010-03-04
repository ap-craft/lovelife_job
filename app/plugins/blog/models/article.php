<?php
class Article extends BlogAppModel {

	var $name = 'Article';
	var $useTable = 'articles';
	var $feed = true;  
	
    var $validate = array(
        'title' => array(
            'required' => VALID_NOT_EMPTY
        ),
        'content' => array(
            'required' => VALID_NOT_EMPTY
        ),
        'url' => array(
        	'unique' => array('rule' => array('unique')),
            'rule2' => array('rule' => array('minLength', 5)),
            'rule1' => array('rule' => array('custom','/^[0-9a-z-_]+$/i')),
            'required' => VALID_NOT_EMPTY
        )
    );
   
    var $hasMany = array(
    	'Comment' =>
			array(
				'className'     => 'Comment',
				'conditions'    => 'Comment.accepted = 1',
				'order'         => 'Comment.created',
				'limit'         => '',
				'foreignKey'    => 'article_id',
				'dependent'     => true,
				'exclusive'     => false,
				'finderQuery'   => '',
				'fields'        => '',
				'offset'        => '',
				'counterQuery'  => ''
			),
		'Trackback' => 
			array(
				'className'     => 'Trackback',
				'conditions'    => 'Trackback.accepted = 1',
				'order'         => 'Trackback.created',
				'limit'         => '',
				'foreignKey'    => 'article_id',
				'dependent'     => true,
				'exclusive'     => false,
				'finderQuery'   => '',
				'fields'        => '',
				'offset'        => '',
				'counterQuery'  => ''
			)
	);
	
  	function unique($field){

		foreach( $field as $key => $value ){

			$found = $this->query("select * from categories where url = '{$value}'");

			if(count($found) == 0)
				return true;
			else
				return false;
		}
	}
	
	function showed($article_id){
		$this->query("update articles set showed = showed + 1 where id = {$article_id}");
	}
}
?>