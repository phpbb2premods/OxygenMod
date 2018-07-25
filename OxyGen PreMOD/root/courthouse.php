<?php 
/***************************************************************************
 *					courthouse.php
 *				------------------------
 *	begin 			: 22/01/2004
 *	copyright			: Malicious Rabbit / Dr DLP
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *
 ***************************************************************************/

define('IN_PHPBB', true); 
$phpbb_root_path = './'; 
include($phpbb_root_path . 'extension.inc'); 
include($phpbb_root_path . 'common.'.$phpEx);

$userdata = session_pagestart($user_ip, PAGE_INDEX); 
init_userprefs($userdata);

//-- mod : access limitation ---------------------------------------------------
//-- add
if( $board_config['cell_access'] == ADMIN && $userdata['user_level'] != ADMIN )
{
	message_die(GENERAL_MESSAGE, $lang['Not_Authorised']);
}
else if ( $board_config['cell_access'] == MOD && ( $userdata['user_level'] != MOD && $userdata['user_level'] != ADMIN ) )
{
	message_die(GENERAL_MESSAGE, $lang['Not_Authorised']);
}
else if( $board_config['cell_access'] == USER && !$userdata['session_logged_in'] )
{
	message_die(GENERAL_MESSAGE, $lang['Not_Authorised']);
}
//-- fin mod : access limitation -----------------------------------------------

$user_id = $userdata['user_id'];

if ( !$userdata['session_logged_in'] )
{
	$redirect = "courthouse.$phpEx";
	$redirect .= ( isset($user_id) ) ? '&user_id=' . $user_id : '';
	header('Location: ' . append_sid("login.$phpEx?redirect=$redirect", true));
}

$template->set_filenames(array('body' => 'cell_courthouse_list_body.tpl'));
$page_title = $lang['Cell_courthouse'];
include_once($phpbb_root_path . 'includes/page_header.'.$phpEx);
include_once($phpbb_root_path . 'includes/functions_jail.'.$phpEx);

// Update the time sentence
cell_update_users();

$punishment[1] = $lang['Cell_punishment_global'];
$punishment[2] = $lang['Cell_punishment_posts'];
$punishment[3] = $lang['Cell_punishment_read'];

$start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;
$celled_list = $HTTP_POST_VARS['celled_list'];
$caution = $HTTP_POST_VARS['caution_pay'];
$guilty = $HTTP_POST_VARS['guilty'];
$innocent = $HTTP_POST_VARS['innocent'];
$blank = $HTTP_POST_VARS['blank'];
$celled_id = intval($HTTP_POST_VARS['celled_id']);
$celled_user_id = intval($HTTP_GET_VARS['celled_user_id']);

if ( isset($HTTP_GET_VARS['from']) || isset($HTTP_POST_VARS['from']) )
{
	$from = ( isset($HTTP_POST_VARS['from']) ) ? htmlspecialchars($HTTP_POST_VARS['from']) : htmlspecialchars($HTTP_GET_VARS['from']);
}
else
{
	$from = 'list';
}

if ( $celled_user_id )
{
	$from = 'judgement_page';
}
elseif ($celled_list)
{
	$from = 'celleds_list';
}
else if ($caution)
{
	$from = 'caution_pay';
}
else if ($guilty) 
{ 
	$vote = 0; 
	$from = 'judgement'; 
} 
else if ($innocent) 
{ 
	$vote = 1; 
	$from = 'judgement'; 
}
else if ($blank)
{
	$from = 'blank';
}

switch( $from )
{
	case 'blank' :

		if ( $userdata['user_points'] < $board_config['cell_amount_user_blank'] )
		{
			message_die(GENERAL_MESSAGE, $lang['Cell_lack_money']);
		}

		$ssql = "SELECT celled_id FROM " . JAIL_USERS_TABLE . "
			ORDER BY celled_id
			DESC LIMIT 1 ";
		if (!$db->sql_query($ssql))
		{
			message_die(GENERAL_ERROR, "Could not update user's jail infos", '', __LINE__, __FILE__, $ssql);
		}
		$total = $db->sql_fetchrow($sresult);
		$cell_id = $total['celled_id'];

		$imprisonned = 0;
		$more_sql = '';

		if ( $userdata['user_cell_time'] > 0 )
		{
			$more_sql = 'AND celled_id <> ".$cell_id." ';
			$imprisonned = 1;
		}

		$sql = "DELETE FROM " . JAIL_USERS_TABLE . " 
			WHERE user_id = $user_id
			$more_sql ";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR,"", __LINE__, __FILE__, $sql);
		}

		$sql = "UPDATE ".USERS_TABLE."
			SET user_points = user_points - ".$board_config['cell_amount_user_blank']." ,
		  	    user_cell_celleds = $imprisonned
			WHERE user_id = $user_id ";
		if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not update user points', '', __LINE__, __FILE__, $sql);
		}

		$message = $lang['Cell_blank_done'].'<br /><br />'.sprintf($lang['Cell_return'],"<a href=\"" . append_sid("courthouse.$phpEx") . "\">", "</a>") ;
		message_die(GENERAL_MESSAGE, $message );

		break;

	case 'caution_pay' :

		$sledge_price = intval($HTTP_POST_VARS['sledge_price']);

		if ( $userdata['user_points'] < $sledge_price )
		{
			message_die(GENERAL_MESSAGE, $lang['Cell_lack_money']);
		}

		$sql = "UPDATE ".USERS_TABLE."
			SET user_points = user_points - $sledge_price 
			WHERE user_id = $user_id ";
		if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not update user points', '', __LINE__, __FILE__, $sql);
		}

		cell_free_user( $celled_id , $user_id );

		$message = $lang['Cell_sledge_paid'].'<br /><br />'.sprintf($lang['Cell_return'],"<a href=\"" . append_sid("courthouse.$phpEx") . "\">", "</a>") ;
		message_die(GENERAL_MESSAGE, $message );
			
		break;

	case 'celleds_list' :

		$template->set_filenames(array('body' => 'cell_courthouse_list_body.tpl'));

		if ( isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']) )
		{
			$mode = ( isset($HTTP_POST_VARS['mode']) ) ? htmlspecialchars($HTTP_POST_VARS['mode']) : htmlspecialchars($HTTP_GET_VARS['mode']);
		}
		else
		{
			$mode = 'username';
		}

		if(isset($HTTP_POST_VARS['order']))
		{
			$sort_order = ($HTTP_POST_VARS['order'] == 'ASC') ? 'ASC' : 'DESC';
		}
		else if(isset($HTTP_GET_VARS['order']))
		{
			$sort_order = ($HTTP_GET_VARS['order'] == 'ASC') ? 'ASC' : 'DESC';
		}
		else
		{
			$sort_order = 'ASC';
		}

		$mode_types_text = array( $lang['Sort_Username'],$lang['Cell_freed_type'] ,$lang['Cell_celled_time'],$lang['Cell_celled_date'],$lang['Cell_admin_celled_caution'],$lang['Cell_imprisonments']);
		$mode_types = array('username', 'freed','cell_time', 'cell_date','caution','cell_times');

		$select_sort_mode = '<select name="mode">';
		for($i = 0; $i < count($mode_types_text); $i++)
		{
			$selected = ( $mode == $mode_types[$i] ) ? ' selected="selected"' : '';
			$select_sort_mode .= '<option value="' . $mode_types[$i] . '"' . $selected . '>' . $mode_types_text[$i] . '</option>';
		}
		$select_sort_mode .= '</select>';

		$select_sort_order = '<select name="order">';
		if($sort_order == 'ASC')
		{
			$select_sort_order .= '<option value="ASC" selected="selected">' . $lang['Sort_Ascending'] . '</option><option value="DESC">' . $lang['Sort_Descending'] . '</option>';
		}
		else
		{
			$select_sort_order .= '<option value="ASC">' . $lang['Sort_Ascending'] . '</option><option value="DESC" selected="selected">' . $lang['Sort_Descending'] . '</option>';
		}	
		$select_sort_order .= '</select>';

		switch( $mode )
		{
			case 'username':
				$order_by = "u.username $sort_order LIMIT $start, " . $board_config['topics_per_page'];
				break;
			case 'freed':
				$order_by = "j.user_freed_by $sort_order LIMIT $start, " . $board_config['topics_per_page'];
				break;
			case 'cell_time':
				$order_by = "j.user_time $sort_order LIMIT $start, " . $board_config['topics_per_page'];
				break;
			case 'cell_date':
				$order_by = "j.user_cell_date $sort_order LIMIT $start, " . $board_config['topics_per_page'];
				break;
			case 'caution':
				$order_by = "j.user_caution $sort_order LIMIT $start, " . $board_config['topics_per_page'];
				break;
			case 'cell_times':
				$order_by = "u.user_cell_celleds $sort_order LIMIT $start, " . $board_config['topics_per_page'];
				break;
			default:
				$order_by = "u.username $sort_order LIMIT $start, " . $board_config['topics_per_page'];
				break;
		}

		$sql = "SELECT * FROM " . JAIL_USERS_TABLE . " j , " . USERS_TABLE . " u
			WHERE u.user_id = j.user_id
			ORDER BY $order_by";
		if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not query users', '', __LINE__, __FILE__, $sql);
		}

		if ( $row = $db->sql_fetchrow($result) )
		{
			$i = 0;
			do
			{
				if ( $i == '0' ) 
				{ 
					$template->assign_block_vars('cell_user', array()); 
				}

//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
				$username = $row['username'];
MOD-*/
//-- add
				$style_color = $rcs->get_colors($row);
				$username = '<a href="' . append_sid('profile.' . $phpEx . '?mode=viewprofile&amp;' . POST_USERS_URL . '=' . $row['user_id']) . '" alt="' . $lang['Read_profile'] . '" title="' . $lang['Read_profile'] . '" ' . $style_color . '>' . $row['username'] . '</a>';
//-- fin mod : rank color system -----------------------------------------------

				$user_id = $row['user_id'];
				$profile_img = '<img src="' . $images['icon_profile'] . '" alt="' . $lang['Read_profile'] . '" title="' . $lang['Read_profile'] . '" border="0" />';

				if ( $row['user_freed_by'] =='1' )
				{
					$freed_by = $lang['Cell_freed_type_time'];
				}
				else if ( $row['user_freed_by'] =='2' )
				{
					$freed_by = $lang['Cell_freed_type_admin'];
				}
				else if ( $row['user_freed_by'] =='0' )
				{
					$freed_by = $lang['Cell_freed_type_still'];
				}
				else
				{
					$nsql = "SELECT username , user_id FROM " . USERS_TABLE . "
						WHERE user_id = " . $row['user_freed_by'] . " ";
					if( !($nresult = $db->sql_query($nsql)) )
					{
						message_die(GENERAL_ERROR, 'Could not query users', '', __LINE__, __FILE__, $nsql);
					}
					$nrow = $db->sql_fetchrow($nresult);
					$freed_by = $nrow['username'];
				}

				$celled_times = $row['user_cell_celleds'];
				$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
				$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

				$template->assign_block_vars('cell_user.cell_users', array(
					'ROW_CLASS' => $row_class,
					'USERNAME' => $username ,
					'TIME' => cell_create_time($row['user_time']),
					'DATE' => create_date($board_config['default_dateformat'], $row['user_cell_date'], $board_config['board_timezone']),
					'SLEDGE' => $row['user_caution'],
					'FREED_BY' => $freed_by, 
					'CELLED_TIMES' => $celled_times,
					'U_VIEWPROFILE' => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$user_id"))
				);

				$i++;
			}
			while ( $row = $db->sql_fetchrow($result) );
		}
		else
		{
			$template->assign_block_vars('cell_no_users', array());
		}

		$sql = "SELECT count(*) AS total FROM " . JAIL_USERS_TABLE ;
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Error getting total users', '', __LINE__, __FILE__, $sql);
		}

		if ( $total = $db->sql_fetchrow($result) )
		{
			$total_members = $total['total'];
			$pagination = generate_pagination("courthouse.$phpEx?from=celleds_list&amp;mode=$mode&amp;order=$sort_order", $total_members, $board_config['topics_per_page'], $start). '&nbsp;';
		}
		if ( $userdata['user_cell_celleds'] && $board_config['cell_allow_user_blank'] )
		{
			$template->assign_block_vars('user_blank', array());	
			$blank_text = sprintf($lang['Cell_blank_text'],$board_config['cell_amount_user_blank'].'&nbsp;'.$board_config['points_name']);
		}	

		$template->assign_vars(array(
			'PAGINATION' => $pagination,
			'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $total_members / $board_config['topics_per_page'] )), 
			'L_GOTO_PAGE' => $lang['Goto_page'],
			'L_SELECT_SORT_METHOD' => $lang['Select_sort_method'],
			'L_IMPRISONNED_LIST'   => $lang['Cell_celled_list_history'],
			'L_BLANK' => $lang['Cell_blank_explain'],
			'L_BLANK_EXPLAIN' => $blank_text,
			'S_MODE_SELECT' => $select_sort_mode,
			'S_ORDER_SELECT' => $select_sort_order,
		));

		break;

	case 'judgement' :

		$sql = "INSERT INTO " . JAIL_VOTES_TABLE . "
			( vote_id , voter_id , vote_result )
			VALUES ( ".$celled_id." , ".$user_id." , ".$vote." )";
		if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not update user points', '', __LINE__, __FILE__, $sql);
		}

		$sql = "SELECT count(*) AS total_votes FROM " . JAIL_VOTES_TABLE . "
			WHERE vote_id = ".$celled_id;
		if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not update user points', '', __LINE__, __FILE__, $sql);
		}
		$row = $db->sql_fetchrow($result);
		$total = $row['total_votes'];

		$votes = 0;
		if ( $total >= $board_config['cell_user_judge_voters'] )
		{
			$sql = "SELECT * FROM " . JAIL_VOTES_TABLE . "
			WHERE vote_id = $celled_id ";
			if( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not update user points', '', __LINE__, __FILE__, $sql);
			}
			$row = $db->sql_fetchrowset($result);
			for ( $i = 0 ; $i < count($row) ; $i ++)
			{
				$votes = $votes + $row[$i]['vote_result'];
			}
			$medium = floor ( $board_config['cell_user_judge_voters'] / 2 );

			if ( $votes > $medium )
			{
				cell_free_user( $celled_id , 2 );
			}	
			else 
			{
				$sql = "UPDATE " . USERS_TABLE . " 
				SET user_cell_enable_free = 2
				WHERE user_id = $celled_id ";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR,"", __LINE__, __FILE__, $sql);
				}

				$sql = "DELETE FROM " . JAIL_VOTES_TABLE . " 
				WHERE vote_id = $celled_id ";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR,"", __LINE__, __FILE__, $sql);
				}
			}
		}

		$message = $lang['Cell_judgement_done'].'<br /><br />'.sprintf($lang['Cell_return'],"<a href=\"" . append_sid("courthouse.$phpEx") . "\">", "</a>") ;
		message_die(GENERAL_MESSAGE, $message );

	break;

	case 'judgement_page' :

		$template->set_filenames(array('body' => 'cell_courthouse_judge_body.tpl'));

		$sql = "SELECT * FROM " . USERS_TABLE . "
			WHERE user_id = $celled_user_id
			AND user_cell_time > 0 ";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR,"", __LINE__, __FILE__, $sql);
		}
		$celled_data = $db->sql_fetchrow($result);
		$celled_id = $celled_data['user_id'];

		$can_vote = FALSE;

		$sql = "SELECT vote_result FROM " . JAIL_VOTES_TABLE . "
			WHERE voter_id = $user_id
			AND vote_id = $celled_id ";
		if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain vote results', '', __LINE__, __FILE__, $sql);
		}
		$row = $db->sql_fetchrow($result);

		if ( !(is_numeric($row['vote_result'])))
		{
			$can_vote = TRUE;
		}

		if ( $celled_data['user_cell_enable_caution'] && $board_config['cell_allow_user_caution'] )
		{
			$template->assign_block_vars('caution_authed',array());
		}
		else if ( !$celled_data['user_cell_enable_caution'] && $board_config['cell_allow_user_caution'] )
		{
			$template->assign_block_vars('caution_not_authed',array());
		}
		if ( $celled_data['user_cell_enable_free'] && $board_config['cell_allow_user_judge'] &&  ( $board_config['cell_user_judge_posts'] < $userdata['user_posts'] ) && $can_vote )
		{
			$template->assign_block_vars('judge_authed',array());
		}
		else if (  $board_config['cell_allow_user_judge'] && ( !$celled_data['user_cell_enable_free'] || ($board_config['cell_user_judge_posts'] > $userdata['user_posts'] )))
		{
			$template->assign_block_vars('judge_not_authed',array());
		}
		else if (  $board_config['cell_allow_user_judge'] && ( $celled_data['user_cell_enable_free'] =='2' ))
		{
			$template->assign_block_vars('judge_authed_ever',array());
		}
		else
		{
			$template->assign_block_vars('judge_ever',array());
		}

		$template->assign_vars(array(
//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
			'NAME' => $celled_data['username'],
MOD-*/
//-- add
			'NAME' => '<a href="' . append_sid('profile.' . $phpEx . '?mode=viewprofile&amp;' . POST_USERS_URL . '=' . $celled_user_id) . '" alt="' . $lang['Read_profile'] . '" title="' . $lang['Read_profile'] . '">' . $rcs->get_colors($celled_data, $celled_data['username']) . '</a>',
//-- fin mod : rank color system -----------------------------------------------
			'CAUTION' => $celled_data['user_cell_caution'],
			'SENTENCE' => $celled_data['user_cell_sentence'],
			'TIME' => cell_create_time($celled_data['user_cell_time']),
			'CELLEDS' => $celled_data['user_cell_celleds'],
			'PUNISHMENT' => $punishment[$celled_data['user_cell_punishment']],
			'CELLED_ID' => $celled_id,
			'L_PAY_CAUTION' => $lang['Cell_judgement_pay_sledge'],
			'L_SENTENCE' => $lang['Cell_sentence'],
			'L_JUDGEMENT' => $lang['Cell_judgement'],
		));

		break;

	case 'list' :

		$template->set_filenames(array('body' => 'cell_courthouse_body.tpl'));

		if ( isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']) )
		{
			$mode = ( isset($HTTP_POST_VARS['mode']) ) ? htmlspecialchars($HTTP_POST_VARS['mode']) : htmlspecialchars($HTTP_GET_VARS['mode']);
		}
		else
		{
			$mode = 'username';
		}

		if(isset($HTTP_POST_VARS['order']))
		{
			$sort_order = ($HTTP_POST_VARS['order'] == 'ASC') ? 'ASC' : 'DESC';
		}
		else if(isset($HTTP_GET_VARS['order']))
		{
			$sort_order = ($HTTP_GET_VARS['order'] == 'ASC') ? 'ASC' : 'DESC';
		}
		else
		{
			$sort_order = 'ASC';
		}

		$mode_types_text = array( $lang['Sort_Username'],$lang['Cell_celled_time'] ,$lang['Cell_admin_celled_caution']);
		$mode_types = array('username', 'cell_time', 'caution');

		$select_sort_mode = '<select name="mode">';
		for($i = 0; $i < count($mode_types_text); $i++)
		{
			$selected = ( $mode == $mode_types[$i] ) ? ' selected="selected"' : '';
			$select_sort_mode .= '<option value="' . $mode_types[$i] . '"' . $selected . '>' . $mode_types_text[$i] . '</option>';
		}
		$select_sort_mode .= '</select>';

		$select_sort_order = '<select name="order">';
		if($sort_order == 'ASC')
		{
			$select_sort_order .= '<option value="ASC" selected="selected">' . $lang['Sort_Ascending'] . '</option><option value="DESC">' . $lang['Sort_Descending'] . '</option>';
		}
		else
		{
			$select_sort_order .= '<option value="ASC">' . $lang['Sort_Ascending'] . '</option><option value="DESC" selected="selected">' . $lang['Sort_Descending'] . '</option>';
		}	
		$select_sort_order .= '</select>';

		switch( $mode )
		{
			case 'username':
				$order_by = "username $sort_order LIMIT $start, " . $board_config['topics_per_page'];
				break;
			case 'cell_time':
				$order_by = "user_cell_time $sort_order LIMIT $start, " . $board_config['topics_per_page'];
				break;
			case 'caution':
				$order_by = "user_cell_caution $sort_order LIMIT $start, " . $board_config['topics_per_page'];
				break;
			default:
				$order_by = "username $sort_order LIMIT $start, " . $board_config['topics_per_page'];
				break;
		}

		$sql = "SELECT * FROM " . USERS_TABLE . "
			WHERE user_cell_time > 0
			ORDER BY $order_by";
		if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not query users', '', __LINE__, __FILE__, $sql);
		}

		if ( $row = $db->sql_fetchrow($result) )
		{
			$i = 0;
			do
			{
				if ( $i == '0' ) 
				{ 
					$template->assign_block_vars('cell_user', array()); 
				}

//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
				$username = $row['username'];
MOD-*/
//-- add
				$style_color = $rcs->get_colors($row);
				$username = '<a href="' . append_sid('profile.' . $phpEx . '?mode=viewprofile&amp;' . POST_USERS_URL . '=' . $row['user_id']) . '" alt="' . $lang['Read_profile'] . '" title="' . $lang['Read_profile'] . '" ' . $style_color . '>' . $row['username'] . '</a>';
//-- fin mod : rank color system -----------------------------------------------

				$cuser_id = $row['user_id'];
				$profile_img = '<img src="' . $images['icon_profile'] . '" alt="' . $lang['Read_profile'] . '" title="' . $lang['Read_profile'] . '" border="0" />';
				$judgement_img = '<img src="' . $images['icon_justice'] . '" alt="' . $lang['Cell_judge_user'] . '" title="' . $lang['Cell_judge_user'] . '" border="0" />';

				$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
				$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

				$template->assign_block_vars('cell_user.cell_users', array(
					'ROW_CLASS' => $row_class,
					'CELLED_ID' => $cuser_id,
					'USERNAME' => $username ,
					'TIME' => cell_create_time($row['user_cell_time']),
					'SLEDGE' => $row['user_cell_caution'], 
					'JUDGEMENT_IMG' => $judgement_img,
					'PUNISHMENT' => $punishment[$row['user_cell_punishment']],
					'U_JUDGEMENT' => append_sid("courthouse.$phpEx?celled_user_id=$cuser_id"),
					'U_VIEWPROFILE' => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$cuser_id"))
				);

				$i++;
			}
			while ( $row = $db->sql_fetchrow($result) );
		}
		else
		{
			$template->assign_block_vars('cell_no_users', array());
		}

		$sql = "SELECT count(*) AS total FROM " . USERS_TABLE ."
		WHERE user_cell_time > 0 ";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Error getting total users', '', __LINE__, __FILE__, $sql);
		}

		if ( $total = $db->sql_fetchrow($result) )
		{
			$total_members = $total['total'];
			$pagination = generate_pagination("courthouse.$phpEx?from=list&amp;mode=$mode&amp;order=$sort_order", $total_members, $board_config['topics_per_page'], $start). '&nbsp;';
		}

		$template->assign_vars(array(
			'L_SELECT_SORT_METHOD' => $lang['Select_sort_method'],
			'S_MODE_SELECT' => $select_sort_mode,
			'S_ORDER_SELECT' => $select_sort_order,
			'PAGINATION' => $pagination,
			'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $total_members / $board_config['topics_per_page'] )), 
			'L_GOTO_PAGE' => $lang['Goto_page'],
		));

		break;
}

$template->assign_vars(array(
	'POINTS'                 => $userdata['user_points'],
	'L_NO_CELLED'            => $lang['Cell_judgement_none'],
	'L_CAUTION_NOT_AUTHED'   => $lang['Cell_caution_not_authed'],
	'L_JUDGE_NOT_AUTHED'     => $lang['Cell_judgement_not_authed'],
	'L_JUDGE_EVER'           => $lang['Cell_judgement_ever'],
	'L_JUDGEMENT_EXPLAIN'    => $lang['Cell_judgement_explain'],
	'L_JUDGEMENT_NO'         => $lang['Cell_judgement_guilty'],
	'L_JUDGEMENT_YES'        => $lang['Cell_judgement_innocent'],
	'L_JUDGE_AUTHED_EVER'    => $lang['Cell_judgement_ever_authed'],
	'L_NEVER_CELLED'         => $lang['Cell_judgement_never'],
	'L_CELLED_TIMES'         => $lang['Cell_imprisonments'],
	'L_SUBMIT'               => $lang['Submit'],
	'L_PUNISHMENT'           => $lang['Cell_punishment'],
	'L_POINTS'               => $board_config['points_name'],
	'L_SLEDGE'							=> $lang['Cell_admin_celled_caution'],
	'L_IMPRISONED_TIME' 	 => $lang['Cell_celled_time'],
	'L_IMPRISONED_DATE' 	 => $lang['Cell_celled_date'],
	'L_FREED_BY'             => $lang['Cell_freed_type'],
	'L_JUDGEMENT'            => $lang['Cell_judgement'],
	'L_COURTHOUSE'           => $lang['Cell_courthouse'],
	'L_CELLED_LIST'          => $lang['Cell_celled_list'],
	'S_COURTHOUSE_ACTION'    => append_sid("courthouse.$phpEx"),
));

$template->pparse('body');
include($phpbb_root_path . 'includes/page_tail.'.$phpEx);


 
?>
