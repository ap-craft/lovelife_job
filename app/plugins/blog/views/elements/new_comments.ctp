<h1>最新コメント一覧</h1>
<ul id="new_comments">
<?php if(isset($new_comments)) { foreach($new_comments as $comment) { ?>
	<li>
		<div class="comment_new">
				<?php e($manjuuHtml->link($manjuuText->truncate(h($comment['Comment']['body'])),HOST . $manjuuHtml->base . '/blog/entry/' . $comment['Article']['url'] . '#comments')) ?>
			<div class="name">
				by <?php e(h($comment['Comment']['name'])) ?>
			</div>
		</div>
	</li>
<?php }} ?>
</ul>