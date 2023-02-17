<?=$this->extend('layout/template');?>
<?=$this->section('content')?>
<div class="right_col" role="main">
    <!-- top tiles -->
    <div class="row tile_count">
        <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-home"></i> Total Unit</span>
            <div class="count">0</div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-book"></i> Total Kegiatan</span>
            <div class="count">0</div>

        </div>
        <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-users"></i> Total user</span>
            <div class="count green">0</div>
        </div>
    </div>
    <!-- /top tiles -->

    <div class="row">


        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile ">
                <div class="x_title">
                    <h2>Grafik Penarikan Pertahun</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<?=$this->endSection();?>
<?=$this->section('js')?>
<script>
        $(document).ready(function () {
            makechart();
        });
        makechart = () => {
            var ctx = document.getElementById("myChart");
		var mybarChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agus", "September",
					"Oktober",
					"November", "Desember"
				],
				datasets: [{
					label: 'Jurusan A',
					backgroundColor: "#26B99A",
					data: [51, 30, 40, 28, 92, 50, 40, 50, 60, 10, 20, 10]
				}, {
					label: 'Jurusan B',
					backgroundColor: "#03586A",
					data: [41, 56, 25, 48, 72, 34, 12, 200, 300, 100, 10, 1]
				}, {
					label: 'Jurusan C',
					backgroundColor: "#1019f0",
					data: [41, 42, , 10, 10, 10, 10, 10, 10, 10, 10, 10]
				}]
			},

			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero: true
						}
					}]
				}
			}
		});

        }
    </script>
<?=$this->endSection()?>