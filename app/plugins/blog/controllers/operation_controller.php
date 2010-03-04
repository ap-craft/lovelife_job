<?php

class OperationController extends BlogAppController
{
    var $name = 'Operation';
  var $uses = array('Blog.Article','Blog.Comment','Blog.Category','Setting','Blog.Trackback');

  function admin_settings(){

    $message = "";

    if(!empty($this->data)){

      $this->Setting->create($this->data);
      $this->Setting->validates();

      $validationResult = $this->Setting->validationErrors;

      if (empty($validationResult)) {

        $hash = $this->data['blog'];

        foreach($hash as $key => $value){
          $this->Setting->setValue('blog.' . $key,$value);
        }

        $message = "設定が完了しました。";
      }
    }else{
      $tmp = $this->Setting->readAllValue();
      foreach($tmp as $key => $value){
        if(ereg('blog',$key)){
          $key = str_replace('blog.','',$key);
          $this->data['blog'][$key] = $value;
        }
      }
    }

    $this->Session->write("message",$message);

  }

  function admin_blog_list($page = 1) {
    $articles = $this->Article->findAll(" type=1 ",null,"Article.created",$this->admin_num_rows,$page);
    $count = $this->Article->findCount();
    $this->set("articles",$articles);

    //ページング関連の処理
    $this->set('pages',ceil($count / $this->admin_num_rows));
    $this->set('page',$page);
    $this->set('page_url','/admin/blog/operation/blog_list/');
  }

  function admin_blog_new() {
    $message = "";

    $this->set("categories",$this->Category->find('list'));

    if(!empty($this->data)){

      $this->Article->create($this->data);
      $this->Article->validates();

      $validationResult = $this->Article->validationErrors;

      if (empty($validationResult)) {

        $trackback_urls = trim($this->data['Article']['trackback']);
        unset($this->data['Article']['trackback']);

        $this->data['Article']['created'] = date("Y-m-d H:i:s");
        $this->data['Article']['type'] = 1;

        if($this->Article->save($this->data)){
          $message .= "新規記事を保存しました。\n";
        }else{
          $message .= "記事の保存に失敗しました。\n";
        }

        // get information for trackback and ping
        $blog_name = $this->Setting->getValue('blog.name');
        $blog_author = $this->Setting->getValue('blog.author');
        $permalink = HOST . $this->base . '/blog/entry/' . $this->data['Article']['url'];
        $rss_link = HOST . $this->base . '/blog/rss';


        // send trackback
        if(!empty($trackback_urls)){

          //load trackback class
          App::import('Vendor', 'trackback',array('file' => 'trackback.php'));

          $urls = explode("\n",$trackback_urls);

          $content = strip_tags($this->data['Article']['content']);
          $content = mb_substr($content,0,100);

          if(count($urls) > 0){
            $trackback = new Trackback($blog_name,$blog_author,Configure::read('App.encoding'));

            foreach($urls as $url){
              if ($trackback->ping($url,$permalink,$this->data['Article']['title'],$content)) {
                $message .= "{$url}にトラックバックを送信しました。\n";
              } else {
                $message .= "{$url}にトラックバックは送信できませんでした。\n";
              }
            }
          }
        }

        $pings = explode("\n",$this->Setting->getValue('blog.pings'));

        if(!empty($pings)){

          App::import('Vendor', 'weblog_pinger',array('file' => 'weblog_pinger.php'));
          App::import('Vendor', 'xmlrpc',array('file' => 'xmlrpc.inc'));

          foreach($pings as $url){

            if(!empty($url)){
              $pinger = new Weblog_Pinger();

              $blog_name = urlencode($blog_name);

              //メジャーな所に送っておく。
              $ping_result = $pinger->ping_all(trim($url),$blog_name,$permalink);
              $this->log("ping result : \n" . var_export($ping_result,true) , LOG_DEBUG);

              $ping_result = $pinger->simplePing(trim($url),$blog_name,$permalink,"","",$rss_link);
              $this->log("ping result : \n" . var_export($ping_result,true) , LOG_DEBUG);

              if (!is_array($ping_result)){
                $message .= "{$url}にPingを送信しました。<br />\n";
              }else{
                $message .= "{$url}にPing送信に失敗しました。<br />\n";
              }
            }
          }
        }

        $this->Session->write("message",$message);
        $this->redirect(array('controller'=>'operation','action'=>'blog_list'));
      }

    }
  }

  function admin_blog_edit($id=null){
    $message = "";

    $this->set("categories",$this->Category->find('list'));

    if(empty($this->data))
      $this->data = $this->Article->findById($id);
    else{

      $this->Article->create($this->data);
      $this->Article->validates();

      $validationResult = $this->Article->validationErrors;

      if(!empty($validationResult['url']) && $validationResult['url'] == 'unique'){
        $article = $this->Article->findByUrl($this->data['Article']['url']);
        if($article['Article']['id'] == $this->data['Article']['id']){
          unset($validationResult['url']);
        }
      }

      if (empty($validationResult)) {

        //差分のデータを取得
        $old_data = $this->Article->findById($this->data['Article']['id']);
        $this->data['Article']['modified'] = date("Y-m-d H:i:s");

        $merged_data = am($old_data['Article'],$this->data['Article']);

        if($this->Article->save($merged_data)){
          $message .= "記事を変更しました。";
        }else{
          $message .= "記事の変更に失敗しました。";
        }

        $this->Session->write("message",$message);
        $this->redirect(array('controller'=>'operation','action'=>'blog_list'));
      }else{

      }

    }

  }

  function admin_blog_delete($id) {

    $message = "";

    if(!empty($id)){
      if($this->Article->delete($id)){
        $message .= "記事を削除しました。";
      }else{
        $message .= "削除に失敗しました。";
      }

      $this->Session->write("message",$message);
      $this->redirect(array('controller'=>'operation','action'=>'blog_list'));
    }
  }

  function admin_category_list() {
    $this->set("categories",$this->Category->findAll(null,null,"Category.created"));
  }

  function admin_category_new() {
    if(!empty($this->data)){

      $this->Category->create($this->data);
      $this->Category->validates();

      $validationResult = $this->Category->validationErrors;

      if (empty($validationResult)) {

        $this->data['Category']['created'] = date("Y-m-d H:i:s");

        $this->Category->save($this->data);
        $this->redirect(array('controller'=>'operation','action'=>'category_list'));
      }

    }
  }

  function admin_category_edit($id=null){

    if(empty($this->data))
      $this->data = $this->Category->findById($id);
    else{

      $this->Category->create($this->data);
      $this->Category->validates();

      $validationResult = $this->Category->validationErrors;

      if(!empty($validationResult['url']) && $validationResult['url'] == 'unique'){
        $category = $this->Category->findByUrl($this->data['Category']['url']);
        if($category['Category']['id'] == $this->data['Category']['id']){
          unset($validationResult['url']);
        }
      }

      if (empty($validationResult)) {

        $this->data['Category']['modified'] = date("Y-m-d H:i:s");

        $this->Category->save($this->data,false);
        $this->redirect(array('controller'=>'operation','action'=>'category_list'));
      }else{

      }

    }
  }

  function admin_category_delete($id=null){
    if(!empty($id)){
      $this->Category->delete($id);
      $this->redirect(array('controller'=>'operation','action'=>'category_list'));
    }
  }

  //コメント関連
  function admin_comment_list($article_id = 0) {
    $where = '';

    if($article_id != 0)
      $where = " article_id= {$article_id} ";

    $comments = $this->Comment->findAll($where,null,"Article.created");
    $trackbacks = $this->Trackback->findAll($where,null,"Article.created");

    $replies = array();

    foreach($comments as $comment){
      $comment['Comment']['type'] = 'comment';
      $comment['Comment']['article_title'] = $comment['Article']['title'];
      $replies[] = $comment['Comment'];
    }

    foreach($trackbacks as $trackback){
      $trackback['Trackback']['type'] = 'trackback';
      $trackback['Trackback']['article_title'] = $trackback['Article']['title'];
      $replies[] = $trackback['Trackback'];
    }

    $this->set('replies',$replies);
    $this->set('article_id',$article_id);
  }

  function admin_comment_delete($id,$article_id = null) {

    $message = "";

    if(!empty($id)){
      if($this->Comment->delete($id)){
        $message .= "コメントを削除しました。";
      }else{
        $message .= "コメント削除に失敗しました。";
      }

      $this->Session->write("message",$message);
      $this->redirect(array('controller'=>'operation','action'=>'comment_list',$article_id));
    }
  }

  function admin_trackback_delete($id,$article_id = null) {

    $message = "";

    if(!empty($id)){
      if($this->Trackback->delete($id)){
        $message .= "トラックバックを削除しました。";
      }else{
        $message .= "トラックバック削除に失敗しました。";
      }

      $this->Session->write("message",$message);
      $this->redirect(array('controller'=>'operation','action'=>'comment_list',$article_id));
    }
  }

  function admin_comment_accept($id,$article_id = null){
    $this->Comment->accept($id);
    $this->Session->write("message",'コメントを承認しました。');
    $this->redirect(array('controller'=>'operation','action'=>'comment_list',$article_id));
  }

  function admin_comment_deny($id,$article_id = null){
    $this->Comment->deny($id);
    $this->Session->write("message",'コメントを非承認にしました。');
    $this->redirect(array('controller'=>'operation','action'=>'comment_list',$article_id));
  }

  function admin_trackback_accept($id,$article_id = null){
    $this->Trackback->accept($id);
    $this->Session->write("message",'トラックバックを承認しました。');
    $this->redirect(array('controller'=>'operation','action'=>'comment_list',$article_id));
  }

  function admin_trackback_deny($id,$article_id = null){
    $this->Trackback->deny($id);
    $this->Session->write("message",'トラックバックを非承認にしました。');
    $this->redirect(array('controller'=>'operation','action'=>'comment_list',$article_id));
  }
}

?>