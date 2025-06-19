<div class="page-wrapper">
    <div class="card page-header p-0" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;">
        <div class="card-block front-icon-breadcrumb row align-items-end">
            <div class="breadcrumb-header col title-bukukas">
                <div class="big-icon">
                    <i class="<?=$page_icon?>"></i>
                </div>
                <div class="d-inline-block">
                    <h5><?=$page_name?></h5>
                    <span>Pengaturan</span>
                </div>
            </div>
            <div class="col text-right">

            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="card" style="box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;">
             <div class="card-header bg-primary cardtitleAlat">
                  <span class="text-white" style="font-size: 18px !important;">Pengguna <?= $this->session->userdata('nama'); ?></span>
            </div>
            <form class="card-body" novalidate="" method="POST" id="formajax" action="<?= base_url('akun/update') ?>" autocomplete="off">
                <div class="row">
                    <div class="col-xl-6 col-md-12">
                        <div class="form-group row">
                            <div class="col-md-5 col-lg-4">
                                <label for="nama-2" class="block">Nama Lengkap *</label>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <input id="nama-2" name="nama" value="<?=$user['nama']?>" type="text" class="required form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5 col-lg-4">
                                <label for="email-2" class="block">Email *</label>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <input id="email-2" name="email" value="<?=$user['username']?>" type="email" class="required form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5 col-lg-4">
                                <label for="telepon-2" class="block">No. Telepon *</label>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <input id="telepon-2" name="telepon" value="<?=$user['telepon']?>" type="number" class="required form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5 col-lg-4">
                                <label for="password-2" class="block">Password *</label>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <input id="password-2" name="password" type="password" class="form-control required" placeholder="Biarkan kosong, jika tidak ingin diubah">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5 col-lg-4">
                                <label for="confirm-2" class="block">Confirm Password *</label>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <input id="confirm-2" name="confirm" type="password" class="form-control required" placeholder="Biarkan kosong, jika tidak ingin diubah">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5 col-lg-4">
                                <label class="block">Status </label>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <h6>Pengguna <?=$premium ? 'Premium' : 'Gratis' ?></h6>
                            </div>
                        </div>
                        <?php if($premium){ ?>
                        <div class="form-group row">
                            <div class="col-md-5 col-lg-4">
                                <label class="block">Tanggal Habis Premium </label>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <h6><?= date_format(date_create($lastPremium), 'd F Y, H:i:s')?></h6>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="form-group row">
                            <div class="col-md-5 col-lg-4">
                                <label class="block">Tanggal Mendaftar </label>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <h6><?= date_format(date_create($user['created_at']), 'd F Y, H:i:s')?></h6>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5 col-lg-4">
                                <label class="block">Aktivitas Terakhir </label>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <h6><?=$lastAct?></h6>
                            </div>
                        </div>
                    </div>
                    <hr class="d-md-block d-lg-none"/>
                    <div class="col-xl-6 col-md-12">
                        <div class="form-group row">
                            <div class="col-md-5 col-lg-4">
                                <label for="organisasi-2" class="block">Perusahaan/Organisasi *</label>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <input id="organisasi-2" name="organisasi" type="text" value="<?=$user['organisasi']?>" class="required form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5 col-lg-4">
                                <label for="alamat-1" class="block">Alamat *</label>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <input id="alamat-1" name="alamat_1" type="text" value="<?=$user['alamat_1']?>" class="required form-control"  placeholder="Alamat Baris 1">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5 col-lg-4">
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <input id="alamat-2" name="alamat_2" type="text" value="<?=$user['alamat_2']?>" class="required form-control"  placeholder="Alamat Baris 2">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5 col-lg-4">
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <input id="alamat-3" name="alamat_3" type="text" value="<?=$user['alamat_3']?>" class="required form-control"  placeholder="Alamat Baris 3">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5 col-lg-4">
                                <label for="isiProvinsi" class="block">Provinsi *</label>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <input id="getProvinsi" type="hidden" value="<?= $user['provinsi'] != null ? $user['provinsi'] : '' ?>">
                                <select id="isiProvinsi" name="provinsi" class="required form-control" aria-label="Pilih Provinsi" onchange="pilihWilayah('regencies',this.value.split(',')[0]);" >
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5 col-lg-4">
                                <label for="isiKabKota" class="block">Kabupaten/Kota *</label>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <input id="getKota" type="hidden" value="<?= $user['kota'] != null ? $user['kota'] : '' ?>">
                                <select name="kota" id="isiKabKota" class="required form-control">
                                    <?php if($user['kota'] == null){?>
                                        <option value="" selected>Pilih Kabupaten/Kota</option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5 col-lg-4">
                                <label for="pekerjaan-1" class="block">Pekerjaan/Jabatan *</label>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <input id="pekerjaan-1" name="pekerjaan" type="text" class="required form-control" value="<?=$user['pekerjaan']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5 col-lg-4">
                                <label for="penggunaan-1" class="block">Penggunaan *</label>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <select id="penggunaan-1" name="penggunaan" class="required form-control">
                                    <option value="" selected>Pilih Metode</option>
                                    <?php 
                                        $penggunaan = ["Pribadi/Keluarga", "Pekerja Professional/Pekerja Lepas", "Usaha Mikro dan Kecil", "Perusahaan (CV/PT)", "Organisasi/Komunitas", "Yayasan/LSM"];
                                        foreach ($penggunaan as $pg) { 
                                        $text = '';
                                        if($user['penggunaan'] == $pg){
                                            $text = 'selected';
                                        }
                                        ?>
                                        <option value="<?=$pg?>" <?=$text?>><?=$pg?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block p-t-15 p-b-15 btnSubmit">Simpan Pengaturan Akun</button>
            </form>
        </div>
    </div>
</div>

