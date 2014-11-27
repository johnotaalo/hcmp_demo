<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/unit_size.js"></script>
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
    .user2{
        width:70px;

        text-align: center;
    }
    .col5{background:#D8D8D8;}
</style>
<script type="text/javascript">
    $(function() {
        jQuery(document).ready(function() {

            $("#begin_date").datepicker({
                defaultDate: "",
                changeMonth: true,
                changeYear: true,
                numberOfMonths: 1,
                // onClose : function(selectedDate) {
                // 	$("#end_date").datepicker("option", "minDate", selectedDate);
                // }
            });
            $("#end_date").datepicker({
                defaultDate: "",
                changeMonth: true,
                changeYear: true,
                numberOfMonths: 1,
                // onClose : function(selectedDate) {
                // 	$("#begin_date").datepicker("option", "minDate", selectedDate);
                // }
            });
        });


        $('#save1')
                .button()
                .click(function() {

            $('#myform').submit();
        });

    });


</script>

<?php



$orderid = $order_id;
 
foreach ($all_details as $detail) {
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
?>
<style>
    .converts{
        
    }
    .converts:hover{
        color: #fff;
    }
</style>
<div style="height: 71px;
display: block;
float: right;
margin-right: 35px;
background: #F1F1F1;
padding: 8px;">
    <div  class ="converts"  style="width:40px; float: left;padding-right: 23px;">
        <a href="<?php echo site_url('rtk_management/get_lab_report/' . $this->uri->segment(3) . '/excel'); ?>">
        <img src="<?php echo site_url('images/excel-icon.jpg'); ?>" />
        <h3> Download Excel</a></h3></div>

    <div  class ="converts" style="width:40px; float: left;padding-right: 14px;">
        <a href="<?php echo site_url('rtk_management/get_lab_report/' . $this->uri->segment(3) . '/pdf'); ?>"> 
        <img src="<?php echo site_url('images/pdf-icon.jpg'); ?>" />
        <h3>Download PDF</a></h3></div>

</div>

<?php $attributes = array('name' => 'myform', 'id' => 'myform');
echo form_open('rtk_management/edit_lab_order_details/' . $orderid, $attributes);
?>

<div id="dialog-form" title="Lab Commodities Order Report">
    <form>
        <?php
//        $d = new DateTime('2010-01-08');
  //      $d->modify($order['order_date']);
    //    $english_date = $d->format('D dS M Y');
        ?>
        <table id="user_order" width="90%" class="data-table">		
            <tr><td style = "text-align:left"><b>Name of Facility:</b></td>
                <td colspan = "2"><?php echo $facility_name ?></td>
                <td colspan = "3" rowspan = "8" style ="background: #fff;"></td>
                <td colspan = "3"><b>Applicable to HIV Test Kits Only</b></td>
                <td colspan = "3" rowspan = "8" style ="background: #fff;"></td>
                <td colspan = "4" style="text-align:center"><b>Applicable to Malaria Testing Only</b></td>
              
            </tr>
            <tr ><td colspan = "2" style = "text-align:left"><b>MFL Code:</b></td>
                <td><?php echo $facility_code ?></td>
                <td colspan = "2" style="text-align:center"><b>Type of Service</b></td>
                <td colspan = "1" style="text-align:center"><b>No. of Tests Done</b></td>
                <td colspan = "1"><b>Test</b></td>
                <td colspan = "1"><b>Category</b></td>
                <td colspan = "1"><b>No. of Tests Performed</b></td>
                <td colspan = "1"><b>No. Positive</b></td>							
            </tr>
            <tr><td colspan = "2" style = "text-align:left"><b>District:</b></td>
                <td><?php echo $district ?></td>
                <td colspan = "2"><b>VCT</b></td>
                <td style="text-align:center;"><?php echo $vct ?></td>
                <td rowspan = "3">RDT</td>
                <td style = "text-align:left">Patients&nbsp;<u>under</u> 5&nbsp;years</td>
            <td style="text-align:center;"><?php echo $rdt_under_tests ?></td>
            <td style="text-align:center;"><?php echo $rdt_under_pos ?></td>
            </tr>
            <tr><td colspan = "2" style = "text-align:left"><b>County:</b></td>						
                <td><?php echo $county ?></td>
                <td colspan = "2"><b>PITC</b></td>
                <td style="text-align:center;"><?php echo $pitc ?></td>
                <td style = "text-align:left">Patients&nbsp;aged 5-14&nbsp;yrs</td>
                <td style="text-align:center;"><?php echo $rdt_btwn_tests ?></td>
                <td style="text-align:center;"><?php echo $rdt_btwn_pos ?></td>
            </tr>
            <tr><td colspan = "2" style = "text-align:left"><b>Affiliation:</b></td>	
                <td><?php echo $owner ?></td>
                <td colspan = "2"><b>PMTCT</b></td>
                <td style="text-align:center;"><?php echo $pmtct ?></td>
                <td style = "text-align:left">Patients&nbsp;<u>over</u> 14&nbsp;years</td>
            <td style="text-align:center;"><?php echo $rdt_over_tests ?></td>
            <td style="text-align:center;"><?php echo $rdt_over_pos ?></td>

            </tr>
            <tr><td colspan = "2" style = "text-align:right"><b>Beginning:</b></td>	
                <td style="text-align:center;"><?php echo $beg_date ?></td>
                <td colspan = "2"><b>Blood&nbsp;Screening</b></td>
                <td style="text-align:center;""2" style = "color:#000"><?php echo $b_screening ?></td>
                <td rowspan = "3">Microscopy</td>
                <td style = "text-align:left">Patients&nbsp;<u>under</u> 5&nbsp;years</td>
            <td style="text-align:center;"><?php echo $micro_under_tests ?></td>
            <td style="text-align:center;"><?php echo $micro_under_pos ?></td>
            </tr>
            <tr><td colspan = "2" style = "text-align:right"><b>Ending:</b></td>
                <td style="text-align:center;"><?php echo $end_date ?></td>
                <td colspan = "2"><b>Other&nbsp;(Please&nbsp;Specify)</b></td>
                <td style="text-align:center;"><?php echo $other ?></td>
                <td style = "text-align:left">Patients&nbsp;aged 5-14&nbsp;yrs</td>
                <td style="text-align:center;"><?php echo $micro_btwn_tests ?></td>
                <td style="text-align:center;"><?php echo $micro_btwn_pos ?></td>
            </tr>
            <tr><td colspan = "3"></td>
                <td colspan = "2"><b>Specify&nbsp;Here:</b></td>
                <td style="text-align:center;"><?php echo $specification ?></td>
                <td style = "text-align:left">Patients&nbsp;<u>over</u> 14&nbsp;years</td>
            <td style="text-align:center;"><?php echo $micro_over_tests ?></td>
            <td style="text-align:center;"><?php echo $micro_over_pos ?></td>
            </tr>

            <tr></tr>
            <tr > 				<th rowspan = "2" colspan = "2" style = "text-align:center;font-size:12"><b>Category Name</b></th>
                <th rowspan = "2" colspan = "2" style = "text-align:center;font-size:12"><b>Commodity Name</b></th>
                <th rowspan = "2" style = "text-align:center;font-size:12"><b>Unit of Issue (e.g. Test)</b></th>
                <th rowspan = "2" style = "text-align:center;font-size:12"><b>Beginning Balance</b></th>
                <th rowspan = "2" style = "text-align:center;font-size:12"><b>Quantity Received</b></th>
                <th rowspan = "2" style = "text-align:center;font-size:12"><b>Quantity Used</b></th>
                <th rowspan = "2" style = "text-align:center;font-size:12"><b>Number of Tests Done</b></th>
                <th rowspan = "2" style = "text-align:center;font-size:12"><b>Losses</b></th>
                <th colspan = "2" style = "text-align:center;font-size:12"><b>Adjustments [indicate if (+) or (-)]</b></th>	
                <th rowspan = "2" style = "text-align:center;font-size:12"><b>End of Month Physical Count</b></th>
                <th rowspan = "2" style = "text-align:center;font-size:12"><b>Quantity Expiring in <u>less than</u> 6 Months</b></th>
                <th rowspan = "2" style = "text-align:center;font-size:12"><b>Days out of Stock</b></th>	
                <th rowspan = "2" style = "text-align:center;font-size:12"><b>Quantity Requested for&nbsp;Re-Supply</b></th>
            </tr>
            <tr>
                <th style = "text-align:center">Positive</th>
                <th style = "text-align:center">Negative</th>
            </tr>
<?php $checker = 0;
foreach ($all_details as $detail) {
    ?>
                <tr>
                    <td colspan = "2" style = "text-align:left"><b><?php echo $detail['category_name']; ?></b></td>		    
                    <td colspan = "2" style = "text-align:left"></b><?php echo $detail['commodity_name']; ?></td>
                    <td style = "text-align:center"><?php echo $detail['unit_of_issue']; ?></td>
                    <td style = "text-align:center"><?php echo $detail['beginning_bal']; ?></td>
                    <td style = "text-align:center"><?php echo $detail['q_received']; ?></td>
                    <td style = "text-align:center"><?php echo $detail['q_used']; ?></td>
                    <td style = "text-align:center"><?php echo $detail['no_of_tests_done']; ?></td>
                    <td style = "text-align:center"><?php echo $detail['losses']; ?></td>
                    <td style = "text-align:center"><?php echo $detail['positive_adj']; ?></td>
                    <td style = "text-align:center"><?php echo $detail['negative_adj']; ?></td>
                    <td style = "text-align:center"><?php echo $detail['closing_stock']; ?></td>
                    <td style = "text-align:center"><?php echo $detail['q_expiring']; ?></td>
                    <td style = "text-align:center"><?php echo $detail['days_out_of_stock']; ?></td>	
                    <td style = "text-align:center"><?php echo $detail['q_requested']; ?></td>
                </tr>
    <?php $checker++;
}
?>
            <tr>
                <td colspan = "16"><br/></td>
            </tr>
            <tr>				
                <td colspan = "16" style = "text-align:left">Explain Losses and Adjustments: <?php echo $explanation ?></td>
            </tr>
            <tr>				<td colspan = "4" style = "text-align:left"><b>Order for Extra LMIS tools:<br/> To be requested only when your data collection or reporting tools are nearly full. Indicate quantity required for each tool type.</b></td>
                <td colspan = "4"><b>(1) Daily Activity Register for Laboratory Reagents and Consumables (MOH 642):</b></td>
                <td colspan = "2" style="text-align:center;"><?php echo $moh_642 ?></td>
                <td colspan = "4"><b>(2) F-CDRR for Laboratory Commodities (MOH 643):</b></td>
                <td colspan = "2" style="text-align:center;"><?php echo $moh_643 ?></td>
            </tr>	


            <tr>					<td colspan = "4" style = "text-align:left">Compiled by: <?php echo $compiled_by ?></td>
                <td colspan = "3" style = "text-align:left">Tel: <?php // echo $phone_no ?></td>
                <td colspan = "3" style = "text-align:left">Designation: <?php echo $designation ?></td>
                <td colspan = "3" style = "text-align:left">Sign:</td>
                <td colspan = "3" style = "text-align:left">Date: <?php echo $order_date ?></td>
            </tr>

            <tr>					<td colspan = "4" style = "text-align:left">Approved by:</td>
                <td colspan = "3" style = "text-align:left">Tel:</td>
                <td colspan = "3" style = "text-align:left">Designation:</td>
                <td colspan = "3" style = "text-align:left">Sign:</td>
                <td colspan = "3" style = "text-align:left">Date:</td>
            </tr>


        </table></form>
</div>
<!--<input  class="btn btn-primary" id="save1" name="save1"  value="Edit Order" >-->
<?php form_close(); ?>