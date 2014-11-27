<?php
$current_year = date('Y');
$earliest_year = $current_year - 5;
$facility_Code=$this -> session -> userdata('news');	
?>
<script src="<?php echo base_url().'Scripts/accordion.js'?>" type="text/javascript"></script> 
<style>
.content input[type="text"]{
display: inline-block;
margin-top: 0.4em;
width:37%;
margin-right:0.5em;
padding: 0.55em 0.9em;
margin-bottom:2em;

}
.content input[type="radio"]{
display: inline-block;
margin-top: 0.3em;
width:15%;
margin-right:0.1em;
padding: 0.55em 0.9em;
}

.leftpanel{
width: 15%;
    	height:auto;
    	float: left;
}
.reportDisplay{
    width: 84%;
    min-height:100%;
    height:600px;
    float: left;
    -webkit-box-shadow: 2px 2px 6px #888;
	box-shadow: 2px 2px 6px 2px #888; 
    margin-left:0.75em;
    margin-bottom:0em;
}

#accordion {
width: 300px;
margin: 50px auto;
float:left;
margin-left:0.45em;
}
.collapsible,
.page_collapsible,
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
.accordion-open,
.collapse-open {
background: #289909; /* Old browsers */
color: #fff; }
.accordion-open span,
.collapse-open span {
display:block;
float:right;
padding:10px; }
.accordion-open span,
.collapse-open span {
background:url('<?php echo base_url()?>Images/minus.jpg') center center no-repeat; }
.accordion-close span,
.collapse-close span {
display:block;
float:right;
background:url('<?php echo base_url()?>
	Images/plus.jpg') center center no-repeat;
	padding:10px; }
	div.container {
		width: auto;
		height: auto;
		padding: 0;
		margin: 0;
	}
	div.content {
		background: #f0f0f0;
		margin: 0;
		padding: 10px;
		font-size: .9em;
		line-height: 1.5em;
		font-family: "Helvetica Neue", Arial, Helvetica, Geneva, sans-serif;
	}
	div.content ul, div.content p {
		padding: 0;
		margin: 0;
		padding: 3px;
	}
	div.content ul li {
		list-style-position: inside;
		line-height: 25px;
	}
	div.content ul li a {
		color: #555555;
	}
	code {
		overflow: auto;
	}
	.accordion h3.collapse-open {
	}
	.accordion h3.collapse-close {
	}
	.accordion h3.collapse-open span {
	}
	.accordion h3.collapse-close span {
	}

	.from {
		background-color: #749a02;
		-webkit-box-shadow: 0 0 9px #333; }
		50% { background-color: #91bd09;
		-webkit-box-shadow: 0 0 18px #91bd09;
	}
	.to {
		background-color: #749a02;
		-webkit-box-shadow: 0 0 9px #333;
	}

</style>
<div class="leftpanel"><h3 class="accordion" id="section1">Expiries<span></span><h3>
<div class="container">
    <div class="content">
      
    <h3> <a href="#"  id="expired">View Expiries</a></h3> 
    </n>
     <h3> <a href="#" id="potentialexpiries">View Potential Expiries</a></h3> 
     <?php $attributes = array( 'name' => 'myform', 'id'=>'myform');
	 echo form_open('raw_data/gen_pdf',$attributes); ?>	
<button id="downloader" class="btn" >Download PDF<i class="icon-circle-arrow-down" style="margin-left: 3px"></i></button>
<input type="hidden" id="timer" name="timer" value="3" readonly="readonly"/>
<?php  echo form_close();
		?>
      
    
    
    </div>
</div>

    <h3 class="accordion" id="section2">Stock Control Card<span></span><h3>
<div class="container">
	<!-- Start of stock control form-->
	
    <div class="content">
    	 <select id="desc" name="desc" class="dropdownsize">
    <option>Select Drug Name</option>
		<?php 
		foreach ($drugs as $drugs) {
			$id=$drugs->id;
			$kemsa=$drugs->Kemsa_Code;
			$drug=$drugs->Drug_Name;
			?>
			<option value="<?php echo $id; ?>"><?php echo $drug; ?></option>
			
		<?php } ?>		
	</select>
	<input  type="hidden"  name="drugname" id="drugname" value="" />
	
	<h2>Click below to choose date range</h2>
	<input type="text" size="10"  value="" id="from" placeholder="From" />
	<input type="text" size="10"  value="" id="to" placeholder="To"/>
	<button class="awesome blue" id="stockcontrol" style="margin-left:0%">Generate Report</button>
	<?php $attributes = array( 'name' => 'myform', 'id'=>'myform');
	 echo form_open('/',$attributes); ?>	
<button id="downloader" class="btn" >Download PDF<i class="icon-circle-arrow-down" style="margin-left: 3px"></i></button>

<?php  echo form_close();
		?>
	<input type="hidden"  value="<?php echo $facility_Code ?>" id="facilitycode" name="facilitycode" />
    </div>
    
</div>

<!-- Start of stock control form-->

<h3 class="accordion" id="section3">Order Report<span></span><h3>
<div class="container">
    <div class="content">
    <h2><a href="#" id="orders">Click to view orders</a></h2> 
   

    </div>
    
</div>
<!-- Start of commodities Issue form-->
<h3 class="accordion" id="section4">Commodities Issued<span></span><h3>
<div class="container">
    <div class="content">
    	 <h2>Click below to choose date range</h2>
	<input type="text" size="10"  value="" id="fromcommodity" placeholder="From" />
	<input type="text" size="10"  value="" id="tocommodity" placeholder="To"/>
	<button class="awesome blue" id="commodityissue" style="margin-left:30%">Generate Report</button>
	
    </div>
</div>


</div>

<div class="reportDisplay">
	
</div>

<script type="text/javascript">
	$(function() {
			
			var loading_icon="<?php echo base_url().'Images/loader.gif' ?>";
			
			
			$('#desc').change(function() {
			
				
			var txt=$("#desc option:selected").text();
							
				$('input[name=drugname]').val(txt);
				
				});
				
				
				//default call
				var url = "<?php echo base_url().'stock_expiry_management/default_expiries'?>";
			    ajax_request (url);
         
         $("#commodityissue").click(function(){
      var url = "<?php echo base_url().'raw_data/commoditieshtml'?>";
      var data_1="fromcommodity= "+$('#fromcommodity').val()+"&tocommodity="+ $('#tocommodity').val() +"&facilitycode="+ $('#facilitycode').val();
       ajax_request (url,data_1);
    });
				
	$("#stockcontrol").click(function(){
      var url = "<?php echo base_url().'raw_data/stockchtml'?>";
      var data_1='desc='+$('#desc').val()+'&from='+$('#from').val()+'&drugname='+$('#drugname').val()+'&to='+$('#to').val()+'&facilitycode='+$('#facilitycode').val();
          ajax_request (url,data_1);
    });
    
    $("#potentialexpiries").click(function(){
      var url = "<?php echo base_url().'stock_expiry_management/default_expiries'?>";
      ajax_request (url,'');
    });
    
    $("#expired").click(function(){
      var url = "<?php echo base_url().'stock_expiry_management/facility_report_expired'?>";
    ajax_request (url,'');
    });
    
    $("#orders").click(function(){
      var url = "<?php echo base_url().'order_management/get_delivered_orders_ajax'?>";
    ajax_request (url,'');
    });
    
    			$("#from,#from_order,#fromcommodity").datepicker({
				defaultDate : "+1w",
				changeMonth : true,
				changeYear : true,
				numberOfMonths : 1,
				onClose : function(selectedDate) {
					$("#to,#to_order,#tocommodity").datepicker("option", "minDate", selectedDate);
				}
			});
			$("#to,#to_order,#tocommodity").datepicker({
				defaultDate : "+1w",
				changeMonth : true,
				changeYear : true,
				numberOfMonths : 1,
				onClose : function(selectedDate) {
					$("#from,#from_order,#fromcommodity").datepicker("option", "maxDate", selectedDate);
				}
			});
			$.fn.slideFadeToggle = function(speed, easing, callback) {
				return this.animate({
					opacity : 'toggle',
					height : 'toggle'
				}, speed, easing, callback);
			};

			$('.accordion').accordion({
				defaultOpen : 'section1',
				cookieName : 'nav',
				speed : 'medium',
				animateOpen : function(elem, opts) {//replace the standard slideUp with custom function
					elem.next().slideFadeToggle(opts.speed);
				},
				animateClose : function(elem, opts) {//replace the standard slideDown with custom function
					elem.next().slideFadeToggle(opts.speed);
				}
			});
		/*	$("input[name$='reportingperiod']").change(function() {
				// alert( $("input[name$='reportingperiod']").val());
				var radio_value = $(this).val();

				if (radio_value == 'Yearly') {
					$("#Yearly").show("slow");
					$("#Quarterly").hide("fast");

				} else if (radio_value == 'Quarterly') {
					$("#Quarterly").show("slow");
					$("#Yearly").hide("fast");
				}

			});

			$("#Quarterly").hide();
			$("#Yearly").show();*/
			
		
			
			
			function ajax_request (url, data_){
	var url =url;
	var loading_icon="<?php echo base_url().'Images/loader.gif' ?>";
	 $.ajax({
          type: "POST",
          data:data_,
          url: url,
          beforeSend: function() {
            $(".reportDisplay").html("");
            
             $(".reportDisplay").html("<img style='margin-left:20%;' src="+loading_icon+">");
            
          },
          success: function(msg) {
          $(".reportDisplay").html("");
           $(".reportDisplay").html(msg);           
          }
        }); 
}
			
			
			
	}); 
</script>


