<script type="text/javascript" language="javascript" src="<?php echo base_url();  ?>Scripts/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();  ?>Scripts/unit_size.js"></script>
		<style type="text/css" title="currentStyle">
			
			@import "<?php echo base_url(); ?>DataTables-1.9.3 /media2/css/jquery.dataTables.css";
			.user{
	width:50px;
	background : none;
	border : none;
	text-align: center;
	}
				.user2{
	width:50px;
	background-color:#FCEFA1;
	
	text-align: center;
	}
		</style>	
<script>
 var drawingRights=<?php echo $order_details[0]['drawing_rights']; ?>
 
 var c_total=0;
 
	function checker(jay,chr){
		//get from which row we are getting the data from which the user is adding data
		var x= jay;
		var newTotal=0;		
	    var quantity=document.getElementsByName("quantity["+x+"]")[0].value;
	    //checking if the quantity is a number 	    
	var num = document.getElementsByName("quantity["+x+"]")[0].value.replace(/\,/g,'');
if(!isNaN(num)){
if(num.indexOf('.') > -1) {
alert("Decimals are not allowed.");
document.getElementsByName("quantity["+x+"]")[0].value = document.getElementsByName("quantity["+x+"]")[0].value.substring(0,document.getElementsByName("quantity["+x+"]")[0].value.length-1);
document.getElementsByName("quantity["+x+"]")[0].select();
return;
}
} else {
alert('Enter only numbers');
document.getElementsByName("quantity["+x+"]")[0].value= document.getElementsByName("quantity["+x+"]")[0].value.substring(0,document.getElementsByName("quantity["+x+"]")[0].value.length-1);
document.getElementsByName("quantity["+x+"]")[0].select();	
return;
}
if(num <0){
	alert('Negatives are not allowed');
document.getElementsByName("quantity["+x+"]")[0].value= document.getElementsByName("quantity["+x+"]")[0].value.substring(0,document.getElementsByName("quantity["+x+"]")[0].value.length-1);
document.getElementsByName("quantity["+x+"]")[0].select();	
return;	
}
		//delete any value in order total
		$('#t').empty(); 
		document.getElementsByName("cost["+x+"]")[0].value='';
		//get the data from the row the user is at
		var price= document.getElementsByName("price["+x+"]")[0].value;
       
        var draw=0;
        //alert(draw);
        var newTotal=0; 
        $('#drawing').empty();
        //find the total of that perticular item
        var total=price*quantity;
        //set the total in the textfield
        document.getElementsByName("cost["+x+"]")[0].value=total.toFixed(2);  
        
        var unit_cost=document.getElementsByName("unit_size["+x+"]")[0].value;
        var test=get_unit_quantity(unit_cost)
        document.getElementsByName("actual_quantity["+x+"]")[0].value=test*quantity;
        
       
        
 /**************************************************************************************************************/       
        //we need to calculate the total of the order, so we load all of the cost variables    
        //loop through them to get the values sum it to get the total
        $("input[name^=cost]").each(function() {
        	
        newTotal=parseFloat($(this).val())+parseFloat(newTotal);
     	draw=drawingRights-newTotal;
          
                    });
                    
 /**************************************************************************************************************/    
           c_total=newTotal;
  /***********************************************check to see if the user has used up all of their drawing rights *********************************/      

        $('#t').html(number_format(newTotal, 2, '.', ',')); 
        //calculate the users drawing rights balance based on the items they have ordered for.
        if(newTotal==0){
        	
     	 	$('#drawing').html(drawingRights);  
     	 	
     	 }else{
     	 	
     	 	if(draw<0){  	 		
     	 		$('#drawing').css("color","red");
     	 	}
     	 	else{
     	 		$('#drawing').css("color","#036");
     	 	}
     	 
     	 	$('#drawing').html(number_format(draw, 2, '.', ','));
     	 	}
 
	}
			
			 $(function() {
			 	
			 			$( "#dialog:ui-dialog" ).dialog( "destroy" );
		//confirmation modal window
		$( "#dialog-form-order" ).dialog({
		    autoOpen: false,
			height: 600,
			width: 800,
			modal: true,
			buttons: {
				"Confirm": function() {
           $('#myform').submit();
           $( this ).dialog( "close" );
           $('#order_processing').modal({ keyboard: false });
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				
			}
			});
			 	
			 	
			 	
			 	
			 				var $myDialog = $('<div></div>')
    .html('<h3 class="text-error">Please confirm if you want to reject and return this order back to the facility<h3>')
    .dialog({
        autoOpen: false,
        title: 'Confirmation',
        buttons: { "Cancel": function() {
                      $(this).dialog("close");
                      return false;
                },
                "OK": function() { 
                	
                			
		$('input:hidden[name=reject_order_status]').val('1');
		 $(this).dialog("close");
		$('#myform').submit();
		 $('#order_processing').modal();
		return false;
     
                 }
        }
});
			 	
			 	
			//button to post the order
			$( "#approve" )
			.button()
			.click(function() {
				
		   				$('#user-order tbody').empty();
				$('#test-hapa tbody').empty();
				
				var cost = document.myform.elements["cost[]"];
                var t=$('#t').html();
                var t_new=  t.replace(',', 'new');
                var bal=drawingRights-c_total;
                
        if(t==0){
        	$( "#demo" ).append('<div id="pop" title="System Message"><p>Please Enter Order Quantity</p></div>');
        	$("#pop").dialog({
			height: 140,
			modal: true
		});
        }
        else{
        	$('#test-hapa tbody').append(
     		'<tr>'+
			'<td>Drawing Rights</td>'+
			'<td>'+
			'<input style="border: none" class="user_" type="text" readonly="readonly"  value="'+number_format(drawingRights, 2, '.', ',')+' Ksh'+'" />'+
			'</td>'+
		'</tr>'+
		'<tr>'+
			'<td>Total Order Value</td>'+
			'<td>'+
			'<input style="border: none" class="user_" type="text" readonly="readonly" value="'+t+' Ksh'+'"/>'+
			'</td>'+
		'</tr>'+
		'<tr>'+
			'<td>Balance</td>'+
			'<td>'+
			'<input style="border: none" class="user_" type="text" readonly="readonly" id="drawing_rights_bal"  value="'+number_format(bal, 2, '.', ',')+' Ksh'+'"/>'+
			'</td>'+
		'</tr>'
     		
     	)
  /*******************************************************printing out the pop out form***********************************/   	
        $("input[name^=cost]").each(function(i) {
        $( "#user-order tbody" ).append( "<tr>" +
							"<td>" +$(document.getElementsByName("drugCode["+i+"]")).val()+ "</td>" +
							"<td>" +$(document.getElementsByName("drugName["+i+"]")).val()+ "</td>" +
							"<td>" +$(document.getElementsByName("quantity["+i+"]")).val()+ "</td>" +	
							"<td>" +number_format($(document.getElementsByName("price["+i+"]")).val(), 2, '.', ',')+ "</td>" +	
							"<td>" +number_format($(document.getElementsByName("cost["+i+"]")).val(), 2, '.', ',')+ "</td>" +													
						"</tr>" ); 
                    });
         	
         	  
         	  if(bal<0){  	 		
     	 		$('#drawing_rights_bal').css("color","red");
     	 	}
     	 	else{
     	 		$('#drawing_rights_bal').css("color","#036");
     	 	} 
     	 	
     	 	  $( "#dialog-form-order" ).dialog( "open" ); 		
				
			}
			});		
			
			
			
			$( "#reject" )
			.button()
			.click(function() {
		
           return $myDialog.dialog('open');
           
           
			});	
			

	});	
			

	   $(document).ready(function() {
 
        $("input[name^=quantity]").each(function(index, value) {
  	var chr=false;
  	suggest_order_value(index);
    checker(index,chr);
    });

    	$('#main1').dataTable( {
					"bJQueryUI": true,
                   "bPaginate": false
				} );
    
});
</script>

<div id="notification">Rationalized Quantities = (Monthly Consumption * 4) - Closing Stock</div>

<div id="dialog-form-order" title="Please Confirm your Order">
	<table class="table-update"  id='test-hapa'><tbody></tbody></table>
	<form>
	<table id="user-order" width="500px" class="table-update">
					<thead>
					<tr>
					    <th><b>KEMSA Code</b></th>
						<th><b>Description</b></th>
						<th style="width: 20px"><b>Order Quantity</b></th>
						<th style="width: 20px"><b>Unit Cost Ksh</b></th>	 
						<th style="width: 20px"><b>Total Ksh</b></th>	 	    
					</tr>
					</thead>
							<tbody>
							
						</tbody>
						</table>
	</form>
</div>
<caption><p style="letter-spacing: 1px;font-weight: bold;text-shadow: 0 1px rgba(0, 0, 0, 0.1);font-size: 14px; " >
	Facility Order No <?php echo $this->uri->segment(3);?>| Facility MFl code <?php echo $this->uri->segment(4);?>|  
	<span ><b > Total Order Value </b><b id="t" >  0</b></span> |<span> Drawing Rights Available Balance :<b id="drawing"> </b><br />
	</p></caption>
<?php $attributes = array( 'name' => 'myform', 'id'=>'myform');
	 echo form_open('order_approval/update_order',$attributes); ?>	
<?php echo form_hidden('f_order_id', $this->uri->segment(3));?>	 
<?php echo form_hidden('reject_order_status','0');?>	 
<table id="main1" width="100%">
	<thead>
	<tr>
		
		                <th><b>Category</b></th>
						<th><b>Description</b></th>
						<th><b>KEMSA&nbsp;Code</b></th>
						<th><b>Order&nbsp;Unit Size</b></th>
						<th><b>Order Unit Cost</b></th>
						<th ><b>Opening Balance</b></th>
						<th ><b>Total Receipts</b></th>
					    <th><b>Total issues</b></th>
					    <th><b>Adjustments</b></th>
					    <th><b>Losses</b></th>
					    <th><b>Closing Stock</b></th>
					    <th><b>No days out of stock</b></th>
					    <th><b>Historical Consumption</b></th>
					    <th><b>Rationalized Quantities</b></th>
					    <th><b>Order Quantity</b></th>
					    <th><b>Actual Units</b></th>
					    <th><b>Order cost(Ksh)</b></th>	
					   <th><b>Comment(if any)</b></th>
					   
	</tr>
	</thead>
	<tbody>
		
	<?php $count=0; $thr=true; 
	
	
	
		foreach($detail_list  as $rows){
			
			
			//setting the values to display
			 $ordered=$rows->quantityOrdered;
			 $code=$rows->kemsa_code;
			 $t_issues=$rows->t_issues;
			 $c_stock=$rows->c_stock;
			 $value=0;
			 if($value<0){
			 	$value=0;
			 }
			?>
			
	<tr>
		<?php echo form_hidden('order_id['.$count.']', $rows->id);?>
		<?php foreach($rows->Code as $drug)
		foreach($drug->Category as $cat){
				
			$cat_name=$cat->Category_Name;	
				
			}
			echo "<td>$cat_name</td>";
		
		$cost=$drug->Unit_Cost; $t_cost=$cost*$ordered;
		
   echo form_hidden('drugName['.$count.']'  ,$drug->Drug_Name).
   form_hidden('drugCode['.$count.']'  ,$drug->Kemsa_Code).
   form_hidden('closing_stock_['.$count.']'  ,$c_stock).
   form_hidden('price['.$count.']'  ,$drug->Unit_Cost).
   form_hidden('unit_size['.$count.']'  ,$drug->Unit_Size).
   '<td>'.$drug->Drug_Name.'</td>
         <td>'.$drug->Kemsa_Code.'</td>
		 <td>'.$drug->Unit_Size.'</td>
		 <td>'.$drug->Unit_Cost.'</td>';?>
		<td><input style="border: none" readonly="readonly" class="user" type="text"<?php echo 'name="open['.$count.']"'; ?>  value="<?php echo $rows->o_balance;?>" /></td>
		<td><input style="border: none" class="user" readonly="readonly" type="text"<?php echo 'name="receipts['.$count.']"'; ?>  value="<?php echo $rows->t_receipts;?>" /></td>
		<td><input style="border: none" class="user" readonly="readonly" type="text"<?php echo 'name="issues['.$count.']"'; ?>  value="<?php echo $t_issues;?>" /></td>
		<td><input style="border: none" class="user" readonly="readonly" type="text"<?php echo 'name="adjustments['.$count.']"'; ?> value="<?php echo $rows->adjust;?>" /></td>
		<td><input style="border: none" class="user" readonly="readonly" type="text"<?php echo 'name="losses['.$count.']"'; ?> value="<?php echo $rows->losses;?>" /></td>
		<td><input style="border: none" class="user" readonly="readonly" type="text"<?php echo 'name="closing['.$count.']"'; ?> value="<?php echo $c_stock;?>" /></td>
		<td><input style="border: none" class="user" readonly="readonly" type="text"<?php echo 'name="days['.$count.']"'; ?> value="<?php echo $rows->days;?>" /></td>
		<td ><input style="border: none" class="user" readonly="readonly" type="text" <?php echo 'name="historical['.$count.']"'; ?> value="<?php echo $rows->historical_consumption;?>"/></td>
		<td><input  style="border: none" class="user" readonly="readonly" class="user2" type="text" value="" <?php echo 'name="suggested['.$count.']"'; ?> /></td>	
		<td><input class="user2" type="text" value="<?php echo $ordered;?>" <?php echo 'name="quantity['.$count.']"';?> onkeyup="<?php echo 'checker('.$count.','.$thr.')';?>"/></td>
		<td><input class="user" readonly="readonly" style="border: none" type="text" <?php echo 'name="actual_quantity['.$count.']"';?> value="0"/></td>
		<td><input class="user2" type="text" value="<?php echo  ceil($t_cost);?>" <?php echo 'name="cost['.$count.']"';?>/></td>
		<td><input class="user2" type="text" value="<?php echo $rows->comment;?>"/></td>
			
	</tr> 
	<?php
	$count=$count+1;;	}
	?>
	</tbody>
</table>

<br>
<br />

<?php echo form_close(); ?>
<button class="btn btn-primary"  id="approve">Approve Order</button> <button class="btn btn-danger" id="reject">Reject Order</button>
<!--------order processing data---------->
<div class="modal fade" id="order_processing" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       
        <h2 class="modal-title">Processing Order....</h2>
      </div>
      <div class="modal-body">
    
        <h2 class="label label-info">Please wait as the order is being processed </h2><img src="<?php echo base_url().'Images/processing.gif' ?>" />
      </div>
      <div class="modal-footer">       
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

