<?=$this->extend('layout/template');?>
<?=$this->section('content');?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Rencana Penarikan Dana Bulanan </h3>
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
                                    <a href="/unit/tambah-kegiatan/<?=$lembaga->id_lembaga?>"
                                        class="btn btn-info btn-xs"><i class="fa fa-reply"></i>Kembali</a>
                                    <table class="table table-bordered" id="table-rincian-kegiatan">
                                        <tr>
                                            <td colspan="3">Kementrian Negara/ Lembaga</td>
                                            <td colspan="14">: Kementrian Agama</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Satuan Kerja</td>
                                            <td colspan="14">: IAIN Batusangkar</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Fak/PPs/Lembaga/Unit</td>
                                            <td colspan="14">: <?=$lembaga->nama_lembaga?></td>
                                        </tr>
                                        <tr style="background-color: rgb(130, 230, 137);text-align: center;">
                                            <td>Kode</td>
                                            <td>Uraian</td>
                                            <td>Pagu (Rp)</td>
                                            <?php foreach ($month as $key => $value): ?>
                                            <td><?=$value['month']?></td>
                                            <?php endforeach;?>
                                            <td>Jumlah</td>
                                            <td style="width: 10px;">
                                            Action</td>
                                        </tr>
                                        <tr>
                                            <td><?=$kegiatan->kode_kegiatan?></td>
                                            <td><b><?=$kegiatan->uraian_kegiatan?></b></td>
                                            <td>Rp.<?=number_format($kegiatan->pagu_kegiatan)?></td>
                                            <?php for ($i = 0; $i < 12; $i++): ?>
                                            <td></td>
                                            <?php endfor;?>
                                            <td colspan="2"></td>
                                        </tr>
                                        <!-- use for data  -->
                                        <?php foreach ($rincian_kegiatan as $key => $value): ?>
                                        <tr>
                                            <td style="text-align: right;"><?=$value->kode_rincian?></td>
                                            <td><?=$value->uraian_rincian_kegiatan?></td>
                                            <td class="pagu_<?=$value->id_rincian?>"
                                                data-pagu="<?=$value->pagu_rincian_kegiatan?>">
                                                Rp.<?=number_format($value->pagu_rincian_kegiatan)?></td>
                                            <?php
$array_total = [];
$bulan = null;
$total = 0;for ($i = 1; $i <= 13; $i++): ?>
                                            <?php $pagu = 0;foreach ($value->rincian_pagu as $key => $value2) {
    if ($i == (int) $value2->bulan) {
        $pagu = $value2->pagu;
        $bulan = $value2->bulan;
        break;
    }
}?>
                                            <?php
$array_total[] = $pagu;
if ($i == 13) {
    $total = array_sum($array_total);
}
?>
                                            <td style="text-align: center;" data-pagu="<?=$pagu?>" data-bulan="<?=$i?>"
                                                data-id_kegiatan="<?=$kegiatan->id_kegiatan?>"
                                                data-id_rincian="<?=$value->id_rincian?>"
                                                class="<?=$i == 13 ? '' : 'pagu_perbulan'?> field_<?=$value->id_rincian?>_<?=$i?>">
                                                <span
                                                <?=$i == 13 ? ($value->pagu_rincian_kegiatan == $total ? 'style="color:green"' : 'style="color:red"') : '';?>
                                                    class="span_<?=$value->id_rincian?>_<?=$i?>"><?=number_format($i == 13 ? $total : $pagu)?></span>
                                            </td>
                                            <?php endfor;?>
                                            <td class="text-center">
                                                    <a <?=$value->pagu_rincian_kegiatan == $total ? '' : 'style="display: none;"'?>  href="/administrator/tambah-penarikan-mingguan/<?=$lembaga->id_lembaga . "/" . $kegiatan->id_kegiatan . "/" . $value->id_rincian?>" class="btn btn-success btn-xs btn_<?=$value->id_rincian?>"><i class="fa fa-plus"></i> Penarikan Mingguan</a>
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
<script>
    $(document).ready(function () {
        document.body.style.zoom = "80%";

    });
</script>
<?=$this->endSection();?>