<?php
/* SVN FILE: $Id: app_controller.php 7296 2008-06-27 09:09:03Z gwoo $ */
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @subpackage		cake.cake.libs.controller
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 7296 $
 * @modifiedby		$LastChangedBy: gwoo $
 * @lastmodified	$Date: 2008-06-27 02:09:03 -0700 (Fri, 27 Jun 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		cake
 * @subpackage	cake.cake.libs.controller
 */
class AppController extends Controller {

  var $components = array('AdminAuth','PluginLoader');
  var $helpers = array('html','manjuuHtml','form','manjuuForm','javascript','text','manjuuText');
  var $uses = array('Setting','Page');

  //管理画面の一覧表示の行数
  var $admin_num_rows = 10;

  //リスト表示の際に１画面に表示する項目数
  var $num_posts = 15;

  //実行中のプラグイン識別名
  var $plugin_name = '';

  //管理画面かどうかフラグ
  var $is_admin = false;

  function beforeFilter(){

    //全てのコントローラーの共通処理をここに記述する
    $this->pageTitle = 'まんじゅうCMS';

    //共通設定の読み込み
    $this->_loadCommonValues();
  }

  //全てのページで使用される共有変数の読み込み
  function _loadCommonValues(){

    //設定の読み込み
    $this->settings = $this->Setting->getValues();

    if($this->settings['site_name'])
      $this->pageTitle = $this->settings['site_name'];

    //ページの取得（メニュー用）
    $this->set('menu',$this->Page->generateMenu());

    //全ビューで使用するView変数
    $this->set('Settings',$this->settings);

    //表示するメッセージがあった場合
    if($this->Session->check('message')){
      $this->set('message',$this->Session->read('message'));
      $this->Session->delete('message');
    }

    //管理画面関連
    $this->admin_num_rows = Configure::read('admin_num_rows');

    //共通にセットする変数
    $this->set('plugin_name',$this->plugin_name);

    //プラグインの読み込み
    if (preg_match("/^" . Configure::read('Routing.admin') . '/', $this->action)) {

      $admin_additional_menu = array();
      $plugins = getPlugins();
      
      foreach($plugins as $plugin){
	    $pluginDir = APP . 'plugins' . DS . $plugin;
	    $load_string = Inflector::classify($plugin) . '.' . Inflector::classify($plugin . '_app_controller');

	    if(is_dir($pluginDir) && App::import($load_string)){

	      $class_name = Inflector::classify($plugin . '_app_controller');
	      $tmp_instance = new $class_name;

	      if(isset($tmp_instance->admin_menu))
	        foreach($tmp_instance->admin_menu as $name => $value){
	          $admin_additional_menu[$name] = $value;
	        }
	    }
      }

      $this->set('additional_menu',$admin_additional_menu);
    }
  }

  //スパム対策用の足し算を設定
  function _setMagicWord(){
    $_SESSION['magic_number'] = rand(2,9);
      $_SESSION['magic_number_first'] = rand(1,$_SESSION['magic_number'] - 1);
      $second_number = $_SESSION['magic_number'] - $_SESSION['magic_number_first'];
      $option_spam = array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9);
      $option_spam_ja = array(1=>'一',2=>'二',3=>'三',4=>'四',5=>'五',6=>'六',7=>'七',8=>'八',9=>'九');
      $question = "{$option_spam_ja[$_SESSION['magic_number_first']]}足す{$option_spam_ja[$second_number]}は？";
      $this->set('question',$question);
      $this->set('option_spam',$option_spam);
  }

  //メールの送信
  function _sendMail($subject,$to,$to_name = '',$template = 'email'){

    $from = Configure::read('from_address');
    $from_name = Configure::read('from_name');

    $this->Qdmail->to($to,$to_name);
    $this->Qdmail->subject($subject);
    $this->Qdmail->from($from,$from_name);

    $content = $this->render(null,'email',$template);
    $this->output = '';

    $this->Qdmail->text($content);
    $this->Qdmail->send();

    $this->autoRender = true;
  }

  function afterFilter(){

    //openwysiwyg/addons/imagelibraryに渡す値を設定
    $_SESSION['WWW_ROOT'] = HOST . $this->base;
    $_SESSION['DOC_ROOT'] = WWW_ROOT;
  }
}
?>