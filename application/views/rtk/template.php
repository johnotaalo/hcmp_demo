<html lang="en"><head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">   
        <!-- Bootstrap core CSS -->   
        <link rel="icon" href="<?php echo base_url() . 'assets/img/coat_of_arms.png' ?>" type="image/x-icon" />
        <link href="<?php echo base_url() . 'assets/css/style.css' ?>" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url() . 'assets/css/dashboard.css' ?>" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url() . 'assets/boot-strap3/css/bootstrap.min.css' ?>" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url() . 'assets/boot-strap3/css/bootstrap-responsive.css' ?>" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url() . 'assets/css/normalize.css' ?>" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url() . 'assets/css/jquery-ui-1.10.4.custom.min.css' ?>" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url() . 'assets/css/font-awesome.min.css' ?>" type="text/css" rel="stylesheet"/>
        <script src="<?php echo base_url() . 'assets/scripts/jquery-1.8.0.js' ?>" type="text/javascript"></script>
        <link href="<?php echo base_url() . 'assets/datatable/TableTools.css' ?>" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url() . 'assets/datatable/dataTables.bootstrap.css' ?>" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url() . 'assets/css/font-awesome.min.css' ?>" type="text/css" rel="stylesheet"/>
        <script src="<?php echo base_url() . 'assets/scripts/jquery.js' ?>" type="text/javascript"></script>
        <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablesorter.js"></script>
        <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.metadata.js"></script>
        <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablecloth.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/tablecloth/assets/css/tablecloth.css">
        <script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/datatable/jquery.dataTables.js"></script>


        <title>HCMP | <?php echo $title; ?></title>

        <style>
            .active-panel{
                border-left: 6px solid #36BB24;
            }
        </style>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </script>
    </head>
<body screen_capture_injected="true" style="">

    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img style="display:inline-block;" src="<?php echo base_url(); ?>assets/img/coat_of_arms-resized1.png" class="img-responsive " alt="Responsive image">
                <div id="" style="display:inline-block;">
                    <span style="font-size: 0.95em;font-weight: bold; ">Ministry of Health</span><br />
                    <span style="font-size: 0.85em;">Health Commodities Management Platform (HCMP)</span>	
                </div>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right" >
                    <li><a class="" href="<?php echo site_url() . 'Home'; ?>" >HOME</a> </li>   
                    <?php
//Retrieve all accessible menus/submenus from the session
                    $menus = $this->session->userdata('menus');
                    $sub_menus = $this->session->userdata('sub_menus');
//Loop through all menus to display them in the top panel menu section
                    foreach ($menus as $menu) {
                        ?>
                        <li class="">
                            <a href="<?php echo site_url($menu['menu_url']); ?>" id="sub" class=""><?php echo $menu['menu_text']; ?></a>           	
                            <ul  class="dropdown-menu" style="min-width: 0">           		
                                <?php
                                foreach ($sub_menus as $sub_menu) {
                                    if ($menu['menu_id'] == $sub_menu['menu_id']) {
                                        ?>

                                        <li><a style="background: whitesmoke;color: black !important" class="" href="<?php echo $sub_menu['submenu_url'] ?>">
                                                <?php echo $sub_menu['submenu_text'] ?></a></li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </li>

                        <?php
                    }
                    ?>
                    <li class="dropdown ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user" ></span><?php echo $this->session->userdata('full_name'); ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <!--li><a style="background: whitesmoke;color: black !important" href="<?php echo site_url("user/change_password"); ?>"><span class="glyphicon glyphicon-pencil" style="margin-right: 2%;"></span>Change password</a></li-->                
                            <li><a style="background: whitesmoke;color: black !important" href="#" data-toggle="modal" data-target="#Change_Password"><span class="glyphicon glyphicon-pencil" style="margin-right: 2%;"></span>Change password</a></li>                
                            <li><a style="background: whitesmoke;color: black !important" href="<?php echo site_url("user/logout"); ?>" ><span class="glyphicon glyphicon-off" style="margin-right: 2%;"></span>Log out</a></li>               
                        </ul>
                    </li>
                </ul>         
            </div>
        </div>

    </div>   
    <div class="container-fluid" style="margin-top: 2%;">
        <div class="" style="padding:0;border-radius: 0;margin-top: -2% ">
            <h1 class="page-header" style="margin: 0;font-size: 1.3em;"><?php echo $banner_text; ?></h1>
            <?php $this->load->view($content_view); ?>
        </div>
    </div>
    <div id="footer">
        <div class="container">
            <p class="text-muted"> Government of Kenya &copy <?php echo date('Y'); ?>. All Rights Reserved</p>
        </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
    $(document).ready(function() {
        $('#message').hide();
        $('#change_password_btn').click(function() {   
            var old_pass = $('#old_pass').val();
            var new_pass = $('#new_pass').val();
            var confirm_pass = $('#confirm_pass').val();
            var user_id = $('#user_id').val();  
            if(new_pass!=confirm_pass){
                $('#message').show();
                $('#message').val('Sorry the Passwords do Not Match. Please Retry');                
                $('#message').css('color','red');
            }else{ 
                $.post("<?php echo base_url() . 'rtk_management/change_password'; ?>", {                
                    new_pass: new_pass,                                          
                    user_id:user_id,
                }).done(function(data) {                     
                    $('#message').val(data); 
                    $('#message').show();               
                    $('#message').css('color','green');
                    setTimeout(function(){
                        $('#Change_Password').modal('hide');
                    }, 5000);
                });
            }
        });
    });
       
    </script>
    <script src="<?php echo base_url() . 'assets/datatable/jquery.dataTables.min.js' ?>" type="text/javascript"></script>	
    <script src="<?php echo base_url() . 'assets/datatable/dataTables.bootstrap.js' ?>" type="text/javascript"></script>
    <script src="<?php echo base_url() . 'assets/datatable/TableTools.js' ?>" type="text/javascript"></script>
    <script src="<?php echo base_url() . 'assets/datatable/ZeroClipboard.js' ?>" type="text/javascript"></script>
    <script src="<?php echo base_url() . 'assets/datatable/dataTables.bootstrapPagination.js' ?>" type="text/javascript"></script>

    <script src="<?php echo base_url() . 'assets/scripts/jquery-ui-1.10.4.custom.min.js' ?>" type="text/javascript"></script>
    <script src="<?php echo base_url() . 'assets/scripts/highcharts.js' ?>" type="text/javascript"></script>
    <script src="<?php echo base_url() . 'assets/scripts/exporting.js' ?>" type="text/javascript"></script>  
    <script src="<?php echo base_url() . 'assets/boot-strap3/js/bootstrap.min.js' ?>" type="text/javascript"></script>	
    <script type="text/javascript" src="<?php echo base_url() . 'assets/scripts/jquery.loadingbar.js' ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/loadingbar.css' ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/elusive-webfont.css' ?>" />
    <div id="window-resizer-tooltip" style="display: none;"><a href="#" title="Edit settings" style="background-image: url(chrome-extension://kkelicaakdanhinjdeammmilcgefonfh/images/icon_19.png);"></a><span class="tooltipTitle">Window size: </span><span class="tooltipWidth" id="winWidth">1366</span> x <span class="tooltipHeight" id="winHeight">768</span><br><span class="tooltipTitle">Viewport size: </span><span class="tooltipWidth" id="vpWidth">1366</span> x <span class="tooltipHeight" id="vpHeight">449</span></div></body></html>

    <div class="modal fade" id="Change_Password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Change Password</h4>
              </div>
              <div class="modal-body">
                <p></p>
                <form id="new_change_password">       
                    <table id="change_password_table">
                      <tr>    
                        <td>Old Password</td>
                        <td><input class="form-control" id="old_pass" type="text" name="old_pass" style="width:96%"/></td>
                      </tr>   
                      <tr>
                        <td>New Password</td>
                        <td><input class="form-control" id="new_pass" type="text" name="new_pass" style="width:96%"/></td>
                      </tr>             
                      <tr>
                        <td>Confirm Password</td>
                        <td><input class="form-control" id="confirm_pass" type="text" name="confirm_pass" style="width:96%"/></td>
                      </tr>
                      <tr>
                        <td colspan="2">
                            <input class="form-control" id="message" type="text" name="message" style="width:96%" />
                        </td>                        
                      </tr>                                     
                        
                     <input class="form-control" id="user_id" type="hidden" name="user_id" style="width:96%" value="<?php echo $this->session->userdata('user_id'); ?>"/>
                      
                    </table>
                  </form>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>        
                <button type="button" id="change_password_btn" class="btn btn-primary">Change</button>
              </div>
            </div>
          </div>
        </div>
