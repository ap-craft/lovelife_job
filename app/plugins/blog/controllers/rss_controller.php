<?php

class RssController extends BlogAppController
{
    var $name = 'Rss';
	var $uses = array('Blog.Article');
	var $helpers = array('rss');
	
	function index() {
		
		$this->layoutPath = 'rss';
		
		$article = $this->Article->findAll(null,null,"Article.created desc",15);
		
		$this->set('article',$article);
		
		$this->set('channel',array(
		
			'title' => $this->settings['blog.name'],
			'link' => HOST . $this->base . '/blog/rss',
			'description' => $this->settings['blog.description'])
			
		);

	}
	
	function category($url = ''){
		
		$this->layoutPath = 'rss';

		if($url == '')
			$this->redirect(array('plugin'=>'blog','controller'=>'rss','action'=>'index'));

		$category = $this->Category->findByUrl($url);
		
		if(!isset($category['Category']))
			$this->redirect(array('plugin'=>'blog','controller'=>'rss','action'=>'index'));
		
		$article = $this->Article->findAll("category_id = {$category['Category']['id']}",null,"Article.created desc",15);

		$this->set('article',$article);
		
		$this->set('channel',array(
		
			'title' => $this->settings['blog.name'],
			'link' => HOST . $this->base . '/blog/rss',
			'description' => $this->settings['blog.description'])
			
		);
		
		$this->render('index');
	}
}

?>