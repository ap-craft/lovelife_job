<h1>コンタクトフォーム</h1>

ご質問等はここから承ります。

	<?php echo $manjuuForm->create('ContactForm',array(
		'url' => array(
			'controller'=>'index',
			'action'=>'index',
			'plugin'=>'contact'
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
		'label'=>'お名前'
		)
	); 
	?>

	<?php echo $manjuuForm->input('email',array(
		'error' => array(
			'required' 	=> '必須項目です。',
			'email' 	=> '有効なメールアドレスではありません。',
		),
		'type'=>'text',
		'size'=>40,
		'label'=>'返信先メールアドレス'
		)
	); 
	?>
	
	<?php echo $manjuuForm->input('contact',array(
		'error' => array(
			'required' 	=> '必須項目です。',
		),
		'type'=>'textarea',
		'label'=>'お問合せ内容'
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

<?php echo $manjuuForm->end('送信する') ?>