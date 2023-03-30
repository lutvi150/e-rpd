<?=$this->extend('layout/template');?>
<?=$this->section('content');?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data Laporan Per Unit</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Data Laporan Unit Kampus</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Settings 1</a>
                                    <a class="dropdown-item" href="#">Settings 2</a>
                                </div>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id=""
                                        class="table nowrap" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <td rowspan="2" style="width:1%">No.</td>
                                                <td class="text-center" rowspan="2">Nama Lembaga</td>
                                                <td rowspan="2">Total Pagu</td>
                                                <td style="text-align: center;" colspan="5">Cetak Laporan</td>
                                            </tr>
                                            <tr class="text-center">
                                                <td>Kegiatan</td>
                                                <td>Penarikan Dana Bulanan</td>
                                                <td>Rincian Perminggu</td>
                                                <td>Kalender Kegiatan Harian</td>
                                                <td>Rencana Penarikan Harian</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($unit as $key => $value): ?>
                                            <tr>
                                                <td><?=$key + 1?></td>
                                                <td><?=$value->nama_lembaga?></td>
                                                <td>Rp.<?=number_format($value->pagu)?></td>
                                                <td class="text-center" ><a target="_blank" href="/report/kegiatan/<?=$value->id_lembaga?>" class="btn btn-xs btn-success"><i class="fa fa-print"></i> Cetak</a></td>
                                                <td class="text-center"><a target="_blank" href="/report/bulanan/<?=$value->id_lembaga?>" class="btn btn-xs btn-success"><i class="fa fa-print"></i> Cetak</a></td>
                                                <td class="text-center"><a target="_blank" href="/report/mingguan/<?=$value->id_lembaga?>" class="btn btn-xs btn-success"><i class="fa fa-print"></i> Cetak</a></td>
                                                <td class="text-center"><a target="_blank" href="/report/kalender_kegiatan/<?=$value->id_lembaga?>" class="btn btn-xs btn-success"><i class="fa fa-print"></i> Cetak</a></td>
                                                <td class="text-center"><a target="_blank" href="/report/penarikan_harian/<?=$value->id_lembaga?>" class="btn btn-xs btn-success"><i class="fa fa-print"></i> Cetak</a></td>
                                            </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?=$this->endSection();?>
<?=$this->section('js');?>
<script>
    let base_url = "<?=base_url();?>";
    $(document).ready(function () {
        document.body.style.zoom = "80%";
    });
</script>
<?=$this->endSection();?>