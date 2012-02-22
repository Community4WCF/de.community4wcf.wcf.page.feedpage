DROP TABLE IF EXISTS wcf1_feedpage;
CREATE TABLE wcf1_feedpage (
	feedID int(10) unsigned NOT NULL auto_increment,
	title varchar(255) NOT NULL default '',
	author varchar(255) NOT NULL default '',
	link varchar(255) NOT NULL default '',
	guid varchar(255) NOT NULL default '',
	pubDate int(10) unsigned NOT NULL default 0,
	description mediumtext,
	disabled tinyint(1) unsigned NOT NULL default 0,
	PRIMARY KEY (feedID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;