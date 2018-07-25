<script language="JavaScript" type="text/javascript">
<!--//
function _dom_menu()
{
	return this;
}
	_dom_menu.prototype.objref = function(id)
	{
		return document.getElementById ? document.getElementById(id) : (document.all ? document.all[id] : (document.layers ? document.layers[id] : null));
	}
	_dom_menu.prototype.cancel_event = function()
	{
		if ( window.event )
		{
			window.event.cancelBubble = true;
		}
	}

	_dom_menu.prototype.set = function(menu) {
		var menus = new Array(
			'reginfo',
			'profileinfo',
			'avatarinfo',
			'signatureinfo',
			'qpesinfo',
			'prefinfo'
		);
		var object;
		var opt;
		var flag;
		for (i=0; i < menus.length; i++)
		{
			cur_menu = menus[i];
			object = this.objref(cur_menu);
			if ( object && object.style )
			{
				object.style.display = (cur_menu == menu) ? '' : 'none';
			}
			opt = this.objref(cur_menu + '_opt');
			if ( opt && opt.style )
			{
				opt.style.fontWeight = (cur_menu == menu) ? 'bold' : '';
			}
			flag = this.objref(cur_menu + '_flag');
			if ( flag && flag.style )
			{
				flag.style.fontWeight = (cur_menu == menu) ? 'bold' : '';
				flag.className = (cur_menu == menu) ? 'row1 gensmall' : 'row2 gensmall';
			}
		}
		this.cancel_event();
	}

// instantiate
dom_menu = new _dom_menu();
//-->
</script>

<h1>{L_HIDE_ENTRIES_CONFIGURATION_TITLE}</h1>

<p>{L_HIDE_ENTRIES_CONFIGURATION_EXPLAIN}</p>


<form action="{S_CONFIG_ACTION}" method="post">
<table cellpadding="0" cellspacing="2" border="0" width="100%"><tr><td width="200" valign="top">

<table cellpadding="4" cellspacing="1" border="0" class="forumline" width="200">

<tr>
  <th class="thHead" colspan="2">{L_HIDE_ENTRIES_CONFIGURATION_TITLE}</th>
</tr>
	<tr>
		<td id="reginfo_flag" class="row1 gensmall" align="right" width="10">&raquo;</td>
		<td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('reginfo'); return false;"><div id="reginfo_opt" class="gensmall" {STYLE_FONT_ACTIF_REG}><a href="#" onclick="dom_menu.set('reginfo'); return false;">{L_REGISTRATION_INFO}</a></div></td>
	</tr>
	<tr>
		<td id="profileinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
		<td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('profileinfo'); return false;"><div id="profileinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('profileinfo'); return false;">{L_PROFILE_INFO}</a></div></td>
	</tr>
	<tr>
		<td id="avatarinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
		<td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('avatarinfo'); return false;"><div id="avatarinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('avatarinfo'); return false;">{L_AVATAR_PANEL}</a></div></td>
	</tr>
	<tr>
		<td id="signatureinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
		<td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('signatureinfo'); return false;"><div id="signatureinfo_opt" class="gensmall" {STYLE_FONT_ACTIF_SIG}><a href="#" onclick="dom_menu.set('signatureinfo'); return false;">{L_SIGNATURE}</a></div></td>
	</tr>
	<tr>
		<td id="qpesinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
		<td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('qpesinfo'); return false;"><div id="qpesinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('qpesinfo'); return false;">{L_QP_SETTINGS}</a></div></td>
	</tr>
	<tr>
		<td id="prefinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
		<td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('prefinfo'); return false;"><div id="prefinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('prefinfo'); return false;">{L_PREFERENCES}</a></div></td>
	</tr>
</table>

</td><td valign="top" width="100%">

<table id="reginfo" class="forumline" border="0" cellpadding="4" cellspacing="1" width="100%">
	<tr>
		<th class="thHead" colspan="2">{L_REGISTRATION_INFO}</th>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_NAME_CHANGE}</td>
		<td class="row2" colspan="1" rowspan="4" align="center" width="45%">
		{L_ACCOUNT_INFORMATIONS}
		</td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_MAIL_CHANGE}</td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_PASSWORD_CHANGE}</td>
	</tr>
	<tr>
		<td class="row1">{L_ACCOUNT_DELETE}</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center"><input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>

</table><table id="profileinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_PROFILE_INFO}</th>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_ICQ}</td>
		<td class="row2" width="45%">
		<input type="radio" name="override_icq" value="1" {OVERRIDE_ICQ_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_icq" value="0" {OVERRIDE_ICQ_NO} />
		<span class="genmed">{L_NO}</span>
		<hr><span class="gensmall">{L_USER_FIELD_REQUIRED}:
		<input type="radio" name="required_icq" value="1" {REQUIRED_ICQ_YES} />{L_YES}&nbsp;&nbsp;
		<input type="radio" name="required_icq" value="0" {REQUIRED_ICQ_NO} />{L_NO}
		</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_AIM}</td>
		<td class="row2">
		<input type="radio" name="override_aim" value="1" {OVERRIDE_AIM_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_aim" value="0" {OVERRIDE_AIM_NO} />
		<span class="genmed">{L_NO}</span>
		<hr><span class="gensmall">{L_USER_FIELD_REQUIRED}:
		<input type="radio" name="required_aim" value="1" {REQUIRED_AIM_YES} />{L_YES}&nbsp;&nbsp;
		<input type="radio" name="required_aim" value="0" {REQUIRED_AIM_NO} />{L_NO}
		</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_MSN}</td>
		<td class="row2">
		<input type="radio" name="override_msn" value="1" {OVERRIDE_MSN_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_msn" value="0" {OVERRIDE_MSN_NO} />
		<span class="genmed">{L_NO}</span>
		<hr><span class="gensmall">{L_USER_FIELD_REQUIRED}:
		<input type="radio" name="required_msnm" value="1" {REQUIRED_MSN_YES} />{L_YES}&nbsp;&nbsp;
		<input type="radio" name="required_msnm" value="0" {REQUIRED_MSN_NO} />{L_NO}
		</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_SKYPE}</td>
		<td class="row2">
		<input type="radio" name="override_skype" value="1" {OVERRIDE_SKYPE_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_skype" value="0" {OVERRIDE_SKYPE_NO} />
		<span class="genmed">{L_NO}</span>
		<hr><span class="gensmall">{L_USER_FIELD_REQUIRED}:
		<input type="radio" name="required_skype" value="1" {REQUIRED_SKYPE_YES} />{L_YES}&nbsp;&nbsp;
		<input type="radio" name="required_skype" value="0" {REQUIRED_SKYPE_NO} />{L_NO}
		</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_YAHOO}</td>
		<td class="row2">
		<input type="radio" name="override_yahoo" value="1" {OVERRIDE_YAHOO_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_yahoo" value="0" {OVERRIDE_YAHOO_NO} />
		<span class="genmed">{L_NO}</span>
		<hr><span class="gensmall">{L_USER_FIELD_REQUIRED}:
		<input type="radio" name="required_yim" value="1" {REQUIRED_YAHOO_YES} />{L_YES}&nbsp;&nbsp;
		<input type="radio" name="required_yim" value="0" {REQUIRED_YAHOO_NO} />{L_NO}
		</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_WEBSITE}</td>
		<td class="row2">
		<input type="radio" name="override_website" value="1" {OVERRIDE_WEBSITE_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_website" value="0" {OVERRIDE_WEBSITE_NO} />
		<span class="genmed">{L_NO}</span>
		<hr><span class="gensmall">{L_USER_FIELD_REQUIRED}:
		<input type="radio" name="required_website" value="1" {REQUIRED_WEBSITE_YES} />{L_YES}&nbsp;&nbsp;
		<input type="radio" name="required_website" value="0" {REQUIRED_WEBSITE_NO} />{L_NO}
		</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_LOCATION}</td>
		<td class="row2">
		<input type="radio" name="override_location" value="1" {OVERRIDE_LOCATION_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_location" value="0" {OVERRIDE_LOCATION_NO} />
		<span class="genmed">{L_NO}</span>
		<hr><span class="gensmall">{L_USER_FIELD_REQUIRED}:
		<input type="radio" name="required_location" value="1" {REQUIRED_LOCATION_YES} />{L_YES}&nbsp;&nbsp;
		<input type="radio" name="required_location" value="0" {REQUIRED_LOCATION_NO} />{L_NO}
		</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_OCCUPATION}</td>
		<td class="row2">
		<input type="radio" name="override_occupation" value="1" {OVERRIDE_OCCUPATION_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_occupation" value="0" {OVERRIDE_OCCUPATION_NO} />
		<span class="genmed">{L_NO}</span>
		<hr><span class="gensmall">{L_USER_FIELD_REQUIRED}:
		<input type="radio" name="required_occupation" value="1" {REQUIRED_OCCUPATION_YES} />{L_YES}&nbsp;&nbsp;
		<input type="radio" name="required_occupation" value="0" {REQUIRED_OCCUPATION_NO} />{L_NO}
		</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_INTERESTS}</td>
		<td class="row2">
		<input type="radio" name="override_interests" value="1" {OVERRIDE_INTERESTS_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_interests" value="0" {OVERRIDE_INTERESTS_NO} />
		<span class="genmed">{L_NO}</span>
		<hr><span class="gensmall">{L_USER_FIELD_REQUIRED}:
		<input type="radio" name="required_interests" value="1" {REQUIRED_INTERESTS_YES} />{L_YES}&nbsp;&nbsp;
		<input type="radio" name="required_interests" value="0" {REQUIRED_INTERESTS_NO} />{L_NO}
		</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_BIRTHDAY}</td>
		<td class="row2">
		<input type="radio" name="override_birthday" value="1" {OVERRIDE_BIRTHDAY_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_birthday" value="0" {OVERRIDE_BIRTHDAY_NO} />
		<span class="genmed">{L_NO}</span>
		<hr><span class="gensmall">{L_BDAY_REQUIRED}:
		<input type="radio" name="bday_required" value="1" {BDAY_REQUIRED_YES} /><span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="bday_required" value="0" {BDAY_REQUIRED_NO} /><span class="genmed">{L_NO}</span>
    </span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_GENDER}</td>
		<td class="row2">
		<input type="radio" name="override_gender" value="1" {OVERRIDE_GENDER_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_gender" value="0" {OVERRIDE_GENDER_NO} />
		<span class="genmed">{L_NO}</span>
		<hr><span class="gensmall">{L_GENDER_REQUIRED}:
		<input type="radio" name="gender_required" value="1" {GENDER_REQUIRED_YES} /><span class="genmed">{L_YES}</span>&nbsp;&nbsp;
    <input type="radio" name="gender_required" value="0"{GENDER_REQUIRED_NO} /><span class="genmed">{L_NO}</span>
    </span>
		</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center"><input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>

</table><table id="avatarinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_AVATAR_PANEL}</th>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_LOCAL}</td>
		<td class="row2" width="45%">
		<input type="radio" name="allow_avatar_local" value="1" {AVATARS_LOCAL_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="allow_avatar_local" value="0" {AVATARS_LOCAL_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_REMOTE} <br /><span class="gensmall">{L_ALLOW_REMOTE_EXPLAIN}</span></td>
		<td class="row2">
		<input type="radio" name="allow_avatar_remote" value="1" {AVATARS_REMOTE_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="allow_avatar_remote" value="0" {AVATARS_REMOTE_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_UPLOAD}</td>
		<td class="row2">
		<input type="radio" name="allow_avatar_upload" value="1" {AVATARS_UPLOAD_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="allow_avatar_upload" value="0" {AVATARS_UPLOAD_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center"><input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>

</table><table id="signatureinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_SIGNATURE}</th>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_SIGNATURE}</td>
		<td class="row2" width="45%">
		<input type="radio" name="override_signature" value="1" {OVERRIDE_SIGNATURE_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_signature" value="0" {OVERRIDE_SIGNATURE_NO} />
		<span class="genmed">{L_NO}</span>
		<hr><span class="gensmall">{L_USER_FIELD_REQUIRED}:
		<input type="radio" name="required_signature" value="1" {REQUIRED_SIGNATURE_YES} />{L_YES}&nbsp;&nbsp;
		<input type="radio" name="required_signature" value="0" {REQUIRED_SIGNATURE_NO} />{L_NO}
		</span>
		</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center"><input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>

</table><table id="qpesinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_QP_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_QUICK_POST}</td>
		<td class="row2" width="45%">
		<input type="radio" name="override_quick_post" value="1" {OVERRIDE_QUICK_POST_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_quick_post" value="0" {OVERRIDE_QUICK_POST_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center"><input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>

</table><table id="prefinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_PREFERENCES}</th>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_PUBLIC_VIEW_MAIL}</td>
		<td class="row2" width="45%">
		<input type="radio" name="override_public_view_mail" value="1" {OVERRIDE_PUBLIC_VIEW_MAIL_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_public_view_mail" value="0" {OVERRIDE_PUBLIC_VIEW_MAIL_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_HIDE_ONLINE}</td>
		<td class="row2">
		<input type="radio" name="override_hide_online" value="1" {OVERRIDE_HIDE_ONLINE_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_hide_online" value="0" {OVERRIDE_HIDE_ONLINE_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_NOTIFY_ON_REPLY}</td>
		<td class="row2">
		<input type="radio" name="override_notify_on_reply" value="1" {OVERRIDE_NOTIFY_ON_REPLY_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_notify_on_reply" value="0" {OVERRIDE_NOTIFY_ON_REPLY_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_NOTIFY_PM}</td>
		<td class="row2">
		<input type="radio" name="override_notify_pm" value="1" {OVERRIDE_NOTIFY_PM_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_notify_pm" value="0" {OVERRIDE_NOTIFY_PM_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_POPUP_PM}</td>
		<td class="row2">
		<input type="radio" name="override_popup_pm" value="1" {OVERRIDE_POPUP_PM_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_popup_pm" value="0" {OVERRIDE_POPUP_PM_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_NOTIFY_ON_DONATION}</td>
		<td class="row2">
		<input type="radio" name="override_notify_on_donation" value="1" {OVERRIDE_NOTIFY_ON_DONATION_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_notify_on_donation" value="0" {OVERRIDE_NOTIFY_ON_DONATION_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_ALWAYS_ADD_SIGNATURE}</td>
		<td class="row2">
		<input type="radio" name="override_always_add_signature" value="1" {OVERRIDE_ALWAYS_ADD_SIGNATURE_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_always_add_signature" value="0" {OVERRIDE_ALWAYS_ADD_SIGNATURE_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_BBCODE}</td>
		<td class="row2">
    <input type="radio" name="override_bbcode" value="1" {OVERRIDE_BBCODE_YES} />
    <span class="genmed">{L_YES}</span>&nbsp;&nbsp;
    <input type="radio" name="override_bbcode" value="0" {OVERRIDE_BBCODE_NO} />
    <span class="genmed">{L_NO}</span>
    </td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_HTML}</td>
		<td class="row2">
		<input type="radio" name="override_html" value="1" {OVERRIDE_HTML_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_html" value="0" {OVERRIDE_HTML_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_SMILIES}</td>
		<td class="row2">
		<input type="radio" name="override_smilies" value="1" {OVERRIDE_SMILIES_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_smilies" value="0" {OVERRIDE_SMILIES_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_LANGUAGE}</td>
		<td class="row2">
		<input type="radio" name="override_language" value="1" {OVERRIDE_LANGUAGE_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_language" value="0" {OVERRIDE_LANGUAGE_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_BOARD_STYLE}</td>
		<td class="row2">
		<input type="radio" name="override_board_style" value="1" {OVERRIDE_BOARD_STYLE_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_board_style" value="0" {OVERRIDE_BOARD_STYLE_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_TIME_MODE}</td>
		<td class="row2">
		<input type="radio" name="override_time_mode" value="1" {OVERRIDE_TIME_MODE_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_time_mode" value="0" {OVERRIDE_TIME_MODE_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_DATE_FORMAT}</td>
		<td class="row2">
		<input type="radio" name="override_date_format" value="1" {OVERRIDE_DATE_FORMAT_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_date_format" value="0" {OVERRIDE_DATE_FORMAT_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_POSTS_PER_PAGE}</td>
		<td class="row2">
		<input type="radio" name="override_posts_per_page" value="1" {OVERRIDE_POSTS_PER_PAGE_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_posts_per_page" value="0" {OVERRIDE_POSTS_PER_PAGE_NO} />
		<span class="genmed">{L_NO}</span>
		<hr>
		<span class="gensmall">{L_USER_FIELD_REQUIRED}:
		<input type="radio" name="required_posts_per_page" value="1" {REQUIRED_POSTS_PER_PAGE_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="required_posts_per_page" value="0" {REQUIRED_POSTS_PER_PAGE_NO} />
		<span class="genmed">{L_NO}</span>
    </span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_TOPICS_PER_PAGE}</td>
		<td class="row2">
		<input type="radio" name="override_topics_per_page" value="1" {OVERRIDE_POSTS_PER_PAGE_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
		<input type="radio" name="override_topics_per_page" value="0" {OVERRIDE_POSTS_PER_PAGE_NO} />
		<span class="genmed">{L_NO}</span>
		<hr>
		<span class="gensmall">{L_USER_FIELD_REQUIRED}:
		<input type="radio" name="required_topics_per_page" value="1" {REQUIRED_TOPICS_PER_PAGE_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;&nbsp;
    <input type="radio" name="required_topics_per_page" value="0"{REQUIRED_TOPICS_PER_PAGE_NO} />
		<span class="genmed">{L_NO}</span>
    </span>
		</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center"><input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>
</table>

</td></tr></table>{S_HIDDEN_FIELDS}
</form>

<br clear="all" />
