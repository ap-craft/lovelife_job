<?php
	//ルーティング関連の追加
	Router::connect('/sidebar_rss/show/*', array('controller' => 'show_rss', 'action' => 'index', 'plugin' => 'sidebar_rss'));
?>