<?php

//コンタクトフォームモジュールのインストーラー
class InstallContactTask extends Shell {

  var $uses = array('Installer');

  function execute(){
      $query_path = APP . 'plugins' . DS . 'contact' . DS . 'install.sql';

      $answer = strtoupper($this->in('設定データを初期化しますか？（この操作を行うとデータが消去されますので気をつけてください。）', array('y', 'n'),'n'));

      if($answer == 'Y'){
        $this->output('データ初期化中');
        $this->Installer->generateTables($query_path);
        $this->output('作成完了');
      }
  }

  function output($text){
    print mb_convert_encoding($text,Configure::read('Shell.encoding'),'UTF-8') . "\n";
  }

  function in($text,$param,$default){
    $text = mb_convert_encoding($text,Configure::read('Shell.encoding'),'UTF-8');
    return parent::in($text,$param,$default);
  }
}

?>