<?php
//
//	file: includes/class_visual_confirm_img.php
//	author: ptirhiik
//	begin: 17/03/2006
//	version: 1.6.0 phpBB - 31/12/2006
//	license: http://opensource.org/licenses/gpl-license.php GNU General Public License (GPL)
//

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

// define('VC_DEBUG', true); // bypass the run through the include, and allow to set a code rather than read it from db

class visual_confirm_img
{
	var $code;
	var $fonts;
	var $fonts_dir;
	var $backs_dir;
	var $width;
	var $height;

	function visual_confirm_img()
	{
		$this->fonts_dir = 'includes/vc/fonts';
		$this->backs_dir = 'includes/vc/backs';
		$this->width = 360;
		$this->height = 90;

		$this->code = false;
		$this->fonts = false;

		// init the randomizer
		mt_srand((double) microtime() * 1000000);
	}

	function process()
	{
		if ( $this->init() && $this->read() )
		{
			$this->display();
		}
	}

	function init()
	{
		return true;
	}

	function read()
	{
		global $db, $userdata;
		global $HTTP_GET_VARS;

		$this->code = false;
		if ( ($confirm_id = htmlspecialchars($HTTP_GET_VARS['id'])) && preg_match('/^[A-Za-z0-9]+$/', $confirm_id) )
		{
			// Try and grab code for this id and session
			$sql = 'SELECT code
						FROM ' . CONFIRM_TABLE . '
						WHERE session_id = \'' . $userdata['session_id'] . '\'
						AND confirm_id = \'' . $confirm_id . '\'';
			if ( $result = $db->sql_query($sql) && ($row = $db->sql_fetchrow($result)) )
			{
				$this->code = $row['code'];
			}
		}
		return !empty($this->code);
	}

	function display()
	{
	}

	function rand($range, $max=0)
	{
		return is_array($range) ? mt_rand($range[0], $range[1]) : mt_rand($range, $max);
	}

	function hex2rgb($hex_color)
	{
		$split = explode('.', substr(chunk_split($hex_color, 2, '.'), 0, -1));
		return array(hexdec($split[0]), hexdec($split[1]), hexdec($split[2]));
	}

	function rgb2hex($rgb_color)
	{
		return sprintf('%02x%02x%02x', $rgb_color[0], $rgb_color[1], $rgb_color[2]);
	}

	function get_rsc($dir, $mask, $from_idx=0)
	{
		global $phpbb_root_path;

		$res = array();
		if ( !empty($dir) )
		{
			if ( ($handle = @opendir($phpbb_root_path . $dir)) )
			{
				while ( $filename = @readdir($handle) )
				{
					if ( preg_match($mask, $filename) )
					{
						$res[$from_idx] = $filename;
						$from_idx++;
					}
				}
				@closedir($handle);
			}
		}
		return empty($res) ? array() : $res;
	}

	function rsc_name($dir, $name)
	{
		global $phpbb_root_path;
		return empty($name) ? '' : phpbb_realpath($phpbb_root_path . $dir . '/' . $name);
	}
}

// let's go : first choose the method
if ( defined('VC_DEBUG') && VC_DEBUG )
{
	return;
}
$handled = false;
if ( !$handled && (@extension_loaded('gd') || @extension_loaded('gd2')) )
{
	include($phpbb_root_path . 'includes/vc/class_visual_confirm_img_gd.' . $phpEx);
	$visual_confirm_img = new visual_confirm_img_gd();
	$handled = $visual_confirm_img->process();
	unset($visual_confirm_img);
}
if ( !$handled )
{
	include($phpbb_root_path . 'includes/vc/class_visual_confirm_img_bt.' . $phpEx);
	$visual_confirm_img = new visual_confirm_img_bt();
	$handled = $visual_confirm_img->process();
	unset($visual_confirm_img);
}
exit;

?>