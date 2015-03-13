<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap core CSS -->
    <link rel="icon" href="<?php echo base_url().'assets/img/coat_of_arms.png'?>" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/loadingbar.css'?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/elusive-webfont.css'?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/component.css'?>" />
	<link href="<?php echo base_url().'assets/css/style.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/offline-theme-default.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/styles.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/css/select2.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/offline-language-english.css'?>" type="text/css" rel="stylesheet"/> 
	<link href="<?php echo base_url().'assets/css/normalize.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/css/dashboard.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/css/jquery-ui-1.10.4.custom.min.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap.min.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap-responsive.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/css/font-awesome.min.css'?>" type="text/css" rel="stylesheet"/>
	 <link rel="stylesheet" href="<?php echo base_url().'assets/css/pace-theme-flash.css'?>" />
    <script src="<?php echo base_url().'assets/scripts/jquery.js'?>" type="text/javascript"></script>
	<link href="<?php echo base_url().'assets/datatable/TableTools.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/datatable/dataTables.bootstrap.css'?>" type="text/css" rel="stylesheet"/>
	<script src="<?php echo base_url().'assets/scripts/pace.js'?>" type="text/javascript"></script>
     <script src="<?php echo base_url().'assets/scripts/offline.js'?>" type="text/javascript"></script>
    <script src="<?php echo base_url().'assets/scripts/offline-simulate-ui.min.js'?>" type="text/javascript"></script>
     <script src="<?php echo base_url().'assets/scripts/select2.js'?>" type="text/javascript"></script>
     
	
    <title>HCMP | <?php echo $title;?></title>
    <style type="text/css">
        body {
        padding-top: 2px;
        margin-bottom: 60px !important;
        }
        .panel,.page-header
        
{
  border-radius: 0 !important;
}
.modal-content,.form-control
{
  border-radius: 0 !important;
}
    </style>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  <style id="holderjs-style" type="text/css"></style><script type="text/javascript" src="chrome-extension://bfbmjmiodbnnpllbbbfblcplfjjepjdn/js/injected.js"></script>
  <link type="text/css" rel="stylesheet" href="chrome-extension://cpngackimfmofbokmjmljamhdncknpmg/style.css">
  <script type="text/javascript" charset="utf-8" src="chrome-extension://cpngackimfmofbokmjmljamhdncknpmg/js/page_context.js">
  	
  </script>
<script>
    $(function(){

        var 
            $online = $('.online'),
            $offline = $('.offline');

        Offline.on('confirmed-down', function () {
            $online.fadeOut(function () {
                $offline.fadeIn();
            });
        });

        Offline.on('confirmed-up', function () {
            $offline.fadeOut(function () {
                $online.fadeIn();
            });
        });

    });
</script>
 </head>

<body screen_capture_injected="true" >
    
         <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header" id="st-trigger-effects">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand " href="#" data-effect="st-effect-7">☰ Menu</a>

        </div>
        <div class="navbar-header" >
  
            <a href="<?php echo base_url().'Home';?>">   
            <img style="display:inline-block;"  src="<?php echo base_url();?>assets/img/coat_of_arms_dash.png" class="img-responsive " alt="Responsive image" id="logo" ></a>
            <div id="" style="display:inline-block;">
                    <span style="font-size: 0.95em;font-weight: bold; ">Ministry of Health</span><br />
                    <span style="font-size: 0.85em;">Health Commodities Management Platform (HCMP)</span>   
                </div>
        </div>
        <div class="collapse navbar-collapse">
          
          <ul class="nav navbar-nav navbar-right">
           <!-- <li class="active"><a href="<?php echo site_url().'Home';?>">Home</a></li>-->
            

            
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Welcome, <?php echo $this -> session -> userdata('full_name');?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/user/preferences"><span class="glyphicon glyphicon-cog" style="margin-right: 2%;"></span> Preferences</a></li>
                            
                            <li class="divider"></li>
                            <li><a href="<?php echo site_url("user/logout");?>"><span class="glyphicon glyphicon-off" style="margin-right: 2%;"></span> Logout</a></li>
                        </ul>
                    </li>
          </ul>

                              
        </div><!--/.nav-collapse -->

      </div>
    </div>
    <div class="container"></div>
<div id="st-container" class="st-container" style="padding-top: 3.8%;margin-bottom: 60px !important;" >
           
            <!-- content push wrapper -->
            <div class="container-fluid st-pusher">
                </nav>

                <nav class="st-menu st-effect-7" id="menu-7">
                    <h2 class="icon icon-lab">Sidebar</h2>
                    <ul>
                        <li><a class="icon icon-data" href="<?php echo base_url().'Home';?>">Home</a></li>
                        <li><a class="icon icon-study" href="<?php echo base_url().'admin/manage_commodities';?>">Commodities</a></li>
                        <li><a class="icon icon-location" href="<?php echo base_url().'admin/manage_users';?>">User Management</a></li>
                        <li><a class="icon icon-photo" href="<?php echo base_url().'admin/manage_facilities'?>">Facility Management</a></li>
                        <li><a class="icon icon-wallet" href="#">Counties</a></li>
                        <li><a class="icon icon-wallet" href="#">Sub-Counties</a></li>
                        <li><a class="icon icon-photo" href="<?php echo base_url().'admin/report_management'?>">Report Management</a></li>
                    </ul>
                </nav>

                 <div class="container-fluid" style="padding-left: 8px;padding-right: 2px;padding-bottom:42px;"><!-- this is the wrapper for the content -->
   
                   <?php $this -> load -> view($content_view);?>
                    
                    
                </div><!-- /container-fluid
            </div><!-- /st-pusher -->
        </div><!-- /st-container -->
        <div id="footer" style="">
      <div class="container">
        <p class="text-muted"> Government of Kenya &copy <?php echo date('Y');?>. All Rights Reserved</p>
      </div>
    </div>
                 <!----------- HCMP MODAL dialog Box for all uses--------->
<div class="modal fade" id="communication_dialog" tabindex="-1" role="dialog"
 aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">HCMP: Notification Message</h4>
      </div>
      <div class="modal-body" style="max-height: 500px; overflow-y: auto">   
      </div>
      <div class="modal-footer">         
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->  
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="<?php echo base_url().'assets/boot-strap3/js/bootstrap.min.js'?>" type="text/javascript"></script>
    <!-- Bootstrap core JavaScript===================== -->	
  <script src="<?php echo base_url().'assets/scripts/jquery-ui-1.10.4.custom.min.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/scripts/highcharts.js'?>" type="text/javascript"></script>
   <script src="<?php echo base_url().'assets/scripts/exporting.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/scripts/jquery.floatThead.min.js'?>" type="text/javascript"></script>	
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="<?php echo base_url().'assets/scripts/hcmp_shared_functions.js'?>" type="text/javascript"></script>
    <!--Datatables==========================  -->
  <script src="<?php echo base_url().'assets/datatable/jquery.dataTables.min.js'?>" type="text/javascript"></script>	
  <script src="<?php echo base_url().'assets/datatable/dataTables.bootstrap.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/datatable/TableTools.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/datatable/ZeroClipboard.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/datatable/dataTables.bootstrapPagination.js'?>" type="text/javascript"></script>
  <!-- validation ===================== -->
  <script src="<?php echo base_url().'assets/scripts/jquery.validate.min.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/datatable/dataTables.bootstrapPagination.js'?>" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/scripts/jquery.loadingbar.js'?>"></script>
    <script src="<?php echo base_url().'assets/scripts/sidebarEffects.js'?>" type="text/javascript"></script>
    <script src="<?php echo base_url().'assets/scripts/classie.js'?>" type="text/javascript"></script>
	 
</body>
</html>