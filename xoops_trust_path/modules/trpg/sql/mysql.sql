CREATE TABLE `{prefix}_{dirname}_rpg` (
  `rpg_id` int(11) unsigned NOT NULL  auto_increment,
  `title` varchar(255) NOT NULL,
  `kana` varchar(128) NOT NULL,
  `abbr` varchar(60) NOT NULL,
  `pub_id` mediumint(8) unsigned NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `posttime` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`rpg_id`)) ENGINE=MyISAM;

CREATE TABLE `{prefix}_{dirname}_book` (
  `book_id` int(11) unsigned NOT NULL  auto_increment,
  `title` varchar(255) NOT NULL,
  `rpg_id` int(8) unsigned NOT NULL,
  `version` varchar(60) NOT NULL,
  `btype` int(2) unsigned NOT NULL,
  `pub_id` mediumint(8) unsigned NOT NULL,
  `isbn` varchar(15) NOT NULL,
  `isbn13` varchar(15) NOT NULL,
  `pubyear` int(6) unsigned NOT NULL,
  `price` decimal(10,4) unsigned NOT NULL,
  `currency` int(5) unsigned NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `posttime` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`book_id`),
  KEY `rpg_id` (`rpg_id`, `pubyear`)
  ) ENGINE=MyISAM;

