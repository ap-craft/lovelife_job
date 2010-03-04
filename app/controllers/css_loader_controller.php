<?php
//プラグインのCSSをロードするコントローラー
class CssLoaderController extends AppController {

  var $name = 'CssLoader';
  var $uses = array();

  function index($plugin_name){
    //余計な物を出さないためにデバッグモードを強制的に０にする
    Configure::write('debug',0);
    $this->layout = null;

    Header("Content-Type:text/css");
    $cssPath = APP . 'plugins' . DS . $plugin_name . DS . 'vendors' .DS . 'css' . DS . 'style.css';

    if(file_exists($cssPath)){
      echo file_get_contents($cssPath);
    }

    $this->render(false);
  }

}
?>