<h1>カテゴリー別記事</h1>
<ul id="category_list">
<?php if(isset($categories)) { foreach($categories as $category) { ?>
	<li>
		<?php e($manjuuHtml->link($manjuuText->truncate(h($category['Category']['name'])),HOST . $manjuuHtml->base . '/blog/category/' . $category['Category']['url'])) ?>
	</li>
<?php }} ?>
</ul>