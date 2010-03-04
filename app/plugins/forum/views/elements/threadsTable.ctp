<?php if(isset($threads)) { ?>

<table class="threads" cellpadding="0" cellspacing="0">
<th>掲示板名</th>
<th align="right">最終投稿日時</th>
<?php foreach($threads as $thread){ ?>

<tr>
	
	<td>&nbsp;<?php e($manjuuHtml->link($thread['Thread']['name'],array('plugin'=>'forum','controller'=>'thread','action'=>'show',$thread['Thread']['id']))) ?></td>
	<td align="right">&nbsp;<?php e(date('Y/m/d/ h:i:s',strtotime($thread['Thread']['modified']))) ?></td>
	
</tr>

<?php } ?>
</table>
<?php } ?>