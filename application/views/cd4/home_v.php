<script src="<?php echo base_url().'Scripts/accordion.js'?>" type="text/javascript"></script> 
<SCRIPT LANGUAGE="Javascript" SRC="<?php echo base_url();?>Scripts/FusionCharts/FusionCharts.js"></SCRIPT>
<script type="text/javascript">
$(document).ready(function(){

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
    //default call
    var url = "<?php echo base_url().'cd4_management/get_kenyan_county_map' ?>"
    
    ajax_request (url);

$(".ajax-call").click(function(){
var id  = $(this).attr("id"); 

  if(id=='reporting_rate'){
  	 var url = "<?php echo base_url().'rtk_management/get_reporting_rate' ?>";
       	
 }
  if(id=='county'){
  	var url = "<?php echo base_url().'rtk_management/get_rtk_county_distribution_allocation_detail' ?>";
       
  }
  
  if(id=="fcdrr"){
  	var url = "<?php echo base_url().'rtk_management/get_report/fcdrr' ?>";
  }
  if(id=="lab_commodities"){
  	var url = "<?php echo base_url().'rtk_management/get_report/lab_commodities' ?>";
  }

  ajax_request (url);
    
});
function ajax_request (url){
	var url =url;
	var loading_icon="<?php echo base_url().'Images/loader.gif' ?>";
	 $.ajax({
          type: "POST",
          url: url,
          beforeSend: function() {
            $("#test_a").html("");
            
             $("#test_a").html("<img style='margin-left:20%;' src="+loading_icon+">");
            
          },
          success: function(msg) {
          $("#test_a").html("");
           $("#test_a").html(msg);           
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

.alerts{
	width:95%;
	height:auto;
	background: #E3E4FA;	
	padding-bottom: 2px;
	padding-left: 2px;
	margin-left:0.5em;
	-webkit-box-shadow: 0 8px 6px -6px black;
	   -moz-box-shadow: 0 8px 6px -6px black;
	        box-shadow: 0 8px 6px -6px black;
	
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
	box-shadow: 2px 2px 6px #888; 
    margin-left:0.75em;
    margin-bottom:0em;
    
    }
    .dash_notify{
    width: 15.85%;
    float: left;
    padding-left: 2px;
    height:450px;
    margin-left:8px;
    -webkit-box-shadow: 2px 2px 6px #888;
	box-shadow: 2px 2px 6px #888;
    
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
    padding:0;
    margin:0;
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
    
   <!-- <h3 class="accordion" class="ajax-call" id="facility_list">Facility List<span></span><h3>
<div class="container">
  
</div>-->
<a class="ajax-call" id="reporting_rate" ><h3 class="accordion" >Reporting Rate<span></span><h3></a>
<div class="container">

</div>
<a class="ajax-call" id="county" ><h3 class="accordion" >County<span></span><h3></a>
<div class="container">

</div>

   <h3 class="accordion" >Reports <span></span><h3>
<div class="container">
	
   <div class="content">
   	
   	
    	<button class="awesome blue" ><a class="ajax-call" id="fcdrr">FCDRR</a></button>
      <button class="awesome blue" > <a class="ajax-call" id="lab_commodities">LAB COMMODITIES</a></button>
  
    </div>
</div>

</div>
<div class="sidebar">
	
		<h2>Quick Access</h2>
<nav class="sidenav">
	<ul>
		<li class="orders_minibar"><a href="#">demo</a></li>

	<ul>
</nav>
				
		</fieldset>
	
</div>
</div>
<div class="dash_main" id = "dash_main">
<div id="test_a" style="overflow: scroll; height: 51em; min-height:100%; margin: 0; width: 100%">

		</div>
</div>

