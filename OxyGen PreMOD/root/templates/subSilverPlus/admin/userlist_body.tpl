<script language="javascript" type="text/javascript">
<!--

var allAre = 0;
function openAll()
{
	var other_pic = "";
	var list = "";
	if( document.all )
	{
		list = document.all("oI[]")
		for( var i = 0; i < list.length; i++ )
		{
			list[i].click();
		}
	}
	else if( document.getElementsByName )
	{
		other_pic = document.getElementById( "top_folder" );
		list = document.getElementsByName( "oF[]" );
		for( var i = 0; i < list.length; i++ )
		{
			handleClick( list[i].id );
		}
	}

	if( allAre == 0 )
	{
		allAre = 1;
		other_pic.innerHTML = "<img src='{I_ARROW_DOWN}'>";
	}
	else
	{
		allAre = 0;
		other_pic.innerHTML = "<img src='{I_ARROW_RIGHT}'>";
	}
	return;
}

function selectAll()
{
	if( document.getElementsByName )
	{
		var list = document.getElementsByName( 'u[]' );
		for( var i = 0; i < list.length; i++ )
		{
			list[i].checked = !list[i].checked;
		}
	}
}

function handleClick(id)
{
	var obj = "";
	var pic_obj = "";
 
	if( document.getElementById )
	{
		obj = document.getElementById( "user" + id );
		pic_obj = document.getElementById( id );
	}
	else if( document.all )
	{
		obj = document.all[ "user" + id ];
		pic_obj = document.all[ id ];
	}
	else if( document.layers )
	{
		obj = document.layers[ "user" + id ];
		pic_obj = document.layers[ id ];
	}
	else
	{
		return 1;
	}

	if( !obj )
	{
		return 1;
	}
	else if( obj.style )
	{
		if( obj.style.display == "none" )
		{
			obj.style.display = "";
			pic_obj.innerHTML = "<img src='{I_ARROW_DOWN}'>";
		}
		else
		{
			obj.style.display = "none";
			pic_obj.innerHTML = "<img src='{I_ARROW_RIGHT}'>";
		}
	}
	else
	{
		obj.visibility = "show";
	}
}
//-->
</script>

<script language="javascript" type="text/javascript">
<!-- Begin
function menzselector(status)
{
	for (i = 0; i < document.userlistform.length; i++)
	{
		document.userlistform.elements[i].checked = status;
	}
}
//  End -->
</script>

<h1>{L_TITLE}</h1>

<p>{L_DESCRIPTION}</p>

<form action="{S_ACTION}" method="post"><table width="100%" cellpadding="3" cellspacing="1" border="0">
<tr>
	<td width="100%">&nbsp;</td>
	<td align="right" nowrap="nowrap"><span class="gen">{L_SORT_BY}</td>
	<td nowrap="nowrap">{S_SELECT_SORT}</td> 
	<td nowrap="nowrap">{S_SELECT_SORT_ORDER}</td>
	<td nowrap="nowrap"><span class="gen">{L_SHOW}</span></td>
	<td nowrap="nowrap"><input class="post" type="text" size="5" value="{S_SHOW}" name="show" /></td>
	<td nowrap="nowrap">{S_HIDDEN_FIELDS}<input type="submit" value="{S_SORT}" name="change_sort" class="liteoption" /></td>
</tr>
</table></form>

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
<tr>
	<!-- BEGIN alphanumsearch -->
	<td align="left" width="{alphanumsearch.SEARCH_SIZE}"><span class="genmed"><a href="{alphanumsearch.SEARCH_LINK}" class="genmed">{alphanumsearch.SEARCH_TERM}</a></span></td>
	<!-- END alphanumsearch -->
</tr>
</table>

<form name="userlistform" action="{S_ACTION}" method="post"><table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<tr>
	<th width="3%"><input type="checkbox" onclick="javascript:selectAll();" /></th>
	<th width="2%" onClick="javascript:openAll();" id="top_folder"><img src="{I_ARROW_RIGHT}"></th>
	<th width="15%">&nbsp;{L_USERNAME}&nbsp;</th>
	<th width="7%">&nbsp;{L_ACTIVE}&nbsp;</th>
	<th width="15%">&nbsp;{L_JOINED}&nbsp;</th>
	<th width="20%">&nbsp;{L_ACTIVITY}&nbsp;</th>
	<th width="8%">&nbsp;{L_POSTS}&nbsp;</th>
	<th width="15%">&nbsp;{L_EMAIL}&nbsp;</th>
	<th width="25%">&nbsp;{L_REGIP}&nbsp;</th>
</tr>
<!-- BEGIN user_row -->
<tr>
	<td class="{user_row.ROW_CLASS}" align="center" nowrap="nowrap"><input type="checkbox" name="{S_USER_VARIABLE}[]" value="{user_row.USER_ID}" /></td>
	<td class="{user_row.ROW_CLASS}" align="center" nowrap="nowrap">
		<span id="oI[]" onClick="javascript:handleClick('{user_row.USER_ID}');">
		<div id="{user_row.USER_ID}" name="oF[]"><img src="{I_ARROW_RIGHT}">
		</div></span>
	</td>
	<td class="{user_row.ROW_CLASS}" align="center"><span class="gen" {user_row.STYLE_COLOR}><b><a href="{user_row.U_MANAGE}" class="gen" {user_row.STYLE_COLOR}>{user_row.USERNAME}</a></b></span></td>
	<td class="{user_row.ROW_CLASS}" align="center"><span class="gen">{user_row.ACTIVE}</span></td>
	<td class="{user_row.ROW_CLASS}" align="center"><span class="gen">{user_row.JOINED}</span></td>
	<td class="{user_row.ROW_CLASS}" align="center"><span class="gen">{user_row.LAST_ACTIVITY}</span></td>
	<td class="{user_row.ROW_CLASS}" align="center"><span class="gen">{user_row.POSTS}</span></td>
	<td class="{user_row.ROW_CLASS}" align="center"><span class="gen">{user_row.EMAIL}</span></td>
	<td class="{user_row.ROW_CLASS}" align="center"><span class="gen">{user_row.USER_REGIP}</span></td>
</tr>
<tr id="user{user_row.USER_ID}" style="display: none">
	<td class="{user_row.ROW_CLASS}">&nbsp;</td>
	<td class="{user_row.ROW_CLASS}" colspan="8" width="100%"><table  width="100%" cellpadding="3" cellspacing="1" border="0">
	<tr>
		<td class="{user_row.ROW_CLASS}" width="33%"><b class="gen">{L_RANK}:</b>&nbsp;{user_row.RANK}&nbsp;&nbsp;&nbsp;{user_row.I_RANK}</td>
		<td class="{user_row.ROW_CLASS}" width="34%"><b class="gen">{L_GROUP}:</b>
		<!-- BEGIN group_row -->
		<a href="{user_row.group_row.U_GROUP}" class="gen" target="_blank">{user_row.group_row.GROUP_NAME}</a>&nbsp;({user_row.group_row.GROUP_STATUS})<br />
		<!-- END group_row -->
		<!-- BEGIN no_group_row -->
		{user_row.no_group_row.L_NONE}<br />
		<!-- END no_group_row -->
		</td>
		<td class="{user_row.ROW_CLASS}" width="33%"><b class="gen">{L_POSTS}:</b>&nbsp;{user_row.POSTS}&nbsp;&nbsp;&nbsp;<a href="{user_row.U_SEARCH}" class="gen" target="_blank">{L_FIND_ALL_POSTS}</a></td>
	</tr>
	<tr>
		<td class="{user_row.ROW_CLASS}" colspan="3"><b class="gen">{L_WEBSITE}:</b>&nbsp;<a href="{user_row.U_WEBSITE}" class="gen" target="_blank">{user_row.U_WEBSITE}</a></td>
	</tr>
	<tr>
		<td class="{user_row.ROW_CLASS}"><span class="gen">
			<a href="{user_row.U_MANAGE}" class="gen">{L_MANAGE}</a><br /> 
			<a href="{user_row.U_PERMISSIONS}" class="gen">{L_PERMISSIONS}</a><br /> 
			<a href="mailto:{user_row.EMAIL}" class="gen">{L_EMAIL}&nbsp;[&nbsp;{user_row.EMAIL}&nbsp;]</a><br />
			<a href="{user_row.U_PM}" class="gen">{L_PM}</a>
		</span></td>
		<td colspan="2" class="{user_row.ROW_CLASS}">{user_row.I_AVATAR}</td>
	</tr>
	</table></td>
</tr>
<!-- END user_row -->
<tr>
	<td class="catBottom" colspan="9"><table width="100%" cellspacing="0">
	<tr>
		<td class="cattitle" nowrap="nowrap">
			<input type="button" name="SelectAll" value="{L_SELECT_ALL}" class="liteoption" onclick="menzselector(true);" />
			<input type="button" name="DeselectAll" value="{L_DESELECT_ALL}" class="liteoption" onclick="menzselector(false);" /> 
		</td>
		<td class="cattitle" align="right" nowrap="nowrap">
			<select name="mode" class="post">
			<option value="">{L_SELECT}</option>
			<option value="delete">{L_DELETE}</option>
			<option value="ban">{L_BAN}</option>
			<option value="unban">{L_UNBAN}</option> 
			<option value="activate">{L_ACTIVATE_DEACTIVATE}</option>
			<option value="group">{L_ADD_GROUP}</option>
			</select>
			<input type="submit" name="go" value="{L_GO}" class="mainoption" />
		</td>
	</tr>
	</table></td>
</tr>
</table></form> 

<table width="100%" cellpadding="3" cellspacing="1" border="0">
<tr>
	<td align="left" width="50%"><span class="gen">{PAGE_NUMBER}</span></td>
	<td align="right" width="50%"><span class="gen">{PAGINATION}</span></td>
</tr>
</table>
<br clear="all" />
