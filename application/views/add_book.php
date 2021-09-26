<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Book </h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="active">Add Book</li>
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
                <form action="<?php echo base_url() ?>evis_app/save_book" method="POST" enctype="multipart/form-data">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" required name="book_name" class="form-control" placeholder="Enter Book Name">
                        </div>
                        <div class="form-group">
                            <label>Published Year</label>
                            <input type="number" required name="book_year" class="form-control" placeholder="Enter Book Published Year">
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
                            <label>Cover Picture</label>
                            <input type="file" name="book_image" class="form-control">
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
                            <input type="text" required name="book_edition" class="form-control" placeholder="Enter Book Edition">
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
                        <button type="submit" class="btn btn-success">Add Book</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>