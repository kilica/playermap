CREATE TABLE `{prefix}_{dirname}_player` (
  `uid` mediumint(8) unsigned NOT NULL	auto_increment,
  `name` varchar(255) NOT NULL,
  `gender` tinyint(1) unsigned NOT NULL,
  `birthyear` smallint(4) unsigned NOT NULL,
  `startyear` smallint(4) unsigned NOT NULL,
  `pref_id` mediumint(5) unsigned NOT NULL,
  `address` text NOT NULL,
  `pl_lat` decimal(18,14) signed NOT NULL,
	`pl_lng` decimal(18,14) signed NOT NULL,
  `role` tinyint(1) unsigned NOT NULL,
  `sun` tinyint(1) unsigned NOT NULL,
  `mon` tinyint(1) unsigned NOT NULL,
  `tue` tinyint(1) unsigned NOT NULL,
  `wed` tinyint(1) unsigned NOT NULL,
  `thu` tinyint(1) unsigned NOT NULL,
  `fri` tinyint(1) unsigned NOT NULL,
  `sat` tinyint(1) unsigned NOT NULL,
  `hol` tinyint(1) unsigned NOT NULL,
  `pbn` tinyint(1) unsigned NOT NULL,
  `description` text NOT NULL,
  `posttime` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`uid`),
  KEY `posttime` (`posttime`),
  KEY `pref_id` (`pref_id`, `posttime`) 
  ) ENGINE=MyISAM;

CREATE TABLE `{prefix}_{dirname}_conne` (
  `conne_id` int(11) unsigned NOT NULL	auto_increment,
  `uid` mediumint(8) unsigned NOT NULL,
  `conne_uid` mediumint(8) unsigned NOT NULL,
  `level` tinyint(2) unsigned NOT NULL,
  `stat` tinyint(2) unsigned NOT NULL,
  `accepttime` int(11) unsigned NOT NULL,
  `posttime` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`conne_id`),
  UNIQUE KEY `friend` (`uid`, `conne_uid`),
  KEY `uid` (`uid`, `stat`, `accepttime`) ,
  KEY `conne_id` (`conne_uid`, `stat`, `accepttime`) 
  ) ENGINE=MyISAM;

CREATE TABLE `{prefix}_{dirname}_group` (
  `group_id` int(11) unsigned NOT NULL	auto_increment,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `policy` text NOT NULL,
  `posttime` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`group_id`),
  KEY `posttime` (`posttime`)
  ) ENGINE=MyISAM;

CREATE TABLE `{prefix}_{dirname}_circle` (
  `group_id` int(11) unsigned NOT NULL	auto_increment,
  `address` text NOT NULL,
  `pref_id` mediumint(8) unsigned NOT NULL,
  `grp_lat` decimal(18,14) signed NOT NULL,
  `grp_lng` decimal(18,14) signed NOT NULL,
  `sun` tinyint(1) unsigned NOT NULL,
  `mon` tinyint(1) unsigned NOT NULL,
  `tue` tinyint(1) unsigned NOT NULL,
  `wed` tinyint(1) unsigned NOT NULL,
  `thu` tinyint(1) unsigned NOT NULL,
  `fri` tinyint(1) unsigned NOT NULL,
  `sat` tinyint(1) unsigned NOT NULL,
  `hol` tinyint(1) unsigned NOT NULL,
  `pbn` tinyint(1) unsigned NOT NULL,
  `posttime` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`group_id`),
  KEY `pref_id` (`pref_id`, `posttime`)
  ) ENGINE=MyISAM;

CREATE TABLE `{prefix}_{dirname}_member` (
  `member_id` int(11) unsigned NOT NULL  auto_increment,
  `group_id` mediumint(8) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `since` smallint(4) unsigned NOT NULL,
  `rank` tinyint(2) unsigned NOT NULL,
  `posttime` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`member_id`),
  UNIQUE KEY `group_member` (`group_id`, `uid`),
  KEY `group_id` (`group_id`, `rank`, `posttime`),
  KEY `uid` (`uid`, `rank`, `posttime`)
  ) ENGINE=MyISAM;

CREATE TABLE `{prefix}_{dirname}_permission` (
  `permission_id` int(11) unsigned NOT NULL  auto_increment,
  `group_id` mediumint(8) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL,
  `dirname` varchar(64) NOT NULL,
  `dataname` varchar(64) NOT NULL,
  PRIMARY KEY  (`permission_id`),
  UNIQUE KEY `permission` (`group_id`, `uid`, `dirname`, `dataname`),
  KEY `data` (`dirname`, `dataname`, `uid`),
  KEY `uid` (`uid`)
  ) ENGINE=MyISAM;

CREATE TABLE `{prefix}_{dirname}_favrpg` (
  `favrpg_id` int(11) unsigned NOT NULL  auto_increment,
  `rpg_id` mediumint(8) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL,
  `rating` tinyint(1) unsigned NOT NULL,
  `player` tinyint(1) unsigned NOT NULL,
  `master` tinyint(1) unsigned NOT NULL,
  `since` smallint(4) unsigned NOT NULL,
  `owner` tinyint(1) NOT NULL,
  `description` text NOT NULL,
  `posttime` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`favrpg_id`),
  UNIQUE KEY `favrpg` (`rpg_id`, `uid`),
  KEY `rating_uid` (`rating`, `uid`, `posttime`),
  KEY `rating_rpg_id` (`rating`, `rpg_id`, `posttime`),
  KEY `uid` (`uid`, `posttime`),
  KEY `rpg_id` (`rpg_id`, `posttime`)
  ) ENGINE=MyISAM;

CREATE TABLE `{prefix}_{dirname}_review` (
  `review_id` int(11) unsigned NOT NULL  auto_increment,
  `book_id` mediumint(8) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL,
  `rating` tinyint(1) unsigned NOT NULL,
  `importance` tinyint(1) unsigned NOT NULL,
  `owner` tinyint(1) NOT NULL,
  `description` text NOT NULL,
  `posttime` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`review_id`),
  UNIQUE KEY `favrpg` (`book_id`, `uid`),
  KEY `rating_uid` (`rating`, `uid`, `posttime`),
  KEY `rating_book_id` (`rating`, `book_id`, `posttime`),
  KEY `uid` (`uid`, `posttime`),
  KEY `book_id` (`book_id`, `posttime`)
  ) ENGINE=MyISAM;

CREATE TABLE `{prefix}_{dirname}_log` (
  `log_id` int(11) unsigned NOT NULL  auto_increment,
  `title` varchar(255) NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL,
  `rpg_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  `conv_id` mediumint(8) unsigned NOT NULL,
  `sessiontime` int(11) unsigned NOT NULL,
  `scheduletime` int(11) unsigned NOT NULL,
  `recruit` tinyint(1) unsigned NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `posttime` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`log_id`),
  KEY `uid` (`uid`, `sessiontime`),
  KEY `rpg_id` (`rpg_id`, `sessiontime`),
  KEY `group_id` (`group_id`, `sessiontime`),
  KEY `conv_id` (`conv_id`, `sessiontime`)
  ) ENGINE=MyISAM;

CREATE TABLE `{prefix}_{dirname}_entry` (
  `entry_id` int(11) unsigned NOT NULL	auto_increment,
  `log_id` mediumint(8) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL,
  `role` tinyint(1) unsigned NOT NULL,
  `schedule` text NOT NULL,
  `description` text NOT NULL,
  `comment` text NOT NULL,
  `posttime` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`entry_id`),
  KEY `log_id` (`log_id`, `posttime`),
  KEY `uid` (`uid`, `posttime`)
  ) ENGINE=MyISAM;

CREATE TABLE `{prefix}_{dirname}_conv` (
  `conv_id` int(11) unsigned NOT NULL  auto_increment,
  `title` varchar(255) NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  `pref_id` mediumint(8) unsigned NOT NULL,
  `site` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `cv_lat` decimal(18,14) signed NOT NULL,
  `cv_lng` decimal(18,14) signed NOT NULL,
  `starttime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `booking` tinyint(1) unsigned NOT NULL,
  `fee` text NOT NULL,
  `capacity` mediumint(5) unsigned NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `posttime` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`conv_id`),
  KEY `pref_id` (`pref_id`, `starttime`),
  KEY `starttime` (`starttime`),
  KEY `posttime` (`posttime`)
  ) ENGINE=MyISAM;

CREATE TABLE `{prefix}_{dirname}_recruit` (
  `recruit_id` int(11) unsigned NOT NULL  auto_increment,
  `title` varchar(255) NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `description` text NOT NULL,
  `posttime` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`recruit_id`)
  ) ENGINE=MyISAM;

