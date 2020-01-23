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
					<table class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th>NO</th>
								<th>NAMA</th>
								<th> &nbsp;&nbsp;
                                AKSI
                                &nbsp;&nbsp;</th>
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
				"url": "<?php echo site_url('master/device_type') ?>",
				"type": "POST",
				"data": function(d) {
					// d.name = document.getElementById('name').value;
				},
			},

			"serverSide": true,
			"processing": true,
			"columns": [
				{"data": "no", "orderable": false, "className": "text-center"},
				{"data": "name", "orderable": false, "className": "text-left"},
				{"data": "actions", "orderable": false, "className": "text-center"},
			],
			"lengthMenu": [
				[10, 25, 50, 100],
				[10, 25, 50, 100]
			],
			"language": {
					"aria": {
						"sortAscending": ": activate to sort column ascending",
						"sortDescending": ": activate to sort column descending"
					},
					"processing": "Proses.....",
					"emptyTable": "Tidak ada data",
					"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
					"infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
					"infoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
					"lengthMenu": " _MENU_",
					"search": "Pencarian :",
					"zeroRecords": "Tidak ditemukan data yang sesuai",
					"paginate": {
						"previous": "Sebelumnya",
						"next": "Selanjutnya",
						"last": "Terakhir",
						"first": "Pertama"
					}
				},
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
	});

</script>