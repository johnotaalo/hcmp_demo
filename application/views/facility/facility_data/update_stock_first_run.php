<div  class='label label-info' style="font-size: 1.8em">Please note this is a one off activity</div><br>
<div  class='label label-info' style="font-size: 1.8em">Stock level as of <?php $today= ( date('d M Y')); //get today's date in full?>
<input type="hidden" name="datepicker" readonly="readonly" value="<?php echo $today;?>"/><?php echo $today;?> To Add facility stock data, first do physical stock count</div> 

<?php $att=array("name"=>'myform','id'=>'myform');
echo form_open('stock_management/add_stock_first_run',$att); ?>
<table border="0" class="table table-hover table-bordered table-update" width="50%" id="order_table">
	<thead>
		<tr>
			<th style="text-align:center; font-size: 14px"><b>Description</b></th>
			<th style="text-align:center; font-size: 14px"><b>Source</b></th>
			<th style="text-align:center; font-size: 14px"><b>Unit Size</b></th>
			<th style="text-align:center; font-size: 14px"><b>Unit of Issue</b></th>
			<th style="text-align:center; font-size: 14px"><b>Batch No</b></th>
			<th style="text-align:center; font-size: 14px"><b>Manufacturer</b></th>
			<th style="text-align:center; font-size: 14px"><b>Expiry Date</b></th>
			<th style="text-align:center; font-size: 14px"><b>Stock Level</b></th>
			<th style="text-align:center; font-size: 14px"><b>Total Unit Count</b></th>
			<th style="text-align:center; font-size: 14px"><b>Options</b></th>
		</tr>
	</thead>
	    <tbody>
		<tr drug_row="1">
			<td><input type="hidden" id="desc_hidden" class="desc_hidden"  name="desc_hidden"/>	
				<input type="hidden" class="drug_id" value=""  name="drug_id[]"/>
			<select  name="desc[]" class="desc">
				<option title="0" value="0">-Select One--</option>
				<?php
				foreach ($drugs as $drug) {
					$id=$drug->id;
					//$id1=$drug->Kemsa_Code;
					$drug_name=$drug->Drug_Name;
					$unit_size=$drug->Unit_Size;
					foreach($drug->CommoditySourceName as $test):
					$id1=$test->source_name;
					endforeach;
					echo "<option title='" . $id."^".$id1."^".$drug."^".$unit_size . "' value='$id'>" .$drug->Drug_Name ;
				}
				?>
			</select></td>
			<td><input type="text" class="input-small kemsa_code" readonly="readonly" name="kemsa_code[]"/></td>
			<td><input  type="text" class="input-small unit_size" readonly="readonly"  name="u_size[]" /></td>
			<td>
			<select name="unitissue[]" class="unitissue input-small">
			<option value="Pack_Size">Pack Size</option>
			<option value="Unit_Size">Unit Size</option>
			</select>	
			</td>
			<td><input class='input-small batchN' name='batchNo[]' type='text'/></td>
			<td><input id='manuf' class="manuf" name='manuf[]' type='text' value="" /></td>
			<td><input  class='input-small my_date'  name='expiry_date[]' type='text' /></td>
			<td><input id='a_stock' name='a_stock[]' type='text' class="input-small a_stock" /></td>
			<td><input class='input-small qreceived' id='qreceived' readonly='readonly'  type='text' name='qreceived[]' value=''  /></td>
			<td>
			<a class="add label label-success">Add Row</a>
            <a class="remove label label-important" style="display:none;">Remove Row</span>
			</td>
		</tr>
	</tbody>
</table>
<?php echo form_close();?>

 <button class="btn btn-primary"  id="save1" >Save</button>
 <script type="text/javascript" language="javascript" src="<?php echo base_url();  ?>Scripts/unit_size.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		//Check if drugs were temporarily saved
		var link="<?php echo base_url().'stock_management/getTempStock' ?>";
		$.ajax({
			url : link,
			type : 'POST',
			dataType : 'json',
			success : function(data) {
				var data_count=data.length;
				var x=1;
				var last_row=$('#order_table tr:last');
				$.each(data, function(i, jsondata) {
					var drug_id=data[i]['id'];
					var category=data[i]['category'];
					var kemsa_code=data[i]['kemsa_code'];
					var description=data[i]['description'];
					var unit_size=data[i]['unit_size'];
					var batch_no=data[i]['batch_no'];
					var manu=data[i]['manu'];
					var expiry_date=data[i]['expiry_date'];
					var stock_level=data[i]['stock_level'];
					var unit_count=data[i]['unit_count'];
					var facility_code=data[i]['facility_code'];
					var drug_id=data[i]['drug_id'];
				    var unit_issue=data[i]['unit_issue'];
					
					var cloned_object = $('#order_table tr:last').clone(true);
					var drug_row = cloned_object.attr("drug_row");
					var next_drug_row = parseInt(drug_row) + 1;
					cloned_object.attr("drug_row", next_drug_row);
					cloned_object.find(".remove").show();
					
					var expiry_id = "expiry_date_" + next_drug_row;
					var comb=drug_id+"^"+kemsa_code+"^"+description+"^"+unit_size;
					comb= $.trim(comb);
					cloned_object.find(".desc").val(drug_id);
					cloned_object.find(".kemsa_code").attr('value',kemsa_code);
					cloned_object.find(".unit_size").attr('value',unit_size);
					cloned_object.find(".batchN").attr('value',batch_no);
					cloned_object.find(".manuf").attr('value',manu);
					cloned_object.find(".my_date").attr('value',expiry_date);
					cloned_object.find(".a_stock").attr('value',stock_level);
					cloned_object.find(".qreceived").attr('value',unit_count);
					cloned_object.find(".unitissue").attr('value',unit_issue);
					cloned_object.find(".drug_id").attr('value',drug_id);
					cloned_object.insertAfter('#order_table tr:last');
					
					if(x==data_count){
						$('#order_table tbody tr:first').remove();
					}
					x++;
					
				});

			}
		});
		

		$(".desc").change(function(){
			var data =$('option:selected', this).attr('title'); 

	       	var data_array=data.split("^");
	       	$(this).closest("tr").find(".unit_size").val(data_array[3]);
	     	$(this).closest("tr").find(".kemsa_code").val(data_array[1]);
	     	$(this).closest("tr").find(".drug_id").val(data_array[0]);

		});
		
		$(".add").click(function() {
			
			var last_row = $('#order_table tr:last');
			//Get data for the last row
			var last_drug=last_row.find(".desc").val();
			/*
			 * Post temp data
			 */
			var url = "<?php echo base_url().'stock_management/autosave_update'?>";
			
			var data =$('option:selected', $(this).closest("tr").find('.desc')).attr('title'); 
            
	       	var data_array=data.split("^");
			var unit_size=$(this).closest("tr").find('.unit_size').val();
			var batchNo=$(this).closest("tr").find('.batchN').val();
			var manuf=$(this).closest("tr").find('.manuf').val();
			var expiry_date=$(this).closest("tr").find('.my_date').val();
			var stock_level=$(this).closest("tr").find('.a_stock').val();
			var unit_count=$(this).closest("tr").find('.qreceived').val();
			var unitissue=$(this).closest("tr").find('.unitissue').val();
			
			var alert_message='';
			
			if(data==0){
				alert_message +="- Select a commodity first\n";
			}
			
			if(batchNo==""){
				alert_message +="- Indicate batch No of the commodity\n";
			}
			if(manuf==""){
				alert_message +="-Indicate Manufacturer of the commodity\n";
			}
			if(expiry_date==''){
				alert_message +="-Indicate the expiry date of the commodity\n";
			}
			if(stock_level==''){
				alert_message +="-Indicate the stock level of the commodity\n";
			}
			if(isNaN(alert_message)){
				alert(alert_message+' before adding a new row\n');
				return;
			}
						
             if(batchNo!='' && stock_level!=''){									
	          $.ajax({
	          type: "POST",
	          data: "&kemsa_code="+data_array[1]+"&description=N/A&unit_size="
	          +unit_size+" &batch_no="+batchNo+"&manu="+manuf+
	          "&expiry_date="+expiry_date+
	          "&stock_level="+stock_level+
	          "&unit_count="+unit_count+
	          "&unit_issue="+unitissue+
	          "&drug_id="+data_array[0],
	          url: url,
	          beforeSend: function() {
	           // console.log("data to send :"+data);
	          },
	          success: function(msg) {
	            console.log(msg);
	            
	             }
	         });
	       }
			/*
			 * Post temp data end
			 */
			
			var cloned_object = $('#order_table tr:last').clone(true);
			var drug_row = cloned_object.attr("drug_row");
			var next_drug_row = parseInt(drug_row) + 1;
			cloned_object.attr("drug_row", next_drug_row);

			//Get New Object id's
			var category_id = "desc_" + next_drug_row;
			var kemsa_code_id = "kemsa_code_" + next_drug_row;
			var unit_size_id = "unit_size_" + next_drug_row;
			var Pack_Size_id = "Pack_Size_" + next_drug_row;
			var batchNo_id = "batchNo_" + next_drug_row;
			var manuf_id = "manuf_" + next_drug_row;
			var my_date_id = "my_date_" + next_drug_row;
			var a_stock_id = "a_stock_" + next_drug_row;
			var qreceived_id = "qreceived_" + next_drug_row;
           
			//Find Old Objects and reset values

			var desc = cloned_object.find(".desc");
			var kemsa_code = cloned_object.find(".kemsa_code");
			var unit_size = cloned_object.find(".unit_size");
			var Unit_Issue_Size = cloned_object.find(".quantity");
			var Pack_Issue_Size = cloned_object.find(".quantity_available");
			var batchNo = cloned_object.find(".batchN");
			var manuf = cloned_object.find(".manuf");
			var my_date = cloned_object.find(".my_date");
			var a_stock = cloned_object.find(".a_stock");
			var qreceived = cloned_object.find(".qreceived");
		

			
			desc.attr("value", "0");

			kemsa_code.attr("id", unit_size_id);
			kemsa_code.attr("value", "");

			unit_size.attr("id", kemsa_code_id);
			unit_size.attr("value", "");

			batchNo.attr("id", batchNo_id);
			batchNo.attr("value", "");

			manuf.attr("id", manuf_id);
			manuf.attr("value", "");

			my_date.attr("id", my_date_id);
			my_date.attr("value", "");

			a_stock.attr("id", a_stock_id);
			a_stock.attr("value", "");

			qreceived.attr("id", qreceived_id);
			qreceived.attr("value", "");

			var my_date_selector = "#" + my_date_id;

			cloned_object.find(".remove").show();
			cloned_object.insertAfter('#order_table tr:last');
	
			refreshDatePickers();

		});
	    });
	
	$('.a_stock').live('keyup',function(){
  
    var num=$(this).val();
    
    if(!isNaN(num)){
    if(num.indexOf('.') > -1) {	
    alert("Decimals are not allowed.");
    $(this).val(""); $(this).focus();
    return;
     }           
     }                       
    else {
    	
    alert('Enter only numbers');
    $(this).val("");$(this).focus();
    return;
      }

    var unitissue=$(this).closest("tr").find('.unitissue').val();

  	if (unitissue == 'Pack_Size'){
  		//unit_size
  	var actual_unit_size=get_unit_quantity($(this).closest("tr").find('.unit_size').val());	
  	var total_a_stock=actual_unit_size*num;
 
    $(this).closest("tr").find('.qreceived').val(total_a_stock);
       }
   else{
	//do this other
	var actual_unit_size=1;

    var total_a_stock=actual_unit_size*num;
 
    $(this).closest("tr").find('.qreceived').val(total_a_stock);
    }	
    ///////////////////////////////////////update the record 
           	var url = "<?php echo base_url().'stock_management/autosave_update'?>";
			
			var data =$('option:selected', $(this).closest("tr").find('.desc')).attr('title'); 
            
	       	var data_array=data.split("^");
			var unit_size=$(this).closest("tr").find('.unit_size').val();
			var batchNo=$(this).closest("tr").find('.batchN').val();
			var manuf=$(this).closest("tr").find('.manuf').val();
			var expiry_date=$(this).closest("tr").find('.my_date').val();
			var stock_level=$(this).closest("tr").find('.a_stock').val();
			var unit_count=$(this).closest("tr").find('.qreceived').val();
			var unitissue=$(this).closest("tr").find('.unitissue').val();
						
             if($.isNumeric(data_array[0])){
									
	          $.ajax({
	          type: "POST",
	          data: "&kemsa_code="+data_array[1]+"&description=N/A&unit_size="
	          +unit_size+" &batch_no="+batchNo+"&manu="+manuf+
	          "&expiry_date="+expiry_date+
	          "&stock_level="+stock_level+
	          "&unit_count="+unit_count+
	          "&unit_issue="+unitissue+
	          "&drug_id="+data_array[0],
	          url: url,
	          beforeSend: function() {
	           // console.log("data to send :"+data);
	          },
	          success: function(msg) {
	            console.log(msg);
	            
	             }
	         });
	       }

    });
	
    $('.remove').live('click',function(){
	var data =$('option:selected', $(this).closest("tr").find('.desc')).attr('title');            
	

	 if(data!=0){
	var data_array=data.split("^");	
	var batchNo=$(this).closest("tr").find('.batchN').val();
	
	var facilitycode = "<?php echo  $this -> session -> userdata('news')?>";
	var url = "<?php echo base_url().'stock_management/delete_temp_autosave'?>";

        $.ajax({
          type: "POST",
          data: "drugid="+data_array[0]+"&facilitycode="+facilitycode+"&batchNo="+batchNo,
          url: url,
          success: function() {
 
          }
        });
       }
 
    $(this).parent().parent().remove();
    
    });
	

json_obj = {
				"url" : "<?php echo base_url().'Images/calendar.gif';?>",
				};
	var baseUrl=json_obj.url;
	

			
//	-- Datepicker		
		
	$(".my_date").datepicker({
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
					
					dateFormat: 'd M yy', 
					changeMonth: true,
			        changeYear: true,
			        buttonImage: baseUrl,
			       
				});
			
/************save move*******************/
				var $myDialog = $('<div></div>')
    .html('Please confirm the values before saving')
    .dialog({
        autoOpen: false,
        title: 'Confirmation',
        buttons: { "Cancel": function() {
                      $(this).dialog("close");
                      return false;
                },
                "OK": function() { 
                	var checker=0;
                	$("input[name^=expiry_date]").each(function() {
                		checker=checker+1;
                		
                	});
                	//alert(checker);
                	if(checker=0){
                		alert("Cannot submit an empty form");
                		$(this).dialog("close"); 
                	}
                	else{
                	$(this).dialog("close"); 
                      $('#myform').submit();
                      return true;	
                	}
                	
                      
                 }
        }
});
		$('#save1')
		.button()
			.click(function() {
				
			return $myDialog.dialog('open');
		});	
			

    /*********************getting the last day of the month***********/
  function getLastDayOfYearAndMonth(year, month)
{
    return(new Date((new Date(year, month + 1, 1)) - 1)).getDate();
}
   

	function refreshDatePickers() {
		var counter = 0;
		$('.my_date').each(function() {
			var this_id = $(this).attr("id"); // current inputs id
        var new_id = counter +1; // a new id
        $(this).attr("id", new_id); // change to new id
        $(this).removeClass('hasDatepicker'); // remove hasDatepicker class
        $(this).datepicker({ 
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
        	dateFormat: 'd M yy', 
        	        buttonImage: baseUrl,
					changeMonth: true,
			        changeYear: true
				});; // re-init datepicker
				counter++;
		});
		
		
  }
</script>

