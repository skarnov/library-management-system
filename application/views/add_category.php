<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Category </h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Home</a></li>
                <li class="active">Add Category</li>
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
                <form action="<?php echo base_url()?>evis_app/save_category" method="POST">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" required name="category_name" class="form-control" placeholder="Enter Your Name">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Category Status</label>
                            <div class="controls">
                                <select name="category_status" class="form-control" tabindex="1">
                                    <option value=" ">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Add Category</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>