<?php
/* SVN FILE: $Id: bootstrap.php 6311 2008-01-02 06:33:52Z phpnut $ */
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.app.config
 * @since			CakePHP(tm) v 0.10.8.2117
 * @version			$Revision: 6311 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2008-01-01 22:33:52 -0800 (Tue, 01 Jan 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 *
 * This file is loaded automatically by the app/webroot/index.php file after the core bootstrap.php is loaded
 * This is an application wide file to load any function that is not used within a class define.
 * You can also use this to include or require any files in your application.
 *
 */
/**
 * The settings below can be used to set additional paths to models, views and controllers.
 * This is related to Ticket #470 (https://trac.cakephp.org/ticket/470)
 *
 * $modelPaths = array('full path to models', 'second full path to models', 'etc...');
 * $viewPaths = array('this path to views', 'second full path to views', 'etc...');
 * $controllerPaths = array('this path to controllers', 'second full path to controllers', 'etc...');
 *
 */
//EOF

$vendorPaths = array(
  ROOT . DS . APP_DIR . DS . "vendors" . DS,
  ROOT . DS . "vendors" . DS,
);

//プラグインのベンダーディレクトリを検索対象に追加する
$plugins = getPlugins();
foreach($plugins as $plugin){
  $vendor_path = ROOT . DS . APP_DIR . DS . "plugins" . DS . $plugin . DS . 'vendors';
  if(is_dir($vendor_path))
    $vendorPaths[] = $vendor_path;
}

//ベンダーの読み込み対象情報を変更
Configure::write('vendorPaths',$vendorPaths);

//インストールされているプラグイン一覧を取得する
function getPlugins(){
  $pluginFolder = new Folder(APP . 'plugins');
  $plugins = $pluginFolder->ls();

  $result = array();

  if(count($plugins) > 0){

    foreach($plugins[0] as $plugin){
        $result[] = $plugin;
    }
  }

  return $result;
}

?>