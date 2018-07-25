#
# Basic DB data for phpBB2 devel
#
# $Id: mysql_basic.sql,v 1.29.2.27 2006/05/20 14:01:48 grahamje Exp $


# -- Attachment Config
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('allow_ftp_upload', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('allow_pm_attach', '1');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('attachment_quota', '52428800');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('attachment_topic_review', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('attach_version', '2.4.5');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('default_pm_quota', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('default_upload_quota', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('disable_mod', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('display_order', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('download_path', '');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('flash_autoplay', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_pass', '');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_pasv_mode', '1');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_path', '');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_server', '');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_user', '');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_create_thumbnail', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_display_inlined', '1');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_imagick', '');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_link_height', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_link_width', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_max_height', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_max_width', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_min_thumb_filesize', '12000');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_attachments', '3');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_attachments_pm', '1');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_filesize', '262144');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_filesize_pm', '262144');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('show_apcp', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('topic_icon', 'images/icon_clip.gif');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('upload_dir', 'files');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('upload_img', 'images/icon_clip.gif');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('use_gd2', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('wma_autoplay', '0');


# -- BBCode Box Reloaded Entries
INSERT INTO phpbb_bbc_box (bbc_id, bbc_name, bbc_value, bbc_auth, bbc_before, bbc_after, bbc_helpline, bbc_img, bbc_divider, bbc_order) VALUES (1, 'strike', '1', '0', 's', 's', 'strike', 'strike', '0', '10');
INSERT INTO phpbb_bbc_box (bbc_id, bbc_name, bbc_value, bbc_auth, bbc_before, bbc_after, bbc_helpline, bbc_img, bbc_divider, bbc_order) VALUES (2, 'spoiler', '1', '0', 'spoil', 'spoil', 'spoiler', 'spoiler', '0', '20');
INSERT INTO phpbb_bbc_box (bbc_id, bbc_name, bbc_value, bbc_auth, bbc_before, bbc_after, bbc_helpline, bbc_img, bbc_divider, bbc_order) VALUES (3, 'fade', '1', '0', 'fade', 'fade', 'fade', 'fade', '0', '30');
INSERT INTO phpbb_bbc_box (bbc_id, bbc_name, bbc_value, bbc_auth, bbc_before, bbc_after, bbc_helpline, bbc_img, bbc_divider, bbc_order) VALUES (4, 'rainbow', '1', '0', 'rainbow', 'rainbow', 'rainbow', 'rainbow', '1', '40');
INSERT INTO phpbb_bbc_box (bbc_id, bbc_name, bbc_value, bbc_auth, bbc_before, bbc_after, bbc_helpline, bbc_img, bbc_divider, bbc_order) VALUES (5, 'justify', '1', '0', 'align=justify', 'align', 'justify', 'justify', '0', '50');
INSERT INTO phpbb_bbc_box (bbc_id, bbc_name, bbc_value, bbc_auth, bbc_before, bbc_after, bbc_helpline, bbc_img, bbc_divider, bbc_order) VALUES (6, 'right', '1', '0', 'align=right', 'align', 'right', 'right', '0', '60');
INSERT INTO phpbb_bbc_box (bbc_id, bbc_name, bbc_value, bbc_auth, bbc_before, bbc_after, bbc_helpline, bbc_img, bbc_divider, bbc_order) VALUES (7, 'center', '1', '0', 'align=center', 'align', 'center', 'center', '0', '70');
INSERT INTO phpbb_bbc_box (bbc_id, bbc_name, bbc_value, bbc_auth, bbc_before, bbc_after, bbc_helpline, bbc_img, bbc_divider, bbc_order) VALUES (8, 'left', '1', '0', 'align=left', 'align', 'left', 'left', '1', '80');
INSERT INTO phpbb_bbc_box (bbc_id, bbc_name, bbc_value, bbc_auth, bbc_before, bbc_after, bbc_helpline, bbc_img, bbc_divider, bbc_order) VALUES (9, 'link', '1', '0', 'link=', 'link', 'link', 'alink', '0', '90');
INSERT INTO phpbb_bbc_box (bbc_id, bbc_name, bbc_value, bbc_auth, bbc_before, bbc_after, bbc_helpline, bbc_img, bbc_divider, bbc_order) VALUES (10, 'target', '1', '0', 'target=', 'target', 'target', 'atarget', '1', '100');
INSERT INTO phpbb_bbc_box (bbc_id, bbc_name, bbc_value, bbc_auth, bbc_before, bbc_after, bbc_helpline, bbc_img, bbc_divider, bbc_order) VALUES (11, 'marqd', '1', '0', 'marq=down', 'marq', 'marqd', 'marqd', '0', '110');
INSERT INTO phpbb_bbc_box (bbc_id, bbc_name, bbc_value, bbc_auth, bbc_before, bbc_after, bbc_helpline, bbc_img, bbc_divider, bbc_order) VALUES (12, 'marqu', '1', '0', 'marq=up', 'marq', 'marqu', 'marqu', '0', '120');
INSERT INTO phpbb_bbc_box (bbc_id, bbc_name, bbc_value, bbc_auth, bbc_before, bbc_after, bbc_helpline, bbc_img, bbc_divider, bbc_order) VALUES (13, 'marql', '1', '0', 'marq=left', 'marq', 'marql', 'marql', '0', '130');
INSERT INTO phpbb_bbc_box (bbc_id, bbc_name, bbc_value, bbc_auth, bbc_before, bbc_after, bbc_helpline, bbc_img, bbc_divider, bbc_order) VALUES (14, 'marqr', '1', '0', 'marq=right', 'marq', 'marqr', 'marqr', '1', '140');
INSERT INTO phpbb_bbc_box (bbc_id, bbc_name, bbc_value, bbc_auth, bbc_before, bbc_after, bbc_helpline, bbc_img, bbc_divider, bbc_order) VALUES (15, 'email', '1', '0', 'email', 'email', 'email', 'email', '0', '150');
INSERT INTO phpbb_bbc_box (bbc_id, bbc_name, bbc_value, bbc_auth, bbc_before, bbc_after, bbc_helpline, bbc_img, bbc_divider, bbc_order) VALUES (16, 'flash', '1', '0', 'flash width=250 height=250', 'flash', 'flash', 'flash', '0', '160');
INSERT INTO phpbb_bbc_box (bbc_id, bbc_name, bbc_value, bbc_auth, bbc_before, bbc_after, bbc_helpline, bbc_img, bbc_divider, bbc_order) VALUES (17, 'video', '1', '0', 'video width=400 height=350', 'video', 'video', 'video', '0', '170');
INSERT INTO phpbb_bbc_box (bbc_id, bbc_name, bbc_value, bbc_auth, bbc_before, bbc_after, bbc_helpline, bbc_img, bbc_divider, bbc_order) VALUES (18, 'stream', '1', '0', 'stream', 'stream', 'stream', 'stream', '0', '180');
INSERT INTO phpbb_bbc_box (bbc_id, bbc_name, bbc_value, bbc_auth, bbc_before, bbc_after, bbc_helpline, bbc_img, bbc_divider, bbc_order) VALUES (19, 'real', '1', '0', 'ram width=220 height=140', 'ram', 'real', 'real', '0', '190');
INSERT INTO phpbb_bbc_box (bbc_id, bbc_name, bbc_value, bbc_auth, bbc_before, bbc_after, bbc_helpline, bbc_img, bbc_divider, bbc_order) VALUES (20, 'quick', '1', '0', 'quick width=480 height=224', 'quick', 'quick', 'quick', '1', '200');
INSERT INTO phpbb_bbc_box (bbc_id, bbc_name, bbc_value, bbc_auth, bbc_before, bbc_after, bbc_helpline, bbc_img, bbc_divider, bbc_order) VALUES (21, 'sup', '1', '0', 'sup', 'sup', 'sup', 'sup', '0', '210');
INSERT INTO phpbb_bbc_box (bbc_id, bbc_name, bbc_value, bbc_auth, bbc_before, bbc_after, bbc_helpline, bbc_img, bbc_divider, bbc_order) VALUES (22, 'sub', '1', '0', 'sub', 'sub', 'sub', 'sub', '1', '220');
INSERT INTO phpbb_bbc_box (bbc_id, bbc_name, bbc_value, bbc_auth, bbc_before, bbc_after, bbc_helpline, bbc_img, bbc_divider, bbc_order) VALUES (23, 'tmb', '1', '0', 'tmb', 'tmb', 'tmb', 'tmb', '0', '230');
INSERT INTO phpbb_bbc_box (bbc_id, bbc_name, bbc_value, bbc_auth, bbc_before, bbc_after, bbc_helpline, bbc_img, bbc_divider, bbc_order) VALUES (24, 'php', '1', '0', 'php', 'php', 'php', 'php', '0', '240');
INSERT INTO phpbb_bbc_box (bbc_id, bbc_name, bbc_value, bbc_auth, bbc_before, bbc_after, bbc_helpline, bbc_img, bbc_divider, bbc_order) VALUES (25, 'youtube', '1', '0', 'youtube', 'youtube', 'youtube', 'youtube', '0', '250');


# -- Bot Indexing Entries
INSERT INTO phpbb_bots (bot_id, bot_name, bot_agent, last_visit, bot_visits, bot_pages, pending_agent, pending_ip, bot_ip, bot_style) VALUES (1, 'GoogleBot', 'Google', '', '0', '0', '', '', '66.249', '1');
INSERT INTO phpbb_bots (bot_id, bot_name, bot_agent, last_visit, bot_visits, bot_pages, pending_agent, pending_ip, bot_ip, bot_style) VALUES (2, 'MSNBot', 'msnbot/', '', '0', '0', '', '', '207.68.146|64.4.8|65.54.188', '1');
INSERT INTO phpbb_bots (bot_id, bot_name, bot_agent, last_visit, bot_visits, bot_pages, pending_agent, pending_ip, bot_ip, bot_style) VALUES (3, 'Ask Jeeves', 'teoma', '', '0', '0', '', '', '65.214.36|65.214.37|65.214.38|65.214.39', '1');
INSERT INTO phpbb_bots (bot_id, bot_name, bot_agent, last_visit, bot_visits, bot_pages, pending_agent, pending_ip, bot_ip, bot_style) VALUES (4, 'Yahoo! Slurp', 'Yahoo', '', '0', '0', '', '', '66.196|68.142|202.160', '1');


# -- Categories
INSERT INTO phpbb_categories (cat_id, cat_title, cat_order) VALUES (1, 'Test category 1', 10);


# -- Config
INSERT INTO phpbb_config (config_name, config_value) VALUES ('administrator_max_inbox_privmsgs', '500');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('administrator_max_savebox_privmsgs', '500');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('administrator_max_sentbox_privmsgs', '500');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('administrator_max_trashbox_privmsgs', '500');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_autologin', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_avatar_local', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_avatar_remote', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_avatar_upload', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_bbcode', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_html', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_html_tags', 'b,i,u,pre');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_namechange', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_sig', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_smilies', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_theme_create', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('annonce_globale_index', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('anons_qp_settings', '1-0-1-1-1-1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('avatar_filesize', '6144');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('avatar_gallery_path', 'images/avatars/gallery');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('avatar_max_height', '150');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('avatar_max_width', '150');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('avatar_path', 'images/avatars');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('bbc_advanced', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('bbc_box_on', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('bbc_per_row', '14');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('bbc_style_path', 'default');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('bbc_time_regen', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('bin_forum', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('birthday_settings', '0-1-5-100');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_disable', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_disable_caption', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_disable_text', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_email','youraddress@yourdomain.com');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_email_form', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_email_sig', 'Thanks, The Management');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_timezone', '2');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('bump_interval', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('bump_type', 'd');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cache_rcs', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('card_max', '4');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cell_access', '-1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cell_allow_display_bars', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cell_allow_display_celleds', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cell_allow_user_blank', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cell_allow_user_caution', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cell_allow_user_judge', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cell_amount_user_blank', '5000');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cell_user_judge_posts', '2');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cell_user_judge_voters', '10');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('config_id', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cookie_domain', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cookie_name', 'oxygen100mysql');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cookie_path', '/');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cookie_secure', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('coppa_fax', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('coppa_mail', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('default_dateformat', '|d M Y| H:i');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('default_style', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('disallow_edition_deleting_admin_messages','1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('enable_confirm', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('faq_access', '-1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('favicon_icon', 'images/favicon.ico');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('flood_interval', '15');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('forum_icon_path', 'images/forum_icons');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('gender_required', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('groups_access', '-1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('guests_need_name', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('gzip_compress', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('gzip_level', '9');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('hot_threshold','25');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('icon_per_row', '8');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('images_max_size', '400');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('instant_msg_delay', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('instant_msg_enable', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('instant_msg_refresh_time', '30');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('join_interval', '18');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('last_topic_title_length', '25');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('login_reset_time', '30');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_autologin_time', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_inbox_privmsgs', '50');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_login_attempts', '5');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_poll_options', '10');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_savebox_privmsgs', '50');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_sentbox_privmsgs', '25');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_sig_chars', '255');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_smilies', '10');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_subforums', '3');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_trashbox_privmsgs', '50');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('memberlist_access', '-1');
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
INSERT INTO phpbb_config (config_name, config_value) VALUES ('mod_search_engine', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('no_guest_on_index', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('online_time', '60');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_aim', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_always_add_signature', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_bbcode', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_birthday', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_board_style', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_date_format', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_icq', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_gender', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_hide_online', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_html', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_interests', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_language', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_location', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_msn', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_notify_on_reply', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_notify_pm', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_notify_on_donation', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_occupation', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_popup_pm', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_posts_per_page', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_public_view_mail', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_quick_post', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_signature', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_skype', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_smilies', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_time_mode', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_topics_per_page', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_user_style', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_website', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_yahoo', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('oxygen_version', '1.1.0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('pm_allow_threshold', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('points_browse', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('points_donate', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('points_name', 'Points');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('points_page', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('points_post', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('points_reply', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('points_topic', '2');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('points_user_group_auth_ids', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('posts_per_page', '15');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('present_forum', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('present_required', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('privmsg_disable', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('profile_access', '-1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('prune_enable', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('rand_seed', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('rcs_enable', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('rcs_level_admin', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('rcs_level_mod', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('rcs_ranks_stats', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('record_online_date', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('record_online_users', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('registration_closed', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('registration_status', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('removed_users', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('reply_flood_ctrl', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('required_aim', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('required_icq', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('required_interests', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('required_location', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('required_msnm', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('required_occupation', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('required_posts_per_page', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('required_signature', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('required_skype', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('required_topics_per_page', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('required_website', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('required_yim', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('require_activation', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('script_path', '/phpBB2/');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('search_access', '-1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('search_flood_interval', '15');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('search_min_chars', '3');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sendmail_fix', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('server_name', 'www.myserver.tld');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('server_port', '80');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('session_length', '3600');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_access', '-1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_allow_bbcode','1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_allow_guest','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_allow_guest_view','1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_allow_delete','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_allow_delete_all','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_allow_edit','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_allow_edit_all','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_allow_smilies','1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_banned_user_id','');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_banned_user_id_view','');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_date_format','|d M Y| H:i');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_date_on','1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_delete_days','30');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_height','170');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_links_names','1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_make_links','1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_messages_number_on_index', '20');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_on','1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_refresh_time', '120');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_text_lenght','500');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_width','100%');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('shoutbox_word_lenght','90');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sitename', 'OxyGen PreMOD');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('site_desc', 'By EzCom');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smilies_path', 'images/smiles');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smilie_buttons', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smilie_columns', '4');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smilie_icon_path', 'images/smiles');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smilie_popup', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smilie_posting', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smilie_rows', '5');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smtp_delivery', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smtp_host', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smtp_password', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smtp_username', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('split_announce', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('split_global_announce', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('split_sticky', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('split_topic_split', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sub_title_length', '100');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('topics_per_page', '50');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('users_qp_settings', '1-0-1-1-1-1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('version', '.0.22');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('viewonline_access', '-1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('wpm_active', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('wpm_message', 'Bonjour [username] !\r\nBienvenue sur [sitename] !\r\nSi vous avez des questions sur ce site, n''hésitez pas à le demander !');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('wpm_subject', 'Bienvenue sur [sitename] !');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('wpm_userid', '-1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('wpm_username', 'Anonymous');


# -- extension_groups
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (1, 'Archive ZIP', 0, 1, 1, 'images/app_icons/zip.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (2, 'Archive RAR', 0, 1, 1, 'images/app_icons/rar.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (3, 'Archive 7Z', 0, 1, 1, 'images/app_icons/7z.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (4, 'Archive ACE', 0, 1, 1, 'images/app_icons/ace.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (5, 'Archive CAB', 0, 1, 1, 'images/app_icons/cab.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (6, 'Archive GZ', 0, 1, 1, 'images/app_icons/gz.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (7, 'Archive TAR', 0, 1, 1, 'images/app_icons/tar.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (8, 'Image GIF', 0, 0, 1, 'images/app_icons/gif.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (9, 'Image JPEG', 0, 0, 1, 'images/app_icons/jpg.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (10, 'Image PNG', 0, 0, 1, 'images/app_icons/png.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (11, 'Image PSD', 0, 0, 1, 'images/app_icons/psd.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (12, 'Image PSP', 0, 0, 1, 'images/app_icons/psp.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (13, 'Image TIFF', 0, 0, 1, 'images/app_icons/tiff.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (14, 'Vidéo AVI', 0, 0, 1, 'images/app_icons/avi.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (15, 'Image BMP', 0, 0, 1, 'images/app_icons/bmp.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (16, 'Vidéo DivX', 0, 0, 1, 'images/app_icons/divx.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (17, 'Vidéo Quicktime', 0, 0, 1, 'images/app_icons/mov.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (18, 'Vidéo MPEG-4', 0, 0, 1, 'images/app_icons/mp4.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (19, 'Vidéo MPEG', 0, 0, 1, 'images/app_icons/mpg.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (20, 'Vidéo OGM', 0, 0, 1, 'images/app_icons/ogm.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (21, 'Vidéo WMV', 0, 0, 1, 'images/app_icons/wmv.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (22, 'Vidéo XviD', 0, 0, 1, 'images/app_icons/xvid.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (23, 'Fichier Son Midi', 0, 0, 1, 'images/app_icons/midi.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (24, 'Fichier Son MP3', 0, 0, 1, 'images/app_icons/mp3.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (25, 'Fichier Son OGG', 0, 0, 1, 'images/app_icons/ogg.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (26, 'Fichier Son WAVE', 0, 0, 1, 'images/app_icons/wav.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (27, 'Fichier Son WMA', 0, 0, 1, 'images/app_icons/wma.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (28, 'Feuille de Style CSS', 0, 0, 1, 'images/app_icons/css.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (29, 'Page Web HTM', 0, 0, 1, 'images/app_icons/htm.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (30, 'Page Web HTML', 0, 0, 1, 'images/app_icons/html.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (31, 'Image BIN', 0, 0, 1, 'images/app_icons/bin.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (32, 'Image CloneCD', 0, 0, 1, 'images/app_icons/ccd.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (33, 'Fichier CUE', 0, 0, 1, 'images/app_icons/cue.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (34, 'Image ISO', 0, 0, 1, 'images/app_icons/iso.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (35, 'Image MDS', 0, 0, 1, 'images/app_icons/mds.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (36, 'Image NRG', 0, 0, 1, 'images/app_icons/nrg.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (37, 'Document Word', 0, 0, 1, 'images/app_icons/doc.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (38, 'Fichier Texte', 0, 0, 1, 'images/app_icons/txt.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (39, 'Fichier Batch', 0, 0, 1, 'images/app_icons/bat.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (40, 'Librairie DLL', 0, 0, 1, 'images/app_icons/dll.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (41, 'Fichier INI', 0, 0, 1, 'images/app_icons/ini.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (42, 'Fichier Système', 0, 0, 1, 'images/app_icons/sys.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (43, 'Document PDF', 0, 0, 1, 'images/app_icons/blank.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (44, 'Feuille Excel', 0, 0, 1, 'images/app_icons/blank.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (45, 'Fichier DIZ', 0, 0, 1, 'images/app_icons/blank.gif', 262144, '');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (46, 'Fichier SWF', 0, 0, 1, 'images/app_icons/blank.gif', 262144, '');


# -- extensions
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (1, 1, 'zip', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (2, 2, 'rar', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (3, 3, '7z', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (4, 4, 'ace', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (5, 5, 'cab', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (6, 6, 'gz', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (7, 7, 'tar', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (8, 8, 'gif', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (9, 9, 'jpeg', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (10, 9, 'jpg', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (11, 10, 'png', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (12, 11, 'psd', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (13, 12, 'psp', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (14, 13, 'tif', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (15, 13, 'tiff', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (16, 14, 'avi', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (17, 15, 'bmp', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (18, 16, 'divx', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (19, 17, 'mov', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (20, 19, 'mpg', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (21, 19, 'mpeg', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (22, 20, 'ogm', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (23, 21, 'wmv', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (24, 22, 'xvid', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (25, 23, 'mid', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (26, 24, 'mp3', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (27, 25, 'ogg', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (28, 26, 'wav', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (29, 27, 'wma', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (30, 28, 'css', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (31, 29, 'htm', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (32, 30, 'html', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (33, 31, 'bin', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (34, 32, 'ccd', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (35, 33, 'cue', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (36, 34, 'iso', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (37, 35, 'mds', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (38, 36, 'nrg', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (39, 37, 'doc', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (40, 38, 'txt', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (41, 39, 'bat', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (42, 40, 'dll', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (43, 41, 'ini', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (44, 42, 'sys', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (45, 43, 'pdf', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (46, 44, 'xls', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (47, 45, 'diz', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (48, 46, 'swf', '');


# -- forbidden_extensions
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (1,'php');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (2,'php3');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (3,'php4');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (4,'phtml');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (5,'pl');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (6,'asp');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (7,'cgi');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (8,'php5');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (9,'php6');


# -- Forums
INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, cat_id, forum_order, forum_posts, forum_topics, forum_last_post_id, auth_view, auth_read, auth_post, auth_reply, auth_edit, auth_delete, auth_announce, auth_sticky, auth_pollcreate, auth_vote, auth_attachments) VALUES (1, 'Test Forum 1', 'This is just a test forum.', 1, 10, 1, 1, 1, 0, 0, 1, 1, 1, 1, 3, 3, 1, 1, 3);


# -- Groups
INSERT INTO phpbb_groups (group_id, group_name, group_description, group_single_user) VALUES (1, 'Anonymous', 'Personal User', 1);
INSERT INTO phpbb_groups (group_id, group_name, group_description, group_single_user) VALUES (2, 'Admin', 'Personal User', 1);


# -- Logs
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


# -- Demo Post
INSERT INTO phpbb_posts (post_id, topic_id, forum_id, poster_id, post_time, post_username, poster_ip) VALUES (1, 1, 1, 2, 972086460, NULL, '7F000001');
INSERT INTO phpbb_posts_text (post_id, post_subject, post_text) VALUES (1, 'Welcome to phpBB 2', 'This is an example post in your phpBB 2 installation. You may delete this post, this topic and even this forum if you like since everything seems to be working!');


# -- default quota limits
INSERT INTO phpbb_quota_limits (quota_limit_id, quota_desc, quota_limit) VALUES (1, 'Low', 262144);
INSERT INTO phpbb_quota_limits (quota_limit_id, quota_desc, quota_limit) VALUES (2, 'Medium', 2097152);
INSERT INTO phpbb_quota_limits (quota_limit_id, quota_desc, quota_limit) VALUES (3, 'High', 5242880);


# -- Ranks
INSERT INTO phpbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES ( 1, 'Site Admin', -1, 1, NULL);


# -- Rank Color System
INSERT INTO phpbb_rcs (rcs_id, rcs_name, rcs_color, rcs_single, rcs_display, rcs_order) VALUES (1, 'Administrator', 'CC0000', 0, 1, 10);
INSERT INTO phpbb_rcs (rcs_id, rcs_name, rcs_color, rcs_single, rcs_display, rcs_order) VALUES (2, 'Moderator', '006600', 0, 1, 20);


# -- wordlist
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 1, 'example', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 2, 'post', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 3, 'phpbb', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 4, 'installation', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 5, 'delete', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 6, 'topic', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 7, 'forum', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 8, 'since', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 9, 'everything', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 10, 'seems', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 11, 'working', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 12, 'welcome', 0 );


# -- wordmatch
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 1, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 2, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 3, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 4, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 5, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 6, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 7, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 8, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 9, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 10, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 11, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 12, 1, 1 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 3, 1, 1 );


# -- Smilies
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (1, ':D', 'icon_biggrin.gif', 'Very Happy', 1, 1);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (2, ':-D', 'icon_biggrin.gif', 'Very Happy', 1, 2);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (3, ':grin:', 'icon_biggrin.gif', 'Very Happy', 1, 3);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (4, ':)', 'icon_smile.gif', 'Smile', 1, 4);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (5, ':-)', 'icon_smile.gif', 'Smile', 1, 5);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (6, ':smile:', 'icon_smile.gif', 'Smile', 1, 6);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (7, ':(', 'icon_sad.gif', 'Sad', 1, 7);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (8, ':-(', 'icon_sad.gif', 'Sad', 1, 8);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (9, ':sad:', 'icon_sad.gif', 'Sad', 1, 9);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (10, ':o', 'icon_surprised.gif', 'Surprised', 1, 10);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (11, ':-o', 'icon_surprised.gif', 'Surprised', 1, 11);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (12, ':eek:', 'icon_surprised.gif', 'Surprised', 1, 12);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (13, ':shock:', 'icon_eek.gif', 'Shocked', 1, 13);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (14, ':?', 'icon_confused.gif', 'Confused', 1, 14);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (15, ':-?', 'icon_confused.gif', 'Confused', 1, 15);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (16, ':???:', 'icon_confused.gif', 'Confused', 1, 16);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (17, '8)', 'icon_cool.gif', 'Cool', 1, 17);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (18, '8-)', 'icon_cool.gif', 'Cool', 1, 18);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (19, ':cool:', 'icon_cool.gif', 'Cool', 1, 19);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (20, ':lol:', 'icon_lol.gif', 'Laughing', 1, 20);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (21, ':x', 'icon_mad.gif', 'Mad', 1, 21);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (22, ':-x', 'icon_mad.gif', 'Mad', 1, 22);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (23, ':mad:', 'icon_mad.gif', 'Mad', 1, 23);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (24, ':P', 'icon_razz.gif', 'Razz', 1, 24);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (25, ':-P', 'icon_razz.gif', 'Razz', 1, 25);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (26, ':razz:', 'icon_razz.gif', 'Razz', 1, 26);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (27, ':oops:', 'icon_redface.gif', 'Embarassed', 1, 27);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (28, ':cry:', 'icon_cry.gif', 'Crying or Very sad', 1, 28);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (29, ':evil:', 'icon_evil.gif', 'Evil or Very Mad', 1, 29);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (30, ':twisted:', 'icon_twisted.gif', 'Twisted Evil', 1, 30);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (31, ':roll:', 'icon_rolleyes.gif', 'Rolling Eyes', 1, 31);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (32, ':wink:', 'icon_wink.gif', 'Wink', 1, 32);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (33, ';)', 'icon_wink.gif', 'Wink', 1, 33);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (34, ';-)', 'icon_wink.gif', 'Wink', 1, 34);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (35, ':!:', 'icon_exclaim.gif', 'Exclamation', 1, 35);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (36, ':?:', 'icon_question.gif', 'Question', 1, 36);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (37, ':idea:', 'icon_idea.gif', 'Idea', 1, 37);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (38, ':arrow:', 'icon_arrow.gif', 'Arrow', 1, 38);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (39, ':|', 'icon_neutral.gif', 'Neutral', 1, 39);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (40, ':-|', 'icon_neutral.gif', 'Neutral', 1, 40);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (41, ':neutral:', 'icon_neutral.gif', 'Neutral', 1, 41);
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon, cat_id, smilies_order) VALUES (42, ':mrgreen:', 'icon_mrgreen.gif', 'Mr. Green', 1, 42);


# -- Smilies Category
INSERT INTO phpbb_smilies_cat (cat_id, cat_name, description, cat_order, cat_perms, cat_forum, cat_category, cat_icon_url, smilies_per_page, smilies_popup) VALUES (1, 'phpBB', 'The default phpBB Smiles', 1, 1, -2, -2, 'icon_smile.gif', 0, '410|300|8');


# -- Themes
INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, rcs_admincolor, rcs_modcolor, rcs_usercolor, rcs_botcolor, theme_logo) VALUES (1, 'subSilverPlus', 'subSilverPlus', 'subSilverPlus.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', 10, 11, 12, '444444', '006600', 'FFA34F', '', '', '', 'CC0000', '006600', '006699', '000000', 'templates/subSilverPlus/images/header/logo_phpBB.gif');
INSERT INTO phpbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES (1, 'The lightest row colour', 'The medium row color', 'The darkest row colour', '', '', '', 'Border round the whole page', 'Outer table border', 'Inner table border', 'Silver gradient picture', 'Blue gradient picture', 'Fade-out gradient on index', 'Background for quote boxes', 'All white areas', '', 'Background for topic posts', '2nd background for topic posts', '', 'Main fonts', 'Additional topic title font', 'Form fonts', 'Smallest font size', 'Medium font size', 'Normal font size (post body etc)', 'Quote & copyright text', 'Code text colour', 'Main table header text colour', '', '', '');


# -- Demo Topic
INSERT INTO phpbb_topics (topic_id, topic_title, topic_poster, topic_time, topic_views, topic_replies, forum_id, topic_status, topic_type, topic_vote, topic_first_post_id, topic_last_post_id) VALUES (1, 'Welcome to phpBB 2', 2, '972086460', 0, 0, 1, 0, 0, 0, 1, 1);


# -- User -> Group
INSERT INTO phpbb_user_group (group_id, user_id, user_pending) VALUES (1, -1, 0);
INSERT INTO phpbb_user_group (group_id, user_id, user_pending) VALUES (2, 2, 0);


# -- Users
INSERT INTO phpbb_users (user_id, username, user_level, user_regdate, user_password, user_email, user_icq, user_website, user_occ, user_from, user_interests, user_sig, user_viewemail, user_style, user_aim, user_yim, user_msnm, user_posts, user_attachsig, user_allowsmile, user_allowhtml, user_allowbbcode, user_allow_pm, user_notify_pm, user_allow_viewonline, user_rank, user_avatar, user_lang, user_timezone, user_dateformat, user_actkey, user_newpasswd, user_notify, user_active) VALUES ( -1, 'Anonymous', 0, 0, '', '', '', '', '', '', '', '', 0, NULL, '', '', '', 0, 0, 1, 1, 1, 0, 1, 1, NULL, '', '', 0, '', '', '', 0, 0);


# -- username: admin    password: admin (change this or remove it once everything is working!)
INSERT INTO phpbb_users (user_id, username, user_level, user_regdate, user_password, user_email, user_icq, user_website, user_occ, user_from, user_interests, user_sig, user_viewemail, user_style, user_aim, user_yim, user_msnm, user_posts, user_attachsig, user_allowsmile, user_allowhtml, user_allowbbcode, user_allow_pm, user_notify_pm, user_popup_pm, user_allow_viewonline, user_rank, user_avatar, user_lang, user_timezone, user_dateformat, user_actkey, user_newpasswd, user_notify, user_active, user_qp_settings, user_topics, user_admin_notes) VALUES ( 2, 'Admin', 1, 0, '21232f297a57a5a743894a0e4a801fc3', 'admin@yourdomain.com', '', '', '', '', '', '', 1, 1, '', '', '', 1, 0, 1, 0, 1, 1, 1, 1, 1, 1, '', 'english', 1.00, '|d M Y| H:i', '', '', 0, 1, '1-0-1-1-1-1', 1, 'Welcome to Sexy Administrator Index - RC3 (1.0.5)');
