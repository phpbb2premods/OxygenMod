<?php
/**
*
* @version $Id: functions_topics_list.php,v 1.1.9 2003/11/04 18:53:35 Ptirhiik Exp $
* @copyright (c) 2003 Ptirhiik, admin@rpgnet-fr.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

define('USER_REPLIED_ICON', true);

// various includes
include_once($phpbb_root_path . './includes/functions_post.' . $phpEx);
include_once($phpbb_root_path . './includes/bbcode.' . $phpEx);

function topic_list($box, $tpl='', $topic_rowset, $list_title='', $split_type=false, $display_nav_tree=true, $footer='', $inbox=true, $select_field='', $select_type=0, $select_formname='', $select_values=array())
{
	global $db, $template, $board_config, $userdata, $phpEx, $lang, $images, $HTTP_COOKIE_VARS;
	global $tree;

//-- mod : rank color system ---------------------------------------------------
//-- add
	global $rcs, $get;
//-- fin mod : rank color system -----------------------------------------------

	static $box_id;

	// save template state
	$sav_tpl = $template->_tpldata;

	// init
	if (empty($tpl))
	{
		$tpl = 'topics_list_box';
	}
	if (empty($list_title))
	{
		$list_title = $lang['Topics'];
	}
	if (!empty($select_values) && !is_array($select_values) )
	{
		$s_values = $select_values;
		$select_values = array();
		$select_values[] = $s_values;
	}

	// selections
	$select_multi = false;
	$select_unique = false;
	if (!empty($select_field) && ($select_type > 0) && !empty($select_formname) )
	{
		switch ($select_type)
		{
			case 1:
				$select_multi = true;
				break;
			case 2:
				$select_unique = true;
				break;
		}
	}

	// get split params
	$switch_split_global_announce = (isset($board_config['split_global_announce']) && isset($lang['Post_Global_Announcement'])) ? intval($board_config['split_global_announce']) : false;
	$switch_split_announce = isset($board_config['split_announce']) ? intval($board_config['split_announce']) : false;
	$switch_split_sticky = isset($board_config['split_sticky']) ? intval($board_config['split_sticky']) : false;

	// set in separate table
	$split_box = $inbox && (isset($board_config['split_topic_split']) ? intval($board_config['split_topic_split']) : false);

	// take care of the context
	if (!$split_type)
	{
		$split_box = false;
		$switch_split_global_announce = false;
		$switch_split_announce = false;
		$switch_split_sticky = false;
	}

	if (!$switch_split_global_announce && !$switch_split_announce && !$switch_split_sticky)
	{
		$split_type = false;
		$split_box = false;
	}

	// Define censored word matches
	$orig_word = array();
	$replacement_word = array();
	obtain_word_list($orig_word, $replacement_word);

	// read the user cookie
	$tracking_topics	= ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . "_t"]) : array();
	$tracking_forums	= ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . "_f"]) : array();
	$tracking_all		= ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f_all']) ) ? intval($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f_all']) : NULL;

	// categories hierarchy v 2 compliancy
	$cat_hierarchy = function_exists(get_auth_keys);
	if (!$cat_hierarchy)
	{
		// standard read
		$is_auth = array();
		$is_auth = auth(AUTH_ALL, AUTH_LIST_ALL, $userdata);
	}

	// topic icon present
	$icon_installed = function_exists(get_icon_title);

	// get a default title
	if (empty($list_title))
	{
		$list_title = $lang['forum'];
	}

	// choose template
	$template->set_filenames(array($tpl => $tpl . '.tpl'));

	// check if user replied to the topics
	$user_topics = array();
	if ($userdata['user_id'] != ANONYMOUS)
	{
		// get all the topic ids to display
		$topic_ids = array();
		for ($i = 0; $i < count($topic_rowset); $i++)
		{
			$topic_item_type	= substr($topic_rowset[$i]['topic_id'], 0, 1);
			$topic_id			= intval(substr($topic_rowset[$i]['topic_id'], 1));
			if ( $topic_item_type == POST_TOPIC_URL )
			{
				$topic_ids[] = $topic_id;
			}
		}
		// check if the user replied to
		if (!empty($topic_ids))
		{
			// check the posts
			$s_topic_ids = implode(', ', $topic_ids);
			$sql = 'SELECT DISTINCT topic_id FROM ' . POSTS_TABLE . ' 
					WHERE topic_id IN (' . $s_topic_ids . ')
						AND poster_id = ' . $userdata['user_id'];
			if ( !($result = $db->sql_query($sql)) )
			{
			   message_die(GENERAL_ERROR, 'Could not obtain post information', '', __LINE__, __FILE__, $sql);
			}
			while ($row = $db->sql_fetchrow($result))
			{
				$user_topics[POST_TOPIC_URL . $row['topic_id']] = true;
			}
		}
	}

	// initiate
	$template->assign_block_vars($tpl, array(
		'FORMNAME'		=> $select_formname,
		'FIELDNAME'		=> $select_field,
	));

	// spanning of the first column (list name)
	$span_left = 1;
	if ( count($topic_rowset) > 0 )
	{
		// add folder image
		$span_left++;
	}
	if ( $icon_installed )
	{
		// add topic icon
		$span_left++;
	}
	if ( $select_unique )
	{
		// selection in front is asked
		$span_left++;
	}
	// spanning of the whole line (bottom row and/or empty list)

//-- mod : first topic date ----------------------------------------------------
//-- delete
/*-MOD
	$span_all = $span_left + 4;
MOD-*/
//-- add
	$span_all = $span_left + 5;
//-- fin mod : first topic date ------------------------------------------------

	if ( $select_multi && (count($topic_rowset) >0) )
	{
		$span_all++;
	}

	// display topics
	$color = false;
	$prec_topic_type = '';
	$header_sent = false;
	if (!isset($box_id)) $box_id = -1;
	for ($i=0; $i < count($topic_rowset); $i++)
	{
		$topic_item_type	= substr($topic_rowset[$i]['topic_id'], 0, 1);
		$topic_id			= intval(substr($topic_rowset[$i]['topic_id'], 1));
		$topic_title		= ( count($orig_word) ) ? preg_replace($orig_word, $replacement_word, $topic_rowset[$i]['topic_title']) : $topic_rowset[$i]['topic_title'];

//-- mod : post description ----------------------------------------------------
//-- add
		$topic_sub_title = !empty($topic_rowset[$i]['topic_sub_title']) ? ( count($orig_word) ? preg_replace($orig_word, $replacement_word, $topic_rowset[$i]['topic_sub_title']) : $topic_rowset[$i]['topic_sub_title'] ) : '';
//-- fin mod : post description ------------------------------------------------

//-- mod : quick title edition -------------------------------------------------
//-- add
		colorize_title($topic_title, $topic_rowset[$i]['topic_attribute'], $topic_rowset[$i]['topic_attribute_position'], $topic_rowset[$i]['topic_attribute_color'], $topic_rowset[$i]['topic_attribute_username'], $topic_rowset[$i]['topic_attribute_date']);
//-- fin mod : quick title edition ---------------------------------------------

		$replies			= $topic_rowset[$i]['topic_replies'];
		$topic_type			= $topic_rowset[$i]['topic_type'];
		$user_replied		= ( !empty($user_topics) && isset($user_topics[$topic_rowset[$i]['topic_id']]) );
		$force_type_display	= false;
		$forum_id			= $topic_rowset[$i]['forum_id'];

		if( $topic_type == POST_GLOBAL_ANNOUNCE && !$board_config['split_global_announce'] )
		{
			$topic_type = $lang['Topic_Global_Announcement'] . ' ';
		}
		else if( $topic_type == POST_ANNOUNCE && !$board_config['split_announce'] )
		{
			$topic_type = $lang['Topic_Announcement'] . ' ';
		}
		else if( $topic_type == POST_STICKY && !$board_config['split_sticky'] )
		{
			$topic_type = $lang['Topic_Sticky'] . ' ';
		}
		else
		{
			$topic_type = '';		
		}

		if( $topic_rowset[$i]['topic_vote'] )
		{
//-- mod : inspired of categories hierarchy ------------------------------------
//-- delete
/*-MOD
			$topic_type .= $lang['Topic_Poll'] . ' ';
MOD-*/
//-- add
			$topic_type .= '<img src="' . $images['Topic_Poll'] . '" border="0" alt="' . $lang['Topic_Poll'] . '" title="' . $lang['Topic_Poll'] . '" />' . ' ';
//-- fin mod : inspired of categories hierarchy --------------------------------
			$force_type_display = true;
		}

		if( $topic_rowset[$i]['topic_status'] == TOPIC_MOVED )
		{
			$topic_type = $lang['Topic_Moved'] . ' ';
			$topic_id = $topic_rowset[$i]['topic_moved_id'];
			$folder_image =  $images['folder'];
			$folder_alt = $lang['Topics_Moved'];
			$newest_post_img = '';
			$force_type_display = true;
		}
		else
		{
			if( $topic_rowset[$i]['topic_type'] == POST_GLOBAL_ANNOUNCE )
			{
				$folder = ($user_replied && defined('USER_REPLIED_ICON')) ? $images['folder_global_announce_own'] : $images['folder_global_announce'];
				$folder_new = ($user_replied && defined('USER_REPLIED_ICON')) ? $images['folder_global_announce_new_own'] : $images['folder_global_announce_new'];
			}
			else if( $topic_rowset[$i]['topic_type'] == POST_ANNOUNCE )
			{
				$folder = ($user_replied && defined('USER_REPLIED_ICON')) ? $images['folder_announce_own'] : $images['folder_announce'];
				$folder_new = ($user_replied && defined('USER_REPLIED_ICON')) ? $images['folder_announce_new_own'] : $images['folder_announce_new'];
			}
			else if( $topic_rowset[$i]['topic_type'] == POST_STICKY )
			{
				$folder = ($user_replied && defined('USER_REPLIED_ICON')) ? $images['folder_sticky_own'] : $images['folder_sticky'];
				$folder_new = ($user_replied && defined('USER_REPLIED_ICON')) ? $images['folder_sticky_new_own'] : $images['folder_sticky_new'];
			}
			else if( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED )
			{
				$folder = ($user_replied && defined('USER_REPLIED_ICON')) ? $images['folder_locked_own'] : $images['folder_locked'];
				$folder_new = ($user_replied && defined('USER_REPLIED_ICON')) ? $images['folder_locked_new_own'] : $images['folder_locked_new'];
			}
			else
			{
				if($replies >= $board_config['hot_threshold'])
				{
					$folder = ($user_replied && defined('USER_REPLIED_ICON')) ? $images['folder_hot_own'] : $images['folder_hot'];
					$folder_new = ($user_replied && defined('USER_REPLIED_ICON')) ? $images['folder_hot_new_own'] : $images['folder_hot_new'];
				}
				else
				{
					$folder = ($user_replied && defined('USER_REPLIED_ICON')) ? $images['folder_own'] : $images['folder'];
					$folder_new = ($user_replied && defined('USER_REPLIED_ICON')) ? $images['folder_new_own'] : $images['folder_new'];
				}
			}

//-- mod : keep unread flags ---------------------------------------------------
//-- delete
/*-MOD
			$newest_post_img = '';
			if ( $userdata['session_logged_in'] && ($topic_item_type == POST_TOPIC_URL) )
			{
				if( $topic_rowset[$i]['post_time'] > $userdata['user_lastvisit'] ) 
				{
					if( !empty($tracking_topics) || !empty($tracking_forums) || !empty($tracking_all) )
					{
						$unread_topics = true;
						if( !empty($tracking_topics[$topic_id]) )
						{
							if( $tracking_topics[$topic_id] >= $topic_rowset[$i]['post_time'] )
							{
								$unread_topics = false;
							}
						}
						if( !empty($tracking_forums[$forum_id]) )
						{
							if( $tracking_forums[$forum_id] >= $topic_rowset[$i]['post_time'] )
							{
								$unread_topics = false;
							}
						}
						if( !empty($tracking_all) )
						{
							if( $tracking_all >= $topic_rowset[$i]['post_time'] )
							{
								$unread_topics = false;
							}
						}
						if ( $unread_topics )
						{
							$folder_image = $folder_new;
							$folder_alt = $lang['New_posts'];
							$newest_post_img = '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;view=newest") . '"><img src="' . $images['icon_newest_reply'] . '" alt="' . $lang['View_newest_post'] . '" title="' . $lang['View_newest_post'] . '" border="0" /></a> ';
						}
						else
						{
							$folder_image = $folder;
							$folder_alt = ( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['No_new_posts'];
							$newest_post_img = '';
						}
					}
					else
					{
						$folder_image = $folder_new;
						$folder_alt = ( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['New_posts'];
						$newest_post_img = '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;view=newest") . '"><img src="' . $images['icon_newest_reply'] . '" alt="' . $lang['View_newest_post'] . '" title="' . $lang['View_newest_post'] . '" border="0" /></a> ';
					}
				}
				else 
				{
					$folder_image = $folder;
					$folder_alt = ( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['No_new_posts'];
					$newest_post_img = '';
				}
			}
			else
			{
				$folder_image = $folder;
				$folder_alt = ( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['No_new_posts'];
				$newest_post_img = '';
			}
MOD-*/
//-- add
			if( $topic_rowset[$i]['post_time'] > topic_last_read($forum_id, $topic_id) )
			{
				$folder_image = $folder_new;
				$folder_alt = $lang['New_posts'];     
				$newest_post_img = '<a href="' . append_sid('viewtopic.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;view=newest') . '"><img src="' . $images['icon_newest_reply'] . '" alt="' . $lang['View_newest_post'] . '" title="' . $lang['View_newest_post'] . '" border="0" /></a> '; 
			}
			else
			{
				$folder_image = $folder;
				$folder_alt = ( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['No_new_posts'];
				$newest_post_img = '';
			}
//-- fin mod : keep unread flags -----------------------------------------------
		}

		// generate list of page for the topic
		$goto_page = '';
		if( ( $replies + 1 ) > $board_config['posts_per_page'] )
		{
			$total_pages = ceil( ( $replies + 1 ) / $board_config['posts_per_page'] );
			$goto_page = ' [ <img src="' . $images['icon_gotopost'] . '" alt="' . $lang['Goto_page'] . '" title="' . $lang['Goto_page'] . '" />' . $lang['Goto_page'] . ': ';
			$times = 1;
			for($j = 0; $j < $replies + 1; $j += $board_config['posts_per_page'])
			{
				$goto_page .= '<a href="' . append_sid('viewtopic.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;start=' . $j) . '">' . $times . '</a>';
				if( $times == 1 && $total_pages > 4 )
				{
					$goto_page .= ' ... ';
					$times = $total_pages - 3;
					$j += ( $total_pages - 4 ) * $board_config['posts_per_page'];
				}
				else if ( $times < $total_pages )
				{
					$goto_page .= ', ';
				}
				$times++;
			}
			$goto_page .= ' ] ';
		}

		$topic_author = '';
		$first_post_time = '';
		$last_post_time = '';
		$last_post_url = '';
		$views = '';
		switch ($topic_item_type)
		{
			case POST_USERS_URL:
				$view_topic_url		= append_sid('profile.' . $phpEx . '?' . POST_USERS_URL . '=' . $topic_id);
				break;
			default:
				$view_topic_url		= append_sid('viewtopic.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id);

//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
				$topic_author		= ( $topic_rowset[$i]['user_id'] != ANONYMOUS ) ? '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $topic_rowset[$i]['user_id']) . '">' : '';
MOD-*/
//-- add
				$topic_author_color = $rcs->get_colors($topic_rowset[$i]);
				$topic_author 		= ($topic_rowset[$i]['user_id'] != ANONYMOUS) ? '<a href="' . $get->url('profile', array('mode' => 'viewprofile', POST_USERS_URL => $topic_rowset[$i]['user_id']), true) . '" title="' . $lang['Read_profile'] . '" ' . $topic_author_color . '>' : '';
//-- fin mod : rank color system -----------------------------------------------

				$topic_author		.= ( $topic_rowset[$i]['user_id'] != ANONYMOUS ) ? $topic_rowset[$i]['username'] : ( ( $topic_rowset[$i]['post_username'] != '' ) ? $topic_rowset[$i]['post_username'] : $lang['Guest'] );
				$topic_author		.= ( $topic_rowset[$i]['user_id'] != ANONYMOUS ) ? '</a>' : '';
				$first_post_time	= create_date($board_config['default_dateformat'], $topic_rowset[$i]['topic_time'], $board_config['board_timezone']);
				$last_post_time		= create_date($board_config['default_dateformat'], $topic_rowset[$i]['post_time'], $board_config['board_timezone']);

//-- mod : ip country flag -----------------------------------------------------
//-- add
				$topic_author_ipcf = $topic_rowset[$i]['user_cf_iso3661_1'];
				$lastpost_iso3661_1 = $topic_rowset[$i]['user2flag'];
//-- fin mod : ip country flag -------------------------------------------------

//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
				$last_post_author	= ( $topic_rowset[$i]['id2'] == ANONYMOUS ) ? ( ($topic_rowset[$i]['post_username2'] != '' ) ? $topic_rowset[$i]['post_username2'] . ' ' : $lang['Guest'] . ' ' ) : '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $topic_rowset[$i]['id2']) . '">' . $topic_rowset[$i]['user2'] . '</a>';
MOD-*/
//-- add
				$last_post_author_color = $rcs->get_colors($topic_rowset[$i], '', false, 'group_id2', 'color2', 'level2');
				$last_post_author 	= ($topic_rowset[$i]['id2'] == ANONYMOUS) ? (($topic_rowset[$i]['post_username2'] != '') ? $topic_rowset[$i]['post_username2'] : $lang['Guest']) : '<a href="' . $get->url('profile', array('mode' => 'viewprofile', POST_USERS_URL => $topic_rowset[$i]['id2']), true) . '" title="' . $lang['Read_profile'] . '" ' . $last_post_author_color . '>' . $topic_rowset[$i]['user2'] . '</a>';
//-- fin mod : rank color system -----------------------------------------------

				$last_post_url		= '<a href="' . append_sid('viewtopic.' . $phpEx . '?'  . POST_POST_URL . '=' . $topic_rowset[$i]['topic_last_post_id']) . '#' . $topic_rowset[$i]['topic_last_post_id'] . '"><img src="' . $images['icon_latest_reply'] . '" alt="' . $lang['View_latest_post'] . '" title="' . $lang['View_latest_post'] . '" border="0" /></a>';
				$views				= $topic_rowset[$i]['topic_views'];
				break;
		}

		// categories hierarchy v 2 compliancy
		$nav_tree = '';
		if ( $display_nav_tree && !empty($topic_rowset[$i]['forum_id']) )
		{
			if ($cat_hierarchy)
			{
				if ($tree['auth'][POST_FORUM_URL . $topic_rowset[$i]['forum_id']]['tree.auth_view'])
				{
					$nav_tree = make_cat_nav_tree(POST_FORUM_URL . $topic_rowset[$i]['forum_id'], '', 'gensmall');
				}
			}
			else
			{
				if ($is_auth[ $topic_rowset[$i]['forum_id'] ]['auth_view'])
				{
					$nav_tree = '<a href="' . append_sid('viewforum.' . $phpEx . '?f=' . $topic_rowset[$i]['forum_id']) . '" class="gensmall">' . $topic_rowset[$i]['forum_name'] . '</a>';
				}
			}
		}
		if (!empty($nav_tree))
		{
			$nav_tree = '[ ' . $nav_tree . ' ]';
		}

		// get the type for rupture
		$topic_real_type = $topic_rowset[$i]['topic_type'];

		// if no split between global and standard announcement, group them with standard announcement
		if ( !$switch_split_global_announce && ($topic_real_type == POST_GLOBAL_ANNOUNCE) ) $topic_real_type = POST_ANNOUNCE;

		// if no split between announce and sticky, group them with sticky
		if ( !$switch_split_announce && ($topic_real_type == POST_ANNOUNCE) ) $topic_real_type = POST_STICKY;

		// if no split between sticky and normal, group them with normal
		if ( !$switch_split_sticky && ($topic_real_type == POST_STICKY) ) $topic_real_type = POST_NORMAL;

		// check if rupture
		$rupt = false;

		// split
		if ( ($i == 0) || $split_type )
		{
			if ($i == 0)
			{
				$rupt = true;
			}

			// check the rupt
			if ($prec_topic_type != $topic_real_type)
			{
				$rupt = true;
			}
		}
		$prec_topic_type = $topic_real_type;

		// header
		if ($rupt)
		{
			// close the prec box
			if ($split_box && ($i != 0))
			{
				// footer
				$template->assign_block_vars($tpl . '.row', array(
					'COLSPAN'		=> $span_all,
				));

				// table closure
				$template->assign_block_vars($tpl . '.row.footer_table', array());

				// spacing
				$template->assign_block_vars($tpl . '.row', array());
				$template->assign_block_vars($tpl . '.row.spacer', array());

				// unset header
				$header_sent = false;
			}

			// get box title
			$main_title = $list_title;
			$sub_title = $list_title;
			switch ($topic_real_type)
			{
				case POST_GLOBAL_ANNOUNCE:
					$sub_title = $lang['Post_Global_Announcement'];
					break;
				case POST_ANNOUNCE:
					$sub_title = $lang['Post_Announcement'];
					break;
				case POST_STICKY:
					$sub_title = $lang['Post_Sticky'];
					break;
				case POST_NORMAL:
					$sub_title = $lang['Topics'];
					break;
			}

			$template->assign_block_vars($tpl . '.row', array(
				'L_TITLE'		=> (!$split_box) ? $main_title : $sub_title,
				'L_REPLIES'		=> $lang['Replies'],
				'L_AUTHOR'		=> $lang['Author'],

//-- mod : first topic date ----------------------------------------------------
//-- add
				'L_CREATE_DATE'		=> $lang['Create_Date'],
//-- fin mod : first topic date ------------------------------------------------

				'L_VIEWS'		=> $lang['Views'],
				'L_LASTPOST'	=> $lang['Last_Post'],
				'COLSPAN'		=> $span_all,
			));

			// open a new box
			if ($split_box || ($i == 0))
			{
				$box_id++;
				$template->assign_block_vars($tpl . '.row.header_table', array(
					'COLSPAN'		=> $span_left,
					'BOX_ID'		=> $box_id,
				));

				// selection fields
				if ($select_multi)
				{
					$template->assign_block_vars($tpl . '.row.header_table.multi_selection', array());
				}

				// set header
				$header_sent = true;
			}

			// not in box, send a row title
			if ($split_type && !$split_box)
			{
				$template->assign_block_vars($tpl . '.row', array(
					'L_TITLE'		=> $sub_title,
					'COLSPAN'		=> $span_all,
				));
				$template->assign_block_vars($tpl . '.row.header_row', array());
			}
		}

		// erase the type before the title if split
		if ( $split_type && ($topic_real_type == $topic_rowset[$i]['topic_type']) && !$force_type_display)
		{
			$topic_type = '';
		}

		// get the announces dates
		$topic_announces_dates = '';
		if (function_exists(get_announces_title) && in_array( $topic_rowset[$i]['topic_type'], array(POST_ANNOUNCE, POST_GLOBAL_ANNOUNCE)))
		{
			$topic_announces_dates = get_announces_title($topic_rowset[$i]['topic_time'], $topic_rowset[$i]['topic_announce_duration']);
		}

		// get the calendar dates
		$topic_calendar_dates = '';
		if (function_exists(get_calendar_title))
		{
			$topic_calendar_dates = get_calendar_title($topic_rowset[$i]['topic_calendar_time'], $topic_rowset[$i]['topic_calendar_duration']);
		}

		// get the topic icons
		$icon = '';
		if ($icon_installed)
		{
			$type = $topic_rowset[$i]['topic_type'];
			if ($type == POST_NORMAL)
			{
			}
			$icon = get_icon_title($topic_rowset[$i]['topic_icon'], 1, $type);
		}

		// send topic to template
		$selected = (!empty($select_values) && in_array($topic_rowset[$i]['topic_id'], $select_values));
		$color = !$color;
		$template->assign_block_vars( $tpl . '.row', array(
			'ROW_CLASS'				=> ($color || !defined('TOPIC_ALTERNATE_ROW_CLASS')) ? 'row1' : 'row2',
			'ROW_FOLDER_CLASS'		=> ($user_replied && defined('USER_REPLIED_CLASS')) ? USER_REPLIED_CLASS : ( ($color || !defined('TOPIC_ALTERNATE_ROW_CLASS')) ? 'row1' : 'row2' ),
			'FORUM_ID'				=> $forum_id,
			'TOPIC_ID'				=> $topic_id,
			'TOPIC_FOLDER_IMG'		=> $folder_image,

//-- mod : hypercell class -----------------------------------------------------
//-- add
			'HYPERCELL_CLASS' => get_hypercell_class($topic_rowset[$i]['topic_status'], ($folder_image == $folder_new), $topic_rowset[$i]['topic_type'], $replies),
//-- fin mod : hypercell class -------------------------------------------------

			'TOPIC_AUTHOR'			=> $topic_author,
			'GOTO_PAGE'				=> !empty($goto_page) ? '<br />' . $goto_page : '',

//-- mod : annonce globale -----------------------------------------------------
//-- add
			'GLOBAL_LINK' => $global_link,
//-- fin mod : annonce globale -------------------------------------------------

//-- mod : ip country flag -----------------------------------------------------
//-- add
			'TOPIC_AUTHOR_FLAG' => $topic_author_ipcf, 
			'TOPIC_AUTHOR_FLAG_ALT' => $lang['IP2Country'][$topic_author_ipcf],
			'IP_CF_LAST_POST' => $lastpost_iso3661_1,
			'IP_CF_LAST_POST_ALT' => $lang['IP2Country'][$lastpost_iso3661_1],
//-- fin mod : ip country flag -------------------------------------------------

//-- mod : annonce globale -----------------------------------------------------
//-- add
			'GLOBAL_LINK' => $global_link,
//-- fin mod : annonce globale -------------------------------------------------

			'TOPIC_NAV_TREE'		=> !empty($nav_tree) ? (empty($goto_page) ? '<br />' : '') . $nav_tree : '',
			'REPLIES'				=> $replies,
			'NEWEST_POST_IMG'		=> $newest_post_img,

//-- mod : attachment mod ------------------------------------------------------
//-- add
			'TOPIC_ATTACHMENT_IMG' => topic_attachment_image($topic_rowset[$i]['topic_attachment']),
//-- fin mod : attachment mod --------------------------------------------------

			'ICON'					=> $icon,
			'TOPIC_TITLE'			=> $topic_title,
			'TOPIC_ANNOUNCES_DATES'	=> $topic_announces_dates,
			'TOPIC_CALENDAR_DATES'	=> $topic_calendar_dates,
			'TOPIC_TYPE'			=> $topic_type,
			'VIEWS'					=> $views,
			'FIRST_POST_TIME'		=> $first_post_time,
			'LAST_POST_TIME'		=> $last_post_time,
			'LAST_POST_AUTHOR'		=> $last_post_author,
			'LAST_POST_IMG'			=> $last_post_url,
			'L_TOPIC_FOLDER_ALT'	=> $folder_alt,
			'U_VIEW_TOPIC'			=> $view_topic_url,
			'BOX_ID'				=> $box_id,
			'FID'					=> $topic_rowset[$i]['topic_id'],
			'L_SELECT'				=> ($selected && ($select_multi || $select_unique)) ? 'checked="checked"' : '',
		));
		$template->assign_block_vars( $tpl . '.row.topic', array());

//-- mod : post description ----------------------------------------------------
//-- add
		display_sub_title($tpl . '.row.topic', $topic_sub_title, $board_config['sub_title_length']);
//-- fin mod : post description ------------------------------------------------

		// selection fields
		if ($select_multi)
		{
			$template->assign_block_vars($tpl . '.row.topic.multi_selection', array());
		}
		if ($select_unique)
		{
			$template->assign_block_vars($tpl . '.row.topic.single_selection', array());
		}

		// icons
		if ($icon_installed)
		{
			$template->assign_block_vars( $tpl . '.row.topic.icon', array());
		}

		// nav tree asked
		if ($display_nav_tree && !empty($nav_tree))
		{
			$template->assign_block_vars( $tpl . '.row.topic.nav_tree', array());
		}
	} // end for topic_rowset read

	// send an header if missing
	if (!$header_sent)
	{
		$template->assign_block_vars($tpl . '.row', array(
			'L_TITLE'		=> $list_title,
			'L_REPLIES'		=> $lang['Replies'],
			'L_AUTHOR'		=> $lang['Author'],

//-- mod : first topic date ----------------------------------------------------
//-- add
			'L_CREATE_DATE'		=> $lang['Create_Date'],
//-- fin mod : first topic date ------------------------------------------------

			'L_VIEWS'		=> $lang['Views'],
			'L_LASTPOST'	=> $lang['Last_Post'],
			'COLSPAN'		=> $span_all,
		));

		// open a new box
		$template->assign_block_vars($tpl . '.row.header_table', array(
			'COLSPAN'		=> $span_left,
		));
	}

	// no data
	if (count($topic_rowset) == 0)
	{
		// send no topics notice
		$template->assign_block_vars( $tpl . '.row', array(
			'L_NO_TOPICS'	=> $lang['No_search_match'],
			'COLSPAN'		=> $span_all,
		));
		$template->assign_block_vars( $tpl . '.row.no_topics', array());
	}

	// bottom line
	if (!empty($footer))
	{
		$template->assign_block_vars( $tpl . '.row', array(
			'COLSPAN'		=> $span_all,
			'FOOTER'		=> $footer,
		));
		$template->assign_block_vars( $tpl . '.row.bottom', array());
	}

	// table closure
	$template->assign_block_vars( $tpl . '.row', array(
		'COLSPAN'		=> $span_all,
	));
	$template->assign_block_vars( $tpl . '.row.footer_table', array());

	// spacing
	if (empty($footer))
	{
		// spacing
		$template->assign_block_vars($tpl . '.row', array());
		$template->assign_block_vars($tpl . '.row.spacer', array());
	}

	// transfert to a var
	$template->assign_var_from_handle('_box', $tpl);
	$res = $template->_tpldata['.'][0]['_box'];

	// restore template saved state
	$template->_tpldata = $sav_tpl;

	// assign value to the main template
	$template->assign_vars(array($box => $res));
}

?>
