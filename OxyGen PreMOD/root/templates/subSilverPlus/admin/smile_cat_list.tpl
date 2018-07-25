<script language="javascript" type="text/javascript">
<!--
	function editsmiley(url)
	{
		document.location.href = url + "&multi={MULTI_CATS}";
	}
//-->
</script>

<h1>{L_PAGE_TITLE}</h1>

<p><span class="gen">{L_PAGE_DESCRIPTION}</span></p>

<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thCornerL">{L_ORDER_NUM}</th>
		<th class="thTop">{L_CATEGORY_NAME}</th>
		<th class="thTop">{L_CATEGORY_DESC}</th>
		<th class="thTop">{L_SMILEY_COUNT}</th>
		<th class="thCornerR">{L_CATEGORY_OPTIONS}</th> 
	</tr>
	<!-- BEGIN smile_categories -->
	<tr> 
		<td class="{smile_categories.ROW_CLASS}" align="center"><span class="gen">{smile_categories.CATEGORY_NUM}</span></td>
		<td class="{smile_categories.ROW_CLASS}"><span class="gen">{smile_categories.CATEGORY_NAME}</span></td>
		<td width="55%" class="{smile_categories.ROW_CLASS}"><span class="gen">{smile_categories.CATEGORY_DESC}</span></td>
		<td class="{smile_categories.ROW_CLASS}" align="center"><span class="gen">{smile_categories.SMILEY_COUNT}</span></td>
		<td nowrap class="{smile_categories.ROW_CLASS}" align="center"><span class="gen"><a href="{smile_categories.CATEGORY_EDIT}">{L_EDIT}</a></span></td>
	</tr>
	<tr>
		<td class="{smile_categories.ROW_CLASS}" colspan="5" align="left"><span class="gen">{smile_categories.S_SMILEY_LIST}</span></td>
	</tr>
	<!-- END smile_categories -->
</table>
<br />
<div align="center"><span class="copyright"><a href="http://mods.afkamm.co.uk" target="blank" class="copyright">Smiley Categories MOD</a> &copy; 2004, 2005 Afkamm</span></div>
