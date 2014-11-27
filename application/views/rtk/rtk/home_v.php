<?php
$month = $this->session->userdata('Month');
if ($month==''){
 $month = date('mY',time());
}
$year= substr($month, -4);
$month= substr_replace($month,"", -4);
$monthyear = $year . '-' . $month . '-1';
$englishdate = date('F, Y', strtotime($monthyear));
$englishdate = date('F, Y', strtotime('previous month'));
$this->load->database();
$q = 'SELECT id,county FROM  `counties` ORDER BY  `counties`.`county` ASC ';
$res_arr = $this->db->query($q);
$counties_option_html="";
foreach ($res_arr->result_array() as  $value) {
  $counties_option_html .='<option value="'.$value['id'].'">'.$value['county'].'</option>';
}
$districts_option_html = "";
$q1 = 'SELECT id,district,county FROM  `districts` ORDER BY  `districts`.`district` ASC ';
$res_arr1 = $this->db->query($q1);
foreach ($res_arr1->result_array() as  $value) {
  $districts_option_html .='<option county="'.$value['county'].'" value="'.$value['id'].'">'.$value['district'].'</option>';
}

$thismonthname  = date('F',strtotime("-1 month", time()));
$prevmonthname = date('F',strtotime("-2 month", time()));
$prev_prevmonthname = date('F',strtotime("-3 month", time()));


?>
<script type="text/javascript">
  function loadcountysummary(county){
            $(".dash_main").load("<?php echo base_url(); ?>rtk_management/rtk_reporting_by_county/" + county);
            $("#county_summary").load("<?php echo base_url(); ?>rtk_management/summary_tab_display/" + county + "/<?php echo $year.'/'.$month.'/'; ?>");
            $("#county_graph").load("<?php echo base_url(); ?>rtk_management/fusion_test/" + county + "/<?php echo $month.'/'.$year.'/'; ?>");

   }
$(document).ready(function(){

//  $(".breadcrumb").load("<?php echo base_url(); ?>rtk_management/reporting_counties/<?php echo $month.'/'.$year.'/'; ?>");
  $(".breadcrumb a").click( function(event)
{
   var clicked =  $(this).text();
   $( "#selectedcounty" ).html(clicked);
});
 
  $("#user_switch").change(function(){
  var val = $('#user_switch').val();
  if(val == 'scmlt'){
  $('#county_switch').attr('disabled','disabled');
  $('#district_switch').removeAttr('disabled');
  }
  if(val == 'rtk_county_admin'){
  $('#county_switch').removeAttr('disabled');
  $('#district_switch').attr('disabled','disabled');
  }
  });

  $("#switch_idenity").click(function(event)
  {
  var switch_as = $('#user_switch').val();
  var switch_county = $('#county_switch option:selected').val();
  var switch_dist = $('#district_switch').val();

if (switch_dist>0){
  switch_county = $('#district_switch option:selected').attr('county');
//  switch_county = $('#district_switch:selected').attr('county').val();
//alert(switch_county);
var path = "<?php echo base_url() . 'rtk_management/switch_district'; ?>/"+switch_dist+"/"+switch_as+"/0/0/"+switch_county+"/rtk_manager";
  window.location.href=path;


}

  var path = "<?php echo base_url() . 'rtk_management/switch_district'; ?>/"+switch_dist+"/"+switch_as+"/0/0/"+switch_county+"/rtk_manager";

//  rtk_management/switch_district/district/switched_as/month/redirect_url/county
  window.location.href=path;

  });


            $('#switch_month').change(function(){
                var value = $('#switch_month').val();
              var path = "<?php echo base_url().'rtk_management/switch_district/0/rtk_manager/';?>"+value + "/";
//              alert (path);
                 window.location.href=path;
            });

   
               });
</script>
<style>
#inner_wrapper
{
  margin-bottom: 100px;
}
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
#1287{
  color:#fff;
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

<div>
<?php { ?>
<div id="fixed-topbar" style="z-index:10;position: fixed; top: 74px;background: #708BA5; width: 100%;padding: 7px 1px 0px 13px;border-bottom: 1px solid #ccc;border-bottom: 1px solid #ccc;border-radius: 4px 0px 0px 4px;">
<span class="lead" style="color: #ccc;float:left;">Switch Identities</span>
&nbsp;
<select id="user_switch" class="form-control" style="width:20%;float:left;margin-left:200px;"><option value="0"> -- Select UserType--</option><option value="scmlt">SCMLT</option><option value="rtk_county_admin">County Administrator</option>
</select>
&nbsp;
<select id="county_switch" class="form-control" style="width:20%;float:left"><option value="0"> -- Select County --</option><?php echo $counties_option_html;?></select>
&nbsp;
<select id="district_switch" class="form-control" style="width:20%;float:left"><option value="0"> -- Select Sub-County --</option><?php echo $districts_option_html;?></select>
&nbsp;
<a href="#" class="btn btn-primary" id="switch_idenity" style="margin-top: 0px;float:left">Go</a>
</div>
<?php } ?>

 


<div class="well" style="width:97%;"> 
<div class="page-header">
 
     <h1 style="font-size: 140%;">County Summary <?php echo $englishdate;?><small> Kenya</small></h1>
   </div>
<!--     <h4>Leading County in reporting: Nakuru</h4>-->
     <div id="county_graph"></div>
     
     <div id="container" style="min-width: 310px; width:97%; height: 1400px; margin: 0 auto"></div>

  
</div>
    
</div>

<script type="text/javascript">$(function () {
        $('#container').highcharts({

            credits: {
      enabled: false
    },
            chart: {
                type: 'bar'
            },
            title: {
                text: 'RTK Monthly reporting rates'
            },
            subtitle: {
                text: 'RTK Data'
            },
            xAxis: {
                categories: <?php echo $counties_json; ?>
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Percentage reporting'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: '#FFFFFF',
                shadow: true
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: '<?php echo $prev_prevmonthname; ?>',
                data: <?php echo $prev_prev_monthjson; ?>
    
            },{
                name: '<?php echo $prevmonthname; ?>',
                data: <?php echo $previous_monthjson; ?>
    
            },  {
                name: '<?php echo $thismonthname; ?>',
                data: <?php echo $thismonthjson; ?>
    
            }]
        });
    });
    
</script>