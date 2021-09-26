<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Reader </h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="active">Add Reader</li>
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
                <form action="<?php echo base_url() ?>evis_app/save_reader" method="POST">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Library Card Number</label>
                            <input type="text" required name="reader_library_no" class="form-control" placeholder="Enter Library Card Number">
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" required name="reader_name" class="form-control" placeholder="Enter Reader Name">
                        </div>
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" required name="reader_mobile" class="form-control" placeholder="Enter Reader Mobile">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" required name="reader_email" class="form-control" placeholder="Enter Reader Email">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" required name="reader_address" class="form-control" placeholder="Enter Reader Address">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" required name="reader_password" class="form-control" placeholder="Enter Reader Password">
                        </div>
                        <div class="form-group">
                            <label>Conform Password</label>
                            <input type="password" required name="conform_password" class="form-control" placeholder="Enter Reader Password">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Reader Activation</label>
                            <div class="controls">
                                <select name="reader_status" class="form-control" tabindex="1">
                                    <option value="">Select Availability</option>
                                    <option value="1">Available</option>
                                    <option value="0">Not Available</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Add Reader</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>