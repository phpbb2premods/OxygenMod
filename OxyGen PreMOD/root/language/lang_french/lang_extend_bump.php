<?php
/**
*
* @package bump_topic_mod [french]
* @version $Id: lang_extend_bump.php,v 1.0 12/08/2006 16:05 reddog Exp $
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
	$lang['Bump'] = 'Remonter';

	$lang['bt_minutes'] = 'minutes';
	$lang['bt_hours'] = 'heures';
	$lang['bt_days'] = 'jours';

	$lang['bump_interval'] = 'Intervalle pour remonter un sujet';
	$lang['bump_interval_explain'] = 'Nombre de minutes, d\'heures ou de jours entre le dernier message à un sujet et la possibilité de remonter ce sujet.';
	$lang['reply_flood_ctrl'] = 'Contrôle du Flood sur les réponses';
	$lang['reply_flood_ctrl_explain'] = 'cette option empêche un utilisateur de poster deux réponses consécutives dans un même sujet.';
}

$lang['rules_bump_can'] = 'Vous <b>pouvez</b> remonter les sujets dans ce forum';
$lang['rules_bump_cannot'] = 'Vous <b>ne pouvez pas</b> remonter les sujets dans ce forum';

$lang['topic_bumped'] = 'Le sujet a été remonté avec succès';
$lang['user_cannot_bump'] = 'Vous ne pouvez pas remonter les sujets dans ce forum';
$lang['bump_error'] = 'Vous ne pouvez pas remonter ce sujet si peu de temps après le dernier message.';
$lang['reply_error_without_bump'] = 'Vous ne pouvez pas répondre à votre propre message dans ce sujet; préférez éditer votre précédent message puis ensuite remonter le sujet.';
$lang['reply_error_with_bump'] = 'Un minimum de %d %s est requis entre le dernier message à un sujet et la possibilité de le remonter.';

$lang['bumped_by'] = 'Dernière remontée du sujet par %s le %s';
$lang['bump_topic'] = 'Remonter le sujet';

$lang['bt_type_m_s'] = 'minute';
$lang['bt_type_h_s'] = 'heure';
$lang['bt_type_d_s'] = 'jour';
$lang['bt_type_m_p'] = 'minutes';
$lang['bt_type_h_p'] = 'heures';
$lang['bt_type_d_p'] = 'jours';

?>