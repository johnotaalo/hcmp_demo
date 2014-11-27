<?php
$this -> load -> database();
$q = 'SELECT id,county FROM  `counties` ORDER BY  `counties`.`county` ASC   ';
$res_arr = $this -> db -> query($q);
$counties_option_html = "";
foreach ($res_arr->result_array() as $value) {
	$counties_option_html .= '<option value="' . $value['id'] . '">' . $value['county'] . '</option>';
}
 ?>
<script type="text/javascript">
	$(document).ready(function(){
	$("#user_switch").change(function(){
	var val = $('#user_switch').val();
	if(val == 'dpp'){
	$('#county_switch').attr('disabled','disabled');
	$('#district_switch').removeAttr('disabled');
	}
	if(val == 'rca'){
	$('#county_switch').removeAttr('disabled');
	$('#district_switch').attr('disabled','disabled');
	}
	});

	$("#switch_idenity").click(function(event)
	{
	var switch_as = $('#user_switch').val();
	var switch_county = $('#county_switch option:selected').val();
	var switch_dist = $('#district_switch').val();

	//         switch_district($new_dist, $switched_as, $month, $redirect_url,$newcounty)

	var path = "<?php echo base_url() . 'rtk_management/switch_district'; ?>/"+switch_dist+"/"+switch_as+"/0/0/"+switch_county+"/";
//document.write(path);
//    alert (path);
window.location.href=path;

  });

            $('#switch_month').change(function(){
                var value = $('#switch_month').val();
              var path = "<?php echo base_url() . 'rtk_management/switch_district/0/rtk_manager/'; ?>"+value + "/";
//              alert (path);
                 window.location.href=path;
            });
               });
</script>
<?php {?>
<div id="fixed-topbar" style="position: fixed; top: 104px;background: #708BA5; width: 100%;padding: 7px 1px 0px 13px;border-bottom: 1px solid #ccc;border-bottom: 1px solid #ccc;border-radius: 4px 0px 0px 4px;">
<span class="lead" style="color: #ccc;">Switch Identities</span>
&nbsp;
<select id="user_switch"><option value="0"> -- Select UserType--</option><option value="dpp">DMLT</option><option value="rca">County Administrator</option>
</select>
&nbsp;
<select id="county_switch"><option value="0"> -- Select Select County--</option><?php echo $counties_option_html; ?></select>
&nbsp;
<select id="district_switch"><option value="0"> -- Select Select District--</option></select>
&nbsp;
<a href="#" class="btn btn-primary" id="switch_idenity" style="margin-top: -10px;">Go</a>
</div>
<?php } ?>
