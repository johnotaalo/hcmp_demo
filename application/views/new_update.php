<script type="text/javascript" language="javascript" src="<?php echo base_url();  ?>Scripts/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();  ?>Scripts/unit_size.js"></script>
		<style type="text/css" title="currentStyle">
			
			@import "<?php echo base_url(); ?>DataTables-1.9.3 /media2/css/jquery.dataTables.css";
		</style>
<style>

.user{
		width:6.25em;
	}
	
	.user1{
	width:100px;
	background : none;
	border : none;
		}
	.date{
		width:8.675px;
	}
	
	.label-container
{
    margin: 10px 10px;
}
	#updateord input[type="text"]{
		
		height: 1.4em;
		margin:0.5em;
	}
	

	</style>   
   	<div id="IssueNow" title="Fill in the details below">
	<table class="table-update" width="100%">
					<thead>
					<tr>
						
						<th><b>Description</b></th>
						<th><b>KEMSA code</b></th>
						<th><b>Unit Size</b></th>
						<th><b>Batch No</b></th>
						<th>Manufacturer</th>
						<th><b>Expiry Date &nbsp;</b></th>
						<th><b>Quantity Received</b></th>
						<th><b>Total Unit Count</b></th>
							
						    
					</tr>
					</thead>
					<tbody>
						<tr>
							
						<td>
			<input type="hidden" id="desc_hidden"  name="desc_hidden"/>				
        <select id="desc" name="desc">
    <option>-Type Commodity Name-</option>
		<?php 
		foreach ($drugs as $drugs) {
			$id=$drugs->id;
			$id1=$drugs->Kemsa_Code;
			$drug=$drugs->Drug_Name;
			$unit_size=$drugs->Unit_Size;
			foreach($drugs->Category as $cat){
				
			$cat_name=$cat;	
				
			}
			?>
			<option value="<?php echo $id."|".$id1."|".$cat_name."|".$drug."|".$unit_size;?>"><?php echo $drug;?></option>
		<?php }
		?>
	</select></td>
	<td >
						<input size="10" type="text" style="border: none" name="kemsa_code" id="kemsa_code"/>
	</td>
	<td width="50">
						<input size="10" type="text" style="border: none" name="u_size[0]" id="unit_size" />
	</td>
						<td >
						<input size="10" type="text" name="batchNo" />
	</td>
	<td><input class='user' type='text' name='manufacturer' id='manufacturer' value=''/></td>
	<?php 
$today= date("d M Y"); ?>
	<td width="80">
	<input size="15" type="text" name="Exp" value="<?php echo $today; ?>"  id="expiry_date" />
	</td>
	<td width="80">
						<input size="5" type="text" name="units1[0]" id="p_units1" onkeyup="calculate_units1(0)" />
	</td>
						
	
	<td width="80"><input size="10" type="text" style="border: none" id="qreceived" name="qreceived[0]"/>
		
		
	</td>
						</tr>
					</tbody>
					</table>
					
	 			
						<input type="hidden"id="kemsac" name="kemsac"  readonly="readonly" />
						<input type="hidden" class="user" id="avlb_hide" name="avlb_hide" /> 
						<label></label>
						
</div>
<?php 
$att=array("name"=>'myform','id'=>'myform');
	 echo form_open('stock/submit',$att); ?>
	 <?php foreach($ord as $d):
	 	
	 	?>
	 	<div>
	 		<p id="notification" style="text-align:center;">Please enter Order Delivery details and Received commodities in Packs and NOT units </p>
		
	 	</div>
	 	<div style=" font-size: 15px; margin-bottom: 1em;"><a href="#" class="show_hide" >Delivery Dispatch Details. Click to Show / Hide</a></div>
	 	
	 	<div id="updateord" >
	 	<fieldset id="updateOrderleft">
	 		<legend>Order Details</legend>
	 		<div >
	 	<label>Order Date :</label>
	 	<input type="text" class="user1" name="orderd" readonly="readonly" value="<?php $s= $d->orderDate; echo date('d M, Y', strtotime($s)); ?>"  />
	 	
	 	<label>Order By:</label>
	 	<input type="text" readonly="readonly" class="user1" name="orderby" value="<?php 
	 	
	 	$user_details=user::getAllUser($d->orderby)->toArray();
	 	
	 	echo $user_details[0]['fname']." ".$user_details[0]['lname'];?>" />
	 	
	 	<label>Order No:</label>
	 	<input type="text" name="order"  class="user1" readonly="readonly" value="<?php echo $this->uri->segment(3); ?>" />	 	
	 	
	 	 </div>
	 	</fieldset>
	
	 
	 <fieldset id="updateOrder_Centerleft">
	 	<legend>Approval Details</legend>
	 <div >
	 	
	 	<label>Approval Date</label>
	 	<input type="text" name="appd" readonly="readonly" class="user1" value="<?php  $p=$d->approvalDate; echo date('d M, Y', strtotime($p));?>" />
	 	
	 	<label>Approved By</label>
		<input type="text"  name="appby" class="user1" readonly="readonly" value="<?php $user_details=user::getAllUser($d->approveby)->toArray();
	 	
	 	echo $user_details[0]['fname']." ".$user_details[0]['lname']; ?>" />
		
		<label>Order Sheet No :</label>
		<input type="text" name="lsn" value="" class="user1" readonly="readonly" />
				
		</div>
	 </fieldset>
	
	 <fieldset id="updateOrder_Centerright">
	 	 <legend>Dispatch Details</legend>
	 <div >
	 			
		<label>Dispatch Date:</label>
		<input type="text" name="dispdate" class="user1" value="<?php echo $today;?>" id="dispatch_date" />	
			
		<label>Delivery Note No:</label>
		<input type="text" name="dno" />
				
		<label>Warehouse</label>
		<input type="text" name="warehouse" />
		</div>
		</fieldset>
		
		<fieldset id="updateOrderright">
	 	<legend>Delivery Details</legend>
	 <div >
	 	
	 	<label>Date Received</label>
	 	<input type="text" readonly="readonly" name="ddate" value="<?php echo date('d M, Y');?>"  id="rdates" class="box" />
	 	
	 	<label>Received By</label>
		<input type="text" readonly="readonly" class="user1" name="rname" value="<?php echo $this -> session -> userdata('names');?> <?php echo $this -> session -> userdata('inames');?>" />
		
		<label>Receiver's Phone`s Number:</label>
		<input type="text" name="rphone" class="user1" readonly="readonly" value="<?php echo $this -> session -> userdata('phone_no');?>"  />
				
		</div>
	 </fieldset>
  <?php endforeach?> 
 
  </div>		
  <div >
		<p id="notification">* Commodities as supplied by KEMSA</p>	</div>
 <div id="demo1" >
 	
		<table  id="main" width="100%">
					<thead>
					<tr>
						<th><b>KEMSA Code</b></th>
						<th><b>Description</b></th>
						<th><b>Unit Size</b></th>
						<th><b>Ordered Qty</b></th>
						<th><b>Batch No</b></th>
						<th>Manufacturer</th>
						<th><b>Expiry Date</b></th>
						<th><b>Quantity Received</b></th>
						<th><b>Total Unit Count</b></th>					   				    
					</tr>
					</thead>
					<tbody>
						
					<?php 
					$main_count=1;
					foreach ($order_details as $value) {
						$value1=$value->kemsa_code;
						$order_qty=$value->quantityOrdered;
						 
					
						foreach($value->Code as $drug1){
						 
							$drug_name=$drug1->Drug_Name;
							$drug_code=$drug1->Kemsa_Code;
							$unit_size=$drug1->Unit_Size;
							$unit_cost=$drug1->Unit_Cost;
							//$order_qty=$drug1->quantityOrdered;
							
		
						}
						foreach($drug1->Category as $cat){
				
			$cat_name=$cat;	
				
			}
						echo"
						<tr>
						
						<input type='hidden' name='kemsaCode[$main_count]' value=$value1 />
						<input type='hidden' name='drugName[$main_count]' value=$drug_name />
						<td>$drug_code</td>
						<td>$drug_name</td>
						<td><input class='user1' readonly='readonly' type='text' name='u_size[$main_count]' value='$unit_size'/></td>
						<td><input class='user1' readonly='readonly' type='text' name='u_size[$main_count]' value='$order_qty'/></td>
						<td><input class='user' type='text' name='batchNo[$main_count]' value=''/></td>
						<td><input class='user' type='text' name='manufacturer[$main_count]' value=''/></td>
						<td><input  class='my_date user' type='text' name='Exp[$main_count]'  value=''/></td>
						<td><input class='user' type='text' name='units1[$main_count]'  value='' onkeyup='calculate_units1($main_count)'/></td>
						<td><input class='user1' readonly='readonly'  type='text' name='qreceived[$main_count]' value='' /> </td>
						
						</tr>";
						
					$main_count=$main_count+1;
					}
					
					echo "<script>var count=".($main_count)."</script>";
					?>
					
							
								
						</tbody>
					
				</table>
			
			<br />
<button class="btn"   id="NewIssue">Add Commodity</button>
<button class="btn btn-primary" id="finishIssue">Save </button>
		</div>
			 <script> 
   /************************************calculating the  order values *******/
  
  function calculate_units1 (argument) {
  	
  	var x= argument;
  
  	
    //checking if the quantity is a number 	    
	var num = document.getElementsByName("units1["+x+"]")[0].value.replace(/\,/g,'');
if(!isNaN(num)){
if(num.indexOf('.') > -1) {
alert("Decimals are not allowed.");
document.getElementsByName("units1["+x+"]")[0].value = document.getElementsByName("units1["+x+"]")[0].value.substring(0,document.getElementsByName("units1["+x+"]")[0].value.length-1);
document.getElementsByName("units1["+x+"]")[0].select();
return;
}
} else {
alert('Enter only numbers');
document.getElementsByName("units1["+x+"]")[0].value= document.getElementsByName("units1["+x+"]")[0].value.substring(0,document.getElementsByName("units1["+x+"]")[0].value.length-1);
return;
}
  var actual_unit_size=get_unit_quantity(document.getElementsByName("u_size["+x+"]")[0].value);
    
 var total_units1=actual_unit_size*num;
 
   document.getElementsByName("qreceived["+x+"]")[0].value=total_units1; 
    
    
  }
   
   /*********************getting the last day of the month***********/
  function getLastDayOfYearAndMonth(year, month)
{
    return(new Date((new Date(year, month + 1, 1)) - 1)).getDate();
}
   
  /******************************************data-table set up*********************/
/* Define two custom functions (asc and desc) for string sorting */
			jQuery.fn.dataTableExt.oSort['string-case-asc']  = function(x,y) {
				return ((x < y) ? -1 : ((x > y) ?  1 : 0));
			};
			
			jQuery.fn.dataTableExt.oSort['string-case-desc'] = function(x,y) {
				return ((x < y) ?  1 : ((x > y) ? -1 : 0));
			}; 
    </script>   
   <script> 
	
	 /************************************document ready**********************************************************/
   $(document).ready(function() {
		
		        $( "#desc" ).combobox({
        	selected: function(event, ui) {
        		
           var data =$("#desc").val();
           
           var data_array=data.split("|");
         
           $('#unit_size').val(data_array[4]);
            $('#kemsa_code').val(data_array[1]);
         
            $( "#desc_hidden" ).val(data);
            
			}
			});
		
				
		json_obj = {
				"url" : "<?php echo base_url().'Images/calendar.gif';?>",
				};
	var baseUrl=json_obj.url;			
		$( "#datepicker" ).datepicker({
			showOn: "button",
			changeMonth: true,
			changeYear: true,
			dateFormat: 'd M, yy', 
			buttonImage: baseUrl,
			buttonImageOnly: true
		});
		$( "#expiry_date" ).datepicker({
			beforeShowDay: function(date)
    {
        // getDate() returns the day [ 0 to 31 ]
        if (date.getDate() ==
            getLastDayOfYearAndMonth(date.getFullYear(), date.getMonth()))
        {
            return [true, ''];
        }

        return [false, ''];
    },
			changeMonth: true,
			changeYear: true,
			dateFormat: 'd M yy'
		});
		
		$( "#rdates,#dispby" ).datepicker({
			showOn: "button",
			changeMonth: true,
			changeYear: true,
			dateFormat: 'd M yy', 
			buttonImage: baseUrl,
			buttonImageOnly: true
		});

		$( "#dispatch_date" ).datepicker({
			showOn: "button",
			changeMonth: true,
			changeYear: true,
			dateFormat: 'd M yy', 
			buttonImage: baseUrl,
			buttonImageOnly: true
		});
				
		
         
		$( "#IssueNow" ).dialog({
		    autoOpen: false,
			height: 200,
			width:1250,
			modal: true,
			buttons: {
				"Add Commodity": function() {
					
					var details=$("#desc_hidden").val();	
					var details_array=details.split("|");				
						    
          $( "#main" ).dataTable().fnAddData( [
          	"" + details_array[1] + "",
         '<input type="hidden" name="kemsaCode['+count+']" value="'+details_array[0]+'" />'+
         '<input type="hidden" name="drugName['+count+']" value="'+details_array[3]+'" />'+ 
							"" + details_array[3] + "",
							'' +'<input class="user1" readonly="readonly" type="text" name="u_size['+count+']" value="'+$('#unit_size').val()+'"/>',
							'' +'<input class="user1" readonly="readonly" type="text"  value="0"/>',
							'' +'<input class="user" type="text" name="batchNo['+count+']" value="'+$('input:text[name=batchNo]').val()+'"/>',
							'' +'<input class="user" type="text" name="manufacturer['+count+']" value="'+$('input:text[name=manufacturer]').val()+'"/>',
							'' +'<input class="my_date user" type="text" name="Exp['+count+']"  value="'+ $('input:text[name=Exp]').val() +'"/>',
							'' +'<input class="user" type="text" name="units1['+count+']"  value="'+ $('#p_units1').val() +'" onkeyup="calculate_units1('+count+')" "/>',
							'' +'<input class="user1" readonly="readonly" type="text" name="qreceived['+count+']"  value="'+ $('#qreceived').val() +'"/> <img class="del" src="<?php echo base_url()?>Images/close.png" />'
							] ); 
						count= count+1;
						$( this ).dialog( "close" );
					refreshDatePickers();
						
        
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				$('#kemsa_code').val('');
				$('#unit_size').val('');
				$('input:text[name=batchNo]').val('');
				$('#p_units1').val('');
				$('#qreceived').val('');
				
			}
						
			});
			
			$( "#NewIssue" )
			.button()
			.click(function() {
				$( "#IssueNow" ).dialog( "open" );
			});
			$( "#finishIssue" )
			.button()
			.click(function() {
				$( "#myform" ).submit();
				 return true;
			});
			// Select all table cells to bind a click event
$('.del').live('click',function(){
    $(this).parent().parent().remove();
});
		
	
	
		function refreshDatePickers() {
		var counter = 0;
		$('.my_date').each(function() {
			var this_id = $(this).attr("id"); // current inputs id
        var new_id = counter +1; // a new id
        $(this).attr("id", new_id); // change to new id
        $(this).removeClass('hasDatepicker'); // remove hasDatepicker class
        $(this).datepicker({ 
        	dateFormat: 'd M yy', 
        	        		beforeShowDay: function(date)
    {
        // getDate() returns the day [ 0 to 31 ]
        if (date.getDate() ==
            getLastDayOfYearAndMonth(date.getFullYear(), date.getMonth()))
        {
            return [true, ''];
        }

        return [false, ''];
    },
					changeMonth: true,
			        changeYear: true
				});; // re-init datepicker
				counter++;
		});
	}
	

   
refreshDatePickers();

    	$('#main').dataTable( {
         "bJQueryUI": true,
          "bPaginate": false
				} );
				
				//$("#updateord").hide();
        $(".show_hide").show();
 
    $('.show_hide').click(function(){
    $("#updateord").slideToggle();
    });

				
				
    
});

   </script>  
		