<!--Validation Scripts-->
<link href="<?php echo base_url().'CSS/jquery.validate.css'?>" type="text/css" rel="stylesheet"/> 
<script src="<?php echo base_url().'Scripts/jquery.validate.js'?>" type="text/javascript"></script> 
<script type="text/javascript">
            /* <![CDATA[ */
           // jQuery(function(){
              
                //jQuery("#ValidField").validate({
                  //  expression: "if (VAL) return true; else return false;",
                  //  message: "Please enter the Required field"
             //   });
               
            //});
            /* ] var input = document.getElementByName("fname");]> */
           
        </script>
        
<script>
        function callme() {
        	var service= $('#ValidField').val();
           if(service==null || service==""){
           	alert("First name must be filled out");
  			return false;
           }
            
        }
        </script>
<?php $facilityCode=$facility_c=$this -> session -> userdata('news');	?>

<?php echo form_open('service_point/submit') ; ?>

				<table class="data-table" width="700">
	<tr><p>
		<td><label for="fname">Service Points::</label></td>
		<td><input type="text" name="spoint" value="" id="ValidField" onblur="callme(this);"/></td>
	</p>
	</tr>
	
		
		<input type="hidden" name="facility" value="<?php echo $facilityCode?>" />

	
	<tr><p>
		<td><?php echo form_submit('submit','Add Service Point'); ?></td>
	</p></tr>
	<?php echo form_close(); ?>
	</table>