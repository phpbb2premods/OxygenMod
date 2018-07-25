<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
<tr> 
	<td align="left" valign="bottom">
	<span class="nav">
	<a href="{U_INDEX}" class="nav">{L_INDEX}</a>
	</span>
	</td>
</tr>
</table>

<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0" class="forumline">
<form action="{U_SHOUTBOX}" method="post" name="post" onsubmit="return checkForm(this)">
<tr>
	<td class="catBottom" colspan="2" align="center" height="28">
	{S_HIDDEN_FORM_FIELDS}<input type="submit" tabindex="1" name="refresh" class="mainoption" value="{L_SHOUT_REFRESH}" />&nbsp;
	</td>
</tr>
</form>
</table>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
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
	<span class="copyright"> Powered by Malach &copy; 2005 </span>
	<a href="http://www.phantasia-fr.com/" target="_phpbb" class="copyright">MiniChat 1.0.5</a>
	</td>
</tr>
</table>
<br class="nav" />

<!-- BEGIN shoutrow -->
<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
<tr>
	<th class="thLeft" width="160" height="26" nowrap="nowrap">{L_AUTHOR}</th>
	<th class="thRight" nowrap="nowrap">{L_MSG}</th>
</tr>
<tr> 
	<td width="160" align="middle" valign="top" class="row1">
	<span class="name"><b>{shoutrow.SB_USERNAME}</b></span><br /><span class="postdetails">
	<br />{shoutrow.USER_RANK}<br />
	<br />{shoutrow.RANK_IMAGE}
	<br />{shoutrow.USER_AVATAR}<br />
	<br />{shoutrow.USER_JOINED}
	</span>
	</td>
	<td class="row1" width="100%" height="28" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="4">
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

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
<tr> 
	<td align="left" valign="top">
	<span class="gensmall">{S_TIMEZONE}</span>
	</td>
	<td align="right" valign="bottom"> 
	<span class="nav">{PAGINATION}</span>
	</td>
</tr>
</table>
