<h1>記事一覧</h1>

<table border="0" class="listTable">

<tr>
	<th align="left" width="40%">タイトル</th>
	<th align="left" width="20%">作成日</th>
	<th align="left" widrh="40%">操作</th>
	
</tr>

<?php foreach($articles as $article) { ?>
	<tr>
		<td align="left">
			<?php e($article['Article']['title']) ?>
		</td>
		<td align="left">
			<?php e(date("Y年m月d日", strtotime($article['Article']['created']))) ?>
		</td>
		<td align="right">
		<a href="<?php e($html->base) ?>/blog/entry/<?php e($article['Article']['url']) ?>">見る</a>/		
		<a href="<?php e($html->base) ?>/admin/blog/operation/comment_list/<?php e($article['Article']['id']) ?>">コメントの編集</a>/
		<a href="<?php e($html->base) ?>/admin/blog/operation/blog_edit/<?php e($article['Article']['id']) ?>">編集</a>/
		<a href="<?php e($html->base) ?>/admin/blog/operation/blog_delete/<?php e($article['Article']['id']) ?>" onclick="return confirm('本当にいいですか？')">削除</a>
		</td>
	</tr>
<?php } ?>

</table>

<?php echo $this->renderElement('paginator'); ?>

<div class="alignRight">
	<a href="<?php e($html->base) ?>/admin/blog/operation/blog_new">新規追加</a>
</div>