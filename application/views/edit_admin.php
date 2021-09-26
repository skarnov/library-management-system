<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Administrator </h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Home</a></li>
                <li><a href="<?php echo base_url(); ?>evis_app/add_admin">Add Admin</a></li>
                <li><a href="<?php echo base_url(); ?>evis_app/manage_admin">Manage Admin</a></li>
                <li class="active">Edit Admin</li>
            </ul>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <h3 style="color:green">
                    <?php
                    $msg=$this->session->userdata('message');
                    if(isset($msg)){
                    echo $msg;
                    $this->session->unset_userdata('message');
                    }
                    ?>
                </h3>
                <form action="<?php echo base_url()?>evis_app/update_admin" name="myForm" method="POST" enctype="multipart/form-data">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" required name="admin_name" class="form-control" value="<?php echo $admin_info->admin_name;?>">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" required name="admin_email" class="form-control" value="<?php echo $admin_info->admin_email;?>">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label class="control-label">Level</label>
                            <div class="controls">
                                <select name="admin_level" class="form-control" tabindex="1">
                                    <option value="">Select Status</option>
                                    <option value="1">Administrator</option>
                                    <option value="2">Librarian</option>
                                    <option value="3">Manager</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Activation Status</label>
                            <div class="controls">
                                <select name="admin_status" class="form-control" tabindex="1">
                                    <option value=" ">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div style="background-color:wheat;"><?php echo validation_errors(); ?></div>
                        <button type="submit" class="btn btn-success">Add Admin</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.forms['myForm'].elements['admin_level'].value = '<?php echo $admin_info->admin_level; ?>';
    document.forms['myForm'].elements['admin_status'].value = '<?php echo $admin_info->admin_status; ?>';
</script>