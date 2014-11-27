
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablesorter.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.metadata.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablecloth.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/datatable/jquery.dataTables.js"></script>
<script type="text/javascript">

<?php
$this->load->database();
$q = 'SELECT id,county FROM  `counties` ORDER BY  `counties`.`county` ASC ';
$res_arr = $this->db->query($q);
$counties_option_html = "";
foreach ($res_arr->result_array() as $value) {
    $counties_option_html .='<option value="' . $value['id'] . '">' . $value['county'] . '</option>';
}
$districts_option_html = "";
$q1 = 'SELECT id,district,county FROM  `districts` ORDER BY  `districts`.`district` ASC ';
$res_arr1 = $this->db->query($q1);
foreach ($res_arr1->result_array() as $value) {
    $districts_option_html .='<option county="' . $value['county'] . '" value="' . $value['id'] . '">' . $value['district'] . '</option>';
}
?>
    $(document).ready(function() {

        $('#users').dataTable({
            "bJQueryUI": false,
            "bPaginate": true
        });
        $('#add_user').click(function() {
            $('#user_add_form').submit();
        });
        $('#add_rca_county').click(function() {
            $(this).parent().submit();
        });
        $("#users").tablecloth({theme: "paper",         
          bordered: true,
          condensed: true,
          striped: true,
          sortable: true,
          clean: true,
          cleanElements: "th td",
          customClass: "data-table"
        });  

    });
</script>
<style type="text/css">

    .dataTables_wrapper{
        margin-left: 16px;
        font-size: 11.5px;
        background: #FFFFEC;
        padding: 12px;
    }
    .dataTables_filter{
        float: right;
    }
    #users_length{
        float: left;
    }
    #users{
        width: 100%; 
    }
    #users_paginate{
        float: right;
    }
</style>

<div class="tab-content">
    <div class="tab-pane active" id="lA">
        <h3>Users</h3>
       
        <button data-target="#Add_DMLT" class="btn btn-default" data-toggle="modal">Add user</button>

        <div class="modal fade" id="Add_DMLT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add User</h4>
              </div>
              <div class="modal-body">
                <form id="user_add_form" method="POST" action="<?php echo base_url(); ?>rtk_management/adduser" title="Add User">

                    <label for="FirstName">First Name</label><br />
                    <input class="form-control" type="text" name="FirstName" rel="1" required/><br />

                    <label for="Lastname">Last Name</label><br />
                    <input class="form-control" type="text" name="Lastname" rel="2" required/><br />

                    <label for="email">Email</label><br />
                    <input class="form-control" type="text" name="email" rel="3" required/><br />
                    <select class="form-control" name="level" rel="0">
                        <option value="0">-- Select User Level --</option>
                        <option value="13">County Admin</option>
                        <option value="7">SCMLT</option>
                    </select>
                    <br />
                    <select class="form-control" name="county" rel="5">
                        <option value="0">-- Select County --</option>
                        <?php echo $counties_option_html; ?>

                    </select>
                    <br />
                    <select class="form-control" name="district" rel="4">
                        <option value="0">-- Select Sub-County --</option>
                        <?php echo $districts_option_html; ?>
                    </select>
                </form>

            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>        
                <button type="button" id="add_user" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>
        </div>



        <table class="" id="users">
            <thead style="text-align:left; font-size:13px; font-style:bold;">
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>User Level</th>
            <th>Sub-County</th>
            <th>County</th>
            <th>Delete</th>
            </thead>
            <tbody style="border-top: solid 1px #828274;">
                <?php
                foreach ($users as $value) {
                    if ($value['user_indicator'] == 'scmlt') {
                        $value['level'] = 'Sub-County Admin';
                    }
                    ?>  

                    <tr>
                        <td><?php echo '<a href="user_profile/'.$value['user_id'].'">'.$value['fname'].'</a>'; ?></td>
                        <td><?php echo '<a href="user_profile/'.$value['user_id'].'">'.$value['lname'].'</a>'; ?></td>
                        <td><?php echo $value['email']; ?></td>
                        <td><?php echo $value['level']; ?></td>
                        <td><?php
                            if ($value['user_indicator'] == 'rtkcountyadmin') {
                                echo 'Not Applicable';
                            } else {
                                echo $value['district'];
                            }
                            ?></td>
                        <td><?php echo $value['county']; ?> </td>
                        <td><a style="color:red;" title="Delete user" href="<?php echo base_url() . 'rtk_management/delete_user_gen/' . $value['user_id'] . '/rtk_manager'; ?>">[x]</a></td>
                    </tr>
                <script type="text/javascript">
                    $(function() {
                            });
                </script>
            <?php } ?></tbody>
        </table>

    </div>
</div>

