<?php 
if($this->session->userdata('session_rtc')) {
  if($this->session->userdata('role_id') == 9999){
    redirect(base_url('sysconf/home_dev'));
  }else if($this->session->userdata('role_id') == 9998){
    redirect(base_url('conf/adminweb'));
  }else{
    redirect(base_url('home'));
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <!-- Meta -->
    <meta name="description" content="Buku Kas">
    <meta name="author" content="Rahmat Hidayat">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">

    <title><?=$page_name?></title>
    
    <!-- Favicon icon -->
    <link rel="icon" href="<?= base_url('assets') ?>/assets/images/fav.png" type="image/x-icon">
    <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets') ?>/bower_components/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets') ?>/assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets') ?>/assets/icon/icofont/css/icofont.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets') ?>/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/assets/')?>css/login.css">
  </head>

  <body class="fix-menu">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->


    <?=$content?>
    

    <div class="modal fade" id="default-Modal"  role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <h3 id="titlemodal" class="p-15 m-0"></h3>
                <div class="loadformModal"></div>
            </div>
        </div>
    </div>
    
    <!-- Required Jquery -->
    <script type="text/javascript" src="<?=base_url('assets')?>/bower_components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets')?>/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets')?>/bower_components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets')?>/bower_components/bootstrap/js/bootstrap.min.js"></script>
  
    <script src="<?=base_url('assets')?>/assets/js/custom.js"></script>
    <script src="<?=base_url('assets') ?>/sweetalert2/dist/sweetalert2.min.js"></script>
    <script type="text/javascript">var baseUrl = '<?=base_url()?>'</script>

    <?php if(isset($dataload)){ ?>
        <script src="<?=base_url('assets')?>/dataload/<?=$dataload?>"></script>
    <?php } ?>
  </body>
</html>
