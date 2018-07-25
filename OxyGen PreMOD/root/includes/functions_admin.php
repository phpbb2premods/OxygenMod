<?php
/***************************************************************************
 *                            functions_admin.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: functions_admin.php,v 1.5.2.5 2005/09/14 19:16:21 acydburn Exp $
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

//
// Simple version of jumpbox, just lists authed forums
//
//-- mod : improved jumpboxes --------------------------------------------------
//-- delete
/*-MOD
function make_forum_select($box_name, $ignore_forum = false, $select_forum = '')
{
	global $db, $userdata;

	$is_auth_ary = auth(AUTH_READ, AUTH_LIST_ALL, $userdata);

	$sql = 'SELECT f.forum_id, f.forum_name
		FROM ' . CATEGORIES_TABLE . ' c, ' . FORUMS_TABLE . ' f
		WHERE f.cat_id = c.cat_id 
		ORDER BY c.cat_order, f.forum_order';

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Couldn not obtain forums information', '', __LINE__, __FILE__, $sql);
	}

	$forum_list = '';
	while( $row = $db->sql_fetchrow($result) )
	{
		if ( $is_auth_ary[$row['forum_id']]['auth_read'] && $ignore_forum != $row['forum_id'] )
		{
			$selected = ( $select_forum == $row['forum_id'] ) ? ' selected="selected"' : '';
			$forum_list .= '<option value="' . $row['forum_id'] . '"' . $selected .'>' . $row['forum_name'] . '</option>';
		}
	}

	$forum_list = ( $forum_list == '' ) ? '<option value="-1">-- ! No Forums ! --</option>' : '<select name="' . $box_name . '">' . $forum_list . '</select>';

	return $forum_list;
}
MOD-*/
//-- add
function make_forum_select($box_name, $ignore_forum = false, $select_forum = '')
{
	global $db, $userdata, $lang;
	$is_auth_ary = auth(AUTH_READ, AUTH_LIST_ALL, $userdata);

	$sql = 'SELECT c.cat_id, c.cat_title, c.cat_order
		FROM ' . CATEGORIES_TABLE . ' c, ' . FORUMS_TABLE . ' f
		WHERE f.cat_id = c.cat_id
		GROUP BY c.cat_id, c.cat_title, c.cat_order
		ORDER BY c.cat_order';
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain category list.', '', __LINE__, __FILE__, $sql);
	}

	$category_rows = array();
	while ( $row = $db->sql_fetchrow($result) )
	{
		$category_rows[] = $row;
	}

	if ( $total_categories = count($category_rows) )
	{
		$sql = 'SELECT *
			FROM ' . FORUMS_TABLE . '
			ORDER BY cat_id, forum_order';
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain forums information', '', __LINE__, __FILE__, $sql);
		}

		$forum_rows = array();
		while ( $row = $db->sql_fetchrow($result) )
		{
			$forum_rows[] = $row;

//-- mod : simple subforums ----------------------------------------------------
//-- add
			$forums_list[] = $row;
//-- fin mod : simple subforums ------------------------------------------------
		}

		if ( $total_forums = count($forum_rows) )
		{
			for( $i = 0; $i < $total_categories; $i++ )
			{
				$boxstring_forums = '';
				for( $j = 0; $j < $total_forums; $j++ )
				{
					if ( !$forum_rows[$j]['forum_parent'] && $forum_rows[$j]['cat_id'] == $category_rows[$i]['cat_id'] && $is_auth_ary[$forum_rows[$j]['forum_id']]['auth_read'] && $ignore_forum != $forum_rows[$j]['forum_id'] )
					{
						$selected = ( $select_forum == $forum_rows[$j]['forum_id'] ) ? ' selected="selected"' : '';

//-- mod : simple subforums ----------------------------------------------------
//-- add
						$id = $forum_rows[$j]['forum_id'];
//-- fin mod : simple subforums ------------------------------------------------

						$boxstring_forums .=  '<option value="' . $forum_rows[$j]['forum_id'] . '"' . $selected . '>' . $forum_rows[$j]['forum_name'] . '</option>';		

//-- mod : simple subforums ----------------------------------------------------
//-- add
						for( $k = 0; $k < $total_forums; $k++ )
						{
							if ( $forum_rows[$k]['forum_parent'] == $id && $forum_rows[$k]['cat_id'] == $category_rows[$i]['cat_id'] && $is_auth_ary[$forum_rows[$k]['forum_id']]['auth_read'] )
							{
								$selected = ( $forum_rows[$k]['forum_id'] == $match_forum_id ) ? 'selected="selected"' : '';
								$boxstring_forums .=  '<option value="' . $forum_rows[$k]['forum_id'] . '"' . $selected . '>-- ' . $forum_rows[$k]['forum_name'] . '</option>';
							}
						}
//-- fin mod : simple subforums ------------------------------------------------
					}
				}

				if ( $boxstring_forums != '' )
				{
					$boxstring .= '<optgroup label="' . $category_rows[$i]['cat_title'] . '">';
					$boxstring .= $boxstring_forums;
					$boxstring .= '</optgroup>';
				}
			}
		}
	}

	else
	{
		$boxstring .= '';
	}

	$forum_list = ( $boxstring == '' ) ? $lang['No_forums'] : '<select name="' . $box_name . '"><option value="">' . $lang['Select_forum'] . '</option>' . $boxstring . '</select>';

	return $forum_list;
}
//-- fin mod : improved jumpboxes ----------------------------------------------

//
// Synchronise functions for forums/topics
//
function sync($type, $id = false)
{
	global $db;

	switch($type)
	{
		case 'all forums':
			$sql = 'SELECT forum_id
				FROM ' . FORUMS_TABLE;
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get forum IDs', '', __LINE__, __FILE__, $sql);
			}

			while( $row = $db->sql_fetchrow($result) )
			{
				sync('forum', $row['forum_id']);
			}
			$db->sql_freeresult($result);
		   	break;

		case 'all topics':
			$sql = 'SELECT topic_id
				FROM ' . TOPICS_TABLE;
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get topic ID', '', __LINE__, __FILE__, $sql);
			}

			while( $row = $db->sql_fetchrow($result) )
			{
				sync('topic', $row['topic_id']);
			}
			$db->sql_freeresult($result);
			break;

	  	case 'forum':
			$sql = 'SELECT MAX(post_id) AS last_post, COUNT(post_id) AS total 
				FROM ' . POSTS_TABLE . '  
				WHERE forum_id = ' . $id;
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get post ID', '', __LINE__, __FILE__, $sql);
			}

			if ( $row = $db->sql_fetchrow($result) )
			{
				$last_post = ( $row['last_post'] ) ? $row['last_post'] : 0;
				$total_posts = ($row['total']) ? $row['total'] : 0;
			}
			else
			{
				$last_post = 0;
				$total_posts = 0;
			}
			$db->sql_freeresult($result);

			$sql = 'SELECT COUNT(topic_id) AS total
				FROM ' . TOPICS_TABLE . '
				WHERE forum_id = ' . $id;
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get topic count', '', __LINE__, __FILE__, $sql);
			}

			$total_topics = ( $row = $db->sql_fetchrow($result) ) ? ( ( $row['total'] ) ? $row['total'] : 0 ) : 0;
			$db->sql_freeresult($result);

			$sql = 'UPDATE ' . FORUMS_TABLE . '
				SET forum_last_post_id = ' . $last_post . ', forum_posts = ' . $total_posts . ', forum_topics = ' . $total_topics . '
				WHERE forum_id = ' . $id;
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update forum', '', __LINE__, __FILE__, $sql);
			}
			break;

		case 'topic':
			$sql = 'SELECT MAX(post_id) AS last_post, MIN(post_id) AS first_post, COUNT(post_id) AS total_posts
				FROM ' . POSTS_TABLE . '
				WHERE topic_id = ' . $id;
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get post ID', '', __LINE__, __FILE__, $sql);
			}

			if ( $row = $db->sql_fetchrow($result) )
			{
				if ($row['total_posts'])
				{
					// Correct the details of this topic
					$sql = 'UPDATE ' . TOPICS_TABLE . ' 
						SET topic_replies = ' . ($row['total_posts'] - 1) . ', topic_first_post_id = ' . $row['first_post'] . ', topic_last_post_id = ' . $row['last_post'] . '
						WHERE topic_id = ' . $id;

					if (!$db->sql_query($sql))
					{
						message_die(GENERAL_ERROR, 'Could not update topic', '', __LINE__, __FILE__, $sql);
					}
				}
				else
				{
					// There are no replies to this topic
					// Check if it is a move stub
					$sql = 'SELECT topic_moved_id 
						FROM ' . TOPICS_TABLE . ' 
						WHERE topic_id = ' . $id;

					if (!($result = $db->sql_query($sql)))
					{
						message_die(GENERAL_ERROR, 'Could not get topic ID', '', __LINE__, __FILE__, $sql);
					}

					if ($row = $db->sql_fetchrow($result))
					{
						if (!$row['topic_moved_id'])
						{
							$sql = 'DELETE FROM ' . TOPICS_TABLE . ' WHERE topic_id = ' . $id;
			
							if (!$db->sql_query($sql))
							{
								message_die(GENERAL_ERROR, 'Could not remove topic', '', __LINE__, __FILE__, $sql);
							}
						}
					}

					$db->sql_freeresult($result);
				}
//-- mod : attachment mod ------------------------------------------------------
//-- add
				attachment_sync_topic($id);
//-- fin mod : attachment mod --------------------------------------------------
			}
			break;
	}
	
	return true;
}

//-- mod : modcp merge hack ----------------------------------------------------
//-- add
function make_topic_select($box_name, $forum_id)
{
	global $db, $userdata;

	$is_auth_ary = auth(AUTH_READ, AUTH_LIST_ALL, $userdata);

	$sql = 'SELECT topic_id, topic_title 
		FROM ' . TOPICS_TABLE . ' 
		WHERE forum_id = ' . $forum_id . '
		ORDER BY topic_title';
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain topics information', '', __LINE__, __FILE__, $sql);
	}

	$topic_list = '';
	while( $row = $db->sql_fetchrow($result) )
	{
		$topic_list .= '<option value="' . $row['topic_id'] . '">' . $row['topic_title'] . '</option>';
	}

	$topic_list = ( $topic_list == '' ) ? '<option value="-1">-- ! No Topics ! --</option>' : '<select name="' . $box_name . '">' . $topic_list . '</select>';

	return $topic_list;
}
//-- fin mod : modcp merge hack ------------------------------------------------

?>
