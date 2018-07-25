<?php

/**
*
* @version $Id: admin_overall_forumauth.php,v 1.0.9 2006/10/31 17:28:38 ABDev Exp $
* @copyright (c) 2006 ABDev
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* Original author : Smartor, 2002
* Original author : Sjpphpbb, 2005
*/

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);

//-- mod : oxygen premod -------------------------------------------------------
//-- delete
/*-MOD
	$module['Forums']['Overall_Permissions'] = $filename . '?' . POST_FORUM_URL . '=' . $forum_id;
MOD-*/
//-- add
	$module['Forums']['Permissions'] = $filename;
//-- fin mod : oxygen premod ---------------------------------------------------

	return;
}

//
// Load default header
//
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

//
// Start program - define vars
//
//-- mod : annonce globale -----------------------------------------------------
// here we added for each row a new column for global announcement filled with auth_admin
// and add Global Ann in the comment header
//-- modify
//                View      Read      Post      Reply     Edit     Delete    Sticky   Announce Global Ann   Vote      Poll
$simple_auth_ary = array(
	0  => array(AUTH_ALL, AUTH_ALL, AUTH_ALL, AUTH_ALL, AUTH_REG, AUTH_REG, AUTH_MOD, AUTH_MOD, AUTH_ADMIN, AUTH_REG, AUTH_REG),
	1  => array(AUTH_ALL, AUTH_ALL, AUTH_REG, AUTH_REG, AUTH_REG, AUTH_REG, AUTH_MOD, AUTH_MOD, AUTH_ADMIN, AUTH_REG, AUTH_REG),
	2  => array(AUTH_REG, AUTH_REG, AUTH_REG, AUTH_REG, AUTH_REG, AUTH_REG, AUTH_MOD, AUTH_MOD, AUTH_ADMIN, AUTH_REG, AUTH_REG),
	3  => array(AUTH_ALL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_MOD, AUTH_ADMIN, AUTH_ACL, AUTH_ACL),
	4  => array(AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_MOD, AUTH_ADMIN, AUTH_ACL, AUTH_ACL),
	5  => array(AUTH_ALL, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_ADMIN, AUTH_MOD, AUTH_MOD),
	6  => array(AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_ADMIN, AUTH_MOD, AUTH_MOD),
);
//-- fin mod : annonce globale -------------------------------------------------

$simple_auth_types = array($lang['Public'], $lang['Registered'], $lang['Registered'] . ' [' . $lang['Hidden'] . ']', $lang['Private'], $lang['Private'] . ' [' . $lang['Hidden'] . ']', $lang['Moderators'], $lang['Moderators'] . ' [' . $lang['Hidden'] . ']');

//-- mod : announces suite -----------------------------------------------------
// here we added
//	, 'auth_global_announce'
//-- modify
//-- mod : attachment mod ------------------------------------------------------
// here we added
//	, 'auth_attachments', 'auth_download'
//-- modify
//-- mod : bump topic ----------------------------------------------------------
// here we added
//	, 'auth_bump'
//-- modify
$forum_auth_fields = array('auth_view', 'auth_read', 'auth_post', 'auth_reply', 'auth_edit', 'auth_bump', 'auth_delete', 'auth_sticky', 'auth_announce', 'auth_global_announce', 'auth_vote', 'auth_pollcreate', 'auth_attachments', 'auth_download');
//-- fin mod : bump topic ------------------------------------------------------
//-- fin mod : attachment mod --------------------------------------------------
//-- fin mod : announces suite -------------------------------------------------

$forum_auth_levels = array('ALL', 'REG', 'PRIVATE', 'MOD', 'ADMIN');

$forum_auth_const = array(AUTH_ALL, AUTH_REG, AUTH_ACL, AUTH_MOD, AUTH_ADMIN);

$forum_auth_images = array(
	AUTH_ALL => 'ALL',
	AUTH_REG => 'REG',
	AUTH_ACL => 'PRIVATE',
	AUTH_MOD => 'MOD',
	AUTH_ADMIN => 'ADMIN',
);

$forum_auth_cats = array(
	'VIEW' => 'auth_view',
	'READ' => 'auth_read',
	'POST' => 'auth_post',
	'REPLY' => 'auth_reply',
	'EDIT' => 'auth_edit',
//-- mod : bump topic ----------------------------------------------------------
//-- add
	'BUMP' => 'auth_bump',
//-- fin mod : bump topic ------------------------------------------------------
	'DELETE' => 'auth_delete',
	'STICKY' => 'auth_sticky',
	'ANNOUNCE' => 'auth_announce',
//-- mod : announces suite -----------------------------------------------------
//-- add
	'GLOBAL_ANNOUNCE' => 'auth_global_announce',
//-- fin mod : announces suite -------------------------------------------------
	'VOTE' => 'auth_vote',
	'POLLCREATE' => 'auth_pollcreate',
//-- mod : attachment mod ------------------------------------------------------
//-- add
	'AUTH_DOWNLOAD' => 'auth_download',
	'AUTH_ATTACH' => 'auth_attachments',
//-- fin mod : attachment mod --------------------------------------------------
);

for($i=0; $i<count($forum_auth_const); $i++) {
	$auth_key .= '<img src="/images/spacer.gif" width=10 height=10 class="' . $forum_auth_classes[$forum_auth_const[$i]] . '">&nbsp;' . $forum_auth_levels[$i] . '&nbsp;&nbsp;';
	$template->assign_block_vars('authedit',	array(
		'CLASS' => $forum_auth_classes[$forum_auth_const[$i]],
		'NAME' => $forum_auth_levels[$i],
		'VALUE' => $forum_auth_const[$i],
	));
}

if( isset($HTTP_GET_VARS['adv']) )
{
	$adv = intval($HTTP_GET_VARS['adv']);
}
else
{
	unset($adv);
}

$template->set_filenames(array('body' => 'admin/auth_overall_forum_body.tpl'));

//
// Start program proper
//
if( isset($HTTP_POST_VARS['submit']) )
{
	foreach($_POST['auth'] as $forum_id => $forum)
  {
		$forum_id = intval($forum_id);
		$sql = '';
		foreach($forum as $a => $newval)
    {
			if ($newval && in_array($newval, $forum_auth_levels) && array_key_exists($a, $forum_auth_cats))
      {
				$sql .= ( ( $sql != '' ) ? ', ' : '' ) . $forum_auth_cats[$a] . '=' . array_search($newval, $forum_auth_images);
			}
		}

		if (!empty($sql))
    {
			$sql = 'UPDATE ' . FORUMS_TABLE . ' SET ' . $sql . ' WHERE forum_id = ' . $forum_id;
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update auth table', '', __LINE__, __FILE__, $sql);
			}
		}
	}
} // End of submit

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
			'CAT_ID' => $cat_id,
			'CAT_DESC' => $category_rows[$i]['cat_title'],
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
			if ($forum_rows[$j]['cat_id'] == $cat_id && $forum_rows[$j]['forum_parent'] == 0)
//-- fin mod : simple subforums ------------------------------------------------
			{
				$template->assign_block_vars('catrow.forumrow',	array(
					'FORUM_NAME' => $forum_rows[$j]['forum_name'],
//-- mod : colorize forumtitle -------------------------------------------------
//-- add
					'FORUM_COLOR' => (!empty($forum_rows[$j]['forum_color'])) ? 'style="color: #' . $forum_rows[$j]['forum_color'] . '"' : '',
//-- fin mod : colorize forumtitle ---------------------------------------------
					'FORUM_ID' => $forum_rows[$j]['forum_id'],
					'ROW_COLOR' => $row_color,
					'AUTH_VIEW_IMG' => $forum_auth_images[$forum_rows[$j]['auth_view']],
					'AUTH_READ_IMG' => $forum_auth_images[$forum_rows[$j]['auth_read']],
					'AUTH_POST_IMG' => $forum_auth_images[$forum_rows[$j]['auth_post']],
					'AUTH_REPLY_IMG' => $forum_auth_images[$forum_rows[$j]['auth_reply']],
					'AUTH_EDIT_IMG' => $forum_auth_images[$forum_rows[$j]['auth_edit']],
//-- mod : bump topic ----------------------------------------------------------
//-- add
					'AUTH_BUMP_IMG' => $forum_auth_images[$forum_rows[$j]['auth_bump']],
//-- fin mod : bump topic ------------------------------------------------------
					'AUTH_DELETE_IMG' => $forum_auth_images[$forum_rows[$j]['auth_delete']],
					'AUTH_STICKY_IMG' => $forum_auth_images[$forum_rows[$j]['auth_sticky']],
					'AUTH_ANNOUNCE_IMG' => $forum_auth_images[$forum_rows[$j]['auth_announce']],
//-- mod : announces suite -----------------------------------------------------
//-- add
					'AUTH_GLOBAL_ANNOUNCE_IMG' => $forum_auth_images[$forum_rows[$j]['auth_global_announce']],
//-- fin mod : announces suite -------------------------------------------------
					'AUTH_VOTE_IMG' => $forum_auth_images[$forum_rows[$j]['auth_vote']],
					'AUTH_POLLCREATE_IMG' => $forum_auth_images[$forum_rows[$j]['auth_pollcreate']],
//-- mod : attachment mod ------------------------------------------------------
//-- add
					'AUTH_ATTACH_IMG' => $forum_auth_images[$forum_rows[$j]['auth_attachments']],
					'AUTH_DOWNLOAD_IMG' => $forum_auth_images[$forum_rows[$j]['auth_download']],
//-- fin mod : attachment mod --------------------------------------------------
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
//-- mod : colorize forumtitle -------------------------------------------------
//-- add
							'FORUM_COLOR' => (!empty($forum_rows[$k]['forum_color'])) ? 'style="color: #' . $forum_rows[$k]['forum_color'] . '"' : '',
//-- fin mod : colorize forumtitle ---------------------------------------------
							'FORUM_ID' => $forum_rows[$k]['forum_id'],
							'ROW_COLOR' => $row_color,
							'STYLE' => ' style="padding-left: 20px;" ',	
							'AUTH_VIEW_IMG' => $forum_auth_images[$forum_rows[$k]['auth_view']],
							'AUTH_READ_IMG' => $forum_auth_images[$forum_rows[$k]['auth_read']],
							'AUTH_POST_IMG' => $forum_auth_images[$forum_rows[$k]['auth_post']],
							'AUTH_REPLY_IMG' => $forum_auth_images[$forum_rows[$k]['auth_reply']],
							'AUTH_EDIT_IMG' => $forum_auth_images[$forum_rows[$k]['auth_edit']],
//-- mod : bump topic ----------------------------------------------------------
//-- add
							'AUTH_BUMP_IMG' => $forum_auth_images[$forum_rows[$k]['auth_bump']],
//-- fin mod : bump topic ------------------------------------------------------
							'AUTH_DELETE_IMG' => $forum_auth_images[$forum_rows[$k]['auth_delete']],
							'AUTH_STICKY_IMG' => $forum_auth_images[$forum_rows[$k]['auth_sticky']],
							'AUTH_ANNOUNCE_IMG' => $forum_auth_images[$forum_rows[$k]['auth_announce']],
//-- mod : announces suite -----------------------------------------------------
//-- add
							'AUTH_GLOBAL_ANNOUNCE_IMG' => $forum_auth_images[$forum_rows[$k]['auth_global_announce']],
//-- fin mod : announces suite -------------------------------------------------
							'AUTH_VOTE_IMG' => $forum_auth_images[$forum_rows[$k]['auth_vote']],
							'AUTH_POLLCREATE_IMG' => $forum_auth_images[$forum_rows[$k]['auth_pollcreate']],
//-- mod : attachment mod ------------------------------------------------------
//-- add
							'AUTH_ATTACH_IMG' => $forum_auth_images[$forum_rows[$k]['auth_attachments']],
							'AUTH_DOWNLOAD_IMG' => $forum_auth_images[$forum_rows[$k]['auth_download']],
//-- fin mod : attachment mod --------------------------------------------------
						));
					}
				}
//-- fin mod : simple subforums ------------------------------------------------
			}
		}
	}
}

$template->assign_vars(array(
	'L_FORUM_TITLE' => $lang['Auth_Control_Forum'],
	'L_FORUM_EXPLAIN' => $lang['Forum_auth_explain_overall'],
	'L_FORUM_EXPLAIN_EDIT' => $lang['Forum_auth_explain_overall_edit'],
	'L_FORUM_OVERALL_RESTORE' => $lang['Forum_auth_overall_restore'],
	'L_FORUM_OVERALL_STOP' => $lang['Forum_auth_overall_stop'],
	'L_SUBMIT' => $lang['Submit'],

	'L_VIEW' => $lang['View'],
	'L_READ' => $lang['Read'],
	'L_POST' => $lang['Post'],
	'L_REPLY' => $lang['Reply'],
	'L_EDIT' => $lang['Edit'],
//-- mod : bump topic ----------------------------------------------------------
//-- add
	'L_BUMP' => $lang['Bump'],
//-- fin mod : bump topic ------------------------------------------------------
	'L_DELETE' => $lang['Delete'],
	'L_STICKY' => $lang['Sticky'],
	'L_ANNOUNCE' => $lang['Announce'],
//-- mod : announces suite -----------------------------------------------------
//-- add
	'L_GLOBAL_ANNOUNCE' => $lang['Global_Announce'],
//-- fin mod : announces suite -------------------------------------------------
	'L_VOTE' => $lang['Vote'],
	'L_POLLCREATE' => $lang['Pollcreate'],
//-- mod : attachment mod ------------------------------------------------------
//-- add
	'L_ATTACH' => $lang['Auth_attach'],
	'L_DOWNLOAD' => $lang['Auth_download'],
//-- fin mod : attachment mod --------------------------------------------------
	'AUTH_KEY' => $auth_key,
));

$template->pparse('body');

include('./page_footer_admin.'.$phpEx);

?>
