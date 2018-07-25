<?php 
/***************************************************************************
 *					cell.php
 *				------------------------
 *	begin 		: 29/12/2003
 *	copyright		: Malicious Rabbit / Dr DLP
 *
 *
 ***************************************************************************/

define('IN_PHPBB', true); 
define('CELL', true); 

$phpbb_root_path = './'; 
include($phpbb_root_path . 'extension.inc'); 
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
$userdata = session_pagestart($user_ip, PAGE_INDEX); 
init_userprefs($userdata); 
// End session management
//

$template->set_filenames(array(
	'body' => 'cell_body.tpl')
);

include_once($phpbb_root_path . 'includes/page_header.'.$phpEx);
include_once($phpbb_root_path . 'includes/functions_jail.'.$phpEx);

$user_id = $userdata['user_id'];
$caution = $userdata['user_cell_caution'];
$pay = isset($HTTP_POST_VARS['submit']);

// Update the time sentence
cell_update_users();

if( $pay )
{
	$sql = 'UPDATE ' . JAIL_USERS_TABLE . '
		SET user_freed_by = ' . $user_id . '
		WHERE user_id = ' . $user_id ;
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, '', __LINE__, __FILE__, $sql);
	}
	$sql = 'DELETE FROM ' . JAIL_VOTES_TABLE . ' 
		WHERE vote_id = ' . $user_id ;
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, '', __LINE__, __FILE__, $sql);
	}

	$sql = 'UPDATE ' . USERS_TABLE . " 
		SET user_points = user_points - $caution,
		user_cell_time = 0,
		user_cell_time_judgement = 0,
		user_cell_enable_caution = 0,
		user_cell_enable_free = 0,
		user_cell_sentence = '',
		user_cell_caution = 0
		WHERE user_id = $user_id";
	if ( !($result = $db->sql_query($sql)) )
	{
			message_die(GENERAL_ERROR, '', __LINE__, __FILE__, $sql);
	}

	message_die(GENERAL_MESSAGE, $lang['Cell_free']);
}

if ( ( $userdata['user_points'] >= $caution ) && $caution != 0 )
{
	$template->assign_block_vars('is_rich', array());
}

$punishment[1] = $lang['Cell_time_explain'];
$punishment[2] = $lang['Cell_time_explain_posts'];
$punishment[3] = $lang['Cell_time_explain_read'];

$template->assign_vars(array(
	'DAY'                 => $days,
	'HOUR'                => $hours,
	'MINUTE'              => $minutes,
	'CAUTION'             => $caution . ' &nbsp; ' . $board_config['points_name'],
	'L_CELL'		      => $lang['Cell_title'],
	'L_CELL_EXPLAIN'	  => $lang['Cell_explain'],
	'L_CELL_TIME'         => $lang['Cell_time'],
	'L_CELL_TIME_EXPLAIN' => $punishment[$userdata['user_cell_punishment']],
	'L_CELLED_TIME'       => cell_create_time($userdata['user_cell_time']),
	'L_CAUTION'           => $lang['Cell_caution'],
	'L_SENTENCE'          => $userdata['user_cell_sentence'],
	'L_CAUTION_PAY'       => $lang['Cell_caution_pay'],
	'S_CELL_ACTION'       => append_sid('cell.'.$phpEx),
	
));

$template->pparse('body');
include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
 
?> 