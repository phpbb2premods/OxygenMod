<script type="text/javascript" src="./../templates/picker/picker.js"></script>
<script type="text/javascript">
//<![CDATA[
<!--
var cp = new ColorPicker();
//-->
//]]>
</script>

<script language="javascript" type="text/javascript">
<!--
function update_forum_icon(newimage)
{
	document.forum_icon.src = "{ICON_BASEDIR}/" + newimage;
}
//-->
</script>

<h1>{L_FORUM_TITLE}</h1>

<p>{L_FORUM_EXPLAIN}</p>

<form action="{S_FORUM_ACTION}" method="post">
  <table class="forumline" width="100%" cellpadding="4" cellspacing="1" border="0" align="center">
	<tr>
	  <th class="thHead" colspan="2">{L_FORUM_SETTINGS}</th>
	</tr>
	<tr>
	  <td class="row1" width="38%">{L_FORUM_NAME}</td>
	  <td class="row2"><input type="text" size="25" name="forumname" value="{FORUM_NAME}" class="post" /></td>
	</tr>
	<tr>
	  <td class="row1">{L_FORUM_DESCRIPTION}</td>
	  <td class="row2"><textarea rows="5" cols="45" wrap="virtual" name="forumdesc" class="post">{DESCRIPTION}</textarea></td>
	</tr>
	<tr>
	  <td class="row1">{L_CATEGORY}</td>
	  <td class="row2"><select name="c">{S_CAT_LIST}</select></td>
	</tr>
	<tr>
	  <td class="row1">{L_FORUM_STATUS}</td>
	  <td class="row2"><select name="forumstatus">{S_STATUS_LIST}</select></td>
	</tr>
	<tr>
	  <td class="row1">{L_SUBTEMPLATE}</td>
	  <td class="row2">{FORUM_TEMPLATE}</td>
	</tr>
	<tr> 
	  <td class="row1">{L_POINTS_DISABLED}</td>
	  <td class="row2"><select name="points_disabled">{S_POINTS_LIST}</select></td>
	</tr>
	<tr> 
		<td class="row1">{L_DISABLE_WORD_CENSOR}</td>
		<td class="row2">
		<input type="radio" name="disable_word_censor" value="1" class="post" {DISABLE_WORD_CENSOR_YES} />&nbsp;{L_YES}&nbsp;
		<input type="radio" name="disable_word_censor" value="0" class="post" {DISABLE_WORD_CENSOR_NO} />&nbsp;{L_NO}</td>
	</tr>
	<tr> 
	  <td class="row1">{L_PASSWORD}</td>
	  <td class="row2"><input class="post" type="text" name="password" value="{FORUM_PASSWORD}" size="30" maxlength="20" /></td>
	</tr>
	<tr>
	  <td class="row1">{L_QP_TITLE}</td>
	  <td class="row2">
	  	<input type="radio" name="forum_qpes" value="1" {FORUM_QP_YES} /> {L_YES}&nbsp;
	  	<input type="radio" name="forum_qpes" value="0" {FORUM_QP_NO} /> {L_NO}
	  </td>
	</tr>
	<tr>
	  <td class="row1">{L_FORUM_AS_CATEGORY}</td>
	  <td class="row2">
	  	<input type="radio" name="forum_as_category" value="1" {FORUM_AS_CATEGORY_YES} /> {L_YES}&nbsp;
	  	<input type="radio" name="forum_as_category" value="0" {FORUM_AS_CATEGORY_NO} /> {L_NO}
	  </td>
	</tr>
	<tr> 
	  <td class="row1">{L_FORUM_ICON}</td>
	  <td class="row2"><select name="forumicon" onchange="update_forum_icon(this.options[selectedIndex].value);">{ICON_LIST}</select> &nbsp; <img name="forum_icon" src="{ICON_IMG}" border="0" alt="" /> &nbsp;</td>
	</tr>
	<tr>
	  <td class="row1">{L_FORUM_COLOR}<br /><span class="gensmall">{L_FORUM_COLOR_EXPLAIN}</span></td>
		<td class="row2">
			<input type="text" id="forum_color" size="10" maxlength="6" name="forum_color" value="{FORUM_COLOR}" class="post" onchange="previewColor('preview_forum_color', this.value);" />
			<input class="cp_preview" type="text" readonly="readonly" size="1" id="preview_forum_color" title="{L_PICK_COLOR}" onclick="showColorPicker(this, document.forms[0].forum_color, 'preview_forum_color'); return false;" />
		</td>
	</tr>
	<tr>
	  <td class="row1">{L_FORUM_IS_LINK}</td>
	  <td class="row2"><input class="post" type="checkbox" name="forum_is_link" value="1" {FORUM_IS_LINK} /></td>
	</tr>
	<tr>
	  <td class="row1">{L_FORUM_LINK_TARGET}</td>
	  <td class="row2"><input class="post" type="checkbox" name="forum_link_target" value="1" {FORUM_LINK_TARGET} /></td>
	</tr>
	<tr>
	  <td class="row1">{L_FORUM_WEBLINK}</td>
	  <td class="row2"><input class="post" type="text" size="25" maxlength="200" name="forum_weblink" value="{FORUM_WEBLINK}" /></td>
	</tr>
	<tr>
	  <td class="row1">{L_AUTO_PRUNE}</td>
	  <td class="row2"><table cellspacing="0" cellpadding="1" border="0">
		<tr>
		  <td align="right" valign="middle">{L_ENABLED}</td>
		  <td align="left" valign="middle"><input type="checkbox" name="prune_enable" value="1" {S_PRUNE_ENABLED} /></td>
		</tr>
		<tr>
		  <td align="right" valign="middle">{L_PRUNE_DAYS}</td>
		  <td align="left" valign="middle"><input type="text" name="prune_days" value="{PRUNE_DAYS}" size="5" class="post" /> {L_DAYS}</td>
		</tr>
		<tr>
		  <td align="right" valign="middle">{L_PRUNE_FREQ}</td>
		  <td align="left" valign="middle"><input type="text" name="prune_freq" value="{PRUNE_FREQ}" size="5" class="post" /> {L_DAYS}</td>
		</tr>
	  </table></td>
	</tr>
	<tr>
		<td class="row1">{L_FORUM_DISPLAY_SORT}</td>
		<td class="row2">
			<select name="forum_display_sort">{S_FORUM_DISPLAY_SORT_LIST}</select>&nbsp;
			<select name="forum_display_order">{S_FORUM_DISPLAY_ORDER_LIST}</select>&nbsp;
		</td>
	</tr>
	<tr>
	  <td class="catBottom" colspan="2" align="center">
		{S_HIDDEN_FIELDS}
		<input type="submit" name="submit" value="{S_SUBMIT_VALUE}" class="mainoption" />
	  </td>
	</tr>
  </table>
</form>
<br clear="all" />
<script type="text/javascript">
//<![CDATA[
<!--//
previewColor('preview_forum_color', document.getElementById('forum_color').value);
//-->
//]]>
</script>
