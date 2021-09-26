<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Allocate </h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="<?php echo base_url(); ?>evis_app/manage_allocation">Manage Allocation</a></li>
                <li class="active">Edit Allocate</li>
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
                <form name="myForm" action="<?php echo base_url() ?>evis_app/update_allocate" method="POST">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label class="control-label">Select Reader</label>
                            <div class="controls">
                                <select name="reader_id" class="form-control" tabindex="1">
                                    <option value=" ">Select Status</option>
                                    <?php
                                    foreach ($all_reader as $v_reader) {
                                        ?>
                                        <option value="<?php echo $v_reader->reader_id; ?>"><?php echo $v_reader->reader_name; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Book Allocate Start Date</label>
                            <input type="text" name="allocate_start_date" class="form-control" value="<?php echo $allocate_info->allocate_start_date ?>">
                            <input type="hidden" name="allocate_id" class="form-control" value="<?php echo $allocate_info->allocate_id ?>">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label class="control-label">Select Book</label>
                            <div class="controls">
                                <select name="book_id" class="form-control" tabindex="1">
                                    <option value=" ">Select Status</option>
                                    <?php
                                    foreach ($all_book as $v_book) {
                                        ?>
                                        <option value="<?php echo $v_book->book_id; ?>"><?php echo $v_book->book_name; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Book Allocate End Date</label>
                            <input type="text" name="allocate_end_date" class="form-control" value="<?php echo $allocate_info->allocate_end_date ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Refund Status</label>
                            <div class="controls">
                                <select name="refund_status" class="form-control" tabindex="1">
                                    <option value="">Select Status</option>
                                    <option value="1">Allocate</option>
                                    <option value="0">Not Allocate</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Done</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.forms['myForm'].elements['reader_id'].value = '<?php echo $allocate_info->reader_id; ?>';
    document.forms['myForm'].elements['book_id'].value = '<?php echo $allocate_info->book_id; ?>';
    document.forms['myForm'].elements['refund_status'].value = '<?php echo $allocate_info->refund_status; ?>';
</script>