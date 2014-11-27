 <style type="text/css">
.extra{
	font-size: 133%; 
    padding: 15px;
    border: 1px #ECE8E8 solid;
    border-bottom: 8px solid #D4D48B;
    border-radius: 0px 6px 6px 10px;    
}
.extra:hover{
	background: #FCFAFA;
	border: 1px #EBD3D3 solid;
	border-bottom: 8px solid #F32A72;
}
.extra>span,.extra>span>a:hover{
	font-size: 30px;text-shadow: 2px 2px #EBEBEB;
	text-decoration: none;
}
.progress{
	height: 8px;
}
 </style>



<div id="nav" style="margin-top:10px;width:100%"><?php include('allocation_links.php');?></div>
<div class="row" style="width:100%; margin-top:4%;margin-left:4%;float:left;">
<!--div class="span3">
<<ul class="nav nav-tabs nav-stacked">
                 <li class="active"><a href="#"></a></li>
                 <li><a href="#"></a></li>
                 <li><a href="#"></a></li>
               </ul>
               >
               </div-->
<div class="span3 extra">
<span><a href="<?php echo base_url().'rtk_management/allocation_zone/a'?>">ZONE A</a></span><br>
<?php echo $zone_a_stats['allocation_percentage']; ?>% allocated
<div class="progress progress-info">
<div class="bar" style="width: <?php echo $zone_a_stats['allocation_percentage']; ?>%"></div>
</div>
Last Allocated <?php echo date('d,F Y', $zone_a_stats['last_allocation']); ?>
</div>
<div class="span3 extra">
<span><a href="<?php echo base_url().'rtk_management/allocation_zone/b'?>">ZONE B</a></span><br>
<?php echo $zone_b_stats['allocation_percentage']; ?>% allocated
<div class="progress progress-info">
<div class="bar" style="width: <?php echo $zone_b_stats['allocation_percentage']; ?>%"></div>
</div>
Last Allocated <?php echo date('d,F Y', $zone_b_stats['last_allocation']); ?>
</div>
<div class="span3 extra">
<span><a href="<?php echo base_url().'rtk_management/allocation_zone/c'?>">ZONE C</a></span><br>
<?php echo $zone_c_stats['allocation_percentage']; ?>% allocated
<div class="progress progress-info">
<div class="bar" style="width: <?php echo $zone_c_stats['allocation_percentage']; ?>%"></div>
</div>
Last Allocated <?php echo date('d,F Y', $zone_c_stats['last_allocation']); ?>
</div>
<div class="span3 extra">
<span><a href="<?php echo base_url().'rtk_management/allocation_zone/d'?>">ZONE D</a></span><br>
<?php echo $zone_d_stats['allocation_percentage']; ?>% allocated
<div class="progress progress-info">
<div class="bar" style="width: <?php echo $zone_d_stats['allocation_percentage']; ?>%"></div>
</div>
Last Allocated <?php echo date('d,F Y', $zone_d_stats['last_allocation']); ?>
</div>


</div>

<script type="text/javascript">
  $('#trend_tab').removeClass('active_tab');    
  $('#stocks_tab').removeClass('active_tab');  
  $('#allocations_tab').addClass('active_tab');
</script>