<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">   
    <!-- Bootstrap core CSS -->  
    <link rel="icon" href="<?php echo base_url().'assets/img/coat_of_arms.png'?>" type="image/x-icon" />
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
    <script src="<?php echo base_url().'assets/scripts/jquery.js'?>" type="text/javascript"></script>
    <link href="<?php echo base_url().'assets/datatable/TableTools.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/datatable/dataTables.bootstrap.css'?>" type="text/css" rel="stylesheet"/>
    <script src="<?php echo base_url('assets/scripts/county_sub_county_functions.js')?>" type="text/javascript"></script>
     <link href="<?php echo base_url().'assets/css/offline-theme-default.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/offline-language-english.css'?>" type="text/css" rel="stylesheet"/>
     <script src="<?php echo base_url().'assets/scripts/offline.js'?>" type="text/javascript"></script>
    <script src="<?php echo base_url().'assets/scripts/offline-simulate-ui.min.js'?>" type="text/javascript"></script>
    <title>HCMP | <?php echo $title;?></title>

<style>
	.active-panel{
    	border-left: 6px solid #36BB24;
    }
    body {
padding-top: 0;
}
#main-content{
  margin-top: 4.5%;
  
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
  </script></head>
  <body screen_capture_injected="true" style="">

    <div class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin:0;">
        <div class="container-fluid">
            <div class="navbar-header" id="st-trigger-effects">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          

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
            <li class="active"><a href="<?php echo site_url().'Home';?>">Home</a></li>
            <?php
//Retrieve all accessible menus/submenus from the session
$menus= $this -> session -> userdata('menus');
$sub_menus= $this -> session -> userdata('sub_menus');
//Loop through all menus to display them in the top panel menu section
foreach($menus as $menu){?>
    <li class="">
                <a href="<?php echo site_url($menu['menu_url']); ?>" id="sub" class=""><?php echo $menu['menu_text'];?></a>             
                <ul  class="dropdown-menu" style="min-width: 0">                
                    <?php 
                foreach($sub_menus as $sub_menu){
                    if ($menu['menu_id']==$sub_menu['menu_id']) {?>
                        
                        <li><a style="background: whitesmoke;color: black !important"  class="" href="<?php echo $sub_menu['submenu_url']?>">
                            <?php echo $sub_menu['submenu_text']?></a></li>
                    <?php                   
                } 
                }
                ?>
                </ul>
                </li>
     
<?php
                    }
    ?>

            
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Welcome, <?php echo $this -> session -> userdata('full_name');?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/user/preferences"><span class="glyphicon glyphicon-cog" style="margin-right: 2%;"></span> Preferences</a></li>
                            
                            <li class="divider"></li>
                            <li><a href="<?php echo site_url("user/logout");?>"><span class="glyphicon glyphicon-off" style="margin-right: 2%;"></span> Logout</a></li>
                        </ul>
                    </li>
          </ul>
<div  id="system_alerts">
                    <?php $flash_success_data = NULL;
                          $flash_error_data = NULL;
                          $flash_success_data = $this -> session -> flashdata('system_success_message');
                          $flash_error_data = $this -> session -> flashdata('system_error_message');
                            if ($flash_success_data != NULL) {
                            echo '<div class="alert alert-success alert-dismissable" >
                            <button type="button" class=" close" data-dismiss="alert" aria-hidden="true">×</button>' . $flash_success_data . '</div>';
                           } elseif ($flash_error_data != NULL) {
                            echo '<div class="alert alert-danger alert-dismissable" >
                            <button type="button" class=" close" data-dismiss="alert" aria-hidden="true">×</button>' . $flash_error_data . '</div>';
                            }
                        ?>
 </div>
                              
        </div><!--/.nav-collapse -->

      </div>
    </div>
   <div class="container-fluid" style="" id="main-content">

    <?php $this -> load -> view($content_view);?>
    </div> <!-- /container -->
<div id="footer">
      <div class="container">
        <p class="text-muted"> Government of Kenya &copy <?php echo date('Y');?>. All Rights Reserved</p>
      </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
    var url='<?php echo base_url(); ?>';
    </script>
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
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/loadingbar.css'?>" />
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/elusive-webfont.css'?>" />
<div id="window-resizer-tooltip" style="display: none;"><a href="#" title="Edit settings" style="background-image: url(chrome-extension://kkelicaakdanhinjdeammmilcgefonfh/images/icon_19.png);"></a><span class="tooltipTitle">Window size: </span><span class="tooltipWidth" id="winWidth">1366</span> x <span class="tooltipHeight" id="winHeight">768</span><br><span class="tooltipTitle">Viewport size: </span><span class="tooltipWidth" id="vpWidth">1366</span> x <span class="tooltipHeight" id="vpHeight">449</span></div></body></html>