<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="">
        <title><?php echo $title; ?></title>
        <!-- Bootstrap core CSS -->
        <?php echo link_tag('bootstrap/css/bootstrap.css', 'stylesheet', 'text/css'); ?>
        <?php echo link_tag('bootstrap/css/bootstrap-theme.css', 'stylesheet', 'text/css'); ?>
        <?php echo link_tag('jquery-ui/jquery-ui.css', 'stylesheet', 'text/css'); ?>


        <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>jquery-ui/jquery-ui.js"></script>
        <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.js"></script>

        <script src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>

        <?php echo link_tag('fullcalendar/fullcalendar.css', 'stylesheet', 'text/css'); ?>
        <?php echo link_tag('fullcalendar/fullcalendar.print.css', 'stylesheet', 'text/css'); ?>
        <script src="<?php echo base_url(); ?>fullcalendar/lib/moment.min.js"></script>
        <script src="<?php echo base_url(); ?>fullcalendar/fullcalendar.min.js"></script>

        <script src='https://www.google.com/recaptcha/api.js'></script>

        <script src="<?php echo base_url(); ?>js/script.js"></script>

        <?php echo link_tag('css/style.css', 'stylesheet', 'text/css'); ?>

    </head>

    <body>
        <div class="container">

            <header>
                <a href="<?php echo site_url(); ?>">
                    <div class="page-header" style="margin-top: 5px;">
                        <h1><a href="<?php echo site_url(); ?>/home">ระบบจองคิวเครื่อง XPS</a></h1>
                    </div>
                </a>
            </header>

            <?php if ($this->session->userdata('email')): ?>
                <?php $user_url = site_url() . '/user/user_detail/' . $this->session->userdata('user_id'); ?>
                <nav class="navbar navbar-default" role="navigation" style="border-radius: 0;">
                    <div class="container-fluid">

                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="<?php echo site_url(); ?>/home">หน้าแรก</a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">                        

                            <ul class="nav navbar-nav navbar-right">
                                <li><a title="ข้อมูลส่วนตัว" href="<?php echo $user_url; ?>"><strong><?php echo $firstname . ' ' . $lastname; ?></strong></a></li>

                                <li><a title="ออกจากระบบ" href="<?php echo site_url(); ?>/logout"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout</a></li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
                <?php
            
             endif;
