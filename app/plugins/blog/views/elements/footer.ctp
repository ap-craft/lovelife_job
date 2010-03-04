<br style="clear: both" />
<div id="blog_footer" >
	 <div class="width_selecter">
	 	<div class="left_col">
	 		<h2>ブログ カテゴリー別人気記事</h2>
	 		
	 		<?php if(isset($categories)) { foreach($categories as $category) { ?>
	 			
	 			<div class="category_box">
	 				<div class="cat_title">
	 					<?php e($manjuuHtml->link($category['Category']['name'],'/blog/category/' .$category['Category']['url'])) ?>
	 				</div>
	 				<ul>
	 					<?php foreach($category['Article'] as $article) { ?>
							<li>
								<?php e($manjuuHtml->link($article['title'],'/blog/entry/' . $article['url'])) ?>
							</li>
						<?php } ?>
					</ul>
	 			</div>
	 			
	 		<?php }} ?>
	 		
		</div>
		<div class="right_col">
			<h2>ブログ 総合人気記事</h2>

	 			<div class="category_box">
	 				<ul>
	 				<?php if(isset($popular_articles)) { foreach($popular_articles as $article) { ?>
							<li><a href="<?php e($html->base) ?>/blog/entry/<?php e($article['Article']['url'])?>"><?php e($article['Article']['title'])?></a></li>	
	 				<?php }} ?>
	 				</ul>
	 			</div>
		</div>
		<br style="clear: both" />
	 </div>
</div>