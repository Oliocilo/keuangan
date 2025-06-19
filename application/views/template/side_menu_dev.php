
<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?=activeSubMenu($page_active,'dashboard')?>">
                <a href="<?=base_url('sysconf/home_dev')?>">
                    <span class="pcoded-micon"><i class="fa fa-dashboard"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
            <li class="<?=activeSubMenu($page_active,'sysfunction')?>">
                <a href="<?=base_url('sysconf/sysfunction')?>" >
                    <span class="pcoded-micon"><i class="fa fa-cog"></i></span>
                    <span class="pcoded-mtext">SysFunction</span>
                </a>
            </li>
        </ul>
    </div>
</nav>