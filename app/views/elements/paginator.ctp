<?php if($pages > 1) { ?>

<div class="paginator">

<table border="0" style="text-align: center">
<tr>
<?php for($i=1;$i<=$pages;$i++) { ?>
	<td height="60" width="50" valign="top">
		<? if($page == $i ) { ?>
			<a><div class="now_showing" ><?php e($i) ?></div></a>
		<? } else { ?>
			<a href="<?php echo $this->base . $page_url ?><?php e($i) ?>"><div class="paginator_chip" ><?php e($i) ?></div></a>
		<? } ?>
	</td>
<?php }?>

</tr>
</table>
</div>

<?php } ?>