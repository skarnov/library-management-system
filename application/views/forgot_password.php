<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Evis Login</title>
        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="login-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="login-heading">Forgot Password</span></h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" action="<?php echo base_url() ?>evis_login/reset_password" method="POST">
                                <h3 style="color:red">
                                    <?php
                                    $exc = $this->session->userdata('exception');
                                    if (isset($exc)) {
                                        echo $exc;
                                        $this->session->unset_userdata('exception');
                                    }
                                    ?>
                                </h3>
                                <div style="background-color:wheat;"><?php echo validation_errors(); ?></div><br/>
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="E-Mail" name="admin_email" type="email" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-xl btn-danger">Done</button>
                                        <a href="<?php echo base_url();?>" class="btn btn-xl btn-danger">Back</a>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>