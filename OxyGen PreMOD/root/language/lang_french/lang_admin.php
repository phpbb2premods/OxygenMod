<?php
/**
*
* @version $Id: lang_admin.php,v 1.35.2.17 2006/02/05 15:59:48 grahamje Exp $
* @copyright (C) 2001 The phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @Translation: Helix < http://www.phpbb-fr.com/ >
* @Translation: ABDev < http://www.oxygen-powered.net/ >
*
*/

//
// Format is same as lang_main
//

//
// Modules, this replaces the keys used
// in the modules[][] arrays in each module file
//
$lang['General'] = 'G�n�ral';
$lang['Users'] = 'Utilisateurs';
$lang['Groups'] = 'Groupes';
$lang['Forums'] = 'Forums';
$lang['Styles'] = 'Th�mes';

$lang['Configuration'] = 'Configuration';
$lang['Permissions'] = 'Permissions';
$lang['Manage'] = 'Gestion';
$lang['Disallow'] = 'Interdire un nom d\'utilisateur';
$lang['Prune'] = 'D�lester';
$lang['Mass_Email'] = 'E-mail de masse';
$lang['Ranks'] = 'Rangs';
$lang['Smilies'] = 'Smilies';
$lang['Ban_Management'] = 'Contr�le du bannissement';
$lang['Word_Censor'] = 'Censure';
$lang['Export'] = 'Exporter';
$lang['Create_new'] = 'Cr�er';
$lang['Add_new'] = 'Ajouter';
$lang['Backup_DB'] = 'Sauvegarder la base de donn�es';
$lang['Restore_DB'] = 'Restaurer la base de donn�es';


//
// Index
//
$lang['Admin'] = 'Administration';
$lang['Not_admin'] = 'Vous n\'�tes pas autoris� � administrer ce forum';
$lang['Welcome_phpBB'] = 'Bienvenue sur phpBB';
$lang['Admin_intro'] = 'Merci d\'avoir choisi phpBB comme solution de forum. Cet �cran vous donnera un rapide aper�u des diverses statistiques de votre forum. Vous pouvez revenir sur cette page en cliquant sur le lien <u>Index de l\'administration</u> dans le volet de gauche. Pour retourner � l\'index de votre forum, cliquez sur le logo phpBB dans le volet de gauche. Les autres liens du volet de gauche vous permettront de contr�ler tous les aspects de votre forum. Chaque page contiendra les instructions n�cessaires concernant l\'utilisation des outils.';
$lang['Main_index'] = 'Index du forum';
$lang['Forum_stats'] = 'Statistiques';
$lang['Admin_Index'] = 'Index de l\'administration';
$lang['Preview_forum'] = 'Aper�u du forum';

$lang['Click_return_admin_index'] = 'Cliquez %sici%s pour revenir � l\'index d\'administration';

$lang['Statistic'] = 'Statistique';
$lang['Value'] = 'Valeur';
$lang['Number_posts'] = 'Nombre de messages';
$lang['Posts_per_day'] = 'Messages par jour';
$lang['Number_topics'] = 'Nombre de sujets';
$lang['Topics_per_day'] = 'Sujets par jour';
$lang['Number_users'] = 'Nombre d\'utilisateurs';
$lang['Users_per_day'] = 'Utilisateurs par jour';
$lang['Board_started'] = 'Ouverture du forum';
$lang['Avatar_dir_size'] = 'Taille du dossier des avatars';
$lang['Database_size'] = 'Taille de la base de donn�es';
$lang['Gzip_compression'] ='Compression GZIP';
$lang['Not_available'] = 'Non disponible';

$lang['ON'] = 'ON'; // This is for GZip compression
$lang['OFF'] = 'OFF';


//
// Auth pages
//
$lang['Select_a_User'] = 'S�lectionner un utilisateur';
$lang['Select_a_Group'] = 'S�lectionner un groupe';
$lang['Select_a_Forum'] = 'S�lectionner un forum';
$lang['Auth_Control_User'] = 'Contr�le des permissions des utilisateurs';
$lang['Auth_Control_Group'] = 'Contr�le des permissions des groupes';
$lang['Auth_Control_Forum'] = 'Contr�le des permissions des forums';
$lang['Look_up_User'] = 'Rechercher l\'utilisateur';
$lang['Look_up_Group'] = 'Rechercher le groupe';
$lang['Look_up_Forum'] = 'Rechercher le forum';

$lang['Group_auth_explain'] = 'Depuis ce formulaire, vous pouvez modifier les permissions et les statuts de mod�rateurs assign�s � chaque groupe. N\'oubliez pas qu\'en changeant les permissions de groupe, les permissions individuelles d\'utilisateurs pourront toujours autoriser un utilisateur � entrer sur un forum, etc. Vous serez pr�venu le cas �ch�ant.';
$lang['User_auth_explain'] = 'Depuis ce formulaire, vous pouvez modifier les permissions et les statuts de mod�rateurs assign�s � chaque utilisateur, individuellement. N\'oubliez pas qu\'en changeant les permissions individuelles d\'utilisateurs, les permissions de groupe pourront toujours autoriser un utilisateur � entrer sur un forum, etc. Vous serez pr�venu le cas �ch�ant.';
$lang['Forum_auth_explain'] = 'Depuis ce formulaire, vous pouvez modifier les niveaux d\'acc�s de chaque forum. Vous aurez deux modes pour le faire, un mode simple, et un mode avanc�; le mode avanc� offre un plus grand contr�le sur le fonctionnement de chaque forum. Rappelez-vous qu\'en modifiant les niveaux d\'acc�s d\'un forum, les utilisateurs du forum pourront en �tre affect�s.';

$lang['Simple_mode'] = 'Mode simple';
$lang['Advanced_mode'] = 'Mode avanc�';
$lang['Moderator_status'] = 'Statut de mod�rateur';

$lang['Allowed_Access'] = 'Acc�s autoris�';
$lang['Disallowed_Access'] = 'Acc�s interdit';
$lang['Is_Moderator'] = 'est mod�rateur';
$lang['Not_Moderator'] = 'n\'est pas mod�rateur';

$lang['Conflict_warning'] = 'Avertissement : Conflit des autorisations';
$lang['Conflict_access_userauth'] = 'Cet utilisateur a toujours les droits d\'acc�s � ce forum gr�ce � son appartenance � un groupe. Vous pouvez modifier les permissions du groupe ou retirer cet utilisateur du groupe pour l\'emp�cher compl�tement d\'avoir les droits d\'acc�s. L\'attribution des droits par les groupes (et les forums concern�s) sont not�s ci-dessous.';
$lang['Conflict_mod_userauth'] = 'Cet utilisateur a toujours les droits de mod�ration � ce forum gr�ce � son appartenance � un groupe. Vous pouvez modifier les permissions du groupe ou retirer cet utilisateur du groupe pour l\'emp�cher compl�tement d\'avoir les droits de mod�ration. L\'attribution des droits par les groupes (et les forums concern�s) sont not�s ci-dessous.';

$lang['Conflict_access_groupauth'] = 'L\'utilisateur suivant (ou les utilisateurs) a toujours les droits d\'acc�s � ce forum gr�ce � ses permissions d\'utilisateur. Vous pouvez modifier les permissions d\'utilisateur pour l\'emp�cher compl�tement d\'avoir les droits d\'acc�s. L\'attribution des droits par les permissions d\'utilisateur (et les forums concern�s) sont not�s ci-dessous.';
$lang['Conflict_mod_groupauth'] = 'L\'utilisateur suivant (ou les utilisateurs) a toujours les droits de mod�ration � ce forum gr�ce � ses permissions d\'utilisateur. Vous pouvez modifier les permissions d\'utilisateur pour l\'emp�cher compl�tement d\'avoir les droits de mod�ration. L\'attribution des droits par les permissions d\'utilisateur (et les forums concern�s) sont not�s ci-dessous.';

$lang['Public'] = 'Public';
$lang['Private'] = 'Priv�';
$lang['Registered'] = 'Enregistr�';
$lang['Administrators'] = 'Administrateurs';
$lang['Hidden'] = 'Invisible';

// These are displayed in the drop down boxes for advanced
// mode forum auth, try and keep them short!
$lang['Forum_ALL'] = 'TOUS';
$lang['Forum_REG'] = 'MEMBRES';
$lang['Forum_PRIVATE'] = 'PRIVE';
$lang['Forum_MOD'] = 'MOD';
$lang['Forum_ADMIN'] = 'ADMIN';

$lang['View'] = 'Voir';
$lang['Read'] = 'Lire';
$lang['Post'] = '�mettre';
$lang['Reply'] = 'R�pondre';
$lang['Edit'] = 'Editer';
$lang['Delete'] = 'Supprimer';
$lang['Sticky'] = 'Note';
$lang['Announce'] = 'Annoncer';
$lang['Vote'] = 'Voter';
$lang['Pollcreate'] = 'Cr�er un sondage';

$lang['Permissions'] = 'Permissions';
$lang['Simple_Permission'] = 'Permission simple';

$lang['User_Level'] = 'Niveau de l\'utilisateur';
$lang['Auth_User'] = 'Utilisateur';
$lang['Auth_Admin'] = 'Administrateur';
$lang['Group_memberships'] = 'Effectifs des groupes d\'utilisateurs';
$lang['Usergroup_members'] = 'Ce groupe est compos� des membres suivants';

$lang['Forum_auth_updated'] = 'Permissions du forum mises � jour';
$lang['User_auth_updated'] = 'Permissions de l\'utilisateur mises � jour';
$lang['Group_auth_updated'] = 'Permissions du groupe mises � jour';

$lang['Auth_updated'] = 'Les permissions ont �t� mises � jour';
$lang['Click_return_userauth'] = 'Cliquez %sici%s pour revenir aux permissions d\'utilisateurs';
$lang['Click_return_groupauth'] = 'Cliquez %sici%s pour revenir aux permissions de groupes';
$lang['Click_return_forumauth'] = 'Cliquez %sici%s pour revenir aux permissions des forums';


//
// Banning
//
$lang['Ban_control'] = 'Bannissement';
$lang['Ban_explain'] = 'Depuis ce formulaire, vous pouvez contr�ler les bannissements des utilisateurs. Vous pouvez accomplir cela en bannissant soit un utilisateur sp�cifique, soit un intervalle d\'adresses IP ou un nom de serveur. Ces m�thodes emp�cheront un utilisateur d\'atteindre votre forum. Pour emp�cher un utilisateur de s\'enregistrer sous un nom d\'utilisateur diff�rent, vous pouvez �galement bannir une adresse e-mail sp�cifique. Veuillez noter que bannir uniquement l\'adresse e-mail n\'emp�chera pas l\'utilisateur concern� de se connecter ou poster sur votre forum; vous devrez utiliser l\'une des deux m�thodes cit�es ci-dessus.';
$lang['Ban_explain_warn'] = 'Veuillez noter qu\'entrer un intervalle d\'adresses IP aura pour r�sultat de prendre en compte toutes les adresses entre l\'IP de d�part et l\'IP de fin dans la liste de bannissement. Des essais seront effectu�s afin de r�duire le nombre d\'adresses IP ajout�es � la base de donn�es en introduisant des jokers automatiquement aux endroits appropri�s. Si vous devez r�ellement entrer un intervalle, essayez de le garder r�duit ou au mieux, fixez des adresses sp�cifiques.';

$lang['Select_username'] = 'S�lectionner un nom d\'utilisateur';
$lang['Select_ip'] = 'S�lectionner une adresse IP';
$lang['Select_email'] = 'S�lectionner une adresse e-mail';

$lang['Ban_username'] = 'Bannir un ou plusieurs utilisateurs sp�cifiques';
$lang['Ban_username_explain'] = 'Vous pouvez bannir plusieurs utilisateurs d\'une fois en utilisant la combinaison appropri�e de souris et clavier pour votre ordinateur et navigateur internet';

$lang['Ban_IP'] = 'Bannir une ou plusieurs adresses IP ou noms de serveurs';
$lang['IP_hostname'] = 'Adresses IP ou noms de serveurs';
$lang['Ban_IP_explain'] = 'Pour sp�cifier plusieurs IP ou noms de serveurs diff�rents, s�parez-les par des virgules. Pour sp�cifier un intervalle d\'adresses IP, s�parez le d�but et la fin avec un trait d\'union (-); pour sp�cifier un joker, utilisez une �toile (*)';

$lang['Ban_email'] = 'Bannir une ou plusieurs adresses e-mail';
$lang['Ban_email_explain'] = 'Pour sp�cifier plus d\'une adresse e-mail, s�parez-les par des virgules. Pour sp�cifier un joker pour le nom d\'utilisateur, utilisez * ; par exemple *@hotmail.com';

$lang['Unban_username'] = 'D�bannir un ou plusieurs utilisateurs sp�cifiques';
$lang['Unban_username_explain'] = 'Vous pouvez d�bannir plusieurs utilisateurs en une fois en utilisant la combinaison appropri�e de souris et clavier pour votre ordinateur et navigateur internet';

$lang['Unban_IP'] = 'D�bannir une ou plusieurs adresses IP';
$lang['Unban_IP_explain'] = 'Vous pouvez d�bannir plusieurs adresses IP en une fois en utilisant la combinaison appropri�e de souris et clavier pour votre ordinateur et navigateur internet';

$lang['Unban_email'] = 'D�bannir une ou plusieurs adresses e-mail';
$lang['Unban_email_explain'] = 'Vous pouvez d�bannir plusieurs adresses e-mail en une fois en utilisant la combinaison appropri�e de souris et clavier pour votre ordinateur et navigateur internet';

$lang['No_banned_users'] = 'Aucun nom d\'utilisateur banni';
$lang['No_banned_ip'] = 'Aucune adresse IP bannie'; 
$lang['No_banned_email'] = 'Aucune adresse e-mail bannie';

$lang['Ban_update_sucessful'] = 'La liste de bannissement a �t� mise � jour';
$lang['Click_return_banadmin'] = 'Cliquez %sici%s pour revenir au bannissement';


//
// Configuration
//
$lang['General_Config'] = 'Configuration g�n�rale';
$lang['Config_explain'] = 'Depuis ce formulaire, vous pouvez personnaliser toutes les options g�n�rales du forum.';

$lang['Click_return_config'] = 'Cliquez %sici%s pour revenir � la configuration g�n�rale';

$lang['General_settings'] = 'Options g�n�rales';
$lang['Server_name'] = 'Nom de domaine';
$lang['Server_name_explain'] = 'Le nom de domaine � partir duquel ce forum fonctionne';
$lang['Script_path'] = 'Chemin du script';
$lang['Script_path_explain'] = 'Le chemin relatif de phpBB2 par rapport au nom de domaine';
$lang['Server_port'] = 'Port du serveur';
$lang['Server_port_explain'] = 'Le port utilis� par votre serveur est habituellement le 80. Modifier uniquement si diff�rent';
$lang['Site_name'] = 'Nom du site';
$lang['Site_desc'] = 'Description du site';
$lang['Board_disable'] = 'D�sactiver le forum';
$lang['Board_disable_explain'] = 'Ceci rendra le forum indisponible aux utilisateurs. Toutefois, les administrateurs auront toujours acc�s � l\'ensemble du forum m�me si celui-ci est d�sactiv�.';
$lang['Acct_activation'] = 'Activation du compte';
$lang['Acc_None'] = 'Aucune'; // These three entries are the type of activation
$lang['Acc_User'] = 'Utilisateur';
$lang['Acc_Admin'] = 'Administrateur';

$lang['Abilities_settings'] = 'Options de base';
$lang['Max_poll_options'] = 'Nombre maximal d\'options pour les sondages';
$lang['Flood_Interval'] = 'Intervalle de flood';
$lang['Flood_Interval_explain'] = 'Temps en secondes durant lequel un utilisateur doit patienter avant de pouvoir �mettre de nouveau.';
$lang['Board_email_form'] = 'Messagerie e-mail via le forum';
$lang['Board_email_form_explain'] = 'Les utilisateurs s\'envoient des e-mail par ce forum';
$lang['Topics_per_page'] = 'Nombre de sujets affich�s par page';
$lang['Posts_per_page'] = 'Nombre de messages affich�s par page';
$lang['Hot_threshold'] = 'Seuil de messages pour �tre populaire';
$lang['Default_style'] = 'Th�me par d�faut';
$lang['Override_style'] = 'Annuler le th�me de l\'utilisateur';
$lang['Override_style_explain'] = 'Remplace le th�me de l\'utilisateur par le th�me par d�faut';
$lang['Default_language'] = 'Langue par d�faut';
$lang['Date_format'] = 'Format de la date';
$lang['System_timezone'] = 'Fuseau horaire';
$lang['Enable_gzip'] = 'Activer la compression GZIP';
$lang['Enable_prune'] = 'Activer le d�lestage du forum';
$lang['Allow_HTML'] = 'Autoriser le HTML';
$lang['Allow_BBCode'] = 'Autoriser le BBCode';
$lang['Allowed_tags'] = 'Balises HTML autoris�es';
$lang['Allowed_tags_explain'] = 'S�parer les balises avec des virgules';
$lang['Allow_smilies'] = 'Autoriser les smilies';
$lang['Smilies_path'] = 'Dossier de stockage des smilies';
$lang['Smilies_path_explain'] = 'Chemin relatif au forum, exemple : images/smiles';
$lang['Allow_sig'] = 'Autoriser les signatures';
$lang['Max_sig_length'] = 'Longueur maximale de la signature';
$lang['Max_sig_length_explain'] = 'Nombre maximal de caract�res dans la signature de l\'utilisateur';
$lang['Allow_name_change'] = 'Autoriser les changements de nom d\'utilisateur';

$lang['Avatar_settings'] = 'Avatars';
$lang['Allow_local'] = 'Activer la galerie des avatars';
$lang['Allow_remote'] = 'Activer les avatars � distance';
$lang['Allow_remote_explain'] = 'Les avatars sont stock�s sur un autre site web';
$lang['Allow_upload'] = 'Activer l\'envoi d\'avatar';
$lang['Max_filesize'] = 'Taille maximale du fichier avatar';
$lang['Max_filesize_explain'] = 'Pour les avatars envoy�s';
$lang['Max_avatar_size'] = 'Dimensions maximales de l\'avatar';
$lang['Max_avatar_size_explain'] = '(Hauteur x Largeur en pixels)';
$lang['Avatar_storage_path'] = 'Chemin de stockage des avatars';
$lang['Avatar_storage_path_explain'] = 'Chemin relatif au forum, exemple : images/avatars';
$lang['Avatar_gallery_path'] = 'Chemin de la galerie des avatars';
$lang['Avatar_gallery_path_explain'] = 'Chemin relatif au forum pour les images pr�-charg�es, exemple : images/avatars/gallery';

$lang['COPPA_settings'] = 'Options COPPA';
$lang['COPPA_fax'] = 'Num�ro de Fax COPPA';
$lang['COPPA_mail'] = 'Adresse postale de la COPPA';
$lang['COPPA_mail_explain'] = 'Ceci est l\'adresse postale o� les parents enverront le formulaire d\'enregistrement COPPA';

$lang['Email_settings'] = 'E-mail';
$lang['Admin_email'] = 'Adresse e-mail de l\'administrateur';
$lang['Email_sig'] = 'Signature e-mail';
$lang['Email_sig_explain'] = 'Ce texte sera attach� � tous les e-mails que le forum enverra';
$lang['Use_SMTP'] = 'Utiliser un serveur SMTP pour l\'e-mail';
$lang['Use_SMTP_explain'] = 'S�lectionner Oui si vous souhaitez ou devez envoyer des e-mails par un serveur sp�cifique au lieu de la fonction locale mail()';
$lang['SMTP_server'] = 'Adresse du serveur SMTP';
$lang['SMTP_username'] = 'Nom d\'utilisateur SMTP';
$lang['SMTP_username_explain'] = 'Entrez un nom d\'utilisateur pour votre serveur SMTP seulement si n�cessaire';
$lang['SMTP_password'] = 'Mot de passe SMTP';
$lang['SMTP_password_explain'] = 'Entrez un mot de passe pour votre serveur SMTP seulement si n�cessaire';

$lang['Disable_privmsg'] = 'Messagerie priv�e';

//-- mod : separate pm limits for admins and mods ------------------------------
//-- delete
/*-MOD
$lang['Inbox_limits'] = 'Messages Max dans la Bo�te de r�ception';
$lang['Sentbox_limits'] = 'Messages Max dans la Bo�te des messages envoy�s';
$lang['Savebox_limits'] = 'Message Max dans la Bo�te des Archives';
MOD-*/
//-- fin mod : separate pm limits for admins and mods --------------------------

$lang['Cookie_settings'] = 'Options du cooky';
$lang['Cookie_settings_explain'] = 'Ces d�tails d�finissent la mani�re dont les cookies sont envoy�s au navigateur internet des utilisateurs. Dans la majeure partie des cas, les valeurs par d�faut devraient �tre suffisantes. Si vous avez besoin de les modifier, faites-le avec pr�caution; des valeurs incorrectes pourraient emp�cher les utilisateurs de se connecter.';
$lang['Cookie_domain'] = 'Domaine du cooky';
$lang['Cookie_name'] = 'Nom du cooky';
$lang['Cookie_path'] = 'Chemin du cooky';
$lang['Cookie_secure'] = 'Cooky s�curis�';
$lang['Cookie_secure_explain'] = 'Si votre serveur fonctionne via SSL, activez cette fonction; sinon, laissez-la d�sactiv�e';
$lang['Session_length'] = 'Dur�e de la session [ secondes ]';

// Visual Confirmation
$lang['Visual_confirm'] = 'Activer la confirmation visuelle';
$lang['Visual_confirm_explain'] = 'Requiert que les nouveaux utilisateurs entrent un code d�fini par une image lors de leur enregistrement.';

// Autologin Keys - added 2.0.18
$lang['Allow_autologin'] = 'Permettre la connexion automatique';
$lang['Allow_autologin_explain'] = 'D�termine si l\'utilisateur est autoris� � choisir d\'�tre automatiquement connect� lors de sa visite sur le forum.';
$lang['Autologin_time'] = 'Expiration de la clef de connexion automatique';
$lang['Autologin_time_explain'] = 'Nombre de jour(s) durant le(s)quel(s) la clef de connexion automatique est valide si l\'utilisateur ne visite pas le forum. Mettre � z�ro pour d�sactiver l\'expiration.';

// Search Flood Control - added 2.0.20
$lang['Search_Flood_Interval'] = 'Intervalles de flood pour la recherche';
$lang['Search_Flood_Interval_explain'] = 'Temps en secondes durant lequel un utilisateur doit patienter avant de pouvoir lancer une nouvelle recherche.'; 

//
// Forum Management
//
$lang['Forum_admin'] = 'Administration des forums';
$lang['Forum_admin_explain'] = 'Vous pouvez ici ajouter, supprimer, �diter, r�ordonner et resynchroniser vos cat�gories et forums.';
$lang['Edit_forum'] = 'Editer un forum';
$lang['Create_forum'] = 'Nouveau forum';
$lang['Create_category'] = 'Nouvelle cat�gorie';
$lang['Remove'] = 'Enlever';
$lang['Action'] = 'Action';
$lang['Update_order'] = 'Mettre � jour l\'ordre';
$lang['Config_updated'] = 'Configuration du forum mise � jour';
$lang['Edit'] = 'Editer';
$lang['Delete'] = 'Supprimer';
$lang['Move_up'] = 'Monter';
$lang['Move_down'] = 'Descendre';
$lang['Resync'] = 'Resynchroniser';
$lang['No_mode'] = 'Aucun mode n\'a �t� d�fini';
$lang['Forum_edit_delete_explain'] = 'Depuis ce formulaire, vous pouvez personnaliser toutes les options g�n�rales du forum.';

$lang['Move_contents'] = 'D�placer tout le contenu vers';
$lang['Forum_delete'] = 'Supprimer un forum';
$lang['Forum_delete_explain'] = 'Depuis ce formulaire, vous pouvez supprimer un forum (ou une cat�gorie) et d�cider o� vous voulez mettre les messages (ou les forums) qu\'il contenait.';

$lang['Status_locked'] = 'Verrouill�';
$lang['Status_unlocked'] = 'D�verrouill�';
$lang['Forum_settings'] = 'Options g�n�rales des forums';
$lang['Forum_name'] = 'Nom du forum';
$lang['Forum_desc'] = 'Description';
$lang['Forum_status'] = 'Statut du forum';
$lang['Forum_pruning'] = 'Auto-d�lestage';

$lang['prune_freq'] = 'V�rifier l\'�ge des sujets tous les ';
$lang['prune_days'] = 'Retirer les sujets n\'ayant pas eu de r�ponses depuis';
$lang['Set_prune_data'] = 'Vous avez activ� l\'auto-d�lestage pour ce forum mais n\'avez pas d�fini une fr�quence ou un nombre de jours � d�lester. Veuillez revenir en arri�re et le faire';

$lang['Move_and_Delete'] = 'D�placer et supprimer';

$lang['Delete_all_posts'] = 'Supprimer tous les messages';
$lang['Nowhere_to_move'] = 'Nul part o� d�placer';

$lang['Edit_Category'] = 'Editer une cat�gorie';
$lang['Edit_Category_explain'] = 'Utilisez ce formulaire pour modifer le nom d\'une cat�gorie.';

$lang['Forums_updated'] = 'Informations du forum et de la cat�gorie mises � jour';

$lang['Must_delete_forums'] = 'Vous devez supprimer tous vos forums avant de pouvoir supprimer cette cat�gorie';

$lang['Click_return_forumadmin'] = 'Cliquez %sici%s pour revenir � l\'administration des forums';


//
// Smiley Management
//
$lang['smiley_title'] = 'Utilitaire d\'�dition des smiles';
$lang['smile_desc'] = 'Depuis cette page vous pouvez ajouter, retirer et �diter les smiles que les utilisateurs utilisent dans leurs messages et messages priv�s.';

$lang['smiley_config'] = 'Smiles';
$lang['smiley_code'] = 'Code du smile';
$lang['smiley_url'] = 'Fichier image du smile';
$lang['smiley_emot'] = '�motion du smile';
$lang['smile_add'] = 'Ajouter un nouveau smile';
$lang['Smile'] = 'Smile';
$lang['Emotion'] = '�motion';

$lang['Select_pak'] = 'Selectionner le package (fichier .pak)';
$lang['replace_existing'] = 'Remplacer les smiles existants';
$lang['keep_existing'] = 'Conserver les smiles existants';
$lang['smiley_import_inst'] = 'Vous devez d�zipper le pack de smiles et envoyer tous les fichiers dans le dossier de smiles appropri� pour l\'installation. Ensuite, s�lectionnez les informations correctes dans ce formulaire pour importer le pack de smiles.';
$lang['smiley_import'] = 'Importer un pack de smiles';
$lang['choose_smile_pak'] = 'Choisir un pack de smiles, fichier .pak';
$lang['import'] = 'Importer les smiles';
$lang['smile_conflicts'] = 'Que faire en cas de conflit ?';
$lang['del_existing_smileys'] = 'Supprimer les smiles existants avant l\'importation';
$lang['import_smile_pack'] = 'Importer un pack de smiles';
$lang['export_smile_pack'] = 'Cr�er un pack de smiles';
$lang['export_smiles'] = 'Pour cr�er un pack de smiles � partir de vos smiles actuellement install�s, cliquez %sici%s pour t�l�charger le fichier .pak de smiles. Nommez ce fichier de fa�on appropri�e afin de vous assurer de conserver l\'extension de fichier .pak. Ensuite, cr�ez un fichier zip contenant toutes les images de vos smiles plus le fichier de configuration .pak.';

$lang['smiley_add_success'] = 'Le smile a �t� ajout�';
$lang['smiley_edit_success'] = 'Le smile a �t� mis � jour';
$lang['smiley_import_success'] = 'Le pack de smiles a �t� import� !';
$lang['smiley_del_success'] = 'Le smile a �t� retir�';
$lang['Click_return_smileadmin'] = 'Cliquez %sici%s pour revenir � l\'administration des smiles';

$lang['Confirm_delete_smiley'] = 'Etes-vous s�r de vouloir supprimer ce smile ?';

//
// User Management
//
$lang['User_admin'] = 'Administration des utilisateurs';
$lang['User_admin_explain'] = 'Depuis ce formulaire, vous pouvez changer les informations des utilisateurs et certaines options sp�cifiques.';

$lang['Look_up_user'] = 'Rechercher l\'utilisateur';

$lang['Admin_user_fail'] = 'Impossible de mettre � jour le profil de l\'utilisateur.';
$lang['Admin_user_updated'] = 'Le profil de l\'utilisateur a �t� mis � jour avec succ�s.';
$lang['Click_return_useradmin'] = 'Cliquez %sici%s pour revenir � l\'administration des utilisateurs';

$lang['User_delete'] = 'Supprimer cet utilisateur';
$lang['User_delete_explain'] = 'Cliquez ici pour supprimer cet utilisateur; cette op�ration est irr�versible.';
$lang['User_deleted'] = 'L\'utilisateur a �t� supprim�.';

$lang['User_status'] = 'L\'utilisateur est actif';
$lang['User_allowpm'] = 'Peut envoyer des messages priv�s';
$lang['User_allowavatar'] = 'Peut afficher un avatar';

$lang['Admin_avatar_explain'] = 'Ici vous pouvez voir et supprimer l\'avatar actuel de l\'utilisateur.';

$lang['User_special'] = 'Champs sp�ciaux pour administrateurs uniquement';
$lang['User_special_explain'] = 'Ces champs ne peuvent pas �tre modifi�s par l\'utilisateur. Ici, vous pouvez d�finir leur statut et d\'autres options non-accessibles aux utilisateurs.';


//
// Group Management
//
$lang['Group_administration'] = 'Administration des groupes';
$lang['Group_admin_explain'] = 'Depuis ce panneau, vous pouvez administrer tous vos groupes d\'utilisateurs. Vous pouvez supprimer, cr�er et �diter les groupes existants. Vous pouvez choisir des mod�rateurs, alterner le statut ouvert/ferm� d\'un groupe et d�finir le nom et la description d\'un groupe';
$lang['Error_updating_groups'] = 'Il y a eu une erreur durant la mise � jour des groupes';
$lang['Updated_group'] = 'Le groupe a �t� mis � jour';
$lang['Added_new_group'] = 'Le nouveau groupe a �t� cr��';
$lang['Deleted_group'] = 'Le groupe a �t� supprim�';
$lang['New_group'] = 'Cr�er un nouveau groupe';
$lang['Edit_group'] = 'Editer un groupe';
$lang['group_name'] = 'Nom du groupe';
$lang['group_description'] = 'Description du groupe';
$lang['group_moderator'] = 'Mod�rateur du groupe';
$lang['group_status'] = 'Statut du groupe';
$lang['group_open'] = 'Groupe ouvert';
$lang['group_closed'] = 'Groupe ferm�';
$lang['group_hidden'] = 'Groupe invisible';
$lang['group_delete'] = 'Supprimer un groupe';
$lang['group_delete_check'] = 'Supprimer ce groupe';
$lang['submit_group_changes'] = 'Envoyer les modifications';
$lang['reset_group_changes'] = 'Remettre � zero';
$lang['No_group_name'] = 'Vous devez sp�cifier un nom pour ce groupe';
$lang['No_group_moderator'] = 'Vous devez sp�cifier un mod�rateur pour ce groupe';
$lang['No_group_mode'] = 'Vous devez sp�cifier un mode pour ce groupe, ouvert ou ferm�';
$lang['No_group_action'] = 'Aucune action n\'a �t� sp�cifi�e';
$lang['delete_group_moderator'] = 'Supprimer l\'ancien mod�rateur du groupe ?';
$lang['delete_moderator_explain'] = 'Si vous changez le mod�rateur du groupe, cochez cette case pour enlever l\'ancien mod�rateur de ce groupe. Sinon, vous pouvez ne pas la cocher, et l\'utilisateur deviendra un membre r�gulier de ce groupe.';
$lang['Click_return_groupsadmin'] = 'Cliquez %sici%s pour revenir � l\'administration des groupes.';
$lang['Select_group'] = 'S�lectionner un groupe';
$lang['Look_up_group'] = 'Rechercher le groupe';


//
// Prune Administration
//
$lang['Forum_Prune'] = 'D�lester un forum';
$lang['Forum_Prune_explain'] = 'Ceci supprimera tous les sujets n\'ayant pas eu de r�ponses depuis le nombre de jours que vous aurez choisi. Si vous n\'entrez pas de nombre, tous les sujets seront supprim�s. Par contre cela ne supprimera ni les sujets dans lesquels un sondage est encore en cours, ni les annonces. Vous devrez supprimer ces sujets manuellement.';
$lang['Do_Prune'] = 'Faire le d�lestage';
$lang['All_Forums'] = 'Tous les forums';
$lang['Prune_topics_not_posted'] = 'D�lester les sujets sans r�ponses depuis cette p�riode (en jours)';
$lang['Topics_pruned'] = 'Sujets d�lest�s';
$lang['Posts_pruned'] = 'Messages d�lest�s';
$lang['Prune_success'] = 'Le d�lestage des forums s\'est correctement d�roul�.';


//
// Word censor
//
$lang['Words_title'] = 'Censure';
$lang['Words_explain'] = 'Depuis ce panneau de contr�le, vous pouvez ajouter, �diter, et retirer les mots qui seront automatiquement censur�s sur vos forums. De plus, les gens ne seront pas autoris�s � s\'inscrire avec des noms d\'utilisateurs contenant ces mots. Les jokers (*) sont accept�s dans le champ \'Mot\', exemple : *test* concordera avec detestable, test* concordera avec testing, et *test avec detest.';
$lang['Word'] = 'Mot';
$lang['Edit_word_censor'] = 'Editer Cette censure';
$lang['Replacement'] = 'Remplacement';
$lang['Add_new_word'] = 'Ajouter une censure';
$lang['Update_word'] = 'Mettre � jour cette censure';

$lang['Must_enter_word'] = 'Vous devez entrer une censure et sa rempla�ante';
$lang['No_word_selected'] = 'Aucune censure s�lectionn�e pour l\'�dition';

$lang['Word_updated'] = 'La censure s�lectionn�e a �t� mise � jour';
$lang['Word_added'] = 'La censure a �t� ajout�e';
$lang['Word_removed'] = 'La censure s�lectionn�e a �t� retir�e';

$lang['Click_return_wordadmin'] = 'Cliquez %sici%s pour revenir � l\'administration de la censure';

$lang['Confirm_delete_word'] = 'Etes-vous s�r de vouloir supprimer cette censure ?';


//
// Mass Email
//
$lang['Mass_email_explain'] = 'Ici, vous pouvez envoyer le m�me e-mail � tous les utilisateurs du forum ou seulement � ceux d\'un groupe donn�. Pour ce faire, un e-mail sera envoy� en copie cach�e � partir de l\'adresse e-mail d\'administration vers ses destinataires. L\'envoi massif d\'e-mail prend un certain temps; soyez patient apr�s l\'envoi et n\'interrompez pas le chargement de la page. Vous serez averti automatiquement de la fin de l\'op�ration.';
$lang['Compose'] = 'Composer';

$lang['Recipients'] = 'Destinataires';
$lang['All_users'] = 'Tous les utilisateurs';

$lang['Email_successfull'] = 'Votre message a �t� envoy�';
$lang['Click_return_massemail'] = 'Cliquez %sici%s pour revenir au formulaire de l\'e-mail de masse';


//
// Ranks admin
//
$lang['Ranks_title'] = 'Administration des rangs';
$lang['Ranks_explain'] = 'Depuis ce formulaire, vous pouvez ajouter, �diter, voir et supprimer des rangs. Vous pouvez �galement cr�er des rangs personnalis�s qui pourront �tre assign�s � des utilisateurs sp�cifiques via le gestionnaire des utilisateurs';

$lang['Add_new_rank'] = 'Ajouter un nouveau rang';

$lang['Rank_title'] = 'Titre';
$lang['Rank_special'] = 'Rang sp�cial';
$lang['Rank_minimum'] = 'Messages minimums'; 
$lang['Rank_maximum'] = 'Messages maximums';
$lang['Rank_image'] = 'Image du rang (chemin relatif)';
$lang['Rank_image_explain'] = 'Utilisez ceci pour associer une image au rang';

$lang['Must_select_rank'] = 'Vous devez s�lectionner un rang';
$lang['No_assigned_rank'] = 'Aucun rang sp�cial assign�';

$lang['Rank_updated'] = 'Le rang a �t� mis � jour';
$lang['Rank_added'] = 'Le rang a �t� ajout�';
$lang['Rank_removed'] = 'Le rang a �t� supprim�';
$lang['No_update_ranks'] = 'Le rang a �t� supprim�; toutefois, les comptes des utilisateurs n\'ont pas �t� mis � jour. Vous devrez remettre � z�ro manuellement leur rang.';

$lang['Click_return_rankadmin'] = 'Cliquez %sici%s pour revenir � l\'administration des rangs';

$lang['Confirm_delete_rank'] = 'Etes-vous s�r de vouloir supprimer ce rang ?';

//
// Disallow Username Admin
//
$lang['Disallow_control'] = 'Contr�le des noms d\'utilisateurs interdits';
$lang['Disallow_explain'] = 'Ici, vous pouvez contr�ler les noms d\'utilisateurs qui seront interdits � l\'usage. Les noms d\'utilisateurs interdits peuvent contenir un caract�re joker (*). Veuillez noter que vous ne pourrez pas interdire un nom d\'utilisateur d�j� enregistr�; vous devrez d\'abord supprimer le compte de l\'utilisateur et ensuite interdire le nom d\'utilisateur';

$lang['Delete_disallow'] = 'Supprimer';
$lang['Delete_disallow_title'] = 'Retirer un nom d\'utilisateur interdit';
$lang['Delete_disallow_explain'] = 'Vous pouvez retirer un nom d\'utilisateur interdit en s�lectionnant le nom d\'utilisateur depuis la liste et en cliquant sur Supprimer';

$lang['Add_disallow'] = 'Ajouter';
$lang['Add_disallow_title'] = 'Ajouter un nom d\'utilisateur interdit';
$lang['Add_disallow_explain'] = 'Vous pouvez interdire un nom d\'utilisateur en utilisant le caract�re joker *';

$lang['No_disallowed'] = 'Aucun nom d\'utilisateur interdit';

$lang['Disallowed_deleted'] = 'Le nom d\'utilisateur interdit a �t� retir�';
$lang['Disallow_successful'] = 'Le nom d\'utilisateur interdit a �t� ajout�';
$lang['Disallowed_already'] = 'Le nom que vous avez entr� ne peut �tre interdit. Soit il existe d�j� dans la liste, soit il est dans la liste des mots censur�s, ou soit il est d�j� enregistr�';

$lang['Click_return_disallowadmin'] = 'Cliquez %sici%s pour revenir � l\'administration des noms d\'utilisateurs interdits';


//
// Styles Admin
//
$lang['Styles_admin'] = 'Administration des th�mes';
$lang['Styles_explain'] = 'En utilisant cet outil, vous pouvez ajouter, �diter, supprimer et g�rer les th�mes (mod�les de documents et th�mes) disponibles aupr�s des utilisateurs.';
$lang['Styles_addnew_explain'] = 'La liste suivante contient tous les th�mes actuellement disponibles pour le mod�le de document courant. Les �l�ments sur cette liste n\'ont pas encore �t� install�s dans la base de donn�es de phpBB. Pour installer un th�me, il suffit de cliquer sur le lien \'Installer\' � c�t� d\'une entr�e';

$lang['Select_template'] = 'S�lectionner un mod�le de document';

$lang['Style'] = 'Th�me';
$lang['Template'] = 'Mod�le de document';
$lang['Install'] = 'Installer';
$lang['Download'] = 'T�l�charger';

$lang['Edit_theme'] = 'Editer un th�me';
$lang['Edit_theme_explain'] = 'Depuis ce formulaire, vous pouvez �diter les param�tres pour le th�me s�lectionn�';

$lang['Create_theme'] = 'Cr�er un th�me';
$lang['Create_theme_explain'] = 'Utilisez le formulaire ci-dessous pour cr�er un nouveau th�me pour un mod�le de document s�lectionn�. Lorsque vous entrerez les couleurs (pour lesquelles vous devrez utiliser une notation hexad�cimale), vous ne devrez pas inclure le # initial, exemple : CCCCCC est valide, #CCCCCC ne l\'est pas';

$lang['Export_themes'] = 'Exporter des th�mes';
$lang['Export_explain'] = 'Dans ce panneau, vous pourrez exporter les donn�es de ce th�me pour un mod�le de document s�lectionn�. S�lectionnez le mod�le de document depuis la liste ci-dessous, et le script cr�era le fichier de configuration du th�me et essaiera de le copier dans le r�pertoire s�lectionn� des mod�les de documents. S\'il ne peut pas le copier lui-m�me, il vous proposera de le t�l�charger. Afin que le script puisse copier le fichier, vous devez donner les droits d\'�criture pour le r�pertoire sur le serveur. Pour plus d\'informations � propos de cela, allez voir le Guide de l\'utilisateur de phpBB 2.';

$lang['Theme_installed'] = 'Le th�me s�lectionn� a �t� install�';
$lang['Style_removed'] = 'Le th�me s�lectionn� a �t� retir� de la base de donn�es. Pour enlever compl�tement ce th�me de votre syst�me, vous devez supprimer les fichiers appropri�s dans le r�pertoire du mod�le de document.';
$lang['Theme_info_saved'] = 'Les informations du th�me pour le mod�le de document s�lectionn� ont �t� sauvegard�es. Vous devriez restreindre les permissions du fichier theme_info.cfg (et si possible dans le r�pertoire du mod�le de document s�lectionn�) � la lecture seule';
$lang['Theme_updated'] = 'Le th�me s�lectionn� a �t� mis � jour. Vous devriez exporter maintenant les nouveaux param�tres du th�me';
$lang['Theme_created'] = 'Th�me cr��. Vous devriez exporter maintenant le th�me vers le fichier de configuration du th�me pour le conserver en lieu s�r ou l\'utiliser ailleurs';

$lang['Confirm_delete_style'] = '-tes-vous s�r de vouloir supprimer ce th�me ?';

$lang['Download_theme_cfg'] = 'L\'exportateur n\'arrive pas � �crire le fichier des informations du th�me. Cliquez sur le bouton ci-dessous pour t�l�charger ce fichier avec votre navigateur internet. Une fois t�l�charg�, vous pourrez le transf�rer vers le r�pertoire contenant les mod�les de documents. Vous pourrez ensuite cr�er un pack des fichiers pour le distribuer ou l\'utiliser ailleurs si vous le d�sirez';
$lang['No_themes'] = 'Le mod�le de document que vous avez s�lectionn� n\'a pas de th�me. Pour cr�er un nouveau th�me, cliquez sur Cr�er un Nouveau Th�me sur le volet de gauche';
$lang['No_template_dir'] = 'Impossible d\'ouvrir le r�pertoire du mod�le de document. Il peut �tre illisible par le serveur ou ne pas exister';
$lang['Cannot_remove_style'] = 'Vous ne pouvez pas enlever le th�me s�lectionn� tant qu\'il est utilis� par le forum en tant que th�me par d�faut. Veuillez changer le th�me par d�faut et r�essayer.';
$lang['Style_exists'] = 'Le nom du th�me choisi existe d�j�; veuillez revenir en arri�re et choisir un nom diff�rent.';

$lang['Click_return_styleadmin'] = 'Cliquez %sici%s pour revenir � l\'administration des th�mes';

$lang['Theme_settings'] = 'Options du th�me';
$lang['Theme_element'] = 'El�ment du th�me';
$lang['Simple_name'] = 'Nom simple';
$lang['Value'] = 'Valeur';
$lang['Save_Settings'] = 'Sauvegarder les param�tres';

$lang['Stylesheet'] = 'Feuille de style CSS';
$lang['Stylesheet_explain'] = 'Nom du fichier pour la feuille de style CSS � utiliser pour ce th�me.';
$lang['Background_image'] = 'Image de fond';
$lang['Background_color'] = 'Couleur de fond';
$lang['Theme_name'] = 'Nom du th�me';
$lang['Link_color'] = 'Couleur du lien';
$lang['Text_color'] = 'Couleur du texte';
$lang['VLink_color'] = 'Couleur du lien Visit�';
$lang['ALink_color'] = 'Couleur du lien Actif';
$lang['HLink_color'] = 'Couleur du lien survol�';
$lang['Tr_color1'] = 'Table Rang�e Couleur 1';
$lang['Tr_color2'] = 'Table Rang�e Couleur 2';
$lang['Tr_color3'] = 'Table Rang�e Couleur 3';
$lang['Tr_class1'] = 'Table Rang�e Class 1';
$lang['Tr_class2'] = 'Table Rang�e Class 2';
$lang['Tr_class3'] = 'Table Rang�e Class 3';
$lang['Th_color1'] = 'Table En-t�te Couleur 1';
$lang['Th_color2'] = 'Table En-t�te Couleur 2';
$lang['Th_color3'] = 'Table En-t�te Couleur 3';
$lang['Th_class1'] = 'Table En-t�te Class 1';
$lang['Th_class2'] = 'Table En-t�te Class 2';
$lang['Th_class3'] = 'Table En-t�te Class 3';
$lang['Td_color1'] = 'Table Cellule Couleur 1';
$lang['Td_color2'] = 'Table Cellule Couleur 2';
$lang['Td_color3'] = 'Table Cellule Couleur 3';
$lang['Td_class1'] = 'Table Cellule Class 1';
$lang['Td_class2'] = 'Table Cellule Class 2';
$lang['Td_class3'] = 'Table Cellule Class 3';
$lang['fontface1'] = 'Nom de la police 1';
$lang['fontface2'] = 'Nom de la police 2';
$lang['fontface3'] = 'Nom de la police 3';
$lang['fontsize1'] = 'Taille Police 1';
$lang['fontsize2'] = 'Taille Police 2';
$lang['fontsize3'] = 'Taille Police 3';
$lang['fontcolor1'] = 'Couleur Police 1';
$lang['fontcolor2'] = 'Couleur Police 2';
$lang['fontcolor3'] = 'Couleur Police 3';
$lang['span_class1'] = 'Span Class 1';
$lang['span_class2'] = 'Span Class 2';
$lang['span_class3'] = 'Span Class 3';
$lang['img_poll_size'] = 'Taille Image Sondage [px]';
$lang['img_pm_size'] = 'Taille Statut Message Priv� [px]';


//
// Install Process
//
$lang['Welcome_install'] = 'Bienvenue � l\'installation de phpBB 2';
$lang['Initial_config'] = 'Configuration de base';
$lang['DB_config'] = 'Configuration de la base de donn�es';
$lang['Admin_config'] = 'Configuration du compte administrateur';
$lang['continue_upgrade'] = 'Une fois que vous avez t�l�charg� le fichier config.php vers votre ordinateur, vous pouvez cliquer sur le boutton \'Continuer la Mise � jour\' ci-dessous pour progresser dans le processus de mise � jour. Veuillez attendre la fin du processus de mise � jour avant d\'envoyer le fichier config.php.';
$lang['upgrade_submit'] = 'Continuer la mise � jour';

$lang['Installer_Error'] = 'Une erreur s\'est produite durant l\'installation';
$lang['Previous_Install'] = 'Une installation pr�c�dente a �t� d�tect�e';
$lang['Install_db_error'] = 'Une erreur s\'est produite en essayant de mettre � jour la base de donn�es';

$lang['Re_install'] = 'Votre installation pr�c�dente est toujours active. <br /><br />Si vous voulez r�installer phpBB 2, cliquez sur le bouton Oui ci-dessous. Vous �tes conscient qu\'en faisant cela, vous d�truirez toutes les donn�es existantes; aucune sauvegarde ne sera faite ! Le nom d\'utilisateur de l\'administrateur et le mot de passe que vous utilisez pour vous connecter au forum sera recr�� apr�s la r�installation; rien d\'autre ne sera fait conserv�. <br /><br />R�fl�chissez bien avant d\'appuyer sur Oui !';

$lang['Inst_Step_0'] = 'Merci d\'avoir choisi phpBB 2. Afin d\'achever cette installation, veuillez remplir les d�tails demand�s ci-dessous. Veuillez noter que la base de donn�es dans laquelle vous installez devrait d�j� exister. Si vous �tes en train d\'installer sur une base de donn�es qui utilise ODBC, MS Access par exemple, vous devez d\'abord lui cr�er un SGBD avant de continuer.';

$lang['Start_Install'] = 'D�marrer l\'installation';
$lang['Finish_Install'] = 'Finir l\'installation';

$lang['Default_lang'] = 'Langue par d�faut du forum';
$lang['DB_Host'] = 'Nom du serveur de base de donn�es / SGBD';
$lang['DB_Name'] = 'Nom de votre base de donn�es';
$lang['DB_Username'] = 'Nom d\'utilisateur';
$lang['DB_Password'] = 'Mot de passe';
$lang['Database'] = 'Votre base de donn�es';
$lang['Install_lang'] = 'Choisissez la langue pour l\'installation';
$lang['dbms'] = 'Type de la base de donn�es';
$lang['Table_Prefix'] = 'Pr�fixe des tables';
$lang['Admin_Username'] = 'Nom d\'utilisateur';
$lang['Admin_Password'] = 'Mot de passe';
$lang['Admin_Password_confirm'] = 'Mot de passe [ Confirmer ]';

$lang['Inst_Step_2'] = 'Votre compte d\'administration a �t� cr��. A ce point, l\'installation de base est termin�e. Vous allez �tre redirig� vers une nouvelle page qui vous permettra d\'administrer votre nouvelle installation. Veuillez vous assurer de v�rifier les d�tails de la Configuration G�n�rale et d\'op�rer les changements qui s\'imposent. Merci d\'avoir choisi phpBB 2.';

$lang['Unwriteable_config'] = 'Votre fichier config.php est en lecture seule actuellement. Une copie du fichier config.php va vous �tre propos�e en t�l�chargement apr�s avoir avoir cliqu� sur le boutton ci-dessous. Vous devrez envoyer ce fichier dans le m�me r�pertoire o� est install� phpBB 2. Une fois termin�, vous pourrez vous connecter en utilisant vos nom d\'utilisateur et mot de passe d\'administrateur que vous avez fourni pr�c�demment, et visiter le Panneau d\'Administration (un lien appara�tra en bas de chaque page une fois connect�) pour v�rifier la Configuration G�n�rale. Merci d\'avoir choisi phpBB 2.';
$lang['Download_config'] = 'T�l�charger le fichier config.php';

$lang['ftp_choose'] = 'Choisir la m�thode de t�l�chargement';
$lang['ftp_option'] = '<br />Tant que les extensions FTP seront activ�es dans cette version de PHP, l\'option d\'essayer d\'envoyer automatiquement le fichier config.php sur un ftp peut vous �tre donn�e.';
$lang['ftp_instructs'] = 'Vous avez choisi de transf�rer automatiquement via FTP le fichier vers le compte contenant phpBB 2. Veuillez compl�ter les informations ci-dessous afin de faciliter cette op�ration. Notez que le chemin FTP doit �tre le chemin exact vers le r�pertoire o� est install� phpBB2 comme si vous �tiez en train d\'envoyer le fichier avec n\'importe quel client FTP.';
$lang['ftp_info'] = 'Entrez vos informations FTP';
$lang['Attempt_ftp'] = 'Essayer de transf�rer le fichier config.php vers un serveur ftp';
$lang['Send_file'] = 'Juste m\'envoyer le fichier et je l\'enverrai manuellement sur le serveur ftp';
$lang['ftp_path'] = 'Chemin de phpBB2 FTP';
$lang['ftp_username'] = 'Votre nom d\'utilisateur FTP';
$lang['ftp_password'] = 'Votre mot de passe FTP';
$lang['Transfer_config'] = 'D�marrer le transfert';
$lang['NoFTP_config'] = 'La tentative d\'envoi du fichier config.php par FTP a �chou�. Veuillez t�l�charger le fichier config.php et l\'envoyer manuellement sur votre serveur FTP.';

$lang['Install'] = 'Installation';
$lang['Upgrade'] = 'Mise � jour';


$lang['Install_Method'] = 'Type d\'installation';

$lang['Install_No_Ext'] = 'La configuration PHP sur votre serveur ne supporte pas le type de base de donn�es que vous avez s�lectionn�';

$lang['Install_No_PCRE'] = 'phpBB2 requiert le support des expressions r�guli�res Perl pour PHP, mais votre configuration PHP ne semble pas le supporter !';

//
// Version Check
//
$lang['Version_up_to_date'] = 'Votre installation est � jour, aucune mise � jour n\'est disponible pour votre version de phpBB.';
$lang['Version_not_up_to_date'] = 'Votre installation de phpBB <b>ne semble pas</b> �tre � jour. Des mises � jours sont disponibles pour votre version de phpBB, veuillez visiter <a href="http://www.phpbb.com/downloads.php" target="_new">http://www.phpbb.com/downloads.php</a> ou <a href="http://www.phpbb-fr.com/">http://www.phpbb-fr.com/</a> afin d\'obtenir une version plus r�cente.';
$lang['Latest_version_info'] = 'La derni�re version de phpBB disponible est <b>phpBB %s</b>.';
$lang['Current_version_info'] = 'Vous utilisez <b>phpBB %s</b>.';
$lang['Connect_socket_error'] = 'Impossible d\'ouvrir une connection au serveur phpBB, l\'erreur retourn�e est :<br />%s.';
$lang['Socket_functions_disabled'] = 'Impossible d\'utiliser les fonctions de socket.';
$lang['Mailing_list_subscribe_reminder'] = 'Afin d\'obtenir les derni�res informations sur les mises � jours de phpBB, <a href="http://www.phpbb.com/support/" target="_new">inscrivez-vous � notre liste de diffusion</a> (en anglais).';
$lang['Version_information'] = 'Informations de version'; 

//
// Login attempts configuration
//
$lang['Max_login_attempts'] = 'Tentatives de connexions autoris�es';
$lang['Max_login_attempts_explain'] = 'Nombre maximum de tentatives de connexions qu\'un utilisateur peut soumettre avant qu\'il ne puisse plus se connecter.';
$lang['Login_reset_time'] = 'Temps de verrouillage de la connexion';
$lang['Login_reset_time_explain'] = 'Temps en minutes durant lequel un utilisateur, ayant d�pass� le nombre de tentatives de connexions autoris�es, ne pourra pas se connecter';

//
// That's all Folks!
// -------------------------------------------------

//-- mod : oxygen premod -------------------------------------------------------
//-- add
$lang['Files_folders'] = 'Fichiers et dossiers';
$lang['Files_folders_explain'] = '<b>Obligatoire</b> - Afin de pouvoir fonctionner correctement, OxyGen PreMOD a besoin d\'acc�der ou d\'�crire dans certains fichiers ou dossiers. Si vous voyez �<b style="color:red">Non-d�tect�</b>�, vous devrez cr�er le fichier ou dossier concern�. Si vous voyez �<b style="color:red">�criture impossible</b>�, vous devrez changer les permissions sur ce fichier ou dossier pour permettre � OxyGen PreMOD de pouvoir �crire dessus.';

$lang['Optional_files_folders'] = 'Fichiers et dossiers optionnels';
$lang['Optional_files_folders_explain'] = '<b>Optionnel</b> - Ces fichiers, dossiers ou permissions ne sont pas obligatoires. Le processus d\'installation tentera par divers moyens de les cr�er s\'ils n\'existent pas ou s\'ils ne peuvent �tre �crits. N�anmoins, la pr�sence de ceux-ci acc�lera la proc�dure d\'installation.';

$lang['Found'] = '<b style="color:green">D�tect�</b>';
$lang['Not_found'] = '<b style="color:red">Non-d�tect�</b>';
$lang['Writeable'] = ', <b style="color:green">�criture autoris�e</b>';
$lang['Unwriteable'] = ', <b style="color:red">�criture impossible (CHMOD 777)</b>';
$lang['Unmodifiable'] = ', <b style="color:red">�criture impossible (CHMOD 666)</b>';
//-- fin mod : oxygen premod ---------------------------------------------------

?>
