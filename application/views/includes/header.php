<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../skin/assets/ico/favicon.png">

    <title>B Database</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>skin/dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>skin/signin.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>skin/datepicker.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="../../skin/assets/js/html5shiv.js"></script>
    <script src="../../skin/assets/js/respond.min.js"></script>
    <![endif]-->

    <script src="<?php echo base_url(); ?>skin/assets/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>skin/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>skin/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>skin/dist/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(); ?>skin/dist/js/datepicker/js/bootstrap-datepicker.js"></script>
</head>

<body>

<div class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">B Database</a>
        </div>

        <div class="collapse navbar-collapse">
            <p class="navbar-text pull-right">

                <?php if($this->session->userdata('is_logged_in')): ?>
                    <i class="icon-user icon-white"></i> <?php echo ucfirst($this->session->userdata('username')); ?> &nbsp; &nbsp;

                    <?php
                        $user_type = ($this->session->userdata('user_type')!='admin')? 'member' : $this->session->userdata('user_type');
                    ?>


                    &nbsp; &nbsp; <?php echo anchor($user_type.'/logout','<i class=></i> Logout')?>

                <?php else: ?>
                    &nbsp; &nbsp; <?php echo anchor('login','Login / Signup')?>
                <?php endif; ?> <br />
                <!--                    --><?php //echo form_input(array('name' => 'search', 'id' => 'search')); ?>

            </p>

        </div><!--/.nav-collapse -->
    </div>
</div>

<div class="container">
    <div class="row">
