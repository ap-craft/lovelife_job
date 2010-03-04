<h1>ページ一覧</h1>

<table border="0" class="listTable">

<tr>
	<th align="left" width="40%">タイトル</th>
	<th align="left" width="40%">作成日</th>
	<th align="left" widrh="20%">操作</th>
	
</tr>

<?php foreach($page_data as $page) { ?>
	<tr>
		<td align="left">
			<?php e($page['Page']['title']) ?>
		</td>
		<td align="left">
			<?php e(date("Y年m月d日", strtotime($page['Page']['created']))) ?>
		</td>
		<td align="right">
		<a href="<?php e($html->base) ?>/admin/page/show<?php e($page['Page']['id']) ?>">見る</a>/
		<a href="<?php e($html->base) ?>/admin/page/edit/<?php e($page['Page']['id']) ?>">編集</a>/
		<a href="<?php e($html->base) ?>/admin/page/delete/<?php e($page['Page']['id']) ?>" onclick="return confirm('本当にいいですか？')">削除</a>
		</td>
	</tr>
<?php } ?>

</table>

<?php echo $this->renderElement('paginator'); ?>

<div class="alignRight">
	<a href="<?php e($html->base) ?>/admin/page/new">新規追加</a>
</div>