
    <div class="container">
        <div class="img">
            <img src="<?= base_url('assets') ?>/assets/images/bg_login.jpg">
        </div>
        <div class="login-content">
            <form  id="formajax" action="<?= base_url('processLogin')?>">
                <img src="<?= base_url('assets') ?>/assets/images/logo.png">
                <h2 class="title">Welcome</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>E-Mail</h5>
                        <input type="text" name="username" class="input">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i"> 
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" name="password" class="input">
                    </div>
                </div>
                <a href="<?= base_url('register')?>" class="float-left">Create account</a>
                <a href="<?= base_url('reset')?>">Forgot Password?</a>
                <input type="submit" class="btn btnSubmit" value="Login">
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