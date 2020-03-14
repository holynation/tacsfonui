<?php $base=base_url(); ?>
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
    <link rel="icon" href="favicon.png" type="image/png">

    <!-- ==== Google Font ==== -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CMontserrat:400,500">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/private/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/private/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/private/css/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/private/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/private/css/style.css">

    <!-- Page Level Stylesheets -->

</head>
<body>

    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Login Page Start -->
        <div class="m-account-w" data-bg-img="<?php echo base_url(); ?>assets/private/img/account/wrapper-bg.jpg">
            <div class="m-account">
                <div class="row no-gutters">
                    <div class="col-md-6">
                        <!-- Login Content Start -->
                        <div class="m-account--content-w" data-bg-img="<?php echo base_url(); ?>assets/private/img/account/content-bg.jpg">
                            <div class="m-account--content">
                                <h2 class="h2">Don't have an account?</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                <a href="register.html" class="btn btn-rounded">Register Now</a>
                            </div>
                        </div>
                        <!-- Login Content End -->
                    </div>

                    <div class="col-md-6">
                        <!-- Login Form Start -->
                        <div class="m-account--form-w">
                            <div class="m-account--form">
                                <!-- Logo Start -->
                                <div class="logo">
                                    <img src="<?php echo base_url(); ?>assets/private/img/logo.png" alt="">
                                </div>
                                <!-- Logo End -->

                                <form action="<?php echo base_url('auth/web'); ?>" method="post" role="form">
                                    <label class="m-account--title">Login to your account</label>

                                    <div id="form-notify"></div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <i class="fas fa-user"></i>
                                            </div>

                                            <input type="email" name="email" placeholder="Email" class="form-control" autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <i class="fas fa-key"></i>
                                            </div>

                                            <input type="password" name="password" placeholder="Password" class="form-control" autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="m-account--actions">
                                        <a href="#" class="btn-link">Forgot Password?</a>

                                        <button type="submit" class="btn btn-rounded btn-info">Login</button>
                                    </div>

                                    <div class="m-account--alt">
                                        <p><span>OR LOGIN WITH</span></p>

                                        <div class="btn-list">
                                            <a href="#" class="btn btn-rounded btn-warning">Facebook</a>
                                            <a href="#" class="btn btn-rounded btn-warning">Google</a>
                                        </div>
                                    </div>

                                    <div class="m-account--footer">
                                        <p>&copy; <?php echo date('Y'); ?> TACSFON UI</p>
                                    </div>
                                    <input type="hidden" name="isajax">
                                    <input type="hidden" id='base_path' value="<?= $base ?>">
                                </form>
                            </div>
                        </div>
                        <!-- Login Form End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Login Page End -->
    </div>
    <!-- Wrapper End -->

    <!-- Scripts -->
    <script src="<?php echo base_url(); ?>assets/private/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/private/js/main.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/private/js/custom.js'); ?>"></script>

    <!-- Page Level Scripts -->

<script>
  $(function () {
    var form =$('form');
    form.submit(function(event) {
      event.preventDefault();
      var note = $("#form-notify");
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
      $("#form-notify").show();
      $("#form-notify").text(data.message).addClass("alert").css({background: '#FF4040',color:'#fff'});
    }
  }
</script>
</body>
</html>
