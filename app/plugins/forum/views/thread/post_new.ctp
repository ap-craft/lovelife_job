<h1>投稿</h1>

	<?php echo $manjuuForm->create('Post',array(
		'url' => array(
			'controller'=>'thread',
			'action'=>'post_new',
			'plugin'=>'forum',
			$this->data['Post']['thread_id']
		),
		'type'=>'post'
		)
	);?>

	<?php echo $manjuuForm->input('name',array(
		'error' => array(
			'required' 	=> '必須項目です。',
		),
		'type'=>'text',
		'size'=>40,
		'label'=>'名前'
		)
	); 
	?>

	<?php echo $manjuuForm->input('body',array(
		'error' => array(
			'required' 	=> '必須項目です。',
		),
		'type'=>'textarea',
		'label'=>'本文'
		)
	); 
	?>

	<?php echo $manjuuForm->input('password',array(
		'error' => array(
			'required' 	=> '必須項目です。',
			'alphaNumeric' => '半角英数字のみで書いてください。',
		),
		'type'=>'text',
		'size'=>40,
		'label'=>'パスワード'
		)
	); 
	?>
	
	<?php echo $manjuuForm->input('magic_number',array(
		'error' => array(
			'wrong_answer' 	=> '答えがちがいます。',
		),
		'type'=>'select',
		'label'=>$question,
		'options'=>$option_spam,
		)
	); 
	?>
	<div class="form_note">※これはスパム対策です。答えの数字を選んでください。</div>

<?php echo $manjuuForm->input('thread_id',array('type'=>'hidden')); ?>
<?php echo $manjuuForm->end('投稿する') ?>