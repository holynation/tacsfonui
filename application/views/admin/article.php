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
	                            <a href="<?php echo base_url('vc/create/article'); ?>" class="btn btn-dark"> View Article</a>
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
                    <h3 class="panel-title">Article</h3>
                </div>

                <div class="panel-content">
                    <div class="row">
	                    <div class="col-lg-12">
	                        <div class="card-box">
	                        	<form action="" method="post">
	                        		<textarea id="summernote_editor" name="summernote_editor">
	                        			<h6>You can type here articles using this editor...</h6>
	                        		</textarea>
	                        	</form> <!-- end summernote-editor-->
	                        </div> <!-- end card-box-->
	                    </div>
	                    <!-- end col-12 -->
	                </div> <!-- end row -->
                </div>
            </div>
        </section>
        <!-- Main Content End -->

<?php include_once 'template/footer_admin.php'; ?>