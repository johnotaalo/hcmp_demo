<?php //echo "<pre>";print_r($district_dashboard_notifications);echo "</pre>";exit; ?>
<div class="container" style="width: 96%; margin: auto;">
<div class="row">
  <div class="col-md-4">
    <div class="row">     
      <div class="col-md-12">
        <div class="panel panel-success" id="notify">
          <div class="panel-heading">
            <h3 class="panel-title">Notification <span class="glyphicon glyphicon-bell"></span> </h3>
          </div>
      <div class="panel-body">
        <input type="hidden" id="stocklevel" value="<?php echo $district_dashboard_notifications['facility_stock_count'] ?>" readonly/>
          <?php if($district_dashboard_notifications['facility_donations']>0): ?>
         <div style="height:auto; margin-bottom: 2px" class="warning message ">       
        <h5>Inter Facility Donation</h5> 
          <p>
      <a class="link" href="<?php echo base_url('issues/confirm_store_external_issue/to-me') ?>"><span class="badge"><?php 
        echo $district_dashboard_notifications['facility_donations'];?></span> Items have been donated to you</a> 
      </p>
       </div>
            <?php endif; // items_stocked_out_in_facility?>
         <?php if($district_dashboard_notifications['actual_expiries']>0): ?>
        <div style="height:auto; margin-bottom: 2px" class="warning message ">        
        <h5>Expired Commodities</h5>
          <p>
      <a class="link" href="<?php echo base_url('reports/store_expiries') ?>"> <span class="badge"><?php 
        echo $district_dashboard_notifications['actual_expiries'];?></span>Expired Commodities Awaiting Decommisioning.</a> 
      </p> 
        </div>
         <?php endif; // Actual Expiries?>
          <?php if($district_dashboard_notifications['potential_expiries']>0): ?>
         <div style="height:auto; margin-bottom: 2px" class="warning message ">       
        <h5>Potential Expiries</h5> 
          <p>
      <a class="link" href="<?php echo base_url('reports/district_store_reports') ?>"><span class="badge"><?php 
        echo $district_dashboard_notifications['potential_expiries'];?></span>Commodities Expiring in the next 6 months</a> 
      </p>
       </div>
      <?php endif; // Potential Expiries?>
      </div>    
    </div>
  </div>
    </div>
  <div class="row">     
      <div class="col-md-12">       
      <div class="panel panel-success" id="actions">
          <div class="panel-heading">
            <h3 class="panel-title">Actions <span class="glyphicon glyphicon-list-alt"></span></h3>
      </div>
      <div class="panel-body">
       <?php if($district_dashboard_notifications['district_stock_count']>0): ?>
        <div style="height:auto; margin-bottom: 2px" class="distribute message ">
          <a href="<?php echo base_url('issues/district_store'); ?>"><h5>Redistribute Commodities to Facilities</h5></a>   
        </div>        
         <div style="height:auto; margin-bottom: 2px" class="reports message ">
          <a href="<?php echo base_url("reports/district_store_reports") ?>"><h5>Reports</h5></a>        
        </div>
        <?php endif; ?>
      </div>
        </div>      

      </div>    
    </div>
  </div>
   <div class="col-md-8">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">Graph <span class="glyphicon glyphicon-stats" style=""></span><span class="glyphicon glyphicon-align-left" style="margin-left: 1%"></span></h3>
      </div>
      <div class="panel-body" style="overflow-y: auto">
        <div style="/*border: 1px solid #036;*/ ;" id="container"></div>
      </div>
    </div>
  </div> 
  </div>  
  
</div>

<script>

  
   $(document).ready(function() {

    var stock=$('#stocklevel').val()

    if(stock==0){

      // startIntro();
    }
    
    $('#update_order_hide').hide() 
       $('#order_hide').hide() 

       $('#order_tab').click(function(event) {
           /* Act on the event */
           $('#order_hide').toggle('slow')
       }); 
       $('#update_order').click(function(event) {
           /* Act on the event */
           $('#update_order_hide').toggle('slow')
       }); 

 <?php echo $district_dashboard_notifications['district_stock_graph'] ?>

    });
</script>
   