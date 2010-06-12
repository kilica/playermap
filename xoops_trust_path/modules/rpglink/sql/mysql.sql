CREATE TABLE `{prefix}_{dirname}_link` (
  `link_id` int(11) unsigned NOT NULL  auto_increment,
  `title` varchar(255) NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL,
  `url` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `rss` varchar(255) NOT NULL,
  `pref_id` mediumint(8) unsigned NOT NULL,
  `description` text NOT NULL,
  `posttime` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`link_id`)) ENGINE=MyISAM;

CREATE TABLE `{prefix}_{dirname}_update` (
  `update_id` int(11) unsigned NOT NULL  auto_increment,
  `title` varchar(255) NOT NULL,
  `link_id` int(8) unsigned NOT NULL,
  `url` varchar(255) NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `description` text NOT NULL,
  `posttime` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`update_id`),
  KEY `posttime` (`posttime`),
  KEY `link_id` (`link_id`, `posttime`)
  ) ENGINE=MyISAM;

CREATE TABLE `{prefix}_{dirname}_lrpg` (
  `lrpg_id` int(11) unsigned NOT NULL  auto_increment,
  `rpg_id` int(8) unsigned NOT NULL,
  `link_id` int(8) unsigned NOT NULL,
  `posttime` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`lrpg_id`),
  UNIQUE KEY `lrpg` (`link_id`, `rpg_id`),
  KEY `link_id` (`link_id`, `posttime`),
  KEY `rpg_id` (`rpg_id`, `posttime`),
  KEY `posttime` (`posttime`)
  ) ENGINE=MyISAM;

