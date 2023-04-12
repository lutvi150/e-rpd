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
                                        <tr style="background-color: rgb(130, 230, 137);text-align: center;">
                                            <td>Kode</td>
                                            <td>Uraian</td>
                                            <td>Pagu (Rp)</td>
                                            <?php foreach ($month as $key => $value): ?>
                                            <td><?=$value['month']?></td>
                                            <?php endforeach;?>
                                            <td>Jumlah</td>
                                            <td style="width: 10px;">
                                            <?php if ($lembaga->status_verifikasi == 1 || $lembaga->status_verifikasi == 4): ?>
                                            <button onclick="show_modal()" type="button"
                                                    class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Tambah
                                                    Rincian</button>
                                            <?php endif;?></td>
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
                                                    class="span_<?=$value->id_rincian?>_<?=$i?>"><?=number_format($i == 13 ? $total : $pagu)?> <?=$i == 13 ? ($value->pagu_rincian_kegiatan == $total ? '' : '<br><label class="label label-danger">Belum Balance</label>') : '';?></span>
                                            </td>
                                            <?php endfor;?>
                                            <td class="text-center">
                                            <?php if ($lembaga->status_verifikasi == 1 || $lembaga->status_verifikasi == 4): ?>
                                                <button type="button" onclick="delete_data(<?=$value->id_rincian?>)"
                                                    class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                                <button type="button" onclick="edit_data(<?=$value->id_rincian?>)"
                                                    class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></button>
                                                    <?php endif;?>
                                                    <a <?=$value->pagu_rincian_kegiatan == $total ? '' : 'style="display: none;"'?>  href="/unit/tambah-penarikan-mingguan/<?=$lembaga->id_lembaga . "/" . $kegiatan->id_kegiatan . "/" . $value->id_rincian?>" class="btn btn-success btn-xs btn_<?=$value->id_rincian?>"><i class="fa fa-plus"></i> Penarikan Mingguan</a>
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
<!-- Modal add draw money -->
<div class="modal fade" id="add-new-draw" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-rincian-kegiatan" method="post">
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
                        <textarea name="uraian_rincian_kegiatan" class="form-control" id="" cols="30"
                            rows="4"></textarea>
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
    let base_url = "<?=base_url();?>";
    let id_lembaga = "<?=$lembaga->id_lembaga;?>";
    let id_kegiatan = "<?=$kegiatan->id_kegiatan?>"
    $(document).ready(function () {
        document.body.style.zoom = "80%";
     <?php if ($lembaga->status_verifikasi == 1 || $lembaga->status_verifikasi == 4): ?>

        $('.pagu_perbulan').on('click', function () {
            var $e = $(this).parent();
            var id_kegiatan = $(this).data('id_kegiatan');
            var id_rincian = $(this).data('id_rincian');
            var bulan = $(this).data('bulan');
            var pagu = parseInt($(this).data('pagu'));

            let input =
                `<input type="text"  onkeyup="update_total(${id_rincian},${bulan})"  class="form-control input_${id_rincian}_${bulan}" value="${pagu}" />`;
            $(this).html(input);
            var $newE = $e.find('input');
            $newE.focus();
            $newE.on('blur', function () {
                pagu = parseInt($(this).val());
                if (isNaN(pagu)) {
                    pagu = 0;
                }
                $(this).parent().html('<span>' + pagu + '</span>');
                $(".field_" + id_rincian + "_" + bulan).data('pagu', pagu);
                sessionStorage.setItem('data', JSON.stringify({
                    id_rincian_kegiatan: id_rincian,
                    bulan: bulan,
                    total_pagu_perbulan: $(this).val()
                }))
                update_rincian_perbulan();
            });
        });
        <?php endif;?>
    });
    update_total = (id_rincian, bulan) => {
        let pagu_normal = parseInt($(".pagu_" + id_rincian).data('pagu'));
        let data = 0;
        let name = "";
        let name_input = "";
        let nilai;
        for (let index = 1; index <= 12; index++) {
            name = id_rincian + "_" + index;
            name_input = id_rincian + "_" + bulan;
            if (name == name_input) {
                nilai = parseInt($(".input_" + id_rincian + "_" + index).val());
            } else {
                nilai = parseInt($(".field_" + id_rincian + "_" + index).data('pagu'));
            }
            if (isNaN(nilai)) {
                nilai = 0;
            }
            data += nilai;
        }
        if (pagu_normal === data) {
            $(".span_" + id_rincian + "_" + 13).text(data).attr('style','color:green');
            $(".btn_"+id_rincian).removeAttr("style");
        } else {
            $(".span_" + id_rincian + "_" + 13).html(data+`<br><label class="label label-danger">Belum Balance</label>`).attr('style', 'color:red');
            $(".btn_"+id_rincian).attr('style','display:none')
        }
    }
    update_rincian_perbulan = () => {
        $.ajax({
            type: "POST",
            url: base_url + "/unit/api/update-pagu-perbulan",
            data: JSON.parse(sessionStorage.getItem('data')),
            dataType: "JSON",
            success: function (response) {},
            error: function () {
                Swal.fire('Something went wrong');
            }
        });
    }
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
                $("textarea[name='uraian_rincian_kegiatan']").val(response.data
                    .uraian_rincian_kegiatan);
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
                    url: "<?=base_url('/unit/api/delete-penarikan-bulanan')?>",
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