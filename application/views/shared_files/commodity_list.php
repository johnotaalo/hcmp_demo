<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url(); ?>DataTables-1.9.3/extras/TableTools-2.0.0/media/js/ZeroClipboard.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url(); ?>DataTables-1.9.3/extras/TableTools-2.0.0/media/js/TableTools.js"></script>
<style type="text/css" title="currentStyle">			
			@import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
			@import "<?php echo base_url(); ?>DataTables-1.9.3/extras/TableTools-2.0.0/media/css/TableTools.css";
		</style>
		<style>
			.warning2 {
	background: #FEFFC8 url('<?php echo base_url()?>Images/excel-icon.jpg') 20px 50% no-repeat;
	border: 1px solid #F1AA2D;
	}
		</style>
<?php $current_year = date('Y');
$earliest_year = $current_year - 10;
?>
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
				$('#example').dataTable( {
			 "bSort": false,
					"bJQueryUI": true,
                   "bPaginate": false,
                  "sDom": '<"H"Tfr>t<"F"ip>',
					"oTableTools": {
			"sSwfPath": "<?php echo base_url(); ?>assets/datatable/extras/TableTools-2.0.0/media/swf/copy_cvs_xls_pdf.swf"
		}
				} );
			} );
		</script>
		
		<div class="tabbable">
			<ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab"><h4>KEMSA</h4></a></li>
    <li><a href="#tab2" data-toggle="tab">Section 2</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab1">
		
		<div style="margin-left: 80%" >
		<a href="<?php echo site_url('report_management/commodity_excel');?>">
			<div class="activity excel"><h2> Download</h2></div>
			</a></div>
			
				<table  style="margin-left: 0;" id="example" width="100%">
					<thead>
					<tr>
						<th><b>Category</b></th>
						<th><b>Description</b></th>
						<th><b>KEMSA Code</b></th>
						<th><b>Order Unit Size</b></th>
						<th><b>Order Unit Cost (KSH) <br> 2012-2013</b></th>				    
					</tr>
					</thead>
					<tbody>
		<?php 
		foreach($drug_categories as $category):?>

					<?php
						foreach($category->Category as $drug):?>
							
						<tr>

							
							<td><?php echo $drug->Category_Name?></td>
							<td><?php echo $category->Drug_Name;?></td>
							<td><?php echo $category->Kemsa_Code;?></td>
							<td> <?php echo $category->Unit_Size;?> </td>
							<td><?php echo $category->Unit_Cost;?> </td>
						</tr>
						
						<?php endforeach;?>
		<?php endforeach;?>
		</tbody>
	
				</table>
				</div>
    <div class="tab-pane" id="tab2">
     
    </div>
  </div>
</div>
 