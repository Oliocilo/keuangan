
 <nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">

        <?php foreach($menuList as $n => $mnl) { ?>
            <div class="pcoded-navigatio-lavel"><?=isset($mnl['menu']) ? $mnl['menu'] : "";?></div>
                
        <ul class="pcoded-item pcoded-left-item">
                <?php foreach ($mnl['parent'] as $key => $pv) {?>

                  <ul class="pcoded-item pcoded-left-item">
                    <?php if(!empty($pv['sub'])){ ?>
                    <li class="pcoded-hasmenu <?=activeMenu($page_active,$pv['slug'])?>">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="<?=$pv['icon']?>"></i></span>
                            <span class="pcoded-mtext"><?=$pv['menu']?></span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <?php foreach ($pv['sub'] as $key => $subm) { ?>
                            <li class="<?=activeSubMenu(isset($page_sub_active) ? $page_sub_active : '',$subm['slug'])?>">
                                <a href="<?=base_url($subm['link'])?>">
                                    <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                    <span class="pcoded-mtext"><?=$subm['menu']?></span>
                                </a>
                            </li>
                        <?php } ?>
                        </ul>
                    </li>
            <?php }else{ ?>
                <li class="<?=activeSubMenu($page_active,$pv['slug'])?>">
                    <a href="<?=base_url($pv['link'])?>">
                        <span class="pcoded-micon"><i class="<?=$pv['icon']?>"></i></span>
                        <span class="pcoded-mtext"><?=$pv['menu']?></span>
                    </a>
                </li>
            <?php } ?>

                </ul>
            <?php } ?>
        <?php } ?>

      
       
       
    </div>
</nav>