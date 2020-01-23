function showModal(url) {
	$.magnificPopup.open({
		items: {
			src: url
		},
		modal: true,
		type: 'ajax',
		tLoading: '<i class="fa fa-refresh fa-spin"></i> Please wait...',
		showCloseBtn: false,
	});
}

function closeModal() {
	
	localStorage.removeItem("dataSet");

	// console.log('ok')
	localStorage.removeItem("dataSetfare");
	$.magnificPopup.close();
}

function getFormData(form){
	var unindexed_array = form.serializeArray();
	var indexed_array = {};

	$.map(unindexed_array, function(n, i){
		indexed_array[n['name']] = n['value'];
	});

	return indexed_array;
}

rules	= {};
messages= {};

function validateForm(id,callback){
	$(id).validate({
		ignore      : 'input[type=hidden], .select2-search__field', 
		errorClass  : 'validation-error-label',
		successClass: 'validation-valid-label',
		rules   	: rules,
		messages	: messages,

		highlight   : function(element, errorClass) {
			$(element).addClass('val-error');
		},

		unhighlight : function(element, errorClass) {
			$(element).removeClass('val-error');
		},

		errorPlacement: function(error, element) {
			if (element.parents('div').hasClass('has-feedback')) {
				error.appendTo( element.parent() );
			}

			else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
				error.appendTo( element.parent() );
			}

			else {
				error.insertAfter(element);
			}
		},

		submitHandler: function(form) {
			if(typeof callback != 'undefined' && typeof callback == 'function') {
				callback(form.action,getFormData($(form)));
			}
		}
	});
}
function settingDefaultDatatable(){
	$.extend($.fn.dataTable.defaults, {
		'processing': true,
		'serverSide': true,
		'ordering': true,
		"lengthMenu": [
			[5, 10, 20, 50, 100, -1],
			[5, 10, 20, 50, 100, "All"]
		],
		'pageLength': 10,
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
		  // users keypress on search data
		  "initComplete": function() {
			  var $searchInput = $('div.dataTables_filter input');
			  var data_tables = $('#dataTables').DataTable();
			  $searchInput.unbind();
			  $searchInput.bind('keyup', function(e) {
				  if (e.keyCode == 13 || e.whiche == 13) {
					console.log(e);
					  data_tables.search(this.value).draw();
				  }
			  });
		  },
	  });
}
function unBlockUiId(id){
	$('#'+id).block({
		message: '<h4><i class="fa fa-spinner fa-spin"></i> Loading</h4>',
	});
}

function notification8(message,heading){
	theme = 'teal';
	if(heading.toUpperCase() == 'GAGAL'){
		theme = 'smoke';
	}

	$.notific8(message, {
		life: 5000,
		heading: heading,
		theme: theme,
		horizontalEdge: 'bottom',
		verticalEdge: 'right',
		zindex: 1500
	});
}

function postData(url,data,y){
	$.ajax({
		url         : url,
		data        : data,
		type        : 'POST',
		dataType    : 'json',

		beforeSend: function(){
			unBlockUiId('box')
		},

		success: function(json) {
			if(json.code == 1){
				closeModal();
				toastr.success(json.message, 'Success');
				if(y){
					$('#grid').treegrid('reload');
				} else {
					$('#dataTables').DataTable().ajax.reload( null, false );
				}
			} else {
				toastr.error(json.message, 'Failed');
			}
		},

		error: function() {
			toastr.error('Please Contact Administrator', 'Failed');
		},

		complete: function(){
			$('#box').unblock(); 
		}
	});
}

function confirmationAction(message,url){
	alertify.confirm(message, function (e) {
		if(e){
			returnConfirmation(url)
		}
	});
}

function delete_menu(message,url){
	alertify.confirm(message, function (e) {
		if(e){
			$.ajax({
				url     : url,
				type    : 'GET',
				dataType: 'json',

				beforeSend: function(){
					$.blockUI({message: '<h4><i class="fa fa-spinner fa-spin"></i> Loading</h4>'});
				},

				success: function(json) {
					if(json.code == 1){
						toastr.success(json.message, 'Success');
						$('#grid').treegrid('reload');
					}else{
						toastr.error(json.message, 'Failed');
					}
				},

				error: function() {
					toastr.error('Please Contact Administrator', 'Failed');
				},

				complete: function(){
					$.unblockUI();
				}
			});
		}
	});
}

function returnConfirmation(url){
	$.ajax({
		url         : url,
		type        : 'GET',
		dataType    : 'json',

		beforeSend: function(){
			$.blockUI({message: '<h4><i class="fa fa-spinner fa-spin"></i> Loading</h4>'});
		},

		success: function(json) {
			if(json.code == 1){
				toastr.success(json.message, 'Success');
				$('#dataTables').DataTable().ajax.reload(null, false );
			}else{
				toastr.error(json.message, 'Failed');
			}
		},

		error: function() {
			toastr.error('Please Contact Administrator', 'Failed');
		},

		complete: function(){
			$.unblockUI();
		}
	});
}

function validatorPassword(){
	$.validator.addMethod('password', function (value) { 
		return /(?=^.{7,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/.test(value); 
	}, 'Minimal 7 karakter, 1 angka, 1 huruf kecil dan 1 huruf kapital');
}

function formatIDR(angka) {
	var reverse = angka.toString().split('').reverse().join(''),
	ribuan = reverse.match(/\d{1,3}/g);
	ribuan = ribuan.join('.').split('').reverse().join('');

	return ribuan;
}

function formatRupiah(angka, prefix){
	var number_string = (angka + '').replace(/[^,\d]/g, '').toString(),
	split    = number_string.split(','),
	sisa     = split[0].length % 3,
	rupiah   = split[0].substr(0, sisa),
	ribuan   = split[0].substr(sisa).match(/\d{3}/gi);

	if (ribuan) {
		separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}

	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

function removeRupiah(str){
	return str.split('.').join('');
}

function isNumberKey(evt){
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	return true;
}

function iconFormat(icon) {
	return "<i class='fa fa-" + icon.text + "'></i> " + icon.text;
}

function number_format(num){
	if(num == null || num == 'undefined'){
		return 0;
	}else{
		return num.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");        
	}
}

// from ejohn.org/blog/javascript-pretty-date/
function pretty(timestamp){
    var date = new Date(parseInt(timestamp, 10)),
    diff = (((new Date()).getTime() - date.getTime()) / 1000),
    day_diff = Math.floor(diff / 86400);
    if ( isNaN(day_diff) || day_diff < 0 || day_diff >= 31 ) return;
    return day_diff == 0 && (
        diff < 60 && "Baru saja" ||
        diff < 120 && "1m" ||
        diff < 3600 && Math.floor( diff / 60 ) + "m" ||
        diff < 7200 && "1h" ||
        diff < 86400 && Math.floor( diff / 3600 ) + "j") ||
    day_diff == 1 && "1d" ||
    day_diff < 7 && day_diff + "d" ||
    day_diff < 31 && Math.ceil( day_diff / 7 ) + "minggu";
}

function notifSound() {
    var audio = new Audio('../assets/sounds/quite-impressed.mp3');
    audio.loop = false;
    audio.play(); 
}