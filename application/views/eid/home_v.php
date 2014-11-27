<script type="text/javascript">
	$('#inner_wrapper').prepend( $('<link rel="stylesheet" type="text/css" />').attr('href', '<?php echo base_url() ?>assets/CSS/eid/font-awesome-4.1.0/css/font-awesome.min.css') );
	$('#inner_wrapper').prepend( $('<link rel="stylesheet" type="text/css" />').attr('href', '<?php echo base_url() ?>assets/CSS/eid/font-awesome-4.1.0/css/font-awesome-animation.min.css') );
	$('#inner_wrapper').prepend( $('<link rel="stylesheet" type="text/css" />').attr('href', '<?php echo base_url() ?>assets/css/eid/fonts/style.css') );
	$('#inner_wrapper').prepend( $('<link rel="stylesheet" type="text/css" />').attr('href', '<?php echo base_url() ?>assets/css/eid/css/main.css') );
	$('#inner_wrapper').prepend( $('<link rel="stylesheet" type="text/css" />').attr('href', '<?php echo base_url() ?>assets/css/eid/css/main-responsive.css') );
	$('#inner_wrapper').prepend( $('<link rel="stylesheet" type="text/css" />').attr('href', '<?php echo base_url() ?>assets/css/eid/css/theme_light.css') );
	$('#inner_wrapper').prepend( $('<link rel="stylesheet" type="text/css" />').attr('href', '<?php echo base_url() ?>assets/css/eid/fonts/style.css') );
	$('#inner_wrapper').prepend( $('<link rel="stylesheet" type="text/css" />').attr('href', '<?php echo base_url() ?>assets/CSS/eid/eid.css') );
</script>

		<!-- start: MAIN CONTAINER -->
		<div class="main-container">
			<div class="navbar-content">
				<!-- start: SIDEBAR -->
				<div class="main-navigation navbar-collapse collapse">
					<!-- start: MAIN MENU TOGGLER BUTTON -->
					<div class="navigation-toggler">
						<i class="clip-chevron-left"></i>
						<i class="clip-chevron-right"></i>
					</div>
					<!-- end: MAIN MENU TOGGLER BUTTON -->
					<!-- start: MAIN NAVIGATION MENU -->
					<ul class="main-navigation-menu">
						<li class="active sidebar-title">
							<a href="#"><i class="clip-home-3"></i>
								<span class="title"> Dashboard </span><span class="selected"></span>
							</a>
						</li>
						<li class=" sidebar-title">
							<a href="javascript:void(0)"><i class="fa fa-upload"></i>
								<span class="title"> <?php echo $last_period; ?> Report Submissions  <span class="badge badge-danger"> <?php echo $submission_rate; ?></span></span><i class="icon-arrow"></i>
								<span class="selected"></span>
							</a>
							<ul class="sub-menu" style="display: block;">
								<li>
									<?php echo $lab_submissions; ?>
								</li>
								
							</ul>
						</li>
						<li class="sidebar-title" id="report-download-title">
							<a href="#"><i class="fa fa-download"></i>
								<span class="title"> Report Downloads </span><span class="selected"></span>
							</a>
						</li>
						
						
						<li class="sidebar-title" id="report-submission-title">
							<a href="#"><i class="fa fa-upload"></i>
								<span class="title"> Kit Submission Report </span><span class="selected"></span>
							</a>
						</li>
						
						
					</ul>
					<!-- end: MAIN NAVIGATION MENU -->
				</div>
				<!-- end: SIDEBAR -->
			</div>
			<!-- start: PAGE -->
			<div class="main-content">
				<!-- start: REPORT DOWNLOAD MODAL FORM -->
				<div class="modal fade" id="md-download-report" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
									&times;
								</button>
								<h4 class="modal-title">Report Download</h4>
							</div>
							<div class="modal-body">
								<form class="form-horizontal" role="form">
									<div class="form-group">
			    						<label for="download-report-period" class="col-sm-4 control-label">Reporting period</label>
									    <div class="col-sm-8">
									    	
										     <select id="download-report-period" class="form-control">
												<?php
												$x = 0;
												foreach ($years as $value){
													for ($i=12; $i >=1 ; $i--) {
														if($x == 0){//Only get up to current month for the first year
															$monthNum = date('n') - 1;
															if($i>$monthNum){
																continue;
															}
															$x++;
														} 
														$period = $value.'-'.$i;
														$monthName = date("F", mktime(0, 0, 0, $i, 10));
														echo "<option value=\"$period\">$monthName - $value</option>\n";
													}
													
												}	
												?>
											</select>
									    </div>
									</div>
									<div class="form-group">
			    						<label for="report-type" class="col-sm-4 control-label">Download Type</label>
									    <div class="col-sm-8">
										     <select id="report-type" class="form-control">
												<option value="1">By platform</option>
												<option value="2">By Lab</option>
											</select>
									    </div>
									</div>
									<div id="by-platform-content"></div>
									<div id="report-type-content" >
										<div style="text-align: right">
											<div class="btn-group">
											  <button type="button" id="btn-download-taqman" class="btn btn-info btn-download-byplatform"><i class="fa fa-download"></i> Download TAQMAN</button>
											</div>
											<div class="btn-group">
											  <button type="button" id="btn-download-abbott" class="btn btn-info btn-download-byplatform"><i class="fa fa-download"></i> Download ABBOTT</button>
											</div>
										</div>
									</div>
									
								</form>
							</div>
							
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->
				<!-- end: REPORT DOWNLOAD MODAL FORM -->
				<div class="container home-main">
					<!-- start: PAGE HEADER -->
					<div class="row">
						<div class="col-sm-12">
							
							<!-- start: PAGE TITLE & BREADCRUMB -->
							<ol class="breadcrumb">
								<li>
									<i class="clip-home-3"></i>
									<a href="#">
										Home
									</a>
								</li>
								<li class="active"  id="breadcrumb-title">
									Dashboard
								</li>
							</ol>
							<div class="page-header">
								<h1>Dashboard <small>overview &amp; stats </small></h1>
							</div>
							<!-- end: PAGE TITLE & BREADCRUMB -->
						</div>
					</div>
					<!-- end: PAGE HEADER -->
					<!-- start: PAGE CONTENT -->
					<div id="page-content"></div>
					
					<!-- end: PAGE CONTENT-->
				</div>
			</div>
			<!-- end: PAGE -->
		</div>
		<!-- end: MAIN CONTAINER -->
		

<style>
	select{
		border-radius:0px;
	}
</style>