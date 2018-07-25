
#
#-----[ Delete SQL Entries ]----------------------------------------------------
#
ALTER TABLE phpbb_auth_access DROP auth_ban;
ALTER TABLE phpbb_auth_access DROP auth_greencard;
ALTER TABLE phpbb_auth_access DROP auth_bluecard;

DELETE FROM phpbb_bbc_box WHERE bbc_id = 23;

ALTER TABLE phpbb_categories DROP include_on_index;

ALTER TABLE phpbb_forums DROP auth_ban;
ALTER TABLE phpbb_forums DROP auth_greencard;
ALTER TABLE phpbb_forums DROP auth_bluecard;
ALTER TABLE phpbb_forums DROP forum_views;

ALTER TABLE phpbb_groups DROP group_allow_pm;

ALTER TABLE phpbb_posts DROP post_bluecard;

ALTER TABLE phpbb_sessions DROP session_agent;

ALTER TABLE phpbb_topics DROP topic_announce_duration;

ALTER TABLE phpbb_users DROP user_allow_mass_pm;
ALTER TABLE phpbb_users DROP ct_logintry;
ALTER TABLE phpbb_users DROP ct_unsucclogin;
ALTER TABLE phpbb_users DROP ct_pwreset;
ALTER TABLE phpbb_users DROP ct_mailcount;
ALTER TABLE phpbb_users DROP ct_postcount;
ALTER TABLE phpbb_users DROP ct_posttime;
ALTER TABLE phpbb_users DROP ct_searchcount;
ALTER TABLE phpbb_users DROP ct_searchtime;
ALTER TABLE phpbb_users DROP user_situation;
ALTER TABLE phpbb_users DROP user_announcement_date_display;
ALTER TABLE phpbb_users DROP user_announcement_display;
ALTER TABLE phpbb_users DROP user_announcement_display_forum;
ALTER TABLE phpbb_users DROP user_announcement_split;
ALTER TABLE phpbb_users DROP user_announcement_forum;
ALTER TABLE phpbb_users DROP user_regles;
ALTER TABLE phpbb_users DROP user_time_mode;
ALTER TABLE phpbb_users DROP user_dst_time_lag;
ALTER TABLE phpbb_users DROP user_pc_timeOffsets;
ALTER TABLE phpbb_users DROP user_split_global_announce;
ALTER TABLE phpbb_users DROP user_split_announce;
ALTER TABLE phpbb_users DROP user_split_sticky;
ALTER TABLE phpbb_users DROP user_split_topic_split;
ALTER TABLE phpbb_users DROP user_trashbox;
ALTER TABLE phpbb_users DROP user_custom_gamesize;

ALTER TABLE phpbb_vote_desc DROP vote_hide;

DELETE FROM phpbb_themes WHERE themes_id = '1';

#
#-----[ Delete SQL phpbb_config Entries ]---------------------------------------
#
DELETE FROM phpbb_config WHERE config_name = 'account_delete';
DELETE FROM phpbb_config WHERE config_name = 'activeportail';
DELETE FROM phpbb_config WHERE config_name = 'admin_notes';
DELETE FROM phpbb_config WHERE config_name = 'announcement_date_display';
DELETE FROM phpbb_config WHERE config_name = 'announcement_date_display_over';
DELETE FROM phpbb_config WHERE config_name = 'announcement_display';
DELETE FROM phpbb_config WHERE config_name = 'announcement_display_forum';
DELETE FROM phpbb_config WHERE config_name = 'announcement_display_forum_over';
DELETE FROM phpbb_config WHERE config_name = 'announcement_display_over';
DELETE FROM phpbb_config WHERE config_name = 'announcement_duration';
DELETE FROM phpbb_config WHERE config_name = 'announcement_forum';
DELETE FROM phpbb_config WHERE config_name = 'announcement_forum_over';
DELETE FROM phpbb_config WHERE config_name = 'announcement_last_prune';
DELETE FROM phpbb_config WHERE config_name = 'announcement_prune_strategy';
DELETE FROM phpbb_config WHERE config_name = 'announcement_split';
DELETE FROM phpbb_config WHERE config_name = 'announcement_split_over';
DELETE FROM phpbb_config WHERE config_name = 'bluecard_limit';
DELETE FROM phpbb_config WHERE config_name = 'bluecard_limit_2';
DELETE FROM phpbb_config WHERE config_name = 'cash_adminbig';
DELETE FROM phpbb_config WHERE config_name = 'cash_adminnavbar';
DELETE FROM phpbb_config WHERE config_name = 'cash_disable';
DELETE FROM phpbb_config WHERE config_name = 'cash_disable_spam_message';
DELETE FROM phpbb_config WHERE config_name = 'cash_disable_spam_num';
DELETE FROM phpbb_config WHERE config_name = 'cash_disable_spam_time';
DELETE FROM phpbb_config WHERE config_name = 'cash_display_after_posts';
DELETE FROM phpbb_config WHERE config_name = 'cash_installed';
DELETE FROM phpbb_config WHERE config_name = 'cash_post_message';
DELETE FROM phpbb_config WHERE config_name = 'cash_version';
DELETE FROM phpbb_config WHERE config_name = 'dbmtnc_disallow_postcounter';
DELETE FROM phpbb_config WHERE config_name = 'dbmtnc_disallow_rebuild';
DELETE FROM phpbb_config WHERE config_name = 'dbmtnc_rebuildcfg_maxmemory';
DELETE FROM phpbb_config WHERE config_name = 'dbmtnc_rebuildcfg_minposts';
DELETE FROM phpbb_config WHERE config_name = 'dbmtnc_rebuildcfg_php3only';
DELETE FROM phpbb_config WHERE config_name = 'dbmtnc_rebuildcfg_php3pps';
DELETE FROM phpbb_config WHERE config_name = 'dbmtnc_rebuildcfg_php4pps';
DELETE FROM phpbb_config WHERE config_name = 'dbmtnc_rebuildcfg_timelimit';
DELETE FROM phpbb_config WHERE config_name = 'dbmtnc_rebuildcfg_timeoverwrite';
DELETE FROM phpbb_config WHERE config_name = 'dbmtnc_rebuild_end';
DELETE FROM phpbb_config WHERE config_name = 'dbmtnc_rebuild_pos';
DELETE FROM phpbb_config WHERE config_name = 'default_dst_time_lag';
DELETE FROM phpbb_config WHERE config_name = 'default_time_mode';
DELETE FROM phpbb_config WHERE config_name = 'description_sujet';
DELETE FROM phpbb_config WHERE config_name = 'forum_logo';
DELETE FROM phpbb_config WHERE config_name = 'hacks_list_access';
DELETE FROM phpbb_config WHERE config_name = 'hypercell_onclick';
DELETE FROM phpbb_config WHERE config_name = 'invite_only';
DELETE FROM phpbb_config WHERE config_name = 'live_email_validation';
DELETE FROM phpbb_config WHERE config_name = 'login_locked_out';
DELETE FROM phpbb_config WHERE config_name = 'login_tries';
DELETE FROM phpbb_config WHERE config_name = 'login_try';
DELETE FROM phpbb_config WHERE config_name = 'max_user_bancard';
DELETE FROM phpbb_config WHERE config_name = 'maxsize_avatar';
DELETE FROM phpbb_config WHERE config_name = 'news_forum';
DELETE FROM phpbb_config WHERE config_name = 'news_length';
DELETE FROM phpbb_config WHERE config_name = 'number_of_news';
DELETE FROM phpbb_config WHERE config_name = 'number_recent_topics';
DELETE FROM phpbb_config WHERE config_name = 'override_pm_trashbox';
DELETE FROM phpbb_config WHERE config_name = 'override_situation';
DELETE FROM phpbb_config WHERE config_name = 'oxytanium_version';
DELETE FROM phpbb_config WHERE config_name = 'profile_options_access';
DELETE FROM phpbb_config WHERE config_name = 'prune_shouts';
DELETE FROM phpbb_config WHERE config_name = 'regles_forum_protect';
DELETE FROM phpbb_config WHERE config_name = 'regles_required';
DELETE FROM phpbb_config WHERE config_name = 'regles_topic';
DELETE FROM phpbb_config WHERE config_name = 'report_forum';
DELETE FROM phpbb_config WHERE config_name = 'sai_template';
DELETE FROM phpbb_config WHERE config_name = 'situation_required';
DELETE FROM phpbb_config WHERE config_name = 'split_announce_over';
DELETE FROM phpbb_config WHERE config_name = 'split_global_announce_over';
DELETE FROM phpbb_config WHERE config_name = 'split_sticky_over';
DELETE FROM phpbb_config WHERE config_name = 'split_topic_split_over';
DELETE FROM phpbb_config WHERE config_name = 'today_day_selected';
DELETE FROM phpbb_config WHERE config_name = 'welcome_text';
DELETE FROM phpbb_config WHERE config_name = 'arcade_access';
DELETE FROM phpbb_config WHERE config_name = 'cagnotte';
DELETE FROM phpbb_config WHERE config_name = 'category_preview_games';
DELETE FROM phpbb_config WHERE config_name = 'cat_use';
DELETE FROM phpbb_config WHERE config_name = 'championnat_cat';
DELETE FROM phpbb_config WHERE config_name = 'championnat_points_five';
DELETE FROM phpbb_config WHERE config_name = 'championnat_points_four';
DELETE FROM phpbb_config WHERE config_name = 'championnat_points_one';
DELETE FROM phpbb_config WHERE config_name = 'championnat_points_three';
DELETE FROM phpbb_config WHERE config_name = 'championnat_points_two';
DELETE FROM phpbb_config WHERE config_name = 'championnat_taux_cinq';
DELETE FROM phpbb_config WHERE config_name = 'championnat_taux_deux';
DELETE FROM phpbb_config WHERE config_name = 'championnat_taux_dix';
DELETE FROM phpbb_config WHERE config_name = 'championnat_taux_huit';
DELETE FROM phpbb_config WHERE config_name = 'championnat_taux_neuf';
DELETE FROM phpbb_config WHERE config_name = 'championnat_taux_quatre';
DELETE FROM phpbb_config WHERE config_name = 'championnat_taux_sept';
DELETE FROM phpbb_config WHERE config_name = 'championnat_taux_six';
DELETE FROM phpbb_config WHERE config_name = 'championnat_taux_trois';
DELETE FROM phpbb_config WHERE config_name = 'championnat_taux_un';
DELETE FROM phpbb_config WHERE config_name = 'custom_gamesize_active_big';
DELETE FROM phpbb_config WHERE config_name = 'custom_gamesize_active_small';
DELETE FROM phpbb_config WHERE config_name = 'custom_gamesize_big_height';
DELETE FROM phpbb_config WHERE config_name = 'custom_gamesize_big_width';
DELETE FROM phpbb_config WHERE config_name = 'custom_gamesize_default';
DELETE FROM phpbb_config WHERE config_name = 'custom_gamesize_normal_height';
DELETE FROM phpbb_config WHERE config_name = 'custom_gamesize_normal_width';
DELETE FROM phpbb_config WHERE config_name = 'custom_gamesize_small_height';
DELETE FROM phpbb_config WHERE config_name = 'custom_gamesize_small_width';
DELETE FROM phpbb_config WHERE config_name = 'date_distribcagnotte';
DELETE FROM phpbb_config WHERE config_name = 'days_limit';
DELETE FROM phpbb_config WHERE config_name = 'day_distrib';
DELETE FROM phpbb_config WHERE config_name = 'display_winner_avatar';
DELETE FROM phpbb_config WHERE config_name = 'fav_nbr_in_page';
DELETE FROM phpbb_config WHERE config_name = 'games_par_page';
DELETE FROM phpbb_config WHERE config_name = 'game_order';
DELETE FROM phpbb_config WHERE config_name = 'last_seen';
DELETE FROM phpbb_config WHERE config_name = 'limit_by_posts';
DELETE FROM phpbb_config WHERE config_name = 'limit_type';
DELETE FROM phpbb_config WHERE config_name = 'linkcat_align';
DELETE FROM phpbb_config WHERE config_name = 'nbr_games_fav';
DELETE FROM phpbb_config WHERE config_name = 'pay_all_games';
DELETE FROM phpbb_config WHERE config_name = 'points_pay';
DELETE FROM phpbb_config WHERE config_name = 'points_winner';
DELETE FROM phpbb_config WHERE config_name = 'poll_forum';
DELETE FROM phpbb_config WHERE config_name = 'posts_needed';
DELETE FROM phpbb_config WHERE config_name = 'prize_all_games';
DELETE FROM phpbb_config WHERE config_name = 'stat_par_page';
DELETE FROM phpbb_config WHERE config_name = 'use_auto_distrib';
DELETE FROM phpbb_config WHERE config_name = 'use_cagnotte_mod';
DELETE FROM phpbb_config WHERE config_name = 'use_category_mod';
DELETE FROM phpbb_config WHERE config_name = 'use_fav_category';
DELETE FROM phpbb_config WHERE config_name = 'use_hide_fav';
DELETE FROM phpbb_config WHERE config_name = 'use_points_cagnotte';
DELETE FROM phpbb_config WHERE config_name = 'use_points_mod';
DELETE FROM phpbb_config WHERE config_name = 'use_points_pay_charging';
DELETE FROM phpbb_config WHERE config_name = 'use_points_pay_mod';
DELETE FROM phpbb_config WHERE config_name = 'use_points_pay_submit';
DELETE FROM phpbb_config WHERE config_name = 'use_points_win_mod';
DELETE FROM phpbb_config WHERE config_name = 'winner_avatar_position';

#
#-----[ Modify SQL Entries ]----------------------------------------------------
#
RENAME TABLE phpbb_title_infos TO phpbb_attributes;

ALTER TABLE phpbb_attributes CHANGE id attribute_id INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE phpbb_attributes CHANGE title_info attribute VARCHAR(255) NOT NULL;
ALTER TABLE phpbb_attributes CHANGE color attribute_color VARCHAR(6) NOT NULL;
ALTER TABLE phpbb_attributes CHANGE date_format attribute_date_format VARCHAR(25) NOT NULL;
ALTER TABLE phpbb_attributes CHANGE position attribute_position TINYINT(1) NOT NULL DEFAULT 0;
ALTER TABLE phpbb_attributes CHANGE administrator attribute_administrator TINYINT(1) DEFAULT 0;
ALTER TABLE phpbb_attributes CHANGE moderator attribute_moderator TINYINT(1) DEFAULT 0;
ALTER TABLE phpbb_attributes CHANGE author attribute_author TINYINT(1) DEFAULT 0;
ALTER TABLE phpbb_attributes DROP INDEX id, ADD PRIMARY KEY (attribute_id);
ALTER TABLE phpbb_attributes ADD attribute_order INT(11) DEFAULT '0' NOT NULL;

ALTER TABLE phpbb_forums CHANGE auth_global_announce auth_global_announce TINYINT(2) NOT NULL DEFAULT '5';
ALTER TABLE phpbb_posts_text CHANGE post_description post_sub_title VARCHAR(255);
ALTER TABLE phpbb_search_results CHANGE search_array MEDIUMTEXT NOT NULL;
ALTER TABLE phpbb_topics CHANGE topic_description topic_sub_title VARCHAR(255) NOT NULL;
ALTER TABLE phpbb_topics CHANGE title_compl_infos topic_attribute VARCHAR(255);
ALTER TABLE phpbb_topics CHANGE title_compl_color topic_attribute_color VARCHAR(6) DEFAULT '' NOT NULL;
ALTER TABLE phpbb_topics CHANGE title_pos topic_attribute_position TINYINT(1) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_users CHANGE user_warnings user_warn INT(2) NOT NULL DEFAULT '0';
#
#-----[ Add SQL Entries ]--------------------------------------------------------
#
ALTER TABLE phpbb_auth_access ADD auth_bump TINYINT(1) NOT NULL DEFAULT '0';

INSERT INTO phpbb_bbc_box (bbc_id, bbc_name, bbc_value, bbc_auth, bbc_before, bbc_after, bbc_helpline, bbc_img, bbc_divider, bbc_order) VALUES (25, 'youtube', '1', '0', 'youtube', 'youtube', 'youtube', 'youtube', '0', '250');

INSERT INTO phpbb_bots (bot_id, bot_name, bot_agent, last_visit, bot_visits, bot_pages, pending_agent, pending_ip, bot_ip, bot_style) VALUES (1, 'GoogleBot', 'Google', '', '0', '0', '', '', '66.249', '1');
INSERT INTO phpbb_bots (bot_id, bot_name, bot_agent, last_visit, bot_visits, bot_pages, pending_agent, pending_ip, bot_ip, bot_style) VALUES (2, 'MSNBot', 'msnbot/', '', '0', '0', '', '', '207.68.146|64.4.8|65.54.188', '1');
INSERT INTO phpbb_bots (bot_id, bot_name, bot_agent, last_visit, bot_visits, bot_pages, pending_agent, pending_ip, bot_ip, bot_style) VALUES (3, 'Ask Jeeves', 'teoma', '', '0', '0', '', '', '65.214.36|65.214.37|65.214.38|65.214.39', '1');
INSERT INTO phpbb_bots (bot_id, bot_name, bot_agent, last_visit, bot_visits, bot_pages, pending_agent, pending_ip, bot_ip, bot_style) VALUES (4, 'Yahoo! Slurp', 'Yahoo', '', '0', '0', '', '', '66.196|68.142|202.160', '1');

ALTER TABLE phpbb_forums ADD points_disabled TINYINT(1) NOT NULL AFTER prune_enable;
ALTER TABLE phpbb_forums ADD title_is_link TINYINT(1) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_forums ADD weblink VARCHAR(200) NOT NULL;
ALTER TABLE phpbb_forums ADD forum_link_count MEDIUMINT(8) UNSIGNED NOT NULL;
ALTER TABLE phpbb_forums ADD forum_as_category MEDIUMINT(8) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_forums ADD auth_bump TINYINT(2) NOT NULL DEFAULT '0';
ALTER TABLE phpbb_forums ADD forum_link_target TINYINT(1) DEFAULT 0 NOT NULL;
ALTER TABLE phpbb_forums ADD forum_template MEDIUMINT(8) DEFAULT '0' NOT NULL;

ALTER TABLE phpbb_instant_msg ADD bbcode_uid VARCHAR(10) NOT NULL AFTER message;
ALTER TABLE phpbb_instant_msg ADD enable_bbcode TINYINT (1) NOT NULL AFTER bbcode_uid;
ALTER TABLE phpbb_instant_msg ADD enable_smilies TINYINT (1) NOT NULL AFTER enable_bbcode;

INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_admin', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_admin_ban', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_admin_config', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_admin_email', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_admin_forum_creation', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_admin_forum_deletion', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_admin_forum_edit', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_admin_prune', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_admin_user_manage', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_admins_config', '0');
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_admins_del', '0');
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_admins_view', '0');
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_error', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_error_critical', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_error_general', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_error_prune', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_email_send', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_last_prune', '0');
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_mod', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_mod_delete', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_mod_edit', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_mod_lock', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_mod_move', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_mod_prune', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_mod_unlock', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_mod_version', '0.3.1');
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_msgdie_hide', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_prune_days', '30');
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_super_admins', '2');
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_user', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_user_delete', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_user_edit', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_user_fail_login', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_user_login', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_user_logout', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_user_newtopic', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_user_profile', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_user_prune', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_user_register', 1);
INSERT INTO phpbb_log_config (config_name, config_value) VALUES ('log_view_per_page', '50');

ALTER TABLE phpbb_rcs CHANGE rcs_order rcs_order mediumint(8) UNSIGNED NOT NULL;

ALTER TABLE phpbb_sessions ADD is_robot VARCHAR(255) DEFAULT '0' NOT NULL;

ALTER TABLE phpbb_themes ADD rcs_botcolor varchar(6) DEFAULT '000000' NOT NULL AFTER rcs_usercolor;

ALTER TABLE phpbb_topics ADD topic_attribute_username VARCHAR(25) DEFAULT '' NOT NULL;
ALTER TABLE phpbb_topics ADD topic_attribute_date VARCHAR(25) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_topics ADD topic_last_post_time INTEGER(11) UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE phpbb_topics ADD topic_bumped TINYINT(1) UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE phpbb_topics ADD topic_bumper MEDIUMINT(8) NOT NULL DEFAULT '0';

ALTER TABLE phpbb_users ADD user_notify_donation TINYINT(1) NOT NULL;
ALTER TABLE phpbb_users ADD user_namechange TINYINT(1) DEFAULT '0';
ALTER TABLE phpbb_users ADD user_points INT(11) NOT NULL;
ALTER TABLE phpbb_users ADD admin_allow_points TINYINT(1) NOT NULL DEFAULT '1';
ALTER TABLE phpbb_users ADD user_iprange VARCHAR(255);
ALTER TABLE phpbb_users ADD user_restrictip TINYINT(1) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_users ADD user_mailchange TINYINT(1) DEFAULT '0';
ALTER TABLE phpbb_users ADD user_passwordchange TINYINT(1) DEFAULT '0';
ALTER TABLE phpbb_users ADD user_account_delete TINYINT(1) DEFAULT '0';
ALTER TABLE phpbb_users ADD user_lastlogin INT(11) DEFAULT 0 NOT NULL;

INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg, rcs_admincolor, rcs_modcolor, rcs_usercolor, online_color, offline_color, hidden_color, theme_logo, rcs_botcolor) VALUES (1, 'subSilverPlus', 'subSilverPlus', 'subSilverPlus.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, ''Courier New'', sans-serif', 10, 11, 12, '444444', '006600', 'FFA34F', '', '', '', NULL, NULL, 'CC0000', '006600', '006699', '008500', 'DF0000', 'EBD400', 'templates/subSilverPlus/images/header/logo_phpBB.gif', '000000');

#
#-----[ Update SQL Entries ]----------------------------------------------------
#
UPDATE phpbb_attachments_config SET config_value = '2.4.5' WHERE config_name = 'attach_version';

UPDATE phpbb_config SET config_value = '.0.22' WHERE config_name = 'version';

UPDATE phpbb_users SET user_lastlogin = user_lastvisit WHERE user_lastlogin = '0';
UPDATE phpbb_users SET user_style = 1;

#
#-----[ Add SQL Entries in phpbb_config ]---------------------------------------
#
INSERT INTO phpbb_config (config_name, config_value) VALUES ('administrator_max_inbox_privmsgs', '500');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('administrator_max_savebox_privmsgs', '500');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('administrator_max_sentbox_privmsgs', '500');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('administrator_max_trashbox_privmsgs', '500');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('annonce_globale_index', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_disable_caption', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_disable_text', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('bump_type', 'd');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('bump_interval', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('card_max', '4');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('instant_msg_delay', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('instant_msg_enable', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('instant_msg_refresh_time', '30');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('last_topic_title_length', '25');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_subforums', '3');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_author', 'Forum Meta Tags v1.0.2');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_description', 'The description of your site.');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_keywords', 'keywords, seperated, by, commas');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_language', 'en');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_rating', 'General');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_robots', 'index, follow');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_visit_after', '7 days');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('moderator_max_inbox_privmsgs', '250');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('moderator_max_savebox_privmsgs', '250');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('moderator_max_sentbox_privmsgs', '250');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('moderator_max_trashbox_privmsgs', '250');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_notify_on_donation', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('oxygen_version', '1.1.0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('points_browse', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('points_donate', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('points_page', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('points_post', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_quick_post', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('points_reply', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('points_topic', '2');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('points_user_group_auth_ids', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('removed_users', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('reply_flood_ctrl', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('required_posts_per_page', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('required_signature', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('required_topics_per_page', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_allow_bbcode', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_allow_guest', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_allow_guest_view', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_allow_delete', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_allow_delete_all', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_allow_edit', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_allow_edit_all', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_allow_smilies', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_banned_user_id', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_banned_user_id_view', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_date_format', '|d M Y| H:i');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_date_on', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_delete_days', '30');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_height', '170');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_links_names', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_make_links', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_messages_number_on_index', '20');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_on', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_refresh_time', '120');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_text_lenght', '500');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_width', '100%');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_word_lenght', '90');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sub_title_length', '100');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('viewonline_access', '-1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('wpm_active', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('wpm_message', 'Bonjour [username] !\r\nBienvenue sur [sitename] !\r\nSi vous avez des questions sur ce site, n''hésitez pas à le demander !');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('wpm_subject', 'Bienvenue sur [sitename] !');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('wpm_userid', '-1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('wpm_username', 'Anonymous');

#
#-----[ Update SQL Entries in phpbb_config ]------------------------------------
#
UPDATE phpbb_config SET config_value = '1' WHERE config_name = 'allow_namechange';
UPDATE phpbb_config SET config_value = '-1' WHERE config_name = 'cell_access';
UPDATE phpbb_config SET config_value = '|d M Y| H:i' WHERE config_name = 'default_dateformat';
UPDATE phpbb_config SET config_value = '-1' WHERE config_name = 'faq_access';
UPDATE phpbb_config SET config_value = '-1' WHERE config_name = 'groups_access';
UPDATE phpbb_config SET config_value = '-1' WHERE config_name = 'memberlist_access';
UPDATE phpbb_config SET config_value = '0' WHERE config_name = 'pm_allow_threshold';
UPDATE phpbb_config SET config_value = '-1' WHERE config_name = 'profile_access';
UPDATE phpbb_config SET config_name = 'rcs_level_admin' WHERE config_name = 'rcs_group_admin' LIMIT 1;
UPDATE phpbb_config SET config_name = 'rcs_level_mod' WHERE config_name = 'rcs_group_mod' LIMIT 1;
UPDATE phpbb_config SET config_name = 'rcs_ranks_stats' WHERE config_name = 'rcs_group_stats' LIMIT 1;
UPDATE phpbb_config SET config_value = '-1' WHERE config_name = 'search_access';
UPDATE phpbb_config SET config_value = '-1' WHERE config_name = 'shoutbox_access';
UPDATE phpbb_config SET config_value = 'subSilverPlus' WHERE config_name = 'xs_def_template';

INSERT IGNORE INTO phpbb_config (config_name, config_value) VALUES ('images_max_size', '400');

UPDATE phpbb_config SET config_value = '1' WHERE config_name = 'default_style';

#
#-----[ Empty Sessions Entries ]------------------------------------------------
#
DELETE FROM phpbb_sessions_keys;
DELETE FROM phpbb_sessions;
