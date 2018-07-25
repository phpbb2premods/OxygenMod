{JS_FUNCS}
<script type="text/javascript">
<!--

function new_cls(new_tab_id)
{
	findObj('t1').className = 'row2';
	findObj('t2').className = 'row2';
	findObj('t3').className = 'row2';
	findObj('t4').className = 'row2';
	findObj(new_tab_id).className = 'row1';
}

function tab(show_tab_id)
{
	objHide('versions');
	objHide('stats');
	objHide('server');
	objHide('users');
	objShow(show_tab_id);
	return false;
}

//-->
</script>

<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
  <tr>
	<th class="thCornerL" width="100%"><span class="catLeft">{L_WELCOME}</span></th>
  </tr>
  <tr>
	<td class="row1">
	{L_ADMIN_INTRO}
	</td>
  </tr>
</table>
<br />

<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
	<td width="60%" valign="top" align="left">

<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
  <tr>
	<th class="thCornerL" width="100%" colspan="2"><span class="catLeft">{L_CONTROL_PANEL}</span></th>
  </tr>
  <tr> 
	<td width="100%" nowrap="nowrap" height="25" class="row3" colspan="2">
		<span class="gensmall">
			<table width="100%" cellpadding="3" cellspacing="1" border="0" class="bodyline">
			<tr>
				<td id="t1" class="row1" align="center" width="20%">
					<a class="gensmall" href="#" onClick="new_cls('t1');tab('versions');">{L_VERSIONS}</a>
				</td>
				<td id="t2" class="row2" align="center" width="20%">
					<a class="gensmall" href="#" onClick="new_cls('t2');tab('stats');">{L_STATS}</a>
				</td>
				<td id="t3" class="row2" align="center" width="20%">
					<a class="gensmall" href="#" onClick="new_cls('t3');tab('server');">{L_SERVER}</a>
				</td>
				<td id="t4" class="row2" align="center" width="20%">
					<a class="gensmall" href="#" onClick="new_cls('t4');tab('users');">{L_USERS}</a>
				</td>
			</tr>
			</table>
		</span>
	</td>
  </tr>
<tbody id="versions">
  <tr>
	<td class="row1" nowrap="nowrap">{L_SVR_VERSION}:</td>
	<td class="row2" width="60%"><b>{SVR_VERSION}</b></td>
  </tr>
  <tr> 
	<td class="row1" nowrap="nowrap">{L_PHP_VERSION}:</td>
	<td class="row2"><b>{PHP_VERSION}</b></td>
  </tr> 
  <tr>
	<td class="row1" nowrap="nowrap">{L_SQL_VERSION}:</td>
	<td class="row2"><b>{SQL_VERSION}</b></td>
  </tr> 
  <tr>
	<td class="row1" nowrap="nowrap">{L_BB_VERSION}:</td>
	<td class="row2"><b>{BB_VERSION}</b></td>
  </tr> 
  <tr>
	<td class="row1" nowrap="nowrap">{L_OXYGEN_VERSION}:</td>
	<td class="row2"><b>{OXYGEN_VERSION}</b></td>
  </tr> 
</tbody>

<tbody id="stats" style="display:none">
  <tr> 
	<td class="row1" nowrap="nowrap">{L_NUMBER_POSTS}:</td>
	<td class="row2" width="60%"><b>{NUMBER_OF_POSTS}</b></td>
  </tr> 
  <tr>
	<td class="row1" nowrap="nowrap">{L_POSTS_PER_DAY}:</td>
	<td class="row2"><b>{POSTS_PER_DAY}</b></td>
  </tr> 
  <tr>
	<td class="row1" nowrap="nowrap">{L_NUMBER_TOPICS}:</td>
	<td class="row2"><b>{NUMBER_OF_TOPICS}</b></td>
  </tr> 
  <tr>
	<td class="row1" nowrap="nowrap">{L_TOPICS_PER_DAY}:</td>
	<td class="row2"><b>{TOPICS_PER_DAY}</b></td>
  </tr> 
  <tr>
	<td class="row1" nowrap="nowrap">{L_NUMBER_USERS}:</td>
	<td class="row2"><b>{NUMBER_OF_USERS}</b></td>
  </tr> 
  <tr>
	<td class="row1" nowrap="nowrap">{L_USERS_PER_DAY}:</td>
	<td class="row2"><b>{USERS_PER_DAY}</b></td>
  </tr> 
</tbody>

<tbody id="server" style="display:none">
  <tr>
	<td class="row1" nowrap="nowrap">{L_BOARD_STARTED}:</td>
	<td class="row2" width="60%"><b>{START_DATE}</b></td>
  </tr> 
  <tr>
	<td class="row1" nowrap="nowrap">{L_AVATAR_DIR_SIZE}:</td>
	<td class="row2"><b>{AVATAR_DIR_SIZE}</b></td>
  </tr> 
  <tr>
	<td class="row1" nowrap="nowrap">{L_DB_SIZE}:</td>
	<td class="row2"><b>{DB_SIZE}</b></td>
  </tr> 
  <tr>
	<td class="row1" nowrap="nowrap">{L_GZIP_COMPRESSION}:</td>
	<td class="row2"><b>{GZIP_COMPRESSION}</b></td>
  </tr>
</tbody>

<tbody id="users" style="display:none">
  <tr>
	<td class="row1" nowrap="nowrap">{L_ADMINS}:</td>
	<td class="row2" width="60%">
		<b>{NUM_ADMINS}</b>
		<!-- BEGIN switch_list_admins -->
		<span class="gensmall">[ <a class="gensmall" onClick="objSwitch('list_admins')" href="#">{L_LIST}</a> ]</span>
		<!-- END switch_list_admins -->
	</td>
  </tr>
  <!-- BEGIN switch_list_admins -->
  <tr id="list_admins" style="display:none">
	<td class="row1" nowrap="nowrap">{L_ADMINS_LIST}:</td>
	<td class="row2"><b>{LIST_ADMINS}</b></td>
  </tr>
  <!-- END switch_list_admins -->
  <tr>
	<td class="row1" nowrap="nowrap">{L_MODS}:</td>
	<td class="row2">
		<b>{NUM_MODS}</b>
		<!-- BEGIN switch_list_mods -->
		<span class="gensmall">[ <a class="gensmall" onClick="objSwitch('list_mods')" href="#">{L_LIST}</a> ]</span>
		<!-- END switch_list_mods -->
	</td>
  </tr>
  <!-- BEGIN switch_list_mods -->
  <tr id="list_mods" style="display:none">
	<td class="row1" nowrap="nowrap">{L_MODS_LIST}:</td>
	<td class="row2"><b>{LIST_MODS}</b></td>
  </tr>
  <!-- END switch_list_mods -->
  <tr>
	<td class="row1" nowrap="nowrap">{L_INACTIVE}:</td>
	<td class="row2">
		<b>{NUM_INACTIVE}</b>
		<!-- BEGIN switch_list_inactive -->
		<span class="gensmall">[ <a class="gensmall" onClick="objSwitch('list_inactive')" href="#">{L_LIST}</a> ]</span>
		<!-- END switch_list_inactive -->
	</td>
  </tr>
  <!-- BEGIN switch_list_inactive -->
  <tr id="list_inactive" style="display:none">
	<td class="row1" nowrap="nowrap">{L_INACTIVE_LIST}:</td>
	<td class="row2"><b>{LIST_INACTIVE}</b></td>
  </tr>
  <tr>
  <!-- END switch_list_inactive -->
	<td class="row1" nowrap="nowrap">{L_BANNED}:</td>
	<td class="row2">
		<b>{NUM_BANNED}</b>
		<!-- BEGIN switch_list_banned -->
		<span class="gensmall">[ <a class="gensmall" onClick="objSwitch('list_banned')" href="#">{L_LIST}</a> ]</span>
		<!-- END switch_list_banned -->
	</td>
  </tr>
  <!-- BEGIN switch_list_banned -->
  <tr id="list_banned" style="display:none">
	<td class="row1" nowrap="nowrap">{L_BANNED_LIST}:</td>
	<td class="row2"><b>{LIST_BANNED}</b></td>
  </tr>
  <!-- END switch_list_banned -->
</tbody>
</table>

	</td>
	<td width="40%" valign="top" align="right">

<table width="99%" cellpadding="3" cellspacing="1" border="0" class="forumline">
  <tr> 
	<th height="25" class="thCornerL" colspan="3">{L_SETTINGS}</th>
  </tr>
  <tr>
	<td class="row3" height="148px" valign="top">
		<table width="100%" cellpadding="1" cellspacing="1" border="0" class="bodyline">

		<form action="{U_MSCHANGE}" method="POST">
		<tr>
			<td height="30px" class="row1" valign="middle" width="130px">&nbsp;{L_MS_EDIT}</td>
			<td class="row2" valign="middle">&nbsp;{S_DEFAULT_MS}&nbsp;<input type="submit" value="{L_SUBMIT}" class="mainoption" /></td>
		</tr>
		<tr>
			<td class="row3" height="1px" colspan="2"></td>
		</tr>
		</form>

		<form action="{U_STYLECHANGE}" method="POST">
		<tr>
			<td height="30px" class="row1" valign="middle" width="130px">&nbsp;{L_STYLE_EDIT}</td>
			<td class="row2" valign="middle">&nbsp;{S_DEFAULT_STYLE}&nbsp;<input type="submit" value="{L_SUBMIT}" class="mainoption" /></td>
		</tr>
		<tr>
			<td class="row3" height="1px" colspan="2"></td>
		</tr>
		</form>

		<form action="{U_VERCHANGE}" method="POST">
		<tr>
			<td height="30px" class="row1" valign="middle" width="130px">&nbsp;{L_EDIT_VERSION}</td>
			<td class="row2" valign="middle">
				<span class="gensmall" id="ver">&nbsp;{BB_VERSION} [ <a href="#" onClick="objShow('ver_edit');objHide('ver');" class="gensmall">{L_CHANGE}</a> ]</span>
				<span class="gensmall" id="ver_edit" style="display:none">
					&nbsp;<input type="text" name="new_ver" value="{BB_VERSION_RAW}" class="post" />&nbsp;<input type="submit" value="{L_SUBMIT}" class="mainoption" />
					[ <a href="#" onClick="objShow('ver');objHide('ver_edit');" class="gensmall">{L_CANCEL}</a> ]
				</span>
			</td>
		</tr>
		</form>

		</table>
	</td>
  </tr>
</table>

	</td>
</tr>
</table>
<br />

<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
	<td width="45%" valign="top" align="left">

<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
  <tr> 
	<th height="25" class="thCornerL" colspan="3">{L_QUICKSUBMIT}</th>
  </tr>
  
  <form action="{MS_URL}" target="_blank" method="POST">
  <tr>
	<td class="row2" width="120px" height="25px">{L_MOD_SEARCH}</td>
	<td class="row1">
		<input type="textbox" value="" name="{MS_FORM}" style="width:95%" class="post" />
	</td>
	<td class="row1" width="88px">
		<input type="submit" name="submit" value="{L_SUBMIT}" style="width:95%" class="mainoption" />
	</td>
  </tr>
  </form>

  <form action="{U_PHPFUNC}" target="_blank" method="GET">
  <tr>
	<td class="row2" height="25px">{L_PHPFUNC}</td>
	<td class="row1">
		<input type="textbox" value="" name="pattern" style="width:95%" class="post" />
	</td>
	<td class="row1">
		<input type="submit" name="submit" value="{L_SUBMIT}" style="width:95%" class="mainoption" />
	</td>
  </tr>
  </form>
  
  <form action="{U_SQLFUNC}" target="_blank" method="GET">
  <tr>
	<td class="row2" height="25px">{L_SQLFUNC}</td>
	<td class="row1">
		<input type="textbox" value="" name="q" style="width:95%" class="post" />
	</td>
	<td class="row1">
		<input type="submit" name="submit" value="{L_SUBMIT}" style="width:95%" class="mainoption" />
	</td>
  </tr>
  </form>
	</td>
</tr>
</table>

	</td>
	<td width="55%" valign="top" align="right">

<table width="99%" cellpadding="3" cellspacing="1" border="0" class="forumline">
  <tr> 
	<th height="25" class="thCornerL" colspan="3">{L_NOTEPADS}</th>
  </tr>

  <form action="{U_NOTEPAD_G}" name="notepads" method="POST">
  <tbody id="notepad_global">
  <tr>
	<td class="row1" valign="top" style="height: 120px">
		<textarea class="post" name="global" style="height:120px;width:100%">{NOTEPAD_GLOBAL}</textarea>
	</td>
  </tr>
  <tr>
	<td class="row2" valign="bottom">
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td valign="middle" align="left" width="25%">
				<input type="submit" class="mainoption" value="{L_SAVE}" />
			</td>
			<td valign="middle" align="center" width="50%">
				<span class="gensmall"><b>{L_NOTEPAD_GLOBAL}</b></span>
			</td>
			<td valign="middle" align="right" width="25%">
				<input type="button" class="mainoption" value="{L_SWITCH}" onClick="objHide('notepad_global');objShow('notepad_personal');" />
			</td>
		</tr>
		</table>
	</td>
  </tr>
  </tbody>
  </form>

  <form action="{U_NOTEPAD_P}" name="notepads" method="POST">
  <tbody id="notepad_personal" style="display:none">
  <tr>
	<td class="row1" valign="top" style="height: 120px">
		<textarea class="post" name="personal" style="height:120px;width:100%">{NOTEPAD_PERSONAL}</textarea>
	</td>
  </tr>
  <tr>
	<td class="row2" valign="bottom">
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td valign="middle" align="left" width="25%">
				<input type="submit" class="mainoption" value="{L_SAVE}" />
			</td>
			<td valign="middle" align="center" width="50%">
				<span class="gensmall"><b>{L_NOTEPAD_PERSONAL}</b></span>
			</td>
			<td valign="middle" align="right" width="25%">
				<input type="button" class="mainoption" value="{L_SWITCH}" onClick="objHide('notepad_personal');objShow('notepad_global');" />
			</td>
		</tr>
		</table>
	</td>
  </tr>
  </tbody>
  </form>

</table>

	</td>
</tr>
</table>
<br />

<h1>{L_WHO_IS_ONLINE}</h1>

<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
  <tr> 
	<th width="20%" class="thCornerL" height="25">&nbsp;{L_USERNAME}&nbsp;</th>
	<th width="20%" height="25" class="thTop">&nbsp;{L_STARTED}&nbsp;</th>
	<th width="20%" class="thTop">&nbsp;{L_LAST_UPDATE}&nbsp;</th>
	<th width="20%" class="thCornerR">&nbsp;{L_FORUM_LOCATION}&nbsp;</th>
	<th width="20%" height="25" class="thCornerR">&nbsp;{L_IP_ADDRESS}&nbsp;</th>
  </tr>
  <!-- BEGIN reg_user_row -->
  <tr> 
	<td width="20%" class="{reg_user_row.ROW_CLASS}">&nbsp;<span class="gen"><a href="{reg_user_row.U_USER_PROFILE}"{reg_user_row.STYLE}>{reg_user_row.USERNAME}</a></span>&nbsp;</td>
	<td width="20%" align="center" class="{reg_user_row.ROW_CLASS}">&nbsp;<span class="gen">{reg_user_row.STARTED}</span>&nbsp;</td>
	<td width="20%" align="center" nowrap="nowrap" class="{reg_user_row.ROW_CLASS}">&nbsp;<span class="gen">{reg_user_row.LASTUPDATE}</span>&nbsp;</td>
	<td width="20%" class="{reg_user_row.ROW_CLASS}">&nbsp;<span class="gen"><a href="{reg_user_row.U_FORUM_LOCATION}" class="gen">{reg_user_row.FORUM_LOCATION}</a></span>&nbsp;</td>
	<td width="20%" class="{reg_user_row.ROW_CLASS}">&nbsp;<span class="gen"><a href="{reg_user_row.U_WHOIS_IP}" class="gen" target="_phpbbwhois">{reg_user_row.IP_ADDRESS}</a></span>&nbsp;</td>
	</tr>
	<!-- END reg_user_row -->
	<!-- BEGIN spider_user_row -->
	<tr> 
	<td colspan="5" height="1" class="row3"><img src="../images/spacer.gif" width="1" height="1" alt="."></td>
	</tr>
  <tr> 
	<td width="20%" class="{spider_user_row.ROW_CLASS}">&nbsp;<span class="gen">{spider_user_row.USERNAME}</span>&nbsp;</td>
	<td width="20%" align="center" class="{spider_user_row.ROW_CLASS}">&nbsp;<span class="gen">{spider_user_row.STARTED}</span>&nbsp;</td>
	<td width="20%" align="center" nowrap="nowrap" class="{spider_user_row.ROW_CLASS}">&nbsp;<span class="gen">{spider_user_row.LASTUPDATE}</span>&nbsp;</td>
	<td width="20%" class="{spider_user_row.ROW_CLASS}">&nbsp;<span class="gen"><a href="{spider_user_row.U_FORUM_LOCATION}" class="gen">{spider_user_row.FORUM_LOCATION}</a></span>&nbsp;</td>
	<td width="20%" class="{spider_user_row.ROW_CLASS}">&nbsp;<span class="gen"><a href="{spider_user_row.U_WHOIS_IP}" target="_phpbbwhois">{spider_user_row.IP_ADDRESS}</a></span>&nbsp;</td>
  </tr>
  <!-- END spider_user_row -->
  <!-- BEGIN guest_user_row -->
  <tr> 
	<td colspan="5" height="1" class="row3"><img src="../images/spacer.gif" width="1" height="1" alt="."></td>
  </tr>
  <tr> 
	<td width="20%" class="{guest_user_row.ROW_CLASS}">&nbsp;<span class="gen">{guest_user_row.USERNAME}</span>&nbsp;</td>
	<td width="20%" align="center" class="{guest_user_row.ROW_CLASS}">&nbsp;<span class="gen">{guest_user_row.STARTED}</span>&nbsp;</td>
	<td width="20%" align="center" nowrap="nowrap" class="{guest_user_row.ROW_CLASS}">&nbsp;<span class="gen">{guest_user_row.LASTUPDATE}</span>&nbsp;</td>
	<td width="20%" class="{guest_user_row.ROW_CLASS}">&nbsp;<span class="gen"><a href="{guest_user_row.U_FORUM_LOCATION}" class="gen">{guest_user_row.FORUM_LOCATION}</a></span>&nbsp;</td>
	<td width="20%" class="{guest_user_row.ROW_CLASS}">&nbsp;<span class="gen"><a href="{guest_user_row.U_WHOIS_IP}" target="_phpbbwhois">{guest_user_row.IP_ADDRESS}</a></span>&nbsp;</td>
  </tr>
  <!-- END guest_user_row -->
</table>

<br />
