
<?=$this->include('layout/header')?>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="#" class="site_title"><i class="fa fa-home"></i> <span>E-RPD</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="<?=base_url()?>/assets/logo/icon-admin.png" alt="..."
                                class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Selamat Datang,</span>
                            <h2>Admin</h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                  <?=$this->include('layout/sidebar');?>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <?=$this->include('layout/top_navigation');?>
            <!-- /top navigation -->

            <!-- page content -->
            <?=$this->renderSection('content')?>
            <!-- /page content -->

            <!-- footer content -->
           <?=$this->include('layout/footer')?>
            <!-- /footer content -->
        </div>
    </div>

    <?=$this->include('layout/script');?>
    <?=$this->renderSection('js');?>


</body>

</html>