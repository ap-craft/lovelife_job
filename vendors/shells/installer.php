<?php

class InstallerShell extends Shell {

  var $uses = array('Installer');
  var $installed_plugins;
  var $tasks = array();

  //レポジトリの場所
  var $repository_url = 'http://www.manjuu.com/repository.ini';

  function loadTasks() {
    Configure::write('debug', 0);

    //設置されているプラグインを取得
    $this->installed_plugins = getPlugins();

    foreach($this->installed_plugins as $plugin){
      
      $taskPath = APP . 'plugins' . DS . $plugin . DS . 'vendors' .DS . 'shells' . DS;
      $installerPath = APP . 'plugins' . DS . $plugin . DS . 'vendors' .DS . 'shells' . DS . 'tasks' . DS . "install_{$plugin}.php";

      if(file_exists($installerPath)){
      	$this->Dispatch->shellPaths[] =$taskPath;
      	$this->tasks[] = $this->getPluginInstallerTaskName($plugin);
      }
    }

    parent::loadTasks();
  }

  function main(){

    if(!$this->Installer->databaseConnectivilityCheck()){
      $this->output('データベースに接続できません。');
      $this->output('app/config/database.phpを正しく設定してくだささい。');
      die();
    }else
      $this->output('データベース接続成功');

    if(!$this->Installer->tableExistanceCheck()){
      $answer = strtoupper($this->in('テーブルが存在しません。作成しますか?', array('y', 'n'),'y'));

      if($answer == 'Y'){
        $this->output('テーブルを作成します。');
        $this->Installer->generateTables();
        $this->output('作成完了');
      }

    }else
      $this->output('テーブルは既に存在しています。');

    $answer = strtoupper($this->in('パーミッションの設定を自動で行いますか？', array('y', 'n'),'y'));

     if($answer == 'Y'){
      //パーミッションの設定
      $this->output('パーミッションを設定します。');
      system(' chmod -R 777 ' . APP . 'tmp');
      system(' chmod -R 777 ' . APP . 'webroot' . DS . 'upload');
      $this->output('設定完了');
     }

    $this->output('インストールは完了しました。');
    $this->output("
　　　　　　　　　　　　　　　　　　　∧∧∩
　　　　　　　　　　　　　　　　　　 ( ﾟ∀ﾟ )/
　　　　　　　　　　　　 ﾊ_ﾊ　　　⊂　　 ﾉ　　　 ﾊ_ﾊ
　　　　　　　　　　　('(ﾟ∀ﾟ ∩　　 (つ ﾉ　　 ∩ ﾟ∀ﾟ)')
　　　　　　 ﾊ_ﾊ　　　ヽ　　〈　　　 (ノ　　　　〉　　/　　　 　ﾊ_ﾊ
　　　　　('(ﾟ∀ﾟ∩　　　ヽヽ_)　　　　　　　　(_ノ ノ　　　 .∩ ﾟ∀ﾟ)')
　　　　　O,_　　〈　　　　　　　　　　　　　　　　　　　　　　〉　　,_O
　　　　　　　｀ヽ_)　　　　　　　　　　　　　　　　　　　　　（_/ ´
　　 ﾊ_ﾊ　　　　　　　　　ManjuuCMSキターーーーー　　　　　　　　　 ﾊ_ﾊ
⊂(ﾟ∀ﾟ⊂⌒｀⊃　　　　　　　　　　　　　　　　　　　　　　 ⊂´⌒⊃ﾟ∀ﾟ)⊃
		");
  }

  //プラグインをインストールする
  function plugin(){

    if(isset($this->args[0]))
      $plugin_name = $this->args[0];

    //レポジトリファイルをコピー
    $repository_ini = file_get_contents($this->repository_url);
    file_put_contents(CACHE . 'latest_repository.ini',$repository_ini);
    $repository = parse_ini_file(CACHE . 'latest_repository.ini',true);
    $available_plugins = array();

    foreach($repository['plugins'] as $name => $url){
      $available_plugins[] = $name;
    }
    foreach($this->installed_plugins as $pluginname){
      if(!in_array($pluginname,$available_plugins))
        $available_plugins[] = $pluginname;
    }
	
    if(!isset($plugin_name)){

      $this->output('インストール可能なプラグイン一覧');
      foreach($available_plugins as $name){
          $this->output($name);
      }
      $plugin_name = trim($this->in('インストールしたいプラグイン名を入力してください。'));
    }

    if(!in_array($plugin_name,$available_plugins)){
      $this->output('プラグインが見つかりませんでした。');
      return;
    }

    //既にあるかどうかチェック
    if(in_array($plugin_name,$this->installed_plugins)){
      $answer = strtoupper($this->in('インストール済みのプラグインです。再インストールしますか？',array('y','n'),'n'));
      if($answer == 'N')
        return;
    }

    //ダウンロード開始
    $tmp = parse_url($repository['plugins'][$plugin_name]);
    $path_info = pathinfo($tmp['path']);
    $filename = $path_info['basename'];

    $this->output($repository['plugins'][$plugin_name] . 'よりダウンロード中');
    copy($repository['plugins'][$plugin_name],CACHE . $filename);

    //解凍
    system("tar xvfz " . CACHE . $filename . ' --directory=' . CACHE);

    //プラグインディレクトリに移動
    rename(CACHE . $plugin_name,APP . 'plugins' . DS . $plugin_name);

    //タスク情報を再読み込み
    $this->loadTasks();

    //プラグイン内のタスクを実行
    $plugin_installer_task_name = $this->getPluginInstallerTaskName($plugin_name);
    $this->$plugin_installer_task_name->initialize();
    $this->$plugin_installer_task_name->execute();
  }

  function output($text){
    print mb_convert_encoding($text,Configure::read('Shell.encoding'),'UTF-8') . "\n";
  }

  function in($text,$param = null,$default = null){
    $text = mb_convert_encoding($text,Configure::read('Shell.encoding'),'UTF-8');
    return parent::in($text,$param,$default);
  }

  function getPluginInstallerTaskName($plugin_name){
    return Inflector::classify('install_' . $plugin_name);
  }
}

?>