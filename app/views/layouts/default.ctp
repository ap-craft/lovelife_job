<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title_for_layout?></title>
<meta name="description"content="<?php e($Settings['seo_description'])?>">
<meta name="keywords"content="<?php e($Settings['seo_keywords'])?>">
<meta name="robots" content="index,follow">
<?php e($javascript->link('mootools')) ?>
<?php e($html->css('style')) ?>

<?php e($manjuuHtml->pluginCss()) ?>

<?php e($Settings['addtional_head'])?>
</head>

<body>

<div class="container">
	
	<div class="main">

		<div class="header">
		
			<div class="title">
				<h1><?php e($Settings['site_name'])?></h1>
			</div>
			<div class="subtitle">
				<h2><?php e($Settings['subtitle'])?></h2>
			</div>			
		</div>
		
		<div class="content" id="<?php e($plugin_name) ?>">
			<?php echo $content_for_layout ?>
		</div>

		<div class="sidenav">
			
			<h1><?php e($manjuuHtml->link('トップページへ','/')) ?></h1>
			
    		<?php foreach($menu as $link) { 
    			$url = $link['Page']['url'];
    			$title = $link['Page']['title'];
    			$type = $link['Page']['type'];
    		?>
    			<h1><?php e($manjuuHtml->pageLink($title,$url,$type)) ?></h1>
    			
				<?php if(isset($link['SubPages']) && count($link['SubPages']) > 0)  { ?>
					<ul>
						<?php foreach($link['SubPages'] as $sub_link) { 
							$url = $sub_link['url'];
							$title = $sub_link['title'];
							$type = $sub_link['type'];
						?>
							<li><?php e($manjuuHtml->pageLink($title,$url,$type)) ?></li>
						<?php } ?>
					</ul>
				<?php } ?>
	
    		<?php } ?>

			<?php if(isset($rss1)) e($rss1) ?>
				
			<h1>Search</h1>
			<form action="index.html">
			<div>
				<input type="text" name="search" class="styled" /> <input type="submit" value="" class="button" />
			</div>
			</form>

		</div>
	
		<div class="clearer"><span></span></div>

	</div>

	<div class="footer">
		poered by <a href="http://www.manjuu.com">manjuuCMS</a>
	</div>

</div>

</body>

</html>