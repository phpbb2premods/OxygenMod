<script language="JavaScript" type="text/javascript">
<!--//
function _dom_menu()
{
	return this;
}
	_dom_menu.prototype.objref = function(id)
	{
		return document.getElementById ? document.getElementById(id) : (document.all ? document.all[id] : (document.layers ? document.layers[id] : null));
	}
	_dom_menu.prototype.cancel_event = function()
	{
		if ( window.event )
		{
			window.event.cancelBubble = true;
		}
	}

	_dom_menu.prototype.set = function(menu) {
		var menus = new Array(
			'generalinfo',
			'metatagsinfo',
			'securityinfo',
			'suscribeinfo',
			'timegestioninfo',
			'cookiesinfo',
			'pminfo',
			'avatarinfo',
			'postinfo',
			'quickpostinfo',
			'smilesinfo',
			'basicinfo',
			'coppainfo',
			'emailinfo',
			'birthdayinfo',
			'wpminfo',
			'cellinfo',
			'pointsinfo',
			'shoutboxinfo',
			'divinfo',
			'restrictioninfo'
		);
		var object;
		var opt;
		var flag;
		for (i=0; i < menus.length; i++)
		{
			cur_menu = menus[i];
			object = this.objref(cur_menu);
			if ( object && object.style )
			{
				object.style.display = (cur_menu == menu) ? '' : 'none';
			}
			opt = this.objref(cur_menu + '_opt');
			if ( opt && opt.style )
			{
				opt.style.fontWeight = (cur_menu == menu) ? 'bold' : '';
			}
			flag = this.objref(cur_menu + '_flag');
			if ( flag && flag.style )
			{
				flag.style.fontWeight = (cur_menu == menu) ? 'bold' : '';
				flag.className = (cur_menu == menu) ? 'row1 gensmall' : 'row2 gensmall';
			}
		}
		this.cancel_event();
	}

// instantiate
dom_menu = new _dom_menu();
//-->
</script>

<h1>{L_CONFIGURATION_TITLE}</h1>

<p>{L_CONFIGURATION_EXPLAIN}</p>


<form action="{S_CONFIG_ACTION}" method="post">
<table cellpadding="0" cellspacing="2" border="0" width="100%"><tr><td width="200" valign="top">

<table cellpadding="4" cellspacing="1" border="0" class="forumline" width="200">

<tr>
  <th class="thHead" colspan="2">{L_CONFIGURATION_TITLE}</th>
</tr>
<tr>
  <td id="generalinfo_flag" class="row1 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('generalinfo'); return false;"><div id="generalinfo_opt" class="gensmall" style="font-weight: bold;"><a href="#" onclick="dom_menu.set('generalinfo'); return false;">{L_GENERAL_SETTINGS}</a></div></td>
</tr>
<tr>
  <td id="metatagsinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('metatagsinfo'); return false;"><div id="metatagsinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('metatagsinfo'); return false;">{L_META_TAGS}</a></div></td>
</tr>
<tr>
  <td id="securityinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('securityinfo'); return false;"><div id="securityinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('securityinfo'); return false;">{L_SECURITY_SETTINGS}</a></div></td>
</tr>
<tr>
  <td id="suscribeinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('suscribeinfo'); return false;"><div id="suscribeinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('suscribeinfo'); return false;">{L_SUSCRIBE_SETTINGS}</a></div></td>
</tr>
<tr>
  <td id="timegestioninfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('timegestioninfo'); return false;"><div id="timegestioninfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('timegestioninfo'); return false;">{L_TIME_SETTINGS}</a></div></td>
</tr>
<tr>
  <td id="cookiesinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('cookiesinfo'); return false;"><div id="cookiesinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('cookiesinfo'); return false;">{L_COOKIE_SETTINGS}</a></div></td>
</tr>
<tr>
  <td id="pminfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('pminfo'); return false;"><div id="pminfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('pminfo'); return false;">{L_PRIVATE_MESSAGING}</a></div></td>
</tr>
<tr>
  <td id="avatarinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('avatarinfo'); return false;"><div id="avatarinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('avatarinfo'); return false;">{L_AVATAR_SETTINGS}</a></div></td>
</tr>
<tr>
  <td id="postinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('postinfo'); return false;"><div id="postinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('postinfo'); return false;">{L_MESSAGES_SETTINGS}</a></div></td>
</tr>
<tr>
  <td id="quickpostinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('quickpostinfo'); return false;"><div id="quickpostinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('quickpostinfo'); return false;">{L_QP_SETTINGS}</a></div></td>
</tr>
<tr>
  <td id="smilesinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('smilesinfo'); return false;"><div id="smilesinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('smilesinfo'); return false;">{L_SMILEY_CONFIGURATION}</a></div></td>
</tr>
<tr>
  <td id="basicinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('basicinfo'); return false;"><div id="basicinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('basicinfo'); return false;">{L_ABILITIES_SETTINGS}</a></div></td>
</tr>
<tr>
  <td id="coppainfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('coppainfo'); return false;"><div id="coppainfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('coppainfo'); return false;">{L_COPPA_SETTINGS}</a></div></td>
</tr>
<tr>
  <td id="emailinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('emailinfo'); return false;"><div id="emailinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('emailinfo'); return false;">{L_EMAIL_SETTINGS}</a></div></td>
</tr>
<tr>
  <td id="birthdayinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('birthdayinfo'); return false;"><div id="birthdayinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('birthdayinfo'); return false;">{L_BDAY_SETTINGS}</a></div></td>
</tr>
<tr>
  <td id="wpminfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('wpminfo'); return false;"><div id="wpminfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('wpminfo'); return false;">{L_WPM}</a></div></td>
</tr>
<tr>
  <td id="cellinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('cellinfo'); return false;"><div id="cellinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('cellinfo'); return false;">{L_CELL}</a></div></td>
</tr>
<tr>
  <td id="pointsinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('pointsinfo'); return false;"><div id="pointsinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('pointsinfo'); return false;">{L_SYS_SETTINGS}</a></div></td>
</tr>
<tr>
  <td id="shoutboxinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('shoutboxinfo'); return false;"><div id="shoutboxinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('shoutboxinfo'); return false;">{L_SHOUTBOX_SETTINGS}</a></div></td>
</tr>
<tr>
  <td id="restrictioninfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('restrictioninfo'); return false;"><div id="restrictioninfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('restrictioninfo'); return false;">{L_RESTRICTION_SETTINGS}</a></div></td>
</tr>
<tr>
  <td id="divinfo_flag" class="row2 gensmall" align="right" width="10">&raquo;</td>
  <td style="cursor: pointer; font-weight: normal;" class="row1" onmouseover="this.className='row2'; this.style.cursor='pointer'; this.style.fontWeight='bold';" onmouseout="this.className='row1'; this.style.fontWeight='normal';" onclick="dom_menu.set('divinfo'); return false;"><div id="divinfo_opt" class="gensmall"><a href="#" onclick="dom_menu.set('divinfo'); return false;">{L_DIV_SETTINGS}</a></div></td>
</tr>
</table>

</td><td valign="top" width="100%">

<table id="generalinfo" class="forumline" border="0" cellpadding="4" cellspacing="1" width="100%">
	<tr>
	  <th class="thHead" colspan="2">{L_GENERAL_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_SERVER_NAME}</td>
		<td class="row2" width="45%">
		<input class="post" type="text" maxlength="255" size="40" name="server_name" value="{SERVER_NAME}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_SERVER_PORT}<br />
		<span class="gensmall">{L_SERVER_PORT_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" maxlength="5" size="5" name="server_port" value="{SERVER_PORT}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_SCRIPT_PATH}<br />
		<span class="gensmall">{L_SCRIPT_PATH_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" maxlength="255" name="script_path" value="{SCRIPT_PATH}" />
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_SITE_NAME}<br />
		<span class="gensmall">{L_SITE_NAME_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" size="25" maxlength="100" name="sitename" value="{SITENAME}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_SITE_DESCRIPTION}</td>
		<td class="row2">
		<input class="post" type="text" size="40" maxlength="255" name="site_desc" value="{SITE_DESCRIPTION}" />
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_DISABLE_BOARD}<br /><span class="gensmall">{L_DISABLE_BOARD_EXPLAIN}</span></td>
		<td class="row2">
		<input type="radio" name="board_disable" value="1" {S_DISABLE_BOARD_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="board_disable" value="0" {S_DISABLE_BOARD_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_DISABLED_CAPTION}</td>
		<td class="row2">
		<input class="post" type="text" size="30" maxlength="100" name="board_disable_caption" value="{DISABLED_CAPTION}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_DISABLED_TEXT}<br /></td>
		<td class="row2">
		<textarea name="board_disable_text" rows="5" cols="30" maxlength="255">{DISABLED_TEXT}</textarea>
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_DEFAULT_STYLE}</td>
		<td class="row2">{STYLE_SELECT}</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_STYLE}<br />
		<span class="gensmall">{L_OVERRIDE_STYLE_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input type="radio" name="override_user_style" value="1" {OVERRIDE_STYLE_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="override_user_style" value="0" {OVERRIDE_STYLE_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_DEFAULT_LANGUAGE}</td>
		<td class="row2">{LANG_SELECT}</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_ENABLE_GZIP}</td>
		<td class="row2">
		<input type="radio" name="gzip_compress" value="1" {GZIP_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="gzip_compress" value="0" {GZIP_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_ENABLE_PRUNE}</td>
		<td class="row2">
		<input type="radio" name="prune_enable" value="1" {PRUNE_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="prune_enable" value="0" {PRUNE_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center">
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>

</table><table id="metatagsinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_META_TAGS}</th>
	</tr>
	<tr>
		<td class="row2" colspan="2">
		<span class="gensmall">{L_META_TAGS_EXPLAIN}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_META_LANGUAGE}<br />
		<span class="gensmall">{L_META_LANGUAGE_EXPLAIN}</span>
		</td>
		<td class="row2" width="45%">
		<input class="post" type="text" name="meta_language" value="{META_LANGUAGE}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_META_AUTHOR}<br />
		<span class="gensmall">{L_META_AUTHOR_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" name="meta_author" value="{META_AUTHOR}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_META_KEYWORDS}<br />
		<span class="gensmall">{L_META_KEYWORDS_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" name="meta_keywords" value="{META_KEYWORDS}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_META_DESCRIPTION}<br />
		<span class="gensmall">{L_META_DESCRIPTION_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" name="meta_description" value="{META_DESCRIPTION}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_META_ROBOTS}<br />
		<span class="gensmall">{L_META_ROBOTS_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" name="meta_robots" value="{META_ROBOTS}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_META_RATING}<br />
		<span class="gensmall">{L_META_RATING_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" name="meta_rating" value="{META_RATING}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_META_VISIT_AFTER}<br />
		<span class="gensmall">{L_META_VISIT_AFTER_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" name="meta_visit_after" value="{META_VISIT_AFTER}" />
		</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center">
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>

</table><table id="securityinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_SECURITY_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_AUTOLOGIN}<br />
		<span class="gensmall">{L_ALLOW_AUTOLOGIN_EXPLAIN}</span>
		</td>
		<td class="row2" width="45%">
		<input type="radio" name="allow_autologin" value="1" {ALLOW_AUTOLOGIN_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="allow_autologin" value="0" {ALLOW_AUTOLOGIN_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_AUTOLOGIN_TIME}<br />
		<span class="gensmall">{L_AUTOLOGIN_TIME_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" size="3" maxlength="4" name="max_autologin_time" value="{AUTOLOGIN_TIME}" />
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_MAX_LOGIN_ATTEMPTS}<br />
		<span class="gensmall">{L_MAX_LOGIN_ATTEMPTS_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" size="3" maxlength="4" name="max_login_attempts" value="{MAX_LOGIN_ATTEMPTS}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_LOGIN_RESET_TIME}<br />
		<span class="gensmall">{L_LOGIN_RESET_TIME_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" size="3" maxlength="4" name="login_reset_time" value="{LOGIN_RESET_TIME}" />
		</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center">
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>

</table><table id="suscribeinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_SUSCRIBE_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_VISUAL_CONFIRM}<br />
		<span class="gensmall">{L_VISUAL_CONFIRM_EXPLAIN}</span>
		</td>
		<td class="row2" width="45%">
		<input type="radio" name="enable_confirm" value="1" {CONFIRM_ENABLE} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="enable_confirm" value="0" {CONFIRM_DISABLE} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_ACCT_ACTIVATION}</td>
		<td class="row2">
		<input type="radio" name="require_activation" value="{ACTIVATION_NONE}" {ACTIVATION_NONE_CHECKED} />
		<span class="genmed">{L_NONE}</span>&nbsp;
		<input type="radio" name="require_activation" value="{ACTIVATION_USER}" {ACTIVATION_USER_CHECKED} />
		<span class="genmed">{L_USER}</span>&nbsp;
		<input type="radio" name="require_activation" value="{ACTIVATION_ADMIN}" {ACTIVATION_ADMIN_CHECKED} />
		<span class="genmed">{L_ADMIN}</span>
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
  <tr>
    <td class="row1">{L_REGISTRATION_STATUS}<br />
		<span class="gensmall">{L_REGISTRATION_STATUS_EXPLAIN}</span>
		</td>
    <td class="row2">
		<input type="radio" name="registration_status" value="1" {S_REGISTRATION_STATUS_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="registration_status" value="0" {S_REGISTRATION_STATUS_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
  </tr>
  <tr>
    <td class="row1">{L_REGISTRATION_CLOSED}<br />
		<span class="gensmall">{L_REGISTRATION_CLOSED_EXPLAIN}</span>
		</td>
    <td class="row2">
		<input class="post" type="text" size="40" maxlength="255" name="registration_closed" value="{REGISTRATION_CLOSED}" />
		</td>
  </tr>
	<tr>
		<td class="catBottom" colspan="2" align="center">
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>

</table><table id="timegestioninfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_TIME_SETTINGS}</th>
	</tr>
	<tr>
	  <td class="row1">{L_DATE_FORMAT}<br /><span class="gensmall">{L_DATE_FORMAT_EXPLAIN}</span></td>
		<td class="row2" width="45%"><span class="genmed">
			<select name="dateoptions" id="dateoptions" onchange="if (this.value == 'custom') { document.getElementById('default_dateformat').value = '{A_DEFAULT_DATEFORMAT}'; } else { document.getElementById('default_dateformat').value = this.value; }">
				{S_DATEFORMAT_OPTIONS}
			</select><br />
			<input type="text" name="default_dateformat" id="default_dateformat" value="{DEFAULT_DATEFORMAT}" maxlength="30" class="post" />
		</span></td>
	</tr>
	<tr>
	  <td class="row1">{L_SYSTEM_TIMEZONE}</td>
	  <td class="row2">{TIMEZONE_SELECT}</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center">
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>

</table><table id="cookiesinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_COOKIE_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row2" colspan="2">
		<span class="gensmall">{L_COOKIE_SETTINGS_EXPLAIN}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_COOKIE_DOMAIN}</td>
		<td class="row2" width="45%">
		<input class="post" type="text" maxlength="255" name="cookie_domain" value="{COOKIE_DOMAIN}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_COOKIE_NAME}</td>
		<td class="row2">
		<input class="post" type="text" maxlength="16" name="cookie_name" value="{COOKIE_NAME}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_COOKIE_PATH}</td>
		<td class="row2">
		<input class="post" type="text" maxlength="255" name="cookie_path" value="{COOKIE_PATH}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_COOKIE_SECURE}<br />
		<span class="gensmall">{L_COOKIE_SECURE_EXPLAIN}</span>
		</td>
		<td class="row2"><input type="radio" name="cookie_secure" value="0" {S_COOKIE_SECURE_DISABLED} />
		<span class="genmed">{L_DISABLED}</span>&nbsp;
		<input type="radio" name="cookie_secure" value="1" {S_COOKIE_SECURE_ENABLED} />
		<span class="genmed">{L_ENABLED}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_SESSION_LENGTH}</td>
		<td class="row2">
		<input class="post" type="text" maxlength="5" size="5" name="session_length" value="{SESSION_LENGTH}" />
		</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center">
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>

</table><table id="pminfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_PRIVATE_MESSAGING}</th>
	</tr>
	<tr>
		<td class="row1">{L_DISABLE_PRIVATE_MESSAGING}</td>
		<td class="row2" width="45%">
		<input type="radio" name="privmsg_disable" value="0" {S_PRIVMSG_ENABLED} />
		<span class="genmed">{L_ENABLED}</span>&nbsp;
		<input type="radio" name="privmsg_disable" value="1" {S_PRIVMSG_DISABLED} />
		<span class="genmed">{L_DISABLED}</span>
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_ADMINISTRATOR_INBOX_LIMIT}</td>
		<td class="row2">
		<input class="post" type="text" maxlength="4" size="4" name="administrator_max_inbox_privmsgs" value="{ADMINISTRATOR_INBOX_LIMIT}" />
		</td>
	</tr>
  <tr>
		<td class="row1">{L_ADMINISTRATOR_SENTBOX_LIMIT}</td>
		<td class="row2">
		<input class="post" type="text" maxlength="4" size="4" name="administrator_max_sentbox_privmsgs" value="{ADMINISTRATOR_SENTBOX_LIMIT}" />
		</td>
	</tr>
  <tr>
		<td class="row1">{L_ADMINISTRATOR_SAVEBOX_LIMIT}</td>
		<td class="row2">
		<input class="post" type="text" maxlength="4" size="4" name="administrator_max_savebox_privmsgs" value="{ADMINISTRATOR_SAVEBOX_LIMIT}" />
		</td>
	</tr>
	</tr>
  <tr>
		<td class="row1">{L_ADMINISTRATOR_TRASHBOX_LIMIT}</td>
		<td class="row2">
		<input class="post" type="text" maxlength="4" size="4" name="administrator_max_trashbox_privmsgs" value="{ADMINISTRATOR_TRASHBOX_LIMIT}" />
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
  <tr>
		<td class="row1">{L_MODERATOR_INBOX_LIMIT}</td>
		<td class="row2">
		<input class="post" type="text" maxlength="4" size="4" name="moderator_max_inbox_privmsgs" value="{MODERATOR_INBOX_LIMIT}" />
		</td>
	</tr>
  <tr>
		<td class="row1">{L_MODERATOR_SENTBOX_LIMIT}</td>
		<td class="row2">
		<input class="post" type="text" maxlength="4" size="4" name="moderator_max_sentbox_privmsgs" value="{MODERATOR_SENTBOX_LIMIT}" />
		</td>
  </tr>
  <tr>
		<td class="row1">{L_MODERATOR_SAVEBOX_LIMIT}</td>
		<td class="row2">
		<input class="post" type="text" maxlength="4" size="4" name="moderator_max_savebox_privmsgs" value="{MODERATOR_SAVEBOX_LIMIT}" />
		</td>
  </tr>
  <tr>
		<td class="row1">{L_MODERATOR_TRASHBOX_LIMIT}</td>
		<td class="row2">
		<input class="post" type="text" maxlength="4" size="4" name="moderator_max_trashbox_privmsgs" value="{MODERATOR_TRASHBOX_LIMIT}" />
		</td>
  </tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_INBOX_LIMIT}</td>
		<td class="row2">
		<input class="post" type="text" maxlength="4" size="4" name="max_inbox_privmsgs" value="{INBOX_LIMIT}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_SENTBOX_LIMIT}</td>
		<td class="row2">
		<input class="post" type="text" maxlength="4" size="4" name="max_sentbox_privmsgs" value="{SENTBOX_LIMIT}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_SAVEBOX_LIMIT}</td>
		<td class="row2">
		<input class="post" type="text" maxlength="4" size="4" name="max_savebox_privmsgs" value="{SAVEBOX_LIMIT}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_TRASHBOX_LIMIT}</td>
		<td class="row2">
		<input class="post" type="text" maxlength="4" size="4" name="max_trashbox_privmsgs" value="{TRASHBOX_LIMIT}" />
		</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center">
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>

</table><table id="avatarinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_AVATAR_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_MAX_FILESIZE}<br />
		<span class="gensmall">{L_MAX_FILESIZE_EXPLAIN}</span>
		</td>
		<td class="row2" width="45%">
		<input class="post" type="text" size="4" maxlength="10" name="avatar_filesize" value="{AVATAR_FILESIZE}" /> Bytes
		</td>
	</tr>
	<tr>
		<td class="row1">{L_MAX_AVATAR_SIZE}<br />
			<span class="gensmall">{L_MAX_AVATAR_SIZE_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" size="3" maxlength="4" name="avatar_max_height" value="{AVATAR_MAX_HEIGHT}" /> x <input class="post" type="text" size="3" maxlength="4" name="avatar_max_width" value="{AVATAR_MAX_WIDTH}">
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_AVATAR_STORAGE_PATH}<br />
		<span class="gensmall">{L_AVATAR_STORAGE_PATH_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" size="20" maxlength="255" name="avatar_path" value="{AVATAR_PATH}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_AVATAR_GALLERY_PATH}<br />
		<span class="gensmall">{L_AVATAR_GALLERY_PATH_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" size="20" maxlength="255" name="avatar_gallery_path" value="{AVATAR_GALLERY_PATH}" />
		</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center">
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>

</table><table id="postinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_MESSAGES_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_ANNONCE_GLOBALE_INDEX}</td>
		<td class="row2" width="45%">
		<input type="radio" name="annonce_globale_index" value="1" {ANNONCE_GLOBALE_INDEX_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="annonce_globale_index" value="0" {ANNONCE_GLOBALE_INDEX_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_SPLIT_GLOBAL_ANNOUNCE}</td>
		<td class="row2">
		<input type="radio" name="split_announce" value="1"{SPLIT_GLOBAL_ANNOUNCE_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="split_announce" value="0"{SPLIT_GLOBAL_ANNOUNCE_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_SPLIT_ANNOUNCE}</td>
		<td class="row2">
		<input type="radio" name="split_global_announce" value="1"{SPLIT_ANNOUNCE_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="split_global_announce" value="0"{SPLIT_ANNOUNCE_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_SPLIT_STICKY}</td>
		<td class="row2">
		<input type="radio" name="split_sticky" value="1"{SPLIT_STICKY_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="split_sticky" value="0"{SPLIT_STICKY_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_SPLIT_TOPIC_SPLIT}</td>
		<td class="row2">
		<input type="radio" name="split_topic_split" value="1"{SPLIT_TOPIC_SPLIT_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="split_topic_split" value="0"{SPLIT_TOPIC_SPLIT_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_FLOOD_INTERVAL}<br />
		<span class="gensmall">{L_FLOOD_INTERVAL_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" size="3" maxlength="4" name="flood_interval" value="{FLOOD_INTERVAL}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_SEARCH_FLOOD_INTERVAL}<br />
		<span class="gensmall">{L_SEARCH_FLOOD_INTERVAL_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" size="3" maxlength="4" name="search_flood_interval" value="{SEARCH_FLOOD_INTERVAL}" />
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_BUMP_INTERVAL}<br />
		<span class="gensmall">{L_BUMP_INTERVAL_EXPLAIN}</span>
		</td>
		<td class="row2">{S_BUMP_INTERVAL}</td>
	</tr>
	<tr>
		<td class="row1">{L_REPLY_FLOOD_CTRL}<br />
		<span class="gensmall">{L_REPLY_FLOOD_CTRL_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input type="radio" name="reply_flood_ctrl" value="1"{REPLY_FLOOD_CTRL_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="reply_flood_ctrl" value="0"{REPLY_FLOOD_CTRL_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_JOIN_INTERVAL}<br />
		<span class="gensmall">{L_JOIN_INTERVAL_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" size="3" maxlength="4" name="join_interval" value="{JOIN_INTERVAL}" />
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_LAST_TOPIC_TITLE_LENGHT}<br />
		<span class="gensmall">{L_LAST_TOPIC_TITLE_LENGHT_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" size="3" maxlength="4" name="last_topic_title_length" value="{LAST_TOPIC_TITLE_LENGHT}" />
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_SUB_TITLE_LENGTH}<br />
		<span class="gensmall">{L_SUB_TITLE_LENGTH_EXPLAIN}</span>
		</td>
		<td class="row2"><span class="genmed">
			<input type="text" size="5" name="sub_title_length" value="{SUB_TITLE_LENGTH}" class="post" />
		</span></td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_TOPICS_PER_PAGE}</td>
		<td class="row2">
		<input class="post" type="text" name="topics_per_page" size="3" maxlength="4" value="{TOPICS_PER_PAGE}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_POSTS_PER_PAGE}</td>
		<td class="row2">
		<input class="post" type="text" name="posts_per_page" size="3" maxlength="4" value="{POSTS_PER_PAGE}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_HOT_THRESHOLD}</td>
		<td class="row2">
		<input class="post" type="text" name="hot_threshold" size="3" maxlength="4" value="{HOT_TOPIC}" />
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
  <tr>
    <td class="row1">{L_ICONS_PER_ROW}<br />
		<span class="gensmall">{L_ICONS_PER_ROW_EXPLAIN}</span>
		</td>
    <td class="row2">
		<input class="post" type="text" size="3" maxlength="2" name="icon_per_row" value="{ICONS_PER_ROW}" />
		</td>
  </tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
  <tr>
    <td class="row1">{L_IMAGES_MAX_SIZE}</td>
    <td class="row2">
		<input class="post" type="text" size="6" maxlength="5" name="images_max_size" value="{IMAGES_MAX_SIZE}" />
		</td>
  </tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_DISALLOW_EDITING_DELETING_ADMIN_MESSAGES}</td>
		<td class="row2">
		<input type="radio" name="disallow_edition_deleting_admin_messages" value="1" {DISALLOW_EDITING_DELETING_ADMIN_MESSAGES_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="disallow_edition_deleting_admin_messages" value="0" {DISALLOW_EDITING_DELETING_ADMIN_MESSAGES_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center">
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>

</table><table id="quickpostinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_QP_SETTINGS}</th>
	</tr>
	<!-- BEGIN quick_post -->
	<tr>
		<td class="row1">{quick_post.L_QP_TITLE}<br /><span class="gensmall">{quick_post.L_QP_DESC}</span></td>
		<td class="row2" width="45%"><table width="100%" cellspacing="0" cellpadding="0" border="0">
		  <tr>
		  	<td><span class="gensmall">{L_QP_USER}</span></td>
		  	<td width="100%">
		  		<input type="radio" name="{quick_post.USER_QP_VAR}" value="1" {quick_post.USER_QP_YES} />
					<span class="genmed">{L_YES}</span>&nbsp;
		  		<input type="radio" name="{quick_post.USER_QP_VAR}" value="0" {quick_post.USER_QP_NO} />
					<span class="genmed">{L_NO}</span>
		  	</td>
		  </tr>
		  <tr>
			<td><span class="gensmall">{L_QP_ANON}</span></td>
			<td width="100%">
				<input type="radio" name="{quick_post.ANON_QP_VAR}" value="1" {quick_post.ANON_QP_YES} />
				<span class="genmed">{L_YES}</span>&nbsp;
				<input type="radio" name="{quick_post.ANON_QP_VAR}" value="0" {quick_post.ANON_QP_NO} />
				<span class="genmed">{L_NO}</span>
			</td>
		  </tr>
		</table></td>
	</tr>
	<!-- END quick_post -->
	<tr>
		<td class="catBottom" colspan="2" align="center">
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>

</table><table id="smilesinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_SMILEY_CONFIGURATION}</th>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_SMILIES}</td>
		<td class="row2" width="45%">
		<input type="radio" name="allow_smilies" value="1"{SMILE_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="allow_smilies" value="0"{SMILE_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_SMILIES_PATH}<br /><span class="gensmall">{L_SMILIES_PATH_EXPLAIN}</span></td>
		<td class="row2">
		<input class="post" type="text" size="20" maxlength="255" name="smilies_path" value="{SMILIES_PATH}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_SMILEY_TABLE_COLUMNS}</td>
		<td class="row2">
		<input class="post" type="text" size="3" maxlength="2" name="smilie_columns" value="{SMILEY_COLUMNS}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_SMILEY_TABLE_ROWS}</td>
		<td class="row2">
		<input class="post" type="text" size="3" maxlength="2" name="smilie_rows" value="{SMILEY_ROWS}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_SMILEY_POSTING}</td>
		<td class="row2"><select name="smilie_posting">
		<option value="0"{SMILEY_NOTHING1}>{L_SMILEY_NOTHING}</option>
		<option value="1"{SMILEY_BUTTONS1}>{L_SMILEY_BUTTON}</option>
		<option value="2"{SMILEY_DROPDOWN1}>{L_SMILEY_DROPDOWN}</option>
		</select></td>
	</tr>
	<tr>
		<td class="row1">{L_SMILEY_POPUP}</td>
		<td class="row2"><select name="smilie_popup">
		<option value="0"{SMILEY_NOTHING2}>{L_SMILEY_NOTHING}</option>
		<option value="1"{SMILEY_BUTTONS2}>{L_SMILEY_BUTTON}</option>
		<option value="2"{SMILEY_DROPDOWN2}>{L_SMILEY_DROPDOWN}</option>
		</select></td>
	</tr>
	<tr> 
		<td class="row1">{L_SMILEY_BUTTONS}</td>
		<td class="row2">
		<input type="radio" name="smilie_buttons" value="2"{SMILEY_BUTTONS_ICON} /> {L_BUTTONS_ICON}&nbsp;&nbsp;
		<input type="radio" name="smilie_buttons" value="1"{SMILEY_BUTTONS_NAME} /> {L_BUTTONS_NAME}&nbsp;&nbsp;
		<input type="radio" name="smilie_buttons" value="0"{SMILEY_BUTTONS_NUMBER} /> {L_BUTTONS_NUMBER}
		</td>
	</tr>
	<tr>
		<td class="row1">{L_SMILIES_ICON_PATH}<br />
		<span class="gensmall">{L_SMILIES_ICON_PATH_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" size="20" maxlength="255" name="smilie_icon_path" value="{SMILIES_ICON_PATH}" />
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_MAX_SMILIES}</td>
		<td class="row2">
		<input class="post" type="text" name="max_smilies" size="3" maxlength="4" value="{MAX_SMILIES}" />
		</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center">
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>

</table><table id="basicinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_ABILITIES_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_MAX_POLL_OPTIONS}</td>
		<td class="row2" width="45%">
		<input class="post" type="text" name="max_poll_options" size="4" maxlength="4" value="{MAX_POLL_OPTIONS}" />
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_HTML}</td>
		<td class="row2">
    <input type="radio" name="allow_html" value="1" {HTML_YES} />
    <span class="genmed">{L_YES}</span>&nbsp;
    <input type="radio" name="allow_html" value="0" {HTML_NO} />
    <span class="genmed">{L_NO}</span>
    </td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOWED_TAGS}<br />
		<span class="gensmall">{L_ALLOWED_TAGS_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" size="30" maxlength="255" name="allow_html_tags" value="{HTML_TAGS}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_BBCODE}</td>
		<td class="row2">
		<input type="radio" name="allow_bbcode" value="1" {BBCODE_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="allow_bbcode" value="0" {BBCODE_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_SIG}</td>
		<td class="row2">
		<input type="radio" name="allow_sig" value="1" {SIG_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="allow_sig" value="0" {SIG_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_MAX_SIG_LENGTH}<br />
		<span class="gensmall">{L_MAX_SIG_LENGTH_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" size="5" maxlength="4" name="max_sig_chars" value="{SIG_SIZE}" />
		</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center">
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>

</table><table id="coppainfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_COPPA_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_COPPA_FAX}</td>
		<td class="row2" width="45%">
		<input class="post" type="text" size="25" maxlength="100" name="coppa_fax" value="{COPPA_FAX}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_COPPA_MAIL}<br />
		<span class="gensmall">{L_COPPA_MAIL_EXPLAIN}</span>
		</td>
		<td class="row2">
		<textarea name="coppa_mail" rows="5" cols="30">{COPPA_MAIL}</textarea>
		</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center">
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>

</table><table id="emailinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_EMAIL_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_ADMIN_EMAIL}</td>
		<td class="row2" width="45%">
		<input class="post" type="text" size="25" maxlength="100" name="board_email" value="{EMAIL_FROM}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_EMAIL_SIG}<br />
		<span class="gensmall">{L_EMAIL_SIG_EXPLAIN}</span>
		</td>
		<td class="row2">
		<textarea name="board_email_sig" rows="5" cols="30">{EMAIL_SIG}</textarea>
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_BOARD_EMAIL_FORM}<br />
		<span class="gensmall">{L_BOARD_EMAIL_FORM_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input type="radio" name="board_email_form" value="1" {BOARD_EMAIL_FORM_ENABLE} />
		<span class="genmed">{L_ENABLED}</span>&nbsp;
		<input type="radio" name="board_email_form" value="0" {BOARD_EMAIL_FORM_DISABLE} />
		<span class="genmed">{L_DISABLED}</span>
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_USE_SMTP}<br />
		<span class="gensmall">{L_USE_SMTP_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input type="radio" name="smtp_delivery" value="1" {SMTP_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="smtp_delivery" value="0" {SMTP_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_SMTP_SERVER}</td>
		<td class="row2">
		<input class="post" type="text" name="smtp_host" value="{SMTP_HOST}" size="25" maxlength="50" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_SMTP_USERNAME}<br />
		<span class="gensmall">{L_SMTP_USERNAME_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" name="smtp_username" value="{SMTP_USERNAME}" size="25" maxlength="255" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_SMTP_PASSWORD}<br />
		<span class="gensmall">{L_SMTP_PASSWORD_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="password" name="smtp_password" value="{SMTP_PASSWORD}" size="25" maxlength="255" />
		</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center">
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>

</table><table id="birthdayinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_BDAY_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_BDAY_GREETING}<br />
		<span class="gensmall">{L_BDAY_GREETING_EXPLAIN}</span>
		</td>
		<td class="row2" width="45%">
			<input type="radio" name="bday_greeting" value="1" {BDAY_GREETING_YES} />
			<span class="genmed">{L_YES}</span>&nbsp;
			<input type="radio" name="bday_greeting" value="0" {BDAY_GREETING_NO} />
			<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_BDAY_MIN_AGE}</td>
		<td class="row2">
		<input class="post" type="text" size="4" maxlength="4" name="bday_min_age" value="{BDAY_MIN_AGE}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_BDAY_MAX_AGE}</td>
		<td class="row2">
		<input class="post" type="text" size="4" maxlength="4" name="bday_max_age" value="{BDAY_MAX_AGE}" />
		</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center">
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>

</table><table id="wpminfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_WPM}</th>
	</tr>
	<tr> 
    <td class="row1">{L_WPM_ACTIVE}</td> 
		<td class="row2">
		<input type="radio" name="wpm_active" value="1" {WPM_ACTIVE_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="wpm_active" value="0" {WPM_ACTIVE_NO} />
		<span class="genmed">{L_NO}</span>
	</tr>
  <tr>
    <td class="row1">{L_WPM_SUBJECT}</td>
    <td class="row2">
		<input type="text" class="post" size="40" maxlength="255" name="wpm_subject" value="{WPM_SUBJECT}" />
		</td>
  </tr>
  <tr>
    <td class="row1">{L_WPM_MESSAGE}</td>
    <td class="row2">
		<textarea name="wpm_message" rows="7" cols="70">{WPM_MESSAGE}</textarea>
		</td>
  </tr>
	<tr>
		<td class="catBottom" colspan="2" align="center">
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>

</table><table id="cellinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_CELL}</th>
	</tr>
	<tr>
		<td class="row1">{L_CELL_BARS}</td>
		<td class="row2" width="45%">
			<input type="radio" name="cell_allow_display_bars" value="1" {CELL_BARS_YES} />
			<span class="genmed">{L_YES}</span>&nbsp;
			<input type="radio" name="cell_allow_display_bars" value="0" {CELL_BARS_NO} />
			<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_CELL_CELLEDS}</td>
		<td class="row2">
			<input type="radio" name="cell_allow_display_celleds" value="1" {CELL_CELLEDS_YES} />
			<span class="genmed">{L_YES}</span>&nbsp;
			<input type="radio" name="cell_allow_display_celleds" value="0" {CELL_CELLEDS_NO} />
			<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_CELL_CAUTION}</td>
		<td class="row2">
			<input type="radio" name="cell_allow_user_caution" value="1" {CELL_CAUTION_YES} />
			<span class="genmed">{L_YES}</span>&nbsp;
			<input type="radio" name="cell_allow_user_caution" value="0" {CELL_CAUTION_NO} />
			<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_CELL_JUDGE}</td>
		<td class="row2">
			<input type="radio" name="cell_allow_user_judge" value="1" {CELL_JUDGE_YES} />
			<span class="genmed">{L_YES}</span>&nbsp;
			<input type="radio" name="cell_allow_user_judge" value="0" {CELL_JUDGE_NO} />
			<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_CELL_VOTERS}</td>
		<td class="row2">
		<input class="post" type="text" size="8" maxlength="8" name="cell_user_judge_voters" value="{CELL_VOTERS}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_CELL_POSTS}</td>
		<td class="row2">
		<input class="post" type="text" size="8" maxlength="8" name="cell_user_judge_posts" value="{CELL_POSTS}" />
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_CELL_BLANK}</td>
		<td class="row2">
			<input type="radio" name="cell_allow_user_blank" value="1" {CELL_BLANK_YES} />
			<span class="genmed">{L_YES}</span>&nbsp;
			<input type="radio" name="cell_allow_user_blank" value="0" {CELL_BLANK_NO} />
			<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_CELL_BLANK_SUM}</td>
		<td class="row2">
		<input class="post" type="text" size="8" maxlength="8" name="cell_amount_user_blank" value="{CELL_BLANK_SUM}" />
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_CELL_ACCESS}</td>
		<td class="row2"><select name="cell_access">
			<option {CELL_ACCESS_ALL} value="-1">{L_PUBLIC}</option>
			<option {CELL_ACCESS_REG} value="0">{L_REGISTERED}</option>
			<option {CELL_ACCESS_MOD} value="2">{L_MODERATOR}</option>
			<option {CELL_ACCESS_ADMIN} value="1">{L_ADMINISTRATOR}</option>
		</select></td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center">
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>

</table><table id="pointsinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_SYS_SETTINGS}</th>
	</tr>
  <tr>
		<td class="row1">{L_ENABLE_POST}<br />
		<span class="gensmall">{L_ENABLE_POST_EXPLAIN}</span>
		</td>
		<td class="row2" width="45%">
		<input type="radio" name="points_post" value="1" {S_POINTS_POST_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="points_post" value="0" {S_POINTS_POST_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
  </tr>
	<tr>
		<td class="row1">{L_ENABLE_BROWSE}<br />
		<span class="gensmall">{L_ENABLE_BROWSE_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input type="radio" name="points_browse" value="1" {S_POINTS_BROWSE_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="points_browse" value="0" {S_POINTS_BROWSE_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_ENABLE_DONATION}<br />
		<span class="gensmall">{L_ENABLE_DONATION_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input type="radio" name="points_donate" value="1" {S_POINTS_DONATE_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="points_donate" value="0" {S_POINTS_DONATE_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_POINTS_NAME}<br />
		<span class="gensmall">{L_POINTS_NAME_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" maxlength="100" name="points_name" value="{S_POINTS_NAME}" /> 
		</td>
	</tr>
	<tr>
		<td class="row1">{L_PER_REPLY}<br />
		<span class="gensmall">{L_PER_REPLY_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" name="points_reply" size="3" maxlength="4" value="{S_POINTS_REPLY}" /> 
		</td>
	</tr>
	<tr>
		<td class="row1">{L_PER_TOPIC}<br />
		<span class="gensmall">{L_PER_TOPIC_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" name="points_topic" size="3" maxlength="4" value="{S_POINTS_TOPIC}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_PER_PAGE}<br />
		<span class="gensmall">{L_PER_PAGE_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" name="points_page" size="3" maxlength="4" value="{S_POINTS_PAGE}" /> 
		</td>
	</tr>
	<tr>
		<td class="row1">{L_USER_GROUP_AUTH}<br />
		<span class="gensmall">{L_USER_GROUP_AUTH_EXPLAIN}</span>
		</td>
		<td class="row2">
		<textarea name="points_user_group_auth_ids">{S_USER_GROUP_AUTH}</textarea> 
		</td>
	</tr>
	<tr> 
		<td class="row1">{L_POINTS_RESET}<br />
		<span class="gensmall">{L_POINTS_RESET_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" maxlength="100" name="reset_points" /> 
		</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center">
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>

</table><table id="shoutboxinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_SHOUTBOX_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_SHOUTBOX_ON}</td>
		<td class="row2" width="45%">
		<input type="radio" name="shoutbox_on" value="1" {SHOUTBOX_ON_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="shoutbox_on" value="0" {SHOUTBOX_ON_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr> 
		<td class="row1">{L_DATE_ON}</td> 
		<td class="row2">
		<input type="radio" name="shoutbox_date_on" value="1" {DATE_ON_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="shoutbox_date_on" value="0" {DATE_ON_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr> 
	<tr>
		<td class="row1">{L_MAKE_LINKS}</td>
		<td class="row2">
		<input type="radio" name="shoutbox_make_links" value="1" {MAKE_LINKS_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="shoutbox_make_links" value="0" {MAKE_LINKS_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_LINKS_NAMES}</td>
		<td class="row2">
		<input type="radio" name="shoutbox_links_names" value="1" {LINKS_NAMES_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="shoutbox_links_names" value="0" {LINKS_NAMES_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_SMILIES}</td>
		<td class="row2">
		<input type="radio" name="shoutbox_allow_smilies" value="1" {ALLOW_SMILIES_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="shoutbox_allow_smilies" value="0" {ALLOW_SMILIES_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr> 
		<td class="row1">{L_ALLOW_BBCODE}</td> 
		<td class="row2">
		<input type="radio" name="shoutbox_allow_bbcode" value="1" {ALLOW_BBCODE_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="shoutbox_allow_bbcode" value="0" {ALLOW_BBCODE_NO} />
		<span class="genmed">{L_NO}</span>
		</td> 
	</tr> 
	<tr>
		<td class="row1">{L_ALLOW_EDIT}</td>
		<td class="row2">
		<input type="radio" name="shoutbox_allow_edit" value="1" {ALLOW_EDIT_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="shoutbox_allow_edit" value="0" {ALLOW_EDIT_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_EDIT_ALL}</td>
		<td class="row2">
		<input type="radio" name="shoutbox_allow_edit_all" value="1" {ALLOW_EDIT_ALL_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="shoutbox_allow_edit_all" value="0" {ALLOW_EDIT_ALL_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_DELETE}</td>
		<td class="row2">
		<input type="radio" name="shoutbox_allow_delete" value="1" {ALLOW_DELETE_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="shoutbox_allow_delete" value="0" {ALLOW_DELETE_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_DELETE_ALL}</td>
		<td class="row2">
		<input type="radio" name="shoutbox_allow_delete_all" value="1" {ALLOW_DELETE_ALL_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="shoutbox_allow_delete_all" value="0" {ALLOW_DELETE_ALL_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_GUEST}</td>
		<td class="row2">
		<input type="radio" name="shoutbox_allow_guest" value="1" {ALLOW_GUEST_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="shoutbox_allow_guest" value="0" {ALLOW_GUEST_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_GUEST_VIEW}</td>
		<td class="row2">
		<input type="radio" name="shoutbox_allow_guest_view" value="1" {ALLOW_GUEST_VIEW_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="shoutbox_allow_guest_view" value="0" {ALLOW_GUEST_VIEW_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_SHOUT_MESSAGES_ON_INDEX}</td>
		<td class="row2">
		<input type="text" class="post" name="shoutbox_messages_number_on_index" value="{SHOUT_MESSAGES_ON_INDEX}" size="4" maxlength="255" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_DELETE_DAYS}</td>
		<td class="row2">
		<input type="text" class="post" name="shoutbox_delete_days" value="{DELETE_DAYS}" size="4" maxlength="255" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_TEXT_LENGHT}</td>
		<td class="row2">
		<input type="text" class="post" name="shoutbox_text_lenght" value="{TEXT_LENGHT}" size="4" maxlength="255" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_WORD_LENGHT}</td>
		<td class="row2">
		<input type="text" class="post" name="shoutbox_word_lenght" value="{WORD_LENGHT}" size="4" maxlength="255" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_DATE_FORMAT}</td>
		<td class="row2">
		<input type="text" class="post" name="shoutbox_date_format" value="{DATE_FORMAT}" size="10" maxlength="255" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_SHOUT_REFRESH_TIME}</td>
		<td class="row2">
		<input type="text" class="post" name="shoutbox_refresh_time" value="{SHOUT_REFRESH_TIME}" size="10" maxlength="255" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_SHOUT_SIZE}</td>
		<td class="row2">
		<input type="text" class="post" name="shoutbox_width" value="{SHOUT_WIDTH}" size="4" maxlength="255" /> x <input type="text" class="post" name="shoutbox_height" value="{SHOUT_HEIGHT}" size="4" maxlength="255" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_BANNED_USER_ID}
		<br />
		<span class="gensmall">{L_BANNED_USER_ID_E}</span>
		</td>
		<td class="row2">
		<input type="text" class="post" name="shoutbox_banned_user_id" value="{BANNED_USER_ID}" size="25" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_BANNED_USER_ID_VIEW}
		<br />
		<span class="gensmall">{L_BANNED_USER_ID_VIEW_E}</span>
		</td>
		<td class="row2">
		<input type="text" class="post" name="shoutbox_banned_user_id_view" value="{BANNED_USER_ID_VIEW}" size="25" />
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_SHOUTBOX_ACCESS}</td>
		<td class="row2"><select name="shoutbox_access">
			<option {SHOUTBOX_ACCESS_ALL} value="-1">{L_PUBLIC}</option>
			<option {SHOUTBOX_ACCESS_REG} value="0">{L_REGISTERED}</option>
			<option {SHOUTBOX_ACCESS_MOD} value="2">{L_MODERATOR}</option>
			<option {SHOUTBOX_ACCESS_ADMIN} value="1">{L_ADMINISTRATOR}</option>
		</select></td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center">
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>

</table><table id="restrictioninfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_RESTRICTION_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_MEMBERLIST_ACCESS}</td>
		<td class="row2" width="45%"><select name="memberlist_access">
			<option {MEMBERLIST_ACCESS_ALL} value="-1">{L_PUBLIC}</option>
			<option {MEMBERLIST_ACCESS_REG} value="0">{L_REGISTERED}</option>
			<option {MEMBERLIST_ACCESS_MOD} value="2">{L_MODERATOR}</option>
			<option {MEMBERLIST_ACCESS_ADMIN} value="1">{L_ADMINISTRATOR}</option>
		</select></td>
	</tr>
	<tr>
		<td class="row1">{L_FAQ_ACCESS}</td>
		<td class="row2"><select name="faq_access">
			<option {FAQ_ACCESS_ALL} value="-1">{L_PUBLIC}</option>
			<option {FAQ_ACCESS_REG} value="0">{L_REGISTERED}</option>
			<option {FAQ_ACCESS_MOD} value="2">{L_MODERATOR}</option>
			<option {FAQ_ACCESS_ADMIN} value="1">{L_ADMINISTRATOR}</option>
		</select></td>
	</tr>
	<tr>
		<td class="row1">{L_PROFILE_ACCESS}</td>
		<td class="row2"><select name="profile_access">
			<option {PROFILE_ACCESS_ALL} value="-1">{L_PUBLIC}</option>
			<option {PROFILE_ACCESS_REG} value="0">{L_REGISTERED}</option>
			<option {PROFILE_ACCESS_MOD} value="2">{L_MODERATOR}</option>
			<option {PROFILE_ACCESS_ADMIN} value="1">{L_ADMINISTRATOR}</option>
		</select></td>
	</tr>
	<tr>
		<td class="row1">{L_GROUPS_ACCESS}</td>
		<td class="row2"><select name="groups_access">
			<option {GROUPS_ACCESS_ALL} value="-1">{L_PUBLIC}</option>
			<option {GROUPS_ACCESS_REG} value="0">{L_REGISTERED}</option>
			<option {GROUPS_ACCESS_MOD} value="2">{L_MODERATOR}</option>
			<option {GROUPS_ACCESS_ADMIN} value="1">{L_ADMINISTRATOR}</option>
		</select></td>
	</tr>
	<tr>
		<td class="row1">{L_SEARCH_ACCESS}</td>
		<td class="row2"><select name="search_access">
			<option {SEARCH_ACCESS_ALL} value="-1">{L_PUBLIC}</option>
			<option {SEARCH_ACCESS_REG} value="0">{L_REGISTERED}</option>
			<option {SEARCH_ACCESS_MOD} value="2">{L_MODERATOR}</option>
			<option {SEARCH_ACCESS_ADMIN} value="1">{L_ADMINISTRATOR}</option>
		</select></td>
	</tr>
	<tr>
		<td class="row1">{L_VIEWONLINE_ACCESS}</td>
		<td class="row2"><select name="viewonline_access">
			<option {VIEWONLINE_ACCESS_ALL} value="-1">{L_PUBLIC}</option>
			<option {VIEWONLINE_ACCESS_REG} value="0">{L_REGISTERED}</option>
			<option {VIEWONLINE_ACCESS_MOD} value="2">{L_MODERATOR}</option>
			<option {VIEWONLINE_ACCESS_ADMIN} value="1">{L_ADMINISTRATOR}</option>
		</select></td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_PM_ALLOW_THRESHOLD}<br />
		<span class="gensmall">{L_PM_ALLOW_TRHESHOLD_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" maxlength="4" size="4" name="pm_allow_threshold" value="{PM_ALLOW_THRESHOLD}" />
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_PRESENT_REQUIRED}<br /></td>
		<td class="row2">
		<input type="radio" name="present_required" value="1" {PRESENT_REQUIRED_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="present_required" value="0" {PRESENT_REQUIRED_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_PRESENT_FORUM}<br />
		<span class="gensmall">{L_PRESENT_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" size="3" maxlength="3" name="present_forum" value="{PRESENT_FORUM}" />
		</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center">
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>

</table><table id="divinfo" style="display:none" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_DIV_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_FORUM_ICON_PATH}<br />
		<span class="gensmall">{L_FORUM_ICON_PATH_EXPLAIN}</span>
		</td>
		<td class="row2" width="45%">
		<input class="post" type="text" size="20" maxlength="255" name="forum_icon_path" value="{FORUM_ICON_PATH}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_MAX_SUBFORUMS}<br />
		<span class="gensmall">{L_MAX_SUBFORUMS_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" name="max_subforums" size="3" maxlength="4" value="{MAX_SUBFORUMS}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_BIN_FORUM}<br />
		<span class="gensmall">{L_BIN_FORUM_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input type="text" class="post" name="bin_forum" size="4" maxlength="4" value="{BIN_FORUM}" />
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_ONLINE_TIME}<br />
		<span class="gensmall">{L_ONLINE_TIME_EXPLAIN}</span>
		</td>
		<td class="row2">
		<input class="post" type="text" size="3" maxlength="4" name="online_time" value="{ONLINE_TIME}" />
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
  <tr>
    <td class="row1">{L_FAVICON_ICON}<br />
		<span class="gensmall">{L_FAVICON_ICON_EXPLAIN}</span>
		</td>
    <td class="row2">
		<input type="text" class="post" size="40" maxlength="255" name="favicon_icon" value="{FAVICON_ICON}" />
		</td>
  </tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_INSTANT_MSG_ENABLE}</td>
		<td class="row2">
		<input type="radio" name="instant_msg_enable" value="1" {INSTANT_MSG_ENABLE_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="instant_msg_enable" value="0" {INSTANT_MSG_ENABLE_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
		<td class="row1">{L_INSTANT_MSG_AUTO_REFRESH}</td>
		<td class="row2">
		<input type="text" class="post" name="instant_msg_refresh_time" size="4" maxlength="4" value="{INSTANT_MSG_AUTO_REFRESH}" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_INSTANT_MSG_AUTOPRUNE}</td>
		<td class="row2">
		<input type="text" class="post" name="instant_msg_delay" size="4" maxlength="4" value="{INSTANT_MSG_AUTOPRUNE}" />
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_WARN_LEVEL}</td>
		<td class="row2">
		<input class="post" type="text" name="card_max" value="{WARN_LEVEL}" size="3" maxlenght="2" />
		</td>
	</tr>
	<tr>
		<td class="row2" colspan="2"></td>
	</tr>
	<tr>
		<td class="row1">{L_NO_GUEST_ON_INDEX}</td>
		<td class="row2">
		<input type="radio" name="no_guest_on_index" value="1" {NO_GUEST_ON_INDEX_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="no_guest_on_index" value="0" {NO_GUEST_ON_INDEX_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
	</tr>
	<tr>
    <td class="row1">{L_GUESTS_NEED_NAME}</td>
    <td class="row2">
		<input type="radio" name="guests_need_name" value="1" {GUESTS_NEED_NAME_YES} />
		<span class="genmed">{L_YES}</span>&nbsp;
		<input type="radio" name="guests_need_name" value="0" {GUESTS_NEED_NAME_NO} />
		<span class="genmed">{L_NO}</span>
		</td>
  </tr>
	<tr>
		<td class="catBottom" colspan="2" align="center">
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>
</table>

</td></tr></table>{S_HIDDEN_FIELDS}
</form>

<br clear="all" />
