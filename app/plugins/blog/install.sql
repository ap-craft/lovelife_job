DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
   `id` int(11) NOT NULL auto_increment,
   `url` text NOT NULL,
   `title` text NOT NULL,
   `content` text NOT NULL,
   `is_published` int(11) NOT NULL,
   `category_id` int(11) NOT NULL,
   `type` int(11) NOT NULL,
   `showed` int(11) NOT NULL,
   `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
   PRIMARY KEY (`id`)
) DEFAULT CHARSET utf8;

﻿DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
   `id` int(11) NOT NULL auto_increment,
   `name` text NOT NULL,
   `url` varchar(255) NOT NULL,
   `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
   PRIMARY KEY (`id`)
) DEFAULT CHARSET utf8;

﻿DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
   `id` int(11) NOT NULL auto_increment,
   `article_id` int(11) NOT NULL,
   `name` text NOT NULL,
   `url` varchar(255) NOT NULL,
   `body` text NOT NULL,
   `accepted` tinyint(4) NOT NULL,
   `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
   PRIMARY KEY (`id`)
) DEFAULT CHARSET utf8;

﻿DROP TABLE IF EXISTS `trackbacks`;
CREATE TABLE `trackbacks` (
   `id` int(11) NOT NULL auto_increment,
   `article_id` int(11) NOT NULL,
   `url` varchar(255) NOT NULL,
   `title` text NOT NULL,
   `blog_name` text NOT NULL,
   `excerpt` text NOT NULL,
   `accepted` tinyint(4) NOT NULL,
   `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`)
) DEFAULT CHARSET utf8;

DELETE FROM `settings` where `key` like 'blog%';
INSERT INTO `settings` (`key`, `value`,`created`) VALUES
('blog.name', 'まんじゅうCMS　ブログ', now()),
('blog.author', 'CloverStudio.inc', now()),
('blog.pings', '', now()),
('blog.description', 'これはまんじゅうCMSのブログです。', now());