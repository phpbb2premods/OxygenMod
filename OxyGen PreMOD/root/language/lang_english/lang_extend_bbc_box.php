<?php
/***************************************************************************
 * lang_bbc_box.php [English]
 * --------------------------
 * begin	: Wednesday, June 08, 2005
 * copyright	: reddog - http://www.reddevboard.com/
 * version	: 1.0.8 - 09/10/2005
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

//
// bbc box settings (acp)
//

//main
$lang['bbc_settings_title'] = 'BBcode Box Reloaded - Configuration';
$lang['bbc_settings_explain'] = 'Using this form you can renew bbcode data cache and modify the options.';
$lang['bbc_settings_adjust'] = 'Adjustements';
$lang['bbc_settings_cache'] = 'Cache';

// regen
$lang['bbc_box_cache'] = 'BBcode table cache';
$lang['bbc_last_regen'] = 'Data last regeneration';
$lang['bbc_today_at'] = 'today at %s';
$lang['bbc_yesterday_at'] = 'yesterday at %s';

// bbc per row
$lang['bbc_per_row'] = 'Number of bbcode per row';
$lang['bbc_per_row_explain'] = 'Set here the number of buttons displayed per row in the posting display';

// mode selection (beginner or advanced)
$lang['bbc_mode_select'] = 'Select the mode';
$lang['bbc_mode_select_explain'] = 'You have the choice between the <span style="color:darkred"><strong>advanced</strong></span> mode which offers additional adjustments and the <span style="color:green"><strong>beginner</strong></span> mode, ideal not to make errors.';
$lang['bbc_advanced'] = '<span style="color:darkred"><strong>advanced</strong></span>';
$lang['bbc_beginner'] = '<span style="color:green"><strong>beginner</strong></span>';

// switch on/off (buttons)
$lang['bbc_switch_select'] = 'Show bbcode buttons in the posting display';
$lang['bbc_switch_select_explain'] = 'If this option is disabled, basic bbcode buttons will be showed in the posting display. However, to really disable bbcode tags, use the menu listing the buttons.';

// skin selection
$lang['Select_skin'] = 'Select skin';
$lang['Skin_preview'] = 'Preview';

// actions
$lang['bbc_regen'] = 'Regenerate the cache';
$lang['bbc_settings_updated'] = 'The bbcode setup has been updated.';
$lang['bbc_cache_updated'] = 'BBcode table cache succeed.';
$lang['bbc_click_return'] = 'Click %sHere%s to return to the previous page.';
$lang['bbc_click_return_settings'] = 'Click %sHere%s to return to the bbcode settings.';

//
// bbc box manage (acp)
//

//main
$lang['bbc_manage_title'] = 'BBcode Box Reloaded - BBcode Manage';
$lang['bbc_manage_explain'] = 'Using this form you can add, edit, view and delete bbcode. Each bbcode requires some lines in <span style="color:darkred"><em>bbcode.php</em></span> (and sometimes in <span style="color:darkred"><em>bbcode.tpl</em></span>), as well as a key <span style="color:darkblue">$lang[\'bbcbxr_help\'][\'helpline\']</span> and a key <span style="color:darkblue">$lang[\'bbcbxr_desc\'][\'helpline\']</span> in <span style="color:darkred"><em>lang_bbc_box.php</em></span> (where the var helpline corresponds to its value).';
$lang['bbc_edit_title'] = 'BBcode Box Reloaded - BBcode %s Edition';
$lang['bbc_edit_explain'] = 'Using this form you can modify the fields of the selected bbcode. <span style="color:darkred"><strong>ATTENTION!</strong></span> A field is composed only of <span style="color:green"><strong>one word (or one letter)</strong></span>, any <span style="color:darkred"><strong>special characters</strong></span>, a <span style="color:darkred"><strong>space</strong></span> or <span style="color:darkred"><strong>capital letters</strong></span> are not accepted.';
$lang['bbc_edit_rules'] = '<strong>Fields open and close tag:</strong> <span style="color:darkred"><strong>you should not modify</strong></span> the vars placed before (example: width, height) and after (example: down, left, right) a character =, those are defined in <span style="color:darkred"><em>bbcode.php</em></span>';
$lang['bbc_add_title'] = 'BBcode Box Reloaded - Add a new bbcode';
$lang['bbc_add_explain'] = 'Using this form you can define the new bbcode fields. <span style="color:darkred"><strong>ATTENTION!</strong></span> A field is composed only of <span style="color:green"><strong>one word (or one letter)</strong></span>, any <span style="color:darkred"><strong>special characters</strong></span>, a <span style="color:darkred"><strong>space</strong></span> or <span style="color:darkred"><strong>capital letters</strong></span> are not accepted. An image must be present in the directory planned for that (by default: <em>templates/bbc_box/styles/default/</em>).';
$lang['bbc_add_rules'] = 'The first field is <span style="color:darkred"><strong>important</strong></span>, it\'s used to manage the bbcode in <span style="color:darkred"><em>bbcode.php</em></span>. Vars can be added in the tag fields if those are defined in the same file (example: <em>tag=</em><strong>center</strong> or <em>tag</em> <strong>width</strong><em>=100</em>). Add a new bbcode from this form is not enough, each bbcode requires some lines in <span style="color:darkred"><em>bbcode.php</em></span> (and sometimes in <span style="color:darkred"><em>bbcode.tpl</em></span>).';

// fields
$lang['bbc_name'] = 'bbcode';
$lang['bbc_name_explain'] = '<span style="color:darkred"><strong>important</strong></span> variable used as name for the bbcode, without space nor special characters.';
$lang['bbc_img_display'] = 'button';
$lang['bbc_before'] = 'open tag';
$lang['bbc_before_explain'] = 'variable used as open tag, without the hooks.';
$lang['bbc_before_edit_explain'] = 'What will give [%s] as open tag in a message.';
$lang['bbc_after'] = 'close tag';
$lang['bbc_after_explain'] = 'variable used as close tag, without the hooks.';
$lang['bbc_after_edit_explain'] = 'What will give [%s] as close tag in a message.';
$lang['bbc_helpline'] = 'helpline';
$lang['bbc_helpline_explain'] = 'variable used for the helpline when the mouse passes on a button bbcode, without space nor special characters.';
$lang['bbc_img'] = 'image';
$lang['bbc_img_explain'] = 'variable used for the keys $images[].';
$lang['bbc_divider'] = 'spacing';
$lang['bbc_divider_explain'] = 'to add or not a spacing after this button bbcode.';

// actions
$lang['Edit'] = 'Edit';
$lang['Delete'] = 'Delete';
$lang['bbc_move_after'] = 'Move this bbcode after';
$lang['bbc_top'] = '___Top___';
$lang['Add_new_bbc'] = 'Add a new bbcode';
$lang['bbc_must_select'] = 'You must select a bbcode';
$lang['bbc_must_fill'] = 'You must fill all fields';
$lang['bbc_updated'] = 'The bbcode was successfully updated';
$lang['bbc_added'] = 'The bbcode was successfully added';
$lang['bbc_removed'] = 'The bbcode was successfully removed';
$lang['bbc_click_return_manage'] = 'Click %sHere%s to return to bbcode manage';

//
// bbc box list (acp)
//

// main
$lang['bbc_box_title'] = 'BBcode Box Reloaded';
$lang['bbc_box_explain'] = 'Here you can enable, disabled the bbcode buttons used on the board ; and manage the auth levels of each one of them.';
$lang['bbc_box_list'] = 'BBcode buttons list';

// actions
$lang['Enable_all'] = 'Enable all';
$lang['Disable_all'] = 'Disable all';
$lang['Button_switch'] = 'Enable or disable the selected button';
$lang['bbc_act_mode'] = 'Enable/Disable Mode';
$lang['bbc_perms_mode'] = 'Auth Levels Mode';
$lang['bbc_go_to'] = 'go to %s';
$lang['bbc_box_updated'] = 'The bbcode buttons setup has been updated';
$lang['bbc_box_return'] = 'Click %sHere%s to return to the bbcode buttons administration';

//
// bbc box (board)
//

// main
$lang['Font_size'] = 'Font size';
$lang['Font_type'] = 'Font type';
$lang['Font_color'] = 'Font colour';
$lang['Type_default'] = 'Default';
$lang['Close_Tags'] = 'Close Tags';
$lang['Styles_tip'] = 'Tip: Styles can be applied quickly to selected text.';

// generic help
$lang['bbcbxr_e_help'] = 'List: add a list element';
$lang['bbcode_a_help'] = 'Close all open bbCode tags';
$lang['bbcode_s_help'] = 'Font color: [color=red]text[/color]  Tip: you can also use color=#FF0000';
$lang['bbcode_f_help'] = 'Font size: [size=x-small]small text[/size]';
$lang['bbcbxr_t_help'] = 'Font type: [font=Verdana]text[/font]';
$lang['bbcbxr_bs_help'] = 'Background color: [bcolor=red]texte[/bcolor] Tip: you can also use color=#FF0000';

// default
$lang['bbcbxr_help']['bold'] = 'Bold text: [b]text[/b]';
$lang['bbcbxr_help']['italic'] = 'Italic text: [i]text[/i]';
$lang['bbcbxr_help']['underline'] = 'Underline text: [u]text[/u]';
$lang['bbcbxr_help']['quote'] = 'Quote text: [quote]text[/quote]';
$lang['bbcbxr_help']['code'] = 'Code display: [code]code[/code]';
$lang['bbcbxr_help']['ulist'] = 'List: [list]text[/list]';
$lang['bbcbxr_help']['olist'] = 'Ordered list: [list=]text[/list]';
$lang['bbcbxr_help']['picture'] = 'Insert image: [img]http://image_url[/img]';
$lang['bbcbxr_help']['www'] = 'Insert URL: [url]http://url[/url] or [url=http://url]URL text[/url]';

// bbcode box
$lang['bbcbxr_help']['strike'] = 'Strike text: [%s]text[/%s]';
$lang['bbcbxr_help']['spoiler'] = 'Spoiler: [%s]text[/%s]';
$lang['bbcbxr_help']['fade'] = 'Fade: [%s]text[/%s] or with [img]http://image_url/[/img]';
$lang['bbcbxr_help']['rainbow'] = 'Insert gradient text: [%s]texte[/%s]';
$lang['bbcbxr_help']['justify'] = 'Justify text: [%s]text[/%s]';
$lang['bbcbxr_help']['right'] = 'Set text align to right: [%s]text[/%s]';
$lang['bbcbxr_help']['center'] = 'Set text align to center: [%s]text[/%s]';
$lang['bbcbxr_help']['left'] = 'Set text align to left: [%s]text[/%s]';
$lang['bbcbxr_help']['link'] = 'Insert anchor link: [%starget_name]text[/%s]';
$lang['bbcbxr_help']['target'] = 'Insert anchor target: [%starget_name]text[/%s]';
$lang['bbcbxr_help']['marqd'] = 'Marque text to down: [%s]text[/%s]';
$lang['bbcbxr_help']['marqu'] = 'Marque text to up: [%s]text[/%s]';
$lang['bbcbxr_help']['marql'] = 'Marque text to Left: [%s]text[/%s]';
$lang['bbcbxr_help']['marqr'] = 'Marque text to Right: [%s]text[/%s]';
$lang['bbcbxr_help']['email'] = 'Insert Email: [%s]Email Here[/%s]';
$lang['bbcbxr_help']['flash'] = 'Insert flash file: [%s]flash URL[/%s]';
$lang['bbcbxr_help']['video'] = 'Insert video file: [%s]file URL[/%s]';
$lang['bbcbxr_help']['stream'] = 'Insert stream file: [%s]File URL[/%s]';
$lang['bbcbxr_help']['real'] = 'Insert Real Media file: [%s]File URL[/%s]';
$lang['bbcbxr_help']['quick'] = 'Quicktime video: [%s]http://quicktime_video_url/[/%s]';
$lang['bbcbxr_help']['sup'] = 'Superscript: [%s]text[/%s]';
$lang['bbcbxr_help']['sub'] = 'Subscript: [%s]text[/%s]';
// undefined
$lang['bbcbxr_help_none'] = 'BBcode use: [%s]text[/%s]';

// font size
$lang['font_tiny'] = 'Tiny';
$lang['font_small'] = 'Small';
$lang['font_normal'] = 'Normal';
$lang['font_large'] = 'Large';
$lang['font_huge'] = 'Huge';

// font type
$lang['type_arial'] = 'Arial';
$lang['type_comicsansms'] = 'Comic Sans MS';
$lang['type_couriernew'] = 'Courier New';
$lang['type_georgia'] = 'Georgia';
$lang['type_lucidaconsole'] = 'Lucida Console';
$lang['type_microsoft'] = 'Microsoft Sans Serif';
$lang['type_tahoma'] = 'Tahoma';
$lang['type_timesnewroman'] = 'Times New Roman';
$lang['type_trebuchet'] = 'Trebuchet MS';
$lang['type_verdana'] = 'Verdana';

// tools bar
$lang['bbcbxr_swc_help'] = 'Switch font color mode to background color mode';
$lang['bbcbxr_hr_help'] = 'Insert Horizontal Rule';
$lang['bbcbxr_chr_help'] = 'Insert custom character';

// charmap popup
$lang['charmap_page'] = 'Custom characters';
$lang['charmap_title'] = 'Select a custom character';

// description
$lang['bbcbxr_desc']['strike'] = 'Strike text';
$lang['bbcbxr_desc']['spoiler'] = 'Spoiler';
$lang['bbcbxr_desc']['fade'] = 'Fade';
$lang['bbcbxr_desc']['rainbow'] = 'Gradient text';
$lang['bbcbxr_desc']['justify'] = 'Justify text';
$lang['bbcbxr_desc']['right'] = 'Text align to right';
$lang['bbcbxr_desc']['center'] = 'Text align to center';
$lang['bbcbxr_desc']['left'] = 'Text align to left';
$lang['bbcbxr_desc']['link'] = 'Anchor link';
$lang['bbcbxr_desc']['target'] = 'Anchor target';
$lang['bbcbxr_desc']['marqd'] = 'Marque text to down';
$lang['bbcbxr_desc']['marqu'] = 'Marque text to up';
$lang['bbcbxr_desc']['marql'] = 'Marque text to Left';
$lang['bbcbxr_desc']['marqr'] = 'Marque text to Right';
$lang['bbcbxr_desc']['email'] = 'Email';
$lang['bbcbxr_desc']['flash'] = 'Flash file';
$lang['bbcbxr_desc']['video'] = 'Video file';
$lang['bbcbxr_desc']['stream'] = 'Stream file';
$lang['bbcbxr_desc']['real'] = 'Real Media file';
$lang['bbcbxr_desc']['quick'] = 'Quicktime video';
$lang['bbcbxr_desc']['sup'] = 'Superscript';
$lang['bbcbxr_desc']['sub'] = 'Subscript';

// addons
// add keys $lang[] from addons below this line

// thumbnail
$lang['bbcbxr_help']['tmb'] = 'Insert a thumbnail: [tmb]http://image_url[/tmb]';
$lang['bbcbxr_desc']['tmb'] = 'Thumbnail';

//-- mod : php bbcode box reloaded ---------------------------------------------
//-- add
$lang['bbcbxr_help']['php'] = 'Insert PHP Code: [php]code[/php]';
//-- fin mod : php bbcode box reloaded -----------------------------------------

// YouTube
$lang['bbcbxr_help']['youtube'] = 'YouTube: [youtube]YouTube URL[/youtube]';
$lang['bbcbxr_desc']['youtube'] = 'YouTube';

//
// That's all Folks!
// -------------------------------------------------

?>
