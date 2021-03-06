<div class="col-md-12">
    <div class="portlet box blue" id="box">
        <?php echo headerForm($title) ?>
        <div class="portlet-body">

            <form id="ff" method="post" action="" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>NIK:</label>
                                        <input type="text" class="form-control" autocomplete="off" placeholder="Nama" name="nik" id="nik" required>
                                        <!-- <span class="help-block"><b>* serial will be generated automatically</b></span> -->
                                    </div>
                                    <div class="form-group">
                                        <label>Nama:</label>
                                        <input type="text" class="form-control" autocomplete="off" placeholder="Nama" name="nama" id="nama" required>
                                        <!-- <span class="help-block"><b>* serial will be generated automatically</b></span> -->
                                    </div>
                                    <div class="form-group">
                                        <label>Tempat Lahir:</label>
                                        <input type="text" class="form-control" autocomplete="off" placeholder="Tempat Lahir" name="tempatlahir" id="tempatlahir" required>
                                        <!-- <span class="help-block"><b>* serial will be generated automatically</b></span> -->
                                    </div>
                                    <label>Tanggal Lahir</label>
                                    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                        <input type="text" name="tanggallahir" class="form-control">
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat:</label>
                                        <input type="text" class="form-control" autocomplete="off" placeholder="Alamat" name="alamat" id="alamat" required>
                                        <!-- <span class="help-block"><b>* serial will be generated automatically</b></span> -->
                                    </div>
                                    <div class="form-group">
                                        <label>Domisili:</label>
                                        <input type="text" class="form-control" autocomplete="off" placeholder="Domisili" name="domisili" id="domisili" required>
                                        <!-- <span class="help-block"><b>* serial will be generated automatically</b></span> -->
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pendidikan:</label>
                                        <select class="form-control  select2" id="pendidikan" style="width: 100%" name="pendidikan">
                                            <option value="">Pilih</option>
                                            <?php foreach ($pendidikan as $key => $value) { ?>
                                                <option value="<?php echo $this->enc->encode($value->id_seq) ?>">
                                                    <?php echo $value->nama ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Pekerjaan:</label>
                                        <select class="form-control  select2" id="pekerjaan" style="width: 100%" name="pekerjaan">
                                            <option value="">Pilih</option>
                                            <?php foreach ($pekerjaan as $key => $value) { ?>
                                                <option value="<?php echo $this->enc->encode($value->id_seq) ?>">
                                                    <?php echo $value->nama ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin:</label>
                                        <select class="form-control" id="jk" name="jk">
                                            <option value="">Pilih</option>
                                            <option value="1">Laki-Laki</option>
                                            <option value="2">Wanita</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Asal Gereja:</label>
                                        <select class="form-control  select2" id="gbkp" name="gbkp">
                                            <option value="">Pilih</option>
                                            <?php foreach ($gbkp as $key => $value) { ?>
                                                <option value="<?php echo $this->enc->encode($value->id_seq) ?>">
                                                    <?php echo $value->nama ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>No Hp:</label>
                                        <input type="text" class="form-control" autocomplete="off" placeholder="No Handphone" name="hp" id="hp" required>
                                        <!-- <span class="help-block"><b>* serial will be generated automatically</b></span> -->
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input type="text" class="form-control" autocomplete="off" placeholder="Email" name="email" id="email" required>
                                        <!-- <span class="help-block"><b>* serial will be generated automatically</b></span> -->
                                    </div>
                                    <div class="form-group">
                                        <label>Username:</label>
                                        <input type="text" class="form-control" autocomplete="off" placeholder="Email" name="username" id="username" required>
                                        <!-- <span class="help-block"><b>* serial will be generated automatically</b></span> -->
                                    </div>
                                    <div class="form-group">
                                        <label>Password:</label>
                                        <input type="text" class="form-control" autocomplete="off" placeholder="Password" name="password" id="password" required>
                                        <label>Keanggotaan:</label>
                                        <select class="form-control" id="anggota" name="anggota">
                                            <option value="">Pilih</option>
                                            <option value="AKTIF">AKTIF</option>
                                            <option value="TIDAK AKTIF">TIDAK AKTIF</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <?php echo createBtnForm('Save') ?>
                <?php echo form_close(); ?>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.date-picker').datepicker({
            'orientation': 'bottom',
            'format': 'yyyy-mm-dd',
            // autoclose: true
        });
        $('.select2').select2();

        $('#ff').submit(function(e) {
            e.preventDefault();
            console.log('ok');
            // postData(url, data);
            $.ajax({
                url: '<?php echo base_url(); ?>pengurus/runggun/saveRunggun',
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
                        // unblockID('#form_edit');
                        closeModal();
                        toastr.success(json.message, 'Sukses');

                        $('#dataTables').DataTable().ajax.reload(null, false);
                    } else {
                        toastr.error(json.message, 'Gagal');
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
    })
</script>