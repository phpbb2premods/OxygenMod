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
$lang['General'] = 'Général';
$lang['Users'] = 'Utilisateurs';
$lang['Groups'] = 'Groupes';
$lang['Forums'] = 'Forums';
$lang['Styles'] = 'Thèmes';

$lang['Configuration'] = 'Configuration';
$lang['Permissions'] = 'Permissions';
$lang['Manage'] = 'Gestion';
$lang['Disallow'] = 'Interdire un nom d\'utilisateur';
$lang['Prune'] = 'Délester';
$lang['Mass_Email'] = 'E-mail de masse';
$lang['Ranks'] = 'Rangs';
$lang['Smilies'] = 'Smilies';
$lang['Ban_Management'] = 'Contrôle du bannissement';
$lang['Word_Censor'] = 'Censure';
$lang['Export'] = 'Exporter';
$lang['Create_new'] = 'Créer';
$lang['Add_new'] = 'Ajouter';
$lang['Backup_DB'] = 'Sauvegarder la base de données';
$lang['Restore_DB'] = 'Restaurer la base de données';


//
// Index
//
$lang['Admin'] = 'Administration';
$lang['Not_admin'] = 'Vous n\'êtes pas autorisé à administrer ce forum';
$lang['Welcome_phpBB'] = 'Bienvenue sur phpBB';
$lang['Admin_intro'] = 'Merci d\'avoir choisi phpBB comme solution de forum. Cet écran vous donnera un rapide aperçu des diverses statistiques de votre forum. Vous pouvez revenir sur cette page en cliquant sur le lien <u>Index de l\'administration</u> dans le volet de gauche. Pour retourner à l\'index de votre forum, cliquez sur le logo phpBB dans le volet de gauche. Les autres liens du volet de gauche vous permettront de contrôler tous les aspects de votre forum. Chaque page contiendra les instructions nécessaires concernant l\'utilisation des outils.';
$lang['Main_index'] = 'Index du forum';
$lang['Forum_stats'] = 'Statistiques';
$lang['Admin_Index'] = 'Index de l\'administration';
$lang['Preview_forum'] = 'Aperçu du forum';

$lang['Click_return_admin_index'] = 'Cliquez %sici%s pour revenir à l\'index d\'administration';

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
$lang['Database_size'] = 'Taille de la base de données';
$lang['Gzip_compression'] ='Compression GZIP';
$lang['Not_available'] = 'Non disponible';

$lang['ON'] = 'ON'; // This is for GZip compression
$lang['OFF'] = 'OFF';


//
// Auth pages
//
$lang['Select_a_User'] = 'Sélectionner un utilisateur';
$lang['Select_a_Group'] = 'Sélectionner un groupe';
$lang['Select_a_Forum'] = 'Sélectionner un forum';
$lang['Auth_Control_User'] = 'Contrôle des permissions des utilisateurs';
$lang['Auth_Control_Group'] = 'Contrôle des permissions des groupes';
$lang['Auth_Control_Forum'] = 'Contrôle des permissions des forums';
$lang['Look_up_User'] = 'Rechercher l\'utilisateur';
$lang['Look_up_Group'] = 'Rechercher le groupe';
$lang['Look_up_Forum'] = 'Rechercher le forum';

$lang['Group_auth_explain'] = 'Depuis ce formulaire, vous pouvez modifier les permissions et les statuts de modérateurs assignés à chaque groupe. N\'oubliez pas qu\'en changeant les permissions de groupe, les permissions individuelles d\'utilisateurs pourront toujours autoriser un utilisateur à entrer sur un forum, etc. Vous serez prévenu le cas échéant.';
$lang['User_auth_explain'] = 'Depuis ce formulaire, vous pouvez modifier les permissions et les statuts de modérateurs assignés à chaque utilisateur, individuellement. N\'oubliez pas qu\'en changeant les permissions individuelles d\'utilisateurs, les permissions de groupe pourront toujours autoriser un utilisateur à entrer sur un forum, etc. Vous serez prévenu le cas échéant.';
$lang['Forum_auth_explain'] = 'Depuis ce formulaire, vous pouvez modifier les niveaux d\'accès de chaque forum. Vous aurez deux modes pour le faire, un mode simple, et un mode avancé; le mode avancé offre un plus grand contrôle sur le fonctionnement de chaque forum. Rappelez-vous qu\'en modifiant les niveaux d\'accès d\'un forum, les utilisateurs du forum pourront en être affectés.';

$lang['Simple_mode'] = 'Mode simple';
$lang['Advanced_mode'] = 'Mode avancé';
$lang['Moderator_status'] = 'Statut de modérateur';

$lang['Allowed_Access'] = 'Accès autorisé';
$lang['Disallowed_Access'] = 'Accès interdit';
$lang['Is_Moderator'] = 'est modérateur';
$lang['Not_Moderator'] = 'n\'est pas modérateur';

$lang['Conflict_warning'] = 'Avertissement : Conflit des autorisations';
$lang['Conflict_access_userauth'] = 'Cet utilisateur a toujours les droits d\'accès à ce forum grâce à son appartenance à un groupe. Vous pouvez modifier les permissions du groupe ou retirer cet utilisateur du groupe pour l\'empêcher complètement d\'avoir les droits d\'accès. L\'attribution des droits par les groupes (et les forums concernés) sont notés ci-dessous.';
$lang['Conflict_mod_userauth'] = 'Cet utilisateur a toujours les droits de modération à ce forum grâce à son appartenance à un groupe. Vous pouvez modifier les permissions du groupe ou retirer cet utilisateur du groupe pour l\'empêcher complètement d\'avoir les droits de modération. L\'attribution des droits par les groupes (et les forums concernés) sont notés ci-dessous.';

$lang['Conflict_access_groupauth'] = 'L\'utilisateur suivant (ou les utilisateurs) a toujours les droits d\'accès à ce forum grâce à ses permissions d\'utilisateur. Vous pouvez modifier les permissions d\'utilisateur pour l\'empêcher complètement d\'avoir les droits d\'accès. L\'attribution des droits par les permissions d\'utilisateur (et les forums concernés) sont notés ci-dessous.';
$lang['Conflict_mod_groupauth'] = 'L\'utilisateur suivant (ou les utilisateurs) a toujours les droits de modération à ce forum grâce à ses permissions d\'utilisateur. Vous pouvez modifier les permissions d\'utilisateur pour l\'empêcher complètement d\'avoir les droits de modération. L\'attribution des droits par les permissions d\'utilisateur (et les forums concernés) sont notés ci-dessous.';

$lang['Public'] = 'Public';
$lang['Private'] = 'Privé';
$lang['Registered'] = 'Enregistré';
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
$lang['Post'] = 'Émettre';
$lang['Reply'] = 'Répondre';
$lang['Edit'] = 'Editer';
$lang['Delete'] = 'Supprimer';
$lang['Sticky'] = 'Note';
$lang['Announce'] = 'Annoncer';
$lang['Vote'] = 'Voter';
$lang['Pollcreate'] = 'Créer un sondage';

$lang['Permissions'] = 'Permissions';
$lang['Simple_Permission'] = 'Permission simple';

$lang['User_Level'] = 'Niveau de l\'utilisateur';
$lang['Auth_User'] = 'Utilisateur';
$lang['Auth_Admin'] = 'Administrateur';
$lang['Group_memberships'] = 'Effectifs des groupes d\'utilisateurs';
$lang['Usergroup_members'] = 'Ce groupe est composé des membres suivants';

$lang['Forum_auth_updated'] = 'Permissions du forum mises à jour';
$lang['User_auth_updated'] = 'Permissions de l\'utilisateur mises à jour';
$lang['Group_auth_updated'] = 'Permissions du groupe mises à jour';

$lang['Auth_updated'] = 'Les permissions ont été mises à jour';
$lang['Click_return_userauth'] = 'Cliquez %sici%s pour revenir aux permissions d\'utilisateurs';
$lang['Click_return_groupauth'] = 'Cliquez %sici%s pour revenir aux permissions de groupes';
$lang['Click_return_forumauth'] = 'Cliquez %sici%s pour revenir aux permissions des forums';


//
// Banning
//
$lang['Ban_control'] = 'Bannissement';
$lang['Ban_explain'] = 'Depuis ce formulaire, vous pouvez contrôler les bannissements des utilisateurs. Vous pouvez accomplir cela en bannissant soit un utilisateur spécifique, soit un intervalle d\'adresses IP ou un nom de serveur. Ces méthodes empêcheront un utilisateur d\'atteindre votre forum. Pour empêcher un utilisateur de s\'enregistrer sous un nom d\'utilisateur différent, vous pouvez également bannir une adresse e-mail spécifique. Veuillez noter que bannir uniquement l\'adresse e-mail n\'empêchera pas l\'utilisateur concerné de se connecter ou poster sur votre forum; vous devrez utiliser l\'une des deux méthodes citées ci-dessus.';
$lang['Ban_explain_warn'] = 'Veuillez noter qu\'entrer un intervalle d\'adresses IP aura pour résultat de prendre en compte toutes les adresses entre l\'IP de départ et l\'IP de fin dans la liste de bannissement. Des essais seront effectués afin de réduire le nombre d\'adresses IP ajoutées à la base de données en introduisant des jokers automatiquement aux endroits appropriés. Si vous devez réellement entrer un intervalle, essayez de le garder réduit ou au mieux, fixez des adresses spécifiques.';

$lang['Select_username'] = 'Sélectionner un nom d\'utilisateur';
$lang['Select_ip'] = 'Sélectionner une adresse IP';
$lang['Select_email'] = 'Sélectionner une adresse e-mail';

$lang['Ban_username'] = 'Bannir un ou plusieurs utilisateurs spécifiques';
$lang['Ban_username_explain'] = 'Vous pouvez bannir plusieurs utilisateurs d\'une fois en utilisant la combinaison appropriée de souris et clavier pour votre ordinateur et navigateur internet';

$lang['Ban_IP'] = 'Bannir une ou plusieurs adresses IP ou noms de serveurs';
$lang['IP_hostname'] = 'Adresses IP ou noms de serveurs';
$lang['Ban_IP_explain'] = 'Pour spécifier plusieurs IP ou noms de serveurs différents, séparez-les par des virgules. Pour spécifier un intervalle d\'adresses IP, séparez le début et la fin avec un trait d\'union (-); pour spécifier un joker, utilisez une étoile (*)';

$lang['Ban_email'] = 'Bannir une ou plusieurs adresses e-mail';
$lang['Ban_email_explain'] = 'Pour spécifier plus d\'une adresse e-mail, séparez-les par des virgules. Pour spécifier un joker pour le nom d\'utilisateur, utilisez * ; par exemple *@hotmail.com';

$lang['Unban_username'] = 'Débannir un ou plusieurs utilisateurs spécifiques';
$lang['Unban_username_explain'] = 'Vous pouvez débannir plusieurs utilisateurs en une fois en utilisant la combinaison appropriée de souris et clavier pour votre ordinateur et navigateur internet';

$lang['Unban_IP'] = 'Débannir une ou plusieurs adresses IP';
$lang['Unban_IP_explain'] = 'Vous pouvez débannir plusieurs adresses IP en une fois en utilisant la combinaison appropriée de souris et clavier pour votre ordinateur et navigateur internet';

$lang['Unban_email'] = 'Débannir une ou plusieurs adresses e-mail';
$lang['Unban_email_explain'] = 'Vous pouvez débannir plusieurs adresses e-mail en une fois en utilisant la combinaison appropriée de souris et clavier pour votre ordinateur et navigateur internet';

$lang['No_banned_users'] = 'Aucun nom d\'utilisateur banni';
$lang['No_banned_ip'] = 'Aucune adresse IP bannie'; 
$lang['No_banned_email'] = 'Aucune adresse e-mail bannie';

$lang['Ban_update_sucessful'] = 'La liste de bannissement a été mise à jour';
$lang['Click_return_banadmin'] = 'Cliquez %sici%s pour revenir au bannissement';


//
// Configuration
//
$lang['General_Config'] = 'Configuration générale';
$lang['Config_explain'] = 'Depuis ce formulaire, vous pouvez personnaliser toutes les options générales du forum.';

$lang['Click_return_config'] = 'Cliquez %sici%s pour revenir à la configuration générale';

$lang['General_settings'] = 'Options générales';
$lang['Server_name'] = 'Nom de domaine';
$lang['Server_name_explain'] = 'Le nom de domaine à partir duquel ce forum fonctionne';
$lang['Script_path'] = 'Chemin du script';
$lang['Script_path_explain'] = 'Le chemin relatif de phpBB2 par rapport au nom de domaine';
$lang['Server_port'] = 'Port du serveur';
$lang['Server_port_explain'] = 'Le port utilisé par votre serveur est habituellement le 80. Modifier uniquement si différent';
$lang['Site_name'] = 'Nom du site';
$lang['Site_desc'] = 'Description du site';
$lang['Board_disable'] = 'Désactiver le forum';
$lang['Board_disable_explain'] = 'Ceci rendra le forum indisponible aux utilisateurs. Toutefois, les administrateurs auront toujours accès à l\'ensemble du forum même si celui-ci est désactivé.';
$lang['Acct_activation'] = 'Activation du compte';
$lang['Acc_None'] = 'Aucune'; // These three entries are the type of activation
$lang['Acc_User'] = 'Utilisateur';
$lang['Acc_Admin'] = 'Administrateur';

$lang['Abilities_settings'] = 'Options de base';
$lang['Max_poll_options'] = 'Nombre maximal d\'options pour les sondages';
$lang['Flood_Interval'] = 'Intervalle de flood';
$lang['Flood_Interval_explain'] = 'Temps en secondes durant lequel un utilisateur doit patienter avant de pouvoir émettre de nouveau.';
$lang['Board_email_form'] = 'Messagerie e-mail via le forum';
$lang['Board_email_form_explain'] = 'Les utilisateurs s\'envoient des e-mail par ce forum';
$lang['Topics_per_page'] = 'Nombre de sujets affichés par page';
$lang['Posts_per_page'] = 'Nombre de messages affichés par page';
$lang['Hot_threshold'] = 'Seuil de messages pour être populaire';
$lang['Default_style'] = 'Thème par défaut';
$lang['Override_style'] = 'Annuler le thème de l\'utilisateur';
$lang['Override_style_explain'] = 'Remplace le thème de l\'utilisateur par le thème par défaut';
$lang['Default_language'] = 'Langue par défaut';
$lang['Date_format'] = 'Format de la date';
$lang['System_timezone'] = 'Fuseau horaire';
$lang['Enable_gzip'] = 'Activer la compression GZIP';
$lang['Enable_prune'] = 'Activer le délestage du forum';
$lang['Allow_HTML'] = 'Autoriser le HTML';
$lang['Allow_BBCode'] = 'Autoriser le BBCode';
$lang['Allowed_tags'] = 'Balises HTML autorisées';
$lang['Allowed_tags_explain'] = 'Séparer les balises avec des virgules';
$lang['Allow_smilies'] = 'Autoriser les smilies';
$lang['Smilies_path'] = 'Dossier de stockage des smilies';
$lang['Smilies_path_explain'] = 'Chemin relatif au forum, exemple : images/smiles';
$lang['Allow_sig'] = 'Autoriser les signatures';
$lang['Max_sig_length'] = 'Longueur maximale de la signature';
$lang['Max_sig_length_explain'] = 'Nombre maximal de caractères dans la signature de l\'utilisateur';
$lang['Allow_name_change'] = 'Autoriser les changements de nom d\'utilisateur';

$lang['Avatar_settings'] = 'Avatars';
$lang['Allow_local'] = 'Activer la galerie des avatars';
$lang['Allow_remote'] = 'Activer les avatars à distance';
$lang['Allow_remote_explain'] = 'Les avatars sont stockés sur un autre site web';
$lang['Allow_upload'] = 'Activer l\'envoi d\'avatar';
$lang['Max_filesize'] = 'Taille maximale du fichier avatar';
$lang['Max_filesize_explain'] = 'Pour les avatars envoyés';
$lang['Max_avatar_size'] = 'Dimensions maximales de l\'avatar';
$lang['Max_avatar_size_explain'] = '(Hauteur x Largeur en pixels)';
$lang['Avatar_storage_path'] = 'Chemin de stockage des avatars';
$lang['Avatar_storage_path_explain'] = 'Chemin relatif au forum, exemple : images/avatars';
$lang['Avatar_gallery_path'] = 'Chemin de la galerie des avatars';
$lang['Avatar_gallery_path_explain'] = 'Chemin relatif au forum pour les images pré-chargées, exemple : images/avatars/gallery';

$lang['COPPA_settings'] = 'Options COPPA';
$lang['COPPA_fax'] = 'Numéro de Fax COPPA';
$lang['COPPA_mail'] = 'Adresse postale de la COPPA';
$lang['COPPA_mail_explain'] = 'Ceci est l\'adresse postale où les parents enverront le formulaire d\'enregistrement COPPA';

$lang['Email_settings'] = 'E-mail';
$lang['Admin_email'] = 'Adresse e-mail de l\'administrateur';
$lang['Email_sig'] = 'Signature e-mail';
$lang['Email_sig_explain'] = 'Ce texte sera attaché à tous les e-mails que le forum enverra';
$lang['Use_SMTP'] = 'Utiliser un serveur SMTP pour l\'e-mail';
$lang['Use_SMTP_explain'] = 'Sélectionner Oui si vous souhaitez ou devez envoyer des e-mails par un serveur spécifique au lieu de la fonction locale mail()';
$lang['SMTP_server'] = 'Adresse du serveur SMTP';
$lang['SMTP_username'] = 'Nom d\'utilisateur SMTP';
$lang['SMTP_username_explain'] = 'Entrez un nom d\'utilisateur pour votre serveur SMTP seulement si nécessaire';
$lang['SMTP_password'] = 'Mot de passe SMTP';
$lang['SMTP_password_explain'] = 'Entrez un mot de passe pour votre serveur SMTP seulement si nécessaire';

$lang['Disable_privmsg'] = 'Messagerie privée';

//-- mod : separate pm limits for admins and mods ------------------------------
//-- delete
/*-MOD
$lang['Inbox_limits'] = 'Messages Max dans la Boîte de réception';
$lang['Sentbox_limits'] = 'Messages Max dans la Boîte des messages envoyés';
$lang['Savebox_limits'] = 'Message Max dans la Boîte des Archives';
MOD-*/
//-- fin mod : separate pm limits for admins and mods --------------------------

$lang['Cookie_settings'] = 'Options du cooky';
$lang['Cookie_settings_explain'] = 'Ces détails définissent la manière dont les cookies sont envoyés au navigateur internet des utilisateurs. Dans la majeure partie des cas, les valeurs par défaut devraient être suffisantes. Si vous avez besoin de les modifier, faites-le avec précaution; des valeurs incorrectes pourraient empêcher les utilisateurs de se connecter.';
$lang['Cookie_domain'] = 'Domaine du cooky';
$lang['Cookie_name'] = 'Nom du cooky';
$lang['Cookie_path'] = 'Chemin du cooky';
$lang['Cookie_secure'] = 'Cooky sécurisé';
$lang['Cookie_secure_explain'] = 'Si votre serveur fonctionne via SSL, activez cette fonction; sinon, laissez-la désactivée';
$lang['Session_length'] = 'Durée de la session [ secondes ]';

// Visual Confirmation
$lang['Visual_confirm'] = 'Activer la confirmation visuelle';
$lang['Visual_confirm_explain'] = 'Requiert que les nouveaux utilisateurs entrent un code défini par une image lors de leur enregistrement.';

// Autologin Keys - added 2.0.18
$lang['Allow_autologin'] = 'Permettre la connexion automatique';
$lang['Allow_autologin_explain'] = 'Détermine si l\'utilisateur est autorisé à choisir d\'être automatiquement connecté lors de sa visite sur le forum.';
$lang['Autologin_time'] = 'Expiration de la clef de connexion automatique';
$lang['Autologin_time_explain'] = 'Nombre de jour(s) durant le(s)quel(s) la clef de connexion automatique est valide si l\'utilisateur ne visite pas le forum. Mettre à zéro pour désactiver l\'expiration.';

// Search Flood Control - added 2.0.20
$lang['Search_Flood_Interval'] = 'Intervalles de flood pour la recherche';
$lang['Search_Flood_Interval_explain'] = 'Temps en secondes durant lequel un utilisateur doit patienter avant de pouvoir lancer une nouvelle recherche.'; 

//
// Forum Management
//
$lang['Forum_admin'] = 'Administration des forums';
$lang['Forum_admin_explain'] = 'Vous pouvez ici ajouter, supprimer, éditer, réordonner et resynchroniser vos catégories et forums.';
$lang['Edit_forum'] = 'Editer un forum';
$lang['Create_forum'] = 'Nouveau forum';
$lang['Create_category'] = 'Nouvelle catégorie';
$lang['Remove'] = 'Enlever';
$lang['Action'] = 'Action';
$lang['Update_order'] = 'Mettre à jour l\'ordre';
$lang['Config_updated'] = 'Configuration du forum mise à jour';
$lang['Edit'] = 'Editer';
$lang['Delete'] = 'Supprimer';
$lang['Move_up'] = 'Monter';
$lang['Move_down'] = 'Descendre';
$lang['Resync'] = 'Resynchroniser';
$lang['No_mode'] = 'Aucun mode n\'a été défini';
$lang['Forum_edit_delete_explain'] = 'Depuis ce formulaire, vous pouvez personnaliser toutes les options générales du forum.';

$lang['Move_contents'] = 'Déplacer tout le contenu vers';
$lang['Forum_delete'] = 'Supprimer un forum';
$lang['Forum_delete_explain'] = 'Depuis ce formulaire, vous pouvez supprimer un forum (ou une catégorie) et décider où vous voulez mettre les messages (ou les forums) qu\'il contenait.';

$lang['Status_locked'] = 'Verrouillé';
$lang['Status_unlocked'] = 'Déverrouillé';
$lang['Forum_settings'] = 'Options générales des forums';
$lang['Forum_name'] = 'Nom du forum';
$lang['Forum_desc'] = 'Description';
$lang['Forum_status'] = 'Statut du forum';
$lang['Forum_pruning'] = 'Auto-délestage';

$lang['prune_freq'] = 'Vérifier l\'âge des sujets tous les ';
$lang['prune_days'] = 'Retirer les sujets n\'ayant pas eu de réponses depuis';
$lang['Set_prune_data'] = 'Vous avez activé l\'auto-délestage pour ce forum mais n\'avez pas défini une fréquence ou un nombre de jours à délester. Veuillez revenir en arrière et le faire';

$lang['Move_and_Delete'] = 'Déplacer et supprimer';

$lang['Delete_all_posts'] = 'Supprimer tous les messages';
$lang['Nowhere_to_move'] = 'Nul part où déplacer';

$lang['Edit_Category'] = 'Editer une catégorie';
$lang['Edit_Category_explain'] = 'Utilisez ce formulaire pour modifer le nom d\'une catégorie.';

$lang['Forums_updated'] = 'Informations du forum et de la catégorie mises à jour';

$lang['Must_delete_forums'] = 'Vous devez supprimer tous vos forums avant de pouvoir supprimer cette catégorie';

$lang['Click_return_forumadmin'] = 'Cliquez %sici%s pour revenir à l\'administration des forums';


//
// Smiley Management
//
$lang['smiley_title'] = 'Utilitaire d\'édition des smiles';
$lang['smile_desc'] = 'Depuis cette page vous pouvez ajouter, retirer et éditer les smiles que les utilisateurs utilisent dans leurs messages et messages privés.';

$lang['smiley_config'] = 'Smiles';
$lang['smiley_code'] = 'Code du smile';
$lang['smiley_url'] = 'Fichier image du smile';
$lang['smiley_emot'] = 'Émotion du smile';
$lang['smile_add'] = 'Ajouter un nouveau smile';
$lang['Smile'] = 'Smile';
$lang['Emotion'] = 'Émotion';

$lang['Select_pak'] = 'Selectionner le package (fichier .pak)';
$lang['replace_existing'] = 'Remplacer les smiles existants';
$lang['keep_existing'] = 'Conserver les smiles existants';
$lang['smiley_import_inst'] = 'Vous devez dézipper le pack de smiles et envoyer tous les fichiers dans le dossier de smiles approprié pour l\'installation. Ensuite, sélectionnez les informations correctes dans ce formulaire pour importer le pack de smiles.';
$lang['smiley_import'] = 'Importer un pack de smiles';
$lang['choose_smile_pak'] = 'Choisir un pack de smiles, fichier .pak';
$lang['import'] = 'Importer les smiles';
$lang['smile_conflicts'] = 'Que faire en cas de conflit ?';
$lang['del_existing_smileys'] = 'Supprimer les smiles existants avant l\'importation';
$lang['import_smile_pack'] = 'Importer un pack de smiles';
$lang['export_smile_pack'] = 'Créer un pack de smiles';
$lang['export_smiles'] = 'Pour créer un pack de smiles à partir de vos smiles actuellement installés, cliquez %sici%s pour télécharger le fichier .pak de smiles. Nommez ce fichier de façon appropriée afin de vous assurer de conserver l\'extension de fichier .pak. Ensuite, créez un fichier zip contenant toutes les images de vos smiles plus le fichier de configuration .pak.';

$lang['smiley_add_success'] = 'Le smile a été ajouté';
$lang['smiley_edit_success'] = 'Le smile a été mis à jour';
$lang['smiley_import_success'] = 'Le pack de smiles a été importé !';
$lang['smiley_del_success'] = 'Le smile a été retiré';
$lang['Click_return_smileadmin'] = 'Cliquez %sici%s pour revenir à l\'administration des smiles';

$lang['Confirm_delete_smiley'] = 'Etes-vous sûr de vouloir supprimer ce smile ?';

//
// User Management
//
$lang['User_admin'] = 'Administration des utilisateurs';
$lang['User_admin_explain'] = 'Depuis ce formulaire, vous pouvez changer les informations des utilisateurs et certaines options spécifiques.';

$lang['Look_up_user'] = 'Rechercher l\'utilisateur';

$lang['Admin_user_fail'] = 'Impossible de mettre à jour le profil de l\'utilisateur.';
$lang['Admin_user_updated'] = 'Le profil de l\'utilisateur a été mis à jour avec succès.';
$lang['Click_return_useradmin'] = 'Cliquez %sici%s pour revenir à l\'administration des utilisateurs';

$lang['User_delete'] = 'Supprimer cet utilisateur';
$lang['User_delete_explain'] = 'Cliquez ici pour supprimer cet utilisateur; cette opération est irréversible.';
$lang['User_deleted'] = 'L\'utilisateur a été supprimé.';

$lang['User_status'] = 'L\'utilisateur est actif';
$lang['User_allowpm'] = 'Peut envoyer des messages privés';
$lang['User_allowavatar'] = 'Peut afficher un avatar';

$lang['Admin_avatar_explain'] = 'Ici vous pouvez voir et supprimer l\'avatar actuel de l\'utilisateur.';

$lang['User_special'] = 'Champs spéciaux pour administrateurs uniquement';
$lang['User_special_explain'] = 'Ces champs ne peuvent pas être modifiés par l\'utilisateur. Ici, vous pouvez définir leur statut et d\'autres options non-accessibles aux utilisateurs.';


//
// Group Management
//
$lang['Group_administration'] = 'Administration des groupes';
$lang['Group_admin_explain'] = 'Depuis ce panneau, vous pouvez administrer tous vos groupes d\'utilisateurs. Vous pouvez supprimer, créer et éditer les groupes existants. Vous pouvez choisir des modérateurs, alterner le statut ouvert/fermé d\'un groupe et définir le nom et la description d\'un groupe';
$lang['Error_updating_groups'] = 'Il y a eu une erreur durant la mise à jour des groupes';
$lang['Updated_group'] = 'Le groupe a été mis à jour';
$lang['Added_new_group'] = 'Le nouveau groupe a été créé';
$lang['Deleted_group'] = 'Le groupe a été supprimé';
$lang['New_group'] = 'Créer un nouveau groupe';
$lang['Edit_group'] = 'Editer un groupe';
$lang['group_name'] = 'Nom du groupe';
$lang['group_description'] = 'Description du groupe';
$lang['group_moderator'] = 'Modérateur du groupe';
$lang['group_status'] = 'Statut du groupe';
$lang['group_open'] = 'Groupe ouvert';
$lang['group_closed'] = 'Groupe fermé';
$lang['group_hidden'] = 'Groupe invisible';
$lang['group_delete'] = 'Supprimer un groupe';
$lang['group_delete_check'] = 'Supprimer ce groupe';
$lang['submit_group_changes'] = 'Envoyer les modifications';
$lang['reset_group_changes'] = 'Remettre à zero';
$lang['No_group_name'] = 'Vous devez spécifier un nom pour ce groupe';
$lang['No_group_moderator'] = 'Vous devez spécifier un modérateur pour ce groupe';
$lang['No_group_mode'] = 'Vous devez spécifier un mode pour ce groupe, ouvert ou fermé';
$lang['No_group_action'] = 'Aucune action n\'a été spécifiée';
$lang['delete_group_moderator'] = 'Supprimer l\'ancien modérateur du groupe ?';
$lang['delete_moderator_explain'] = 'Si vous changez le modérateur du groupe, cochez cette case pour enlever l\'ancien modérateur de ce groupe. Sinon, vous pouvez ne pas la cocher, et l\'utilisateur deviendra un membre régulier de ce groupe.';
$lang['Click_return_groupsadmin'] = 'Cliquez %sici%s pour revenir à l\'administration des groupes.';
$lang['Select_group'] = 'Sélectionner un groupe';
$lang['Look_up_group'] = 'Rechercher le groupe';


//
// Prune Administration
//
$lang['Forum_Prune'] = 'Délester un forum';
$lang['Forum_Prune_explain'] = 'Ceci supprimera tous les sujets n\'ayant pas eu de réponses depuis le nombre de jours que vous aurez choisi. Si vous n\'entrez pas de nombre, tous les sujets seront supprimés. Par contre cela ne supprimera ni les sujets dans lesquels un sondage est encore en cours, ni les annonces. Vous devrez supprimer ces sujets manuellement.';
$lang['Do_Prune'] = 'Faire le délestage';
$lang['All_Forums'] = 'Tous les forums';
$lang['Prune_topics_not_posted'] = 'Délester les sujets sans réponses depuis cette période (en jours)';
$lang['Topics_pruned'] = 'Sujets délestés';
$lang['Posts_pruned'] = 'Messages délestés';
$lang['Prune_success'] = 'Le délestage des forums s\'est correctement déroulé.';


//
// Word censor
//
$lang['Words_title'] = 'Censure';
$lang['Words_explain'] = 'Depuis ce panneau de contrôle, vous pouvez ajouter, éditer, et retirer les mots qui seront automatiquement censurés sur vos forums. De plus, les gens ne seront pas autorisés à s\'inscrire avec des noms d\'utilisateurs contenant ces mots. Les jokers (*) sont acceptés dans le champ \'Mot\', exemple : *test* concordera avec detestable, test* concordera avec testing, et *test avec detest.';
$lang['Word'] = 'Mot';
$lang['Edit_word_censor'] = 'Editer Cette censure';
$lang['Replacement'] = 'Remplacement';
$lang['Add_new_word'] = 'Ajouter une censure';
$lang['Update_word'] = 'Mettre à jour cette censure';

$lang['Must_enter_word'] = 'Vous devez entrer une censure et sa remplaçante';
$lang['No_word_selected'] = 'Aucune censure sélectionnée pour l\'édition';

$lang['Word_updated'] = 'La censure sélectionnée a été mise à jour';
$lang['Word_added'] = 'La censure a été ajoutée';
$lang['Word_removed'] = 'La censure sélectionnée a été retirée';

$lang['Click_return_wordadmin'] = 'Cliquez %sici%s pour revenir à l\'administration de la censure';

$lang['Confirm_delete_word'] = 'Etes-vous sûr de vouloir supprimer cette censure ?';


//
// Mass Email
//
$lang['Mass_email_explain'] = 'Ici, vous pouvez envoyer le même e-mail à tous les utilisateurs du forum ou seulement à ceux d\'un groupe donné. Pour ce faire, un e-mail sera envoyé en copie cachée à partir de l\'adresse e-mail d\'administration vers ses destinataires. L\'envoi massif d\'e-mail prend un certain temps; soyez patient après l\'envoi et n\'interrompez pas le chargement de la page. Vous serez averti automatiquement de la fin de l\'opération.';
$lang['Compose'] = 'Composer';

$lang['Recipients'] = 'Destinataires';
$lang['All_users'] = 'Tous les utilisateurs';

$lang['Email_successfull'] = 'Votre message a été envoyé';
$lang['Click_return_massemail'] = 'Cliquez %sici%s pour revenir au formulaire de l\'e-mail de masse';


//
// Ranks admin
//
$lang['Ranks_title'] = 'Administration des rangs';
$lang['Ranks_explain'] = 'Depuis ce formulaire, vous pouvez ajouter, éditer, voir et supprimer des rangs. Vous pouvez également créer des rangs personnalisés qui pourront être assignés à des utilisateurs spécifiques via le gestionnaire des utilisateurs';

$lang['Add_new_rank'] = 'Ajouter un nouveau rang';

$lang['Rank_title'] = 'Titre';
$lang['Rank_special'] = 'Rang spécial';
$lang['Rank_minimum'] = 'Messages minimums'; 
$lang['Rank_maximum'] = 'Messages maximums';
$lang['Rank_image'] = 'Image du rang (chemin relatif)';
$lang['Rank_image_explain'] = 'Utilisez ceci pour associer une image au rang';

$lang['Must_select_rank'] = 'Vous devez sélectionner un rang';
$lang['No_assigned_rank'] = 'Aucun rang spécial assigné';

$lang['Rank_updated'] = 'Le rang a été mis à jour';
$lang['Rank_added'] = 'Le rang a été ajouté';
$lang['Rank_removed'] = 'Le rang a été supprimé';
$lang['No_update_ranks'] = 'Le rang a été supprimé; toutefois, les comptes des utilisateurs n\'ont pas été mis à jour. Vous devrez remettre à zéro manuellement leur rang.';

$lang['Click_return_rankadmin'] = 'Cliquez %sici%s pour revenir à l\'administration des rangs';

$lang['Confirm_delete_rank'] = 'Etes-vous sûr de vouloir supprimer ce rang ?';

//
// Disallow Username Admin
//
$lang['Disallow_control'] = 'Contrôle des noms d\'utilisateurs interdits';
$lang['Disallow_explain'] = 'Ici, vous pouvez contrôler les noms d\'utilisateurs qui seront interdits à l\'usage. Les noms d\'utilisateurs interdits peuvent contenir un caractère joker (*). Veuillez noter que vous ne pourrez pas interdire un nom d\'utilisateur déjà enregistré; vous devrez d\'abord supprimer le compte de l\'utilisateur et ensuite interdire le nom d\'utilisateur';

$lang['Delete_disallow'] = 'Supprimer';
$lang['Delete_disallow_title'] = 'Retirer un nom d\'utilisateur interdit';
$lang['Delete_disallow_explain'] = 'Vous pouvez retirer un nom d\'utilisateur interdit en sélectionnant le nom d\'utilisateur depuis la liste et en cliquant sur Supprimer';

$lang['Add_disallow'] = 'Ajouter';
$lang['Add_disallow_title'] = 'Ajouter un nom d\'utilisateur interdit';
$lang['Add_disallow_explain'] = 'Vous pouvez interdire un nom d\'utilisateur en utilisant le caractère joker *';

$lang['No_disallowed'] = 'Aucun nom d\'utilisateur interdit';

$lang['Disallowed_deleted'] = 'Le nom d\'utilisateur interdit a été retiré';
$lang['Disallow_successful'] = 'Le nom d\'utilisateur interdit a été ajouté';
$lang['Disallowed_already'] = 'Le nom que vous avez entré ne peut être interdit. Soit il existe déjà dans la liste, soit il est dans la liste des mots censurés, ou soit il est déjà enregistré';

$lang['Click_return_disallowadmin'] = 'Cliquez %sici%s pour revenir à l\'administration des noms d\'utilisateurs interdits';


//
// Styles Admin
//
$lang['Styles_admin'] = 'Administration des thèmes';
$lang['Styles_explain'] = 'En utilisant cet outil, vous pouvez ajouter, éditer, supprimer et gérer les thèmes (modèles de documents et thèmes) disponibles auprès des utilisateurs.';
$lang['Styles_addnew_explain'] = 'La liste suivante contient tous les thèmes actuellement disponibles pour le modèle de document courant. Les éléments sur cette liste n\'ont pas encore été installés dans la base de données de phpBB. Pour installer un thème, il suffit de cliquer sur le lien \'Installer\' à côté d\'une entrée';

$lang['Select_template'] = 'Sélectionner un modèle de document';

$lang['Style'] = 'Thème';
$lang['Template'] = 'Modèle de document';
$lang['Install'] = 'Installer';
$lang['Download'] = 'Télécharger';

$lang['Edit_theme'] = 'Editer un thème';
$lang['Edit_theme_explain'] = 'Depuis ce formulaire, vous pouvez éditer les paramètres pour le thème sélectionné';

$lang['Create_theme'] = 'Créer un thème';
$lang['Create_theme_explain'] = 'Utilisez le formulaire ci-dessous pour créer un nouveau thème pour un modèle de document sélectionné. Lorsque vous entrerez les couleurs (pour lesquelles vous devrez utiliser une notation hexadécimale), vous ne devrez pas inclure le # initial, exemple : CCCCCC est valide, #CCCCCC ne l\'est pas';

$lang['Export_themes'] = 'Exporter des thèmes';
$lang['Export_explain'] = 'Dans ce panneau, vous pourrez exporter les données de ce thème pour un modèle de document sélectionné. Sélectionnez le modèle de document depuis la liste ci-dessous, et le script créera le fichier de configuration du thème et essaiera de le copier dans le répertoire sélectionné des modèles de documents. S\'il ne peut pas le copier lui-même, il vous proposera de le télécharger. Afin que le script puisse copier le fichier, vous devez donner les droits d\'écriture pour le répertoire sur le serveur. Pour plus d\'informations à propos de cela, allez voir le Guide de l\'utilisateur de phpBB 2.';

$lang['Theme_installed'] = 'Le thème sélectionné a été installé';
$lang['Style_removed'] = 'Le thème sélectionné a été retiré de la base de données. Pour enlever complètement ce thème de votre système, vous devez supprimer les fichiers appropriés dans le répertoire du modèle de document.';
$lang['Theme_info_saved'] = 'Les informations du thème pour le modèle de document sélectionné ont été sauvegardées. Vous devriez restreindre les permissions du fichier theme_info.cfg (et si possible dans le répertoire du modèle de document sélectionné) à la lecture seule';
$lang['Theme_updated'] = 'Le thème sélectionné a été mis à jour. Vous devriez exporter maintenant les nouveaux paramètres du thème';
$lang['Theme_created'] = 'Thème créé. Vous devriez exporter maintenant le thème vers le fichier de configuration du thème pour le conserver en lieu sûr ou l\'utiliser ailleurs';

$lang['Confirm_delete_style'] = '-tes-vous sûr de vouloir supprimer ce thème ?';

$lang['Download_theme_cfg'] = 'L\'exportateur n\'arrive pas à écrire le fichier des informations du thème. Cliquez sur le bouton ci-dessous pour télécharger ce fichier avec votre navigateur internet. Une fois téléchargé, vous pourrez le transférer vers le répertoire contenant les modèles de documents. Vous pourrez ensuite créer un pack des fichiers pour le distribuer ou l\'utiliser ailleurs si vous le désirez';
$lang['No_themes'] = 'Le modèle de document que vous avez sélectionné n\'a pas de thème. Pour créer un nouveau thème, cliquez sur Créer un Nouveau Thème sur le volet de gauche';
$lang['No_template_dir'] = 'Impossible d\'ouvrir le répertoire du modèle de document. Il peut être illisible par le serveur ou ne pas exister';
$lang['Cannot_remove_style'] = 'Vous ne pouvez pas enlever le thème sélectionné tant qu\'il est utilisé par le forum en tant que thème par défaut. Veuillez changer le thème par défaut et réessayer.';
$lang['Style_exists'] = 'Le nom du thème choisi existe déjà; veuillez revenir en arrière et choisir un nom différent.';

$lang['Click_return_styleadmin'] = 'Cliquez %sici%s pour revenir à l\'administration des thèmes';

$lang['Theme_settings'] = 'Options du thème';
$lang['Theme_element'] = 'Elément du thème';
$lang['Simple_name'] = 'Nom simple';
$lang['Value'] = 'Valeur';
$lang['Save_Settings'] = 'Sauvegarder les paramètres';

$lang['Stylesheet'] = 'Feuille de style CSS';
$lang['Stylesheet_explain'] = 'Nom du fichier pour la feuille de style CSS à utiliser pour ce thème.';
$lang['Background_image'] = 'Image de fond';
$lang['Background_color'] = 'Couleur de fond';
$lang['Theme_name'] = 'Nom du thème';
$lang['Link_color'] = 'Couleur du lien';
$lang['Text_color'] = 'Couleur du texte';
$lang['VLink_color'] = 'Couleur du lien Visité';
$lang['ALink_color'] = 'Couleur du lien Actif';
$lang['HLink_color'] = 'Couleur du lien survolé';
$lang['Tr_color1'] = 'Table Rangée Couleur 1';
$lang['Tr_color2'] = 'Table Rangée Couleur 2';
$lang['Tr_color3'] = 'Table Rangée Couleur 3';
$lang['Tr_class1'] = 'Table Rangée Class 1';
$lang['Tr_class2'] = 'Table Rangée Class 2';
$lang['Tr_class3'] = 'Table Rangée Class 3';
$lang['Th_color1'] = 'Table En-tête Couleur 1';
$lang['Th_color2'] = 'Table En-tête Couleur 2';
$lang['Th_color3'] = 'Table En-tête Couleur 3';
$lang['Th_class1'] = 'Table En-tête Class 1';
$lang['Th_class2'] = 'Table En-tête Class 2';
$lang['Th_class3'] = 'Table En-tête Class 3';
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
$lang['img_pm_size'] = 'Taille Statut Message Privé [px]';


//
// Install Process
//
$lang['Welcome_install'] = 'Bienvenue à l\'installation de phpBB 2';
$lang['Initial_config'] = 'Configuration de base';
$lang['DB_config'] = 'Configuration de la base de données';
$lang['Admin_config'] = 'Configuration du compte administrateur';
$lang['continue_upgrade'] = 'Une fois que vous avez téléchargé le fichier config.php vers votre ordinateur, vous pouvez cliquer sur le boutton \'Continuer la Mise à jour\' ci-dessous pour progresser dans le processus de mise à jour. Veuillez attendre la fin du processus de mise à jour avant d\'envoyer le fichier config.php.';
$lang['upgrade_submit'] = 'Continuer la mise à jour';

$lang['Installer_Error'] = 'Une erreur s\'est produite durant l\'installation';
$lang['Previous_Install'] = 'Une installation précédente a été détectée';
$lang['Install_db_error'] = 'Une erreur s\'est produite en essayant de mettre à jour la base de données';

$lang['Re_install'] = 'Votre installation précédente est toujours active. <br /><br />Si vous voulez réinstaller phpBB 2, cliquez sur le bouton Oui ci-dessous. Vous êtes conscient qu\'en faisant cela, vous détruirez toutes les données existantes; aucune sauvegarde ne sera faite ! Le nom d\'utilisateur de l\'administrateur et le mot de passe que vous utilisez pour vous connecter au forum sera recréé après la réinstallation; rien d\'autre ne sera fait conservé. <br /><br />Réfléchissez bien avant d\'appuyer sur Oui !';

$lang['Inst_Step_0'] = 'Merci d\'avoir choisi phpBB 2. Afin d\'achever cette installation, veuillez remplir les détails demandés ci-dessous. Veuillez noter que la base de données dans laquelle vous installez devrait déjà exister. Si vous êtes en train d\'installer sur une base de données qui utilise ODBC, MS Access par exemple, vous devez d\'abord lui créer un SGBD avant de continuer.';

$lang['Start_Install'] = 'Démarrer l\'installation';
$lang['Finish_Install'] = 'Finir l\'installation';

$lang['Default_lang'] = 'Langue par défaut du forum';
$lang['DB_Host'] = 'Nom du serveur de base de données / SGBD';
$lang['DB_Name'] = 'Nom de votre base de données';
$lang['DB_Username'] = 'Nom d\'utilisateur';
$lang['DB_Password'] = 'Mot de passe';
$lang['Database'] = 'Votre base de données';
$lang['Install_lang'] = 'Choisissez la langue pour l\'installation';
$lang['dbms'] = 'Type de la base de données';
$lang['Table_Prefix'] = 'Préfixe des tables';
$lang['Admin_Username'] = 'Nom d\'utilisateur';
$lang['Admin_Password'] = 'Mot de passe';
$lang['Admin_Password_confirm'] = 'Mot de passe [ Confirmer ]';

$lang['Inst_Step_2'] = 'Votre compte d\'administration a été créé. A ce point, l\'installation de base est terminée. Vous allez être redirigé vers une nouvelle page qui vous permettra d\'administrer votre nouvelle installation. Veuillez vous assurer de vérifier les détails de la Configuration Générale et d\'opérer les changements qui s\'imposent. Merci d\'avoir choisi phpBB 2.';

$lang['Unwriteable_config'] = 'Votre fichier config.php est en lecture seule actuellement. Une copie du fichier config.php va vous être proposée en téléchargement après avoir avoir cliqué sur le boutton ci-dessous. Vous devrez envoyer ce fichier dans le même répertoire où est installé phpBB 2. Une fois terminé, vous pourrez vous connecter en utilisant vos nom d\'utilisateur et mot de passe d\'administrateur que vous avez fourni précédemment, et visiter le Panneau d\'Administration (un lien apparaîtra en bas de chaque page une fois connecté) pour vérifier la Configuration Générale. Merci d\'avoir choisi phpBB 2.';
$lang['Download_config'] = 'Télécharger le fichier config.php';

$lang['ftp_choose'] = 'Choisir la méthode de téléchargement';
$lang['ftp_option'] = '<br />Tant que les extensions FTP seront activées dans cette version de PHP, l\'option d\'essayer d\'envoyer automatiquement le fichier config.php sur un ftp peut vous être donnée.';
$lang['ftp_instructs'] = 'Vous avez choisi de transférer automatiquement via FTP le fichier vers le compte contenant phpBB 2. Veuillez compléter les informations ci-dessous afin de faciliter cette opération. Notez que le chemin FTP doit être le chemin exact vers le répertoire où est installé phpBB2 comme si vous étiez en train d\'envoyer le fichier avec n\'importe quel client FTP.';
$lang['ftp_info'] = 'Entrez vos informations FTP';
$lang['Attempt_ftp'] = 'Essayer de transférer le fichier config.php vers un serveur ftp';
$lang['Send_file'] = 'Juste m\'envoyer le fichier et je l\'enverrai manuellement sur le serveur ftp';
$lang['ftp_path'] = 'Chemin de phpBB2 FTP';
$lang['ftp_username'] = 'Votre nom d\'utilisateur FTP';
$lang['ftp_password'] = 'Votre mot de passe FTP';
$lang['Transfer_config'] = 'Démarrer le transfert';
$lang['NoFTP_config'] = 'La tentative d\'envoi du fichier config.php par FTP a échoué. Veuillez télécharger le fichier config.php et l\'envoyer manuellement sur votre serveur FTP.';

$lang['Install'] = 'Installation';
$lang['Upgrade'] = 'Mise à jour';


$lang['Install_Method'] = 'Type d\'installation';

$lang['Install_No_Ext'] = 'La configuration PHP sur votre serveur ne supporte pas le type de base de données que vous avez sélectionné';

$lang['Install_No_PCRE'] = 'phpBB2 requiert le support des expressions régulières Perl pour PHP, mais votre configuration PHP ne semble pas le supporter !';

//
// Version Check
//
$lang['Version_up_to_date'] = 'Votre installation est à jour, aucune mise à jour n\'est disponible pour votre version de phpBB.';
$lang['Version_not_up_to_date'] = 'Votre installation de phpBB <b>ne semble pas</b> être à jour. Des mises à jours sont disponibles pour votre version de phpBB, veuillez visiter <a href="http://www.phpbb.com/downloads.php" target="_new">http://www.phpbb.com/downloads.php</a> ou <a href="http://www.phpbb-fr.com/">http://www.phpbb-fr.com/</a> afin d\'obtenir une version plus récente.';
$lang['Latest_version_info'] = 'La dernière version de phpBB disponible est <b>phpBB %s</b>.';
$lang['Current_version_info'] = 'Vous utilisez <b>phpBB %s</b>.';
$lang['Connect_socket_error'] = 'Impossible d\'ouvrir une connection au serveur phpBB, l\'erreur retournée est :<br />%s.';
$lang['Socket_functions_disabled'] = 'Impossible d\'utiliser les fonctions de socket.';
$lang['Mailing_list_subscribe_reminder'] = 'Afin d\'obtenir les dernières informations sur les mises à jours de phpBB, <a href="http://www.phpbb.com/support/" target="_new">inscrivez-vous à notre liste de diffusion</a> (en anglais).';
$lang['Version_information'] = 'Informations de version'; 

//
// Login attempts configuration
//
$lang['Max_login_attempts'] = 'Tentatives de connexions autorisées';
$lang['Max_login_attempts_explain'] = 'Nombre maximum de tentatives de connexions qu\'un utilisateur peut soumettre avant qu\'il ne puisse plus se connecter.';
$lang['Login_reset_time'] = 'Temps de verrouillage de la connexion';
$lang['Login_reset_time_explain'] = 'Temps en minutes durant lequel un utilisateur, ayant dépassé le nombre de tentatives de connexions autorisées, ne pourra pas se connecter';

//
// That's all Folks!
// -------------------------------------------------

//-- mod : oxygen premod -------------------------------------------------------
//-- add
$lang['Files_folders'] = 'Fichiers et dossiers';
$lang['Files_folders_explain'] = '<b>Obligatoire</b> - Afin de pouvoir fonctionner correctement, OxyGen PreMOD a besoin d\'accéder ou d\'écrire dans certains fichiers ou dossiers. Si vous voyez “<b style="color:red">Non-détecté</b>”, vous devrez créer le fichier ou dossier concerné. Si vous voyez “<b style="color:red">Écriture impossible</b>”, vous devrez changer les permissions sur ce fichier ou dossier pour permettre à OxyGen PreMOD de pouvoir écrire dessus.';

$lang['Optional_files_folders'] = 'Fichiers et dossiers optionnels';
$lang['Optional_files_folders_explain'] = '<b>Optionnel</b> - Ces fichiers, dossiers ou permissions ne sont pas obligatoires. Le processus d\'installation tentera par divers moyens de les créer s\'ils n\'existent pas ou s\'ils ne peuvent être écrits. Néanmoins, la présence de ceux-ci accélera la procédure d\'installation.';

$lang['Found'] = '<b style="color:green">Détecté</b>';
$lang['Not_found'] = '<b style="color:red">Non-détecté</b>';
$lang['Writeable'] = ', <b style="color:green">écriture autorisée</b>';
$lang['Unwriteable'] = ', <b style="color:red">écriture impossible (CHMOD 777)</b>';
$lang['Unmodifiable'] = ', <b style="color:red">écriture impossible (CHMOD 666)</b>';
//-- fin mod : oxygen premod ---------------------------------------------------

?>
