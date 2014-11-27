<form name="approvals" action="<?php echo $formaction;?>" method="post">
		<table>
			<th width="1500px"><div class="notice">
			Please approve <?php echo strtoupper($labname);?>&nbsp;'s KIT Consumption for <?php echo $left;?> Platform for <?php echo $monthname.' '.$approve_year;?>.</div></th>
			<tr ><th><input type="submit" name="display_approval" id="btn_approval_report" value="Display for Approval" style="width:400px;padding:8px" class="btn-md" />
			<input type="hidden" id="left" name="left" value="<?php echo $approve_left;?>" />
			<input type="hidden" id="platform" value="<?php echo $left;?>" />
			<input type="hidden" id="subm_testing_lab" name="lab" value="<?php echo $approve_lab;?>" />
			<input type="hidden" id="labname" name="labname" value="<?php echo $labname;?>" />
			<input type="hidden" id="monthname" name="labname" value="<?php echo $approve_lab;?>" />
			<input type="hidden" id="lastmonth" name="lastmonth" value="<?php echo $approve_lastmonth;?>" />
			<input type="hidden" id="year" name="year" value="<?php echo $approve_year;?>" />
			</th></tr>
		</table>
</form>