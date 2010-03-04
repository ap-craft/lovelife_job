<?php
class ManjuuHtmlHelper extends HtmlHelper {

  //ページへのリンクを生成
  function pageLink($title,$url,$type=1){

    if($type==1)
      return $this->link($title,array('controller'=>'page','plugin'=>'',$url));
    else
      return $this->link($title,$url);
  }

  //プラグインのCSSをロード
  function pluginCss(){
    $view =& ClassRegistry::getObject('view');
    $htmlHelper = $view->loaded['html'];

    $return = '';

    $plugins = getPlugins();

    foreach($plugins as $plugin){

      $pluginDir = APP . 'plugins' . DS . $plugin;
      $cssPath = APP . 'plugins' . DS . $plugin . DS . 'vendors' .DS . 'css' . DS . 'style.css';

      if(is_dir($pluginDir) && file_exists($cssPath)){
        $url = $htmlHelper->base . '/cssLoader/' . $plugin;
        $return .= '<link rel="stylesheet" type="text/css" href="' . $url . '" />' . "\n";
      }

    }

    return $return;
  }
}
?>