<style>
.stat_item {
		height: 48px;
		padding: 2px 20px;
		color: #fff;
		text-align: center;
		font-size: 1.5em;
		-webkit-box-shadow: 3px 0px 5px 0px rgba(51, 50, 50, 0.59);
-moz-box-shadow:    3px 0px 5px 0px rgba(51, 50, 50, 0.59);
box-shadow:         3px 0px 5px 0px rgba(51, 50, 50, 0.59);
	}	
	
	#footer{
		position: relative
	}
</style>

<div class="container">

<div class="row" style="padding-top: 1%" >
	
	<div class="col-md-2">
					<div class="color_g stat_item">
						<span class="glyphicon glyphicon-user"></span>
                  	Users
                            
                   </div>
	</div>
	
	<div class="col-md-2">
					<div class="color_e stat_item">
						<span class="glyphicon glyphicon-shopping-cart"></span>
                 	 Orders
                            
                   </div>
	</div>
	
	<div class="col-md-2">
					<div class="color_f stat_item">
						<span class="glyphicon glyphicon-usd"></span>
                 	 
                        Order total Ksh    
                   </div>
	</div>
	
	<div class="col-md-2">
					<div class="color_c stat_item">
						<span class="glyphicon glyphicon-map-marker"></span>
                  
                     Counties       
                   </div>
	</div>
	<div class="col-md-2">
					<div class="color_b stat_item">
						<span class="glyphicon glyphicon-pushpin"></span>
                  
                    notifications     
                   </div>
	</div>
	<div class="col-md-2">
					<div class="color_a stat_item">
					<span class="glyphicon glyphicon-dashboard"></span>
                  
                    notifications      
                   </div>
	</div>
	
</div>

</div>

<div class="container-fluid" style="border: 0px solid #036;">

<div class="row" style="margin-top: 1%;border: 0px solid #036;" >


<div class="col-md-6"  id="">
<div class="row" style="margin-left: 0px;"> 
	<div class="col-md-12" style="height:350px;border: 0px solid #036;">
	
	</div>
	
	</div>
	
	<div class="row" style="margin-left: 0px;"> 
	<div class="col-md-12" style="border: 0px solid #036;">
	
	<div class="panel panel-default">
  <!-- Default panel contents -->
  	<div class="panel-heading">Panel heading</div>
<div class="panel-body">
    <div id="container">
    	
    </div>
  </div>
  
	</div>
	
	</div>
	
	</div>


</div>
<div class="col-md-6" >
	<div class="row" style="margin-left: 0px;"> 
	<div class="col-md-12" style="border: 0px solid #036;">
		
		<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Panel heading</div>

  <div class="panel-body">
    <div id="container2">
    	
    </div>
  </div>
  
	</div>
	
	</div>
	
	</div>
	
	<div class="row" style="margin-left: 0px;"> 
	<div class="col-md-12" style="border: 0px solid #036;">
		
		<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Panel heading</div>

  
  <div class="panel-body">
    <div id="container2">
    	
    </div>
  </div>
  
	
	</div>
	
	</div>
	
	<div class="row" style="margin-left: 0px;"> 
	<div class="col-md-12" style="border: 0px solid #036;">
		
		<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Panel heading</div>

  <div class="panel-body">
    <div id="container3">
    	
    </div
  </div>
  
	</div>
	
	</div>
	
	</div>


</div>

</div>

</div>

<script>
$(document).ready(function () {
	
	$(function () {
        $('#container2').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                text: 'Monthly Average Temperature'
            },
            subtitle: {
                text: 'Source: WorldClimate.com'
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Temperature (°C)'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'Tokyo',
                data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name: 'London',
                data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
            }]
        });
    });
    

	
	
	$(function () {
        $('#container3').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Stacked column chart'
            },
            xAxis: {
                categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total fruit consumption'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                }
            },
            legend: {
                align: 'right',
                x: -70,
                verticalAlign: 'top',
                y: 20,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +'</b><br/>'+
                        this.series.name +': '+ this.y +'<br/>'+
                        'Total: '+ this.point.stackTotal;
                }
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                        style: {
                            textShadow: '0 0 3px black, 0 0 3px black'
                        }
                    }
                }
            },
            series: [{
                name: 'John',
                data: [5, 3, 4, 7, 2]
            }, {
                name: 'Jane',
                data: [2, 2, 3, 2, 1]
            }, {
                name: 'Joe',
                data: [3, 4, 4, 2, 5]
            }]
        });
    });
    

	
	$(function () {
    var chart;
    
    $(document).ready(function () {
    	
    	// Build the chart
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Browser market shares at a specific website, 2014'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: 'Browser share',
                data: [
                    ['Firefox',   45.0],
                    ['IE',       26.8],
                    {
                        name: 'Chrome',
                        y: 12.8,
                        sliced: true,
                        selected: true
                    },
                    ['Safari',    8.5],
                    ['Opera',     6.2],
                    ['Others',   0.7]
                ]
            }]
        });
    });
    
});
	
	

    
     });
	
</script>