<?php
/**
*
* @package The Logger
* @version $Id: lang_extend_the_logger.php,v 1.0.0 2007/04/07 eviL3 Exp $
* @copyright (c) 2006 eviL3 and Brainy
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if( !$lang )
{
	$lang = array();
}

/**
* Add some language entries for the logger
*/
$lang = array_merge($lang, array(
	// ------------- Global -------------
	'the_logger'	=> 'The Logger',

	'log_click_return_config'	=> 'Click %sHere%s to return to Logging Configuration',
	'log_click_return_view'		=> 'Click %sHere%s to return to Logs',

	'log_view_not_allowed'		=> 'You are not allowed to view the Logs.',
	'log_config_not_allowed'	=> 'You are not allowed to edit the Logging configuration.',
	'log_logs_deleted'			=> 'The logs have been removed successfully.<br /><br />Click %shere%s to return to the "View Logs" page.', // %s is the url to the view logs page

	'log_up_to_date'	=> '<span style="color:green;">Your installation of the logger is up-to-date.</span>',
	'log_not_up_to_date'	=> '<span style="color:red;">Your installation of the logger is not up-to-date.</span>',

	// ------------- Config -------------
	'log_config'			=> 'Logging Configuration',
	'log_config_explain'	=> 'Here you can Modify the settings for the Logger',

	// General / Global
	'log_gen_settings'	=> 'General Logging Settings',
	'log_user'	=> 'User Log',
	'log_mod'	=> 'Moderator Log',
	'log_admin'	=> 'Administrator Log',
	'log_error'	=> 'Error Log',
	'log_email_send'			=> 'Send email if unable to log',
	'log_msgdie_hide'			=> 'Hide errors from message_die',
	'log_msgdie_hide_explain'	=> 'Don\'t show errors for message die. Show a "Default" message instead.',
	'log_super_admins'			=> 'Super admins',
	'log_super_admins_explain'	=> 'Enter user IDs of super admins seperated by a comma. Super admins can view logs and change the config.',
	'log_admins_view'			=> 'Allow other admins to view logs',
	'log_admins_del'			=> 'Allow other admins to delete logs',
	'log_admins_config'			=> 'Allow other admins to change the configuration',

	// User
	'log_user_log_config'			=> 'User Logging Settings',
	'log_user_log_config_explain'	=> 'These Settings change what User Actions are logged.  If User Logging is disabled up above, they have no effect.',
	'log_user_prune'		=> 'Prune User Logs',
	'log_user_newtopic'		=> 'Log New Topics by Users',
	'log_user_edit'			=> 'Log Editing by Users',
	'log_user_delete'		=> 'Log Post Deletion by Users',
	'log_user_login'		=> 'Log Login by Users',
	'log_user_logout'		=> 'Log Logout by Users',
	'log_user_fail_login'	=> 'Log Failed Login by Users',
	'log_user_profile'		=> 'Log Profile Edit by Users',
	'log_user_register'		=> 'Log new registrations',

	// Moderator
	'log_mod_mog_config'			=> 'Moderator Logging Settings',
	'log_mod_mog_config_explain'	=> 'These Settings change what Moderator Actions are logged.  If Moderator Logging is disabled up above, they have no effect.',
	'log_mod_prune'		=> 'Prune Moderator Logs',
	'log_mod_edit'		=> 'Log Moderator Edits',
	'log_mod_delete'	=> 'Log Moderator Post / Topic Deletion',
	'log_mod_move'		=> 'Log Topic Moving',
	'log_mod_lock'		=> 'Log Topic Locking',
	'log_mod_unlock'	=> 'Log Topic Unlocking',
	'log_mod_split'		=> 'Log Topic Splitting',

	// Admin
	'log_admin_log_config'			=> 'Admin Logging Settings',
	'log_admin_log_config_explain'	=> 'These Settings change what Admin Actions are logged.  If Admin Logging is disabled up above, they have no effect.',
	'log_admin_prune'			=> 'Prune Admin Logs',
	'log_admin_config'			=> 'Log Configuration changes',
	'log_admin_email'			=> 'Log Mass Email',
	'log_admin_forum_creation'	=> 'Log Forum Creation',
	'log_admin_forum_deletion'	=> 'Log Forum Deletion',
	'log_admin_forum_edit'		=> 'Log Forum Changes',
	'log_admin_ban'				=> 'Log User Ban',
	'log_admin_user_manage'		=> 'Log User Manage',

	// Error
	'log_error_log_config'	=> 'Error Logging Settings',
	'log_error_log_explain'	=> 'These Settings change which Errors are logged.  If Error Logging is disabled up above, they have no effect.',
	'log_error_prune'		=> 'Prune Error Logs',
	'log_error_general'				=> 'Log General Errors',
	'log_error_critical'			=> 'Log Critical Errors',
	'log_error_critical_explain'	=> 'This may fail, since critical errors occur when database information is not availible.',

	// Other
	'log_other_settings'		=> 'Other Settings / Information',
	'log_view_per_page'			=> 'Log entries per page',
	'log_view_per_page_explain'	=> 'Number of log entries when viewing logs',
	'log_prune_days'			=> 'Prune Days',
	'log_prune_days_explain'	=> 'The number of days before log entries are pruned. Entering 0 will disable pruning.',
	'log_mod_version_check'			=> 'Allow Logger Version Check',
	'log_mod_version_check_explain'	=> 'No personal data will be sent',
	'log_mod_version'			=> 'Version of the Logger',

	// ------------- View Logs -------------
	'log_view'			=> 'View logs',
	'log_view_explain'	=> 'You can view the logs on this page. In the dropdown menu you can select an other log type.',

	// Log types (categories)
	'log_type_user'		=> 'User log',
	'log_type_mod'		=> 'Moderator log',
	'log_type_admin'	=> 'Admin log',
	'log_type_error'	=> 'Error log',

	// Log entry types
	'LOG_U_NEWTOPIC'		=> 'New topic "%1$s" created in %2$s',	// %1$s = Topic title, %2$s = forum
	'LOG_U_EDIT'			=> 'Post in Topic "%2$s" edited %1$s',	// %1$s = post link, %2$s = Topic title
	'LOG_U_DELETE'			=> 'Post in Topic "%1$s" deleted',		// %2$s = Topic title

	'LOG_U_LOGIN'			=> 'User logged in (Admin = %1$s)',		// %1$s = (bool) admin?
	'LOG_U_LOGOUT'			=> 'User logged out',
	'LOG_U_LOGIN_FAILED'	=> 'Login failed',

	'LOG_U_PROFILE'			=> 'User edited profile',
	'LOG_U_REGISTER'		=> 'User %1$s (%2$s) registered',

	'LOG_M_EDIT'			=> 'Post in Topic "%2$s" edited (Moderator edit) %1$s',	// %1$s = post link, %2$s = Topic title
	'LOG_M_DELETE'			=> 'Post in Topic "%1$s" deleted',						// %1$s = Topic title
	'LOG_M_DELETE_TOPIC'	=> 'Topic "%1$s" deleted',								// %1$s = post title
	'LOG_M_MOVE'			=> 'Topic "%2$s" moved to %1$s',						// %1$s = forum, %2$s = Topic title
	'LOG_M_LOCK'			=> 'Topic "%1$s" locked',								// %1$s = Topic title
	'LOG_M_UNLOCK'			=> 'Topic "%1$s" unlocked',								// %1$s = Topic title
	'LOG_M_SPLIT'			=> 'Topic "%1$s" split',								// %1$s = Topic title

	'LOG_A_UPDATE_LOG_CONFIG'	=> 'Updated logging configuration',
	'LOG_A_UPDATE_BOARD_CONFIG'	=> 'Updated board configuration',
	'LOG_A_MASS_EMAIL'			=> 'Sent mass email',
	'LOG_A_CREATE_FORUM'		=> 'Created forum "%1$s"',	// %1$s = forum name
	'LOG_A_DELETE_FORUM'		=> 'Deleted forum "%1$s"',	// %1$s = forum name
	'LOG_A_EDIT_FORUM'			=> 'Forum "%1$s" changed to "%2$s"',	// %1$s = Old forum name, %2$s = New forum name
	'LOG_A_USER_BAN'			=> 'User "%1$s" banned',	// %1$s = username, %2$s = user id
	'LOG_A_IP_BAN'				=> 'IP "%1$s" banned',		// %1$s = ip adress
	'LOG_A_EMAIL_BAN'			=> 'Email "%1$s" banned',	// %1$s = email adress
	'LOG_A_USER_UNBAN'			=> 'User "%1$s" unbanned',	// %1$s = username, %2$s = user id
	'LOG_A_IP_UNBAN'			=> 'IP "%1$s" unbanned',	// %1$s = ip adress
	'LOG_A_EMAIL_UNBAN'			=> 'Email "%1$s" unbanned',	// %1$s = email adress
	'LOG_A_USER_MANAGE'			=> 'User "%1$s" managed',	// %1$s = username, %2$s = user id

	'LOG_E_LOGGING_CONFIG_ERROR'	=> 'Failed to update logging configuration',

	'LOG_E_GENERAL'		=> '<b><u>General Error:</u></b><br /><br />%s',
	'LOG_E_CRITICAL'	=> '<b><u>Critical Error:</u></b><br /><br />%s',

	// Other
	'Log_no_logs'	=> 'There aren\'t any logs.',
	'log_confirm_deleteall'	=> 'Are you sure you want to remove all logs from this type?',

	// ------------- Errors -------------
	'log_error_delete'	=> 'There was an error when deleting logs.',

	// ------------- Main ---------------
	'Log_failed_log_title'	=> 'Failed to log error at %s',
	'Log_failed_get_f_name'	=> 'No Forum Name could be obtained',
	'Log_failed_get_u_name'	=> 'No username could be obtained',

	'Logging'	=> 'Logging',
	'Log_view'	=> 'View logs',

	'log_msgdie_default'	=> 'An error has occured on this Board. The administrator has been notified.',

//-- mod : the logger - proxy detection ----------------------------------------
//-- add
	'log_real_ip'	=> 'Real IP address',
//-- fin mod : the logger - proxy detection ------------------------------------
));

?>
