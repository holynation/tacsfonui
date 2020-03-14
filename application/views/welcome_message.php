<?php $base=base_url(); ?>
<!DOCTYPE html>
<html lang="en">


<!-- login23:11-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title><?php echo getTitlePage('Login'); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="<?php echo base_url(); ?>assets/js/html5shiv.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper account-wrapper">
        <div class="account-page">
			<div class="account-center">
				<div class="account-box">
                    <form action="<?php echo base_url('auth/web'); ?>" method="post" role="form" class="form-signin">
						<div class="account-logo">
                            <a href="javascript:void(0)"><img src="assets/img/logo-dark.png" alt=""></a>
                        </div>
                        <div id="notify"></div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="text" autofocus class="form-control" placeholder="Enter your email here" name="email" id="email">
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password" class="form-control" placeholder="Enter your password here" name="password" id="password">
                        </div>
                        <!-- <div class="form-group text-right">
                            <a href="forgot-password.html">Forgot your password?</a>
                        </div> -->
                        <input type="hidden" name="isajax">
                		<input type="hidden" id='base_path' value="<?= $base ?>">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary account-btn">Login</button>
                        </div>
                    </form>
                </div>
			</div>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/app.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/custom.js'); ?>"></script>

 <script>
  $(function () {
    var form =$('form');
    form.submit(function(event) {
      event.preventDefault();
      var note = $("#notify");
      note.text('');
      note.hide();
      submitAjaxForm(form);
    });
  });

  function ajaxFormSuccess(target,data){
    if (data.status) {
      var path = data.message;
      location.assign(path);
    }
    else{
      $("#notify").show();
      $("#notify").text(data.message).addClass("alert alert-danger alert-dismissible");
    }
  }
</script>
</body>
</html>