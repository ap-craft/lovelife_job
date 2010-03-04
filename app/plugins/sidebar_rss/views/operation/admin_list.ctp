<h1>RSS一覧</h1>

<table border="0" class="listTable">

<tr>
	<th align="left" width="40%">タイトル</th>
	<th align="left" width="40%">作成日</th>
	<th align="left" widrh="20%">操作</th>
	
</tr>

<?php foreach($rsses as $rss) { ?>
	<tr>
		<td align="left">
			<?php e($rss['Rss']['name']) ?>
		</td>
		<td align="left">
			<?php e(date("Y年m月d日", strtotime($rss['Rss']['created']))) ?>
		</td>
		<td align="right">
		<a href="<?php e($html->base) ?>/admin/sidebar_rss/operation/edit/<?php e($rss['Rss']['id']) ?>">編集</a>/
		<a href="<?php e($html->base) ?>/admin/sidebar_rss/operation/delete/<?php e($rss['Rss']['id']) ?>" onclick="return confirm('本当にいいですか？')">削除</a>
		</td>
	</tr>
<?php } ?>

</table>

<div class="alignRight">
	<a href="<?php e($html->base) ?>/admin/sidebar_rss/operation/new">新規追加</a>
</div>