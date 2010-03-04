<?php
//ブログモジュールのベースコントローラー
/*
 * 前ページ共通で読み込みたい場合
 *
   --- app_controller.php内で
  var $uses = array(...,'Blog.Comment','Blog.Category','Blog.Article');

   --- controllers/components/manjuu.phpのstartup内で
  //ブログの最新コメント
   $new_comments = $controller->Comment->findAll(null,null,"Comment.created desc ", 20);
  $controller->set('new_comments',$new_comments);

  //ブログ最新の投稿
  $new_articles = $controller->Article->findAll(null,null,"Article.created desc ", 20);
  $controller->set('new_articles',$new_articles);

  //カテゴリー情報の設定
  $controller->set('popular_articles', $controller->Article->findAll(null,null,"Article.showed desc,Article.created desc",20));
  $controller->set('categories', $controller->Category->findAll(null,null,"Category.created"));

  --- Viewの表示したい場所で
  <!-- ブログプラグインの最新投稿  -->
  <?php e($this->renderElement('new_articles',array('plugin'=>'blog'))); ?>

  <!-- ブログプラグインの最新コメント  -->
  <?php e($this->renderElement('new_comments',array('plugin'=>'blog'))); ?>

  <!-- ブログプラグインのカテゴリー一覧  ->
  <?php e($this->renderElement('category_list',array('plugin'=>'blog'))); ?>

  <!-- ブログプラグインのカテゴリー別人気ブログ一覧  (フッターバージョン) ->
  <?php e($this->renderElement('footer',array('plugin'=>'blog'))); ?>
 *
 */
class BlogAppController extends AppController
{
  //1ページに表示する記事の数
  var $num_posts = 15;
  var $uses = array('Blog.Article','Blog.Category','Setting');
  var $helpers = array('html','manjuuHtml','form','manjuuForm','text','manjuuText','javascript');
  var $settings = null;

  var $plugin_name = 'blog';

  //管理画面のメニュー
  var $admin_menu = array(
    'ブログ'=>array(
      '投稿一覧'=>array('plugin'=>'blog','controller'=>'operation','action'=>'blog_list'),
      'コメント・TB一覧'=>array('plugin'=>'blog','controller'=>'operation','action'=>'comment_list'),
      'ブログカテゴリー一覧'=>array('plugin'=>'blog','controller'=>'operation','action'=>'category_list'),
      'ブログ設定'=>array('plugin'=>'blog','controller'=>'operation','action'=>'settings')
    )
  );

  function beforeFilter(){

    //共通設定の読み込み
    $this->_loadCommonValues();
  }
}

?>