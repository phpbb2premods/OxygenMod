<?php
/**
*
* @package bump_topic_mod [english]
* @version $Id: lang_extend_bump.php,v 1.0 12/08/2006 15:55 reddog Exp $
* @copyright (c) 2006 reddog - http://www.reddevboard.com/
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

// admin part
if ($lang_extend_admin)
{
	$lang['Bump'] = 'Bump';

	$lang['bt_minutes'] = 'minutes';
	$lang['bt_hours'] = 'hours';
	$lang['bt_days'] = 'days';

	$lang['bump_interval'] = 'Bump Interval';
	$lang['bump_interval_explain'] = 'Number of minutes, hours or days between the last post to a topic and the ability to bump this topic.';
	$lang['reply_flood_ctrl'] = 'Flood control on reply';
	$lang['reply_flood_ctrl_explain'] = 'this option prevents a user to add two consecutive posts in the same topic.';
}

$lang['rules_bump_can'] = 'You <b>can</b> bump topics in this forum';
$lang['rules_bump_cannot'] = 'You <b>cannot</b> bump topics in this forum';

$lang['topic_bumped'] = 'Topic has been bumped successfully';
$lang['user_cannot_bump'] = 'You cannot bump topics in this forum';
$lang['bump_error'] = 'You cannot bump this topic so soon after the last post.';
$lang['reply_error_without_bump'] = 'You cannot reply to your own post in this topic; please rather edit your previous post and then bump topic.';
$lang['reply_error_with_bump'] = 'A minimum number of %d %s is required between the last post to a topic and the ability to bump this topic.';

$lang['bumped_by'] = 'Last bumped by %s on %s';
$lang['bump_topic'] = 'Bump Topic';

$lang['bt_type_m_s'] = 'minute';
$lang['bt_type_h_s'] = 'hour';
$lang['bt_type_d_s'] = 'day';
$lang['bt_type_m_p'] = 'minutes';
$lang['bt_type_h_p'] = 'hours';
$lang['bt_type_d_p'] = 'days';

?>