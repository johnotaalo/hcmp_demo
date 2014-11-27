<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
<style type="text/css" title="currentStyle">

    @import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
</style>
<script type="text/javascript">
    $(function() {
        //tabs
        $('#tabs').tabs();

        // $('#lab_orders').dataTable( {
        //         "bJQueryUI": true,
        //         "bPaginate": false
        //       } );

    });

</script>
<?php
$district = $this->session->userdata('district1');
$district_name = Districts::get_district_name($district)->toArray();
$d_name = $district_name[0]['district'];
?>
<div id="notification">View all orders for <?php echo $d_name; ?> district below</div>
<div id="tabs">
    <ul>
        <li>
            <a href="#tab-1">RTK Reports</a>
        </li>
        <!--		<li>
                                <a href="#tab-2">FCDRR</a>
                        </li>
                        <li>
                                <a href="#tab-3">Lab Commodities</a>
                        </li>-->
    </ul>

    <div id="tab-1">
<?php if (count($lab_order_list) > 0) : ?>
            <table width="100%" id="example" class="data-table">
                <thead>
                    <tr>
                        <th>Reports for</th>
                        <th>MFL&nbsp;Code</th>
                        <th>Facility Name</th>
                        <th>Compiled By</th>
                        <th>Order Type</th>
                        <th>Order&nbsp;Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($lab_order_list as $order) {
                        $d = new DateTime('');
                        $d->modify($order['order_date']);
                        $english_date = $d->format('D dS M Y');
                         


                        ?>
                        <tr>
                            <td><?php echo 'july'; ?></td>		
                            <td><?php echo $order['facility_code']; ?></td>
                            <td><?php echo $order['facility_name']; ?></td>
                            <td><?php echo $order['compiled_by']; ?></td>
                            <td><?php echo "Lab Commodities"; ?></td>
                            <td><?php echo $english_date; ?></td>
                            <td><a href="<?php echo site_url('rtk_management/lab_order_details/' . $order['id']); ?>"class="link">View</a>|<a href="<?php echo site_url('rtk_management/edit_lab_order_details/' . $order['id']); ?>"class="link">Edit</a></td>
                        </tr> 
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
        else :
            echo '<p id="notification">No Records Found</p>';
        endif;
        ?>

    </div>
  

</div>