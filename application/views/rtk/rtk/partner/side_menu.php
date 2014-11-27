<?php
	$user = $this->session->userdata('user_indicator');
	$partners_option_html = "";
	$q2 = "SELECT ID,name FROM  `partners` ORDER BY  `partners`.`name` ASC ";
	$res_arr2 = $this->db->query($q2);
	foreach ($res_arr2->result_array() as $key => $value) {
	  $partners_option_html .='<option value="'.$value['ID'].'">'.$value['name'].'</option>';
	}
?>
<div class="col-md-2" style="border-right: solid 1px #ccc;padding-right: 20px;margin-left:-5px">
    <div id="switch">
    <?php 
    	if($user=='rtk_partner_super'){
    	?>
    	<select id="partner_switch" class="form-control" style="border-color:green">
    		<option value="0"> -- Switch Partner --</option>
    			<?php echo $partners_option_html;?>
    	</select>
    	<br/>
    	<?php
    	}
    	?>
    	
        <p class="form-control">MENU</p>
    </div>    
    <ul class="nav nav-pills nav-stacked" style="font-size:120%;border:ridge 1px #ccc">
        <li><a href="<?php echo base_url().'rtk_management/partner_home'?>">Summary</a></li> 
        <li><a href="<?php echo base_url().'rtk_management/partner_facilities' ?>">Facilities</a></li>       
        <li><a href="<?php echo base_url().'rtk_management/partner_stock_status'?>">Stock Status</a></li>
        <li><a href="<?php echo base_url().'rtk_management/partner_commodity_usage'?>">Commodity Usage</a></li>
    </ul>
</div>

<script type="text/javascript">
	$("#partner_switch").change(function(){
		var ending;
  		var switch_partner = $('#partner_switch').val();
  		var switch_county = 0;
  		var switch_dist = 0;
  		var switch_as = 'rtk_partner_super';
		if(switch_partner!=0){
		   ending = switch_partner;
		}else{
		  ending = '';
		}
		//alert(ending);
		var path = "<?php echo base_url() . 'rtk_management/switch_district'; ?>/"+switch_dist+"/"+switch_as+"/0/0/"+switch_county+"/partner_home"+"/"+ending;
		// /var path = "<?php echo base_url() . 'rtk_management/switch_district'; ?>/"+""+"/"+""+"/0/0/"+""+"/partner_home"+"/"+ending;
		window.location.href=path;
	});
	
</script>