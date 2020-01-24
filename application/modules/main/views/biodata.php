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
    <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />

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

        .footer {
            background: #152f4f;
            color: white;
        }

        .footer .links ul {
            list-style-type: none;
        }

        .footer .links li a {
            color: white;
            -webkit-transition: color 0.2s;
            transition: color 0.2s;
        }

        .footer .links li a:hover {
            text-decoration: none;
            color: #4180cb;
        }

        .footer .about-company i {
            font-size: 25px;
        }

        .footer .about-company a {
            color: white;
            -webkit-transition: color 0.2s;
            transition: color 0.2s;
        }

        .footer .about-company a:hover {
            color: #4180cb;
        }

        .footer .location i {
            font-size: 18px;
        }

        .footer .copyright p {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .select2-container--default .select2-results__option[aria-disabled=true] {
            display: none;
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
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="page-container">
            <div class="col-md-12">
                <div class="potret body" style="margin-top:25px;background-color: #cccccc63;border-radius:25px !important;padding-bottom: 1px;">
                    <?php echo form_open('main/main/action_update', 'id="ff" autocomplete="off"'); ?>

                    <div class="form-group" style="padding-top: 10px; padding-left: 10px;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <label>NIK :</label>
                                    <div class="input-group center">
                                        <input type="text" name="nik" class="form-control" value="<?= $row->nik; ?>" readonly>
                                    </div>
                                    <label>Nama Lengkap</label>
                                    <div class="input-group">
                                        <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?= $row->nama; ?>" readonly>

                                    </div>
                                    <label>Tempat Lahir</label>
                                    <div class="input-group">
                                        <input type="text" name="tempatlahir" class="form-control" placeholder="Tempat Lahir" required>

                                    </div>
                                    <label>Tanggal Lahir</label>
                                    <div class="input-group">
                                        <input type="text" name="nama" class="form-control" placeholder="Nama" required>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <label>No.hp</label>
                                        <div class="input-group">
                                            <input type="text" name="nohp" class="form-control" placeholder="No Handphone" required>

                                        </div>
                                        <label>Email</label>
                                        <div class="input-group">
                                            <input type="text" name="email" class="form-control" placeholder="Email" required>

                                        </div>
                                        <label>alamat</label>
                                        <div class="input-group">
                                            <input type="text" name="alamat" class="form-control" placeholder="Nama" readonly value="<?= $row->alamat; ?>">

                                        </div>
                                        <label>domisili</label>
                                        <div class="input-group">
                                            <input type="text" name="nama" class="form-control" placeholder="Nama" required>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Asal Gereja</label>
                                    <div class="input-group">
                                        <input type="text" name="runggun" class="form-control" value="<?=$row->runggun?>" readonly>

                                    </div>
                                    <label>UserName:</label>
                                    <div class="input-group">
                                        <input type="text" name="username" class="form-control" value="<?=$row->username?>" placeholder="Nama" readonly>

                                    </div>
                                    <label>Jenis Kelamin:</label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password" required>

                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-sm btn-add pull-right" style="    margin-top: 20px;margin-right: 10px;width: 40%;border-radius: 25px !important;background-color: aquamarine;" title="Daftar"> Daftar</button>
                            </div>
                        </div>

                    </div>
                    <?php echo form_close(); ?>

                </div>
            </div>
        </div>
        <div class="footer" style="margin-top: 25px;padding-top:25px;padding-bottom:25px;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-xs-12 col-sm-5 about-company" style="margin-top:10px;">
                        <img src="<?php echo base_url(); ?>assets/img/footer.jpg" width="120" height="180" alt="logo">
                    </div>
                    <div class="col-lg-3 col-xs-12 col-md-3  col-sm-3 links">
                        <h4 class="mt-lg-0 mt-sm-3">Links</h4>
                        <ul class="m-0 p-0">
                            <li>- <a href="#">Lorem ipsum</a></li>
                            <li>- <a href="#">Nam mauris velit</a></li>
                            <li>- <a href="#">Etiam vitae mauris</a></li>
                            <li>- <a href="#">Fusce scelerisque</a></li>
                            <li>- <a href="#">Sed faucibus</a></li>
                            <li>- <a href="#">Mauris efficitur nulla</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-xs-12 col-md-4  col-sm-4 location">
                        <h4 class="mt-lg-0 mt-sm-4">Location</h4>
                        <p>22, Lorem ipsum dolor, consectetur adipiscing</p>
                        <p class="mb-0"><i class="fa fa-phone mr-3"></i>(541) 754-3010</p>
                        <p><i class="fa fa-envelope-o mr-3"></i>info@hsdf.com</p>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col copyright">
                        <p class=""><small class="text-white-50">© 2019. All Rights Reserved.</small></p>
                    </div>
                </div>
            </div>
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
    <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/global.js" type="text/javascript"></script>
    <!-- <script src="<?php echo base_url() ?>assets/pages/scripts/login-4.min.js" type="text/javascript"></script> -->
    <script type="text/javascript">
        $(document).ready(function() {
            $("#gbkptext").hide();
            $('.select2').select2();
            $('#gbkp').next(".select2-container").hide();
            // validateForm('#ff', function(url, data) {
            //     postData(url, data);
            // });
            validateForm('#ff', function(url, data) {

                if ($('#gbkp').val() == '') {
                    data['gbkp'] = ''
                }
                $.ajax({
                    url: url,
                    data: data,
                    type: 'POST',
                    dataType: 'json',

                    beforeSend: function() {
                        unBlockUiId('box')
                    },

                    success: function(json) {
                        if (json.code == 1) {

                            setTimeout(function() {
                                setTimeout(function() {
                                    window.location.href = "<?= base_url('login') ?>";
                                }, 1);

                            }, 1);
                            toastr.success(json.message, 'Sukses');
                        } else {
                            toastr.error(json.message, 'Gagal');
                            closeModal();

                        }
                    },

                    error: function() {
                        toastr.error('Silahkan Hubungi Administrator', 'Gagal');
                    },

                    complete: function() {
                        $('#box').unblock();
                    }
                });
            });
        });

        function getGbkp(stateID) {

            console.log(stateID);
            if (stateID == 1) {
                $('#gbkp').next(".select2-container").show();
                $("#gbkptext").hide();

                $.ajax({
                    url: '<?php echo site_url() ?>main/main/getGbkp/',
                    type: "GET",
                    dataType: "json",
                    beforeSend: function() {
                        unBlockUiId('box')
                    },
                    success: function(data) {
                        unBlockUiId('box')
                        console.log(data);
                        $('select[name="gbkp"]').empty();
                        $('select[name="gbkp"]').append('<option value="">PILIH</option>');
                        $.each(data, function(key, value) {
                            $('select[name="gbkp"]').append('<option value="' + value.id_seq + '">' + value.name + '</option>');
                        });
                    },
                    error: function() {
                        toastr.error('Silahkan Hubungi Administrator', 'Gagal');
                    },

                    complete: function() {
                        $('#box').unblock();
                    }
                });
            } else if (stateID == 2) {
                $('#gbkptext').show();
                $('#gbkp').next(".select2-container").hide();

            } else {
                $("#gbkptext").hide();
                $('#gbkp').next(".select2-container").hide();

            }
        }
    </script>

</body>

</html>