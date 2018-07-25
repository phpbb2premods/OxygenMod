
<h1>{L_PAGE_TITLE}</h1>

<p><span class="gen">{L_PAGE_DESC}</span></p>

<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
	<tr>
		<th class="thTop">{L_HEADER1}</th>
		<th class="thTop">{L_HEADER2}</th>
		<th class="thTop">{L_HEADER3}</th>
		<th class="thTop">{L_HEADER4}</th>
	</tr>
	<tr>
		<td colspan="3" height="1" class="spaceRow"></td>
		<td class="row1" rowspan="{ROW_SPAN3}" valign="top">
			<table width="100%" border="0">
			{VIEWABLE_IN3}
			</table>
		</td>
	</tr>

	<!-- BEGIN catrow -->
	<tr>
		<td class="row3" colspan="2"><span class="cattitle"><b><a href="{catrow.U_VIEWCAT}">{catrow.CAT_DESC}</a></b></span></td>
		<td class="row3" rowspan="{catrow.ROW_SPAN2}" valign="top">
			<table width="100%" border="0">
			{catrow.VIEWABLE_IN2}
			</table>
		</td>
	</tr>
	<!-- BEGIN forumrow -->
	<tr>
		<td class="{catrow.forumrow.ROW_CLASS}" align="left" valign="top"><span class="gen"><a href="{catrow.forumrow.U_VIEWFORUM}" target="_new">{catrow.forumrow.FORUM_NAME}</a></span><br /><span class="gensmall">{catrow.forumrow.FORUM_DESC}</span></td>
		<td class="{catrow.forumrow.ROW_CLASS}" valign="top">
			<table width="100%" border="0">
			{catrow.forumrow.VIEWABLE_IN1}
			</table>
		</td>
	</tr>
	<!-- END forumrow -->
	<tr>
		<td colspan="3" height="1" class="spaceRow"></td>
	</tr>
	<!-- END catrow -->
</table>
<br />
<div align="center"><span class="copyright"><a href="http://mods.afkamm.co.uk" target="blank" class="copyright">Smiley Categories MOD</a> &copy; 2004, 2005 Afkamm</span></div>
