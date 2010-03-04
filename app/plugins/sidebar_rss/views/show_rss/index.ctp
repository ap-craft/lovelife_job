<div class="sidebar_rss">
	<h1><?php e(h($rss['Rss']['name'])) ?></h1>
	<ul>
		<?php foreach($rss_fetched->items as $value) { ?>
			<li>
				<a href="<?php e(h($value['link'])) ?>">
					&raquo;&nbsp;<?php e($manjuuText->truncate(h($value['title']),15,'...')) ?>
				</a>
			</li>
		<?php } ?>
	</ul>
</div>