<form method="post" action="{S_MODE_ACTION}">
  <table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr>
	  <td class="nav">
		<a href="#bot" class="nav"><img alt="" src="{I_ARROW_DN}" class="absbottom" border="0" /></a>
		<a href="{U_INDEX}" class="nav">{L_INDEX}</a> &raquo; <a href="{U_MEMBERLIST}" class="nav">{L_MEMBERLIST}</a>
	  </td>
		<td colspan="2" align="right" nowrap="nowrap"><span class="genmed">{L_SORT_PER_LETTER}:&nbsp;{S_LETTER_SELECT}{S_LETTER_HIDDEN}</span></td>
	</tr>
  </table>
  <table class="forumline" width="100%" cellpadding="3" cellspacing="1" border="0">
	<tr>
	  <th height="25" class="thCornerL" nowrap="nowrap">#</th>
	  <th class="thTop" nowrap="nowrap">&nbsp;</th>
	  <th class="thTop" nowrap="nowrap">{L_ONLINE_STATUS}</th>
	  <th class="thTop" nowrap="nowrap">{L_USERNAME}</th>
	  <th class="thTop" nowrap="nowrap">{L_COUNTRY}</th>
	  <th class="thTop" nowrap="nowrap">{L_EMAIL}</th>
	  <th class="thTop" nowrap="nowrap">{L_FROM}</th>
	  <th class="thTop" nowrap="nowrap">{L_JOINED}</th>
	  <th class="thTop" nowrap="nowrap">{L_VISITED}</th>
	  <th class="thTop" nowrap="nowrap">{L_POSTS}</th>
	  <th class="thTop" nowrap="nowrap">{L_TOPICS}</th>
		<th class="thTop" nowrap="nowrap">{L_POINTS}</th>
	  <th class="thCornerR" nowrap="nowrap">{L_WEBSITE}</th>
	</tr>
	<!-- BEGIN memberrow -->
	<tr>
	  <td class="{memberrow.ROW_CLASS}" align="center"><span class="gen">&nbsp;{memberrow.ROW_NUMBER}&nbsp;</span></td>
	  <td class="{memberrow.ROW_CLASS}" align="center">&nbsp;{memberrow.PM_IMG}&nbsp;</td>
	  <td class="{memberrow.ROW_CLASS}" align="center" valign="middle"><span class="gen">{memberrow.ONLINE_STATUS_IMG}</span></td>
		<td class="{memberrow.ROW_CLASS}" align="center"><span class="gen"><a href="{memberrow.U_VIEWPROFILE}" alt="{memberrow.L_VIEWPROFILE}" title="{memberrow.L_VIEWPROFILE}"{memberrow.STYLE}>{memberrow.USERNAME}</a></span></td>
		<td class="{memberrow.ROW_CLASS}" align="center"> <img src="images/flags/{memberrow.FLAG}.png" width="18" height="12" title="{memberrow.COUNTRY}" /> </td>
	  <td class="{memberrow.ROW_CLASS}" align="center" valign="middle">&nbsp;{memberrow.EMAIL_IMG}&nbsp;</td>
	  <td class="{memberrow.ROW_CLASS}" align="center" valign="middle"><span class="gen">{memberrow.FROM}</span></td>
	  <td class="{memberrow.ROW_CLASS}" align="center" valign="middle"><span class="gensmall">{memberrow.JOINED}</span></td>
	  <td class="{memberrow.ROW_CLASS}" align="center" valign="middle"><span class="gensmall">{memberrow.VISITED}</span></td>
	  <td class="{memberrow.ROW_CLASS}" align="center" valign="middle"><span class="gen">{memberrow.POSTS}</span></td>
	  <td class="{memberrow.ROW_CLASS}" align="center" valign="middle"><span class="gen">{memberrow.TOPICS}</span></td>
	  <td class="{memberrow.ROW_CLASS}" align="center" valign="middle"><span class="gen">{memberrow.POINTS}</span></td>
	  <td class="{memberrow.ROW_CLASS}" align="center">&nbsp;{memberrow.WWW_IMG}&nbsp;</td>
	</tr>
	<!-- END memberrow -->
	<tr>
	  <td class="catBottom" colspan="13" height="28" align="center"><span class="genmed">
	  	{L_SELECT_SORT_METHOD}:&nbsp;{S_MODE_SELECT}&nbsp;{L_ORDER}&nbsp;{S_ORDER_SELECT}&nbsp;
		<input type="submit" name="submit" value="{L_SUBMIT}" class="liteoption" />
	  </span></td>
	</tr>
  </table>

  <table width="100%" cellspacing="2" cellpadding="0" border="0">
	<tr>
	  <td valign="middle"><span class="nav">
	  	<a href="#top" class="nav"><img alt="" src="{I_ARROW_UP}" border="0" /></a>
	  	{PAGE_NUMBER}
	  </span></td>
	  <td valign="middle" align="right"><span class="nav">{PAGINATION}</span></td>
	</tr>
  </table>
</form>
<table width="100%" cellspacing="2" border="0">
  <tr>
	<td valign="top" align="right">{JUMPBOX}</td>
  </tr>
</table>
