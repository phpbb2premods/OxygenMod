<?php
/**
*
* @version $Id: shoutbox_body.php,v 1.4 11/02/2006 23:16 PastisD Exp $
* @copyright (c) 2006 PastisD
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
* Original author : Malach, http://www.phantasia-fr.com, 2006
*
*/

if($HTTP_COOKIE_VARS['shoutbox'] == "off")
{
	$shout_size = 'width="0" height="0" border="0"'; 
	$shoutbox_title = '<a href="shoutbox_max.php" title="' . $lang['All_Messages'] . '">' . $lang['title_minichat'] . '</a> - <a href="' . append_sid('shoutbox_view.'.$phpEx) . '?mode=show" class="mainmenu">' . $lang['sb_show'] . '</a>';
}
else
{
	$shout_size = 'width="100%" height="' . $board_config['shoutbox_height'] . '" border="0"';
	$shoutbox_title = '<a href="shoutbox_max.php" title="' . $lang['All_Messages'] . '" class="cattitle">' . $lang['title_minichat'] . '</a>';
}

$shoutbox_body = '<table width="' . $board_config['shoutbox_width'] . '" align="center" cellpadding="2" cellspacing="1" border="0" class="forumline">
									<th class="cattitle" align="center" height="20">' . $shoutbox_title . '</th>
									<tr>
										<td align="center" valign="middle" rowspan="4">
										<iframe bgcolor="#63456B" src="shoutbox.php" ' . $shout_size . '></iframe>
										</td>
									</tr>
									</table>
									<br />';

$template->assign_vars(array('SHOUTBOX_BODY' => $shoutbox_body));

?>
