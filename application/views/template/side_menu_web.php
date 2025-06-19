
<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?=activeSubMenu($page_active,'dashboard')?>">
                <a href="<?=base_url('conf/adminweb')?>">
                    <span class="pcoded-micon"><i class="fa fa-dashboard"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
            <li class="<?=activeSubMenu($page_active,'transaksi')?>">
                <a href="<?=base_url('conf/transaksi')?>">
                    <span class="pcoded-micon"><i class="fa fa-exchange"></i></span>
                    <span class="pcoded-mtext">Transaksi</span>
                </a>
            </li>
            <li class="<?=activeSubMenu($page_active,'pengguna')?>">
                <a href="<?=base_url('conf/pengguna')?>">
                    <span class="pcoded-micon"><i class="fa fa-users"></i></span>
                    <span class="pcoded-mtext">Pengguna Terdaftar</span>
                </a>
            </li>

            <li class="<?=activeSubMenu($page_active,'premium')?>">
                <a href="<?=base_url('conf/premium')?>">
                    <span class="pcoded-micon"><i class="fa fa-star"></i></span>
                    <span class="pcoded-mtext">Paket Premium</span>
                </a>
            </li>

            <li class="<?=activeSubMenu($page_active,'rekening')?>">
                <a href="<?=base_url('conf/rekening')?>">
                    <span class="pcoded-micon"><i class="fa fa-credit-card"></i></span>
                    <span class="pcoded-mtext">Daftar Rekening</span>
                </a>
            </li>
        </ul>

    </div>
</nav>