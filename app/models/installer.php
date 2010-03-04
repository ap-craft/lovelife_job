<?php
class Installer extends AppModel {

  var $name = 'Installer';
  var $useTable = false;

  //データベースに接続できるかどうかチェック
  function databaseConnectivilityCheck(){
    //テーブルとかあるかどうかチェック
    $db =& ConnectionManager::getDataSource($this->useDbConfig);
    return $db->connected;
  }

  //テーブルが出来てるかチェック
  function tableExistanceCheck(){

    $result = $this->query('describe pages');

    if(empty($result))
      return false;
    else
      return true;
  }

  //初期設定に必要なテーブルやデータを作成
  function generateTables($query_path = ''){
    if($query_path == '')
      $query_path = ROOT . DS . 'install.sql';

    $queries_tmp = file_get_contents($query_path);
    $queries = explode(";",$queries_tmp);
    foreach($queries  as $query){
      if(!empty($query))
        $this->query($query);
    }
  }
}

?>