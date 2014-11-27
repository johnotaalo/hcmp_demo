 <style type="text/css">
.dash{    
    padding: 15px;
    border: 1px #ECE8E8 solid;
    border-bottom: 8px solid #428bca;
    border-radius: 0px 6px 6px 10px;
    min-width: 28%;
    width: auto;
    height: auto;
    margin-top: 10px;
    color: #428bca;
}
.dash a{
  text-decoration: none;
}
.details{
  font-size: 28px;  
  height: 15%;
  border-bottom: 1px ridge #ccc;

}
.facils{
  height: 10%;
  padding-top: 2px;
  font-size: 18px;
}
.dash:hover{
	background: #FCFAFA;
	border: 1px #EBD3D3 solid;
  color: #003300;
	border-bottom: 8px solid #003300;
}
.extra>span,.extra>span>a:hover{
	font-size: 30px;text-shadow: 0px 0px #003300;
	text-decoration: none;
}
.progress{
	height: 8px;
}
 </style>




<div class="row" style="width:100%; margin-top:2%;margin-left:4%;">
  <div id="rtk" class="dash span">
    <a href="<?php echo base_url().'rtk_management/allocation_trend'?>">
      <div class="details">RTK ALLOCATION</div><br/>
      <div class="facils">Total Facilities Supported: <?php echo $rtk[0]['rtk'];?></div>      
    </a>
  </div>
  <div id="cd4" class="dash span">
     <a href="<?php echo base_url().'cd4_management'?>">
      <div class="details">CD4 ALLOCATION</div><br/>
      <div class="facils">Total Sites Supported: <?php echo $cd4[0]['cd4'];?></div>      
    </a>
  </div>
  <div id="eid" class="dash span">
     <a href="<?php echo base_url().'eid_management'?>">
      <div class="details">EID/VL ALLOCATION</div><br/>
      <div class="facils">Total Labs Supported: <?php echo $eid[0]['eid'];?></div>      
    </a>
  </div>  
</div>