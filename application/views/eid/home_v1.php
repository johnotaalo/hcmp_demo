<script type="text/javascript">
	$('#inner_wrapper').prepend( $('<link rel="stylesheet" type="text/css" />').attr('href', '<?php echo base_url() ?>assets/CSS/eid/font-awesome-4.1.0/css/font-awesome.min.css') );
	$('#inner_wrapper').prepend( $('<link rel="stylesheet" type="text/css" />').attr('href', '<?php echo base_url() ?>assets/CSS/eid/eid.css') );
</script>
<div class="container-fluid" id="eid_container">
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
  <div class="eid_sidebar row">
    <div class="well col-sm-2 col-md-2" id="eid_side" style="margin-left: 2%">
    	<ul class="nav nav-list">
			<li class="nav-header sidebar_title side_menu">
				<div style="margin-bottom: 25px"><?php echo $last_period; ?> REPORT SUBMISSIONS</div>
				<!--<select id="subm_month" class="input-small"></select><select class="input-small" id="subm_year"></select>  -->
			</li>
			<?php echo $lab_submissions; ?>
			
    	</ul>
    </div>
    <div class="well col-sm-9 col-md-9" id="eid_main"  style="margin-left: 2%">
      <!--Body content-->
      <div class="tabbable"> <!-- Only required for left/right tabs -->
		  <ul class="nav nav-tabs" id="eid_content_menus">
		    <li id="eid_management/menus/submission_tracking" class="active eid_menus"><a href="#tab_tracking" data-toggle="tab">Submissions Tracking</a></li>
		    <li id="eid_management/menus/kit_consumption" class="eid_menus"><a href="#tab_consumption" data-toggle="tab" class="menu_ref">Kit Consumption Trend</a></li>
		    <li id="eid_management/menus/kit_forecasting" class="eid_menus"><a href="#tab_forecasting" data-toggle="tab" class="menu_ref">Kit Forecasting &amp; Quantification</a></li>
		    <li id="eid_management/menus/submission_report" class="eid_menus"><a href="#tab_report" data-toggle="tab" class="menu_ref">Kit Submission Report</a></li>
		  </ul>
		  <div class="tab-content">
		    <div class="tab-pane active" id="tab_tracking">
		      <p><?php if(isset($content)){$this ->load ->view($content); } ?></p>
		    </div>
		    <div class="tab-pane " id="tab_consumption">Cons</div>
		    <div class="tab-pane" id="tab_forecasting">Fore</div>
		    <div class="tab-pane" id="tab_report">Report</div>
		  </div>
		</div>
    </div>
  </div>
</div>

<style>
	select{
		border-radius:0px;
	}
</style>