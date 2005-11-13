#
# Table structure for table `tinycontent`
#

CREATE TABLE tinycontent7 (
  storyid int(8) NOT NULL auto_increment,
  blockid int(8) unsigned NOT NULL default '0',
  title varchar(255) NOT NULL default '',
  text text default NULL,
  visible tinyint(1) NOT NULL default '0',
  homepage tinyint(1) NOT NULL default '0',
  nohtml tinyint(1) NOT NULL default '0',
  nosmiley tinyint(1) NOT NULL default '0',
  nobreaks tinyint(1) NOT NULL default '0',
  nocomments tinyint(1) NOT NULL default '0',
  link tinyint(1) NOT NULL default '0',
  address varchar(255) default NULL,
  submenu tinyint(1) NOT NULL default '0',
  last_modified timestamp(14),
  created datetime NOT NULL default '2001-1-1 00:00:00',
  html_header text default NULL,

  KEY (title),
  KEY (blockid),
  KEY (visible),
  KEY (homepage),
  KEY (nohtml),
  KEY (nosmiley),
  KEY (nobreaks),
  KEY (nocomments),
  KEY (link),
  KEY (address),
  KEY (submenu),
  KEY (last_modified),
  PRIMARY KEY (storyid)
) TYPE=MyISAM;
