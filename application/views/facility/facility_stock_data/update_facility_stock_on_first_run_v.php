<style type="text/css">
#note{
      padding:10px;
}
</style>
<div class="container-fluid" >

      <div class="row">
            <!--<div class="col-md-4" id=""><p class="bg-info" id="note">
                 Please  note this activity is as off of <?php $today = ( date('d M Y'));
    //get today's date in full
?><input type="hidden" name="datepicker" readonly="readonly" value="<?php echo $today; ?>"/>
           <b> <?php //echo $today; ?>.
            </b>
            </p></div>-->
<input type="hidden" name="datepicker" readonly="readonly" value="<?php echo $today; ?>"/>
            <div class="col-md-4" id="">
<p class="bg-info" id="note">
 <strong>Step <span class="badge ">2 of 2</span> :</strong> 
           Please conduct a physical stock count,then fill in your stock data.
</p>
            </div>
            <?php if(isset($import)): ?>

                    <div style="height:auto; margin-bottom: 2px" class="warning message col-md-5" id="">        
        <h5> 1) Set up facility stock</h5> 
            <p>
         This process can take up to 1 minute,please wait. 
            </p>

        </div>
   
            <?php endif; ?>

          <div class="col-md-5">
              <p class="bg-warning" id="note" style="">
                <span class="badge ">NB</span>
                If a commodity is not in the list below, click <strong><a href="<?php echo base_url('stock/set_up_facility_stock')?>">here</a></strong> to select it. If it is not on the list entirely, please contact 
                your county pharmacist.
                </p>
          </div> 

          <div class="col-md-3">
              <div style="padding-top:2%;">
                  <a href="http://localhost/HCMP-1/reports/create_excel_facility_stock_template"><button type="button" class="btn btn-primary">
            <span class="glyphicon glyphicon-save"></span>download excel template
        </button> </a>
        <button type="button" class="btn btn-success update-via-excel">
            <span class="glyphicon glyphicon-open"></span>upload
        </button>
              </div>
              
          </div> 
      </div>
    
            
    <hr />
      <div class="row " style="min-height:300px; overflow: auto;"><div class="col-md-12">
    
        <?php $att = array("name" => 'myform', 'id' => 'myform');
        echo form_open('stock/add_stock_level', $att);
 ?>
 <input type="hidden" name="form_type" value="first_run" />
        <table  class="table table-hover table-bordered table-update table-responsive"  id="facility_stock_table">

            <thead style="background-color: white">
                <tr>
                    <th> Description</th>
                    <th> Supplier</th>
                    <th> Unit Size</th>
                    <th> Batch No</th>
                    <th> Source of Item</th>
                    <th> Manufacturer</th>
                    <th> Expiry Date</th>
                    <th> Issue Type</th>
                    <th> Stock Level</th>
                    <th> Total (Units)</th>
                    <th> Options</th>
                </tr>
            </thead>
            <tbody>
                <tr table_row="1">
                    <td>
                    <input type="hidden" class="commodity_id" value=""  name="commodity_id[]"/>
                    <select  name="desc[]" class="form-control desc" style="" id="desc">
                        <option special_data="0" value="0">Select One</option>
                         <?php
                foreach ($commodities as $commodities) {
                    $id = $commodities['commodity_id'] ;
                    $commodities_name = $commodities['commodity_name'];
                    $unit_size = $commodities['unit_size'];
                    $commodity_code = $commodities['commodity_code'];
                    $total_units = $commodities['total_commodity_units'];                  
                    $name =$commodities['source_name'];
              
                    echo "<option special_data='" . $id . "^" . $name . "^" . $commodity_code . "^" . $unit_size . "^" . $total_units . "' 
                    value='$id'>" . $commodities_name . "</option>";
                }
                ?>
                    </select></td>
                    <td>
                    <input style="width:70px !important;" type="text" class="form-control input-small commodity_supplier" name="commodity_supplier[]" readonly="readonly"/>
                    <input type="hidden" class="actual_units"/>
                    </td>
                    <td>
                    <input style="width:70px !important;" type="text" class="form-control input-small unit_size"   name="commodity_unit_size[]" readonly="readonly"/>
                    </td>
                    <td>
                    <input  style="width:80px !important;" class='form-control input-small commodity_batch_no' required="required" data-val="true" name='commodity_batch_no[]' type='text'/>
                    </td>
                    <td>
                    <select style="width:95px !important;" class="form-control input-small source_of_item" name="source_of_item[]">
                        <?php
                        foreach ($commodity_source as $commodity_source) {
                            $id = $commodity_source -> id;
                            $commodity_source_name = $commodity_source -> source_name;
                            echo "<option value='$id'>$commodity_source_name</option>";
                        }
                        ?>
                    </select></td>
                    <td>
                    <input style="width:70px !important;" id='commodity_manufacture' required="required" class="form-control commodity_manufacture input-small"
                    name='commodity_manufacture[]' type='text' value=""  data-val="true"/>
                    </td>
                    <td>
                    <input  style="width:90px !important;" class='form-control input-small clone_datepicker' required="required"  data-val="true" name='clone_datepicker[]' type='text' />
                    </td>
                    <td>
                    <select style="width:80px !important;"name="commodity_unit_of_issue[]" class="form-control commodity_unit_of_issue input-small">
                        <option value="Pack_Size">Packs</option>
                        <option value="Unit_Size">Units</option>
                    </select></td>
                    <td>
                    <input style="width:60px !important;" id='commodity_available_stock' name='commodity_available_stock[]'
                    type='text' class="form-control input-small input-small commodity_available_stock" required="true" data-val="true"/>
                    </td>
                    <td>
                    <input type='text' style="width:60px !important;" class='form-control input-small commodity_total_units' readonly="readonly" name='commodity_total_units[]' value=''/>
                    </td>
                    <td style="width:120px !important;">
                    <button type="button" class="remove btn btn-danger btn-xs">
                        <span class="glyphicon glyphicon-minus"></span>row
                    </button>
                    <button type="button" class="add btn btn-primary btn-xs">
                         <span class="glyphicon glyphicon-plus"></span>row
                     </button>
    </td>
                </tr>
            </tbody>
        </table>
        <?php echo form_close(); ?>

    </div></div>
</div>
<hr />
<div class="container-fluid">

	<div style="float: right">
		   <!--   <button type="button" class="importing btn btn-sm btn-success">-->
    <div style="float: right">
        <?php if(!isset($import)): ?>
        <!--<a href="<?php echo base_url('reports/create_excel_facility_stock_template') ?>" >
       <!-- <button type="button" class="btn btn-primary">
            <span class="glyphicon glyphicon-save"></span>download excel template
        </button> </a>
        <button type="button" class="btn btn-success update-via-excel">
            <span class="glyphicon glyphicon-open"></span>upload
        </button>-->
        <button type="button" class="save btn btn-sm btn-success">
            <span class="glyphicon glyphicon-open"></span>Save
        </button>
        <?php else: ?>

              <button type="button" class="importing btn btn-sm btn-success">
            <span class="glyphicon glyphicon-open"></span>Finish Importing
        </button>
        <?php endif; ?>
    </div>
</div>

    <script type="text/javascript">
        $(document).ready(function() {
        	window.onbeforeunload = function() {
        return "Are you sure you want to leave?";
    }
   
            changeHashOnLoad();

        setTimeout(function () {
               // alert();
         swal({  

                  title: "Step 2 of 2",  
                   text: "Please select a commodity & fills the stock level.",
                     type: "info"

                     });

             }, 000);
                    
        var $table = $('table');
        //float the headers
        $table.floatThead({
        scrollingTop: 100,
        zIndex: 1001,
        scrollContainer: function($table){ return $table.closest('.test'); }
        });
        ////upload via excel
        $(".update-via-excel").on('click', function() {
        var body_content='<?php  $att=array("name"=>'myform','id'=>'myform');
        echo form_open_multipart('stock/update_stock_via_excel',$att)?>
            '+
            '<input type="file" name="file" id="file" required="required" class="form-control"><br>'+
            '<input type="submit" name="submit"  value="Upload">'+
            '</form>';
            //hcmp custom message dialog
            dialog_box(body_content,'');

            });
            //Check if drugs were temporarily saved
            var link="<?php echo base_url('stock/get_temp_stock_data_json') ?>";
            $.ajax({
            url : link,
            type : 'POST',
            dataType : 'json',
            success : function(data) {
            var data_count=data.length;
            var x=1;
            var last_row=$('#facility_stock_table tr:last');

            $.each(data, function(i, jsondata) {
            //prepare the data
            var commodity_id=data[i]['commodity_id'];
            var unit_size=data[i]['unit_size'];
            var batch_no=data[i]['batch_no'];
            var commodity_manufacture=data[i]['manu'];
            var clone_datepicker=data[i]['expiry_date'];
            var stock_level=data[i]['stock_level'];
            var total_unit_count=data[i]['total_unit_count'];
            var facility_code=data[i]['facility_code'];
            var total_units=data[i]['total_units'];
            var unit_issue=data[i]['unit_issue'];
            var source_of_item=data[i]['unit_issue'];
            var supplier=data[i]['supplier'];
            var selected_option=data[i]['unit_issue'];
            var cloned_object = $('#facility_stock_table tr:last').clone(true);
            var table_row = cloned_object.attr("table_row");
            var next_table_row = parseInt(table_row) + 1;
            //set the data
            cloned_object.attr("table_row", next_table_row);
            cloned_object.find(".commodity_unit_of_issue").val(selected_option);
            cloned_object.find(".desc").val(commodity_id);
           
            cloned_object.find(".unit_size").attr('value',unit_size);
            cloned_object.find(".commodity_batch_no").attr('value',batch_no);
            cloned_object.find(".commodity_batch_no").attr('name',"commodity_batch_no["+next_table_row+"]");
            cloned_object.find(".commodity_manufacture").attr('value',commodity_manufacture);
            cloned_object.find(".commodity_manufacture").attr('name',"commodity_manufacture["+next_table_row+"]");
            cloned_object.find(".clone_datepicker").attr('value',clone_datepicker);
            cloned_object.find(".clone_datepicker").attr('name',"clone_datepicker["+next_table_row+"]");
            cloned_object.find(".commodity_available_stock").attr('value',stock_level);
            cloned_object.find(".commodity_available_stock").attr('name',"commodity_available_stock["+next_table_row+"]");
            cloned_object.find(".commodity_total_units").attr('value',total_units);
            cloned_object.find(".commodity_unit_of_issue").attr('value',unit_issue);
            cloned_object.find(".actual_units").attr('value',total_units);
            cloned_object.find(".source_of_item").attr('value',source_of_item);
            cloned_object.find(".commodity_supplier").attr('value',supplier);
            cloned_object.insertAfter('#facility_stock_table tr:last');
            if(x==data_count){
            $('#facility_stock_table tbody tr:first').remove();
            }

            refreshDatePickers();
            x++;
            });

            }
            });
            ////when the user selects the commodity name
            $(".desc").change(function(){

            var data =$('option:selected', this).attr('special_data');
            var data_array=data.split("^");
            //set the user data here
            $(this).closest("tr").find(".unit_size").val(data_array[3]);
            $(this).closest("tr").find(".commodity_supplier").val(data_array[1]);
            $(this).closest("tr").find(".commodity_id").val(data_array[0]);
            $(this).closest("tr").find(".actual_units").val(data_array[4]);
            });

            $(".commodity_batch_no").on('keyup',function(){

            confirm_batch_no();

            });
            ////when the user clicks add a row
            $(".add").on('click',function(){
            /////update the record
            var selector_object=$("#facility_stock_table tr:last");
            var url = "<?php echo base_url('stock/autosave_update_stock')?>";
            var temp_data=send_data_to_the_temp_table(selector_object);
            var alert_message=check_if_the_form_has_been_filled_correctly(selector_object);
            if(isNaN(alert_message)){
            var notification='<ol>'+alert_message+'</ol>&nbsp;&nbsp;&nbsp;&nbsp;<span class="label label-danger">Before adding a new row</span>';
            //hcmp custom dialog box
            hcmp_message_box(title='HCMP error message',notification,message_type='error');
            //This event is fired immediately when the hide instance method has been called.
            $('#communication_dialog').on('hide.bs.modal', function (e) { selector_object.closest("tr").find('.desc').focus();  });
            return;
            }
            if(temp_data[1]==0 && temp_data[2]=="" && temp_data[5]=='' ){
            return;
            }
            else{
            //send data to the temp table
            ajax_simple_post_with_console_response(url, temp_data[0]);  /// uncomment this
            }
            clone_the_last_row_of_the_table();

            });
            $('.commodity_available_stock').on('keyup',function(){
            //get the value of the input
            var num=$(this).val();
            //get the object
            var selector_object=$(this);
            var temp_data=send_data_to_the_temp_table(selector_object);
            var commodity_unit_of_issue=selector_object.closest("tr").find('.commodity_unit_of_issue').val();
            var actual_unit_size=selector_object.closest("tr").find('.actual_units').val();
            var alert_message=check_if_the_form_has_been_filled_correctly(selector_object);
            if(isNaN(alert_message)){
            selector_object.val("");
            var notification='<ol>'+alert_message+'</ol>&nbsp;&nbsp;&nbsp;&nbsp;<span class="label label-danger"></span>';
            //hcmp custom dialog box
             hcmp_message_box(title='HCMP error message',notification,message_type='error');
            //This event is fired immediately when the hide instance method has been called.
            $('#communication_dialog').on('hide.bs.modal', function (e) { selector_object.closest("tr").find('.desc').focus();  });
            selector_object.closest("tr").find('.commodity_total_units').val();
            return;
            }
            // check if the user has inputed a decimal or character
            if(!isNaN(num)){
            if(num.indexOf('.') > -1) {
            //reset the text field and the message dialog box
            selector_object.val("");
            //hcmp custom message dialog
             hcmp_message_box(title='HCMP error message',notification='Decimals are not allowed',message_type='error');
            //dialog_box("Decimals are not allowed",'<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>');
            //This event is fired immediately when the hide instance method has been called.
            $('#communication_dialog').on('hide.bs.modal', function (e) { selector_object.focus();  })
            return;}  }
            else {
            //reset the text field and the message dialog box
            selector_object.val("");
            //hcmp custom message dialog
            hcmp_message_box(title='HCMP error message',notification='Enter only numbers',message_type='error');
           // dialog_box("Enter only numbers",'<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>');
            //This event is fired immediately when the hide instance method has been called.
            $('#communication_dialog').on('hide.bs.modal', function (e) { selector_object.focus();  })
            return; }
            // finally calculate the stock
            calculate_actual_stock(actual_unit_size,commodity_unit_of_issue,num,".commodity_total_units",selector_object);
            //update the record
            var url = "<?php echo base_url('stock/autosave_update_stock')?>";
            //save the infor
            ajax_simple_post_with_console_response(url, temp_data[0]);
            });
            $('.remove').on('click',function(){
            var selector_object=$(this);
            //hcmp custom message dialog
            //
            swal({   title: "Are you sure?",   
                text: "Are you sure you want to delete this record? You will not be able to recover this data!!!",  
                 type: "warning",   showCancelButton: true,  
                  confirmButtonColor: "#5cb85c",  
                   confirmButtonText: "Yes, continue!",   
                   cancelButtonText: "No, cancel please",  
                    closeOnConfirm: false,  
                     closeOnCancel: false }, 
                     
                     function(isConfirm){   if (isConfirm) {   
                          
                         swal("Deleted!", "Record Deleted.", "success"); 
                         
                              //url for deleting the row
            var url = "<?php echo base_url('stock/delete_temp_autosave')?>";
            //get the data to delete the row
            var temp_data=send_data_to_the_temp_table(selector_object);
            if(temp_data[6]!=0){
            //data to be used to delete the row
            var data="commodity_id="+temp_data[6]+"&commodity_batch_no="+temp_data[2];
            //delete the row on the temp table
            ajax_simple_post_with_console_response(url, data); }
            //remove the row
            var rowCount =0;
            rowCount = $('#facility_stock_table  >tbody >tr').length;
            //finally remove the row
            if(rowCount==1){
            clone_the_last_row_of_the_table();
            selector_object.parent().parent().remove();  }
            else{ selector_object.parent().parent().remove();  }
           // $('#communication_dialog').modal('hide');      

                         
                           } else {
                            
                            swal({   title: "Cancelled!",   text: "Your transaction was stopped ",  type: "warning", showCancelButton: false , timer: 3000 });
                               
                              return; 
                              } });
           
           // $('.remove_record').on('click',function(){
            
           // })
            });
            /************save the data here*******************/
           
            $('.save').button().click(function() {
             $("#myform").validate();
            //notification = $("table#facility_stock_table").dataTable();
           // var notification = $("table#facility_stock_table")[0].clone(true);
            var html_data = "";
           // var notification =  $('<div>').append( $('table#facility_stock_table').clone() ).html();

           var html_data='<style>.sweet-alert{width:60%;left:40%}</style><div style="max-height:300px;overflow-y:auto"><table class="table table-hover table-bordered table-update">'+
                    "<thead><tr>"+
                    "<th>Description</th>"+
                    "<th>Batch No</th>"+
                    "<th>Quantity(Units)</th>"+
                    "</tr></thead><tbody>";                       
        $("input[name^=commodity_available_stock]").each(function(i) { 
            //$(document).each('','input[name^=cost]', function (i){
         var commodity_name=$(this).closest("tr").find("#desc :selected").text()
         var batchn=$(this).closest("tr").find(".commodity_batch_no").val()
         var total_units=$(this).closest("tr").find(".commodity_total_units").val()
         //alert(C_name);
         //return;
        html_data +="<tr>" +
                            "<td>" +commodity_name+ "</td>" +
                            "<td>" +batchn+ "</td>" +
                            "<td>" +total_units+ "</td>" +   
                                                                              
                        "</tr>" 
                    });
         html_data +="</tbody></table></div>";

            confirm_with_summary(html_data,'#myform') 

             
            //
            });

             $('.importing').button().click(function() {
             $(this).attr("disabled", 'disabled');
            var img='<img src="<?php echo base_url('assets/img/wait.gif') ?>"/>';
       dialog_box(img+'<h5 style="display: inline-block; font-weight:500;font-size: 18px;padding-left: 2%;"> Please wait finalizing import</h5>',
     '');
             $("#myform").submit();  
            });

            function send_data_to_the_temp_table(selector_object){

            var data_ =$('option:selected', selector_object.closest("tr").find('.desc')).attr('special_data');
            var source_of_item=$('option:selected', selector_object.closest("tr").find('.source_of_item')).val();
            var data_array=data_.split("^");
            var unit_size=selector_object.closest("tr").find('.unit_size').val();
            var commodity_batch_noo=selector_object.closest("tr").find('.commodity_batch_no').val();
            var commodity_manufacture=selector_object.closest("tr").find('.commodity_manufacture').val();
            var clone_datepicker=selector_object.closest("tr").find('.clone_datepicker').val();
            var stock_level=selector_object.closest("tr").find('.commodity_available_stock').val();
            var unit_count=selector_object.closest("tr").find('.commodity_total_units').val();
            var commodity_unit_of_issue=selector_object.closest("tr").find('.commodity_unit_of_issue').val();
            var supplier=data_array[1];
            var data="&commodity_id="+data_array[0]+"&unit_size="
            +unit_size+" &batch_no="+commodity_batch_noo+"&manuf="+commodity_manufacture+
            "&expiry_date="+clone_datepicker+
            "&stock_level="+stock_level+
            "&total_units_count="+selector_object.closest("tr").find('.commodity_total_units').val()+
            "&unit_issue="+commodity_unit_of_issue+
            "&total_units="+data_array[4]+
            "&source_of_item="+source_of_item+
            "&supplier="+supplier;

            return [data, data_ ,commodity_batch_noo,commodity_manufacture,clone_datepicker,stock_level,data_array[0]];
            }

            function check_if_the_form_has_been_filled_correctly(selector_object){
            var temp_data=send_data_to_the_temp_table(selector_object);
            var alert_message='';
            if(temp_data[1]==0){
            alert_message +="<li><b>Please Select a commodity first.<b></li>";
            }
            if(temp_data[2]==""){
            alert_message +="<li><b>Please Indicate batch No of the commodity.<b></li>";
            }
            if(temp_data[3]==""){
            alert_message +="<li><b> Please Indicate Manufacturer of the commodity.<b></li>";
            }
            if(temp_data[4]==''){
            alert_message +="<li><b>Please Indicate the expiry date of the commodity.<b></li>";
            }
            if(temp_data[5]==''){
            alert_message +="<li><b>Please Indicate the stock level of the commodity.<b></li>";
            }
            return alert_message;
            }
            function  clone_the_last_row_of_the_table(){
               
            var cloned_object = $('#facility_stock_table tr:last').clone(true);
            cloned_object.find('input[type=text]').attr("value", "");
            var table_row = cloned_object.attr("table_row");
            var next_table_row = parseInt(table_row) + 1;
            var commodity_id_id = "commodity_id_" + next_table_row;
            var commodity_batch_no_id = "commodity_batch_no_" + next_table_row;
            var source_of_item_id = "source_of_item_" + next_table_row;
            var commodity_manufacture_id = "commodity_manufacture_" + next_table_row;
            var clone_datepicker_id = "clone_datepicker_" + next_table_row;
            var commodity_total_units_id = "commodity_total_units_" + next_table_row;
            var commodity_available_stock_id = "commodity_available_stock_" + next_table_row;
            //Find Old Objects and reset values
            var desc = cloned_object.find(".desc");
            var commodity_available_stock = cloned_object.find(".commodity_available_stock");
            var commodity_id = cloned_object.find(".commodity_id");
            var source_of_item = cloned_object.find(".source_of_item");
            var commodity_manufacture = cloned_object.find(".commodity_manufacture");
            var clone_datepicker = cloned_object.find(".clone_datepicker");
            var commodity_total_units = cloned_object.find(".commodity_total_units");
            var commodity_batch_no = cloned_object.find(".commodity_batch_no");
            //reset the values
            cloned_object.attr("table_row", next_table_row );
            desc.attr("value", "0");
            commodity_batch_no.attr("id", commodity_batch_no_id);

            commodity_id.attr("id", commodity_id_id);

            commodity_batch_no.attr("id", commodity_batch_no_id);

            commodity_batch_no.attr("name", "commodity_batch_no["+next_table_row+"]");
            commodity_manufacture.attr("id", commodity_manufacture_id);

            commodity_manufacture.attr("name", "commodity_manufacture["+next_table_row+"]");
            commodity_total_units.attr("id", commodity_total_units_id);

            commodity_available_stock.attr("id", commodity_available_stock_id);
            commodity_available_stock.attr("name", "commodity_available_stock["+next_table_row+"]");

            clone_datepicker.attr("id", clone_datepicker_id);
            clone_datepicker.attr("name", "clone_datepicker["+next_table_row+"]");

            // remove the error class
            cloned_object.find("label.error").remove();
            //insert the data
            cloned_object.insertAfter('#facility_stock_table tr:last').find('input').val('');
            // refresh the datepickers
            refreshDatePickers();
            }

            //make sure batch numbers entered are unique

function confirm_batch_no() {
    var arr = [];
    i = 0;
    $('.commodity_batch_no').each(function() {

        
        arr[i++] =$(this).closest('tr').find('.commodity_batch_no').val();

                 
        }); 

      j=0;
    $(arr).each(function() {

      var compare=$('#facility_stock_table tr:last').find('.commodity_batch_no').val();
    $(".add").attr("disabled", false);
    // alert(compare+arr[j])

     if(compare==arr[j-1]){
      $(".add").attr("disabled", true);
      swal({  

                  title: "Error",  
                   text: "Please make sure all batch numbers are unique",
                     type: "error"

                     });
      return;

     }
       
        j++;
        }); 

         
           
  }
            });
    </script>

