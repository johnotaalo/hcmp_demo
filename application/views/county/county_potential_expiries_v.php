<script type="text/javascript" language="javascript" src="<?php echo base_url();  ?>Scripts/jquery.dataTables.js"></script>
<style type="text/css" title="currentStyle">
			
			@import "<?php echo base_url(); ?>DataTables-1.9.3 /media2/css/jquery.dataTables.css";
		</style>

<script type="text/javascript" language="javascript">
$(document).ready(function(){
	 //default call
    $("#3months").click(function(){
      var url = "<?php echo base_url().'stock_expiry_management/get_expiries'?>";
      var id  = $(this).attr("id");
      //alert (id);
        $.ajax({
          type: "POST",
          data: {'id':  $(this).attr("id"),},
          url: url,
          beforeSend: function() {
            $(".reportDisplay").html("");
          },
          success: function(msg) {
            $(".reportDisplay").html(msg);
            
             }
         });
    });
    $("#6months").click(function(){
      var url = "<?php echo base_url().'stock_expiry_management/get_expiries'?>";
      var id  = $(this).attr("id");
      //alert (id);
        $.ajax({
          type: "POST",
          data: {'id':  $(this).attr("id"),},
          url: url,
          beforeSend: function() {
            $(".reportDisplay").html("");
          },
          success: function(msg) {
            $(".reportDisplay").html(msg);
            
             }
         });
    });
    $("#12months").click(function(){
      var url = "<?php echo base_url().'stock_expiry_management/get_expiries'?>";
      var id  = $(this).attr("id");
      //alert (id);
        $.ajax({
          type: "POST",
          data: {'id':  $(this).attr("id"),},
          url: url,
          beforeSend: function() {
            $(".reportDisplay").html("");
          },
          success: function(msg) {
            $(".reportDisplay").html(msg);
            
             }
         });
    });
        });  
</script>

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
  -webkit-box-shadow: 0px 0px 10px rgba(0,0,0,.8);
   -moz-box-shadow: 0px 0px 10px rgba(0,0,0,.8);
   box-shadow: 0px 0px 10px rgba(0,0,0,.8);	
	}
	
</style>
<?php
foreach ($report as $item) {
	foreach ($item->Coder as $coder) {
		$facility_name=$coder->facility_name;
	}
}
if ($mycount>0) {?>
<fieldset>

		<legend></legend>
	<h2>Commodities Expiring in the Next:</h2>  
	<button id="3months" class="awesome blue" style="margin-left:1%; margin-top: 0.5em;";> Next 3 Months</button> 
	<button id="6months" class="awesome blue" style="margin-left:1%; margin-top: 0.5em;";> Next 6 Months</button>
	<button id="12months" class="awesome blue" style="margin-left:1%; margin-top: 0.5em;";> Next 12 Months</button>  
	
	
</fieldset>
<div class="whole_report">
	<!--<div class="try">
<button class="button">Download PDF</button>
</div>-->
<div>
	<img src="<?php echo base_url().'Images/coat_of_arms.png'?>" style="position:absolute;  width:90px; width:90px; top:0px; left:0px; margin-bottom:-100px;margin-right:-100px;"></img>
       
       <span style="margin-left:100px;  font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 15px;">
     Ministry of Health</span><br>
       <span style=" font-size: 12px;  margin-left:100px;">Health Commodities Management Platform</span><span style="text-align:center;" >
       	<h2 style="text-align:center; font-size: 20px;">Potential Expiries in <?php echo $facility_name; ?></h2>
       
       
      
       	<hr/> 
        
        	
</div>


<table class="data-table1">
	<tr><td colspan="8"> 
	</td></tr>	
	
		
	<tr>
		<th><strong>Kemsa Code</strong></th>
		<th><strong>Description</strong></th>
		<th><strong>Unit size</strong></th>
		<th><strong>Unit Cost</strong></th>
		<th><strong>Batch No</strong></th>
		<th><strong>Expiry Date</strong></th>
		
		<th><strong><b>Units</b></strong></th>
		<th><strong><b>Stock Worth(Ksh)</b></strong></th>
	</tr><tbody>
		
		<?php 
				foreach ($report as $drug ) { ?>
					
					<?php foreach($drug->Code as $d){ 
								$name=$d->Drug_Name;
								$code=$d->Kemsa_Code;
					            $unitS=$d->Unit_Size; 
								$unitC=$d->Unit_Cost;
								$calc=$drug->balance;
								$thedate=$drug->expiry_date;
								$formatme = new DateTime($thedate);
								 $myvalue= $formatme->format('d M Y');
								?>
				
						<tr>
							
							<td><?php echo $code;?> </td>
							<td><?php echo $name;?></td>
							<td><?php echo $unitS;?> </td>
							<td><?php echo $unitC;?> </td>
							<td><?php echo $drug->batch_no;?> </td>
							<td><?php echo $myvalue;?></td>
							
							
								
							<td><?php echo $drug->balance;?></td>
							<td> <?php echo $calc*$unitC;?> </td>
							
						</tr>
					<?php }
							?>		
		</tbody>
		
		<?php }
					?>	
	 
</table>



<?php 

if ($option1=' ') { ?>
	<input type="hidden"  id="interval" name="interval" value="12_months" />
	<?php
} else { ?>
	<input type="hidden"  id="interval" name="interval" value="<?php echo $option ?>" />
	<?php
}

?>



		</div>
		<?php } else {
			echo '<div class="norecord"></div>';
		} ?>