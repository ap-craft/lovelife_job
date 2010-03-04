<?php
//サイドバーにＲＳＳの内容を吐き出す
class SidebarRssAppController extends AppController
{
	var $uses = array('Page','Setting');
	var $helpers = array('html','manjuuHtml','form','manjuuForm','javascript','Text','manjuuText');

  //管理画面のメニュー
  var $admin_menu = array(
    '外部RSS読み込み'=>array(
      '設定'=>array('plugin'=>'sidebar_rss','controller'=>'operation','action'=>'list')
    )
  );	
  
	function beforeFilter(){
		
		$this->_loadCommonValues();
	}
}

?>