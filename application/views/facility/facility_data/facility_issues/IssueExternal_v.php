 <div  class='label label-info' style="font-size: 1.8em">To redistribute commodities i) select commodity to redistribute
	ii) enter quanitity you wish to redistribute and select the batch no and facility  
	iii) to add more redistributes press add row</div>
 <?php $att=array("name"=>'myform','id'=>'myform'); echo form_open('Issues_main/InsertExt',$att); ?>
<table   class="table table-hover table-bordered table-update" id="example" width="100%" >
					<thead>
					<tr>
						<th style="text-align:center; font-size: 14px"><b>Sub County</b></th>
						<th style="text-align:center; font-size: 14px"><b>Facility</b></th>
						<th style="text-align:center; font-size: 14px"><b>Description</b></th>
						<th style="text-align:center; font-size: 14px"><b>Source</b></th>
						<th style="text-align:center; font-size: 14px"><b>Unit Size</b></th>
						<th style="text-align:center; font-size: 14px"><b>Batch No</b></th>
						<th style="text-align:center; font-size: 14px"><b>Expiry Date</b></th>
						<th style="text-align:center; font-size: 14px"><b>Available Stock</b></th>
						<th style="text-align:center; font-size: 14px"><b>Issued Quantity</b></th>
					    <th style="text-align:center; font-size: 14px"><b>Issue Date </b></th>
						<th style="text-align:center; font-size: 14px"><b>Action</b></th> 				    
					</tr>
					</thead>
					<tbody>
						<tr row_id='0'>
							<td>
								<select name="district[0]" class="district">
								<option value="0">--select subcounty---</option>
								<?php 
		foreach ($district as $district) {
			$id=$district->id;
			$name=$district->district;		
			echo '<option value="'.$id.'"> '.$name.'</option>';
		}?>	
								</select>
							</td>
						<td>
						<select  name="mfl[0]" class="facility">
                       <option value="0">--select facility---</option>
					   </select>
						</td>
						<td>
	<select class="desc" name="desc[0]">
    <option title="0" value="0" selected="selected">-Select Commodity -</option>
<?php 
		foreach ($drugs as $drugs) :			
			
			$drugname=$drugs['drug_name'];
			$code=$drugs['id'];
			$unit=$drugs['unit_size'];
			$kemsa_code=$drugs['source_name'];
			
		echo "<option title='$code^$unit^$kemsa_code' value='$code'> $drugname</option>";
		
		endforeach;
		?> 
	</select>
						</td>
						<td>
				        <input type="hidden" id="0" name="commodity_id[0]" value="" class="commodity_id"/>
						<input type="hidden" name="commodity_balance[0]" value="0" class="commodity_balance"/>
						<input type="hidden" name="drug_id[0]" value="" class="drug_id"/>	
						<input type="text" class="input-small kemsa_code" readonly="readonly" name="kemsa_code[]"/></td>
			            <td><input  type="text" class="input-small unit_size" readonly="readonly"  /></td>
						<td><select class=" input-small batchNo" name="batchNo[0]"></select></td>
						<td><input class='input-small exp_date'  name='expiry_date[0]' readonly="readonly" type='text' /></td>
						<td><input class='input-small AvStck' type="text" name="AvStck[0]" readonly="readonly" /></td>
						<td><input class='input-small Qtyissued' type="text" value="0"  name="Qtyissued[0]" /></td>
						<td><input class='input-small my_date' type="text" name="date_issue[0]"  value="" /></td>
						<td><a class="add label label-success">Add Row</a><a class="remove label label-important" style="display:none;">Remove Row</span></td>
			</tr>
		           </tbody></table>
 </form>
 <button class="btn btn-primary" id="finishIssue" >Finish</button>
<script>
/***************clone the row here*********************/
		$(".add").click(function() {

             //find the last row
            var last_row = $('#example tr:last');
            var cloned_object = last_row.clone(true);
           
            
            var table_row = cloned_object.attr("row_id");
			
			var service_point=$(this).closest("tr").find(".district").val();
			var facility=$(this).closest("tr").find(".facility").val();
			var commodity_id=$(this).closest("tr").find(".desc").val();
			var issue_date=$(this).closest("tr").find(".my_date").val();
			var issue_quantity=$(this).closest("tr").find(".Qtyissued").val();
			var alert_message='';
			
			if(service_point==0){
				alert_message +="-Select a subcounty\n";
			}
			if(facility==0){
				alert_message +="-Select a facility\n";
			}
			if(commodity_id==0){
				alert_message +="-Select a commodity to issue\n";
			}
			if(issue_quantity==''){
				alert_message +="-Indicate how much you want to\n";
			}
			if(issue_date==''){
				alert_message +="-Indicate the date of the issue\n";
			}
			if(isNaN(alert_message)){
				alert(alert_message+' before adding a new row\n');
				return;
			}
			
			//set the quantities to readonly
			$(this).closest("tr").find(".Qtyissued").attr('readonly','readonly');
			$(this).closest("tr").find(".batchNo").prop("disabled", true);
			//reset the values of current element 
			var next_table_row = parseInt(table_row) + 1;
			cloned_object.attr("row_id", next_table_row);
			cloned_object.find(".service_point").attr('name','Servicepoint['+next_table_row+']'); 
			cloned_object.find(".commodity_id").attr('name','commodity_id['+next_table_row+']'); 
			cloned_object.find(".commodity_id").attr('id',next_table_row); 
			cloned_object.find(".Qtyissued").attr('name','Qtyissued['+next_table_row+']'); 	
			cloned_object.find(".my_date").attr('name','date_issue['+next_table_row+']'); 
			cloned_object.find(".AvStck").attr('name','AvStck['+next_table_row+']'); 
			cloned_object.find(".drug_id").attr('name','drug_id['+next_table_row+']'); 
			cloned_object.find(".batchNo").attr('name','batchNo['+next_table_row+']');
			cloned_object.find(".facility").attr('name','mfl['+next_table_row+']');
			cloned_object.find(".exp_date").attr('name','expiry_date['+next_table_row+']');
			cloned_object.find(".commodity_balance").attr('name','commodity_balance['+next_table_row+']');
			cloned_object.find(".desc").attr('name','desc['+next_table_row+']');
			cloned_object.find(".commodity_balance").attr('name','commodity_balance['+next_table_row+']');					
            cloned_object.find("input").attr('value',"");     
            cloned_object.find(".Qtyissued").attr('value',"0"); 
            cloned_object.find(".Qtyissued").removeAttr('readonly');  
            cloned_object.find(".batchNo").prop("disabled", false);           
            cloned_object.find(".batchNo").html("");    
             cloned_object.find(".facility").html("");         
			cloned_object.find(".remove").show();
			cloned_object.insertAfter('#example tr:last');
	
			refreshDatePickers();

		});
		
	/// remove the row
		$('.remove').live('click',function(){
			var row_id=$(this).closest("tr").index();
		   
			var bal=parseInt($(this).closest("tr").find(".Qtyissued").val());
			
            var commodity_stock_id=parseInt($(this).closest("tr").find(".drug_id").val());
           
            var total=0;
			
			$("input[name^=commodity_id]").each(function(index, value) {
				
			var new_id=$(this).closest("tr").index();
			var total_current_issues=$(this).closest("tr").find(".Qtyissued").val();
			var current_drug_id=$(this).closest("tr").find(".drug_id").val();
   
                  if(new_id>row_id && parseInt($(this).val())==commodity_stock_id){
                  	 
                   var value=parseInt($("input[name='AvStck["+new_id+"]']").val())+bal;  ///AvStck
                   $("input[name='AvStck["+new_id+"]']").val(value);
                  }
                  
                  if(new_id>row_id && current_drug_id==commodity_stock_id){
                
                   var value=parseInt($(this).closest("tr").find(".commodity_balance").val())+bal;  ///AvStck
                   $(this).closest("tr").find(".commodity_balance").val(value);
                  }
                 
		        });
			
	       $(this).parent().parent().remove();
    
      });
      
      ///when changing the commodity combobox
      		$(".desc").live('change',function(){
      		var row_id=$(this).closest("tr").index();	
      		if(parseInt(row_id)==0){
      		var prv_id=parseInt(row_id);	
      		}
      		else{
      		var prv_id=parseInt(row_id)-1;	
      		}
      		
      		var locator=$('option:selected', this);
			var data =$('option:selected', this).attr('title'); 
	       	var data_array=data.split("^");
	       	

	        locator.closest("tr").find(".unit_size").val(data_array[1]);
	     	locator.closest("tr").find(".kemsa_code").val(data_array[2]);
	     	locator.closest("tr").find(".drug_id").val(data_array[0]);
	     	locator.closest("tr").find(".AvStck").val("");
	     	locator.closest("tr").find(".exp_date").val("");
	     	locator.closest("tr").find(".Qtyissued").val("0");
	     	locator.closest("tr").find(".my_date").val("");	     	

			json_obj={"url":"<?php echo site_url("order_management/getBatch");?>",}
			
			var baseUrl=json_obj.url;
			var id=data_array[0];
            var dropdown="<option title=''>--select Batch--</option>";
            var new_date='';
            var bal='';
            var commodity_stock_row_id='';
            var total=0;
            var drug_id_current=0;
            var total_stock_bal=0;
            var total_issues=0;
			$.ajax({
			  type: "POST",
			  url: baseUrl,
			  data: "desc="+id,
			  success: function(msg){

			  		var values=msg.split("_");
			  		
			  		var txtbox;
					 for (var i=0; i < values.length-1; i++) {
			  			var id_value=values[i].split("*")
			  			if(i==0){
			  				dropdown+="<option selected='selected' title="+id_value[2]+"^"+id_value[3]+"^"+id_value[5]+"^"+id_value[6]+">";
			  				 new_date=$.datepicker.formatDate('d M yy', new Date(id_value[2]));
			  				 bal=id_value[3];
			  				 commodity_stock_row_id=id_value[5];
			  				 total_stock_bal=id_value[6];
			  				 drug_id_current=id_value[0];
			  			}else{
			  				dropdown+="<option title="+id_value[2]+"^"+id_value[3]+"^"+id_value[5]+"^"+id_value[6]+">";
			  				 total_stock_bal=id_value[6];
			  			}
			  			
						dropdown+=id_value[1];						
						dropdown+="</option>";					
					};	
					
			  },
			  error: function(XMLHttpRequest, textStatus, errorThrown) {
			       if(textStatus == 'timeout') {}
			   }
			}).done(function( msg ) {
			 /* get all the items which have been issued and have 
			  * the same id and sum them up reduce the total available balance*/	     
				$("input[name^=commodity_id]").each(function(index, value) {
                  
                  if($(this).val()==commodity_stock_row_id){
                  var element_id=$(this).attr('id');
                   total=parseInt($("input[name='Qtyissued["+element_id+"]']").val())+total;
                  }
                 
		        });
		        
		        /* Check for all commodities that have the same id as the current item selected
		         * then sum up all the issues above the given item
		         * use this value to reduce the value of the total value of the commodity*/	        
		        $("input[name^=drug_id]").each(function(index, value) {
		        	
                 var row_id_=$(this).closest("tr").index();
                 
                  var total_current_issues=$(this).closest("tr").find(".Qtyissued").val();
                 
                  if($(this).val()==drug_id_current && row_id_<row_id){
                  	
                   total_issues=parseInt(total_current_issues)+total_issues;
                   //alert(total_issues);
                  }
                 
		        });
		        
		        var remaining_items=bal-total;		        
				locator.closest("tr").find(".batchNo").html(dropdown);
				locator.closest("tr").find(".exp_date").val(""+new_date+"" );
				locator.closest("tr").find(".AvStck").val(remaining_items);	
				locator.closest("tr").find(".commodity_id").val(commodity_stock_row_id);
				locator.closest("tr").find(".commodity_balance").val(total_stock_bal-total_issues);		
								
			});
		});
		
		/////batch no change event
		$('.batchNo').live('change',function(){
			var row_id=$(this).closest("tr").index();
		    var locator=$('option:selected', this);
			var data =$('option:selected', this).attr('title'); 
	       	var data_array=data.split("^");	
	       	var new_date='';
	       	var val='';
	       	var total=0;
	       	var total_issues=0;
	       	var commodity_stock_row_id;
	       	var remaining_items=0;
	       	var bal=parseInt($("input[name='Qtyissued["+row_id+"]']").val());
	      	var total_stock_bal=0
            var commodity_stock_id_old=parseInt($("input[name='commodity_id["+row_id+"]']").val());
            var drug_id_current='';
          
              
	       	$("input[name='commodity_id["+row_id+"]']").val(data_array[2]);
	       	$("input[name='commodity_balance["+row_id+"]']").val(data_array[3]);
	       	total_stock_bal=data_array[3];
	       	if(data_array[0]!=''){
	       		
	       	new_date=$.datepicker.formatDate('d M yy', new Date(data_array[0]));	
	       	val=data_array[1];
	       	commodity_stock_row_id=data_array[2];
            drug_id_current=parseInt($("input[name='drug_id["+row_id+"]']").val());
	        remaining_items=val-total;
	        
	        locator.closest("tr").find(".exp_date").val(""+new_date+"");
	        
			locator.closest("tr").find(".AvStck").val(remaining_items);
			
			locator.closest("tr").find(".Qtyissued").val("0");	

	       	}
	       	else{
	       		
	       	locator.closest("tr").find(".exp_date").val("");
			locator.closest("tr").find(".AvStck").val("");
			locator.closest("tr").find(".Qtyissued").val("0");
				
	       	}
	       	
	       	$("input[name^=commodity_id]").each(function(index, value) {
	       		  var element_id=$(this).closest("tr").attr('id');
                  if(element_id>row_id && $(this).val()==commodity_stock_id_old){ 
                           	
                   var value=parseInt($("input[name='AvStck["+element_id+"]']").val())+bal;  ///AvStck
                   $("input[name='AvStck["+element_id+"]']").val(value);
                  }
                 
		       });
		        
		        /* Check for all commodities that have the same id as the current item selected
		         * then sum up all the issues above the given item
		         * use this value to reduce the value of the total value of the commodity*/	        
		        $("input[name^=drug_id]").each(function(index, value) {
		        	
                 var row_id_=$(this).closest("tr").index();                 
                 var total_current_issues=$(this).closest("tr").find(".Qtyissued").val();
                
                  if($(this).val()==drug_id_current && row_id_<row_id){
                   total_issues=parseInt(total_current_issues)+total_issues;
                  
                  }
                  
		        });
		        
		       locator.closest("tr").find(".commodity_balance").val(total_stock_bal-total_issues);	
      });
        //entering the values to issue check if you have enough balance
        $(".Qtyissued").live('keyup',function (){
            var row_id=$(this).closest("tr").index();
        	var bal=parseInt($(this).closest("tr").find(".AvStck").val());
        	var drug_id_current=parseInt($(this).closest("tr").find(".desc").val());
        	var issues=$(this).val();
        	var remainder=bal-issues;

        		if (remainder<0) {
						$(this).val("0");
						$(this).focus();
						alert("Can not issue beyond available stock");
						return;
					}
					else{
						
					}
					if (issues <0) {
					    $(this).val("0");
					    $(this).focus();
					    alert("Issued value must be above 0");
					    return;
					}
					if(issues.indexOf('.') > -1) {
						$(this).val("0");
						$(this).focus();
						alert("Decimals are not allowed.");
						return;
							}
					if (isNaN(issues)){
						$(this).val("0");
						$(this).focus();
						alert('Enter only numbers');
						return;
				}

        });
             ///// county district facility filter 
       $('.district').live("change", function() {
			/*
			 * when clicked, this object should populate district names to district dropdown list.
			 * Initially it sets default values to the 2 drop down lists(districts and facilities) 
			 * then ajax is used is to retrieve the district names using the 'dropdown()' method that has
			 * 3 arguments(the ajax url, value POSTed and the id of the object to populated)
			 */
	        var locator =$('option:selected', this);

			json_obj={"url":"<?php echo site_url("order_management/getFacilities");?>",}
			var baseUrl=json_obj.url;
			var id=$(this).val();
		    var dropdown;
			$.ajax({
			  type: "POST",
			  url: baseUrl,
			  data: "district="+id,
			  success: function(msg){

			  		var values=msg.split("_");
			  		var txtbox;

			  		for (var i=0; i < values.length-1; i++) {
			  			var id_value=values[i].split("*");	
			  					  			
			  			dropdown+="<option value="+id_value[0]+">";
						dropdown+=id_value[1];						
						dropdown+="</option>";		  			

		  		}
	
			  },
			  error: function(XMLHttpRequest, textStatus, errorThrown) {
			       if(textStatus == 'timeout') {}
			   }
			}).done(function( msg ) {
			
				locator.closest("tr").find(".facility").html(dropdown);

			});	
			
		});	


        	//	-- Datepicker		
		json_obj = {
				"url" : "<?php echo base_url().'Images/calendar.gif';?>",
				};
	    var baseUrl=json_obj.url;
	
     $( ".my_date" ).datepicker({
			showOn: "both",
			dateFormat: 'd M yy', 
			buttonImage: baseUrl,
			buttonImageOnly: true,
			changeMonth: true,
			changeYear: true,
			maxDate: new Date()
		});

	function refreshDatePickers() {		
		var counter = 0;
		$('.my_date').each(function() {
		var this_id = $(this).attr("id"); // current inputs id
        var new_id = counter +1; // a new id
        $(this).attr("id", new_id); // change to new id
        $(this).removeClass('hasDatepicker'); // remove hasDatepicker class
        $(this).datepicker({ 
                    maxDate: new Date(),
        	        dateFormat: 'd M yy', 
        	        buttonImage: baseUrl,
					changeMonth: true,
			        changeYear: true
				});; // re-init datepicker
				counter++;
		});
		
		
  }
      /////// save button
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
                	$("input[name^=commodity_id]").each(function() {
                		checker=checker+1;
                	$(this).closest("tr").find(".batchNo").removeAttr('disabled'); 		
                	});

                	if(checker<1){
                		alert("Cannot submit an empty form");
                		$(this).dialog("close"); 
                	}
                	else{
                		
                	$(this).dialog("close"); 
                     $( "#myform" ).submit();
                      return true;	
                	}
                	
                      
                 }
        }
});
      $( "#finishIssue" )
			.button()
			.click(function() {
				return $myDialog.dialog('open');			
			});
		
</script>