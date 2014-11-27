<?php
$year = date("Y");
$county_id = $this -> session -> userdata('county_id');
$district_id =  $this -> session -> userdata('district_id');

		  $identifier = $this -> session -> userdata('user_indicator');
		
        switch ($identifier):
			case 'district':
			$link=	base_url('reports/order_listing/subcounty/true');
			$link2=	base_url('reports/order_listing/subcounty');
			break;
			case 'county':
			$link=	base_url('reports/order_listing/county/true');
			$link2=	base_url('reports/order_listing/county');
			break;
			 endswitch;
			
?>

<div class="row" style="margin-left: 1%">
	<div class="col-md-4">
		<div class="row">			
			<div class="col-md-12">
				<div class="panel panel-success">
      		<div class="panel-heading">
        		<h3 class="panel-title">Notification <span class="glyphicon glyphicon-bell"></span> </h3>
      		</div>
            <div class="panel-body">
    <?php if($county_dashboard_notifications['facility_donations']>0): ?>
      	 <div style="height:auto; margin-bottom: 2px" class="warning message ">      	
       	 <h5>Commodity Redistribution</h5> 
        	<p>
			<a class="link" href="<?php echo base_url('reports/county_donation/')?>"><span class="badge"><?php 
				echo $county_dashboard_notifications['facility_donations'];?></span> Commodities have been redistributed in your area</a> 
			</p>
 		 </div>
		  <?php endif; // Potential Expiries?>
         <?php if($county_dashboard_notifications['actual_expiries']>0): ?>
        <div style="height:auto; margin-bottom: 2px" class="warning message ">       	
        <h5>Expired Commodities</h5>
        	<p>
			<a class="link" href="<?php echo base_url('reports/county_expiries') ?>"> <span class="badge"><?php 
				echo $county_dashboard_notifications['actual_expiries'];?></span>Expired Commodities in your area</a> 
			</p> 
        </div>
         <?php endif; // Actual Expiries?>
          <?php if($county_dashboard_notifications['potential_expiries']>0): ?>
      	 <div style="height:auto; margin-bottom: 2px" class="warning message ">      	
        <h5>Potential Expiries</h5> 
        	<p>
			<a class="link" href="<?php echo base_url('reports/county_expiries') ?>"><span class="badge"><?php 
				echo $county_dashboard_notifications['potential_expiries'];?></span>Commodities Expiring in the next 6 months in your area</a> 
			</p>
			 </div>
		  <?php endif; // Potential Expiries?>
         <?php if($county_dashboard_notifications['items_stocked_out_in_facility']>0): ?>
        <div style="height:auto; margin-bottom: 2px" class="warning message ">       	
        <h5>Stock Outs</h5>
        	<p>
			<a class="link" href="<?php echo base_url('reports/stock_out') ?>"> <span class="badge">
		<?php echo $county_dashboard_notifications['items_stocked_out_in_facility'] ?></span>facilities have stocked out items</a> 
			</p> 
        </div>
        <?php endif; // items_stocked_out_in_facility?>
        <?php if(array_key_exists('pending', $county_dashboard_notifications['facility_order_count']) 
        && @$county_dashboard_notifications['facility_order_count']['pending']>0): ?>
      	<div style="height:auto; margin-bottom: 2px" class="warning message ">      	
        	<h5>Orders Pending Approval by District Pharmacist</h5> 
        	<p>
			<a class="link" href="<?php echo $link2 ?>"><span class="badge"><?php 
			echo $county_dashboard_notifications['facility_order_count']['pending'] ?></span>Order(s) Pending in your area</a> 
			</p>
        </div>
        <?php endif; //pending
         if(array_key_exists('rejected', $county_dashboard_notifications['facility_order_count']) 
         && @$county_dashboard_notifications['facility_order_count']['rejected']>0): ?>
        <div style="height:auto; margin-bottom: 2px" class="warning message ">      	
        	<h5>Orders Rejected by District Pharmacist</h5> 
        	<p>
			<a class="link" href="<?php echo $link ?>"><span class="badge"><?php 
			echo $county_dashboard_notifications['facility_order_count']['rejected'] ?></span>Order(s) rejected in your area</a> 
			</p>
        </div>
        <?php endif; //rejected
        if(array_key_exists('approved', $county_dashboard_notifications['facility_order_count'])
		 && @$county_dashboard_notifications['facility_order_count']['approved']>0): ?>
        <div style="height:auto; margin-bottom: 2px" class="warning message ">      	
        	<h5>Pending Dispatch</h5> 
        	<p>
			<a class="link" href="<?php echo $link; ?>"><span class="badge"><?php 
			echo $county_dashboard_notifications['facility_order_count']['approved'] ?></span>Order(s) pending dispatch from KEMSA</a> 
			</p>
        </div>
         <?php endif; //approved?>
      </div>     
    </div>
	</div>
		</div>

	</div>
  <div class="col-md-8">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">Analysis <span class="glyphicon glyphicon-stats" style=""></span><span class="glyphicon glyphicon-align-left" style="margin-left: 1%"></span></h3>
      </div>
      <div class="panel-body" style="overflow-y: auto">
   <a href="<?php echo base_url("reports/mapping"); ?>"> <label>Roll out status:  <?php  $total=0;
   $total_=$county_dashboard_notifications['facility_roll_out_status'][0]['targetted'];
     $total=round((@$county_dashboard_notifications['facility_roll_out_status'][0]['using_hcmp']/$total_*100),1);
     echo ' Using HCMP '.$county_dashboard_notifications['facility_roll_out_status'][0]['using_hcmp']
     .' /  Targeted for roll out '.$county_dashboard_notifications['facility_roll_out_status'][0]['targetted']?></label>
    <div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $total ?>%;">
        <?php echo $total."%" ?>
    </div>
      </div>
      </a> 
      <div id="facility_monitoring"></div>
    </div>
  </div>  
	</div>	
	<script>
	     ajax_request_replace_div_content('reports/monitoring',"#facility_monitoring");
	</script>