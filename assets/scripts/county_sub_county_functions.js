/**
 *@author Kariuki & Mureithi
 */
  $(document).ready(function () {
  	//default 
  $('.page-header').html('Notifications');
  $('#notifications').parent().parent().parent().addClass('active-panel');
  ajax_request_replace_div_content('reports/notification_dashboard',"#notification");
 
  $('[data-toggle=offcanvas]').click(function () {
    $('.row-offcanvas').toggleClass('active');
  });
  
  $(window).resize(function() {
    if (($(window).width() < 768))
    {
        $( ".col-md-2,.col-md-10" ).css( "position", "" );
    };
});
//expiries function
$("#expiries").on('click', function(){
$('.page-header').html('Expiries');
active_panel(this);
ajax_request_replace_div_content('reports/expiries_dashboard',"#notification");
});
//Notifications function
$("#notifications").on('click', function(){
active_panel(this);
 ajax_request_replace_div_content('reports/notification_dashboard',"#notification");
$('.page-header').html('Notifications');
});
//stocking_levels function
$("#stocking_levels").on('click', function(){
ajax_request_replace_div_content('reports/stock_level_dashboard',"#notification");
active_panel(this);
$('.page-header').html('Stocking Levels');
});
//Consumption function
$("#consumption").on('click', function(){
active_panel(this);
$('.page-header').html('Consumption');
ajax_request_replace_div_content('reports/consumption_data_dashboard',"#notification");
});
//Consumption function
$("#system_usage").on('click', function(){
active_panel(this);
$('.page-header').html('System Usage');
});
     
});

function active_panel(div_object){

     	 $('.panel').removeClass('active-panel');
     	 $(div_object).parent().parent().parent().addClass('active-panel');
     }
     function ajax_request_replace_div_content(function_url,div){
		var function_url =url+function_url;
		var loading_icon=url+"assets/img/loader2.gif";
		$.ajax({
		type: "POST",
		url: function_url,
		beforeSend: function() {
		$(div).html("<img style='margin-left:20%;' src="+loading_icon+">");
		},
		success: function(msg) {
		$(div).html(msg);
		}
		});
		}	
	