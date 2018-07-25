<script language="JavaScript" type="text/javascript">
<!--
function checkForm(formObj)
{
	formErrors = false;    

	if (formObj.message.value.length < 2)
	{
		formErrors = "{L_EMPTY_MESSAGE_EMAIL}";
	}
	else if ( formObj.subject.value.length < 2)
	{
		formErrors = "{L_EMPTY_SUBJECT_EMAIL}";
	}

	if (formErrors)
	{
		alert(formErrors);
		return false;
	}
}
//-->
</script>

<form action="{S_POST_ACTION}" method="post" name="post" onSubmit="return checkForm(this)">
  {ERROR_BOX}
  <table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr>
	  <td class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></td>
	</tr>
  </table>
  <table class="forumline" width="100%" cellpadding="3" cellspacing="1" border="0">
	<tr>
	  <th class="thHead" colspan="2" height="25">{L_SEND_EMAIL_MSG}</th>
	</tr>
	<tr>
	  <td class="row1" width="22%"><b class="gen">{L_RECIPIENT}</b></td>
	  <td class="row2" width="78%"><b class="gen">{USERNAME}</b></td>
	</tr>
	<tr>
	  <td class="row1" width="22%"><b class="gen">{L_SUBJECT}</b></td>
	  <td class="row2" width="78%"><span class="gen">
		<input type="text" name="subject" size="45" maxlength="100" style="width:450px" tabindex="2" class="post" value="{SUBJECT}" />
	  </span></td>
	</tr>
	<tr>
	  <td class="row1" valign="top">
		<b class="gen">{L_MESSAGE_BODY}</b><br />
		<span class="gensmall">{L_MESSAGE_BODY_DESC}</span>
	  </td>
	  <td class="row2"><span class="gen">
		<textarea name="message" rows="25" cols="40" wrap="virtual" style="width:500px" tabindex="3" class="post">{MESSAGE}</textarea>
	  </span></td>
	</tr>
	<tr>
	  <td class="row1" valign="top"><b class="gen">{L_OPTIONS}</b></td>
	  <td class="row2"><table cellspacing="0" cellpadding="1" border="0">
		<tr>
		  <td><input type="checkbox" name="cc_email" value="1" checked="checked" /></td>
		  <td class="gen">{L_CC_EMAIL}</td>
		</tr>
	  </table></td>
	</tr>
	<tr>
	  <td class="catBottom" colspan="2" align="center" height="28">
		{S_HIDDEN_FIELDS}
		<input type="submit" tabindex="6" name="submit" class="mainoption" value="{L_SEND_EMAIL}" />
	  </td>
	</tr>
  </table>
</form>
<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr>
	<td valign="top" align="right">{JUMPBOX}</td>
  </tr>
</table>