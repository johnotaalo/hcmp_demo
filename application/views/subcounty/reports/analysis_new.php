<?php
function calculate_percentage($val1,$val2){
 		if(!isset($val1)) {
			 $val1 = 1;
		 }
		if (!isset($val2)){
			$val2 = 1;
		}
	
            $percentage = ($val2/$val1)*100;
            return @round($percentage);
        }
 ?>

<style type="text/css" title="currentStyle">    
 p{
 	font-size: 14px;
 }
.leftpanel{
width: 17%;
height:auto;
float: left;
padding-left: 1em;
}

 .dash_main{
    width: 80%;
    min-height: 100%;
    height:600px;
    float: left;
       -webkit-box-shadow: 2px 2px 6px #888;
	box-shadow: 2px 2px 6px 2px #888; 
    margin-left:0.75em;
    margin-bottom:0em;
    
    }
    .accordion {
margin: 0;
padding:5%;
height:15px;
border-top:#f0f0f0 1px solid;
background: #cccccc;
font:normal 1.3em 'Trebuchet MS',Arial,Sans-Serif;
text-decoration:none;
text-transform:uppercase;
background: #29527b; /* Old browsers */
border-radius: 0.5em;
color: #fff; }

</style>

<!-- <div class="dash_main" style="overflow: auto"> -->
	<div class='label label-info'>The below analysis is retrieved from  <?php echo $coverage_data['total_facilities'] ?>  
		out of <?php echo $coverage_data['total_evaluation'] ?> facilities that underwent the Evaluation process. – 
		Coverage <?php
		$total=0;
		$total=@round(($coverage_data['total_facilities']/$coverage_data['total_evaluation'])*100);
		 echo $total ?>%</div>

				<button id="raw_data_view" class=" btn btn-sm btn-small btn-primary">
				<span class = "ui-button-text">View Raw Data
					</span>
				</button>


		 <table width="100%" class="table table-bordered">
	<tr class="accordion">
    <td colspan="4">1. FACILITY INFORMATION</td></tr>

	<tr>
		
        <td colspan="0">
		<!-- <label style=" font-weight:bold">Facility Type Evaluated </label> -->



		<div id="chart_1" style="width:500px; height:250px;" ></div>
        </td>

		<td colspan="2">
		<!-- <label style=" font-weight:bold">Personel Trained</label> -->
		  <div id="chart_2" style="width:500px; height:250px;" ></div>
        </td>
    </tr>
    				
	 </tr>
	 <tr class="accordion"><td colspan="4">2. TRAINING EVALUATION</td></tr>
	  	<tr>
    			<td colspan="4">
                
      				<div id="chart_3" style="width:100%; height:250px; margin =0; padding = 0;"></div>
            	  	</td>			

    				</tr>
  	  	<tr>
    			 				
    				<td colspan="2">
    				<p>Was the training carried out in agreement to the agreed date and time?</p></td>
    				<td>
    				<?php 

    				$statusY="#5CB85C";
					$statusN="#D9534F";
       
 
    				$percentageY= calculate_percentage($scheduled_training[0]['total'],$scheduled_training[0]['actual']);
					// $percentageN=100-$percentageY;
					$percentageN=100 - $percentageY;

    				$progress_bar1 = $percentageY;
					$progress_bar_1 = $percentageN;

    			echo  "<div class='progress'><div class='bar'  style='float:left;width:$percentageY%;background:$statusY'> YES ".$percentageY ."% </div>

    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'> NO ".$percentageN."% </div></div>"; 
    					 ?>
    				</td>

	</tr>	

	<tr>
	<td colspan="2">
		<p >Were you given the appropriate feedback and encouragement during the training by the coordinator?</p>
	</td>
	<td colspan="2">
		<?php

        $percentageY= calculate_percentage($feedback_training[0]['total'],$feedback_training[0]['actual']);
                    // $percentageN=100-$percentageY;
                    $percentageN=100 - $percentageY;

                    $progress_bar2 = $percentageY;
					$progress_bar_2 = $percentageN;

		echo  "<div class='progress'><div class='bar'  style='float:left;width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'> NO ".$percentageN ."% </div></div>"; 
		 ?>
	</td>
	</tr>

	<tr>
	<td>
		<p>Did the District Pharmacist or District Coordinator carry out further supervision visits to support you in the use of the tool?</p>
	</td>
	<td>
		<?php 

        $percentageY= calculate_percentage($pharm_supervision[1]['total'],$pharm_supervision[1]['actual']);

                    $percentageN=100 - $percentageY;

                    $progress_bar3 = $percentageY;
					$progress_bar_3 = $percentageN;

		echo  "<p>District Pharmacist  </p><div class='progress'><div class='bar'  style='float:left;width:$percentageY%; clear:none; background:$statusY'>YES ".$percentageY ."% </div>
    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'>NO ".$percentageN ."% </div></div>"; 
		 ?>
	</td>
		<td>
		<?php 

        $percentageY= calculate_percentage($coord_supervision[1]['total'],$coord_supervision[1]['actual']);

                    $percentageN=100 - $percentageY;

                    $progress_bar4 = $percentageY;
					$progress_bar_4 = $percentageN;

		echo  "<p>District Coordinator  </p><div class='progress'><div class='bar'  style='float:left;width:$percentageY%; clear:none; background:$statusY'>YES ".$percentageY ."% </div>
    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'>NO ".$percentageN ."% </div></div>"; 
		 ?>
	</td>
	</tr>

	<tr>
	<td colspan="2">
		<p>Did you identify any requirements during training that needed to be addressed?</p>
	</td>
	<td colspan="2">
		<?php 
        // print_r($req_id);
        // exit;
        $percentageY= calculate_percentage($req_id[1]['total'],$req_id[1]['actual']);
                    // $percentageN=100-$percentageY;
                    $percentageN=100 - $percentageY;

                    $progress_bar5 = $percentageY;
					$progress_bar_5 = $percentageN;

			echo  "<div class='view_requirements progress'><div class='bar'  style='float:left;width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'>  NO ".$percentageN ."% </div></div></div></td>"; 
    				  
		 ?>
	</td>
	</tr>

	<tr>
	<td colspan="2">
		<p>Have the requirements been addressed?</p>
	</td>
	<td colspan="2">
		<?php 
         $percentageY= calculate_percentage($req_addr[1]['total'],$req_addr[1]['actual']);
                    // $percentageN=100-$percentageY;
                    $percentageN=100 - $percentageY;

                    $progress_bar6 = $percentageY;
					$progress_bar_6 = $percentageN;

			echo  "<div class='progress'><div class='bar'  style='float:left;width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'>  NO ".$percentageN ."% </div></div></div></td>"; 
		 ?>
	</td>
	</tr>

	<tr>
	<td colspan="2">
		<p>Did you find the training useful?</p>
	</td>
	<td colspan="2">
		<?php 

        $percentageY= calculate_percentage($train_useful[1]['actual'],$train_useful[1]['total']);
                      $percentageN=100-$percentageY;

                      $progress_bar7 = $percentageY;
					$progress_bar_7 = $percentageN;

			echo  "<div class='progress'><div class='bar'  style='float:left;width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'>  NO ".$percentageN ."% </div></div></div></td>"; 
		 ?>
	</td>
	</tr>
	<tr class="accordion"><td colspan="4">3. WEB TOOL EVALUATION</td></tr>

	<tr>
	       	<td colspan="3">
	       		<label style=" font-weight:bold">How frequently do you use the system in commodity management
	       		</label>

      				 <div id="chart_5" style="width:100%; height:250px;"></div>
	       	</td>
            </tr>

    <tr>
	       	<td colspan="3">
	       		<div id="chart_6" style="width:100%; height:300px;"></div>
	       	</td>

	</tr>
	
    <tr>
	<td colspan="2">
		<p >Is the tool easy to use and understand?</p>
	</td>
	<td>
		<?php 
        $percentageY= calculate_percentage($ease_of_use[0]['total'],$ease_of_use[1]['actual']);
       
                    $percentageN=100 - $percentageY;

                    $progress_bar8 = $percentageY;
					$progress_bar_8 = $percentageN;

			echo  "<div class='progress'><div class='bar'  style='float:left;width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'> NO".$percentageN ."% </div></div></div></td>";
		 ?>
	</td>
	</tr>
	<tr>
	<td colspan="2">
		<p >Does it meet your expectations in commodity management?</p>
	</td>
	<td colspan="2">
		<?php 
        $percentageY= calculate_percentage($meet_expect[0]['total'],$meet_expect[1]['actual']);

                    $percentageN=100 - $percentageY;

                    $progress_bar9 = $percentageY;
					$progress_bar_9 = $percentageN;

		echo  "<div class='progress'>
			<div class='bar'  style='float:left; width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
    		<div class='view_expectations bar'><div class='bar' style='float:right; width:$percentageN%;background:$statusN'>  NO ".$percentageN ."% </div></div>
    		</div></td>";
		 ?>
	</td>
	</tr>
	<tr>
	<td colspan="2">
		<p >Would you be willing to re-train facility staff on the use and importance of the tool?</p>
	</td>
	<td colspan="2">
		<?php 
        $percentageY= calculate_percentage($retrain[0]['total'],$retrain[0]['actual']);

                    $percentageN=100 - $percentageY;

                    $progress_bar10 = $percentageY;
					$progress_bar_10 = $percentageN;

			echo  "
			<div class='progress'>
			<div class='bar' style='float:left; width:$percentageY%; background:$statusY'>YES ".$percentageY ."% </div>
    		<div class='bar' style='float:right; width:$percentageN%; background:$statusN'> NO ".$percentageN ."% </div>
    			
    			</div>";

		 ?>
	</td>
	</tr>
	</table>

<script>
	$(function () { 
		<?php 
			   echo $facility_evaluation;//first chart
               echo $frequency_of_use;
               echo $trained_personel;
               echo $comfort_level;//sixth chart
               echo $training_resource;
         ?>    
});
$(".view_requirements").click( function (){
		
		$('.modal-dialog').addClass("modal-lg");
		var body_content='<table class="row-fluid table table-hover table-bordered table-update" width="100%">'+
		'<thead><tr><th>Facility Name</th><th>Requirements to be addressed</th></tr></thead>'+
		'<tbody>'+			   	    
		'<?php	foreach($show_req as $detail):
			     $facilityname = $detail['facility_name'];
				 $reqspec = $detail['req_spec'];							
				 
				 ;?>'+'<tr><td>'+'<?php echo $facilityname ;?>'+'</td>'
				 
				 +'<td>'+'<?php echo $reqspec ;?>'+'</td>'
				 +'</td></tr>'+'<?php endforeach;?>'
				 +'</tbody></table>';
        //hcmp custom message dialog
    dialog_box(body_content,'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
    $('#communication_dialog').on('hidden.bs.modal', function (e) {  $('.modal-dialog').removeClass("modal-lg");
    $('.modal-body').html(''); 	})    
   
    });

// $(".view_expectations").click( function (){
// 		
		// $('.modal-dialog').addClass("modal-lg");
		// var body_content='<table class="row-fluid table table-hover table-bordered table-update" width="100%">'+
		// '<thead><tr><th>Facility Name</th><th>Requirements to be addressed</th></tr></thead>'+
		// '<tbody>'+		   	    
		// '<?php	foreach($show_expect as $detail):
			      // $facility = $detail['facility_name'];
				  // $suggest = $detail['expect_suggest'];							
// 
				 // ;?>'+'<tr><td>'+'<?php echo $detail['facility_name'] ;?>'+'</td>'
// 				 
				 // +'<td>'+'<?php echo $detail['expect_suggest'] ;?>'+'</td>'
				 // +'</td></tr>'+'<?php endforeach;?>'
				 // +'</tbody></table>';
        // //hcmp custom message dialog
    // dialog_box(body_content,'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
    // $('#communication_dialog').on('hidden.bs.modal', function (e) {  $('.modal-dialog').removeClass("modal-lg");
    // $('.modal-body').html(''); 	})    
//    
    // });

$("#raw_data_view").click( function (){

// first graph data
		$('.modal-dialog').addClass("modal-lg");
		var body_content=
		'<p>Facility Types Evaluated in %</p>'
		+'<table class="row-fluid table table-hover table-bordered" width="100%">'+
		'<tbody>'
		+'<tr>'
		+'<td> FBO: '+ <?php echo $fbo ?> +'</td>'
		+'<td> Other Public Institutions: '+ <?php echo $public_institutions ?> +'</td>'
		+'<td> GOK: '+ <?php echo $gok ?> +'</td>'
		+'</tr>'
		+'</tbody></table>'+

// second graph data
		'<p>Personel Trained </p>'
		+'<table class="row-fluid table table-hover table-bordered table-update" width="100%">'+
		'<tbody>'
		+'<tr>'
		+'<td> Facility Deputy:  '+ <?php echo $fdep ?> +'</td>'
		+'<td> Nurse: '+ <?php echo $nurse ?> +'</td>'
		+'<td> Facility Head: '+ <?php echo $fhead ?> +'</td>'
		+'<td> Personal Technician: '+ <?php echo $ptech ?> +'</td>'
		+'<td> Store Manager:  '+ <?php echo $sman ?> +'</td>'
		+'</tr>'
		+'</tbody></table>'+

// third graph data
		'<p>Appropriate Resources During Training </p>'
		+'<table class="row-fluid table table-hover table-bordered table-update" width="100%">'+
		'<tbody>'
		+'<tr>'
		+'<td> Computers:  '+ <?php echo $computers ?> +'</td>'
		+'<td> Modems: '+ <?php echo $modems ?> +'</td>'
		+'<td> Bundles: '+ <?php echo $bundles ?> +'</td>'
		+'<td> Manuals: '+ <?php echo $manuals ?> +'</td>'
		+'</tr>'
		+'</tbody></table>'+
// scheduled_training
		'<p>Was the training carried out in agreement to the agreed date and time? </p>'
		+'<table class="row-fluid table table-hover table-bordered table-update" width="100%">'+
		'<tbody>'
		+'<tr>'
		+'<td> YES:  '+ <?php echo $progress_bar1 ?> +'%</td>'
		+'<td> NO: '+ <?php echo $progress_bar_1 ?> +'%</td>'
		+'</tr>'
		+'</tbody></table>'+
// feedback and encouragement
		'<p>Were you given the appropriate feedback and encouragement during training? </p>'
		+'<table class="row-fluid table table-hover table-bordered table-update" width="100%">'+
		'<tbody>'
		+'<tr>'
		+'<td> YES:  '+ <?php echo $progress_bar2 ?> +'%</td>'
		+'<td> NO: '+ <?php echo $progress_bar_2 ?> +'%</td>'
		+'</tr>'
		+'</tbody></table>'+
// further supervision visits
		'<p>Did the District Pharmacist or District Coordinator carry out further supervision visits to support you in the use of the tool? </p>'
		+'<table class="row-fluid table table-hover table-bordered table-update" width="100%">'+
		'<tbody>'
		+'<tr>'
		+'<td> <em>District Pharmacist</em></td><td> YES: '+ <?php echo $progress_bar3 ?> +'%</td>'
		+'<td>NO: '+ <?php echo $progress_bar_3 ?> +'</td>'

		+'<td> <em>District Coordinator</em></td><td> YES: '+ <?php echo $progress_bar4 ?> +'%</td>'
		+'<td>NO: '+ <?php echo $progress_bar_4 ?> +'</td>'
		+'</tr>'
		+'</tbody></table>'+
// requirements
		'<p>Did you identify any requirements during training that needed to be addressed? </p>'
		+'<table class="row-fluid table table-hover table-bordered table-update" width="100%">'+
		'<tbody>'
		+'<tr>'
		+'<td> YES:  '+ <?php echo $progress_bar5 ?> +'%</td>'
		+'<td> NO: '+ <?php echo $progress_bar_5 ?> +'%</td>'
		+'</tr>'
		+'</tbody></table>'+
// requirements addressed
		'<p>Have the requirements been addressed? </p>'
		+'<table class="row-fluid table table-hover table-bordered table-update" width="100%">'+
		'<tbody>'
		+'<tr>'
		+'<td> YES:  '+ <?php echo $progress_bar6 ?> +'%</td>'
		+'<td> NO: '+ <?php echo $progress_bar_6 ?> +'%</td>'
		+'</tr>'
		+'</tbody></table>'+
// training useful
		'<p>Did you find the training useful? </p>'
		+'<table class="row-fluid table table-hover table-bordered table-update" width="100%">'+
		'<tbody>'
		+'<tr>'
		+'<td> YES:  '+ <?php echo $progress_bar7 ?> +'%</td>'
		+'<td> NO: '+ <?php echo $progress_bar_7 ?> +'%</td>'
		+'</tr>'
		+'</tbody></table>'+
// ease of use
		'<p>Is the tool easy to use and understand? </p>'
		+'<table class="row-fluid table table-hover table-bordered table-update" width="100%">'+
		'<tbody>'
		+'<tr>'
		+'<td> YES:  '+ <?php echo $progress_bar8 ?> +'%</td>'
		+'<td> NO: '+ <?php echo $progress_bar_8 ?> +'%</td>'
		+'</tr>'
		+'</tbody></table>'+
// expectations
		'<p>Is the tool easy to use and understand? </p>'
		+'<table class="row-fluid table table-hover table-bordered table-update" width="100%">'+
		'<tbody>'
		+'<tr>'
		+'<td> YES:  '+ <?php echo $progress_bar9 ?> +'%</td>'
		+'<td> NO: '+ <?php echo $progress_bar_9 ?> +'%</td>'
		+'</tr>'
		+'</tbody></table>'+
// willingness to retrain
		'<p>Would you be willing to re-train facility staff on the use and importance of the tool? </p>'
		+'<table class="row-fluid table table-hover table-bordered table-update" width="100%">'+
		'<tbody>'
		+'<tr>'
		+'<td> YES:  '+ <?php echo $progress_bar10 ?> +'%</td>'
		+'<td> NO: '+ <?php echo $progress_bar_10 ?> +'%</td>'
		+'</tr>'
		+'</tbody></table>'
		;


        //hcmp custom message dialog
    dialog_box(body_content,'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
    $('#communication_dialog').on('hidden.bs.modal', function (e) {  $('.modal-dialog').removeClass("modal-lg");
    $('.modal-body').html(''); 	})    
   
    });

    function ajax_request_special_(url,date){
	var url =url;
	 $.ajax({
          type: "POST",
          url: url,
          success: function(msg) {
          	$('.modal-dialog').addClass("modal-lg");
          	var body_content = msg;
          	dialog_box(body_content,'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
           	 $('#communication_dialog').on('hidden.bs.modal', function (e) {  $('.modal-dialog').removeClass("modal-lg");
   			 $('.modal-body').html(''); })
         
          }
        }); 
}
</script>