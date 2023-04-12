<?=$this->extend('layout/template');?>
<?=$this->section('content');?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data User</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Data User Terdaftar Pada Aplikasi</h2>
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
                                    <button type="button" onclick="show_modal();" class="btn btn-info btn-xs"><i class="fa fa-plus"></i> Tambah User</button>
                                    <table id="datatable-responsive"
                                        class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th style="width:1%">No.</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Nama Unit</th>
                                                <th>Nama Level</th>
                                                <th>Created</th>
                                                <th style="width:10%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data_user as $key => $value): ?>
                                            <tr>
                                                <td><?=$key + 1?></td>
                                                <td><?=$value->nama_user?></td>
                                                <td><?=$value->email?></td>
                                                <td><?=$value->nama_lembaga?></td>
                                                <td><?=$value->role?></td>
                                                <td><?=$value->created_at?></td>
                                                <td>
                                                    <button type="button" onclick="delete_data(<?=$value->id?>)" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                                    <button onclick="edit_data(<?=$value->id?>)" class="btn btn-warning btn-xs" type="button"><i class="fa fa-edit"></i></button>
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
<div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form  id="form-user" method="post">
            <div class="modal-header">
                <h5 class="modal-title">Tambah User</h5>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert">
                    <strong>Info</strong>
                    <p>Password akan otomatis sama dengan email</p>
                </div>
                <div class="form-group">
                  <label for="">Nama</label>
                  <input type="text" name="nama" id="nama" class="form-control" placeholder="" aria-describedby="helpId">
                  <small id="helpId" class="text-error enama"></small>
                </div>
                <div class="form-group">
                  <label for="">Email</label>
                  <input type="email" name="email" id="email"  class="form-control" placeholder="" aria-describedby="helpId">
                  <small id="helpId" class="text-error eemail"></small>
                </div>
                <div class="form-group">
                  <label for="">Nama Lembaga</label>
                  <select name="nama_lembaga" class="form-control" id="nama_lembaga">
                    <?php foreach ($lembaga as $key => $value): ?>
                    <option value="<?=$value->id_lembaga?>"><?=$value->nama_lembaga?></option>
                    <?php endforeach;?>
                  </select>
                  <small id="helpId" class="text-error eemail"></small>
                </div>
                <div class="form-group show-password" hidden >
                    <label for="">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="" aria-describedby="helpId">
                    <small id="helpId" class="" style="color: red;">Jika ingin ubah password masukkan password disini, jika tidak cukup kosongkan</small>
                  </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="add_user();" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>
<?=$this->endSection();?>
<?=$this->section('js');?>
<script>
    let base_url="<?=base_url();?>";
    show_modal=()=>{
        $("#add-user").modal("show");
        $(".show-password").attr('hidden',true);
        $("input[name='email']").removeAttr('disabled');
        $('input').val("");
        $("#form-user").attr("action",'/administrator/api/save-data-user/store')
    }
    edit_data = (id) => {

        $(".show-password").removeAttr('hidden');
        $("input[name='email']").attr('disabled',true);
        sessionStorage.setItem('id_user', id);
        $.ajax({
            type: "POST",
            url: base_url + "/administrator/api/edit-data-user",
            data: {
                id_user: id
            },
            dataType: "JSON",
            success: function (response) {
                let html="";
                let status="";
                $.each(response.lembaga, function (indexInArray, valueOfElement) {
                    status=valueOfElement.id_pengelola==sessionStorage.getItem('id_user')?"selected":"";
                    html+=`<option ${status} value="${valueOfElement.id_lembaga}">${valueOfElement.nama_lembaga}</option>`;
                });
                $("#nama_lembaga").html(html);
                $("input[name='nama']").val(response.user.nama_user);
                $("input[name='email']").val(response.user.email);
                $("#form-user").attr("action", "/administrator/api/save-data-user/update");
                $("#add-user").modal("show");
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
                    url: "<?=base_url('/administrator/api/delete-data-user')?>",
                    data: {
                        id: id
                    },
                    dataType: "JSON",
                    success: function (response) {
                        if (response.status == 'success') {
                            Swal.fire('Data berhasil di hapus!', '', 'success').then(() => {
                                location.reload();
                            })
                        }else{
                            Swal.fire(`${response.msg}`, '', 'error');
                        }
                    }
                });

            } else if (result.isDenied) {
                Swal.fire('Hapus Data di batalkan', '', 'info')
            }
        })
    }
     add_user=()=> {
        $(".text-error").text('');
        console.log($("#form-user").attr("action"));
        let data = {
            email: $("#email").val(),
            nama: $("#nama").val(),
            id:sessionStorage.getItem('id_user'),
        }
        $("#form-user").ajaxForm({
            type: "POST",
            url: base_url+$("#form-user").attr("action"),
            data: data,
            dataType: "JSON",
            success: function(response) {
                if (response.status == 'validation_failed') {
                    $.each(response.errors, function(indexInArray, valueOfElement) {
                        $(".e" + indexInArray).text(valueOfElement);
                    });
                } else if (response.status == 'user not found') {
                    Swal.fire('Maaf username atau password yang anda gunakan salah');
                } else if (response.status == 'success') {
                    Swal.fire(`${response.msg}`).then(()=>{
                        location.reload();
                    })
                } else {
                    Swal.fire('Sistem bermasalah');
                }
            },
            error: function() {
                Swal.fire('Something went wrong');
            }
        }).submit();
    }
</script>
<?=$this->endSection();?>