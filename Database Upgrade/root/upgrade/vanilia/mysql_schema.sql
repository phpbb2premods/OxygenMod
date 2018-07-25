
#
#-----[ Delete SQL Tables ]-----------------------------------------------------
#
DROP TABLE phpbb_smilies;
DROP TABLE phpbb_themes;

#
#-----[ Add SQL Tables ]--------------------------------------------------------
#
CREATE TABLE phpbb_attach_quota (
	user_id mediumint(8) unsigned NOT NULL DEFAULT '0',
	group_id mediumint(8) unsigned NOT NULL DEFAULT '0',
	quota_type smallint(2) NOT NULL DEFAULT '0',
	quota_limit_id mediumint(8) unsigned NOT NULL DEFAULT '0',
	KEY quota_type (quota_type)
);

CREATE TABLE phpbb_attachments (
	attach_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL, 
	post_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL, 
	privmsgs_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	user_id_1 mediumint(8) NOT NULL,
	user_id_2 mediumint(8) NOT NULL,
	KEY attach_id_post_id (attach_id, post_id),
	KEY attach_id_privmsgs_id (attach_id, privmsgs_id),
	KEY post_id (post_id),
	KEY privmsgs_id (privmsgs_id)
);

CREATE TABLE phpbb_attachments_config (
	config_name varchar(255) NOT NULL,
	config_value varchar(255) NOT NULL,
	PRIMARY KEY (config_name)
);

CREATE TABLE phpbb_attachments_desc (
	attach_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	physical_filename varchar(255) NOT NULL,
	real_filename varchar(255) NOT NULL,
	download_count mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	comment varchar(255),
	extension varchar(100),
	mimetype varchar(100),
	filesize int(20) NOT NULL,
	filetime int(11) DEFAULT '0' NOT NULL,
	thumbnail tinyint(1) DEFAULT '0' NOT NULL,
	PRIMARY KEY (attach_id),
	KEY filetime (filetime),
	KEY physical_filename (physical_filename(10)),
	KEY filesize (filesize)
);

CREATE TABLE phpbb_attributes (
	attribute_id INT(11) NOT NULL auto_increment,
	attribute VARCHAR(255) NOT NULL DEFAULT '',
	attribute_color VARCHAR(6) NOT NULL DEFAULT '',
	attribute_date_format VARCHAR(25) DEFAULT NULL,
	attribute_position TINYINT(1) NOT NULL DEFAULT '0',
	attribute_administrator TINYINT(1) DEFAULT '0',
	attribute_moderator TINYINT(1) DEFAULT '0',
	attribute_author TINYINT(1) DEFAULT '0',
	attribute_order INT(11) DEFAULT '0' NOT NULL,
	PRIMARY KEY (attribute_id)
);

CREATE TABLE phpbb_bbc_box (
	bbc_id smallint(5) unsigned NOT NULL auto_increment,
	bbc_name varchar(255) NOT NULL,
	bbc_value varchar(255) NOT NULL,
	bbc_auth varchar(255) NOT NULL,
	bbc_before varchar(255) NOT NULL,
	bbc_after varchar(255) NOT NULL,
	bbc_helpline varchar(255) NOT NULL,
	bbc_img varchar(255) NOT NULL,
	bbc_divider varchar(255) NOT NULL,
	bbc_order mediumint(8) DEFAULT '1' NOT NULL,
	PRIMARY KEY (bbc_id)
);

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

CREATE TABLE phpbb_cf_ip_to_iso3661_1 (
	ip_from int(11) unsigned NOT NULL DEFAULT '0',
	ip_to int(11) unsigned NOT NULL DEFAULT '0',
	iso3661_1 CHAR(2) NOT NULL,
	KEY ip_from (ip_from, ip_to)
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

CREATE TABLE phpbb_extension_groups (
	group_id mediumint(8) NOT NULL auto_increment,
	group_name char(20) NOT NULL,
	cat_id tinyint(2) DEFAULT '0' NOT NULL, 
	allow_group tinyint(1) DEFAULT '0' NOT NULL,
	download_mode tinyint(1) UNSIGNED DEFAULT '1' NOT NULL,
	upload_icon varchar(100) DEFAULT '',
	max_filesize int(20) DEFAULT '0' NOT NULL,
	forum_permissions varchar(255) DEFAULT '' NOT NULL,
	PRIMARY KEY group_id (group_id)
);

CREATE TABLE phpbb_extensions (
	ext_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	group_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	extension varchar(100) NOT NULL,
	comment varchar(100),
	PRIMARY KEY ext_id (ext_id)
);

CREATE TABLE phpbb_forbidden_extensions (
	ext_id mediumint(8) UNSIGNED NOT NULL auto_increment, 
	extension varchar(100) NOT NULL, 
	PRIMARY KEY (ext_id)
);

CREATE TABLE phpbb_guests_visit (
	guest_time INT(11) NOT NULL DEFAULT '0',
	guest_visit INT(11) NOT NULL DEFAULT '0',
	PRIMARY KEY (guest_time)
);

CREATE TABLE phpbb_instant_msg (
	id_msg mediumint(8) NOT NULL auto_increment,
	id_sender mediumint(8) NOT NULL default '0',
	id_dest mediumint(8) NOT NULL default '0',
	date_msg int(11) NOT NULL default '0',
	message text NOT NULL,
	bbcode_uid VARCHAR(10) NOT NULL,
	enable_bbcode TINYINT (1) NOT NULL,
	enable_smilies TINYINT (1) NOT NULL,
	UNIQUE KEY id_msg (id_msg)
);

CREATE TABLE phpbb_jail_users (
	celled_id int(8) NOT NULL DEFAULT '0',
	user_id int(8) NOT NULL DEFAULT '0',
	user_cell_date int(11) NOT NULL DEFAULT '0',
	user_freed_by int(8) NOT NULL DEFAULT '0',
	user_sentence text,
	user_caution int(8) NOT NULL DEFAULT '0',
	user_time int(11) NOT NULL DEFAULT '0',
	PRIMARY KEY (celled_id)
);

CREATE TABLE phpbb_jail_votes (
	vote_id mediumint(8) NOT NULL DEFAULT '0',
	voter_id mediumint(8) NOT NULL DEFAULT '0',
	vote_result mediumint(8) NOT NULL DEFAULT '0',
	KEY vote_id (vote_id),
	KEY voter_id (voter_id)
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

CREATE TABLE phpbb_quota_limits (
	quota_limit_id mediumint(8) unsigned NOT NULL auto_increment,
	quota_desc varchar(20) NOT NULL DEFAULT '',
	quota_limit bigint(20) unsigned NOT NULL DEFAULT '0',
	PRIMARY KEY (quota_limit_id)
);

CREATE TABLE phpbb_rcs (
	rcs_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	rcs_name varchar(50) DEFAULT '' NOT NULL,
	rcs_color varchar(6) DEFAULT '' NOT NULL,
	rcs_single tinyint(1) DEFAULT '0' NOT NULL,
	rcs_display tinyint(1) DEFAULT '0' NOT NULL,
	rcs_order mediumint(8) UNSIGNED NOT NULL,
	PRIMARY KEY (rcs_id)
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

CREATE TABLE phpbb_smilies (
	smilies_id smallint(5) unsigned NOT NULL auto_increment,
	code varchar(50) DEFAULT NULL,
	smile_url varchar(100) DEFAULT NULL,
	emoticon varchar(75) DEFAULT NULL,
	cat_id smallint(5) NOT NULL DEFAULT '1',
	smilies_order smallint(5) NOT NULL DEFAULT '0',
	PRIMARY KEY (smilies_id)
);

CREATE TABLE phpbb_smilies_cat (
	cat_id smallint(5) unsigned NOT NULL auto_increment,
	cat_name varchar(255) NOT NULL DEFAULT '',
	description varchar(255) NOT NULL DEFAULT '',
	cat_order smallint(3) NOT NULL DEFAULT '0',
	cat_perms tinyint(1) NOT NULL DEFAULT '1',
	cat_forum smallint(4) NOT NULL DEFAULT '0',
	cat_category smallint(4) NOT NULL DEFAULT '1',
	cat_icon_url varchar(100) DEFAULT NULL,
	smilies_per_page smallint(3) NOT NULL DEFAULT '0',
	smilies_popup varchar(12) NOT NULL DEFAULT '',
	PRIMARY KEY (cat_id)
);

CREATE TABLE phpbb_themes (
	themes_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	template_name varchar(30) NOT NULL DEFAULT '',
	style_name varchar(30) NOT NULL DEFAULT '',
	head_stylesheet varchar(100) DEFAULT NULL,
	body_background varchar(100) DEFAULT NULL,
	body_bgcolor varchar(6) DEFAULT NULL,
	body_text varchar(6) DEFAULT NULL,
	body_link varchar(6) DEFAULT NULL,
	body_vlink varchar(6) DEFAULT NULL,
	body_alink varchar(6) DEFAULT NULL,
	body_hlink varchar(6) DEFAULT NULL,
	tr_color1 varchar(6) DEFAULT NULL,
	tr_color2 varchar(6) DEFAULT NULL,
	tr_color3 varchar(6) DEFAULT NULL,
	tr_class1 varchar(25) DEFAULT NULL,
	tr_class2 varchar(25) DEFAULT NULL,
	tr_class3 varchar(25) DEFAULT NULL,
	th_color1 varchar(6) DEFAULT NULL,
	th_color2 varchar(6) DEFAULT NULL,
	th_color3 varchar(6) DEFAULT NULL,
	th_class1 varchar(25) DEFAULT NULL,
	th_class2 varchar(25) DEFAULT NULL,
	th_class3 varchar(25) DEFAULT NULL,
	td_color1 varchar(6) DEFAULT NULL,
	td_color2 varchar(6) DEFAULT NULL,
	td_color3 varchar(6) DEFAULT NULL,
	td_class1 varchar(25) DEFAULT NULL,
	td_class2 varchar(25) DEFAULT NULL,
	td_class3 varchar(25) DEFAULT NULL,
	fontface1 varchar(50) DEFAULT NULL,
	fontface2 varchar(50) DEFAULT NULL,
	fontface3 varchar(50) DEFAULT NULL,
	fontsize1 tinyint(4) DEFAULT NULL,
	fontsize2 tinyint(4) DEFAULT NULL,
	fontsize3 tinyint(4) DEFAULT NULL,
	fontcolor1 varchar(6) DEFAULT NULL,
	fontcolor2 varchar(6) DEFAULT NULL,
	fontcolor3 varchar(6) DEFAULT NULL,
	span_class1 varchar(25) DEFAULT NULL,
	span_class2 varchar(25) DEFAULT NULL,
	span_class3 varchar(25) DEFAULT NULL,
	img_size_poll smallint(5) UNSIGNED,
	img_size_privmsg smallint(5) UNSIGNED,
	rcs_admincolor varchar(6) DEFAULT '' NOT NULL,
	rcs_modcolor varchar(6) DEFAULT '' NOT NULL,
	rcs_usercolor varchar(6) DEFAULT '' NOT NULL,
	rcs_botcolor varchar(6) DEFAULT '' NOT NULL,
	online_color varchar(6) DEFAULT '008500' NOT NULL,
	offline_color varchar(6) DEFAULT 'DF0000' NOT NULL,
	hidden_color varchar(6) DEFAULT 'EBD400' NOT NULL,
	theme_logo varchar(255) DEFAULT '' NOT NULL,
	PRIMARY KEY (themes_id)
);
