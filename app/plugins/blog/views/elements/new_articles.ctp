<h1>ブログ最新記事一覧</h1>
<ul id="new_articles">
<?php if(isset($new_articles)) { foreach($new_articles as $article) { ?>
	<li>
		<?php e($manjuuHtml->link($manjuuText->truncate(h($article['Article']['title'])),HOST . $manjuuHtml->base . '/blog/entry/' . $article['Article']['url'])) ?>
	</li>
<?php }} ?>
</ul>