<h1>RSSの追加</h1>

<?php echo $form->create('SidebarRss.Rss',array(
	'url' => array(
		'controller'=>'operation',
		'action' => 'new'
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
		'label'=>'タイトル'
		)
	); 
	?>
	
	<?php echo $form->input('url',array(
		'error' => array(
			'required' 	=> 	'必須項目です。',
		),
		'type'=>'text',
		'size'=>40,
		'label'=>'RSSのURL'
		)
	); 
	?>

	<?php echo $form->input('id',array(
		'type'=>'hidden',
		)
	); 
	?>
<?php echo $form->end('編集する') ?>