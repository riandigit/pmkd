<div class="page-content-wrapper">
	<div class="page-content">
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<?php echo '<a href="' . $url_home . '">' . $home . '</a>'; ?>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<span><?php echo $title; ?></span>
				</li>
			</ul>
			<div class="page-toolbar">
				<div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom">
					<span class="thin uppercase hidden-xs" id="datetime"></span>
					<script type="text/javascript">window.onload = date_time('datetime');</script>
				</div>
			</div>
		</div>

		<div class="my-div-body">
			<div class="portlet box blue-madison">
				<div class="portlet-title">
					<div class="caption"><?php echo $title ?></div>
					<div class="pull-right btn-add-padding"><?php echo $btn_add; ?></div>
				</div>

				<div class="portlet-body">
					<div class="table-toolbar">
						<div class="row">
							<div class="col-sm-12">   

							</div>
						</div>
					</div>

					<table class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Golongan</th>
								<th>Panjang Minimal (mm)</th>
								<th>Panjang Maksimal (mm)</th>
								<th>Keterangan</th>
								<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Aksi
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

var table= {
	loadData: function() {
		$('#dataTables').DataTable({
			"ajax": {
				"url": "<?php echo site_url('master/vehicle_class') ?>",
				"type": "POST",
				"data": function(d) {
					// d.customer = document.getElementById('customer').value;
				},
			},

			"serverSide": true,
			"processing": true,
			"columns": [
					{"data": "no", "orderable": false, "className": "text-center"},
					{"data": "vehicle_class_name", "orderable": true, "className": "text-left"},
					{"data": "min_length", "orderable": true, "className": "text-right"},
					{"data": "max_length", "orderable": true, "className": "text-right"},
					{"data": "desc", "orderable": true, "className": "text-left"},
					{"data": "actions", "orderable": false, "className": "text-center"},
			],
			"lengthMenu": [
				[10, 25, 50, 100],
				[10, 25, 50, 100]
			],
			"pageLength": 10,
			"pagingType": "bootstrap_full_number",
			"order": [[ 0, "desc" ]],
			"initComplete": function () {
				var $searchInput = $('div.dataTables_filter input');
				var data_tables = $('#dataTables').DataTable();
				$searchInput.unbind();
				$searchInput.bind('keyup', function (e) {
					if (e.keyCode == 13 || e.whiche == 13) {
						data_tables.search(this.value).draw();
					}
				});
			},
		});

		$('#export_tools > li > a.tool-action').on('click', function() {
			var data_tables = $('#dataTables').DataTable();
			var action = $(this).attr('data-action');

			data_tables.button(action).trigger();
		});
	},

	reload: function() {
		$('#dataTables').DataTable().ajax.reload();
	},

	init: function() {
		if (!jQuery().DataTable) {
			return;
		}

		this.loadData();
	}
};
	
	jQuery(document).ready(function () {
		table.init();

		$("#customer").on("change",function(){
			table.reload();
		});

	});

</script>