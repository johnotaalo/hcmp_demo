<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
<style type="text/css" title="currentStyle">  
      @import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
.leftpanel{
width: 17%;
height:auto;
float: left;
padding-left: 1em;
}
 .dash_main{
    width: 80%;
    min-height:100%;
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
table.data-table {
  margin: 10px auto;
  }
  
table.data-table th {
  color:#036;
  text-align:center;
  font-size: 13.5px;
  max-width: 600px;
  }
table.data-table td, table th {
  padding: 4px;
  }
table.data-table td {
  height: 30px;
  width: 130px;
  font-size: 12.5px;
  margin: 0px;
  }
</style>

<script type="text/javascript">
	$(function() {
						//button to post the order
		$( ".delete" )
			.button()
			.click(function() {
				
		var id=$(this).attr("id");
				
	$( "#dialog-confirm" ).dialog({
      resizable: false,
      autoOpen: true,
      height:200,
      modal: true,
      buttons: {
        "Delete all items": function() {
        	window.location="<?php echo site_url('order_management/delete_order');?>/"+id;	
          $( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
			});	
			
			 $( "#dialog-confirm" ).dialog( {autoOpen: false} );

$("#dialog1").dialog({
					height : 140,
					modal : true
				});
		$('#rejected,#delivered,#pending,#approved').dataTable( {
					"bJQueryUI": true,
					"bPaginate": false
				} );
		
  } );
</script>

<div class="leftpanel">
	<div id="dialog-confirm" title="Delete facility data?">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
  	<h3 class="text-error">The order will be deleted and cannot be recovered!. Are you sure?</h3></p>
</div>
<h3 class="accordion" id="leftpanel">Orders Summary<span></span></h3>
<div id="details">
	<table  class="data-table">
		<thead>
<tr>
	    <th>Order Status</th>
		<th>No. of Orders</th>
	</tr>
	</thead>
	<tbody>
		
		<?php 
		//$year=date("Y");
		$rejected_data='';
		$delivery_data='';
		$pending_data='';
		$approved_data='';
				
		foreach($delivered as $delivered_details):
			
			$mfl=$delivered_details['facility_code'];
			$name=$delivered_details['facility_name'];
			$order_date=$delivered_details['orderDate'];
			$district=$delivered_details['district'];
			$year=$delivered_details['mwaka'];
			$order_total=$delivered_details['orderTotal'];
			$order_total=number_format($order_total, 2, '.', ',');
			$delivery_total=$delivered_details['total_delivered'];
			$delivery_total=number_format($delivery_total, 2, '.', ',');
			$fill_rate=$delivered_details['fill_rate'];
			$link=base_url().'order_management/moh_order_details/'.$delivered_details['id'];
			$link2=base_url().'order_management/update_order/'.$delivered_details['id'];
			
		    $delivery_data .= <<<HTML_DATA
            <tr>
           <td>$district</td>
           <td>$name</td>
           <td>$mfl</td>
           <td>$year</td>
           <td>$order_total</td>
           <td>$delivery_total</td>
           <td>$fill_rate %</td>
           <td></td>
           <td><span ><a href='$link' class="label label-success" >Download</a></span>|
           <span ><a href='$link'>View</a></span></td>
           </tr>
HTML_DATA;
			
			endforeach;
			
			foreach($pending as $delivered_details):
			
			$mfl=$delivered_details['facility_code'];
			$name=$delivered_details['facility_name'];
			$order_date=$delivered_details['orderDate'];
			$district=$delivered_details['district'];
			$year=$delivered_details['mwaka'];
			$order_total=$delivered_details['orderTotal'];
			$order_total=number_format($order_total, 2, '.', ',');
			$link=base_url().'order_management/update_order/'.$delivered_details['id'];
			$link2=base_url().'order_approval/district_order_details/'.$delivered_details['id'];
			
		    $pending_data .= <<<HTML_DATA
            <tr>
           <td>$district</td>
           <td>$name</td>
           <td>$mfl</td>
           <td>$year</td>
           <td>$order_total</td>          
           <td><span ><a href='$link' class="label label-success" >Download</a></span>|
           <span ><a href='$link2' class="label label-inverse" >View</a></span>|
           <a id="$delivered_details[id]" href="#"class="delete"> 
		<span  class='label label-danger'>
		DELETE</span></a></td>
           </tr>
HTML_DATA;
			
			endforeach;
			
			foreach($rejected as $delivered_details):
			
			$mfl=$delivered_details['facility_code'];
			$name=$delivered_details['facility_name'];
			$order_date=$delivered_details['orderDate'];
			$district=$delivered_details['district'];
			$year=$delivered_details['mwaka'];
			$order_total=$delivered_details['orderTotal'];
			$order_total=number_format($order_total, 2, '.', ',');
			$link=base_url().'order_management/update_order/'.$delivered_details['id'];
			$link2=base_url().'order_approval/district_order_details/'.$delivered_details['id']."/1/1/1/1";;
		    $rejected_data .= <<<HTML_DATA
            <tr>
           <td>$district</td>
           <td>$name</td>
           <td>$mfl</td>
           <td>$year</td>
           <td>$order_total</td>          
          <td><span ><a href='$link' class="label label-success" >Download</a></span>|
           <span ><a href='$link2' class="label label-inverse" >View</a></span>|<a id="$delivered_details[id]" href="#"class="delete"> 
		<span  class='label label-danger'>
		DELETE</span></a></td>
           </tr>
HTML_DATA;
			
			endforeach;
			
				foreach($approved as $delivered_details):
			
			$mfl=$delivered_details['facility_code'];
			$name=$delivered_details['facility_name'];
			$order_date=$delivered_details['orderDate'];
			$district=$delivered_details['district'];
			$year=$delivered_details['mwaka'];
			$order_total=$delivered_details['orderTotal'];
			$order_total=number_format($order_total, 2, '.', ',');
			$link=base_url().'order_management/update_order/'.$delivered_details['id']; 
			$link2=base_url().'order_approval/district_order_details/'.$delivered_details['id']."/1/1/1/1";;
			
		    $approved_data .= <<<HTML_DATA
            <tr>
           <td>$district</td>
           <td>$name</td>
           <td>$mfl</td>
           <td>$year</td>
           <td>$order_total</td>
           <td><span ><a href='$link' class="label label-success" >Download</a></span>|
           <span><a href='$link2' class="label label-inverse" >View</a></span>|
           <a id="$delivered_details[id]" href="#"class="delete"> 
		<span  class='label label-danger'>
		DELETE</span></a>
           </td>
           </tr>
HTML_DATA;
			
			endforeach;
		$rejected_orders=0;
		$pending_orders=0;
		$approved_orders=0;
		$delivered_orders=0;
	//	foreach ($order_counts as $item) {
		    $rejected_orders=$order_counts[0]['rejected_orders'];
			$pending_orders=$order_counts[0]['pending_orders'];
			$approved_orders=$order_counts[0]['approved_orders'];
			$delivered_orders=$order_counts[0]['delivered_orders'];

		//} 
		?>
        <tr><td>Rejected Orders</td><td><?php echo $rejected_orders; ?></td></tr>
		<tr><td>Pending Approval</td><td><?php echo $pending_orders; ?></td></tr>
		<tr><td>Pending Delivery</td><td><?php echo $approved_orders; ?></td></tr>
		<tr><td>Delivered</td><td><?php echo $delivered_orders; ?></td></tr></tbody></table>

</div>

</div>
<div class="dash_main" style="overflow: auto">
<div class='label label-info'> Below are orders made in the sub-county</div>
<div class="tabbable tabs-left">
              <div class="tab-content">
              	 <ul class="nav nav-tabs">
              	 <li class=""><a href="#D" data-toggle="tab"><h3>Rejected Orders</h3></a></li>
                <li class=""><a href="#A" data-toggle="tab"><h3>Pending Approval</h3></a></li>
                <li class=""><a href="#B" data-toggle="tab"><h3>Pending Delivery</h3></a></li>
                <li class="active"><a href="#C" data-toggle="tab"><h3>Delivered</h3></a></li>
              </ul>
              <div class="tab-pane" id="D">
                        <table width="100%" id="rejected">
		<thead>
		<tr>
			<th>District</th>
			<th>Health Facility</th>
			<th>MLF No.</th>
			<th>Year</th>
			<th>Order Value (KSH)</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		<?php echo $rejected_data; ?>
			</tbody>
		
	</table>
                </div>
                <div class="tab-pane" id="A">
                        <table width="100%" id="delivered">
		<thead>
		<tr>
			<th>District</th>
			<th>Health Facility</th>
			<th>MLF No.</th>
			<th>Year</th>
			<th>Order Value (KSH)</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		<?php echo $pending_data; ?>
			</tbody>
		
	</table>
                </div>
                <div class="tab-pane" id="B">
                       <table width="100%" id="approved">
		<thead>
		<tr>
			<th>District</th>
			<th>Health Facility</th>
			<th>MLF No.</th>
			<th>Year</th>
			<th>Order Value (KSH)</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		<?php echo $approved_data; ?>
			</tbody>
		
	</table>
                </div>
                <div class="tab-pane active" id="C">
                  <table width="100%" id="delivered">
		<thead>
		<tr>
			<th>District</th>
			<th>Health Facility</th>
			<th>MLF No.</th>
			<th>Year</th>
			<th>Order Value (KSH)</th>
			<th>Received Value (KSH)</th>
			<th>Fill Rate %</th>
			<th>Lead Time</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		<?php echo $delivery_data; ?>
			</tbody>
		
	</table>
                </div>
              </div>
             
            </div>


</div>

