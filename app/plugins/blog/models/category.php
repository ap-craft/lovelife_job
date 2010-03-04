<?php
class Category extends BlogAppModel {

	var $name = 'Category';
	var $useTable = 'categories';
	
    var $validate = array(
        'name' => array(
            'required' => VALID_NOT_EMPTY
        ),
        'url' => array(
        	'unique' => array('rule' => array('unique')),
            'rule2' => array('rule' => array('minLength', 2)),
            'rule1' => array('rule' => array('custom','/^[0-9a-z-_]+$/i')),
            'required' => VALID_NOT_EMPTY
        )
    );

    var $hasMany = array('Article' =>
		array(
			'className'     => 'Article',
			'conditions'    => '',
			'order'         => 'Article.showed desc,Article.created desc',
			'limit'         => '10',
			'foreignKey'    => 'category_id',
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
}
?>