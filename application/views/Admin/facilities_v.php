<?php //echo "<pre>";print_r($facilities_listing_inactive);echo "</pre>";exit; ?>
<style>
.panel-body,span:hover,.status_item:hover
	{ 
		
		cursor: pointer !important; 
	}
	
	.panel {
		
		border-radius: 0;
		
	}
	.panel-body {
		
		padding: 8px;
	}
	#addModal .modal-dialog,#editModal .modal-dialog {
		width: 54%;
		
	}
		
	
</style>



<div class="container-fluid">
	
	<div class="row" style="margin-top: 1%;" >
		<div class="col-md-12">
			
			<ul class="nav nav-tabs" id="Tab">
  <li class="active"><a href="#home" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span>Active Facilities</a></li>
  <!-- <li><a href="#profile" data-toggle="tab"><span class="glyphicon glyphicon-list"></span> Inactive Facilities</a></li> -->
</ul>

<div class="tab-content" style="margin-top: 5px;">
  <div class="tab-pane active" id="home">
  	 <?php 
  	 $this -> load -> view('Admin/facilities_listing_active');
  	 ?>
  	
  </div>
  <!-- <div class="tab-pane" id="profile">
    <?php 
     //$this -> load -> view('Admin/facilities_listing_inactive');
     ?>
  </div> -->
  
</div>

		</div>
	</div>
	
	
</div>




<script>
	
	$(document).ready(function () {
		$(".deactivate_facility").click(function(e){
        e.preventDefault();

        var facility_id = $(this).attr("data-facility-id");
        var facility_status = $(this).attr("data-facility-status");
        // data-facility-status
        //alert(facility_status);return;
        //alert(facility_status);

        $.ajax({
          type:'POST',
          url:"deactivate_facility"
          ,beforeSend: function() {
            var answer = confirm("Are you sure you want to proceed?");
        if (answer){
            
        } else {
            return false;
        }
      },
          data:{
                'ndata':facility_id,
                'status':facility_status
          },
          success:function(msg){
            // alert(msg);return;
            location.reload();
          }
        });
    });

    $(".activate_facility").click(function(e){
        e.preventDefault();

        var facility_id = $(".lucky_facility").val();
        var facility_status = $(".lucky_facility option:selected").attr("class");
        // data-facility-status
        // alert(facility_id);
        // alert(facility_status);

        $.ajax({
          type:'POST',
          url:"deactivate_facility"
          ,beforeSend: function() {
            var answer = confirm("Are you sure you want to proceed?");
        if (answer){
            
        } else {
            return false;
        }
      },
          data:{
                'ndata':facility_id,
                'status':facility_status
          },
          success:function(msg){
            //alert(msg);return;
            location.reload();
          }
        });
    });




    
	});
	
	
</script>