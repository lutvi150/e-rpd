<?=$this->extend('layout/template');?>
<?=$this->section('content');?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data Unit/ Lembaga</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Data Unit/ Lembaga Kampus</h2>
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
                                    <table id="datatable-responsive"
                                        class="table table-striped table-bordered dt-responsive " cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th style="width:1%">No.</th>
                                                <th>Nama Lembaga</th>
                                                <th>Total Pagu</th>
                                                <th>Status Verifikasi</th>
                                                <th style="width:10px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($unit as $key => $value): ?>
                                            <tr>
                                                <td><?=$key + 1?></td>
                                                <td><?=$value->nama_lembaga?></td>
                                                <td>Rp.<?=number_format($value->pagu)?></td>
                                                <td>
                                                    <?php if ($value->status_verifikasi == 2): ?>
                                                    <span class="label label-warning"><i class="fa fa-refresh"></i>
                                                        Belum di Verifikasi</span>
                                                    <?php elseif ($value->status_verifikasi == 3): ?>
                                                    <span class="label label-success"><i class="fa fa-check"></i>
                                                        Terverifikasi</span>
                                                    <?php elseif ($value->status_verifikasi == 4): ?>
                                                    <span class="label label-danger"><i class="fa fa-refresh"></i>
                                                        Revisi</span>
                                                    <?php endif;?>
                                                </td>
                                                <td style="width: 10px;">

                                                    <a href="<?=base_url('administrator/tambah-kegiatan/' . $value->id_lembaga)?>"
                                                        class="btn btn-success btn-xs">
                                                        <i class="fa fa-search"></i> Priview
                                                        Kegiatan
                                                    </a>

                                                    <?php if ($value->status_verifikasi == 2): ?>
                                                    <button type="button" class="btn btn-success btn-xs btn-verifikasi"
                                                        data-id="<?=$value->id_lembaga?>"><i class="fa fa-send"></i>
                                                        Validasi Data</button>
                                                    <?php endif;?>
                                                    <a href="<?=base_url('all/history-verifikasi/' . $value->id_lembaga)?>"
                                                        class="btn btn-warning btn-xs"><i class="fa fa-book"></i>
                                                        History Pengajuan</a>
                                                </td>
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

<!-- Modal -->
<div class="modal fade" id="reason-denied" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alasan Penolakan verifikasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning" role="alert">
                    <strong>Permberitahuan</strong>
                    <p>Silahkan tuliskan info tentang koreksi pengajuan yang anda tolak</p>
                </div>
                <textarea name="reasone" id="reason" cols="30" rows="10"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary send-reason-denied">Simpan</button>
            </div>
        </div>
    </div>
</div>
<?=$this->endSection();?>
<?=$this->section('js');?>
<script>
    CKEDITOR.replace('reason');
    let base_url = "<?=base_url();?>";
    show_modal = () => {
        $("#add-lembaga").modal("show");
        $('input').val("");
        $("#form-lembaga").attr("action", '/administrator/api/save-data-lembaga')
    }
    add_lembaga = () => {
        $(".text-error").text('');

        $("#form-lembaga").ajaxForm({
            type: "POST",
            url: base_url + $("#form-lembaga").attr("action"),
            dataType: "JSON",
            success: function (response) {
                if (response.status == 'validation_failed') {
                    $.each(response.errors, function (indexInArray, valueOfElement) {
                        $(".e" + indexInArray).text(valueOfElement);
                    });
                    $(".btn-loading").hide();
                    $(".btn-login").removeAttr('hidden style');
                } else if (response.status == 'user not found') {
                    Swal.fire('Maaf username atau password yang anda gunakan salah');
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
                    url: "<?=base_url('/administrator/api/delete-data-lembaga')?>",
                    data: {
                        id_lembaga: id
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
                $("#reason-denied").modal("show");
            }
        })
    }
    $(".btn-verifikasi").click(function (e) {
        Swal.fire({
            title: 'Kamu akan verifikasi data ini ?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Verifikasi',
            denyButtonText: `Minta Revisi`,
        }).then((result) => {
            let id_lembaga = $(this).data('id');
            sessionStorage.setItem('id_lembaga', id_lembaga)
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url('all/api/update-status-verifikasi')?>",
                    data: {
                        id_lembaga: id_lembaga,
                        status: 3
                    },
                    dataType: "JSON",
                    success: function (response) {
                        if (response.status == 'success') {
                            Swal.fire('Data berhasil di verifikasi', '', 'success').then(
                                () => {
                                    location.reload();
                                });
                        }
                    },
                    error: function () {
                        Swal.fire('Something Wrong', '', 'info');
                    }
                });
            } else if (result.isDenied) {
                sessionStorage.setItem('status', 4)
                $("#reason-denied").modal("show");
            }
        })
    });
    $(".send-reason-denied").click(function (e) {
        $.ajax({
            type: "POST",
            url: "<?=base_url('all/api/update-status-verifikasi')?>",
            data: {
                id_lembaga: sessionStorage.getItem('id_lembaga'),
                status: sessionStorage.getItem('status'),
                comment:CKEDITOR.instances.reason.getData()
            },
            dataType: "JSON",
            success: function (response) {
                if (response.status == 'success') {
                    Swal.fire('Pengajuan verifikasi berhasil di tolak', '', 'success').then(
                        () => {
                            location.reload();
                        });
                }
            },
            error: function () {
                Swal.fire('Something Wrong', '', 'info');
            }
        });
    });
</script>
<?=$this->endSection();?>