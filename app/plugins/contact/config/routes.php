<?php
	//ルーティング関連の追加
	Router::connect('/contact', array('controller' => 'index', 'action' => 'index', 'plugin' => 'contact'));
?>