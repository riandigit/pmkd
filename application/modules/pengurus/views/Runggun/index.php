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
                    <script type="text/javascript">
                        window.onload = date_time('datetime');
                    </script>
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
                    <table class="table table-bordered table-hover" id="dataTables">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Pendidikan</th>
                                <th>Pekerjaan</th>
                                <th>Asal Gereja</th>
                                <th>Alamat</th>
                                <th>Domisili</th>
                                <th>Keanggotaan</th>
                                <th>Jenis Kelamin</th>
                                <th>NO HP</th>
                                <th>Email</th>
                                <th>Status Anggota</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tfood></tfood>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var TableDatatablesManaged = function() {

        var initTable1 = function() {

            var table = $('#dataTables');

            // begin first table
            table.dataTable({
                "ajax": {
                    "url": "<?php echo site_url('Pengurus/runggun/Runggunlist') ?>",
                    "type": "POST",
                    "data": function(d) {},
                },
                "serverSide": true,
                "processing": true,
                "columns": [{
                        "data": "no",
                        "orderable": true,
                        "className": "text-center",
                        "width": 20
                    },
                    {
                        "data": "nik",
                        "orderable": true
                    },
                    {
                        "data": "nama",
                        "orderable": true
                    },
                    {
                        "data": "tempat_lahir",
                        "orderable": true
                    },
                    {
                        "data": "tanggal_lahir",
                        "orderable": true
                    },
                    {
                        "data": "nmpendidikan",
                        "orderable": true
                    },
                    {
                        "data": "nmpekerjaan",
                        "orderable": true
                    },
                    {
                        "data": "gereja",
                        "orderable": true
                    },
                    {
                        "data": "alamat",
                        "orderable": true
                    },
                    {
                        "data": "domisili",
                        "orderable": true
                    },
                    {
                        "data": "keanggotaan",
                        "orderable": true
                    },
                    {
                        "data": "jk",
                        "orderable": true
                    },
                    {
                        "data": "phone",
                        "orderable": true
                    },
                    {
                        "data": "email",
                        "orderable": true
                    },
                    {
                        "data": "status_anggota",
                        "orderable": true
                    },
                    {
                        "data": "action",
                        "orderable": false,
                        "className": "text-center",
                        "width": 100
                    }
                ],

                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
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

                // "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [10, 15, 25, -1],
                    [10, 15, 25, "All"] // change per page values here
                ],
                // set the initial value
                "pageLength": 10,
                "pagingType": "bootstrap_full_number",
                "columnDefs": [{ // set default column settings
                        'orderable': true,
                        'targets': [0]
                    },
                    {
                        "searchable": true,
                        "targets": [1]
                    },
                    {
                        "searchable": true,
                        "targets": [1]
                    },
                    {
                        "searchable": true,
                        "targets": [1]
                    },
                    {
                        "searchable": true,
                        "targets": [1]
                    },
                    {
                        "searchable": true,
                        "targets": [1]
                    },
                    {
                        "searchable": true,
                        "targets": [1]
                    },
                    {
                        "searchable": true,
                        "targets": [1]
                    },
                    {
                        "searchable": true,
                        "targets": [1]
                    },
                    {
                        "searchable": true,
                        "targets": [1]
                    },
                    {
                        "searchable": true,
                        "targets": [1]
                    },
                    {
                        "searchable": true,
                        "targets": [1]
                    },
                    {
                        "searchable": true,
                        "targets": [1]
                    },
                    {
                        "searchable": true,
                        "targets": [1]
                    },
                    {
                        "searchable": true,
                        "targets": [1]
                    },
                    {
                        'orderable': false,

                        // "targets": [1],
                        render: $.fn.dataTable.render.text()
                    }
                ],
                "order": [
                    [0, "asc"]
                ], // set first column as a default sort by asc

                // users keypress on search data
                "initComplete": function() {
                    var $searchInput = $('div.dataTables_filter input');
                    var data_tables = $('#dataTables').DataTable();
                    $searchInput.unbind();
                    $searchInput.bind('keyup', function(e) {
                        if (e.keyCode == 13) {
                            data_tables.search(this.value).draw();
                        }
                    });
                },
            });
        }

        return {

            //main function to initiate the module
            init: function() {
                if (!jQuery().dataTable) {
                    return;
                }

                initTable1();
            }

        };

    }();

    //if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        TableDatatablesManaged.init();
    });
    //}
</script>