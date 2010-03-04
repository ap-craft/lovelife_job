DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
   `id` int(11) NOT NULL auto_increment,
   `thread_id` int(11),
   `name` varchar(255),
   `body` text,
   `password` varchar(255),
   `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
   PRIMARY KEY (`id`)
) DEFAULT CHARSET utf8;

DROP TABLE IF EXISTS `threads` ;
CREATE TABLE `threads` (
   `id` int(11) NOT NULL auto_increment,
   `name` varchar(255) NOT NULL,
   `description` text NOT NULL,
   `password` varchar(255) NOT NULL,
   `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
   PRIMARY KEY (`id`)
) DEFAULT CHARSET utf8;