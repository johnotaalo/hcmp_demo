		<script type="text/javascript">
$(function () {
	<?php $header=""; $total=1;  if($total>0): ?>
        $('#container').highcharts({
            chart: {
            },
         title: {
                text: 'stock expiring in <?php $header=""; echo $county." ".$year;?>',
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
                    text: 'stock expiring in <?php echo $consumption_option; ?>'
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
           <?php  echo "{type: 'spline', name: 'total', data:".$series_data."
            ,marker: {
                	lineWidth: 2,
                	lineColor: Highcharts.getOptions().colors[3],
                	fillColor: 'white'
                } }
           "?>
        ]
        });
        <?php else: ?>
		 var loading_icon="<?php echo base_url().'Images/no-record-found.png'; 
		 $header="<br><div align='center' class='label label-info '>Expiries for $county $year </div>" ?>";
		 $("#container").html("<img style='margin-left:20%;' src="+loading_icon+">")
		  <?php endif; ?>
    });
		</script>
<?php echo $header; ?>
		<div id="container" style="width: 100%; height: 100%; margin: 0 auto"></div>