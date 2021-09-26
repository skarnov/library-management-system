<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Book Information </h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="<?php echo base_url(); ?>evis_app/manage_book">Manage Book</a></li>
                <li class="active">Edit Book</li>
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
                <form name="myForm" action="<?php echo base_url() ?>evis_app/update_book" method="POST">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" required name="book_name" class="form-control" value="<?php echo $book_info->book_name; ?>">
                            <input type="hidden" required name="book_id" class="form-control" value="<?php echo $book_info->book_id; ?>">
                        </div>
                        <div class="form-group">
                            <label>Published Year</label>
                            <input type="number" required name="book_year" class="form-control" value="<?php echo $book_info->book_year; ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Select Author</label>
                            <div class="controls">
                                <select name="author_id" class="form-control" tabindex="1">
                                    <option value=" ">Select Status</option>
                                    <?php
                                    foreach ($all_author as $v_author) {
                                        ?>
                                        <option value="<?php echo $v_author->author_id; ?>"><?php echo $v_author->author_name; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Book Country</label>
                            <div class="controls">
                                <select name="book_country" class="form-control" tabindex="1">
                                    <option value="">Select Status</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="India">India</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States of America">United States of America</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Edition</label>
                            <input type="text" required name="book_edition" class="form-control" value="<?php echo $book_info->book_edition; ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Select Category</label>
                            <div class="controls">
                                <select name="category_id" class="form-control" tabindex="1">
                                    <option value="">Select Category</option>
                                    <?php
                                    foreach ($all_category as $v_category) {
                                        ?>
                                        <option value="<?php echo $v_category->category_id; ?>"><?php echo $v_category->category_name; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Select Publisher</label>
                            <div class="controls">
                                <select name="publisher_id" class="form-control" tabindex="1">
                                    <option value="">Select Publisher</option>
                                    <?php
                                    foreach ($all_publisher as $v_publisher) {
                                        ?>
                                        <option value="<?php echo $v_publisher->publisher_id; ?>"><?php echo $v_publisher->publisher_name; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Book Language</label>
                            <div class="controls">
                                <select name="book_language" class="form-control" tabindex="1">
                                    <option value="">Select Language</option>
                                    <option value="Bengali">Bengali</option>
                                    <option value="English">English</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Book Availability</label>
                            <div class="controls">
                                <select name="book_availability" class="form-control" tabindex="1">
                                    <option value="">Select Availability</option>
                                    <option value="1">Available</option>
                                    <option value="0">Not Available</option>
                                </select>
                            </div>
                        </div>
                        <div style="background-color:wheat;"><?php echo validation_errors(); ?></div>
                        <button type="submit" class="btn btn-success">Update Info</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.forms['myForm'].elements['author_id'].value = '<?php echo $book_info->author_id; ?>';
    document.forms['myForm'].elements['book_country'].value = '<?php echo $book_info->book_country; ?>';
    document.forms['myForm'].elements['category_id'].value = '<?php echo $book_info->category_id; ?>';
    document.forms['myForm'].elements['publisher_id'].value = '<?php echo $book_info->publisher_id; ?>';
    document.forms['myForm'].elements['book_language'].value = '<?php echo $book_info->book_language; ?>';
    document.forms['myForm'].elements['book_availability'].value = '<?php echo $book_info->book_availability; ?>';
</script>