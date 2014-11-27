<?php
include_once 'ago_time.php';
$counties_select_html = '';
foreach ($all_counties as $value) {
    $counties_select_html .='<option value="' . $value['id'] . '">' . $value['county'] . '</option>';
}
$sub_counties_select_html = '';
foreach ($all_subcounties as $value) {
    $sub_counties_select_html .='<option value="' . $value['id'] . '">' . $value['district'] . '</option>';
}
?>
<style type="text/css">
    body > div.container-fluid > div > div > div > div:nth-child(1)	{font-size: 120%;word-spacing: 2px;}
    body > div.container-fluid > div > div > div > div:nth-child(1) > div{padding: 10px;}
    body > div.container-fluid > div > div > div > div:nth-child(2){height: 75%;overflow-y: scroll;overflow-x: hidden;margin-left: 10px;}
</style>
<div class="row">
    <div class="col-sm-6 col-md-7">
        <div class="panel pull-left">
            <img src="http://switchontario.ca/Resources/Pictures/profile_image_placeholder.jpg" alt="<?php echo $full_name; ?>" class="img-responsive pull-left">
            <div class="caption">
                <h3><?php echo $full_name; ?> <small></small></h3>
                <p>
                    <span class="label label-success"> &nbsp; <small>ACTIVE</small></span>
                    <br />
                    <span class="glyphicon glyphicon-user"></span><?php echo $user_details[0]['level']; ?>
                    <br />
                    <span class="glyphicon glyphicon-envelope"></span><?php echo $user_details[0]['email']; ?>
                    <br />
                    <span class="glyphicon glyphicon-envelope"></span><?php echo $user_details[0]['user_indicator']; ?>
                    <br />
                    <span class="glyphicon glyphicon-earphone"></span><?php echo $user_details[0]['telephone']; ?>
                    <br />
                    Create <?php echo $user_details[0]['created_at']; ?>
                    <br />
                    District: <?php
                    foreach ($user_details[2] as $key => $value) {
                        echo '<a style="color:red;" href="' . base_url()
                        . 'rtk_management/remove_dmlt_from_district/' . $user_id
                        . '/' . $value['district_id']
                        . '?referer=user_management'   
                        . '" title="Remove Sub County">' . $value['district'] . '</a>  ';
                    }
                    ?>
                    <br />
            

                    County: <?php
                    foreach ($user_details[1] as $key => $value) {
                        echo '<a style="color:red;" href="' . base_url()
                        . 'rtk_management/remove_rca_from_county/' . $user_id
                        . '/' . $value['county_id']
                        . '" title="Remove County">' . $value['county'] . '  ';
                    }
                    ?>
                </p>
                <p><a href="#" class="btn btn-primary" role="button">Deactivate</a>
                    <?php if ($user_details[0]['user_indicator'] == 'rtk_county_admin') { ?> 
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_county">
                                <span class="glyphicon glyphicon-plus"></span> Add County to <?php echo $full_name; ?>
                            </button>


                        <div class="modal fade" id="add_county" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Add <?php echo $full_name; ?> to County</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p></p>
                                        <form id="add_location_to_user" method="POST"  action="<?php echo base_url('rtk_management/add_rca_to_county'); ?>" > 
                                            <div class="modal-body">
                                                <input type="hidden" id="rca_id" name="rca_id" value="<?php echo $user_id; ?>"/>
                                                <h5>County: </h5>
                                                <select name="county" id="county" class="form-control">
                                                <?php echo $counties_select_html; ?>
                                                </select>
                                                <hr>
                                            </div>
                                        </form>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" id="save" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
            <?php if ($user_details[0]['user_indicator'] == 'scmlt') { ?> 
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_county">
                        <span class="glyphicon glyphicon-plus"></span> Add Sub-County to <?php echo $full_name; ?>
                    </button>


                    <div class="modal fade" id="add_county" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Add <?php echo $full_name; ?> to Sub-County</h4>
                                </div>
                                <div class="modal-body">
                                    <p></p>
                                    <form id="add_location_to_user" method="POST" action="<?php echo base_url('rtk_management/dmlt_district_action1'); ?>" > 
                                        <div class="modal-body">
                                            <input type="hidden" name="dmlt_id" value="<?php echo $user_id; ?>"/>
                                            <input type="hidden" name="action" value="add"/>
                                            <input type="hidden" name="referer" value="user_management"/>
                                            <h5>Sub-County: </h5>
                                            <select name="dmlt_district" id="county" class="form-control">
                                        <?php echo $sub_counties_select_html; ?>
                                            </select>
                                            <hr>
                                        </div>
                                    </form>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" id="save" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

    </div>
</div>
<div class="panel pull-left">   
<?php
foreach ($user_logs as $logs) {
    $action_clause = '';
    $action_clause = ($logs['action'] == 'ADDFDR') ? 'Added a Report' : $action_clause;
    $action_clause = ($logs['action'] == 'UPDFDR') ? 'Edited a Report' : $action_clause;
    $action_clause = ($logs['action'] == 'ACTFCL') ? 'Activated a Facility' : $action_clause;
    $action_clause = ($logs['action'] == 'DCTFCL') ? 'Deactivated a Facility' : $action_clause;
    $action_clause = ($logs['action'] == 'UPDFCL') ? 'Edited a Facility' : $action_clause;
    $action_clause = ($logs['action'] == 'ADDUSR') ? 'Added  a User' : $action_clause;
    $action_clause = ($logs['action'] == 'UPDUSR') ? 'Edited a User' : $action_clause;
    $link = "";
    $date = date('H:m:s d F, Y', $logs['timestamp']);
    ?>
        <?php
        echo
        '<a href="' . $link . '" title="' . $date . '">'
        . $logs['fname'] . ' '
        . $logs['lname'] . ' '
        . '</a>'
        . $action_clause . ' '
        . '<a href="' . $link . '" title="' . $date . '">'
        . timeAgo($logs['timestamp'])
        . '</a>';
        ?>
            <br />
    <?php } ?>
</div>

</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        $("#save").click(function() {
            $("#add_location_to_user").submit();
        });


    });
</script>