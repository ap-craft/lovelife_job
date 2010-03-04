<h1>発言一覧</h1>

<table border="0" class="listTable">

<tr>
	<th align="left" width="20%">名前</th>
	<th align="left" width="60%">発言内容</th>
	<th align="left" widrh="10%">発言日時</th>
	<th align="right" widrh="10%">操作</th>
	
</tr>

<?php foreach($posts as $post) { ?>
	<tr>
		<td align="left">
			&nbsp;<?php e($post['Post']['name']) ?>
		</td>
		<td align="left">
			&nbsp;<?php e($post['Post']['body']) ?>
		</td>
		<td align="left">
			&nbsp;<?php e(date('Y/m/d H:i:s',strtotime($post['Post']['created']))) ?>
		</td>
		<td align="right">
			<a href="<?php e($html->base) ?>/admin/forum/operation/post_delete/<?php e($post['Post']['thread_id']) ?>/<?php e($post['Post']['id']) ?>" onclick="return confirm('本当にいいですか？')">削除</a>
		</td>
	</tr>
<?php } ?>

</table>

<?php echo $this->renderElement('paginator'); ?>

<div class="alignRight">
	<a href="<?php e($html->base) ?>/admin/forum/operation/thread_list">スレッド一覧へ戻る</a>
</div>