<?php
//掲示板プラグイン
class ForumAppController extends AppController
{

  var $plugin_name = 'forum';

  //管理画面のメニュー
  var $admin_menu = array(
    '掲示板'=>array(
      '掲示板一覧'=>array('plugin'=>'forum','controller'=>'operation','action'=>'thread_list')
    )
  );
  
	function beforeFilter(){
		$this->_loadCommonValues();
	}
	
	//掲示板のトップにリダイレクトする
	function _redirectTop(){
		$this->redirect(array('plugin'=>'forum','controller'=>'thread','action'=>'index'));
	}
	
	//画面にメッセージを表示する
	function _setMessage($text = ''){
		if(!empty($text)){
			$this->Session->write('message',$text);
		}
	}
}

?>