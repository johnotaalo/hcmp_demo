<script type="text/javascript">
	$('#inner_wrapper').prepend( $('<link rel="stylesheet" type="text/css" />').attr('href', '<?php echo base_url() ?>assets/CSS/eid/font-awesome-4.1.0/css/font-awesome.min.css') );
	$('#inner_wrapper').prepend( $('<link rel="stylesheet" type="text/css" />').attr('href', '<?php echo base_url() ?>assets/CSS/eid/eid.css') );
</script>
<form action="<?php echo base_url(); ?>eid_management/approve_reports" name="fmApproval" id="fmApproval" method="post">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10 col-sm-10"  style="margin-left: 2%">
				<!--menu-->
				<div class="navigation" id="sub-nav">
					<ul class="tabbed">
						<li><a href="<?php echo base_url(); ?>eid_management"><i class="fa fa-3x fa-home"></i></a></li>
						<!--<li>&nbsp;|&nbsp;</li>				
						<!--<li id="health_facility"><a href="#">Health Facility Requisitions </a></li> 
						<li>&nbsp;|&nbsp;</li>-->
					</ul>
					
					<div class="clearer">&nbsp;</div>
				</div>
			</div>
				
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<ul class="breadcrumb">
				  <li class="active"><?php echo @$platform.' ['.@strtoupper($labname). ' '.@$monthname.' '.@$year; ?>] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="">Date Submitted <?php echo $datesubmitted;?>  | Today's Date : <?php echo date('d-M-Y');?></span></li>
				</ul>
			</div>
			<?php
			$slab		= $lab; 
			$prevmonth = $lastmonth;
			$currentyear = $year;
			$reporttitle=$platform.' KIT CONSUMPTION REPORT FOR ['.  strtoupper($labname) . ' '. $monthname.' '.$year.' ]';
			//echo $reporttitle;
			?>
		</div>
		
		<div class="row">
		   <form method="post" action="" name="customForm" autocomplete="off">
		   	<input type="hidden" name="reporttitle" size="31"   value="<?php  echo $reporttitle ; ?>"/>
			<input type="hidden" name="lastmonth" size="31"   value="<?php  echo $lastmonth ; ?>"/>
			<input type="hidden" name="monthname" size="31"   value="<?php  echo $monthname ; ?>"/>
			<input type="hidden" name="year" size="31"  value="<?php  echo $year ; ?>"/>
			<input type="hidden" name="labname" size="31"  value="<?php  echo $labname ; ?>"/>
			<input type="hidden" name="lab" size="31"  value="<?php  echo $lab ; ?>"/>
			
			<div class="col-sm-12 col-md-12">
				<div class="tabbable"> <!-- Only required for left/right tabs -->
				  <ul class="nav nav-tabs" id="eid_content_menus">
				    <li id="eid_management/report_details/eid" class="active eid_menus"><a href="#eid_report" data-toggle="tab">EARLY INFANT DIAGNOSIS CONSUMPTION REPORT</a></li>
				    <li id="eid_management/report_details/vl" class="eid_menus"><a href="#vl_report" data-toggle="tab" class="menu_ref">VIRAL LOAD CONSUMPTION REPORT</a></li>
				  </ul>
				  <div class="tab-content">
				   <div class="tab-pane active" id="eid_report"> 
					   	<table class="table">
							<thead>
								<tr><td>Total Tests Done <small>( for <?php echo $monthname .' , '.$year ?> )</small> - VL : <b><?php echo $testsdone ;?>  <input type="hidden" name="eidtestsdone" size="5" value="<?php echo $testsdone;?>" style = "background:#FFFFCC; font-weight:bold"/></b></td></tr>
							</thead>
							<tbody></tbody>
						</table>
				   		<table class="table table-bordered table-striped" id="tbl_subm_report">
							<thead>
								<tr>
									<td colspan="14" style="background-color:#FFFFFF">
									<div align="center"><font color="#0000FF">EARLY INFANT DIAGNOSIS CONSUMPTION REPORT </font></div></td>				
								</tr>
								<tr>
									<td rowspan="2" style="background-color:#FFFFFF">&nbsp;</td>
									<th style="width:300px" rowspan="2">DESCRIPTION OF GOODS </th>
									<?php if(strtoupper($platform)=='TAQMAN'){ ?>
									<th rowspan="2"><small>UNIT OF ISSUE</small></th>
									<?php } ?>
									<th rowspan="2">BEGINNING BALANCE</th>
									<th style="width:200px; font-size:10px" colspan="2"><font color="#990000">QUANTITY RECEIVED FROM CENTRAL WAREHOUSE (KEMSA, SCMS / RDC)</font></th>
									<th style="width:100px" rowspan="2">QUANTITY USED</th>
									<th rowspan="2">LOSSES / WASTAGE</th>
									<th style="width:200px" colspan="2">ADJUSTMENTS</th>
									<th rowspan="2">ENDING BALANCE <br><small>(PHYSICAL COUNT)</small></th>
									<th rowspan="2">QTY REQUESTED</th>		
									<th rowspan="2">QTY ALLOCATED</th>				
								</tr>
								<tr>
									<th style="width:100px">Quantity</th>
									<th style="width:150px">Lot No.</th>
									<th style="width:100px">Positive<br /><small style="color:#00CC00">(Received other source)</small></th>
									<th style="width:100px">Negative<br /><small style="color:#9900CC">(Issued Out)</small></th>
								</tr>
							</thead>
							<tbody>
								<?php
								if(strtoupper($platform)=='TAQMAN'){// If TAQMAN, load EID data
									echo $this ->load ->view('eid/submission_report_includes/eid_taqman_content');
								}elseif(strtoupper($platform)=='ABBOTT'){// If ABBOTT, load EID data
									echo $this ->load ->view('eid/submission_report_includes/eid_abbott_content');	
								}
								?>
							</tbody>
							
						</table>
				   </div>
				   <div class="tab-pane"  id="vl_report">
				   		<table class="table">
							<thead>
								<tr><td>Total Tests Done <small>( for <?php echo $monthname .' , '.$year ?> )</small> - VL : <b><?php echo $vtestsdone ;?>  <input type="hidden" name="eidtestsdone" size="5" value="<?php echo $testsdone;?>" style = "background:#FFFFCC; font-weight:bold"/></b></td></tr>
							</thead>
							<tbody></tbody>
						</table>
				   		<table class="table table-bordered table-striped" id="">
							<thead>
								<tr>
									<td colspan="14" style="background-color:#FFFFFF">
									<div align="center"><font color="#0000FF">VIRAL LOAD CONSUMPTION REPORT </font></div></td>				
								</tr>
								<tr>
									<td rowspan="2" style="background-color:#FFFFFF">&nbsp;</td>
									<th style="width:300px" rowspan="2">DESCRIPTION OF GOODS </th>
									<?php if(strtoupper($platform)=='TAQMAN'){ ?>
									<th rowspan="2"><small>UNIT OF ISSUE</small></th>
									<?php } ?>
									<th rowspan="2">BEGINNING BALANCE</th>
									<th style="width:200px; font-size:10px" colspan="2"><font color="#990000">QUANTITY RECEIVED FROM CENTRAL WAREHOUSE (KEMSA, SCMS / RDC)</font></th>
									<th style="width:100px" rowspan="2">QUANTITY USED</th>
									<th rowspan="2">LOSSES / WASTAGE</th>
									<th style="width:200px" colspan="2">ADJUSTMENTS</th>
									<th rowspan="2">ENDING BALANCE <br><small>(PHYSICAL COUNT)</small></th>
									<th rowspan="2">QTY REQUESTED</th>		
									<th rowspan="2">QTY ALLOCATED</th>			
								</tr>
								<tr>
									<th style="width:100px">Quantity</th>
									<th style="width:150px">Lot No.</th>
									<th style="width:100px">Positive<br /><small style="color:#00CC00">(Received other source)</small></th>
									<th style="width:100px">Negative<br /><small style="color:#9900CC">(Issued Out)</small></th>
								</tr>
							</thead>
							<tbody>
								<?php
								if(strtoupper($platform)=='TAQMAN'){// If TAQMAN, load EID data
									echo $this ->load ->view('eid/submission_report_includes/vl_taqman_content');
								}elseif(strtoupper($platform)=='ABBOTT'){// If ABBOTT, load EID data
									echo $this ->load ->view('eid/submission_report_includes/vl_abbott_content');	
								}
								?>
								
							</tbody>
						</table>
				   </div>
				  </div>
				</div>
			</div>
		  </form>
		</div>
		
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<input style="padding: 8px;" type="submit" name="btn_approve_reports" id="btn_approve_reports" class="btn-primary" value="Approve <?php echo @$platform; ?>" />
				<input type="hidden" name="platform" value="<?php echo $platform;?>" />
			</div>
		</div>
	</div>
</form>
