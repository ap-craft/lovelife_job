<h1>スレッド一覧</h1>

<table border="0" class="listTable">

<tr>
	<th align="left" width="40%">タイトル</th>
	<th align="right" widrh="40%">操作</th>
	
</tr>

<?php foreach($threads as $thread) { ?>
	<tr>
		<td align="left">
			&nbsp;<?php e($thread['Thread']['name']) ?>
		</td>

		<td align="right">
			<a href="<?php e($html->base) ?>/admin/forum/operation/post_list/<?php e($thread['Thread']['id']) ?>">投稿内容の編集</a>/
			<a href="<?php e($html->base) ?>/admin/forum/operation/thread_delete/<?php e($thread['Thread']['id']) ?>" onclick="return confirm('本当にいいですか？')">削除</a>
		</td>
	</tr>
<?php } ?>

</table>

<?php echo $this->renderElement('paginator'); ?>