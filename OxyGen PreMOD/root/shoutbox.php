<?php
/**
*
* @version $Id: shoutbox.php,v 1.0.5 11/02/2006 23:16 PastisD Exp $
* @copyright (c) 2006 PastisD
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
* Original author : Malach, http://www.phantasia-fr.com, 2006
*
*/

define('IN_PHPBB', true);
$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);

include_once($phpbb_root_path . 'common.'.$phpEx);
include_once($phpbb_root_path . 'includes/bbcode.'.$phpEx);

$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);

?>

<html>
<frameset rows="36%, 14%" cols="*" scrolling=NO noresize framespacing=0 frameborder=NO border="0">
<frame src="<?php echo append_sid('shoutbox_view.'.$phpEx); ?>" name="ekran" noresize marginwidth="0" marginheight="0">
<frame src="<?php echo append_sid('shoutbox_send.'.$phpEx); ?>" scrolling="no" name="sender" noresize marginwidth="0" marginheight="0">
</frameset>

<noframes>
<body>Your browser does not support this feature!!!</body>
</noframes>
</html>
