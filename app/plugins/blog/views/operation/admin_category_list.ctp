<h1>カテゴリー一覧</h1>

<table border="0" class="listTable">

<tr>
	<th align="left" width="40%">名前</th>
	<th align="left" width="40%">作成日</th>
	<th align="left" widrh="20%">操作</th>
	
</tr>

<?php foreach($categories as $category) { ?>
	<tr>
		<td align="left">
			<?php e($category['Category']['name']) ?>
		</td>
		<td align="left">
			<?php e(date("Y年m月d日", strtotime($category['Category']['created']))) ?>
		</td>
		<td align="right">
		<a href="<?php e($html->base) ?>/admin/blog/operation/category_edit/<?php e($category['Category']['id']) ?>">編集</a>/
		<a href="<?php e($html->base) ?>/admin/blog/operation/category_delete/<?php e($category['Category']['id']) ?>" onclick="return confirm('本当にいいですか？')">削除</a>
		</td>
	</tr>
<?php } ?>

</table>

<div class="alignRight">
	<a href="<?php e($html->base) ?>/admin/blog/operation/category_new">新規追加</a>
</div>