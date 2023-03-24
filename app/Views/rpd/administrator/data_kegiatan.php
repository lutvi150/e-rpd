<?=$this->extend('layout/template');?>
<?=$this->section('content');?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data Kegiatan Unit/ Lembaga </h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Unit/Lembaga : <?=$lembaga->nama_lembaga?></h2>
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
                                    <a href="/unit/rpd" class="btn btn-info btn-xs"><i class="fa fa-reply"></i> Kembali</a>
                                    <table class="table table-bordered">
                                        <tr>
                                            <td colspan="2">Kementrian Negara/ Lembaga</td>
                                            <td colspan="3">: Kementrian Agama</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Satuan Kerja</td>
                                            <td colspan="3">: IAIN Batusangkar</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Fak/PPs/Lembaga/Unit</td>
                                            <td colspan="3">: <?=$lembaga->nama_lembaga?></td>
                                        </tr>
                                        <tr style="background-color: rgb(130, 230, 137);text-align: center;">
                                            <td>Kode</td>
                                            <td>Uraian</td>
                                            <td>Pagu (Rp)</td>
                                            <td>Jadwal Pelaksanaan</td>
                                            <td>Action</td>

                                        </tr>
                                        <!-- use for data  -->
                                        <?php foreach ($activity as $key => $value): ?>
                                        <tr>
                                            <td><?=$value->kode_kegiatan?></td>
                                            <td><?=$value->uraian_kegiatan?></td>
                                            <td>Rp.<?=number_format($value->pagu_kegiatan)?></td>
                                            <td><?=$month[$value->mulai_pelaksanaan - 1]['month'] . " - " . $month[$value->akhir_pelaksanaan - 1]['month']?>
                                            </td>
                                            <td style="text-align: center;">
                                                    <a href="/administrator/tambah-penarikan-bulanan/<?=$lembaga->id_lembaga . "/" . $value->id_kegiatan?>" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Penarikan Bulanan</a>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                        <!-- end data  -->
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
<?=$this->endSection();?>