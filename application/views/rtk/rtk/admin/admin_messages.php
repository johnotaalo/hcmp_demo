<!DOCTYPE html>
<html lang="en">
<head>   
  <link href="<?php echo base_url().'assets/css/style.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/offline.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/select2.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/offline-language-english.css'?>" type="text/css" rel="stylesheet"/>  
  <link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap.min.css'?>" type="text/css" rel="stylesheet"/>
  <link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap-responsive.css'?>" type="text/css" rel="stylesheet"/>
  <link href="<?php echo base_url().'assets/css/jquery-ui.css'?>" type="text/css" rel="stylesheet"/>
  <link rel="stylesheet" href="<?php echo base_url().'assets/css/pace-theme-flash.css'?>" />
  <script src="<?php echo base_url().'assets/scripts/pace.js'?>" type="text/javascript"></script>
     <script src="<?php echo base_url().'assets/scripts/offline.js'?>" type="text/javascript"></script>
     <script src="<?php echo base_url().'assets/scripts/select2.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/scripts/typehead/handlebars.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/scripts/jquery.js'?>" type="text/javascript"></script> 
  <script src="<?php echo base_url().'assets/scripts/validator.js'?>" type="text/javascript"></script> 
  <script src="<?php echo base_url().'assets/scripts/waypoints.js'?>" type="text/javascript"></script> 
  <script src="<?php echo base_url().'assets/scripts/waypoints-sticky.min.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/boot-strap3/js/bootstrap.min.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/scripts/typehead/typeahead.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url();?>assets/FusionCharts/FusionCharts.js" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/tagsinput/tagmanager.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/tagsinput/bootstrap-tagsinput.js'?>" type="text/javascript"></script>
  <link rel="stylesheet" href="<?php echo base_url().'assets/tagsinput/bootstrap-tagsinput.css'?>" />
  <script type="text/javascript" src="<?php echo base_url().'assets/tinymce/js/tinymce/tinymce.min.js'?>"></script>


  <script>
  paceOptions = {
    ajax: false, // disabled
    document: true, // 
    eventLag: true,
    restartOnPushState: false,
    elements:{
      selectors:['body']
    } // 

  };
  function load(time){
    var x = new XMLHttpRequest()
    x.open('GET', document.URL , true);
    x.send();
  };
  setTimeout(function(){
    Pace.ignore(function(){
      load(3100);
    });
  },4500);

  Pace.on('hide', function(){
   //   console.log('done');
 });

  var url="<?php echo base_url(); ?>";
  </script>
  <style>
  .tt-dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 96%;
    padding: 5px 0;
    margin: 2px 0 0;
    list-style: none;
    font-size: 14px;
    background-color: #ffffff;
    border: 1px solid #cccccc;
    border: 1px solid rgba(0, 0, 0, 0.15);
    border-radius: 4px;
    -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
    background-clip: padding-box;
  }
  .tt-suggestion > p {
    display: block;
    padding: 3px 20px;
    clear: both;
    font-weight: normal;
    line-height: 1.428571429;
    color: #333333;
    white-space: nowrap;
  }
  .tt-suggestion > p:hover,
  .tt-suggestion > p:focus,
  .tt-suggestion.tt-cursor p {
    color: #ffffff;
    text-decoration: none;
    outline: 0;
    background-color: #428bca;
  }
  .typeahead {width: 400px;}
  .query-title{border-bottom:inset; font-weight:bold}

  .input-small{
    width: 100px !important;
  }
  .input-small_{
    width: 230px !important;
  }
  .panel-success>.panel-heading {
    color: white;
    background-color: #528f42;
    border-color: #528f42;
    border-radius:0;

  }
  .navbar-default {
    background-color: white;
    border-color: #e7e7e7;
  }
  .modal-content
  {
    border-radius: 0 !important;
  }
  #navigate ul {
   text-align: left;
   display: inline;
   margin: 0;
   padding: 13px 4px 17px 0;
   list-style: none;
 }
/*
 * For National Outlook only as it doesnt display properly
 */
 #navigate ul li {
   display: inline-block;
   margin-right: -4px;
   position: relative;
   padding: 13px 18px;
   background: #29527b; /* Old browsers */
   cursor: pointer;
   -webkit-transition: all 0.2s;
   -moz-transition: all 0.2s;
   -ms-transition: all 0.2s;
   -o-transition: all 0.2s;
   transition: all 0.2s;
 }
 #message_div{
  width: 100%;
  height: auto;
  border: ridge 1px;
  margin-top: 5%;
  background-color: #F9F9F9;
  text-align: left;
}
#message_div input{
  float: left;
  margin-left: 10px;
}

.twitter-typeahead{
  width: 100%;
}
</style>
</head> 
<body style="padding-top: 0;">  
<?php 
    include('admin_links.php');    
?>

<center>
<div id="message_div">
  <div class="panel-body">
    <form id="compose" name="compose">       
      <table id="compose_table" >
        <tr>
          <label>To:</label>
        </tr><br/>

        <tr>  
                              
             <input type="hidden" class="form-control" id="receipient_id">
            <input class="typeahead form-control tm-input" id="receipient" type="text" placeholder="Enter Receipient" data-provide="typeahead" style="width:100%" />             

        </tr><br/>    
        <tr>
          <label>Subject:</label>
        </tr><br/>
        <tr>                   
          <input class="form-control" id="subject" name="subject" type="text" style="width:100%" placeholder="RE:SUBJECT"/>   
          <tr>
            <label>Message:</label>
          </tr><br/>
          <tr>    
            <textarea class="form-control" id="message" name="message" style="width:96%;background:#ffffff;" rows="10" placeholder="Type your Message Here"></textarea>
          </tr> <br/>
          <tr>            
            <td><button id="save_message_btn" class="btn btn-primary">Send Message</button></td>
            <td>&nbsp;<button class="btn">Clear All</button></td>
          </tr>
          <!--input type="hidden" name="receipient_id" id="receipient_id" value="NULL"/-->
        </table>
      </form>   
    </div>

  </div>

</div>
</center>
  
</body>
<script>
jQuery.browser = {};
(function () {
  jQuery.browser.msie = false;
  jQuery.browser.version = 0;
  if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
    jQuery.browser.msie = true;
    jQuery.browser.version = RegExp.$1;
  }
})();
var substringMatcher = function(strs) {
  return function findMatches(q, cb) {
    var matches, substringRegex;
                // an array that will be populated with substring matches
                matches = [];
                // regex used to determine if a string contains the substring `q`
                substrRegex = new RegExp(q, 'i');
                // iterate through the pool of strings and for any string that
                // contains the substring `q`, add it to the `matches` array
                $.each(strs, function(i, str) {
                  if (substrRegex.test(str)) {
                    // the typeahead jQuery plugin expects suggestions to a
                    // JavaScript object, refer to typeahead docs for more info
                    matches.push({ value: str });
                  }
                });
                cb(matches);
              };
            };
            
            
            var messages = new Bloodhound({
              datumTokenizer: Bloodhound.tokenizers.obj.whitespace('receipients'),
              queryTokenizer: Bloodhound.tokenizers.whitespace,
              prefetch: { 
                url:'../assets/scripts/typehead/json/messages.json',
                ttl:0
              }
            });           


            
            messages.initialize();
            
            /*$(".tm-input").tagsManager({               
              replace:false,                              
              onlyTagList: false,  
              
            });*/


            $('.typeahead').typeahead({
              highlight: true
            },
            {
              name: 'facilities',
              displayKey: 'receipients',              
              source: messages.ttAdapter(),
              templates: {
                //header: '<h5 class="query-title">Facilities</h5>'
              }
            }).on('typeahead:selected',onSelected);/*.on('typeahead:selected',onSelected)*/;
            /*$('#receipient').tagsinput('items');
              var receipients = $(".tm-input").tagsManager({               
                replace:false,                              
                onlyTagList: true,  
                
              });*/


    function onSelected($e, datum) {
          $.each(datum, function( k, v ){
          $('#receipient_id').val('NULL');            
          $('#receipient_id').val(datum.id);          
        });
        }
      $(function(){

             $('#save_message_btn').click(function(e) {         
              e.preventDefault();          
             // var form = $( "form[name=compose]").serialize();        
              //var receipient = $("#receipient").val();
              var subject = $("#subject").val();
              var message = tinymce.get('message').getContent();
             // var message = $("#message").val(); 
              var id = $("#receipient_id").val();             
              //alert('Receipients='+receipients+' Subject'+subject+' Message'+message);
              
              $.post("<?php echo base_url() . 'rtk_management/rtk_send_message'; ?>", {
                  message: message,
                  subject: subject,
                  id: id,            
                  }).done(function(data) {
                      alert("Data Loaded: " + data);                      
                      window.location = "<?php echo base_url() . 'rtk_management/rtk_manager_messages'; ?>";
                  });
               }); 
      });
                  
                 

</script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea"
 });
</script>
<script>
    $('#settings_tab').removeClass('active_tab');
    $('#messaging_tab').addClass('active_tab');
    $('#trend_tab').removeClass('active_tab');
    $('#users_tab').removeClass('active_tab');
    $('#activity_tab').removeClass('active_tab');
</script>


