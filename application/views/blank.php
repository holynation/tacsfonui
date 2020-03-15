<?php include_once 'template/header_admin.php'; ?>
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
                        <h2 class="page--title h5">Blank Page</h2>
                        <!-- Page Title End -->

                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item"><span>Page Layouts</span></li>
                            <li class="breadcrumb-item active"><span>Blank Page</span></li>
                        </ul>
                    </div>

                    <div class="col-lg-6">
                        <!-- Summary Widget Start -->
                        <div class="summary--widget">
                            <div class="summary--item">
                                <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#009378">2,9,7,9,11,9,7,5,7,7,9,11</p>

                                <p class="summary--title">This Month</p>
                                <p class="summary--stats text-green">2,371,527</p>
                            </div>

                            <div class="summary--item">
                                <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#e16123">2,3,7,7,9,11,9,7,9,11,9,7</p>

                                <p class="summary--title">Last Month</p>
                                <p class="summary--stats text-orange">2,527,371</p>
                            </div>
                        </div>
                        <!-- Summary Widget End -->
                    </div>
                </div>
            </div>
        </section>
        <!-- Page Header End -->

        <!-- Main Content Start -->
        <section class="main--content">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Panel Title Here</h3>

                    <div class="dropdown">
                        <button type="button" class="btn-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>

                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="far fa-circle"></i>Panel Option 1</a></li>
                            <li><a href="#"><i class="far fa-circle"></i>Panel Option 2</a></li>
                            <li><a href="#"><i class="far fa-circle"></i>Panel Option 3</a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-content">
                    <p>Panel Content Here</p>
                </div>
            </div>
        </section>
        <!-- Main Content End -->

        <!-- Main Footer Start -->
        <footer class="main--footer main--footer-light">
            <p>Copyright &copy; <a href="#">DAdmin</a>. All Rights Reserved.</p>
        </footer>
        <!-- Main Footer End -->
    </main>
    <!-- Main Container End -->
</div>
<!-- Wrapper End -->

<?php include_once 'template/footer_admin.php'; ?>
