<?php
/** 
*
* @package quick_post_es_mod [english]
* @version $Id: lang_extend_qpes.php,v 1.0 10/06/2006 16:21 reddog Exp $
* @copyright (c) 2006 reddog - http://www.reddevboard.com/
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

// admin part
if ($lang_extend_admin)
{
	$lang['qp_config_title'] = 'Quick Post ES Configuration';
	$lang['qp_config_title_desc'] = 'Here you can manage the options from Quick Post ES MOD.';
	$lang['qp_config_updated'] = 'The Quick Post ES configuration has been updated.';
	$lang['qp_click_return_config'] = 'Click %sHere%s to return to the Quick Post ES configuration.';
	$lang['qp_user'] = 'members:';
	$lang['qp_anon'] = 'anonymous:';
}

// main
$lang['qp_quick_post'] = 'Quick Reply';
$lang['qp_settings'] = 'Quick Reply Settings';

// display
$lang['qp_quote_selected'] = 'Quote selected';
$lang['qp_quote_empty'] = 'No text selected';
$lang['qp_options'] = 'More options';
$lang['bbcode_e_help'] = 'List: add a list element';

// fields
$lang['qp_enable'] = 'Enable Quick Reply';
$lang['qp_enable_explain'] = 'enable/disable quick reply form on the phpBB Board';
$lang['qp_show'] = 'Show Quick Reply';
$lang['qp_show_explain'] = 'Show quick reply form by default';
$lang['qp_subject'] = 'Enable subject field';
$lang['qp_subject_explain'] = 'enable/disable the subject field in quick reply form';
$lang['qp_bbcode'] = 'Enable bbcode';
$lang['qp_bbcode_explain'] = 'enable/disable bbcode in quick reply form';
$lang['qp_smilies'] = 'Enable smilies';
$lang['qp_smilies_explain'] = 'enable/disable smilies in quick reply form';
$lang['qp_more'] = 'Enable more options';
$lang['qp_more_explain'] = 'enable/disable the additional options in quick reply form';

?>