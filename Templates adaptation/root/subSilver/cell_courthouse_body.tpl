<form action="{S_COURTHOUSE_ACTION}" method="post">
<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center">
	<tr> 
		<td align="left"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a href="{U_COURTHOUSE}" class="nav">{L_COURTHOUSE}</a></span></td>
		<!-- BEGIN cell_user -->
		<td align="right" nowrap="nowrap"><span class="genmed">{L_SELECT_SORT_METHOD}:&nbsp;{S_MODE_SELECT}&nbsp;&nbsp;{L_ORDER}&nbsp;{S_ORDER_SELECT}&nbsp;&nbsp; 
		<input type="submit" name="list" value="{L_SUBMIT}" class="liteoption" />
		<!-- END cell_user -->
		</span></td>
	</tr>
  </table>

<table width="100%" cellpadding="1" cellspacing="1" border="0" class="forumline" align="center">
	<!-- BEGIN cell_user -->
	<tr>  
		<th class="thTop" nowrap="nowrap" height="25">{L_USERNAME}</th>
		<th class="thTop" nowrap="nowrap">{L_SLEDGE}</th>
		<th class="thTop" nowrap="nowrap">{L_IMPRISONED_TIME}</th>
		<th class="thTop" nowrap="nowrap">{L_PUNISHMENT}</th>
		<th class="thTop" nowrap="nowrap">{L_JUDGEMENT}</th>
	</tr>
	<!-- BEGIN cell_users -->
	<tr> 
		<td class="{cell_user.cell_users.ROW_CLASS}" align="center"><span class="gen"><b>{cell_user.cell_users.USERNAME}</b></td>
		<td class="{cell_user.cell_users.ROW_CLASS}" align="center"><span class="gen">{cell_user.cell_users.SLEDGE}&nbsp;{L_POINTS}</span></td>
		<td class="{cell_user.cell_users.ROW_CLASS}" align="center"><span class="gensmall">{cell_user.cell_users.TIME}</span></td>
		<td class="{cell_user.cell_users.ROW_CLASS}" align="center"><span class="gensmall">{cell_user.cell_users.PUNISHMENT}</span></td>
		<td class="{cell_user.cell_users.ROW_CLASS}" align="center"><a href="{cell_user.cell_users.U_JUDGEMENT}">{cell_user.cell_users.JUDGEMENT_IMG}</a></td>
	</tr>
	<!-- END cell_users -->
	<!-- END cell_user -->
	<!-- BEGIN cell_no_users -->
	<tr>
		<th align="center" colspan="5">{L_NO_CELLED}</th>
	</tr>
	<!-- END cell_no_users -->
</table>

<!-- BEGIN cell_user -->
<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
	<tr> 
		<td align="right" valign="top"></td>
	</tr>
</table>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr> 
		<td><span class="nav">{PAGE_NUMBER}</span></td>
		<td align="right"><span class="nav">{PAGINATION}</span></td>
	</tr>
</table>
<!-- END cell_user -->

<br clear="all" />
<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
	<tr> 
		<td align="center" ><input type="submit" name="celled_list" value="{L_CELLED_LIST}" class="liteoption" /></td>
	</tr>
</table>

</form>



