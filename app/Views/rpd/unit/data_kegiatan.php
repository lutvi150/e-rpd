<?=$this->extend('layout/template');?>
<?=$this->section('content');?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data Kegiatan Unit </h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Data : <?=$lembaga->nama_lembaga?></h2>
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
                                    <a href="/unit/rpd" class="btn btn-info btn-xs"><i class="fa fa-reply"></i>Kembali</a>
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
                                            <td style="width: 10px;"><button onclick="show_activity()" type="button"
                                                    class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Tambah
                                                    Kegiatan</button></td>
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
                                                <button onclick="delete_data(<?=$value->id_kegiatan?>)" type="button"
                                                    class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                                <button type="button" onclick="edit_data(<?=$value->id_kegiatan?>)"
                                                    class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></button>
                                                    <a href="/unit/tambah-penarikan-bulanan/<?=$lembaga->id_lembaga . "/" . $value->id_kegiatan?>" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Penarikan Bulanan</a>
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
<!-- Modal add activity -->
<div class="modal fade" id="add-activity" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" id="form-activity" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kegiatan</h5>

                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Kode Kegiatan</label>
                        <input type="text" name="kode_kegiatan" id="" class="form-control" placeholder=""
                            aria-describedby="helpId">
                        <small id="helpId" class="text-error ekode_kegiatan"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Uraian</label>
                        <input type="text" name="uraian_kegiatan" id="" class="form-control" placeholder=""
                            aria-describedby="helpId">
                        <small id="helpId" class="text-error euraian_kegiatan"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Pagu</label>
                        <input type="text" name="pagu_kegiatan" id="" class="form-control" placeholder=""
                            aria-describedby="helpId">
                        <small id="helpId" class="text-error epagu_kegiatan"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Mulai Pelaksanaan</label>
                        <select name="mulai_pelaksanaan" onchange="check_start_month()" class="form-control"
                            id="mulai_pelaksanaan">
                            <?php foreach ($month as $key => $value): ?>
                            <option value="<?=$value['kode']?>"><?=$value['long_month']?></option>
                            <?php endforeach;?>
                        </select>
                        <small id="helpId" class="text-error emulai_pelaksanaan"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Akhir Pelaksanaan</label>
                        <select name="akhir_pelaksanaan" onchange="check_start_month()" class="form-control"
                            id="akhir_pelaksanaan">
                            <?php foreach ($month as $key => $value): ?>
                            <option value="<?=$value['kode']?>"><?=$value['long_month']?></option>
                            <?php endforeach;?>
                        </select>
                        <small id="helpId" class="text-error eakhir_pelaksanaan"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" onclick="add_activity()" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?=$this->endSection();?>
<?=$this->section('js');?>
<script>
    let base_url = "<?=base_url();?>";
    let id_lembaga = "<?=$lembaga->id_lembaga;?>";
    show_activity = () => {
        $("#add-activity").modal("show");
        $('input').val("");
        $("#form-activity").attr("action", "/unit/api/store-kegiatan/store");
    }
    check_start_month = () => {
        $(".text-error").text("");
        let start = $("#mulai_pelaksanaan").children("option:selected").val();
        let end = $("#akhir_pelaksanaan").children("option:selected").val();
        console.log({
            start: parseInt(start),
            end: parseInt(end)
        });
        if (parseInt(start) > parseInt(end)) {
            $(".emulai_pelaksanaan").text("Mulai pelaksanaan tidak boleh lewat dari akhir pelaksanaan");
            $(".eakhir_pelaksanaan").text('Akhir Pelaksanaan Tidak Boleh Mendahului Mulai Pelaksanaan');
        }
    }
    add_activity = () => {
        $(".text-error").text('');
        $("#form-activity").ajaxForm({
            type: "POST",
            url: base_url + $("#form-activity").attr("action"),
            data: {
                id_lembaga: id_lembaga,
                id_kegiatan: sessionStorage.getItem('id_kegiatan')
            },
            dataType: "JSON",
            success: function (response) {
                if (response.status == 'validation_failed') {
                    $.each(response.errors, function (indexInArray, valueOfElement) {
                        $(".e" + indexInArray).text(valueOfElement);
                    });
                    $(".btn-loading").hide();
                    $(".btn-login").removeAttr('hidden style');
                } else if (response.status == 'success') {
                    Swal.fire(`${response.msg}`).then(() => {
                        location.reload();
                    })
                } else {
                    Swal.fire('Sistem bermasalah');
                }
            },
            error: function () {
                $(".btn-loading").hide();
                $(".btn-login").removeAttr('hidden style');
                Swal.fire('Something went wrong');
            }
        }).submit();
    }
    edit_data = (id) => {
        sessionStorage.setItem('id_kegiatan', id);
        $.ajax({
            type: "POST",
            url: base_url + "/unit/api/edit-kegiatan",
            data: {
                id_kegiatan: id
            },
            dataType: "JSON",
            success: function (response) {
                $("input[name='kode_kegiatan']").val(response.data.kode_kegiatan);
                $("input[name='uraian_kegiatan']").val(response.data.uraian_kegiatan);
                $("input[name='pagu_kegiatan']").val(response.data.pagu_kegiatan);
                $("#form-activity").attr("action", "/unit/api/store-kegiatan/update");
                $("#add-activity").modal("show");
            },
            error: function () {
                $(".btn-loading").hide();
                $(".btn-login").removeAttr('hidden style');
                Swal.fire('Something went wrong');
            }
        });
    }
    delete_data = (id) => {
        Swal.fire({
            title: 'Kamu akan hapus data ini ?',
            showDenyButton: true,
            confirmButtonText: 'Iya',
            denyButtonText: `Batalkan`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url('/unit/api/delete-kegiatan')?>",
                    data: {
                        id: id
                    },
                    dataType: "JSON",
                    success: function (response) {
                        if (response.status == 'success') {
                            Swal.fire('Data berhasil di hapus!', '', 'success').then(() => {
                                location.reload();
                            })
                        }
                    }
                });

            } else if (result.isDenied) {
                Swal.fire('Hapus Data di batalkan', '', 'info')
            }
        })
    }
</script>
<?=$this->endSection();?>