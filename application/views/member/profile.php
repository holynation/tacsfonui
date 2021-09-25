<?php 
include "template/header.php";
include "template/sidebar.php";
?>

<div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-7 col-6">
                        <h4 class="page-title">My Profile</h4>
                    </div>

                    <div class="col-sm-5 col-6 text-right m-b-30">
                        <a href="edit-profile.html" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Edit Profile</a>
                    </div>
                </div>
                <div class="card-box profile-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="#"><img class="avatar" src="<?php echo base_url($patients->img_path); ?>" alt="doctor pic"></a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0"><?php echo $patients->first_name .' '.$patients->last_name; ?></h3>
                                                <small class="text-muted">Patient</small>
                                                <div class="staff-id">Patients ID : PA-<?php echo randStrGen(5); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">Phone:</span>
                                                    <span class="text"><a href="#"><?php echo format_phone_nig($patients->phone_num); ?></a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Email:</span>
                                                    <span class="text"><a href="#"><?php echo $patients->email; ?></a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Birthday:</span>
                                                    <span class="text"><?php echo dateFormatter($patients->dob); ?></span>
                                                </li>
                                                <li>
                                                    <span class="title">Address:</span>
                                                    <span class="text"><?php echo $patients->address; ?></span>
                                                </li>  
                                                <li>
                                                    <span class="title">Gender:</span>
                                                    <span class="text"><?php echo $patients->gender; ?></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>
				<div class="profile-tabs">
					<ul class="nav nav-tabs nav-tabs-bottom">
						<li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">About</a></li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane show active" id="about-cont">
			                <div class="row">
			                    <div class="col-md-12">
			                        <div class="card-box">
			                            <h3 class="card-title">Personal Informations</h3>
			                            <div class="experience-box">
			                                <ul class="experience-list">
			                                    <li>
			                                        <div class="experience-user">
			                                            <div class="before-circle"></div>
			                                        </div>
			                                        <div class="experience-content">
			                                            <div class="timeline-content">
			                                                <a href="#" class="name">Marital Status: <?php echo $patients->marital_status; ?></a>
			                                            </div>
			                                        </div>
			                                    </li>
			                                    <li>
			                                        <div class="experience-user">
			                                            <div class="before-circle"></div>
			                                        </div>
			                                        <div class="experience-content">
			                                            <div class="timeline-content">
			                                                <a href="#" class="name">Health Status: <?php echo $patients->health_status; ?></a>
			                                            </div>
			                                        </div>
			                                    </li>
			                                </ul>
			                            </div>
			                        </div>
			                    </div>
			                </div>
						</div>
					</div>
				</div>
            </div>
        </div>

<?php include_once 'template/footer.php'; ?>
 <script>
   function addMoreEvent() {
     $('.showupload').click(function(event) {
       $(this).hide();
       $('.upload-control').show();
     });
   }
 </script>