<h1>サイト設定</h1>

<?php echo $form->create('Setting',array(
	'url' => array(
		'controller'=>'settings',
		'action' => 'index'
		),
	'type'=>'post'
	)
);?>
	<?php echo $form->input('site_name',array(
		'error' => array(
			'required' 	=> '必須項目です。',
		),
		'type'=>'text',
		'size'=>40,
		'label'=>'サイト名',
		)
	); 
	?>

	<?php echo $form->input('subtitle',array(
		'error' => array(
			'required' 	=> '必須項目です。',
		),
		'type'=>'text',
		'size'=>40,
		'label'=>'サイト副題',
		)
	); 
	?>
	
	<?php echo $form->input('seo_keywords',array(
		'type'=>'text',
		'size'=>40,
		'label'=>'キーワード',
		)
	); 
	?>
	
	<?php echo $form->input('seo_description',array(
		'type'=>'text',
		'size'=>40,
		'label'=>'デスクリプション',
		)
	); 
	?>

	<?php echo $form->input('addtional_head',array(
		'type'=>'textarea',
		'size'=>40,
		'label'=>'&lt;haed&gt;内追加要素',
		)
	); 
	?>

	<?php echo $form->input('last_line',array(
		'type'=>'textarea',
		'size'=>40,
		'label'=>'&lt;/body&gt;直前要素',
		)
	); 
	?>
	
	<div class="form_note">※Javascriptのコードやアクセス解析のコードなど</div>

	<?php echo $form->input('use_wysiwsg',array(
		'type'=>'checkbox',
		'value'=>'1',
		'label'=>'WYSIWYGエディタをつかう',
		)
	); 
	?>
<?php echo $form->end(array('label'=>'設定する')) ?>