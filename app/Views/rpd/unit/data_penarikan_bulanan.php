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
                                    <a href="/unit/tambah-kegiatan/<?=$kegiatan->id_kegiatan?>"
                                        class="btn btn-info btn-xs"><i class="fa fa-reply"></i>Kembali</a>
                                    <table class="table table-bordered">
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
                                            <td style="width: 10px;"><button onclick="show_modal()" type="button"
                                                    class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Tambah
                                                    Rincian</button></td>
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
                                            <td style="text-align: right;"><?=$value->kode_rincian?></td>
                                            <td><?=$value->uraian_rincian_kegiatan?></td>
                                            <td>Rp.<?=number_format($value->pagu_rincian_kegiatan)?></td>
                                            <?php for ($i = 1; $i <= 13; $i++): ?>
                                            <td>
                                                <input type="number" data-month="<?=$i?>"  class="form-control">
                                            </td>
                                            <?php endfor;?>
                                            <td>
                                                <button type="button" onclick="delete_data(<?=$value->id_rincian?>)" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                                <button type="button" onclick="edit_data(<?=$value->id_rincian?>)" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></button>
                                            </td>
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
<!-- Modal add draw money -->
<div class="modal fade" id="add-new-draw" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form  id="form-rincian-kegiatan" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Rincian Penarikan Bulanan</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Kode Rincian</label>
                        <input type="text" name="kode_rincian" id="" class="form-control" placeholder=""
                            aria-describedby="helpId">
                        <small id="helpId" class="text-error ekode_rincian"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Uraian Kegiatan</label>
                        <textarea name="uraian_rincian_kegiatan" class="form-control" id="" cols="30" rows="4"></textarea>
                        <small id="helpId" class="text-error euraian_rincian_kegiatan"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Pagu</label>
                        <input type="text" name="pagu_rincian_kegiatan" class="form-control">
                        <small id="helpId" class="text-error epagu_rincian_kegiatan"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" onclick="store_data()" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?=$this->endSection();?>
<?=$this->section('js');?>
<script>
    $(document).ready(function () {
        document.body.style.zoom = "80%";
    });
    let base_url = "<?=base_url();?>";
    let id_lembaga = "<?=$lembaga->id_lembaga;?>";
    let id_kegiatan="<?=$kegiatan->id_kegiatan?>"
    show_modal = () => {
        $("#add-new-draw").modal("show");
        $('input').val("");
        $("#form-rincian-kegiatan").attr("action", "/unit/api/store-penarikan-bulanan/store");
    }
    store_data = () => {
        $(".text-error").text('');
        $("#form-rincian-kegiatan").ajaxForm({
            type: "POST",
            url: base_url + $("#form-rincian-kegiatan").attr("action"),
            data: {
                id_kegiatan: id_kegiatan,
                id_rincian: sessionStorage.getItem('id_rincian')
            },
            dataType: "JSON",
            success: function (response) {
                if (response.status == 'validation_failed') {
                    $.each(response.errors, function (indexInArray, valueOfElement) {
                        $(".e" + indexInArray).text(valueOfElement);
                    });
                } else if (response.status == 'success') {
                    Swal.fire(`${response.msg}`).then(() => {
                        location.reload();
                    })
                } else {
                    Swal.fire('Sistem bermasalah');
                }
            },
            error: function () {
                Swal.fire('Something went wrong');
            }
        }).submit();
    }
    edit_data = (id) => {
        sessionStorage.setItem('id_rincian', id);
        $.ajax({
            type: "POST",
            url: base_url + "/unit/api/edit-penarikan-bulanan",
            data: {
                id_rincian: id
            },
            dataType: "JSON",
            success: function (response) {
                $("input[name='kode_rincian']").val(response.data.kode_rincian);
                $("textarea[name='uraian_rincian_kegiatan']").val(response.data.uraian_rincian_kegiatan);
                $("input[name='pagu_rincian_kegiatan']").val(response.data.pagu_rincian_kegiatan);
                $("#form-rincian-kegiatan").attr("action", "/unit/api/store-penarikan-bulanan/update");
                $("#add-new-draw").modal("show");
            },
            error: function () {
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
                    url: "<?=base_url('/unit/api/dalete-penarikan-bulanan')?>",
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