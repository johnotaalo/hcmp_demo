 <h1 class="page-header" style="margin: 0;font-size: 1.6em;">Potential Expiries <?php echo $district_name.' District Store '.date('Y') ;?></h1>
 <div class="filter" style="width=device; height:auto; ">
<div class="btn-group" data-toggle="buttons">
  <label class="btn btn-primary  btn-xs">
    <input type="radio" name="options" id="3months" class="optioncheck" value="3"> 3 Months
  </label>
  <label class="btn btn-primary btn-xs">
    <input type="radio" name="options" id="6months" checked="checked" class="optioncheck" value="6"> 6 Months
  </label>
  <label class="btn btn-primary btn-xs">
    <input type="radio" name="options" id="1year" class="optioncheck" value="12"> 1 Year
  </label>
</div>
 </div>

<div class="well">
  <div style="min-height: 400px;" id="reports_display">
    <table  class="table table-hover table-bordered table-update" id="potential_exp_datatable" >
  <thead style="background-color: white">
  <tr>
    <th>Commodity Description</th>
    <th>Commodity Code </th>
    <th>Batch No Affected</th>
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
                $name=$potential_exp['commodity_name'];
                $commodity_code=$potential_exp['commodity_name'];
                $unitS=$potential_exp['unit_size'];
                $unitC=$potential_exp['unit_cost'];
                $total_units=$potential_exp['current_balance'];
                $expired_packs=round($total_units,1);
                $total_exp_cost=  $expired_packs*$unitC;             
                $formatdate = new DateTime($potential_exp['expiry_date']);
                $formated_date= $formatdate->format('d M Y');
				$ts1 = strtotime(date('d M Y'));
                $ts2 = strtotime(date($potential_exp['expiry_date']));
                $seconds_diff = $ts2 - $ts1;
				$total=$total+ $total_exp_cost;
                ?>       
            <tr>
              <td><?php  echo $name;?> </td>
              <td><?php  echo $commodity_code;?> </td>
              <td><?php  echo $potential_exp['batch_no'];?></td>
              <td><?php  echo $formated_date;?> </td>
              <td><?php  echo floor($seconds_diff/3600/24);?> </td>
              <td><?php  echo $unitS;?></td>
              <td><?php  echo $expired_packs; ?></td>
              <td><?php  echo $calculated; ?></td>
              <td><?php  echo $unitC;?></td>
              <td><?php  echo number_format($total_exp_cost, 2, '.', ',');?></td>
            </tr>
          <?php } echo "<tr>
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
	
</div>
<script type="text/javascript">
$(document).ready(function() {

  $('.btn').button()

 $(".optioncheck").click(function() {
      
      var div="#reports_display";
      var url = "<?php echo base_url()."reports/potential_exp_process_store/$district_id"?>";
      var data= $(this).val();   
      ajax_post_process_data (url,div,data); 
     
    });

   function ajax_post_process_data (url,div,data){
    var url =url;
     var loading_icon="<?php echo base_url().'assets/img/loader.gif' ?>";
     $.ajax({
          type: "POST",
          data:{'option_selected': data},
          url: url,
          beforeSend: function() {
            $(div).html("");
            
             $(div).html("<img style='margin:20% 0 20% 30%;' src="+loading_icon+">");
            
          },
          success: function(msg) {
          $(div).html("");
           $(div).html(msg);           
          }
        }); 
}
 

});


</script>