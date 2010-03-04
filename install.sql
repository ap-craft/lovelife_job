DROP TABLE IF EXISTS `pages`; 
CREATE TABLE `pages` (
   `id` int(11) NOT NULL auto_increment,
   `parent_id` int(11),
   `url` varchar(255),
   `title` varchar(255),
   `content` text,
   `type` int(11),
   `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
   `sort` int(11),
   PRIMARY KEY (`id`),
   KEY `id` (`id`)
) DEFAULT CHARSET utf8;

DROP TABLE IF EXISTS `settings`; 
CREATE TABLE `settings` (
   `id` int(11) NOT NULL auto_increment,
   `key` varchar(255) NOT NULL,
   `value` text NOT NULL,
   `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
   PRIMARY KEY (`id`)
) DEFAULT CHARSET utf8;

INSERT INTO `settings` (`id`, `key`, `value`, `modified`, `created`) VALUES 
('1', 'site_name', 'まんじゅうCMS', '2008-09-04 16:02:02', '2008-07-15 13:02:09'),
('2', 'seo_keywords', 'manjuu cms', '2008-09-04 16:02:02', '2008-07-15 13:02:09'),
('3', 'seo_description', 'This web site is made of manjuuCMS', '2008-09-04 16:02:02', '2008-07-15 13:02:09'),
('6', 'subtitle', 'なんでも出来ちゃうCMSだお', '2008-09-04 16:02:02', '0000-00-00 00:00:00'),
('11', 'use_wysiwsg', '1', '2008-09-04 16:02:02', '2008-08-31 08:33:57'),
('12', 'addtional_head', '', '2008-09-04 16:02:02', '2008-09-02 11:02:07'),
('13', 'last_line', '', '2008-09-04 16:02:02', '2008-09-02 11:49:07');

INSERT INTO `pages` (`id`, `parent_id`, `url`, `title`, `content`, `type`, `modified`, `created`, `sort`) VALUES 
('29', '0', 'samples', 'サンプルページ', '<h1>サンプルページ集</h1>ここでは、サンプルのページを紹介します。<br>', '1', '0000-00-00 00:00:00', '2008-09-12 00:42:27', '1'),
('30', '29', 'sample1', 'サンプルページ１', 'test', '1', '2008-09-12 00:50:06', '2008-09-12 00:49:43', '1'),
('31', '29', 'sample2', 'サンプルページ２', 'test', '1', '0000-00-00 00:00:00', '2008-09-12 00:50:01', '2'),
('32', '0', 'sample-2', 'サンプルページ２', '<br>', '1', '0000-00-00 00:00:00', '2008-09-12 01:10:27', '3'),
('33', '29', 'sample3', 'サンプルページ３', '<br>', '1', '0000-00-00 00:00:00', '2008-09-12 01:10:53', '3'),
('34', '32', 'sample4', 'サンプルページ４', 'ddd', '1', '0000-00-00 00:00:00', '2008-09-12 01:11:26', '5'),
('35', '32', 'sample5', 'サンプルページ５', '<br>', '1', '0000-00-00 00:00:00', '2008-09-12 01:11:43', '6'),
('26', '0', 'index', 'トップページ', '<h1>トップページ</h1>これは、<a name="" target="" classname="" class="" href="http://manjuu.com">まんじゅうCMS</a>デフォルトのトップページです。<br>まんじゅうCSMとは、<a name="" target="" classname="" class="" href="http://clover-studio.com/">CloverStudio</a>が開発しているCakePHPで作られたCMSです。\r\n            	まんじゅうCMSは３つのポリシーの元開発されています。<br><ul><li>カスタマイズされる事前提</li><li>既にあるものは出来るだけ再利用</li><li>部品をみんなで作って共有すればもっとWebサービスを簡単に早く開発できる</li></ul>CMSは簡単に導入できる事を目標に作られているのが大半で<strong>、カスタマイズ性に優れたCMSはあるにしてもその障壁（学習コスト等）は\r\n                大きく、初期のWebサイトの構築には便利だとしても、その後の運営や拡張をスムーズに行うには余計なコストや時間がかかってしまいます</strong>。\r\n                プラグインが公開されているのもありますが本当に欲しい物と少し違っていたりするのがほとんどで、トータルで考えると結局フルスクラッチで\r\n                開発してしまうのが現状ではないでしょうか？\r\n                その問題点を解決すべくまんじゅうCMSは今もっとも注目されているcakePHPを利用して作られています。<strong>cakePHPを利用する事でcakePHPを知っている\r\n                と言う条件で学習コストはかなり下げる事が出来る上に、cakePHPを学習したとしても他のプロジェクトに活用出来るので無駄になりません。<br><br></strong><h1>特徴</h1><h2>カスタマイズ性</h2>まんじゅうCMSはcakePHPユーザーのcakePHPユーザーによるcakePHPのためのCMSです。他のオープンなCMSが独自の設計で開発されていて、カスタマイズができるようなるまでの学習障壁大きいことを解決するために作られました。\r\n                \r\n            <h2>オープンソース</h2>まんじゅうCMSはオープンソースです。カスタマイズされる事を前提に作られているので当然ですが、オープンソースにする事により、\r\n                プラグイン等の情報を共有する事ができます。情報やプラグインを共有する事によってより簡単にプロジェクトへ導入する事が\r\n                出来るようになります。\r\n            <h2>プラグイン</h2>まんじゅうCMSはcakePHPの標準機能であるプラグインを利用して作られています。この機能を利用して誰でも簡単にプラグインを書くことができます。プラグインを書いたらぜひ共有しましょう。現在あるプラグインはプラグインのページを参考にしてください。<br><br><h1>こんな人にお勧め</h1>\r\n            <p>\r\n            	まんじゅうCSMはこんな人におすすめです。\r\n          </p>\r\n             <ul><li>オープンなCMSのプラグインを開発するのは面倒</li><li>もうcakePHP以外のフレームワークは使う気がしない</li><li>HTMLベースのサイトなんだけど将来的にブログとか機能を追加する予定</li></ul>\r\n            <p>\r\n            	導入は非常に簡単なので、ぜひ使ってみてください！\r\n          </p>\r\n         <h1>ビジョンとか</h1>\r\n         <p>\r\n         	<strong>すべてのHTMLベースのサイトをまんじゅうCMSに置き換えて命を吹き込む事。</strong><br>\r\n       	    <strong>そしてcakePHPをスタンダードな開発環境にする事。        </strong></p><br>', '2', '2008-09-12 00:37:02', '2008-09-04 11:21:04', '1');