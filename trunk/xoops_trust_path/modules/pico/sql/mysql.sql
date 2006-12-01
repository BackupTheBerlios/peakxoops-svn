# CREATE TABLE `tablename` will be queried as
# CREATE TABLE `prefix_dirname_tablename`

CREATE TABLE category_access (
  cat_id smallint(5) unsigned NOT NULL default 0,
  uid mediumint(8) default NULL,
  groupid smallint(5) default NULL,
  can_post tinyint(1) NOT NULL default 0,
  can_edit tinyint(1) NOT NULL default 0,
  can_delete tinyint(1) NOT NULL default 0,
  post_auto_approved tinyint(1) NOT NULL default 0,
  can_makesubcategory tinyint(1) NOT NULL default 0,
  is_moderator tinyint(1) NOT NULL default 0,
  UNIQUE KEY (cat_id,uid),
  UNIQUE KEY (cat_id,groupid),
  KEY (cat_id),
  KEY (uid),
  KEY (groupid),
  KEY (can_post)
) TYPE=MyISAM;

CREATE TABLE categories (
  cat_id smallint(5) unsigned NOT NULL auto_increment,
  pid smallint(5) unsigned NOT NULL default 0,
  cat_title varchar(255) NOT NULL default '',
  cat_desc text NOT NULL,
  cat_depth_in_tree smallint(5) NOT NULL default 0,
  cat_order_in_tree smallint(5) NOT NULL default 0,
  cat_path_in_tree text NOT NULL,
  cat_unique_path text NOT NULL,
  cat_weight smallint(5) NOT NULL default 0,
  cat_options text NOT NULL,
  PRIMARY KEY (cat_id),
  KEY (cat_weight),
  KEY (pid)
) TYPE=MyISAM;

CREATE TABLE contents (
  content_id int(10) unsigned NOT NULL auto_increment,
  cat_id smallint(5) unsigned NOT NULL default 0,
  weight smallint(5) unsigned NOT NULL default 0,
  created_time int(10) NOT NULL default 0,
  modified_time int(10) NOT NULL default 0,
  poster_uid mediumint(8) unsigned NOT NULL default 0,
  poster_ip varchar(15) NOT NULL default '',
  modifier_uid mediumint(8) unsigned NOT NULL default 0,
  modifier_ip varchar(15) NOT NULL default '',
  subject varchar(255) NOT NULL default '',
  subject_waiting varchar(255) NOT NULL default '',
  visible tinyint(1) NOT NULL default 1,
  approval tinyint(1) NOT NULL default 1,
  use_cache tinyint(1) NOT NULL default 1,
  allow_comment tinyint(1) NOT NULL default 1,
  show_in_navi tinyint(1) NOT NULL default 1,
  show_in_menu tinyint(1) NOT NULL default 1,
  viewed int(10) unsigned NOT NULL default 0,
  votes_sum int(10) unsigned NOT NULL default 0,
  votes_count int(10) unsigned NOT NULL default 0,
  htmlheader text NOT NULL,
  htmlheader_waiting text NOT NULL,
  body text NOT NULL,
  body_waiting text NOT NULL,
  body_cached text NOT NULL,
  filters text NOT NULL,
  PRIMARY KEY (content_id),
  KEY (poster_uid),
  KEY (subject),
  KEY (created_time),
  KEY (cat_id),
  KEY (visible),
  KEY (votes_sum),
  KEY (votes_count)
) TYPE=MyISAM;

CREATE TABLE content_votes (
  vote_id int(10) unsigned NOT NULL auto_increment,
  content_id int(10) unsigned NOT NULL default 0,
  uid mediumint(8) unsigned NOT NULL default 0,
  vote_point tinyint(3) NOT NULL default 0,
  vote_time int(10) NOT NULL default 0,
  vote_ip char(16) NOT NULL default '',
  PRIMARY KEY (vote_id),
  KEY (content_id),
  KEY (vote_ip)
) TYPE=MyISAM;

