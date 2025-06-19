<div class="page-wrapper">
   <div class="card page-header p-0">
        <div class="card-block front-icon-breadcrumb row align-items-end">
            <div class="breadcrumb-header col title-bukukas">
                <div class="big-icon">
                    <i class="fa fa-book"></i>
                </div>
                <div class="d-inline-block">
                    <h5><?=$page_name?></h5>
                    <span>Pengingat dan Tulisan Ringkas</span>
                </div>
                <button type="button" onclick="addForm()" class="btn btn-primary waves-effect waves-light float-right" data-toggle="tooltip" data-placement="top" title="Add note">
                    <i class="icofont icofont-ui-add"></i><span class="m-l-10">Buat Catatan</span>
                </button>
            </div>
        </div>
    </div>
    <div class="page-body m-0">
        <!-- Sticky Notes card start -->
        <div class="card" style="box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;">
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <?php
                        foreach ($catatan as $key => $val) {            
                            if(strlen($val['catatan']) > 50){
                                $val['catatan'] = substr($val['catatan'], 0, 47).'...';
                            }
                    ?>
                        <div class="col-12 col-md-3">
                            <div class="thumbnail">
                                <div class="thumb">
                                    <button type="button" class="btn p-0 position-relative" onclick="editForm(<?=$val['id']?>,'<?=$val['warna_latar']?>','<?=$val['warna_teks']?>')" data-toggle="tooltip" data-placement="top" title="Catatan">
                                        <img src="<?=base_url('assets/images/catatan-container.png')?>" alt="" class="img-fluid img-thumbnail" style="background-color:<?=$val['warna_latar']?>">
                                        <h6 class="textCatatan" style="color:<?=$val['warna_teks']?>"><?=$val['catatan']?></h6>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php } 
                        if(empty($catatan)) echo '<div class="col-12 text-center">Belum ada catatan.</div>';
                    ?>
                </div>
            </div>
        </div>
        <!-- Sticky Notes card end -->
    </div>
</div>
<div id="formDelete"></div>