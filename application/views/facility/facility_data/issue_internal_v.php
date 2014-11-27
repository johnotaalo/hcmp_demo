<script src="http://localhost/HCMP/Scripts/jquery.js" type="text/javascript"></script> 
 <style>
.user{
		width:50px;
	}
	.date{
		width:60px;
	}	
	.user1{
	width:50px;
	background : none;
	border : none;
	text-align: center;
	}
	</style> 
<script type="text/javascript">
 
json_obj = {	"url" : "<?php echo base_url().'Images/calendar.gif';?>",
	};
	var baseUrl=json_obj.url;
        var jq = $.noConflict();
        
$(document).ready(function() { 
    
$(".remove").hide();
  // Handler for .ready() called.
$(".add").click(function() {
//	when add is clicked this function

    var today = new Date();
    var today_date = ("0" + today.getDate()).slice(-2);
    var today_year = today.getFullYear();
    var today_month = ("0" + (today.getMonth() + 1)).slice(-2);
    var today_full_date = today_date + "-" + today_month + "-" + today_year;
 
$table=$('#mytable'); 
var cloned_object=$table.find('tr:last').clone(true);
$(this).find("user1").attr("id","unit_size_1");
//var cloned_object = ('#mytable tr:last').clone(true);
var issue_row = cloned_object.attr("issue_row");
var next_issue_row = parseInt(issue_row) + 1;

cloned_object.attr("issue_row",next_issue_row);
var s11N_id = "s11N_"+ next_issue_row;
var desc_id = "desc_"+ next_issue_row;
var unit_size_id = "unit_size_"+ next_issue_row;
var batchNo_id = "batchNo_"+ next_issue_row;
var Exp_id = "Exp_"+ next_issue_row;
var avlb_Stock_id = "avlb_Stock_" + next_issue_row;
var qty_id = "qty_" + next_issue_row;
var datepicker_id = "datepicker_"+ next_issue_row;
//var datepicker_id = "datepicker";
var Servicepoint_id = "Servicepoint_" + next_issue_row;

var dropdownsize = cloned_object.find(".dropdownsize");
//dropdownsize.empty();
var user = cloned_object.find(".user");

var user1 = cloned_object.find(".user1");
var avlb_Stock = cloned_object.find(".avlb_Stock");
//user1.attr("value","");
user1.attr("id",unit_size_id);

//var usertr = cloned_object.find(".usertr");
//usertr.append('<input class="user1" id="unit_size_" name="unit_size">');

var batch = cloned_object.find(".batch");
var expiry = cloned_object.find(".expiry");
var servicepoint = cloned_object.find(".servicepoint");
var quantity = cloned_object.find(".quantity");
var date = cloned_object.find(".date");
var checked_balance = 0;      
avlb_Stock.attr("id",avlb_Stock_id);
avlb_Stock.attr("value","");
batch.attr("id", batchNo_id);
dropdownsize.attr("id",desc_id);
user.attr("id",s11N_id);
user1.attr("id",unit_size_id);

//$('input:text[name=datepicker]').val('');

batch.attr("id",batchNo_id);
batch.empty();
//batch.attr("value","-Batch-");
expiry.attr("id",Exp_id);
expiry.empty();
//expiry.attr("value","-Exp-");
quantity.attr("id",qty_id);
quantity.attr("value","")
servicepoint.attr("id",Servicepoint_id);
date.attr("value", "");
date.attr("id",datepicker_id);


   
           
cloned_object.insertAfter('#mytable tr:last');
$('.remove').show();
refreshDatePickers(next_issue_row);		 

return false;
});

$( ".date" ).datepicker({
//			showOn: "button",
			dateFormat: 'd M, yy', 
//			buttonImage: baseUrl,
//			buttonImageOnly: false
		});
                
$('.dropdownsize').change(function() {

	var this_row_id = $(this).closest("tr");
	var number = this_row_id.attr("issue_row");
	var therow = parseInt(number);
 						

                                var code= $(this).closest(".dropdownsize").val();
				var rowno = $(this).closest('tr:#issue_row');
//				alert (rowno);

				var text=$("#desc option:selected").text();
				var code_array=code.split("|");
				var text_array=text.split("|");
				$('input:[name=kemsac]').val(code_array[0]);
				$('input:[name=kemsac_1]').val(code_array[2]); 				
 				
				$('#unit_size_'+number).val(code_array[1]);
//				$('input:first.user1').closest('input').val(code_array[1]);
//				$('input:[name=unit_size]').val(code_array[1]);	
				//alert(code_array[1]);
				//alert(code);

			/*
			 * when clicked, this object should populate district names to district dropdown list.
			 * Initially it sets default values to the 2 drop down lists(districts and facilities) 
			 * then ajax is used is to retrieve the district names using the 'dropdown()' method that has
			 * 3 arguments(the ajax url, value POSTed and the id of the object to populated)
			 */
			$("#batchNo_"+number).html("<option>--Batch--</option>");
			$("#Exp_"+number).html("<option>--Exp--</option>");
			//$("#Exp").html("<option>--Exp Dates--</option>");
			json_obj={"url":"<?php echo site_url("order_management/getBatch");?>",}
			var baseUrl=json_obj.url;
			var id=code_array[0];
//                        alert (number);
			dropdown(baseUrl,"desc="+id,"#batchNo_"+number)



	});
        $('.batch').click(function(){
       
        var this_row_id = $(this).closest("tr");
	var number = this_row_id.attr("issue_row");
	var therow = parseInt(number);
 
         var code= $(".dropdownsize").val();
         var batch= $(".dropdownsize option:selected").text();
		 var text=$(".dropdownsize option:selected").text();
		 var code_array=code.split("|");

	     var batch_array=$('#batchNo_'+number).val();
		 var batch_split=batch_array.split("|");
		 var drug_total=0;

  var new_date=$.datepicker.formatDate('d M, yy', new Date(batch_split[0]));

			var drop='<option>'+new_date+'</option>'
			$('#Exp_'+number).html(drop);

	$("input[name^=kemsaCode]").each(function(index, value) {
  //alert(batch);
			if($(this).val()==(code_array[0]) && $(document.getElementsByName("batchNo["+index+"]")).val()==batch){ 

				drug_total +=parseInt($(document.getElementsByName("Qtyissued["+index+"]")).val());
			}
		});
			//alert(drug_total);
		   if(drug_total>0){
          batch_split[1]= batch_split[1]-drug_total;
		   }else{

		   }
           
            $('.avlb_Stock').val(batch_split[1]);
			$('#avlb_hide').val(batch_split[1]);

		});
                $('.quantity').keyup(function() {
                    
        var this_row_id = $(this).closest("tr");
	var number = this_row_id.attr("issue_row");
	var therow = parseInt(number);
					var hidden=$('input:[name=avlb_hide]').val();                                       
  					var stock=$('input:text[name=avlb_Stock]').val();
                                        
                                        var issues=$('#qty_'+number).val();
	//				var issues=$('input:text[name=qty]').val();
					var remainder=stock-issues;
                                        

					if (remainder<0) {
						$('input:text[name=qty]').val('');
                                                $('#aavlb_Stock_'+number).val(stock);
//						$('input:[name=avlb_Stock]').val(hidden);
						alert("Can not issue beyond available stock");
					}else{
						$("#avlb_Stock_"+number).val(remainder);
//						$('input:text[name=avlb_Stock]').val(remainder);
					}
					if (issues == 0) {
					    $('input:text[name=qty]').val('');
                                            $('#qty_'+number).val('');
					    alert("Issued value must be above 0");
					}
					if(issues.indexOf('.') > -1) {
						alert("Decimals are not allowed.");
							}
					if (isNaN(issues)){
						$('input:text[name=qty]').val('');
						alert('Enter only numbers');
							}
					});
                $(".remove").click(function() {
                $(this).closest('tr').remove();
            });
		function dropdown(baseUrl,post,identifier){
			/*
			 * ajax is used here to retrieve values from the server side and set them in dropdown list.
			 * the 'baseUrl' is the target ajax url, 'post' contains the a POST varible with data and
			 * 'identifier' is the id of the dropdown list to be populated by values from the server side
			 */
			$.ajax({
			  type: "POST",
			  url: baseUrl,
			  data: post,
			  success: function(msg){

			  	 	//alert(msg);

			  		var values=msg.split("_");
			  		var dropdown;
			  		var txtbox;
			  		for (var i=0; i < values.length-1; i++) {
			  			var id_value=values[i].split("*")
			  			if(i==0){
			  				dropdown+="<option selected='selected' value="+id_value[2]+"|"+id_value[3]+">";
			  			}else{
			  				dropdown+="<option value="+id_value[2]+"|"+id_value[3]+">";
			  			}

						dropdown+=id_value[1];						
						dropdown+="</option>";


					};					
					$(identifier).html(dropdown);

			  },
			  error: function(XMLHttpRequest, textStatus, errorThrown) {
			       if(textStatus == 'timeout') {}
			   }
			}).done(function( msg ) {
				//alert("am done");
			});
		}	

});

  function refreshDatePickers() {
				var counter = 0;
				$('.date').each(function() {
					var new_id = "datepicker_" + counter;
					$(this).attr("id", new_id);
					$(this).datepicker("destroy");
					$(this).not('.hasDatePicker').datepicker({
						defaultDate : new Date(),
						//showOn: "button",
                                                dateFormat: 'd M, yy',
                                                //buttonImage: baseUrl,
                                                buttonImageOnly: false
					});
					counter++;

				});
			}
                       
                        $(function(){
 
                      });





</script>
	 <form action="http://localhost/HCMP/Issues_main/Insert_test" method="post" accept-charset="utf-8" name="myform" id="myform">
<table class="data-table" id="mytable" width="100%" style="background: rgb(218, 218, 218);" >
	<thead>
	<tr>
	<th><b>S11 No</b></th>
	<th><b>Service Point</b></th>
	<th><b>Description</b></th>
	<th><b>Unit Size</b></th>
	<th><b>Batch No</b></th>
	<th><b>Expiry Date</b></th>
	<th><b>Available Stock</b></th>
	<th><b>Issued Quantity</b></th>	
	<th><b>Issue Date</b></th>	
	
	<td></td>

 	</tr>
	</thead>
	<tbody>
	<tr issue_row="1">
	<td>
	<input class="user" text="" name="s11N" id="s11N" value=""></td>
</td>
	<td>   
	<select id="Servicepoint" name="Servicepoint" class="servicepoint">
		<option>-Select-</option>
		<option value="CCC">CCC</option>
		<option value="Pharmacy">Pharmacy</option>
		<option value="Lab">Lab</option>
		<option value="Maternity">Maternity</option>
		<option value="Injection Room">Injection Room</option>
		<option value="Dressing room">Dressing room</option>
		<option value="TB Clinic">TB Clinic</option>
		<option value="MCH">MCH</option>
		<option value="Diabetic Clinic">Diabetic Clinic</option>
	</select>
	</td>
	<td>
   <select class="dropdownsize" id="desc" name="desc">
    <option >-Select Commodity -</option>
		<?php 
		foreach ($drugs as $drugs) {			
			foreach ($drugs->Code as $d) {
			$drugname=$d->Drug_Name;
			$code=$d->id;
			$unit=$d->Unit_Size;
			$kemsa_code=$d->Kemsa_Code;

			?>
			<option value="<?php echo $code."|".$unit."|".$kemsa_code;?>"><?php echo $drugname;?></option>
		<?php }
		?>
		<?php }?>
	</select></td>
	<td id="usertr">
    <input class="user1" id="unit_size_1" name="unit_size" type="text"/>
	</td>
	<td>
	<select class="batch" id="batchNo_1" name="batchNo">
		<option>-Batch-</option>
	</select></td>
						<td>
	<select class="expiry" id="Exp_1" name="Exp">
		<option>-Exp-</option>
	</select></td> 
	<td>
<input class="avlb_Stock" id="avlb_Stock_1" name="avlb_Stock" disabled="disabled">	</td>
	 
	<td ><input type="text" class="quantity" name="qty" id="qty_1" value=""></td>
	<td>
            <?php 

//					 	$today= ( date('d M, Y')); 
 				$today = "Wed Jul,2013";	
				?><input type="text" name="datepicker" class="date" readonly="readonly" value=" " id="datepicker_1"/></td>

     	<td ><a href="#" class="add">Add</a> <br /> <a href="#" class="remove" onclick="">Remove</a></td>

	</tr>
	</tbody>
	</table>
             
<input id="finishIssue" type="submit" value="Finish" class="ui-button ui-widget ui-state-default ui-corner-all" role="button" aria-disabled="false">
</form>