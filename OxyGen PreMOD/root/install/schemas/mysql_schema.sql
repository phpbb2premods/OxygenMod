#
# phpBB2 - MySQL schema
#
# $Id: mysql_schema.sql,v 1.35.2.12 2006/02/06 21:32:42 grahamje Exp $
#

#
# Table structure for table 'phpbb_attach_quota'
#
CREATE TABLE phpbb_attach_quota (
	user_id mediumint(8) unsigned NOT NULL DEFAULT '0',
	group_id mediumint(8) unsigned NOT NULL DEFAULT '0',
	quota_type smallint(2) NOT NULL DEFAULT '0',
	quota_limit_id mediumint(8) unsigned NOT NULL DEFAULT '0',
	KEY quota_type (quota_type)
);


#
# Table structure for table 'phpbb_attachments'
#
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


#
# Table structure for table 'phpbb_attachments_config'
#
CREATE TABLE phpbb_attachments_config (
	config_name varchar(255) NOT NULL,
	config_value varchar(255) NOT NULL,
	PRIMARY KEY (config_name)
);


#
# Table structure for table 'phpbb_attachments_desc'
#
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


#
# Table structure for table 'phpbb_attributes'
#
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


#
# Table structure for table 'phpbb_auth_access'
#
CREATE TABLE phpbb_auth_access (
	group_id mediumint(8) DEFAULT '0' NOT NULL,
	forum_id smallint(5) UNSIGNED DEFAULT '0' NOT NULL,
	auth_view tinyint(1) DEFAULT '0' NOT NULL,
	auth_read tinyint(1) DEFAULT '0' NOT NULL,
	auth_post tinyint(1) DEFAULT '0' NOT NULL,
	auth_reply tinyint(1) DEFAULT '0' NOT NULL,
	auth_edit tinyint(1) DEFAULT '0' NOT NULL,
	auth_delete tinyint(1) DEFAULT '0' NOT NULL,
	auth_sticky tinyint(1) DEFAULT '0' NOT NULL,
	auth_announce tinyint(1) DEFAULT '0' NOT NULL,
	auth_global_announce tinyint(1) DEFAULT '0' NOT NULL,
	auth_vote tinyint(1) DEFAULT '0' NOT NULL,
	auth_pollcreate tinyint(1) DEFAULT '0' NOT NULL,
	auth_attachments tinyint(1) DEFAULT '0' NOT NULL,
	auth_mod tinyint(1) DEFAULT '0' NOT NULL,
	auth_download tinyint(1) DEFAULT '0' NOT NULL,
	auth_bump tinyint(1) DEFAULT '0' NOT NULL,
	KEY group_id (group_id),
	KEY forum_id (forum_id)
);


#
# Table structure for table 'phpbb_banlist'
#
CREATE TABLE phpbb_banlist (
	ban_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	ban_userid mediumint(8) NOT NULL,
	ban_ip char(8) NOT NULL,
	ban_email varchar(255),
	PRIMARY KEY (ban_id),
	KEY ban_ip_user_id (ban_ip, ban_userid)
);


#
# Table structure for table 'phpbb_bbc_box'
#
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


#
# Table structure for table 'phpbb_bots'
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


#
# Table structure for table 'phpbb_categories'
#
CREATE TABLE phpbb_categories (
	cat_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	cat_title varchar(100),
	cat_order mediumint(8) UNSIGNED NOT NULL,
	PRIMARY KEY (cat_id),
	KEY cat_order (cat_order)
);


#
# Table structure for table 'phpbb_cf_ip_to_iso3661_1'
#
CREATE TABLE phpbb_cf_ip_to_iso3661_1 (
	ip_from int(11) unsigned NOT NULL DEFAULT '0',
	ip_to int(11) unsigned NOT NULL DEFAULT '0',
	iso3661_1 CHAR(2) NOT NULL,
	KEY ip_from (ip_from, ip_to)
);


#
# Table structure for table 'phpbb_config'
#
CREATE TABLE phpbb_config (
	config_name varchar(255) NOT NULL,
	config_value varchar(255) NOT NULL,
	PRIMARY KEY (config_name)
);


#
# Table structure for table 'phpbb_confirm'
#
CREATE TABLE phpbb_confirm (
	confirm_id char(32) DEFAULT '' NOT NULL,
	session_id char(32) DEFAULT '' NOT NULL,
	code char(6) DEFAULT '' NOT NULL, 
	PRIMARY KEY (session_id, confirm_id)
);


#
# Table structure for table 'phpbb_disallow'
#
CREATE TABLE phpbb_disallow (
	disallow_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	disallow_username varchar(25) DEFAULT '' NOT NULL,
	PRIMARY KEY (disallow_id)
);


#
# Table structure for table 'phpbb_ext_host'
#
CREATE TABLE phpbb_ext_host (
	ext_id mediumint(8) unsigned NOT NULL auto_increment,
	ext_name varchar(50) NOT NULL,
	ext_url varchar(150) NOT NULL,
	ext_ub tinyint(1) NOT NULL DEFAULT '0',
	ext_ubc text NOT NULL,
	ext_enabled tinyint(1) NOT NULL DEFAULT '0',
	PRIMARY KEY (ext_id)
);


#
# Table structure for table 'phpbb_extension_groups'
#
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


#
# Table structure for table 'phpbb_extensions'
#
CREATE TABLE phpbb_extensions (
	ext_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	group_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	extension varchar(100) NOT NULL,
	comment varchar(100),
	PRIMARY KEY ext_id (ext_id)
);


#
# Table structure for table 'phpbb_forbidden_extensions'
#
CREATE TABLE phpbb_forbidden_extensions (
	ext_id mediumint(8) UNSIGNED NOT NULL auto_increment, 
	extension varchar(100) NOT NULL, 
	PRIMARY KEY (ext_id)
);


#
# Table structure for table 'phpbb_forum_prune'
#
CREATE TABLE phpbb_forum_prune (
	prune_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	forum_id smallint(5) UNSIGNED NOT NULL,
	prune_days smallint(5) UNSIGNED NOT NULL,
	prune_freq smallint(5) UNSIGNED NOT NULL,
	PRIMARY KEY (prune_id),
	KEY forum_id (forum_id)
);


#
# Table structure for table 'phpbb_forums'
#
CREATE TABLE phpbb_forums (
	forum_id smallint(5) UNSIGNED NOT NULL,
	cat_id mediumint(8) UNSIGNED NOT NULL,
	forum_name varchar(150),
	forum_desc text,
	forum_status tinyint(4) DEFAULT '0' NOT NULL,
	forum_order mediumint(8) UNSIGNED DEFAULT '1' NOT NULL,
	forum_posts mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	forum_topics mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	forum_last_post_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	prune_next int(11),
	prune_enable tinyint(1) DEFAULT '0' NOT NULL,
	points_disabled tinyint(1) NOT NULL,
	auth_view tinyint(2) DEFAULT '0' NOT NULL,
	auth_read tinyint(2) DEFAULT '0' NOT NULL,
	auth_post tinyint(2) DEFAULT '0' NOT NULL,
	auth_reply tinyint(2) DEFAULT '0' NOT NULL,
	auth_edit tinyint(2) DEFAULT '0' NOT NULL,
	auth_delete tinyint(2) DEFAULT '0' NOT NULL,
	auth_sticky tinyint(2) DEFAULT '0' NOT NULL,
	auth_announce tinyint(2) DEFAULT '0' NOT NULL,
	auth_global_announce tinyint(2) DEFAULT '5' NOT NULL,
	auth_vote tinyint(2) DEFAULT '0' NOT NULL,
	auth_pollcreate tinyint(2) DEFAULT '0' NOT NULL,
	auth_attachments tinyint(2) DEFAULT '0' NOT NULL,
	forum_parent int(11) DEFAULT '0' NOT NULL,
	title_is_link tinyint(1) DEFAULT '0' NOT NULL,
	weblink varchar(200) NOT NULL,
	forum_link_count mediumint(8) unsigned NOT NULL,
	forum_link_target tinyint(1) DEFAULT 0 NOT NULL,
	forum_icon varchar(255) DEFAULT NULL,
	forum_qpes tinyint(1) DEFAULT '1' NOT NULL,
	auth_download tinyint(2) DEFAULT '0' NOT NULL,
	forum_color varchar(6) DEFAULT '' NOT NULL,
	forum_password varchar(20) DEFAULT '' NOT NULL,
	disable_word_censor tinyint(1) DEFAULT '0' NOT NULL,
	forum_display_sort tinyint(1) NOT NULL,
	forum_display_order tinyint(1) NOT NULL,
	forum_as_category mediumint(8) DEFAULT '0' NOT NULL,
	auth_bump tinyint(2) DEFAULT '0' NOT NULL,
	forum_template mediumint DEFAULT '0' NOT NULL,
	PRIMARY KEY (forum_id),
	KEY forums_order (forum_order),
	KEY cat_id (cat_id),
	KEY forum_last_post_id (forum_last_post_id)
);


#
# Table structure for table 'phpbb_groups'
#
CREATE TABLE phpbb_groups (
	group_id mediumint(8) NOT NULL auto_increment,
	group_type tinyint(4) DEFAULT '1' NOT NULL,
	group_name varchar(40) NOT NULL,
	group_description varchar(255) NOT NULL,
	group_moderator mediumint(8) DEFAULT '0' NOT NULL,
	group_single_user tinyint(1) DEFAULT '1' NOT NULL,
	group_color mediumint(8) DEFAULT '0' NOT NULL,
	PRIMARY KEY (group_id),
	KEY group_single_user (group_single_user)
);


#
# Table structure for table 'phpbb_guests_visit'
#
CREATE TABLE phpbb_guests_visit (
	guest_time INT(11) NOT NULL DEFAULT '0',
	guest_visit INT(11) NOT NULL DEFAULT '0',
	PRIMARY KEY (guest_time)
);


#
# Table structure for table 'phpbb_instant_msg'
#
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


#
# Table structure for table 'phpbb_jail_users'
#
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


#
# Table structure for table 'phpbb_jail_votes'
#
CREATE TABLE phpbb_jail_votes (
	vote_id mediumint(8) NOT NULL DEFAULT '0',
	voter_id mediumint(8) NOT NULL DEFAULT '0',
	vote_result mediumint(8) NOT NULL DEFAULT '0',
	KEY vote_id (vote_id),
	KEY voter_id (voter_id)
);


#
# Table structure for table 'phpbb_log'
#
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


#
# Table structure for table 'phpbb_log_config'
#
CREATE TABLE phpbb_log_config (
	config_name VARCHAR (255) NOT NULL,
	config_value VARCHAR (255) DEFAULT '',
	PRIMARY KEY (config_name)
);


#
# Table structure for table 'phpbb_posts'
#
CREATE TABLE phpbb_posts (
	post_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	topic_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	forum_id smallint(5) UNSIGNED DEFAULT '0' NOT NULL,
	poster_id mediumint(8) DEFAULT '0' NOT NULL,
	post_time int(11) DEFAULT '0' NOT NULL,
	poster_ip char(8) NOT NULL,
	post_username varchar(25),
	enable_bbcode tinyint(1) DEFAULT '1' NOT NULL,
	enable_html tinyint(1) DEFAULT '0' NOT NULL,
	enable_smilies tinyint(1) DEFAULT '1' NOT NULL,
	enable_sig tinyint(1) DEFAULT '1' NOT NULL,
	post_edit_time int(11),
	post_edit_count smallint(5) UNSIGNED DEFAULT '0' NOT NULL,
	post_icon tinyint(2) DEFAULT NULL,
	post_attachment tinyint(1) DEFAULT '0' NOT NULL,
	PRIMARY KEY (post_id),
	KEY forum_id (forum_id),
	KEY topic_id (topic_id),
	KEY poster_id (poster_id),
	KEY post_time (post_time),
	KEY post_icon (post_icon)
);


#
# Table structure for table 'phpbb_posts_text'
#
CREATE TABLE phpbb_posts_text (
	post_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	bbcode_uid char(10) DEFAULT '' NOT NULL,
	post_subject char(60),
	post_sub_title varchar(255) DEFAULT NULL,
	post_text mediumtext,
	PRIMARY KEY (post_id)
);


#
# Table structure for table 'phpbb_privmsgs'
#
CREATE TABLE phpbb_privmsgs (
	privmsgs_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	privmsgs_type tinyint(4) DEFAULT '0' NOT NULL,
	privmsgs_subject varchar(255) DEFAULT '0' NOT NULL,
	privmsgs_from_userid mediumint(8) DEFAULT '0' NOT NULL,
	privmsgs_to_userid mediumint(8) DEFAULT '0' NOT NULL,
	privmsgs_date int(11) DEFAULT '0' NOT NULL,
	privmsgs_ip char(8) NOT NULL,
	privmsgs_enable_bbcode tinyint(1) DEFAULT '1' NOT NULL,
	privmsgs_enable_html tinyint(1) DEFAULT '0' NOT NULL,
	privmsgs_enable_smilies tinyint(1) DEFAULT '1' NOT NULL,
	privmsgs_attach_sig tinyint(1) DEFAULT '1' NOT NULL,
	privmsgs_attachment tinyint(1) DEFAULT '0' NOT NULL,
	PRIMARY KEY (privmsgs_id),
	KEY privmsgs_from_userid (privmsgs_from_userid),
	KEY privmsgs_to_userid (privmsgs_to_userid)
);


#
# Table structure for table 'phpbb_privmsgs_text'
#
CREATE TABLE phpbb_privmsgs_text (
	privmsgs_text_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	privmsgs_bbcode_uid char(10) DEFAULT '0' NOT NULL,
	privmsgs_text mediumtext,
	PRIMARY KEY (privmsgs_text_id)
);


#
# Table structure for table 'phpbb_quota_limits'
#
CREATE TABLE phpbb_quota_limits (
	quota_limit_id mediumint(8) unsigned NOT NULL auto_increment,
	quota_desc varchar(20) NOT NULL DEFAULT '',
	quota_limit bigint(20) unsigned NOT NULL DEFAULT '0',
	PRIMARY KEY (quota_limit_id)
);


#
# Table structure for table 'phpbb_ranks'
#
CREATE TABLE phpbb_ranks (
	rank_id smallint(5) UNSIGNED NOT NULL auto_increment,
	rank_title varchar(50) NOT NULL,
	rank_min mediumint(8) DEFAULT '0' NOT NULL,
	rank_special tinyint(1) DEFAULT '0',
	rank_image varchar(255),
	PRIMARY KEY (rank_id)
);


#
# Table structure for table 'phpbb_rcs'
#
CREATE TABLE phpbb_rcs (
	rcs_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	rcs_name varchar(50) DEFAULT '' NOT NULL,
	rcs_color varchar(6) DEFAULT '' NOT NULL,
	rcs_single tinyint(1) DEFAULT '0' NOT NULL,
	rcs_display tinyint(1) DEFAULT '0' NOT NULL,
	rcs_order mediumint(8) UNSIGNED NOT NULL,
	PRIMARY KEY (rcs_id)
);


#
# Table structure for table 'phpbb_search_results'
#
CREATE TABLE phpbb_search_results (
	search_id int(11) UNSIGNED NOT NULL DEFAULT '0',
	session_id char(32) NOT NULL DEFAULT '',
	search_time int(11) DEFAULT '0' NOT NULL,
	search_array text NOT NULL,
	PRIMARY KEY  (search_id),
	KEY session_id (session_id)
);


#
# Table structure for table 'phpbb_search_wordlist'
#
CREATE TABLE phpbb_search_wordlist (
	word_text varchar(50) binary NOT NULL DEFAULT '',
	word_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	word_common tinyint(1) unsigned NOT NULL DEFAULT '0',
	PRIMARY KEY (word_text),
	KEY word_id (word_id)
);


#
# Table structure for table 'phpbb_search_wordmatch'
#
CREATE TABLE phpbb_search_wordmatch (
	post_id mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
	word_id mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
	title_match tinyint(1) NOT NULL DEFAULT '0',
	KEY post_id (post_id),
	KEY word_id (word_id)
);


#
# Table structure for table 'phpbb_sessions'
#
CREATE TABLE phpbb_sessions (
	session_id char(32) DEFAULT '' NOT NULL,
	session_user_id mediumint(8) DEFAULT '0' NOT NULL,
	session_start int(11) DEFAULT '0' NOT NULL,
	session_time int(11) DEFAULT '0' NOT NULL,
	session_ip char(8) DEFAULT '0' NOT NULL,
	session_page int(11) DEFAULT '0' NOT NULL,
	session_logged_in tinyint(1) DEFAULT '0' NOT NULL,
	session_admin tinyint(2) DEFAULT '0' NOT NULL,
	is_robot varchar(255) DEFAULT '0' NOT NULL,
	session_cf_iso3661_1 char(2) DEFAULT 'wo' NOT NULL,
	PRIMARY KEY (session_id),
	KEY session_user_id (session_user_id),
	KEY session_id_ip_user_id (session_id, session_ip, session_user_id)
);


#
# Table structure for table 'phpbb_sessions_keys'
#
CREATE TABLE phpbb_sessions_keys (
	key_id varchar(32) DEFAULT '0' NOT NULL,
	user_id mediumint(8) DEFAULT '0' NOT NULL,
	last_ip varchar(8) DEFAULT '0' NOT NULL,
	last_login int(11) DEFAULT '0' NOT NULL,
	PRIMARY KEY (key_id, user_id),
	KEY last_login (last_login)
);


#
# Table structure for table 'phpbb_shoutbox'
#
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


#
# Table structure for table 'phpbb_smilies'
#
CREATE TABLE phpbb_smilies (
	smilies_id smallint(5) unsigned NOT NULL auto_increment,
	code varchar(50) DEFAULT NULL,
	smile_url varchar(100) DEFAULT NULL,
	emoticon varchar(75) DEFAULT NULL,
	cat_id smallint(5) NOT NULL DEFAULT '1',
	smilies_order smallint(5) NOT NULL DEFAULT '0',
	PRIMARY KEY (smilies_id)
);


#
# Table structure for table 'phpbb_smilies_cat'
#
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


#
# Table structure for table 'phpbb_themes'
#
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


#
# Table structure for table 'phpbb_themes_name'
#
CREATE TABLE phpbb_themes_name (
	themes_id smallint(5) UNSIGNED DEFAULT '0' NOT NULL,
	tr_color1_name char(50),
	tr_color2_name char(50),
	tr_color3_name char(50),
	tr_class1_name char(50),
	tr_class2_name char(50),
	tr_class3_name char(50),
	th_color1_name char(50),
	th_color2_name char(50),
	th_color3_name char(50),
	th_class1_name char(50),
	th_class2_name char(50),
	th_class3_name char(50),
	td_color1_name char(50),
	td_color2_name char(50),
	td_color3_name char(50),
	td_class1_name char(50),
	td_class2_name char(50),
	td_class3_name char(50),
	fontface1_name char(50),
	fontface2_name char(50),
	fontface3_name char(50),
	fontsize1_name char(50),
	fontsize2_name char(50),
	fontsize3_name char(50),
	fontcolor1_name char(50),
	fontcolor2_name char(50),
	fontcolor3_name char(50),
	span_class1_name char(50),
	span_class2_name char(50),
	span_class3_name char(50),
	PRIMARY KEY (themes_id)
);


#
# Table structure for table 'phpbb_topics'
#
CREATE TABLE phpbb_topics (
	topic_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	forum_id smallint(8) UNSIGNED DEFAULT '0' NOT NULL,
	topic_title char(60) NOT NULL,
	topic_sub_title varchar(255) NOT NULL,
	topic_poster mediumint(8) DEFAULT '0' NOT NULL,
	topic_time int(11) DEFAULT '0' NOT NULL,
	topic_views mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	topic_replies mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	topic_status tinyint(3) DEFAULT '0' NOT NULL,
	topic_vote tinyint(1) DEFAULT '0' NOT NULL,
	topic_type tinyint(3) DEFAULT '0' NOT NULL,
	topic_first_post_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	topic_last_post_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	topic_moved_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	topic_icon tinyint(2) DEFAULT NULL,
	topic_attribute VARCHAR(255),
	topic_attribute_color VARCHAR(6) DEFAULT '' NOT NULL,
	topic_attribute_position TINYINT(1) DEFAULT '0' NOT NULL,
	topic_attribute_username VARCHAR(25) DEFAULT '' NOT NULL,
	topic_attribute_date VARCHAR(25) DEFAULT '0' NOT NULL,
	topic_attachment tinyint(1) DEFAULT '0' NOT NULL,
	topic_last_post_time integer(11) UNSIGNED DEFAULT '0' NOT NULL,
	topic_bumped tinyint(1) UNSIGNED DEFAULT '0' NOT NULL,
	topic_bumper mediumint(8) DEFAULT '0' NOT NULL,
	PRIMARY KEY (topic_id),
	KEY forum_id (forum_id),
	KEY topic_moved_id (topic_moved_id),
	KEY topic_status (topic_status),
	KEY topic_type (topic_type)
);


#
# Table structure for table 'phpbb_topics_watch'
#
CREATE TABLE phpbb_topics_watch (
	topic_id mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
	user_id mediumint(8) NOT NULL DEFAULT '0',
	notify_status tinyint(1) NOT NULL DEFAULT '0',
	KEY topic_id (topic_id),
	KEY user_id (user_id),
	KEY notify_status (notify_status)
);


#
# Table structure for table 'phpbb_user_group'
#
CREATE TABLE phpbb_user_group (
	group_id mediumint(8) DEFAULT '0' NOT NULL,
	user_id mediumint(8) DEFAULT '0' NOT NULL,
	user_pending tinyint(1),
	group_moderator tinyint(1) NOT NULL,
	KEY group_id (group_id),
	KEY user_id (user_id)
);


#
# Table structure for table 'phpbb_users'
#
CREATE TABLE phpbb_users (
	user_id mediumint(8) NOT NULL,
	user_active tinyint(1) DEFAULT '1',
	username varchar(25) NOT NULL,
	user_password varchar(32) NOT NULL,
	user_session_time int(11) DEFAULT '0' NOT NULL,
	user_session_page smallint(5) DEFAULT '0' NOT NULL,
	user_lastvisit int(11) DEFAULT '0' NOT NULL,
	user_regdate int(11) DEFAULT '0' NOT NULL,
	user_level tinyint(4) DEFAULT '0',
	user_posts mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	user_timezone decimal(5,2) DEFAULT '0' NOT NULL,
	user_style tinyint(4),
	user_lang varchar(255),
	user_dateformat varchar(14) DEFAULT 'd M Y H:i' NOT NULL,
	user_new_privmsg smallint(5) UNSIGNED DEFAULT '0' NOT NULL,
	user_unread_privmsg smallint(5) UNSIGNED DEFAULT '0' NOT NULL,
	user_last_privmsg int(11) DEFAULT '0' NOT NULL,
	user_login_tries smallint(5) UNSIGNED DEFAULT '0' NOT NULL,
	user_last_login_try int(11) DEFAULT '0' NOT NULL,
	user_emailtime int(11),
	user_viewemail tinyint(1),
	user_attachsig tinyint(1) DEFAULT NULL,
	user_allowhtml tinyint(1) DEFAULT '1',
	user_allowbbcode tinyint(1) DEFAULT '1',
	user_allowsmile tinyint(1) DEFAULT '1',
	user_postspp varchar(4) DEFAULT NULL,
	user_topicspp varchar(4) DEFAULT NULL,
	user_allowavatar tinyint(1) DEFAULT '1' NOT NULL,
	user_allow_pm tinyint(1) DEFAULT '1' NOT NULL,
	user_allow_viewonline tinyint(1) DEFAULT '1' NOT NULL,
	user_notify tinyint(1) DEFAULT '1' NOT NULL,
	user_notify_pm tinyint(1) DEFAULT '0' NOT NULL,
	user_notify_donation tinyint(1) NOT NULL,
	user_popup_pm tinyint(1) DEFAULT '0' NOT NULL,
	user_rank int(11) DEFAULT '0',
	user_avatar varchar(100),
	user_avatar_type tinyint(4) DEFAULT '0' NOT NULL,
	user_email varchar(255),
	user_icq varchar(15),
	user_website varchar(100),
	user_from varchar(100),
	user_sig text,
	user_sig_bbcode_uid char(10),
	user_aim varchar(255),
	user_yim varchar(255),
	user_msnm varchar(255),
	user_skype varchar(255),
	user_occ varchar(100),
	user_interests varchar(255),
	user_actkey varchar(32),
	user_newpasswd varchar(32),
	user_unread_topics text,
	user_color mediumint(8) DEFAULT '0' NOT NULL,
	user_group_id mediumint(8) DEFAULT '0' NOT NULL,
	user_admin_notes text NOT NULL,
	user_qp_settings varchar(25) DEFAULT '1-0-1-1-1-1' NOT NULL,
	user_cf_iso3661_1 char(2) DEFAULT 'wo' NOT NULL,
	user_lastlogin int(11) DEFAULT '0' NOT NULL,
	user_birthday varchar(10) DEFAULT '' NOT NULL,
	user_inactive_emls tinyint(1) NOT NULL,
	user_inactive_last_eml int(11) NOT NULL,
	user_namechange tinyint(1) DEFAULT '0',
	user_points int(11) NOT NULL,
	admin_allow_points tinyint(1) DEFAULT '1' NOT NULL,
	user_cell_time int(11) DEFAULT '0' NOT NULL,
	user_cell_time_judgement int(11) DEFAULT '0' NOT NULL,
	user_cell_caution int(8) DEFAULT '0' NOT NULL,
	user_cell_sentence text,
	user_cell_enable_caution int(8) DEFAULT '0' NOT NULL,
	user_cell_enable_free int(8) DEFAULT '0' NOT NULL,
	user_cell_celleds int(8) DEFAULT '0' NOT NULL,
	user_cell_punishment tinyint(1) DEFAULT '0' NOT NULL,
	user_gender tinyint(4) DEFAULT '0' NOT NULL,
	user_iprange varchar(255) DEFAULT NULL,
	user_restrictip tinyint(1) DEFAULT '0' NOT NULL,
	user_mailchange tinyint(1) DEFAULT '0',
	user_passwordchange tinyint(1) DEFAULT '0',
	user_topics mediumint(8) DEFAULT '0' NOT NULL,
	user_boulet varchar(255) DEFAULT '0' NOT NULL,
	user_regip char(8) DEFAULT '0' NOT NULL,
	user_account_delete tinyint(1) DEFAULT '0',
	user_warn INT(2) NOT NULL,
	PRIMARY KEY (user_id),
	KEY user_session_time (user_session_time)
);


#
# Table structure for table 'phpbb_vote_desc'
#
CREATE TABLE phpbb_vote_desc (
	vote_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	topic_id mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
	vote_text text NOT NULL,
	vote_start int(11) NOT NULL DEFAULT '0',
	vote_length int(11) NOT NULL DEFAULT '0',
	PRIMARY KEY (vote_id),
	KEY topic_id (topic_id)
);


#
# Table structure for table 'phpbb_vote_results'
#
CREATE TABLE phpbb_vote_results (
	vote_id mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
	vote_option_id tinyint(4) UNSIGNED NOT NULL DEFAULT '0',
	vote_option_text varchar(255) NOT NULL,
	vote_result int(11) NOT NULL DEFAULT '0',
	KEY vote_option_id (vote_option_id),
	KEY vote_id (vote_id)
);


#
# Table structure for table 'phpbb_vote_voters'
#
CREATE TABLE phpbb_vote_voters (
	vote_id mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
	vote_user_id mediumint(8) NOT NULL DEFAULT '0',
	vote_user_ip char(8) NOT NULL,
	vote_cast tinyint(4) unsigned NOT NULL DEFAULT '0',
	KEY vote_id (vote_id),
	KEY vote_user_id (vote_user_id),

	KEY vote_user_ip (vote_user_ip)
);


#
# Table structure for table 'phpbb_words'
#
CREATE TABLE phpbb_words (
	word_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	word char(100) NOT NULL,
	replacement char(100) NOT NULL,
	PRIMARY KEY (word_id)
);
