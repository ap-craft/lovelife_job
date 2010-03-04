DROP TABLE IF EXISTS `rsses`;
CREATE TABLE `rsses` (
   `id` int(11) NOT NULL auto_increment,
   `name` varchar(255),
   `url` varchar(255),
   `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
   PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET utf8;

INSERT INTO `rsses` (`id`, `name`, `url`, `modified`, `created`) VALUES 
('1', '開発ブログ', 'http://yasue.us/blog/rss/category/manjuu', '0000-00-00 00:00:00', '2008-08-28 15:20:13');