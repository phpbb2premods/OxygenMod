{BBC_JS_BOX}

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
<!-- BEGIN switch_avatar_block -->
			'avatarinfo',
<!-- END switch_avatar_block -->
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
<!-- BEGIN switch_avatar_block -->
		pic = this.objref('avatarinfo_cur');
		if ( pic && pic.style )
		{
			pic.style.display = ( menu == 'avatarinfo' ) ? '' : 'none';
		}
<!-- END switch_avatar_block -->
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

<form action="{S_PROFILE_ACTION}" {S_FORM_ENCTYPE} name="post" method="post">

{ERROR_BOX}

<table width="100%" cellspacing="2" cellpadding="0" border="0" align="center">
<tr>
	<td class="nav" align="left" width="100%" colspan="2" valign="top"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></td>
</tr>
<tr>
	<td width="250" valign="top"><table cellpadding="4" cellspacing="1" border="0" class="forumline" width="250">
	<tr>
		<th class="thHead" colspan="2">{L_PROFILE}</th>
	</tr>
	<tr>
		<td id="reginfo_flag" class="{STYLE_ROW_REG} gensmall" align="right" width="10">&raquo;</td>
		<td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('reginfo'); return false;"><div id="reginfo_opt" class="gensmall" {STYLE_FONT_ACTIF_REG}><a href="#" onclick="dom_menu.set('reginfo'); return false;">{L_REGISTRATION_INFO}</a></div></td>
	</tr>
	<tr>
		<td id="profileinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
		<td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('profileinfo'); return false;"><div id="profileinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('profileinfo'); return false;">{L_PROFILE_INFO}</a></div></td>
	</tr>
	<!-- BEGIN switch_avatar_block -->
	<tr>
		<td id="avatarinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
		<td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('avatarinfo'); return false;"><div id="avatarinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('avatarinfo'); return false;">{L_AVATAR_PANEL}</a></div></td>
	</tr>
	<!-- END switch_avatar_block -->
	<!-- BEGIN override_signature_block -->
	<tr>
		<td id="signatureinfo_flag" class="{STYLE_ROW_SIG} gensmall" align="right" width="10">&raquo;</td>
		<td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('signatureinfo'); return false;"><div id="signatureinfo_opt" class="gensmall" {STYLE_FONT_ACTIF_SIG}><a href="#" onclick="dom_menu.set('signatureinfo'); return false;">{L_SIGNATURE}</a></div></td>
	</tr>
	<!-- END override_signature_block -->
	<!-- BEGIN override_quick_post_block -->
	<tr>
		<td id="qpesinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
		<td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('qpesinfo'); return false;"><div id="qpesinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('qpesinfo'); return false;">{L_QP_SETTINGS}</a></div></td>
	</tr>
	<!-- END override_quick_post_block -->
	<tr>
		<td id="prefinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
		<td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('prefinfo'); return false;"><div id="prefinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('prefinfo'); return false;">{L_PREFERENCES}</a></div></td>
	</tr>
	</table>
	<br style="font-size: 3px" />

	<table id="avatarinfo_cur" style="display:none" cellpadding="4" cellspacing="1" border="0" class="forumline" width="100%">
	<tr>
		<th class="thHead">{L_CURRENT_IMAGE}</th>
	</tr>
	<tr>
		<td class="row1" align="center">{AVATAR}<span class="gensmall"><br /><input type="checkbox" name="avatardel" />&nbsp;{L_DELETE_AVATAR}</span></td>
	</tr>
	</table></td>

	<td valign="top" width="100%">
	<table id="reginfo" {STYLE_DYSPLAY_REG} class="forumline" border="0" cellpadding="4" cellspacing="1" width="100%">
	<tr>
		<th class="thHead" colspan="2">{L_REGISTRATION_INFO}</th>
	</tr>
	<tr> 
		<td class="row2" colspan="2"><span class="gensmall">{L_ITEMS_REQUIRED}</span></td>
	</tr>
	<!-- BEGIN switch_namechange_disallowed -->
	<tr> 
		<td class="row1"><span class="gen">{L_USERNAME}: *</span></td>
		<td class="row2" width="38%"><input type="hidden" name="username" value="{USERNAME}" /><span class="gen"><b>{USERNAME}</b></span></td>
	</tr>
	<!-- END switch_namechange_disallowed -->
	<!-- BEGIN switch_namechange_allowed -->
	<tr> 
		<td class="row1" width="38%"><span class="gen">{L_USERNAME}: *</span></td>
		<td class="row2"><input type="text" class="post" style="width:200px" name="username" size="25" maxlength="25" value="{USERNAME}" /></td>
	</tr>
	<!-- END switch_namechange_allowed -->
	<!-- BEGIN switch_mailchange_disallowed -->
	<tr>
		<td class="row1"><span class="gen">{L_EMAIL_ADDRESS}: *</span></td>
		<td class="row2"><input type="hidden" name="email" value="{EMAIL}" /><b class="gen">{EMAIL}</b><br /><span class="gensmall">{L_EMAIL_EXPLAIN}</span></td>
	</tr>
	<!-- END switch_mailchange_disallowed -->
	<!-- BEGIN switch_mailchange_allowed -->
	<tr> 
		<td class="row1"><span class="gen">{L_EMAIL_ADDRESS}: *</span></td>
		<td class="row2"><input type="text" class="post" style="width:200px" name="email" size="25" maxlength="255" value="{EMAIL}" /></td>
	</tr>
	<!-- END switch_mailchange_allowed -->
	<!-- BEGIN switch_edit_profile -->
	<tr> 
	  <td class="row1"><span class="gen">{L_CURRENT_PASSWORD}: *</span><br />
		<span class="gensmall">{L_CONFIRM_PASSWORD_EXPLAIN}</span></td>
	  <td class="row2"> 
		<input type="password" class="post" style="width: 200px" name="cur_password" size="25" maxlength="32" value="{CUR_PASSWORD}" />
	  </td>
	</tr>
	<!-- END switch_edit_profile -->
	<!-- BEGIN switch_passwordchange_disallowed -->
	<tr>
		<td class="row1"><span class="gen">{L_NEW_PASSWORD}: *</span></td>
		<td class="row2"><span class="gensmall">{L_PASSWORD_EXPLAIN}</span></td>
	</tr>
	<!-- END switch_passwordchange_disallowed -->
	<!-- BEGIN switch_passwordchange_allowed -->
	<tr>
	  <td class="row1"><span class="gen">{L_NEW_PASSWORD}: *</span><br />
		<span class="gensmall">{L_PASSWORD_IF_CHANGED}</span></td>
	  <td class="row2"> 
		<input type="password" class="post" style="width: 200px" name="new_password" size="25" maxlength="32" value="{NEW_PASSWORD}" />
	  </td>
	</tr>
	<tr> 
		<td class="row1"><span class="gen">{L_CONFIRM_PASSWORD}: * </span><br />
		<span class="gensmall">{L_PASSWORD_CONFIRM_IF_CHANGED}</span></td>
	  <td class="row2"> 
		<input type="password" class="post" style="width: 200px" name="password_confirm" size="25" maxlength="32" value="{PASSWORD_CONFIRM}" />
	  </td>
	</tr>
	<!-- END switch_passwordchange_allowed -->
	<!-- BEGIN account_delete_block -->
	<tr> 
		<td class="row1"><span class="gen">{L_ACCOUNT_DELETE}</span></td>
		<td class="row2"> 
		<input type="checkbox" name="deleteuser">
		<span class="gensmall">{L_DELETE_ACCOUNT_EXPLAIN}</span>
		</td>
  </tr>
  <!-- END account_delete_block -->
	<!-- Visual Confirmation -->
	<!-- BEGIN switch_confirm -->
	<tr>
		<td class="row1" colspan="2" align="center"><span class="gensmall">{L_CONFIRM_CODE_IMPAIRED}</span><br /><br />{CONFIRM_IMG}<br /><br /></td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_CONFIRM_CODE}: * </span><br /><span class="gensmall">{L_CONFIRM_CODE_EXPLAIN}</span></td>
	  <td class="row2"><input type="text" class="post" style="width: 200px" name="confirm_code" size="6" maxlength="6" value="" /></td>
	</tr>
	<!-- END switch_confirm -->
	<tr>
		<td class="catBottom" colspan="2" align="center">
    <input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
    <input type="reset" value="{L_RESET}" class="liteoption" />
    </td>
	</tr>

</table><table id="profileinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_PROFILE_INFO}</th>
	</tr>
	<tr>
		<td class="row2" colspan="2"><span class="gensmall">{L_ITEMS_REQUIRED}</span></td>
	</tr>
	<tr> 
	  <td class="row2" colspan="2"><span class="gensmall">{L_PROFILE_INFO_NOTICE}</span></td>
	</tr>
	<!-- BEGIN override_icq_block -->
	<tr> 
	  <td class="row1"><span class="gen">{L_ICQ_NUMBER}:</span></td>
	  <td class="row2" width="38%"> 
		<input type="text" name="icq" class="post"style="width: 100px"  size="10" maxlength="15" value="{ICQ}" />
	  </td>
	</tr>
	<!-- END override_icq_block -->
	<!-- BEGIN override_aim_block -->
	<tr> 
	  <td class="row1"><span class="gen">{L_AIM}:</span></td>
	  <td class="row2"> 
		<input type="text" class="post"style="width: 150px"  name="aim" size="20" maxlength="255" value="{AIM}" />
	  </td>
	</tr>
	<!-- END override_aim_block -->
	<!-- BEGIN override_msn_block -->
	<tr> 
	  <td class="row1"><span class="gen">{L_MESSENGER}:</span></td>
	  <td class="row2"> 
		<input type="text" class="post"style="width: 150px"  name="msn" size="20" maxlength="255" value="{MSN}" />
	  </td>
	</tr>
	<!-- END override_msn_block -->
	<!-- BEGIN override_skype_block -->
	<tr> 
	  <td class="row1"><span class="gen">{L_SKYPE}:</span></td>
	  <td class="row2"> 
		<input type="text" class="post"style="width: 150px"  name="skype" size="20" maxlength="255" value="{SKYPE}" />
	  </td>
	</tr>
	<!-- END override_skype_block -->
	<!-- BEGIN override_yahoo_block -->
	<tr> 
	  <td class="row1"><span class="gen">{L_YAHOO}:</span></td>
	  <td class="row2"> 
		<input type="text" class="post"style="width: 150px"  name="yim" size="20" maxlength="255" value="{YIM}" />
	  </td>
	</tr>
	<!-- END override_yahoo_block -->
	<!-- BEGIN override_website_block -->
	<tr> 
	  <td class="row1"><span class="gen">{L_WEBSITE}:</span></td>
	  <td class="row2"> 
		<input type="text" class="post"style="width: 200px"  name="website" size="25" maxlength="255" value="{WEBSITE}" />
	  </td>
	</tr>
	<!-- END override_website_block -->
	<!-- BEGIN override_location_block -->
	<tr> 
	  <td class="row1"><span class="gen">{L_LOCATION}:</span></td>
	  <td class="row2"> 
		<input type="text" class="post"style="width: 200px"  name="location" size="25" maxlength="100" value="{LOCATION}" />
	  </td>
	</tr>
	<!-- END override_location_block -->
	<!-- BEGIN override_occupation_block -->
	<tr> 
	  <td class="row1"><span class="gen">{L_OCCUPATION}:</span></td>
	  <td class="row2"> 
		<input type="text" class="post"style="width: 200px"  name="occupation" size="25" maxlength="100" value="{OCCUPATION}" />
	  </td>
	</tr>
	<!-- END override_occupation_block -->
	<!-- BEGIN override_interests_block -->
	<tr> 
	  <td class="row1"><span class="gen">{L_INTERESTS}:</span></td>
	  <td class="row2"> 
		<input type="text" class="post"style="width: 200px"  name="interests" size="35" maxlength="150" value="{INTERESTS}" />
	  </td>
	</tr>
	<!-- END override_interests_block -->
	<!-- BEGIN override_birthday_block -->
	<tr>
	  <td class="row1"><span class="gen">{L_BDAY_BIRTHDATE}:{L_BDAY_REQUIRED}</span></td>
	  <td class="row2"><span class="genmed">
		{L_BDAY_DAY}: {S_BDAY_DAY_OPTIONS}&nbsp;
		{L_BDAY_MONTH}: {S_BDAY_MONTH_OPTIONS}&nbsp;
		{L_BDAY_YEAR}: {S_BDAY_YEAR_OPTIONS}
	  </span></td>
	</tr>
	<!-- END override_birthday_block -->
	<!-- BEGIN override_gender_block -->
	<tr>
		<td class="row1"><span class="gen">{L_GENDER}:{GENDER_REQUIRED}</span></td>
		<td class="row2">
		<input type="radio" {LOCK_GENDER} name="gender" value="0" {GENDER_NO_SPECIFY_CHECKED}/>
		<span class="gen">{L_GENDER_NOT_SPECIFY}</span>&nbsp;&nbsp;
		<input type="radio" name="gender" value="1" {GENDER_MALE_CHECKED}/>
		<span class="gen">{L_GENDER_MALE}</span>&nbsp;&nbsp;
		<input type="radio" name="gender" value="2" {GENDER_FEMALE_CHECKED}/>
		<span class="gen">{L_GENDER_FEMALE}</span>
		</td>
	</tr>
	<!-- END override_gender_block -->
	<tr>
		<td class="catBottom" colspan="2" align="center">
    <input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
    <input type="reset" value="{L_RESET}" class="liteoption" />
    </td>
	</tr>

</table><table id="signatureinfo" {STYLE_DYSPLAY_SIG} border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
  {SIG_PREVIEW_BOX}
	<tr>
		<th class="thHead" colspan="2">{L_SIGNATURE}</th>
	</tr>
	<tr> 
	  <td class="row2" colspan="2"><span class="gensmall">{L_SIGNATURE_EXPLAIN}</span></td>
	</tr>
	<tr>
	  <td class="row1" valign="top"><table width="100%" cellspacing="0" cellpadding="1" border="0">
		<tr>
		  <td valign="middle" align="center"><table width="100" cellspacing="0" cellpadding="5" border="0">
			<tr align="center">
			  <td colspan="{S_SMILIES_COLSPAN}" class="gensmall"><b>{L_EMOTICONS}</b></td>
			</tr>
			<!-- BEGIN smilies_row -->
			<tr align="center" valign="middle">
			  <!-- BEGIN smilies_col -->
				  <td><img src="{smilies_row.smilies_col.SMILEY_IMG}" border="0" onmouseover="this.style.cursor='hand';" onclick="emoticon('{smilies_row.smilies_col.SMILEY_CODE}');" alt="{smilies_row.smilies_col.SMILEY_DESC}" title="{smilies_row.smilies_col.SMILEY_DESC}" /></td>
			  <!-- END smilies_col -->
			</tr>
			<!-- END smilies_row -->
			<!-- BEGIN switch_smilies_extra -->
			<tr align="center">
			  <td colspan="{S_SMILIES_COLSPAN}"><span class="nav"><a href="{U_MORE_SMILIES}" onclick="window.open('{U_MORE_SMILIES}', '_phpbbsmilies', 'HEIGHT=300,resizable=yes,scrollbars=yes,WIDTH=250');return false;" target="_phpbbsmilies" class="nav">{L_MORE_SMILIES}</a></span></td>
			</tr>
			<!-- END switch_smilies_extra -->
		  </table></td>
		</tr>
	  </table></td>
	  <td class="row2" valign="top"><table cellspacing="0" cellpadding="2" border="0">
		{BBC_DISPLAY_BOX}
		<tr>
			<td><textarea name="message" rows="10" cols="76" wrap="virtual" style="width:450px" tabindex="3" class="post" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);">{SIGNATURE}</textarea></td>
		</tr>
	  </table></td>
	</tr>
	<!-- BEGIN smiley_category -->
	<tr>
		<td class="row1" valign="top"><span class="gen">
		<b>{L_SMILEY_CATEGORIES}:</b></span>
		</td>
		<td class="row2"><table cellspacing="1" cellpadding="4" border="0">
		<tr> 
			<!-- BEGIN buttons -->
			<input {smiley_category.buttons.TYPE} name="_phpbbsmilies" {smiley_category.buttons.VALUE} onClick="window.open('{smiley_category.buttons.CAT_MORE_SMILIES}', '_phpbbsmilies', 'HEIGHT=300,resizable=yes,scrollbars=yes,WIDTH=410'); return false;" onMouseOver="helpline('{smiley_category.buttons.NAME}')" /> 
			<!-- END buttons -->
			<!-- BEGIN dropdown -->
			{smiley_category.dropdown.OPTIONS}
			<!-- END dropdown -->
		</tr>
		</table></td>
	</tr>
	<!-- END smiley_category -->
	<tr>
		<td class="catBottom" colspan="2" align="center">
	  <input type="submit" name="preview" value="{L_PREVIEW}" class="mainoption" />&nbsp;&nbsp;
    <input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
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
		<td class="row2" width="38%"><span class="gen">
			<input type="radio" name="{qpes.QP_VAR}" value="1"{qpes.QP_YES} /> {L_YES}&nbsp;
			<input type="radio" name="{qpes.QP_VAR}" value="0"{qpes.QP_NO} /> {L_NO}
		</span></td>
	</tr>
	<!-- END qpes -->
	<tr>
		<td class="catBottom" colspan="2" align="center">
    <input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
    <input type="reset" value="{L_RESET}" class="liteoption" />
    </td>
	</tr>

</table><table id="prefinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_PREFERENCES}</th>
	</tr>
	<!-- BEGIN override_public_view_mail_block -->
	<tr> 
	  <td class="row1"><span class="gen">{L_PUBLIC_VIEW_EMAIL}:</span></td>
	  <td class="row2" width="38%"> 
		<input type="radio" name="viewemail" value="1" {VIEW_EMAIL_YES} />
		<span class="gen">{L_YES}</span>&nbsp;&nbsp; 
		<input type="radio" name="viewemail" value="0" {VIEW_EMAIL_NO} />
		<span class="gen">{L_NO}</span></td>
	</tr>
	<!-- END override_public_view_mail_block -->
	<!-- BEGIN override_hide_online_block -->
	<tr> 
	  <td class="row1"><span class="gen">{L_HIDE_USER}:</span></td>
	  <td class="row2"> 
		<input type="radio" name="hideonline" value="1" {HIDE_USER_YES} />
		<span class="gen">{L_YES}</span>&nbsp;&nbsp; 
		<input type="radio" name="hideonline" value="0" {HIDE_USER_NO} />
		<span class="gen">{L_NO}</span></td>
	</tr>
	<!-- END override_hide_online_block -->
	<!-- BEGIN override_notify_on_reply_block -->
	<tr> 
	  <td class="row1"><span class="gen">{L_NOTIFY_ON_REPLY}:</span><br />
		<span class="gensmall">{L_NOTIFY_ON_REPLY_EXPLAIN}</span></td>
	  <td class="row2"> 
		<input type="radio" name="notifyreply" value="1" {NOTIFY_REPLY_YES} />
		<span class="gen">{L_YES}</span>&nbsp;&nbsp; 
		<input type="radio" name="notifyreply" value="0" {NOTIFY_REPLY_NO} />
		<span class="gen">{L_NO}</span></td>
	</tr>
	<!-- END override_notify_on_reply_block -->
	<!-- BEGIN override_notify_pm_block -->
	<tr> 
	  <td class="row1"><span class="gen">{L_NOTIFY_ON_PRIVMSG}:</span></td>
	  <td class="row2"> 
		<input type="radio" name="notifypm" value="1" {NOTIFY_PM_YES} />
		<span class="gen">{L_YES}</span>&nbsp;&nbsp; 
		<input type="radio" name="notifypm" value="0" {NOTIFY_PM_NO} />
		<span class="gen">{L_NO}</span></td>
	</tr>
	<!-- END override_notify_pm_block -->
	<!-- BEGIN override_popup_pm_block -->
	<tr>
	  <td class="row1"><span class="gen">{L_POPUP_ON_PRIVMSG}:</span><br />
    <span class="gensmall">{L_POPUP_ON_PRIVMSG_EXPLAIN}</span></td>
	  <td class="row2"> 
		<input type="radio" name="popup_pm" value="1" {POPUP_PM_YES} />
		<span class="gen">{L_YES}</span>&nbsp;&nbsp; 
		<input type="radio" name="popup_pm" value="0" {POPUP_PM_NO} />
		<span class="gen">{L_NO}</span></td>
	</tr>
	<!-- END override_popup_pm_block -->
	<!-- BEGIN override_notify_on_donation_block -->
	<tr>
	  <td class="row1"><span class="gen">{L_NOTIFY_DONATION}:</span><br />
		<span class="gensmall">{L_NOTIFY_DONATION_EXPLAIN}</span></td>
	  <td class="row2"> 
		<input type="radio" name="notifydonation" value="1" {NOTIFY_DONATION_YES} />
		<span class="gen">{L_YES}</span>&nbsp;&nbsp; 
		<input type="radio" name="notifydonation" value="0" {NOTIFY_DONATION_NO} />
		<span class="gen">{L_NO}</span></td>
	</tr>
	<!-- END override_notify_on_donation_block -->
	<!-- BEGIN override_always_add_signature_block -->
	<tr> 
	  <td class="row1"><span class="gen">{L_ALWAYS_ADD_SIGNATURE}:</span></td>
	  <td class="row2"> 
		<input type="radio" name="attachsig" value="1" {ALWAYS_ADD_SIGNATURE_YES} />
		<span class="gen">{L_YES}</span>&nbsp;&nbsp; 
		<input type="radio" name="attachsig" value="0" {ALWAYS_ADD_SIGNATURE_NO} />
		<span class="gen">{L_NO}</span></td>
	</tr>
	<!-- END override_always_add_signature_block -->
	<!-- BEGIN override_bbcode_block -->
	<tr> 
	  <td class="row1"><span class="gen">{L_ALWAYS_ALLOW_BBCODE}:</span></td>
	  <td class="row2"> 
		<input type="radio" name="allowbbcode" value="1" {ALWAYS_ALLOW_BBCODE_YES} />
		<span class="gen">{L_YES}</span>&nbsp;&nbsp; 
		<input type="radio" name="allowbbcode" value="0" {ALWAYS_ALLOW_BBCODE_NO} />
		<span class="gen">{L_NO}</span></td>
	</tr>
	<!-- END override_bbcode_block -->
	<!-- BEGIN override_html_block -->
	<tr> 
	  <td class="row1"><span class="gen">{L_ALWAYS_ALLOW_HTML}:</span></td>
	  <td class="row2"> 
		<input type="radio" name="allowhtml" value="1" {ALWAYS_ALLOW_HTML_YES} />
		<span class="gen">{L_YES}</span>&nbsp;&nbsp; 
		<input type="radio" name="allowhtml" value="0" {ALWAYS_ALLOW_HTML_NO} />
		<span class="gen">{L_NO}</span></td>
	</tr>
	<!-- END override_html_block -->
	<!-- BEGIN override_smilies_block -->
	<tr> 
	  <td class="row1"><span class="gen">{L_ALWAYS_ALLOW_SMILIES}:</span></td>
	  <td class="row2"> 
		<input type="radio" name="allowsmilies" value="1" {ALWAYS_ALLOW_SMILIES_YES} />
		<span class="gen">{L_YES}</span>&nbsp;&nbsp; 
		<input type="radio" name="allowsmilies" value="0" {ALWAYS_ALLOW_SMILIES_NO} />
		<span class="gen">{L_NO}</span></td>
	</tr>
	<!-- END override_smilies_block -->
	<!-- BEGIN override_language_block -->
	<tr> 
	  <td class="row1"><span class="gen">{L_BOARD_LANGUAGE}:</span></td>
	  <td class="row2"><span class="gensmall">{LANGUAGE_SELECT}</span></td>
	</tr>
	<!-- END override_language_block -->
	<!-- BEGIN override_board_style_block -->
	<tr> 
	  <td class="row1"><span class="gen">{L_BOARD_STYLE}:</span></td>
	  <td class="row2"><span class="gensmall">{STYLE_SELECT}</span></td>
	</tr>
	<!-- END override_board_style_block -->
	<!-- BEGIN override_time_mode_block -->
	<tr>
	  <td class="row1"><span class="gen">{L_TIMEZONE}:</span></td>
	  <td class="row2"><span class="gensmall">{TIMEZONE_SELECT}</span></td>
	</tr>
	<!-- END override_time_mode_block -->
	<!-- BEGIN override_date_format_block -->
	<tr> 
	  <td class="row1"><span class="gen">{L_DATE_FORMAT}:</span><br />
		<span class="gensmall">{L_DATE_FORMAT_EXPLAIN}</span></td>
	  <td class="row2"><span class="gen">
		<select name="dateoptions" id="dateoptions" onchange="if (this.value=='custom') { dE('custom_date',1); } else { dE('custom_date',-1); } if (this.value == 'custom') { document.getElementById('dateformat').value = '{A_DEFAULT_DATEFORMAT}'; } else { document.getElementById('dateformat').value = this.value; }">
			{S_DATEFORMAT_OPTIONS}
		</select>
		<div id="custom_date"{S_CUSTOM_DATEFORMAT}><input type="text" name="dateformat" id="dateformat" value="{DATE_FORMAT}" maxlength="30" class="post" style="margin-top: 3px;" /></div>
	  </span></td>
	</tr>
	<!-- END override_date_format_block -->
	<!-- BEGIN override_posts_per_page_block -->
	<tr>
	  <td class="row1"><span class="gen">{L_POSTS_PER_PAGE}:</span><br />
		<span class="gensmall">{L_POSTS_PER_PAGE_EXPLAIN}</span></td>
	  <td class="row2"> 
		<input type="text" name="postspp" style="width: 25px" value="{POSTS_PER_PAGE}" maxlength="3" class="post" />
	  </td>
	</tr>
	<!-- END override_posts_per_page_block -->
	<!-- BEGIN override_topics_per_page_block -->
	<tr>
	  <td class="row1"><span class="gen">{L_TOPICS_PER_PAGE}:</span><br />
		<span class="gensmall">{L_TOPICS_PER_PAGE_EXPLAIN}</span></td>
	  <td class="row2"> 
		<input type="text" name="topicspp" style="width: 25px" value="{TOPICS_PER_PAGE}" maxlength="3" class="post" />
	  </td>
	</tr>
	<!-- END override_topics_per_page_block -->
	<tr>
		<td class="catBottom" colspan="2" align="center">
    <input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
    <input type="reset" value="{L_RESET}" class="liteoption" />
    </td>
	</tr>
</table>

<!-- BEGIN switch_avatar_block -->
<table id="avatarinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_AVATAR_PANEL}</th>
	</tr>
	<tr> 
	  <td class="row2" colspan="2"><span class="gensmall">{L_AVATAR_EXPLAIN}</span></td>
	</tr>
	<!-- BEGIN switch_avatar_local_upload -->
	<tr> 
		<td class="row1"><span class="gen">{L_UPLOAD_AVATAR_FILE}:</span></td>
		<td class="row2" width="38%"><input type="hidden" name="MAX_FILE_SIZE" value="{AVATAR_SIZE}" /><input type="file" name="avatar" class="post" style="width:200px" /></td>
	</tr>
	<!-- END switch_avatar_local_upload -->
	<!-- BEGIN switch_avatar_remote_upload -->
	<tr> 
		<td class="row1"><span class="gen">{L_UPLOAD_AVATAR_URL}:</span><br /><span class="gensmall">{L_UPLOAD_AVATAR_URL_EXPLAIN}</span></td>
		<td class="row2"><input type="text" name="avatarurl" size="40" class="post" style="width:200px" /></td>
	</tr>
	<!-- END switch_avatar_remote_upload -->
	<!-- BEGIN switch_avatar_remote_link -->
	<tr> 
		<td class="row1"><span class="gen">{L_LINK_REMOTE_AVATAR}:</span><br /><span class="gensmall">{L_LINK_REMOTE_AVATAR_EXPLAIN}</span></td>
		<td class="row2"><input type="text" name="avatarremoteurl" size="40" class="post" style="width:200px" /></td>
	</tr>
	<!-- END switch_avatar_remote_link -->
	<!-- BEGIN switch_avatar_local_gallery -->
	<tr> 
		<td class="row1"><span class="gen">{L_AVATAR_GALLERY}:</span></td>
		<td class="row2"><input type="submit" name="avatargallery" value="{L_SHOW_GALLERY}" class="liteoption" /></td>
	</tr>
	<!-- END switch_avatar_local_gallery -->
<tr>
	<td class="catBottom" colspan="2" align="center" height="28">
  <input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
  <input type="reset" value="{L_RESET}" name="reset" class="liteoption" />
	</td>
</tr>
</table>
<!-- END switch_avatar_block -->

</td></tr></table>{S_HIDDEN_FIELDS}
</form>

<br clear="all" />
