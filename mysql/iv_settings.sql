CREATE TABLE `iv_settings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL COMMENT 'Параметр',
  `value` varchar(300) DEFAULT NULL COMMENT 'Значение',
  `module` varchar(32) DEFAULT NULL COMMENT 'Модуль',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8