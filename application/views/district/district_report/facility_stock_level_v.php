<script type="text/javascript" language="javascript" src="<?php echo base_url();  ?>Scripts/jquery.dataTables.js"></script>
		<style type="text/css" title="currentStyle">	
			@import "<?php echo base_url(); ?>DataTables-1.9.3/media2/css/jquery.dataTables.css";
		</style>
<style>
.user{
	width:100px;
	background : none;
	border : none;
	text-align: center;
	}
/*	.col5{background:#D8D8D8;}*/
	</style>
    
<script>
/******************************************data-table set up*********************/
/* Define two custom functions (asc and desc) for string sorting */
			jQuery.fn.dataTableExt.oSort['string-case-asc']  = function(x,y) {
				return ((x < y) ? -1 : ((x > y) ?  1 : 0));
			};
			
			jQuery.fn.dataTableExt.oSort['string-case-desc'] = function(x,y) {
				return ((x < y) ?  1 : ((x > y) ? -1 : 0));
			};
 			   
  $(document).ready(function() {
  	
    	$('#main').dataTable( {
    		"aaSorting": [ [0,'asc'], [1,'asc'] ],
					"bJQueryUI": true,
                   "bPaginate": false
				} );
				});
</script>
<?php if(isset($msg)){ ?>
<div id="notification">    
<?php echo $msg; }?>
</div>

<div>
                <table width="100%" id="main">
                    <thead>
                    <tr>
                        <th><b>Category</b></th>
                        <th><b>Description</b></th>
                        <th><b>KEMSA&nbsp;Code</b></th>
                        <th ><b>Opening&nbsp;Balance</b></th>
                        <th ><b>Total&nbsp;Receipts</b></th>
                        <th><b>Total&nbsp;issues</b></th>
                        <th><b>Adjustments</b></th>
                        <th><b>Losses</b></th>
                        <th><b>Days out of stock</b></th>   
                        <th><b>Closing Stock</b></th>
                                     
                    </tr>
                    </thead>
                    
                            <tbody>
                                <?php $count=0;

        foreach($facility_order as $drug){?>
                        <tr>
                            <?php foreach($drug->Code as $d){
                            	
                            	$code=$d->Kemsa_Code;
                                $name=$d->Drug_Name; 
                                $ucost=$d->Unit_Cost;
                                $usize=$d->Unit_Size;}
                                foreach($d->Category as $cat){
				
			$cat_name=$cat;	
				
			}
                                ?>
                           
                            <td><?php echo $cat?></td>
                            <td><?php echo $name?></td>
                            <td ><?php echo $code;?></td>                            
                            <td><input class="user" type="text" value="<?php echo $drug->Opening_Balance;?>" /></td>
                            <td><input class="user" type="text" value="<?php echo $drug->Total_Receipts;?>" /></td>
                            <td><input class="user" type="text" value="<?php echo $drug->Total_Issues;?>" /></td>
                            <td><input class="user" type="text" value="<?php echo $drug->Adj;?>"  /></td>
                            <td><input class="user" type="text" value="<?php echo $drug->Losses;?>" /></td>
                            <td><input class="user" type="text" value="<?php echo $drug->Days_Out_Of_Stock;?>" /></td>  
                            <td><input class="user" type="text" value="<?php echo $drug->Closing_Stock;?>" /></td>
                                        
                        </tr>
<?php } ?>
                        </tbody>
                </table>
</div>