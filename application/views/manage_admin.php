<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Administrators </h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Home</a></li>
                <li><a href="<?php echo base_url(); ?>evis_app/add_admin">Add Admin</a></li>
                <li class="active">Manage Admin</li>
            </ul>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <h3 style="color:green">
                    <?php
                    $msg = $this->session->userdata('message');
                    if (isset($msg)) {
                        echo $msg;
                        $this->session->unset_userdata('message');
                    }
                    ?>
                </h3>
                <div class="table-responsive">
                    <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                                foreach($all_admin as $v_admin)
                                {
                            ?>
                            <tr>
                                <td><?php echo $v_admin->admin_name;?></td>
                                <td><img src="<?php echo base_url().$v_admin->admin_image;?>" style="height:50px; width:50px;"></td>
                                <td><?php echo $v_admin->admin_email;?></td>
                                <td>
                                    <div class='activation_color'>
                                        <?php
                                            if($v_admin->admin_level=='1') {
                                                echo 'Administrator';
                                            }
                                            elseif ($v_admin->admin_level=='2') {
                                                echo 'Librarian';
                                            }
                                            elseif ($v_admin->admin_level=='3') {
                                                echo 'Manager';
                                            }
                                        
                                        ?>   
                                    </div>
                                </td>
                                <td>
                                    <div class='activation_color'>
                                        <?php
                                            if($v_admin->admin_status=='1') {
                                                echo 'Active';
                                            }
                                        ?> 
                                        <div id='color'>    
                                            <?php
                                                if($v_admin->admin_status==0) {
                                                    echo 'NOT ACTIVE';
                                                }
                                            ?>   
                                        </div>    
                                    </div>
                                </td>
                                <td>
                                    <?php if($v_admin->admin_status=='1')
                                        {
                                    ?>
                                        <a href="<?php echo base_url();?>evis_app/deactive_admin/<?php echo $v_admin->admin_id;?>" class="btn btn-danger" data-toggle="tooltip" title="Deactive Admin"><i class="fa fa-times"></i></a>
                                    <?php
                                        }
                                        else{
                                    ?>
                                        <a href="<?php echo base_url();?>evis_app/active_admin/<?php echo $v_admin->admin_id;?>" class="btn btn-success" data-toggle="tooltip" title="Active Admin"><i class="fa fa-check"></i></a>
                                    <?php
                                        }
                                    ?>
                                    <a href="<?php echo base_url();?>evis_app/edit_admin/<?php echo $v_admin->admin_id;?>" class="btn btn-primary" data-toggle="tooltip" title="Edit Admin"><i class="fa fa-pencil-square-o"></i></a>
                                    <a href="<?php echo base_url();?>evis_app/delete_admin/<?php echo $v_admin->admin_id;?>" class="btn btn-danger" data-toggle="tooltip" title="Delete Admin" onclick="return check_delete();"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                              <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <div class="pull-right">
                        <?php echo $this->pagination->create_links();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>