<?=$this->extend('layout/template');?>
<?=$this->section('content');?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>History Verifikasi </h3>
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
                            <div class="col-md-12 col-sm-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>History Pengajuan Verifikasi</h2>
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
                                        <ul class="list-unstyled timeline">
                                            <?php foreach ($verifikasi as $key => $value): ?>
                                            <li>
                                                <div class="block">
                                                <?php if ($value->status == 1) {
    $status = 'Draf';
} elseif ($value->status == 2) {
    $status = 'Verifikasi';
} elseif ($value->status == 3) {
    $status = 'Terverifikasi';
} else {
    $status = 'Revisi';
}?>
                                                    <div class="tags btn-"  >
                                                        <a href="" class="tag">

                                                            <span><?=$status?></span>
                                                        </a>
                                                    </div>
                                                    <div class="block_content">
                                                        <h2 class="title">
                                                            <a>Status Verifikasi</a>
                                                        </h2>
                                                        <div class="byline">
                                                            <span>Dibuat pada: <?=$value->created_at?></span> Oleh <a><?=$value->nama_user?></a>
                                                        </div>
                                                        <p class="excerpt"><?=$value->comment?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php endforeach;?>
                                        </ul>

                                    </div>
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