<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Book Management </h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Home</a></li>
                <li><a href="<?php echo base_url(); ?>evis_app/add_book">Add Book</a></li>
                <li class="active">Manage Book</li>
            </ul>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <div class="row">
                    <div class="col-md-3">
                        <form action="<?php echo base_url() ?>evis_app/book_search" method="POST">
                            <div class="input-group"  style="margin-top: 4%;">
                                <input class="form-control" id="system-search" name="text" placeholder="Search Books" required>
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
                <h3 style="color:green">
                    <?php
                    $msg = $this->session->userdata('message');
                    if (isset($msg)) {
                        echo $msg;
                        $this->session->unset_userdata('message');
                    }
                    ?>
                </h3>
                <div class="table-responsive">
                    <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                            <th>Name</th>
                            <th>Cover Picture</th>
                            <th>Author</th>
                            <th>Edition</th>
                            <th>Publisher</th>
                            <th>Category</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                                foreach($search_book as $v_book)
                                {
                            ?>
                            <tr>
                                <td><?php echo $v_book->book_name;?></td>
                                <td><img src="<?php echo base_url().$v_book->book_image;?>" style="height:50px; width:50px;" /></td>
                                <td><?php echo $v_book->author_name;?></td>
                                <td><?php echo $v_book->book_edition;?></td>
                                <td><?php echo $v_book->publisher_name;?></td>
                                <td><?php echo $v_book->category_name;?></td>
                                <td>
                                    <a href="<?php echo base_url();?>evis_app/view_book/<?php echo $v_book->book_id;?>/<?php echo $v_book->category_name;?>/<?php echo $v_book->author_name;?>/<?php echo $v_book->publisher_name;?>" class="btn btn-warning" data-toggle="tooltip" title="View Book"><i class="fa fa-tablet"></i></a>
                                    <a href="<?php echo base_url();?>evis_app/edit_book/<?php echo $v_book->book_id;?>" class="btn btn-primary" data-toggle="tooltip" title="Edit Book"><i class="fa fa-pencil-square-o"></i></a>
                                    <a href="<?php echo base_url();?>evis_app/delete_book/<?php echo $v_book->book_id;?>" class="btn btn-danger" data-toggle="tooltip" title="Delete Book" onclick="return check_delete();"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                              <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <div class="pull-right">
                        <?php echo $this->pagination->create_links();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>