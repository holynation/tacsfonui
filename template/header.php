<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Our Church is a premium HTML5 Church Website Template with Responsive design. Church Template includes many pages like Bulletin, Programs, events, sermons, ministries, working church contact form etc..">
<meta name="keywords" content="Church, Website, Template, Bulletin, Programs, Events, Themeforest, Premium, Charity, Non Profit ">
<meta name="author" content="Surjith SM">
<title>TACSFON - Household of Refuge</title>

<!-- Bootstrap core CSS -->
<link href="<?php echo base_url(); ?>assets/public/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/public/css/font-awesome.min.css" rel="stylesheet">
<!-- Church Template CSS -->
<link href="<?php echo base_url(); ?>assets/public/css/church.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/public/css/fancybox.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
<![endif]-->

<!-- Favicons -->
<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/public/images/favicon.png">

<!-- Custom Google Font : Montserrat and Droid Serif -->

<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700' rel='stylesheet' type='text/css'>
</head>

<body>
<!-- Navigation Bar Starts -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="<?php echo base_url(); ?>"> <img src="<?php echo base_url(); ?>assets/logo.jpg" alt="church logo" class="img-responsive"></a> </div>
    <div class="navbar-collapse collapse" id="nav">
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="<?php echo base_url(); ?> ">HOME</a>
        </li>
        <li><a href="<?php echo base_url('about'); ?>">ABOUT</a></li>
        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Media <span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-menu-left" role="menu">
            <li><a href="<?php echo base_url('audio'); ?>">Audio</a></li>
            <li><a href="<?php echo base_url('drama'); ?>">Drama</a></li>
          </ul>
        </li>
        <li><a href="<?php echo base_url('events'); ?>">Events</a></li>
        <li><a href="<?php echo base_url('gallery'); ?>">Gallery</a></li>
        <li><a href="<?php echo base_url('contact'); ?>">CONTACT</a></li>
        <li><a href="<?php echo base_url('login'); ?>" class="btn btn-default"><i class="glyphicon glyphicon-user"></i> SIGN IN</a></li>
      </ul>
    </div>
    <!--/.nav-collapse --> 
  </div>
</div>
<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
<!--// Navbar Ends--> 
<?php
  // print_r(getSliders());exit;
include_once("assets/public/css/slider.php");
?>