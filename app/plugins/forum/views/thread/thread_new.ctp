<h1>新規掲示板の作成</h1>

	<?php echo $manjuuForm->create('Thread',array(
		'url' => array(
			'controller'=>'thread',
			'action'=>'thread_new',
			'plugin'=>'forum'
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
		'label'=>'タイトル'
		)
	); 
	?>

	<?php echo $manjuuForm->input('description',array(
		'error' => array(
			'required' 	=> '必須項目です。',
		),
		'type'=>'textarea',
		'label'=>'説明文'
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

<?php echo $manjuuForm->end('新規作成') ?>