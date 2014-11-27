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

<script type="text/javascript">
	$(function() {
	
    var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Pie2D.swf"?>", "ChartId1", "100%", "100%", "0", "0");
    var url = '<?php echo base_url()."report_management/facility_type/".$county_id?>'; 
    chart.setDataURL(url);
    chart.render("chart_1");

    var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Pie2D.swf"?>", "ChartId2", "100%", "100%", "0", "0");
    var url = '<?php echo base_url()."report_management/personel_trained/".$county_id?>'; 
    chart.setDataURL(url);
    chart.render("chart_2");
    
     var chart = new FusionCharts("<?php echo site_url()?>scripts/FusionCharts/StackedBar2D.swf", "ChartId", "85%", "100%", "0", "1");
      var url = '<?php echo base_url()."report_management/get_training_resource/".$county_id?>'; 
      chart.setDataURL(url);
	   chart.render("chart_3");
	   
	    var chart = new FusionCharts("<?php echo site_url()?>scripts/FusionCharts/StackedBar2D.swf", "ChartId", "85%", "100%", "0", "1");
      var url = '<?php echo base_url()."report_management/get_use_freq/".$county_id?>'; 
      chart.setDataURL(url);
	   chart.render("chart_5");
	   
	   var chart = new FusionCharts("<?php echo site_url()?>scripts/FusionCharts/StackedBar2D.swf", "ChartId", "100%", "100%", "0", "1");
      var url = '<?php echo base_url()."report_management/get_level_of_comfort/".$county_id?>'; 
      chart.setDataURL(url);
	   chart.render("chart_6");
    
    var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Pie2D.swf"?>", "ChartId4", "100%", "80%", "0", "0");
    var url = '<?php echo base_url()."report_management/training_satisfaction/".$county_id?>'; 
    chart.setDataURL(url);
     chart.render("chart_4");
    });
       

	
</script>
<div class="leftpanel">
<h3 class="accordion" id="leftpanel"><span> Evaluation Forms Analysis</span></h3>
</div>
<div class="dash_main" style="overflow: auto">
	<div class='label label-info'>The below analysis is retrieved from  <?php echo $coverage_data['total_evaluation'] ?>  
		out of <?php echo $coverage_data['total_facilities'] ?> facilities that underwent the Evaluation process. – 
		Coverage <?php
		$total=0;
		$total=@round(($coverage_data['total_evaluation']/$coverage_data['total_facilities'])*100);
		 echo $total ?>%</div>
	 <table width="100%" class="table table-bordered">
	<tr class="accordion"><td colspan="4">1. FACILITY INFORMATION</td></tr>
	<tr>
    			<td>
      				<label style=" font-weight:bold">Facility Type Evaluated </label>
      				<div id="chart_1"></div></td>
              				
    				<td>
    					<label style=" font-weight:bold">Personel Trained</label>
      				  <div id="chart_2"></div></td>
    				
 </tr>
  	
	<tr class="accordion"><td colspan="4">2. TRAINING EVALUATION</td></tr>
	  	<tr>
    			<td>
    				<label style=" font-weight:bold">Appropriate Resources During Training</label>
      				<div id="chart_3"></div>
            	  	</td>			
    				<td>
    					<label style=" font-weight:bold">Satisfaction Level</label>
      				 <div id="chart_4"></div>
    				</td>
  	</tr>
  	  	<tr>
    			 				
    				<td>
    				<p>Was the training carried out in agreement to the agreed date and time?</p></td><td> <?php 
    				
    				$statusY="#7ada33";
					$statusN="#e93939";
    				
    				
    				$yes=0;
    				foreach($sheduled_training as $data):
    				$total_responses=$data['total'];
    				if($data['agreed_time']==1):
					
					$yes=$data['actual'];
					endif;
    				
					endforeach;
    				
    				$percentageY=@round(($yes/$total_responses)*100);
					$percentageN=@round((($yes-$total_responses)/$total_responses)*100);
    			    				
    				$percentageY=@round(($yes/$total_responses)*100);
					$percentageN=100-$percentageY;
    			    				
    				echo  "<div class='progress'><div class='bar'  style='width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'>NO ".$percentageN ."% </div></div></div></td>"; 
    				  ?>
    				</tr>
    				<tr>
    				<td>
    				<p >Were you given the appropriate feedback and encouragement during the training by the coordinator?</p></td><td><?php 
    				$total_responses=0;
					$yes=0;
    				foreach($feedback_training as $data):
    				$total_responses=$data['total'];
    				if($data['feedback']==1):
					
					$yes=$data['actual'];
					endif;
    				
					endforeach;
    				$percentageY=@round(($yes/$total_responses)*100);
					$percentageN=100-$percentageY;
    			    				
    				echo  "<div class='progress'><div class='bar'  style='width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'>NO ".$percentageN ."% </div></div></div></td>"; 
    				  ?>	
    				  </td>	
    				</tr>
    				
    				<tr>
    					<td>
    				<p>Did the District Pharmacist or District Coordinator carry out further supervision visits to support you in the use of the tool?</p></td>
    				
    				<td>	 <?php
    					$total_responses=0;
					$yes=0;
    				foreach($pharm_supervision as $data):
    				$total_responses=$data['total'];
    				if($data['pharm_supervision']==1):
					
					$yes=$data['actual'];
					endif;
    				
					endforeach;
					$percentageY=@round(($yes/$total_responses)*100);
					$percentageN=100-$percentageY;
    				
    				echo  "<p>District Pharmacist  </p><div class='progress'><div class='bar'  style='width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'>".$percentageN ."% </div></div></div>"; 
    				  ?></p></td>	
    				  <td>
    				   <?php 
    				$total_responses=0;
					$yes=0;
    				foreach($coord_supervision as $data):
    				$total_responses=$data['total'];
    				if($data['coord_supervision']==1):
					
					$yes=$data['actual'];
					endif;
    				
					endforeach;
					$percentageY=@round(($yes/$total_responses)*100);
					$percentageN=100-$percentageY;
    				
    				echo  "<p>District Coordinator</p><div class='progress'><div class='bar'  style='width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'>".$percentageN ."% </div></div></div>"; 
    				  ?>
    				  </td>	
    				</tr>
    					<tr>
    						<td>
    				<p>Did you identify any requirements during training that needed to be addressed?</p></td><td><?php
    					$total_responses=0;
					$yes=0; 
    				foreach($req_id as $data):
    				$total_responses=$data['total'];
    				if($data['req_id']==1):
					
					$yes=$data['actual'];
					endif;
    				
					endforeach;
    				
    				$percentageY=@round(($yes/$total_responses)*100);
					$percentageN=100-$percentageY;
    			    				
    				echo  "<div class='progress'><div class='bar'  style='width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'>".$percentageN ."% </div></div></div></td>"; 
    				  ?>
    				
    				</tr>
    				
    				<tr>
    					<td>
    				<p>Have the requirements been addressed?</p></td><td><?php
    					$total_responses=0;
					$yes=0; 
    				foreach($req_addr as $data):
    				$total_responses=$data['total'];
    				if($data['req_addr']==1):
					
					$yes=$data['actual'];
					endif;
    				
					endforeach;
    				$percentageY=@round(($yes/$total_responses)*100);
					$percentageN=100-$percentageY;
    			    				
    				echo  "<div class='progress'><div class='bar'  style='width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'>".$percentageN ."% </div></div></div></td>"; 
    				  ?>
    				  </td>	
    				</tr>
    				<tr>
    					<td>
    				<p>Did you find the training useful?</p></td><td><?php
    					$total_responses=0;
					$yes=0; 
					
    				foreach($train_useful as $data):
    				$total_responses=$data['total'];
    				if($data['train_useful']==1):
					
					$yes=$data['actual'];
					endif;
    				
					endforeach;
    				$percentageY=@round(($yes/$total_responses)*100);
					$percentageN=100-$percentageY;
    			    				
    				echo  "<div class='progress'><div class='bar'  style='width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'>".$percentageN ."% </div></div></div></td>"; 
    				  ?>	
    				  </td>	
    				</tr>

		<tr class="accordion"><td colspan="4">3. WEB TOOL EVALUATION</td></tr>
	       <tr>
	       	<td>
	       		<label style=" font-weight:bold">How frequently do you use the system in commodity management</label>
      				 <div id="chart_5"></div>
	       	</td>
	       	<td>
	       	<label style=" font-weight:bold">Comfort level in using the syste</label>
      				 <div id="chart_6"></div>	
	       	</td>
	       </tr>
	                 <tr>
	                 	<td>
    				<p > Does the web tool improve commodity management in your facility?</td><td> <?php
    					$total_responses=0;
					$yes=0; 
					
    				foreach($improvement as $data):
    				$total_responses=$data['total'];
    				if($data['improvement']==1):
					
					$yes=$data['actual'];
					endif;
    				
					endforeach;
    				
    				$percentageY=@round(($yes/$total_responses)*100);
					$percentageN=100-$percentageY;
    			    				
    				echo  "<div class='progress'><div class='bar'  style='width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'>".$percentageN ."% </div></div></div></td>"; 
    				  ?>
    				  </td>	
    				</tr>
    				
    				<tr>
    					<td>
    				<p >Is the tool easy to use and understand?</p></td><td><?php
    					$total_responses=0;
					$yes=0; 
					
    				foreach($ease_of_use as $data):
    				$total_responses=$data['total'];
    				if($data['ease_of_use']==1):
					
					$yes=$data['actual'];
					endif;
    				
					endforeach;
    				
    				$percentageY=@round(($yes/$total_responses)*100);
					$percentageN=100-$percentageY;
    			    				
    				echo  "<div class='progress'><div class='bar'  style='width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'>".$percentageN ."% </div></div></div></td>"; 
    				  ?>
    				  </td>	
    				</tr>
    				<tr>
    					<td>
    				<p >Does it meet your expectations in commodity management?</p></td><td><?php
    					$total_responses=0;
					$yes=0; 
				
    				foreach($meet_expect as $data):
    				$total_responses=$data['total'];
    				if($data['meet_expect']==1):
					
					$yes=$data['actual'];
					endif;
    				
					endforeach;
    			
    				$percentageY=@round(($yes/$total_responses)*100);
					$percentageN=100-$percentageY;
    			    				
    				echo  "<div class='progress'><div class='bar'  style='width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'>".$percentageN ."% </div></div></div></td>"; 
    				  ?>
    				  </td>	
    				</tr>
    				<tr>
    					<td>
    				<p >Would you be willing to re-train facility staff on the use and importance of the tool?</p></td><td><?php
    					$total_responses=0;
					$yes=0; 
					
    				foreach($retrain as $data):
    				$total_responses=$data['total'];
    				if($data['retrain']==1):
					
					$yes=$data['actual'];
					endif;
    				
					endforeach;
    				
    				$percentageY=@round(($yes/$total_responses)*100);
					$percentageN=100-$percentageY;
    			    				
    				echo  "<div class='progress'><div class='bar'  style='width:$percentageY%;background:$statusY'>YES ".$percentageY ."% </div>
    				<div class='bar' style='float:right; width:$percentageN%;background:$statusN'>".$percentageN ."% </div></div></div></td>"; 
    				  ?>	</p>
    				  </td>	
    				</tr>
                    </table>

</div>

