<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr>
	<td class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></td>
  </tr>
</table>

<table class="forumline" width="100%" cellpadding="4" cellspacing="1" border="0">
  <tr>
	<th class="thCornerL" width="35%" height="25">&nbsp;{L_USERNAME}&nbsp;</th>
	<th class="thTop" width="25%">&nbsp;{L_LAST_UPDATE}&nbsp;</th>
	<th class="thCornerR" width="40%">&nbsp;{L_FORUM_LOCATION}&nbsp;</th>
  </tr>
  <tr>
	<td class="catSides" colspan="3" height="28"><b class="cattitle">{TOTAL_REGISTERED_USERS_ONLINE}</b></td>
  </tr>
  <!-- BEGIN reg_user_row -->
  <tr>
	<td class="{reg_user_row.ROW_CLASS}" width="35%"><span class="gen"><img width="18" height="12" border="0" src="images/flags/{reg_user_row.FLAG}.png" alt="{reg_user_row.COUNTRY}" title="{reg_user_row.COUNTRY}" />&nbsp;<a href="{reg_user_row.U_USER_PROFILE}"{reg_user_row.STYLE} title="{reg_user_row.L_VIEWPROFILE}">{reg_user_row.USERNAME}</a></span></td>
	<td class="{reg_user_row.ROW_CLASS}" width="25%" align="center" nowrap="nowrap"><span class="gen">{reg_user_row.LASTUPDATE}</span></td>
	<td class="{reg_user_row.ROW_CLASS}" width="40%"><span class="gen"><a href="{reg_user_row.U_FORUM_LOCATION}" class="gen">{reg_user_row.FORUM_LOCATION}</a></span></td>
  </tr>
  <!-- END reg_user_row -->
  <tr>
	<td class="row3" colspan="3" height="1"><img src="{I_SPACER}" alt="" width="1" height="1" /></td>
  </tr>
  <tr>
	<td class="catSides" colspan="3" height="28"><b class="cattitle">{TOTAL_GUEST_USERS_ONLINE}</b></td>
  </tr>
  <!-- BEGIN guest_user_row -->
  <tr>
	<td class="{guest_user_row.ROW_CLASS}" width="35%"><span class="gen"><img width="18" height="12" border="0" src="images/flags/{guest_user_row.FLAG}.png" alt="{guest_user_row.COUNTRY}" title="{guest_user_row.COUNTRY}" />&nbsp;{guest_user_row.USERNAME}</span></td>
	<td class="{guest_user_row.ROW_CLASS}" width="25%" align="center" nowrap="nowrap"><span class="gen">{guest_user_row.LASTUPDATE}</span></td>
	<td class="{guest_user_row.ROW_CLASS}" width="40%"><span class="gen"><a href="{guest_user_row.U_FORUM_LOCATION}" class="gen">{guest_user_row.FORUM_LOCATION}</a></span></td>
  </tr>
  <!-- END guest_user_row -->
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr>
	<td class="gensmall" align="left" valign="top">{L_ONLINE_EXPLAIN}</td>
	<td class="gensmall" align="right" valign="top">{S_TIMEZONE}</td>
  </tr>
</table>

<table width="100%" cellspacing="2" cellpadding="0" border="0">
  <tr>
	<td valign="top" align="right">{JUMPBOX}</td>
  </tr>
</table>
