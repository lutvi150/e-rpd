<?=$this->extend('layout/template');?>
<?=$this->section('content');?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Rencana Kegiatan Harian</h3>
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
                                    <form action="" id="form-kegiatan" method="post">
                                    <a href="/unit/tambah-penarikan-mingguan/<?=$lembaga->id_lembaga . "/" . $kegiatan->id_kegiatan . "/" . $rincian_kegiatan->id_rincian?>"
                                        class="btn btn-info btn-xs"><i class="fa fa-reply"></i>Kembali</a>
                                        <a class="btn btn-success btn-xs" href="/unit/tambah-penarikan-harian/<?=$uri->id_lembaga . "/" . $uri->id_kegiatan . "/" . $uri->id_rincian . "/" . $uri->id_rincian_kegiatan_perbulan . "/" . $uri->bulan . "/penarikan"?>"><i class="fa fa-hand-o-up" aria-hidden="true"></i> Rencana Penarikan Dana Harian</a>
                                    <table class="table table-bordered" id="table-rincian-kegiatan">
                                        <tr>
                                            <td colspan="17" style="font-weight: bold;text-align:center;">Bulan :<?=$month->long_month?> Tahun Anggaran <?=date('Y')?></td>
                                        </tr>
                                        <tr style="background-color: rgb(130, 230, 137);text-align: center;">
                                            <td></td>
                                            <td>Uraian</td>
                                            <td>Senin</td>
                                            <td>Selasa</td>
                                            <td>Rabu</td>
                                            <td>Kamis</td>
                                            <td>Jum'at</td>
                                        </tr>
                                        <?php foreach ($day_in_month as $key => $value): ?>
                                        <tr class="text-center">
                                            <?php if ($key == 1): ?>
                                            <td style="text-align: right;"><?=$rincian_kegiatan->kode_rincian;?></td>
                                            <td style="text-align: left;">`<?=$rincian_kegiatan->uraian_rincian_kegiatan?></td>
                                            <?php elseif ($key == 0): ?>
                                            <td></td>
                                            <td>Tanggal</td>
                                            <?php else: ?>
                                            <td></td>
                                            <td></td>
                                            <?php endif;?>
                                            <?php foreach ($value as $key2 => $value2): ?>
                                            <td><?=($value2['date'])?></td>
                                            <?php endforeach;?>
                                        </tr>
                                        <tr class="text-center">
                                            <td></td>
                                            <td></td>
                                            <?php $jumlah = 0;foreach ($value as $key3 => $value2): ?>
                                            <td>
                                                <?php if ($value2['date'] !== '-'): ?>
                                                <?php foreach ($kegiatan_perhari as $key4 => $v_kegiatan) {
    if ($value2['date'] == $v_kegiatan->date) {
        $check = null;
        if ($v_kegiatan->status == 1) {
            $check = 'checked="checked"';
        }
        break;
    }}?>
  <?php if ($lembaga->status_verifikasi == 1 || $lembaga->status_verifikasi == 4): ?>
    <div class="checkbox">
													<label>
														<input type="checkbox" class="flat date_<?=$value2['date']?>" name="date_<?=$value2['date']?>" <?=$check;?>>
													</label>
												</div>
                                                    <?php else: ?>
                                                        <div class="checkbox">
													<label>
                                                        <?php if ($check == null): ?>
                                                            &#9587;
                                                        <?php else: ?>
                                                        &#10004;
                                                        <?php endif;?>
													</label>
												</div>
                                                        <?php endif;?>
                                                <?php else: ?>
                                                -
                                                <?php endif;?>
                                            </td>
                                            <?php endforeach;?>
                                        </tr>
                                        <?php endforeach;?>
                                        <!-- use for data  -->

                                        <!-- end data  -->
                                    </table>
  <?php if ($lembaga->status_verifikasi == 1 || $lembaga->status_verifikasi == 4): ?>
                                    <div class="text-center">
                                        <button type="button" onclick="update_kegiatan();" class="btn btn-success btn-xs text-center" ><i class="fa fa-save"></i> Simpan Data</button>
                                    </div>
                                    <?php endif;?>
                                </form>
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
    let bulan = "<?=$month_number?>";
    let id_rincian = "<?=$rincian_kegiatan->id_rincian?>";
    let day = "<?=$day?>";
    update_kegiatan = () => {
        var array_kegiatan = [];
        let status=0;
        for (let index = 1; index <= day; index++) {
            status=$(".date_" + index+":checked").val();
            status=status=='on'?1:0;
            console.log(status);
            if ($(".date_" + index)[0]) {
                array_kegiatan.push({date:index,status:status})
                };
            }
            console.log(array_kegiatan);
            sessionStorage.setItem('kegiatan_perhari',JSON.stringify(array_kegiatan));
            update_rincian_perhari();
        }
    update_rincian_perhari = () => {
        $.ajax({
            type: "POST",
            url: base_url + "/unit/api/update-penarikan-perhari",
            data: {id_rincian_kegiatan:id_rincian,bulan:bulan,kegiatan_perhari:JSON.parse(sessionStorage.getItem('kegiatan_perhari')),status:'kegiatan'},
            dataType: "JSON",
            success: function (response) {
                Swal.fire('Update Kegiatan berhasil');
            },
            error: function () {
                Swal.fire('Something went wrong');
            }
        });
    }
</script>
<?=$this->endSection();?>