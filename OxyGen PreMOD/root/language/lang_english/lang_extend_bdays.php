<?php
/**
*
* @package birthday_event_mod
* @version $Id: lang_extend_bdays.php,v 0.1 28/04/2006 18:08 reddog Exp $
* @copyright (c) 2006 reddog - http://www.reddevboard.com/
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

// date format
$lang['bday_date_format'] =  'F d, Y';

// admin part
if ($lang_extend_admin)
{
	// configuration
	$lang['bday_settings'] = 'Birthday settings';
	$lang['bday_required'] = 'Birthday required';
	$lang['bday_required_explain'] = 'Force users to submit a birthday';
	$lang['bday_greeting'] = 'Birthday greeting';
	$lang['bday_greeting_explain'] = 'Users who have submitted a birthday can have a birthday greeting, and listed those on the board index';
	$lang['bday_min_age'] = 'Minimum user age';
	$lang['bday_max_age'] = 'Maximum user age';
}

// main
$lang['bday_birthdays'] = 'Birthdays';
$lang['bday_required'] = 'Your birthday is required on this board';
$lang['bday_day'] = 'Day';
$lang['bday_month'] = 'Month';
$lang['bday_year'] = 'Year';
$lang['bday_birthdate'] = 'Birthdate';
$lang['bday_greeting'] = 'Congratulations to:';
$lang['bday_no_today'] = 'No birthdays today';
$lang['bday_none'] = 'None specified';
$lang['bday_born'] = 'born on %s';
$lang['bday_age'] = 'Age';
$lang['bday_happy'] = 'Happy birthday to %s';

?>