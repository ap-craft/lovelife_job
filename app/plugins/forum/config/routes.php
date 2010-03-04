<?php
	//ルーティング関連の追加
	Router::connect('/forum', array('plugin'=>'forum','controller' => 'thread', 'action' => 'index'));
?>