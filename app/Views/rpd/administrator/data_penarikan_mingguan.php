at<?=$this->extend('layout/template');?>
<?=$this->section('content');?>
<style>
    tr.center-text td {
        text-align: center;
        vertical-align: middle;
    }
</style>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Rencana Penarikan Dana Bulanan Rincian Perminggu </h3>
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
                                    <a href="/unit/tambah-penarikan-bulanan/<?=$lembaga->id_lembaga . "/" . $kegiatan->id_kegiatan?>"
                                        class="btn btn-info btn-xs"><i class="fa fa-reply"></i> Kembali</a>
                                    <table class="table table-bordered" id="table-rincian-kegiatan">
                                        <tr>
                                            <td colspan="3">Kementrian Negara/ Lembaga</td>
                                            <td colspan="14">: Kementrian Agama</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Satuan Kerja</td>
                                            <td colspan="14">: UIN MY Batusangkar</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Fak/PPs/Lembaga/Unit</td>
                                            <td colspan="14">: <?=$lembaga->nama_lembaga?></td>
                                        </tr>
                                        <tr class="center-text">
                                            <td style="text-align: center;" rowspan="2">Kode</td>
                                            <td rowspan="2">Uraian Program</td>
                                            <td rowspan="2">Harga Satuan</td>
                                            <td rowspan="2">Bulan</td>
                                            <td rowspan="2">Pagu/Perbulan</td>
                                            <td colspan="5">Rincian Perminggu</td>

                                        </tr>
                                        <tr>

                                            <?php for ($i = 1; $i <= 4; $i++): ?>
                                            <td style="text-align: center;">Minggu ke <br><?=$i?></td>
                                            <?php endfor;?>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><?=$kegiatan->kode_kegiatan?></td>
                                            <td style="font-weight: bold;"><?=$kegiatan->uraian_kegiatan?></td>
                                            <td>Rp. <?=number_format($kegiatan->pagu_kegiatan)?></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <!-- use for data  -->
                                        <?php foreach ($rincian_perbulan as $key => $value): ?>
                                        <tr>
                                            <?php if ($key == 0): ?>
                                            <td style="text-align: right;"><?=$rincian_kegiatan->kode_rincian?></td>
                                            <td><?=$rincian_kegiatan->uraian_rincian_kegiatan?></td>
                                            <td>Rp. <?=number_format($rincian_kegiatan->pagu_rincian_kegiatan)?></td>
                                            <?php else: ?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <?php endif;?>
                                            <td><?=$month[$value->bulan]->long_month?></td>
                                            <td data-pagu="<?=$value->total_pagu_perbulan?>"
                                                class="pagu_rincian_<?=$value->id_rincian_kegiatan_perbulan?>">
                                                <?=number_format($value->total_pagu_perbulan)?></td>
                                            <?php $total_mingguan = 0;foreach ($value->week_data as $key => $value2): ?>
                                            <td style="text-align: center;"
                                                class="week-draw field_<?=$value->id_rincian_kegiatan_perbulan . "_" . $value2->minggu?>"
                                                data-week="<?=$value2->minggu?>" data-pagu="<?=$value2->pagu?>"
                                                data-id_perbulan="<?=$value->id_rincian_kegiatan_perbulan?>">
                                                <span><?=number_format($value2->pagu)?></span></td>
                                            <?php $total_mingguan += $value2->pagu;?>
                                            <?php endforeach;?>
                                            <td>
                                            <a href="/administrator/tambah-penarikan-harian/<?=$lembaga->id_lembaga . "/" . $kegiatan->id_kegiatan . "/" . $rincian_kegiatan->id_rincian . "/" . $value->id_rincian_kegiatan_perbulan . "/" . $value->bulan . "/penarikan"?>" <?=$total_mingguan == $value->total_pagu_perbulan ? "" : 'style="display:none"'?> class="btn btn-success btn-xs btn_<?=$value->id_rincian_kegiatan_perbulan?>"><i
                                                        class="fa fa-plus"></i> Rincian Harian</a>
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