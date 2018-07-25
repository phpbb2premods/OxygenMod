<?php
/**
*
* @package The Logger
* @version $Id: lang_extend_the_logger.php,v 1.0.0 2007/04/07 eviL3 Exp $
* @copyright (c) 2006 eviL3 and Brainy
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* @french translation : ABDev, EzCom
*/

if( !$lang )
{
	$lang = array();
}

/**
* Add some language entries for the logger
*/
$lang = array_merge($lang, array(
	// ------------- Global -------------
	'the_logger'	=> 'The Logger',

	'log_click_return_config'	=> 'Cliquez %sici%s pour revenir � la configuration des enregistrements',
	'log_click_return_view'		=> 'Cliquez %sici%s pour revenir aux enregistrements',

	'log_view_not_allowed'		=> 'Vous n\'�tes pas autoris� � visualiser les enregistrements.',
	'log_config_not_allowed'	=> 'Vous n\'�tes pas autoris� � �diter la configuration des enregistrements.',
	'log_logs_deleted'			=> 'Les enregistrements ont �t� supprim�s.<br /><br />Cliquez %sici%s pour revenir � la page "Visualisation des enregistrements".', // %s is the url to the view logs page

	'log_up_to_date'	=> '<span style="color:green;">Votre version de The logger est � jour.</span>',
	'log_not_up_to_date'	=> '<span style="color:red;">Votre version de The logger n\'est pas � jour.</span>',

	// ------------- Config -------------
	'log_config'			=> 'Configuration des enregistements',
	'log_config_explain'	=> 'Depuis ce formulaire, vous pouvez modifier les r�glages de The Logger',

	// General / Global
	'log_gen_settings'	=> 'R�glages g�n�raux',
	'log_user'	=> 'Enregistrer les actions des utilisateurs',
	'log_mod'	=> 'Enregistrer les actions de la mod�ration',
	'log_admin'	=> 'Enregistrer les actions de l\'administration',
	'log_error'	=> 'Enregistrer les erreurs',
	'log_email_send'			=> '�mettre un email si l\'enregistrement est impossible',
	'log_msgdie_hide'			=> 'Masquer les erreurs obtenues depuis la fonction "message_die"',
	'log_msgdie_hide_explain'	=> 'Ne pas afficher les erreurs obtenues par "message die". Afficher un message par d�faut � la place.',
	'log_super_admins'			=> 'Administrateurs principaux',
	'log_super_admins_explain'	=> 'Saisissez les IDs des administrateurs principaux en les s�parant par une virgule. Les administrateurs principaux peuvent visualiser les enregistrements et modifier la configuration.',
	'log_admins_view'			=> 'Autoriser les autres administrateurs � visualiser les enregistrements',
	'log_admins_del'			=> 'Autoriser les autres administrateurs � supprimer les enregistrements',
	'log_admins_config'			=> 'Autoriser les autres administrateurs � modifier la configuration',

	// User
	'log_user_log_config'			=> 'R�glages des enregistrements des utilisateurs',
	'log_user_log_config_explain'	=> 'Ces r�glages permettent d\'enregistrer les actions des utilisateurs. Si la fonction "Enregistrer les actions des utilisateurs" est d�sactiv�e, ils n\'auront aucun effet.',
	'log_user_prune'		=> 'D�lester les enregistrements des utilisateurs',
	'log_user_newtopic'		=> 'Enregistrer les nouveaux sujets',
	'log_user_edit'			=> 'Enregistrer les �ditions',
	'log_user_delete'		=> 'Enregistrer les suppressions de messages',
	'log_user_login'		=> 'Enregistrer les connexions',
	'log_user_logout'		=> 'Enregistrer les d�connexions',
	'log_user_fail_login'	=> 'Enregistrer les erreurs de connexion',
	'log_user_profile'		=> 'Enregistrer les �ditions de profil',
	'log_user_register'		=> 'Enregistrer les nouvelles inscriptions',

	// Moderator
	'log_mod_mog_config'			=> 'R�glages des enregistrements de la mod�ration',
	'log_mod_mog_config_explain'	=> 'Ces r�glages permettent d\'enregistrer les actions de la mod�ration. Si la fonction "Enregistrer les actions de la mod�ration" est d�sactiv�e, ils n\'auront aucun effet.',
	'log_mod_prune'		=> 'D�lester les enregistrements de la mod�ration',
	'log_mod_edit'		=> 'Enregistrer les �ditions de messages',
	'log_mod_delete'	=> 'Enregistrer les suppressions de messages / sujets',
	'log_mod_move'		=> 'Enregistrer les d�placements de sujets',
	'log_mod_lock'		=> 'Enregistrer les verrouillages de sujets',
	'log_mod_unlock'	=> 'Enregistrer les d�verrouillages de sujets',
	'log_mod_split'		=> 'Enregistrer les divisions de sujets',

	// Admin
	'log_admin_log_config'			=> 'R�glages des enregistrements de l\'administration',
	'log_admin_log_config_explain'	=> 'Ces r�glages permettent d\'enregistrer les actions de l\'administration. Si la fonction "Enregistrer les actions de l\'administration" est d�sactiv�e, ils n\'auront aucun effet.',
	'log_admin_prune'			=> 'D�lester les enregistrements de l\'administration',
	'log_admin_config'			=> 'Enregistrer les changements de configuration',
	'log_admin_email'			=> 'Enregistrer les �missions d\'email de masse',
	'log_admin_forum_creation'	=> 'Enregistrer les cr�ations de forum',
	'log_admin_forum_deletion'	=> 'Enregistrer les suppressions de forum',
	'log_admin_forum_edit'		=> 'Enregistrer les modifications de forum',
	'log_admin_ban'				=> 'Enregistrer les bannissements d\'utilisateur',
	'log_admin_user_manage'		=> 'Enregistrer les actions de la gestion des utilisateurs',

	// Error
	'log_error_log_config'	=> 'R�glages des enregistrements des erreurs',
	'log_error_log_explain'	=> 'Ces r�glages permettent d\'enregistrer les erreurs. Si la fonction "Enregistrer les erreurs" est d�sactiv�e, ils n\'auront aucun effet.',
	'log_error_prune'		=> 'D�lester les enregistrements des erreurs',
	'log_error_general'				=> 'Enregistrer les erreurs g�n�rales',
	'log_error_critical'			=> 'Enregistrer les erreurs critiques',
	'log_error_critical_explain'	=> 'Ceci peut ne pas �tre fiable, du fait que les erreurs critiques surviennent lorsque la base de donn�es n\'est pas accessible.',

	// Other
	'log_other_settings'		=> 'R�glages divers / Information',
	'log_view_per_page'			=> 'Nombre d\'enregistrements par page',
	'log_view_per_page_explain'	=> 'Nombre d\'enregistrements par page lors de la visualisation',
	'log_prune_days'			=> 'D�lestage',
	'log_prune_days_explain'	=> 'Nombre de jours pendant lesquels les enregistrements sont conserv�s. La valeur <b>0</b> d�sactive le d�lestage automatique.',
	'log_mod_version_check'			=> 'Autoriser la v�rification de version de "The Logger"',
	'log_mod_version_check_explain'	=> 'Aucune donn�e personnelle ne sera �mise',
	'log_mod_version'			=> 'Version de "The Logger"',

	// ------------- View Logs -------------
	'log_view'			=> 'Visualisation des enregistrements',
	'log_view_explain'	=> 'Depuis cette page, vous pouvez visualiser les enregistrements. Le menu d�roulant vous permet de s�lectionner d\'autres types d\'enregistrements.',

	// Log types (categories)
	'log_type_user'		=> 'Utilisateurs',
	'log_type_mod'		=> 'Mod�ration',
	'log_type_admin'	=> 'Administration',
	'log_type_error'	=> 'Erreurs',

	// Log entry types
	'LOG_U_NEWTOPIC'		=> 'Nouveau sujet "%1$s" cr�� dans le forum %2$s',	// %1$s = Topic title, %2$s = forum
	'LOG_U_EDIT'			=> '�dition du message dans le sujet "%2$s" :: %1$s',	// %1$s = post link, %2$s = Topic title
	'LOG_U_DELETE'			=> 'Suppression du message dans le sujet "%1$s"',		// %2$s = Topic title

	'LOG_U_LOGIN'			=> 'Connexion de l\'utilisateur (Administrateur :: %1$s)',		// %1$s = (bool) admin?
	'LOG_U_LOGOUT'			=> 'D�connexion de l\'utilisateur ',
	'LOG_U_LOGIN_FAILED'	=> '�chec de la connexion',

	'LOG_U_PROFILE'			=> 'L\'utilisateur a �dit� son profil',
	'LOG_U_REGISTER'		=> 'L\'utilisateur %1$s (%2$s) s\'est inscrit',

	'LOG_M_EDIT'			=> '�dition du message dans le sujet "%2$s" par un mod�rateur :: %1$s',	// %1$s = post link, %2$s = Topic title
	'LOG_M_DELETE'			=> 'Suppression du message dans le sujet "%1$s"',						// %1$s = Topic title
	'LOG_M_DELETE_TOPIC'	=> 'Suppression du sujet "%1$s"',								// %1$s = post title
	'LOG_M_MOVE'			=> 'D�placement du sujet "%2$s" vers le forum %1$s',						// %1$s = forum, %2$s = Topic title
	'LOG_M_LOCK'			=> 'Verrouillage du sujet "%1$s"',								// %1$s = Topic title
	'LOG_M_UNLOCK'			=> 'D�verrouillage du sujet "%1$s"',								// %1$s = Topic title
	'LOG_M_SPLIT'			=> 'Division du sujet "%1$s"',								// %1$s = Topic title

	'LOG_A_UPDATE_LOG_CONFIG'	=> 'Mise � jour de la configuration des enregistrements',
	'LOG_A_UPDATE_BOARD_CONFIG'	=> 'Mise � jour de la configuration du forum',
	'LOG_A_MASS_EMAIL'			=> '�mission d\'un email de masse',
	'LOG_A_CREATE_FORUM'		=> 'Cr�ation du forum "%1$s"',	// %1$s = forum name
	'LOG_A_DELETE_FORUM'		=> 'Suppression du forum "%1$s"',	// %1$s = forum name
	'LOG_A_EDIT_FORUM'			=> 'Forum "%1$s" modifi� en "%2$s"',	// %1$s = Old forum name, %2$s = New forum name
	'LOG_A_USER_BAN'			=> 'Bannissement de l\'utilisateur "%1$s"',	// %1$s = username, %2$s = user id
	'LOG_A_IP_BAN'				=> 'Bannissement de l\'IP "%1$s"',		// %1$s = ip adress
	'LOG_A_EMAIL_BAN'			=> 'Bannissement de l\'adresse email "%1$s"',	// %1$s = email adress
	'LOG_A_USER_UNBAN'			=> 'D�bannissement de l\'utilisateur "%1$s"',	// %1$s = username, %2$s = user id
	'LOG_A_IP_UNBAN'			=> 'D�bannissement de l\'IP "%1$s"',	// %1$s = ip adress
	'LOG_A_EMAIL_UNBAN'			=> 'D�bannissement de l\'adresse email "%1$s"',	// %1$s = email adress
	'LOG_A_USER_MANAGE'			=> 'Mise � jour du profil de l\'utilisateur "%1$s"',	// %1$s = username, %2$s = user id

	'LOG_E_LOGGING_CONFIG_ERROR'	=> '�chec de la mise � jour de la configuration des enregistrements',

	'LOG_E_GENERAL'		=> '<b><u>Erreur g�n�rale:</u></b><br /><br />%s',
	'LOG_E_CRITICAL'	=> '<b><u>Erreur critique:</u></b><br /><br />%s',

	// Other
	'Log_no_logs'	=> 'Il n\'y a aucun enregistrement.',
	'log_confirm_deleteall'	=> '�tes-vous s�r de vouloir supprimer tous les enregistrements de ce type ?',

	// ------------- Errors -------------
	'log_error_delete'	=> 'Une erreur s\'est produite lors de la suppression des enregistrements.',

	// ------------- Main ---------------
	'Log_failed_log_title'	=> 'Failed to log error at %s',
	'Log_failed_get_f_name'	=> 'Aucun nom de forum n\'a pu �tre obtenu',
	'Log_failed_get_u_name'	=> 'Aucun nom d\'utilisateur n\'a pu �tre obtenu',

	'Logging'	=> 'The Logger',
	'Log_view'	=> 'Enregistrements',

	'log_msgdie_default'	=> 'Une erreur vient de se produire sur ce forum. L\'administrateur en a �t� pr�venu.',

//-- mod : the logger - proxy detection ----------------------------------------
//-- add
	'log_real_ip'	=> 'Adresse IP r�elle',
//-- fin mod : the logger - proxy detection ------------------------------------
));

?>
