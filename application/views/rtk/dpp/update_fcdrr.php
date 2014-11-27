<script type="text/javascript" language="javascript" src="<?php echo base_url();  ?>Scripts/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();  ?>Scripts/unit_size.js"></script>
<style type="text/css" title="currentStyle">
			
			@import "<?php echo base_url(); ?>DataTables-1.9.3 /media2/css/jquery.dataTables.css";
		</style>
<style>
.user{
	width:70px;
	background : none;
	border : none;
	text-align: center;
	}
    .user1{
    width:100px;
    background : none;
    border : none;
    text-align: left;
    }
	.user2{
	width:70px;
	
	text-align: center;
	}

     .user3{
    width:100px;
    
    text-align: center;
    }
   	.col5{background:#D8D8D8;}
	</style>
	<script type="text/javascript">
    $(function() {    
jQuery(document).ready(function() {

                $("#begin_date").datepicker({
                defaultDate : "",
                changeMonth : true,
                changeYear : true,
                numberOfMonths : 1,
                // onClose : function(selectedDate) {
                //  $("#end_date").datepicker("option", "minDate", selectedDate);
                // }
            });
        $("#end_date").datepicker({
                defaultDate : "+1w",
                changeMonth : true,
                changeYear : true,
                numberOfMonths : 1,
                // onClose : function(selectedDate) {
                //  $("#begin_date").datepicker("option", "minDate", selectedDate);
                // }
            });
            });


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
                    // var checker=0;
                    // $("input[name^=expiry_date]").each(function() {
                    //  checker=checker+1;
                        
                    // });
                    // //alert(checker);
                    // if(checker<2){
                    //  alert("Cannot submit an empty form");
                    //  $(this).dialog("close"); 
                    // }
                    // else{
                    $(this).dialog("close"); 
                      $('#myform').submit();
                      $('.user2').val('');
                      return true;  
                    
                    
                      
                 }
        }
});

        $('#save1')
        .button()
            .click(function() {
                
            return $myDialog.dialog('open');
        });
            $( "#dialog" ).dialog({
            height: 140,
            modal: true
        });

});


</script>

<!-- pop out modal box -->
<?php $attributes = array( 'name' => 'myform', 'id'=>'myform');
     echo form_open('rtk_management/post_fcdrr',$attributes); ?>

<div id="dialog-form" title="FCDRR">
 <table id="test-hapa" width="100%" class="data-table"><tbody>


<tr><?php 
        foreach ($details as $counties) {
            $facility_name=$counties['facility_name'];
            $district=$counties['district_name'];
            $county=$counties['county'];
            $owner=$counties['owner'];
            ?>
            <option value="<?php echo $facility_name.'|'.$district.'|'.$county.'|'.$owner?>"></option>
        <?php }
        ?>
    <td colspan="2"><b>Name of Facility:</b></td>
    <td> <input class="user1" id="facility" name="facility" size="20" readonly="readonly" value= "<?php echo $facility_name?>" /></td>
    <td><b>Facility Code:</b></td>
    <td><input class="user1" id="facility_code" name="facility_code" readonly="readonly" value= "<?php echo $facility_code?>"</td>
    <td><b>District:</b></td>
    <td> <input class="user1" id="district" name="district" readonly="readonly" value= "<?php echo $district?>" /></td>
    <td><b>Province/County:</b></td>
    <td ><input class="user1" id="county" name="county" readonly="readonly" value= "<?php echo $county?>"/></td>
    <td><b>Affilliation:</b></td>
  <td><input class="user1" id="owner" name="owner" readonly="readonly"  value= "<?php echo $owner?>"/></td>
  </tr>
 
  
  <tr>
    <td align="right" colspan="3"><b>REPORT FOR PERIOD:BEGINNING:</b></td>
    <td><input class='my_date'id="begin_date" name="begin_date" type="text"/></td>
    <td ><b>ENDING:<b></td>
    <td><input class='my_date'id="end_date" name="end_date"  type="text"/></td>
    
  </tr>
  
  <tr>
    <td colspan="3"></td>
    <td colspan="2" align="center"><i>dd/mm/yyyy</i></td>
    <td colspan="2" align="center"><i>dd/mm/yyyy</i></td>
    <td colspan="7"></td>
          
  </tr>
  <tr>
    <td colspan="4"><b>State the number of CD4 Tests conducted:-</b></td>
   <td ><b> Calibur:</b><input type="text" placeholder="Tests" name="caliburTest" class="user3"/><input type="text" placeholder="Equip No." name="caliburequipment" class="user3" </td>
    <td ><b> Count:</b><input type="text" placeholder="Tests" name="countTest" class="user3"/><input type="text" placeholder="Equip No." name="countequipment" class="user3" </td>
    <td ><b>Cyflow Partec:</b> <input type="text" placeholder="Tests" name="cyflowTest" class="user3"/><input type="text" placeholder="Equip No." name="cyflowequipment" class="user3"/></td>
    
  </tr>
  <tr>
    <td colspan="4"><b>TOTAL NUMBER OF CD4 TESTS DONE DURING THE MONTH(REPORTING PERIOD):</b></td>
    <td colspan="10">&nbsp;</td>
    
  </tr>







	</tbody></table>
	<form>

	<table id="user-order" width="500px" class="data-table" >
					<thead>
					
<tr>		<th rowspan="2"><b>COMMODITY CODE</b></th>
			<th rowspan="2"><b>COMMODITY NAME</b></th>
            <th rowspan="2"><b>UNIT OF ISSUE</b></th>
            <th rowspan="2"><b>BEGINNING BALANCE</b></th>
            <th colspan="2"><b>QUANTITY RECEIVED FROM CENTRAL<br/> WAREHOUSE (e.g. KEMSA)</b></th>
            <th colspan="2"><b>QUANTITY RECEIVED FROM OTHER SOURCE(S)</b></th>
            <th rowspan="2"><b>QUANTITY USED</b></th>
            <th rowspan="2"><b>LOSSES/WASTAGE</b></th>
            <th colspan="2"><b>ADJUSTMENTS<br/><i>Indicate if (+) or (-)</i></b></th>
            <th rowspan="2"><b>ENDING BALANCE <br/>PYSICAL COUNT at end of the Month</b></th>
            <th rowspan="2"><b>QUANTITY REQUESTED</b></th>
            </tr>
            
            
            <tr>
            <th>Quantity</th>
            <th>Lot No.</th>           
             <th>Quantity</th>
            <th>Lot No.</th>
            <th>Positive</th>
            <th>Negative</th>    
            </tr>
        </thead>
<tbody>




<?php $checker=0;
                    foreach ($commodities as $lab_category) {
                        ?>
                    <tr>
                        <th colspan = "14" style = "text-align:left"><b><?php echo $lab_category->category_name; ?></b></th>            
                    </tr>

                        <?php
                        foreach ($lab_category->rtk_commodities as $lab_commodities) {?>
                    <tr><input type="hidden" id="commodity_id[<?php echo $checker?>]" name="commodity_id[<?php echo $checker?>]" value="<?php echo $lab_commodities['id']; ?>" >
                       
                        <td  style = "text-align:left" class="user2"></b><?php echo $lab_commodities['commodity_code']; ?></td>
                        <td  style = "text-align:left" class="user2"></b><?php echo $lab_commodities['commodity_name']; ?></td>
                        <td><input id="unit_of_issue[<?php echo $checker?>]" class="user1" name = "unit_of_issue[<?php echo $checker?>]" value="<?php echo $lab_commodities['unit_of_issue']; ?>" readonly="readonly"></td>
                        <td><input id="beginning_bal[<?php echo $checker?>]" class="user2" name = "beginning_bal[<?php echo $checker?>]"></td>
                        <td><input id="qty_warehouse[<?php echo $checker?>]" name = "qty_warehouse[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center"/></td>
                        <td><input id="lot_No_warehouse[<?php echo $checker?>]" name = "lot_No_warehouse[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center"/></td>
                        <td><input id="qty_other[<?php echo $checker?>]" name = "qty_other[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center"/></td>
                        <td><input id="lot_No_other[<?php echo $checker?>]" name = "lot_No_other[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center"/></td>
                        <td><input id="qty_used[<?php echo $checker?>]" name = "qty_used[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center"/></td>
                        <td><input id="loss[<?php echo $checker?>]" name = "loss[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center"/></td>   
                        <td><input id="positive_adj[<?php echo $checker?>]" name = "positive_adj[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center"/></td>
                        <td><input id="negative_adj[<?php echo $checker?>]"  name = "negative_adj[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center"/></td>
                        <td><input id="ending_bal[<?php echo $checker?>]" name = "ending_bal[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center"/></td>
                        <td><input id="qty_requested[<?php echo $checker?>]" name = "qty_requested[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center"/></td>   
                        
                    </tr>
                    <?php $checker++;}
                    
                }?>



												
							
						</tbody>
						</table>
	</form>
</div>

<input  class="button" id="save1" name="save1"  value="Save" >
</body>
