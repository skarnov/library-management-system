<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo $title; ?></title>
        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
            function check_delete()
            {
                var chk = confirm('Are You Want To Delete This');
                if (chk)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        </script> 
    </head>

    <body>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>">Evis Library Management System</a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li><i>Welcome! </i><strong><?php echo $this->session->userdata('admin_name'); ?></strong></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <?php
                            $Today = date('y:m:d');
                            $new = date('l, F d, Y', strtotime($Today));
                            echo $new;
                            ?> 
                        </a>
                    </li>
                    <li><a href="<?php echo base_url(); ?>evis_app/logout"><i class="fa fa-sign-out fa-fw"></i> Logout </a></li>
                </ul>
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li>
                                <a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                            <?php
                                $admin_level = $this->session->userdata('admin_level');
                                if ($admin_level == '1')
                                {
                            ?>
                                <li>
                                    <a href="#"><i class="fa fa-flag"></i> Admin Manager<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="<?php echo base_url(); ?>evis_app/add_admin">Add Admin</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url(); ?>evis_app/manage_admin">Manage Admin</a>
                                        </li>
                                    </ul>
                                </li>
                            <?php
                                }
                            ?>
                            <?php
                                $admin_level = $this->session->userdata('admin_level');
                                if ($admin_level == '2' || $admin_level == '1')
                                {
                            ?>
                            <li>
                                <a href="#"><i class="fa fa-book"></i> Book Manager<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo base_url(); ?>evis_app/add_book">Add Book</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>evis_app/manage_book">Manage Book</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-list"></i> Category Manager<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo base_url(); ?>evis_app/add_category">Add Category</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>evis_app/manage_category">Manage Category</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-pencil"></i> Author Manager<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo base_url(); ?>evis_app/add_author">Add Author</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>evis_app/manage_author">Manage Author</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-television"></i> Publisher Manager<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo base_url(); ?>evis_app/add_publisher">Add Publisher</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>evis_app/manage_publisher">Manage Publisher</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-male"></i> Reader Manager<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo base_url(); ?>evis_app/add_reader">Add Reader</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>evis_app/manage_reader">Manage Reader</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-sun-o"></i> Library Management<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo base_url(); ?>evis_app/add_allocate">Allocate Book</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>evis_app/manage_allocation">Manage Allocation</a>
                                    </li>
                                </ul>
                            </li>
                            <?php
                                }
                            ?>
                            <?php
                                $admin_level = $this->session->userdata('admin_level');
                                if ($admin_level == '3' || $admin_level == '1')
                                {
                            ?>
                            <li>
                                <a href="<?php echo base_url(); ?>evis_app/licence"><i class="fa fa-exclamation-triangle"></i> Licence</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>evis_app/about"><i class="fa fa-home"></i> About</a>
                            </li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>
            <?php echo $dashboard; ?>
        </div>
        <!-- /#wrapper -->
        <!-- jQuery -->
        <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?php echo base_url(); ?>js/metisMenu.min.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url(); ?>js/sb-admin-2.js"></script>
        <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    </body>
</html>