<?php
/***************************************************************************
 *                              admin_board.php
 *                            -------------------
 *   begin                : Thursday, Jul 12, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: admin_board.php,v 1.51.2.15 2006/02/10 22:19:01 grahamje Exp $
 *
 *
 ***************************************************************************/

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['General']['Configuration'] = $file;
	return;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
include($phpbb_root_path . 'includes/functions_selects.'.$phpEx);

//
// Pull all config data
//
$sql = 'SELECT * FROM ' . CONFIG_TABLE;
if(!$result = $db->sql_query($sql))
{
	message_die(CRITICAL_ERROR, 'Could not query config information in admin_board', '', __LINE__, __FILE__, $sql);
}
else
{
	while( $row = $db->sql_fetchrow($result) )
	{
		$config_name = $row['config_name'];
		$config_value = $row['config_value'];
		$default_config[$config_name] = isset($HTTP_POST_VARS['submit']) ? str_replace("'", "\'", $config_value) : $config_value;
		
		$new[$config_name] = ( isset($HTTP_POST_VARS[$config_name]) ) ? $HTTP_POST_VARS[$config_name] : $default_config[$config_name];

		if ($config_name == 'cookie_name')
		{
			$new['cookie_name'] = str_replace('.', '_', $new['cookie_name']);
		}

		// Attempt to prevent a common mistake with this value,
		// http:// is the protocol and not part of the server name
		if ($config_name == 'server_name')
		{
			$new['server_name'] = str_replace('http://', '', $new['server_name']);
		}

		// Attempt to prevent a mistake with this value.
		if ($config_name == 'avatar_path')
		{
			$new['avatar_path'] = trim($new['avatar_path']);
			if (strstr($new['avatar_path'], "\0") || !is_dir($phpbb_root_path . $new['avatar_path']) || !is_writable($phpbb_root_path . $new['avatar_path']))
			{
				$new['avatar_path'] = $default_config['avatar_path'];
			}
		}

//-- mod : birthday ------------------------------------------------------------
//-- add
		$bday_required = $bday_greeting = $bday_min_age = $bday_max_age = 0;

		if (!empty($board_config['birthday_settings']))
		{
			list($bday_required, $bday_greeting, $bday_min_age, $bday_max_age) = explode('-', $board_config['birthday_settings']);
		}

		$bday_required = ( isset($HTTP_POST_VARS['bday_required']) ) ? intval($HTTP_POST_VARS['bday_required']) : $bday_required;
		$bday_greeting = ( isset($HTTP_POST_VARS['bday_greeting']) ) ? intval($HTTP_POST_VARS['bday_greeting']) : $bday_greeting;
		$bday_min_age = ( isset($HTTP_POST_VARS['bday_min_age']) ) ? intval($HTTP_POST_VARS['bday_min_age']) : $bday_min_age;
		$bday_max_age = ( isset($HTTP_POST_VARS['bday_max_age']) ) ? intval($HTTP_POST_VARS['bday_max_age']) : $bday_max_age;

		$bday_settings = array($bday_required, $bday_greeting, $bday_min_age, $bday_max_age);
		$new['birthday_settings'] = implode('-', $bday_settings);
//-- fin mod : birthday --------------------------------------------------------

//-- mod : quick post es -------------------------------------------------------
//-- add
		$user_qp = $user_qp_show = $user_qp_subject = $user_qp_bbcode = $user_qp_smilies = $user_qp_more = 0;
		$anon_qp = $anon_qp_show = $anon_qp_subject = $anon_qp_bbcode = $anon_qp_smilies = $anon_qp_more = 0;

		if (!empty($board_config['users_qp_settings']))
		{
			list($user_qp, $user_qp_show, $user_qp_subject, $user_qp_bbcode, $user_qp_smilies, $user_qp_more) = explode('-', $board_config['users_qp_settings']);
		}
		
		if (!empty($board_config['anons_qp_settings']))
		{
			list($anon_qp, $anon_qp_show, $anon_qp_subject, $anon_qp_bbcode, $anon_qp_smilies, $anon_qp_more) = explode('-', $board_config['anons_qp_settings']);
		}

		$params = array(
			'user_qp', 'user_qp_show', 'user_qp_subject', 'user_qp_bbcode', 'user_qp_smilies', 'user_qp_more',
			'anon_qp', 'anon_qp_show', 'anon_qp_subject', 'anon_qp_bbcode', 'anon_qp_smilies', 'anon_qp_more',
		);
		for($i = 0; $i < count($params); $i++)
		{
			$$params[$i] = ( isset($HTTP_POST_VARS[$params[$i]]) ) ? intval($HTTP_POST_VARS[$params[$i]]) : $$params[$i];
		}

		$users_qp_settings = array($user_qp, $user_qp_show, $user_qp_subject, $user_qp_bbcode, $user_qp_smilies, $user_qp_more);
		$anons_qp_settings = array($anon_qp, $anon_qp_show, $anon_qp_subject, $anon_qp_bbcode, $anon_qp_smilies, $anon_qp_more);
		$new['users_qp_settings'] = implode('-', $users_qp_settings);
		$new['anons_qp_settings'] = implode('-', $anons_qp_settings);
//-- fin mod : quick post es ---------------------------------------------------

		if( isset($HTTP_POST_VARS['submit']) )
		{
			$sql = 'UPDATE ' . CONFIG_TABLE . '
				SET config_value = \'' . str_replace("\'", "''", $new[$config_name]) . '\'
				WHERE config_name = \'' . $config_name . '\'';
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Failed to update general configuration for '.$config_name, '', __LINE__, __FILE__, $sql);
			}
		}
	}

	if( isset($HTTP_POST_VARS['submit']) )
	{
//-- mod : the logger ----------------------------------------------------------
//-- add
		if( defined( 'LOG_MOD_INSTALLED' ) )
		{
			if( $log->config['log_admin_config'] )
			{
				$log->insert( LOG_TYPE_ADMIN, 'LOG_A_UPDATE_BOARD_CONFIG' );
			}
		}
//-- fin mod : the logger ------------------------------------------------------

		$message = $lang['Config_updated'] . '<br /><br />' . sprintf($lang['Click_return_config'], '<a href="' . append_sid('admin_board.' . $phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid('index.' . $phpEx . '?pane=right') . '">', '</a>');

		message_die(GENERAL_MESSAGE, $message);
	}
}

$style_select = style_select($new['default_style'], 'default_style', '../templates');
$lang_select = language_select($new['default_lang'], 'default_lang', 'language');
$timezone_select = tz_select($new['board_timezone'], 'board_timezone');

//-- mod : annonce globale -----------------------------------------------------
//-- add
$annonce_globale_index_yes = ( $new['annonce_globale_index'] ) ? 'checked="checked"' : '';
$annonce_globale_index_no = ( !$new['annonce_globale_index'] ) ? 'checked="checked"' : '';
//-- fin mod : annonce globale -------------------------------------------------

//-- mod : split topic type ----------------------------------------------------
//-- add
$split_global_announce_yes = ( $new['split_global_announce'] ) ? 'checked="checked"' : '';
$split_global_announce_no = ( !$new['split_global_announce'] ) ? 'checked="checked"' : '';

$split_announce_yes = ( $new['split_announce'] ) ? 'checked="checked"' : '';
$split_announce_no = ( !$new['split_announce'] ) ? 'checked="checked"' : '';

$split_sticky_yes = ( $new['split_sticky'] ) ? 'checked="checked"' : '';
$split_sticky_no = ( !$new['split_sticky'] ) ? 'checked="checked"' : '';

$split_topic_split_yes = ( $new['split_topic_split'] ) ? 'checked="checked"' : '';
$split_topic_split_no = ( !$new['split_topic_split'] ) ? 'checked="checked"' : '';
//-- fin mod : split topic type ------------------------------------------------

$disable_board_yes = ( $new['board_disable'] ) ? 'checked="checked"' : '';
$disable_board_no = ( !$new['board_disable'] ) ? 'checked="checked"' : '';

$cookie_secure_yes = ( $new['cookie_secure'] ) ? 'checked="checked"' : '';
$cookie_secure_no = ( !$new['cookie_secure'] ) ? 'checked="checked"' : '';

$html_tags = $new['allow_html_tags'];

$override_user_style_yes = ( $new['override_user_style'] ) ? 'checked="checked"' : '';
$override_user_style_no = ( !$new['override_user_style'] ) ? 'checked="checked"' : '';

$html_yes = ( $new['allow_html'] ) ? 'checked="checked"' : '';
$html_no = ( !$new['allow_html'] ) ? 'checked="checked"' : '';

$bbcode_yes = ( $new['allow_bbcode'] ) ? 'checked="checked"' : '';
$bbcode_no = ( !$new['allow_bbcode'] ) ? 'checked="checked"' : '';

$activation_none = ( $new['require_activation'] == USER_ACTIVATION_NONE ) ? 'checked="checked"' : '';
$activation_user = ( $new['require_activation'] == USER_ACTIVATION_SELF ) ? 'checked="checked"' : '';
$activation_admin = ( $new['require_activation'] == USER_ACTIVATION_ADMIN ) ? 'checked="checked"' : '';

$confirm_yes = ($new['enable_confirm']) ? 'checked="checked"' : '';
$confirm_no = (!$new['enable_confirm']) ? 'checked="checked"' : '';

$allow_autologin_yes = ($new['allow_autologin']) ? 'checked="checked"' : '';
$allow_autologin_no = (!$new['allow_autologin']) ? 'checked="checked"' : '';

$board_email_form_yes = ( $new['board_email_form'] ) ? 'checked="checked"' : '';
$board_email_form_no = ( !$new['board_email_form'] ) ? 'checked="checked"' : '';

$gzip_yes = ( $new['gzip_compress'] ) ? 'checked="checked"' : '';
$gzip_no = ( !$new['gzip_compress'] ) ? 'checked="checked"' : '';

$privmsg_on = ( !$new['privmsg_disable'] ) ? 'checked="checked"' : '';
$privmsg_off = ( $new['privmsg_disable'] ) ? 'checked="checked"' : '';

$prune_yes = ( $new['prune_enable'] ) ? 'checked="checked"' : '';
$prune_no = ( !$new['prune_enable'] ) ? 'checked="checked"' : '';

$smile_yes = ( $new['allow_smilies'] ) ? 'checked="checked"' : '';
$smile_no = ( !$new['allow_smilies'] ) ? 'checked="checked"' : '';

$sig_yes = ( $new['allow_sig'] ) ? 'checked="checked"' : '';
$sig_no = ( !$new['allow_sig'] ) ? 'checked="checked"' : '';

$smtp_yes = ( $new['smtp_delivery'] ) ? 'checked="checked"' : '';
$smtp_no = ( !$new['smtp_delivery'] ) ? 'checked="checked"' : '';

//-- mod : welcome private message ---------------------------------------------
//-- add
$wmp_active_yes = ( $new['wpm_active'] ) ? 'checked="checked"' : '';
$wmp_active_no = ( !$new['wpm_active'] ) ? 'checked="checked"' : '';
//-- fin mod : welcome private message -----------------------------------------

//-- mod : instant msg ---------------------------------------------------------
//-- add
$instant_msg_enable_yes = ( $new['instant_msg_enable'] ) ? 'checked="checked"' : '';
$instant_msg_enable_no = ( !$new['instant_msg_enable'] ) ? 'checked="checked"' : '';
//-- fin mod : instant msg -----------------------------------------------------

//-- mod : quick post es -------------------------------------------------------
//-- add
$qp_displays = array(
	array('qp_title' => $lang['qp_enable'], 'qp_desc' => $lang['qp_enable_explain'], 'qp_user_var' => 'user_qp', 'qp_anon_var' => 'anon_qp'),
	array('qp_title' => $lang['qp_show'], 'qp_desc' => $lang['qp_show_explain'], 'qp_user_var' => 'user_qp_show', 'qp_anon_var' => 'anon_qp_show'),
	array('qp_title' => $lang['qp_subject'], 'qp_desc' => $lang['qp_subject_explain'], 'qp_user_var' => 'user_qp_subject', 'qp_anon_var' => 'anon_qp_subject'),
	array('qp_title' => $lang['qp_bbcode'], 'qp_desc' => $lang['qp_bbcode_explain'], 'qp_user_var' => 'user_qp_bbcode', 'qp_anon_var' => 'anon_qp_bbcode'),
	array('qp_title' => $lang['qp_smilies'], 'qp_desc' => $lang['qp_smilies_explain'], 'qp_user_var' => 'user_qp_smilies', 'qp_anon_var' => 'anon_qp_smilies'),
	array('qp_title' => $lang['qp_more'], 'qp_desc' => $lang['qp_more_explain'], 'qp_user_var' => 'user_qp_more', 'qp_anon_var' => 'anon_qp_more'),
);
foreach( $qp_displays as $qp_display => $qp_generate )
{
	$qp_user_var = $qp_generate['qp_user_var'];
	$qp_anon_var = $qp_generate['qp_anon_var'];

	$template->assign_block_vars('quick_post', array(
		'L_QP_TITLE' => $qp_generate['qp_title'],
		'L_QP_DESC' => $qp_generate['qp_desc'],
		'USER_QP_VAR' => $qp_user_var,
		'ANON_QP_VAR' => $qp_anon_var,
		'USER_QP_YES' => ( $$qp_user_var ) ? 'checked="checked"' : '',
		'USER_QP_NO' => ( !$$qp_user_var ) ? 'checked="checked"' : '',
		'ANON_QP_YES' => ( $$qp_anon_var ) ? 'checked="checked"' : '',
		'ANON_QP_NO' => ( !$$qp_anon_var ) ? 'checked="checked"' : '',
	));
}
//-- fin mod : quick post es ---------------------------------------------------

//-- mod : disable registration ------------------------------------------------
//-- add
$registration_status_yes = ( $new['registration_status'] ) ? 'checked="checked"' : '';
$registration_status_no = ( !$new['registration_status'] ) ? 'checked="checked"' : '';
//-- fin mod : disable registration --------------------------------------------

//-- mod : presentation --------------------------------------------------------
//-- add
$present_required_yes = ( $new['present_required'] ) ? 'checked="checked"' : '';
$present_required_no = ( !$new['present_required'] ) ? 'checked="checked"' : '';
//-- fin mod : presentation ----------------------------------------------------

//-- mod : gender --------------------------------------------------------------
//-- add
$gender_required_yes = ( $new['gender_required'] ) ? ' checked="checked"' : '';
$gender_required_no = ( !$new['gender_required'] ) ? ' checked="checked"' : '';
//-- fin mod : gender ----------------------------------------------------------

//-- mod : birthday ------------------------------------------------------------
//-- add
$bday_required_yes = ( $bday_required ) ? 'checked="checked"' : '';
$bday_required_no = ( !$bday_required ) ? 'checked="checked"' : '';
$bday_greeting_yes = ( $bday_greeting ) ? 'checked="checked"' : '';
$bday_greeting_no = ( !$bday_greeting ) ? 'checked="checked"' : '';
//-- fin mod : birthday --------------------------------------------------------

//-- mod : force guests to enter their username --------------------------------
//-- add
$guests_need_name_yes = ( $new['guests_need_name'] ) ? 'checked="checked"' : '';
$guests_need_name_no = ( !$new['guests_need_name'] ) ? 'checked="checked"' : '';
//-- fin mod : force guests to enter their username ----------------------------

//-- mod : block the index to the guests ---------------------------------------
//-- add
$no_guest_on_index_yes = ( $new['no_guest_on_index'] ) ? 'checked="checked"' : '';
$no_guest_on_index_no = ( !$new['no_guest_on_index'] ) ? 'checked="checked"' : '';
//-- fin mod : block the index to the guests -----------------------------------

//-- mod : disallow editing/deleting administrator posts -----------------------
//-- add
$disallow_edition_deleting_admin_messages_yes = ( $new['disallow_edition_deleting_admin_messages'] ) ? 'checked="checked"' : '';
$disallow_edition_deleting_admin_messages_no = ( !$new['disallow_edition_deleting_admin_messages'] ) ? 'checked="checked"' : '';
//-- fin mod : disallow editing/deleting administrator posts -------------------

//-- mod : minichat ------------------------------------------------------------
//-- add
$shoutbox_on_yes = ( $new['shoutbox_on'] ) ? 'checked="checked"' : '';
$shoutbox_on_no = ( !$new['shoutbox_on'] ) ? 'checked="checked"' : '';

$date_on_yes = ( $new['shoutbox_date_on'] ) ? 'checked="checked"' : '';
$date_on_no = ( !$new['shoutbox_date_on'] ) ? 'checked="checked"' : '';

$make_links_yes = ( $new['shoutbox_make_links'] ) ? 'checked="checked"' : '';
$make_links_no = ( !$new['shoutbox_make_links'] ) ? 'checked="checked"' : '';

$links_names_yes = ( $new['shoutbox_links_names'] ) ? 'checked="checked"' : '';
$links_names_no = ( !$new['shoutbox_links_names'] ) ? 'checked="checked"' : '';

$allow_smilies_yes = ( $new['shoutbox_allow_smilies'] ) ? 'checked="checked"' : '';
$allow_smilies_no = ( !$new['shoutbox_allow_smilies'] ) ? 'checked="checked"' : '';

$allow_bbcode_yes = ( $new['shoutbox_allow_bbcode'] ) ? 'checked="checked"' : '';
$allow_bbcode_no = ( !$new['shoutbox_allow_bbcode'] ) ? 'checked="checked"' : '';

$allow_edit_yes = ( $new['shoutbox_allow_edit'] ) ? 'checked="checked"' : '';
$allow_edit_no = ( !$new['shoutbox_allow_edit'] ) ? 'checked="checked"' : '';

$allow_edit_all_yes = ( $new['shoutbox_allow_edit_all'] ) ? 'checked="checked"' : '';
$allow_edit_all_no = ( !$new['shoutbox_allow_edit_all'] ) ? 'checked="checked"' : '';

$allow_delete_yes = ( $new['shoutbox_allow_delete'] ) ? 'checked="checked"' : '';
$allow_delete_no = ( !$new['shoutbox_allow_delete'] ) ? 'checked="checked"' : '';

$allow_delete_all_yes = ( $new['shoutbox_allow_delete_all'] ) ? 'checked="checked"' : '';
$allow_delete_all_no = ( !$new['shoutbox_allow_delete_all'] ) ? 'checked="checked"' : '';

$allow_guest_yes = ( $new['shoutbox_allow_guest'] ) ? 'checked="checked"' : '';
$allow_guest_no = ( !$new['shoutbox_allow_guest'] ) ? 'checked="checked"' : '';

$allow_guest_view_yes = ( $new['shoutbox_allow_guest_view'] ) ? 'checked="checked"' : '';
$allow_guest_view_no = ( !$new['shoutbox_allow_guest_view'] ) ? 'checked="checked"' : '';
//-- fin mod : minichat --------------------------------------------------------

//-- mod : jail mod ------------------------------------------------------------
//-- add
$allow_display_bars_yes = ( $new['cell_allow_display_bars'] ) ? 'checked="checked"' : '';
$allow_display_bars_no = ( !$new['cell_allow_display_bars'] ) ? 'checked="checked"' : '';

$allow_display_celleds_yes = ( $new['cell_allow_display_celleds'] ) ? 'checked="checked"' : '';
$allow_display_celleds_no = ( !$new['cell_allow_display_celleds'] ) ? 'checked="checked"' : '';

$allow_user_caution_yes = ( $new['cell_allow_user_caution'] ) ? 'checked="checked"' : '';
$allow_user_caution_no = ( !$new['cell_allow_user_caution'] ) ? 'checked="checked"' : '';

$allow_user_judge_yes = ( $new['cell_allow_user_judge'] ) ? 'checked="checked"' : '';
$allow_user_judge_no = ( !$new['cell_allow_user_judge'] ) ? 'checked="checked"' : '';

$allow_user_blank_yes = ( $new['cell_allow_user_blank'] ) ? 'checked="checked"' : '';
$allow_user_blank_no = ( !$new['cell_allow_user_blank'] ) ? 'checked="checked"' : '';
//-- fin mod : jail mod --------------------------------------------------------

//-- mod : points system -------------------------------------------------------
//-- add
$points_post_yes = ($new['points_post']) ? 'checked="checked"' : '';
$points_post_no	 = (!$new['points_post']) ? 'checked="checked"' : '';

$points_poll_yes = ($new['points_poll']) ? 'checked="checked"' : '';
$points_poll_no = (!$new['points_poll']) ? 'checked="checked"' : '';

$points_browse_yes = ($new['points_browse']) ? 'checked="checked"' : '';
$points_browse_no	 = (!$new['points_browse']) ? 'checked="checked"' : '';

$points_donate_yes = ($new['points_donate']) ? 'checked="checked"' : '';
$points_donate_no  = (!$new['points_donate']) ? 'checked="checked"' : '';
//-- fin mod : points system ---------------------------------------------------

$template->set_filenames(array('body' => 'admin/board_config_body.tpl'));

//
// Escape any quotes in the site description for proper display in the text
// box on the admin page 
//
$new['site_desc'] = str_replace('"', '&quot;', $new['site_desc']);
$new['sitename'] = str_replace('"', '&quot;', strip_tags($new['sitename']));

//-- mod : disable registration ------------------------------------------------
//-- add
$new['registration_closed'] = str_replace('"', '&quot;', $new['registration_closed']);
//-- fin mod : disable registration --------------------------------------------

$template->assign_vars(array(
	'S_CONFIG_ACTION' => append_sid('admin_board.' . $phpEx),

	'L_YES' => $lang['Yes'],
	'L_NO' => $lang['No'],
	'L_CONFIGURATION_TITLE' => $lang['General_Config'],
	'L_CONFIGURATION_EXPLAIN' => $lang['Config_explain'],
	'L_GENERAL_SETTINGS' => $lang['General_settings'],
	'L_SERVER_NAME' => $lang['Server_name'], 
	'L_SERVER_NAME_EXPLAIN' => $lang['Server_name_explain'], 
	'L_SERVER_PORT' => $lang['Server_port'], 
	'L_SERVER_PORT_EXPLAIN' => $lang['Server_port_explain'], 
	'L_SCRIPT_PATH' => $lang['Script_path'], 
	'L_SCRIPT_PATH_EXPLAIN' => $lang['Script_path_explain'], 
	'L_SITE_NAME' => $lang['Site_name'],
	'L_SITE_DESCRIPTION' => $lang['Site_desc'],
	'L_DISABLE_BOARD' => $lang['Board_disable'], 
	'L_DISABLE_BOARD_EXPLAIN' => $lang['Board_disable_explain'], 
	'L_ACCT_ACTIVATION' => $lang['Acct_activation'], 
	'L_NONE' => $lang['Acc_None'], 
	'L_USER' => $lang['Acc_User'], 
	'L_ADMIN' => $lang['Acc_Admin'], 
	'L_VISUAL_CONFIRM' => $lang['Visual_confirm'], 
	'L_VISUAL_CONFIRM_EXPLAIN' => $lang['Visual_confirm_explain'], 
	'L_ALLOW_AUTOLOGIN' => $lang['Allow_autologin'],
	'L_ALLOW_AUTOLOGIN_EXPLAIN' => $lang['Allow_autologin_explain'],
	'L_AUTOLOGIN_TIME' => $lang['Autologin_time'],
	'L_AUTOLOGIN_TIME_EXPLAIN' => $lang['Autologin_time_explain'],
	'L_COOKIE_SETTINGS' => $lang['Cookie_settings'], 
	'L_COOKIE_SETTINGS_EXPLAIN' => $lang['Cookie_settings_explain'], 
	'L_COOKIE_DOMAIN' => $lang['Cookie_domain'],
	'L_COOKIE_NAME' => $lang['Cookie_name'], 
	'L_COOKIE_PATH' => $lang['Cookie_path'], 
	'L_COOKIE_SECURE' => $lang['Cookie_secure'], 
	'L_COOKIE_SECURE_EXPLAIN' => $lang['Cookie_secure_explain'], 
	'L_SESSION_LENGTH' => $lang['Session_length'], 
	'L_PRIVATE_MESSAGING' => $lang['Private_Messaging'], 
	'L_INBOX_LIMIT' => $lang['Inbox_limits'], 
	'L_SENTBOX_LIMIT' => $lang['Sentbox_limits'], 
	'L_SAVEBOX_LIMIT' => $lang['Savebox_limits'], 
	'L_DISABLE_PRIVATE_MESSAGING' => $lang['Disable_privmsg'], 
	'L_ENABLED' => $lang['Enabled'], 
	'L_DISABLED' => $lang['Disabled'], 
	'L_ABILITIES_SETTINGS' => $lang['Abilities_settings'],
	'L_MAX_POLL_OPTIONS' => $lang['Max_poll_options'],
	'L_FLOOD_INTERVAL' => $lang['Flood_Interval'],
	'L_FLOOD_INTERVAL_EXPLAIN' => $lang['Flood_Interval_explain'], 
	'L_SEARCH_FLOOD_INTERVAL' => $lang['Search_Flood_Interval'],
	'L_SEARCH_FLOOD_INTERVAL_EXPLAIN' => $lang['Search_Flood_Interval_explain'], 

//-- mod : welcome private message ---------------------------------------------
//-- add
	'L_WPM' => $lang['wpm'],
	'L_WPM_ACTIVE' => $lang['wpm_active'],
	'L_WPM_NAME' => $lang['wpm_name'],
	'L_WPM_SUBJECT' => $lang['wpm_subject'],
	'L_WPM_MESSAGE' => $lang['wpm_message'],

	'WPM_ACTIVE_YES' => $wmp_active_yes,
	'WPM_ACTIVE_NO' => $wmp_active_no,
	'WPM_USERNAME' => $board_config['wpm_username'],
	'WPM_SUBJECT' => stripslashes($new['wpm_subject']),
	'WPM_MESSAGE' => stripslashes($new['wpm_message']),
//-- fin mod : welcome private message -----------------------------------------

//-- mod : disallow editing/deleting administrator posts -----------------------
//-- add
	'L_DISALLOW_EDITING_DELETING_ADMIN_MESSAGES' => $lang['Disallow_Edition_Deleting_Admin_Messages'],
	'DISALLOW_EDITING_DELETING_ADMIN_MESSAGES_YES' => $disallow_edition_deleting_admin_messages_yes,
	'DISALLOW_EDITING_DELETING_ADMIN_MESSAGES_NO' => $disallow_edition_deleting_admin_messages_no,
//-- fin mod : disallow editing/deleting administrator posts -------------------

//-- mod : oxygen premodded version --------------------------------------------
//-- add
	'L_SECURITY_SETTINGS' => $lang['Security_settings'],
	'L_SUSCRIBE_SETTINGS' => $lang['Suscribe_settings'],
	'L_TIME_SETTINGS' => $lang['Time_settings'],
	'L_MESSAGES_SETTINGS' => $lang['Messages_settings'],
	'L_SHOUTBOX_SETTINGS' => $lang['Shoutbox_Settings'],
	'L_YELLOW_CARD_MOD' => $lang['Yellow_card'],
	'L_DIV_SETTINGS' => $lang['Div_Settings'],
	'L_RESTRICTION_SETTINGS' => $lang['Restriction_Settings'],
//-- fin mod : oxygen premodded version ----------------------------------------

//-- mod : forum meta tags -----------------------------------------------------
//-- add
  'L_META_TAGS' => $lang['Meta_Tags'],
  'L_META_TAGS_EXPLAIN' => $lang['Meta_Tags_Explain'],
  'L_META_LANGUAGE' => $lang['Meta_Language'],
  'L_META_LANGUAGE_EXPLAIN' => $lang['Meta_Language_Explain'],
  'L_META_AUTHOR' => $lang['Meta_Author'],
  'L_META_AUTHOR_EXPLAIN' => $lang['Meta_Author_Explain'],
  'L_META_DESCRIPTION' => $lang['Meta_Description'],
  'L_META_DESCRIPTION_EXPLAIN' => $lang['Meta_Description_Explain'],
  'L_META_KEYWORDS' => $lang['Meta_Keywords'],
  'L_META_KEYWORDS_EXPLAIN' => $lang['Meta_Keywords_Explain'],
  'L_META_ROBOTS' => $lang['Meta_Robots'],
  'L_META_ROBOTS_EXPLAIN' => $lang['Meta_Robots_Explain'],
  'L_META_RATING' => $lang['Meta_Rating'],
  'L_META_RATING_EXPLAIN' => $lang['Meta_Rating_Explain'],
  'L_META_VISIT_AFTER' => $lang['Meta_Visit_After'],
  'L_META_VISIT_AFTER_EXPLAIN' => $lang['Meta_Visit_After_Explain'],

  'META_LANGUAGE' => $new['meta_language'],
  'META_AUTHOR' => $new['meta_author'],
  'META_KEYWORDS' => $new['meta_keywords'],
  'META_DESCRIPTION' => $new['meta_description'],
  'META_ROBOTS' => $new['meta_robots'],
  'META_RATING' => $new['meta_rating'],
  'META_VISIT_AFTER' => $new['meta_visit_after'],
//-- fin mod : forum meta tags -------------------------------------------------

//-- mod : minichat ------------------------------------------------------------
//-- add
	'SHOUTBOX_ON_YES' => $shoutbox_on_yes,
	'SHOUTBOX_ON_NO' => $shoutbox_on_no,
	'DATE_ON_YES' => $date_on_yes,
	'DATE_ON_NO' => $date_on_no,
	'MAKE_LINKS_YES' => $make_links_yes,
	'MAKE_LINKS_NO' => $make_links_no,
	'LINKS_NAMES_YES' => $links_names_yes,
	'LINKS_NAMES_NO' => $links_names_no,
	'ALLOW_SMILIES_YES' => $allow_smilies_yes,
	'ALLOW_SMILIES_NO' => $allow_smilies_no,
	'ALLOW_BBCODE_YES' => $allow_bbcode_yes,
	'ALLOW_BBCODE_NO' => $allow_bbcode_no,
	'ALLOW_EDIT_YES' => $allow_edit_yes,
	'ALLOW_EDIT_NO' => $allow_edit_no,
	'ALLOW_EDIT_ALL_YES' => $allow_edit_all_yes,
	'ALLOW_EDIT_ALL_NO' => $allow_edit_all_no,
	'ALLOW_DELETE_YES' => $allow_delete_yes,
	'ALLOW_DELETE_NO' => $allow_delete_no,
	'ALLOW_DELETE_ALL_YES' => $allow_delete_all_yes,
	'ALLOW_DELETE_ALL_NO' => $allow_delete_all_no,
	'ALLOW_GUEST_YES' => $allow_guest_yes,
	'ALLOW_GUEST_NO' => $allow_guest_no,
	'ALLOW_GUEST_VIEW_YES' => $allow_guest_view_yes,
	'ALLOW_GUEST_VIEW_NO' => $allow_guest_view_no,

	'TEXT_LENGHT' => $new['shoutbox_text_lenght'],
	'WORD_LENGHT' => $new['shoutbox_word_lenght'],
	'DATE_FORMAT' => $new['shoutbox_date_format'],
	'SHOUT_WIDTH' => $new['shoutbox_width'],
	'SHOUT_HEIGHT' => $new['shoutbox_height'],
	'BANNED_USER_ID' => $new['shoutbox_banned_user_id'],
	'BANNED_USER_ID_VIEW' => $new['shoutbox_banned_user_id_view'],
	'DELETE_DAYS' => $new['shoutbox_delete_days'],
	'SHOUT_REFRESH_TIME' => $new['shoutbox_refresh_time'],
	'SHOUT_MESSAGES_ON_INDEX' => $new ['shoutbox_messages_number_on_index'],

	'L_SHOUT_MESSAGES_ON_INDEX' => $lang['sb_messages_number_on_index'],
	'L_SHOUT_REFRESH_TIME' => $lang['sb_refresh_time'],
	'L_DELETE_DAYS' => $lang['delete_days'],
	'L_SHOUTBOX_ON' => $lang['shoutbox_on'],
	'L_DATE_ON' => $lang['date_on'],
	'L_ALLOW_SMILIES' => $lang['Allow_smilies'],
	'L_ALLOW_BBCODE' => $lang['Allow_BBCode'],
	'L_DATE_FORMAT' => $lang['Date_format'],
	'L_SHOUT_SIZE' => $lang['shout_size'],
	'L_MAKE_LINKS' => $lang['sb_make_links'],
	'L_LINKS_NAMES' => $lang['sb_links_names'],
	'L_ALLOW_EDIT' => $lang['sb_allow_edit'],
	'L_ALLOW_EDIT_ALL' => $lang['sb_allow_edit_all'],
	'L_ALLOW_DELETE' => $lang['sb_allow_delete'],
	'L_ALLOW_DELETE_ALL' => $lang['sb_allow_delete_all'],
	'L_ALLOW_GUEST' => $lang['sb_allow_guest'],
	'L_ALLOW_GUEST_VIEW' => $lang['sb_allow_guest_view'],
	'L_TEXT_LENGHT' => $lang['sb_text_lenght'],
	'L_WORD_LENGHT' => $lang['sb_word_lenght'],
	'L_BANNED_USER_ID' => $lang['sb_banned_user_send'],
	'L_BANNED_USER_ID_E' => $lang['sb_banned_user_send_e'],
	'L_BANNED_USER_ID_VIEW' => $lang['sb_banned_user_view'],
	'L_BANNED_USER_ID_VIEW_E' => $lang['sb_banned_user_view_e'],
//-- fin mod : minichat --------------------------------------------------------

//-- mod : jail mod ------------------------------------------------------------
//-- add
	'CELL_BARS_YES' => $allow_display_bars_yes,
	'CELL_BARS_NO' => $allow_display_bars_no,
	'CELL_CELLEDS_YES' => $allow_display_celleds_yes,
	'CELL_CELLEDS_NO' => $allow_display_celleds_no,
	'CELL_CAUTION_YES' => $allow_user_caution_yes,
	'CELL_CAUTION_NO' => $allow_user_caution_no,
	'CELL_JUDGE_YES' => $allow_user_judge_yes,
	'CELL_JUDGE_NO' => $allow_user_judge_no,
	'CELL_BLANK_YES' => $allow_user_blank_yes,
	'CELL_BLANK_NO' => $allow_user_blank_no,

	'CELL_VOTERS' => $new['cell_user_judge_voters'],
	'CELL_POSTS' => $new['cell_user_judge_posts'],
	'CELL_BLANK_SUM' => $new['cell_amount_user_blank'],

	'L_CELL' => $lang['Cell'],
	'L_CELL_BARS' => $lang['Cell_settings_bars'],
	'L_CELL_CELLEDS' => $lang['Cell_settings_celleds'],
	'L_CELL_CAUTION' => $lang['Cell_settings_caution'],
	'L_CELL_JUDGE' => $lang['Cell_settings_judge'],
	'L_CELL_BLANK' => $lang['Cell_settings_blank'],
	'L_CELL_BLANK_SUM' => $lang['Cell_settings_blank_sum'],
	'L_CELL_VOTERS' => $lang['Cell_settings_voters'],
	'L_CELL_POSTS' => $lang['Cell_settings_posts'],
//-- fin mod : jail mod --------------------------------------------------------

//-- mod : points system -------------------------------------------------------
//-- add
	'S_POINTS_POST_YES' => $points_post_yes,
	'S_POINTS_POST_NO' => $points_post_no,
	'S_POINTS_BROWSE_YES' => $points_browse_yes,
	'S_POINTS_BROWSE_NO' => $points_browse_no,
	'S_POINTS_DONATE_YES' => $points_donate_yes,
	'S_POINTS_DONATE_NO' => $points_donate_no,

	'S_POINTS_REPLY' => $new['points_reply'],
	'S_POINTS_TOPIC' => $new['points_topic'],
	'S_POINTS_PAGE' => $new['points_page'],
	'S_POINTS_NAME' => $new['points_name'],
	'S_USER_GROUP_AUTH' => $new['points_user_group_auth_ids'],

	'L_SYS_SETTINGS' => $lang['Points_Configuration'],
	'L_ENABLE_POST' => sprintf($lang['Points_enable_post'], $board_config['points_name']),
	'L_ENABLE_BROWSE' => sprintf($lang['Points_enable_browse'], $board_config['points_name']),
	'L_ENABLE_DONATION' => $lang['Points_enable_donation'],
	'L_POINTS_NAME' => $lang['Points_name'],
	'L_PER_REPLY' => $lang['Points_per_reply'],
	'L_PER_TOPIC' => $lang['Points_per_topic'],
	'L_PER_PAGE' => $lang['Points_per_page'],
	'L_USER_GROUP_AUTH' => $lang['Points_user_group_auth'],
	'L_ENABLE_POST_EXPLAIN' => sprintf($lang['Points_enable_post_explain'], $board_config['points_name']),
	'L_ENABLE_BROWSE_EXPLAIN' => sprintf($lang['Points_enable_browse_explain'], $board_config['points_name']),
	'L_ENABLE_DONATION_EXPLAIN' => sprintf($lang['Points_enable_donation_explain'], $board_config['points_name']),
	'L_POINTS_NAME_EXPLAIN' => $lang['Points_name_explain'],
	'L_PER_REPLY_EXPLAIN' => sprintf($lang['Points_per_reply_explain'], $board_config['points_name']),
	'L_PER_TOPIC_EXPLAIN' => sprintf($lang['Points_per_topic_explain'], $board_config['points_name']),
	'L_PER_PAGE_EXPLAIN' => sprintf($lang['Points_per_page_explain'], $board_config['points_name']),
	'L_USER_GROUP_AUTH_EXPLAIN' => $lang['Points_user_group_auth_explain'],
	'L_POINTS_RESET' => $lang['Points_reset'],
	'L_POINTS_RESET_EXPLAIN' => $lang['Points_reset_explain'],
//-- fin mod : points system ---------------------------------------------------

//-- mod : block the index to the guests ---------------------------------------
//-- add
  'L_NO_GUEST_ON_INDEX' => $lang['No_Guest_on_Index'],
	'NO_GUEST_ON_INDEX_YES' => $no_guest_on_index_yes, 
	'NO_GUEST_ON_INDEX_NO' => $no_guest_on_index_no,
//-- fin mod : block the index to the guests -----------------------------------

//-- mod : smiley categories ---------------------------------------------------
//-- add
	'L_SMILEY_CONFIGURATION' => $lang['Smiley_Config'],

	'L_SMILEY_TABLE_COLUMNS' => $lang['Smiley_table_columns'],
	'L_SMILEY_TABLE_ROWS' => $lang['Smiley_table_rows'],
	'L_SMILEY_WINDOW_COLUMNS' => $lang['Smiley_window_columns'],
	'L_SMILEY_POSTING' => $lang['Smiley_posting'],
	'L_SMILEY_POPUP' => $lang['Smiley_popup'],
	'L_SMILEY_NOTHING' => $lang['smiley_nothing'],
	'L_SMILEY_BUTTON' => $lang['Smiley_button'],
	'L_SMILEY_DROPDOWN' => $lang['Smiley_dropdown'],
	'L_SMILEY_BUTTONS' => $lang['Smiley_buttons'],
	'L_BUTTONS_ICON' => $lang['Smiley_buttons_icon'],
	'L_BUTTONS_NAME' => $lang['Smiley_buttons_name'],
	'L_BUTTONS_NUMBER' => $lang['Smiley_buttons_number'],
	'L_SMILIES_ICON_PATH' => $lang['Smilies_icon_path'],
	'L_SMILIES_ICON_PATH_EXPLAIN' => $lang['Smilies_icon_path_explain'],

	'SMILIES_ICON_PATH' => $new['smilie_icon_path'],
	'SMILEY_COLUMNS' => $new['smilie_columns'],
	'SMILEY_ROWS' => $new['smilie_rows'],

	'SMILEY_NOTHING1' => ( $new['smilie_posting'] == 0 ) ? ' selected="selected"' : '',
	'SMILEY_BUTTONS1' => ( $new['smilie_posting'] == 1 ) ? ' selected="selected"' : '',
	'SMILEY_DROPDOWN1' => ( $new['smilie_posting'] == 2 ) ? ' selected="selected"' : '',

	'SMILEY_NOTHING2' => ( $new['smilie_popup'] == 0 ) ? ' selected="selected"' : '',
	'SMILEY_BUTTONS2' => ( $new['smilie_popup'] == 1 ) ? ' selected="selected"' : '',
	'SMILEY_DROPDOWN2' => ( $new['smilie_popup'] == 2 ) ? ' selected="selected"' : '',

	'SMILEY_BUTTONS_ICON' => ( $new['smilie_buttons'] == 2 ) ? 'checked="checked"' : '',
	'SMILEY_BUTTONS_NAME' => ( $new['smilie_buttons'] == 1 ) ? 'checked="checked"' : '',
	'SMILEY_BUTTONS_NUMBER' => ( $new['smilie_buttons'] == 0 ) ? 'checked="checked"' : '',
//-- fin mod : smiley categories -----------------------------------------------

//-- mod : board favicon -------------------------------------------------------
//-- add
  'L_FAVICON_ICON' => $lang['Favicon_icon'],
  'L_FAVICON_ICON_EXPLAIN' => $lang['Favicon_icon_explain'],
  'FAVICON_ICON' => $new['favicon_icon'],
//-- fin mod : board favicon ---------------------------------------------------

//-- mod : access limitation ---------------------------------------------------
//-- add
	'L_RESTRICTION_SETTINGS' => $lang['Restriction_Settings'],
	'L_MEMBERLIST_ACCESS' => $lang['Memberlist_access'],
	'L_PROFILE_ACCESS' => $lang['Profile_access'],
	'L_FAQ_ACCESS' => $lang['Faq_access'],
	'L_GROUPS_ACCESS' => $lang['Groups_access'],
	'L_SEARCH_ACCESS' => $lang['Search_access'],
	'L_VIEWONLINE_ACCESS' => $lang['Viewonline_access'],
	'L_CELL_ACCESS' => $lang['Cell_access'],
	'L_SHOUTBOX_ACCESS' => $lang['Shoutbox_access'],
	'L_REFERRERS_ACCESS' => $lang['Referrers_access'],
		'L_PUBLIC' => $lang['Public'],
		'L_REGISTERED' => $lang['Registered'],
		'L_MODERATOR' => $lang['Moderator'],
		'L_ADMINISTRATOR' => $lang['Acc_Admin'],

	'MEMBERLIST_ACCESS_ALL' => ($new['memberlist_access'] == '-1') ? 'selected="selected"' : '',
	'MEMBERLIST_ACCESS_REG' => ($new['memberlist_access'] == '0') ? 'selected="selected"' : '',
	'MEMBERLIST_ACCESS_MOD' => ($new['memberlist_access'] == '2') ? 'selected="selected"' : '',
	'MEMBERLIST_ACCESS_ADMIN' => ($new['memberlist_access'] == '1') ? 'selected="selected"' : '',

	'PROFILE_ACCESS_ALL' => ($new['profile_access'] == '-1') ? 'selected="selected"' : '',
	'PROFILE_ACCESS_REG' => ($new['profile_access'] == '0') ? 'selected="selected"' : '',
	'PROFILE_ACCESS_MOD' => ($new['profile_access'] == '2') ? 'selected="selected"' : '',
	'PROFILE_ACCESS_ADMIN' => ($new['profile_access'] == '1') ? 'selected="selected"' : '',

	'FAQ_ACCESS_ALL' => ($new['faq_access'] == '-1') ? 'selected="selected"' : '',
	'FAQ_ACCESS_REG' => ($new['faq_access'] == '0') ? 'selected="selected"' : '',
	'FAQ_ACCESS_MOD' => ($new['faq_access'] == '2') ? 'selected="selected"' : '',
	'FAQ_ACCESS_ADMIN' => ($new['faq_access'] == '1') ? 'selected="selected"' : '',

	'GROUPS_ACCESS_ALL' => ($new['groups_access'] == '-1') ? 'selected="selected"' : '',
	'GROUPS_ACCESS_REG' => ($new['groups_access'] == '0') ? 'selected="selected"' : '',
	'GROUPS_ACCESS_MOD' => ($new['groups_access'] == '2') ? 'selected="selected"' : '',
	'GROUPS_ACCESS_ADMIN' => ($new['groups_access'] == '1') ? 'selected="selected"' : '',

	'SEARCH_ACCESS_ALL' => ($new['search_access'] == '-1') ? 'selected="selected"' : '',
	'SEARCH_ACCESS_REG' => ($new['search_access'] == '0') ? 'selected="selected"' : '',
	'SEARCH_ACCESS_MOD' => ($new['search_access'] == '2') ? 'selected="selected"' : '',
	'SEARCH_ACCESS_ADMIN' => ($new['search_access'] == '1') ? 'selected="selected"' : '',

	'REFERRERS_ACCESS_ALL' => ($new['referrers_access'] == '-1') ? 'selected="selected"' : '',
	'REFERRERS_ACCESS_REG' => ($new['referrers_access'] == '0') ? 'selected="selected"' : '',
	'REFERRERS_ACCESS_MOD' => ($new['referrers_access'] == '2') ? 'selected="selected"' : '',
	'REFERRERS_ACCESS_ADMIN' => ($new['referrers_access'] == '1') ? 'selected="selected"' : '',

	'VIEWONLINE_ACCESS_ALL' => ($new['viewonline_access'] == '-1') ? 'selected="selected"' : '',
	'VIEWONLINE_ACCESS_REG' => ($new['viewonline_access'] == '0') ? 'selected="selected"' : '',
	'VIEWONLINE_ACCESS_MOD' => ($new['viewonline_access'] == '2') ? 'selected="selected"' : '',
	'VIEWONLINE_ACCESS_ADMIN' => ($new['viewonline_access'] == '1') ? 'selected="selected"' : '',

	'CELL_ACCESS_ALL' => ($new['cell_access'] == '-1') ? 'selected="selected"' : '',
	'CELL_ACCESS_REG' => ($new['cell_access'] == '0') ? 'selected="selected"' : '',
	'CELL_ACCESS_MOD' => ($new['cell_access'] == '2') ? 'selected="selected"' : '',
	'CELL_ACCESS_ADMIN' => ($new['cell_access'] == '1') ? 'selected="selected"' : '',

	'SHOUTBOX_ACCESS_ALL' => ($new['shoutbox_access'] == '-1') ? 'selected="selected"' : '',
	'SHOUTBOX_ACCESS_REG' => ($new['shoutbox_access'] == '0') ? 'selected="selected"' : '',
	'SHOUTBOX_ACCESS_MOD' => ($new['shoutbox_access'] == '2') ? 'selected="selected"' : '',
	'SHOUTBOX_ACCESS_ADMIN' => ($new['shoutbox_access'] == '1') ? 'selected="selected"' : '',
//-- fin mod : access limitation -----------------------------------------------

//-- mod : pm threshold --------------------------------------------------------
//-- add
	'L_PM_ALLOW_THRESHOLD' => $lang['pm_allow_threshold'],
	'L_PM_ALLOW_TRHESHOLD_EXPLAIN' => $lang['pm_allow_threshold_explain'],
	'PM_ALLOW_THRESHOLD' => $new['pm_allow_threshold'],
//-- fin mod : pm threshold ----------------------------------------------------

//-- mod : disable registration ------------------------------------------------
//-- add
	'L_REGISTRATION_STATUS' => $lang['disable_registration_status'],
	'L_REGISTRATION_STATUS_EXPLAIN' => $lang['disable_registration_status_explain'],
	'L_REGISTRATION_CLOSED' => $lang['registration_closed'],
	'L_REGISTRATION_CLOSED_EXPLAIN' => $lang['registration_closed_explain'],
	'S_REGISTRATION_STATUS_YES' => $registration_status_yes,
	'S_REGISTRATION_STATUS_NO' => $registration_status_no,
	'REGISTRATION_CLOSED' => $new['registration_closed'],
//-- fin mod : disable registration --------------------------------------------

//-- mod : disable board message -----------------------------------------------
//-- add
	'L_DISABLED_CAPTION' => $lang['Board_disable_caption'],
	'L_DISABLED_TEXT' => $lang['Board_disable_text'],
	'DISABLED_CAPTION' => $new['board_disable_caption'],
	'DISABLED_TEXT' => $new['board_disable_text'],
//-- fin mod : disable board message -------------------------------------------

//-- mod : presentation --------------------------------------------------------
//-- add
	'L_PRESENT_FORUM' => $lang['present_forum'],
	'L_PRESENT_EXPLAIN' => $lang['present_explain'],
	'L_PRESENT_REQUIRED' => $lang['present_required'],
	'PRESENT_REQUIRED_YES' => $present_required_yes,
	'PRESENT_REQUIRED_NO' => $present_required_no, 
	'PRESENT_FORUM' => $new['present_forum'],
//-- fin mod : presentation ----------------------------------------------------

//-- mod : separate pm limits for admins and mods ------------------------------
//-- add
	'L_ADMINISTRATOR_INBOX_LIMIT' => $lang['Administrator_Inbox_limits'],
	'L_ADMINISTRATOR_SENTBOX_LIMIT' => $lang['Administrator_Sentbox_limits'],
	'L_ADMINISTRATOR_SAVEBOX_LIMIT' => $lang['Administrator_Savebox_limits'],
	'L_MODERATOR_INBOX_LIMIT' => $lang['Moderator_Inbox_limits'],
	'L_MODERATOR_SENTBOX_LIMIT' => $lang['Moderator_Sentbox_limits'],
	'L_MODERATOR_SAVEBOX_LIMIT' => $lang['Moderator_Savebox_limits'],

	'ADMINISTRATOR_INBOX_LIMIT' => $new['administrator_max_inbox_privmsgs'],
	'ADMINISTRATOR_SENTBOX_LIMIT' => $new['administrator_max_sentbox_privmsgs'],
	'ADMINISTRATOR_SAVEBOX_LIMIT' => $new['administrator_max_savebox_privmsgs'],
	'MODERATOR_INBOX_LIMIT' => $new['moderator_max_inbox_privmsgs'],
	'MODERATOR_SENTBOX_LIMIT' => $new['moderator_max_sentbox_privmsgs'],
	'MODERATOR_SAVEBOX_LIMIT' => $new['moderator_max_savebox_privmsgs'],
//-- fin mod : separate pm limits for admins and mods --------------------------

//-- mod : trashbox ------------------------------------------------------------
//-- add
	'L_TRASHBOX_LIMIT' => $lang['Trashbox_limits'],
	'TRASHBOX_LIMIT' => $new['max_trashbox_privmsgs'],

	'L_ADMINISTRATOR_TRASHBOX_LIMIT' => $lang['Administrator_Trashbox_limits'],
	'L_MODERATOR_TRASHBOX_LIMIT' => $lang['Moderator_Trashbox_limits'],
	'ADMINISTRATOR_TRASHBOX_LIMIT' => $new['administrator_max_trashbox_privmsgs'],
	'MODERATOR_TRASHBOX_LIMIT' => $new['moderator_max_trashbox_privmsgs'],
//-- fin mod : trashbox --------------------------------------------------------

//-- mod : double post merge ---------------------------------------------------
//-- add
	'L_JOIN_INTERVAL' => $lang['Join_Interval'],
	'L_JOIN_INTERVAL_EXPLAIN' => $lang['Join_Interval_explain'], 
	'JOIN_INTERVAL' => $new['join_interval'],
//-- fin mod : double post merge -----------------------------------------------

//-- mod : double post merge ---------------------------------------------------
//-- add
	'L_LAST_TOPIC_TITLE_LENGHT' => $lang['Last_topic_title_length'],
	'L_LAST_TOPIC_TITLE_LENGHT_EXPLAIN' => $lang['Last_topic_title_length_explain'], 
	'LAST_TOPIC_TITLE_LENGHT' => $new['last_topic_title_length'],
//-- fin mod : double post merge -----------------------------------------------

//-- mod : maxi simple subforums -----------------------------------------------
//-- add
	'L_MAX_SUBFORUMS' => $lang['Max_subforums'],
	'L_MAX_SUBFORUMS_EXPLAIN' => $lang['Max_subforums_explain'],
	'MAX_SUBFORUMS' => $new['max_subforums'],
//-- fin mod : maxi simple subforums -------------------------------------------

//-- mod : resize posted images based on max width -----------------------------
//-- add
  'L_IMAGES_MAX_SIZE' => $lang['Images_max_size'],
  'IMAGES_MAX_SIZE' => $new['images_max_size'],
//-- fin mod : resize posted images based on max width -------------------------

//-- mod : annonce globale -----------------------------------------------------
//-- add
	'L_ANNONCE_GLOBALE_INDEX' => $lang['Annonce_Globale_Index'],
	'ANNONCE_GLOBALE_INDEX_YES' => $annonce_globale_index_yes,
	'ANNONCE_GLOBALE_INDEX_NO' => $annonce_globale_index_no,
//-- fin mod : annonce globale -------------------------------------------------

//-- mod : split topic type ----------------------------------------------------
//-- add
	'L_SPLIT_GLOBAL_ANNOUNCE' => $lang['split_global_announce'],
	'SPLIT_GLOBAL_ANNOUNCE_YES' => $split_global_announce_yes,
	'SPLIT_GLOBAL_ANNOUNCE_NO' => $split_global_announce_no,

	'L_SPLIT_ANNOUNCE' => $lang['split_announce'],
	'SPLIT_ANNOUNCE_YES' => $split_announce_yes,
	'SPLIT_ANNOUNCE_NO' => $split_announce_no,

	'L_SPLIT_STICKY' => $lang['split_sticky'],
	'SPLIT_STICKY_YES' => $split_sticky_yes,
	'SPLIT_STICKY_NO' => $split_sticky_no,

	'L_SPLIT_TOPIC_SPLIT' => $lang['split_topic_split'],
	'SPLIT_TOPIC_SPLIT_YES' => $split_topic_split_yes,
	'SPLIT_TOPIC_SPLIT_NO' => $split_topic_split_no,
//-- fin mod : split topic type ------------------------------------------------

	'L_MAX_LOGIN_ATTEMPTS'			=> $lang['Max_login_attempts'],
	'L_MAX_LOGIN_ATTEMPTS_EXPLAIN'	=> $lang['Max_login_attempts_explain'],
	'L_LOGIN_RESET_TIME'			=> $lang['Login_reset_time'],
	'L_LOGIN_RESET_TIME_EXPLAIN'	=> $lang['Login_reset_time_explain'],
	'MAX_LOGIN_ATTEMPTS'			=> $new['max_login_attempts'],
	'LOGIN_RESET_TIME'				=> $new['login_reset_time'],

	'L_BOARD_EMAIL_FORM' => $lang['Board_email_form'], 
	'L_BOARD_EMAIL_FORM_EXPLAIN' => $lang['Board_email_form_explain'], 
	'L_TOPICS_PER_PAGE' => $lang['Topics_per_page'],
	'L_POSTS_PER_PAGE' => $lang['Posts_per_page'],
	'L_HOT_THRESHOLD' => $lang['Hot_threshold'],
	'L_DEFAULT_STYLE' => $lang['Default_style'],
	'L_OVERRIDE_STYLE' => $lang['Override_style'],
	'L_OVERRIDE_STYLE_EXPLAIN' => $lang['Override_style_explain'],
	'L_DEFAULT_LANGUAGE' => $lang['Default_language'],
	'L_DATE_FORMAT' => $lang['Date_format'],
	'L_SYSTEM_TIMEZONE' => $lang['System_timezone'],
	'L_ENABLE_GZIP' => $lang['Enable_gzip'],
	'L_ENABLE_PRUNE' => $lang['Enable_prune'],
	'L_ALLOW_HTML' => $lang['Allow_HTML'],
	'L_ALLOW_BBCODE' => $lang['Allow_BBCode'],
	'L_ALLOWED_TAGS' => $lang['Allowed_tags'],
	'L_ALLOWED_TAGS_EXPLAIN' => $lang['Allowed_tags_explain'],
	'L_ALLOW_SMILIES' => $lang['Allow_smilies'],
	'L_SMILIES_PATH' => $lang['Smilies_path'],
	'L_SMILIES_PATH_EXPLAIN' => $lang['Smilies_path_explain'],
	'L_ALLOW_SIG' => $lang['Allow_sig'],
	'L_MAX_SIG_LENGTH' => $lang['Max_sig_length'],
	'L_MAX_SIG_LENGTH_EXPLAIN' => $lang['Max_sig_length_explain'],
	'L_AVATAR_SETTINGS' => $lang['Avatar_settings'],
	'L_ALLOW_LOCAL' => $lang['Allow_local'],
	'L_ALLOW_REMOTE' => $lang['Allow_remote'],
	'L_ALLOW_REMOTE_EXPLAIN' => $lang['Allow_remote_explain'],
	'L_ALLOW_UPLOAD' => $lang['Allow_upload'],
	'L_MAX_FILESIZE' => $lang['Max_filesize'],
	'L_MAX_FILESIZE_EXPLAIN' => $lang['Max_filesize_explain'],
	'L_MAX_AVATAR_SIZE' => $lang['Max_avatar_size'],
	'L_MAX_AVATAR_SIZE_EXPLAIN' => $lang['Max_avatar_size_explain'],
	'L_AVATAR_STORAGE_PATH' => $lang['Avatar_storage_path'],
	'L_AVATAR_STORAGE_PATH_EXPLAIN' => $lang['Avatar_storage_path_explain'],
	'L_AVATAR_GALLERY_PATH' => $lang['Avatar_gallery_path'],
	'L_AVATAR_GALLERY_PATH_EXPLAIN' => $lang['Avatar_gallery_path_explain'],
	'L_COPPA_SETTINGS' => $lang['COPPA_settings'],
	'L_COPPA_FAX' => $lang['COPPA_fax'],
	'L_COPPA_MAIL' => $lang['COPPA_mail'],
	'L_COPPA_MAIL_EXPLAIN' => $lang['COPPA_mail_explain'],
	'L_EMAIL_SETTINGS' => $lang['Email_settings'],
	'L_ADMIN_EMAIL' => $lang['Admin_email'],
	'L_EMAIL_SIG' => $lang['Email_sig'],
	'L_EMAIL_SIG_EXPLAIN' => $lang['Email_sig_explain'],
	'L_USE_SMTP' => $lang['Use_SMTP'],
	'L_USE_SMTP_EXPLAIN' => $lang['Use_SMTP_explain'],
	'L_SMTP_SERVER' => $lang['SMTP_server'], 
	'L_SMTP_USERNAME' => $lang['SMTP_username'], 
	'L_SMTP_USERNAME_EXPLAIN' => $lang['SMTP_username_explain'], 
	'L_SMTP_PASSWORD' => $lang['SMTP_password'], 
	'L_SMTP_PASSWORD_EXPLAIN' => $lang['SMTP_password_explain'], 
	'L_SUBMIT' => $lang['Submit'], 
	'L_RESET' => $lang['Reset'],

//-- mod : instant msg ---------------------------------------------------------
//-- add
	'L_INSTANT_MSG_ENABLE' => $lang['Instant_msg_enable'],
	'L_INSTANT_MSG_AUTOPRUNE' => $lang['Instant_msg_autoprune'],
	'L_INSTANT_MSG_AUTO_REFRESH' => $lang['Instant_msg_auto_refresh'],
	'INSTANT_MSG_ENABLE_YES' => $instant_msg_enable_yes,
	'INSTANT_MSG_ENABLE_NO' => $instant_msg_enable_no,
	'INSTANT_MSG_AUTOPRUNE' => $new['instant_msg_delay'],
	'INSTANT_MSG_AUTO_REFRESH' => $new['instant_msg_refresh_time'],
//-- fin mod : instant msg -----------------------------------------------------

//-- mod : quick post es -------------------------------------------------------
//-- add
	'L_QP_SETTINGS' => $lang['qp_settings'],
	'L_QP_USER' => $lang['qp_user'],
	'L_QP_ANON' => $lang['qp_anon'],
//-- fin mod : quick post es ---------------------------------------------------

//-- mod : mini card -----------------------------------------------------------
//-- add
	'L_WARN_LEVEL' => $lang['card_warn_level'],
	'WARN_LEVEL' => $new['card_max'],
//-- fin mod : mini card -------------------------------------------------------

//-- mod : gender --------------------------------------------------------------
//-- add
	'L_GENDER_REQUIRED' => $lang['Gender_required'],
	'GENDER_REQUIRED_YES' => $gender_required_yes,
	'GENDER_REQUIRED_NO' => $gender_required_no,
//-- fin mod : gender ----------------------------------------------------------

//-- mod : online offline hidden -----------------------------------------------
//-- add
	'L_ONLINE_TIME' => $lang['Online_time'],
	'L_ONLINE_TIME_EXPLAIN' => $lang['Online_time_explain'], 
	'ONLINE_TIME' => $new['online_time'],
//-- fin mod : online offline hidden -------------------------------------------

//-- mod : force guests to enter their username --------------------------------
//-- add
	'L_GUESTS_NEED_NAME' => $lang['guests_need_name'],
	'GUESTS_NEED_NAME_YES' => $guests_need_name_yes,
	'GUESTS_NEED_NAME_NO' => $guests_need_name_no,
//-- fin mod : force guests to enter their username ----------------------------

//-- mod : birthday ------------------------------------------------------------
//-- add
	'L_BDAY_SETTINGS' => $lang['bday_settings'],
	'L_BDAY_REQUIRED' => $lang['bday_required'],
	'L_BDAY_REQUIRED_EXPLAIN' => $lang['bday_required_explain'],
	'L_BDAY_GREETING' => $lang['bday_greeting'],
	'L_BDAY_GREETING_EXPLAIN' => $lang['bday_greeting_explain'],
	'L_BDAY_MIN_AGE' => $lang['bday_min_age'],
	'L_BDAY_MAX_AGE' => $lang['bday_max_age'],

	'BDAY_REQUIRED_YES' => $bday_required_yes,
	'BDAY_REQUIRED_NO' => $bday_required_no,
	'BDAY_GREETING_YES' => $bday_greeting_yes,
	'BDAY_GREETING_NO' => $bday_greeting_no,
	'BDAY_MIN_AGE' => $bday_min_age,
	'BDAY_MAX_AGE' => $bday_max_age,
//-- fin mod : birthday --------------------------------------------------------

//-- mod : post icon -----------------------------------------------------------
//-- add
	'L_ICONS_PER_ROW' => $lang['Icons_per_row'], 
	'L_ICONS_PER_ROW_EXPLAIN' => $lang['Icons_per_row_explain'], 
	'ICONS_PER_ROW' => $new['icon_per_row'],
//-- fin mod : post icon -------------------------------------------------------

//-- mod : recycle bin hack ----------------------------------------------------
//-- add
	'L_BIN_FORUM' => $lang['Bin_forum'],
	'L_BIN_FORUM_EXPLAIN' => $lang['Bin_forum_explain'],
	'BIN_FORUM' => $new['bin_forum'],
//-- fin mod : recycle bin hack ------------------------------------------------

//-- mod : forum icon with acp control -----------------------------------------
//-- add
	'L_FORUM_ICON_PATH' => $lang['Forum_icon_path'],
	'L_FORUM_ICON_PATH_EXPLAIN' => $lang['Forum_icon_path_explain'],
	'FORUM_ICON_PATH' => $new['forum_icon_path'],
//-- fin mod : forum icon with acp control -------------------------------------

//-- mod : post description ----------------------------------------------------
//-- add
	'L_SUB_TITLE_LENGTH' => $lang['Sub_title_length'],
	'L_SUB_TITLE_LENGTH_EXPLAIN' => $lang['Sub_title_length_explain'],
	'SUB_TITLE_LENGTH' => $new['sub_title_length'],
//-- fin mod : post description ------------------------------------------------

//-- mod : limit smilies per post ----------------------------------------------
//-- add
	'MAX_SMILIES' => $new['max_smilies'],
	'L_MAX_SMILIES' => $lang['Max_smilies'],
//-- fin mod : limit smilies per post ------------------------------------------

//-- mod : bump topic ----------------------------------------------------------
//-- add
	'L_BUMP_INTERVAL' => $lang['bump_interval'],
	'L_BUMP_INTERVAL_EXPLAIN' => $lang['bump_interval_explain'],
	'L_REPLY_FLOOD_CTRL' => $lang['reply_flood_ctrl'],
	'L_REPLY_FLOOD_CTRL_EXPLAIN' => $lang['reply_flood_ctrl_explain'],

	'S_BUMP_INTERVAL' => bump_interval($new['bump_interval'], $new['bump_type']),
	'REPLY_FLOOD_CTRL_YES' => !empty($new['reply_flood_ctrl']) ? ' checked="checked"' : '',
	'REPLY_FLOOD_CTRL_NO' => empty($new['reply_flood_ctrl']) ? ' checked="checked"' : '',
//-- fin mod : bump topic ------------------------------------------------------

	'SERVER_NAME' => $new['server_name'], 
	'SCRIPT_PATH' => $new['script_path'], 
	'SERVER_PORT' => $new['server_port'], 
	'SITENAME' => $new['sitename'],
	'SITE_DESCRIPTION' => $new['site_desc'], 
	'S_DISABLE_BOARD_YES' => $disable_board_yes,
	'S_DISABLE_BOARD_NO' => $disable_board_no,
	'ACTIVATION_NONE' => USER_ACTIVATION_NONE, 
	'ACTIVATION_NONE_CHECKED' => $activation_none,
	'ACTIVATION_USER' => USER_ACTIVATION_SELF, 
	'ACTIVATION_USER_CHECKED' => $activation_user,
	'ACTIVATION_ADMIN' => USER_ACTIVATION_ADMIN, 
	'ACTIVATION_ADMIN_CHECKED' => $activation_admin, 
	'CONFIRM_ENABLE' => $confirm_yes,
	'CONFIRM_DISABLE' => $confirm_no,
	'ALLOW_AUTOLOGIN_YES' => $allow_autologin_yes,
	'ALLOW_AUTOLOGIN_NO' => $allow_autologin_no,
	'AUTOLOGIN_TIME' => (int) $new['max_autologin_time'],
	'BOARD_EMAIL_FORM_ENABLE' => $board_email_form_yes, 
	'BOARD_EMAIL_FORM_DISABLE' => $board_email_form_no, 
	'MAX_POLL_OPTIONS' => $new['max_poll_options'], 
	'FLOOD_INTERVAL' => $new['flood_interval'],
	'SEARCH_FLOOD_INTERVAL' => $new['search_flood_interval'],
	'TOPICS_PER_PAGE' => $new['topics_per_page'],
	'POSTS_PER_PAGE' => $new['posts_per_page'],
	'HOT_TOPIC' => $new['hot_threshold'],
	'STYLE_SELECT' => $style_select,
	'OVERRIDE_STYLE_YES' => $override_user_style_yes,
	'OVERRIDE_STYLE_NO' => $override_user_style_no,
	'LANG_SELECT' => $lang_select,
	'L_DATE_FORMAT_EXPLAIN' => $lang['Date_format_explain'],
	'DEFAULT_DATEFORMAT' => $new['default_dateformat'],
	'TIMEZONE_SELECT' => $timezone_select,
	'S_PRIVMSG_ENABLED' => $privmsg_on, 
	'S_PRIVMSG_DISABLED' => $privmsg_off, 
	'INBOX_LIMIT' => $new['max_inbox_privmsgs'], 
	'SENTBOX_LIMIT' => $new['max_sentbox_privmsgs'],
	'SAVEBOX_LIMIT' => $new['max_savebox_privmsgs'],
	'COOKIE_DOMAIN' => $new['cookie_domain'], 
	'COOKIE_NAME' => $new['cookie_name'], 
	'COOKIE_PATH' => $new['cookie_path'], 
	'SESSION_LENGTH' => $new['session_length'], 
	'S_COOKIE_SECURE_ENABLED' => $cookie_secure_yes, 
	'S_COOKIE_SECURE_DISABLED' => $cookie_secure_no, 
	'GZIP_YES' => $gzip_yes,
	'GZIP_NO' => $gzip_no,
	'PRUNE_YES' => $prune_yes,
	'PRUNE_NO' => $prune_no, 
	'HTML_TAGS' => $html_tags, 
	'HTML_YES' => $html_yes,
	'HTML_NO' => $html_no,
	'BBCODE_YES' => $bbcode_yes,
	'BBCODE_NO' => $bbcode_no,
	'SMILE_YES' => $smile_yes,
	'SMILE_NO' => $smile_no,
	'SIG_YES' => $sig_yes,
	'SIG_NO' => $sig_no,
	'SIG_SIZE' => $new['max_sig_chars'], 
	'AVATAR_FILESIZE' => $new['avatar_filesize'],
	'AVATAR_MAX_HEIGHT' => $new['avatar_max_height'],
	'AVATAR_MAX_WIDTH' => $new['avatar_max_width'],
	'AVATAR_PATH' => $new['avatar_path'], 
	'AVATAR_GALLERY_PATH' => $new['avatar_gallery_path'], 
	'SMILIES_PATH' => $new['smilies_path'], 
	'INBOX_PRIVMSGS' => $new['max_inbox_privmsgs'], 
	'SENTBOX_PRIVMSGS' => $new['max_sentbox_privmsgs'], 
	'SAVEBOX_PRIVMSGS' => $new['max_savebox_privmsgs'], 
	'EMAIL_FROM' => $new['board_email'],
	'EMAIL_SIG' => $new['board_email_sig'],
	'SMTP_YES' => $smtp_yes,
	'SMTP_NO' => $smtp_no,
	'SMTP_HOST' => $new['smtp_host'],
	'SMTP_USERNAME' => $new['smtp_username'],
	'SMTP_PASSWORD' => $new['smtp_password'],
	'COPPA_MAIL' => $new['coppa_mail'],
	'COPPA_FAX' => $new['coppa_fax'])
);

//-- mod : date format evolved -------------------------------------------------
//-- add
dateformat_select($new['default_dateformat']);
//-- fin mod : date format evolved ---------------------------------------------

$template->pparse('body');

include('./page_footer_admin.'.$phpEx);

?>
