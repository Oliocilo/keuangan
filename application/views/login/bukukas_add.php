
<div class="container">
        <div class="img">
            <img src="<?= base_url('assets') ?>/assets/images/bg_login.jpg">
        </div>
        <div class="login-content">
          <form style="width:460px" id="formajax" action="<?= base_url('processBukukas') ?>">
               <img src="<?= base_url('assets') ?>/assets/images/logo.png">
               <h2 class="title text-nowrap">Buat Buku Kas</h2>
               <div class="errorValidate" style="display:none"><ul></ul></div>
               <div class="input-div one">
                    <div class="i">
                         <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                         <h5>Nama Buku Kas</h5>
                         <input type="text" name="nama" class="input">
                    </div>
               </div>
               <div class="input-div two">
                    <div class="i">
                         <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                         <h5>Deskripsi Buku Kas</h5>
                         <textarea name="deskripsi" class="input"></textarea>
                    </div>
               </div>
               <div class="input-div one">
                    <div class="i">
                         <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                         <h5>Saldo Awal</h5>
                         <input type="text" name="saldo_awal" class="currency input" data-a-sign="Rp. ">
                    </div>
               </div>
               <div class="row pt-3">
                    <div class="col-lg-6">
                         <div class="input-div one focus">
                              <div class="i">
                                   <i class="fas fa-user"></i>
                              </div>
                              <div class="div">
                                   <h5>Kategori Pemasukan 1</h5>
                                   <input type="text" name="kategori[0]" class="input" value="Penjualan Barang" disabled>
                              </div>
                         </div>
                    </div>
                    <div class="col-lg-6">
                         <div class="input-div one">
                              <div class="i">
                                   <i class="fas fa-user"></i>
                              </div>
                              <div class="div">
                                   <h5>Kategori Pemasukan 2</h5>
                                   <input type="text" name="kategori[1]" class="input">
                              </div>
                         </div>
                    </div>
               </div>
               <div class="row pt-3">
                    <div class="col-lg-6">
                         <div class="input-div one focus">
                              <div class="i">
                                   <i class="fas fa-user"></i>
                              </div>
                              <div class="div">
                                   <h5>Kategori Pengeluaran 1</h5>
                                   <input type="text" name="kategori[2]" class="input" value="Pembelian Barang" disabled>
                              </div>
                         </div>
                    </div>
                    <div class="col-lg-6">
                         <div class="input-div one">
                              <div class="i">
                                   <i class="fas fa-user"></i>
                              </div>
                              <div class="div">
                                   <h5>Kategori Pengeluaran 2</h5>
                                   <input type="text" name="kategori[3]" class="input">
                              </div>
                         </div>
                    </div>
               </div>
               <input type="submit" class="btn btnSubmit" value="Simpan">
            </form>
        </div>
    </div>

<script type="text/javascript" src="<?=base_url('assets')?>/assets/pages/j-pro/js/autoNumeric.js"></script>
<script type="text/javascript">
     $('.currency').autoNumeric('init', {
        aSep: '.', 
        aDec: ',',
        aForm: true,
        aPad: false,
        vMin: 0,
     });

    const inputs = document.querySelectorAll(".input");

    function addcl(){
        let parent = this.parentNode.parentNode;
        parent.classList.add("focus");
    }

    function remcl(){
        let parent = this.parentNode.parentNode;
        if(this.value == ""){
            parent.classList.remove("focus");
        }
    }

    inputs.forEach(input => {
        input.addEventListener("focus", addcl);
        input.addEventListener("blur", remcl);
    });

</script>