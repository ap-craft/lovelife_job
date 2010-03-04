<script type="text/javascript">
<?php if($Settings['use_wysiwsg'] == 1) { ?>
	WYSIWYG.attach('page_content',full); // default setup
<?php } ?>
</script>

<h1>ページの編集</h1>

すでに存在する記事を編集します。

<?php echo $form->create('Page',array(
	'url' => array(
		'controller'=>'page',
		'action' => 'edit'
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
	※ページ種がリンクページの場合は、リンク先のURLとなります。

	<?php echo $form->input('sort',array(
		'error' => array(
			'required' 	=> 	'必須項目です。',
			'numeric'	=>	'数字のみで入力してください。',
		),
		'type'=>'text',
		'size'=>40,
		'label'=>'ソート番号'
		)
	); 
	?>

	<?php echo $form->input('type',array(
		'error' => array(
			'required' 	=> 	'必須項目です。',
		),
		'label'=>'ページ種類',
		'options'=>$page_types
		)
	); 
	?>

	<?php echo $form->input('parent_id',array(
		'error' => array(
			'required' 	=> 	'必須項目です。',
		),
		'label'=>'親記事',
		'options'=>$parents
		)
	); 
	?>
		
	<?php echo $form->input('content',array(
		'error' => array(
			'required' 	=> '必須項目です。',
		),
		'type'=>'textarea',
		'label'=>'本文',
		'class'=>'text_entry_box',
		'id'=>'page_content'
		)
	); 
	?>
	

	<?php echo $form->input('id',array('type'=>'hidden'));?>
<?php echo $form->end('編集する') ?>