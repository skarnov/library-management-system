<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Update Author Information </h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="<?php echo base_url(); ?>evis_app/manage_author">Manage Author</a></li>
                <li class="active">Edit Author</li>
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
                <form name="myForm" action="<?php echo base_url() ?>evis_app/update_author" method="POST">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>author Name</label>
                            <input type="text" required name="author_name" class="form-control" value="<?php echo $author_info->author_name; ?>">
                            <input type="hidden" required name="author_id" class="form-control" value="<?php echo $author_info->author_id; ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">author Status</label>
                            <div class="controls">
                                <select name="author_status" class="form-control" tabindex="1">
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
    document.forms['myForm'].elements['author_status'].value = '<?php echo $author_info->author_status; ?>';
</script>