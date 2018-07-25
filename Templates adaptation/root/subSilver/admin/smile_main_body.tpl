<script language="JavaScript">
<!--

// Got the following code from a script at http://www.js-x.com/js/
var _A = new Array();
var _B = new Array();
var _C = new Array();
var _D = new Array();
var _E = new Array();
var _F = new Array();
var _G = new Array();
var _H = new Array();
var _I = new Array();
var _J = new Array();

{S_CAT_INFO}
function update()
{
	document.list.cat_name2.value = _A[document.list.cat.value];
	document.list.cat_desc2.value = _B[document.list.cat.value];
	document.list.cat_id.value = _C[document.list.cat.value];
	document.list.cat_view_perms2.value = _D[document.list.cat.value];
	document.list.cat_forum2.value = _E[document.list.cat.value];
	document.list.ordernum2.value = _C[document.list.cat.value];
	document.list.cat_icon2.value = _F[document.list.cat.value];
	document.list.cat_per_page2.value = _G[document.list.cat.value];
	document.list.popup_width2.value = _H[document.list.cat.value];
	document.list.popup_height2.value = _I[document.list.cat.value];
	document.list.popup_cols2.value = _J[document.list.cat.value];

	var smile_src = _F[document.list.cat.value];
	if( smile_src == '' )
	{
		var smile_src = "blank_icon.gif";
	}
	update_smiley2(smile_src);
}

function popupTest(url)
{
	var catid = document.list.cat_id.value.split("|");
	var winwidth = document.list.popup_width2.value;
	var winheight = document.list.popup_height2.value;
	var wincol = document.list.popup_cols2.value;
	var perpage = document.list.cat_per_page2.value;

	if( catid[0] )
	{
		window.open(url + "&cat=" + catid[1] + "&col=" + wincol + "&width=" + winwidth + "&height=" + winheight + "&perp=" + perpage, "_phpbbsmilies", "HEIGHT=" + winheight + ",resizable=yes,scrollbars=yes,WIDTH=" + winwidth);
	}
	else
	{
		alert('{L_POPUP_ALERT}');
	}
}

function unlock()
{
	eval("document.list.ordernum1.disabled = false");
}

function lock()
{
	eval("document.list.ordernum1.disabled = true");
}

function unlockdrop(filename)
{
	var exten = filename.split(".");

	if( exten[1] == 'pak' )
	{
		eval("document.importexport.import_cat.disabled = false");
	}
	else
	{
		eval("document.importexport.import_cat.disabled = true");
	}
}

function update_smiley1(newimage)
{
	document.smiley_image1.src = "{S_SMILEY_BASEDIR}/" + newimage;
}

function update_smiley2(newimage)
{
	document.smiley_image2.src = "{S_SMILEY_BASEDIR}/" + newimage;
}

// -->
</script>

<h1>{L_SMILEY_TITLE}</h1>

<p><span class="gen">{L_SMILEY_TEXT}</span></p>

<table cellspacing="1" cellpadding="4" border="0" width="100%" class="forumline">
<form action="{S_SMILEY_CAT_ACTION}" method="post" name="list">
	<tr>
		<th width="50%" colspan="2" class="thTop">{L_ADD}</th>
		<th width="50%" colspan="2" class="thTop">{L_EDIT}</th>
	</tr>
	<tr>
		<td colspan="2" rowspan=2" valign="top" class="row2"><span class="genmed">{L_ADD_DESC}</span></td>
		<td colspan="2" valign="top" class="row2"><span class="genmed">{L_EDIT_DESC}</span></td>
	</tr>
	<tr>
		<td class="row1"><span class="genmed">{L_SELECT_CAT}</span></td>
		<td class="row1"><select name="cat" onChange="update()"><option value="0">--</option>{S_CAT_EDIT}</select></td>
	</tr>
	<tr>
		<td class="row1"><span class="genmed">{L_CAT_NAME}<span style="color: red;">*</span></span></td>
		<td class="row1"><input class="post" type="text" name="cat_name1" value="" size="25" /></td>
		<td class="row1"><span class="genmed">{L_CAT_NAME}<span style="color: red;">*</span></span></td>
		<td class="row1"><input class="post" type="text" name="cat_name2" size="25" /></td>
	</tr>
	<tr>
		<td class="row1" nowrap="nowrap"><span class="genmed">{L_CAT_DESC}<span style="color: red;">*</span></span></td>
		<td class="row1"><input class="post" type="text" name="cat_desc1" value="" size="25" /></td>
		<td class="row1" nowrap="nowrap"><span class="genmed">{L_CAT_DESC}<span style="color: red;">*</span></span></td>
		<td class="row1"><input class="post" type="text" name="cat_desc2" size="25" /></td>
	</tr>
	<tr>
		<td class="row1"><span class="genmed">{L_PER_PAGE}</span></td>
		<td class="row1"><input class="post" type="text" name="cat_per_page1" value="0" size="3" maxlength="3" />&nbsp;<span class="gensmall">{L_PER_PAGE_LIMIT}</span></td>
		<td class="row1"><span class="genmed">{L_PER_PAGE}</span></td>
		<td class="row1"><input class="post" type="text" name="cat_per_page2" size="3" maxlength="3" />&nbsp;<span class="gensmall">{L_PER_PAGE_LIMIT}</span></td>
	</tr>
	<tr>
		<td class="row1" nowrap="nowrap"><span class="genmed">{L_POPUP_COLS}</span></td>
		<td class="row1"><input class="post" type="text" name="popup_cols1" value="9" size="3" maxlength="2" /></td>
		<td class="row1" nowrap="nowrap"><span class="genmed">{L_POPUP_COLS}</span></td>
		<td class="row1"><input class="post" type="text" name="popup_cols2" size="3" maxlength="2" /></td>
	</tr>
	<tr> 
		<td class="row1"><span class="genmed">{L_POPUP_SIZE}</span></td>
		<td class="row1"><span class="gensmall"><input class="post" type="text" name="popup_width1" value="410" size="3" maxlength="3" /><b>&nbsp;{L_POPUP_X}&nbsp;</b><input class="post" type="text" name="popup_height1" value="300" size="3" maxlength="3" />&nbsp;{L_POPUP_SIZE_ATTRIBS}</span></td>
		<td class="row1"><span class="genmed"><a href="javascript:popupTest('{U_MORE_SMILIES}');" onClick="popupTest('{U_MORE_SMILIES}');" title="{L_POPUP_TEST}">{L_POPUP_SIZE}</a></span></td>
		<td class="row1"><span class="gensmall"><input class="post" type="text" name="popup_width2" size="3" maxlength="3" /><b>&nbsp;{L_POPUP_X}&nbsp;</b><input class="post" type="text" name="popup_height2" size="3" maxlength="3" />&nbsp;{L_POPUP_SIZE_ATTRIBS}</span></td>
	</tr>
	<tr>
		<td class="row1"><span class="genmed">{L_VIEWABLE_BY}</span></td>
		<td class="row1"><select name="cat_view_perms1"><option value="5">{L_PERMS0}</option><option value="1">{L_PERMS1}</option><option value="2">{L_PERMS2}</option><option value="3">{L_PERMS3}</option><option value="4">{L_PERMS4}</option></select></td>
		<td class="row1"><span class="genmed">{L_VIEWABLE_BY}</span></td>
		<td class="row1"><select name="cat_view_perms2"><option value="-1">--</option><option value="5">{L_PERMS0}</option><option value="1">{L_PERMS1}</option><option value="2">{L_PERMS2}</option><option value="3">{L_PERMS3}</option><option value="4">{L_PERMS4}</option></select></td>
	</tr>
	<tr> 
		<td class="row1"><span class="genmed">{L_VIEWABLE_IN}</span></td>
		<td class="row1"><select name="cat_forum1">{S_CAT_FORUM}</select></td>
		<td class="row1"><span class="genmed"><a href="{U_FORUM_PERMS}">{L_VIEWABLE_IN}</a></span></td>
		<td class="row1"><select name="cat_forum2"><option value="-1|-1">--</option>{S_CAT_FORUM}</select></td>
	</tr>
	<tr> 
		<td class="row1"><span class="genmed">{L_ORDER}</span></td>
		<td class="row1"><span class="genmed"><input type="radio" name="order1" value="first" onClick="lock()" />{L_FIRST}<input type="radio" name="order1" value="last" onClick="lock()" checked="checked" />{L_LAST}<input type="radio" name="order1" value="after" onClick="unlock()" />{L_AFTER}&nbsp;&nbsp;&nbsp;<select name="ordernum1" disabled="disabled">{S_CAT_ORDER}</select></span></td>
		<td class="row1"><span class="genmed">{L_ORDER}</span></td>
		<td class="row1"><span class="genmed"><select name="ordernum2"><option value="-1">--</option>{S_CAT_ORDER}</select>&nbsp;{L_ORDER_CHANGE}</span></td>
	</tr>
	<tr> 
		<td class="row1"><span class="genmed">{L_CAT_ICON}</span></td>
		<td class="row1"><select name="cat_icon1" onchange="update_smiley1(this.options[selectedIndex].value);">{S_CAT_ICON2}</select>&nbsp;<img name="smiley_image1" src="{SMILEY_IMG}" border="0" alt="" />&nbsp;</td>
		<td class="row1"><span class="genmed">{L_CAT_ICON}</span></td>
		<td class="row1"><select name="cat_icon2" onchange="update_smiley2(this.options[selectedIndex].value);"><option value="blank_icon.gif">--</option>{S_CAT_ICON1}</select>&nbsp;<img name="smiley_image2" src="{SMILEY_IMG}" border="0" alt="" />&nbsp;</td>
	</tr>
	<tr> 
		<td colspan="2" class="row1">&nbsp;</td>
		<td colspan="2" align="center" class="row1"><span class="genmed">{L_EDIT_DELETE}<input type="checkbox" value="1" name="delete" class="post" /></span></td>
	</tr>
	<tr>
		<td colspan="2" align="center" class="catBottom"><input type="submit" value="{L_SUBMIT}" name="cat_add" class="mainoption" /></td>
		<td colspan="2" align="center" class="catBottom">{S_HIDDEN_FIELDS3}<input type="submit" value="{L_SUBMIT}" name="cat_edit" class="mainoption" /></td>
	</tr>
</form>

<form action="{S_SMILEY_CAT_ACTION}" method="post" name="importexport">
	<tr>
		<th class="thTop" width="50%" colspan="2">{L_SMILEY_IMPORT}</th>
		<th class="thTop" width="50%" colspan="2">{L_SMILEY_EXPORT}</th>
	</tr>
	<tr>
		<td class="row2" valign="top" colspan="2"><span class="genmed">{L_IMPORT_DESCRIPTION}</span></td>
		<td class="row2" valign="top" colspan="2"><span class="genmed">{L_EXPORT_DESCRIPTION}</span></td>
	</tr>
	<tr> 
		<td class="row1"><span class="genmed">{L_SELECT_PAK}</span></td>
		<td class="row1"><select name="smile_pak" onChange="unlockdrop(this.options[selectedIndex].value)">{S_CAT_PAK}</select></td>
		<td class="row1"><span class="genmed">{L_EXPORT_TYPE}</span></td>
		<td class="row1"><span class="genmed">&nbsp;<input type="radio" name="export_type" value="0" checked="checked" />&nbsp;{L_EXPORT_TYPE_PAK}<br />&nbsp;<input type="radio" name="export_type" value="1" />&nbsp;{L_EXPORT_TYPE_CAT}</span></td>
	</tr>
	<tr> 
		<td class="row1"><span class="genmed">{L_SELECT_IMPORT}<span style="color: red;">*</span></span></td>
		<td class="row1"><select name="import_cat" disabled="disabled">{S_CAT_IMPORT}</select></td>
		<td class="row1"><span class="genmed">{L_SELECT_EXPORT}</span></td>
		<td class="row1"><select name="export_cat">{S_CAT_EXPORT}</select></td>
	</tr>
	<tr> 
		<td class="row1"><span class="genmed">{L_DEL_EXISTING}<span style="color: red;">*</span></span></td>
		<td class="row1"><span class="genmed"><input type="radio" name="del_smiley" value="1" />{L_YES}&nbsp;&nbsp;<input type="radio" name="del_smiley" value="0" checked="checked" />{L_NO}</span></td>
		<td class="row1" colspan="2" rowspan="3">&nbsp;</td>
	</tr>
	<tr> 
		<td class="row1"><span class="genmed">{L_CONFLICTS}<span style="color: red;">*</span></span></td>
		<td class="row1"><span class="genmed">&nbsp;<input type="radio" name="replace" value="1" checked/>{L_REPLACE_EXISTING}<br />&nbsp;<input type="radio" name="replace" value="0" />{L_KEEP_EXISTING}</span></td>
	</tr>
	<tr> 
		<td class="row1"><span class="genmed">{L_DEL_EXISTING_ALL}</span></td>
		<td class="row1"><span class="genmed"><input type="radio" name="del_all" value="1" />{L_YES}&nbsp;&nbsp;<input type="radio" name="del_all" value="0" checked="checked" />{L_NO}</span></td>
	</tr>
	<tr> 
		<td class="catBottom" colspan="2" align="center"><input class="mainoption" name="import_pack" type="submit" value="{L_IMPORT}" /></td>
		<td class="catBottom" colspan="2" align="center"><input class="mainoption" name="export_pack" type="submit" value="{L_EXPORT}" /></td>
	</tr>
</form>

<form action="{S_SMILEY_CAT_ACTION}" method="post">
	<tr>
		<th colspan="2" class="thTop">{L_UNUSED_SMILIES_TITLE}</th>
		<th colspan="2" class="thTop">{L_CAT_VIEW_TITLE}</th>
	</tr>
	<tr>
		<td colspan="2" valign="top" class="row2"><span class="genmed">{L_UNUSED_SMILIES_DESC}</span></td>
		<td colspan="2" valign="top" class="row2"><span class="genmed">{L_CAT_VIEW_DESC}</span></td>
	</tr>
	<tr>
		<td class="row1"><span class="genmed">{L_SMILIES_UNUSED_NUM}</span></td>
		<td class="row1"><span class="genmed">&nbsp;&nbsp;<b>{S_SMILIES_UNUSED_NUM}</b></span></td>
		<td rowspan="3" colspan="2" valign="middle" class="row1">
			<table border="0" width="100%">
				<tr>
					<td align="center"><select size="{CAT_COUNT}" multiple="multiple" name="catview[]">{S_CAT_VIEW}</select></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="row1"><span class="genmed">{L_SMILEY_FILENAME_CODE}</span></td>
		<td class="row1"><span class="genmed"><input type="radio" name="code" value="1" />{L_YES}&nbsp;&nbsp;<input type="radio" name="code" value="0" checked="checked" />{L_NO}</span></td>
	</tr>
	<tr>
		<td class="row1"><span class="genmed">{L_SELECT_CAT}</span></td>
		<td class="row1"><select name="cat">{S_CAT_LIST}</select></td>
	</tr>
	<tr>
		<td colspan="2" align="center" class="catBottom">{S_HIDDEN_FIELDS4}<input type="submit" value="{L_UNUSED_SMILIES}" name="unused_smilies" class="mainoption" /></td>
		<td colspan="2" align="center" class="catBottom"><input type="submit" value="{L_CAT_VIEW}" name="cat_view" class="mainoption" /></td>
	</tr>
</form>
</table>
<br />
<div align="center"><span class="copyright"><a href="http://mods.afkamm.co.uk" target="blank" class="copyright">Smiley Categories MOD</a> &copy; 2004, 2005 Afkamm</span></div>
