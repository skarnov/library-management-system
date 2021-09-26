<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Publisher </h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Home</a></li>
                <li><a href="<?php echo base_url(); ?>evis_app/add_publisher">Add Publisher</a></li>
                <li><a href="<?php echo base_url(); ?>evis_app/manage_publisher">Manage Publisher</a></li>
                <li class="active">Edit Publisher</li>
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
                <form name="myForm" action="<?php echo base_url()?>evis_app/update_publisher" method="POST">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Publisher Name</label>
                            <input type="text" required name="publisher_name" class="form-control" value="<?php echo $publisher_info->publisher_name;?>">
                            <input type="hidden" required name="publisher_id" class="form-control" value="<?php echo $publisher_info->publisher_id;?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Publisher Status</label>
                            <div class="controls">
                                <select name="publisher_status" class="form-control" tabindex="1">
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Update Info</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.forms['myForm'].elements['publisher_status'].value = '<?php echo $publisher_info->publisher_status; ?>';
</script>