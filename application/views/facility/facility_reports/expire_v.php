<style>
table.data-table1 {
	border: 1px solid #000033;
	margin: 10px auto;
	border-spacing: 0px;
	}
	
table.data-table1 th {
	border: none;
	color:#036;
	text-align:center;
	font-size: 13.5px;
	border: 1px solid #000033;
	border-top: none;
	max-width: 600px;
	}
table.data-table1 td, table th {
	padding: 4px;
	}
table.data-table1 td {
	border: none;
	border-left: 1px solid #000033;
	border-right: 1px solid #000033;
	height: 30px;
	width: 130px;
	font-size: 12.5px;
	margin: 0px;
	border-bottom: 1px solid #000033;
	}
.col5{
	background:#C9C299;
	}
	.try{
		float: right;
		margin-bottom: 1px auto;
	}
	.whole_report{
	      
    position: relative;
  width: 88%;
  background: #FFFAF0;
  -moz-border-radius: 4px;
  border-radius: 4px;
  padding: 2em 1.5em;
  color: rgba(0,0,0, .8);
  
  line-height: 1.5;
  margin: 20px auto;
   box-shadow: 0px 0px 5px #ccc;
  -moz-box-shadow: 0px 0px 5px #ccc;
  -webkit-box-shadow: 0px 0px 5px #ccc;
	}
	
	.messages{
		background-color: #036;
width: auto;
height: 50px;
line-height: 50px;
color: white;
text-decoration: none;
font-size: 14px;
font-family: helvetica, arial;
font-weight: bold;
display: inline;
padding: 5px;

		 
		
	}

	
</style>
<script>
	$().ready(function(){
		
				var $myDialog = $('<div></div>')
    .html('<h2>Please Confirm</h2>')
    .dialog({
        autoOpen: false,
        title: 'Confirmation',
        buttons: { "Cancel": function() {
                      $(this).dialog("close");
                      return false;
                },
                "OK": function() { 
                       $(this).dialog("close");
                      $('#myform').submit();
                      $('#order_processing').modal(); 
                	}                	
                      
                 }
      });
      
      $("#yesno").click(function() {
		return $myDialog.dialog('open');
	});
      
});
</script>
<div class="messages">
	*Decommision-This sends an email with an attachment of all expired drugs to the DPP. (<?php echo $dpp_array[0]['fname'].' '.$dpp_array[0]['lname'] ?>)
</div>
<div class="whole_report">
	<div class="try">
<button id="yesno" class="button">Decomission</button>
</div>
	<?php $attributes = array( 'name' => 'myform', 'id'=>'myform');
	 echo form_open('stock_expiry_management/Decommission',$attributes).form_close();?>
	
<div>
	<img src="<?php echo base_url().'Images/coat_of_arms.png'?>" style="position:absolute;  width:90px; width:90px; top:0px; left:0px; margin-bottom:-100px;margin-right:-100px;"></img>

       <span style="margin-left:100px;  font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 15px;">
     Ministry of Health</span><br>
       <span style=" font-size: 12px;  margin-left:100px;">Health Commodities Management Platform</span><span style="text-align:center;" >
       	<h2 style="text-align:center; font-size: 20px;">Expired Commodities as of <?php 
					
					$today= ( date('d M, Y')); 
					echo $today;					
				?></h2>
</div>
<table class="data-table">
	
	<tr>
		<th>Source</th>
		<th>Item Code</th>
		<th>Description</th>
		<th>Batch No Affected</th>
		<th>Manufacturer</th>
		<th>Expiry Date</th>
		<th>Unit size</th>
		<th>Stock Expired (Packs)</th>
		<th>Unit Cost (KSH)</th>
		<th>Total Cost(KSH)</th>
	</tr>
	
			
		<tbody>
		
		<?php    $total=0;

				foreach ($expired as $drug ) { 
				foreach($drug->Code as $d){
						        $total_units=$d->total_units ;
								$name=$d->Drug_Name;
								$code1=$d->Kemsa_Code;
					            $unitS=$d->Unit_Size; 
								$unitC=$d->Unit_Cost;
								$calc=$drug->balance;
								$balance=round(($calc/$total_units),1);
								$total_expired=$drug->total;
								$total=round($total+$total_expired,1);
								$thedate=$drug->expiry_date;
								$formatme = new DateTime($thedate);
								 $myvalue= $formatme->format('d M Y');
								 
							foreach($d->CommoditySourceName as $test):
					$code=$test->source_name;
					endforeach;
								?>
				
						<tr>
							
							<td><?php echo $code;?> </td>
						    <td><?php echo $code1;?> </td>
							<td><?php echo $name;?></td>
							<td><?php echo $drug->batch_no;?> </td>
							<td><?php echo $drug->manufacture;?> </td>
							<td><?php echo $myvalue;?></td>
							<td><?php echo $unitS;?></td>
							<td><?php echo $balance;?></td>
							<td><?php echo $unitC;?></td>
							<td><?php echo number_format($total_expired, 2, '.', ',');?></td>
							
							
						</tr>
					<?php }
								
	                      }

					?>	
			<tr><td colspan="8" ></td><td><b>TOTAL (KSH) </b></td><td><b><?php echo number_format($total, 2, '.', ','); ?></b></td></tr>
		
	 </tbody>
</table>
</div>
<!--------order processing data---------->
<div class="modal fade" id="order_processing" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       
        <h2 class="modal-title">Processing Decommission....</h2>
      </div>
      <div class="modal-body">
    
        <h2 class="label label-info">Please wait as Decommission is being processed </h2><img src="<?php echo base_url().'Images/processing.gif' ?>" />
      </div>
      <div class="modal-footer">       
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->