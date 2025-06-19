<div class="page-wrapper">
    <div class="card page-header p-0" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;">
        <div class="card-block front-icon-breadcrumb row align-items-end">
            <div class="breadcrumb-header col title-bukukas">
                <div class="big-icon">
                    <i class="fa fa-cogs"></i>
                </div>
                <div class="d-inline-block">
                    <h5><?=$page_name?></h5>
                    <span>Peralatan</span>
                </div>
            </div>
            <div class="col text-right">

            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="m-b-25">
                  <button class="btn btn-primary">Buat Invoice</button>

                  <a href="<?=base_url('alat/einvoice/list')?>">
                      <button class="btn btn-outline-secondary">Buku Invoice</button>
                  </a>

                  <a href="<?=base_url('alat/einvoice/pelanggan')?>">
                  <button class="btn btn-outline-secondary">Daftar Pelanggan</button>
              </a>
         
        </div>


        <form  method="POST" action="<?= base_url('alat/einvoice/store') ?>" id="formInv">
 <div class="card" style="box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;">
             <div class="card-header bg-primary cardtitleAlat">
                  <span class="text-white" style="font-size: 18px !important;">Buat Invoice</span>
            </div>
            <div class="card-block">
                <div class="row b-b-primary p-10">
                    <div class="col-md-6   m-b-10">
                        <img src="<?=base_url('assets/assets/images/logortc.png')?>" class="logoinvoice">
                        <div id="progress-container">
                            <div id="progress-bar"></div>
                        </div>
                        <div class="inputbox">
                            <input type="file" id="file-input" name="">

                        </div>
                    </div>
                    <div class="col-md-6 info-saldo" style="float:right;">
                        <div class="text-right float-right">
                            <table class="text-right">
                                <tr>
                                    <th class="text-right">Invoice No.*</th>
                                    <td class="text-right"><input type="text" name="st[1][invoice_no]" class="form-control bgabu font-weight-bold req" value="<?=$noInv?>" onfocus="javascript:this.value==this.defaultValue ? this.value = '' : ''" onblur="javascript:this.value == '' ? this.value = this.defaultValue : ''"></td>
                                </tr>
                                <tr>
                                    <th class="text-right">Tanggal Invoice*</th>
                                    <td class="text-right"><input type="text" name="st[1][invoice_tanggal]" class="form-control bgabu req" value="<?=date('Y-m-d')?>"></td>
                                </tr>
                                <tr>
                                    <th class="text-right">Jatuh Tempo*</th>
                                    <td class="text-right"><input type="text" name="st[1][invoice_jatuhTempo]" class="form-control bgabu req" value="<?=date('Y-m-d')?>"></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="row b-b-primary p-10">
                    <div class="col-md-4">
                        <div class="">
                            <table class="text-right" style="width:100%">
                                <tr>
                                    <td class="text-right"><input type="text" class="form-control bgabu req" style="width:80%" placeholder="Nama Perusahaan Anda*" name="st[2][nama_perusahaan]"></td>
                                </tr>
                                <tr>
                                    <td class="text-right"><input type="text" class="form-control bgabu req" placeholder="Alamat Anda baris 1*" name="st[2][alamat_baris_1]"></td>
                                </tr>
                                <tr>
                                    <td class="text-right"><input type="text" class="form-control bgabu" placeholder="Alamat Anda baris 2" name="st[2][alamat_baris_2]"></td>
                                </tr>
                                <tr>
                                    <td class="text-right"><input type="text" class="form-control bgabu" placeholder="Alamat Anda baris 3" name="st[2][alamat_baris_3]"></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="row b-b-primary p-10">
                    <div class="col-md-4">
                        <br>
                        <br>
                        <div class="">
                            <h5>Ditagih kepada</h5>
                            <table class="text-right m-t-10" style="width:100%">
                                <tr>
                                    <td class="text-right"><input type="text" class="form-control bgabu req" style="width:80%" placeholder="Nama Pelanggan*" name="st[3][nama_pelanggan]" id="autocomplete-input"></td>
                                </tr>
                                <tr>
                                    <td class="text-right"><input type="text" class="form-control bgabu req" placeholder="Alamat Pelanggan baris 1*" id="addtgh1" name="st[3][alamat_baris_1]"></td>
                                </tr>
                                <tr>
                                    <td class="text-right"><input type="text" class="form-control bgabu" placeholder="Alamat Pelanggan baris 2" id="addtgh2" name="st[3][alamat_baris_2]"></td>
                                </tr>
                                <tr>
                                    <td class="text-right"><input type="text" class="form-control bgabu" placeholder="Alamat Pelanggan baris 3" id="addtgh3" name="st[3][alamat_baris_3]"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                        <div class="invcheck">
                            <input name="st[6][is_dikirim]" id="iskirim" type="checkbox"> Aktifkan kolom "Dikirim kepada"             
                        </div>
                        <br>
                        <div class="">
                            <h5 class="disabled">Dikirim kepada</h5>
                            <table class="text-right m-t-10" style="width:100%">
                                <tr>
                                    <td class="text-right"><input type="text" class="form-control kirimInp bgabu noaction" style="width:80%" placeholder="Nama Penerima" readonly name="st[6][nama_penerima]"></td>
                                </tr>
                                <tr>
                                    <td class="text-right"><input type="text" class="form-control kirimInp bgabu noaction" placeholder="Alamat Penerima baris 1" readonly name="st[6][alamat_baris_1]"></td>
                                </tr>
                                <tr>
                                    <td class="text-right"><input type="text" class="form-control kirimInp bgabu noaction" placeholder="Alamat Penerima baris 2" readonly name="st[6][alamat_baris_2]"></td>
                                </tr>
                                <tr>
                                    <td class="text-right"><input type="text" class="form-control kirimInp bgabu noaction" placeholder="Alamat Penerima baris 3" readonly name="st[6][alamat_baris_3]"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row b-b-primary p-10">

                    <div class="col-md-12">
                        <div class="">
                            <table class="table custom-table table-hover table-bordered thead-center" id="tblinv" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width:60px">ID*</th>
                                        <th style="width:300px">Deskripsi*</th>
                                        <th style="width:70px">Jumlah</th>
                                        <th style="width:170px">Harga Satuan</th>
                                        <th style="width:170px">Total</th>
                                        <th style="width:50px">X</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <tr>
                                    <td style="width:40px">
                                        <input type="text" class="form-control bgabu inputCenter numberID req" id="id_1" name="id[]" value="1">
                                    </td>
                                    <td>
                                        <textarea class="form-control bgabu req" id="desc_1" name="desc[]"></textarea>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control bgabu inputCenter ganti" id="qty_1" name="qty[]" value="1"></td>
                                        <td>
                                            <input type="text" class="form-control bgabu text-right currency ganti" id="harga_1" name="harga[]"></td>
                                            <td>
                                                <input type="text" class="form-control bgabu text-right currency noaction" readonly id="total_1" name="total[]"></td>
                                                <td class="text-center">

                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <div class="text-right">
                                        <button type="button" class="btn btn-success btn-sm" id="addItem"> <i class="fa fa-plus"></i> Tambah Item </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row b-b-primary p-10">
                            <div class="col-md-12 info-saldo" style="float:right;">
                                <div class="text-right float-right">
                                    <table class="table text-right smalltable table-borderless">
                                        <tr>
                                            <th class="text-right vCenter">Sub Total</th>
                                            <td class="text-right"><input id="subtotal" type="text" class="form-control bgabu currency text-right noaction" readonly name="st[4][subtotal]"></td>
                                            <td class="text-center vCenter"></td>
                                        </tr>
                                        <tr>
                                            <th class="text-right vCenter">Sudah Dibayar (-)</th>
                                            <td class="text-right"><input type="text" id="sudahbayar" class="form-control bgabu text-right currency noaction kurang ganti" readonly name="st[4][sudahbayar]" value="0"></td>
                                            <td class="text-center vCenter"><input class="enableInputCheckbox" name="sudahbayar" type="checkbox"> </td>
                                        </tr>
                                        <tr>
                                            <th class="text-right vCenter">Diskon (-)</th>
                                            <td class="text-right"><input type="text" class="form-control bgabu text-right currency noaction kurang ganti" id="diskon" readonly name="st[4][diskon]" value="0"></td>
                                            <td class="text-center vCenter"><input type="checkbox" class="enableInputCheckbox" name="diskon"> </td>
                                        </tr>
                                        <tr>
                                            <th class="text-right vCenter">Pajak (+)</th>
                                            <td class="text-right">
                                                <input type="text" class="form-control bgabu currency text-right tambah ganti" value="0" id="pajak" name="st[4][pajak]">
                                            </td>
                                            <td class="text-center vCenter"><input name="pajak" type="checkbox" checked  class="enableInputCheckbox"> </td>
                                        </tr>
                                        <tr>
                                            <th class="text-right vCenter">Biaya Pengiriman (+)</th>
                                            <td class="text-right"><input type="text" id="ongkir" class="form-control bgabu text-right currency noaction tambah ganti" readonly name="st[4][ongkir]" value="0"></td>
                                            <td class="text-center vCenter"><input type="checkbox" class="enableInputCheckbox" name="ongkir"> </td>
                                        </tr>
                                        <tr style="background:#ddd">
                                            <th class="text-right vCenter">TOTAL</th>
                                            <td class="text-right"><input type="text" id="totalfinal" class="form-control bgabu noaction currency text-right font-weight-bold" readonly name="st[4][totalfinal]"></td>
                                            <td class="text-center vCenter"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div style="position:relative;">
                            <img src="<?=base_url('assets/images/stamp/')?>stamp_lunas.png" width="160" height="116" class="hidden stampImg stampLunas">

                            <img src="<?=base_url('assets/images/stamp/')?>stamp_segera.png" width="160" height="116" class="hidden stampImg stampSegera">

                            <img src="<?=base_url('assets/images/stamp/')?>stamp_jatuh_tempo.png" width="160" height="116" class="hidden stampImg stampJatuhTempo">

                            <img src="<?=base_url('assets/images/stamp/')?>stamp_final.png" width="160" height="116" class="hidden stampImg stampFinal">

                            <img src="<?=base_url('assets/images/stamp/')?>stamp_dikirim.png" width="160" height="116" class="hidden stampImg stampDikirim">

                            <img src="<?=base_url('assets/images/stamp/')?>stamp_disetujui.png" width="160" height="116" class="hidden stampImg stampDisetujui">
                        </div>

                        <div class="row b-b-primary p-10">
                            <div class="col-md-12">
                                <div class="">
                                    <h5>Catatan</h5>
                                    <textarea rows="5" class="form-control bgabu m-t-10" placeholder="Anda bisa menulis catatan tambahan untuk Pelanggan Anda disini." name="st[5][catatan]"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row b-b-primary p-10">
                            <div class="col-md-12">
                                <div class="">
                                    <h5>Stempel</h5>
                                    <div class="stampelLine m-t-10">
                                        <div class="inpstampel">
                                            <input name="stampLunas" class="inputStempel" type="checkbox"> Lunas 
                                        </div>
                                        <div class="inpstampel">
                                            <input name="stampSegera" class="inputStempel" type="checkbox"> Segera 
                                        </div>
                                        <div class="inpstampel">
                                            <input name="stampJatuhTempo" class="inputStempel" type="checkbox" > Jatuh Tempo 
                                        </div>
                                        <div class="inpstampel">
                                            <input name="stampFinal" class="inputStempel" type="checkbox"> Final 
                                        </div>
                                        <div class="inpstampel">
                                            <input name="stampDikirim" class="inputStempel" type="checkbox"> Dikirim 
                                        </div>
                                        <div class="inpstampel">
                                            <input name="stampDisetujui" class="inputStempel" type="checkbox"> Disetujui 
                                        </div>            
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>


                <button type="button" class="btn btn-primary waves-effect btnSubmitINV">Simpan</button>
            </form>

        </div>

    </div>

