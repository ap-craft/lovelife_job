<script language="javascript">

	function deletePost(id){
		password = prompt('パスワードを入力してください。','');
		if(password){
			$('pass_' + id).value = password;
			$('form_' + id).submit();
		}
	}
	
	function deleteThread(){
		password = prompt('パスワードを入力してください。','');
		if(password){
			$('thread_pass').value = password;
			$('thread_form').submit();
		}
	}
	
</script>

<h1><?php e(h($thread['Thread']['name'])) ?></h1>

<div id="description">
	<?php e(h($thread['Thread']['description'])) ?>
</div>

<?php foreach($posts as $post) { ?>
<div class="post">
	<div class="name">
		<?php e(h($post['Post']['name'])) ?> on 
		<span class=""><?php e(h(date('Y/m/d H:i:s',strtotime($post['Post']['created'])))) ?></span>
	</div>
	<div class="body">
		<?php e(h($post['Post']['body'])) ?>
	</div>
	<div class="password">
		<?php echo $manjuuForm->create('Post',array(
			'url' => array(
				'controller'=>'thread',
				'action'=>'post_del',
				'plugin'=>'forum',
				$this->data['Post']['thread_id']
			),
			'type'=>'post',
			'style'=>'display: none',
			'id'=>'form_' . $post['Post']['id']
			)
		);?>
	
		<?php echo $manjuuForm->input('password',array('type'=>'hidden','id'=>'pass_' . $post['Post']['id'])); ?>
		<?php echo $manjuuForm->input('id',array('type'=>'hidden','value'=>$post['Post']['id'])); ?>
		<?php echo $manjuuForm->input('thread_id',array('type'=>'hidden','value'=>$post['Post']['thread_id'])); ?>
		<?php echo $manjuuForm->end('削除') ?>
		<a href="javascript:deletePost(<?php e($post['Post']['id']) ?>)">削除</a>
		<div style="clear: both"></div>
	</div>
</div>
<?php } ?>

<?php echo $this->renderElement('paginator'); ?>

<div class="right_aligned">
	<?php e($manjuuHtml->link('投稿',array('controller'=>'thread','action'=>'post_new','plugin'=>'forum',$thread_id))) ?><br />

	<?php echo $manjuuForm->create('Thread',array(
		'url' => array(
			'controller'=>'thread',
			'action'=>'thread_del',
			'plugin'=>'forum'
		),
		'type'=>'post',
		'style'=>'display: none',
		'id'=>'thread_form'
		)
	);?>

	<?php echo $manjuuForm->input('password',array('type'=>'hidden','id'=>'thread_pass')); ?>
	<?php echo $manjuuForm->input('id',array('type'=>'hidden','value'=>$thread['Thread']['id'])); ?>
	<?php echo $manjuuForm->end('削除') ?>
	
	<a href="javascript:deleteThread()">このスレッドを削除する</a>
</div>