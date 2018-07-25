<?php
/***************************************************************************
 *                             admin_forums.php
 *                            -------------------
 *   begin                : Thursday, Jul 12, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: admin_forums.php,v 1.40.2.13 2006/03/09 21:55:09 grahamje Exp $
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['Forums']['Manage'] = $file;
	return;
}

//
// Load default header
//
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
include($phpbb_root_path . 'includes/functions_admin.'.$phpEx);

//-- mod : simple subtemplates -------------------------------------------------
//-- add
include($phpbb_root_path . 'includes/functions_selects.'.$phpEx);
//-- fin mod : simple subtemplates ---------------------------------------------

$forum_auth_ary = array(
	'auth_view' => AUTH_ALL, 
	'auth_read' => AUTH_ALL, 
	'auth_post' => AUTH_REG, 
	'auth_reply' => AUTH_REG, 
	'auth_edit' => AUTH_REG, 
	'auth_delete' => AUTH_REG, 
	'auth_sticky' => AUTH_MOD, 
	'auth_announce' => AUTH_MOD, 
	'auth_vote' => AUTH_REG,
	'auth_pollcreate' => AUTH_REG
);

//-- mod : bump topic ----------------------------------------------------------
//-- add
$forum_auth_ary['auth_bump'] = AUTH_REG;
//-- fin mod : bump topic ------------------------------------------------------

//-- mod : annonce globale -----------------------------------------------------
//-- add
$forum_auth_ary['auth_global_announce'] = AUTH_ADMIN;
//-- fin mod : annonce globale -------------------------------------------------

//-- mod : attachment mod ------------------------------------------------------
//-- add
$forum_auth_ary['auth_attachments'] = AUTH_REG;
$forum_auth_ary['auth_download'] = AUTH_REG;
//-- fin mod : attachment mod --------------------------------------------------

//
// Mode setting
//
if( isset($HTTP_POST_VARS['mode']) || isset($HTTP_GET_VARS['mode']) )
{
	$mode = ( isset($HTTP_POST_VARS['mode']) ) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
	$mode = htmlspecialchars($mode);
}
else
{
	$mode = '';
}

// ------------------
// Begin function block
//
function get_info($mode, $id)
{
	global $db;

	switch($mode)
	{
		case 'category':
			$table = CATEGORIES_TABLE;
			$idfield = 'cat_id';
			$namefield = 'cat_title';
			break;

		case 'forum':
			$table = FORUMS_TABLE;
			$idfield = 'forum_id';
			$namefield = 'forum_name';
			break;

		default:
			message_die(GENERAL_ERROR, 'Wrong mode for generating select list', '', __LINE__, __FILE__);
			break;
	}
	$sql = 'SELECT count(*) as total FROM ' . $table;
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Couldnot get Forum/Category information', '', __LINE__, __FILE__, $sql);
	}
	$count = $db->sql_fetchrow($result);
	$count = $count['total'];
	$db->sql_freeresult($result);

	$sql = 'SELECT *
		FROM ' . $table . '
		WHERE ' . $idfield . ' = ' . $id; 
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Couldnot get Forum/Category information', '', __LINE__, __FILE__, $sql);
	}

	if( $db->sql_numrows($result) != 1 )
	{
		message_die(GENERAL_ERROR, 'Forum/Category does not exist or multiple forums/categories with ID '.$id, '', __LINE__, __FILE__);
	}

	$return = $db->sql_fetchrow($result);
	$return['number'] = $count;
	$db->sql_freeresult($result);
	return $return;
}

function get_list($mode, $id, $select)
{
	global $db;

	switch($mode)
	{
		case 'category':
			$table = CATEGORIES_TABLE;
			$idfield = 'cat_id';
			$namefield = 'cat_title';
			break;

		case 'forum':
			$table = FORUMS_TABLE;
			$idfield = 'forum_id';
			$namefield = 'forum_name';
			break;

		default:
			message_die(GENERAL_ERROR, 'Wrong mode for generating select list', '', __LINE__, __FILE__);
			break;
	}

	$sql = 'SELECT * FROM ' . $table;
	if( $select == 0 )
	{
		$sql .= ' WHERE ' . $idfield . ' <> ' . $id;
	}

	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Couldnot get list of Categories/Forums', '', __LINE__, __FILE__, $sql);
	}

	$cat_list = '';

	while( $row = $db->sql_fetchrow($result) )
	{
		$s = '';
		if ($row[$idfield] == $id)
		{
			$s = " selected=\"selected\"";
		}
		$catlist .= "<option value=\"$row[$idfield]\"$s>" . $row[$namefield] . "</option>\n";
	}

	return($catlist);
}

//-- mod : simple subforums ----------------------------------------------------
//-- add
function get_list_cat($id, $parent, $forum_id)
{
	global $db;

	$sql = 'SELECT * FROM ' . CATEGORIES_TABLE . ' ORDER BY cat_order ASC';
	
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not get list of categories', '', __LINE__, __FILE__, $sql);
	}
	
	$cat_list = array();
	
	while( $row = $db->sql_fetchrow($result) )
	{
		$cat_list[] = $row;
	}

	$db->sql_freeresult($result);

	$has_sub = false;
	$sql = 'SELECT forum_id, cat_id, forum_name, forum_parent
		FROM ' . FORUMS_TABLE . ' ORDER BY forum_order ASC';
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not get list of forums', '', __LINE__, __FILE__, $sql);
	}
	
	$forums_list = array();
	
	while( $row = $db->sql_fetchrow($result) )
	{
		if( $row['forum_parent'] > 0 && $row['forum_parent'] == $forum_id )
		{
			$has_sub = true;
		}
		
		if( !$row['forum_parent'] )
		{
			$forums_list[] = $row;
		}
	}
	$db->sql_freeresult($result);

	for( $i = 0; $i < count($cat_list); $i++ )
	{
		$cat_id = $cat_list[$i]['cat_id'];
		$selected = ( $id == $cat_id && $parent == 0 ) ? ' selected="selected"' : '';
		$str .= '<option value="' . $cat_id . '"' . $selected . '>' . $cat_list[$i]['cat_title'] . '</option>';
		
		if( !$has_sub )
		{
			for( $j = 0; $j < count($forums_list); $j++)
			{
				if( $forums_list[$j]['cat_id'] == $cat_id && $forums_list[$j]['forum_id'] != $forum_id )
				{
					$forum_id2 = $forums_list[$j]['forum_id'];
					$selected = ( $id == $cat_id && $parent == $forum_id2 ) ? ' selected="selected"' : '';
					$str .= '<option value="' . $cat_id . ',' . $forum_id2 . '"' . $selected . '>- ' . $forums_list[$j]['forum_name'] . '</option>';
				}
			}
		}
	}
	return $str;
}
//-- fin mod : simple subforums ------------------------------------------------

function renumber_order($mode, $cat = 0)
{
	global $db;

	switch($mode)
	{
		case 'category':
			$table = CATEGORIES_TABLE;
			$idfield = 'cat_id';
			$orderfield = 'cat_order';
			$cat = 0;
			break;

		case 'forum':
			$table = FORUMS_TABLE;
			$idfield = 'forum_id';
			$orderfield = 'forum_order';
			$catfield = 'cat_id';
			break;

		default:
			message_die(GENERAL_ERROR, 'Wrong mode for generating select list', '', __LINE__, __FILE__);
			break;
	}

	$sql = 'SELECT * FROM ' . $table;
	if( $cat != 0)
	{
		$sql .= ' WHERE ' . $catfield . ' = ' . $cat;
	}
	$sql .= ' ORDER BY ' . $orderfield . ' ASC';


	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Couldnot get list of Categories', '', __LINE__, __FILE__, $sql);
	}

	$i = 10;
	$inc = 10;

	while( $row = $db->sql_fetchrow($result) )
	{
		$sql = 'UPDATE ' . $table . '
			SET ' . $orderfield . ' = ' . $i . '
			WHERE ' . $idfield . ' = ' . $row[$idfield];
		if( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update order fields', '', __LINE__, __FILE__, $sql);
		}
		$i += 10;
	}
}
//
// End function block
// ------------------

//
// Begin program proper
//
if( isset($HTTP_POST_VARS['addforum']) || isset($HTTP_POST_VARS['addcategory']) )
{
	$mode = ( isset($HTTP_POST_VARS['addforum']) ) ? 'addforum' : 'addcat';

	if( $mode == 'addforum' )
	{
		list($cat_id) = each($HTTP_POST_VARS['addforum']);
		$cat_id = intval($cat_id);
		// 
		// stripslashes needs to be run on this because slashes are added when the forum name is posted
		//
		$forumname = stripslashes($HTTP_POST_VARS['forumname'][$cat_id]);
	}
}

//-- mod : password protected forums -------------------------------------------
//-- add
if( !empty($HTTP_POST_VARS['password']) )
{
	if( !preg_match("#^[A-Za-z0-9]{3,20}$#si", $HTTP_POST_VARS['password']) )
	{
		message_die(GENERAL_MESSAGE, $lang['Only_alpha_num_chars']);
	}
}
//-- fin mod : password protected forums ---------------------------------------

if( !empty($mode) ) 
{
	switch($mode)
	{
		case 'addforum':
		case 'editforum':
			//
			// Show form to create/modify a forum
			//

//-- mod : forum icon with acp control -----------------------------------------
//-- add
			$dir = @opendir($phpbb_root_path . $board_config['forum_icon_path']);
			$count = 0;
			while( $file = @readdir($dir) )
			{
				if( !@is_dir(phpbb_realpath($phpbb_root_path . $board_config['forum_icon_path'] . '/' . $file)) )
				{
					if( preg_match('/(\.gif$|\.png$|\.jpg|\.jpeg)$/is', $file) )
					{
						$forum_icons[$count] = $file; 
						$count++;
					}
				}
			}

			@closedir($dir);

			if ($mode == 'addforum')
			{
				$forum_icons_list = '';
				$forum_icons_list .= '<option value="' . $forum_icons[0] . '" selected="selected">' . $forum_icons[0] . '</option>'; 

				for( $i = 1; $i < count($forum_icons); $i++ )
				{
					$forum_icons_list .= '<option value="' . $forum_icons[$i] . '">' . $forum_icons[$i] . '</option>';
					$default_ficon = $forum_icons[0];
				}
			}
//-- fin mod : forum icon with acp control -------------------------------------

			if ($mode == 'editforum')
			{
				// $newmode determines if we are going to INSERT or UPDATE after posting?

				$l_title = $lang['Edit_forum'];
				$newmode = 'modforum';
				$buttonvalue = $lang['Update'];

				$forum_id = intval($HTTP_GET_VARS[POST_FORUM_URL]);

				$row = get_info('forum', $forum_id);

				$cat_id = $row['cat_id'];
//-- mod : simple subforums ----------------------------------------------------
//-- add
				$parent_id = $row['forum_parent'];
//-- fin mod : simple subforums ------------------------------------------------
				$forumname = $row['forum_name'];
				$forumdesc = $row['forum_desc'];
				$forumstatus = $row['forum_status'];
//-- mod : simple subtemplates -------------------------------------------------
//-- add
				$forum_template = style_select($row['forum_template'], 'forum_template', "../templates");
//-- fin mod : simple subtemplates ---------------------------------------------
//-- mod : topic display order -------------------------------------------------
//-- add
				$forum_display_sort = $row['forum_display_sort'];
				$forum_display_order = $row['forum_display_order'];
//-- fin mod : topic display order ---------------------------------------------
//-- mod : disable word censor for single forums -------------------------------
//-- add
				$disable_word_censor_yes = ($row['disable_word_censor']) ? 'checked="checked"' : '';
				$disable_word_censor_no = (!$row['disable_word_censor']) ? 'checked="checked"' : '';
//-- fin mod : disable word censor for single forums ---------------------------
//-- mod : password protected forums -------------------------------------------
//-- add
				$forum_password = $row['forum_password'];
//-- fin mod : password protected forums ---------------------------------------
//-- mod : colorize forum title ------------------------------------------------
//-- add
				$forum_color = $row['forum_color'];
//-- fin mod : colorize forum title --------------------------------------------
//-- mod : quick post es -------------------------------------------------------
//-- add
				$forum_qpes = $row['forum_qpes'];
//-- fin mod : quick post es ---------------------------------------------------
//-- mod : forum icon with acp control -----------------------------------------
//-- add
				$forumicon = $row['forum_icon'];
				$forum_icons_list = '';
				for( $i = 0; $i < count($forum_icons); $i++ )
				{
					$forum_icons_list .= ($forum_icons[$i] == $row['forum_icon']) ? '<option value="' . $forum_icons[$i] . '" selected="selected">' . $forum_icons[$i] . '</option>' : '<option value="' . $forum_icons[$i] . '">' . $forum_icons[$i] . '</option>';
					$default_ficon = $forum_icons[0];
				}
//-- fin mod : forum icon with acp control -------------------------------------
//-- mod : forumtitle as weblink -----------------------------------------------
//-- add
				$forum_is_link = $row['title_is_link'];
				$forum_weblink = $row['weblink'];
				$forum_link_target = $row['forum_link_target'];
//-- fin mod : forumtitle as weblink -------------------------------------------
//-- mod : forum as category ---------------------------------------------------
//-- add
				$forum_as_category = $row['forum_as_category'];
//-- fin mod : forum as category -----------------------------------------------

				//
				// start forum prune stuff.
				//
				if( $row['prune_enable'] )
				{
					$prune_enabled = 'checked="checked"';
					$sql = 'SELECT * FROM ' . PRUNE_TABLE . ' WHERE forum_id = ' . $forum_id;
					if(!$pr_result = $db->sql_query($sql))
					{
						message_die(GENERAL_ERROR, 'Auto-Prune: Couldnot read auto_prune table.', __LINE__, __FILE__);
					}

					$pr_row = $db->sql_fetchrow($pr_result);
				}
				else
				{
					$prune_enabled = '';
				}
				$db->sql_freeresult($result);
			}
			else
			{
				$l_title = $lang['Create_forum'];
				$newmode = 'createforum';
				$buttonvalue = $lang['Create_forum'];

				$forumdesc = '';
//-- mod : colorize forum title ------------------------------------------------
//-- add
				$forum_color = '';
//-- fin mod : colorize forum title --------------------------------------------
				$forumstatus = FORUM_UNLOCKED;
//-- mod : simple subtemplates -------------------------------------------------
//-- add
				$forum_template = style_select($row['forum_template'], 'forum_template', "../templates");
//-- fin mod : simple subtemplates ---------------------------------------------
//-- mod : topic display order -------------------------------------------------
//-- add
				$forum_display_sort = 0;
				$forum_display_order = 0;
//-- fin mod : topic display order ---------------------------------------------
//-- mod : password protected forums -------------------------------------------
//-- add
				$forum_password = '';
//-- fin mod : password protected forums ---------------------------------------
//-- mod : quick post es -------------------------------------------------------
//-- add
				$forum_qpes = 1;
//-- fin mod : quick post es ---------------------------------------------------
//-- mod : forum as category ---------------------------------------------------
//-- add
				$forum_as_category = '';
//-- fin mod : forum as category -----------------------------------------------
//-- mod : forum icon with acp control -----------------------------------------
//-- add
				$forumicon = '';
//-- fin mod : forum icon with acp control -------------------------------------
				$forum_id = ''; 
				$prune_enabled = '';
//-- mod : disable word censor for single forums -------------------------------
//-- add
				$disable_word_censor_yes = '';
				$disable_word_censor_no = 'checked="checked"';
//-- fin mod : disable word censor for single forums ---------------------------
//-- mod : simple subforums ----------------------------------------------------
//-- add
				$parent_id = 0;
//-- fin mod : simple subforums ------------------------------------------------
			}

//-- mod : simple subforums ----------------------------------------------------
//-- delete
/*-MOD
			$catlist = get_list('category', $cat_id, TRUE);
MOD-*/
//-- add
			$catlist = get_list_cat($cat_id, $parent_id, $forum_id);
//-- fin mod : simple subforums ------------------------------------------------

			$forumstatus == ( FORUM_LOCKED ) ? $forumlocked = 'selected="selected"' : $forumunlocked = 'selected="selected"';

//-- mod : colorize forum title ------------------------------------------------
//-- add
			$forum_color = empty($forum_color) ? '' : $forum_color;
//-- fin mod : colorize forum title --------------------------------------------

			// These two options ($lang['Status_unlocked'] and $lang['Status_locked']) seem to be missing from
			// the language files.
			$lang['Status_unlocked'] = isset($lang['Status_unlocked']) ? $lang['Status_unlocked'] : 'Unlocked';
			$lang['Status_locked'] = isset($lang['Status_locked']) ? $lang['Status_locked'] : 'Locked';
			
			$statuslist = '<option value="' . FORUM_UNLOCKED . '" ' . $forumunlocked . '>' . $lang['Status_unlocked'] . '</option>\n';
			$statuslist .= '<option value="' . FORUM_LOCKED . '" ' . $forumlocked . '>' . $lang['Status_locked'] . '</option>\n'; 

//-- mod : points system -------------------------------------------------------
//-- add
			if ($row['points_disabled'])
			{
				$yes = 'selected="selected"';
			}
			else
			{
				$no = 'selected="selected"';
			}
			$pointslist = '<option value="' . TRUE . '" ' . $yes . '>' . $lang['Yes'] . '</option>';
			$pointslist .= '<option value="' . FALSE . '" ' . $no . '>' . $lang['No'] . '</option>';
//-- fin mod : points system ---------------------------------------------------

			$template->set_filenames(array('body' => 'admin/forum_edit_body.tpl'));

//-- mod : topic display order -------------------------------------------------
//-- add
			$forum_display_sort_list = get_forum_display_sort_option($forum_display_sort, 'list', 'sort');
			$forum_display_order_list = get_forum_display_sort_option($forum_display_order, 'list', 'order');
//-- fin mod : topic display order ---------------------------------------------

			$s_hidden_fields = '<input type="hidden" name="mode" value="' . $newmode .'" /><input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '" />';

			$template->assign_vars(array(
				'S_FORUM_ACTION' => append_sid('admin_forums.'.$phpEx),
				'S_HIDDEN_FIELDS' => $s_hidden_fields,
				'S_SUBMIT_VALUE' => $buttonvalue, 
				'S_CAT_LIST' => $catlist,
				'S_STATUS_LIST' => $statuslist,
				'S_PRUNE_ENABLED' => $prune_enabled,

				'L_FORUM_TITLE' => $l_title, 
				'L_FORUM_EXPLAIN' => $lang['Forum_edit_delete_explain'], 
				'L_FORUM_SETTINGS' => $lang['Forum_settings'], 
				'L_FORUM_NAME' => $lang['Forum_name'], 

//-- mod : simple subforums ----------------------------------------------------
//-- delete
/*-MOD
				'L_CATEGORY' => $lang['Category'], 
MOD-*/
//-- add
				'L_CATEGORY' => $lang['Category'] . ' / ' . $lang['Forum'], 
//-- fin mod : simple subforums ------------------------------------------------

				'L_FORUM_DESCRIPTION' => $lang['Forum_desc'],
				'L_FORUM_STATUS' => $lang['Forum_status'],
				'L_AUTO_PRUNE' => $lang['Forum_pruning'],
				'L_ENABLED' => $lang['Enabled'],
				'L_PRUNE_DAYS' => $lang['prune_days'],
				'L_PRUNE_FREQ' => $lang['prune_freq'],
				'L_DAYS' => $lang['Days'],

				'PRUNE_DAYS' => isset($pr_row['prune_days']) ? $pr_row['prune_days'] : 7,
				'PRUNE_FREQ' => isset($pr_row['prune_freq']) ? $pr_row['prune_freq'] : 1,
				'FORUM_NAME' => $forumname,

//-- mod : simple subtemplates -------------------------------------------------
//-- add
				'L_SUBTEMPLATE' => $lang['Subtemplate'],
				'FORUM_TEMPLATE' => $forum_template,
//-- fin mod : simple subtemplates ---------------------------------------------

//-- mod : topic display order -------------------------------------------------
//-- add
				'L_FORUM_DISPLAY_SORT'			=> $lang['Sort_by'],
				'S_FORUM_DISPLAY_SORT_LIST'		=> $forum_display_sort_list,
				'S_FORUM_DISPLAY_ORDER_LIST'	=> $forum_display_order_list,
//-- fin mod : topic display order ---------------------------------------------

//-- mod : points system -------------------------------------------------------
//-- add
				'S_POINTS_LIST' => $pointslist,
				'L_POINTS_DISABLED' => sprintf($lang['Points_disabled'], $board_config['points_name']),
//-- fin mod : points system ---------------------------------------------------

//-- mod : quick post es -------------------------------------------------------
//-- add
				'L_YES' => $lang['Yes'],
				'L_NO' => $lang['No'],
				'L_QP_TITLE' => $lang['qp_quick_post'],
				'FORUM_QP_YES' => ($forum_qpes) ? 'checked="checked"' : '',
				'FORUM_QP_NO' => (!$forum_qpes) ? 'checked="checked"' : '',
//-- fin mod : quick post es ---------------------------------------------------

//-- mod : forum as category ---------------------------------------------------
//-- add
				'L_FORUM_AS_CATEGORY' => $lang['forum_as_category'],
				'FORUM_AS_CATEGORY_YES' => ($forum_as_category) ? 'checked="checked"' : '',
				'FORUM_AS_CATEGORY_NO' => (!$forum_as_category) ? 'checked="checked"' : '',
//-- fin mod : forum as category -----------------------------------------------

//-- mod : disable word censor for single forums -------------------------------
//-- add
				'L_DISABLE_WORD_CENSOR' => $lang['Disable_word_censor'],
				'DISABLE_WORD_CENSOR_YES' => $disable_word_censor_yes,
				'DISABLE_WORD_CENSOR_NO' => $disable_word_censor_no,
//-- fin mod : disable word censor for single forums ---------------------------

//-- mod : password protected forums -------------------------------------------
//-- add
				'L_PASSWORD' => $lang['Forum_password'],
				'FORUM_PASSWORD' => $forum_password,
//-- fin mod : password protected forums ---------------------------------------

//-- mod : colorize forum title ------------------------------------------------
//-- add
				'L_FORUM_COLOR' => $lang['Forum_color'],
				'L_FORUM_COLOR_EXPLAIN' => $lang['Forum_color_explain'],
				'FORUM_COLOR' => $forum_color,
//-- fin mod : colorize forum title --------------------------------------------

//-- mod : forumtitle as weblink -----------------------------------------------
//-- add
				'L_FORUM_IS_LINK' => $lang['Forum_is_link'],
				'L_FORUM_WEBLINK' => $lang['Forum_weblink'],
				'L_FORUM_LINK_TARGET' => $lang['Forum_link_target'],
				'FORUM_IS_LINK' => ($forum_is_link) ? 'checked="checked"' : '',
				'FORUM_WEBLINK' => $forum_weblink,
				'FORUM_LINK_TARGET' => ($forum_link_target) ? 'checked="checked"' : '',
//-- fin mod : forumtitle as weblink -------------------------------------------

//-- mod : forum icon with acp control -----------------------------------------
//-- add
				'L_FORUM_ICON' => $lang['Forum_icon'],
				'ICON_LIST' => $forum_icons_list,
				'ICON_BASEDIR' => $phpbb_root_path . $board_config['forum_icon_path'],
				'ICON_IMG' => ($forumicon) ? $phpbb_root_path . $board_config['forum_icon_path'] . '/' . $forumicon : $phpbb_root_path . $board_config['forum_icon_path'] . '/' . $default_ficon,
//-- fin mod : forum icon with acp control -------------------------------------
				'DESCRIPTION' => $forumdesc,
			));
			$template->pparse('body');
			break;

		case 'createforum':
			//
			// Create a forum in the DB
			//
			if( trim($HTTP_POST_VARS['forumname']) == '' )
			{
				message_die(GENERAL_ERROR, 'Canot create a forum without a name');
			}

			$sql = 'SELECT MAX(forum_order) AS max_order
				FROM ' . FORUMS_TABLE . '
				WHERE cat_id = ' . intval($HTTP_POST_VARS[POST_CAT_URL]);
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Couldnot get order number from forums table', '', __LINE__, __FILE__, $sql);
			}
			$row = $db->sql_fetchrow($result);

			$max_order = $row['max_order'];
			$next_order = $max_order + 10;

			$sql = 'SELECT MAX(forum_id) AS max_id FROM ' . FORUMS_TABLE;
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Couldnot get order number from forums table', '', __LINE__, __FILE__, $sql);
			}
			$row = $db->sql_fetchrow($result);

			$max_id = $row['max_id'];
			$next_id = $max_id + 1;

			//
			// Default permissions of public :: 
			//
			$field_sql = '';
			$value_sql = '';
			while( list($field, $value) = each($forum_auth_ary) )
			{
				$field_sql .= ', '.$field;
				$value_sql .= ', '.$value;
			}

//-- mod : topic display order -------------------------------------------------
//-- add
			$field_sql .= ', forum_display_sort';
			$value_sql .= ', ' . intval($HTTP_POST_VARS['forum_display_sort']);
			$field_sql .= ', forum_display_order';
			$value_sql .= ', ' . intval($HTTP_POST_VARS['forum_display_order']);
//-- fin mod : topic display order ---------------------------------------------

//-- mod : simple subforums ----------------------------------------------------
//-- add
			$list = explode(',', $HTTP_POST_VARS[POST_CAT_URL]);
			$new_cat = count($list) ? intval($list[0]) : intval($HTTP_POST_VARS[POST_CAT_URL]);
			$new_parent = isset($list[1]) ? intval($list[1]) : 0;
//-- fin mod : simple subforums ------------------------------------------------

//-- mod : forumtitle as weblink -----------------------------------------------
//-- add
			$forum_is_link = empty($forum_is_link) ? 0 : $forum_is_link;
			$forum_link_target = empty($forum_link_target) ? 0 : $forum_link_target;
//-- fin mod : forumtitle as weblink -------------------------------------------

			// There is no problem having duplicate forum names so we won't check for it.
//-- mod : simple subforums ----------------------------------------------------
//-- delete
/*-MOD
			$sql = "INSERT INTO " . FORUMS_TABLE . " (forum_id, forum_name, cat_id, forum_desc, forum_order, forum_status, prune_enable" . $field_sql . ")
				VALUES ('" . $next_id . "', '" . str_replace("\'", "''", $HTTP_POST_VARS['forumname']) . "', " . intval($HTTP_POST_VARS[POST_CAT_URL]) . ", '" . str_replace("\'", "''", $HTTP_POST_VARS['forumdesc']) . "', $next_order, " . intval($HTTP_POST_VARS['forumstatus']) . ", " . intval($HTTP_POST_VARS['prune_enable']) . $value_sql . ")";
MOD-*/
//-- add
			$sql = "INSERT INTO " . FORUMS_TABLE . " (forum_id, forum_name, cat_id, forum_parent, forum_desc, forum_order, forum_status, prune_enable" . $field_sql . ")
				VALUES ('" . $next_id . "', '" . str_replace("\'", "''", $HTTP_POST_VARS['forumname']) . "', " . $new_cat . ', ' . $new_parent . ", '" . str_replace("\'", "''", $HTTP_POST_VARS['forumdesc']) . "', $next_order, " . intval($HTTP_POST_VARS['forumstatus']) . ", " . intval($HTTP_POST_VARS['prune_enable']) . $value_sql . ")";
//-- fin mod : simple subforums ------------------------------------------------

//-- mod : oxygen premod -------------------------------------------------------
//-- add
			$sql = str_replace(', forum_name', ', forum_name, title_is_link, weblink, forum_link_target, forum_icon, forum_qpes, forum_color, forum_password, disable_word_censor, points_disabled, forum_as_category, forum_template', $sql);
			$sql = str_replace(', \'' . str_replace("\'", "''", $HTTP_POST_VARS['forumname']) . '\'', ', \'' . str_replace("\'", "''", $HTTP_POST_VARS['forumname']) . '\', ' . intval($HTTP_POST_VARS['forum_is_link']) . ', \'' . str_replace("\'", "''", $HTTP_POST_VARS['weblink']) . '\', ' . intval($HTTP_POST_VARS['forum_link_target']) . ', \'' . str_replace("\'", "''", $HTTP_POST_VARS['forumicon']) . '\', ' . intval($HTTP_POST_VARS['forum_qpes']) . ', \'' . str_replace("\'", "''", $HTTP_POST_VARS['forum_color']) . '\', \'' . str_replace("\'", "''", $HTTP_POST_VARS['password']) . '\', ' . intval($HTTP_POST_VARS['disable_word_censor']) . ', ' .  intval($HTTP_POST_VARS['points_disabled']) . ', ' .  intval($HTTP_POST_VARS['forum_as_category']) . ', ' . intval($HTTP_POST_VARS['forum_template']) . '', $sql);
//-- fin mod : oxygen premod ---------------------------------------------------

			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not insert row in forums table', '', __LINE__, __FILE__, $sql);
			}

//-- mod : the logger ----------------------------------------------------------
//-- add
			if( defined( 'LOG_MOD_INSTALLED' ) )
			{
				if( $log->config['log_admin_forum_creation'] )
				{
					$log->insert( LOG_TYPE_ADMIN, 'LOG_A_CREATE_FORUM', array($HTTP_POST_VARS['forumname']) );
				}
			}
//-- fin mod : the logger ------------------------------------------------------

			if( $HTTP_POST_VARS['prune_enable'] )
			{

				if( $HTTP_POST_VARS['prune_days'] == '' || $HTTP_POST_VARS['prune_freq'] == '')
				{
					message_die(GENERAL_MESSAGE, $lang['Set_prune_data']);
				}

				$sql = 'INSERT INTO ' . PRUNE_TABLE . ' (forum_id, prune_days, prune_freq)
					VALUES(\'' . $next_id . '\', ' . intval($HTTP_POST_VARS['prune_days']) . ', ' . intval($HTTP_POST_VARS['prune_freq']) . ')';
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Couldnot insert row in prune table', '', __LINE__, __FILE__, $sql);
				}
			}

			$message = $lang['Forums_updated'] . '<br /><br />' . sprintf($lang['Click_return_forumadmin'], '<a href="' . append_sid('admin_forums.'.$phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid('index.'.$phpEx . '?pane=right') . '">', '</a>');

			message_die(GENERAL_MESSAGE, $message);

			break;

		case 'modforum':
//-- mod : the logger ----------------------------------------------------------
//-- add
			if( defined( 'LOG_MOD_INSTALLED' ) )
			{
				$forum_name = $log->convert_forum_id( (int) $HTTP_POST_VARS[POST_FORUM_URL] );
			}
//-- fin mod : the logger ------------------------------------------------------

//-- mod : simple subforums ----------------------------------------------------
//-- add
			$forum_id = intval($HTTP_POST_VARS[POST_FORUM_URL]);
			$row = get_info('forum', $forum_id);
			$list = explode(',', $HTTP_POST_VARS[POST_CAT_URL]);
			$new_cat = count($list) ? intval($list[0]) : intval($HTTP_POST_VARS[POST_CAT_URL]);
			$new_parent = isset($list[1]) ? intval($list[1]) : 0;
			
			if( !$row['forum_parent'] && $row['cat_id'] !== $new_cat )
			{
				$sql = 'UPDATE ' . FORUMS_TABLE . " SET cat_id='$new_cat' WHERE forum_parent='$forum_id'";
				$db->sql_query($sql);
			}
//-- fin mod : simple subforums ------------------------------------------------

			// Modify a forum in the DB
			if( isset($HTTP_POST_VARS['prune_enable']))
			{
				if( $HTTP_POST_VARS['prune_enable'] != 1 )
				{
					$HTTP_POST_VARS['prune_enable'] = 0;
				}
			}

			$sql = "UPDATE " . FORUMS_TABLE . "
				SET forum_name = '" . str_replace("\'", "''", $HTTP_POST_VARS['forumname']) . "', cat_id = " . intval($HTTP_POST_VARS[POST_CAT_URL]) . ", forum_desc = '" . str_replace("\'", "''", $HTTP_POST_VARS['forumdesc']) . "', forum_status = " . intval($HTTP_POST_VARS['forumstatus']) . ", prune_enable = " . intval($HTTP_POST_VARS['prune_enable']) . "
				WHERE forum_id = " . intval($HTTP_POST_VARS[POST_FORUM_URL]);

//-- mod : simple subforums ----------------------------------------------------
//-- add
			$sql = str_replace(', cat_id = ' . intval($HTTP_POST_VARS[POST_CAT_URL]) . '', ', cat_id = ' . $new_cat . ', forum_parent = ' . $new_parent . '', $sql);
//-- fin mod : simple subforums ------------------------------------------------

//-- mod : oxygen premod -------------------------------------------------------
//-- add
			$sql = str_replace('SET ', 'SET title_is_link = ' . intval($HTTP_POST_VARS['forum_is_link']) . ', weblink = \'' . str_replace("\'", "''", $HTTP_POST_VARS['forum_weblink']) . '\', forum_link_target = ' . intval($HTTP_POST_VARS['forum_link_target']) . ', forum_icon = \'' . str_replace("\'", "''", $HTTP_POST_VARS['forumicon']) . '\', forum_qpes = ' . intval($HTTP_POST_VARS['forum_qpes']) . ', forum_color = \'' . str_replace("\'", "''", $HTTP_POST_VARS['forum_color']) . '\', forum_password = \'' . str_replace("\'", "''", $HTTP_POST_VARS['password']) . '\', disable_word_censor = ' . intval($HTTP_POST_VARS['disable_word_censor']) . ', forum_display_order = ' . intval($HTTP_POST_VARS['forum_display_order']) . ', forum_display_sort = ' . intval($HTTP_POST_VARS['forum_display_sort']) . ', points_disabled = ' . intval($HTTP_POST_VARS['points_disabled']) . ', forum_as_category = ' . intval($HTTP_POST_VARS['forum_as_category']) . ', forum_template = ' . intval($HTTP_POST_VARS['forum_template']) . ', ', $sql);
//-- fin mod : oxygen premod ---------------------------------------------------

			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update forum information', '', __LINE__, __FILE__, $sql);
			}

//-- mod : the logger ----------------------------------------------------------
//-- add
			if( defined( 'LOG_MOD_INSTALLED' ) )
			{
				if( $log->config['log_admin_forum_edit'] )
				{
					$log->insert( LOG_TYPE_ADMIN, 'LOG_A_EDIT_FORUM', array($forum_name, $HTTP_POST_VARS['forumname']) );
				}
			}
//-- fin mod : the logger ------------------------------------------------------

			if( $HTTP_POST_VARS['prune_enable'] == 1 )
			{
				if( $HTTP_POST_VARS['prune_days'] == '' || $HTTP_POST_VARS['prune_freq'] == '' )
				{
					message_die(GENERAL_MESSAGE, $lang['Set_prune_data']);
				}

				$sql = 'SELECT *
					FROM ' . PRUNE_TABLE . '
					WHERE forum_id = ' . intval($HTTP_POST_VARS[POST_FORUM_URL]);
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Couldnot get forum Prune Information','',__LINE__, __FILE__, $sql);
				}

				if( $db->sql_numrows($result) > 0 )
				{
					$sql = 'UPDATE ' . PRUNE_TABLE . '
						SET	prune_days = ' . intval($HTTP_POST_VARS['prune_days']) . ',	prune_freq = ' . intval($HTTP_POST_VARS['prune_freq']) . '
				 		WHERE forum_id = ' . intval($HTTP_POST_VARS[POST_FORUM_URL]);
				}
				else
				{
					$sql = 'INSERT INTO ' . PRUNE_TABLE . ' (forum_id, prune_days, prune_freq)
						VALUES(' . intval($HTTP_POST_VARS[POST_FORUM_URL]) . ', ' . intval($HTTP_POST_VARS['prune_days']) . ', ' . intval($HTTP_POST_VARS['prune_freq']) . ')';
				}

				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not Update Forum Prune Information', '',__LINE__, __FILE__, $sql);
				}
			}

			$message = $lang['Forums_updated'] . '<br /><br />' . sprintf($lang['Click_return_forumadmin'], '<a href="' . append_sid('admin_forums.'.$phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid('index.'.$phpEx . '?pane=right') . '">', '</a>');

			message_die(GENERAL_MESSAGE, $message);

			break;
			
		case 'addcat':
			// Create a category in the DB
			if( trim($HTTP_POST_VARS['categoryname']) == '')
			{
				message_die(GENERAL_ERROR, 'Cannot create a category without a name');
			}

			$sql = 'SELECT MAX(cat_order) AS max_order FROM ' . CATEGORIES_TABLE;
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Couldnot get order number from categories table', '', __LINE__, __FILE__, $sql);
			}
			$row = $db->sql_fetchrow($result);

			$max_order = $row['max_order'];
			$next_order = $max_order + 10;
			$db->sql_freeresult($result);

			//
			// There is no problem having duplicate forum names so we won't check for it.
			//
			$sql = 'INSERT INTO ' . CATEGORIES_TABLE . ' (cat_title, cat_order)
				VALUES (\'' . str_replace("\'", "''", $HTTP_POST_VARS['categoryname']) . '\', ' . $next_order . ')';
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Couldnot insert row in categories table', '', __LINE__, __FILE__, $sql);
			}

			$message = $lang['Forums_updated'] . '<br /><br />' . sprintf($lang['Click_return_forumadmin'], '<a href="' . append_sid('admin_forums.'.$phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid('index.'.$phpEx . '?pane=right') . '">', '</a>');

			message_die(GENERAL_MESSAGE, $message);

			break;
			
		case 'editcat':
			//
			// Show form to edit a category
			//
			$newmode = 'modcat';
			$buttonvalue = $lang['Update'];

			$cat_id = intval($HTTP_GET_VARS[POST_CAT_URL]);

			$row = get_info('category', $cat_id);
			$cat_title = $row['cat_title'];

			$template->set_filenames(array('body' => 'admin/category_edit_body.tpl'));

			$s_hidden_fields = '<input type="hidden" name="mode" value="' . $newmode . '" /><input type="hidden" name="' . POST_CAT_URL . '" value="' . $cat_id . '" />';

			$template->assign_vars(array(
				'CAT_TITLE' => $cat_title,

				'L_EDIT_CATEGORY' => $lang['Edit_Category'], 
				'L_EDIT_CATEGORY_EXPLAIN' => $lang['Edit_Category_explain'], 
				'L_CATEGORY' => $lang['Category'], 

				'S_HIDDEN_FIELDS' => $s_hidden_fields, 
				'S_SUBMIT_VALUE' => $buttonvalue, 
				'S_FORUM_ACTION' => append_sid('admin_forums.'.$phpEx),
			));

			$template->pparse('body');
			break;

		case 'modcat':
			// Modify a category in the DB
			$sql = 'UPDATE ' . CATEGORIES_TABLE . '
				SET cat_title = \'' . str_replace("\'", "''", $HTTP_POST_VARS['cat_title']) . '\'
				WHERE cat_id = ' . intval($HTTP_POST_VARS[POST_CAT_URL]);
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Couldnot update forum information', '', __LINE__, __FILE__, $sql);
			}

			$message = $lang['Forums_updated'] . '<br /><br />' . sprintf($lang['Click_return_forumadmin'], '<a href="' . append_sid('admin_forums.'.$phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid('index.'.$phpEx . '?pane=right') . '">', '</a>');

			message_die(GENERAL_MESSAGE, $message);

			break;
			
		case 'deleteforum':
			// Show form to delete a forum
			$forum_id = intval($HTTP_GET_VARS[POST_FORUM_URL]);

			$select_to = '<select name="to_id">';
			$select_to .= '<option value="-1"' . $s . '>' . $lang['Delete_all_posts'] . '</option>\n';
			$select_to .= get_list('forum', $forum_id, 0);
			$select_to .= '</select>';

			$buttonvalue = $lang['Move_and_Delete'];

			$newmode = 'movedelforum';

			$foruminfo = get_info('forum', $forum_id);
			$name = $foruminfo['forum_name'];

			$template->set_filenames(array('body' => 'admin/forum_delete_body.tpl'));

			$s_hidden_fields = '<input type="hidden" name="mode" value="' . $newmode . '" /><input type="hidden" name="from_id" value="' . $forum_id . '" />';

			$template->assign_vars(array(
				'NAME' => $name, 

				'L_FORUM_DELETE' => $lang['Forum_delete'], 
				'L_FORUM_DELETE_EXPLAIN' => $lang['Forum_delete_explain'], 
				'L_MOVE_CONTENTS' => $lang['Move_contents'], 
				'L_FORUM_NAME' => $lang['Forum_name'], 

				'S_HIDDEN_FIELDS' => $s_hidden_fields,
				'S_FORUM_ACTION' => append_sid('admin_forums.'.$phpEx), 
				'S_SELECT_TO' => $select_to,
				'S_SUBMIT_VALUE' => $buttonvalue,
			));

			$template->pparse('body');
			break;

		case 'movedelforum':
			//
			// Move or delete a forum in the DB
			//
			$from_id = intval($HTTP_POST_VARS['from_id']);
			$to_id = intval($HTTP_POST_VARS['to_id']);
			$delete_old = intval($HTTP_POST_VARS['delete_old']);

//-- mod : the logger ----------------------------------------------------------
//-- add
			if( defined( 'LOG_MOD_INSTALLED' ) )
			{
				$forum_name = $log->convert_forum_id( $from_id );
			}
//-- fin mod : the logger ------------------------------------------------------

			// Either delete or move all posts in a forum
			if($to_id == -1)
			{
				// Delete polls in this forum
				$sql = 'SELECT v.vote_id 
					FROM ' . VOTE_DESC_TABLE . ' v, ' . TOPICS_TABLE . ' t 
					WHERE t.forum_id = ' . $from_id . ' 
						AND v.topic_id = t.topic_id';
				if (!($result = $db->sql_query($sql)))
				{
					message_die(GENERAL_ERROR, 'Couldnot obtain list of vote ids', '', __LINE__, __FILE__, $sql);
				}

				if ($row = $db->sql_fetchrow($result))
				{
					$vote_ids = '';
					do
					{
						$vote_ids = (($vote_ids != '') ? ', ' : '') . $row['vote_id'];
					}
					while ($row = $db->sql_fetchrow($result));

					$sql = 'DELETE FROM ' . VOTE_DESC_TABLE . ' WHERE vote_id IN (' . $vote_ids . ')';
					$db->sql_query($sql);

					$sql = 'DELETE FROM ' . VOTE_RESULTS_TABLE . ' WHERE vote_id IN (' . $vote_ids . ')';
					$db->sql_query($sql);

					$sql = 'DELETE FROM ' . VOTE_USERS_TABLE . ' WHERE vote_id IN (' . $vote_ids . ')';
					$db->sql_query($sql);
				}
				$db->sql_freeresult($result);
				
				include($phpbb_root_path . 'includes/prune.'.$phpEx);
				prune($from_id, 0, true); // Delete everything from forum
			}
			else
			{
				$sql = 'SELECT * FROM ' . FORUMS_TABLE . ' WHERE forum_id IN (' . $from_id . ', ' . $to_id . ')';
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Couldnot verify existence of forums', '', __LINE__, __FILE__, $sql);
				}

				if($db->sql_numrows($result) != 2)
				{
					message_die(GENERAL_ERROR, 'Ambiguous forum IDs', '', __LINE__, __FILE__);
				}
				$sql = 'UPDATE ' . TOPICS_TABLE . ' SET forum_id = ' . $to_id . ' WHERE forum_id = ' . $from_id;
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not move topics to other forum', '', __LINE__, __FILE__, $sql);
				}
				$sql = 'UPDATE ' . POSTS_TABLE . ' SET	forum_id = ' . $to_id . ' WHERE forum_id = ' . $from_id;
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not move posts to other forum', '', __LINE__, __FILE__, $sql);
				}
				sync('forum', $to_id);
			}

			// Alter Mod level if appropriate - 2.0.4
			$sql = 'SELECT ug.user_id 
				FROM ' . AUTH_ACCESS_TABLE . ' a, ' . USER_GROUP_TABLE . ' ug 
				WHERE a.forum_id <> ' . $from_id . ' 
					AND a.auth_mod = 1
					AND ug.group_id = a.group_id';
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Couldnot obtain moderator list', '', __LINE__, __FILE__, $sql);
			}

			if ($row = $db->sql_fetchrow($result))
			{
				$user_ids = '';
				do
				{
					$user_ids .= (($user_ids != '') ? ', ' : '' ) . $row['user_id'];
				}
				while ($row = $db->sql_fetchrow($result));

				$sql = 'SELECT ug.user_id 
					FROM ' . AUTH_ACCESS_TABLE . ' a, ' . USER_GROUP_TABLE . ' ug 
					WHERE a.forum_id = ' . $from_id . ' 
						AND a.auth_mod = 1 
						AND ug.group_id = a.group_id
						AND ug.user_id NOT IN (' . $user_ids . ')';
				if( !$result2 = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not obtain moderator list', '', __LINE__, __FILE__, $sql);
				}

				if ($row = $db->sql_fetchrow($result2))
				{
					$user_ids = '';
					do
					{
						$user_ids .= (($user_ids != '') ? ', ' : '') . $row['user_id'];
					}
					while ($row = $db->sql_fetchrow($result2));

					$sql = 'UPDATE ' . USERS_TABLE . ' 
						SET user_level = ' . USER . ' 
						WHERE user_id IN (' . $user_ids . ') 
							AND user_level <> ' . ADMIN;
					$db->sql_query($sql);
				}
				$db->sql_freeresult($result);

			}
			$db->sql_freeresult($result2);

			$sql = 'DELETE FROM ' . FORUMS_TABLE . ' WHERE forum_id = ' . $from_id;
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete forum', '', __LINE__, __FILE__, $sql);
			}

//-- mod : simple subforums ----------------------------------------------------
//-- add
			$sql = 'UPDATE ' . FORUMS_TABLE . ' SET forum_parent = 0 WHERE forum_parent = \'' . $from_id . '\'';
			$db->sql_query($sql);
//-- fin mod : simple subforums ------------------------------------------------

			$sql = 'DELETE FROM ' . AUTH_ACCESS_TABLE . ' WHERE forum_id = ' . $from_id;
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete forum', '', __LINE__, __FILE__, $sql);
			}
			
			$sql = 'DELETE FROM ' . PRUNE_TABLE . ' WHERE forum_id = ' . $from_id;
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete forum prune information!', '', __LINE__, __FILE__, $sql);
			}

//-- mod : the logger ----------------------------------------------------------
//-- add
			if( defined( 'LOG_MOD_INSTALLED' ) )
			{
				if( $log->config['log_admin_forum_deletion'] )
				{
					$log->insert( LOG_TYPE_ADMIN, 'LOG_A_DELETE_FORUM', array($forum_name) );
				}
			}
//-- fin mod : the logger ------------------------------------------------------

			$message = $lang['Forums_updated'] . '<br /><br />' . sprintf($lang['Click_return_forumadmin'], '<a href="' . append_sid('admin_forums.'.$phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid('index.'.$phpEx . '?pane=right') . '">', '</a>');

			message_die(GENERAL_MESSAGE, $message);

			break;
			
		case 'deletecat':
			//
			// Show form to delete a category
			//
			$cat_id = intval($HTTP_GET_VARS[POST_CAT_URL]);

			$buttonvalue = $lang['Move_and_Delete'];
			$newmode = 'movedelcat';
			$catinfo = get_info('category', $cat_id);
			$name = $catinfo['cat_title'];

			if ($catinfo['number'] == 1)
			{
				$sql = 'SELECT count(*) as total FROM ' . FORUMS_TABLE;
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not get Forum count', '', __LINE__, __FILE__, $sql);
				}
				$count = $db->sql_fetchrow($result);
				$count = $count['total'];

				if ($count > 0)
				{
					message_die(GENERAL_ERROR, $lang['Must_delete_forums']);
				}
				else
				{
					$select_to = $lang['Nowhere_to_move'];
				}
				$db->sql_freeresult($result);
			}
			else
			{
				$select_to = '<select name="to_id">';
				$select_to .= get_list('category', $cat_id, 0);
				$select_to .= '</select>';
			}

			$template->set_filenames(array('body' => 'admin/forum_delete_body.tpl'));

			$s_hidden_fields = '<input type="hidden" name="mode" value="' . $newmode . '" /><input type="hidden" name="from_id" value="' . $cat_id . '" />';

			$template->assign_vars(array(
				'NAME' => $name, 

				'L_FORUM_DELETE' => $lang['Forum_delete'], 
				'L_FORUM_DELETE_EXPLAIN' => $lang['Forum_delete_explain'], 
				'L_MOVE_CONTENTS' => $lang['Move_contents'], 
				'L_FORUM_NAME' => $lang['Forum_name'], 
				
				'S_HIDDEN_FIELDS' => $s_hidden_fields,
				'S_FORUM_ACTION' => append_sid('admin_forums.'.$phpEx), 
				'S_SELECT_TO' => $select_to,
				'S_SUBMIT_VALUE' => $buttonvalue,
			));

			$template->pparse('body');
			break;

		case 'movedelcat':
			//
			// Move or delete a category in the DB
			//
			$from_id = intval($HTTP_POST_VARS['from_id']);
			$to_id = intval($HTTP_POST_VARS['to_id']);

			if (!empty($to_id))
			{
				$sql = 'SELECT * FROM ' . CATEGORIES_TABLE . ' WHERE cat_id IN (' . $from_id . ', ' . $to_id . ')';
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not verify existence of categories', '', __LINE__, __FILE__, $sql);
				}
				if($db->sql_numrows($result) != 2)
				{
					message_die(GENERAL_ERROR, 'Ambiguous category IDs','', __LINE__, __FILE__);
				}

				$sql = 'UPDATE ' . FORUMS_TABLE . ' SET cat_id = ' . $to_id . ' WHERE cat_id = ' . $from_id;
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not move forums to other category', '', __LINE__, __FILE__, $sql);
				}
				$db->sql_freeresult($result);
			}

			$sql = 'DELETE FROM ' . CATEGORIES_TABLE .' WHERE cat_id = ' . $from_id;
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete category', '', __LINE__, __FILE__, $sql);
			}

			$message = $lang['Forums_updated'] . '<br /><br />' . sprintf($lang['Click_return_forumadmin'], '<a href="' . append_sid('admin_forums.'.$phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid('index.'.$phpEx . '?pane=right') . '">', '</a>');

			message_die(GENERAL_MESSAGE, $message);

			break;

		case 'forum_order':
			//
			// Change order of forums in the DB
			//
			$move = intval($HTTP_GET_VARS['move']);
			$forum_id = intval($HTTP_GET_VARS[POST_FORUM_URL]);

			$forum_info = get_info('forum', $forum_id);

			$cat_id = $forum_info['cat_id'];

//-- mod : simple subforums ----------------------------------------------------
//-- add
			if( !$forum_info['forum_parent'] )
			{
				// Find previous/next forum
				if( $move > 0 )
				{
					$sql = 'SELECT forum_id, forum_order FROM ' . FORUMS_TABLE . ' WHERE cat_id = \'' . $cat_id . '\' AND forum_parent = 0 AND forum_order > ' . $forum_info['forum_order'] . ' ORDER BY forum_order ASC';
				}
				else
				{
					$sql = 'SELECT forum_id, forum_order FROM ' . FORUMS_TABLE . ' WHERE cat_id = \'' . $cat_id . '\' AND forum_parent = 0 AND forum_order < ' . $forum_info['forum_order'] . ' ORDER BY forum_order DESC';
				}

				if( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not change category order', '', __LINE__, __FILE__, $sql);
				}

				$row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);
				if($row !== false)
				{
					// Swap forum orders
					$sql = 'UPDATE ' . FORUMS_TABLE . ' SET forum_order = ' . $row['forum_order'] . ' WHERE forum_id = \'' . $forum_id . '\'';
					$db->sql_query($sql);

					$sql = 'UPDATE ' . FORUMS_TABLE . ' SET forum_order = ' . $forum_info['forum_order'] . ' WHERE forum_id = ' . $row['forum_id'];
					$db->sql_query($sql);
				}
			}

			else
			{
//-- fin mod : simple subforums ------------------------------------------------

				$sql = 'UPDATE ' . FORUMS_TABLE . ' SET forum_order = forum_order + ' . $move . ' WHERE forum_id = ' . $forum_id;
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not change category order', '', __LINE__, __FILE__, $sql);
				}

				renumber_order('forum', $forum_info['cat_id']);

//-- mod : simple subforums ----------------------------------------------------
//-- add
			}
//-- fin mod : simple subforums ------------------------------------------------

			$show_index = TRUE;

			break;
			
		case 'cat_order':
			//
			// Change order of categories in the DB
			//
			$move = intval($HTTP_GET_VARS['move']);
			$cat_id = intval($HTTP_GET_VARS[POST_CAT_URL]);

			$sql = 'UPDATE ' . CATEGORIES_TABLE . ' SET cat_order = cat_order + ' . $move . ' WHERE cat_id = ' . $cat_id;
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not change category order', '', __LINE__, __FILE__, $sql);
			}

			renumber_order('category');
			$show_index = TRUE;

			break;

		case 'forum_sync':
			sync('forum', intval($HTTP_GET_VARS[POST_FORUM_URL]));
			$show_index = TRUE;

			break;

		default:
			message_die(GENERAL_MESSAGE, $lang['No_mode']);
			break;
	}

	if ($show_index != TRUE)
	{
		include('./page_footer_admin.'.$phpEx);
		exit;
	}
}

//
// Start page proper
//
$template->set_filenames(array('body' => 'admin/forum_admin_body.tpl'));

$template->assign_vars(array(
	'S_FORUM_ACTION' => append_sid('admin_forums.'.$phpEx),
	'L_FORUM_TITLE' => $lang['Forum_admin'], 
	'L_FORUM_EXPLAIN' => $lang['Forum_admin_explain'], 
	'L_CREATE_FORUM' => $lang['Create_forum'], 
	'L_CREATE_CATEGORY' => $lang['Create_category'], 
	'L_EDIT' => $lang['Edit'], 
	'L_DELETE' => $lang['Delete'], 
	'L_MOVE_UP' => $lang['Move_up'], 
	'L_MOVE_DOWN' => $lang['Move_down'], 
	'L_RESYNC' => $lang['Resync'],
));

$sql = 'SELECT cat_id, cat_title, cat_order FROM ' . CATEGORIES_TABLE . ' ORDER BY cat_order';
if( !$q_categories = $db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, 'Could not query categories list', '', __LINE__, __FILE__, $sql);
}

if( $total_categories = $db->sql_numrows($q_categories) )
{
	$category_rows = $db->sql_fetchrowset($q_categories);

	$sql = 'SELECT * FROM ' . FORUMS_TABLE . ' ORDER BY cat_id, forum_order';
	if(!$q_forums = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not query forums information', '', __LINE__, __FILE__, $sql);
	}

	if( $total_forums = $db->sql_numrows($q_forums) )
	{
		$forum_rows = $db->sql_fetchrowset($q_forums);
	}

	//
	// Okay, let's build the index
	//
	$gen_cat = array();

	for($i = 0; $i < $total_categories; $i++)
	{
		$cat_id = $category_rows[$i]['cat_id'];

		$template->assign_block_vars('catrow', array( 
			'S_ADD_FORUM_SUBMIT' => 'addforum[' . $cat_id . ']', 
			'S_ADD_FORUM_NAME' => 'forumname[' . $cat_id . ']', 

			'CAT_ID' => $cat_id,
			'CAT_DESC' => $category_rows[$i]['cat_title'],

			'U_CAT_EDIT' => append_sid('admin_forums.'.$phpEx . '?mode=editcat&amp;' . POST_CAT_URL . '=' . $cat_id),
			'U_CAT_DELETE' => append_sid('admin_forums.'.$phpEx . '?mode=deletecat&amp;' . POST_CAT_URL . '=' . $cat_id),
			'U_CAT_MOVE_UP' => append_sid('admin_forums.'.$phpEx . '?mode=cat_order&amp;move=-15&amp;' . POST_CAT_URL . '=' . $cat_id),
			'U_CAT_MOVE_DOWN' => append_sid('admin_forums.'.$phpEx . '?mode=cat_order&amp;move=15&amp;' . POST_CAT_URL . '=' . $cat_id),
			'U_VIEWCAT' => append_sid($phpbb_root_path . 'index.'.$phpEx . '?' . POST_CAT_URL . '=' . $cat_id),
		));

		for($j = 0; $j < $total_forums; $j++)
		{
			$forum_id = $forum_rows[$j]['forum_id'];

//-- mod : simple subforums ----------------------------------------------------
//-- delete
/*-MOD
			if ($forum_rows[$j]['cat_id'] == $cat_id)
MOD-*/
//-- add
			if ($forum_rows[$j]['cat_id'] == $cat_id && !$forum_rows[$j]['forum_parent'])
//-- fin mod : simple subforums ------------------------------------------------
			{

				$template->assign_block_vars('catrow.forumrow',	array(
					'FORUM_NAME' => $forum_rows[$j]['forum_name'],
//-- mod : colorize forum title ------------------------------------------------
//-- add
					'FORUM_COLOR' => (!empty($forum_rows[$j]['forum_color'])) ? 'style="color: #' . $forum_rows[$j]['forum_color'] . '"' : '',
//-- fin mod : colorize forum title --------------------------------------------
					'FORUM_DESC' => $forum_rows[$j]['forum_desc'],
//-- mod : forum icon with acp control -----------------------------------------
//-- add
					'FORUM_ICON_IMG' => ( $forum_rows[$j]['forum_icon'] ) ? '<img src="' . $phpbb_root_path . $board_config['forum_icon_path'] . '/' . $forum_rows[$j]['forum_icon'] . '" border="0" />' : '',
//-- fin mod : forum icon with acp control -------------------------------------
					'ROW_COLOR' => $row_color,
//-- mod : forumtitle as weblink -----------------------------------------------
//-- delete
/*-MOD
					'NUM_TOPICS' => $forum_rows[$j]['forum_topics'],
					'NUM_POSTS' => $forum_rows[$j]['forum_posts'],

					'U_VIEWFORUM' => append_sid($phpbb_root_path."viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id"),
MOD-*/
//-- add
					'NUM_TOPICS' => ( $forum_rows[$j]['title_is_link'] ) ? '-' : $forum_rows[$j]['forum_topics'],
					'NUM_POSTS' => ( $forum_rows[$j]['title_is_link'] ) ? '-' : $forum_rows[$j]['forum_posts'],

					'U_VIEWFORUM' => ( $forum_rows[$j]['title_is_link'] ) ? $forum_rows[$j]['weblink'] : append_sid($phpbb_root_path . 'viewforum.'.$phpEx . '?' . POST_FORUM_URL . '=' . $forum_id),
//-- fin mod : forumtitle as weblink -------------------------------------------
					'U_FORUM_EDIT' => append_sid('admin_forums.'.$phpEx . '?mode=editforum&amp;' . POST_FORUM_URL . '=' . $forum_id),
					'U_FORUM_DELETE' => append_sid('admin_forums.'.$phpEx . '?mode=deleteforum&amp;' . POST_FORUM_URL . '=' . $forum_id),
					'U_FORUM_MOVE_UP' => append_sid('admin_forums.'.$phpEx . '?mode=forum_order&amp;move=-15&amp;' . POST_FORUM_URL . '=' . $forum_id),
					'U_FORUM_MOVE_DOWN' => append_sid('admin_forums.'.$phpEx . '?mode=forum_order&amp;move=15&amp;' . POST_FORUM_URL . '=' . $forum_id),
					'U_FORUM_RESYNC' => append_sid('admin_forums.'.$phpEx . '?mode=forum_sync&amp;' . POST_FORUM_URL . '=' . $forum_id),
				));

//-- mod : simple subforums ----------------------------------------------------
//-- add
				for( $k = 0; $k < $total_forums; $k++ )
				{
					$forum_id2 = $forum_rows[$k]['forum_id'];
					if ( $forum_rows[$k]['forum_parent'] == $forum_id )
					{
						$template->assign_block_vars('catrow.forumrow',	array(
							'FORUM_NAME' => $forum_rows[$k]['forum_name'],
//-- mod : colorize forum title ------------------------------------------------
//-- add
							'FORUM_COLOR' => (!empty($forum_rows[$k]['forum_color'])) ? 'style="color: #' . $forum_rows[$k]['forum_color'] . '"' : '',
//-- fin mod : colorize forum title --------------------------------------------
							'FORUM_DESC' => $forum_rows[$k]['forum_desc'],
//-- mod : forum icon with acp control -----------------------------------------
//-- add
							'FORUM_ICON_IMG' => ( $forum_rows[$k]['forum_icon'] ) ? '<img src="' . $phpbb_root_path . $board_config['forum_icon_path'] . '/' . $forum_rows[$k]['forum_icon'] . '" border="0" />' : '',
//-- fin mod : forum icon with acp control -------------------------------------
							'ROW_COLOR' => $row_color,
//-- mod : forumtitle as weblink -----------------------------------------------
//-- delete
/*-MOD
							'NUM_TOPICS' => $forum_rows[$k]['forum_topics'],
							'NUM_POSTS' => $forum_rows[$k]['forum_posts'],
MOD-*/
//-- add
							'NUM_TOPICS' => ( $forum_rows[$k]['title_is_link'] ) ? '-' : $forum_rows[$k]['forum_topics'],
							'NUM_POSTS' => ( $forum_rows[$k]['title_is_link'] ) ? '-' : $forum_rows[$k]['forum_posts'],
//-- fin mod : forumtitle as weblink -------------------------------------------

//-- mod : forumtitle as weblink -----------------------------------------------
//-- delete
/*-MOD
							'U_VIEWFORUM' => append_sid($phpbb_root_path."viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id2"),
MOD-*/
//-- add
							'U_VIEWFORUM' => ( $forum_rows[$k]['title_is_link'] ) ? $forum_rows[$k]['weblink'] : append_sid($phpbb_root_path . 'viewforum.' . $phpEx . '?' . POST_FORUM_URL . '=' . $forum_id2),
//-- fin mod : forumtitle as weblink -------------------------------------------
							'U_FORUM_EDIT' => append_sid('admin_forums.'.$phpEx . '?mode=editforum&amp;' . POST_FORUM_URL . '=' . $forum_id2),
							'U_FORUM_DELETE' => append_sid('admin_forums.'.$phpEx . '?mode=deleteforum&amp;' . POST_FORUM_URL . '=' . $forum_id2),
							'U_FORUM_MOVE_UP' => append_sid('admin_forums.'.$phpEx . '?mode=forum_order&amp;move=-15&amp;' . POST_FORUM_URL . '=' . $forum_id2),
							'U_FORUM_MOVE_DOWN' => append_sid('admin_forums.'.$phpEx . '?mode=forum_order&amp;move=15&amp;' . POST_FORUM_URL . '=' . $forum_id2),
							'U_FORUM_RESYNC' => append_sid('admin_forums.'.$phpEx . '?mode=forum_sync&amp;' . POST_FORUM_URL . '=' . $forum_id2),
						));
						$template->assign_block_vars('catrow.forumrow.tree_cross', array('FORUM_TREE_IMG' => $phpbb_root_path . $images['tree_hcross']));
					}
				} // for ... forums
//-- fin mod : simple subforums ------------------------------------------------

			}// if ... forumid == catid
			
		} // for ... forums

	} // for ... categories

}// if ... total_categories

$template->pparse('body');

include('./page_footer_admin.'.$phpEx);

?>
