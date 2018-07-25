<?php
/**
*
* @version $Id: lang_main.php,v 1.85.2.22 2006/12/16 13:11:28 acydburn Exp $
* @copyright (C) 2001 The phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @Translation: Helix < http://www.phpbb-fr.com/ >
* @Translation: ABDev < http://www.oxygen-powered.net/ >
*
*/

//
// The format of this file is ---> $lang['message'] = 'text';
//
// You should also try to set a locale and a character encoding (plus direction). The encoding and direction
// will be sent to the template. The locale may or may not work, it's dependent on OS support and the syntax
// varies ... give it your best guess!
//

$lang['ENCODING'] = 'ISO-8859-1';
$lang['DIRECTION'] = 'LTR';
$lang['LEFT'] = 'GAUCHE';
$lang['RIGHT'] = 'DROITE';
$lang['DATE_FORMAT'] =  'd M Y'; // This should be changed to the default date format for your language, php date() format

// This is optional, if you would like a _SHORT_ message output
// along with our copyright message indicating you are the translator
// please add it here.
$lang['TRANSLATION'] = 'Traduction originale par <a href="http://www.phpbb-fr.com/" title="phpBB-fr" target="_blank" class="copyright">phpBB-fr.com</a>, revue par <a href="http://www.ezcom-fr.com/" title="Communaut� EzCom" target="_blank" class="copyright">EzCom</a>';
$lang['TRANSLATION_INFO'] = 'Traduction originale par <a href="http://www.phpbb-fr.com/" title="phpBB-fr" target="_blank" class="copyright">phpBB-fr.com</a>, revue par <a href="http://www.ezcom-fr.com/" title="Communaut� EzCom" target="_blank" class="copyright">EzCom</a>';

//
// Common, these terms are used
// extensively on several pages
//
$lang['Forum'] = 'Forum';
$lang['Category'] = 'Cat�gorie';
$lang['Topic'] = 'Sujet';
$lang['Topics'] = 'Sujets';
$lang['Replies'] = 'R�ponses';
$lang['Views'] = 'Vus';
$lang['Post'] = 'Message';
$lang['Posts'] = 'Messages';
$lang['Posted'] = 'Post� le';
$lang['Username'] = 'Nom d\'utilisateur';
$lang['Password'] = 'Mot de passe';
$lang['Email'] = 'E-mail';
$lang['Poster'] = '�mettre';
$lang['Author'] = 'Auteur';
$lang['Time'] = 'Temps';
$lang['Hours'] = 'Heures';
$lang['Message'] = 'Message';

$lang['1_Day'] = '1 Jour';
$lang['7_Days'] = '7 Jours';
$lang['2_Weeks'] = '2 Semaines';
$lang['1_Month'] = '1 Mois';
$lang['3_Months'] = '3 Mois';
$lang['6_Months'] = '6 Mois';
$lang['1_Year'] = '1 An';

$lang['Go'] = 'Aller';
$lang['Jump_to'] = 'Sauter vers';
$lang['Submit'] = 'Envoyer';
$lang['Reset'] = 'R�initialiser';
$lang['Cancel'] = 'Annuler';
$lang['Preview'] = 'Pr�visualisation';
$lang['Confirm'] = 'Confirmer';
$lang['Spellcheck'] = 'V�rificateur d\'orthographe';
$lang['Yes'] = 'Oui';
$lang['No'] = 'Non';
$lang['Enabled'] = 'Activ�';
$lang['Disabled'] = 'D�sactiv�';
$lang['Error'] = 'Erreur';

$lang['Next'] = 'Suivante';
$lang['Previous'] = 'Pr�c�dente';
$lang['Goto_page'] = 'Aller � la page';
$lang['Joined'] = 'Inscrit le';
$lang['IP_Address'] = 'Adresse IP';

$lang['Select_forum'] = 'S�lectionner un forum';
$lang['View_latest_post'] = 'Dernier message';
$lang['View_newest_post'] = 'Message le plus r�cent';
$lang['Page_of'] = 'Page <b>%d</b> sur <b>%d</b>'; // Replaces with: Page 1 of 2 for example

$lang['ICQ'] = 'Num�ro ICQ';
$lang['AIM'] = 'Adresse AIM';
$lang['MSNM'] = 'MSN Messenger';
$lang['YIM'] = 'Yahoo Messenger';

$lang['Forum_Index'] = 'Index du forum';  // eg. sitename Forum Index, %s can be removed if you prefer

$lang['Post_new_topic'] = '�mettre un nouveau sujet';
$lang['Reply_to_topic'] = 'R�pondre';
$lang['Reply_with_quote'] = 'R�pondre en citant';

$lang['Click_return_topic'] = 'Cliquez %sici%s pour retourner au sujet de discussion'; // %s's here are for uris, do not remove!
$lang['Click_return_login'] = 'Cliquez %sici%s pour r�essayer';
$lang['Click_return_forum'] = 'Cliquez %sici%s pour retourner au forum';
$lang['Click_view_message'] = 'Cliquez %sici%s pour voir votre message';
$lang['Click_return_modcp'] = 'Cliquez %sici%s pour retourner au Panneau de Contr�le du Mod�rateur';
$lang['Click_return_group'] = 'Cliquez %sici%s pour retourner aux informations du groupe';

//-- mod : admin link in header ------------------------------------------------
//-- delete
/*-MOD
$lang['Admin_panel'] = 'Aller au Panneau d\'administration';
MOD-*/
//-- add
$lang['Admin_panel'] = 'Panneau d\'administration';
//-- fin mod : admin link in header --------------------------------------------

$lang['Board_disable'] = 'D�sol�, mais ce forum est actuellement indisponible. Veuillez r�essayer ult�rieurement.';


//
// Global Header strings
//
$lang['Registered_users'] = 'Utilisateurs enregistr�s :';
$lang['Browsing_forum'] = 'Utilisateurs parcourant actuellement ce forum :';
$lang['Online_users_zero_total'] = 'Il n\'y a <b>aucun</b> utilisateur connect�.';
$lang['Online_users_total'] = 'Il y a <b>%d</b> utilisateurs connect�s :: ';
$lang['Online_user_total'] = 'Il y a <b>%d</b> utilisateur connect� :: ';
$lang['Reg_users_zero_total'] = 'aucun enregistr�, ';
$lang['Reg_users_total'] = '%d enregistr�s, ';
$lang['Reg_user_total'] = '%d enregistr�, ';
$lang['Hidden_users_zero_total'] = 'aucun invisible et ';
$lang['Hidden_user_total'] = '%d invisible et ';
$lang['Hidden_users_total'] = '%d invisibles et ';
$lang['Guest_users_zero_total'] = 'aucun invit�';
$lang['Guest_users_total'] = '%d invit�s';
$lang['Guest_user_total'] = '%d invit�';
$lang['Record_online_users'] = 'Le record du nombre d\'utilisateurs connect�s est de <b>%s</b> le %s'; // first %s = number of users, second %s is the date.

$lang['Admin_online_color'] = '%sAdministrateur%s';
$lang['Mod_online_color'] = '%sMod�rateur%s';

$lang['You_last_visit'] = 'Derni�re visite le %s'; // %s replaced by date/time
$lang['Current_time'] = 'La date/heure actuelle est %s'; // %s replaced by date/time

//-- mod : keep unread flags ---------------------------------------------------
//-- delete
/*-MOD
$lang['Search_new'] = 'Voir les nouveaux messages depuis votre derni�re visite';
MOD-*/
//-- fin mod : keep unread flags -----------------------------------------------
$lang['Search_your_posts'] = 'Voir ses messages';
$lang['Search_unanswered'] = 'Messages sans r�ponse';

$lang['Register'] = 'Inscription';
$lang['Profile'] = 'Profil';
$lang['Edit_profile'] = '�diter votre profil';
$lang['Search'] = 'Rechercher';
$lang['Memberlist'] = 'Membres';
$lang['FAQ'] = 'FAQ';
$lang['BBCode_guide'] = 'Guide du BBCode';
$lang['Usergroups'] = 'Groupes';
$lang['Last_Post'] = 'Derniers messages';
$lang['Moderator'] = 'Mod�rateur';
$lang['Moderators'] = 'Mod�rateurs';


//
// Stats block text
//
$lang['Posted_articles_zero_total'] = 'Nos membres n\'ont �mis aucun message'; // Number of posts
$lang['Posted_articles_total'] = 'Nos membres ont �mis un total de <b>%d</b> messages'; // Number of posts
$lang['Posted_article_total'] = 'Nos membres ont �mis un total de <b>%d</b> message'; // Number of posts
$lang['Registered_users_zero_total'] = 'Nous n\'avons <b>aucun</b> utilisateur enregistr�'; // # registered users
$lang['Registered_users_total'] = 'Nous avons <b>%d</b> utilisateurs enregistr�s'; // # registered users
$lang['Registered_user_total'] = 'Nous avons <b>%d</b> utilisateur enregistr�'; // # registered users
$lang['Newest_user'] = 'L\'utilisateur enregistr� le plus r�cent est <b>%s%s%s</b>'; // a href, username, /a 

$lang['No_new_posts_last_visit'] = 'Aucun nouveau message depuis votre derni�re visite';
$lang['No_new_posts'] = 'Aucun nouveau message';
$lang['New_posts'] = 'Nouveaux messages';
$lang['New_post'] = 'Nouveau message';
$lang['No_new_posts_hot'] = 'Aucun nouveau message [ Populaire ]';
$lang['New_posts_hot'] = 'Nouveaux messages [ Populaire ]';
$lang['No_new_posts_locked'] = 'Aucun nouveau message [ Verrouill� ]';
$lang['New_posts_locked'] = 'Nouveaux messages [ Verrouill� ]';
$lang['Forum_is_locked'] = 'Forum verrouill�';


//
// Login
//
$lang['Enter_password'] = 'Veuillez entrer votre nom d\'utilisateur et votre mot de passe pour vous connecter.';
$lang['Login'] = 'Connexion';
$lang['Logout'] = 'D�connexion';

$lang['Forgotten_password'] = 'J\'ai oubli� mon mot de passe';

$lang['Log_me_in'] = 'Se connecter automatiquement � chaque visite';

$lang['Error_login'] = 'Vous avez sp�cifi� un nom d\'utilisateur incorrect ou inactif ou un mot de passe invalide';


//
// Index page
//
$lang['Index'] = 'Index';
$lang['No_Posts'] = 'Aucun message';
$lang['No_forums'] = 'Ce forum ne comporte pas de sous-forums';

$lang['Private_Message'] = 'Message priv�';
$lang['Private_Messages'] = 'Messages priv�s';
$lang['Who_is_Online'] = 'Qui est en ligne ?';

$lang['Mark_all_forums'] = 'Marquer tous les forums comme lus';
$lang['Forums_marked_read'] = 'Tous les forums ont �t� marqu�s comme lus';


//
// Viewforum
//
$lang['View_forum'] = 'Voir le forum';

$lang['Forum_not_exist'] = 'Le forum s�lectionn� n\'existe pas.';
$lang['Reached_on_error'] = 'Vous avez atteint cette page par erreur.';

$lang['Display_topics'] = 'Montrer les sujets depuis';
$lang['All_Topics'] = 'Tous les sujets';

$lang['Topic_Announcement'] = '<b>Annonce :</b>';
$lang['Topic_Sticky'] = '<b>Post-it :</b>';
$lang['Topic_Moved'] = '<b>D�plac� :</b>';

//-- mod : inspired of categories hierarchy ------------------------------------
//-- delete
/*-MOD
$lang['Topic_Poll'] = '<b>[ Sondage ]</b>';
MOD-*/
//-- fin mod : inspired of categories hierarchy --------------------------------

$lang['Mark_all_topics'] = 'Marquez tous les sujets comme lus';
$lang['Topics_marked_read'] = 'Les sujets de ce forum sont � pr�sent marqu�s comme lus.';

$lang['Rules_post_can'] = 'Vous <b>pouvez</b> �mettre de nouveaux sujets dans ce forum';
$lang['Rules_post_cannot'] = 'Vous <b>ne pouvez pas</b> �mettre de nouveaux sujets dans ce forum';
$lang['Rules_reply_can'] = 'Vous <b>pouvez</b> r�pondre aux sujets dans ce forum';
$lang['Rules_reply_cannot'] = 'Vous <b>ne pouvez pas</b> r�pondre aux sujets dans ce forum';
$lang['Rules_edit_can'] = 'Vous <b>pouvez</b> �diter vos messages dans ce forum';
$lang['Rules_edit_cannot'] = 'Vous <b>ne pouvez pas</b> �diter vos messages dans ce forum';
$lang['Rules_delete_can'] = 'Vous <b>pouvez</b> supprimer vos messages dans ce forum';
$lang['Rules_delete_cannot'] = 'Vous <b>ne pouvez pas</b> supprimer vos messages dans ce forum';
$lang['Rules_vote_can'] = 'Vous <b>pouvez</b> voter dans les sondages de ce forum';
$lang['Rules_vote_cannot'] = 'Vous <b>ne pouvez pas</b> voter dans les sondages de ce forum';
$lang['Rules_moderate'] = 'Vous <b>pouvez</b> %smod�rer ce forum%s'; // %s replaced by a href links, do not remove! 

$lang['No_topics_post_one'] = 'Il n\'y a pas de messages dans ce forum<br />Cliquez sur le lien <b>Nouveau</b> sur cette page pour en �mettre un.';


//
// Viewtopic
//
$lang['View_topic'] = 'Voir le sujet';

$lang['Guest'] = 'Invit�';
$lang['Post_subject'] = 'Sujet';
$lang['View_next_topic'] = 'Sujet suivant';
$lang['View_previous_topic'] = 'Sujet pr�c�dent';
$lang['Submit_vote'] = 'Envoyer le vote';
$lang['View_results'] = 'Voir les r�sultats';

$lang['No_newer_topics'] = 'Il n\'y a pas de nouveaux sujets dans ce forum';
$lang['No_older_topics'] = 'Il n\'y a pas d\'anciens sujets dans ce forum';
$lang['Topic_post_not_exist'] = 'Le sujet ou message que vous recherchez n\'existe pas';
$lang['No_posts_topic'] = 'Il n\'existe pas de messages pour ce sujet';

$lang['Display_posts'] = 'Montrer les messages depuis';
$lang['All_Posts'] = 'Tous les messages';
$lang['Newest_First'] = 'Le plus r�cent en premier';
$lang['Oldest_First'] = 'Le plus ancien en premier';

$lang['Back_to_top'] = 'Haut de page';

$lang['Read_profile'] = 'Profil de l\'utilisateur'; 
$lang['Visit_website'] = 'Site web de l\'utilisateur';
$lang['ICQ_status'] = 'Statut ICQ';
$lang['Edit_delete_post'] = '�diter/Supprimer ce message';
$lang['View_IP'] = 'Adresse IP de l\'utilisateur';
$lang['Delete_post'] = 'Supprimer ce message';

$lang['wrote'] = 'a �crit'; // proceeds the username and is followed by the quoted text
$lang['Quote'] = 'Citation'; // comes before bbcode quote output.
$lang['Code'] = 'Code'; // comes before bbcode code output.

$lang['Edited_time_total'] = 'Derni�re �dition par %s le %s; �dit� %d fois'; // Last edited by me on 12 Oct 2001, edited 1 time in total
$lang['Edited_times_total'] = 'Derni�re �dition par %s le %s; �dit� %d fois'; // Last edited by me on 12 Oct 2001, edited 2 times in total

$lang['Lock_topic'] = 'Verrouiller ce sujet';
$lang['Unlock_topic'] = 'D�verrouiller ce sujet';
$lang['Move_topic'] = 'D�placer ce sujet';
$lang['Delete_topic'] = 'Supprimer ce sujet';
$lang['Split_topic'] = 'Diviser ce sujet';

$lang['Stop_watching_topic'] = 'Cesser de surveiller ce sujet';
$lang['Start_watching_topic'] = 'Surveiller les r�ponses de ce sujet';
$lang['No_longer_watching'] = 'Vous ne surveillez plus ce sujet';
$lang['You_are_watching'] = 'Vous surveillez ce sujet � pr�sent';

$lang['Total_votes'] = 'Total des votes';

//
// Posting/Replying (Not private messaging!)
//
$lang['Message_body'] = 'Corps du message';
$lang['Topic_review'] = 'Revue du sujet';

$lang['No_post_mode'] = 'Mode du sujet non sp�cifi�'; // If posting.php is called without a mode (newtopic/reply/delete/etc, shouldn't be shown normaly)

$lang['Post_a_new_topic'] = '�mettre un nouveau sujet';
$lang['Post_a_reply'] = '�mettre une r�ponse';
$lang['Post_topic_as'] = '�mettre le sujet en tant que';
$lang['Edit_Post'] = '�diter le sujet';
$lang['Options'] = 'Options';

$lang['Post_Announcement'] = 'Annonce';
$lang['Post_Sticky'] = 'Note';
$lang['Post_Normal'] = 'Normal';

$lang['Confirm_delete'] = 'Etes-vous certain(e) de vouloir supprimer ce message ?';
$lang['Confirm_delete_poll'] = 'Etes-vous certain(e) de vouloir supprimer ce sondage ?';

$lang['Flood_Error'] = 'Vous ne pouvez pas poster un autre sujet en si peu de temps apr�s le dernier; veuillez r�essayer dans un court instant.';
$lang['Empty_subject'] = 'Vous devez pr�ciser le nom du sujet avant de pouvoir �mettre un nouveau sujet.';
$lang['Empty_message'] = 'Vous devez saisir un message avant de pouvoir �mettre.';
$lang['Forum_locked'] = 'Ce forum est verrouill�; vous ne pouvez ni �mettre, ni r�pondre, ni �diter les sujets.';
$lang['Topic_locked'] = 'Ce sujet est verrouill�; vous ne pouvez ni �diter les messages, ni r�pondre.';
$lang['No_post_id'] = 'Vous devez s�lectionner un message � �diter';
$lang['No_topic_id'] = 'Vous devez s�lectionner le sujet auquel r�pondre';
$lang['No_valid_mode'] = 'Vous pouvez seulement �mettre, r�pondre, �diter ou citer des messages; veuillez revenir en arri�re et r�essayer.';
$lang['No_such_post'] = 'Il n\'y a aucun message de ce type; veuillez revenir en arri�re et r�essayer.';
$lang['Edit_own_posts'] = 'Vous pouvez uniquement �diter vos propres messages.';
$lang['Delete_own_posts'] = 'Vous pouvez uniquement supprimer vos propres messages.';
$lang['Cannot_delete_replied'] = 'Vous ne pouvez pas supprimer un message ayant eu des r�ponses.';
$lang['Cannot_delete_poll'] = 'Vous ne pouvez pas supprimer un sondage actif.';
$lang['Empty_poll_title'] = 'Vous devez entrer un titre pour le sondage.';
$lang['To_few_poll_options'] = 'Vous devez au moins ins�rer deux options au sondage.';
$lang['To_many_poll_options'] = 'Vous avez ins�r� trop d\'options au sondage.';
$lang['Post_has_no_poll'] = 'Ce sujet ne comporte pas de sondage.';
$lang['Already_voted'] = 'Vous avez d�j� particip� � ce sondage.'; 
$lang['No_vote_option'] = 'Vous devez choisir une option avant de voter.';

$lang['Add_poll'] = 'Ajouter un sondage';
$lang['Add_poll_explain'] = 'Si vous ne voulez pas ajouter de sondage � votre sujet, laissez ces champs vides.';
$lang['Poll_question'] = 'Question du sondage';
$lang['Poll_option'] = 'Option du sondage';
$lang['Add_option'] = 'Ajouter l\'option';
$lang['Update'] = 'Mettre � jour';
$lang['Delete'] = 'Supprimer';
$lang['Poll_for'] = 'Sondage pendant';
$lang['Days'] = 'jours'; // This is used for the Run poll for ... Days + in admin_forums for pruning
$lang['Poll_for_explain'] = '[ Ins�rez 0 ou laissez vide pour ne jamais terminer le sondage ]';
$lang['Delete_poll'] = 'Supprimer le sondage';

$lang['Disable_HTML_post'] = 'D�sactiver le HTML dans ce message';
$lang['Disable_BBCode_post'] = 'D�sactiver le BBCode dans ce message';
$lang['Disable_Smilies_post'] = 'D�sactiver les smilies dans ce message';

$lang['HTML_is_ON'] = 'HTML <u>activ�</u>';
$lang['HTML_is_OFF'] = 'HTML <u>d�sactiv�</u>';
$lang['BBCode_is_ON'] = '%sBBCode%s <u>activ�</u>'; // %s are replaced with URI pointing to FAQ
$lang['BBCode_is_OFF'] = '%sBBCode%s <u>d�sactiv�</u>';
$lang['Smilies_are_ON'] = 'Smilies <u>activ�s</u>';
$lang['Smilies_are_OFF'] = 'Smilies <u>d�sactiv�s</u>';

$lang['Attach_signature'] = 'Attacher sa signature (les signatures peuvent �tre modifi�es dans le profil)';
$lang['Notify'] = 'Me pr�venir lorsque quelqu\'un a r�pondu';

$lang['Stored'] = 'Message enregistr�.';
$lang['Deleted'] = 'Message supprim�.';
$lang['Poll_delete'] = 'Votre sondage a �t� supprim�.';
$lang['Vote_cast'] = 'Votre vote a �t� pris en compte.';

$lang['Topic_reply_notification'] = 'Notification de r�ponse au sujet';

$lang['bbcode_b_help'] = 'Texte gras : [b]texte[/b] (alt+b)';
$lang['bbcode_i_help'] = 'Texte italique : [i]texte[/i] (alt+i)';
$lang['bbcode_u_help'] = 'Texte soulign� : [u]texte[/u] (alt+u)';
$lang['bbcode_q_help'] = 'Citation : [quote]texte cit�[/quote] (alt+q)';
$lang['bbcode_c_help'] = 'Afficher du code : [code]code[/code] (alt+c)';
$lang['bbcode_l_help'] = 'Liste : [list]texte[/list] (alt+l)';
$lang['bbcode_o_help'] = 'Liste ordonn�e : [list=]texte[/list] (alt+o)';
$lang['bbcode_p_help'] = 'Ins�rer une image : [img]http://image_url/[/img] (alt+p)';
$lang['bbcode_w_help'] = 'Ins�rer un lien : [url]http://url/[/url] ou [url=http://url/]Nom[/url] (alt+w)';
$lang['bbcode_a_help'] = 'Fermer toutes les balises BBCode ouvertes';
$lang['bbcode_s_help'] = 'Couleur du texte : [color=red]texte[/color] ce rouge fait partie du code, l\'astuce : #FF0000 fonctionne aussi';
$lang['bbcode_f_help'] = 'Taille du texte : [size=x-small]texte en petit[/size]';

$lang['Emoticons'] = 'Smilies';
$lang['More_emoticons'] = 'Voir plus de smilies';

$lang['Font_color'] = 'Couleur';
$lang['color_default'] = 'D�faut';
$lang['color_dark_red'] = 'Rouge fonc�';
$lang['color_red'] = 'Rouge';
$lang['color_orange'] = 'Orange';
$lang['color_brown'] = 'Marron';
$lang['color_yellow'] = 'Jaune';
$lang['color_green'] = 'Vert';
$lang['color_olive'] = 'Olive';
$lang['color_cyan'] = 'Cyan';
$lang['color_blue'] = 'Bleu';
$lang['color_dark_blue'] = 'Bleu fonc�';
$lang['color_indigo'] = 'Indigo';
$lang['color_violet'] = 'Violet';
$lang['color_white'] = 'Blanc';
$lang['color_black'] = 'Noir';

$lang['Font_size'] = 'Taille';
$lang['font_tiny'] = 'Tr�s petit';
$lang['font_small'] = 'Petit';
$lang['font_normal'] = 'Normal';
$lang['font_large'] = 'Grand';
$lang['font_huge'] = 'Tr�s grand';

$lang['Close_Tags'] = 'Fermer les balises';
$lang['Styles_tip'] = 'Astuce : Une mise en forme peut �tre appliqu�e au texte s�lectionn�.';


//
// Private Messaging
//
$lang['Private_Messaging'] = 'Messages priv�s';

$lang['Login_check_pm'] = 'Se connecter pour v�rifier ses messages priv�s';
$lang['New_pms'] = '%d nouveaux messages'; // You have 2 new messages
$lang['New_pm'] = '%d nouveau message'; // You have 1 new message
$lang['No_new_pm'] = 'Messages priv�s';
$lang['Unread_pms'] = '%d messages non-lus';
$lang['Unread_pm'] = '%d message non-lu';
$lang['No_unread_pm'] = 'Aucun message non-lu';
$lang['You_new_pm'] = 'Un nouveau message priv� vous attend dans votre bo�te de r�ception';
$lang['You_new_pms'] = 'De nouveaux messages priv�s vous attendent dans votre bo�te de r�ception';
$lang['You_no_new_pm'] = 'Aucun nouveau message priv� ne vous attend dans votre bo�te de r�ception';

$lang['Unread_message'] = 'Message non-lu'; 
$lang['Read_message'] = 'Message d�j� lu';

$lang['Read_pm'] = 'Lire'; 
$lang['Post_new_pm'] = 'Nouveau message'; 
$lang['Post_reply_pm'] = 'R�pondre'; 
$lang['Post_quote_pm'] = 'Citer ce message'; 
$lang['Edit_pm'] = '�diter'; 

$lang['Inbox'] = 'Bo�te de r�ception';
$lang['Outbox'] = 'Bo�te d\'envoi';
$lang['Savebox'] = 'Archives';
$lang['Sentbox'] = 'Messages envoy�s';
$lang['Flag'] = '';
$lang['Subject'] = 'Sujet';
$lang['From'] = 'De';
$lang['To'] = 'A';
$lang['Date'] = 'Date';
$lang['Mark'] = 'Marquer';
$lang['Sent'] = 'Envoy�';
$lang['Saved'] = 'Archiv�';
$lang['Delete_marked'] = 'Supprimer la s�lection';
$lang['Delete_all'] = 'Tout supprimer';
$lang['Save_marked'] = 'Sauvegarder la s�lection'; 
$lang['Save_message'] = 'Sauvegarder';
$lang['Delete_message'] = 'Supprimer';

$lang['Display_messages'] = 'Montrer les messages depuis'; // Followed by number of days/weeks/months
$lang['All_Messages'] = 'Tous les messages';

$lang['No_messages_folder'] = 'Aucun message dans ce dossier';

$lang['PM_disabled'] = 'Les messages priv�s ont �t� d�sactiv�s sur ce forum.';
$lang['Cannot_send_privmsg'] = 'L\'administrateur vous a emp�ch� d\'envoyer des messages priv�s.';
$lang['No_to_user'] = 'Vous devez pr�ciser un nom d\'utilisateur pour envoyer ce message.';
$lang['No_such_user'] = 'Cet utilisateur n\'existe pas.';

$lang['Disable_HTML_pm'] = 'D�sactiver le HTML dans ce message';
$lang['Disable_BBCode_pm'] = 'D�sactiver le BBCode dans ce message';
$lang['Disable_Smilies_pm'] = 'D�sactiver les smilies dans ce message';

$lang['Message_sent'] = 'Votre message a �t� envoy�.';

$lang['Click_return_inbox'] = 'Cliquez %sici%s pour retourner � votre bo�te de r�ception';
$lang['Click_return_index'] = 'Cliquez %sici%s pour retourner � l\'index';

$lang['Send_a_new_message'] = 'Envoyer un nouveau message priv�';
$lang['Send_a_reply'] = 'R�pondre � un message priv�';
$lang['Edit_message'] = '�diter un message priv�';

$lang['Notification_subject'] = 'Un nouveau message priv� vient d\'arriver.';

$lang['Find_username'] = 'Trouver un nom d\'utilisateur';
$lang['Find'] = 'Trouver';
$lang['No_match'] = 'Aucun enregistrement trouv�.';

$lang['No_post_id'] = 'L\'ID du message n\'a pas �t� sp�cifi�e';
$lang['No_such_folder'] = 'Le dossier n\'existe pas';
$lang['No_folder'] = 'Aucun dossier sp�cifi�';

$lang['Mark_all'] = 'Tout s�lectionner';
$lang['Unmark_all'] = 'Tout d�s�lectionner';

$lang['Confirm_delete_pm'] = 'Etes-vous certain(e) de vouloir supprimer ce message ?';
$lang['Confirm_delete_pms'] = 'Etes-vous certain(e) de vouloir supprimer ces messages ?';

$lang['Inbox_size'] = 'Votre Bo�te de r�ception est pleine � %d%%'; // eg. Your Inbox is 50% full
$lang['Sentbox_size'] = 'Votre Bo�te des Messages envoy�s est pleine � %d%%'; 
$lang['Savebox_size'] = 'Votre Bo�te des Archives est pleine � %d%%'; 

$lang['Click_view_privmsg'] = 'Cliquez %sici%s pour voir votre Bo�te de r�ception';


//
// Profiles/Registration
//
$lang['Viewing_user_profile'] = 'Profil :: %s'; // %s is username 
$lang['About_user'] = 'Tout sur %s'; // %s is username

$lang['Preferences'] = 'Pr�f�rences';
$lang['Items_required'] = 'Les champs marqu�s d\'un * sont obligatoires.';
$lang['Registration_info'] = 'Enregistrement';
$lang['Profile_info'] = 'Profil';
$lang['Profile_info_warn'] = 'Ces informations seront visibles publiquement';
$lang['Avatar_panel'] = 'Panneau de contr�le des avatars';
$lang['Avatar_gallery'] = 'Galerie des avatars';

$lang['Website'] = 'Site web';
$lang['Location'] = 'Localit�';
$lang['Contact'] = 'Contact';
$lang['Email_address'] = 'E-mail';
$lang['Send_private_message'] = 'Message priv�';
$lang['Hidden_email'] = '[ Invisible ]';
$lang['Interests'] = 'Loisirs';
$lang['Occupation'] = 'Emploi'; 
$lang['Poster_rank'] = 'Rang de l\'utilisateur';

$lang['Total_posts'] = 'Messages';
$lang['User_post_pct_stats'] = '%.2f%% du total'; // 1.25% of total
$lang['User_post_day_stats'] = '%.2f messages par jour'; // 1.5 posts per day
$lang['Search_user_posts'] = 'Trouver tous les messages de %s'; // Find all posts by username

$lang['No_user_id_specified'] = 'Cet utilisateur n\'existe pas.';
$lang['Wrong_Profile'] = 'Vous ne pouvez pas modifier un profil qui n\'est pas le v�tre.';

$lang['Only_one_avatar'] = 'Seul un type d\'avatar peut �tre sp�cifi�';
$lang['File_no_data'] = 'Le fichier de l\'URL que vous avez donn� ne contient aucune donn�e';
$lang['No_connection_URL'] = 'Une connexion ne peut �tre �tablie avec l\'URL que vous avez donn�';
$lang['Incomplete_URL'] = 'L\'URL que vous avez entr� est incompl�te';
$lang['Wrong_remote_avatar_format'] = 'L\'URL de l\'avatar est invalide';
$lang['No_send_account_inactive'] = 'D�sol�, mais votre mot de passe ne peut pas �tre renouvell� �tant donn� que votre compte est actuellement inactif. Veuillez contacter l\'administrateur du forum afin d\'obtenir de plus amples informations.';

$lang['Always_smile'] = 'Toujours activer les smilies';
$lang['Always_html'] = 'Toujours autoriser le HTML';
$lang['Always_bbcode'] = 'Toujours autoriser le BBCode';
$lang['Always_add_sig'] = 'Toujours attacher sa signature';
$lang['Always_notify'] = 'Toujours m\'avertir des r�ponses';
$lang['Always_notify_explain'] = 'Envoie un e-mail lorsque quelqu\'un r�pond aux sujets que vous avez post�. Ceci peut �tre chang� � chaque fois que vous �mettez.';

$lang['Board_style'] = 'Th�me du forum';
$lang['Board_lang'] = 'Langue du forum';
$lang['No_themes'] = 'Aucun th�me dans la base de donn�es';
$lang['Timezone'] = 'Fuseau horaire';
$lang['Date_format'] = 'Format de la date';
$lang['Date_format_explain'] = 'La syntaxe utilis�e est identique � la fonction <a href=\'http://www.php.net/manual/fr/function.date.php\' target=\'_other\'>date()</a> du PHP.';
$lang['Signature'] = 'Signature';
$lang['Signature_explain'] = 'Ceci est un bloc de texte qui peut �tre ajout� aux messages que vous �mettez. Il y a une limite de %d caract�res';
$lang['Public_view_email'] = 'Toujours afficher son adresse e-mail';

$lang['Current_password'] = 'Mot de passe actuel';
$lang['New_password'] = 'Nouveau mot de passe';
$lang['Confirm_password'] = 'Confirmer le mot de passe';
$lang['Confirm_password_explain'] = 'Vous devez confirmer votre mot de passe si vous souhaitez modifier votre adresse e-mail';
$lang['password_if_changed'] = 'Vous avez seulement besoin de fournir un mot de passe si vous voulez le changer';
$lang['password_confirm_if_changed'] = 'Vous avez seulement besoin de confirmer votre mot de passe si vous l\'avez chang� ci-dessus';

$lang['Avatar'] = 'Avatar';
$lang['Avatar_explain'] = 'Affiche une petite image au-dessous de vos d�tails dans vos messages. Sa largeur ne peut pas d�passer %d pixels, sa hauteur %d pixels et la taille du fichier, pas plus de %d ko.';
$lang['Upload_Avatar_file'] = 'Envoyer l\'avatar depuis votre ordinateur';
$lang['Upload_Avatar_URL'] = 'Envoyer l\'avatar � partir d\'une URL';
$lang['Upload_Avatar_URL_explain'] = 'Entrez l\'URL de l\'avatar; elle sera copi�e sur ce site.';
$lang['Pick_local_Avatar'] = 'S�lectionner un avatar de la galerie';
$lang['Link_remote_Avatar'] = 'Lier l\'avatar � partir d\'un autre site';
$lang['Link_remote_Avatar_explain'] = 'Entrez l\'URL de l\'avatar que vous souhaitez lier.';
$lang['Avatar_URL'] = 'URL de l\'avatar';
$lang['Select_from_gallery'] = 'S�lectionner un avatar � partir de la galerie';
$lang['View_avatar_gallery'] = 'Montrer la galerie';

$lang['Select_avatar'] = 'S�lectionner l\'avatar';
$lang['Return_profile'] = 'Annuler l\'avatar';
$lang['Select_category'] = 'S�lectionner une cat�gorie';

$lang['Delete_Image'] = 'Supprimer l\'image';
$lang['Current_Image'] = 'Image actuelle';

$lang['Notify_on_privmsg'] = 'M\'avertir des nouveaux messages priv�s';
$lang['Popup_on_privmsg'] = 'Ouverture d\'une Pop-up lors de nouveaux messages priv�s'; 
$lang['Popup_on_privmsg_explain'] = 'Certains th�mes peuvent ouvrir une nouvelle fen�tre pour vous informer de l\'arriv�e de nouveaux messages priv�s'; 
$lang['Hide_user'] = 'Cacher sa pr�sence en ligne';

$lang['Profile_updated'] = 'Votre profil a �t� mis � jour';
$lang['Profile_updated_inactive'] = 'Votre profil a �t� mis � jour. Toutefois, vous avez modifi� des d�tails vitaux; ainsi, votre compte redevient inactif. V�rifiez votre bo�te e-mail pour savoir comment r�activer votre compte ou, si l\'activation par l\'administrateur est requise, patientez jusqu\'� ce qu\'il le r�active.';

$lang['Password_mismatch'] = 'Les mots de passe que avez saisi sont diff�rents.';
$lang['Current_password_mismatch'] = 'Le mot de passe que vous avez saisi est diff�rent de celui stock� dans la base de donn�es.';
$lang['Password_long'] = 'Votre mot de passe ne doit pas d�passer 32 caract�res.';
$lang['Username_taken'] = 'Ce nom d\'utilisateur est d�j� utilis�.';
$lang['Username_invalid'] = 'Ce nom d\'utilisateur contient un caract�re invalide comme \' par exemple.';
$lang['Username_disallowed'] = 'Ce nom d\'utilisateur a �t� interdit d\'utilisation.';
$lang['Email_taken'] = 'Cette adresse e-mail est d�j� utilis�e par un autre utilisateur.';
$lang['Email_banned'] = 'Cette adresse e-mail a �t� bannie.';
$lang['Email_invalid'] = 'Cette adresse e-mail est invalide.';
$lang['Signature_too_long'] = 'Votre signature est trop longue.';
$lang['Fields_empty'] = 'Vous devez compl�ter les champs obligatoires.';
$lang['Avatar_filetype'] = 'Le type de fichier de l\'avatar doit �tre .jpg, .gif ou .png';
$lang['Avatar_filesize'] = 'La taille de l\'image de l\'avatar doit �tre inf�rieure � %d ko'; // The avatar image file size must be less than 6 ko
$lang['Avatar_imagesize'] = 'La taille de l\'avatar doit �tre de %d pixels de largeur et de %d pixels de hauteur'; 

$lang['Welcome_subject'] = 'Bienvenue sur les forums de %s'; // Welcome to my.com forums
$lang['New_account_subject'] = 'Nouveau compte utilisateur';
$lang['Account_activated_subject'] = 'Compte activ�';

$lang['Account_added'] = 'Merci de vous �tre enregistr�; votre compte a �t� cr��. Vous pouvez vous connecter avec votre nom d\'utilisateur et mot de passe';
$lang['Account_inactive'] = 'Votre compte a �t� cr��. Toutefois, ce forum requiert que votre compte soit activ�, et donc une clef d\'activation a �t� envoy�e � l\'adresse e-mail que vous avez fournie. Veuillez v�rifier votre bo�te e-mail pour de plus amples informations.';
$lang['Account_inactive_admin'] = 'Votre compte a �t� cr��. Toutefois, ce forum requiert que votre compte soit activ� par l\'administrateur. Un e-mail lui a �t� envoy� et vous serez inform� lorsque votre compte sera activ�.';
$lang['Account_active'] = 'Votre compte a �t� activ�. Merci de vous �tre enregistr�';
$lang['Account_active_admin'] = 'Le compte a �t� activ�';
$lang['Reactivate'] = 'R�activez votre compte !';
$lang['Already_activated'] = 'Votre compte est d�j� activ�';
$lang['COPPA'] = 'Votre compte a �t� cr��, mais il doit �tre approuv�. Veuillez v�rifier votre bo�te e-mail pour plus de d�tails.';

$lang['Registration'] = 'Enregistrement - R�glement';

//-- mod : vAgreement terms ----------------------------------------------------
//-- delete
/*-MOD
$lang['Reg_agreement'] = 'Les administrateurs et mod�rateurs de ce forum s\'efforceront de supprimer ou �diter tous les messages � caract�re r�pr�hensible aussi rapidement que possible. Toutefois, il leur est impossible de passer en revue tous les messages. Vous admettez donc que tous les messages post�s sur ces forums expriment la vue et opinion de leurs auteurs respectifs, et non pas des administrateurs, ou mod�rateurs, ou webmestres (except� les messages post�s par eux-m�me) et par cons�quent ne peuvent pas �tre tenus pour responsables.<br /><br />Vous consentez � ne pas poster de messages injurieux, obsc�nes, vulgaires, diffamatoires, mena�ants, sexuels ou tout autre message qui violeraient les lois applicables. Le faire peut vous conduire � �tre banni imm�diatement de fa�on permanente (et votre fournisseur d\'acc�s � internet en sera inform�). L\'adresse IP de chaque message est enregistr�e afin d\'aider � faire respecter ces conditions. Vous �tes d\'accord sur le fait que le webmestre, l\'administrateur et les mod�rateurs de ce forum ont le droit de supprimer, �diter, d�placer ou verrouiller n\'importe quel sujet de discussion � tout moment. En tant qu\'utilisateur, vous �tes d\'accord sur le fait que toutes les informations que vous donnerez ci-apr�s seront stock�es dans une base de donn�es. Cependant, ces informations ne seront divulgu�es � aucune tierce personne ou soci�t� sans votre accord. Le webmestre, l\'administrateur, et les mod�rateurs ne peuvent pas �tre tenus pour responsables si une tentative de piratage informatique conduit � l\'acc�s de ces donn�es.<br /><br />Ce forum utilise les cookies pour stocker des informations sur votre ordinateur. Ces cookies ne contiendront aucune information que vous aurez entr� ci-apr�s; ils servent uniquement � am�liorer le confort d\'utilisation. L\'adresse e-mail est uniquement utilis�e afin de confirmer les d�tails de votre enregistrement ainsi que votre mot de passe (et aussi pour vous envoyer un nouveau mot de passe dans le cas o� vous l\'oublieriez).<br /><br />En vous enregistrant, vous vous portez garant du fait d\'�tre en accord avec le r�glement ci-dessus.';
MOD-*/
//-- fin mod : vAgreement terms ------------------------------------------------

$lang['Agree_under_13'] = 'J\'accepte le r�glement et j\'ai <b>moins</b> de 13 ans';
$lang['Agree_over_13'] = 'J\'accepte le r�glement et j\'ai <b>exactement</b> ou <b>plus</b> de 13 ans';
$lang['Agree_not'] = 'Je n\'accepte pas le r�glement';

$lang['Wrong_activation'] = 'La clef d\'activation que vous avez fourni ne correspond pas � celle de la base de donn�es.';
$lang['Send_password'] = 'Envoyez-moi un nouveau mot de passe'; 
$lang['Password_updated'] = 'Un nouveau mot de passe a �t� cr��; veuillez v�rifier votre bo�te e-mail pour plus de d�tails concernant l\'activation de celui-ci.';
$lang['No_email_match'] = 'L\'adresse e-mail que vous avez fourni ne correspond pas avec celle qui a �t� utilis�e pour ce nom d\'utilisateur.';
$lang['New_password_activation'] = 'Activation d\'un nouveau mot de passe';
$lang['Password_activated'] = 'Votre compte a �t� r�activ�. Pour vous connecter, veuillez utiliser le mot de passe fourni dans l\'e-mail que vous avez re�u.';

$lang['Send_email_msg'] = 'Envoyer un message e-mail';
$lang['No_user_specified'] = 'Aucun utilisateur sp�cifi�';
$lang['User_prevent_email'] = 'Cet utilisateur ne souhaite pas recevoir d\'e-mail. Essayez de lui envoyer un message priv�.';
$lang['User_not_exist'] = 'Cet utilisateur n\'existe pas';
$lang['CC_email'] = 'Envoyer une copie de cet e-mail � soi-m�me';
$lang['Email_message_desc'] = 'Ce message sera envoy� en mode texte uniquement; n\'ins�rez aucun code HTML ou BBCode. L\'adresse de r�ponse pour ce message sera celle de votre e-mail.';
$lang['Flood_email_limit'] = 'Vous ne pouvez pas envoyer un autre e-mail pour le moment; essayez plus tard';
$lang['Recipient'] = 'Destinataire';
$lang['Email_sent'] = 'L\'e-mail a �t� envoy�.';
$lang['Send_email'] = 'Envoyer un e-mail';
$lang['Empty_subject_email'] = 'Vous devez sp�cifier le sujet pour l\'e-mail.';
$lang['Empty_message_email'] = 'Vous devez entrer un message pour qu\'il soit exp�di�.';


//
// Visual confirmation system settings
//
$lang['Confirm_code_wrong'] = 'Le code de confirmation que vous avez saisi ne correspond pas � celui de l\'image. Veuillez r�essayer ult�rieurement.';
$lang['Too_many_registers'] = 'Vous avez d�pass� le nombre de tentatives d\'enregistrement pour cette session. Veuillez r�essayer ult�rieurement.';
$lang['Confirm_code_impaired'] = 'Si vous �tes visuellement d�ficient ou si vous ne pouvez lire ce code, veuillez contacter l\'%sadministrateur%s afin d\'obtenir de l\'aide.';
$lang['Confirm_code'] = 'Code de confirmation';
$lang['Confirm_code_explain'] = 'Entrez exactement le code que vous voyez sur l\'image';



//
// Memberslist
//
$lang['Select_sort_method'] = 'S�lectionner la m�thode de tri';
$lang['Sort'] = 'Trier';
$lang['Sort_Top_Ten'] = 'Top 10';
$lang['Sort_Joined'] = 'Inscrit le';
$lang['Sort_Username'] = 'Nom d\'utilisateur';
$lang['Sort_Location'] = 'Localisation';
$lang['Sort_Posts'] = 'Messages';
$lang['Sort_Email'] = 'E-mail';
$lang['Sort_Website'] = 'Site web';
$lang['Sort_Ascending'] = 'Croissant';
$lang['Sort_Descending'] = 'D�croissant';
$lang['Order'] = 'Ordre';


//
// Group control panel
//
$lang['Group_Control_Panel'] = 'Panneau de contr�le des groupes';
$lang['Group_member_details'] = 'Appartenance � un groupe';
$lang['Group_member_join'] = 'Rejoindre un groupe';

$lang['Group_Information'] = 'Informations du groupe';
$lang['Group_name'] = 'Nom du groupe';
$lang['Group_description'] = 'Description du groupe';
$lang['Group_membership'] = 'Votre statut';
$lang['Group_Members'] = 'Membres du groupe';
$lang['Group_Moderator'] = 'Mod�rateur du groupe';
$lang['Pending_members'] = 'Membres en attente';

$lang['Group_type'] = 'Type du groupe';
$lang['Group_open'] = 'Groupe ouvert';
$lang['Group_closed'] = 'Groupe ferm�';
$lang['Group_hidden'] = 'Groupe invisible';

$lang['Current_memberships'] = 'Membre du groupe';
$lang['Non_member_groups'] = 'Non-membre du groupe';
$lang['Memberships_pending'] = 'Adh�sions en attente';

$lang['No_groups_exist'] = 'Aucun groupe n\'existe';
$lang['Group_not_exist'] = 'Ce groupe d\'utilisateurs n\'existe pas';

$lang['Join_group'] = 'Rejoindre le groupe';
$lang['No_group_members'] = 'Ce groupe n\'a pas de membres';
$lang['Group_hidden_members'] = 'Ce groupe est invisible; vous ne pouvez pas voir son effectif';
$lang['No_pending_group_members'] = 'Ce groupe n\'a pas d\'utilisateurs en attente';
$lang['Group_joined'] = 'Vous vous �tes inscrit � ce groupe.<br />Vous serez averti lorsque votre inscription sera approuv�e par le mod�rateur du groupe.';
$lang['Group_request'] = 'Une requ�te d\'adh�sion � votre groupe a �t� faite.';
$lang['Group_approved'] = 'Votre requ�te a �t� approuv�e.';
$lang['Group_added'] = 'Vous avez �t� rajout� � ce groupe d\'utilisateurs.';
$lang['Already_member_group'] = 'Vous �tes d�j� membre de ce groupe';
$lang['User_is_member_group'] = 'L\'utilisateur est d�j� membre de ce groupe';
$lang['Group_type_updated'] = 'Vous avez mis � jour le type du groupe.';

$lang['Could_not_add_user'] = 'L\'utilisateur que vous avez s�lectionn� n\'existe pas.';
$lang['Could_not_anon_user'] = 'Vous ne pouvez pas rendre des utilisateurs anonymes, membres d\'un groupe.';

$lang['Confirm_unsub'] = 'Etes-vous certain(e) de vouloir vous d�sinscrire de ce groupe ?';
$lang['Confirm_unsub_pending'] = 'Votre inscription � ce groupe n\'a pas encore �t� approuv�e; �tes-vous certain(e) de vouloir vous d�sinscrire ?';

$lang['Unsub_success'] = 'Vous avez �t� d�sinscrit de ce groupe.';

$lang['Approve_selected'] = 'Approuver la s�lection';
$lang['Deny_selected'] = 'Refuser la s�lection';
$lang['Not_logged_in'] = 'Vous devez �tre connect� pour joindre un groupe.';
$lang['Remove_selected'] = 'Supprimer la s�lection';
$lang['Add_member'] = 'Ajouter le membre';
$lang['Not_group_moderator'] = 'Vous n\'�tes pas le mod�rateur de ce groupe; vous ne pouvez donc pas accomplir cette action.';

$lang['Login_to_join'] = 'Connectez-vous pour joindre ou g�rer les adh�sions du groupe';
$lang['This_open_group'] = 'Ceci est un groupe ouvert : cliquez pour faire une demande d\'adh�sion';
$lang['This_closed_group'] = 'Ceci est un groupe ferm� : plus aucun utilisateur n\'est accept�';
$lang['This_hidden_group'] = 'Ceci est un groupe invisible : l\'ajout automatique d\'utilisateurs n\'est pas autoris�';
$lang['Member_this_group'] = 'Vous �tes membre du groupe';
$lang['Pending_this_group'] = 'Votre adh�sion � ce groupe est en attente';
$lang['Are_group_moderator'] = 'Vous �tes le mod�rateur du groupe';
$lang['None'] = 'Aucun';

$lang['Subscribe'] = 'S\'inscrire';
$lang['Unsubscribe'] = 'Se d�sinscrire';
$lang['View_Information'] = 'Voir les informations';


//
// Search
//
$lang['Search_query'] = 'Rechercher';
$lang['Search_options'] = 'Options de recherche';

$lang['Search_keywords'] = 'Recherche par mots-cl�s';
$lang['Search_keywords_explain'] = 'Vous pouvez utiliser <u>AND</u> pour d�terminer les mots qui doivent �tre pr�sents dans les r�sultats, <u>OR</u> pour d�terminer les mots qui peuvent �tre pr�sents dans les r�sultats et <u>NOT</u> pour d�terminer les mots qui ne devraient pas �tre pr�sents dans les r�sultats. Utilisez * comme un joker pour des recherches partielles';
$lang['Search_author'] = 'Recherche par auteur';
$lang['Search_author_explain'] = 'Utilisez * comme un joker pour des recherches partielles';

$lang['Search_for_any'] = 'Rechercher n\'importe quel de ces termes';
$lang['Search_for_all'] = 'Rechercher tous les termes';
$lang['Search_title_msg'] = 'Rechercher dans les titres et messages';
$lang['Search_msg_only'] = 'Rechercher dans les messages uniquement';

$lang['Return_first'] = 'Retourner les'; // followed by xxx characters in a select box
$lang['characters_posts'] = 'premiers caract�res des messages';

$lang['Search_previous'] = 'Rechercher depuis'; // followed by days, weeks, months, year, all in a select box

$lang['Sort_by'] = 'Trier par';
$lang['Sort_Time'] = 'Heure du message';
$lang['Sort_Post_Subject'] = 'Sujet du message';
$lang['Sort_Topic_Title'] = 'Titre du sujet';
$lang['Sort_Author'] = 'Auteur';
$lang['Sort_Forum'] = 'Forum';

$lang['Display_results'] = 'Afficher les r�sultats sous forme de';
$lang['All_available'] = 'Tous disponible';
$lang['No_searchable_forums'] = 'Vous n\'avez pas la permission de rechercher quelconque forum sur ce site.';

$lang['No_search_match'] = 'Aucun sujet ou message ne correspond � vos crit�res de recherche';
$lang['Found_search_match'] = '%d r�sultat trouv�'; // eg. Search found 1 match
$lang['Found_search_matches'] = '%d r�sultats trouv�s'; // eg. Search found 24 matches
$lang['Search_Flood_Error'] = 'Vous ne pouvez pas lancer une autre recherche si rapidement apr�s la derni�re effectu�e; veuillez r�essayer � nouveau dans un court moment.';

$lang['Close_window'] = 'Fermer la fen�tre';


//
// Auth related entries
//
// Note the %s will be replaced with one of the following 'user' arrays
$lang['Sorry_auth_announce'] = 'Seuls les %s peuvent �mettre des annonces dans ce forum.';
$lang['Sorry_auth_sticky'] = 'Seuls les %s peuvent �mettre des post-it dans ce forum.';
$lang['Sorry_auth_read'] = 'Seuls les %s peuvent lire des sujets dans ce forum.';
$lang['Sorry_auth_post'] = 'Seuls les %s peuvent �mettre dans ce forum.';
$lang['Sorry_auth_reply'] = 'Seuls les %s peuvent r�pondre aux messages dans ce forum.';
$lang['Sorry_auth_edit'] = 'Seuls les %s peuvent �diter des messages dans ce forum.';
$lang['Sorry_auth_delete'] = 'Seuls les %s peuvent supprimer des messages dans ce forum.';
$lang['Sorry_auth_vote'] = 'Seuls les %s peuvent voter aux sondages dans ce forum.';

// These replace the %s in the above strings
$lang['Auth_Anonymous_Users'] = '<b>utilisateurs anonymes</b>';
$lang['Auth_Registered_Users'] = '<b>utilisateurs enregistr�s</b>';
$lang['Auth_Users_granted_access'] = '<b>utilisateurs avec un acc�s sp�cial</b>';
$lang['Auth_Moderators'] = '<b>mod�rateurs</b>';
$lang['Auth_Administrators'] = '<b>administrateurs</b>';

$lang['Not_Moderator'] = 'Vous n\'�tes pas mod�rateur sur ce forum.';
$lang['Not_Authorised'] = 'Non Autoris�';

$lang['You_been_banned'] = 'Vous avez �t� banni de ce forum.<br />Veuillez contacter le webmestre ou l\'administrateur du forum pour plus d\'informations.';


//
// Viewonline
//
$lang['Reg_users_zero_online'] = 'Il n\'y a aucunutilisateur enregistr� et '; // There are 5 Registered and
$lang['Reg_users_online'] = 'Il y a %d utilisateurs enregistr�s et '; // There are 5 Registered and
$lang['Reg_user_online'] = 'Il y a %d utilisateur enregistr� et '; // There is 1 Registered and
$lang['Hidden_users_zero_online'] = 'Aucun utilisateur invisible en ligne'; // 6 Hidden users online
$lang['Hidden_users_online'] = '%d utilisateurs invisibles en ligne'; // 6 Hidden users online
$lang['Hidden_user_online'] = '%d utilisateur invisible en ligne'; // 6 Hidden users online
$lang['Guest_users_online'] = 'Il y a %d invit�s en ligne'; // There are 10 Guest users online
$lang['Guest_users_zero_online'] = 'Il n\'y a aucun invit� en ligne'; // There are 10 Guest users online
$lang['Guest_user_online'] = 'Il y a %d invit� en ligne'; // There is 1 Guest user online
$lang['No_users_browsing'] = 'Il n\'y a actuellement personne sur ce forum';

$lang['Online_explain'] = 'Ces donn�es sont bas�es sur les utilisateurs actifs des cinq derni�res minutes';

$lang['Forum_Location'] = 'Emplacement sur le forum';
$lang['Last_updated'] = 'Derni�re mise � jour';

$lang['Forum_index'] = 'Index du forum';
$lang['Logging_on'] = 'Se connecte';
$lang['Posting_message'] = '�met un message';
$lang['Searching_forums'] = 'Recherche sur le forum';
$lang['Viewing_profile'] = 'Regarde un profil';
$lang['Viewing_online'] = 'Regarde qui est en ligne';
$lang['Viewing_member_list'] = 'Regarde la liste des membres';
$lang['Viewing_priv_msgs'] = 'Regarde ses messages priv�s';
$lang['Viewing_FAQ'] = 'Regarde la FAQ';


//
// Moderator Control Panel
//
$lang['Mod_CP'] = 'Panneau de contr�le de mod�ration';
$lang['Mod_CP_explain'] = 'En utilisant le formulaire ci-dessous, vous pouvez accomplir des op�rations de mod�ration de masse sur ce forum. Vous pouvez verrouiller, d�verrouiller, d�placer ou supprimer n\'importe quel nombre de sujets.';

$lang['Select'] = 'S�lectionner';
$lang['Delete'] = 'Supprimer';
$lang['Move'] = 'D�placer';
$lang['Lock'] = 'Verrouiller';
$lang['Unlock'] = 'D�verrouiller';

$lang['Topics_Removed'] = 'Le(s) sujet(s) s�lectionn�(s) a/ont �t� retir�(s) de la base de donn�es avec succ�s.';
$lang['Topics_Locked'] = 'Le(s) sujet(s) s�lectionn�(s) a/ont �t� verrouill�(s).';
$lang['Topics_Moved'] = 'Le(s) sujet(s) s�lectionn�(s) a/ont �t� d�plac�(s).';
$lang['Topics_Unlocked'] = 'Le(s) sujet(s) s�lectionn�(s) a/ont �t� d�verrouill�(s).';
$lang['No_Topics_Moved'] = 'Aucun sujet n\'a �t� d�plac�.';

$lang['Confirm_delete_topic'] = 'Etes-vous certain(e) de vouloir supprimer le(s) sujet(s) s�lectionn�(s) ?';
$lang['Confirm_lock_topic'] = 'Etes-vous certain(e) de vouloir verrouiller le(s) sujet(s) s�lectionn�(s) ?';
$lang['Confirm_unlock_topic'] = 'Etes-vous certain(e) de vouloir d�verrouiller le(s) sujet(s) s�lectionn�(s) ?';
$lang['Confirm_move_topic'] = 'Etes-vous certain(e) de vouloir d�placer le(s) sujet(s) s�lectionn�(s) ?';

$lang['Move_to_forum'] = 'D�placer vers le forum';
$lang['Leave_shadow_topic'] = 'Laisser un sujet-traceur dans l\'ancien forum.';

$lang['Split_Topic'] = 'Panneau de contr�le de la division des sujets';
$lang['Split_Topic_explain'] = 'En utilisant le formulaire ci-dessous, vous pouvez diviser un sujet en deux sujets, soit en s�lectionnant les messages individuellement, soit en divisant � partir d\'un message s�lectionn�';
$lang['Split_title'] = 'Titre du nouveau sujet';
$lang['Split_forum'] = 'Forum du nouveau sujet';
$lang['Split_posts'] = 'Diviser les messages s�lectionn�s';
$lang['Split_after'] = 'Diviser � partir des messages s�lectionn�s';
$lang['Topic_split'] = 'Le sujet s�lectionn� a �t� divis� avec succ�s';

$lang['Too_many_error'] = 'Vous avez s�lectionn� trop de messages. Vous ne pouvez s�lectionner qu\'un seul message pour diviser le sujet � partir de ce message!';

$lang['None_selected'] = 'Vous n\'avez s�lectionn� aucun sujet pour accomplir cette op�ration. Veuillez revenir en arri�re et s�lectionnez-en au moins un.';
$lang['New_forum'] = 'Nouveau forum';

$lang['This_posts_IP'] = 'Adresse IP de ce message';
$lang['Other_IP_this_user'] = 'Autres adresses IP � partir desquelles cet utilisateur a �mis';
$lang['Users_this_IP'] = 'Utilisateurs postant � partir de cette adresse IP';
$lang['IP_info'] = 'Informations sur l\'adresse IP';
$lang['Lookup_IP'] = 'Chercher l\'adresse IP';


//
// Timezones ... for display on each page
//
$lang['All_times'] = 'Toutes les heures sont au format %s'; // eg. All times are GMT - 12 Hours (times from next block)

$lang['-12'] = 'GMT - 12 Heures';
$lang['-11'] = 'GMT - 11 Heures';
$lang['-10'] = 'GMT - 10 Heures';
$lang['-9'] = 'GMT - 9 Heures';
$lang['-8'] = 'GMT - 8 Heures';
$lang['-7'] = 'GMT - 7 Heures';
$lang['-6'] = 'GMT - 6 Heures';
$lang['-5'] = 'GMT - 5 Heures';
$lang['-4'] = 'GMT - 4 Heures';
$lang['-3.5'] = 'GMT - 3,5 Heures';
$lang['-3'] = 'GMT - 3 Heures';
$lang['-2'] = 'GMT - 2 Heures';
$lang['-1'] = 'GMT - 1 Heure';
$lang['0'] = 'GMT';
$lang['1'] = 'GMT + 1 Heure';
$lang['2'] = 'GMT + 2 Heures';
$lang['3'] = 'GMT + 3 Heures';
$lang['3.5'] = 'GMT + 3,5 Heures';
$lang['4'] = 'GMT + 4 Heures';
$lang['4.5'] = 'GMT + 4,5 Heures';
$lang['5'] = 'GMT + 5 Heures';
$lang['5.5'] = 'GMT + 5,5 Heures';
$lang['6'] = 'GMT + 6 Heures';
$lang['6.5'] = 'GMT + 6.5 Heures';
$lang['7'] = 'GMT + 7 Heures';
$lang['8'] = 'GMT + 8 Heures';
$lang['9'] = 'GMT + 9 Heures';
$lang['9.5'] = 'GMT + 9,5 Heures';
$lang['10'] = 'GMT + 10 Heures';
$lang['11'] = 'GMT + 11 Heures';
$lang['12'] = 'GMT + 12 Heures';
$lang['13'] = 'GMT + 13 Heures';

// These are displayed in the timezone select box
$lang['tz']['-12'] = 'GMT - 12 Heures';
$lang['tz']['-11'] = 'GMT - 11 Heures';
$lang['tz']['-10'] = 'GMT - 10 Heures';
$lang['tz']['-9'] = 'GMT - 9 Heures';
$lang['tz']['-8'] = 'GMT - 8 Heures';
$lang['tz']['-7'] = 'GMT - 7 Heures';
$lang['tz']['-6'] = 'GMT - 6 Heures';
$lang['tz']['-5'] = 'GMT - 5 Heures';
$lang['tz']['-4'] = 'GMT - 4 Heures';
$lang['tz']['-3.5'] = 'GMT - 3:30 Heures';
$lang['tz']['-3'] = 'GMT - 3 Heures';
$lang['tz']['-2'] = 'GMT - 2 Heures';
$lang['tz']['-1'] = 'GMT - 1 Heure';
$lang['tz']['0'] = 'GMT';
$lang['tz']['1'] = 'GMT + 1 Heure';
$lang['tz']['2'] = 'GMT + 2 Heures';
$lang['tz']['3'] = 'GMT + 3 Heures';
$lang['tz']['3.5'] = 'GMT + 3:30 Heures';
$lang['tz']['4'] = 'GMT + 4 Heures';
$lang['tz']['4.5'] = 'GMT + 4:30 Heures';
$lang['tz']['5'] = 'GMT + 5 Heures';
$lang['tz']['5.5'] = 'GMT + 5:30 Heures';
$lang['tz']['6'] = 'GMT + 6 Heures';
$lang['tz']['6.5'] = 'GMT + 6:30 Heures';
$lang['tz']['7'] = 'GMT + 7 Heures';
$lang['tz']['8'] = 'GMT + 8 Heures';
$lang['tz']['9'] = 'GMT + 9 Heures';
$lang['tz']['9.5'] = 'GMT + 9:30 Heures';
$lang['tz']['10'] = 'GMT + 10 Heures';
$lang['tz']['11'] = 'GMT + 11 Heures';
$lang['tz']['12'] = 'GMT + 12 Heures';
$lang['tz']['13'] = 'GMT + 13 Heures';

$lang['datetime']['Sunday'] = 'Dimanche';
$lang['datetime']['Monday'] = 'Lundi';
$lang['datetime']['Tuesday'] = 'Mardi';
$lang['datetime']['Wednesday'] = 'Mercredi';
$lang['datetime']['Thursday'] = 'Jeudi';
$lang['datetime']['Friday'] = 'Vendredi';
$lang['datetime']['Saturday'] = 'Samedi';
$lang['datetime']['Sun'] = 'Dim';
$lang['datetime']['Mon'] = 'Lun';
$lang['datetime']['Tue'] = 'Mar';
$lang['datetime']['Wed'] = 'Mer';
$lang['datetime']['Thu'] = 'Jeu';
$lang['datetime']['Fri'] = 'Ven';
$lang['datetime']['Sat'] = 'Sam';
$lang['datetime']['January'] = 'Janvier';
$lang['datetime']['February'] = 'F�vrier';
$lang['datetime']['March'] = 'Mars';
$lang['datetime']['April'] = 'Avril';
$lang['datetime']['May'] = 'Mai';
$lang['datetime']['June'] = 'Juin';
$lang['datetime']['July'] = 'Juillet';
$lang['datetime']['August'] = 'Ao�t';
$lang['datetime']['September'] = 'Septembre';
$lang['datetime']['October'] = 'Octobre';
$lang['datetime']['November'] = 'Novembre';
$lang['datetime']['December'] = 'D�cembre';
$lang['datetime']['Jan'] = 'Jan';
$lang['datetime']['Feb'] = 'F�v';
$lang['datetime']['Mar'] = 'Mar';
$lang['datetime']['Apr'] = 'Avr';
$lang['datetime']['May'] = 'Mai';
$lang['datetime']['Jun'] = 'Juin';
$lang['datetime']['Jul'] = 'Juil';
$lang['datetime']['Aug'] = 'Ao�';
$lang['datetime']['Sep'] = 'Sep';
$lang['datetime']['Oct'] = 'Oct';
$lang['datetime']['Nov'] = 'Nov';
$lang['datetime']['Dec'] = 'D�c';

//
// Errors (not related to a
// specific failure on a page)
//
$lang['Information'] = 'Informations';
$lang['Critical_Information'] = 'Informations critiques';

$lang['General_Error'] = 'Erreur g�n�rale';
$lang['Critical_Error'] = 'Erreur critique';
$lang['An_error_occured'] = 'Une erreur est survenue';
$lang['A_critical_error'] = 'Une erreur critique est survenue';

$lang['Admin_reauthenticate'] = 'Pour administrer le forum, vous devez vous authentifier de nouveau.';
$lang['Login_attempts_exceeded'] = 'Le nombre maximum de %s tentatives de connexions autoris�es a �t� d�pass�. Vous n\'�tes pas autoris� � vous connecter durant les %s prochaines minutes.';
$lang['Please_remove_install'] = 'Veuillez vous assurer que le dossier <em>/install/</em> est bien supprim�';
$lang['Session_invalid'] = 'Session invalide. Veuillez soumettre de nouveau le formulaire.';

//
// That's all, Folks!
// -------------------------------------------------

?>
