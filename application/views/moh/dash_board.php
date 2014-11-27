<?php      
      //We have included ../Includes/FusionCharts.php, which contains functions
      //to help us easily embed the charts.
      include("Scripts/FusionCharts/FusionCharts.php");?>
      <script type="text/javascript" language="javascript" src="<?php echo base_url();  ?>Scripts/unit_size.js"></script>
	    <style>
    .ui-combobox {
        position: relative;
        display: inline-block;
        margin-left: 100px;
    }
    .ui-combobox-toggle {
        position: absolute;
        top: 0;
        bottom: 0;
        margin-left: -1px;
        padding: 0;
        /* adjust styles for IE 6/7 */
        *height: 1.7em;
        *top: 0.1em;
    }
    .ui-combobox-input {
        margin: 0;
        padding: 0.3em;
    }
    </style>

<script>
  $(function() {
  	
  	   $( "#desc" ).combobox({
        	selected: function(event, ui) {
        		
           var data =$("#desc").val();
            var name =encodeURI($("#desc option:selected").text());
          
        var url = "<?php echo base_url().'report_management/moh_consumption_report' ?>"
        $.ajax({
          type: "POST",
          data: "ajax="+name+"&id="+data,
          url: url,
          beforeSend: function() {
            $("#content").html("");
          },
          success: function(msg) {
          	alert(msg);
            $("#content").html(msg);
           
          }
        });
        return false;
            
			}
			});
			
			  	   $( "#desc_2" ).combobox({
        	selected: function(event, ui) {
        		
           var data =$("#desc_2").val();
           var name =encodeURI($("#desc_2 option:selected").text());
        var url = "<?php echo base_url().'report_management/moh_category_consumption_report' ?>"
        $.ajax({
          type: "POST",
          data: "ajax="+name+"&id="+data,
          url: url,
          beforeSend: function() {
            $("#content_2").html("");
          },
          success: function(msg) {
            $("#content_2").html(msg);
           
          }
        });
        return false;
            
			}
			});
			
						  	   $( "#desc_e1" ).combobox({
        	selected: function(event, ui) {
        		
           var data =$("#desc_e1").val();
           var name =encodeURI($("#desc_e1 option:selected").text());
        var url = "<?php echo base_url().'report_management/moh_expiries_report' ?>"
        $.ajax({
          type: "POST",
          data: "ajax="+name+"&id="+data,
          url: url,
          beforeSend: function() {
            $("#content_e1").html("");
          },
          success: function(msg) {
            $("#content_e1").html(msg);
           
          }
        });
        return false;
            
			}
			});			  	   $( "#desc_e2" ).combobox({
        	selected: function(event, ui) {
        		
           var data =$("#desc_e2").val();
           var name =encodeURI($("#desc_e2 option:selected").text());
        var url = "<?php echo base_url().'report_management/moh_category_expiries_report' ?>"
        $.ajax({
          type: "POST",
          data: "ajax="+name+"&id="+data,
          url: url,
          beforeSend: function() {
            $("#content_e2").html("");
          },
          success: function(msg) {
            $("#content_e2").html(msg);
           
          }
        });
        return false;
            
			}
			});
  	
    
    
  });
  </script>

<table >
<tr>
	<td colspan="2" >
		<?php echo renderChart("".base_url()."Scripts/FusionCharts/Charts/Column2D.swf", "", $strXML_owner_count, "f1", 1000, 400, false, true);?>
	</td>
	
</tr>	
</table>
	  <h2>Consumption</h2>
<hr />
<table>
<tr>
	
	<td width="50%">

	<select id="desc" name="desc">
    <option>----Type Commodity Name-</option>
		<?php 
		foreach ($drugs as $drugs0) {
			$id=$drugs0->id;
			$drug=$drugs0->Drug_Name;
			?>
			<option value="<?php echo $id?>"><?php echo $drug;?></option>
		<?php }
		?>
	</select>
<div id="content">
 <?php echo renderChart("".base_url()."Scripts/FusionCharts/Charts/Column2D.swf", "", $strXML_c1, "c1", 500, 300, false, true);?>
  
</div>

</td>
<td >
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />

	
	

		<select id="desc_2" name="desc_2">
    <option>----Type Category Name-</option>
		<?php 
		foreach ($category as $category0) {
			$id=$category0->id;
			$category3=$category0->Category_Name;
			?>
			<option value="<?php echo $id?>"><?php echo $category3;?></option>
		<?php }
		?>
	</select>
	<div id="content_2">
 <?php echo renderChart("".base_url()."Scripts/FusionCharts/Charts/ScrollLine2D.swf", "", $strXML_c2, "c2", 600, 400, false, true);?>
  
</div>
	
</td>

</tr>
</table>
<h2>Expiries</h2>
<hr />
<table>
<tr>
	
	<td width="50%">
			<select id="desc_e1" name="desc_e1">
    <option>----Type Commodity Name-</option>
		<?php 
		foreach ($drugs as $drugs1) {
			$id=$drugs1->id;
			$drug=$drugs1->Drug_Name;
			?>
			<option value="<?php echo $id?>"><?php echo $drug;?></option>
		<?php }
		?>
	</select>
		<div id="content_e1">
 <?php echo renderChart("".base_url()."Scripts/FusionCharts/Charts/Column2D.swf", "", $strXML_e1, "e_1", 500, 300, false, true);?>
  
</div>
	</td>
	<td>
			<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
<select id="desc_e2" name="desc_e2">
    <option>----Type Category Name-</option>
		<?php 
		foreach ($category as $category_1) {
			$id=$category_1->id;
			$category=$category_1->Category_Name;
			?>
			<option value="<?php echo $id?>"><?php echo $category;?></option>
		<?php }
		?>
	</select>
		<div id="content_e2">
 <?php echo renderChart("".base_url()."Scripts/FusionCharts/Charts/ScrollLine2D.swf", "", $strXML_c2, "e_2", 600, 400, false, true);?>
  
</div>
	</td>
	
</tr>
</table>

