<form action="{S_LOGIN_ACTION}" method="post" target="_top">
  <table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr>
	  <td class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></td>
	</tr>
  </table>

  <table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
	<tr>
	  <th height="25" class="thHead" nowrap="nowrap">{L_ENTER_PASSWORD}</th>
	</tr>
	<tr>
	  <td class="row1"><table width="100%" cellpadding="3" cellspacing="1" border="0">
		<tr>
		  <td width="45%" align="right"><span class="gen"><label for="username">{L_USERNAME}: </label></span></td>
		  <td><input class="post" id="username" name="username" type="text" size="25" maxlength="40" value="{USERNAME}" /></td>
		</tr>
		<tr>
		  <td align="right"><span class="gen"><label for="mdp">{L_PASSWORD}: </label></span></td>
		  <td><input class="post" id="mdp" maxlength="32" name="password" type="password" size="25" /></td>
		</tr>
		<!-- BEGIN switch_allow_autologin -->
		<tr align="center">
		  <td colspan="2"><span class="gen"><label for="autologin">{L_AUTO_LOGIN}</label>
		  <input class="text" id="autologin" name="autologin" type="checkbox" checked="checked" /></span></td>
		</tr>
		<!-- END switch_allow_autologin -->
		<tr align="center">
		  <td colspan="2">{S_HIDDEN_FIELDS}<input class="mainoption" name="login" type="submit" value="{L_LOGIN}" /></td>
		</tr>
		<tr align="center">
		  <td colspan="2"><span class="gensmall"><a href="{U_SEND_PASSWORD}" class="gensmall">{L_SEND_PASSWORD}</a></span></td>
		</tr>
	  </table></td>
	</tr>
  </table>
</form>
