CREATE TABLE IF NOT EXISTS `PREFIX_retailersmap_group` ( `id_group` int(10) unsigned NOT NULL AUTO_INCREMENT, `name` varchar(255) NOT NULL, `group_marker` varchar(255) DEFAULT NULL, `group_retina_marker` varchar(255) DEFAULT NULL, `stack_order` int(10) unsigned NOT NULL DEFAULT 0, PRIMARY KEY (`id_group`) ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MYSQLENGINE