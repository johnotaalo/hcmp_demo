<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablecloth.js"></script>


<script type="text/javascript">

    $(document).ready(function() {

        /* Build the DataTable with third column using our custom sort functions */

        $('#example').dataTable({
            "bStateSave": true,
            "iDisplayLength": 10,
            "aaSorting": [[11, "desc"]],
            "bPaginate": false,
        });

        $("#allocate").button().click(function() {

            var loading = '<div id="loading"> &nbsp;&nbsp;<img src="<?php echo base_url(); ?>assets/img/ajax-loader.gif"><span style="font-size: 13px;color: #92CA8F;margin-left:100px; font-family: calibri;">Saving Allocations</span></div>';
            $('#allocation-response').html(loading);        

            var data = $('#myform').serializeArray();
            
            // $.ajax({
            //     url: '../rtk_allocation_data/',
            //     type: 'POST',
            //     data: { form_data: data },
            //     success: function(result) {
            //         console.log(result);
            //     }
            // });
           
            $.post('../rtk_allocation_data/',
                {form_data: data},     

                function(response) {  
                    alert(response);                  
                    $('#allocation-response').html(response);
                    $('#allocation-response').addClass('alert alert-success');
                    location.reload(true);
                    $( "#loading" ).hide();
                }).fail(function(request,error) {
                    console.log(arguments);
                    alert ( " Can't do because: " + error );
                });            
            //alert(data); 

            });

        $('.navtbl li a').click(function(e) {
            var $this = $(this);
            var thistext = $(this).text();
            $('.nav li').removeClass('active');
            $this.parent().addClass('active');
            $(".dataTables_filter label input").focus();
            $('.dataTables_filter label input').val(thistext).trigger($.Event("keyup", {keyCode: 13}));

            e.preventDefault();
        });
        $("table").tablecloth({theme: "paper"});


    });
</script>

<style>
    @import "<?php echo base_url(); ?>assets/datatable/media/css/jquery.dataTables.css";
    @import "<?php echo base_url(); ?>assets/tablecloth/assets/css/tablecloth.css";

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
    table{
        font-size: 13px;
        text-align: center;
        width: 100%;
    }
    table:tr{
        height: 10px;
        

    }
</style> 
<div id="nav" style="margin-top:10px;width:100%"><?php include('allocation_links.php');?></div>

<div style="width:100%;font-size: 15px;background: #F8F8F8;padding: 10px 10px 10px 10px;border-bottom: solid 1px #ccc;margin-top:5%;">
    <ul class="navtbl nav nav-pills">

        <?php foreach ($districts_in_county as $value) { ?>
            <li class=""><a href="#"><?php echo $value['district']; ?></a></li>
        <?php } ?>
       <!--a class="pull-right" href="../county_allocation/<?php echo $county_id;?>" style="line-height: 20px;margin: 8px 26px 0px 0px;text-decoration: none;color: #0088cc;">View <?php echo $countyname;?>  Allocations</a--> 

    </ul>
</div>

<div style="height:411px;overflow:scroll;">
    <?php
    $attributes = array('name' => 'myform', 'id' => 'myform');
    echo form_open('rtk_management/rtk_allocation_data/' . $county_id, $attributes);
    ?>

    <table id="example" style="width:96%" border="0">
        <thead>
            <tr>
            <th><b>District</b></th>
            <th><b>MFL</b></th>
            <th><b>Facility Name</b></th>    
            <th colspan="2"><b>Screening KHB</b></th>
            <th colspan="2"><b>Confirmatory Unigold</b></th>
            <th colspan="2"><b>Tie Breaker</b></th>
            <th><b>Status</b></th>                                              
        </tr>

        <tr>
            <th></th>
            <th></th>
            <th></th>    
            <th>AMC</th>
            <th>QTY to Allocate</th>
            <th>AMC</th>
            <th>QTY to Allocate</th>
            <th>AMC</th>                                                
            <th>QTY to Allocate</th>
            <th></th>
        
        </tr>
        </thead>
        <tbody><?php echo $table_body; ?></tbody>
    </table>
    <br />
<div id="clear">&nbsp;</div>
    <div>
<input class="pull-left" type="button" id="allocate" value="Allocate" style="background: #F8F7F7; padding: 7px;margin: 8px 0px 5px 19px;color: #0088cc;font-family: calibri;font-size: 18px;border: 1px solid #ccc;">
<div id="allocation-response"></div>
</div>
<?php echo form_close(); ?> 
</div>

<script type="text/javascript">
  $('#trend_tab').removeClass('active_tab');    
  $('#stocks_tab').removeClass('active_tab');  
  $('#allocations_tab').addClass('active_tab');
</script>