
<h1>{L_ATTRIBUTE_MANAGEMENT}</h1>

<p>{L_ATTRIBUTE_EXPLAIN}</p>

<span class="nav">{PAGINATION}</span>

<form method="post" action="{S_ATTRIBUTE_ACTION}"><table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
	<tr>
		<th class="thTop">&nbsp;{L_ATTRIBUTE}&nbsp;</th>
		<th class="thTop">&nbsp;{L_COLOR}&nbsp;</th>
		<th class="thTop">&nbsp;{L_PERMISSIONS}&nbsp;</th>
		<th class="thTop">&nbsp;{L_DATE_FORMAT}&nbsp;</th>
		<th class="thTop">&nbsp;{L_POSITION}&nbsp;</th>
		<th class="thTop">&nbsp;{L_ACTION}&nbsp;</th>
	</tr>
	<!-- BEGIN attribute -->
	<tr>
		<td class="{attribute.ROW_CLASS}" align="center">{attribute.ATTRIBUTE}</td>
		<td class="{attribute.ROW_CLASS}" align="center">{attribute.COLOR}</td>
		<td class="{attribute.ROW_CLASS}" align="center">{attribute.PERMISSIONS}</td>
		<td class="{attribute.ROW_CLASS}" align="center">{attribute.DATE_FORMAT}</td>
		<td class="{attribute.ROW_CLASS}" align="center">{attribute.POSITION}</td>
		<td class="{attribute.ROW_CLASS}" align="center" nowrap="nowrap"><table cellpadding="0" cellspacing="1" border="0">
		  <tr>
			<td><a href="{attribute.U_ATTRIBUTE_MOVEUP}" title="{L_MOVEUP}"><img src="{I_MOVEUP}" alt="{L_MOVEUP}" border="0" /></a></td>
			<td><a href="{attribute.U_ATTRIBUTE_EDIT}" title="{L_EDIT}"><img src="{I_EDIT}" alt="{L_EDIT}" border="0" /></a></td>
		  </tr>
		  <tr>
			<td><a href="{attribute.U_ATTRIBUTE_MOVEDW}" title="{L_MOVEDW}"><img src="{I_MOVEDW}" alt="{L_MOVEDW}" border="0" /></a></td>
			<td><a href="{attribute.U_ATTRIBUTE_DELETE}" title="{L_DELETE}"><img src="{I_DELETE}" alt="{L_DELETE}" border="0" /></a></td>
		  </tr>
		</table></td>
	</tr>
	<!-- END attribute -->
	<tr>
		<td class="catBottom" align="center" colspan="6">{S_HIDDEN_FIELDS}<span class="gensmall">
		<a href="{U_ATTRIBUTE_CREATE}" title="{L_CREATE}"><img src="{I_CREATE}" alt="{L_CREATE}" border="0" /></a>
		</span></td>
	</tr>
</table></form>
<br clear="all" />
