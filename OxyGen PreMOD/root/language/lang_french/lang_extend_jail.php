<?php 
/*************************************************************************** 
* 						lang_jail.php [French] 
* 							------------------- 
*
* 						Translation : 
* 					Forums : 
* 
****************************************************************************/ 

$lang['Cell'] = 'Prison';
$lang['Cell_admin_title'] = 'Prison';
$lang['Cell_admin_title_explain'] = 'Ici vous pouvez emprisonner ou lib�rer des membress , et d�finir le temps de leur peine et le montant de leur caution';
$lang['Cell_admin_select_user'] = 'S�lectionnez un membre � emprisonner';
$lang['Cell_admin_select'] = 'Emprisonner cet membre';
$lang['Cell_admin_time'] = 'Dur�e d\'emprisonnement';
$lang['Cell_admin_time_explain'] = 'Ceci repr�sente le temps durant lequel le membre n\'aura plus acc�s � votre forum';
$lang['Cell_admin_caution'] = 'Montant de la caution';
$lang['Cell_admin_caution_explain'] = 'Somme que le membre devra payer pour sa lib�ration . Laissez cette valeur nulle si vous n\'utilisez pas de mod de syst�me de points ou si vous ne d�sirez pas fixer une caution';
$lang['Cell_admin_celled_ok'] = 'Le membre s�lectionn� a �t� emprisonn� avec succ�s';
$lang['Cell_admin_uncelled_ok'] = 'Les membress s�lectionn�s ont �t� lib�r�s avec succ�s';
$lang['Cell_admin_general_return'] = '<br /><br /> Cliquez <a href="' . append_sid('admin_cell.'.$phpEx) . '">ici</a> pour retourner � la gestion de la prison<br /><br />Cliquez <a href="' . append_sid('index.'.$phpEx . '?pane=right') . '">ici</a> pour retourner � l\'index d\'administration';
$lang['Cell_admin_celled_users'] = 'Membres emprisonn�s';
$lang['Cell_admin_celled_name'] = 'Nom';
$lang['Cell_admin_celled_caution'] = 'Caution';
$lang['Cell_admin_celled_time'] = 'Temps restant';
$lang['Cell_admin_celled_free'] = 'Lib�rer';
$lang['Cell_admin_manual_update'] = 'Mettre � jour le temps d\'emprisonnement restant';
$lang['Cell_admin_manual_update_explain'] = 'La mise � jour du temps d\'emprisonnement restant se fait lorsque le membre emprisonn� se connecte sur le forum . En cons�quence , les dur�es de peine restantes que vous voyez peuvent ne pas �tre � jour si le membre ne s\'est pas connect� depuis quelque temps . Cliquez sur le bouton ci-dessous pour corriger cela .';
$lang['Cell_admin_celled_manual_update_ok'] = 'Mise � jour manuelle des temps d\'emprisonnement effectu�e avec succ�s . Les membres suivants ont �t� lib�r�s :<br />';
$lang['Cell_sentence_example'] = 'Vous avez �t� emprisonn� pour non respect du r�glement';
$lang['Cell_sentence'] = 'Sentence';
$lang['Cell_sentence_explain'] = 'Ce texte expliquera au membre emprisonn� la raison de sa d�tention';
$lang['Cell_title'] = 'Emprisonnement';
$lang['Cell_explain'] = 'Un des administrateurs du forum a d�cid� de vous emprisonner durant';
$lang['Cell_time_explain'] = 'Durant cette p�riode vous ne pouvez plus acc�der au forum';
$lang['Cell_day'] = 'Jour';
$lang['Cell_hour'] = 'Heure';
$lang['Cell_minute'] = 'Minute';
$lang['Cell_days'] = 'Jours';
$lang['Cell_hours'] = 'Heures';
$lang['Cell_minutes'] = 'Minutes';
$lang['Cell_caution'] = 'Il vous est possible de sortir de prison en payant une caution d\'un montant de ';
$lang['Cell_caution_pay'] = 'Payer la caution';
$lang['Cell_free'] = 'Vous �tes maintenant lib�r� de prison . Veillez � ne pas y retourner . <br /><br />Cliquez <a href="' . append_sid('admin_cell.'.$phpEx) . '">ici</a> pour aller sur l\'index du forum';

// Language keys added or modified for 0.1.0
$lang['Cell_celled_time'] = 'Dur�e de la peine';
$lang['Cell_judge_user'] = 'Juger ce membre';
$lang['Cell_judgement'] = 'Jugement';
$lang['Cell_freeable'] = 'Peut �tre lib�r�';
$lang['Cell_freeable_explain'] = 'Si vous cochez cette option , les autres membres pourront juger ce membre'; 
$lang['Cell_cautionnable'] = 'Possiblit� de payer la caution par un tiers';
$lang['Cell_cautionnable_explain'] = 'Si vous cochez cette option , les autres membres pourront payer la caution de ceux emprisonn�s';
$lang['Cell_admin_celled_users_explain'] = 'Vous pouvez �diter les membres emprisonn�s en cliquant sur leur nom';
$lang['Cell_admin_celled_edited_ok'] = 'Ce membre a �t� �dit� avec succ�s';
$lang['Cell_selected_celled'] = 'Membre s�lectionn� :';
$lang['Cell_judgement_none'] = 'Aucun membre n\'est actuellement en prison';
$lang['Cell_celled_list'] = 'Voir l\'historique des emprisonnements';
$lang['Cell_celled_date'] = 'Date de la sentence';
$lang['Cell_freed_type'] = 'Lib�r� par';
$lang['Cell_judgement_never'] = 'Aucun membre n\'a �t� emprisonn� � ce jour';
$lang['Cell_freed_type_still'] = 'Ce membre est toujours en prison';
$lang['Cell_freed_type_time'] = 'Ech�ance de la peine';
$lang['Cell_freed_type_admin'] = 'Jugement du tribunal';
$lang['Cell_celled_list_history'] = 'Historique';
$lang['Cell_imprisonments'] = 'Nombre d\'emprisonements';
$lang['Cell_admin_celled_blank'] = 'Effacer l\'historique de ce membre';
$lang['Cell_admin_celled_blank_explain'] = 'Si vous cochez cette option , l\'historique des emprisonnements de ce membre sera effac�e';
$lang['Cell_admin_update_error'] = 'Erreut durant la mise � jour de la configuration g�n�rale de la prison';
$lang['Cell_updated_return_settings'] = 'La configuration g�n�rale de la prison a �t� mise � jour avec succ�s . <br /><br />Cliquez %sici%s pour retourner � la gestion de la prison'; 
$lang['Cell_settings_explain'] = 'Ici vous pouvez �diter les options g�n�rales du syst�me de prison.';
$lang['Cell_settings_bars'] = 'Afficher l\'avatar des membres emprisonn�s derri�re des barreaux de prison';
$lang['Cell_settings_celleds'] = 'Afficher le nombre total d\'emprisonnements dans les messages et le profil des membres';
$lang['Cell_settings_caution'] = 'Autoriser les membres � payer les cautions des autres';
$lang['Cell_settings_judge'] = 'Autoriser les membres � juger les prisonniers';
$lang['Cell_settings_blank'] = 'Autoriser les membres � payer pour vider leur casier judiciaire';
$lang['Cell_settings_blank_sum'] = 'Montant � payer pour vider son casier judicaire';
$lang['Cell_judgement'] = 'Jugement';
$lang['Cell_judgement_pay_sledge'] = 'Payer la caution';
$lang['Cell_lack_money'] = 'Vous n\'avez pas assez de points pour effectuer cette action';
$lang['Cell_sledge_paid'] = 'La caution de ce membre a �t� pay�e avec succ�s';
$lang['Cell_return'] = 'Cliquez %sici%s pour retourner au tribunal';
$lang['Cell_settings_voters'] = 'Nombre minimal de votes pour qu\'un jugement soit valid�'; 
$lang['Cell_settings_posts'] = 'Nombre minimal de messages qu\'un membre doit avoir post� pour avoir le droit de voter';
$lang['Cell_caution_not_authed'] = 'Ce membre ne peut pas �tre lib�r� par le paiement d\'une caution';
$lang['Cell_judgement_ever'] = 'Vous avez d�j� jug� ce membre';
$lang['Cell_judgement_explain'] = 'Quel est votre verdict ?';
$lang['Cell_judgement_guilty'] = 'Coupable';
$lang['Cell_judgement_innocent'] = 'Innocent';
$lang['Cell_judgement_not_authed'] = 'Vous n\'�tes pas autoris� � juger ce membre';
$lang['Cell_judgement_done'] = 'Votre verdict a �t� enregistr� avec succ�s';
$lang['Cell_blank_text'] = 'Vous pouvez effacer votre casier judiciaire si vous payez la somme de %s';
$lang['Cell_blank_explain'] = 'Effacer le casier judiciaire';
$lang['Cell_blank_done'] = 'Votre casier judiciaire est maintenant vierge';
$lang['Cell_judgement_ever_authed'] = 'Ce membre a �t� reconnu coupable par le tribunal';

// Language keys added or modified for 0.2.0
$lang['Cell_default_points_name'] = 'Points';
$lang['Cell_admin_punishment'] = 'Selectionnez les actions interdites pour ce membre :';
$lang['Cell_admin_punishment_global'] = 'Toutes';
$lang['Cell_admin_punishment_posts'] = 'Poster de nouveaux messages';
$lang['Cell_admin_punishment_read'] = 'Poster et lire des messages';
$lang['Cell_punishment'] = 'Punition';
$lang['Cell_punishment_global'] = 'Banni';
$lang['Cell_punishment_posts'] = 'Ne peut plus poster de messages';
$lang['Cell_punishment_read'] = 'Ne peut plus lire ou poster de messages';
$lang['Cell_time_explain_posts'] = 'Durant cette p�riode vous n\'�tes pas autoris� � poster de nouveaux messages';
$lang['Cell_time_explain_read'] = 'Durant cette p�riode vous n\'�tes pas autoris� � poster ou lire des messages';

?>
