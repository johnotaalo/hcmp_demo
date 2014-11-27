<div style="min-height: 400px;" id="reports_display">
   <table  class="table table-hover table-bordered table-update" id="potential_exp_datatable2" >
  <thead style="background-color: white">
  <tr>
    <th>Commodity Description</th>
    <th>Commodity Code </th>
    <th>Batch No Affected</th>
    <th>Manufacturer</th>
    <th>Expiry Date</th>
    <th># Days to Expiry</th>
    <th>Unit size</th>
    <th>Stock Expired (Packs)</th>
    <th>Stock Expired (Units)</th>
    <th>Unit Cost (KSH)</th>
    <th>Total Cost(KSH)</th>
  </tr>
  </thead>
      
    <tbody>
    <?php 
       $total=0;
        foreach ($report_data as $potential_exp ) { 

          foreach($potential_exp->Code as $stock_commodity){
               
                $name=$stock_commodity->commodity_name;
                $commodity_code=$stock_commodity->commodity_code;
                $unitS=$stock_commodity->unit_size; 
                $unitC=$stock_commodity->unit_cost;
                $total_units=$stock_commodity->total_commodity_units;
                $calculated=$potential_exp->initial_quantity;
                $expired_packs=round($calculated/$total_units,1);
                $total_exp_cost=  $expired_packs*$unitC;             
                $formatdate = new DateTime($potential_exp->expiry_date);
                $formated_date= $formatdate->format('d M Y');
				$ts1 = strtotime(date('d M Y'));
                $ts2 = strtotime(date($potential_exp->expiry_date));
                $seconds_diff = $ts2 - $ts1;
				$total=$total+ $total_exp_cost;
                ?>       
            <tr>
              <td><?php  echo $name;?> </td>
              <td><?php  echo $commodity_code;?> </td>
              <td><?php  echo $potential_exp->batch_no;?></td>
              <td><?php  echo $potential_exp->manufacture;?> </td>
              <td><?php  echo $formated_date;?> </td>
              <td><?php  echo floor($seconds_diff/3600/24);?> </td>
              <td><?php  echo $unitS;?></td>
              <td><?php  echo $expired_packs; ?></td>
              <td><?php  echo $calculated; ?></td>
              <td><?php  echo $unitC;?></td>
              <td><?php  echo number_format($total_exp_cost, 2, '.', ',');?></td>
            </tr>
          <?php }} echo "<tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>Total</td>
          <td>".number_format($total, 2, '.', ',')."</td></tr>";
          ?>   
   </tbody>
</table>
  </div>
  <script>
      $(document).ready(function () {
	$('.dataTables_filter label input').addClass('form-control');
	$('.dataTables_length label select').addClass('form-control');
$('#exp_datatable,#potential_exp_datatable,#potential_exp_datatable2').dataTable( {
     "sDom": "T lfrtip",
       "sScrollY": "377px",   
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page",
                        "sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
                    },
            "oTableTools": {
                 "aButtons": [
        "copy",
        "print",
        {
          "sExtends":    "collection",
					"sButtonText": 'Save',
					"aButtons":    [ "csv", "xls", "pdf" ]
        }
      ],
      "sSwfPath": "<?php echo base_url(); ?>assets/datatable/media/swf/copy_csv_xls_pdf.swf"
    }
  } ); 

});
    </script>