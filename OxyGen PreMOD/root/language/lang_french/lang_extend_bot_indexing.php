<?php
/**
*
* @version $Id: lang_extend_bot_indexing.php,v 1.0.0 2007/01/08 ABDev Exp $
* @copyright (c) 2007 ABDev, EzCom
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

/**
* admin part
*/
if ( $lang_extend_admin )
{
	$lang['Manage_Bots'] = 'Moteurs de recherche';
	$lang['Bot_Explain'] = 'Ici, vous pouvez ajouter, �diter ou supprimer les d�finitions des moteurs de recherches.';
	$lang['Pending_Bots'] = 'Moteurs de recherche en attente';
	$lang['Pending_Explain'] = '';

	// editor
	$lang['Bots_add'] = 'Ajouter un nouveau moteur de recherche';
	$lang['Bots_add_explain'] = 'Ici, vous pouvez ajouter une nouvelle d�finition de moteur de recherche.';
	$lang['Bots_edit'] = 'Editer un moteur de recherche';
	$lang['Bots_edit_explain'] = 'Ici, vous pouvez �diter la signature et le nom du moteur de recherche.';
	$lang['Bot_Name'] = 'Nom';
	$lang['Bot_Name_Explain'] = 'Saisissez un nom court pour identifier ce moteur de recherche.';
	$lang['Bot_Agent'] = 'Agent';
	$lang['Bot_Agent_Explain'] = 'Correspondances partielles autoris�es. S�parez les agents avec un simple \'|\'';
	$lang['Bot_Ip'] = 'IPs';
	$lang['Bot_Ip_Explain'] = 'Correspondances partielles autoris�es. S�parez les adresses IP avec un simple \'|\'';
	$lang['Bot_Style'] = 'Th�me';
	$lang['Bot_Style_Explain'] = 'Th�me que le robot voit quand il visite votre forum';

	// buttons
	$lang['Submit'] = 'Soumettre';
	$lang['Reset'] = 'R�initialiser';

	// list
	$lang['Pages'] = 'Pages';
	$lang['Visits'] = 'Visites';
	$lang['Last_Visit'] = 'Derni�re visite';
		$lang['Never'] = 'Jamais';
	$lang['Options'] = 'Options';
		$lang['Edit'] = '�diter';
		$lang['Delete'] = 'Supprimer';
	$lang['Mark'] = 'Marquer';
	$lang['Create'] = 'Cr�er';

	// empty entries
	$lang['No_Bots'] = 'Actuellement, il n\'y a aucune d�finition de moteurs de recherche. Veuillez cliquer sur "Cr�er" pour en ajouter un.';
	$lang['No_Pending_Bots'] = 'Actuellement, il n\'y a aucun moteur de recherche en attente.';

	// confirmation window
	$lang['Added_bot'] = 'Moteur de recherche ajout�.';
	$lang['Ignored_bot'] = 'Moteur de recherche supprim�.';
	$lang['Modified_bot'] = 'Moteur de recherche modifi�.';
	$lang['Ok'] = 'Ok';

	// errors
	$lang['Error_No_Agent_Or_Ip'] = 'Agent ou adresse IP invalides.';
	$lang['Error_No_Bot_Name'] = 'Nom du moteur de recherche non-renseign�.';
	$lang['Error_Bot_Name_Taken'] = 'Ce nom est d�j� utilis�.';
	$lang['Error_Own_Ip'] = 'Vous ne pouvez pas utiliser votre propre adresse IP en tant qu\'adresse IP de moteur de recherche.<br />L\'utiliser vous emp�chera d\'acc�der au panneau d\'administration.';
}

?>
