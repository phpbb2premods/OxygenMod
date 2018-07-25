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
			'registrationinfo',
			'profilinfo',
			'avatarinfo',
			'qpesinfo',
			'preferencesinfo',
			'adminonlyinfo',
			'authorizationsinfo',
			'iprestrictioninfo'
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

<script type="text/javascript">
<!--
	/**
	* Set display of page element
	* Borrowed from phpBB 3.0 (aka Olympus)
	* s[-1,0,1] = hide,toggle display,show
	*/
	function dE(n,s)
	{
		var e = document.getElementById(n);
		if (!s)
		{
			s = (e.style.display == '') ? -1 : 1;
		}
		e.style.display = (s == 1) ? 'block' : 'none';
	}
//-->
</script>

<h1>{L_USER_TITLE}</h1>

<p>{L_USER_EXPLAIN}</p>

{ERROR_BOX}

<form action="{S_PROFILE_ACTION}" {S_FORM_ENCTYPE} method="post">
<table cellpadding="0" cellspacing="2" border="0" width="100%"><tr><td width="250" valign="top">

<table cellpadding="4" cellspacing="1" border="0" class="forumline" width="250">

<tr>
  <th class="thHead" colspan="2">{L_USER_TITLE}</th>
</tr>
<tr>
  <td id="registrationinfo_flag" class="row1 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('registrationinfo'); return false;"><div id="registrationinfo_opt" class="gensmall" style="font-weight: bold;"><a href="#" onclick="dom_menu.set('registrationinfo'); return false;">{L_REGISTRATION_INFO}</a></div></td>
</tr>
<tr>
  <td id="profilinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('profilinfo'); return false;"><div id="profilinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('profilinfo'); return false;">{L_PROFILE_INFO}</a></div></td>
</tr>
<tr>
  <td id="avatarinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('avatarinfo'); return false;"><div id="avatarinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('avatarinfo'); return false;">{L_AVATAR_PANEL}</a></div></td>
</tr>
<tr>
  <td id="qpesinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('qpesinfo'); return false;"><div id="qpesinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('qpesinfo'); return false;">{L_QP_SETTINGS}</a></div></td>
</tr>
<tr>
  <td id="preferencesinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('preferencesinfo'); return false;"><div id="preferencesinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('preferencesinfo'); return false;">{L_PREFERENCES}</a></div></td>
</tr>
<tr>
	<td class="row2" colspan="2"></td>
</tr>
<tr>
  <td id="adminonlyinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('adminonlyinfo'); return false;"><div id="adminonlyinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('adminonlyinfo'); return false;">{L_SPECIAL}</a></div></td>
</tr>
<tr>
  <td id="authorizationsinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('authorizationsinfo'); return false;"><div id="authorizationsinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('authorizationsinfo'); return false;">{L_AUTHORIZATIONS}</a></div></td>
</tr>
<tr>
  <td id="iprestrictioninfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('iprestrictioninfo'); return false;"><div id="iprestrictioninfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('iprestrictioninfo'); return false;">{L_ABOUTRESTRICTIP}</a></div></td>
</tr>
</table>

</td><td valign="top" width="100%">

<table id="registrationinfo" class="forumline" border="0" cellpadding="4" cellspacing="1" width="100%">
	<tr>
	  <th class="thHead" colspan="2">{L_REGISTRATION_INFO}</th>
	</tr>
	<tr>
	  <td class="row2" colspan="2"><span class="gensmall">{L_ITEMS_REQUIRED}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_USERNAME}: *</span></td>
	  <td class="row2" width="45%"><input class="post" type="text" name="username_fillfix" size="35" maxlength="40" value="{USERNAME}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_EMAIL_ADDRESS}: *</span></td>
	  <td class="row2"><input class="post" type="text" name="email" size="35" maxlength="255" value="{EMAIL}" /></td>
	</tr>
	<tr>
	  <td class="row1">
		<span class="gen">{L_NEW_PASSWORD}: *</span><br />
		<span class="gensmall">{L_PASSWORD_IF_CHANGED}</span>
	  </td>
	  <td class="row2"><input class="post" type="password" name="password_fillfix" size="35" maxlength="32" value="" /></td>
	</tr>
	<tr>
	  <td class="row1">
		<span class="gen">{L_CONFIRM_PASSWORD}: * </span><br />
		<span class="gensmall">{L_PASSWORD_CONFIRM_IF_CHANGED}</span>
	  </td>
	  <td class="row2"><input class="post" type="password" name="password_confirm" size="35" maxlength="32" value="" /></td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_REGIP}: </span></td>
	  <td class="row2"><span class="gensmall">{USER_REGIP}</span></td>
	</tr>
	<tr>
	  <td class="catBottom" colspan="2" align="center">
		{S_HIDDEN_FIELDS}
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
	  </td>
	</tr>

</table><table id="profilinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_PROFILE_INFO}</th>
	</tr>
	<tr>
	  <td class="row2" colspan="2"><span class="gensmall">{L_ITEMS_REQUIRED}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_ICQ_NUMBER}</span></td>
	  <td class="row2" width="45%"><input class="post" type="text" name="icq" size="10" maxlength="15" value="{ICQ}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_AIM}</span></td>
	  <td class="row2"><input class="post" type="text" name="aim" size="20" maxlength="255" value="{AIM}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_MESSENGER}</span></td>
	  <td class="row2"><input class="post" type="text" name="msn" size="20" maxlength="255" value="{MSN}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_SKYPE}</span></td>
	  <td class="row2"><input class="post" type="text" name="skype" size="20" maxlength="255" value="{SKYPE}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_YAHOO}</span></td>
	  <td class="row2"><input class="post" type="text" name="yim" size="20" maxlength="255" value="{YIM}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_WEBSITE}</span></td>
	  <td class="row2"><input class="post" type="text" name="website" size="35" maxlength="255" value="{WEBSITE}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_LOCATION}</span></td>
	  <td class="row2"><input class="post" type="text" name="location" size="35" maxlength="100" value="{LOCATION}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_OCCUPATION}</span></td>
	  <td class="row2"><input class="post" type="text" name="occupation" size="35" maxlength="100" value="{OCCUPATION}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_INTERESTS}</span></td>
	  <td class="row2"><input class="post" type="text" name="interests" size="35" maxlength="150" value="{INTERESTS}" /></td>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_BDAY_BIRTHDATE}:{L_BDAY_REQUIRED}</span></td>
		<td class="row2"><span class="genmed">
		{L_BDAY_DAY}: {S_BDAY_DAY_OPTIONS}&nbsp;
		{L_BDAY_MONTH}: {S_BDAY_MONTH_OPTIONS}&nbsp;
		{L_BDAY_YEAR}: {S_BDAY_YEAR_OPTIONS}
		</span></td>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_GENDER}:</span></td>
		<td class="row2">
			<input type="radio" name="gender" value="0" {GENDER_NO_SPECIFY_CHECKED}/>
			<span class="gen">{L_GENDER_NOT_SPECIFY}</span>&nbsp;&nbsp;
			<input type="radio" name="gender" value="1" {GENDER_MALE_CHECKED}/>
			<span class="gen">{L_GENDER_MALE}</span>&nbsp;&nbsp;
			<input type="radio" name="gender" value="2" {GENDER_FEMALE_CHECKED}/>
			<span class="gen">{L_GENDER_FEMALE}</span>
		</td>
	</tr>
	<tr>
	  <td class="row1">
		<span class="gen">{L_SIGNATURE}</span><br />
		<span class="gensmall">{L_SIGNATURE_EXPLAIN}<br /><br />
		{HTML_STATUS}<br />
		{BBCODE_STATUS}<br />
		{SMILIES_STATUS}</span>
	  </td>
	  <td class="row2"><textarea class="post" name="signature" rows="6" cols="45">{SIGNATURE}</textarea></td>
	</tr>
	<tr>
	  <td class="catBottom" colspan="2" align="center">
		{S_HIDDEN_FIELDS}
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
	  </td>
	</tr>

</table><table id="avatarinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_AVATAR_PANEL}</th>
	</tr>
	<tr align="center"> 
	  <td class="row1" colspan="2"><table width="70%" cellspacing="2" cellpadding="0" border="0">
		<tr>
		  <td width="65%"><span class="gensmall">{L_AVATAR_EXPLAIN}</span></td>
		  <td align="center"><span class="gensmall">
			{L_CURRENT_IMAGE}</span><br />
			{AVATAR}<br />
			<input type="checkbox" name="avatardel" /> {L_DELETE_AVATAR}
		  </span></td>
		</tr>
	  </table></td>
	</tr>
	<!-- BEGIN avatar_local_upload -->
	<tr>
	  <td class="row1"><span class="gen">{L_UPLOAD_AVATAR_FILE}</span></td>
	  <td class="row2" width="45%">
		<input type="hidden" name="MAX_FILE_SIZE" value="{AVATAR_SIZE}" />&nbsp;
		<input type="file" name="avatar" class="post" style="width: 200px" />
	  </td>
	</tr>
	<!-- END avatar_local_upload -->
	<!-- BEGIN avatar_remote_upload -->
	<tr>
	  <td class="row1"><span class="gen">{L_UPLOAD_AVATAR_URL}</span></td>
	  <td class="row2"><input class="post" type="text" name="avatarurl" size="40" style="width: 200px" /></td>
	</tr>
	<!-- END avatar_remote_upload -->
	<!-- BEGIN avatar_remote_link -->
	<tr>
	  <td class="row1"><span class="gen">{L_LINK_REMOTE_AVATAR}</span></td>
	  <td class="row2"><input class="post" type="text" name="avatarremoteurl" size="40" style="width: 200px" /></td>
	</tr>
	<!-- END avatar_remote_link -->
	<!-- BEGIN avatar_local_gallery -->
	<tr>
	  <td class="row1"><span class="gen">{L_AVATAR_GALLERY}</span></td>
	  <td class="row2"><input type="submit" name="avatargallery" value="{L_SHOW_GALLERY}" class="liteoption" /></td>
	</tr>
	<!-- END avatar_local_gallery -->
	<tr>
	  <td class="catBottom" colspan="2" align="center">
		{S_HIDDEN_FIELDS}
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
	  </td>
	</tr>

</table><table id="qpesinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_QP_SETTINGS}</th>
	</tr>
	<!-- BEGIN qpes -->
	<tr>
		<td class="row1"><span class="gen">{qpes.L_QP_TITLE}</span><br /><span class="gensmall">{qpes.L_QP_DESC}</span></td>
		<td class="row2" width="45%"><span class="gen">
			<input type="radio" name="{qpes.QP_VAR}" value="1" {qpes.QP_YES} /> {L_YES}&nbsp;
			<input type="radio" name="{qpes.QP_VAR}" value="0" {qpes.QP_NO} /> {L_NO}
		</span></td>
	</tr>
	<!-- END qpes -->
	<tr>
	  <td class="catBottom" colspan="2" align="center">
		{S_HIDDEN_FIELDS}
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
	  </td>
	</tr>

</table><table id="preferencesinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_PREFERENCES}</th>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_PUBLIC_VIEW_EMAIL}</span></td>
	  <td class="row2" width="45%"><span class="gen">
		<input type="radio" name="viewemail" value="1" {VIEW_EMAIL_YES} /> {L_YES}&nbsp;
		<input type="radio" name="viewemail" value="0" {VIEW_EMAIL_NO} /> {L_NO}
	  </span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_HIDE_USER}</span></td>
	  <td class="row2"><span class="gen">
		<input type="radio" name="hideonline" value="1" {HIDE_USER_YES} /> {L_YES}&nbsp;
		<input type="radio" name="hideonline" value="0" {HIDE_USER_NO} /> {L_NO}
	  </span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_NOTIFY_ON_REPLY}</span></td>
	  <td class="row2"><span class="gen">
		<input type="radio" name="notifyreply" value="1" {NOTIFY_REPLY_YES} /> {L_YES}&nbsp;
		<input type="radio" name="notifyreply" value="0" {NOTIFY_REPLY_NO} /> {L_NO}
	  </span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_NOTIFY_ON_PRIVMSG}</span></td>
	  <td class="row2"><span class="gen">
		<input type="radio" name="notifypm" value="1" {NOTIFY_PM_YES} /> {L_YES}&nbsp;
		<input type="radio" name="notifypm" value="0" {NOTIFY_PM_NO} /> {L_NO}
	  </span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_POPUP_ON_PRIVMSG}</span></td>
	  <td class="row2"><span class="gen">
		<input type="radio" name="popup_pm" value="1" {POPUP_PM_YES} /> {L_YES}&nbsp;
		<input type="radio" name="popup_pm" value="0" {POPUP_PM_NO} /> {L_NO}
	  </span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_ALWAYS_ADD_SIGNATURE}</span></td>
	  <td class="row2"><span class="gen">
		<input type="radio" name="attachsig" value="1" {ALWAYS_ADD_SIGNATURE_YES} /> {L_YES}&nbsp;
		<input type="radio" name="attachsig" value="0" {ALWAYS_ADD_SIGNATURE_NO} /> {L_NO}
	  </span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_ALWAYS_ALLOW_BBCODE}</span></td>
	  <td class="row2"><span class="gen">
		<input type="radio" name="allowbbcode" value="1" {ALWAYS_ALLOW_BBCODE_YES} /> {L_YES}&nbsp;
		<input type="radio" name="allowbbcode" value="0" {ALWAYS_ALLOW_BBCODE_NO} /> {L_NO}
	  </span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_ALWAYS_ALLOW_HTML}</span></td>
	  <td class="row2"><span class="gen">
		<input type="radio" name="allowhtml" value="1" {ALWAYS_ALLOW_HTML_YES} /> {L_YES}&nbsp;
		<input type="radio" name="allowhtml" value="0" {ALWAYS_ALLOW_HTML_NO} /> {L_NO}
	  </span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_ALWAYS_ALLOW_SMILIES}</span></td>
	  <td class="row2"><span class="gen">
		<input type="radio" name="allowsmilies" value="1" {ALWAYS_ALLOW_SMILIES_YES} /> {L_YES}&nbsp;
		<input type="radio" name="allowsmilies" value="0" {ALWAYS_ALLOW_SMILIES_NO} /> {L_NO}
	  </span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_BOARD_LANGUAGE}</span></td>
	  <td class="row2">{LANGUAGE_SELECT}</td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_BOARD_STYLE}</span></td>
	  <td class="row2">{STYLE_SELECT}</td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_TIMEZONE}</span></td>
	  <td class="row2">{TIMEZONE_SELECT}</td>
	</tr>
	<tr>
	  <td class="row1">
		<span class="gen">{L_DATE_FORMAT}</span><br />
		<span class="gensmall">{L_DATE_FORMAT_EXPLAIN}</span>
	  </td>
	  <td class="row2"><span class="gen">
		<select name="dateoptions" id="dateoptions" onchange="if (this.value=='custom') { dE('custom_date',1); } else { dE('custom_date',-1); } if (this.value == 'custom') { document.getElementById('dateformat').value = '{A_DEFAULT_DATEFORMAT}'; } else { document.getElementById('dateformat').value = this.value; }">
			{S_DATEFORMAT_OPTIONS}
		</select>
		<div id="custom_date"{S_CUSTOM_DATEFORMAT}><input type="text" name="dateformat" id="dateformat" value="{DATE_FORMAT}" maxlength="30" class="post" style="margin-top: 3px;" /></div>
	  </span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_WHOISONLINE_TYPE}:</span></td>
	  <td class="row2"><span class="gen">
		<input type="radio" name="whoisonline_type" value="1" {WHOISONLINE_TYPE_YES} /> {L_YES}</span>&nbsp;
		<input type="radio" name="whoisonline_type" value="0" {WHOISONLINE_TYPE_NO} /> {L_NO}
		</span></td>
	</tr>
	<tr>
	  <td class="catBottom" colspan="2" align="center">
		{S_HIDDEN_FIELDS}
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
	  </td>
	</tr>

</table><table id="adminonlyinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_SPECIAL}</th>
	</tr>
	<tr>
	  <td class="row1" colspan="2"><span class="gensmall">{L_SPECIAL_EXPLAIN}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_USER_ACTIVE}</span></td>
	  <td class="row2" width="45%"><span class="gen">
		<input type="radio" name="user_status" value="1" {USER_ACTIVE_YES} /> {L_YES}&nbsp;
		<input type="radio" name="user_status" value="0" {USER_ACTIVE_NO} /> {L_NO}
	  </span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_DELETE_USER} ?</span></td>
	  <td class="row2"><input type="checkbox" name="deleteuser"> {L_DELETE_USER_EXPLAIN}</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_SET_POSTS}</span></td> 
	  <td class="row2"><input type="text" name="user_posts" value="{USER_POSTS}" size="10" maxlength="10" class="post" /></td> 
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_SELECT_RANK}</span></td>
	  <td class="row2"><select name="user_rank">{RANK_SELECT_BOX}</select></td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_USER_BOULET}</span></td>
		<td class="row2"><select name="user_boulet_type">{BOULET_SELECT_BOX}</select>&nbsp;<input class="post" type="text" name="user_boulet_value" size="30" maxlength="200" value="{USER_BOULET_VALUE}" /></td>
	</tr>
  <tr>
    <td class="row1"><span class="gen">{L_BANCARD}:</span><br /><span class="gensmall">{L_BANCARD_EXPLAIN}<br /></td>
    <td class="row2"><input type="text" class="post" style="width: 40px"  name="user_ycard" size="4" maxlength="4" value="{BANCARD}" /></td> 
  </tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_POINTS}</span></td>
	  <td class="row2"> 
		<input class="post" type="text" name="points" maxlength="12" value="{POINTS}" size="12" />
	  </td>
	</tr>
	<tr>
	  <td class="catBottom" colspan="2" align="center">
		{S_HIDDEN_FIELDS}
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
	  </td>
	</tr>

</table><table id="authorizationsinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_AUTHORIZATIONS}</th>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_ALLOW_NAMECHANGE}</span></td>
		<td class="row2" width="45%">
		<span class="gen">
		<input type="radio" name="user_namechange" value="1" {ALLOW_NAMECHANGE_YES} /> {L_YES}&nbsp;
		<input type="radio" name="user_namechange" value="0" {ALLOW_NAMECHANGE_NO} />	{L_NO}
		</span></td>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_ALLOW_MAILCHANGE}</span></td>
		<td class="row2"><span class="gen">
		<input type="radio" name="user_mailchange" value="1" {ALLOW_MAILCHANGE_YES} /> {L_YES}&nbsp;
		<input type="radio" name="user_mailchange" value="0" {ALLOW_MAILCHANGE_NO} />	{L_NO}
		</span></td>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_ALLOW_PASSWORDCHANGE}</span></td>
		<td class="row2"><span class="gen">
		<input type="radio" name="user_passwordchange" value="1" {ALLOW_PASSWORDCHANGE_YES} /> {L_YES}&nbsp;
		<input type="radio" name="user_passwordchange" value="0" {ALLOW_PASSWORDCHANGE_NO} />	{L_NO}
		</span></td>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_ALLOW_ACCOUNT_DELETE}</span></td>
		<td class="row2"><span class="gen">
		<input type="radio" name="user_account_delete" value="1" {ALLOW_ACCOUNT_DELETE_YES} /> {L_YES}&nbsp;
		<input type="radio" name="user_account_delete" value="0" {ALLOW_ACCOUNT_DELETE_NO} />	{L_NO}
		</span></td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_ALLOW_PM}</span></td>
	  <td class="row2"><span class="gen">
		<input type="radio" name="user_allowpm" value="1" {ALLOW_PM_YES} /> {L_YES}&nbsp;
		<input type="radio" name="user_allowpm" value="0" {ALLOW_PM_NO} /> {L_NO}
	  </span></td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_PM_QUOTA}</span></td>
	  <td class="row2">{S_SELECT_PM_QUOTA}</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_ALLOW_AVATAR}</span></td>
	  <td class="row2"><span class="gen">
		<input type="radio" name="user_allowavatar" value="1" {ALLOW_AVATAR_YES} /> {L_YES}&nbsp;
		<input type="radio" name="user_allowavatar" value="0" {ALLOW_AVATAR_NO} /> {L_NO}
	  </span></td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_ALLOW_POINTS}</span></td>
	  <td class="row2"><span class="gen">
		<input type="radio" name="allow_points" value="1" {ALLOW_POINTS_YES} />{L_YES}&nbsp; 
		<input type="radio" name="allow_points" value="0" {ALLOW_POINTS_NO} />{L_NO}
		</span></td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_UPLOAD_QUOTA}</span></td>
	  <td class="row2">{S_SELECT_UPLOAD_QUOTA}</td>
	</tr>
	<tr>
	  <td class="catBottom" colspan="2" align="center">
		{S_HIDDEN_FIELDS}
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
	  </td>
	</tr>

</table><table id="iprestrictioninfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_ABOUTRESTRICTIP}</th>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_USER_RESTRICTIP}</span></td>  
	  <td class="row2" width="45%">
		<input type="radio" name="user_restrictip" value="1" {USER_RESTRICTIP_YES} />
		<span class="gen">{L_YES}</span>&nbsp;&nbsp; 
		<input type="radio" name="user_restrictip" value="0" {USER_RESTRICTIP_NO} />
		<span class="gen">{L_NO}</span>
		</td>
	</tr>
	<tr>
	  <td class="row1">	
		{L_USER_IPRANGE}<br />
		{L_ABOUT_IPRANGE}
	  </td>
	  <td class="row2">	
	  <textarea name="user_iprange" maxlength="255" rows=5 cols=25>{USER_IPRANGE}</textarea>
	  </td>
	</tr>
	<tr>
	  <td class="catBottom" colspan="2" align="center">
		{S_HIDDEN_FIELDS}
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
	  </td>
	</tr>
</table>


</td></tr></table>{S_HIDDEN_FIELDS}
</form>

<br clear="all" />
