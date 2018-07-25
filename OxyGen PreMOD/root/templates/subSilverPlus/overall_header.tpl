<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html dir="ltr">
<head>
<title>{SITENAME} :: {PAGE_TITLE}</title>

<link rel="icon" href="{FAVICON_ICON}" type="image/ico" />

<meta http-equiv="Content-Type" content="text/html; charset={S_CONTENT_ENCODING}">
<meta http-equiv="Content-Style-Type" content="text/css">

<meta name="Identifier-URL" content="http://reddevboard.com/">
<meta name="Author" content="reddog - reddevboard.com">
<meta name="Robots" content="all">

<meta name="DC.Creator" content="reddog - reddevboard.com">
<meta name="DC.Rights" content="Attribution-NonCommercial-ShareAlike 2.5, http://creativecommons.org/licenses/by-nc-sa/2.5/">

<meta http-equiv="Content-Language" content="{META_LANGUAGE}" />
<meta name="author" content="{META_AUTHOR}" />
<meta name="keywords" content="{META_KEYWORDS}" />
<meta name="description" content="{META_DESCRIPTION}" />
<meta name="robots" content="{META_ROBOTS}" />
<meta name="rating" content="{META_RATING}" />
<meta name="revisit-after" content="{META_VISIT_AFTER}" />

{META}{NAV_LINKS}
<link rel="stylesheet" type="text/css" href="{STYLE_PATH}/{T_HEAD_STYLESHEET}" media="all">

<link rel="stylesheet" type="text/css" href="./templates/{HYPERCELL_PATH}/hypercell.css" media="screen">
<!--[if IE]>
<style type="text/css" media="screen">
/* This experiment is try to emulate the :hover pseudo-class
   and its dynamic effect on Internet Explorer 5+, because IE support
   :hover only on A (anchor) element */
.hccRow, .hccRow-new, .hccRow-locked, .hccRow-locked-new, .hccRow-moved, .hccRow-link,
.hccRow-announce, .hccRow-announce-new, .hccRow-sticky, .hccRow-sticky-new, .hccRow-hot, .hccRow-hot-new,
.row3Right, .hccRow-right, .hccRow-new-right, .hccRow-locked-right, .hccRow-locked-new-right, .hccRow-moved-right,
.hccRow-announce-right, .hccRow-announce-new-right, .hccRow-sticky-right, .hccRow-sticky-new-right,
.hccRow-hot-right, .hccRow-hot-new-right { behavior: url("./templates/{HYPERCELL_PATH}/hover.htc"); }
</style>
<![endif]-->

<link rel="stylesheet" type="text/css" href="./templates/{T_TEMPLATE_NAME}/rcs_stylesheet.css" media="all">

<script language="javascript" src="templates/transparency.js" type="text/javascript"></script>
<link rel="stylesheet" href="{BBC_BOX_SHEET}" type="text/css">
<script language="javascript" src="templates/bbc_box/fade.js" type="text/javascript"></script>
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="templates/pngfix.js"></script>
<![endif]-->
<script language="javascript" type="text/javascript" src="templates/rmwa_jslib.js"></script>
<script language="javascript" type="text/javascript" src="templates/js_doms_toggles.js"></script>
<script language="javascript" type="text/javascript" src="templates/js_dom_toggle.js"></script>
<script language="javascript" type="text/javascript" src="templates/gradualshine.js"></script>
</head>
<body>

<iframe src="{INSTANT_MSG}" height="0" width="0" frameborder="0"></iframe>

<a name="top" id="top"></a>

<script type="text/javascript">
//<![CDATA[
<!--

var rmw_max_width = '{IMAGES_MAX_SIZE}';
var rmw_border_1 = '1px solid {T_BODY_LINK}';
var rmw_border_2 = '2px dotted {T_BODY_LINK}';
var rmw_image_title = '{L_RMW_IMAGE_TITLE}';

//-->
//]]>
</script>
<script type="text/javascript" src="templates/rmw_jslib.js" type="text/javascript"></script>

<!-- BEGIN switch_enable_pm_popup -->
<table class="pmline" id="new_pm_popup" cellspacing="1" cellpadding="4">
  <tr>
	<td style="height:100px; width:300px;"><span class="gen">
		<a href="{U_PRIVATEMSGS}" class="gen">{PRIVATE_MESSAGE_INFO}</a><br /><br />
		<a href="" onClick="getElementById('new_pm_popup').style.display = 'none'; return false;" class="genmed"><img alt="" src="{I_CLOSE}" border="0" /></a>
	</span></td>
  </tr>
</table> 

<script language="javascript" type="text/javascript">
<!--
	if ( {PRIVATE_MESSAGE_NEW_FLAG} ) 
	{ 
		pmWindow = window.open('{U_PRIVATEMSGS_POPUP}', '_phpbbprivmsg', 'HEIGHT=225,resizable=yes,WIDTH=400');
		if (!window.pmWindow)
		{ 
			document.getElementById('new_pm_popup').style.display = 'inline'; 
		} 
	} 
//-->
</script>
<!-- END switch_enable_pm_popup -->

<table width="100%" cellspacing="0" cellpadding="10" border="0" align="center">
  <tr>
	<td class="bodyline"><table width="100%" cellspacing="0" cellpadding="0" border="0">
	  <tr>
		<td><a href="{U_INDEX}"><img src="{SITE_LOGO}" border="0" alt="{SITENAME}" title="{SITENAME}" /></a></td>
		<td align="center" width="100%" valign="middle">
			<span class="maintitle">{SITENAME}</span><br /><span class="gen">{SITE_DESCRIPTION}<br /></span>
			<table cellspacing="5" cellpadding="2" border="0">
			  <tr>
				<td align="center" valign="top" nowrap="nowrap"><span class="mainmenu">
					<!-- BEGIN switch_faq -->
					<a href="{U_FAQ}" alt="{L_FAQ}" title="{L_FAQ}" class="mainmenu"><img src="{I_FAQ}" border="0" hspace="3" class="absbottom" />{L_FAQ}</a>
					<!-- END switch_faq -->
					<!-- BEGIN switch_search -->
					&nbsp;<a href="{U_SEARCH}" alt="{L_SEARCH}" title="{L_SEARCH}" class="mainmenu"><img src="{I_SEARCH}" border="0" hspace="3" class="absbottom" />{L_SEARCH}</a>
					<!-- END switch_search -->
					<!-- BEGIN switch_memberlist -->
					&nbsp;<a href="{U_MEMBERLIST}" alt="{L_MEMBERLIST}" title="{L_MEMBERLIST}" class="mainmenu"><img src="{I_MEMBERS}" border="0" hspace="3" class="absbottom" />{L_MEMBERLIST}</a>
					<!-- END switch_memberlist -->
					<!-- BEGIN switch_groups -->
					&nbsp;<a href="{U_GROUP_CP}" alt="{L_USERGROUPS}" title="{L_USERGROUPS}" class="mainmenu"><img src="{I_GROUPS}" border="0" hspace="3" class="absbottom" />{L_USERGROUPS}</a>
					<!-- END switch_groups -->
					<!-- BEGIN switch_cell -->
					&nbsp;<a href="{U_COURTHOUSE}" alt="{L_COURTHOUSE}" title="{L_COURTHOUSE}" class="mainmenu"><img src="{I_COURTHOUSE}" border="0" hspace="3" class="absbottom" />{L_COURTHOUSE}</a>
					<!-- END switch_cell -->
					<!-- BEGIN switch_user_logged_out -->
					&nbsp;<a href="{U_REGISTER}" alt="{L_REGISTER}" title="{L_REGISTER}" class="mainmenu"><img src="{I_REGISTER}" border="0" hspace="3" class="absbottom" />{L_REGISTER}</a>
					<!-- END switch_user_logged_out -->
				</span></td>
			  </tr>
			  <tr>
				<td align="center" valign="top" nowrap="nowrap"><span class="mainmenu">
					<a href="{U_PROFILE}" alt="{L_PROFILE}" title="{L_PROFILE}" class="mainmenu"><img src="{I_PROFILE}" border="0" hspace="3" class="absbottom" />{L_PROFILE}</a>
					&nbsp;<a href="{U_PRIVATEMSGS}" alt="{PRIVATE_MESSAGE_INFO}" title="{PRIVATE_MESSAGE_INFO}" class="mainmenu"><img src="{PRIVMSG_IMG}" border="0" hspace="3" class="absbottom" />{PRIVATE_MESSAGE_INFO}</a>
					<!-- BEGIN switch_admin_link -->
					&nbsp;<a href="{U_ADMIN_LINK}" alt="{L_ADMIN_LINK}" title="{L_ADMIN_LINK}" class="mainmenu"><img src="{I_ADMIN_LINK}" border="0" hspace="3" class="absbottom" />{L_ADMIN_LINK}</a>
					<!-- END switch_admin_link -->
					&nbsp;<a href="{U_LOGIN_LOGOUT}" alt="{L_LOGIN_LOGOUT}" title="{L_LOGIN_LOGOUT}" class="mainmenu"><img src="{I_LOGIN}" border="0" hspace="3" class="absbottom" />{L_LOGIN_LOGOUT}</a>
				</span></td>
			  </tr>
			</table>
			<br class="nav" />
		</td>
	  </tr>
	</table>
