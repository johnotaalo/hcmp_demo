<?php $this->load->helper('url');
 $this->load->helper('form');

?>
<script>
	json_obj = {
				"url" : "<?php echo base_url().'Images/calendar.gif';?>",
				};
	var baseUrl=json_obj.url;
	
	$(function() {
		$("#accordion").accordion({
			autoHeight : false,
			collapsible: true,
			active: false
		});
		$( "#datepicker" ).datepicker({
			showOn: "button",
			dateFormat: 'yy-mm-dd', 
			buttonImage: baseUrl,
			buttonImageOnly: true
		});
	});

$(function() {
		$("#accordion").accordion({
			autoHeight : false,
			active: false,
			collapsible: true
		});
	});
	
jQuery(function($) {

    var multiTags = $("#multi");

    function handler(e) {
        var jqEl = $(e.currentTarget);
        var tag = jqEl.parent();
        switch (jqEl.attr("data-action")) {
        case "add":
            tag.after(tag.clone().find("input").val("").end());
            break;
        case "delete":
            tag.remove();
            break;
        }
        return false;
    }

    function save(e) {
        var tags = multiTags.find("input.tag").map(function() {
            return $(this).val();
        }).get().join(',');
        alert(tags);
        return false;
    }

    multiTags.submit(save).find("a").live("click", handler);
});
</script>
<style>
	td {
		padding: 5px;
	}
</style>

<style>
	td {
		padding: 5px;
	}
	form {
    font-family: helvetica, arial, sans-serif;
    font-size: 11px;
}

form div{
    margin-bottom:10px;
}

form a {
    font-size: 12px;
    padding: 4px 10px;
    border: 1px solid #444444;
    background: #555555;
    color:#f7f7f7;
    text-decoration:none;
    vertical-align: middle;
}

form a:hover{
    color:#ffffff;
    background:#111111;   
}

#multi label {
    margin-left:20px;
    margin-right:5px;
    font-size:12px;
    background:#f7f7f7;
    padding: 4px 10px;
    border:1px solid #cccccc;
    vertical-align: middle;
}

#multi input[type="text"]{
    height:22px;
    padding-left:10px;
    padding-right:10px;
    border:1px solid #cccccc;
    vertical-align: middle;
}

#multi input[type="submit"]{
    margin-left:20px;
    border:none;
    background:#222222;
    outline:none;
    color:#ffffff;
    padding: 4px 10px;
    font-size:12px;
}


</style>
<?php 
					$this->load->helper('date');
					$today= standard_date('DATE_ATOM', time()); //get today's date in full
					$today=substr($today,0,9); //get the YYYY-MM-dd format of the date above								
				?>
	<?php //echo form_open('order_management/insert_stock');?>
	<table style="margin: 5px auto; border: 2px solid #036; font-size:14px; float: left">
		<tr>
			<td><b>Date: <input name="date" type="text" value="<?php echo $today;?>" id="datepicker"/></b></td><td></td>
			<td><b>Received By:</b></td><td> KEMSA</td>
			<td><b>Witnessed by: </b>KEMSA</td>
			
		</tr>
	</table>
	<table style="margin:0 auto">
		<tr>
			<?php 
					$this->load->helper('date');
					$today= standard_date('DATE_ATOM', time()); //get today's date in full
					$today=substr($today,0,9); //get the YYYY-MM-dd format of the date above								
				?>
			<td><label for="delivery_date">Invoice Number:</label></td>
			<td>
			<input name="date" type="text" />
			</td>
		</tr>
		<tr>
			<td><label for="delivery_note">Transport Company:</label></td>
			<td>
			<input name="note" type="text" />
			</td>
		</tr>
		<tr>
			<td><label for="commodity_batch">Driver Name:</label></td>
			<td>
			<input name="batch" type="text" />
			</td>
		</tr>
		<tr>
			<td><label for="commodity_batch">Vehicle Reg. No:</label></td>
			<td>
			<input name="reg" type="text" />
			</td>
		</tr>
		<tr>
			<td><label for="commodity_batch">Driver Name:</label></td>
			<td>
			<input name="driver" type="text"/>
			</td>
		</tr>
		<tr>
			<td><label for="commodity_batch">Number of Boxes Received:</label></td>
			<td>
			<input name="box" type="text" />
			</td>
		</tr>
		<tr>
			<td><label for="commodity_batch">No. of other Containers Received:</label></td>
			<td>
			<input name="cont" type="text" />
			</td>
		</tr>
	</table>
	
	<div class="demo" style="margin: 10px;">
	<div id="accordion">
		
			<h3><a href="#">Breakages</a></h3>
			<div>
			<p>
				
    <div id="ekisa">
        <label>Serial Number:</label><input  class="tag" type="text" name="" type="text" style="width: 50px" />
        <label>Item Description:</label><input class="tag" type="text" name="" type="text" style="width: 50px" />
        <label>Code Number:</label><input class="tag" type="text" name="" type="text" style="width: 50px"/>
        <label>Unit:</label><input class="tag" type="text" name="" type="text" style="width: 50px"/>
        <label>Quantity Broken</label><input class="tag" type="text" name="" type="text" style="width: 50px"/>
        <label>Comments:</label><input class="tag" type="text" name="" type="text" style="width: 50px"/>
       <input type="submit" value="Add" id="add" />
       <input type="submit" value="Remove" id="remove" />
    </div>
   <script type="text/javascript">
	
	$("#add").click(function() {
$('#ekisa').clone(true).insertAfter("#ekisa");
});

//the code above is the one for cloning. #ekisa is the object to be cloned

$("#remove").click(function() {
$("#ekisa").after().remove();
});

</script>
	</p>
		</div>
		<h3><a href="#">Missing Items</a></h3>
			<div>
			<p>
				
    <div id="ekisa1">
        <label>Serial Number:</label><input  class="tag" type="text" name="" type="text" style="width: 50px" />
        <label>Item Description:</label><input class="tag" type="text" name="" type="text" style="width: 50px" />
        <label>Code Number:</label><input class="tag" type="text" name="" type="text" style="width: 50px"/>
        <label>Unit:</label><input class="tag" type="text" name="" type="text" style="width: 50px"/>
        <label>Quantity Broken</label><input class="tag" type="text" name="" type="text" style="width: 50px"/>
        <label>Comments:</label><input class="tag" type="text" name="" type="text" style="width: 50px"/>
       <input type="submit" value="Add" id="add1" />
       <input type="submit" value="Remove" id="remove" />
    </div>
   <script type="text/javascript">
	
	$("#add1").click(function() {
$('#ekisa1').clone(true).insertAfter("#ekisa1");
});

//the code above is the one for cloning. #ekisa is the object to be cloned

$("#remove1").click(function() {
$("#ekisa1").after().remove();
});

</script>
	</p>
		</div>
		<h3><a href="#">Items Issued in Errors</a></h3>
			<div>
			<p>
				
    <div id="ekisa2">
        <label>Serial Number:</label><input  class="tag" type="text" name="" type="text" style="width: 50px" />
        <label>Item Description:</label><input class="tag" type="text" name="" type="text" style="width: 50px" />
        <label>Code Number:</label><input class="tag" type="text" name="" type="text" style="width: 50px"/>
        <label>Unit:</label><input class="tag" type="text" name="" type="text" style="width: 50px"/>
        <label>Quantity Broken</label><input class="tag" type="text" name="" type="text" style="width: 50px"/>
        <label>Comments:</label><input class="tag" type="text" name="" type="text" style="width: 50px"/>
       <input type="submit" value="Add" id="add2" />
       <input type="submit" value="Remove" id="remove2" />
    </div>
   <script type="text/javascript">
	
	$("#add2").click(function() {
$('#ekisa2').clone(true).insertAfter("#ekisa2");
});

//the code above is the one for cloning. #ekisa is the object to be cloned

$("#remove2").click(function() {
$("#ekisa2").after().remove();
});

</script>
	</p>
		</div>
	</div>

	<table style="margin:0 auto">
		<tr>
			<td><label for="comments">Any other discrepancies or comments:</label></td><td>			<textarea name="comments"></textarea></td>
		</tr>
		<tr>
			<td colspan="2">
			<input type="submit"  class="button" value="Save Delivery Update" />
			</td>
		</tr>
	</table>
</form>
