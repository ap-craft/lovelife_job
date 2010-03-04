<?php
class Rss extends SidebarRssAppModel {

	var $name = 'Rss';
	var $useTable = 'rsses';

    var $validate = array(
        'name' => array(
            'required' => VALID_NOT_EMPTY
        ),
        'url' => array(
            'required' => VALID_NOT_EMPTY
        )
    );
}
?>