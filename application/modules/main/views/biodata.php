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

    <link href="<?php echo base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/global/plugins/flat-icon/flaticon.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.dataTables.min.css">
	<link href="https://cdn.datatables.net/rowgroup/1.1.0/css/rowGroup.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="<?php echo base_url(); ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" /> -->

    <link href="<?php echo base_url(); ?>assets/global/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/global/css/open-sans.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo base_url(); ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo base_url(); ?>assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/layouts/layout/css/themes/grey.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="<?php echo base_url(); ?>assets/layouts/layout/css/custom.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/js/magnific-popup/magnific-popup.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/js/alertify/css/alertify.core.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/js/alertify/css/alertify.default.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/js/alertify/css/alertify.bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/apps/css/global.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/js/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />

    <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/jquery-ui/jquery-ui.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/msdropdown-select/js/msdropdown/jquery.dd.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/socket.io.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/notifyjs/notify.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/client.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/moment.min.js" type="text/javascript"></script>

    <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>

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
<?php $readonly ='';
$gambar=base_url().'assets/img/noimage.png';
if($row->status_user==2){
    $gambar = base_url('assets/img/fotoanggota/') . $row->foto;
    $readonly='disabled';
}?>
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
                    <form id="ff" method="post" action="" enctype="multipart/form-data">
                        <div class="form-group" style="padding-top: 10px; padding-left: 10px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="id" class="form-control" value="<?= $row->id; ?>" readonly>

                                    <div class="col-md-4">
                                        <label>NIK :</label>
                                        <input type="text" name="nik" class="form-control" value="<?= $row->nik; ?>" readonly>
                                        <label>Nama Lengkap</label>

                                        <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?= $row->nama; ?>" readonly>

                                        <label>Tempat Lahir</label>

                                        <input type="text" name="tempatlahir" class="form-control" placeholder="Tempat Lahir"value="<?= $row->tempat_lahir; ?>"  required >

                                        <label>Tanggal Lahir</label>
                                        <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                            <input type="text" name="tanggallahir" class="form-control" value="<?= $row->tanggal_lahir; ?>"  readonly>
                                            <span class="input-group-btn">
                                                <button class="btn default" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                        </div>
                                        <label>Pendidikan</label>

                                        <input type="text" name="pendidikan" class="form-control" placeholder="Tempat Lahir" value="<?= $row->pendidikan; ?>"  required>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="col-md-12">
                                            <label>Pekerjaan</label>

                                            <input type="text" name="pekerjaan" class="form-control" placeholder="Tempat Lahir" value="<?= $row->pekerjaan; ?>"  required>
                                            <label>No.hp</label>

                                            <input type="text" name="nohp" class="form-control" placeholder="No Handphone"value="<?= $row->phone; ?>"  required>


                                            <label>Email</label>

                                            <input type="text" name="email" class="form-control" placeholder="Email" required value="<?= $row->email; ?>" >


                                            <label>Alamat</label>

                                            <input type="text" name="alamat" class="form-control" placeholder="Nama" readonly value="<?= $row->alamat; ?>">


                                            <label>Domisili</label>

                                            <input type="text" name="domisili" class="form-control" placeholder="Domisili" value="<?= $row->domisili; ?>"  required>


                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Asal Gereja</label>

                                        <input type="text" name="runggun" class="form-control" value="<?= $row->runggun ?>" readonly>


                                        <label>UserName:</label>

                                        <input type="text" name="username" class="form-control" value="<?= $row->username ?>" placeholder="Nama" readonly>


                                        <label>Jenis Kelamin:</label>
                                        <select class="form-control" id="jk" name="jk">
                                            <option value="">Pilih</option>
                                            <option value="1">Laki-Laki</option>
                                            <option value="2">Wanita</option>
                                        </select>
                                        <label>File (.jpg, .png)</label>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="<?= $gambar; ?>" alt=""> </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                            <div>
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new"> Select image </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" name="image" id="image"> </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                        </div>
                                        <div class="clearfix margin-top-10">
                                            <span class="label label-danger">NOTE!</span> Image preview only works in IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+. In older browsers the filename is shown instead.
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4 pull-right">
                                    <button type="submit" class="btn btn-sm btn-add pull-right" style="    margin-top: 20px;margin-right: 10px;width: 40%;border-radius: 25px !important;background-color: aquamarine;" title="Daftar" <?=$readonly?> > Save & Send</button>
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
    <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/pages/scripts/ui-blockui.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/global/plugins/icheck/icheck.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>

    <script src="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/alertify/js/alertify.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/magnific-popup/magnific-popup.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/echarts/echarts.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/global.js" type="text/javascript"></script> -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.date-picker').datepicker({
                'orientation': 'bottom',
                'format': 'yyyy-mm-dd',
                // autoclose: true
            });
            $('#ff').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '<?php echo base_url(); ?>main/main/action_update',
                    data: new FormData($('form')[0]),
                    type: 'POST',
                    dataType: 'json',
                    processData: false,
                    contentType: false,

                    beforeSend: function() {
                        unBlockUiId('box')
                    },

                    success: function(json) {
                        if (json.code == 1) {
                            toastr.success(json.message, 'Sukses');
                            location.reload(true);
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
    </script>

</body>

</html>