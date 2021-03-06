<!DOCTYPE html>
<html dir="ltr" lang="en" class="no-outlines">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- ==== Document Title ==== -->
    <title>TACSFON - Household of Refuge</title>
    
    <!-- ==== Document Meta ==== -->
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- ==== Favicon ==== -->
    <link rel="icon" href="<?php echo base_url(); ?>assets/public/images/favicon.png" type="image/png">

    <!-- ==== Google Font ==== -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CMontserrat:400,500">

    <!-- Stylesheets -->
    <!-- <link rel="stylesheet" href="<?php //echo base_url(); ?>assets/private/libs/summernote/summernote-bs4.css"> -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/private/libs/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/private/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/private/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/private/css/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/private/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/private/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/private/css/dropzone.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/private/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/private/libs/jquery-datetime-picker/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/private/css/style.css">

    <!-- Page Level Stylesheets -->
    <script src="<?php echo base_url(); ?>assets/private/js/jquery.min.js"></script>
</head>
<body>

    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Navbar Start -->
        <header class="navbar navbar-fixed">
            <!-- Navbar Header Start -->
            <div class="navbar--header">
                <!-- Logo Start -->
                <a href="<?php echo base_url(); ?>" class="logo">
                    <img src="<?php echo base_url(); ?>assets/logo.jpg" alt="" width="60" height="60">
                </a>
                <!-- Logo End -->

                <!-- Sidebar Toggle Button Start -->
                <a href="#" class="navbar--btn" data-toggle="sidebar" title="Toggle Sidebar">
                    <i class="fa fa-bars"></i>
                </a>
                <!-- Sidebar Toggle Button End -->
            </div>
            <!-- Navbar Header End -->

            <!-- Sidebar Toggle Button Start -->
            <a href="#" class="navbar--btn" data-toggle="sidebar" title="Toggle Sidebar">
                <i class="fa fa-bars"></i>
            </a>
            <!-- Sidebar Toggle Button End -->

            <!-- Navbar Search Start -->
            <div class="navbar--search">
               <!--  <form action="search-results.html">
                    <input type="search" name="search" class="form-control" placeholder="Search Something..." required>
                    <button class="btn-link"><i class="fa fa-search"></i></button>
                </form> -->
            </div>
            <!-- Navbar Search End -->

            <?php
                $userType=$this->webSessionManager->getCurrentUserProp('user_type');
                $userImage='assets/private/img/avatars/01_80x80.png';
                $userProfile='';
                $userName='';
                if($userType == 'admin'){
                    $userName = $admin->firstname .' '. $admin->lastname;
                    $userImage = ($admin->admin_path != '') ? $admin->admin_path: $userImage;
                    $userProfile= 'vc/admin/profile';
                }
                
            ?>

            <div class="navbar--nav ml-auto">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fa fa-bell"></i>
                            <span class="badge text-white bg-blue"></span>
                        </a>
                    </li>

                    <!-- Nav User Start -->
                    <li class="nav-item dropdown nav--user online">
                        <a href="#" class="nav-link" data-toggle="dropdown">
                            <img src="<?php echo base_url($userImage); ?>" alt="" class="rounded-circle">
                            <span><?php echo $userName; ?></span>
                            <i class="fa fa-angle-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url($userProfile); ?>"><i class="far fa-user"></i>Profile</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a href="<?php echo base_url('auth/logout'); ?>"><i class="fa fa-power-off"></i>Logout</a></li>
                        </ul>
                    </li>
                    <!-- Nav User End -->
                </ul>
            </div>
        </header>
        <!-- Navbar End -->

        <style>
          #notification{
              display: none;
              position: absolute;
              width: 50%;
              z-index: 4000;
          }
          .modal-dialog {
              margin-top: 100px ;
          }
          select{
            wdith:100%;
            display: block;
          }
      </style>

<div id="notification" class="alert alert-dismissable text-center"></div>