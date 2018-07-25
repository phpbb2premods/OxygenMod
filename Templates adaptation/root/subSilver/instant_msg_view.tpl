<link rel="stylesheet" href="templates/{T_THEME_NAME}/{T_HEAD_STYLESHEET}" type="text/css">

<table width="100%" border="0" cellspacing="2" cellpadding="4">
	<form name="form1" method="post" action="{U_ACTION}">
	<!-- BEGIN Switch_MSG_Read -->
	<tr>
	<td align="right" class="row2"><b class="genmed">{L_AUTHOR}</b></td>
	<td class="row2"><b class="genmed">{SENDER}</b></td>
	</tr>
	<tr>
	<td align="right" class="row2" width="25%"><b class="genmed">{L_DATE}</b></td>
	<td class="row2"><b class="genmed">{DATE}</b></td>
	</tr>
	<tr>
	<table width="100%" border="0" cellspacing="2" cellpadding="4">
	<tr>
	<td class="row2" width="100%"><span class="posbody">{L_MESSAGE}</span></td>
	</tr>
	</table>
	</tr>
	<tr>
	<td colspan="2" align="center"><input class="mainoption" type="submit" name="reply" value="{L_REPLY}"></td>
	</tr>
	<!-- END Switch_MSG_Read -->
</table>
<!-- BEGIN Switch_Msg_Send -->
<table width="100%" border="0" cellspacing="2" cellpadding="4">	 
	<tr> 
	<th class="thHead" colspan="2" height="25">{L_DEST}</th>
	</tr>
	<tr>
	<td width="100%"><div align="center">
	<textarea name="message" cols="40" rows="8" id="message">{L_YOUR_MESSAGE}</textarea>
	</div></td>
	</tr>
	<tr> 
	<td colspan="2" align="center"><input class="mainoption" type="submit" name="send" value="{L_SEND}"></td>
	</tr>
<!-- END Switch_Msg_Send -->
	<input name="msg_sender" type="hidden" value="{N_SENDER}">
	<input name="msg_dest" type="hidden" value="{N_DEST}">
	</form>
	{MESSAGE}
</table>
