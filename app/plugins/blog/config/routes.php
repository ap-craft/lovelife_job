<?php
	//ルーティング関連の追加
	Router::connect('/blog', array('controller' => 'top', 'action' => 'index', 'plugin' => 'blog'));
	Router::connect('/blog/top/*', array('controller' => 'top', 'action' => 'index', 'plugin' => 'blog'));
	Router::connect('/blog/entry/*', array('controller' => 'entry', 'action' => 'index', 'plugin' => 'blog'));
	Router::connect('/blog/category/*', array('controller' => 'category', 'action' => 'index', 'plugin' => 'blog'));

	Router::connect('/blog/tb/*', array('controller' => 'Tb', 'action' => 'index', 'plugin' => 'blog'));
?>