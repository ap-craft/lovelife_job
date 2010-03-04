<?php

class CategoryController extends BlogAppController
{
    var $name = 'Category';
	var $uses = array('Blog.Article','Blog.Comment','Blog.Category');
	
    function index($url = '',$page = 1)
    {
		
		if($url == '')
			$this->render('/general/nopage');

		$category = $this->Category->findByUrl($url);
		
		if(!isset($category['Category']))
			$this->render('/general/nopage');
		
		$articles = $this->Article->findAll("category_id = {$category['Category']['id']}",null,'Article.created desc',$this->num_posts,$page);
		
		$this->set('category',$category);
		$this->set('articles',$articles);
		
		$count = $this->Article->findCount("category_id = {$category['Category']['id']}");
		//ページング関連の処理
		$this->set('pages',ceil($count / $this->num_posts));
		$this->set('page',$page);
		$this->set('page_url',"/blog/category/{$url}/");

    }
}
?>