<style type="text/css">
.row{
    font-size: 13px;
    font-family: calibri;
}
.user2{width: 40px;}
#example{width: 100% !important;}    
.nav{margin-bottom: 0px;} 
table,.dataTables_info{font-size: 11px;}
#example_filter>input{position: relative !important;margin-top: 1em;}
#example_wrapper>.DTTT_container>a>span{font-size: 10px;}
.DTTT_container{margin-top: 1em;}
#banner_text{width: auto;}
.divide{height: 2em;}
.span12{
    float: left;
    width: 60%;
    font-size: 14px;
    margin-top: 30px;
}

</style>
<link rel="stylesheet" type="text/css" href="http://tableclothjs.com/assets/css/tablecloth.css">
<script src="http://tableclothjs.com/assets/js/jquery.tablesorter.js"></script>
<script src="http://tableclothjs.com/assets/js/jquery.metadata.js"></script>
<script src="http://tableclothjs.com/assets/js/jquery.tablecloth.js"></script>

<script src="http://localhost/HCMP/scripts/bootstrap-typeahead.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $("table").tablecloth({theme: "paper"});

    var mySource = <?php echo $facilities_in_district; ?>;

    $('#typeahead').typeahead({
        source: mySource,
        display: 'facility_name',
        KeyVal: 'facility_code'
    });

});


</script>

<script type="text/javascript">
$(function(){
    $('#edit_facility').click(function(){
       $('.modal').modal('show');
   })

    $('#update_facility_btn').click(function(){
      var facilityname = $('#facilityname').val();      
      var district = $('#district').val();
      var facility_code = $('#facility_code').val();
      $.post( "<?php echo base_url().'rtk_management/update_facility_county';?>", { 
        facilityname: facilityname,
        facility_code: facility_code,        
        district: district
    })
      .done(function( data ) {
    //alert( "Success : " + data );
  //$('#edit_facility').modal('hide');
//window.location = "<?php echo base_url().'rtk_management/county_admin/facilities';?>";
});
      


  })

});
</script>




<div class="row">
    <div class="span4">

        <ul class="nav nav-tabs nav-stacked">
            <!--            <li><a href="<?php echo base_url() . 'rtk_management/county_profile/' . $county_id; ?>"><?php echo $facility_county; ?></a></li>-->
            <li><a href="<?php echo base_url() . 'rtk_management/district_profile/' . $district_id; ?>"><?php echo $facility_district; ?></a></li>
            <li class="active"><a href="#"><?php echo $banner_text; ?></a></li>
            <li class="active"><a href="#" data-target="#Edit_Facility" data-toggle="modal">Edit Facility</a></li>
            <li><a>
                <input class="form-control" id="typeahead" type="text" data-items="5" value="" placeholder="Search Facility">
            </a></li>

        </ul>
    </div>
    <div class="span12">
        <div class="accordion" id="accordion2">

            <?php foreach ($reports as $key => $value) { ?>
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#report-<?php echo $value['id']; ?>">
                        <?php echo $value['facility_name'] . ' ( ' . $value['district'] . ', ' . $value['county'] . ')'; ?> Summary Report for <?php echo date('F, Y', strtotime('-1 Month',strtotime($value['order_date'])) ); ?> Compiled by <?php echo($value['compiled_by']); ?>
                    </a>
                </div>
                <div id="report-<?php echo $value['id']; ?>" class="accordion-body collapse" style="height: 0px;">
                    <div class="accordion-inner">
                        <table class="table" style="font-size:12px;">
                            <thead>
                                <tr>
                                    <th>Kit</th>
                                    <th> AMC </th>
                                    <th>Beginning Balance</th>
                                    <th>Received Quantity</th>
                                    <th>Used Total</th>
                                    <th>Total Tests</th>
                                    <th>Positive Adjustments</th>
                                    <th>Negative Adjustments</th>
                                    <th>Losses</th>
                                    <th>Closing Balance</th>
                                    <th>Requested</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Determine</td>
                                    <td><?php echo $value[0][0]['amc']; ?></td>
                                    <td><?php echo $value[0][0]['beginning_bal']; ?></td>
                                    <td><?php echo $value[0][0]['q_received']; ?></td>
                                    <td><?php echo $value[0][0]['q_used']; ?></td>
                                    <td><?php echo $value[0][0]['no_of_tests_done']; ?></td>
                                    <td><?php echo $value[0][0]['positive_adj']; ?></td>
                                    <td><?php echo $value[0][0]['negative_adj']; ?></td>
                                    <td><?php echo $value[0][0]['losses']; ?></td>
                                    <td><?php echo $value[0][0]['closing_stock']; ?></td>
                                    <td><?php echo $value[0][0]['q_requested']; ?></td>
                                </tr>
                                <tr>
                                    <td>Unigold</td>

                                    <td><?php echo $value[0][1]['amc']; ?></td>
                                    <td><?php echo $value[0][1]['beginning_bal']; ?></td>
                                    <td><?php echo $value[0][1]['q_received']; ?></td>
                                    <td><?php echo $value[0][1]['q_used']; ?></td>
                                    <td><?php echo $value[0][1]['no_of_tests_done']; ?></td>
                                    <td><?php echo $value[0][1]['positive_adj']; ?></td>
                                    <td><?php echo $value[0][1]['negative_adj']; ?></td>
                                    <td><?php echo $value[0][1]['losses']; ?></td>
                                    <td><?php echo $value[0][1]['closing_stock']; ?></td>
                                    <td><?php echo $value[0][1]['q_requested']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>
    </div>
</div>


<!--Update the Facility -->
<script type="text/javascript">
$(document).ready( function () {
 $('#facilities_tlb').dataTable(); 

// functions may apply here


})
</script>



<div class="modal fade" id="Edit_Facility" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Facility</h4>
    </div>
    <div class="modal-body">       
        <form id="update_facility_form" method="POST" action="<?php echo base_url().'rtk_management/update_facility_county';?>">                        
            <h4>Facility Name: </h4>
            <p> <input type="text" name="facilityname" class="form-control" id="facilityname" value="<?php echo $facility_name ;?>"/></p>            
            <h4>Sub-County </h4>            
            <select name="district" id="district" class="form-control">
                <option value="<?php echo $district_id; ?>";> -- <?php echo $facility_district; ?> --</option>
                <?php 
                foreach ($districts as $dists) { ?>
                <option value="<?php echo $dists['id']; ?>"><?php echo $dists['district']; ?></option>
                <?php }?>
            </select>
            <p> <input type="hidden" class="form-control" name="facility_code" id="facility_code" value="<?php echo $mfl ;?>" /></p>
            <hr>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button id="update_facility_btn" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div> 
