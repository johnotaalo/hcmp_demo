<link rel="stylesheet" type="text/css" href="http://tableclothjs.com/assets/css/tablecloth.css">
<script src="http://tableclothjs.com/assets/js/jquery.tablesorter.js"></script>
<script src="http://tableclothjs.com/assets/js/jquery.metadata.js"></script>
<script src="http://tableclothjs.com/assets/js/jquery.tablecloth.js"></script>



<style>

.dataTables_filter{
  float: right;
}
#pending_facilities_length{
  float: left;  
}
table{
  font-size: 13px;
}


#pending_facilities_paginate{
  font-size: 13px;
  float: right;
  padding:4px;
}
#pending_facilities_info{
  font-size: 15px; 
  float: left;
}

#pending_facilities_filter{
  float: right;
}
.nav li{
  float: left;
  margin-left: 20px;
}
 .DTTT_container{margin-top: 1em;}
    #banner_text{width: auto;}
    .divide{height: 2em;}



</style>
<!--div style="width:100%;font-size: 12px;height:20px;padding: 10px 10px 10px 10px;margin-bottom:10px;" class="navtbl">
    <select id="switch_month" class="form-control" style="max-width: 220px;background-color: #ffffff;border: 1px solid #cccccc;float:left;margin-left:20px;">      
        <?php 

            for ($i=1; $i <=12 ; $i++) { 
            $month = date('m', strtotime("-$i month")); 
            $year = date('Y', strtotime("-$i month")); 
            $month_value = $month.$year;
            $month_text =  date('F', strtotime("-$i month")); 
            $month_text = "-- ".$month_text." ".$year." --";
         ?>
        <option value="<?php echo $month_value ?>"><?php echo $month_text ?></option>;
    <?php } ?>
    </select>
  </div-->
<div style="width:100%;font-size: 12px;height:20px;padding: 10px 10px 10px 10px;margin-bottom:10px;">
  <ul class="navtbl top-navigation nav" style="margin-top:0px;float:left;">        
    <li class=""><a href="#">Zone-A</a></li>
    <li class=""><a href="#">Zone-B</a></li>
    <li class=""><a href="#">Zone-C</a></li>
    <li class=""><a href="#">Zone-D</a></li>
  </ul>
</div>



<div class="main-container" style="width: 100%;float: right;">
	<table id="pending_facilities" class="data-table"> 
		<thead>	      
      <th>County</th>
      <th>Sub-County</th>
			<th>MFL</th>
			<th>Facility Name</th>			
			<th>Zone</th>
			<th>Report For:</th>
		</thead>
		<tbody>
			<?php
      if(count($pending_facility)>0){
       foreach ($pending_facility as $value) {
        $zone = str_replace(' ', '-',$value['zone']);
        $facil = $value['facility_code'];
        ?> 
        <tr>   
          <td><?php echo $value['county'];?></td>
          <td><?php echo $value['district'];?></td>              
          <td><?php echo $value['facility_code'];?></td>
          <td><?php echo $value['facility_name'];?></td>     
          
          <td><?php echo $zone;?></td>
          <td><?php echo $value['report_for'];?></td>
        </tr>
        <?php	}
      }else{ ?>
      <tr>There are No Facilities which did not Report</tr>
      <?php }
      ?>			

    </tbody>
  </table>
</div>
<script>
$(document).ready(function() {
  $("table").tablecloth({theme: "paper",         
          bordered: true,
          condensed: true,
          striped: true,
          sortable: true,
          clean: true,
          cleanElements: "th td",
          customClass: "my-table"
        });
  var table = $('#pending_facilities').dataTable({
    "sDom": "T lfrtip",
    "sScrollY": "377px",
    "sScrollX": "100%",
    "bPaginate": false,
    "oLanguage": {
      "sLengthMenu": "_MENU_ Records per page",
      "sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
    },
    "oTableTools": {
      "aButtons": [      
      "copy",
      "print",
      {
        "sExtends": "collection",
        "sButtonText": 'Save',
        "aButtons": ["csv", "xls", "pdf"]
      }
      ],
      "sSwfPath": "../assets/datatable/media/swf/copy_csv_xls_pdf.swf"
    }
  });

  $("#pending_facilities tfoot th").each(function(i) {
    var select = $('<select><option value=""></option></select>')
    .appendTo($(this).empty())
    .on('change', function() {
      table.column(i)
      .search('^' + $(this).val() + '$', true, false)
      .draw();
    });

    table.column(i).data().unique().sort().each(function(d, j) {
      select.append('<option value="' + d + '">' + d + '</option>')
    });
  });
  $('.navtbl li a').click(function(e) {
    var $this = $(this);
    var thistext = $(this).text();
    $('.navtbl li').removeClass('active');
    $this.parent().addClass('active');
    $(".dataTables_filter label input").focus();
    $('.dataTables_filter label input').val(thistext).trigger($.Event("keyup", {keyCode: 13}));

    e.preventDefault();
  });
  $('#switch_month').change(function() {
            var value = $('#switch_month').val();
            var path = "<?php echo base_url() . 'rtk_management/switch_district/0/allocation_committee/'; ?>" + value + "<?php '/show_allocation_pending/'?>";
            window.location.href = path;
        });

});
</script>

<!--Datatables==========================  --> 
<script src="http://cdn.datatables.net/1.10.0/js/jquery.dataTables.js" type="text/javascript"></script>
<script src="../assets/datatable/jquery.dataTables.min.js" type="text/javascript"></script>  
<script src="../assets/datatable/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="../assets/datatable/TableTools.js" type="text/javascript"></script>
<script src="../assets/datatable/ZeroClipboard.js" type="text/javascript"></script>
<script src="../assets/datatable/dataTables.bootstrapPagination.js" type="text/javascript"></script>
<!-- validation ===================== -->
<script src="../assets/scripts/jquery.validate.min.js" type="text/javascript"></script>



<link href="../assets/boot-strap3/css/bootstrap-responsive.css" type="text/css" rel="stylesheet"/>
<link href="../assets/datatable/TableTools.css" type="text/css" rel="stylesheet"/>
<link href="../assets/datatable/dataTables.bootstrap.css" type="text/css" rel="stylesheet"/>


