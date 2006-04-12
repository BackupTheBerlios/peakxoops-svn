CREATE TABLE plzxoo_question ( 
	qid int(10) auto_increment,
	cid mediumint(5) ,
	uid mediumint(5) ,
	subject varchar(255) ,
	body text ,
	input_date int(10) ,
	priority tinyint(3) ,
	status tinyint(1) ,
	size mediumint(5) ,
	PRIMARY KEY (qid)
) TYPE=MyISAM;

CREATE TABLE plzxoo_answer ( 
	aid int(10) auto_increment,
	qid int(10) ,
	uid mediumint(5) ,
	input_date int(10) ,
	body text ,
	comment varchar(255) ,
	point tinyint(3) ,
	PRIMARY KEY (aid)
) TYPE=MyISAM;

CREATE TABLE plzxoo_category ( 
	cid int(10) auto_increment,
	pid int(10) ,
	name varchar(255) ,
	description text ,
	size mediumint(5) ,
	PRIMARY KEY (cid)
) TYPE=MyISAM;

