
<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel"> Buku Kas</div>
        <ul class="pcoded-item pcoded-left-item">
            <?php foreach ($bukuKasList as $key => $bkl) { ?>
                <li class="active">
                    <a href="<?=base_url('book/id/'.$this->template->matEnc($bkl['id_buku']))?>">
                        <span class="pcoded-micon"><i class="feather icon-book"></i></span>
                        <span class="pcoded-mtext"><?=$bkl['nama']?></span>
                    </a>
                </li>
            <?php } ?>
            
        </ul>
        <div class="pcoded-navigatio-lavel">Utang dan Piutang</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="<?=base_url('debt')?>">
                    <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                    <span class="pcoded-mtext">Utang</span>
                    <!-- <span class="pcoded-badge label label-danger">2+</span> -->
                </a>
            </li>
            <li class="">
                <a href="<?=base_url('credit')?>">
                    <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                    <span class="pcoded-mtext">Piutang</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigatio-lavel">Catatan Laporan</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="<?=base_url('laporan/kas')?>">
                    <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
                    <span class="pcoded-mtext">Laporan Kas</span>
                </a>
            </li>
        </ul>

         <div class="pcoded-navigatio-lavel">Aset</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="<?=base_url('master/aset_kategori')?>">
                    <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
                    <span class="pcoded-mtext">Kategori Aset</span>
                </a>
            </li>
            <li class="pcoded-hasmenu">
                <a href="<?=base_url('aset')?>">
                    <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
                    <span class="pcoded-mtext">Daftar Aset</span>
                </a>
            </li>
        </ul>

         <div class="pcoded-navigatio-lavel">Master Data</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="<?=base_url('master/bukukas')?>">
                    <span class="pcoded-micon"><i class="feather icon-book"></i></span>
                    <span class="pcoded-mtext">Buku Kas</span>
                </a>
            </li>
            <li class="">
                <a href="<?=base_url('master/kategori')?>">
                    <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                    <span class="pcoded-mtext">Kategori</span>
                </a>
            </li>
        </ul>
    </div>
</nav>