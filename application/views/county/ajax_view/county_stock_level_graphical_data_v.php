<script>
	$(document).ready(function() {
		<?php $data_response=count(json_decode($category_data));  if($data_response>0): ?>
	   $('#graph_div').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Commodity stock level for <?php $header=""; echo $month." ".$year." ".$county;?>',
                x: -20 //center
            },
             subtitle: {
                text: 'Source: HCMP',
                x: -20
            },
            credits: { enabled:false},
            xAxis: {
                categories: <?php echo $category_data; ?>
            },
            yAxis: {
                title: {
                    text: 'stock level in <?php echo $consumption_option; ?>'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '<?php echo $consumption_option; ?>'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [
            
            <?php  echo "{ name: 'level', data:".$series_data."}"?>
          ]
        });
        <?php else: ?>
		 var loading_icon="<?php echo base_url().'Images/no-record-found.png'; 
		 $header="<br><div align='center' class='label label-info '>Commodity stock level for  $month $year $county</div>" ?>";
		 $("#graph_div").html("<img style='margin-left:20%;' src="+loading_icon+">")
		  <?php endif; ?>
		  
		  
 });
	
</script>
<?php echo $header; ?>
<div id="graph_div"  style="height:100%; width: 100%; margin: 0 auto; float: left"></div>