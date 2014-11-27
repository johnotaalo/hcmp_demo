<script type="text/javascript">
$(function() {
	<?php  $header=""; $data_response=count(json_decode($commodity_name));  if($data_response>0): ?>
        $('#container').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: ''
            },
            xAxis: {
                categories: <?php echo $commodity_name; ?>
            },
            yAxis: {
                min: 0,
                title: {
                    text: ''
                }
            },
            legend: {
                backgroundColor: '#FFFFFF',
                reversed: true
            },
            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
                credits: { enabled:false},
                series: [{
                name: '<?php echo $title_1; ?>',
                data: <?php echo $current_values; ?>
            }, {
                name: '<?php echo $title_2; ?>',
                data: <?php echo $monthly_values; ?>
            }]
        });
          <?php else: ?>
		 var loading_icon="<?php echo base_url().'Images/no-record-found.png'; 
		// $header="<br><div align='center' class='label label-info '>Commodity consumption level for  $month $year $county</div>" ?>";
		 $("#container").html("<img style='margin-left:20%;' src="+loading_icon+">");
		  <?php endif; ?>
    });
    

		</script>

		
		<div id="container"  style="height: <?php echo $height; ?>; width: <?php echo $width; ?>; margin: 0 auto"></div>