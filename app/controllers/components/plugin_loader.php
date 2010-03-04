<?php

class PluginLoaderComponent extends Object {

  public function startup(&$controller) {

    //全てのページで読み込む情報をここに記述する
    $plugins = getPlugins();
	
  }

}
?>