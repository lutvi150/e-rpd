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
                                    <a href="/unit/tambah-penarikan-mingguan/<?=$lembaga->id_lembaga . "/" . $kegiatan->id_kegiatan . "/" . $rincian_kegiatan->id_rincian?>"
                                        class="btn btn-info btn-xs"><i class="fa fa-reply"></i> Kembali</a>
                                        <a class="btn btn-success btn-xs" href="/unit/tambah-kegiatan-harian/<?=$lembaga->id_lembaga . "/" . $kegiatan->id_kegiatan . "/" . $rincian_kegiatan->id_rincian . "/" . $month_number?>"><i class="fa fa-hand-o-up" aria-hidden="true"></i> Kegiatan Harian</a>
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
                                        <tr>
                                            <td colspan="3">Kode</td>
                                            <td colspan="14" style="font-weight: bold;">: <?=$kegiatan->kode_kegiatan?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Jumlah Dana</td>
                                            <td colspan="14" style="font-weight: bold;">: Rp.
                                                <?=number_format($kegiatan->pagu_kegiatan)?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Nama Kegiatan</td>
                                            <td colspan="14" style="font-weight: bold;">:
                                                <?=$kegiatan->uraian_kegiatan?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Bulan</td>
                                            <td colspan="14" style="font-weight: bold;">: <?=$month->long_month?></td>
                                        </tr>
                                        <tr style="background-color: rgb(130, 230, 137);text-align: center;">
                                            <td>MA</td>
                                            <td>Uraian</td>
                                            <td>Pagu (Rp)</td>
                                            <td>Senin</td>
                                            <td>Selasa</td>
                                            <td>Rabu</td>
                                            <td>Kamis</td>
                                            <td>Jum'at</td>
                                            <td>Jumlah</td>
                                            <td>%</td>
                                        </tr>
                                        <?php foreach ($day_in_month as $key => $value): ?>
                                        <tr class="text-center">
                                            <?php if ($key == 1): ?>
                                            <td style="text-align: right;"><?=$rincian_kegiatan->kode_rincian;?></td>
                                            <td style="text-align: left;">
                                                <?=$rincian_kegiatan->uraian_rincian_kegiatan?></td>
                                            <td style="text-align: right;">Rp.
                                                <?=number_format($rincian_kegiatan->pagu_rincian_kegiatan)?></td>
                                            <?php elseif ($key == 0): ?>
                                            <td></td>
                                            <td>Tanggal</td>
                                            <td></td>
                                            <?php else: ?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <?php endif;?>
                                            <?php foreach ($value as $key2 => $value2): ?>
                                            <td><?=($value2['date'])?></td>
                                            <?php endforeach;?>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <?php $pagu_perhari = 0;
$jumlah = 0;foreach ($value as $key3 => $value2): ?>
                                            <td>
                                                <?php if ($value2['date'] !== '-'): ?>
                                                    <?php foreach ($penarikan_perhari as $key4 => $v_penarikan) {

    if ($value2['date'] == $v_penarikan->date) {
        $pagu_perhari = $v_penarikan->pagu;
        break;
    }
}?>
 Rp. <?=number_format($pagu_perhari)?>
                                                <?php else: ?>
                                                -
                                                <?php endif;?>
                                            </td>
                                            <?php $jumlah += $pagu_perhari;endforeach;?>
                                            <td>Rp.<?=number_format($jumlah)?></td>
                                            <td></td>
                                        </tr>
                                        <?php endforeach;?>
                                        <!-- use for data  -->

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