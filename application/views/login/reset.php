
<div class="container">
        <div class="img">
            <img src="<?= base_url('assets') ?>/assets/images/bg_login.jpg">
        </div>
        <div class="login-content">
            <form  id="formajax" action="<?= base_url('processReset')?>">
                <img src="<?= base_url('assets') ?>/assets/images/logo.png">
                <h2 class="title">Lupa Password</h2>
                <div class="errorValidate" style="display:none"><ul></ul></div>
                <div class="input-div one">
                   <div class="i">
                        <i class="fas fa-user"></i>
                   </div>
                   <div class="div">
                        <h5>E-Mail Pengguna</h5>
                        <input type="text" id="email" name="email" class="input" autocomplete="new-password">
                   </div>
                </div>
                <p class="float-left py-3">Sudah punya akun? <a href="<?= base_url('login')?>" class="d-inline">Login</a></p>
                <input type="submit" class="btn btnSubmit" value="Kirim">
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