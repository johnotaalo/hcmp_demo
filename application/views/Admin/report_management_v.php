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
  <li class="active"><a href="#home" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span>User Settings</a></li>
  <li><a href="#profile" data-toggle="tab"><span class="glyphicon glyphicon-list"></span> Graphs & Statistics</a></li>
</ul>

<div class="tab-content" style="margin-top: 5px;">
  <div class="tab-pane active" id="home">
     <?php 
     $this -> load -> view('Admin/report_management');
     ?>
    
  </div>
  <div class="tab-pane" id="profile">stats</div>
  
</div>

    </div>
  </div>
  
  
</div>




<script>
  
  $(document).ready(function () {
    $(".editable").on('click',function() {
    
          $("#edit_user").attr("disabled", false);
    });
    
    $("#edit_user").attr("disabled", "disabled");
           $('#main-content').on('hidden.bs.modal','#myModal', function () {
        $("#datatable").hide().fadeIn('fast');
        // location.reload();
      });
      
        
    $('#Tab a').click(function (e) {
     e.preventDefault()
        $(this).tab('show')
    })
    
    $("#sub_county").hide(); 
    $("#facility_name").hide();
    
    
$('#add_new').click(function () {
  
     $('#addModal').appendTo("body").modal('show');
})

$('.edit').click(function () {
  
     $('#editModal').appendTo("body").modal('show');
     $("#edit_user").attr("disabled", 'disabled');
})



$('.dataTables_filter label input').addClass('form-control');
  $('.dataTables_length label select').addClass('form-control');
$('#datatable').dataTable( {
     "sDom": "T lfrtip",
       "sScrollY": "320px",   
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page",
                        "sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
                    },
            "oTableTools": {
                 "aButtons": [
        "copy",
        "print",
        {
          "sExtends":    "collection",
          "sButtonText": 'Save',
          "aButtons":    [ "csv", "xls", "pdf" ]
        }
      ],
      "sSwfPath": "<?php echo base_url(); ?>assets/datatable/media/swf/copy_csv_xls_pdf.swf"
    }
    
  } ); 
  $('div.dataTables_filter input').addClass('form-control search');
  $('div.dataTables_length select').addClass('form-control');

    
    oTable = $('#datatable').dataTable();
      
      $('#active').click(function () {
        
        oTable.fnFilter('active');
      })
      
      $('#inactive').click(function () {
        
        oTable.fnFilter('deactivated');
    
      })
      
      
      $("#county").change(function() {
    var option_value=$(this).val();
    
    if(option_value=='NULL'){
    $("#sub_county").hide('slow'); 
    }
    else{
var drop_down='';
 var hcmp_county_api = "<?php echo base_url(); ?>reports/get_sub_county_json_data/"+$("#county").val();
  $.getJSON( hcmp_county_api ,function( json ) {
     $("#sub_county").html('<option value="NULL" selected="selected">Select Sub County</option>');
      $.each(json, function( key, val ) {
        drop_down +="<option value='"+json[key]["id"]+"'>"+json[key]["district"]+"</option>"; 
      });
      $("#sub_county").append(drop_down);
    });
    $("#sub_county").show('slow');   
    }
    
    }); 
    
    $("#sub_county").change(function() {
    var option_value=$(this).val();
    
    if(option_value=='NULL'){
    $("#facility_name").hide('slow'); 
    }
    else{
var drop_down='';
 var hcmp_facility_api = "<?php echo base_url(); ?>reports/get_facility_json/"+$("#sub_county").val();
  $.getJSON( hcmp_facility_api ,function( json ) {
     $("#facility_name").html('<option value="NULL" selected="selected">Select Facility</option>');
      $.each(json, function( key, val ) {
        drop_down +="<option value='"+json[key]["facility_code"]+"'>"+json[key]["facility_name"]+"</option>"; 
      });
      $("#facility_name").append(drop_down);
    });
    $("#facility_name").show('slow'); 
  // console.log(hcmp_facility_api)  
    }
    }); 
    
    //edit
    
    $("#county_edit").change(function() {
    var option_value=$(this).val();
    $('#edit_facility').val('NULL')
    
    if(option_value=='NULL'){
    $("#edit_district").hide('slow'); 
    }
    else{
var drop_down='';
 var hcmp_county_api = "<?php echo base_url(); ?>reports/get_sub_county_json_data/"+$("#county_edit").val();
  $.getJSON( hcmp_county_api ,function( json ) {
     $("#edit_district").html('<option value="NULL" selected="selected">Select Sub County</option>');
      $.each(json, function( key, val ) {
        drop_down +="<option value='"+json[key]["id"]+"'>"+json[key]["district"]+"</option>"; 
      });
      $("#edit_district").append(drop_down);
    });
    $("#edit_district").show('slow');   
    }
    
    }); 
    
    $("#edit_district").change(function() {
    var option_value=$(this).val();
    
    if(option_value=='NULL'){
    $("#edit_facility").hide('slow'); 
    }
    else{
var drop_down='';
 var hcmp_facility_api = "<?php echo base_url(); ?>reports/get_facility_json/"+$("#edit_district").val();
  $.getJSON( hcmp_facility_api ,function( json ) {
     $("#edit_facility").html('<option value="NULL" selected="selected">Select Facility</option>');
      $.each(json, function( key, val ) {
        drop_down +="<option value='"+json[key]["facility_code"]+"'>"+json[key]["facility_name"]+"</option>"; 
      });
      $("#edit_facility").append(drop_down);
    });
    $("#edit_facility").show('slow'); 
  // console.log(hcmp_facility_api)  
    }
    }); 
    
       $('#email').keyup(function() {

  var email = $('#email').val()

   $('#username').val(email)
   
   $.ajax({
      type: "POST",
      dataType: "json",
      url: "<?php echo base_url()."user/check_user_json";?>", //Relative or absolute path to response.php file
      data:{ 'email': $('#email').val()},
      success: function(data) {
        if(data.response=='false'){
            
              $('.err').html(data.msg);
              console.log(data.msg)
              $( '.err' ).addClass( "alert-danger alert-dismissable" );
              $("#edit_user,#create_new").attr("disabled", "disabled");
              }else if(data.response=='true'){
                console.log(data.msg)
                $(".err").empty();
                $(".err").removeClass("alert-danger alert-dismissable");
                $( '.err' ).addClass( "alert-success alert-dismissable" );
                $("#edit_user,#create_new").attr("disabled", false);
                $('.err').html(data.msg);
                
                
              }
      }
    });
    return false;
  });
  
     $('#email_edit').keyup(function() {

  var email = $('#email_edit').val()

   $('#username_edit').val(email)
   
   $.ajax({
      type: "POST",
      dataType: "json",
      url: "<?php echo base_url()."user/check_user_json";?>", //Relative or absolute path to response.php file
      data:{ 'email': $('#email_edit').val()},
      success: function(data) {
        if(data.response=='false'){
            
              $('.err').html(data.msg);
              $( '.err' ).addClass( "alert-danger alert-dismissable" );
              $("#edit_user,#create_new").attr("disabled", "disabled");
              }else if(data.response=='true'){
                //var alt = $('#email_recieve').val();
                //alert(alt);
                $(".err").empty();
                $(".err").removeClass("alert-danger alert-dismissable");
                $( '.err' ).addClass( "alert-success alert-dismissable" );
                $("#edit_user,#create_new").attr("disabled", false);
                $('.err').html(data.msg);
                
                
              }
      }
    });
    return false;

    }) 
    
    $("#create_new").click(function() {

      var first_name = $('#first_name').val()
      var last_name = $('#last_name').val()
      var telephone = $('#telephone').val()
      var email = $('#email').val()
      var username = $('#username').val()
      var facility_id = $('#facility_name').val()
      var district_name = $('#district_name').val()
      var sub_county = $('#sub_county').val()
      var county = $('#county').val()
      var user_type = $('#user_type').val()


    if(user_type==10){
      
      if(first_name==""||last_name==""||telephone==""||email==""||county=="NULL"||user_type=="NULL"){
            alert('Please make sure you have selected all relevant fields.');
              return;
              }
      
    }else if (user_type==3){
      
      if(first_name==""||last_name==""||telephone==""||email==""||county=="NULL"||sub_county=="NULL"||user_type=="NULL"){
            alert('Please make sure you have selected all relevant fields.');
              return;
              }
      
    }
    else{
      if(first_name==""||last_name==""||telephone==""||email==""||county=="NULL"||sub_county=="NULL"||facility_id=="NULL"||user_type=="NULL"){
            alert('Please make sure you have selected all relevant fields.');
              return;
              }
    }
    
       
      
      var div="#processing";
      var url = "<?php echo base_url()."user/addnew_user";?>";
      ajax_post_process (url,div);
           
    });

   function ajax_post_process (url,div){
    var url =url;
    // return;
     var loading_icon="<?php echo base_url().'assets/img/Preloader_4.gif' ?>";
     $.ajax({
          type: "POST",
          data:{ 'first_name': $('#first_name').val(),'last_name': $('#last_name').val(),
          'telephone': $('#telephone').val(),'email': $('#email').val(),
          'username': $('#username').val(),'facility_id': $('#facility_name').val(),
          'county_id':$('#county').val(),
          'district_name': $('#sub_county').val(),'user_type': $('#user_type').val()},
          url: url,
          beforeSend: function() {
           
            var message = confirm("Are you sure you want to proceed?");
        if (message){
            $('.modal-body').html("<img style='margin:30% 0 20% 42%;' src="+loading_icon+">");
        } else {
            return false;
        }
           
          },
          success: function(msg) {
         // $('.modal-body').html(msg);
        setTimeout(function () {
            $('.modal-body').html("<div class='bg-warning' style='height:30px'>"+
              "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>"+
              "<h3>Success!!! A new user was added to the system. Please Close to continue</h3></div>")
              
      $('.modal-footer').html("<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>")
        
        }, 4000);
            
            location.reload();      
          }
        }); 

        $('#editModal,#addmodal').on('hidden.bs.modal', function () {
        $("#datatable").hide().fadeIn('fast');
         location.reload();
      })

}



    
    
        //handle everything edits
$("#test").on('click','.edit',function() {
  
  var district_val=$(this).closest('tr').find('.district').attr('data-attr')
  var facility_val=$(this).closest('tr').find('.facility_name').attr('data-attr')
  var chck_fac_l = facility_val.length 
  var chck_dis_l = district_val.length 
  
  //check which fields to display
  if(chck_fac_l === 0 && chck_dis_l===0 ){
    
  $( "#edit_district" ).prop( "disabled", true );
  //$( "#edit_facility" ).prop( "disabled", true );
  
}else if(chck_dis_l != 0 && chck_fac_l === 0 ){
  
  //$( "#edit_facility" ).prop( "disabled", true );
}

  
  //capture relevant data
var email = $(this).closest('tr').find('.email').html();
var phone = $(this).closest('tr').find('.phone').html();
var district = $(this).closest('tr').find('.district').html();
var fname = $(this).closest('tr').find('.fname').html();
var lname = $(this).closest('tr').find('.lname').html();
var county = $(this).closest('tr').find('.county').attr('data-attr');
var usertype = $(this).closest('tr').find('.level').attr('data-attr');
var district_id = $(this).closest('tr').find('.district').attr('data-attr');
var facility_id = $(this).closest('tr').find('.facility_name').attr('data-attr');
var email_recieve = $(this).closest('tr').find('.email_recieve').attr('data-attr');
var sms_recieve = $(this).closest('tr').find('.sms_recieve').attr('data-attr');
/*
alert(fname);
alert(district);
alert(lname);
alert(county);
alert(facility_id);
alert(district_id);*/
   //fill inputs with relevant data
$('#email_edit').val(email)
$('#email_edit').attr('data-id',$(this).closest('tr').find('.email').attr('data-attr'))
$('#telephone_edit').val(phone)
$('#fname_edit').val(fname)
$('#lname_edit').val(lname)
$('#username_edit').val(email)
$('#user_type_edit_district').val(usertype)
$('#county_edit').val(county)
$('#edit_district').val(district_id)
$('#edit_facility').val(facility_id)
//seth
if (email_recieve=2) {
// alert(email_recieve);return;
  // $('#email_recieve_edit_yes').attr('checked', 'checked');
  $('#email_recieve_selection').val(email_recieve);
}else if (email_recieve=1) {
  $('#email_recieve_edit_no').attr('checked', false);
  $('#email_recieve_selection').val(email_recieve);
};

if (sms_recieve=2) {
  // $('#sms_recieve_edit_yes').attr('checked', 'checked');
  $('#sms_recieve_selection').val(sms_recieve);
}else if (sms_recieve=1) {
  $('#sms_recieve_edit_no').attr('checked', false);
  $('#sms_recieve_selection').val(sms_recieve);
};


if($(this).closest('tr').find('.status_item').attr('data-attr')=="false"){
  $('.onoffswitch-checkbox').prop('checked', false)   
}else if($(this).closest('tr').find('.status_item').attr('data-attr')=="true"){
  $('.onoffswitch-checkbox').prop('checked', true) 
}

if($(this).closest('tr').find('.facility_name').attr('data-attr')==""){
  $("#facility_id_edit").attr("disabled", "disabled"); 
}



  });
  
  //make sure email==username  for edits
  $('#email_edit').keyup(function() {

  var email = $('#email_edit').val()

   $('#username_edit').val(email)
   
   $.ajax({
      type: "POST",
      dataType: "json",
      url: "<?php echo base_url()."user/check_user_json";?>", //Relative or absolute path to response.php file
      data:{ 'email': $('#email_edit').val()},
      success: function(data) {
        if(data.response=='false'){
            
             $('.err_edit').html(data.msg);
              $( '.err_edit' ).addClass( "alert-danger alert-dismissable" );
              $("#edit_user,#create_new").attr("disabled", "disabled");
              }else if(data.response=='true'){
                $(".err_edit").empty();
                $(".err_edit").removeClass("alert-danger alert-dismissable");
                $( '.err_edit' ).addClass( "alert-success alert-dismissable" );
                $("#edit_user,#create_new").attr("disabled", false);
                $('.err_edit').html(data.msg);
                
                
              }
      }
    });
    return false;

    })

    
    /*$("#user_type").change(function() {
  
          var type = $('#user_type').val()
          
          if (type==10){
            $('#username').val($('#county option:selected').text()+'@hcmp.com')
        } 
           
      }); */
      
      $('#email').on(function() {

  var email = $('#email').val()

   $('#username').val(email)
   $.ajax({
      type: "POST",
      dataType: "json",
      url: "<?php echo base_url()."user/check_user_json";?>", //Relative or absolute path to response.php file
      data:{ 'email': $('#email').val()},
      success: function(data) {
        if(data.response=='false'){
            
             $('.err').html(data.msg);
              $( '.err' ).addClass( "alert-danger alert-dismissable" );
              $("#edit_user,#create_new").attr("disabled", "disabled");
              }else if(data.response=='true'){
                $(".err").empty();
                $(".err").removeClass("alert-danger alert-dismissable");
                $( '.err' ).addClass( "alert-success alert-dismissable" );
                $("#edit_user,#create_new").attr("disabled", false);
                $('.err').html(data.msg);
                
                
              }
      }
    });
    return false;

    })
    
    //POST DATA
    
    $("#edit_user").click(function() {

      var div="#process";
      var url = "<?php echo base_url()."admin/edit_user";?>";
      ajax_post (url,div);
      $('#editModal').on('hidden.bs.modal', function () {
        $("#datatable").hide().fadeIn('fast');
        
         location.reload();
      })
           
    });

   function ajax_post (url,div){
    var url =url;
     var loading_icon="<?php echo base_url().'assets/img/Preloader_4.gif' ?>";

     $.ajax({
          type: "POST",
          data:{ 'fname_edit': $('#fname_edit').val(),'lname_edit': $('#lname_edit').val(),'county_edit': $('#county_edit').val(),
          'telephone_edit': $('#telephone_edit').val(),'email_edit': $('#email_edit').val(),
          'username_edit': $('#username_edit').val(),'facility_id_edit_district': $('#edit_facility').val(),
          'user_type_edit_district': $('#user_type_edit_district').val(),'district_name_edit': $('#edit_district').val(),
      'facility_id_edit': $('#edit_facility').val(),'status': $('.onoffswitch-checkbox').prop('checked'),'user_id':$('#email_edit').attr('data-id'),
      'email_recieve_edit':$('#email_recieve_edit').prop('checked'),'sms_recieve_edit':$('#email_recieve_edit').prop('checked')
    },
          url: url,
          beforeSend: function() {
            //$(div).html("");
            // alert($('#email_recieve_edit').prop('checked'));return;
            var answer = confirm("Are you sure you want to proceed?");
        if (answer){
            $('.modal-body').html("<img style='margin:30% 0 20% 42%;' src="+loading_icon+">");
        } else {
            return false;
        }
             
            
          },
          success: function(msg) {
          //success message
          // $('.modal-body').html(msg);
          // return;
          setTimeout(function () {
            $('.modal-body').html("<div class='bg-warning' style='height:30px'>"+
              "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>"+
              "<h3>Success Your records were Edited. Please Close to continue</h3></div>")
              $('.modal-footer').html("<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>")
        
        }, 4000);
        
              
          }
      
        }); 
}


    
  });
  
  
</script>