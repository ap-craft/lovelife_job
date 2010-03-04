<?php

class TopController extends BlogAppController
{
    var $name = 'Top';
	var $uses = array('Blog.Article');
	
    function index($page = 1)
    {
    	$articles = $this->Article->findAll(null,null," created desc",$this->num_posts,$page);
		$this->set("articles",$articles);
	
		$count = $this->Article->findCount();
		//ページング関連の処理
		$this->set('pages',ceil($count / $this->num_posts));
		$this->set('page',$page);
		$this->set('page_url','/blog/top/');
    }
}

?>