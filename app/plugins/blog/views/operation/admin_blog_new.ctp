<script type="text/javascript">
<?php if($Settings['use_wysiwsg'] == 1) { ?>
	WYSIWYG.attach('blog_content',full); // default setup
<?php } ?>
</script>

<h1>新規記事の追加</h1>

新しい記事を追加します。

<?php echo $form->create('Article',array(
	'url' => array(
		'controller'=>'operation',
		'action' => 'blog_new'
		),
	'type'=>'post'
	)
);?>


	<?php echo $form->input('title',array(
		'error' => array(
			'required' 	=> '必須項目です。',
		),
		'type'=>'text',
		'size'=>40,
		'label'=>'タイトル'
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
	
	<?php echo $form->input('category_id',array(
		'error' => array(
			'required' 	=> '必須項目です。',
		),
		'type'=>'select',
		'label'=>'カテゴリー',
		'options'=>$categories
		)
	); 
	
	?>	
	
	<?php echo $form->input('trackback',array(
		'type'=>'textarea',
		'label'=>'トラックバックURL'
		)
	); 
	?>
	<div class="form_note">改行で切って複数のURLを指定可能です。</div>


	<?php echo $form->input('content',array(
		'error' => array(
			'required' 	=> '必須項目です。',
		),
		'type'=>'textarea',
		'label'=>'本文',
		'class'=>'text_entry_box',
		'id'=>'blog_content'
		)
	); 
	?>
<?php echo $form->end('追加する') ?>