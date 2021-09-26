<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Admin</h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Home</a></li>
                <li class="active">Add Admin</li>
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
                <form action="<?php echo base_url();?>evis_app/save_admin" method="POST" enctype="multipart/form-data">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" required name="admin_name" class="form-control" placeholder="Enter Your Name">
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="admin_image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" required name="admin_password" class="form-control" placeholder="Enter Your Password">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label class="control-label">Level</label>
                            <div class="controls">
                                <select name="admin_level" class="form-control" tabindex="1">
                                    <option value=" ">Select Status</option>
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
                        <div class="form-group">
                            <label> Conform Password</label>
                            <input type="password" required name="conform_password" class="form-control" placeholder="Conform The Password">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" required name="admin_email" class="form-control" placeholder="Enter Your Email Address">
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