<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Reader Management </h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Home</a></li>
                <li><a href="<?php echo base_url(); ?>evis_app/add_reader">Add Reader</a></li>
                <li class="active">Manage Reader</li>
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
                            <th>Card NO</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                                foreach($all_reader as $v_reader)
                                {
                            ?>
                            <tr>
                                <td><?php echo $v_reader->reader_library_no;?></td>
                                <td><?php echo $v_reader->reader_name;?></td>
                                <td><?php echo $v_reader->reader_mobile;?></td>
                                <td><?php echo $v_reader->reader_email;?></td>
                                <td><?php echo $v_reader->reader_address;?></td>
                                <td>
                                    <div class='activation_color'>
                                        <?php
                                            if($v_reader->reader_status=='1') {
                                                echo 'Active';
                                            }
                                        ?> 
                                        <div id='color'>    
                                            <?php
                                                if($v_reader->reader_status==0) {
                                                    echo 'NOT ACTIVE';
                                                }
                                            ?>   
                                        </div>    
                                    </div>
                                </td>
                                <td>
                                    <?php if($v_reader->reader_status=='1')
                                        {
                                    ?>
                                        <a href="<?php echo base_url();?>evis_app/deactive_reader/<?php echo $v_reader->reader_id;?>" class="btn btn-danger" data-toggle="tooltip" title="Deactive Reader"><i class="fa fa-times"></i></a>
                                    <?php
                                        }
                                        else{
                                    ?>
                                        <a href="<?php echo base_url();?>evis_app/active_reader/<?php echo $v_reader->reader_id;?>" class="btn btn-success" data-toggle="tooltip" title="Active Reader"><i class="fa fa-check"></i></a>
                                    <?php
                                        }
                                    ?>
                                    <a href="<?php echo base_url();?>evis_app/edit_reader/<?php echo $v_reader->reader_id;?>" class="btn btn-primary" data-toggle="tooltip" title="Edit Reader"><i class="fa fa-pencil-square-o"></i></a>
                                    <a href="<?php echo base_url();?>evis_app/delete_reader/<?php echo $v_reader->reader_id;?>" class="btn btn-danger" data-toggle="tooltip" title="Delete Reader" onclick="return check_delete();"><i class="fa fa-trash"></i></a>
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