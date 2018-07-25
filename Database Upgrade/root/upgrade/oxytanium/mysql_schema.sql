
#
#-----[ Delete SQL Tables ]-----------------------------------------------------
#
DROP TABLE phpbb_arcade_categories;
DROP TABLE phpbb_arcade_championnat;
DROP TABLE phpbb_arcade_comments;
DROP TABLE phpbb_arcade_fav;
DROP TABLE phpbb_auth_arcade_access;
DROP TABLE phpbb_cash;
DROP TABLE phpbb_cash_events;
DROP TABLE phpbb_cash_exchange;
DROP TABLE phpbb_cash_groups;
DROP TABLE phpbb_cash_log;
DROP TABLE phpbb_ct_filter;
DROP TABLE phpbb_ct_viskey;
DROP TABLE phpbb_ctrack;
DROP TABLE phpbb_gamehash;
DROP TABLE phpbb_games;
DROP TABLE phpbb_hackgame;
DROP TABLE phpbb_hacks_list;
DROP TABLE phpbb_invitation_users;
DROP TABLE phpbb_invitations;
DROP TABLE phpbb_ip_tracking;
DROP TABLE phpbb_ip_tracking_config;
DROP TABLE phpbb_posts_edit;
DROP TABLE phpbb_scores;
DROP TABLE phpbb_shout;

#
#-----[ Add SQL Tables ]--------------------------------------------------------
#
CREATE TABLE phpbb_bots (
	bot_id tinyint(3) unsigned NOT NULL auto_increment,
	bot_name varchar(255) NOT NULL DEFAULT '',
	bot_agent text NOT NULL,
	last_visit varchar(255) NOT NULL DEFAULT '',
	bot_visits varchar(255) NOT NULL DEFAULT '0',
	bot_pages varchar(255) NOT NULL DEFAULT '0',
	pending_agent text NOT NULL,
	pending_ip text NOT NULL,
	bot_ip text NOT NULL,
	bot_style varchar(255) NOT NULL DEFAULT '1',
	PRIMARY KEY (bot_id)
);

CREATE TABLE phpbb_ext_host (
	ext_id mediumint(8) unsigned NOT NULL auto_increment,
	ext_name varchar(50) NOT NULL,
	ext_url varchar(150) NOT NULL,
	ext_ub tinyint(1) NOT NULL DEFAULT '0',
	ext_ubc text NOT NULL,
	ext_enabled tinyint(1) NOT NULL DEFAULT '0',
	PRIMARY KEY (ext_id)
);

CREATE TABLE phpbb_guests_visit (
	guest_time INT(11) NOT NULL DEFAULT '0',
	guest_visit INT(11) NOT NULL DEFAULT '0',
	PRIMARY KEY (guest_time)
);

CREATE TABLE phpbb_log (
	log_id mediumint(8) unsigned NOT NULL auto_increment,
	log_type tinyint(4) NOT NULL default '0',
	user_id mediumint(8) unsigned NOT NULL default '0',
	forum_id mediumint(8) unsigned NOT NULL default '0',
	topic_id mediumint(8) unsigned NOT NULL default '0',
	log_ip varchar(40) NOT NULL default '',
	log_ip_real varchar(40) NOT NULL default '',
	log_time int(11) unsigned NOT NULL default '0',
	log_operation text NOT NULL,
	log_data mediumtext NOT NULL,
	PRIMARY KEY  (log_id),
	KEY log_type (log_type),
	KEY forum_id (forum_id),
	KEY topic_id (topic_id),
	KEY user_id (user_id)
);

CREATE TABLE phpbb_log_config (
	config_name VARCHAR (255) NOT NULL,
	config_value VARCHAR (255) DEFAULT '',
	PRIMARY KEY (config_name)
);

CREATE TABLE phpbb_shoutbox (
	id int(11) NOT NULL auto_increment,
	sb_user_id int(11) NOT NULL default '0',
	msg varchar(255) NOT NULL default '',
	timestamp int(10) unsigned NOT NULL default '0',
	sb_username varchar(255) NOT NULL default '',
	shout_bbcode_uid varchar(10) NOT NULL default '',
	enable_bbcode tinyint(1) NOT NULL default '0',
	enable_html tinyint(1) NOT NULL default '0',
	enable_smilies tinyint(1) NOT NULL default '0',
	shout_ip varchar(8) NOT NULL default '',
	shout_group_id mediumint(8) NOT NULL default '0',
	PRIMARY KEY (id)
);
