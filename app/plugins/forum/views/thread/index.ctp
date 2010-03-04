

<h1>掲示板</h1>

<?php e($this->renderElement('threadsTable')) ?>

<div class="right_aligned">
	<?php e($manjuuHtml->link('新規スレッドの作成',array('controller'=>'thread','action'=>'thread_new','plugin'=>'forum'))) ?>
</div>