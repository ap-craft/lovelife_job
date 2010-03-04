DELETE FROM `settings` where `key` like 'contact%';
INSERT INTO `settings` (`key`, `value`,`created`) VALUES
('contact.emailaddress', 'admin@manjuu.com', now());