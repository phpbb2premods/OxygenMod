<?php
/**
*
* @version $Id: shoutbox_send.php,v 1.0.5 11/02/2006 23:16 PastisD Exp $
* @copyright (c) 2006 PastisD
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
* Original author : Malach, http://www.phantasia-fr.com, 2006
*
*/

define('IN_PHPBB', true);
$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);

include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/functions_post.'.$phpEx);

$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);

$hide_txt = '<a href="' . append_sid('shoutbox_send.'.$phpEx) . '?mode=hide">' . $lang['sb_hide'] . '</a>';

if ( isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']) )
{
	$mode = ( isset($HTTP_GET_VARS['mode']) ) ? $HTTP_GET_VARS['mode'] : $HTTP_POST_VARS['mode'];
}

if ( $mode == 'hide' )
{
	@setcookie('shoutbox',off , (time()+3600*9000), $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
	$hide_txt = $lang['sb_hide_done'];
}

$template->set_filenames(array('body' => 'shoutbox_send_body.tpl'));

generate_smilies('inline', PAGE_INDEX);

$template->assign_vars(array(
	'S_CONTENT_ENCODING' => $lang['ENCODING'],
	'L_SEND' => $lang['Submit'],
	'L_GG_MES' => $lang['gg_mes'],
	'NICK' => $userdata['username'],
	'U_MORE_SMILIES' => append_sid('posting.'.$phpEx . '?mode=smilies'),
	'MAXLENGHT' => $board_config['shoutbox_text_lenght'],
	'SB_USER_ID' => $userdata['user_id'],
	'SB_HIDE' => $hide_txt,
	'GO' => $images['icon_go'],
//-- mod : rank color system ---------------------------------------------------
//-- add
	'T_TEMPLATE_NAME' => $theme['template_name'],
//-- fin mod : rank color system -----------------------------------------------
	'REFRESH' => $images['icon_refresh'],
	'SMILIES' => $images['icon_smilies'],
	'SHOUTBOX_ACTION' => append_sid('shoutbox_view.'.$phpEx),
	'T_HEAD_STYLESHEET' => $theme['head_stylesheet']
));

$template->pparse('body');

?>
