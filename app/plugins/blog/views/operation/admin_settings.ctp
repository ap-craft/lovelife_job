<h1>サイト設定</h1>

ここでサイトの設定を行います。

<?php echo $form->create('Setting',array(
	'url' => array(
		'controller'=>'operation',
		'action' => 'settings'
		),
	'type'=>'post'
	)
);?>


	<?php echo $form->input('blog.name',array(
		'error' => array(
			'required' 	=> '必須項目です。',
		),
		'type'=>'text',
		'size'=>40,
		'label'=>'サイト名'
		)
	); 
	?>

	<?php echo $form->input('blog.author',array(
		'error' => array(
			'required' 	=> '必須項目です。',
		),
		'type'=>'text',
		'size'=>40,
		'label'=>'著者名'
		)
	); 
	?>

	<?php echo $form->input('blog.description',array(
		'type'=>'textarea',
		'label'=>'ブログ説明文'
		)
	); 
	?>
	
	<?php echo $form->input('blog.pings',array(
		'type'=>'textarea',
		'label'=>'ping送信先'
		)
	); 
	?>
	<div class="form_note">改行で切って複数のURLを指定可能です。</div>

<?php echo $form->end('編集する') ?>