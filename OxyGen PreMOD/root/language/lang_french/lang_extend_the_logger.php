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

	'log_click_return_config'	=> 'Cliquez %sici%s pour revenir à la configuration des enregistrements',
	'log_click_return_view'		=> 'Cliquez %sici%s pour revenir aux enregistrements',

	'log_view_not_allowed'		=> 'Vous n\'êtes pas autorisé à visualiser les enregistrements.',
	'log_config_not_allowed'	=> 'Vous n\'êtes pas autorisé à éditer la configuration des enregistrements.',
	'log_logs_deleted'			=> 'Les enregistrements ont été supprimés.<br /><br />Cliquez %sici%s pour revenir à la page "Visualisation des enregistrements".', // %s is the url to the view logs page

	'log_up_to_date'	=> '<span style="color:green;">Votre version de The logger est à jour.</span>',
	'log_not_up_to_date'	=> '<span style="color:red;">Votre version de The logger n\'est pas à jour.</span>',

	// ------------- Config -------------
	'log_config'			=> 'Configuration des enregistements',
	'log_config_explain'	=> 'Depuis ce formulaire, vous pouvez modifier les réglages de The Logger',

	// General / Global
	'log_gen_settings'	=> 'Réglages généraux',
	'log_user'	=> 'Enregistrer les actions des utilisateurs',
	'log_mod'	=> 'Enregistrer les actions de la modération',
	'log_admin'	=> 'Enregistrer les actions de l\'administration',
	'log_error'	=> 'Enregistrer les erreurs',
	'log_email_send'			=> 'Émettre un email si l\'enregistrement est impossible',
	'log_msgdie_hide'			=> 'Masquer les erreurs obtenues depuis la fonction "message_die"',
	'log_msgdie_hide_explain'	=> 'Ne pas afficher les erreurs obtenues par "message die". Afficher un message par défaut à la place.',
	'log_super_admins'			=> 'Administrateurs principaux',
	'log_super_admins_explain'	=> 'Saisissez les IDs des administrateurs principaux en les séparant par une virgule. Les administrateurs principaux peuvent visualiser les enregistrements et modifier la configuration.',
	'log_admins_view'			=> 'Autoriser les autres administrateurs à visualiser les enregistrements',
	'log_admins_del'			=> 'Autoriser les autres administrateurs à supprimer les enregistrements',
	'log_admins_config'			=> 'Autoriser les autres administrateurs à modifier la configuration',

	// User
	'log_user_log_config'			=> 'Réglages des enregistrements des utilisateurs',
	'log_user_log_config_explain'	=> 'Ces réglages permettent d\'enregistrer les actions des utilisateurs. Si la fonction "Enregistrer les actions des utilisateurs" est désactivée, ils n\'auront aucun effet.',
	'log_user_prune'		=> 'Délester les enregistrements des utilisateurs',
	'log_user_newtopic'		=> 'Enregistrer les nouveaux sujets',
	'log_user_edit'			=> 'Enregistrer les éditions',
	'log_user_delete'		=> 'Enregistrer les suppressions de messages',
	'log_user_login'		=> 'Enregistrer les connexions',
	'log_user_logout'		=> 'Enregistrer les déconnexions',
	'log_user_fail_login'	=> 'Enregistrer les erreurs de connexion',
	'log_user_profile'		=> 'Enregistrer les éditions de profil',
	'log_user_register'		=> 'Enregistrer les nouvelles inscriptions',

	// Moderator
	'log_mod_mog_config'			=> 'Réglages des enregistrements de la modération',
	'log_mod_mog_config_explain'	=> 'Ces réglages permettent d\'enregistrer les actions de la modération. Si la fonction "Enregistrer les actions de la modération" est désactivée, ils n\'auront aucun effet.',
	'log_mod_prune'		=> 'Délester les enregistrements de la modération',
	'log_mod_edit'		=> 'Enregistrer les éditions de messages',
	'log_mod_delete'	=> 'Enregistrer les suppressions de messages / sujets',
	'log_mod_move'		=> 'Enregistrer les déplacements de sujets',
	'log_mod_lock'		=> 'Enregistrer les verrouillages de sujets',
	'log_mod_unlock'	=> 'Enregistrer les déverrouillages de sujets',
	'log_mod_split'		=> 'Enregistrer les divisions de sujets',

	// Admin
	'log_admin_log_config'			=> 'Réglages des enregistrements de l\'administration',
	'log_admin_log_config_explain'	=> 'Ces réglages permettent d\'enregistrer les actions de l\'administration. Si la fonction "Enregistrer les actions de l\'administration" est désactivée, ils n\'auront aucun effet.',
	'log_admin_prune'			=> 'Délester les enregistrements de l\'administration',
	'log_admin_config'			=> 'Enregistrer les changements de configuration',
	'log_admin_email'			=> 'Enregistrer les émissions d\'email de masse',
	'log_admin_forum_creation'	=> 'Enregistrer les créations de forum',
	'log_admin_forum_deletion'	=> 'Enregistrer les suppressions de forum',
	'log_admin_forum_edit'		=> 'Enregistrer les modifications de forum',
	'log_admin_ban'				=> 'Enregistrer les bannissements d\'utilisateur',
	'log_admin_user_manage'		=> 'Enregistrer les actions de la gestion des utilisateurs',

	// Error
	'log_error_log_config'	=> 'Réglages des enregistrements des erreurs',
	'log_error_log_explain'	=> 'Ces réglages permettent d\'enregistrer les erreurs. Si la fonction "Enregistrer les erreurs" est désactivée, ils n\'auront aucun effet.',
	'log_error_prune'		=> 'Délester les enregistrements des erreurs',
	'log_error_general'				=> 'Enregistrer les erreurs générales',
	'log_error_critical'			=> 'Enregistrer les erreurs critiques',
	'log_error_critical_explain'	=> 'Ceci peut ne pas être fiable, du fait que les erreurs critiques surviennent lorsque la base de données n\'est pas accessible.',

	// Other
	'log_other_settings'		=> 'Réglages divers / Information',
	'log_view_per_page'			=> 'Nombre d\'enregistrements par page',
	'log_view_per_page_explain'	=> 'Nombre d\'enregistrements par page lors de la visualisation',
	'log_prune_days'			=> 'Délestage',
	'log_prune_days_explain'	=> 'Nombre de jours pendant lesquels les enregistrements sont conservés. La valeur <b>0</b> désactive le délestage automatique.',
	'log_mod_version_check'			=> 'Autoriser la vérification de version de "The Logger"',
	'log_mod_version_check_explain'	=> 'Aucune donnée personnelle ne sera émise',
	'log_mod_version'			=> 'Version de "The Logger"',

	// ------------- View Logs -------------
	'log_view'			=> 'Visualisation des enregistrements',
	'log_view_explain'	=> 'Depuis cette page, vous pouvez visualiser les enregistrements. Le menu déroulant vous permet de sélectionner d\'autres types d\'enregistrements.',

	// Log types (categories)
	'log_type_user'		=> 'Utilisateurs',
	'log_type_mod'		=> 'Modération',
	'log_type_admin'	=> 'Administration',
	'log_type_error'	=> 'Erreurs',

	// Log entry types
	'LOG_U_NEWTOPIC'		=> 'Nouveau sujet "%1$s" créé dans le forum %2$s',	// %1$s = Topic title, %2$s = forum
	'LOG_U_EDIT'			=> 'Édition du message dans le sujet "%2$s" :: %1$s',	// %1$s = post link, %2$s = Topic title
	'LOG_U_DELETE'			=> 'Suppression du message dans le sujet "%1$s"',		// %2$s = Topic title

	'LOG_U_LOGIN'			=> 'Connexion de l\'utilisateur (Administrateur :: %1$s)',		// %1$s = (bool) admin?
	'LOG_U_LOGOUT'			=> 'Déconnexion de l\'utilisateur ',
	'LOG_U_LOGIN_FAILED'	=> 'Échec de la connexion',

	'LOG_U_PROFILE'			=> 'L\'utilisateur a édité son profil',
	'LOG_U_REGISTER'		=> 'L\'utilisateur %1$s (%2$s) s\'est inscrit',

	'LOG_M_EDIT'			=> 'Édition du message dans le sujet "%2$s" par un modérateur :: %1$s',	// %1$s = post link, %2$s = Topic title
	'LOG_M_DELETE'			=> 'Suppression du message dans le sujet "%1$s"',						// %1$s = Topic title
	'LOG_M_DELETE_TOPIC'	=> 'Suppression du sujet "%1$s"',								// %1$s = post title
	'LOG_M_MOVE'			=> 'Déplacement du sujet "%2$s" vers le forum %1$s',						// %1$s = forum, %2$s = Topic title
	'LOG_M_LOCK'			=> 'Verrouillage du sujet "%1$s"',								// %1$s = Topic title
	'LOG_M_UNLOCK'			=> 'Déverrouillage du sujet "%1$s"',								// %1$s = Topic title
	'LOG_M_SPLIT'			=> 'Division du sujet "%1$s"',								// %1$s = Topic title

	'LOG_A_UPDATE_LOG_CONFIG'	=> 'Mise à jour de la configuration des enregistrements',
	'LOG_A_UPDATE_BOARD_CONFIG'	=> 'Mise à jour de la configuration du forum',
	'LOG_A_MASS_EMAIL'			=> 'Émission d\'un email de masse',
	'LOG_A_CREATE_FORUM'		=> 'Création du forum "%1$s"',	// %1$s = forum name
	'LOG_A_DELETE_FORUM'		=> 'Suppression du forum "%1$s"',	// %1$s = forum name
	'LOG_A_EDIT_FORUM'			=> 'Forum "%1$s" modifié en "%2$s"',	// %1$s = Old forum name, %2$s = New forum name
	'LOG_A_USER_BAN'			=> 'Bannissement de l\'utilisateur "%1$s"',	// %1$s = username, %2$s = user id
	'LOG_A_IP_BAN'				=> 'Bannissement de l\'IP "%1$s"',		// %1$s = ip adress
	'LOG_A_EMAIL_BAN'			=> 'Bannissement de l\'adresse email "%1$s"',	// %1$s = email adress
	'LOG_A_USER_UNBAN'			=> 'Débannissement de l\'utilisateur "%1$s"',	// %1$s = username, %2$s = user id
	'LOG_A_IP_UNBAN'			=> 'Débannissement de l\'IP "%1$s"',	// %1$s = ip adress
	'LOG_A_EMAIL_UNBAN'			=> 'Débannissement de l\'adresse email "%1$s"',	// %1$s = email adress
	'LOG_A_USER_MANAGE'			=> 'Mise à jour du profil de l\'utilisateur "%1$s"',	// %1$s = username, %2$s = user id

	'LOG_E_LOGGING_CONFIG_ERROR'	=> 'Échec de la mise à jour de la configuration des enregistrements',

	'LOG_E_GENERAL'		=> '<b><u>Erreur générale:</u></b><br /><br />%s',
	'LOG_E_CRITICAL'	=> '<b><u>Erreur critique:</u></b><br /><br />%s',

	// Other
	'Log_no_logs'	=> 'Il n\'y a aucun enregistrement.',
	'log_confirm_deleteall'	=> 'Êtes-vous sûr de vouloir supprimer tous les enregistrements de ce type ?',

	// ------------- Errors -------------
	'log_error_delete'	=> 'Une erreur s\'est produite lors de la suppression des enregistrements.',

	// ------------- Main ---------------
	'Log_failed_log_title'	=> 'Failed to log error at %s',
	'Log_failed_get_f_name'	=> 'Aucun nom de forum n\'a pu être obtenu',
	'Log_failed_get_u_name'	=> 'Aucun nom d\'utilisateur n\'a pu être obtenu',

	'Logging'	=> 'The Logger',
	'Log_view'	=> 'Enregistrements',

	'log_msgdie_default'	=> 'Une erreur vient de se produire sur ce forum. L\'administrateur en a été prévenu.',

//-- mod : the logger - proxy detection ----------------------------------------
//-- add
	'log_real_ip'	=> 'Adresse IP réelle',
//-- fin mod : the logger - proxy detection ------------------------------------
));

?>
