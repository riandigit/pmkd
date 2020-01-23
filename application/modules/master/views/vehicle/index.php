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
							<div class="col-sm-12 form-inline">

								<div class="input-group select2-bootstrap-prepend">
									<div class="input-group-addon">Customer</div>
									<select id="customer" class="form-control js-data-example-ajax select2 input-small" dir="" name="customer">
										<option value="">All</option>
										<?php foreach($customer as $key=>$value ) {?>
										<option value="<?php echo $this->enc->encode($value->customer_id); ?>"><?php echo strtoupper($value->first_name . " " . $value->last_name) ?></option>
										<?php } ?>
									</select>
								</div>        

							</div>
						</div>
					</div>

					<table class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th>NO</th>
								<th>PLAT NUMBER</th>
								<th>STNK</th>
								<th>BRAND</th>
								<th>COLOR</th>
								<th>YEAR</th>
								<th>CYLINDER</th>
								<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CLASS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th>CUSTOMER</th>
								<th>OWNER NAME</th>
								<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                ACTION
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
				"url": "<?php echo site_url('master/vehicle') ?>",
				"type": "POST",
				"data": function(d) {
					d.customer = document.getElementById('customer').value;
				},
			},

			"serverSide": true,
			"processing": true,
			"columns": [
					{"data": "no", "orderable": false, "className": "text-center"},
					{"data": "plate_number", "orderable": true, "className": "text-left"},
					{"data": "stnk", "orderable": true, "className": "text-left"},
					{"data": "vehicle_brand", "orderable": true, "className": "text-left"},
					{"data": "vehicle_color", "orderable": true, "className": "text-left"},
					{"data": "manufacture_year", "orderable": true, "className": "text-left"},
					{"data": "vehicle_cylinder", "orderable": true, "className": "text-left"},
					{"data": "vehicle_class_name", "orderable": true, "className": "text-left"},
					{"data": "customer_name", "orderable": true, "className": "text-left"},
					{"data": "owner_name", "orderable": true, "className": "text-left"},
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