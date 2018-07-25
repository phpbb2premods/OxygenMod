  <tr>
	<td class="row2" colspan="2">
	<form method="post" action="{S_POLL_ACTION}"><table cellspacing="0" cellpadding="4" align="center" border="0">
	  <tr>
		<td align="center"><b class="gen">{POLL_QUESTION}</b></td>
	  </tr>
	  <tr>
		<td align="center"><table cellspacing="0" cellpadding="2" border="0">
		  <!-- BEGIN poll_option -->
		  <tr>
			<td><input type="radio" name="vote_id" value="{poll_option.POLL_OPTION_ID}" /></td>
			<td><span class="gen">{poll_option.POLL_OPTION_CAPTION}</span></td>
		  </tr>
		  <!-- END poll_option -->
		</table></td>
	  </tr>
	  <tr>
		<td align="center"><input type="submit" name="submit" value="{L_SUBMIT_VOTE}" class="liteoption" /></td>
	  </tr>
	  <tr>
		<td align="center"><b class="gensmall"><a href="{U_VIEW_RESULTS}" class="gensmall">{L_VIEW_RESULTS}</a></b></td>
	  </tr>
	</table>{S_HIDDEN_FIELDS}</form>
	</td>
  </tr>