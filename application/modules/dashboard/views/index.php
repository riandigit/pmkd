<div class="page-content-wrapper">
	<div class="page-content">
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<?php echo '<a href="' . $url_home . '">' . $home; ?></a>
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
			<br>
			<div class="row">
				<div class="col-lg-3">
					<a class="dashboard-stat dashboard-stat-v2 blue" href="javascript:;">
						<div class="visual">
							<i class="fa fa-desktop"></i>
						</div>
						<div class="details">
							<div class="number">
								<span data-counter="counterup" id="total_obu">
									0
								</span>
							</div>
							<div class="desc"> Total Obu </div>
						</div>
					</a>
				</div>

				<div class="col-lg-3">
					<a class="dashboard-stat dashboard-stat-v2 green" href="javascript:;">
						<div class="visual">
							<i class="fa fa-car"></i>
						</div>
						<div class="details">
							<div class="number">
								<span data-counter="counterup" id="total_paired">
									0
								</span>
							</div>
							<div class="desc"> Obu Terpasang </div>
						</div>
					</a>
				</div>

				<div class="col-lg-3">
					<a class="dashboard-stat dashboard-stat-v2 red" href="javascript:;">
						<div class="visual">
							<i class="fa fa-desktop"></i>
						</div>
						<div class="details">
							<div class="number">
								<span data-counter="counterup" id="obu_reject">
									0
								</span>
							</div>
							<div class="desc"> Obu Reject</div>
						</div>
					</a>
				</div>

				<div class="col-lg-3">
					<a class="dashboard-stat dashboard-stat-v2 purple" href="javascript:;">
						<div class="visual">
							<i class="fa fa-shopping-cart"></i>
						</div>
						<div class="details">
							<div class="number">
								<span data-counter="counterup" id="request_order">
									0
								</span>
							</div>
							<div class="desc"> Permintaan Order </div>
						</div>
					</a>
				</div>
			</div>
	  
		</div>

		<div class="my-div-body">
			<div class="portlet box blue-madison">
				<div class="portlet-title">
					<div class="caption"><?php echo $title ?></div>
				</div>

				<div class="portlet-body">
					<div class="table-toolbar">
						<div class="row">
							<div class="col-sm-12 form-inline">

								     

							</div>
						</div>
					</div>

					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="dataTables">
						<thead>
							<tr>
								<th>NO</th>
								<th>NAMA PLAZA</th>
								<th>OBU TERSEDIA</th>
								<th>OBU TERPASANG</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<style type="text/css">
	.padding-title-chart{
		padding: 5px 10px 0px 5px !important;
	}

	.padding-body{
		padding: 0px 5px 0px 20px !important;
	}
</style>
<script type="text/javascript">

	var table= {
	loadData: function() {
		$('#dataTables').DataTable({
			"ajax": {
				"url": "<?php echo site_url('dashboard') ?>",
				"type": "POST",
				"data": function(d) {
					// d.operator = document.getElementById('operator').value;
				},
			},

			"serverSide": true,
			"processing": true,
			"columns": [
					{"data": "number", "orderable": false, "className": "text-center" , "width": 5},
					{"data": "plaza_name", "orderable": true, "className": "text-left"},
					{"data": "avail_obu", "orderable": true, "className": "text-right"},
					{"data": "paired_obu", "orderable": true, "className": "text-right"},
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

		$("#operator").on("change",function(){
			table.reload();
		});

	});

	function addCommas(nStr){
		nStr += '';
		x = nStr.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + '.' + '$2');
		}

		return x1 + x2;
	}

	var ticket_chart;
	function Tickets(data){
		require.config({
			paths: {
				echarts: 'assets/global/plugins/echarts/',
			}
		});

		require(
			[
			'echarts',
			'echarts/chart/pie',
			],

			function(ec) {
				var name = 'Type'
				ticket_chart = ec.init(document.getElementById(data.id));
				var ticket_chart_options = {
					tooltip: {
						trigger: 'item',
						formatter: function (params, ticket, callback) {
							html  = params[0]+'<br>';
							html += params[1]+' :<br>'+addCommas(params[2]);

							return html;
						}
					},
					legend: {
						show: true,
						x: 'left',
						y: 'center',
						orient: 'vertical',
						data: data.data.ticket
					},
					color: data.color,
					toolbox: {
						show: true,
						feature: {
							mark: {
								show: false
							},
							dataView: {
								show: false,
								readOnly: false
							},
							restore: {
								show: false
							},
							saveAsImage: {
								show: true
							}
						}
					},
					calculable: false,
					series: [
					{
						name: name,
						type: 'pie',
						center: ['50%','50%'],
						radius: '80%',
						itemStyle: {
							normal: {
								label: {                                
									formatter: function(params) {
										return params.name
									}
								},
							},
						},
						data: data.data.total
					}]
				};

				ticket_chart.setOption(ticket_chart_options);

				$(".menu-toggler").click(function() {
					ticket_chart.resize();
				});

				$(window).resize(function(){
					ticket_chart.resize();
				});
			}
			);
	}

	var daysChart;
	function daysCharts(data){
		require.config({
			paths: {
				echarts: 'assets/global/plugins/echarts/',
			}
		});

		require(
			[
			'echarts',
			'echarts/chart/bar',
			],
			function(ec) {
				daysChart = ec.init(document.getElementById('daysChart'));
				var daysChart_options = {
					tooltip: {
						trigger: 'axis',
						formatter: function (params, ticket, callback) {
							html = params[0][1]+' :<br>'+addCommas(params[0].data);

							return html;
						}
					},
					title: {
						text: 'Go Show & Online',
						subtext: '',
						x: 'center'
					},
					grid: {
						x: 50,
						x2: 25,
						y: 45,
						y2: 60,
					},
					toolbox: {
						show: true,
						feature: {
							mark: {
								show: false
							},
							dataView: {
								show: false,
								readOnly: false
							},
							magicType: {
								show: false,
								type: ['line', 'bar']
							},
							restore: {
								show: false
							},
							saveAsImage: {
								show: true
							}
						}
					},
					calculable: false,
					xAxis: [{
						type: 'category',
						data: data.date,
			// axisLabel:{
			//   rotate:16
			// }
		}],
		yAxis: [{
			type: 'value',
			name: 'Total',
			splitArea: {
				show: true
			},
			axisLabel : {
				formatter: function(params){
					return addCommas(params)
				}
			},
		}],
		series: [{
			type: 'bar',
			data: data.total,
			// itemStyle: {
			//   normal: {
			//     color: function(params) {
			//       var colorList = [
			//       '#4B77BE','#32C5D2','#26C281','#E7505A','#C49F47',
			//       '#E87E04','#C8D046','#9A12B3','#F3C200','#95A5A6',
			//       '#D7504B','#C6E579','#F4E001','#F0805A','#26C0C0'
			//       ];
			//       return colorList[params.dataIndex]
			//     },
			//     label: {
			//       show: true,
			//       position: 'top',
			//       formatter: function(params){
			//         return addCommas(params.data)
			//       }
			//     }
			//   }
			// },
		}]
	};

	daysChart.setOption(daysChart_options);

	$(".menu-toggler").click(function() {
		daysChart.resize();
	});

	$(window).resize(function(){
		daysChart.resize();
	});
}
);
	}

	$(document).ready(function() {
		setTimeout(function(){
			$('.select2').select2();
		},1);

		$(".menu-toggler").click(function() {
			$('.select2').css('width', '100%');
		});

		$('#date').datepicker({
			format: 'yyyy-mm-dd',
			changeMonth: true,
			changeYear: true,
			autoclose: true,
			endDate: new Date(),
		}).on('changeDate',function(e) {

		});

		$('#date2').datepicker({
			format: 'yyyy-mm-dd',
			changeMonth: true,
			changeYear: true,
			autoclose: true,
			endDate: new Date(),
		}).on('changeDate',function(e) {
			$('#date').datepicker('setEndDate', e.date);
		});

		point = 3;
		height = window.screen.availHeight / point;

		$('.height-chart').css('height',height+'px');

		$(window).resize(function(){
			height     = window.screen.availHeight / point;
			$('.height-chart').css('height',height+'px');
		});

		var listDashboard = function(){
			$.ajax({
				url         : 'dashboard/listDashboard',
				data        : {
					date: $('#date').val(),
					date2: $('#date2').val(),
					origin: $('#origin').val()
				},
				type        : 'POST',
				dataType    : 'json',

				beforeSend: function(){
					$('.block-ui').block({
						message: '<h4><i class="fa fa-spinner fa-spin"></i> Loading</h4>',
						css: { 
							padding:        0, 
							margin:         0, 
							width:          '120px', 
							top:            '40%', 
							left:           '40%', 
							textAlign:      'center', 
							color:          '#000', 
							border:         '0px solid #aaa', 
							backgroundColor:'#fff', 
							cursor:         'wait' 
						},
						centerX: false, 
						centerY: false,
						overlayCSS:  { 
							backgroundColor: '#000', 
							opacity:         0.2, 
							cursor:          'wait' 
						},
					});

					$('#searching').button('loading');
				},

				success: function(data) {
		  // console.log(data)
		  if(data.code == 1){
			d = data.data;

			$('#total_obu').html(addCommas(d.total_obu));
			$('#total_paired').html(addCommas(d.total_paired));
			$('#obu_reject').html(addCommas(d.obu_reject));
			$('#request_order').html(addCommas(d.request_order));

			Tickets({
				id: 'volTicket',
				data : d.volume_ticket,
				color : ['#FFD700','#0073c8']
			});

			Tickets({
				id: 'revTicket',
				data : d.revenue_ticket,
				color : ['#FFA500','#000080']
			});

			daysCharts(d.days)
		  }else{
			toastr.error(d.message, 'Gagal')
		  }
		},

		error: function() {
			console.log('Please contact the administrator');
		},

		complete: function(){
			$('.block-ui').unblock(); 
			$('#searching').button('reset');
		}
	})

	  // .done(

	  // setTime = setTimeout(function(){
	  //   listDashboard()
	  // }, 60000)

	  // );  
	}

	listDashboard();

	// $('#date').change(function(){
	//   clearTimeout(setTime)
	//   listDashboard();
	// });

	// $('#date2').change(function(){
	//   clearTimeout(setTime)
	//   listDashboard();
	// });

	// $('#origin').change(function(){
	//   clearTimeout(setTime)
	//   listDashboard();
	// })

	$('#searching').click(function(){
	  // clearTimeout(setTime)
	  listDashboard();
	});
});
</script>