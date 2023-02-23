<?=$this->extend('layout/template');?>
<?=$this->section('content');?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data Unit</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Data Unit Kampus</h2>
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
                                        class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th style="width:1%">No.</th>
                                                <th>Nama Lembaga</th>
                                                <th>Total Pagu</th>
                                                <th style="width:10%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($unit as $key => $value): ?>
                                            <tr>
                                                <td><?=$key + 1?></td>
                                                <td><?=$value->nama_lembaga?></td>
                                                <td>Rp.0</td>
                                                <td>
                                                    <a href="<?=base_url('unit/tambah-kegiatan/' . $value->id_lembaga)?>"

                                                        class="btn btn-success btn-xs"><i
                                                            class="fa fa-plus"></i> Tambah Kegiatan</a>
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


<?=$this->endSection();?>
<?=$this->section('js');?>
<script>
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
                    data: {id_lembaga:id},
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