

<script src="<?php echo base_url().'Scripts/accordion.js'?>" type="text/javascript"></script>
<SCRIPT LANGUAGE="Javascript" SRC="<?php echo base_url();?>Scripts/FusionCharts/FusionCharts.js"></SCRIPT> 
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
    <style type="text/css" title="currentStyle">
      
      @import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
    </style>
    <script type="text/javascript">
    $(document).ready(function(){
       $('#example_main').dataTable({
          "bJQueryUI": true,
          "bPaginate": false,
          "aaSorting": [[ 3, "asc" ]]
        } );
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
 
  <h3 class="accordion" >Reports <span></span><h3>
<div class="container">
  
   <div class="content">
    <select id="facilities" class="dropdownsize">
    <option>--Select Facility--</option>
        <?php 
        foreach ($facilities as $counties) {
            $facility_code=$counties['facility_code'];
            $facility_name=$counties['facility_name'];
            
            ?>
            <option value="<?php echo $facility_code.'|'.$facility_name?>"><?php echo $facility_name;?></option>
        <?php }
        ?>
    </select>   
  <input  type="hidden"  name="facilities" id="facilities" value="<?php echo $facility_name;?>" />

<select id="report" class="dropdownsize">
    <option>--Select Report--</option>
    <option value="fcdrr">FCDRR</option>
  <option value="lab">LAB COMMODITIES</option>
        
    </select>   
  <input  type="hidden"  type="submit" value="Submit" />

   <h2>Select Month</h2>
  <select id="month" class="dropdownsize" placeholder="Month">
    <option value="01">January</option>
    <option value="02">February</option>
    <option value="03">March</option>
    <option value="04">April</option>
    <option value="05">May</option>
    <option value="06">June</option>
    <option value="07">July</option>
    <option value="08">August</option>
    <option value="09">September</option>
    <option value="10">October</option>
    <option value="11">November</option>
    <option value="12">December</option>
  </select>

    <h2>Select Year</h2>
    <select id="year" class="dropdownsize" placeholder="Year">
    <?php $this_year=date('Y');

    for ($i=0; $i < 5 ; $i++) { ?>
    <option value="<?php echo $this_year-$i; ?>"><?php echo $this_year-$i; ?></option>
      <?php } ?>
      </select>
<a href="<?php echo base_url().'rtk_management/view_report'?>"><button class="awesome blue" id="generate" style="margin-left:30%" align="left">Generate Report</button></a>
  </div>
</div>




  <h3 class="accordion" >Statistics<span></span><h3>
<div class="container">
  
  <nav class="sidenav">
  <ul>
  

  </ul>
</nav>

</div>



</div>

  
<div class="sidebar">
  <a href="<?php echo site_url('rtk_management/rtk_orders');?>">&nbsp;</a>
  
    
<nav class="sidenav">
  <ul>
    <li class="orders_minibar"><a href="<?php echo site_url('rtk_management/rtk_orders');?>" style="
    margin: 0;  padding: 5%;  height: 15px;  border-top: #f0f0f0 1px solid;  background: #cccccc;  font: normal 1.3em 'Trebuchet MS',Arial,Sans-Serif;  text-decoration: none;  text-transform: uppercase;  background: #29527b;  border-radius: 0.5em;  color: #fff;
">Orders</a></li>
        <!--<li class="orders_minibar"><a href="<?php echo site_url('rtk_management/rtk_orders');?>">Pending
    <span style="
    font-weight: 400;
    font-size: 1.5em;
    color: #F3EA0B;
    float: right;
    background: rgb(216, 40, 40);
    padding: 4px;
    border-radius: 28px;
    border: solid 1px rgb(150, 98, 98);
">30</span>
</a> </li>-->
 
  </ul>
</nav>


     
  
</div>

  
</div>

<div class="dash_main" id = "dash_main">
  

 
    <?php $district=$this->session->userdata('district1');
      $district_name=Districts::get_district_name($district)->toArray();
      $d_name=$district_name[0]['district']; ?>
      <?php if(isset($popout)){ ?><div id="dialog" title="System Message"><p><?php echo $popout;?></p></div><?php }?>

   <p id="notification" >RTK Facilities in <?php echo $d_name ?> District</p>
       
       <div style="float:left;"><img src="<?php echo base_url().'/Images/check_mark_resize.png'?>"></img>
        <p id="notification">A check mark indicates that that report has been submitted for that facility within the past month</p>
      </div>
            <table  style="margin-left: 0;" id="example_main" width="100%" >
          <thead>
          <tr>
            <th><b>MFL Code</b></th>
            <th><b>Facility Name</b></th>
            <th><b>Owner</b></th>
            <th ><b>FCDRR Reports</b></th> 
                        
          </tr>
          </thead>
          <tbody>
    <?php echo $table_body; ?>
              
        </tbody>            
        </table>

    </div>
    </div>

</div>



