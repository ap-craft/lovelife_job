<?php

class OperationController extends ForumAppController
{
	var $name = 'Operation';
	var $uses = array('Forum.Thread','Forum.Post');
		
	function admin_thread_list($page = 1) {
		
		//掲示板一覧を取得
		$threads = $this->Thread->findAll(null,null," Thread.created",$this->admin_num_rows,$page);
		$count = $this->Thread->findCount();
		$this->set("threads",$threads);

		//ページング関連の処理
		$this->set('pages',ceil($count / $this->admin_num_rows));
		$this->set('page',$page);
		$this->set('page_url','/admin/forum/operation/thread_list');
	}

	function admin_thread_delete($id) {
		
		$message = "";
		
		if(!empty($id)){
			if($this->Thread->delete($id)){
				$message .= "スレッドをを削除しました。";
			}else{
				$message .= "削除に失敗しました。";
			}
			
			$this->Session->write("message",$message);
			$this->redirect(array('plugin'=>'forum','controller'=>'operation','action'=>'thread_list'));
		}
	}
	
	function admin_post_list($thread_id = 0,$page = 1){
		
		if($thread_id == 0)
			$this->redirect(array('plugin'=>'forum','controller'=>'operation','action'=>'thread_list'));
		
		$thread = $this->Thread->findById($thread_id);
		
		if(!isset($thread['Thread']))
			$this->redirect(array('plugin'=>'forum','controller'=>'operation','action'=>'thread_list'));
		
		$posts = $this->Post->findAll(" thread_id = {$thread_id} ",null," Post.created",$this->admin_num_rows,$page);
		$count = $this->Post->findCount(" thread_id = {$thread_id} ");
		$this->set("posts",$posts);

		//ページング関連の処理
		$this->set('pages',ceil($count / $this->admin_num_rows));
		$this->set('page',$page);
		$this->set('page_url','/admin/forum/operation/post_list/' . $thread_id . '/');
		
	}
	
	function admin_post_delete($thread_id,$id){
		$message = "";
		
		if(!empty($id)){
			if($this->Post->delete($id)){
				$message .= "発言をを削除しました。";
			}else{
				$message .= "削除に失敗しました。";
			}
			
			$this->Session->write("message",$message);
			$this->redirect(array('plugin'=>'forum','controller'=>'operation','action'=>'post_list',$thread_id));
		}
	}
}

?>