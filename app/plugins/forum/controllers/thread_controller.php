<?php

class ThreadController extends ForumAppController
{
    var $name = 'Thread';
	var $uses = array('Forum.Thread','Forum.Post');

    function index()
    {
    	//掲示板一覧を取得
    	$threads = $this->Thread->findAll(null,null," Thread.modified desc",$this->num_posts,1);
		$this->set("threads",$threads);
    }
    
    function thread_new() {
    	
       	if(isset($this->data)){

			$this->Thread->create($this->data);
			$this->Thread->validates();
			
			$validationResult = $this->Thread->validationErrors;
			
			if (empty($validationResult)) {
				$this->data['Thread']['created'] = date("Y-m-d H:i:s");
				$this->data['Thread']['modified'] = date("Y-m-d H:i:s");
				$this->Thread->save($this->data);
				
				$this->redirect(array('controller'=>'thread','action'=>'index','plugin'=>'forum'));
			}
    	}
    	
		//スパム対策用の数字を決定
		$this->_setMagicWord();
	}

	function thread_del(){
		
		if(isset($this->data)){
			if(!isset($this->data['Thread']['id'])){
				$this->_redirectTop();
			}
			
			$thread_id = $this->data['Thread']['id'];
			
			$thread = $this->Thread->findById($thread_id);
			
			if(!isset($thread['Thread'])){
				$this->_redirectTop();
			}

			if($thread['Thread']['password'] == $this->data['Thread']['password']){
				$this->Thread->delete($thread_id);
				
				//投稿も全て削除
				$this->Post->delAll($thread_id);
				$this->_setMessage('投稿を削除しました。');
				$this->_redirectTop();
			}else{
				$this->_setMessage('パスワードが違います。');
				$this->_redirectTop();
			}
		}
	}
	
	function show($thread_id = 0,$page = 1) {
		
		if($thread_id != 0){
			$this->set('thread_id',$thread_id);
		}else{
			$this->_redirectTop();
		}
		
		$thread = $this->Thread->findById($thread_id);
		
		if(!isset($thread['Thread']))
			$this->_redirectTop();
			
		//投稿内容の読み込み
		$posts = $this->Post->findAll(" Post.thread_id = {$thread_id}",null," Post.created desc",$this->num_posts,$page);
		$count = $this->Post->findCount(" Post.thread_id = {$thread_id}");
		
		$this->set('thread',$thread);
		$this->set('posts',$posts);

		//ページング関連の処理
		$this->set('pages',ceil($count / $this->num_posts));
		$this->set('page',$page);
		$this->set('page_url',"/forum/thread/show/{$thread_id}/");
	}

    function post_new($thread_id = 0) {
    	
    	if($thread_id != 0){
	       	if(isset($this->data)){
	
				$this->Post->create($this->data);
				$this->Post->validates();
				
				$validationResult = $this->Post->validationErrors;
				
				if (empty($validationResult)) {
					$this->data['Post']['created'] = date("Y-m-d H:i:s");
					$this->data['Post']['modified'] = date("Y-m-d H:i:s");
					$this->Post->save($this->data);
					
					//スレッドの最終更新日時を変更
					$this->Thread->updateDate($thread_id);
					$this->redirect(array('plugin'=>'forum','controller'=>'thread','action'=>'show',$thread_id));
				}
	    	}else{
	    		$this->data['Post']['thread_id'] = $thread_id;
	    	}
	    	
			//スパム対策用の数字を決定
			$this->_setMagicWord();
    	}else{
    		$this->_redirectTop();
    	}
	}
	
	function post_del(){
		
		if(isset($this->data)){
			if(!isset($this->data['Post']['id']) || !isset($this->data['Post']['thread_id'])){
				$this->_redirectTop();
			}
			
			$post_id = $this->data['Post']['id'];
			$thread_id = $this->data['Post']['thread_id'];
			
			
			$post = $this->Post->findById($post_id);
			
			if(!isset($post['Post'])){
				$this->_redirectTop();
			}

			if($post['Post']['password'] == $this->data['Post']['password']){
				$this->Post->delete($post_id);
				$this->_setMessage('投稿を削除しました。');
				$this->redirect(array('plugin'=>'forum','controller'=>'thread','action'=>'show',$thread_id));
			}else{
				$this->_setMessage('パスワードが違います。');
				$this->redirect(array('plugin'=>'forum','controller'=>'thread','action'=>'show',$thread_id));
			}
		}
	}
}

?>