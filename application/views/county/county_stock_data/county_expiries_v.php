<SCRIPT LANGUAGE="Javascript" SRC="<?php echo base_url();?>Scripts/FusionCharts/FusionCharts.js"></SCRIPT>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
    <style type="text/css" title="currentStyle">
      
      @import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
.leftpanel{
width: 17%;
height:auto;
float: left;
padding-left: 1em;
}
.multiple_chart_content{
float:left;
box-shadow: 0 0 5px #888888;
border-radius: 5px;
width:98%; 
height:70%; 
padding:0.2em;
margin-top:0.5em;
}

 .dash_main{
    width: 80%;
    min-height:100%;
    height:600px;
    float: left;
       -webkit-box-shadow: 2px 2px 6px #888;
	box-shadow: 2px 2px 6px 2px #888; 
    margin-left:0.75em;
    margin-bottom:0em;
    
    }
.accordion {
margin: 0;
padding:5%;
height:15px;
border-top:#f0f0f0 1px solid;
background: #cccccc;
font:normal 1.3em 'Trebuchet MS',Arial,Sans-Serif;
text-decoration:none;
text-transform:uppercase;
background: #29527b; /* Old browsers */
border-radius: 0.5em;
color: #fff; }
table.data-table {
  margin: 10px auto;
  }
  
table.data-table th {
  color:#036;
  text-align:center;
  font-size: 13.5px;
  max-width: 600px;
  }
table.data-table td, table th {
  padding: 4px;
  }
table.data-table td {
  height: 30px;
  width: 130px;
  font-size: 12.5px;
  margin: 0px;
  }
</style>

<script type="text/javascript">
	$(function() {
		
		$('#expiry,#potential').dataTable( {
					"bJQueryUI": true,
					"bPaginate": false
				} );
		
		//tabs
		$('#tabs').tabs();
		var url = "<?php echo base_url().'report_management/get_costofexpiries_chart_ajax/county/'?>"
		var div="#chart_3";
		
		ajax_request (url,div);	
			function ajax_request (url,div){
	var url =url;
	var loading_icon="<?php echo base_url().'Images/loader.gif' ?>";
	 $.ajax({
          type: "POST",
          url: url,
          beforeSend: function() {
            $(div).html("");
            
             $(div).html("<img style='margin-top:-10%;' src="+loading_icon+">");
            
          },
          success: function(msg) {
          $(div).html("");
            $(div).html(msg);           
          }
        }); 
}

     
    });
       

	
</script>
<?php
  $total_expiry=0;
  $expired_data='';
  $year=date("Y");
  
 foreach($expired2 as $facility_expiry_data):
	 $district=$facility_expiry_data['district'];
	 $name=$facility_expiry_data['facility_name'];
	 $mfl=$facility_expiry_data['facility_code'];
	 $total=$facility_expiry_data['total'];
	 
	 $total_expiry=$total_expiry+$total;
	 $year=date('Y');
	 $total=number_format($total, 2, '.', ',');
	
	 $district_id=$facility_expiry_data['district_id'];
	  $link=base_url()."stock_expiry_management/facility_report_expired/".$mfl;
	  
$expired_data .= <<<HTML_DATA
<tr>
<td>$district</td>
<td>$name</td>
<td>$mfl</td>
<td>$total</td>
<td><a href='$link' class='link'>View</a></td>
</tr>
HTML_DATA;
	 
	 endforeach;
	   $total_expiry=number_format($total_expiry, 2, '.', ',');
	$expired_data .=  <<<HTML_DATA
<tr>
<td></td>
<td></td>
<td>TOTAL for the year $year</td>
<td>$total_expiry</td>
<td></td>
</tr>
HTML_DATA;


$total_potential=0;
$potential_data='';
 foreach($potential_expiries as $facility_potential_expiries_data):
	 $district=$facility_potential_expiries_data['district'];
	 $name=$facility_potential_expiries_data['facility_name'];
	 $mfl=$facility_potential_expiries_data['facility_code'];
	 $total=$facility_potential_expiries_data['total'];
	 $total_potential=$total_potential+ $total;
	 $total=number_format($total, 2, '.', ',');
	 
	 $link=base_url()."stock_expiry_management/default_expiries/".$mfl;
	 
$potential_data .= <<<HTML_DATA
<tr>
<td>$district</td>
<td>$name</td>
<td>$mfl</td>
<td>$total</td>
<td><a href='$link' class='link'>View</a></td>
</tr>
HTML_DATA;
	 
	 endforeach;
	    $total_potential=number_format($total_potential, 2, '.', ',');
	$potential_data .= <<<HTML_DATA
<tr>
<td></td>
<td></td>
<td>TOTAL</td>
<td>$total_potential</td>
<td></td>
</tr>
HTML_DATA;
 

 ?>
<div class="leftpanel">
<h3 class="accordion" id="leftpanel">Expiries<span></span></h3>
<div class='label label-info'>Expired Commodities - Trend <?php echo date("Y"); ?></div>
			<div style="height: 200px">
				<div id="chart_3"></div>	
			</div>
			

</div>

<div class="dash_main" id = "dash_main">
	<div class='label label-info'> Below are commodities which have expired or about to expire in the near futrue</div>

<div id="tabs" class="main">
	<ul>
		<li>
			<a href="#tab-1">Expired Commodities</a>
		</li>
		<li>		
			<a href="#tab-2">Potential Expiries</a>
		</li>		
	</ul>


<div id="tab-1">
<div class='label label-info'>Expired Commodities - Trend <?php echo date("Y")." TOTAL ".$total_expiry; ?></div>
<table width='100%' id='expiry'>
	<thead>
<tr>
	<th>District</th>
	<th>Health Facility</th>
	<th>Mfl No</th>
	<th>Value of Expiries (KSH)</th>
	<th>Action</th>
</tr>
</thead>	
<tbody>
 <?php

 echo $expired_data;
 
 ?>
  
</tbody>		 
</table>

</div>

<div id="tab-2">
	
<div class='label label-info'>Commodities Expiring between <?php echo date('jS F, Y'); ?> and <?php echo date('jS F, Y', strtotime('+6 months'))." TOTAL ".$total_potential ; ?></div>
<table width='100%' id='potential'>
	<thead>
<tr>
	<th>District</th>
	<th>Health Facility</th>
	<th>Mfl No</th>
	<th>Value of Expiries (KSH)</th>
	<th>Action</th>
</tr>
</thead>	
<tbody>
 <?php
  echo $potential_data;
 ?>
  
</tbody>		 
</table>
</div>



</div>

  </div>
