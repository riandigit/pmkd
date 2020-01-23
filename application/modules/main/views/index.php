<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8">
    <title>PMKD</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="anggota pmkd">
    <meta name="author" content="josep">
    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/img/fav.png'); ?>">

    <link href="<?php echo base_url() ?>assets/pages/css/googletapis.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/layouts/layout/css/custom.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo base_url() ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo base_url() ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo base_url() ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />

    <!-- <link href="<?php echo base_url() ?>assets/pages/css/login-4.min.css" rel="stylesheet" type="text/css" /> -->

    <style>
        @media (max-width: 480px) {
            .login .content {
                width: 298px !important;
            }

        }
    </style>

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
    <div class="page-wrapper">
        <div class="page-header navbar navbar-fixed-top" style="background-color: #3B5998;">
            <div class="page-header-inner ">
                <div class="page-logo">
                    <a href="<?php echo site_url(); ?>">
                        <img src="<?php echo base_url(); ?>assets/img/logo.png" alt="logo" class="logo-default" width="120" />
                    </a>
                    <!-- <div class="menu-toggler sidebar-toggler dropdown-menu-default">
                        <span></span>
                    </div> -->
                </div>
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> <span></span>
                </a>
                <div class="top-menu">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="<?=base_url('login');?>"  >LOGIN</span>
                                <!-- <i class="fa fa-angle-down"></i> -->
                            </a>
                        </li>
                    </ul>
                </div>
            </div> 
        </div>
        <div class="clearfix"></div>
        <div class="page-container">
            <!-- <div class='row'> -->
            <div class="col-md-12">
                <div class="content center" style=" margin-top:20px;">
                    <div class="col-md-4 col-sm-4 col-xs-4" style="background-color: #80808012; margin-right:4 px; border-radius:25px !important; height:320px;">
                        <h3>
                            VISI
                        </h3>
                        <p style="color: #0f4e03!important;">
                            “<b>1 Korintus 3:9 dan 1 Petrus 2:9-10 :</b><br>
                            Menjadi kawan sekerja Allah untuk menyatakan rahmat Allah kepada dunia.
                            Dalam bahasa inggris : <i> to be God’s fellow-workers to manifest God’s mercy to the world </i> , dan didalam Bahasa Karo diartikan <i> Aron Diiata guna jadi pasu-pasu man isi doni.</i>”
                        </p>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4" style="background-color: #80808012; margin-right:4 px;border-radius:25px !important;height:320px;">
                        <img src="<?php echo base_url(); ?>assets/img/logo-permata-gbkp-baru.png" alt="logo" class="center" style=" margin-top:10px; display: block;margin-left: auto;  margin-right: auto;width: 50%;" />
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4" style="background-color: #80808012;border-radius:25px !important;margin-right:4 px;height:320px;">
                        <h3>Misi</h3>
                        <p style="color: #0f4e03!important;">
                            1.Mengembangkan spiritual jemaat berbasis Alkitab<br>
                            2.Mempererat persaudaraan PERMATA GBKP yang saling menopang dan membangun<br>
                            3.Memperkokoh sinergi jaringan ORGANISASI PERMATA GBKP<br>
                            4.Menggali dan mengembangkan potensi PERMATA GBKP<br>
                            5.Meningkatkan rasa kemanusiaan dan keutuhan ciptaan Allah<br>
                        </p>
                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div>
    </div>
    <script src="<?php echo base_url() ?>assets/global/plugins/respond.min.js"></script>
    <script src="<?php echo base_url() ?>assets/global/plugins/excanvas.min.js"></script>
    <!-- BEGIN CORE PLUGINS -->
    <script src="<?php echo base_url() ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <!-- <script src="<?php echo base_url() ?>assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script> -->
    <script src="<?php echo base_url() ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- <script src="<?php echo base_url() ?>assets/pages/scripts/login-4.min.js" type="text/javascript"></script> -->

</body>

</html>