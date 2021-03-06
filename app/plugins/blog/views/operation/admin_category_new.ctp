<h1>カテゴリーの追加</h1>

新しいカテゴリーを追加します。カテゴリー名は、日本語でのカテゴリーの名前を入力してください。
URL用の認識名とは、そのカテゴリーの一覧を表示する際のURLです。半角英数字のみで入力してください。

<?php echo $form->create('Blog.Category',array(
	'url' => array(
		'controller'=>'operation',
		'action' => 'category_new'
		),
	'type'=>'post'
	)
);?>


	<?php echo $form->input('name',array(
		'error' => array(
			'required' 	=> '必須項目です。',
		),
		'type'=>'text',
		'size'=>40,
		'label'=>'カテゴリー名'
		)
	); 
	?>
	
	<?php echo $form->input('url',array(
		'error' => array(
			'required' 	=> 	'必須項目です。',
			'rule1' 	=> 	'半角英数字のみを入力してください。',
			'rule2' 	=> 	'最低5文字以上で入力してください。',
			'unique'	=>	'既に存在しているURLです。',
		),
		'type'=>'text',
		'size'=>40,
		'label'=>'URL用の認識名'
		)
	); 
	?>
		
<?php echo $form->end('追加する') ?>