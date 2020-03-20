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
	                            <a href="<?php echo base_url('vc/create/events'); ?>" class="btn btn-dark"> View Events</a>
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
                    <h3 class="panel-title">Events Calendar</h3>
                </div>

                <div class="panel-content">
                    <div class="row">
	                    <div class="col-lg-12">
	                        <div class="card-box">
	                            <div class="row">
	                                <div class="col-lg-12">
	                                    <div id="calendarApp"></div>
	                                </div> <!-- end col -->
	                            </div>  <!-- end row -->
	                        </div> <!-- end card-box-->

	                        <!-- BEGIN MODAL -->
	                        <div class="modal fade" id="event-modal" tabindex="-1">
	                            <div class="modal-dialog">
	                                <div class="modal-content">
	                                    <div class="modal-header border-bottom-0">
	                                        <h4 class="modal-title">Add New Event</h4>
	                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                                            <span aria-hidden="true">&times;</span>
	                                        </button>
	                                    </div>
	                                    <div class="modal-body">

	                                    </div>
	                                    <div class="modal-footer border-0 pt-0">
	                                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
	                                        <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
	                                        <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
	                                    </div> <!-- end modal footer-->
	                                </div> <!-- end modal content -->
	                            </div> <!-- end modal dialog-->
	                        </div>
	                        <!-- end modal -->

	                        <!-- Modal Add Category -->
	                        <div class="modal fade" id="add-category" tabindex="-1">
	                            <div class="modal-dialog">
	                                <div class="modal-content">
	                                    <div class="modal-header border-bottom-0">
	                                        <h4 class="modal-title">Add a category</h4>
	                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                                            <span aria-hidden="true">&times;</span>
	                                        </button>
	                                    </div>
	                                    <div class="modal-body p-3">
	                                        <form>
	                                            <div class="form-group">
	                                                <label class="control-label">Category Name</label>
	                                                <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name"/>
	                                            </div>
	                                            <div class="form-group">
	                                                <label class="control-label">Choose Category Color</label>
	                                                <select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
	                                                    <option value="primary">Primary</option>
	                                                    <option value="success">Success</option>
	                                                    <option value="danger">Danger</option>
	                                                    <option value="info">Info</option>
	                                                    <option value="warning">Warning</option>
	                                                    <option value="dark">Dark</option>
	                                                </select>
	                                            </div>

	                                        </form>

	                                        <div class="text-right">
	                                            <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
	                                            <button type="button" class="btn btn-primary ml-1 waves-effect waves-light save-category" data-dismiss="modal">Save</button>
	                                        </div>
	                                    </div> <!-- end modal body-->
	                                </div> <!-- end modal content -->
	                            </div> <!-- end modal dialog-->
	                        </div>
	                        <!-- END MODAL -->
	                    </div>
	                    <!-- end col-12 -->
	                </div> <!-- end row -->
                </div>
            </div>
        </section>
        <!-- Main Content End -->
    </main>
    <!-- Main Container End -->

<?php include_once 'template/footer_admin.php'; ?>