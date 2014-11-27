<script type="text/javascript" language="javascript" src="<?php 
 $access_level = $this -> session -> userdata('user_type_id');
echo base_url();  ?>Scripts/jquery.dataTables.js"></script>
		<style type="text/css" title="currentStyle">			
			@import "<?php echo base_url(); ?>DataTables-1.9.3 /media2/css/jquery.dataTables.css";
		</style>
<style>
.user{
	width:100px;
	background : none;
	border : none;
	text-align: center;
	}
	.user_1{
	width:100px;
	/*background : none;
	border : none;*/
	text-align: center;
	}
/*	.col5{background:#D8D8D8;}*/
	</style>
    
<script>
json_obj = {
				"url" : "<?php echo base_url().'Images/calendar.gif';?>",
				};
	var baseUrl=json_obj.url;
 $(function() {
 	
 	   /*********************getting the last day of the month***********/
  function getLastDayOfYearAndMonth(year, month)
{
    return(new Date((new Date(year, month + 1, 1)) - 1)).getDate();
}


		//	-- Datepicker
				$(".my_date").datepicker({
					        	beforeShowDay: function(date)
    {
        // getDate() returns the day [ 0 to 31 ]
        if (date.getDate() ==
            getLastDayOfYearAndMonth(date.getFullYear(), date.getMonth()))
        {
            return [true, ''];
        }

        return [false, ''];
    },
					
					dateFormat: 'd M yy', 
					changeMonth: true,
			        changeYear: true,
			        buttonImage: baseUrl,
			       
				});


 	
			//button to post the order
			$( "#update" )
			.button()
			.click(function() {
				
	return $myDialog.dialog('open');
			});	

			
			
			var $myDialog = $('<div></div>')
    .html('Please confirm the values before saving')
    .dialog({
        autoOpen: false,
        title: 'Confirmation',
        buttons: { "Cancel": function() {
                      $(this).dialog("close");
                      return false;
                },
                "OK": function() { 
                	var checker=0;
                	$("input[name^=batch_no]").each(function() {
                		checker=checker+1;
                		
                	});
                	
                	if(checker==0){
                		alert("Cannot submit an empty form");
                		$(this).dialog("close"); 
                	}
                	else{
                	$(this).dialog("close"); 
                	$('#main_filter').html(function(){
                		
					$(this).find("input").val("");
					
					var the_table =$('#main').dataTable( {
					"bJQueryUI": true,
                   "bPaginate": false,
                   "bDestroy":true
				} );
					});
                      $('#myform').submit();
                      return true;	
                	}
                	
                      
                 }
        }
});

				
		  //popout
$( "#dialog1" ).dialog({
			height: 140,
			modal: true,
			title: "Confirmation"
		});
	});	
 
 		 
  $(document).ready(function() {

    	var the_table =$('#main').dataTable( {
					"bJQueryUI": true,
                   "bPaginate": false
				} );
    
});
</script>
<?php if(isset($confirmation_message)):echo '<div id="dialog1"><h2>'.$confirmation_message.'<h2></div>';endif;  ?>
    <?php $attributes = array( 'name' => 'myform', 'id'=>'myform');
     echo form_open('stock_management/update_facility_stock_details',$attributes); ?>        
	
                <table width="100%" id="main">
                    <thead>
                    <tr>
                        <th><b>Category</b></th>
                        <th><b>Description</b></th>
                        <th><b>KEMSA&nbsp;Code</b></th>
                        <th><b>Unit&nbsp;Size</b></th>
                        <th ><b>Batch&nbsp;No</b></th>
                        <th ><b>Manufacturer</b></th>
                        <th><b>Expiry&nbsp;Date</b></th>
                        <th><b>Stock&nbsp;Level</b></th>
                        <?php
                        
                        if($access_level==2): 
                        echo "<th><b>Delete</b></th>" ; endif; // ;                        
                        
                        ?>
                                                      
                    </tr>
                    </thead>
                    
                            <tbody>
                                <?php $count=0;
        foreach($facility_stock_details as $drug){?>
                        <tr>
                            <?php foreach($drug->Code as $d){
                            	$code=$d->Kemsa_Code;
                                $name=$d->Drug_Name; 
                                $ucost=$d->Unit_Cost;
                                $usize=$d->Unit_Size;}
                                foreach($d->Category as $cat){
				
			$cat_name=$cat->Category_Name;	
				
			}
                                ?>
                           <?php echo form_hidden('id['.$count.']', $drug->id);?>
                            <?php echo form_hidden('kemsa_code['.$count.']', $drug->kemsa_code);?>
                            
                            <td><?php echo $cat_name?></td>
                            <td><?php echo $name?></td>
                            <td ><?php echo $code;?></td>
                            <td ><?php echo $usize;?></td>
                            <td><input class="user_1" type="text"<?php echo 'name="batch_no['.$count.']"'?>  value="<?php echo $drug->batch_no;?>" /></td>
                            <td><input class="user_1" type="text"<?php echo 'name="manufacturer['.$count.']"'?>  value="<?php echo $drug->manufacture;?>" /></td>
                            <td><input class='my_date' type="text"<?php echo 'name="expiry_date['.$count.']"'?> value="<?php
                            
                            $fechaa = new DateTime($drug->expiry_date);
                            $datea= $fechaa->format(' d M Y');                      
                             echo $datea;?>" />
                             </td>
                            <td>
                            	
                            <input class="user" readonly="readonly" type="text"<?php echo 'name="stock_level['.$count.']"'?> value="<?php echo $drug->balance;?>"  /></td>
                             <?php
                        echo "<input type='hidden' name='delete[$count]' value='0' />";
                        if($access_level==2): 
                        echo "<td>
                         
                        <input type='checkbox' name='delete[$count]' value='1' />
                        
                        </td>" ; endif; // ;                        
                        
                        ?>
                                                                
                        </tr>
                        
                        <?php  $count=$count+1; }?>
                        </tbody>
                </table>
             
                <?php echo form_close(); ?>   
           <button class="btn btn-primary" id="update"> Update</button>  
        </div>
</div><!-- End demo -->
<br />
