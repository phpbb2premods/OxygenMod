{BBC_JS_BOX}

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
<tr>
	<td class="nav" align="left" valign="bottom">
	<span class="gensmall"><br />
	<a href="{U_INDEX}" class="nav">{L_INDEX}</a>
	</span>
	</td>
</tr>
</table>

<form action="{U_SHOUTBOX}" method="post" name="post">
{POST_PREVIEW_BOX}
{ERROR_BOX}

<table width="100%" height="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
<tr> 
	<th class="thHead" colspan="2" height="25"><b>{L_MSG}</b></th>
</tr>
<!-- BEGIN switch_username_select -->
<tr> 
	<td class="row1">
	<span class="gen"><b>{L_USERNAME}</b></span>
	</td>
	<td class="row2"><span class="genmed">
	<input type="text" class="post" tabindex="1" name="name" size="25" maxlength="25" value="{USERNAME}" /></span>
	</td>
</tr>
<!-- END switch_username_select -->
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
		<td>
			<textarea name="message" rows="6" cols="76" wrap="virtual" style="width:450px" tabindex="3" class="post" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);">{MESSAGE}</textarea>
		</td>
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
	<td class="row1" valign="top"><span class="gen">
	<b>{L_OPTIONS}</b></span><br /><span class="gensmall">{HTML_STATUS}<br />{BBCODE_STATUS}<br />{SMILIES_STATUS}</span>
	</td>
	<td class="row2"><table cellspacing="1" cellpadding="4" border="0">
	<!-- BEGIN switch_html_checkbox -->
	<tr> 
		<td> 
		<input type="checkbox" name="disable_html" {S_HTML_CHECKED} />
		</td>
		<td>
		<span class="gen">{L_DISABLE_HTML}</span>
		</td>
	</tr>
	<!-- END switch_html_checkbox -->
	<!-- BEGIN switch_bbcode_checkbox -->
	<tr> 
		<td> 
		<input type="checkbox" name="disable_bbcode" {S_BBCODE_CHECKED} />
		</td>
		<td>
		<span class="gen">{L_DISABLE_BBCODE}</span>
		</td>
	</tr>
	<!-- END switch_bbcode_checkbox -->
	<!-- BEGIN switch_smilies_checkbox -->
	<tr> 
		<td> 
		<input type="checkbox" name="disable_smilies" {S_SMILIES_CHECKED} />
		</td>
		<td>
		<span class="gen">{L_DISABLE_SMILIES}</span>
		</td>
	</tr>
	<!-- END switch_smilies_checkbox -->
	</table></td>
</tr>
<tr> 
	<td class="catBottom" colspan="2" align="center" height="28"> 
	{S_HIDDEN_FORM_FIELDS}
	<input type="submit" tabindex="5" name="refresh" class="mainoption" value="{L_SHOUT_REFRESH}" />&nbsp;
	<input type="submit" accesskey="s" tabindex="6" name="shout" class="mainoption" value="{L_SHOUT_SUBMIT}" />
	</td>
</tr>
</table>
</form>
<table width="100%" cellspacing="1" border="0" align="center" cellpadding="4">
<tr> 
	<td align="right" valign="bottom" class="gensmall"> 
	<span class="nav">{PAGINATION}</span>
	</td>
</tr>
</table>

<!--
Do not alter these lines!
// -->
<table border="0" cellpadding="4" cellspacing="1" align="center" width="100%">
<tr>
	<td align="center" valign="top">
	<span class="copyright">Powered by Malach &copy; 2005</span>
	<a href="http://www.phantasia-fr.com/" target="_phpbb" class="copyright">MiniChat 1.0.5</a>
	</td>
</tr>
</table>
<br class="nav" />

<!-- BEGIN shoutrow -->
<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
<tr>
	<th class="row1" width="160" height="26" nowrap="nowrap">{L_AUTHOR}</th>
	<th class="row1" nowrap="nowrap">{L_MSG}</th>
</tr>
<tr> 
	<td width="160" align="middle" valign="top" class="row1">
		<span class="name"><b>{shoutrow.SB_USERNAME}</b></span><br />
		<span class="postdetails">
		<br />{shoutrow.USER_RANK}<br />
		<br />{shoutrow.RANK_IMAGE}
		<br />{shoutrow.USER_AVATAR}<br />
		<br />{shoutrow.USER_JOINED}
		</span>
	</td>
	<td class="row1" width="100%" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="4">
	<tr>
		<td width="100%">
		<span class="postdetails">{L_POSTED}: {shoutrow.TIME}</span>
		</td>
		<td valign="top" align="right" nowrap="nowrap">
		{shoutrow.QUOTE_IMG}{shoutrow.EDIT_IMG}{shoutrow.CENSOR_IMG}{shoutrow.DELETE_IMG}{shoutrow.IP_IMG}
		</td>
	</tr>
	<tr> 
		<td colspan="2"><hr /></td>
	</tr>
	<tr>
		<td colspan="2">
		<span class="postbody">{shoutrow.SHOUT}{shoutrow.SIGNATURE}</span>
		</td>
	</tr>
	</table></td>
</tr>
<tr>
	<td class="row2" colspan="2" height="1"><img src="{I_SPACER}" alt="" width="1" height="1" /></td>
</tr>
</table>
<br class="nav" />
<!-- END shoutrow -->

<table width="100%" cellspacing="1" border="0" align="center" cellpadding="4">
<tr> 
	<td align="left" valign="top">
	<span class="gensmall">{S_TIMEZONE}</span>
	</td>
	<td align="right" valign="bottom"> 
	<span class="nav">{PAGINATION}</span>
	</td>
</tr>
</table>
