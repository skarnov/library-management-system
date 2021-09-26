<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">View Book </h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="<?php echo base_url(); ?>evis_app/manage_book">Manage Book</a></li>
                <li class="active">View Book</li>
            </ul>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <div class="col-sm-12">
                    <div class="col-sm-3">
                        <img class="img-thumbnail" src="<?php echo base_url() . $book_info->book_image; ?>">
                    </div>
                    <div class="col-sm-7">
                        <p>
                            <i class="fa fa-book"></i> <strong>Book Name:</strong> <?php echo $book_info->book_name; ?>
                            <br>
                            <i class="fa fa-pencil"></i> <strong>Author:</strong> <?php echo $author_name; ?>
                            <br>
                            <i class="fa fa-calendar-minus-o"></i> <strong>Year:</strong> <?php echo $book_info->book_year; ?>
                            <br>
                            <i class="fa fa-hourglass"></i> <strong>Edition:</strong> <?php echo $book_info->book_edition; ?>
                            <br>
                            <i class="fa fa-television"></i> <strong>Publisher:</strong> <?php echo $publisher_name; ?>
                            <br>
                            <i class="fa fa-language"></i> <strong>Language:</strong> <?php echo $book_info->book_language; ?>
                            <br>
                            <i class="fa fa-list"></i> <strong>Category:</strong> <?php echo $category_name; ?>
                            <br>
                            <i class="fa fa-list"></i> <strong>Country:</strong> <?php echo $book_info->book_country; ?>
                            <br>
                            <i class="fa fa-building"></i> <strong>Availability:</strong>
                            <?php
                            $availability = $book_info->book_availability;
                            if ($availability == 1) {
                                echo 'Available';
                            }
                            else {
                                echo 'Not Available';
                            }
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>