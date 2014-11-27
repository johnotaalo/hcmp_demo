

$(document).ready(function(){
	
	var protocol =window.location.protocol;
	var host =window.location.host;
	pathArray = window.location.pathname.split( '/' );
	base_url =protocol+'//'+ host+'/'+pathArray[1]+'/';
	//---------- Load other js scrips needed for EID ------------------------
	$.when(
	    $.getScript( base_url+"assets/scripts/eid/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" ),
	    $.getScript( base_url+"assets/scripts/eid/plugins/blockUI/jquery.blockUI.js" ),
	    $.getScript( base_url+"assets/scripts/eid/plugins/iCheck/jquery.icheck.min.js" ),
	    $.getScript( base_url+"assets/scripts/eid/plugins/perfect-scrollbar/src/jquery.mousewheel.js" ),
	    $.getScript( base_url+"assets/scripts/eid/plugins/perfect-scrollbar/src/perfect-scrollbar.js" ),
	    $.getScript( base_url+"assets/scripts/eid/plugins/less/less-1.5.0.min.js" ),
	    $.getScript( base_url+"assets/scripts/eid/plugins/jquery-cookie/jquery.cookie.js" ),
	    $.getScript( base_url+"assets/scripts/eid/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js" ),
	    $.getScript( base_url+"assets/scripts/eid/main.js" ),
	    $.getScript( base_url+"assets/scripts/eid/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js" ),
	    $.getScript( base_url+"assets/scripts/eid/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js" ),
	    $.getScript( base_url+"assets/scripts/eid/index.js" ),
	    $.getScript( base_url+"assets/scripts/eid/plugins/flot/jquery.flot.js" ),
	    $.Deferred(function( deferred ){
	        $( deferred.resolve );
	    })
	).done(function(){
		Main.init();
		Index.init();
	    //place your code here, the scripts are all loaded
	
	});
	
	
	//---------- Load other js scrips needed for EID End ------------------------
	
	eid_click = 0;
	//Get only first part of hash when reloading the page
	var hash_split = window.location.hash.split('/');
	window.location.hash="#eid_management";
	x = 1;//This is used to check hashchange when clicking on menu
	sub_menu_click = 0;//Sub menu click check (submission trackin, submission reports ...)
	
	$(window).trigger('hashchange');
	$(document).on("click",".top_menu",function(event){
		
		if($(this).attr('id')=="eid_management"){
			document.location.hash = '';
			sub_menu_click = 0;
			event.preventDefault();
			document.location.hash =$(this).attr('id');
		}
		
		
		
	});
	
	$(".back_page").on("click",function(){
		var hash = window.location.hash;
		parent.history.back();
        return false;
	});
	
	//EID Menus click
	$(".eid_menus").on("click",function(){
		
	});
	
	$("#subm_month").on("change",function(){
		if($(this).val!=""){
			$("#subm_month").css("border-color","none");
		}
	});
	
	$("#subm_testing_lab").on("change",function(){
		if($(this).val!=""){
			$("#subm_testing_lab").css("border-color","#cccccc");
		}
	});
	
	//Generate report
	$(document).on("click","#btn_submit_cons_report",function(){
		
		//Validation
		var lab = $("#subm_testing_lab").val();
		var lab_name = $("#subm_testing_lab :selected").text();
		var platform = $("input[type='radio'][name='platform']:checked").val();
		var month = $("#subm_month").val();
		var month_name = $("#subm_month").text();
		var year =  $("#subm_year").val();
		if(month==""){
			$("#subm_month").css("border-color","red");
			return;
		}else{
			$("#subm_month").css("border-color","#cccccc");
		}
		if(lab==""){
			$("#subm_testing_lab").css("border-color","red");
			return;
		}else{
			$("#subm_testing_lab").css("border-color","#cccccc");
		}
		var _url = base_url+"eid_management/displayconsumption";
		
		//After check, submit
		//Get consumption report title name
		var text = $(".eid_menus.active").text();
		var request = $.ajax({
			url : _url,
			type : 'post',
			data : {
				"testinglab" : lab,
				"lab_name"   : lab_name,		
				"platform"   : platform,
				"month"      : month,
				"monthyear"  : year,
				"report_text": text
			},
			dataType : "html"
		});
		request.done(function(data) {
			$( "#inner_wrapper" ).html( data);
			$(".allocate_column").css("display","none");
		});
		request.fail(function(jqXHR, textStatus) {
			
		});
	});
	
	//Approval button
	$(document).on("click",".btn_approve",function(event){
		event.preventDefault();
		var href = $(this).attr("href");
		$("#eid_main").load(href);
		sub_menu_click = 2;
		document.location.hash ="eid_management/consumption";
	});
	
	
	
	//Submit approval form data
	$(document).on("submit","#fmApproval",function(event) {
		event.preventDefault();
		
		var url = $(this).attr("action");
		var data = $("#fmApproval").serialize();
		
 		var posting = $.ajax({
						  type		: "POST",
						  url		: url,
						  data		: data,
						  dataType	: "json"
					  });
 		
 		posting.done(function(msg) {
 			if(msg=='success'){//If approval is done for all platforms
 				window.location = base_url+"eid_management";
 			}
 			else if(msg.platformresult==1 && msg.platform=='TAQMAN'){//..has abbott machine
 				if(msg.platform=='TAQMAN' ){
 					var platform_id = 2;
 				}else{
 					var platform_id = 1;
 				}
 				var _url = base_url+"eid_management/displayconsumption";
 				var request = $.ajax({
					url : _url,
					type : 'post',
					data : {
						"testinglab" : msg.lab,
						"lab_name"   : msg.lab_name,		
						"platform"   : platform_id,
						"month"      : msg.month,
						"monthyear"  : msg.year,
						"report_text": "",
						"approval"   : "1"
					},
					dataType : "html"
				});
				request.done(function(data) {
					$( "#inner_wrapper" ).html( data);
					//alert(data)
				});
				request.fail(function(jqXHR, textStatus) {
					
				});
 				
 			}else{// No abbott machine
 				//alert("No abbott machine");
 			}
 		});
 		
 	});
	
	
	//Going back to eid
	$(document).on("click",".btn_back_eid",function(event){
		event.preventDefault();
		sub_menu_click = 0;
		document.location.hash ="";
		document.location.hash ="eid_management";
		
	});
	
	//Sidebar Menu Click
	$(document).on("click",".sidebar-title",function(){
		$(".sidebar-title").removeClass("active");
		$(".sidebar-title").removeClass("open");
		$(".sub-menu").css("display","none");
		$(this).closest(".sidebar-title").find(".sub-menu").css("display","block");
		$(this).addClass("active");
		$(this).addClass("open");
		if($(this).attr("id")=="report-download-title"){
			$("#md-download-report").modal("show");
			//Get years and months
		}else if($(this).attr("id")=="report-submission-title"){
			//Get text from sidebar clicked
			var text = $(this).find(".title").text();
			$("#breadcrumb-title").text(text);
			$("#page-content").load(base_url+"eid_management/menus/submission_report");
		}
	});
	
	// -- DOWNLOAD REPORTS START -------------
	
	$(document).on("change","#download-report-period",function(){
		var period = $(this).val();
		var report_type = $("#report-type").val();
		if(report_type=='2'){//By Lan
			getApprovedReportLabs(period);
		}
		
	});
	$(document).on("click",".btn-download-byplatform",function(){
		var _id = $(this).attr("id");
		var platform = "";
		if(_id=="btn-download-taqman"){
			platform = "1";
		}else if(_id=="btn-download-abbott"){
			platform = "2";
		}
		//Get approved lab reports for download
		var period = $("#download-report-period").val();
		$("#by-platform-content").html('');
		getApprovedReportPlatform(period,platform);
		
	});
	
	
	$(document).on("change","#report-type",function(){
		var val = $(this).val();
		if(val=='1'){//By Platform
			$("#report-type-content").html('<div style="text-align: right"><div class="btn-group"><button type="button" id="btn-download-taqman" class="btn btn-info btn-download-byplatform"><i class="fa fa-download"></i> Download TAQMAN</button></div>\
											<div class="btn-group"><button type="button" id="btn-download-abbott" class="btn btn-info btn-download-byplatform"><i class="fa fa-download"></i>  Download ABBOTT</button></div></div>');
		}else if(val =='2'){// By Lab
			//Get approved lab reports for download
			var period = $("#download-report-period").val();
			$("#report-type-content").html('');
			getApprovedReportLabs(period);
		}
	});
	//DOWNLOAD REPORTS END --------------------
	
	
});

$(window).bind( 'hashchange', function(e) {
	
	if(!window.location.hash){
		return;
	}
	var location = ( window.location.hash.replace("#",""));
	
	if(x==1){//Make sure hash is checked only once when initializing
		hash = location;
		x=2;
	}
	if(sub_menu_click==0){
		$("#tab_tracking").load(base_url+"eid_management/menus/submission_tracking");
		$("#tab_consumption").load(base_url+"eid_management/menus/kit_consumption");
		$("#tab_forecasting").load(base_url+"eid_management/menus/kit_forecasting");
		$("#tab_report").load(base_url+"eid_management/menus/submission_report");
	}else if(sub_menu_click==1){//If hash is changing when clicking sub menus, no need to change the whole content
		$( "#eid_subcontent" ).load( base_url+location, function() {
		  
		});
		sub_menu_click = 0;
	}
	
});

//Approve lab
$(document).on("click",".approve-lab",function(event){
	event.preventDefault();
	var link = $(this).data('ref');
	var lab_name = $(this).data('labname');
	var pathArray = link.split( '/' );
	
	var _url = base_url+"eid_management/displayconsumption";
	
	var request = $.ajax({
		url : _url,
		type : 'post',
		data : {
			"testinglab" : pathArray[1],
			"lab_name"   : lab_name,		
			"platform"   : 1,//By default, make it TAQMAN
			"month"      : pathArray[2],
			"monthyear"  : pathArray[3],
			"report_text": "",
			"approval"   : "1"
		},
		dataType : "html"
	});
	request.done(function(data) {
		$( "#inner_wrapper" ).html( data);
	});
	request.fail(function(jqXHR, textStatus) {
		
	});
});

function getApprovedReportLabs(period){
	period = period.split('-');
	var year = period[0];
	var month = period[1];
	
	//Get data
	var _url = base_url+"eid_management/getApprovedLabs";
	var request = $.ajax({
		url : _url,
		type : 'post',
		data : {
			"year" : year,
			"month": month
		},
		dataType : "html"
	});
	request.done(function(data) {
		$( "#report-type-content" ).html( data);
	});
	request.fail(function(jqXHR, textStatus) {
		
	});
}
function getApprovedReportPlatform(period,platform){
	
	period = period.split('-');
	var year = period[0];
	var month = period[1];
	//Get data
	var _url = base_url+"eid_management/downloadreportbyplatform";
	var request = $.ajax({
		url : _url,
		type : 'post',
		data : {
			"year" : year,
			"month": month,
			"check": "1"
		},
		dataType : "html"
	});
	request.done(function(data) {
		if(data=="1"){//If there are reports for this period, download
			window.location = base_url+"eid_management/downloadreportbyplatform/"+month+"/"+year+"/"+platform+"/0";
		}else{//Otherwise, display message
			$( "#by-platform-content" ).html( data);
		}
		
	});
	request.fail(function(jqXHR, textStatus) {
		
	});
}
