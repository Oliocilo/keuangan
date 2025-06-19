
    <div class="container">
        <div class="img">
            <img src="<?= base_url('assets') ?>/assets/images/bg_login.jpg">
        </div>
        <div class="login-content">
            <form  id="formajax" action="<?= base_url('processRegister')?>">
                <img src="<?= base_url('assets') ?>/assets/images/logo.png">
                <h2 class="title">Daftar Akun</h2>
                <div class="errorValidate" style="display:none"><ul></ul></div>
                <div class="input-div one">
                   <div class="i">
                        <i class="fas fa-user"></i>
                   </div>
                   <div class="div">
                        <h5>Nama Lengkap</h5>
                        <input type="text" name="nama" class="input">
                   </div>
                </div>
                <div class="input-div one">
                   <div class="i">
                        <i class="fas fa-user"></i>
                   </div>
                   <div class="div">
                        <h5>E-Mail</h5>
                        <input type="text" id="new_username" name="new_username" class="input" autocomplete="new-password">
                   </div>
                </div>
                <div class="input-div pass">
                   <div class="i"> 
                        <i class="fas fa-lock"></i>
                   </div> 
                   <div class="div">
                        <h5>Password</h5>
                        <input type="password" id="new_password" name="new_password" class="input" autocomplete="new-password">
                   </div>
                </div>
                <div class="input-div pass">
                   <div class="i"> 
                        <i class="fas fa-lock"></i>
                   </div>
                   <div class="div">
                        <h5>Ulangi Password</h5>
                        <input type="password" id="repeat-password" name="repeat_password" class="input" autocomplete="new-password">
                   </div>
                </div>
                <p class="float-left py-3">Sudah punya akun? <a href="<?= base_url('login')?>" class="d-inline">Login</a></p>
                <input type="submit" class="btn btnSubmit" value="Daftar">
            </form>
        </div>
    </div>

<script type="text/javascript">
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