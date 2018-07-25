<?php
/**
*
* @package oxygen premodded board
* @version $Id: admin_hide_entries.php,v 1.0.1 17/03/2007 20:59 EzCom Exp $
* @copyright (c) 2006 EzCom - http://www.ezcom-fr.com/
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['Users']['Hide_Elements'] = $file;
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
	message_die(CRITICAL_ERROR, 'Could not query config information', '', __LINE__, __FILE__, $sql);
}
else
{
	while( $row = $db->sql_fetchrow($result) )
	{
		$config_name = $row['config_name'];
		$config_value = $row['config_value'];
		$default_config[$config_name] = isset($HTTP_POST_VARS['submit']) ? str_replace("'", "\'", $config_value) : $config_value;
		
		$new[$config_name] = ( isset($HTTP_POST_VARS[$config_name]) ) ? $HTTP_POST_VARS[$config_name] : $default_config[$config_name];

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

		if( isset($HTTP_POST_VARS['submit']) )
		{
			$sql = 'UPDATE ' . CONFIG_TABLE . '
				SET config_value = \'' . str_replace("\'", "''", $new[$config_name]) . '\'
				WHERE config_name = \'' . $config_name . '\'';
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Failed to update general configuration for ' . $config_name, '', __LINE__, __FILE__, $sql);
			}
		}
	}

	if( isset($HTTP_POST_VARS['submit']) )
	{
		$message = $lang['Config_updated'] . '<br /><br />' . sprintf($lang['Click_return_profile_config'], '<a href="' . append_sid('admin_hide_entries.'.$phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid('index.'.$phpEx . '?pane=right') . '">', '</a>');

		message_die(GENERAL_MESSAGE, $message);
	}
}

$avatars_local_yes = ( $new['allow_avatar_local'] ) ? 'checked="checked"' : '';
$avatars_local_no = ( !$new['allow_avatar_local'] ) ? 'checked="checked"' : '';
$avatars_remote_yes = ( $new['allow_avatar_remote'] ) ? 'checked="checked"' : '';
$avatars_remote_no = ( !$new['allow_avatar_remote'] ) ? 'checked="checked"' : '';
$avatars_upload_yes = ( $new['allow_avatar_upload'] ) ? 'checked="checked"' : '';
$avatars_upload_no = ( !$new['allow_avatar_upload'] ) ? 'checked="checked"' : '';

//-- mod : configure member profile required fields ----------------------------
//-- add
$user_icq_yes = ( $new['required_icq'] ) ? 'checked="checked"' : '';
$user_icq_no = ( !$new['required_icq'] ) ? 'checked="checked"' : '';
$user_aim_yes = ( $new['required_aim'] ) ? 'checked="checked"' : '';
$user_aim_no = ( !$new['required_aim'] ) ? 'checked="checked"' : '';
$user_msnm_yes = ( $new['required_msnm'] ) ? 'checked="checked"' : '';
$user_msnm_no = ( !$new['required_msnm'] ) ? 'checked="checked"' : '';

//-- mod : skype ---------------------------------------------------------------
//-- add
$user_skype_yes = ( $new['required_skype'] ) ? 'checked="checked"' : '';
$user_skype_no = ( !$new['required_skype'] ) ? 'checked="checked"' : '';
//-- fin mod : skype -----------------------------------------------------------

$user_yim_yes = ( $new['required_yim'] ) ? 'checked="checked"' : '';
$user_yim_no = ( !$new['required_yim'] ) ? 'checked="checked"' : '';
$user_website_yes = ( $new['required_website'] ) ? 'checked="checked"' : '';
$user_website_no = ( !$new['required_website'] ) ? 'checked="checked"' : '';
$user_from_yes = ( $new['required_location'] ) ? 'checked="checked"' : '';
$user_from_no = ( !$new['required_location'] ) ? 'checked="checked"' : '';
$user_occ_yes = ( $new['required_occupation'] ) ? 'checked="checked"' : '';
$user_occ_no = ( !$new['required_occupation'] ) ? 'checked="checked"' : '';
$user_interests_yes = ( $new['required_interests'] ) ? 'checked="checked"' : '';
$user_interests_no = ( !$new['required_interests'] ) ? 'checked="checked"' : '';
$user_signature_yes = ( $new['required_signature'] ) ? 'checked="checked"' : '';
$user_signature_no = ( !$new['required_signature'] ) ? 'checked="checked"' : '';

//-- mod : users set posts & topics count --------------------------------------
//-- add
$user_posts_per_page_yes = ( $new['required_posts_per_page'] ) ? 'checked="checked"' : '';
$user_posts_per_page_no = ( !$new['required_posts_per_page'] ) ? 'checked="checked"' : '';
$user_topics_per_page_yes = ( $new['required_topics_per_page'] ) ? 'checked="checked"' : '';
$user_topics_per_page_no = ( !$new['required_topics_per_page'] ) ? 'checked="checked"' : '';
//-- fin mod : users set posts & topics count ----------------------------------
//-- fin mod : configure member profile required fields ------------------------

//-- mod : gender --------------------------------------------------------------
//-- add
$gender_required_yes = ( $new['gender_required'] ) ? ' checked="checked"' : '';
$gender_required_no = ( !$new['gender_required'] ) ? ' checked="checked"' : '';
//-- fin mod : gender ----------------------------------------------------------

//-- mod : birthday ------------------------------------------------------------
//-- add
$bday_required_yes = ( $bday_required ) ? 'checked="checked"' : '';
$bday_required_no = ( !$bday_required ) ? 'checked="checked"' : '';
//-- fin mod : birthday --------------------------------------------------------

/*
* Profile options
*/
$override_icq_yes = ( $new['override_icq'] ) ? 'checked="checked"' : '';
$override_icq_no = ( !$new['override_icq'] ) ? 'checked="checked"' : '';
$override_aim_yes = ( $new['override_aim'] ) ? 'checked="checked"' : '';
$override_aim_no = ( !$new['override_aim'] ) ? 'checked="checked"' : '';
$override_msn_yes = ( $new['override_msn'] ) ? 'checked="checked"' : '';
$override_msn_no = ( !$new['override_msn'] ) ? 'checked="checked"' : '';

//-- mod : skype ---------------------------------------------------------------
//-- add
$override_skype_yes = ( $new['override_skype'] ) ? 'checked="checked"' : '';
$override_skype_no = ( !$new['override_skype'] ) ? 'checked="checked"' : '';
//-- fin mod : skype -----------------------------------------------------------

$override_yahoo_yes = ( $new['override_yahoo'] ) ? 'checked="checked"' : '';
$override_yahoo_no = ( !$new['override_yahoo'] ) ? 'checked="checked"' : '';
$override_website_yes = ( $new['override_website'] ) ? 'checked="checked"' : '';
$override_website_no = ( !$new['override_website'] ) ? 'checked="checked"' : '';
$override_location_yes = ( $new['override_location'] ) ? 'checked="checked"' : '';
$override_location_no = ( !$new['override_location'] ) ? 'checked="checked"' : '';
$override_occupation_yes = ( $new['override_occupation'] ) ? 'checked="checked"' : '';
$override_occupation_no = ( !$new['override_occupation'] ) ? 'checked="checked"' : '';
$override_interests_yes = ( $new['override_interests'] ) ? 'checked="checked"' : '';
$override_interests_no = ( !$new['override_interests'] ) ? 'checked="checked"' : '';
$override_birthday_yes = ( $new['override_birthday'] ) ? 'checked="checked"' : '';
$override_birthday_no = ( !$new['override_birthday'] ) ? 'checked="checked"' : '';
$override_gender_yes = ( $new['override_gender'] ) ? 'checked="checked"' : '';
$override_gender_no = ( !$new['override_gender'] ) ? 'checked="checked"' : '';

/*
* Signature Editor
*/
$override_signature_yes = ( $new['override_signature'] ) ? 'checked="checked"' : '';
$override_signature_no = ( !$new['override_signature'] ) ? 'checked="checked"' : '';

/*
* Quick Post ES
*/
$override_quick_post_yes = ( $new['override_quick_post'] ) ? 'checked="checked"' : '';
$override_quick_post_no = ( !$new['override_quick_post'] ) ? 'checked="checked"' : '';

/*
* Preferences
*/
$override_public_view_mail_yes = ( $new['override_public_view_mail'] ) ? 'checked="checked"' : '';
$override_public_view_mail_no = ( !$new['override_public_view_mail'] ) ? 'checked="checked"' : '';
$override_hide_online_yes = ( $new['override_hide_online'] ) ? 'checked="checked"' : '';
$override_hide_online_no = ( !$new['override_hide_online'] ) ? 'checked="checked"' : '';
$override_notify_on_reply_yes = ( $new['override_notify_on_reply'] ) ? 'checked="checked"' : '';
$override_notify_on_reply_no = ( !$new['override_notify_on_reply'] ) ? 'checked="checked"' : '';
$override_notify_pm_yes = ( $new['override_notify_pm'] ) ? 'checked="checked"' : '';
$override_notify_pm_no = ( !$new['override_notify_pm'] ) ? 'checked="checked"' : '';
$override_popup_pm_yes = ( $new['override_popup_pm'] ) ? 'checked="checked"' : '';
$override_popup_pm_no = ( !$new['override_popup_pm'] ) ? 'checked="checked"' : '';
$override_notify_on_donation_yes = ( $new['override_notify_on_donation'] ) ? 'checked="checked"' : '';
$override_notify_on_donation_no = ( !$new['override_notify_on_donation'] ) ? 'checked="checked"' : '';
$override_always_add_signature_yes = ( $new['override_always_add_signature'] ) ? 'checked="checked"' : '';
$override_always_add_signature_no = ( !$new['override_always_add_signature'] ) ? 'checked="checked"' : '';
$override_bbcode_yes = ( $new['override_bbcode'] ) ? 'checked="checked"' : '';
$override_bbcode_no = ( !$new['override_bbcode'] ) ? 'checked="checked"' : '';
$override_html_yes = ( $new['override_html'] ) ? 'checked="checked"' : '';
$override_html_no = ( !$new['override_html'] ) ? 'checked="checked"' : '';
$override_smilies_yes = ( $new['override_smilies'] ) ? 'checked="checked"' : '';
$override_smilies_no = ( !$new['override_smilies'] ) ? 'checked="checked"' : '';
$override_language_yes = ( $new['override_language'] ) ? 'checked="checked"' : '';
$override_language_no = ( !$new['override_language'] ) ? 'checked="checked"' : '';
$override_board_style_yes = ( $new['override_board_style'] ) ? 'checked="checked"' : '';
$override_board_style_no = ( !$new['override_board_style'] ) ? 'checked="checked"' : '';
$override_time_mode_yes = ( $new['override_time_mode'] ) ? 'checked="checked"' : '';
$override_time_mode_no = ( !$new['override_time_mode'] ) ? 'checked="checked"' : '';
$override_date_format_yes = ( $new['override_date_format'] ) ? 'checked="checked"' : '';
$override_date_format_no = ( !$new['override_date_format'] ) ? 'checked="checked"' : '';

//-- mod : users set posts & topics count --------------------------------------
//-- add
$override_posts_per_page_yes = ( $new['override_posts_per_page'] ) ? 'checked="checked"' : '';
$override_posts_per_page_no = ( !$new['override_posts_per_page'] ) ? 'checked="checked"' : '';
$override_topics_per_page_yes = ( $new['override_topics_per_page'] ) ? 'checked="checked"' : '';
$override_topics_per_page_no = ( !$new['override_topics_per_page'] ) ? 'checked="checked"' : '';
//-- fin mod : users set posts & topics count ----------------------------------

$template->set_filenames(array('body' => 'admin/hide_entries_config_body.tpl'));

$template->assign_vars(array(
	'S_CONFIG_ACTION' => append_sid('admin_hide_entries.'.$phpEx),

	'L_YES' => $lang['Yes'],
	'L_NO' => $lang['No'],
	'L_HIDE_ENTRIES_CONFIGURATION_TITLE' => $lang['Hide_Entries_Config'],
	'L_HIDE_ENTRIES_CONFIGURATION_EXPLAIN' => $lang['Hide_Entries_explain'],
	'L_ACCOUNT_INFORMATIONS' => $lang['Account_Informations'],
	'L_SUBMIT' => $lang['Submit'], 
	'L_RESET' => $lang['Reset'],

	'L_ALLOW_NAME_CHANGE' => $lang['Allow_name_change'],

//-- mod : disallow mail and password changes ----------------------------------
//-- add
	'L_ALLOW_MAIL_CHANGE' => $lang['Allow_mail_change'],
	'L_ALLOW_PASSWORD_CHANGE' => $lang['Allow_password_change'],
//-- fin mod : disallow mail and password changes ------------------------------

//-- mod : account self-delete -------------------------------------------------
//-- add
	'L_ACCOUNT_DELETE' => $lang['account_delete'],
//-- fin mod : account self-delete ---------------------------------------------

	'AVATARS_LOCAL_YES' => $avatars_local_yes,
	'AVATARS_LOCAL_NO' => $avatars_local_no,
	'AVATARS_REMOTE_YES' => $avatars_remote_yes,
	'AVATARS_REMOTE_NO' => $avatars_remote_no,
	'AVATARS_UPLOAD_YES' => $avatars_upload_yes,
	'AVATARS_UPLOAD_NO' => $avatars_upload_no,

//-- mod : configure member profile required fields ----------------------------
//-- add
  'L_USER_FIELD_REQUIRED' => $lang['user_field_required'],
	'REQUIRED_ICQ_YES' => $user_icq_yes,
	'REQUIRED_ICQ_NO' => $user_icq_no,
	'REQUIRED_WEBSITE_YES' => $user_website_yes, 
	'REQUIRED_WEBSITE_NO' => $user_website_no, 
	'REQUIRED_LOCATION_YES' => $user_from_yes,
	'REQUIRED_LOCATION_NO' => $user_from_no,
	'REQUIRED_AIM_YES' => $user_aim_yes,
	'REQUIRED_AIM_NO' => $user_aim_no,
	'REQUIRED_YAHOO_YES' => $user_yim_yes,
	'REQUIRED_YAHOO_NO' => $user_yim_no, 
	'REQUIRED_MSN_YES' => $user_msnm_yes,
	'REQUIRED_MSN_NO' => $user_msnm_no,

//-- mod : skype ---------------------------------------------------------------
//-- add
	'REQUIRED_SKYPE_YES' => $user_skype_yes,
	'REQUIRED_SKYPE_NO' => $user_skype_no,
//-- fin mod : skype -----------------------------------------------------------

	'REQUIRED_OCCUPATION_YES' => $user_occ_yes,
	'REQUIRED_OCCUPATION_NO' => $user_occ_no,
	'REQUIRED_INTERESTS_YES' => $user_interests_yes,
	'REQUIRED_INTERESTS_NO' => $user_interests_no,
	'REQUIRED_SIGNATURE_YES' => $user_signature_yes,
	'REQUIRED_SIGNATURE_NO' => $user_signature_no,

//-- mod : users set posts & topics count --------------------------------------
//-- add
	'REQUIRED_POSTS_PER_PAGE_YES' => $user_posts_per_page_yes,
	'REQUIRED_POSTS_PER_PAGE_NO' => $user_posts_per_page_no,
	'REQUIRED_TOPICS_PER_PAGE_YES' => $user_topics_per_page_yes,
	'REQUIRED_TOPICS_PER_PAGE_NO' => $user_topics_per_page_no,
//-- fin mod : users set posts & topics count ----------------------------------
//-- fin mod : configure member profile required fields ------------------------

//-- mod : gender --------------------------------------------------------------
//-- add
	'L_GENDER_REQUIRED' => $lang['Gender_required'],
	'GENDER_REQUIRED_YES' => $gender_required_yes,
	'GENDER_REQUIRED_NO' => $gender_required_no,
//-- fin mod : gender ----------------------------------------------------------

//-- mod : birthday ------------------------------------------------------------
//-- add
	'L_BDAY_REQUIRED' => $lang['bday_required_explain'],
	'BDAY_REQUIRED_YES' => $bday_required_yes,
	'BDAY_REQUIRED_NO' => $bday_required_no,
//-- fin mod : birthday --------------------------------------------------------

	/*
	* Displaying
	*/
	'L_REGISTRATION_INFO' => $lang['Registration_info'],
	'L_PROFILE_INFO' => $lang['Profile_info'],
	'L_AVATAR_PANEL' => $lang['Avatar_panel'],
	'L_SIGNATURE' => $lang['Signature'],
	'L_QP_SETTINGS' => $lang['qp_settings'],
	'L_PREFERENCES' => $lang['Preferences'],

	/*
	* Profile options
	*/
	'L_OVERRIDE_ICQ' => $lang['override_user_icq'],
	'OVERRIDE_ICQ_YES' => $override_icq_yes,
	'OVERRIDE_ICQ_NO' => $override_icq_no,
	'L_OVERRIDE_AIM' => $lang['override_user_aim'],
	'OVERRIDE_AIM_YES' => $override_aim_yes,
	'OVERRIDE_AIM_NO' => $override_aim_no,
	'L_OVERRIDE_MSN' => $lang['override_user_msn'],
	'OVERRIDE_MSN_YES' => $override_msn_yes,
	'OVERRIDE_MSN_NO' => $override_msn_no,
	'L_OVERRIDE_SKYPE' => $lang['override_user_skype'],

//-- mod : skype ---------------------------------------------------------------
//-- add
	'OVERRIDE_SKYPE_YES' => $override_skype_yes,
	'OVERRIDE_SKYPE_NO' => $override_skype_no,
//-- fin mod : skype -----------------------------------------------------------

	'L_OVERRIDE_YAHOO' => $lang['override_user_yahoo'],
	'OVERRIDE_YAHOO_YES' => $override_yahoo_yes,
	'OVERRIDE_YAHOO_NO' => $override_yahoo_no,
	'L_OVERRIDE_WEBSITE' => $lang['override_user_website'],
	'OVERRIDE_WEBSITE_YES' => $override_website_yes,
	'OVERRIDE_WEBSITE_NO' => $override_website_no,
	'L_OVERRIDE_LOCATION' => $lang['override_user_location'],
	'OVERRIDE_LOCATION_YES' => $override_location_yes,
	'OVERRIDE_LOCATION_NO' => $override_location_no,
	'L_OVERRIDE_OCCUPATION' => $lang['override_user_occupation'],
	'OVERRIDE_OCCUPATION_YES' => $override_occupation_yes,
	'OVERRIDE_OCCUPATION_NO' => $override_occupation_no,
	'L_OVERRIDE_INTERESTS' => $lang['override_user_interests'],
	'OVERRIDE_INTERESTS_YES' => $override_interests_yes,
	'OVERRIDE_INTERESTS_NO' => $override_interests_no,
	'L_OVERRIDE_BIRTHDAY' => $lang['override_user_birthday'],
	'OVERRIDE_BIRTHDAY_YES' => $override_birthday_yes,
	'OVERRIDE_BIRTHDAY_NO' => $override_birthday_no,
	'L_OVERRIDE_GENDER' => $lang['override_user_gender'],
	'OVERRIDE_GENDER_YES' => $override_gender_yes,
	'OVERRIDE_GENDER_NO' => $override_gender_no,

	/*
	* Signature Editor
	*/
	'L_OVERRIDE_SIGNATURE' => $lang['override_user_signature'],
	'OVERRIDE_SIGNATURE_YES' => $override_signature_yes,
	'OVERRIDE_SIGNATURE_NO' => $override_signature_no,

	/*
	* Quick Post ES
	*/
	'L_OVERRIDE_QUICK_POST' => $lang['override_user_quick_post'],
	'OVERRIDE_QUICK_POST_YES' => $override_quick_post_yes,
	'OVERRIDE_QUICK_POST_NO' => $override_quick_post_no,

	/*
	* Preferences
	*/
	'L_OVERRIDE_PUBLIC_VIEW_MAIL' => $lang['override_user_public_view_mail'],
	'OVERRIDE_PUBLIC_VIEW_MAIL_YES' => $override_public_view_mail_yes,
	'OVERRIDE_PUBLIC_VIEW_MAIL_NO' => $override_public_view_mail_no,
	'L_OVERRIDE_HIDE_ONLINE' => $lang['override_user_hide_online'],
	'OVERRIDE_HIDE_ONLINE_YES' => $override_hide_online_yes,
	'OVERRIDE_HIDE_ONLINE_NO' => $override_hide_online_no,
	'L_OVERRIDE_NOTIFY_ON_REPLY' => $lang['override_user_notify_on_reply'],
	'OVERRIDE_NOTIFY_ON_REPLY_YES' => $override_notify_on_reply_yes,
	'OVERRIDE_NOTIFY_ON_REPLY_NO' => $override_notify_on_reply_no,
	'L_OVERRIDE_NOTIFY_PM' => $lang['override_user_notify_pm'],
	'OVERRIDE_NOTIFY_PM_YES' => $override_notify_pm_yes,
	'OVERRIDE_NOTIFY_PM_NO' => $override_notify_pm_no,
	'L_OVERRIDE_POPUP_PM' => $lang['override_user_popup_pm'],
	'OVERRIDE_POPUP_PM_YES' => $override_popup_pm_yes,
	'OVERRIDE_POPUP_PM_NO' => $override_popup_pm_no,
	'L_OVERRIDE_NOTIFY_ON_DONATION' => $lang['override_user_notify_on_donation'],
	'OVERRIDE_NOTIFY_ON_DONATION_YES' => $override_notify_on_donation_yes,
	'OVERRIDE_NOTIFY_ON_DONATION_NO' => $override_notify_on_donation_no,
	'L_OVERRIDE_ALWAYS_ADD_SIGNATURE' => $lang['override_user_always_add_signature'],
	'OVERRIDE_ALWAYS_ADD_SIGNATURE_YES' => $override_always_add_signature_yes,
	'OVERRIDE_ALWAYS_ADD_SIGNATURE_NO' => $override_always_add_signature_no,
	'L_OVERRIDE_BBCODE' => $lang['override_user_bbcode'],
	'OVERRIDE_BBCODE_YES' => $override_bbcode_yes,
	'OVERRIDE_BBCODE_NO' => $override_bbcode_no,
	'L_OVERRIDE_HTML' => $lang['override_user_html'],
	'OVERRIDE_HTML_YES' => $override_html_yes,
	'OVERRIDE_HTML_NO' => $override_html_no,
	'L_OVERRIDE_SMILIES' => $lang['override_user_smilies'],
	'OVERRIDE_SMILIES_YES' => $override_smilies_yes,
	'OVERRIDE_SMILIES_NO' => $override_smilies_no,
	'L_OVERRIDE_LANGUAGE' => $lang['override_user_language'],
	'OVERRIDE_LANGUAGE_YES' => $override_language_yes,
	'OVERRIDE_LANGUAGE_NO' => $override_language_no,
	'L_OVERRIDE_BOARD_STYLE' => $lang['override_user_board_style'],
	'OVERRIDE_BOARD_STYLE_YES' => $override_board_style_yes,
	'OVERRIDE_BOARD_STYLE_NO' => $override_board_style_no,
	'L_OVERRIDE_TIME_MODE' => $lang['override_user_time_mode'],
	'OVERRIDE_TIME_MODE_YES' => $override_time_mode_yes,
	'OVERRIDE_TIME_MODE_NO' => $override_time_mode_no,
	'L_OVERRIDE_DATE_FORMAT' => $lang['override_user_date_format'],
	'OVERRIDE_DATE_FORMAT_YES' => $override_date_format_yes,
	'OVERRIDE_DATE_FORMAT_NO' => $override_date_format_no,

//-- mod : users set posts & topics count --------------------------------------
//-- add
	'L_OVERRIDE_POSTS_PER_PAGE' => $lang['override_user_posts_per_page'],
	'OVERRIDE_POSTS_PER_PAGE_YES' => $override_posts_per_page_yes,
	'OVERRIDE_POSTS_PER_PAGE_NO' => $override_posts_per_page_no,
	'L_OVERRIDE_TOPICS_PER_PAGE' => $lang['override_user_topics_per_page'],
	'OVERRIDE_TOPICS_PER_PAGE_YES' => $override_topics_per_page_yes,
	'OVERRIDE_TOPICS_PER_PAGE_NO' => $override_topics_per_page_no,
//-- fin mod : users set posts & topics count ----------------------------------

));

$template->pparse('body');

include('./page_footer_admin.'.$phpEx);

?>
