 <script type="text/javascript" charset="utf-8">
			/* Define two custom functions (asc and desc) for string sorting */
			jQuery.fn.dataTableExt.oSort['string-case-asc']  = function(x,y) {
				return ((x < y) ? -1 : ((x > y) ?  1 : 0));
			};
			
			jQuery.fn.dataTableExt.oSort['string-case-desc'] = function(x,y) {
				return ((x < y) ?  1 : ((x > y) ? -1 : 0));
			};
			
			$(document).ready(function() {
				/* Build the DataTable with third column using our custom sort functions */
				$('#datalist').dataTable( {
			 "bSort": false,
					"bJQueryUI": true,
                   "bPaginate": true,
                  "sDom": '<"H"Tfr>t<"F"ip>',
					"oTableTools": {
			"sSwfPath": "<?php echo base_url(); ?>DataTables-1.9.3/extras/TableTools-2.0.0/media/swf/copy_cvs_xls_pdf.swf"
		}
				} );
			} );
		</script>
		<div class="row">
			<div class="col-md-2">
			</div>
			<div class="col-md-2">
				<a href="<?php echo base_url(); ?>reports/mapping" class="btn btn-success active" role="button">Back</a>
			</div>
		</div>
 <div class="container" style="margin-top: 1%">
      	
        <table  class="table table-hover table-bordered table-update" id="datalist"  >
				<thead style="background-color: white">
				<tr>
				<th>District Name</th>
				<th>MFL No</th>
				<th>Facility Name</th>
				<th>Level</th>
				<th>Type</th>
				<th>Owner</th>
				<th>Date Activated</th>
				</tr>
				</thead>
		<tbody>			   	    
		<?php	foreach($get_facility_data as $detail):
			     $facility_district = $detail['district'];
				 $facility_code = $detail['facility_code'];							
				 $facility_name = $detail['facility_name'];
				 $level= $detail['level'];
				 $type= $detail['type'];
				 $owner = $detail['owner'];
				 $facility_activation_date = $detail['date'] ;?>
				 <tr><td><?php echo $facility_district ;?></td>
				 <td><?php echo $facility_code ;?></td>
				 <td><?php echo $facility_name ;?></td>
				 <td><?php echo $level ;?></td>
				 <td><?php echo $type ;?></td>
				 <td><?php echo $owner;?></td>
				 <td><?php echo $facility_activation_date ;?></td>
				 </td></tr><?php endforeach;?>
				 </tbody></table>
      </div>