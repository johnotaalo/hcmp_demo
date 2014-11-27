 <h1 class="page-header" style="margin: 0;font-size: 1.6em;">Expiries <?php echo $facility_name.' '.date('Y') ;?></h1>
  <div style="min-height: 400px;">
    <table  class="table table-hover table-bordered table-update" id="exp_datatable" >
  <thead style="background-color: white">
  <tr>
    <th>Commodity Description</th>
    <th>Commodity Code </th>
    <th>Unit size</th>
    <th>Batch No Affected</th>
    <th>Manufacturer</th>
    <th>Expiry Date</th>
    <th># Days after Expiry</th>
    <th>Stock Expired (Packs)</th>
    <th>Stock Expired (Units)</th>
    <th>Unit Cost (KSH)</th>
    <th>Total Cost(KSH)</th>
  </tr>
  </thead>
      
    <tbody>
    
     <?php   
           $total=0; $count=0;
        foreach ($expiry_data as $potential_exp ) { 
                $potential_exp[''];
                $formatdate = new DateTime($potential_exp['expiry_date']);
                $formated_date= $formatdate->format('d M Y');
                $total_units=$potential_exp['total_commodity_units'];
                $calculated=$potential_exp['current_balance'];
                $expired_packs=($calculated/$total_units);
                $total_exp_cost=  $expired_packs*$potential_exp['unit_cost'];
                $ts1 = strtotime(date($potential_exp['expiry_date']));
                $ts2 = strtotime(date('d M Y'));
                $seconds_diff = $ts2 - $ts1;
				$total=$total+ $total_exp_cost;  
				$count=($potential_exp['status']==1) ? $count+1: $count;
                ?>    
            <tr>                          
              <td><?php echo $potential_exp['commodity_name'];?> </td>
              <td><?php echo $potential_exp['commodity_code']; ;?> </td>
              <td><?php echo $potential_exp['unit_size'];?> </td>
              <td><?php echo $potential_exp['batch_no'];?> </td>
              <td><?php echo $potential_exp['manufacture'];?> </td>
              <td><?php echo $formated_date;?> </td>
              <td><?php echo floor($seconds_diff/3600/24);?> </td>
              <td><?php echo $expired_packs;?> </td>
              <td><?php echo $calculated;?> </td>                          
              <td><?php echo $potential_exp['unit_cost'];?> </td>
              <td><?php  echo number_format($total_exp_cost, 2, '.', ',');?></td>
            </tr>
          <?php
                }echo "<tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>Total</td>
          <td>".number_format($total, 2, '.', ',')."</td></tr>";
          ?>  
   </tbody>
</table>
<?php
if (!$this -> session -> userdata('facility_id')):
else: 
if($count>0):
$att = array("name" => 'myform', 'id' => 'myform');
echo form_open('stock/decommission', $att);

?>		
</form>
<hr />
<div class="container-fluid">
<div style="float: right">	
<button class="remove btn btn-danger"><span class="glyphicon glyphicon-remove"></span>Decommission Items</button></div>

</div>
<?php endif; endif;?>
</div>

<script type="text/javascript">
$(document).ready(function() {
	
	$('#datatable').dataTable( {
		 "sDom": "T lfrtip",
	
	     "sScrollY": "377px",
	     
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page",
                        "sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
                    },
			      "oTableTools": {
                 "aButtons": [
				"copy",
				"print",
				{
					"sExtends":    "collection",
					"aButtons":    [ "csv", "xls", "pdf" ]
				}
			],
			"sSwfPath": "<?php echo base_url(); ?>assets/datatable/media/swf/copy_csv_xls_pdf.swf"
		}
	} );
	$('.dataTables_filter label input').addClass('form-control');
	$('.dataTables_length label select').addClass('form-control');
$(".remove").on('click',function() {
dialog_box('<h6 style="display: inline-block; font-weight:500;font-size: 18px;padding-left: 2%;">Please Note this action will remove the expired stock from your store, are you sure you want to continue?</h6>',
'<button type="button" class="btn btn-primary" data-dismiss="modal">NO</button><button type="button" class="yes btn btn-danger" data-dismiss="modal">YES</button>');
$(".yes").on('click', function (){
	     //This event is fired immediately when the hide instance method has been called.
    $('.container-fluid').delay(500).queue(function (nxt){
     // Load up a new modal...
    var img='<img src="<?php echo base_url('assets/img/wait.gif') ?>"/>';
  $("#myform").submit();
     dialog_box(img+'<h5 style="display: inline-block; font-weight:500;font-size: 18px;padding-left: 2%;">Please wait as decommissioning is being processed</h5><span class="label label-danger">DO NOT refresh the browser, First confirm if the stock levels have been updated</span>'
     ,
     '');
    	nxt();
    });
})
});

});

</script>