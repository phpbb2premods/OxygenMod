<form action="{S_COURTHOUSE_ACTION}" method="post">
<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center">
	<tr> 
		<td align="left"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a href="{U_COURTHOUSE}" class="nav">{L_COURTHOUSE}</a> -> {L_JUDGEMENT}</span></td></span></td>
	</tr>
  </table>

<table width="100%" cellpadding="1" cellspacing="1" border="0" class="forumline" align="center" >
	<tr>  
		<th align="center" valign="middle" colspan="2">{L_JUDGEMENT}</th>
	</tr>
	<tr height="25">  
		<td align="center" class="row2" width="40%"><span class="gen"><b>{L_USERNAME}</b></span></td>
		<td align="center" class="row1" ><span class="gen">{NAME}</span></td>	
	</tr>
	<tr height="25"> 
		<td align="center" class="row2" width="40%" ><span class="gen"><b>{L_SENTENCE}</b></span></td>
		<td align="center" class="row1" ><span class="gen">{SENTENCE}</span></td>	
	</tr>
	<tr height="25">  
		<td align="center" class="row2" width="40%" ><span class="gen"><b>{L_SLEDGE}</b></span></td>
		<td align="center" class="row1" ><span class="gen">{CAUTION}&nbsp;{L_POINTS}</span></td>	
	</tr>
	<tr height="25">  
		<td align="center" class="row2" width="40%" ><span class="gen"><b>{L_CELLED_TIMES}</b></span></td>
		<td align="center" class="row1" ><span class="gen">{CELLEDS}</span></td>	
	</tr>
	<tr height="25">  
		<td align="center" class="row2" width="40%" ><span class="gen"><b>{L_IMPRISONED_TIME}</b></span></td>
		<td align="center" class="row1" ><span class="gen">{TIME}</span></td>	
	</tr>
	<tr height="25">  
		<td align="center" class="row2" width="40%" ><span class="gen"><b>{L_PUNISHMENT}</b></span></td>
		<td align="center" class="row1" ><span class="gen">{PUNISHMENT}</span></td>	
	</tr>
</table>

<br clear="all" />

<!-- BEGIN judge_authed -->
<table width="100%" cellpadding="1" cellspacing="1" border="0" class="forumline" align="center" >
	<tr height="25"> 
		<td align="center" class="row2" colspan="2"><span class="gen">{L_JUDGEMENT_EXPLAIN}</span></td>
	</tr>
	<tr height="25">  
		<td align="center" width="50%" class="row1"><input type="hidden" name="celled_id" value="{CELLED_ID}" /><input type="submit" name="guilty" value="{L_JUDGEMENT_NO}" class="liteoption" /></td>
		<td align="center" width="50%" class="row1"><input type="hidden" name="celled_id" value="{CELLED_ID}" /><input type="submit" name="innocent" value="{L_JUDGEMENT_YES}" class="liteoption" /></td>
	</tr>
</table>
<!-- END judge_authed -->

<!-- BEGIN judge_ever -->
<table width="100%" cellpadding="1" cellspacing="1" border="0" class="forumline" align="center" >
	<tr>  
		<th align="center" valign="middle">{L_JUDGE_EVER}</th>
	</tr>
</table>
<!-- END judge_ever -->

<!-- BEGIN judge_authed_ever -->
<table width="100%" cellpadding="1" cellspacing="1" border="0" class="forumline" align="center" >
	<tr>  
		<th align="center" valign="middle">{L_JUDGE_AUTHED_EVER}</th>
	</tr>
</table>
<!-- END judge_authed_ever -->

<!-- BEGIN judge_not_authed -->
<table width="100%" cellpadding="1" cellspacing="1" border="0" class="forumline" align="center" >
	<tr>  
		<th align="center" valign="middle">{L_JUDGE_NOT_AUTHED}</th>
	</tr>
</table>
<!-- END judge_not_authed -->

<br clear="all" />

<!-- BEGIN caution_authed -->
<table width="100%" cellpadding="1" cellspacing="1" border="0" class="forumline" align="center" >
	<tr>  
		<th align="center" valign="middle"><input type="hidden" name="celled_id" value="{CELLED_ID}" /><input type="hidden" name="sledge_price" value="{CAUTION}" /><input type="submit" name="caution_pay" value="{L_PAY_CAUTION}" class="liteoption" /></th>
	</tr>
</table>
<!-- END caution_authed -->

<!-- BEGIN caution_not_authed -->
<table width="100%" cellpadding="1" cellspacing="1" border="0" class="forumline" align="center" >
	<tr>  
		<th align="center" valign="middle">{L_CAUTION_NOT_AUTHED}</th>
	</tr>
</table>
<!-- END caution_not_authed -->

</form>



