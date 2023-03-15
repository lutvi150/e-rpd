<?php $session = \Config\Services::session();?>
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>Menu</h3>
        <?php if ($session->get('role') == 'administrator'): ?>
        <ul class="nav side-menu">
            <li><a href="/administrator"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="/administrator/data-unit"><i class="fa fa-building"></i> Data Unit Kampus</a></li>
            <li><a href="/administrator/rpd"><i class="fa fa-database"></i> RPD</a></li>
            <li><a href="/administrator/laporan"><i class="fa fa-book"></i> Laporan</a></li>
            <li><a href="/administrator/data-user"><i class="fa fa-users"></i> Data User</a></li>
        </ul>
        <?php elseif ($session->get('role') == 'unit'): ?>
            <ul class="nav side-menu">
            <li><a href="/unit"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="/unit/rpd"><i class="fa fa-database"></i> RPD</a></li>
            <li><a href="/unit/laporan"><i class="fa fa-book"></i> Laporan</a></li>
        </ul>
            <?php endif;?>
    </div>

</div>
