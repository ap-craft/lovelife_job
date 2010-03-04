<?php if(isset($message)) { ?>
	<div id="alert">
		<?php e($message) ?>
	</div>
<?php } ?>

  <div class="item">
    <h2>
      <?php e($manjuuHtml->link($post['Article']['title'],array('controller'=>'entry','plugin'=>'blog',$post['Article']['url']))) ?>
    </h2>
    <p>
      <?php e($post['Article']['content']) ?>
    </p>
    <div class="article_info">
      Posted on <?php e(date("Y/m/d H:i:s", strtotime($post['Article']['created']))) ?>
      Accessed <?php e($post['Article']['showed'] + 1) ?> times.
    </div>
	
	<h2 id="trackbacks">トラックバック一覧</h2>
	
    <?php if(count($post['Trackback']) == 0) { ?>
      <div class="worning">■トラックバックはありません。</div>
    <?php } else { ?>
    <?php foreach($post['Trackback'] as $trackback) { ?>

      <div class="comment">
        <span class="comment_name"><a href="<?php e(h($trackback['url'])) ?>"><?php e(h($trackback['title'])) ?></span></a> on <?php e(h($trackback['blog_name'])) ?>
        <span class="comment_date"><?php e(date("Y/m/d H:i:s", strtotime($trackback['created']))) ?></span>

        <div class="comment_body">
          <p><?php e(h($trackback['excerpt'])) ?></p>
        </div>
      </div>
    <?php }} ?>
	
	<div id="trackbackurl">
		このブログのトラックバックURLは<br /><a href="<?php e($tb_url) ?>"><?php e($tb_url) ?></a>です。
	</div>
	
    <h2 id="comments">コメント一覧</h2>

    <?php if(count($post['Comment']) == 0) { ?>
      <div class="worning">■まだコメントはありません。</div>
    <?php } else { ?>
    <?php foreach($post['Comment'] as $comment) { ?>

      <div class="comment">
        <span class="comment_name"><a href="<?php e(h($comment['url'])) ?>"><?php e(h($comment['name'])) ?></span></a> Says:
        <span class="comment_date"><?php e(date("Y/m/d H:i:s", strtotime($comment['created']))) ?></span>

        <div class="comment_body">
          <p><?php e(str_replace("\n","<br>",h($comment['body']))) ?></p>
        </div>
      </div>
    <?php }} ?>



    <h3 id="writecomment">コメントを書く</h3>

  <?php echo $manjuuForm->create('Blog.Comment',array(
    'url' => array(
      'controller'=>'entry',
      'action'=>null,
      $post['Article']['url']
    ),
    'type'=>'post'
    )
  );?>

  <?php echo $manjuuForm->input('name',array(
    'error' => array(
      'required' 	=> '必須項目です。',
    ),
    'type'=>'text',
    'size'=>40,
    'label'=>'お名前'
    )
  );
  ?>

  <?php echo $manjuuForm->input('url',array(
    'type'=>'text',
    'size'=>40,
    'label'=>'ホームページアドレス'
    )
  );
  ?>

  <?php echo $manjuuForm->input('magic_number',array(
    'error' => array(
      'wrong_answer' 	=> '答えがちがいます。',
    ),
    'type'=>'select',
    'label'=>$question,
    'options'=>$option_spam,
    )
  );
  ?>
  ※これはスパム対策です。答えの数字を選んでください。
  <?php echo $manjuuForm->input('body',array(
    'error' => array(
      'required' 	=> '必須項目です。',
    ),
    'type'=>'textarea',
    'label'=>'本文'
    )
  );
  ?>
<?php echo $manjuuForm->input('article_id',array('value'=>$post['Article']['id'],'type'=>'hidden'));?>
<?php echo $manjuuForm->end('コメントする') ?>

	
  </div>