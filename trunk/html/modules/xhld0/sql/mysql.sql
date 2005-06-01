CREATE TABLE xhld (
  headline_id smallint(5) unsigned NOT NULL auto_increment,
  headline_name text NOT NULL default '',
  headline_url text NOT NULL default '',
  headline_rssurl text NOT NULL default '',
  headline_titlepattern text NOT NULL default '',
  headline_titleexclude text NOT NULL default '',
  headline_linkpattern text NOT NULL default '',
  headline_linkexclude text NOT NULL default '',
  headline_encoding varchar(15) NOT NULL default '',
  headline_cachetime mediumint(8) unsigned NOT NULL default '3600',
  headline_asblock tinyint(1) unsigned NOT NULL default '0',
  headline_display tinyint(1) unsigned NOT NULL default '0',
  headline_weight smallint(3) unsigned NOT NULL default '0',
  headline_mainfull tinyint(1) unsigned NOT NULL default '1',
  headline_mainimg tinyint(1) unsigned NOT NULL default '1',
  headline_mainmax tinyint(2) unsigned NOT NULL default '10',
  headline_blockimg tinyint(1) unsigned NOT NULL default '0',
  headline_blockmax tinyint(2) unsigned NOT NULL default '10',
  headline_xml mediumtext NOT NULL default '',
  headline_updated int(10) NOT NULL default'0',
  headline_syndication varchar(255) NOT NULL default '',
  headline_timeout smallint(3) NOT NULL default '99',
  headline_allowhtml tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (headline_id)
) TYPE=MyISAM;


