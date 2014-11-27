<div class="col-md-2" style="border-right: solid 1px #ccc;padding-right: 20px;margin-left:-5px">
    <div id="switch">
        <button id="switch_back" class="form-control">Switch to Current Month</button>
    </div>
    <select id="switch_county" class="form-control" style="max-width: 220px;background-color: #ffffff;border: 1px solid #cccccc;">
        <option>-- Select County --</option>
        <?php echo $option; ?>
    </select>

    <select id="switch_month" class="form-control" style="max-width: 220px;background-color: #ffffff;border: 1px solid #cccccc;">       
        <?php 

            for ($i=1; $i <=12 ; $i++) { 
            $month = date('m', strtotime("-$i month")); 
            $year = date('Y', strtotime("-$i month")); 
            $month_value = $month.$year;
            $month_text =  date('F', strtotime("-$i month")); 
            $month_text = "-- ".$month_text." ".$year." --";
         ?>
        <option value="<?php echo $month_value ?>"><?php echo $month_text ?></option>;
    <?php } ?>
    </select>

    <ul class="nav nav-pills nav-stacked" style="font-size:100%;border:ridge 1px #ccc">
        <li><a href="<?php echo base_url().'rtk_management/county_home'?>">
            <span class="glyphicon "> Summary</span>
           </a></li>        
        <li><a href="<?php echo base_url().'rtk_management/rca_districts'?>">Sub-Counties</a></li>
        <li><a href="<?php echo base_url().'rtk_management/county_stock'?>">Stock Card</a></li>
        <li><a href="<?php echo base_url().'rtk_management/rca_pending_facilities'?>">Non-Reported Facilities</a></li>
        <li><a href="<?php echo base_url().'rtk_management/rca_facilities_reports' ?>">Reports</a></li>
        <li><a href="<?php echo base_url().'rtk_management/county_admin/users' ?>">Users</a></li>
        <li><a href="<?php echo base_url().'rtk_management/county_admin/facilities' ?>">Facilities</a></li>
        <li><a href="<?php echo base_url().'rtk_management/county_trend' ?>">
            <span class="glyphicon"> Trends</span>
            </a>
        </li>
    </ul>
</div>

<style type="text/css">
    .nav-pills li{
        width: 100%;
        background-color: #FFF;
        color: green;
        border: 1px ridge;
        font-size: 120%;

    }
    .nav-pills a{
        color: green;
    }
</style>