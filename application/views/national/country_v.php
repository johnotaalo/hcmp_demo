<html lang="en">
	
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">   
    <!-- Bootstrap core CSS -->  
    <link rel="icon" href="<?php echo base_url().'assets/img/coat_of_arms.png'?>" type="image/x-icon" />
    <link href="<?php echo base_url().'assets/css/style.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/normalize.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/css/dashboard.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/css/jquery-ui-1.10.4.custom.min.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap.min.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap-responsive.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/datatable/TableTools.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/css/tabs.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/css/tabstyles.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/datatable/dataTables.bootstrap.css'?>" type="text/css" rel="stylesheet"/>
    <script src="<?php echo base_url().'assets/scripts/jquery.js'?>" type="text/javascript"></script>
    <script src="<?php echo base_url().'assets/scripts/pace.js'?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/scripts/county_sub_county_functions.js')?>" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/FusionCharts/FusionCharts.js" type="text/javascript"></script>
     <script src="<?php echo base_url().'assets/scripts/pace.js'?>" type="text/javascript"></script>
    
     
    <title>HCMP | National</title>
    <STYLE TYPE="text/css">

     a:hover{
    text-decoration: none;
}

.active-panel{
      border-left: 6px solid #36BB24;
    }
    body {
padding-top: 4.5%;
}

.modal-content,.form-control
{
  border-radius: 0 !important;
}

h4{
  
  padding:4px;
  color:black;
  background:white;
  text-align:center;
  margin:0; 
  font-size:15px;
}

.stat_item {
    height: 36px;
    padding: 2px 5px;
    color: #fff;
    text-align: center;
    font-size: 1em;
    
  } 
  
  #notify .col-md-2,.col-md-1{
    padding:3px;
  }
  #notify {
    margin-bottom: 5px;
  }
  .tile{
    box-shadow:  0px 1px 5px 0px #d3d3d3;
    background:white;
  }
  .tile h4{
    padding: 5px;
    background-color:#F5F5F5;
    color: black;
  }
  .btn{
    border-radius: 0;
  }
  .modal-dialog {
    
    width: 74%;
  }
  .stat_item{

    height:110px;
    margin-top:0.5%;
  }
  .figure_up{
    font-size: 30px;
    float:left;
    margin:0 3px 0 34px;

      }
      .figure_count{
    font-size: 22px;
    margin:0 3px 0 60px;

      }
  .figure_low{
    font-size: 12px;
    margin:12px 0 0 0;

      }

 .stat_item .row {
    
    
     }
.view_more{
  height:26px;
  background-color:white;
  color:black;


}
.arrow{
  margin-left:60px;
}


    </STYLE>
<script>
  
  </script>
  
  </head>
  
  <body screen_capture_injected="true" style="background-color: white;">
  	
  	
    
   <div class="container-fluid navbar-default navbar-fixed-top" role="navigation" style="background-color:white">
        <div class="container-fluid">
            <div class="navbar-header" id="st-trigger-effects">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand " href="<?php echo base_url().'national';?>" >HCMP</a>

        </div>
        <div class="navbar-header" >
  
            <a href="<?php echo base_url().'national';?>">   
            <img style="display:inline-block;"  src="<?php echo base_url();?>assets/img/coat_of_arms_dash.png" class="img-responsive " alt="Responsive image" id="logo" ></a>
            
        </div>
        
        <div class="collapse navbar-collapse navbar-right">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="<?php echo base_url().'national';?>">Home</a></li>
            <li class=""><a href="<?php echo base_url().'national/reports';?>">Reports</a></li>
            <li class=""><a href="<?php echo base_url().'national/search';?>">Search</a></li>
            <li class="" style="background: #144d6e; color: white;"><a style="background: #144d6e; color: white;" href="<?php echo base_url().'home';?>"><span class="glyphicon glyphicon-user"></span>Log in</a></li>
                        
                    </li>
          </ul>
          
                                        
        </div><!--/.nav-collapse -->

      </div>
    </div>

<div class="container-fluid" style="">
  <div class="row-fluid">

    <!-- begin div map-->
    <div class="col-lg-3 col-md-12">
      
      <div class="tile" id="map" style="max-height: 400px;">
            
          </div>
      <div style="width:130px;margin-left:30%;padding:2%">
            <div style="display:inline-block;width:10px;height:10px;background:#FFCC99">
                
            </div>
            <div style="width:80px;display:inline-block;margin-left:5px;font-size:120%">
              Using HCMP
              </div>
            </div>
          <script>
          var map= new FusionMaps ("assets/FusionMaps/FCMap_KenyaCounty.swf","KenyaMap","100%","100%","0","0");
          map.setJSONData(<?php echo $maps; ?>);
          
            map.render("map");
            
                    </script>
            
    

    </div><!-- end div map-->

<!-- begin div notification tray-->
    <div class=" tile col-lg-6 col-md-12" style="border: 0px solid #C0C0C0;height:550px;">
      <div class="row">
        
    <div class="col-lg-4 col-md-6">

      <div class="color_b stat_item">
       <div class="row">

        <div class=" figure_up">

          <span class="glyphicon glyphicon-home"></span>
          <span class=" figure_count"> 81</span>
         
        </div>
       
          </div>
           <div class="row">

        <div class=" figure_low">

         Facilities Rolled Out
        </div>
        <div class="view_more" style="">
           View Details
        <span class="arrow  glyphicon glyphicon-circle-arrow-right"></span>

        </div>
       
       
          </div>
         
            
                            
        </div>

    </div>

    <div class="col-lg-4 col-md-6">

      <div class="color_e stat_item">
            <div class="row">

        <div class=" figure_up">

          <span class="glyphicon glyphicon-user"></span>
          <span class=" figure_count"> 429</span>
         
        </div>
       
          </div>
           <div class="row">

        <div class=" figure_low">

         Trained HCW
        </div>
         <div class="view_more" style="">
           View Details
        <span class="arrow  glyphicon glyphicon-circle-arrow-right"></span>

        </div>
       
          </div>
                            
                   </div>
      
    </div>
    <div class="col-lg-4 col-md-12">

      <div class="color_a stat_item">
           <div class="row">

        <div class=" figure_up">

          <span class="glyphicon glyphicon-shopping-cart"></span>
          <span class=" figure_count"> 25</span>
         
        </div>
       
          </div>
           <div class="row">

        <div class=" figure_low">

         Facilities Have Stock-outs
        </div>
         <div class="view_more" style="">
           View Details
        <span class="arrow glyphicon glyphicon-circle-arrow-right"></span>

        </div>
       
          </div>   
        </div>
      
    </div>

      </div>

      <div class="row">
        <div class="col-lg-12" style="margin-top:3%;">
          <h4>M.O.S VS A.M.C</h4>
          <div id="mos"></div>
        </div>
      </div>
      

    </div><!-- end div notification tray-->

    <!-- begin div graph 1-->
<div class="tile col-lg-3 col-md-12" style="border: 0px solid #C0C0C0;height:550px;">
 <h4>Facilities In Numbers</h4>
          
       

</div><!-- end div graph 1-->

    
  </div><!--end first row-->

<div class="row-fluid" style="margin-top:0.5%;">

 
<div class="tile col-lg-6 col-md-12" style="border: 0px solid #C0C0C0;height:400px;">
  <h4>Consumption</h4>
 <div id="consumption"></div>

</div>
<div class="tile col-lg-6 col-md-12" style="border: 0px solid #C0C0C0;height:400px;">
  <h4>Expiries</h4>
 <div id="actual_ex"></div>

</div>

</div><!--end second row-->


<div class="row-fluid" style="margin-top:3%;">

  <div class="tile col-lg-5 col-md-6" style="border: 0px solid #C0C0C0;height:400px;">
    <h4>Orders</h4>
 <div id="orders"></div>

</div>
<div class=" col-lg-3 col-md-6" style="border: 1px solid #C0C0C0;height:400px;">
 

</div>
<div class=" col-lg-4 col-md-12" style="border: 1px solid #C0C0C0;height:400px;">
 

</div>

</div><!--end third row-->

  <div></div>
</div>



	

	</div>
	
	
  <script>
    var url="<?php echo base_url(); ?>";
   ajax_fill_data('Kenya/facility_breakdown_pie',"#facility_breakdown");
   ajax_fill_data('Kenya/mos_graph/NULL/NULL/NULL/NULL/NULL/mos',"#mos");
   ajax_fill_data('Kenya/roll_out',"#roll_out");
   ajax_fill_data('Kenya/consumption',"#consumption");
   ajax_fill_data('national/expiry/NULL/NULL/NULL/NULL/NULL',"#actual_ex");
   ajax_fill_data('Kenya/potential_expiries',"#potential_ex");
   ajax_fill_data('national/order/NULL/NULL/NULL/NULL/NULL',"#orders");
   ajax_fill_data('Kenya/write_dashboard_html',"#hcw_trained");
   ajax_fill_data('Kenya/facility_over_view/',"#facilities_rolled_out");
   ajax_fill_data('Kenya/get_lead_infor/NULL/NULL/NULL/NULL/NULL',"#leadtime");
   
       $("#mosgraph").click(function() {
      ajax_fill_modal('Kenya/mos_graph/NULL/NULL/NULL/NULL/NULL/mosmodalgraph',"#mosmodalgraph");
      });
      
      function ajax_fill_modal(function_url,div){
        var function_url =url+function_url;
        var loading_icon=url+"assets/img/Preloader_1.gif";
        $.ajax({
        type: "POST",
        url: function_url,
        beforeSend: function() {
        $(div).html("<img style='margin:20% 40% 0 40%;' src="+loading_icon+">");
        },
        success: function(msg) {
        $(div).html(msg);
        }
        });
        }  
   
   function ajax_fill_data(function_url,div){
        var function_url =url+function_url;
        var loading_icon=url+"assets/img/Preloader_1.gif";
        $.ajax({
        type: "POST",
        url: function_url,
        beforeSend: function() {
        $(div).html("<img style='margin:40% 50% 0 50%;' src="+loading_icon+">");
        },
        success: function(msg) {
        $(div).html(msg);
        }
        });
        }  
        
        function run(data){
        var county_data=data.split('^');
        $('.county-name').html(county_data[1]+"&nbsp;County &nbsp;");
        ajax_fill_data('Kenya/facility_breakdown_pie/'+county_data[0],"#facility_breakdown");
        ajax_fill_data('Kenya/facility_over_view/'+county_data[0],"#facilities_rolled_out");
        ajax_fill_data('Kenya/write_dashboard_html/'+county_data[0],"#hcw_trained");
        $('.county').val(county_data[0]);
        $('#county_id').val(county_data[0]);
        json_obj={"url":"<?php echo site_url("orders/getDistrict");?>",}
        var baseUrl=json_obj.url;
        dropdown(baseUrl,"county="+county_data[0],".subcounty");
        ajax_fill_data('national/expiry/NULL/'+county_data[0]+'/NULL/NULL/NULL',"#actual_ex");
        ajax_fill_data('Kenya/potential_expiries/'+county_data[0]+'/NULL/NULL/NULL/NULL',"#potential_ex"); 
        ajax_fill_data('Kenya/mos_graph/'+county_data[0]+'/NULL/NULL/NULL/NULL/mos',"#mos");
        ajax_fill_data('Kenya/consumption/'+county_data[0]+'/NULL/NULL/NULL',"#consumption");
       // ajax_request_replace_div_content('national/get_facility_infor/'+county_data[0]+'/NULL/NULL/NULL',"#facilities");
        ajax_fill_data('national/order/NULL/'+county_data[0]+'/NULL/NULL/NULL',"#orders");
       // ajax_request_replace_div_content('national/get_lead_infor/NULL/'+county_data[0]+'/NULL/NULL/NULL',"#lead_infor");
    } 
    
        function dropdown(baseUrl,post,identifier){
            /*
             * ajax is used here to retrieve values from the server side and set them in dropdown list.
             * the 'baseUrl' is the target ajax url, 'post' contains the a POST varible with data and
             * 'identifier' is the id of the dropdown list to be populated by values from the server side
             */
            $.ajax({
              type: "POST",
              url: baseUrl,
              data: post,
              success: function(msg){
                    var values=msg.split("_")
                    var dropdown="<option value='NULL'>All</option>";
                    for (var i=0; i < values.length-1; i++) {
                        var id_value=values[i].split("*")
                        dropdown+="<option value="+id_value[0]+">";
                        dropdown+=id_value[1];
                        dropdown+="</option>";
                    };
                    $(identifier).html(dropdown);
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) {
                   if(textStatus == 'timeout') {}
               }
            }).done(function( msg ) {
            });
        }
         
</script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
    var url='<?php echo base_url(); ?>';
    </script>
  <script src="<?php echo base_url().'assets/boot-strap3/js/bootstrap.min.js'?>" type="text/javascript"></script>
 <!--  <script src="<?php echo base_url();?>assets/FusionCharts/FusionCharts.js" type="text/javascript"></script>
    <!-- Bootstrap core JavaScript===================== --> 
  <script src="<?php echo base_url().'assets/scripts/jquery-ui-1.10.4.custom.min.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/scripts/highcharts.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/scripts/exporting.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/scripts/jquery.floatThead.min.js'?>" type="text/javascript"></script>  
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="<?php echo base_url().'assets/scripts/hcmp_shared_functions.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/scripts/county_sub_county_functions.js')?>" type="text/javascript"></script>
    <!--Datatables==========================  -->
  <script src="<?php echo base_url().'assets/datatable/jquery.dataTables.min.js'?>" type="text/javascript"></script>    
  <script src="<?php echo base_url().'assets/datatable/dataTables.bootstrap.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/datatable/TableTools.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/datatable/ZeroClipboard.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/datatable/dataTables.bootstrapPagination.js'?>" type="text/javascript"></script>
  <!-- validation ===================== -->
  <script src="<?php echo base_url().'assets/scripts/jquery.validate.min.js'?>" type="text/javascript"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/loadingbar.css'?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/elusive-webfont.css'?>" />
</body>
</html>