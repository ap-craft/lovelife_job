<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>まんじゅうCMS - 管理画面</title>

<?php echo $html->css('style_admin'); ?>
<?php echo $javascript->link('openwysiwyg/scripts/wysiwyg'); ?>
<?php echo $javascript->link('openwysiwyg/scripts/wysiwyg-settings'); ?>

<script language="javascript">
	full.ImagePopupFile = "<?php e($html->base) ?>/js/openwysiwyg/addons/imagelibrary/insert_image.php";
	full.ImagesDir = "<?php e($html->base) ?>/js/openwysiwyg/images/";
	full.PopupsDir = "<?php e($html->base) ?>/js/openwysiwyg/popups/";
	full.CSSFile = "<?php e($html->base) ?>/js/openwysiwyg/styles/wysiwyg.css";
	full.Width = "90%"; 
	full.Height = "500px";
	
	//ImageLibraryに渡す変数
	var session_id = '<?php e(session_id()) ?>';
	var session_name = '<?php e(session_name()) ?>';
</script>

</head>

<body>
	
	<div id="container">
		<div id="header">
			<h1>管理画面 - まんじゅうCMS</h1>
		</div>
		<div id="header_underline">
			
		</div>
		<div id="leftnav">
		
			<div id="admin_menu">
				<div id="admin_menu_top"></div>
				<div id="admin_menu_content">
				
					<h2>リンク</h2>
					<ul>
						<li><a href="<?php e($html->base) ?>/">&raquo;&nbsp;トップへ戻る</a></li>
						<li><a href="<?php e($html->base) ?>/admin">&raquo;&nbsp;管理画面トップ</a></li>
					</ul>
										
					<h2>ページ管理</h2>
					<ul>
						<li><a href="<?php e($html->base) ?>/admin/page">&raquo;&nbsp;ページ一覧</a></li>
					</ul>
					<?php foreach($additional_menu as $key => $value) { ?>
						<h2><?php e($key,false) ?></h2>
						<ul>
							<?php foreach($value as $name => $url) { ?>
								<li><?php e($html->link('&raquo;&nbsp;' . $name,$url,false,false,false)) ?></li>
							<?php } ?>
						</ul>
					<?php } ?>
					
					<h2>サイト設定</h2>
					<ul>
						<li><a href="<?php e($html->base) ?>/admin/settings">&raquo;&nbsp;サイト設定</a></li>
					</ul>
				</div>
				<div id="admin_menu_bottom"></div>
			</div>
			
		</div>
		<div id="content">
			<?php 
				if(isset($message))
					print ('<div class="message">' . $message . '</div>');
			?>
			<?php echo $content_for_layout ?>
		</div>
		<div id="footer">
			Footer
		</div>
	</div>
	
</body>