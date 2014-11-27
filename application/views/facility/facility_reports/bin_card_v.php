 <h1 class="page-header" style="margin: 0;font-size: 1.6em;">Bin Card <?php echo $facility_name.' '.date('Y') ;?></h1>
 <div class="filter" style="width=device; height:auto; ">

<div class="form-inline" role="form">
<div class="form-group">
 <select class="form-control input-sm" id="commodity_select" name="commodity_select" >
<option>Select Commodity</option>
 
    <?php 
    foreach ($commodities as $commodities) {
      $id=$commodities['commodity_id'];
      $kemsa=$commodities['commodity_code'];
      $commodity=$commodities['commodity_name'];
      ?>
      <option value="<?php echo $id; ?>"><?php echo $commodity; ?></option>
      
    <?php } ?> 
 </select>
  
</div>
  <div class="form-group">
    
    <input type="text" class="form-control input-sm" id="from" name="from" placeholder="Start Date">
  </div>
 
  <div class="form-group">
   
    <input type="text" class="form-control input-sm" id="to" name="to" placeholder="End Date">
  </div>
  
  <button type="submit" id="filter" name="filter" class="btn btn-success">Filter <span class="glyphicon glyphicon-filter"></span> </button>
</div>
 </div>

<div class="well">
 <div class="" id="reports_display" style="min-height: 350px;" >
            <div style="margin:auto; text-align: center">
                
                <h2> Please Filter above</h2>
                <h3>
                  If you have selected filters above and you still see this message, You have no Records
                </h3>
                
                </div>
            </div>

	
</div>
<script type="text/javascript">
$(document).ready(function() {
	$( "#from" ).datepicker({
      changeMonth: true,
      numberOfMonths: 2,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
       maxDate: new Date(),
      numberOfMonths: 2,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });

    $("#filter").click(function() {
    	      
      var div="#reports_display";
      var url = "<?php echo base_url()."reports/stock_control_ajax"?>";
      ajax_post_process (url,div);
     
    });

   function ajax_post_process (url,div){
    var url =url;

    var loading_icon="<?php echo base_url().'assets/img/loader.gif' ?>";
     $.ajax({
          type: "POST",
          data:{ 'commodity_select': $('#commodity_select').val(),'from': $('#from').val(),'to': $('#to').val(),
          'commodity_name': $('#commodity_select  option:selected').text()},
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