<div class="container" style="width: 96%; margin: auto;">
<div class="row">
        <?php if($facility_dashboard_notifications['stocks_from_v1']>0): ?>
        <div style="height:auto; margin-bottom: 2px" class="warn message col-md-4" id="">        
        <h5> 0) Import facility stock from version 1 </h5> 
            <p>
            <a class="link" href="<?php echo base_url('stock/import') ?>">
                <span class="badge"><?php 
                echo $facility_dashboard_notifications['stocks_from_v1'];?></span>facility stock can be imported to version 2</a> 
            </p>
        </div>
        <?php else: //Import facility stock from version 1?>
	<div class="col-md-4">
		<div class="row">			
			<div class="col-md-12">
				<div class="panel panel-success" id="notify">
      		<div class="panel-heading">
        		<h3 class="panel-title">Notification <span class="glyphicon glyphicon-bell"></span> </h3>
      		</div>
      <div class="panel-body">
      	<input type="hidden" id="stocklevel" value="<?php echo $facility_dashboard_notifications['facility_stock_count'] ?>" readonly/>
    <?php if($facility_dashboard_notifications['facility_donations_pending']>0): ?>
      	 <div style="height:auto; margin-bottom: 2px" class="warn message ">      	
        <h5>Inter Facility Donation</h5> 
        	<p>
			<a class="link" href="<?php echo base_url('issues/confirm_external_issue/pending') ?>"><span class="badge"><?php 
				echo $facility_dashboard_notifications['facility_donations_pending'];?></span> Items have been donated and are pending receipt</a> 
			</p>
			 </div>
		  <?php endif; //donations_pending?>
		      <?php if($facility_dashboard_notifications['facility_donations']>0): ?>
      	 <div style="height:auto; margin-bottom: 2px" class="warn message ">      	
        <h5>Inter Facility Donation</h5> 
        	<p>
			<a class="link" href="<?php echo base_url('issues/confirm_external_issue/to-me') ?>"><span class="badge"><?php 
				echo $facility_dashboard_notifications['facility_donations'];?></span> Items have been donated to you</a> 
			</p>
			 </div>
		  <?php endif; //donations_pending?>
   <?php if($facility_dashboard_notifications['facility_stock_count']==0): ?>

      	<div style="height:auto; margin-bottom: 2px" class="warn message " id="">      	
        <h5> Set up facility stock</h5> 
        	<p>
			<a class="link" href="<?php echo base_url('stock/set_up_facility_stock') ?>">Please conduct a physical stock count for this activity</a> 
			</p>
        </div>
        <!--<div style="height:auto; margin-bottom: 2px" class="warning message ">      	
        <h5>2) No Stock (On First Run)</h5> 
        	<p>
	<a class="link" href="<?php echo base_url('stock/facility_stock_first_run/first_run') ?>">Please update your stock details</a> 
			</p>
        </div>-->
            <?php endif; // items_stocked_out_in_facility?>
         <?php if($facility_dashboard_notifications['actual_expiries']>0): ?>
        <div style="height:auto; margin-bottom: 2px" class="warn message ">       	
        <h5>Expired Commodities</h5>
        	<p>
			<a class="link" href="<?php echo base_url('reports/expiries') ?>"> <span class="badge"><?php 
				echo $facility_dashboard_notifications['actual_expiries'];?></span>Expired Commodities Awaiting Decommisioning.</a> 
			</p> 
        </div>
         <?php endif; // Actual Expiries?>
          <?php if($facility_dashboard_notifications['potential_expiries']>0): ?>
      	 <div style="height:auto; margin-bottom: 2px" class="warn message ">      	
        <h5>Potential Expiries</h5> 
        	<p>
			<a class="link" href="<?php echo base_url('reports') ?>"><span class="badge"><?php 
				echo $facility_dashboard_notifications['potential_expiries'];?></span>Commodities Expiring in the next 6 months</a> 
			</p>
			 </div>
		  <?php endif; // Potential Expiries?>
         <?php if($facility_dashboard_notifications['items_stocked_out_in_facility']>0): ?>
        <div style="height:auto; margin-bottom: 2px" class="warn message ">       	
        <h5>Stock Outs</h5>
        	<p>
			<a class="link" href="<?php echo base_url('reports/facility_stocked_out_items') ?>"> <span class="badge">
		<?php echo $facility_dashboard_notifications['items_stocked_out_in_facility'] ?></span>Item(s) Stocked Out </a> 
			</p> 
        </div>
        <?php endif; // items_stocked_out_in_facility?>
        <?php if(array_key_exists('pending', $facility_dashboard_notifications['facility_order_count']) 
        && @$facility_dashboard_notifications['facility_order_count']['pending']>0): ?>
      	<div style="height:auto; margin-bottom: 2px" class="warn message ">      	
        	<h5>Orders Pending Approval by District Pharmacist</h5> 
        	<p>
			<a class="link" href="<?php echo base_url('reports/order_listing/facility') ?>"><span class="badge"><?php 
			echo $facility_dashboard_notifications['facility_order_count']['pending'] ?></span>Order(s) Pending.</a> 
			</p>
        </div>
        <?php endif; //pending
         if(array_key_exists('rejected', $facility_dashboard_notifications['facility_order_count']) 
         && @$facility_dashboard_notifications['facility_order_count']['rejected']>0): ?>
        <div style="height:auto; margin-bottom: 2px" class="warn message ">      	
        	<h5>Orders Rejected by District Pharmacist</h5> 
        	<p>
			<a class="link" href="<?php echo base_url('reports/order_listing/facility') ?>"><span class="badge"><?php 
			echo $facility_dashboard_notifications['facility_order_count']['rejected'] ?></span>Order(s) Rejected</a> 
			</p>
        </div>
        <?php endif; //rejected
        if(array_key_exists('approved', $facility_dashboard_notifications['facility_order_count'])
		 && @$facility_dashboard_notifications['facility_order_count']['approved']>0): ?>
        <div style="height:auto; margin-bottom: 2px" class="warn message ">      	
        	<h5>Pending Dispatch</h5> 
        	<p>
			<a class="link" href="<?php echo base_url('reports/order_listing/facility') ?>"><span class="badge"><?php 
			echo $facility_dashboard_notifications['facility_order_count']['approved'] ?></span>Order(s) Pending Dispatch</a> 
			</p>
        </div>
         <?php endif; //approved?>
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
       <?php if($facility_dashboard_notifications['facility_stock_count']>0): ?>
        <div style="height:auto; margin-bottom: 2px" class="issue message ">	 
        	<a href="<?php echo base_url("issues/index/internal") ?>"><h5>Issue Commodities to Service Points</h5></a>       	 
        </div>
        
        <div style="height:auto; margin-bottom: 2px;color: #428bca !important;" class="distribute message " id="distribute_tab">
            <h5>Redistribute Commodities to...</h5>
        </div>
         <div style="height:auto; margin-bottom: 2px" class="" id="distribute_hide">
         	<a href="<?php echo base_url('issues/index/external'); ?>"><h5>Other Facilities</h5></a>	 
           <a href="<?php echo base_url('issues/index/district_store'); ?>"><h5>District Store</h5></a>  
        
        </div>
          
       <!-- <div style="height:auto; margin-bottom: 2px" class="distribute message ">
        	<a href="<?php echo base_url('issues/index/external'); ?>"><h5>Redistribute Commodities to Other Facilities</h5></a>	 
        </div>
        <div style="height:auto; margin-bottom: 2px" class="distribute message ">
          <a href="<?php echo base_url('issues/index/district_store'); ?>"><h5>Redistribute Commodities to District Store</h5></a>   
        </div>-->
        
 		<div style="height:auto; margin-bottom: 2px" class="distribute message ">
        	<a href="<?php echo base_url('issues/confirm_external_issue')?>"><h5>Receive Commodity From Other Facility (Redistributions)</h5></a>
        	 
        </div>
       <!-- <div style="height:auto; margin-bottom: 2px" class="distribute message ">
        	<a href="<?php echo base_url('issues/confirm_external_issue')?>"><h5>Receive Commodity From Other Sources</h5></a>
        	 
        </div> -->
         <div style="height:auto; margin-bottom: 2px;color: #428bca !important;" class="order message " id="order_tab">
            <h5>Place an Order</h5>
        </div>
         <div style="height:auto; margin-bottom: 2px" class="" id="order_hide">
            <a href="<?php echo base_url('reports/facility_transaction_data/1'); ?>"><h5>MEDS online</h5></a>
            <a href="<?php echo base_url('reports/facility_transaction_data/1'); ?>"><h5>KEMSA online</h5></a>
            <a href="" class="order-for-excel"><h5>KEMSA via excel</h5></a>
            
        </div>  

            
         <div style="height:auto; margin-bottom: 2px;color: #428bca !important;" class="delivery message" id = "update_order">
        	<h5>Update Order Delivery</h5> 
         </div>  
        	  <div style="height:auto; margin-bottom: 2px" class="" id="update_order_hide">
	            <a href="<?php echo base_url('reports/order_listing/facility'); ?>"><h5>KEMSA</h5></a>
	            <a href="<?php echo base_url('reports/work_in_progress'); ?>"><h5>MEDS</h5></a> 
        	</div>       	 
        <div style="height:auto; margin-bottom: 2px" class="order message ">
          <a href="<?php echo base_url("issues/add_service_points") ?>"><h5>Add Service Points </h5></a>          
        </div>
         <div style="height:auto; margin-bottom: 2px" class="reports message ">
          <a href="<?php echo base_url("reports") ?>"><h5>Reports</h5></a>        
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
  <?php endif; //donations_pending?> 	
	</div>	
	
</div>

<script>

	
   $(document).ready(function() {
    
   	var stock=$('#stocklevel').val()

   	if(stock==0){

   		startIntro();
   	}
   	//for hiding the tabs when the page loads
   	$('#update_order_hide').hide() 
       $('#order_hide').hide() 
       $('#distribute_hide').hide()

       $('#order_tab').click(function(event) {
           /* Act on the event */
           $('#order_hide').toggle('slow')
       }); 
       $('#distribute_tab').click(function(event) {
           /* Act on the event */
           $('#distribute_hide').toggle('slow')
       });
       $('#update_order').click(function(event) {
           /* Act on the event */
           $('#update_order_hide').toggle('slow')
       }); 
               $(".order-for-excel").on('click', function(e) {
                  e.preventDefault(); 
    var body_content='<?php  $att=array("name"=>'myform','id'=>'myform');
    echo form_open_multipart('orders/facility_order',$att)?>'+
'<input type="file" name="file" id="file" required="required" class="form-control"><br>'+
'<button class="upload">Upload</button>'+
'</form>';
   //hcmp custom message dialog
    dialog_box(body_content,'');        
    });
       $('#main-content').on('click', '.upload',function(e){
          e.preventDefault(); 
     var file = $('#file').val();
         var exts = ['xls','xlsx'];
      // first check if file field has any value
      if ( file ) {
        // split file name at dot
        var get_ext = file.split('.');
        // reverse name to check extension
        get_ext = get_ext.reverse();
        // check file type is valid as given in 'exts' array
        if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
          $('#myform').submit();
        } else {
          alert( 'Invalid file format given!' );
        }
      } });

    
 <?php echo $facility_dashboard_notifications['faciliy_stock_graph'] ?>

    });
</script>

<script type="text/javascript">
      function startIntro(){
        var intro = introJs();
          intro.setOptions({
            steps: [
              {
                element: 'welcome',
                intro: "<b>WELCOME TO HCMP. Let us explore.</b>"
              },
              {
                element: '#nav-here',
                intro: "<b>Navigation Bar</b> ",
                position: 'left'
              },
              {
                element: '#notify',
                intro: "Notification panel ",
                position: 'bottom'
              },
              {
                element: '#actions',
                intro: "Actions panel ",
                position: 'bottom'
              },
              {
                element: '#container',
                intro: "<b>Stocks graph here.</b> ",
                position: 'bottom'
              },
              {
                element: '#drop-step',
                intro: "<b>Logout Here.</b> ",
                position: 'left'
              }
              
            ]
          });

          intro.start();
      }
      
    </script>
   