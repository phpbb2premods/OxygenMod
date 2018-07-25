{BBC_JS_BOX}

<!-- BEGIN privmsg_extensions -->
<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr>
	<td width="100%" valign="top" align="center"><table height="40" cellspacing="2" cellpadding="2" border="0">
	  <tr valign="middle"> 
		<td>{INBOX_IMG}</td>
		<td class="cattitle">{INBOX_LINK}&nbsp;</td>
		<td>{SENTBOX_IMG}</td>
		<td class="cattitle">{SENTBOX_LINK}&nbsp;</td>
		<td>{OUTBOX_IMG}</td>
		<td class="cattitle">{OUTBOX_LINK}&nbsp;</td>
		<td>{SAVEBOX_IMG}</td>
		<td class="cattitle">{SAVEBOX_LINK}&nbsp;</td>
	  </tr>
	</table></td>
  </tr>
</table>
<br class="nav" />
<!-- END privmsg_extensions -->

<form action="{S_POST_ACTION}" method="post" name="post" onsubmit="return checkForm(this)" {S_FORM_ENCTYPE}>
  {POST_PREVIEW_BOX}
  {ERROR_BOX}
  <table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr>
	  <td class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a>
		<!-- BEGIN switch_not_privmsg --> 
		&raquo; <a href="{U_CAT}" class="nav">{CAT_NAME}</a>
		<!-- IF PARENT_FORUM --> &raquo; <a class="nav" href="{U_VIEW_PARENT_FORUM}">{PARENT_FORUM_NAME}</a> <!-- ENDIF -->
		&raquo; <a href="{U_VIEW_FORUM}" class="nav">{FORUM_NAME}</a>
		<!-- END switch_not_privmsg -->
	  </td>
	</tr>
  </table>

  <table class="forumline" width="100%" cellpadding="3" cellspacing="1" border="0">
	<tr>
	  <th class="thHead" colspan="2" height="25">{L_POST_A}</th>
	</tr>
	<!-- BEGIN switch_username_select -->
	<tr>
	  <td class="row1"><b class="gen">{L_USERNAME}</b></td>
	  <td class="row2"><span class="genmed"><input type="text" class="post" tabindex="1" name="username" size="25" maxlength="25" value="{USERNAME}" /></span></td>
	</tr>
	<!-- END switch_username_select -->
	<!-- BEGIN switch_privmsg -->
	<tr>
	  <td class="row1"><b class="gen">{L_USERNAME}</b></td>
	  <td class="row2"><span class="genmed">
		<input type="text" class="post" name="username" maxlength="25" size="25" tabindex="1" value="{USERNAME}" />&nbsp;
		<input type="submit" name="usersubmit" value="{L_FIND_USERNAME}" class="liteoption" onClick="window.open('{U_SEARCH_USER}', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" />
	  </span></td>
	</tr>
	<!-- END switch_privmsg -->
	<tr>
	  <td class="row1" width="22%"><b class="gen">{L_SUBJECT}</b></td>
	  <td class="row2" width="78%"><span class="gen">
		<input type="text" name="subject" size="45" maxlength="60" style="width:450px" tabindex="2" class="post" value="{SUBJECT}" />
	  </span></td>
	</tr>
	<!-- BEGIN switch_sub_title -->
	<tr>
		<td class="row1" width="22%"><b class="gen">{L_SUB_TITLE}</b></td>
		<td class="row2" width="78%"><span class="gen">
		<input type="text" name="sub_title" size="45" maxlength="{SUB_TITLE_LENGTH}" style="width:450px;" tabindex="2" class="post" value="{SUB_TITLE}" />
		</span></td>
	</tr>
	<!-- END switch_sub_title -->
	<!-- BEGIN switch_icon_checkbox -->
	<tr>
		<td valign="top" class="row1"><span class="gen"><b>{L_ICON_TITLE}</b></td>
		<td class="row2">
			<table width="100%" border="0" cellspacing="0" cellpadding="2">
			<!-- BEGIN row -->
			<tr>
				<td nowrap="nowrap">
					<span class="gen">
						<!-- BEGIN cell -->
						<input type="radio" name="post_icon" value="{switch_icon_checkbox.row.cell.ICON_ID}"{switch_icon_checkbox.row.cell.ICON_CHECKED}>&nbsp;{switch_icon_checkbox.row.cell.ICON_IMG}&nbsp;&nbsp;
						<!-- END cell -->
					</span>
				</td>
			</tr>
			<!-- END row -->
			</table>
		</td>
	</tr>
	<!-- END switch_icon_checkbox -->
	<tr>
	  <td class="row1" valign="top"><table width="100%" cellspacing="0" cellpadding="1" border="0">
		<tr>
		  <td><b class="gen">{L_MESSAGE_BODY}</b></td>
		</tr>
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
			<td><textarea name="message" rows="15" cols="76" wrap="virtual" style="width:450px" tabindex="3" class="post" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);">{MESSAGE}</textarea></td>
		</tr>
	  </table></td>
	</tr>
	<!-- BEGIN smiley_category -->
	<tr>
	  <td class="row1" valign="top">
		<b class="gen">{L_SMILEY_CATEGORIES}</b>
	  </td>
	  <td class="row2"><table cellspacing="0" cellpadding="1" border="0">
		<tr>
			<td valign="middle">
			<!-- BEGIN buttons -->
			<input {smiley_category.buttons.TYPE} name="_phpbbsmilies" {smiley_category.buttons.VALUE} onClick="window.open('{smiley_category.buttons.CAT_MORE_SMILIES}', '_phpbbsmilies', 'HEIGHT=300,resizable=yes,scrollbars=yes,WIDTH=410'); return false;" onMouseOver="helpline('{smiley_category.buttons.NAME}')" /> 
			<!-- END buttons -->
			<!-- BEGIN dropdown -->
			{smiley_category.dropdown.OPTIONS}
			<!-- END dropdown -->
			</td>
		</tr>
	  </table></td>
	</tr>
	<!-- END smiley_category -->
	<tr>
	  <td class="row1" valign="top">
		<b class="gen">{L_OPTIONS}</b><br />
		<span class="gensmall">{HTML_STATUS}<br />{BBCODE_STATUS}<br />{SMILIES_STATUS}</span>
	  </td>
	  <td class="row2"><table cellspacing="0" cellpadding="1" border="0">
		<!-- BEGIN switch_html_checkbox -->
		<tr>
		  <td><input type="checkbox" name="disable_html" {S_HTML_CHECKED} /></td>
		  <td><span class="gen">{L_DISABLE_HTML}</span></td>
		</tr>
		<!-- END switch_html_checkbox -->
		<!-- BEGIN switch_bbcode_checkbox -->
		<tr>
		  <td><input type="checkbox" name="disable_bbcode" {S_BBCODE_CHECKED} /></td>
		  <td><span class="gen">{L_DISABLE_BBCODE}</span></td>
		</tr>
		<!-- END switch_bbcode_checkbox -->
		<!-- BEGIN switch_smilies_checkbox -->
		<tr>
		  <td><input type="checkbox" name="disable_smilies" {S_SMILIES_CHECKED} /></td>
		  <td><span class="gen">{L_DISABLE_SMILIES}</span></td>
		</tr>
		<!-- END switch_smilies_checkbox -->
		<!-- BEGIN switch_signature_checkbox -->
		<tr>
		  <td><input type="checkbox" name="attach_sig" {S_SIGNATURE_CHECKED} /></td>
		  <td><span class="gen">{L_ATTACH_SIGNATURE}</span></td>
		</tr>
		<!-- END switch_signature_checkbox -->
		<!-- BEGIN switch_notify_checkbox -->
		<tr>
		  <td><input type="checkbox" name="notify" {S_NOTIFY_CHECKED} /></td>
		  <td><span class="gen">{L_NOTIFY_ON_REPLY}</span></td>
		</tr>
		<!-- END switch_notify_checkbox -->
		<!-- BEGIN switch_delete_checkbox -->
		<tr>
		  <td><input type="checkbox" name="delete" /></td>
		  <td><span class="gen">{L_DELETE_POST}</span></td>
		</tr>
		<!-- END switch_delete_checkbox -->
		<!-- BEGIN switch_lock_checkbox --> 
		<tr> 
			<td><input type="checkbox" name="lock_status" {S_LOCKED_BOX} /></td> 
			<td><span class="gen">{L_LOCK_MSG}</span></td> 
		</tr> 
		<!-- END switch_lock_checkbox -->
		<!-- BEGIN switch_type_toggle -->
		<tr>
		  <td><span class="gen">&nbsp;</span></td>
		  <td><span class="gen">{S_TYPE_TOGGLE}</span></td>
		</tr>
		<!-- END switch_type_toggle -->
	  </table></td>
	</tr>
	{ATTACHBOX}
	{EXT_HOSTBOX}
	{POLLBOX}
	<tr>
	  <td class="catBottom" colspan="2" align="center" height="28">
	  	{S_HIDDEN_FORM_FIELDS}
	  	<input type="submit" tabindex="5" name="preview" class="mainoption" value="{L_PREVIEW}" />&nbsp;
	  	<input type="submit" accesskey="s" tabindex="6" name="post" class="mainoption" value="{L_SUBMIT}" />
	  </td>
	</tr>
  </table>
</form>
<table width="100%" cellspacing="2" cellpadding="0" border="0">
  <tr>
	<td valign="top" align="right">{JUMPBOX}</td>
  </tr>
</table>

{TOPIC_REVIEW_BOX}
