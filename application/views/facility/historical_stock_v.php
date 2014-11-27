<script type="text/javascript" language="javascript" src="<?php echo base_url();  ?>Scripts/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();  ?>Scripts/unit_size.js"></script>
<style type="text/css" title="currentStyle">            
        @import "<?php echo base_url(); ?>DataTables-1.9.3 /media2/css/jquery.dataTables.css";
        .footer {
        	position: relative;
        }
</style>

    
<script>
/******************************************data-table set up*********************/
/* Define two custom functions (asc and desc) for string sorting */
            jQuery.fn.dataTableExt.oSort['string-case-asc']  = function(x,y) {
                return ((x < y) ? -1 : ((x > y) ?  1 : 0));
            };
            
            jQuery.fn.dataTableExt.oSort['string-case-desc'] = function(x,y) {
                return ((x < y) ?  1 : ((x > y) ? -1 : 0));
            };
 
function calculate_a_stock (argument) {
    
    
    var x = argument;
    
    //checking if an option has been selected
    if (($("input[type='radio'][name="+x+"]").is(':checked'))==false) {
      document.getElementsByName("consumption["+x+"]")[0].value='';
      document.getElementsByName("total["+x+"]")[0].value='';
      alert('Please select either pack or unit size.');
      return;
    };
   
    var radiocheck =($("input[type='radio'][name="+x+"]:checked").val());
    //checking if the quantity is a number      
var num = document.getElementsByName("consumption["+x+"]")[0].value.replace(/\,/g,'');
if(!isNaN(num)){
if(num.indexOf('.') > -1) {
alert("Decimals are not allowed.");
document.getElementsByName("consumption["+x+"]")[0].value = document.getElementsByName("consumption["+x+"]")[0].value.substring(0,document.getElementsByName("consumption["+x+"]")[0].value.length-1);
document.getElementsByName("consumption["+x+"]")[0].select();
return;
}
} else {
alert('Enter only numbers');
document.getElementsByName("consumption["+x+"]")[0].value= document.getElementsByName("consumption["+x+"]")[0].value.substring(0,document.getElementsByName("consumption["+x+"]")[0].value.length-1);
return;
}
if (radiocheck == 'Pack_Size'){
   // alert(document.getElementsByName("u_size["+x+"]").value);
  var actual_unit_size=get_unit_quantity(document.getElementsByName("u_size["+x+"]")[0].value);

 var total_consumption=actual_unit_size*num;
 
   document.getElementsByName("total["+x+"]")[0].value=total_consumption; 
    
    
  
  } else{
    //do this other
    $(function() {

        document.getElementsByName("total["+x+"]")[0].value = document.getElementsByName("consumption["+x+"]")[0].value;
        
        
    });
}

var drug_id = document.getElementsByName("drug_id["+x+"]")[0].value;
var consumption = document.getElementsByName("consumption["+x+"]")[0].value;
var unit_size = document.getElementsByName("u_size["+x+"]")[0].value;
var total = document.getElementsByName("total["+x+"]")[0].value;
var selected_option = ($("input[type='radio'][name="+x+"]:checked").val());

json_obj={"url":"<?php echo site_url("stock_management/save_historical_stock/");?>",}
var baseUrl=json_obj.url;

save_historical_stock(baseUrl,"data_array="+drug_id+"|"+consumption+"|"+unit_size+"|"+total+"|"+selected_option);
}
/***********creating the request that will update the historical stock table ******/
var c_id=1;
function save_historical_stock(baseUrl, data_array){
               
                json_obj={"url":"<?php echo site_url("stock_management/save_historical_stock/");?>",}
                var baseUrl=json_obj.url;
               // var url = "<?php echo base_url().'stock_management/save_historical_stock/'?>"+drugid;
          /*
       * ajax is used here to retrieve values from the server side and set them in dropdown list.
       * the 'baseUrl' is the target ajax url, 'post' contains the a POST varible with data and
       * 'identifier' is the id of the dropdown list to be populated by values from the server side
       */
      
      $.ajax({
        type: "POST",
        url: baseUrl,
        data: data_array,
        success: function(msg){
          console.log(msg+c_id);
          c_id=c_id+1;
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
             if(textStatus == 'timeout') {}
         }
      }).done(function( msg ) {
        
      });

            }

  $(document).ready(function() {
    
      	
  $( "#save" )
			.button()
			.click(function() {
				
			window.location="<?php echo base_url()."stock_management/fake_historical_response";?>";	
			});

        var the_table = $('#main').dataTable( {
                    "bJQueryUI": true,
                   "bPaginate": false
                } );
    

});


</script>

<h2 style="text-align:left; font-size: 14px">Please note this is a one off activity</h2>

<div id="stocktable" title="Fill in the details below">


<table id ='main' style="margin-left: 0;" width="100%">
    <thead>
            <tr><th style="text-align:center;"><b>Category&nbsp;Name</b></th>                
                <th style="text-align:center;"><b>Commodity&nbsp;Name</b></th>
                <th style="text-align:center;"><b>KEMSA&nbsp;Code</b></th>
                <th style="text-align:center;"><b>Unit&nbsp;Size</b></th>
                <th style="text-align:center;"><b>Pack&nbsp;Size/Unit&nbsp;Size&nbsp;(Select&nbsp;One)</b></th>
                <th style="text-align:center;"><b>Average&nbsp;Consumption&nbsp;Amount</b></th>                   
                <th style="text-align:center;"><b>Total&nbsp;Units</b></th>                   
            </tr>
            </thead>
<tbody>
<?php 
$count = 0;
foreach($historical_data as $data_item):?>

            
        <tr>
            
            
            <td><?php echo $data_item['category_name']?></td>
            <td><?php echo $data_item['drug_name'];?></td>
            <td><?php echo $data_item['kemsa_code'];?></td>
            <td><?php echo $data_item['unit_size'];?></td>
            <input type="hidden" name ='drug_id[<?php echo $count?>]' value="<?php echo $data_item['id']?>"> 
             <input type="hidden" name ='u_size[<?php echo $count?>]' value="<?php 
             if($data_item['unit_size']==NULL){
             	echo 1;
             }
			 else{
			 echo $data_item['unit_size'];	
			 }
             
             ?>">
       <?php

                  	
                   if ($data_item['selected_option']!=NULL && $data_item['selected_option']=='Unit_Size') {?>
              <td><input id='Unit_Size' type='radio' name='<?php echo $count?>' value='Unit_Size' class='<?php echo $count?>' checked='checked'>
                <label for='Unit_Size' style = 'font-size: 12px; font-family: arial,helvetica, sans-serif'>Unit Size</label> 
                <input id='Pack_Size' type='radio' name='<?php echo $count?>' value='Pack_Size' class='<?php echo $count?>' onkeyup='calculate_a_stock(<?php echo $count?>)'>
                <label for='Pack_Size' style = 'font-size: 12px; font-family: arial,helvetica, sans-serif'>Pack Size</label> </td>          
            <?php }elseif ($data_item['selected_option']!=NULL && $data_item['selected_option']=='Pack_Size') {?>
              <td><input id='Unit_Size' type='radio' name='<?php echo $count?>' value='Unit_Size' class='<?php echo $count?>'>
                <label for='Unit_Size' style = 'font-size: 12px; font-family: arial,helvetica, sans-serif'>Unit Size</label>
              <input id='Pack_Size' type='radio' name='<?php echo $count?>' value='Pack_Size' class='<?php echo $count?>' checked='checked' onkeyup='calculate_a_stock(<?php echo $count?>)'>
                <label for='Pack_Size' style = 'font-size: 12px; font-family: arial,helvetica, sans-serif'>Pack Size</label></td>
                <?php }
                elseif ($data_item['selected_option']==NULL){?>
                <td><input id='Unit_Size' type='radio' name='<?php echo $count?>' value='Unit_Size' class='<?php echo $count?>'>
                <label for='Unit_Size' style = 'font-size: 12px; font-family: arial,helvetica, sans-serif'>Unit Size</label>
                <input id='Pack_Size' type='radio' name='<?php echo $count?>' value='Pack_Size' class='<?php echo $count?>' onkeyup='calculate_a_stock(<?php echo $count?>)'>
                <label for='Pack_Size' style = 'font-size: 12px; font-family: arial,helvetica, sans-serif'>Pack Size</label>
              </td>
               <?php }?>
                <td><input  id = 'consumption[<?php echo $count?>]' name = 'consumption[<?php echo $count;?>]' value= "<?php echo $data_item['consumption_level']?>" style='text-align:center;' type = 'text' onkeyup='calculate_a_stock(<?php echo $count?>)'></td>
                <td><input  id = 'total[<?php echo $count?>]' name='total[<?php echo $count?>]' value= "<?php echo $data_item['unit_count']?>"  style='text-align:center;' type = 'text' readonly = 'readonly' value=''></td>
                
                
        </tr>
        
        <?php $count++;
        endforeach;?>

</tbody>
</table>
</div>
<br />
<br />
<button class="btn btn-primary" id="save">Save</button>