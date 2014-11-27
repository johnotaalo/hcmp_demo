<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/datatable/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/tablecloth/assets/css/tablecloth.css">
<script src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablesorter.js"></script>
<script src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.metadata.js"></script>
<script src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablecloth.js"></script>

<style>
    @import "<?php echo base_url(); ?>assets/datatable/media2/css/jquery.dataTables.css";
</style>
<style>
    .user{
        width:70px;
        background : none;
        border : none;
        text-align: center;
    }
    .user2{
        width:70px;

        text-align: center;
    }
    .col5{background:#D8D8D8;}
    table{
        font-size: 11px;   
    }    
    table td{
        line-height: 11px;
    }
</style>

<script type="text/javascript">
    $(function() {

        $('#user_order input').addClass("form-control");

    //Set the begining Balance for the Comodities    
    // var begining_bal = <?php echo json_encode($beginning_bal);?>;

    // for (var a = 0; a < begining_bal.length; a++) {            
    //     var current_bal = begining_bal[a];
    //     $('#b_balance_'+a).attr("value",current_bal); 
    // };             

    //Set the first element uneditable i.e. Screening Determine
    $('#tests_done_0').attr("readonly",'true');

    //Set the Datepickers
    $("#begin_date").datepicker({
        defaultDate: "",
        changeMontd: true,
        changeYear: true,
        numberOfMontds: 1,
    });
    $("#end_date").datepicker({
        defaultDate: "",
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1,
        
    });

    /*Calculating the Value of the Number of tests done for Screening Determine*/

    /*end of triggering of the calculation of Values of the Number of tests done for Screening Determine*/
    $('#vct').change(function(){           
        validate_tests('vct');        
    })    
    $('#pitc').change(function(){        
        validate_tests('pitc');       
    })
    $('#pmtct').change(function(){        
        validate_tests('pmtct');        
    })
    $('#blood_screening').change(function(){        
        validate_tests('blood_screening');        
    })
    $('#other2').change(function(){        
       validate_tests('other2');        
   }) 

    /* end of triggering of the calculation of Values for Screening Determine */   
    /* Start of Validation for Tests for Screening Determine */
    function validate_tests(top_type){
        var input_value  = $('#'+top_type).val();
        if(isNaN(input_value)){            
           $('#'+top_type).css("border-color","red");
       }else{ 
            if(input_value<0){                
                $('#'+top_type).css("border-color","red");                
            }else{      
                $('#'+top_type).css("border-color","none");
                compute_tests_done();
            }
        }

    }

/* --- Start of calculation for the no of tests done for Screening Determine  -- */
function compute_tests_done(){  
    var vct_no = parseInt($('#vct').val());
    var pitc_no = parseInt($('#pitc').val());
    var pmtct_no = parseInt($('#pmtct').val());
    var blood_screening_no = parseInt($('#blood_screening').val());
    var other = parseInt($('#other2').val());
    tests_done_no = vct_no + pitc_no + pmtct_no + blood_screening_no + other;
    $('#tests_done_0').attr("value",tests_done_no).change();
    $('#q_used_0').attr("value",tests_done_no).change();
}       
/* End of Validation for Tests for Screening Determine */


    /* ---- Compute the Losses New----*/    
    function validate_loss(row){
        var tests_done = $('#tests_done_'+row).val();        
        var quantity_used = $('#q_used_'+row).val();
        compute_loss(row,'q_used_','tests_done_');
    }

    function compute_loss(row,q_used,tests_done){        
        var loss = $('#q_used'+row).val() - $('#tests_done'+row).val();
        $('#losses_'+row).val(loss).change();        
    }

    $('.qty_used').change(function() {
        row_id = $(this).closest("tr");
        number = row_id.attr("commodity_id");
        num = parseInt(number);
        validate_inputs_loss('q_used_',num);
        //validate_inputs('q_used_',num);
        
    })
    $('.tests_done').change(function() {
        row_id = $(this).closest("tr");
        number = row_id.attr("commodity_id");
        num = parseInt(number);        
        validate_inputs_loss('tests_done_',num);
        //validate_inputs('tests_done_',num);
        
    })
    $('.bbal').change(function() {
        row_id = $(this).closest("tr");
        number = row_id.attr("commodity_id");
        num = parseInt(number);
        validate_inputs('b_balance_',num);
    })
    $('.qty_rcvd').change(function() {
        row_id = $(this).closest("tr");
        number = row_id.attr("commodity_id");
        num = parseInt(number);
        validate_inputs('q_received_',num);
    })


    $('.pos_adj').change(function() {
        row_id = $(this).closest("tr");
        number = row_id.attr("commodity_id");
        num = parseInt(number);
        validate_inputs('pos_adj_',num);
    })
    $('.neg_adj').change(function() {
        row_id = $(this).closest("tr");
        number = row_id.attr("commodity_id");
        num = parseInt(number);
        validate_inputs('neg_adj_',num);
    })  
    $('.phys_count').change(function() {
        row_id = $(this).closest("tr");
        number = row_id.attr("commodity_id");
        num = parseInt(number);
        validate_inputs('physical_count_',num);
    })           



      /*  Check if a value is a number and not less than zero */
    function validate_inputs(input,row){        
        var input_value  = $('#'+input+row).val();
        if((isNaN(input_value))|| (input_value=='')){            
           $('#'+input+row).css("border-color","red");
           hide_save();
         }else{ 
                $('#'+input+row).css("border",'');                
                if(input_value<0){                
                    $('#'+input+row).css("border-color","red");                
                    hide_save();
                }else{      
                    $('#'+input+row).css("border",'');                
                    show_save();
                    compute_closing(row);
                }
            }

    }

    /*  End of Input Validations */

    /*  Check if a value is a number and not less than zero */
    function validate_inputs_loss(input,row){        
        var input_value  = $('#'+input+row).val();        
        if((isNaN(input_value))||(input_value='')){            
           $('#'+input+row).css("border-color","red");
         }else{ 
                input_value = parseInt(input_value);
                $('#'+input+row).css("border",'');                
                if(input_value<0){                
                    $('#'+input+row).css("border-color","red");
                    hide_save();                
                }else{      
                    $('#'+input+row).css("border",'');
                    var q_used = parseInt($('#q_used_'+row).val());
                    var tests_done = parseInt($('#tests_done_'+row).val());
                    if(q_used < tests_done){
                        $('#q_used_'+row).css("border-color","red"); 
                        $('#tests_done_'+row).css("border-color","red"); 
                        hide_save();
                    }else{
                        /*var loss = q_used - tests_done;
                        $('#q_used_'+row).css("border-color",""); 
                        $('#tests_done_'+row).css("border-color",""); 
                        $('#losses_'+row).val(loss).change();*/
                        show_save();
                        compute_closing(row);
                    }                        
                }
            }

    }

    /*  End of Input Validations */

    /*  End of Input Validations */
    /* Compute Closing Balance */
    function compute_closing(row){
        var b_bal = parseInt($('#b_balance_' + row).val()); 
        var qty_rcvd = parseInt($('#q_received_' + row).val());
        var q_used = parseInt($('#q_used_' + row).val());
        var tests_done = parseInt($('#tests_done_' + row).val());
        var loses = parseInt($('#losses_' + row).val());
        var pos_adj = parseInt($('#pos_adj_' + row).val());
        var neg_adj = parseInt($('#neg_adj_' + row).val());
        var closing = b_bal + qty_rcvd - q_used + pos_adj - neg_adj;       
        if((q_used+neg_adj)>(b_bal+qty_rcvd+pos_adj)){
            alert('You cannot use more kits than what you have in Stock. Please check your computations again');
            $('#b_balance_' + row).css('border-color','red'); 
            $('#q_received_' + row).css('border-color','red'); 
            $('#q_used_' + row).css('border-color','red'); 
            $('#tests_done_' + row).css('border-color','red'); 
            $('#losses_' + row).css('border-color','red'); 
            $('#pos_adj_' + row).css('border-color','red'); 
            $('#neg_adj_' + row).css('border-color','red'); 
            $('#physical_count_' + row).css('border-color','red'); 
            hide_save();
        }else{
            $('#b_balance_' + row).css('border-color',''); 
            $('#q_received_' + row).css('border-color',''); 
            $('#q_used_' + row).css('border-color',''); 
            $('#tests_done_' + row).css('border-color',''); 
            $('#losses_' + row).css('border-color',''); 
            $('#pos_adj_' + row).css('border-color',''); 
            $('#neg_adj_' + row).css('border-color',''); 
            $('#physical_count_' + row).css('border-color',''); 
            $('#physical_count_' + row).val(closing);
            show_save();
        }
    }  

    function hide_save() {
        $('#validate').show();
        $('#validate').html('NOTE: Please Correct all Input Fields with red border to Activate the Update Button');                                         
        $('#validate').css('font-size','13px'); 
        $('#validate').css('color','red'); 
        $('#save1').hide();
    }
    function show_save() {
        $('#validate').hide();       
        $('#save1').show();
    }


$('#save1')
.button()
.click(function() {               
    $('#message').html('The Report is Being Updated. Please Wait...');                                         
    $('#message').css('font-size','13px');                                         
    $('#message').css('color','green'); 
    $(this).hide();

});
$("#dialog").dialog({
    height: 140,
    modal: true
});

});


</script>
<style type="text/css">
    input{
        width: 70px;
    }
    #fixed-alert{
        height: 24px;
        background-color: #EEE;
        color: rgb(255, 166, 166);
        text-shadow: 0.5px 0.51px #949292;
        margin-bottom: 10px;
        position: fixed;
        top: 104px;
        width: 100%;
        padding: 10px 0px 0px 13px;
        border-bottom: 1px solid #ccc;
        font-size: 15px;
        text-align: center;
    }
    #banner_text{
        margin-top: 30px;
    }
    #dialog-form{
        margin-top: 30px;
    }
</style>

<?php foreach ($all_details as $detail) {
    $id = $detail['id'];
    $facility_name = $detail['facility_name'];
    $facility_code = $detail['facility_code'];
    $district_id = $detail['district_id'];
    $district = $detail['district'];
    $county = $detail['county'];
    $owner = $detail['owner'];
    $vct = $detail['vct'];
    $pitc = $detail['pitc'];
    $pmtct = $detail['pmtct'];
    $b_screening = $detail['b_screening'];
    $other = $detail['other'];
    $specification = $detail['specification'];
    $rdt_under_tests = $detail['rdt_under_tests'];
    $rdt_under_pos = $detail['rdt_under_pos'];
    $rdt_btwn_tests = $detail['rdt_btwn_tests'];
    $rdt_btwn_pos = $detail['rdt_btwn_pos'];
    $rdt_over_tests = $detail['rdt_over_tests'];
    $rdt_over_pos = $detail['rdt_over_pos'];
    $micro_under_tests = $detail['micro_under_tests'];
    $micro_under_pos = $detail['micro_under_pos'];
    $micro_btwn_tests = $detail['micro_btwn_tests'];
    $micro_btwn_pos = $detail['micro_btwn_pos'];
    $micro_over_tests = $detail['micro_over_tests'];
    $micro_over_pos = $detail['micro_over_pos'];
    $beg_date = $detail['beg_date'];
    $end_date = $detail['end_date'];
    $explanation = $detail['explanation'];
    $moh_642 = $detail['moh_642'];
    $moh_643 = $detail['moh_643'];
    $compiled_by = $detail['compiled_by'];
    $order_date = $detail['order_date'];
//    $phone_no = $detail['telephone'];
    $designation = $this->session->userdata('full_name');
}
    $attributes = array( 'name' => 'myform', 'id'=>'myform');
    echo form_open('rtk_management/update_lab_commodity_orders',$attributes); 
        ?>

<div id="dialog-form" title="Lab Commodities Order Report">

    <form>
        <table id="user_order" width="10%" class="data-table">
            <input  type="hidden" name="facility_name" colspan = "3" style = "color:#000; border:none" value="<?php echo $facility_name ?>"></td>
            <input  type="hidden" name="order_id" colspan = "3" style = "color:#000; border:none" value="<?php echo $order_id ?>"></td>
            <input type="hidden" name="facility_code" colspan = "2" style = "color:#000; border:none" value="<?php echo $facility_code ?>"></td>
            <input type="hidden" name="district_name" colspan = "2" style = "color:#000; border:none" value="<?php echo $district ?>"></td>
            <input type="hidden" name="county" colspan = "3" style = "color:#000; border:none" value="<?php echo $county ?>"></td>

            <tr><td style = "text-align:left"><b>Name of Facility:</b></td>
                        <td colspan = "2"><?php echo $facility_name?></td>
                        <td colspan = "3" rowspan = "8" style="background: #fff;"></td>
                        <td colspan = "3"><b>Applicable to HIV Test Kits Only</b></td>
                        <td colspan = "3" rowspan = "8" style="background: #fff;"></td>
                        <td colspan = "4" style="text-align:center"><b>Applicable to Malaria Testing Only</b></td>

                    </tr>
                    <tr ><td colspan = "2" style = "text-align:left"><b>MFL Code:</b></td>
                        <td><?php echo $facility_code?></td>
                        <td colspan = "2" style="text-align:center"><b>Type of Service</b></td>
                        <td colspan = "1" style="text-align:center"><b>No. of Tests Done</b></td>                   
                        <td colspan = "1"><b>Test</b></td>
                        <td colspan = "1"><b>Category</b></td>
                        <td colspan = "1"><b>No. of Tests Performed</b></td>
                        <td colspan = "1"><b>No. Positive</b></td>                          
                    </tr>
                    <tr><td colspan = "2" style = "text-align:left"><b>District:</b></td>
                        <td><?php echo $district?></td>
                        <td colspan = "2"><b>VCT</b></td>
                        <td><input class='user2'class='user2' id="vct" name="vct" colspan = "2" style = "color:#000" value="<?php echo $vct?>"/></td>                   
                        <td rowspan = "3">RDT</td>
                        <td style = "text-align:left">Patients&nbsp;<u>under</u> 5&nbsp;years</td>
                        <td><input class='user2'id="rdt_under_tests" name="rdt_under_tests" size="10" type="text" value="<?php echo $rdt_under_tests?>"/></td>
                        <td><input class='user2'id="rdt_under_positive" name="rdt_under_positive" size="10" type="text" value="<?php echo $rdt_under_pos?>"/></td>                          
                    
                        </tr>
                    <tr><td colspan = "2" style = "text-align:left"><b>County:</b></td>                     
                        <td><?php echo $county?></td>
                        <td colspan = "2"><b>PITC</b></td>
                        <td><input class='user2'class='user2' id="pitc" name="pitc" colspan = "2" style = "color:#000" value="<?php echo $pitc?>"/></td>                    
                        <td style = "text-align:left">Patients&nbsp;aged 5-14&nbsp;yrs</td>
                        <td><input class='user2'id="rdt_to_tests" name="rdt_to_tests" size="10" type="text" value="<?php echo $rdt_btwn_tests?>"/></td>
                        <td><input class='user2'id="rdt_to_positive" name="rdt_to_positive" size="10" type="text" value="<?php echo $rdt_btwn_pos?>"/></td>
                        </tr>
                    <tr><td colspan = "2" style = "text-align:left"><b>Affiliation:</b></td>    
                        <td><?php echo $owner?></td>
                        <td colspan = "2"><b>PMTCT</b></td>
                        <td><input class='user2'class='user2' id="pmtct" name="pmtct" colspan = "2" style = "color:#000" value="<?php echo $pmtct?>"/></td>                 
                        <td style = "text-align:left">Patients&nbsp;<u>over</u> 14&nbsp;years</td>
                        <td><input class='user2'id="rdt_over_tests" name="rdt_over_tests" size="10" type="text" value="<?php echo $rdt_over_tests?>"/></td>
                        <td><input class='user2'id="rdt_over_positive" name="rdt_over_positive" size="10" type="text" value="<?php echo $rdt_over_pos?>"/></td>
                        
                        </tr>
                    <tr><td colspan = "2" style = "text-align:right"><b>Beginning:</b></td> 
                        <td><input class='my_date'id="begin_date" name="begin_date" colspan = "2" size="10" type="text" value="<?php echo $beg_date?>"/></td>
                        <td colspan = "2"><b>Blood&nbsp;Screening</b></td>
                        <td><input class='user2'class='user2' id="blood_screening" name="blood_screening" colspan = "2" style = "color:#000" value="<?php echo $b_screening?>"/></td>                   
                        <td rowspan = "3">Microscopy</td>
                        <td style = "text-align:left">Patients&nbsp;<u>under</u> 5&nbsp;years</td>
                        <td><input class='user2'id="micro_under_tests" name="micro_under_tests" size="10" type="text" value="<?php echo $micro_under_tests?>"/></td>
                        <td><input class='user2'id="micro_under_positive" name="micro_under_positive" size="10" type="text" value="<?php echo $micro_under_pos?>"/></td>                            
                    </tr>
                    <tr><td colspan = "2" style = "text-align:right"><b>Ending:</b></td>
                        <td><input class='my_date'id="end_date" name="end_date" colspan = "2" size="10" type="text" value="<?php echo $end_date?>"/></td>
                        <td colspan = "2"><b>Other&nbsp;(Please&nbsp;Specify)</b></td>
                        <td><input class='user2'class='user2' id="other2" name="other2" colspan = "2" style = "color:#000" value="<?php echo $other?>"/></td>                       
                        <td style = "text-align:left">Patients&nbsp;aged 5-14&nbsp;yrs</td>
                        <td><input class='user2'id="micro_to_tests" name="micro_to_tests" size="10" type="text" value="<?php echo $micro_btwn_tests?>"/></td>
                        <td><input class='user2'id="micro_to_positive" name="micro_to_positive" size="10" type="text" value="<?php echo $micro_btwn_pos?>"/></td>
                        </tr>
                    <tr><td colspan = "3"></td>
                            <td colspan = "2"><b>Specify&nbsp;Here:</b></td>
                            <td><input class='user2'class='user2' id="specification" name="specification" colspan = "2" style = "color:#000" value="<?php echo $specification?>"/></td>                         
                            <td style = "text-align:left">Patients&nbsp;<u>over</u> 14&nbsp;years</td>
                            <td><input class='user2'id="micro_over_tests" name="micro_over_tests" size="10" type="text" value="<?php echo $micro_over_tests?>"/></td>
                            <td><input class='user2'id="micro_over_positive" name="micro_over_positive" size="10" type="text" value="<?php echo $micro_over_pos?>"/></td>
                        </tr>
                <tr>
                        <td colspan = "14" style = "text-align:center;" id="calc">
                            <b>The Ending Balance is Computed as follows: </b><i>Beginning Balance + Quantity Received + Positive Adjustments - Quantity Used - Negative Adjustments</i> 
                            <b><br/>Note:</b>
                            The Quantity Used Should Not be Less than the Tests Done
                        </td>            
                    </tr>
                <tr><td colspan = "14"></td></tr>
                <tr >       
                    <td rowspan = "2" colspan = "2"><b>Category</b></td>
                    <td rowspan = "2" colspan = "2"><b>Commodity Name</b></td>
                    <td rowspan = "2"><b>Unit of Issue (e.g. Test)</b></td>
                    <td rowspan = "2"><b>Beginning Balance</b></td>
                    <td rowspan = "2"><b>Quantity Received</b></td>
                    <td rowspan = "2"><b>Quantity Used</b></td>
                    <td rowspan = "2"><b>Number of Tests Done</b></td>
                    <td rowspan = "2"><b>Losses</b></td>
                    <td colspan = "2"><b>Adjustments [indicate if (+) or (-)]</b></td>  
                    <td rowspan = "2"><b>End of Month Physical Count</b></td>
                    <td rowspan = "2"><b>Quantity Expriing in <u>less than</u> 6 Months</b></td>
                    <td rowspan = "2"><b>Days out of Stock</b></td> 
                    <td rowspan = "2"><b>Quantity Requested for&nbsp;Re-Supply</b></td>
                </tr>
                <tr>
                    <td>Positive</td>
                    <td>Negative</td>
                </tr>
                <?php
                $checker = 0;
                // foreach ($lab_categories as $lab_category) {
                    ?>
                    <tr>
                        <td colspan = "14" style = "text-align:left"><b><?php echo $lab_category->category_name; ?></b></td>            
                    </tr>                    
                    <?php foreach ($all_details as $detail) {?>
                        <tr commodity_id="<?php echo $checker ?>"><input type="hidden" id="commodity_id[<?php echo $checker?>]" name="commodity_id[<?php echo $checker?>]" value="<?php echo $detail['commodity_id']; ?>" >
                        <input type="hidden" id="facilityCode" name="facilityCode">
                        <input type="hidden" id="district" name="district" value="<?php echo $district_id; ?>">
                        <input type="hidden" id="unit_of_issue[<?php echo $checker?>]" name = "unit_of_issue[<?php echo $checker?>]" value="<?php echo $detail['unit_of_issue']; ?>">
                        <input type="hidden" id="detail_id[<?php echo $checker?>]" name = "detail_id[<?php echo $checker?>]" value="<?php echo $detail['id']; ?>">
                        <td colspan = "2" style = "text-align:left"><b><?php echo $detail['category_name']; ?></b></td>         
                        <td class="commodity_names" id="commodity_name_<?php echo $checker;?>" colspan = "2" style = "text-align:left"></b><?php echo $detail['commodity_name']; ?></td>
                        <td style = "text-align:center" readonly="readonly"><?php echo $detail['unit_of_issue']; ?></td> 
                        <td><input id="b_balance_<?php echo $checker ?>" name = "b_balance[<?php echo $checker ?>]" class='bbal' size="10" type="text" value="<?php echo $detail['beginning_bal']; ?>" style = "text-align:center"/></td>
                        <td><input id="q_received_<?php echo $checker ?>" name = "q_received[<?php echo $checker ?>]" class='qty_rcvd' size="10" type="text" value="<?php echo $detail['q_received']; ?>" style = "text-align:center"/></td>
                        <td><input id="q_used_<?php echo $checker ?>" name = "q_used[<?php echo $checker ?>]" class='qty_used' size="10" type="text" value="<?php echo $detail['q_used']; ?>" style = "text-align:center"/></td>
                        <td><input id="tests_done_<?php echo $checker ?>" name = "tests_done[<?php echo $checker ?>]" class='tests_done' size="10" value="<?php echo $detail['no_of_tests_done']; ?>" type="text" style = "text-align:center"/></td>
                        <td><input id="losses_<?php echo $checker ?>" name = "losses[<?php echo $checker ?>]" class='loses' size="10" type="text" value="<?php echo $detail['positive_adj']; ?>" style = "text-align:center" /></td>
                        <td><input id="pos_adj_<?php echo $checker ?>" name = "pos_adj[<?php echo $checker ?>]" class='pos_adj' size="10" type="text" value="<?php echo $detail['positive_adj']; ?>" style = "text-align:center"/></td>  
                        <td><input id="neg_adj_<?php echo $checker ?>" name = "neg_adj[<?php echo $checker ?>]" class='neg_adj' size="10" type="text" value="<?php echo $detail['negative_adj']; ?>" style = "text-align:center"/></td>
                        <td><input id="physical_count_<?php echo $checker ?>"  name = "physical_count[<?php echo $checker ?>]" class='phys_count' value="<?php echo $detail['closing_stock']; ?>" size="10" type="text" style = "text-align:center"/></td>
                        <td><input id="q_expiring_<?php echo $checker ?>" name = "q_expiring[<?php echo $checker ?>]" class='user2' size="10" type="text" style = "text-align:center" value="<?php echo $detail['q_expiring']; ?>"/></td>
                        <td><input id="days_out_of_stock_<?php echo $checker ?>" name = "days_out_of_stock[<?php echo $checker ?>]" class='user2' size="10" type="text" style = "text-align:center" value="<?php echo $detail['days_out_of_stock']; ?>"/></td>  
                        <td><input id="q_requested_<?php echo $checker ?>" name = "q_requested[<?php echo $checker ?>]" class='user2' size="10" type="text" style = "text-align:center" value="<?php echo $detail['q_requested']; ?>"/></td>                  
                    </tr>
                    <?php $checker++;
               // }
            }
            ?>
            <tr>
                <td colspan = "14"><br/></td>
            </tr>
            </tr>
<tr>                    
                        <td colspan = "16" style = "text-align:left">Explain Losses and Adjustments:</td>
                    </tr>
<tr>                    
                        <td colspan = "16"><input colspan = "16" id="explanation" name="explanation" size="210" type="text" value="<?php echo $explanation?>" style=" width: 90%;"/></td>
                    
                    </tr>
                    <tr></tr>
<tr>
                        
                        <td colspan = "4" style = "text-align:left"><b>Order for Extra LMIS tools:<br/> To be requested only when your data collection or reporting tools are nearly full. Indicate quantity required for each tool type.</b></td>
                        <td colspan = "4"><b>(1) Daily Activity Register for Laboratory Reagents and Consumables (MOH 642):</b></td>
                        <td colspan = "2"><input class='user2' id="moh_642" name="moh_642" size="10" type="text" value="<?php echo $moh_642?>"/></td>
                        <td colspan = "4"><b>(2) F-CDRR for Laboratory Commodities (MOH 643):</b></td>
                        <td colspan = "2"><input class='user2' id="moh_643" name="moh_643" size="10" type="text" value="<?php echo $moh_643?>"/></td>
                    </tr>
<tr>                    <td colspan = "4" style = "text-align:left">Compiled by: <?php echo $compiled_by?><input name="compiled_by" value ="<?php echo $compiled_by;?>" /></td>
                        <td colspan = "3" style = "text-align:left">Tel: <?php echo $phone_no?><input name="tel" value ="<?php // cho $phone_no;?>" /></td>
                        <td colspan = "3" style = "text-align:left">Designation: <?php echo $full_name;?><input name="designation" value ="<?php // echo $full_name;?>" /></td>
                        <td colspan = "3" style = "text-align:left">Sign: <?php echo $full_name;?></td>
                        <td colspan = "3" style = "text-align:left">Date: <?php echo $order_date?></td>
                    </tr>

<tr>                    <td colspan = "4" style = "text-align:left">Approved by:</td>
                        <td colspan = "3" style = "text-align:left">Tel:</td>
                        <td colspan = "3" style = "text-align:left">Designation:</td>
                        <td colspan = "3" style = "text-align:left">Sign:</td>
                        <td colspan = "3" style = "text-align:left">Date:</td>
                    </tr>


</table>
<div id="validate" type="text" style="margin-left: 0%; width:600px;color:blue;font-size:120%"></div>
<div id="message" type="text" style="margin-left: 0%; width:200px;color:blue;font-size:120%"></div>
<input class="btn btn-primary" type="submit"   id="save1"  value="Update Order" style="margin-left: 0%; width:100px" ></form>
<?php form_close();?>
</div>

<script type="text/javascript">    
    $("table").tablecloth({
        bordered: true,
        condensed: true,
        striped: true,            
        clean: true,                
    });
    $('#commodity_name_0').append(' <br/>(Old Algorithm)');
    $('#commodity_name_1').append(' <br/>(Old Algorithm)');
    $('#calc').css('color','blue');
    $('#calc').css('text-align','center');
    $('#calc').css('font-size','12px');
</script>

