<?php
//コンタクトフォームプラグイン
class ContactAppController extends AppController
{	

  //管理画面のメニュー
  var $admin_menu = array(
    'コンタクトフォーム'=>array(
      '設定'=>array('plugin'=>'contact','controller'=>'operation','action'=>'settings')
    )
  );

	function beforeFilter(){
		
		$this->_loadCommonValues();
	}
}

?>