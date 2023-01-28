<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= getenv('app_name') ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/theme/mazer-main/dist/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/theme/mazer-main/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/theme/mazer-main/dist/assets/css/app.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/theme/mazer-main/dist/assets/css/pages/auth.css">
</head>

<body>
    <style>
        #auth #auth-left .auth-logo img {
            height: 100px;
        }

        .text-error {
            color: red;
        }
    </style>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="#"><img width="100px" src="<?= base_url() ?>/assets/logo/logo.jpg" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-5">Selamat datang di <?= getenv('app_name') ?></p>

                    <form action="" id="login">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" id="email" class="form-control form-control-xl" placeholder="Username">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            <span class="text-error eemail"></span>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" id="password" class="form-control form-control-xl" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <span class="text-error epassword"></span>
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Simpan username
                            </label>
                        </div>
                        <button type="button" class="btn btn-primary btn-block btn-lg shadow-lg mt-5  btn-login text-center">Login</button>
                        <button type="button" hidden class="btn btn-primary btn-block btn-lg shadow-lg mt-5  btn-loading text-center"><svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"></path>
                                <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"></path>
                            </svg>Loding........</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <!-- <p class="text-gray-600">Don't have an account? <a href="auth-register.html"
                                class="font-bold">Sign
                                up</a>.</p>
                        <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>
<script src="<?= base_url(); ?>/assets/theme/mazer-main/dist/assets/vendors/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>/assets/others/form-master/dist/jquery.form.min.js"></script>
<script src="<?= base_url(); ?>/assets/others/sweetalert2-11.6.16/dist/sweetalert2.all.min.js"></script>
<script>
    $(".btn-login").click(function(e) {
        e.preventDefault();
        login();
    });

    function login() {
        $(".text-error").text('');
        // $(".btn-login").hide();
        // $(".btn-loading").removeAttr('hidden style');
        let data = {
            email: $("#email").val(),
            password: $("#password").val(),
        }
        $('#login').ajaxForm({
            type: "POST",
            url: "<?= base_url('api/login') ?>",
            data: data,
            dataType: "JSON",
            success: function(response) {
                if (response.status == 'validation_failed') {
                    $.each(response.errors, function(indexInArray, valueOfElement) {
                        $(".e" + indexInArray).text(valueOfElement);
                    });
                    $(".btn-loading").hide();
                    $(".btn-login").removeAttr('hidden style');
                } else if (response.status == 'user not found') {
                    Swal.fire('Maaf username atau password yang anda gunakan salah');
                } else if (response.status == 'success') {
                    window.reload();
                } else {
                    Swal.fire('Sistem bermasalah');
                }
            },
            error: function() {
                $(".btn-loading").hide();
                $(".btn-login").removeAttr('hidden style');
                Swal.fire('Something went wrong');
            }
        }).submit();
    }
</script>

</html>