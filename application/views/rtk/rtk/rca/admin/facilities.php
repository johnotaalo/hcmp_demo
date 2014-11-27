 
<?php 

$dist = array();
$json_dist = "";

foreach ($districts as $districts_arr) {
  $id = $districts_arr['id'];
  $district = $districts_arr['district'];

$district_arr = array($id => $district);
array_push($dist, $districts_arr);
//array_push($dist, $id);


}

$json_dist = json_encode($dist);
$json_dist = substr($json_dist,0, -1);
$json_dist = substr($json_dist, 1);
$json_dist = str_replace('"', "'", $json_dist);
$json_dist = str_replace('{', "", $json_dist);
$json_dist = str_replace('}', "", $json_dist);
//echo $json_dist;

//{"199":"Gilgil"},{"200":"Kuresoi"},{"201":"Molo"},{"202":"Naivasha"},{"203":"Nakuru"},{"204":"Nakuru North"},{"205":"Njoro"},{"206":"Rongai"},{"207":"Subukia"}]
?>
<style>
#facilities_tlb_paginate{
font-size: 13px;
float: right;
padding:4px;
margin-top: 15px;
}
#facilities_tlb_info{
font-size: 15px; 
margin-left: 4%;
float: left;
}
#facilities_tlb_length{
  margin-left: 4%;
  float: left;
}
#facilities_tlb_filter{
  float: right;
}
.pagination{
  margin-top: 20px;
}
table{
  font-size: 12px;
}
</style>

<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablesorter.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.metadata.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablecloth.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/tablecloth/assets/css/tablecloth.css">
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/datatable/jquery.dataTables.js"></script>

 

  <script type="text/javascript">

           
    $(document).ready(function() {
        
       $("table").tablecloth({theme: "paper",         
          bordered: true,
          condensed: true,
          striped: true,
          sortable: true,
          clean: true,
          cleanElements: "th td",
          customClass: "data-table"
        });

        
    });
</script>
<script type="text/javascript">
  $(document).ready( function () {
   $('#facilities_tlb').dataTable(); 

// functions may apply here
function update_rtk(val){
  alert(val);
}

  })
</script>


<!-- Button to trigger modal -->
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#Add_Facility">Add Facility</button>
<!--a href="#Add_Facility" role="button" class="btn" data-toggle="modal">Add Facility</a-->
<hr />
<div class="modal fade" id="Add_Facility" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Facility</h4>
      </div>
      <div class="modal-body">
        <p></p>
        <form id="add_facility_form"> 
            <div class="modal-body">
                            <h5>Facility Name: </h5>
                            <form id="add_facility" method="POST" action="">
                            <p> <input class="form-control" type="text" name="facilityname" id="facilityname" /></p>
                            <h5>Facility MFL Code: </h5>
                            <p> <input type="text" class="form-control" name="facilitycode" id="facilitycode" /></p>
                            <h5>Facility Owner: </h5>
                            <p> <input type="text" class="form-control" name="facilityowner" id="facilityowner" /></p>
                            <h5>Facility type: </h5>
                            <p> <input type="text" class="form-control" name="facilitytype" id="facilitytype" /></p>

                            <select name="district" id="district" class="form-control">
                              <option> -- Select Sub-County --</option>
                              <?php foreach ($districts as $dists) { ?>
                              <option value="<?php echo $dists['id']; ?>"><?php echo $dists['district']; ?></option>
                              <?php }?>
                            </select>
                            <hr>
                        </div>
        </form>

    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="save_facility" class="btn btn-primary">Save Changes</button>
      </div>
    </div>
  </div>
</div>

<table class="data-table" id="facilities_tlb">

  <thead>
<th>MFL Code</th>
    <th>Name</th>
    <th>Owner</th>
    <th>County</th>
    <th>Sub-County</th>
    <th>Reporting Status</th>
    <th>Action</th>
   </thead>
  <tbody>
<?php foreach ($facilities as $row) { 
   $code =$row['facility_code'];
   ?>
    <tr id="<?php echo $row['facil_id'];?>">    
    <td><?php echo $code; ?></td>
    <td><?php echo $row['facility_name'];?></td>
    <td><?php echo $row['owner'];?></td>
    <td><?php echo $county;?></td>    
    <td><?php echo $row['districtname'];?></td>
    <td><?php if($row['rtk_enabled']==0)
    {

      echo "Non-Reporting";
      echo ' <a href="../../rtk_management/activate_facility/' . $row['facility_code'] . '" title="Add"><span class="glyphicon glyphicon-plus"></span> </i></a>';


    }
    else
      {
        echo "Reporting";
        echo ' <a href="../../rtk_management/deactivate_facility/' . $row['facility_code'] . '" title="Remove"><span class="glyphicon glyphicon-minus"></span> </i></a>';
      }?></td>

  <td><?php if($row['rtk_enabled']==0)
    {      
      echo 'N/A';


    }
    else
      {        
        echo ' <a href="../../rtk_management/facility_profile/' . $code. '">View</a>';
      }?></td>
  </tr>
  <?php }?>
  </tbody>

</table>
<script type="text/javascript">
   $(function(){

    $('#save_facility').click(function(){
      var facilityname = $('#facilityname').val();
      var facilitycode = $('#facilitycode').val();
      var facilityowner = $('#facilityowner').val();
      var facilitytype = $('#facilitytype').val();
      var district = $('#district').val();

      $.post( "<?php echo base_url().'rtk_management/create_facility_county';?>", { 
        facilityname: facilityname,
        facilitycode: facilitycode,
        facilityowner: facilityowner,
        facilitytype: facilitytype,
        district: district
      })
  .done(function( data ) {   
$('#Add_DMLT').modal('hide');
window.location = "<?php echo base_url().'rtk_management/county_admin/facilities';?>";
  });
      


})

   });
</script>