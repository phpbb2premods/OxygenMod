<?php
/**
*
* @version $Id: lang_extend_bot_indexing.php,v 1.0.0 2007/01/08 ABDev Exp $
* @copyright (c) 2007 ABDev, EzCom
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

/**
* admin part
*/
if ( $lang_extend_admin )
{
	$lang['Manage_Bots'] = 'Bots management';
	$lang['Bot_Explain'] = 'Here you can add, edit or delete search engines bot-crawlers definitions.';
	$lang['Pending_Bots'] = 'Pending Bots';
	$lang['Pending_Explain'] = '';

	// editor
	$lang['Bots_add'] = 'Add a new bot';
	$lang['Bots_add_explain'] = 'Here you are adding a new bot definition.';
	$lang['Bots_edit'] = 'Edit a bot';
	$lang['Bots_edit_explain'] = 'Here you can edit the bots signature and name.';
	$lang['Bot_Name'] = 'Bot name';
	$lang['Bot_Name_Explain'] = 'Enter a short name to identify this bot.';
	$lang['Bot_Agent'] = 'Bot agent';
	$lang['Bot_Agent_Explain'] = 'Partial matches are allowed. Seperate agents with a single '|'.';
	$lang['Bot_Ip'] = 'Bot IPs';
	$lang['Bot_Ip_Explain'] = 'Partial matches are allowed. Seperate IP addresses with a single '|'.';
	$lang['Bot_Style'] = 'Style';
	$lang['Bot_Style_Explain'] = 'Style that th bot sees when it\'svisiting your website.';

	// buttons
	$lang['Submit'] = 'Submit';
	$lang['Reset'] = 'Reset';

	// list
	$lang['Pages'] = 'Pages';
	$lang['Visits'] = 'Visits';
	$lang['Last_Visit'] = 'Last visit';
		$lang['Never'] = 'Never';
	$lang['Options'] = 'Options';
		$lang['Edit'] = 'Edit';
		$lang['Delete'] = 'Delete';
	$lang['Mark'] = 'Mark';
	$lang['Create'] = 'Create';

	// empty entries
	$lang['No_Bots'] = 'There are currently no search engines bot-crawlers definitions. Please press "Create" to create a new one.';
	$lang['No_Pending_Bots'] = 'There are currently no waiting search engines bot-crawlers.';

	// confirmation window
	$lang['Added_bot'] = 'Bot added.';
	$lang['Ignored_bot'] = 'Bot deleted.';
	$lang['Modified_bot'] = 'Bot modified.';
	$lang['Ok'] = 'Ok';

	// errors
	$lang['Error_No_Agent_Or_Ip'] = 'Agent or IP address unvalid.';
	$lang['Error_No_Bot_Name'] = 'Bot name not informed.';
	$lang['Error_Bot_Name_Taken'] = 'That bot name is already used.';
	$lang['Error_Own_Ip'] = 'You can\'t use your own IP adresse as bot IP address.<br />Using it will prevent you to access to the administration control panel.';
}

?>
