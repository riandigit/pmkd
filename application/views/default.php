<!DOCTYPE html>
<html lang="en">

<style type="text/css">
	.btn-add {
		background-color: #FF9C00 !important;
		color: white !important;
	}

	.portlet.box.blue-madison {
		border: 1px solid #FF9C00 !important;
		border-top: 0;
	}

	.portlet.box.blue-madison>.portlet-title {
		background-color: #FF9C00 !important;
	}

	.portlet>.portlet-body.blue-madison,
	.portlet.blue-madison {
		background-color: #FF9C00 !important;
	}

	.datagrid-header-inner {
		float: left !important;
		width: 100% !important;
		background-color: #FF9C00 !important;
	}

	.portlet-title {
		background-color: #FF9C00 !important;
	}

	.btn-primary {
		color: #fff !important;
		background-color: #FF9C00 !important;
		border-color: #FF9C00 !important;
	}

	.portlet.box.blue {
		border: 1px solid #FF9C00 !important;
		border-top: 0 !important;
	}

	.portlet>.portlet-body.blue,
	.portlet.blue {
		background-color: #FF9C00 !important;
	}
</style>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="PMKD">
	<meta name="author" content="JOSEP">
	<link rel="shortcut icon" type="image/png" href="<?= base_url('assets/img/fav.png'); ?>">

	<title><?php if (isset($title) && $title != '') {
				echo $title . ' - ';
			} ?> PKMD</title>

	<!-- <link href="<?php echo base_url(); ?>assets/pages/css/googletapis.css" rel='stylesheet' type='text/css'> -->

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


	<script type="text/javascript">
		var base_url = '<?php echo base_url(); ?>';

		function date_time(id) {
			date = new Date;
			year = date.getFullYear();
			month = date.getMonth();
			months = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

			d = date.getDate();
			day = date.getDay();
			days = new Array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');

			h = date.getHours();
			if (h < 10) {
				h = "0" + h;
			}

			m = date.getMinutes();
			if (m < 10) {
				m = "0" + m;
			}

			s = date.getSeconds();
			if (s < 10) {
				s = "0" + s;
			}
			result = h + ':' + m + ':' + s + ', ' + d + ' ' + months[month] + ' ' + year;
			document.getElementById(id).innerHTML = result;
			setTimeout('date_time("' + id + '");', '1000');
			return true;
		}
	</script>

</head>

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
	<div class="page-wrapper">
		<div class="page-header navbar navbar-fixed-top">
			<div class="page-header-inner ">
				<div class="page-logo">
					<a href="<?php echo site_url(); ?>" style="line-height: 46px">
						<img src="<?php echo base_url(); ?>assets/img/logo.png" alt="logo" class="logo-default" width="120" />
					</a>
					<div class="menu-toggler sidebar-toggler dropdown-menu-default">
						<span></span>
					</div>
				</div>
				<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> <span></span>
				</a>
				<div class="top-menu">
					<ul class="nav navbar-nav pull-right">
						<li class="dropdown dropdown-user">
							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
								<!-- <img alt="" class="img-circle username-hide-on-mobile" src="<?php echo base_url(); ?>assets/img/icon-person-white.png" /> -->
								<span class="username"> <?php echo $this->session->userdata('username'); ?> </span>
								<i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-default">
								<li>
									<?php $user_id = $this->enc->encode($this->session->userdata('id')); ?>
									<a href="<?php echo site_url('home/profile'); ?>"> <i class="icon-user"></i>
										Profil
									</a>
								</li>
								<li>
									<a href="<?php echo site_url('login/do_logout'); ?>"> <i class="icon-key"></i>
										Keluar
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="page-container">
			<div class="page-sidebar-wrapper">
				<div class="page-sidebar navbar-collapse collapse" style="margin-top: 22px;">
					<?php
					echo listMenu();
					?>
				</div>
			</div>
			<?php //print_r($this->session->userdata()); 
			?>
			<?php echo isset($content) ? $this->load->view($content) : ''; ?>
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
	<script src="<?php echo base_url(); ?>assets/js/global.js" type="text/javascript"></script>
	<?php
	if ($this->uri->segment(1) && $this->uri->segment(2) && $this->uri->segment(3)) {
		if ($this->uri->segment(1) && $this->uri->segment(2) && $this->uri->segment(3) && $this->uri->segment(4)) {
			$slug = site_url($this->uri->segment(1) . '/' . $this->uri->segment(2));
		} else {
			$slug = site_url($this->uri->segment(1));
		}
	} elseif ($this->uri->segment(1) && $this->uri->segment(2)) {
		$slug = site_url($this->uri->segment(1) . '/' . $this->uri->segment(2));
	} else {
		$slug = site_url(uri_string());
	}
	?>

	<script type="text/javascript">
		$(document).ready(function() {
			var c = '<?=$this->session->userdata('group_id'); ?>';

			$.ajax({
				url: "<?= site_url("home/Waiting") ?>",
				type: "post", // To protect sensitive data
				success: function(response) {
					if (c != 3) {
						if (response > 0) {
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: 'Terdapat Anggota baru yang menunggu izin kamu loh!'
							})
						}
					}


				}
			});

			$('ul li a').each(function(e) {
				uri = '<?php echo $slug ?>';
				ahref = $('a[href="' + uri + '"]');
				if (ahref.parents("ul.sub-menu").parent()[0]) {
					span = $(ahref.parents("ul.sub-menu").parent()[0].children[0].children[3]);
					span.addClass('open');
				}

				ahref.parents("ul.sub-menu").parent().addClass("open active");
				ahref.parent("li").addClass('start active open');
			});

			$(".select2").select2();

			var client = new ClientJS(); // Create A New Client Object
			var fingerprint = client.getFingerprint(); // Get Client's Fingerprint

		});
	</script>
</body>

</html>