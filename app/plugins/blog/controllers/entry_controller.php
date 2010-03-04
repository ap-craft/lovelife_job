<?php

class EntryController extends BlogAppController
{
    var $name = 'Entry';
	var $uses = array('Blog.Article','Blog.Comment');
	
	//ブログの記事ページ
    function index($url = '')
    {
    	if(isset($this->data)){
    		
			//コメントがあった場合
			$this->Comment->create($this->data);
			$this->Comment->validates();
			
			$validationResult = $this->Comment->validationErrors;
			
			if (empty($validationResult)) {
				$this->data['Comment']['created'] = date("Y-m-d H:i:s");
				$this->Comment->save($this->data);
				
				$this->set('message','コメントを受け付けました。承認された時点で表示されます。');
			}
    	}
    	
		if($url == '')
			$this->render('/general/nopage');

		$article = $this->Article->findByUrl($url);
		
		$tb_url = HOST . $this->base . '/blog/tb/' . $url;
		$this->set('tb_url',$tb_url);
		
		if(!isset($article['Article']))
			$this->render('/general/nopage');
		
		//アクセス数をアップデート
		$this->Article->showed($article['Article']['id']);
		
		$this->set("post",$article);
		
		//タイトルの設定
		$this->pageTitle = $article['Article']['title'] . ' - ' . $this->pageTitle;
		
		//スパム対策用の数字を決定
		$this->_setMagicWord();
    }
}
?>