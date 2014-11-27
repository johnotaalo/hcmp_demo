<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
<script src="http://tableclothjs.com/assets/js/jquery.tablecloth.js"></script>


<script type="text/javascript">

    $(document).ready(function() {
        /* Build the DataTable with third column using our custom sort functions */
/*
        $('#example').dataTable({
            "bStateSave": true,
            "iDisplayLength": 10,
            "aaSorting": [[11, "desc"]],
            "bPaginate": false,
        });
 */

       /* $('.nav li a').click(function(e) {
            var $this = $(this);
            var thistext = $(this).text();
            $('.nav li').removeClass('active');
            $this.parent().addClass('active');
            $(".dataTables_filter label input").focus();
            $('.dataTables_filter label input').val(thistext).trigger($.Event("keyup", {keyCode: 13}));

            e.preventDefault();
        });*/
       $("table").tablecloth({theme: "paper"});


    });
</script>

<style>
   
    @import "<?php base_url ?>tablecloth/assets/css/tablecloth.css";

    .alerts{
        width:95%;
        height:auto;
        background: #E3E4FA;    
        padding-bottom: 2px;
        padding-left: 2px;
        margin-left:0.5em;
        -webkit-box-shadow: 0 8px 6px -6px black;
        -moz-box-shadow: 0 8px 6px -6px black;
        box-shadow: 0 8px 6px -6px black;
    }
    .user2{
        width: 40px;
    }
    #example{
        width: 100% !important;
    }    
    .nav{
        margin-bottom: 0px;
    } 
</style> 
<div style="width:100%;font-size: 15px;background: #F8F8F8;padding: 10px 10px 10px 10px;border-bottom: solid 1px #ccc;">
 
</div>
 

<?php include('../rtk/allocation/allocation_links.php');?>

 <div class="container" style="width: 96%; margin: auto;">
 <table width="98%" border="0" class=""  id="example">
    <thead>
        <tr>
            <th>Facility Code</th>
            <th>Facility Name</th>
            <th>Qty Requested</th>
            <th>Commodity Name</th>
            <th>AMC</th>
            <th>Qty Allocated</th>
            <th>Order Date</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($county_allocation as $value){?>
    <tr>
        <td><?php echo $value['facility_code'];?></td>
        <td><?php echo $value['facility_name'];?></td>
        <td><?php echo $value['q_requested'];?></td>
        <td><?php echo $value['commodity_name'];?></td>
        <td><?php echo $value['amc'];?></td>
        <td><?php echo $value['allocated'];?></td>
        <td><?php echo $value['order_date'];?></td>
    </tr>
    <?php }?>
 
</tbody>
</table>  
</div> 
<script>
    $(document).ready(function() {
    $('#example').dataTable( {
       "sDom": "T lfrtip",
         "sScrollY": "377px",
         "sScrollX": "100%",
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

            "sSwfPath": "../v2/assets/datatable/media/swf/copy_csv_xls_pdf.swf"
        }
    } );
    
});
</script>

  <!--Datatables==========================  --> 
<script src="http://cdn.datatables.net/1.10.0/js/jquery.dataTables.js" type="text/javascript"></script>
<script src="../v2/assets/datatable/jquery.dataTables.min.js" type="text/javascript"></script>  
<script src="../v2/assets/datatable/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="../v2/assets/datatable/TableTools.js" type="text/javascript"></script>
<script src="../v2/assets/datatable/ZeroClipboard.js" type="text/javascript"></script>
<script src="../v2/assets/datatable/dataTables.bootstrapPagination.js" type="text/javascript"></script>
<!-- validation ===================== -->
<script src="../v2/assets/scripts/jquery.validate.min.js" type="text/javascript"></script>


 
<link href="../v2/assets/boot-strap3/css/bootstrap-responsive.css" type="text/css" rel="stylesheet"/>
<link href="../v2/assets/datatable/TableTools.css" type="text/css" rel="stylesheet"/>
<link href="../v2/assets/datatable/dataTables.bootstrap.css" type="text/css" rel="stylesheet"/>