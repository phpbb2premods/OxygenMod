<head>
<meta http-equiv="Content-Type" content="text/html; charset={S_CONTENT_ENCODING}">
<meta http-equiv="Content-Style-Type" content="text/css">
<link rel="stylesheet" type="text/css" href="./templates/{T_TEMPLATE_NAME}/{T_HEAD_STYLESHEET}">

<script language="JavaScript">
<!--
function submitonce()
{
	document.post.msg.value = document.post.message.value;
	document.post.message.value = "";	
}
//-->
</script>
<script language="JavaScript">
<!--
function emoticon(text) 
{
	document.post.message.value  += text;
	document.post.message.focus();
}
//-->
</script>
</head>

<body>

<form name="post" action="{SHOUTBOX_ACTION}" method="POST" target="ekran" autocomplete=off onsubmit="submitonce()">
	<table width="100%" cellpadding="1" cellspacing="1" class="bodyline">
		<tr>
			<td class="row1" align="center" valign="center" nowrap="nowrap">		
			<span class="gensmall">{L_GG_MES}: 
			<input type="text" name="message" style="height:20px" size="64" maxlength="{MAXLENGHT}" " value="" class="post">
			<input type="hidden" name="msg" value="">
			<input type="hidden" name="mode" value="submit">
			<input type="image" src="{GO}" name="submit_button" />&nbsp;
			<input type="image" src="{REFRESH}" name="refresh" />
			</span>
			</td>
			<td class="row1" align="center" valign="middle" nowrap>	
			<span class="gensmall"><input type="hidden" name="name" value="{NICK}">
			<input type="hidden" name="sb_user_id" value="{SB_USER_ID}">
			<input type="image" src="{SMILIES}" value="Smileys" style="font-size:9px; height=16px; width=50" onclick="window.open('{U_MORE_SMILIES}', '_phpbbsmilies', 'HEIGHT=280,resizable=yes,scrollbars=yes,WIDTH=350');return false;" target="_phpbbsmilies" />
			</span>
		</tr>
		<tr>
			<td class="row1" align="center" colspan="3">                
			<!-- BEGIN smilies_row -->
			<!-- BEGIN smilies_col -->
			<img src="{smilies_row.smilies_col.SMILEY_IMG}" border="0" onmouseover="this.style.cursor='hand';" onclick="emoticon(' {smilies_row.smilies_col.SMILEY_CODE} ');" alt="{smilies_row.smilies_col.SMILEY_DESC}" title="{smilies_row.smilies_col.SMILEY_DESC}" />	
			<!-- END smilies_col -->
			<!-- END smilies_row -->
			</td>
		</tr>
	</table>
</form>
</body>
