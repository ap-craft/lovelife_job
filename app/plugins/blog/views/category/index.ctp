<div class="category_list">
  <h1>カテゴリー<?php e($category['Category']['name']) ?>のエントリー一覧</h1>

  <?php foreach($articles as $article) { ?>

    <div class="item">
      <h2 class="entry_title">
        <?php e($manjuuHtml->link($article['Article']['title'],array('controller'=>'entry','plugin'=>'blog',$article['Article']['url']))) ?>
      </h2>
      <p>
        <?php e($article['Article']['content']) ?>

        <div class="links">
          <?php e($manjuuHtml->link('コメントを書く',array('controller'=>'entry','plugin'=>'blog',$article['Article']['url'].'#writecomment'))) ?>
        </div>
      </p>

      <div class="article_info">
        Posted on <?php e(date("Y/m/d H:i:s", strtotime($article['Article']['created']))) ?> |
        <?php e($manjuuHtml->link("comments(" . count($article['Comment']) .")",array('controller'=>'entry','plugin'=>'blog',$article['Article']['url'].'#comments'))) ?>
      </div>
    </div>

  <?php } ?>
</div>

<?php echo $this->renderElement('paginator'); ?>