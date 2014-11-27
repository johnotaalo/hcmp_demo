<script src="<?php echo base_url(); ?>assets/scripts/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/tablecloth/assets/css/tablecloth.css">
<script src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablesorter.js"></script>
<script src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.metadata.js"></script>
<script src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablecloth.js"></script>


<script type="text/javascript">

    $(document).ready(function() {

        $('.navtbl li a').click(function(e) {
            var $this = $(this);
            var thistext = $(this).text();
            $('.navtbl li').removeClass('active');
            $this.parent().addClass('active');
            $(".dataTables_filter label input").focus();
            $('.dataTables_filter label input').val(thistext).trigger($.Event("keyup", {keyCode: 13}));

            e.preventDefault();
        });
        $("table").tablecloth({theme: "paper"});


    });
</script>

<style>
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
    .user2{width: 40px;}
    #example{width: 100% !important;}    
    .nav{margin-bottom: 0px;} 
    table,.dataTables_info{font-size: 11px;}
    #example_filter>input{position: relative !important;margin-top: 1em;}
    #example_wrapper>.DTTT_container>a>span{font-size: 10px;}
    .DTTT_container{margin-top: 1em;}
    #banner_text{width: auto;}
    .divide{height: 2em;}
</style> 
 

<div style="width:100%;font-size: 15px;background: #F8F8F8;padding: 10px 10px 10px 10px;border-bottom: solid 1px #ccc;">
    <ul class="navtbl nav nav-pills">

                    <li class=""><a href="#">Quarter-1</a></li>
                    <li class=""><a href="#">Quarter-2</a></li>
                    <li class=""><a href="#">Quarter-3</a></li>
                    <li class=""><a href="#">Quarter-4</a></li>
                    <li class="disabled" style=""><a href="#">&nbsp;</a></li>     
            <li class="disabled" style="border-left: solid 0.1em #ccc;"><a href="#">&nbsp;</a></li>

            <li class=""><a href="#">Zone-A</a></li>
            <li class=""><a href="#">Zone-B</a></li>
            <li class=""><a href="#">Zone-C</a></li>
            <li class=""><a href="#">Zone-D</a></li>
    </ul>
</div>



<div class="container" style="width: 100%; margin: auto;">
    <table width="98%" border="0" class=""  id="example">
        <thead>
            <tr>
                <th>Facility Code</th>
                <th>Facility Name</th>
                <th>Zone</th>
                <th>Contact Person</th>
                <th>Cellphone</th>
                <th>Determine</th>
                <th>Unigold</th>
                <th>Allocated Date</th>
                <th>Quarter</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $max = count($allocations);            
            $i = 0;
            while ($i < $max) {
                $allocation_date = date("4S F Y", $allocations[$i]['allocated_date']);
                $allocation_date = ($allocations[$i]['allocated_date']==0) ? "" : $allocation_date;


                $quarter = date("Y-m-d",$allocations[$i]['allocated_date']);
              $quarter = substr($quarter,5,2);
               $quarter =($quarter/12)*4;
             $quarter = ceil($quarter);
                $quarter ="Quarter-".$quarter;
              $quarter = ($quarter=="Quarter-0") ? '' : $quarter;
            
                $allocations[$i]['Zone'] = str_replace(' ', '-',$allocations[$i]['Zone']);
                ?>
                <tr>
                    <td><?php echo $allocations[$i]['facility_code']; ?></td>
                    <td><?php echo $allocations[$i]['facility_name']; ?></td>
                    <td><?php echo $allocations[$i]['Zone']; ?></td>
                    <td><?php echo $allocations[$i]['contactperson']; ?></td>
                    <td>0<?php echo $allocations[$i]['cellphone']; ?></td>                  
                    <td>0<?php echo $allocations[$i]['cellphone']; ?></td>                  
                    <td>0<?php echo $allocations[$i]['cellphone']; ?></td>                      

                    <!--td><?php echo $allocations[$i]['allocated'];$i++;$i++?></td>
                    <td><?php echo $allocations[$i]['allocated']; ?></td-->
                    <td><?php echo $allocation_date; ?></td>
                    <td><?php echo $quarter; ?></td>
                </tr>
                <?php
                $i++;
            }
            ?>

        </tbody>
    </table>  
    <div style="height:17px;">
    
</div>
</div> 
<script>
    $(document).ready(function() {
        var table = $('#example').dataTable({
            "sDom": "T lfrtip",
            "sScrollY": "377px",
            "sScrollX": "100%",
            "bPaginate": true,
            "oLanguage": {
                "sLengthMenu": "_MENU_ Records per page",
                "sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
            },
            "oTableTools": {
                "aButtons": [
                    "copy",
                    "print",
                    {
                        "sExtends": "collection",
                        "sButtonText": 'Save',
                        "aButtons": ["csv", "xls", "pdf"]
                    }
                ],
                "sSwfPath": "../assets/datatable/media/swf/copy_csv_xls_pdf.swf"
            }
        });

        $("#example tfoot th").each(function(i) {
            var select = $('<select><option value=""></option></select>')
                    .appendTo($(this).empty())
                    .on('change', function() {
                        table.column(i)
                                .search('^' + $(this).val() + '$', true, false)
                                .draw();
                    });

            table.column(i).data().unique().sort().each(function(d, j) {
                select.append('<option value="' + d + '">' + d + '</option>')
            });
        });

    });
</script>

<!--Datatables==========================  --> 
<script src="<?php echo base_url(); ?>assets/datatable/jquery.dataTables.min.js" type="text/javascript"></script>  
<script src="<?php echo base_url(); ?>assets/datatable/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/datatable/TableTools.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/datatable/ZeroClipboard.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/datatable/dataTables.bootstrapPagination.js" type="text/javascript"></script>
<!-- validation ===================== -->
<script src="<?php echo base_url(); ?>assets/scripts/jquery.validate.min.js" type="text/javascript"></script>
 
<link href="<?php echo base_url(); ?>assets/boot-strap3/css/bootstrap-responsive.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url(); ?>assets/datatable/TableTools.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url(); ?>assets/datatable/dataTables.bootstrap.css" type="text/css" rel="stylesheet"/>
