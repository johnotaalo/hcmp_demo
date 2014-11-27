<style>
		div#users-contain { width: 350px; margin: 20px 0; }
		div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
		div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
		.ui-dialog .ui-state-error { padding: .3em; }
		.validateTips { border: 1px solid transparent; padding: 0.3em; }
	</style>
<script>
 
 	
 
	$(function() {
		

		/**********/
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		$( "#dialog-form" ).dialog({
		    autoOpen: false,
			height: 700,
			width: 700,
			modal: true,
			buttons: {
				"The Order is OK": function() {
           $('#myform').submit();
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				
			}
			});
			$( "#Make-Order" )
			.button()
			.click(function() {
				$('#user-order tbody').empty();
				var cost = document.myform.elements["cost[]"];
                var t=$('#t').html();
        if(t==0){
        	$( "#demo" ).append(' <div id="pop" title="System Message"><p>you have placed an empty order</p></div>');
        	$("#pop").dialog();
        }
        else{
        	 for(i=0;i<cost.length;i++)
         {
	if(cost[i].value>0)
     {  
     	$( "#user-order tbody" ).append( "<tr>" +
							"<td>" + document.getElementsByName("kemsaCode["+i+"]")[0].value+ "</td>" +
							"<td>" +document.getElementsByName("drugName["+i+"]")[0].value+ "</td>" +
							"<td>" +document.getElementsByName("quantity["+i+"]")[0].value+ "</td>" +													
						"</tr>" ); 
     	 }
     	
            }
				$( "#dialog-form" ).dialog( "open" );
			
        }
       
		});
		
		$( "#new-form" )
			.button()
			.click(function() {window.location.href = "<?php echo base_url();?>/order_management/new_order2" ;
});
      
        $( "#dialog" ).dialog();
		/****accordion settings*****/
		$("#accordion").accordion({
			autoHeight : false,
			active: false,
			collapsible: true
		});
		/*********/
	});	
    var drawingRights=document.getElementById('drawing').innerHTML;
    
	function checker(jay){
		


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
return;
}
		//delete any value in order total
		$('#t').empty(); 
		document.getElementsByName("cost["+x+"]")[0].value='';
		//get the data from the row the user is at
		var price= document.getElementsByName("price["+x+"]")[0].value;
       
        var draw=0;
        //alert(draw);
       // var rem; 
        $('#drawing').empty();
        //find the total of that perticular item
        var total=price*quantity;
        //set the total in the textfield
        document.getElementsByName("cost["+x+"]")[0].value=total.toFixed(2);  
        //we need to calculate the total of the order, so we load all of the cost variables
        var mutli_education = document.myform.elements["cost[]"];
        //loop through them to get the values sum it to get the total
        
        for(i=0;i<mutli_education.length;i++)
         {
	if(mutli_education[i].value>0)
     {  newTotal=parseFloat(mutli_education[i].value)+parseFloat(newTotal);
     	draw=drawingRights-newTotal;
     	 }
     	
            }
            
      
           //finally print the total 
        $('#t').html((newTotal.toFixed(2))); 
        //calculate the users drawing rights balance based on the items they have ordered for.
        if(newTotal==0){
        	
     	 	$('#drawing').html(drawingRights);  
     	 	
     	 }else{
     	 	$('#drawing').html(draw.toFixed(2));
     	 	}  
         
	}

</script>
<style>
	#user{
		width:70px;
	}
</style>
<!-- pop out modal box -->
<div id="dialog-form" title="Please Confirm your Order">
	<form>
	<table id="user-order" width="500px" class="data-table">
					<thead>
					<tr>
					    <th><b>Code</b></th>
						<th><b>Description</b></th>
						<th style="width: 20px"><b>Order Quantity</b></th>	    
					</tr>
					</thead>
							<tbody>
							
						</tbody>
						</table>
	</form>
</div>
<!--end of pop out modal box -->

<!-- pop out box -->
<div class="demo" id="demo" style="margin: 10px;">
	
	<?php if(isset($popout)){ ?><div id="dialog" title="System Message"><p><?php echo $popout;?></p></div><?php }?>
	<?php $attributes = array( 'name' => 'myform', 'id'=>'myform');
	 echo form_open('Order_Management/makeOrder',$attributes); ?>
	<div id="accordion" >
		<?php $count=0;
		foreach($drug_categories as $category){?>
			<h3><a href="#"><?php echo $category->Category_Name?></a></h3>
			<div>
			<p>
				<table width="800">
					<thead>
					<tr>
						<th style="text-align: left; "><b>Code</b></th>
						<th style="text-align: left;"><b>Description</b></th>
						<th style="text-align: left;"><b>Order Unit Size</b></th>
						<th style="text-align: left;"><b>Order Unit Cost</b></th>
											    
					</tr>
					</thead>
					<?php
						foreach($category->Category_Drugs as $drug){?>
							<tbody>
						<tr>
							
							<td><p style="font-size: 15px;"><?php echo $drug->Kemsa_Code;?></p></td>
							<td><p><?php echo $drug->Drug_Name;?></p></td>
							<td><p> <?php echo $drug->Unit_Size;?> </p></td>
							<td><p><?php echo $drug->Unit_Cost;?> </p></td>
							
			       
						</tr>
						</tbody>
						<?php 
					$count++;	} 
					?>
				</table>
			</p>
		</div>
		<?php } echo form_close();
		?>
	</div>
</div><!-- End demo -->
