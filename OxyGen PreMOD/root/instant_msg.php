<?php
/**
*
* @version $Id: instant_msg.php,v 1.4 14/03/2007 00:27 PastisD Exp $
* @copyright (c) 2006 PastisD - http://www.oxygen-powered.net/
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

define('IN_PHPBB', true);
$phpbb_root_path = './';

require_once($phpbb_root_path . 'extension.inc');
require_once($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//

$template->set_filenames(array('body' => 'instant_msg.tpl'));

$expiry_time = time() - $board_config['session_length'];

$sql = 'SELECT * FROM ' . INSTANTMSG_TABLE . '
	WHERE id_dest= ' . $userdata['user_id'] . '
		AND date_msg >= ' . $expiry_time;
if(!$result = $db->sql_query($sql))
{
	message_die(GENERAL_ERROR, 'Could not query immediate messages table');
}

if ($row = $db->sql_fetchrow($result))
{
	$id_instant_msg = $row['id_msg'];
	$template -> assign_block_vars('swich_instant_msg',array());
}

$template->assign_vars(array(
	'U_INSTANTMSG_POPUP' => append_sid('instant_msg_view.' . $phpEx . '?read=' . $id_instant_msg),
	'U_INSTANTMSG' => append_sid('instant_msg.'.$phpEx),
	'INSTANT_MSG_AUTO_REFRESH' => $board_config['instant_msg_refresh_time'],
));

$template->pparse('body');

?>
