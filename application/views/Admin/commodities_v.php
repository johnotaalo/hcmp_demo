<style>
	
	
</style>


<div class="container-fluid">
	
	<div class="row" style="margin-top: 1%;">
		<div class="col-md-12">
			
			<ul class="nav nav-tabs" id="myTab">
  <li class="active"><a href="#home" data-toggle="tab">Commodity List</a></li>
  <li><a href="#profile" data-toggle="tab">Graphs & Statistics</a></li>
  <li><a href="#messages" data-toggle="tab">Commodity Settings</a></li>
</ul>

<div class="tab-content" style="margin-top: 5px;">
  <div class="tab-pane active" id="home">
  	 <?php 
  	 $this -> load -> view('shared_files/commodities/commodity_list_v');
  	 ?>
  	
  </div>
  <div class="tab-pane" id="profile">stats</div>
  <div class="tab-pane" id="messages">
  <button type="button" class="order-for-excel btn btn-primary" id="order-for-excel">
  <span class="glyphicon glyphicon-floppy-open"></span>Upload File</button>    
  </div>

  </div>

		</div>
	</div>
	
	
</div>




<script>
	
	$(document).ready(function () {

    
		$('#myTab a').click(function (e) {
 		 e.preventDefault()
  			$(this).tab('show')
})
		    $("#order-for-excel").on('click', function(e) {
    e.preventDefault(); 
    var body_content='<?php  $att=array("name"=>'myform','id'=>'myform'); 
    echo form_open_multipart('stock/upload_new_list',$att)?>'+
'<input type="file" name="file" id="file" required="required" class="form-control"><br>'+
'<button type="submit" name="submit"  value="Upload">Upload</button>'+
'</form>';
   //hcmp custom message dialog
    dialog_box(body_content,'');        
    });
	});
	
	
</script>