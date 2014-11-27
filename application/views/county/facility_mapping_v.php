<SCRIPT LANGUAGE="Javascript" SRC="<?php echo base_url();?>Scripts/FusionCharts/FusionCharts.js"></SCRIPT>
<script src="<?php echo base_url().'Scripts/accordion.js'?>" type="text/javascript"></script> 
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
		<style>

			.warning2 {
	background: #FEFFC8 url('<?php echo base_url()?>Images/excel-icon.jpg') 20px 50% no-repeat;
	border: 1px solid #F1AA2D;
	}
		</style>
		<script type="text/javascript" charset="utf-8">
			
			$(document).ready(function() {
			  //default action 
	    
					        //$('.accordion').accordion({defaultOpen: ''});
         //custom animation for open/close
    $.fn.slideFadeToggle = function(speed, easing, callback) {
        return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);
    };
    $('.accordion').accordion({
        defaultOpen: 'section1',
        cookieName: 'nav',
        speed: 'medium',
        animateOpen: function (elem, opts) { //replace the standard slideUp with custom function
            elem.next().slideFadeToggle(opts.speed);
        },
        animateClose: function (elem, opts) { //replace the standard slideDown with custom function
            elem.next().slideFadeToggle(opts.speed);
        }
    });
				/* Build the DataTable with third column using our custom sort functions */
				$('#example_main').dataTable( {
					"bJQueryUI": true,
					"bPaginate": false
				} );
		
		var url = "<?php echo base_url()."report_management/get_county_facility_mapping_data/$year/$month"?>";	
		ajax_request_special(url,'main_div','');				
	   

		$(".ajax_call").click(function(){
		var url = "<?php echo base_url().'report_management/get_district_facility_mapping_/'?>";	
		var id  = $(this).attr("id"); 
		ajax_request_special(url+id,'main_div','');					
	    });
	    
	  
	    
	    $("#section_2").click(function(){
		var url = "<?php echo base_url().'report_management/get_county_facility_mapping_data/'?>";	
		ajax_request_special(url,'main_div','');		
	    });
	
	
		
    function ajax_request_special(url,checker,date){
	var url =url;
	var checker=checker;
	
	var loading_icon="<?php echo base_url().'Images/loader.gif' ?>";
	 $.ajax({
          type: "POST",
          url: url,
          beforeSend: function() {
          	
          	if(checker=="main_div"){
          	 $("#test_a").html("<img style='margin-left:20%;' src="+loading_icon+">");	
          	}else{
          	 $('#dialog').html("");	
          	}
          	
           
          },
          success: function(msg) {
          	if(checker=="main_div"){	
          		
          $("#test_a").html(""); 	
          $("#test_a").html(msg); 
          
          }else{
          	
         $('#dialog').html(msg);
         $('#dialog').dialog({
         	title: 'HCMP Monthly roll out activity '+date,
         })
         $('#dialog').dialog('open');
    
          	
          }
          }
        }); 
}

	});
	</script>
<style>
.leftpanel{
    	width: 17%;
    	height:auto;
    	float: left;
    }

    .dash_menu{
    width: 100%;
    float: left;
    height:auto; 
    -webkit-box-shadow: 2px 3px 5px#888;
	box-shadow: 2px 3px 5px #888; 
	margin-bottom:3.2em; 
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
    background:url('<?php echo base_url()?>Images/plus.jpg') center center no-repeat;
    padding:10px; }
div.container {
    width:auto;
    height:auto;
    padding:0;
    margin:0; }
div.content {
    background:#f0f0f0;
    margin: 0;
    padding:10px;
    font-size:.9em;
    line-height:1.5em;
    font-family:"Helvetica Neue", Arial, Helvetica, Geneva, sans-serif; }
div.content ul, div.content p {
font-size: 1em;
    padding:.2em;
    margin:.2em;
    padding:3px; }
div.content ul li {
    list-style-position:inside;
    line-height:25px; }
div.content ul li a {
    color:#555555; }
code {
    overflow:auto; }
.accordion h3.collapse-open {}
.accordion h3.collapse-close {}
.accordion h3.collapse-open span {}
.accordion h3.collapse-close span {}   
</style>
<div class="leftpanel">

<div class="dash_menu">
	
	<h3 class="accordion" id="section_2" >Roll Out At A glance<span></span>
	<h3>


<h3 class="accordion" id="section1" >Districts in the county<span></span><h3>
<div class="container">
	<div id="content">
		<ol>
<?php
foreach($district_data as $district_detail){

echo "<li>
<a class='ajax_call' id='$district_detail->id' href='#'>$district_detail->district</a>
</li>";			
			
		//////////////////////////////////	
		}

?>		
</ol>		
	</div>
</div>
</div>

</div>

<div class="dash_main" id = "dash_main">
<div id="test_a" style="overflow: scroll; height: 51em; min-height:100%; margin: 0; width: 100%">



		</div>
</div>
 
 