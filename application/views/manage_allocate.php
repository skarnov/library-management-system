<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Book Allocation Management </h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Home</a></li>
                <li><a href="<?php echo base_url(); ?>evis_app/add_allocate">Add Allocation</a></li>
                <li class="active">Manage Allocation</li>
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
                <div class="table-responsive">
                    <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                            <th>Reader Name</th>
                            <th>Book Name</th>
                            <th>Allocation Date</th>
                            <th>Refund Date</th>
                            <th>Refund Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                                foreach($all_allocate as $v_allocate)
                                {
                            ?>
                            <tr>
                                <td><?php echo $v_allocate->reader_name;?></td>
                                <td><?php echo $v_allocate->book_name;?></td>
                                <td><?php echo $v_allocate->allocate_start_date;?></td>
                                <td><?php echo $v_allocate->allocate_end_date;?></td>
                                <td>
                                    <div class='activation_color'>
                                        <?php
                                            if($v_allocate->refund_status=='1') {
                                                echo 'Refuned';
                                            }
                                        ?> 
                                        <div id='color'>    
                                            <?php
                                                if($v_allocate->refund_status==0) {
                                                    echo 'NOT';
                                                }
                                            ?>   
                                        </div>    
                                    </div>
                                </td>
                                <td>
                                    <?php if($v_allocate->refund_status=='1')
                                        {
                                    ?>
                                        <a href="<?php echo base_url();?>evis_app/not_allocate/<?php echo $v_allocate->allocate_id;?>" class="btn btn-danger" data-toggle="tooltip" title="Not Allocate"><i class="fa fa-times"></i></a>
                                    <?php
                                        }
                                        else{
                                    ?>
                                        <a href="<?php echo base_url();?>evis_app/done_allocate/<?php echo $v_allocate->allocate_id;?>" class="btn btn-success" data-toggle="tooltip" title="Allocate"><i class="fa fa-check"></i></a>
                                    <?php
                                        }
                                    ?>
                                    <a href="<?php echo base_url();?>evis_app/edit_allocate/<?php echo $v_allocate->allocate_id;?>" class="btn btn-primary" data-toggle="tooltip" title="Edit Reader"><i class="fa fa-pencil-square-o"></i></a>
                                    <a href="<?php echo base_url();?>evis_app/delete_allocate/<?php echo $v_allocate->allocate_id;?>" class="btn btn-danger" data-toggle="tooltip" title="Delete Reader" onclick="return check_delete();"><i class="fa fa-trash"></i></a>
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