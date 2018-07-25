<?php 
/*************************************************************************** 
* 						lang_jail.php [English] 
* 							------------------- 
*
* 						Translation : seteo-bloke & phpika
* 					Forums : http://www.thegamingforum.com/ & http://www.srg.valcato.net/pikachu
* 
****************************************************************************/ 

$lang['Cell'] = 'Jail';
$lang['Cell_admin_title'] = 'Jail';
$lang['Cell_admin_title_explain'] = 'Here you can imprison or free your users, and define their prison sentence or the amount of the pledge';
$lang['Cell_admin_select_user'] = 'Select a user to imprison';
$lang['Cell_admin_select'] = 'Imprison this user';
$lang['Cell_admin_time'] = 'Prison sentence';
$lang['Cell_admin_time_explain'] = 'Theses values represent the time during which the user will not be authorised access the forums';
$lang['Cell_admin_caution'] = 'Pledge amount';
$lang['Cell_admin_caution_explain'] = 'This is the amount of points the user has to pay to be freed. Set to 0 if you do not want to use this feature or if you do not use a point system on your forums';
$lang['Cell_admin_celled_ok'] = 'The selected user has been successfully imprisoned';
$lang['Cell_admin_uncelled_ok'] = 'The selected users have been successfully released';
$lang['Cell_admin_general_return'] = '<br /><br /> Click <a href="' . append_sid('admin_cell.'.$phpEx) . '">here</a> to return to the jail managament<br /><br />Click <a href="' . append_sid('index.'.$phpEx . '?pane=right') . '">here</a> to return to the administration index';
$lang['Cell_admin_celled_users'] = 'Imprisoned users';
$lang['Cell_admin_celled_name'] = 'Name';
$lang['Cell_admin_celled_caution'] = 'Pledge';
$lang['Cell_admin_celled_time'] = 'Remaining time';
$lang['Cell_admin_celled_free'] = 'Free';
$lang['Cell_admin_manual_update'] = 'Update the prison sentences';
$lang['Cell_admin_manual_update_explain'] = 'The update of the sentences is made while imprisoned users are connected to your forums. If a user has not come to your forums in a while, the values you see may be incorrect. Click on this button to correct this problem.';
$lang['Cell_admin_celled_manual_update_ok'] = 'Update of the prison sentences made successfully. The following users have been freed:<br />';
$lang['Cell_sentence_example'] = 'You have been imprisoned because of offensive language';
$lang['Cell_sentence'] = 'Sentence';
$lang['Cell_sentence_explain'] = 'This text will explain the detention reason to the user';

$lang['Cell_title'] = 'Detention';
$lang['Cell_explain'] = 'A site admin has been decided to imprison you. This will last';
$lang['Cell_time_explain'] = 'Until this time, you will not be able to access these forums';
$lang['Cell_day'] = 'Day';
$lang['Cell_hour'] = 'Hour';
$lang['Cell_minute'] = 'Minute';
$lang['Cell_days'] = 'Days';
$lang['Cell_hours'] = 'Hours';
$lang['Cell_minutes'] = 'Minutes';
$lang['Cell_caution'] = 'It is possible for you to be released from prison by paying a pledge to the sum of ';
$lang['Cell_caution_pay'] = 'Pay the pledge';
$lang['Cell_free'] = 'You have now been released from prison. Be careful not to return to it. <br /><br />Click <a href="' . append_sid('admin_cell.'.$phpEx) . '">here</a> to go the forums index';

// Language keys added or modified for 0.1.0
$lang['Cell_celled_time'] = 'Imprisonment duration';
$lang['Cell_judge_user'] = 'Judge this user';
$lang['Cell_judgement'] = 'Judgement';
$lang['Cell_freeable'] = 'Can be freed';
$lang['Cell_freeable_explain'] = 'If you check this option, the others users will be able to judge this user'; 
$lang['Cell_cautionnable'] = 'Pledge can be paid';
$lang['Cell_cautionnable_explain'] = 'If you check this option, others users will be able to pay the pledge for this user';
$lang['Cell_admin_celled_users_explain'] = 'You can edit the imprisoned users by clicking on their name';
$lang['Cell_admin_celled_edited_ok'] = 'This user has been edited successfully';
$lang['Cell_selected_celled'] = 'Selected user:';
$lang['Cell_judgement_none'] = 'No users are actually imprisoned';
$lang['Cell_celled_list'] = 'See the imprisonment history';
$lang['Cell_celled_date'] = 'Imprisonment date';
$lang['Cell_freed_type'] = 'Freed by';
$lang['Cell_judgement_never'] = 'No users have been imprisonned yet';
$lang['Cell_freed_type_still'] = 'This user is still imprisonned';
$lang['Cell_freed_type_time'] = 'End of the detention period';
$lang['Cell_freed_type_admin'] = 'Courthouse';
$lang['Cell_celled_list_history'] = 'Imprisonment history';
$lang['Cell_imprisonments'] = 'Total imprisonment';
$lang['Cell_admin_celled_blank'] = 'Clear this users imprisonment history';
$lang['Cell_admin_celled_blank_explain'] = 'If you check this option, this users imprisonment history will be deleted';
$lang['Cell_admin_update_error'] = 'Error during the update of the jail setting';
$lang['Cell_updated_return_settings'] = 'The jail settings have been edited successfully. <br /><br />Click %shere%s to return to the jail management'; 
$lang['Cell_settings_explain'] = 'Here you can edit the general settings of the jail system';
$lang['Cell_settings_bars'] = 'Display the avatar of imprisoned users behind cell bars';
$lang['Cell_settings_celleds'] = 'Display the total imprisonment number for this user on topics and in their profile';
$lang['Cell_settings_caution'] = 'Allow users to pay the pledge for other users';
$lang['Cell_settings_judge'] = 'Allow users to judge other users';
$lang['Cell_settings_blank'] = 'Allow users to clear their police record';
$lang['Cell_settings_blank_sum'] = 'Sum to pay to clear the individuals police record';
$lang['Cell_judgement'] = 'Judgement';
$lang['Cell_judgement_pay_sledge'] = 'Pay the pledge';
$lang['Cell_lack_money'] = 'You don\'t have enough points to perform this action';
$lang['Cell_sledge_paid'] = 'This user\'s pledge has been successfully paid';
$lang['Cell_return'] = 'Click %shere%s to return to the courthouse';
$lang['Cell_settings_voters'] = 'Minimum number of votes in order to validate the judgement'; 
$lang['Cell_settings_posts'] = 'Minimum number of posts the users must have to be authorised to vote';
$lang['Cell_caution_not_authed'] = 'This user can\'t be freed by paying a pledge';
$lang['Cell_judgement_ever'] = 'You have already judged this user';
$lang['Cell_judgement_explain'] = 'Which is your judgement?';
$lang['Cell_judgement_guilty'] = 'Guilty';
$lang['Cell_judgement_innocent'] = 'Innocent';
$lang['Cell_judgement_not_authed'] = 'You are not authorised to judge this user';
$lang['Cell_judgement_done'] = 'Your judgement has been registered successfully';
$lang['Cell_blank_text'] = 'You can clear your police record if you pay the sum of %s';
$lang['Cell_blank_explain'] = 'Clear your police record';
$lang['Cell_blank_done'] = 'Your police record have been cleared successfully';
$lang['Cell_judgement_ever_authed'] = 'This user has been judged guilty';

// Language keys added or modified for 0.2.0
$lang['Cell_default_points_name'] = 'Points';
$lang['Cell_admin_punishment'] = 'Select the actions forbidden for the user :';
$lang['Cell_admin_punishment_global'] = 'All';
$lang['Cell_admin_punishment_posts'] = 'Post new messages';
$lang['Cell_admin_punishment_read'] = 'Post and read messages';
$lang['Cell_punishment'] = 'Punishment';
$lang['Cell_punishment_global'] = 'Banned';
$lang['Cell_punishment_posts'] = 'Can\'t post new messages';
$lang['Cell_punishment_read'] = 'Can\'t read or post messages';
$lang['Cell_time_explain_posts'] = 'Until this time, you are not allowed to post new messages';
$lang['Cell_time_explain_read'] = 'Until this time, you are not allowed to read or post messages';

?>
