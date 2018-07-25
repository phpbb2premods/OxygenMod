<?php
/***************************************************************************
 * bbc_box_install.php
 * -------------------
 * begin	: 20/06/2005
 * copyright	: reddog - http://www.reddevboard.com
 * version	: 0.0.2 - 25/06/2005
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

// Begin main prog
define('IN_PHPBB', true);
define('IN_INSTALL', true);

$phpbb_root_path = './../';
include($phpbb_root_path.'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

// ---------
// FUNCTIONS
//
function page_header()
{
	global $phpbb_root_path, $phpEx;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="Content-Style-Type" content="text/css">
<title>OxyGen PreMOD - Upgrade</title>
<link rel="stylesheet" href="css/subSilverPlus.css" type="text/css">
<style type="text/css">
<!--
th		{ background-image: url('css/cellpic3.gif') }
td.cat		{ background-image: url('css/cellpic1.gif') }
td.rowpic	{ background-image: url('css/cellpic2.jpg'); background-repeat: repeat-y }
td.catHead,td.catSides,td.catLeft,td.catRight,td.catBottom { background-image: url('css/cellpic1.gif') }

/* Import the fancy styles for IE only (NS4.x doesn't use the @import function) */
@import url("formIE.css"); 
//-->
</style>
</head>
<body bgcolor="#E5E5E5" text="#000000" link="#006699" vlink="#5584AA">
<table width="100%" border="0" cellspacing="0" cellpadding="10" align="center"> 
	<tr>
		<td class="bodyline"><table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td><a href="<?php echo $phpbb_root_path ?>index.<?php echo $phpEx ?>"><img src="css/logo_phpBB.gif" border="0" alt="" vspace="1" /></a></td>
				<td align="center" width="100%" valign="middle"><span class="maintitle">OxyGen PreMOD - Upgrade</span></td>
			</tr>
		</table>

		<br />
<?php
}

function page_footer()
{
?>
		<div align="center" class="gensmall"><br />Powered by <a href="http://www.phpbb.com/" target="_phpbb" class="copyright">phpBB</a> &copy; 2001, 2005 phpBB Group</div>
		</td>
	</tr>
</table>

</body>
</html>
<?php
}
//
// FUNCTIONS
// ---------

// Define schema info
$available_dbms = array(
	'mysql'=> array(
		'LABEL'			=> 'MySQL 3.x',
		'SCHEMA'		=> 'mysql', 
		'DELIM'			=> ';',
		'DELIM_BASIC'	=> ';',
		'COMMENTS'		=> 'remove_remarks'
	), 
	'mysql4' => array(
		'LABEL'			=> 'MySQL 4.x',
		'SCHEMA'		=> 'mysql', 
		'DELIM'			=> ';', 
		'DELIM_BASIC'	=> ';',
		'COMMENTS'		=> 'remove_remarks'
	)
);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//

// Import language file, setup template ...
include($phpbb_root_path.'language/lang_' . $board_config['default_lang'] . '/lang_admin.'.$phpEx);
include($phpbb_root_path.'language/lang_' . $board_config['default_lang'] . '/lang_main.'.$phpEx);

// Initialise user settings on page load
if( !$userdata['session_logged_in'] )
{
	redirect(append_sid('login.'.$phpEx . '?redirect=upgrade/install.'.$phpEx, true));
}

if( $userdata['user_level'] != ADMIN )
{
page_header();
?>
		<table width="100%" cellspacing="1" cellpadding="2" border="0" class="forumline">
		  <tr>
			<th class="thHead"><?php echo $lang['Information']; ?></th>
		  </tr>
		  <tr>
			<td class="row1"><table width="100%" cellspacing="0" cellpadding="1" border="0">
				<tr> 
					<td>&nbsp;</td>
				</tr>
				<tr> 
					<td align="center"><span class="gen"><?php echo $lang['Not_admin']; ?></span></td>
				</tr>
				<tr> 
					<td>&nbsp;</td>
				</tr>
			</table></td>
		  </tr>
		</table>

		<br clear="all" />
<?php
page_footer();
exit;
}

//--------------------------
//
//	Main process
//
//--------------------------
if ( !isset($HTTP_POST_VARS['confirm']) )
{
page_header();
?>
		<table width="100%" cellspacing="1" cellpadding="2" border="0" class="forumline">
		  <tr>
			<th class="thHead">OxyGen PreMOD - <?php echo $lang['Upgrade']; ?></th>
		  </tr>
		  <tr>
			<td class="row1" align="center"><form action="" method="post">
			  <table width="100%" cellspacing="0" cellpadding="0" border="0">
				<tr>
					<td align="center"><span class="gen">
						<br /><strong>OxyGen PreMOD</strong> - <?php echo $lang['Start_Upgrade']; ?> ?
						<br /><br />
						<input type="submit" name="confirm" value="<?php echo $lang['Yes']; ?>" class="mainoption" />&nbsp;&nbsp;<input type="submit" name="cancel" value="<?php echo $lang['No']; ?>" class="liteoption" />
					</span></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
			  </table>
			</form></td>
		  </tr>
		</table>

		<br clear="all" />
<?php
page_footer();
}
else
{
	page_header();

print<<<PRINTEND
		<table width="100%" cellspacing="1" cellpadding="2" border="0" class="forumline">
		  <tr>
			<th class="thHead">Migration</th>
		  </tr>
		  <tr>
			<td class="row1"><span class="genmed">
				<ul type="disc">
PRINTEND;
	if (!empty($dbms))
	{
		switch($dbms)
		{
			case 'mysql':
			case 'mysql4':
				$check_exts = 'mysql';
				$check_other = 'mysql';
				break;
		}

		if (!extension_loaded($check_exts) && !extension_loaded($check_other))
		{
			?>
					<div class="genmed" align="center"><?php echo $lang['Installer_Error']; ?><br /><br />
					<?php echo $lang['Install_No_Ext']; ?>
					</div>
				</span></td>
			  </tr>
			</table>

			<br clear="all" />
			<?php
			page_footer();
			exit;
		}

		include($phpbb_root_path.'includes/db.'.$phpEx);
	}

	if ( $board_config['oxytanium_version'] )
	{
		$dbms_schema = 'oxytanium/' . $available_dbms[$dbms]['SCHEMA'] . '_schema.sql';
		$dbms_basic = 'oxytanium/' . $available_dbms[$dbms]['SCHEMA'] . '_basic.sql';
	}
	else
	{
		$dbms_schema = 'vanilia/' . $available_dbms[$dbms]['SCHEMA'] . '_schema.sql';
		$dbms_basic = 'vanilia/' . $available_dbms[$dbms]['SCHEMA'] . '_basic.sql';
	}

	$remove_remarks = $available_dbms[$dbms]['COMMENTS'];;
	$delimiter = $available_dbms[$dbms]['DELIM']; 
	$delimiter_basic = $available_dbms[$dbms]['DELIM_BASIC'];

	if ( !file_exists(@phpbb_realpath($phpbb_root_path . 'upgrade/' . $dbms_schema)) )
	{
		?>
				</ul>
				<div class="genmed" align="center">
				The file <?php echo 'upgrade/' . $dbms_schema; ?> doesn't exist. Please ensure that you have copied this file.
				<br /><br />
				<em>"Le fichier <?php echo 'upgrade/' . $dbms_schema; ?> n'existe pas. Assurez-vous que vous l'avez bien copié"</em>.</div>
				<br />
			</span></td>
		  </tr>
		</table>

		<br clear="all" />
		<?php
		page_footer();
		exit;
	}	
	else
	{
		// Load in the sql parser
		include($phpbb_root_path.'includes/sql_parse.'.$phpEx);

		// Ok we have the db info go ahead and read in the relevant schema
		// and work on building the table.. probably ought to provide some
		// kind of feedback to the user as we are working here in order
		// to let them know we are actually doing something.
		$sql_query = @fread(@fopen($dbms_schema, 'r'), @filesize($dbms_schema));
		$sql_query = preg_replace('/phpbb_/', $table_prefix, $sql_query);

		$sql_query = $remove_remarks($sql_query);
		$sql_query = split_sql_file($sql_query, $delimiter);

		for ($i = 0; $i < sizeof($sql_query); $i++)
		{
			if (trim($sql_query[$i]) != '')
			{
				if (!($result = $db->sql_query($sql_query[$i])))
				{
					$error = $db->sql_error();

					print('<li>' . nl2br(trim($sql_query[$i])) . '<br /><ul type="square"><li><font color="#FF0000"><b>Error:</b></font> ' . $error['message'] . '</li></ul></li><br />');
					$sql_error = true;
					break;
				}
				else
				{
					print('<li>' . nl2br(trim($sql_query[$i])) . '<br /><ul type="square"><li><font color="#00AA00"><b>Successfull</b></font></li></ul></li><br />');
				}
			}
		}

		if ( !$sql_error )
		{
			// Ok tables have been built, let's fill in the basic information
			$sql_query = @fread(@fopen($dbms_basic, 'r'), @filesize($dbms_basic));
			$sql_query = preg_replace('/phpbb_/', $table_prefix, $sql_query);

			$sql_query = $remove_remarks($sql_query);
			$sql_query = split_sql_file($sql_query, $delimiter_basic);

			for($i = 0; $i < sizeof($sql_query); $i++)
			{
				if (trim($sql_query[$i]) != '')
				{
					if (!($result = $db->sql_query($sql_query[$i])))
					{
						$error = $db->sql_error();

						print('<li>' . nl2br(trim($sql_query[$i])) . '<br /><ul type="square"><li><font color="#FF0000"><b>Error:</b></font> ' . $error['message'] . '</li></ul></li><br />');
						$sql_error = true;
						break;
					}
					else
					{
						print('<li>' . nl2br(trim($sql_query[$i])) . '<br /><ul type="square"><li><font color="#00AA00"><b>Successfull</b></font></li></ul></li><br />');
					}
				}
			}
		}
	}

print<<<PRINTEND
				</ul>
		  	</span></td>
		  </tr>
		</table>

		<br clear="all" />
PRINTEND;

	if ( !$sql_error )
	{
print<<<PRINTEND
		<table width="100%" cellspacing="1" cellpadding="2" border="0" class="forumline">
		  <tr>
			<th class="thHead">Installation complete</th>
		  </tr>
		  <tr>
			<td class="row1" align="center"><span class="genmed">The Database was successfully updated. Please delete the upgrade/ directory.
				<br /><br />
				<em>"La base de données a été mis à jour avec succès. Veuillez effacer le dossier upgrade/."</em>
			</span></td>
		  </tr>
		</table>

		<br clear="all" />
PRINTEND;
	}
	else
	{
print<<<PRINTEND
		<table width="100%" cellspacing="1" cellpadding="2" border="0" class="forumline">
		  <tr>
			<th class="thHead">Error</th>
		  </tr>
		  <tr>
			<td class="row1" align="center"><span class="genmed">Please ensure your database doesn't have conflicting tables or data, and that you can connect yourselves to it correctly, then try again.
				<br /><br />
				<em>"Veuillez vérifier que votre base de données n'a pas de tables ou de données entrant en conflit, et que vous pouvez vous y connecter correctement, et réessayez."</em>
			</span></td>
		  </tr>
		</table>

		<br clear="all" />
PRINTEND;
	}
	page_footer();
}

?>
