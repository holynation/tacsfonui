<?php include_once 'template/header_admin.php'; ?>
<?php include_once 'template/sidebar.php'; ?>

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

                    <div class="col-lg-6">
	                    <div class="row">
	                        <div class="col-sm-3">
	                            <a href="<?php echo base_url('vc/add/gallery'); ?>" class="btn btn-dark"> View Galleries</a>
	                        </div>
	                    </div>
                	</div>
            </div>
        </section>
        <!-- Page Header End -->

        <!-- Main Content Start -->
        <section class="main--content">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Gallery Dropzone</h3>
                </div>

                <div class="panel-content">
                    <!-- Dropzone Start -->
                    <form action="<?php echo base_url('mc/galleryUpload'); ?>" method="post" enctype="multipart/form-data">
                    	<div class='form-group'>
                    		<?php $userType=$this->webSessionManager->getCurrentUserProp('user_type');
							$value = ($userType) ? $userType : 'admin'; ?>
							<label for='uploader' class='text-hide'>Uploader</label>
							<input type='hidden' name='uploader' id='uploader' value="<?php echo $value; ?>" class='form-control' />
						</div>

						<div class='form-group'>
							<label for='title'>Gallery Title</label>
							<input type='text' name='title' id='title' class='form-control' required />
						</div>

						<div class="dropzone" id="myDropzone">
							<div class="dz-message" data-dz-message>Drop gallery files here to upload</div>
							<div class="fallback">
				                <input name="file" type="file" multiple />
				            </div>
						</div>

						<br/>
						<div class="form-group">
							<button type="submit" class="form-control btn btn-primary float-right" id="submitGallery">Upload</button>
						</div>
                    </form>
                    <!-- Dropzone End -->
                </div>
            </div>
        </section>
        <!-- Main Content End -->
    </main>
    <!-- Main Container End -->

<?php include_once 'template/footer_admin.php'; ?>