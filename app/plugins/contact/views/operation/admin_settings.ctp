<h1>コンタクトフォーム設定</h1>

ここでのコンタクトフォームの設定を行います。

<?php echo $form->create('Setting',array(
	'url' => array(
		'controller'=>'operation',
		'action' => 'settings'
		),
	'type'=>'post'
	)
);?>


	<?php echo $form->input('contact.emailaddress',array(
		'error' => array(
			'required' 	=> '必須項目です。',
		),
		'type'=>'text',
		'size'=>40,
		'label'=>'送信先メールアドレス'
		)
	); 
	?>

<?php echo $form->end('設定する') ?>