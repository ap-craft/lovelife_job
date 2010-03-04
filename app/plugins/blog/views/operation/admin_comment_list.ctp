<h1>コメント一覧</h1>

<table border="0" class="listTable">

<tr>
	<th align="left" width="10%">タイプ</th>
	<th align="left" width="60%">内容</th>
	<th align="left" width="20%">受信日</th>
	<th align="left" widrh="10%">操作</th>
	
</tr>

<?php foreach($replies as $reply) { ?>
	
	<?php if($reply['type'] == 'comment') {
		$comment = $reply;
	 ?>
	 
		<tr>
			<td align="left">
				コメント
			</td>
			<td align="left" nowrap>
				<div style="font-weight: bold;margin-bottom: 5px"><?php e($comment['article_title']) ?></div>
				名前:<?php e(h($manjuuText->truncate($comment['name']))) ?><br />
				URL:<?php e(h($manjuuText->truncate($comment['url']))) ?><br />
				<?php e($manjuuText->truncate($comment['body'])) ?><br />
			</td>
			<td align="left">
				<?php e(date("Y年m月d日", strtotime($comment['created']))) ?>
			</td>
			<td align="right">
			<?php if($comment['accepted'] == 0) { ?><a href="<?php e($html->base) ?>/admin/blog/operation/comment_accept/<?php e($comment['id']) ?>/<?php e($article_id) ?>">承認</a><br />
			<?php } else { ?><a href="<?php e($html->base) ?>/admin/blog/operation/comment_deny/<?php e($comment['id']) ?>/<?php e($article_id) ?>">非承認にする</a><br /><?php } ?>
			<a href="<?php e($html->base) ?>/admin/blog/operation/comment_delete/<?php e($comment['id']) ?>/<?php e($article_id) ?>" onclick="return confirm('本当にいいですか？')">削除</a>
			</td>
		</tr>
	<?php } ?>

	<?php if($reply['type'] == 'trackback') {
		$trackback = $reply;
	 ?>
	 
		<tr>
			<td align="left">
				トラックバック
			</td>
			<td align="left" nowrap>
				<div style="font-weight: bold;margin-bottom: 5px"><?php e($comment['article_title']) ?></div>
				ブログ名:<?php e(h($manjuuText->truncate($trackback['blog_name']))) ?><br />
				タイトル:<?php e(h($manjuuText->truncate($trackback['title']))) ?><br />
				URL:<?php e(h($manjuuText->truncate($trackback['url']))) ?><br />
				<?php e($manjuuText->truncate($trackback['excerpt'])) ?><br />
			</td>
			<td align="left">
				<?php e(date("Y年m月d日", strtotime($trackback['created']))) ?>
			</td>
			<td align="right">
			<?php if($trackback['accepted'] == 0) { ?><a href="<?php e($html->base) ?>/admin/blog/operation/trackback_accept/<?php e($trackback['id']) ?>/<?php e($article_id) ?>">承認</a><br />
			<?php } else { ?><a href="<?php e($html->base) ?>/admin/blog/operation/trackback_deny/<?php e($trackback['id']) ?>/<?php e($article_id) ?>">非承認にする</a><br /><?php } ?>
			<a href="<?php e($html->base) ?>/admin/blog/operation/trackback_delete/<?php e($trackback['id']) ?>/<?php e($article_id) ?>" onclick="return confirm('本当にいいですか？')">削除</a>
			</td>
		</tr>
	<?php } ?>
<?php } ?>

</table>

<div class="alignRight">
	<a href="<?php e($html->base) ?>/admin/blog/operation/blog_list">戻る</a>
</div>