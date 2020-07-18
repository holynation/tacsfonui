<?php $base=base_url(); include_once 'template/header_admin.php'; ?>
<?php include_once 'template/sidebar.php'; ?>
<!-- this is the sidebar position -->

<!-- Main Container Start -->
    <main class="main--container">
        <!-- Page Header Start -->
        <section class="page--header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                       <!-- Page Title Start -->
                          <h2 class="page--title h5"><?php echo ucfirst(removeUnderscore($model)); ?></h2>
                          <!-- Page Title End -->

                          <ul class="breadcrumb">
                              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                              <li class="breadcrumb-item"><span><?php echo removeUnderscore($model); ?></span></li>
                          </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- Page Header End -->

        <!-- Main Content Start -->
        <section class="main--content">
                <div class="row gutter-20">
                    <div class="col-lg-8">
                        <!-- Panel Start -->
                        <div class="panel profile-cover">
                            <div class="profile-cover__img">
                                <img src="<?php echo base_url($userImage); ?>" alt="">
                                <h3 class="h3"><?php echo $userName; ?></h3>
                            </div>
                            <?php
                                $adminCoverImage = ($admin->admin_path != '')  ? $admin->admin_path : "assets/private/img/covers/01_800x150.jpg";
                            ?>
                            <div class="profile-cover__action" data-bg-img="<?php echo base_url($adminCoverImage); ?>" data-overlay="0.3">
                                <button class="showupload btn btn-rounded btn-info">
                                    <i class="fa fa-image"></i>
                                    <span>Change image</span>
                                </button>
                                <!-- <div class="showupload btn btn-primary btn-block">change photo</div> -->
                                  <div class="form">
                                    <?php $userID = (isset($data['id']) && $data['id'] != '') ? $data['id'] : $admin->ID; ?>
                                    <div class="upload-control" style="display: none; width: 205px;margin:0 auto;">
                                      <form id="data_profile_change" method="post" enctype="multipart/form-data" action="<?php echo base_url('mc/update/admin/'.$admin->ID.'/1') ?>">
                                      <label for="">
                                        choose file to upload <br>
                                        <input type="file" name="admin_path" id="admin_path" class="form-control">
                                      </label>
                                      <input type="submit" value="Upload Photo" name="submit-btn" class="btn btn-primary">
                                      </form>
                                    </div>
                                </div>
                            </div>

                            <div class="profile-cover__info">
                                <ul class="nav">
                                    <li><strong><?php echo $memberCount; ?></strong>Members</li>
                                </ul>
                            </div>
                        </div>
                        <!-- Panel End -->

                        <div id="center_modal_password" class="modal fade animated position_modal" role="dialog">
                            <div class="modal-dialog">
                              <!-- <form action="" method="post"> -->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Change Password</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?php echo base_url('vc/changePassword'); ?>" method="post" role="form" id="form_change_password" name="form_change_password">
                                            <div class="form-group mb-3">
                                                <label for="current_password">Current Password</label>
                                                <input class="form-control" type="password" required name="current_password" id="current_password" placeholder="Enter your current password">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="password">New Password</label>
                                                <input class="form-control" type="password" required name="password" id="password" placeholder="Enter your new password">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="confirm_password">Confirm Password</label>
                                                <input class="form-control" type="password" required name="confirm_password" id="confirm_password" placeholder="Enter your password again">
                                            </div>
                                            <div class="form-group">
                                              <button class="btn btn-primary submit-btn btn-block">Update</button>
                                            </div>
                                            <input type="hidden" name="userID" id="userID" value="<?php echo $userID; ?>" />
                                            <input type="hidden" name="isajax">
                                            <input type="hidden" id='base_path' value="<?php echo $base; ?>">
                                            <input type="hidden" name="task" value="update">
                                          </form>
                                    </div>
                                </div>
                              <!-- </form> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <!-- Panel Start -->
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Personal Info.</h3>
                            </div>

                            <div class="panel-content panel-about">
                                <table>
                                    <tr>
                                        <th><i class="fas fa-briefcase"></i>Fullname</th>
                                        <td><?php echo $userName; ?></td>
                                    </tr>
                                    <tr>
                                        <th><i class="fas fa-birthday-cake"></i>email</th>
                                        <td><?php echo $admin->email; ?></td>
                                    </tr>
                                    <tr>
                                        <th><i class="fas fa-map-marker-alt"></i>Locatoin</th>
                                        <td><?php echo $admin->address; ?>.</td>
                                    </tr>
                                    <tr>
                                        <th><i class="fas fa-mobile-alt"></i>Mobile No.</th>
                                        <td><a href="tel:7328397510" class="btn-link"><?php echo format_phone('nig',$admin->phone_number); ?></a></td>
                                    </tr>
                                </table>
                                <button class="btn btn-rounded btn-info" style="margin-top: 15px;" data-toggle='modal' data-target='#center_modal_password'>
                                    <i class="fa fa-lock"></i>
                                    <span>Update Password</span>
                                </button>
                            </div>
                        </div>
                        <!-- Panel End -->
                    </div>
                </div>
            </section>
        <!-- Main Content End -->

<?php include_once 'template/footer_admin.php'; ?>

 <script>
   function addMoreEvent() {
          $('.showupload').click(function(event) {
            $(this).hide();
            $('.upload-control').show();
          });

          $("#data_profile_change").submit(function(e){
            e.preventDefault();
            submitAjaxForm($(this));
           });

           var data_notify = $('#data_notify');
            $('#form_change_password').submit(function(e){
              e.preventDefault();
              var password = $('#password').val(),
                  confirm_password = $('#confirm_password').val(),
                  current_password = $('#current_password').val();

                  if(password == '' || confirm_password == '' || password == ''){
                      data_notify.html('<p class="alert alert-danger" style="width:100%;margin:0 auto;">All Field is required...</p>');
                      return false;
                  }
                  else if(password != confirm_password ){
                    data_notify.html('<p class="alert alert-danger" style="width:100%;margin:0 auto;">new password must match confirm password...</p>');
                    return false;
                  }else{
                    submitAjaxForm($(this));
                  }

            });
        }
          function ajaxFormSuccess(target,data) {
            showNotification(data.status,data.message);
            if(data.status){
                if (typeof target ==='undefined') {
                    location.reload();
                }
            }
          }
 </script>
