<?php include_once 'template/header_admin.php'; ?>
<?php include_once 'template/sidebar.php'; ?>

        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Page Header Start -->
            <section class="page--header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Page Title Start -->
                            <h2 class="page--title h5">Dashboard</h2>
                            <!-- Page Title End -->

                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active"><span>Dashboard</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Page Header End -->

            <!-- Main Content Start -->
            <section class="main--content">
                <div class="row gutter-20">
                    <div class="col-md-4">
                        <div class="panel">
                            <!-- Mini Stats Panel Start -->
                            <div class="miniStats--panel">
                                <div class="miniStats--header bg-darker">
                                    <p class="miniStats--label text-white bg-blue">
                                    </p>
                                </div>

                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-user text-blue"></i>

                                    <p class="miniStats--caption text-blue">Total</p>
                                    <h3 class="miniStats--title h4">Members</h3>
                                    <p class="miniStats--num text-blue"><?php echo $members; ?></p>
                                </div>
                            </div>
                            <!-- Mini Stats Panel End -->
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="panel">
                            <!-- Mini Stats Panel Start -->
                            <div class="miniStats--panel">
                                <div class="miniStats--header bg-darker">
                                    <p class="miniStats--label text-white bg-orange">
                                    </p>
                                </div>

                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-book text-orange"></i>

                                    <p class="miniStats--caption text-orange">Total</p>
                                    <h3 class="miniStats--title h4">Articles</h3>
                                    <p class="miniStats--num text-orange"><?php echo $article; ?></p>
                                </div>
                            </div>
                            <!-- Mini Stats Panel End -->
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="panel">
                            <!-- Mini Stats Panel Start -->
                            <div class="miniStats--panel">
                                <div class="miniStats--header bg-darker">
                                    <p class="miniStats--label text-white bg-green">
                                    </p>
                                </div>

                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-image text-green"></i>
                                    <p class="miniStats--caption text-green">Total</p>
                                    <h3 class="miniStats--title h4">Galleries</h3>
                                    <p class="miniStats--num text-green"><?php echo $gallery; ?></p>
                                </div>
                            </div>
                            <!-- Mini Stats Panel End -->
                        </div>
                    </div>

                    <div class="col-xl-12 col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Overall media Graph Overview</h3>
                            </div>

                            <div class="panel-chart">
                                <!-- Morris Area Chart 01 Start -->
                                <canvas class="chart--body area--chart style--1" id="myChart" width="400" height="150"></canvas>
                                <!-- Morris Area Chart 01 End -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Main Content End -->

<?php include_once 'template/footer_admin.php'; ?>
<script src="<?php echo base_url('assets/private/js/chart.js') ?>"></script>
<script type="text/javascript">
var ctx = document.getElementById("myChart");
var dataVal = JSON.parse('<?php echo $buildDataJson; ?>');
console.log(dataVal);

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Article", "Audios", "Videos", "Events", "Galleries"],
        datasets: [{
            label: 'Statistics',
            data: dataVal,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
