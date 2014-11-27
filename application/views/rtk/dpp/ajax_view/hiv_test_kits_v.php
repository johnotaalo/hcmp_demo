

		var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Column2D.swf"?>", "ChartId_flash", "560", "400", "0", "1");
		var url = '<?php echo base_url()."rtk_management/generate_hiv_test_kits_chart"?>'; 
		chart.setDataURL(url);
		chart.render("chart");
			});

