<?php
class Trackback extends BlogAppModel {
	var $name = 'Trackback';
	var $useTable = 'trackbacks';

    var $belongsTo = array(
		'Article' =>
			array('className'  => 'Article',
					'conditions' => '',
					'order'      => '',
					'foreignKey' => 'article_id'
			)
    );

    function accept($id = 0){
    	$this->query('update trackbacks set accepted = 1 where id = ' . $id);
    }

    function deny($id = 0){
    	$this->query('update trackbacks set accepted = 0 where id = ' . $id);
    }
}
?>