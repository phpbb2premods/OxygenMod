<!-- $Id: userlist_view.tpl,v 0.2 28/11/2006 18:34 reddog Exp $ -->

{NAVIGATION_BOX}
<table class="forumline cells" width="100%" cellspacing="1">
<tr>
	<td class="row1 abstop">
		<!-- BEGIN avatar --><div class="float_right_auto"><img onload="rmwa_img_loaded(this,{AVATAR_MAX_WIDTH},{AVATAR_MAX_HEIGHT})" src="{USER_AVATAR}" alt="" /></div><!-- END avatar -->
	<span class="maintitle">{USERNAME_STYLED}
	<!-- BEGIN rank -->
	</span><br /><span class="genmed">
		{L_USER_RANK}
		<!-- BEGIN img --><br /><img src="{I_USER_RANK}" alt="" title="{L_USER_RANK}" /><!-- END img -->
	<!-- END rank -->
		<br /><br class="both" />
	</span></td>
</tr>
</table>
<br class="both" />
<div class="float_left" style="width:39%;">
<table class="forumline cells" width="100%" cellspacing="1" cellpadding="3">
<tr>
	<th class="thHead">{L_PROFILE}</th>
</tr>
<tr>
	<td class="row1"><table class="subcells" cellspacing="1">
	<tr>
		<td class="abstop hright nowrap"><span class="gen">{L_USERNAME}:</span></td>
		<td width="100%"><span class="gen">{USERNAME_STYLED}</span></td>
	</tr>
	<!-- BEGIN from -->
	<tr>
		<td class="abstop hright nowrap"><span class="gen">{L_FROM}:</span></td>
		<td width="100%"><b class="gen">{USER_FROM}</b></td>
	</tr>
	<!-- END from -->
	<tr>
		<td class="abstop hright nowrap"><span class="gen">{L_COUNTRY}:</span></td>
		<td width="100%"><b class="gen">{USER_COUNTRY}</b>&nbsp;
		<img src="images/flags/{USER_FLAG}.png" alt="{USER_COUNTRY}" title="{USER_COUNTRY}" width="18" height="12" border="0" />
		</td>
	</tr>
	<!-- BEGIN occupation -->
	<tr>
		<td class="abstop hright nowrap"><span class="gen">{L_OCCUPATION}:</span></td>
		<td width="100%"><b class="gen">{USER_OCC}</b></td>
	</tr>
	<!-- END occupation -->
	<!-- BEGIN interests -->
	<tr>
		<td class="abstop hright nowrap"><span class="gen">{L_INTERESTS}:</span></td>
		<td width="100%"><b class="gen">{USER_INTERESTS}</b></td>
	</tr>
	<!-- END interests -->
	<!-- BEGIN www -->
	<tr>
		<td class="absmiddle hright nowrap"><span class="gen">{L_WEBSITE}:</span></td>
		<td width="100%"><span class="gen">
			<a href="{U_WWW}" class="gen"><img src="{I_USER_WWW}" alt="{L_USER_WWW}" title="{L_USER_WWW}" /></a>
		</span></td>
	</tr>
	<!-- END www -->
	<!-- BEGIN user_is_admin -->
	<form method="post" action="{S_PROFILE_ACTION}">
	<tr>
		<td class="absmiddle hright nowrap"><span class="gen">{L_RANK_COLOR}:</span></td>
		<td width="100%"><span class="gen">
			{LIST_BOX}
			<input type="image" src="{I_MINI_SUBMIT}" name="change_individual" alt="{L_CHANGE_INDIVIDUAL}" title="{L_CHANGE_INDIVIDUAL}" class="absbottom" />
		</span></td>
	</tr>
	</form>
	<!-- END user_is_admin -->
	</table></td>
</tr>
</table>
<br style="clear:both;" />
<table class="forumline cells" width="100%" cellspacing="1">
<tr>
	<th class="thHead">{L_CONTACT}</th>
</tr>
<tr>
	<td class="row1"><table class="subcells" cellspacing="1">
	<!-- BEGIN email -->
	<tr>
		<td class="absmiddle hright nowrap"><span class="gen">{L_EMAIL}:</span></td>
		<td width="100%"><span class="gen">
			<a href="{U_EMAIL}" class="gen"><img src="{I_USER_EMAIL}" alt="{L_USER_EMAIL}" title="{L_USER_EMAIL}" /></a>
		</span></td>
	</tr>
	<!-- END email -->
	<tr>
		<td class="absmiddle hright nowrap"><span class="gen">{L_PM}:</span></td>
		<td width="100%"><span class="gen">
			<a href="{U_PM}" class="gen"><img src="{I_USER_PM}" alt="{L_USER_PM}" title="{L_USER_PM}" /></a>
		</span></td>
	</tr>
	<!-- BEGIN msn -->
	<tr>
		<td class="absmiddle hright nowrap"><span class="gen">{L_MSNM}:</span></td>
		<td width="100%"><span class="gen">
			<a href="{U_MSN}" class="gen"><img src="{I_USER_MSN}" alt="{L_USER_MSN}" title="{L_USER_MSN}" /></a>
		</span></td>
	</tr>
	<!-- END msn -->
	<!-- BEGIN skype -->
	<tr>
		<td class="absmiddle hright nowrap"><span class="gen">{L_SKYPE}:</span></td>
		<td width="100%"><span class="gen">
			<a href="{U_SKYPE}" class="gen"><img src="{I_USER_SKYPE}" alt="{L_USER_SKYPE}" title="{L_USER_SKYPE}" /></a>
		</span></td>
	</tr>
	<!-- END skype -->
	<!-- BEGIN yim -->
	<tr>
		<td class="absmiddle hright nowrap"><span class="gen">{L_YIM}:</span></td>
		<td width="100%"><span class="gen">
			<a href="{U_YIM}" class="gen"><img src="{I_USER_YIM}" alt="{L_USER_YIM}" title="{L_USER_YIM}" /></a>
		</span></td>
	</tr>
	<!-- END yim -->
	<!-- BEGIN aim -->
	<tr>
		<td class="absmiddle hright nowrap"><span class="gen">{L_AIM}:</span></td>
		<td width="100%"><span class="gen">
			<a href="{U_AIM}" class="gen"><img src="{I_USER_AIM}" alt="{L_USER_AIM}" title="{L_USER_AIM}" /></a>
		</span></td>
	</tr>
	<!-- END aim -->
	<!-- BEGIN icq -->
	<tr>
		<td class="absmiddle hright nowrap"><span class="gen">{L_ICQ}:</span></td>
		<td width="100%">
			<div style="position:relative;"><a href="{U_ICQ}" class="gen"><img src="{I_USER_ICQ}" alt="{L_USER_ICQ}" title="{L_USER_ICQ}" /></a><div id="icq_status_user" style="position:absolute; left:3px; top:-1px; display:none;"><a href="{U_ICQ_STATUS}"><img src="{I_ICQ_STATUS}" alt="" width="18" height="18" /></a></div></div>
		</td>
	</tr>
	<!-- END icq -->
	</table></td>
</tr>
</table>
</div>
<div class="float_right" style="width:59%;">
<table class="forumline cells" width="100%" cellspacing="1">
<tr>
	<th class="thHead">{L_USER_STATS}</th>
</tr>
<tr>
	<td class="row1"><table class="subcells" cellspacing="1">
	<tr>
		<td class="abstop hright nowrap"><span class="gen">{L_JOINED}:</span></td>
		<td width="100%"><b class="gen">{USER_JOINED}</b></td>
	</tr>
	<tr>
		<td class="abstop hright nowrap"><span class="gen">{L_VISITED}:</span></td>
		<td width="100%"><b class="gen">{VISITED}</b></td>
	</tr>
	<tr>
		<td class="abstop hright nowrap"><span class="gen">{L_TOTAL_POSTS}:</span></td>
		<td width="100%"><b class="gen">{USER_POSTS}</b><br />
		<!-- BEGIN load_statistics -->
		<span class="genmed">
			[{POSTS_PCT} / {POST_DAY}]<br />
			<a href="{U_SEARCH_AUTHOR}" class="genmed">{L_SEARCH_AUTHOR}</a>
		<!-- END load_statistics -->
		</span></td>
	</tr>
	<!-- BEGIN load_activity -->
	<!-- BEGIN f_most_active -->
	<tr>
		<td class="abstop hright nowrap"><span class="gen">{L_ACTIVE_IN_FORUM}:</span></td>
		<td width="100%"><b class="gen"><a href="{U_ACTIVE_FORUM}" class="gen">{ACTIVE_FORUM}</a></b><br />
		<span class="genmed">
			[ {ACTIVE_FORUM_POSTS} / {ACTIVE_FORUM_PCT} ]
		</span></td>
	</tr>
	<!-- END f_most_active -->
	<!-- BEGIN t_most_active -->
	<tr>
		<td class="abstop hright nowrap"><span class="gen">{L_ACTIVE_IN_TOPIC}:</span></td>
		<td width="100%"><b class="gen"><a href="{U_ACTIVE_TOPIC}" class="gen">{ACTIVE_TOPIC}</a></b><br />
		<span class="genmed">
			[ {ACTIVE_TOPIC_POSTS} / {ACTIVE_TOPIC_PCT} ]
		</span></td>
	</tr>
	<!-- END t_most_active -->
	<!-- END load_activity -->
	</table></td>
</tr>
</table>
<!-- BEGIN signature -->
<br class="both" />
<table class="forumline cells" width="100%" cellspacing="1">
<tr>
	<th class="thHead">{L_SIGNATURE}</th>
</tr>
<tr>
	<td class="row1"><span class="gen">{SIGNATURE}</span></td>
</tr>
</table>
<!-- END signature -->
</div>
<br class="both" />
<script type="text/javascript">
//<![CDATA[
<!--//
function _icq()
{
	this.ids = new Array();
	return this;
}
	_icq.prototype.objref = function(id)
	{
		return document.getElementById ? document.getElementById(id) : (document.all ? document.all[id] : (document.layers ? document.layers[id] : null));
	}
	_icq.prototype.display_status = function()
	{
		if ( (navigator.userAgent.toLowerCase().indexOf('mozilla') == -1) || (navigator.userAgent.indexOf('5.') != -1) || (navigator.userAgent.indexOf('6.') != -1) )
		{
			for ( i = 1; i < this.ids.length; i++ )
			{
				icq_status = this.objref(this.ids[i]);
				if ( icq_status && icq_status.style )
				{
					icq_status.style.display = '';
				}
			}
		}
	}

icq_status = new _icq();
icq_status.ids = Array('', 'icq_status_user');
icq_status.display_status();
//-->
//]]>
</script>
