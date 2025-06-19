<?php 
if($this->session->userdata('session_rtc_web')=="") {
    redirect('login');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <title><?=$page_name?> - <?=NAME_APP?></title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="description" content="Keuangan">
    <meta name="author" content="Rahmat Hidayat">
    <!-- Favicon icon -->
    <link rel="icon" href="<?=base_url('assets')?>/assets/images/fav.png" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets')?>/bower_components/bootstrap/css/bootstrap.min.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets')?>/assets/icon/feather/css/feather.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets')?>/assets/css/component.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets')?>/assets/icon/icofont/css/icofont.css">


    <link rel="stylesheet" type="text/css" href="<?=base_url('assets')?>/assets/icon/font-awesome/css/font-awesome.min.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets')?>/assets/pages/clndr-calendar/css/clndr.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets')?>/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets')?>/assets/css/jquery.mCustomScrollbar.css">

    <link rel="stylesheet" type="text/css" href="<?=base_url('assets')?>/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" type="text/css" href="<?=base_url('assets')?>/bower_components/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css">

    <link rel="stylesheet" type="text/css" href="<?=base_url('assets')?>/assets/pages/data-table/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets')?>/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets')?>/assets/pages/data-table/extensions/responsive/css/responsive.dataTables.css">

    <link rel="stylesheet" type="text/css" href="<?=base_url('assets')?>/assets/pages/j-pro/css/demo.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets')?>/assets/pages/j-pro/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets')?>/assets/pages/j-pro/css/j-pro-modern.css">
    
    <link rel="stylesheet" href="<?= base_url('assets') ?>/sweetalert2/dist/sweetalert2.min.css">
    
    <link rel="stylesheet" href="<?=base_url('assets')?>/assets/pages/sticky/css/jquery.postitall.css" type="text/css" media="all">
    <link rel="stylesheet" href="<?=base_url('assets')?>/assets/pages/sticky/css/trumbowyg.css" type="text/css" media="all">


    <link rel="stylesheet" href="<?=base_url('assets')?>/bower_components/select2/css/select2.min.css" />
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets')?>/assets/css/rtc.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets')?>/assets/css/responsive.css">

  </head>

  <body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
      <div class="pcoded-overlay-box"></div>
      <div class="pcoded-container navbar-wrapper">
          <?= $headpanel?>
          <!-- Sidebar inner chat end-->
          <div class="pcoded-main-container">
                  <?= $sidemenu ?>
              <div class="pcoded-wrapper">
                  <div class="pcoded-content">
                      <div class="pcoded-inner-content">
                          <div class="main-body">

                              <?=$content?>

                              
                              <div class="md-overlay"></div>
                           

                          </div>
                      </div>
                  </div>

              </div>
          </div>
      </div>
    </div>

    <div class="modal fade" id="default-Modal"  role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <h3 id="titlemodal" class="p-15 m-0"></h3>
                <div class="loadformModal"></div>
            </div>
        </div>
    </div>

     <div class="modal fade" id="large-Modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <h4 id="titlemodal-lg" class="p-15 m-0"></h4>
                <div class="loadformModal-lg"></div>
            </div>
        </div>
    </div>

     <div class="modal fade" id="large-Modal90" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg90" role="document">
            <div class="modal-content">
                <h3 id="titlemodal90-lg" class="p-15 m-0"></h3>
                <div class="loadformModal90-lg"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="default-modal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="default-modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <div id="default-modal-body"></div>
        </div>

        </div>
        </div>
    </div>

    
    <!-- Required Jquery -->
    <script type="text/javascript">var baseUrl = '<?=base_url()?>'</script>
    <script type="text/javascript" src="<?=base_url('assets')?>/bower_components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets')?>/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets')?>/bower_components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets')?>/bower_components/bootstrap/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="<?=base_url('assets')?>/bower_components/moment/js/moment.js"></script>
    <script type="text/javascript" src="<?=base_url('assets')?>/bower_components/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="<?=base_url('assets')?>/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="<?=base_url('assets')?>/bower_components/modernizr/js/modernizr.js"></script>
    <!-- Chart js -->
    <script type="text/javascript" src="<?=base_url('assets')?>/bower_components/chart.js/js/Chart.js"></script>
    <!-- amchart js -->
    <script src="<?=base_url('assets')?>/assets/pages/widget/amchart/amcharts.js"></script>
    <script src="<?=base_url('assets')?>/assets/pages/widget/amchart/serial.js"></script>
    <script src="<?=base_url('assets')?>/assets/pages/widget/amchart/light.js"></script>
    <script src="<?=base_url('assets')?>/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets')?>/assets/js/SmoothScroll.js"></script>

      <script src="<?=base_url('assets')?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url('assets')?>/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?=base_url('assets')?>/assets/pages/data-table/js/jszip.min.js"></script>
    <script src="<?=base_url('assets')?>/assets/pages/data-table/js/pdfmake.min.js"></script>
    <script src="<?=base_url('assets')?>/assets/pages/data-table/js/vfs_fonts.js"></script>
    <script src="<?=base_url('assets')?>/assets/pages/data-table/extensions/responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?=base_url('assets')?>/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?=base_url('assets')?>/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?=base_url('assets')?>/assets/pages/data-table/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?=base_url('assets')?>/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?=base_url('assets')?>/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>


    <script src="<?=base_url('assets')?>/assets/js/pcoded.min.js"></script>
    <!-- custom js -->

    <script src="<?=base_url('assets')?>/assets/js/vartical-layout.min.js"></script>
   
    <script type="text/javascript" src="<?=base_url('assets')?>/assets/js/script.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets')?>/assets/js/custom.js"></script>
     <script type="text/javascript" src="<?=base_url('assets')?>/assets/js/customaw.js"></script>



    <script type="text/javascript" src="<?=base_url('assets')?>/assets/js/modalEffects.js"></script>
    <script type="text/javascript" src="<?=base_url('assets')?>/assets/js/classie.js"></script>
    

    <script type="text/javascript" src="<?=base_url('assets')?>/assets/pages/j-pro/js/jquery.maskedinput.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets')?>/assets/pages/j-pro/js/jquery.j-pro.js"></script>
    <script type="text/javascript" src="<?=base_url('assets')?>/assets/pages/j-pro/js/autoNumeric.js"></script>
    <script type="text/javascript" src="<?=base_url('assets')?>/assets/pages/j-pro/js/jquery.stepper.min.js"></script>

    
    <script type="text/javascript" src="<?=base_url('assets')?>/assets/pages/sticky/js/trumbowyg.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets')?>/assets/pages/sticky/js/jquery.minicolors.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets')?>/assets/pages/sticky/js/jquery.postitall.js"></script>

    <script src="<?= base_url('assets') ?>/sweetalert2/dist/sweetalert2.min.js"></script>


    <script type="text/javascript" src="<?= base_url('assets') ?>/bower_components/select2/js/select2.full.min.js"></script>
    
    <script type="text/javascript" src="<?= base_url('assets') ?>/bower_components/underscore/js/underscore-min.js"></script>
    <script type="text/javascript" src="<?= base_url('assets') ?>/bower_components/clndr/js/clndr.js"></script>

    <?php if($dataloadweb){ ?>
        <script src="<?=base_url('assets')?>/dataloadweb/<?=$dataloadweb?>"></script>
    <?php } ?>


  

  </body>
</html>
