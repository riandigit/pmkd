<div class="col-md-12">
    <div class="portlet box blue" id="box">
        <?php echo headerForm($title) ?>
        <div class="portlet-body">

            <form id="ff" method="post" action="" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                            <input type="hidden" name="id" class="form-control" value="<?= $row->id; ?>" readonly>
                            <input type="hidden" name="logolama" class="form-control" value="<?= $row->foto; ?>" readonly>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>NIK:</label>
                                        <input type="text" class="form-control" autocomplete="off" placeholder="Nama" name="nik" id="nik" value="<?=$row->nik?>"required>
                                        <!-- <span class="help-block"><b>* serial will be generated automatically</b></span> -->
                                    </div>
                                    <div class="form-group">
                                        <label>Nama:</label>
                                        <input type="text" class="form-control" autocomplete="off" placeholder="Nama" name="nama" value="<?=$row->nama?>" id="nama" required>
                                        <!-- <span class="help-block"><b>* serial will be generated automatically</b></span> -->
                                    </div>
                                    <div class="form-group">
                                        <label>Tempat Lahir:</label>
                                        <input type="text" class="form-control" autocomplete="off" placeholder="Tempat Lahir" name="tempatlahir"value="<?=$row->tempat_lahir?>" id="tempatlahir" required>
                                        <!-- <span class="help-block"><b>* serial will be generated automatically</b></span> -->
                                    </div>
                                    <label>Tanggal Lahir</label>
                                        <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                            <input type="text" name="tanggallahir" value="<?=$row->tanggal_lahir?>"class="form-control">
                                            <span class="input-group-btn">
                                                <button class="btn default" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                        </div>
                                    <div class="form-group">
                                        <label>Alamat:</label>
                                        <input type="text" class="form-control" autocomplete="off" placeholder="Alamat" name="alamat" id="alamat" value="<?=$row->alamat?>" required>
                                        <!-- <span class="help-block"><b>* serial will be generated automatically</b></span> -->
                                    </div>
                                    <div class="form-group">
                                        <label>Domisili:</label>
                                        <input type="text" class="form-control" autocomplete="off" placeholder="Domisili" name="domisili" id="domisili" value="<?=$row->domisili?>" required>
                                        <!-- <span class="help-block"><b>* serial will be generated automatically</b></span> -->
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pendidikan:</label>
                                        <input type="text" class="form-control" autocomplete="off" placeholder="Pendidikan" name="pendidikan" id="pendidikan" value="<?=$row->pendidikan?>" required>
                                        <!-- <span class="help-block"><b>* serial will be generated automatically</b></span> -->
                                    </div>
                                    <div class="form-group">
                                        <label>Pekerjaan:</label>
                                        <input type="text" class="form-control" autocomplete="off" placeholder="Pekerjaan" name="pekerjaan" id="pekerjaan" value="<?=$row->pekerjaan?>" required>
                                        <!-- <span class="help-block"><b>* serial will be generated automatically</b></span> -->
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin:</label>
                                        <select class="form-control" id="jk" name="jk">
                                            <option value="">Pilih</option>
                                            <option <?php if($row->jk == 1){ echo 'selected';}?> value="1">Laki-Laki</option>
                                            <option <?php if($row->jk == 2){ echo 'selected';}?> value="2">Wanita</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Asal Gereja:</label>
                                        <select class="form-control  select2" id="gbkp"  name="gbkp">
                                            <option value="">Pilih</option>
                                            <?php foreach ($gbkp as $key => $value) {
                                                $selected='';
                                                if($row->runggun_id == $value->id_seq){$selected='selected';}
                                                ?>
                                                <option <?=$selected;?> value="<?php echo $this->enc->encode($value->id_seq) ?>">
                                                    <?php echo $value->nama ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>No Hp:</label>
                                        <input type="text" class="form-control" autocomplete="off" placeholder="No Handphone" name="hp" id="hp" value="<?=$row->phone?>" required>
                                        <!-- <span class="help-block"><b>* serial will be generated automatically</b></span> -->
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input type="text" class="form-control" autocomplete="off" placeholder="Email" name="email" value="<?=$row->email?>"  id="email" required>
                                        <!-- <span class="help-block"><b>* serial will be generated automatically</b></span> -->
                                    </div>
                                    <div class="form-group">
                                        <label>Username:</label>
                                        <input type="text" class="form-control" autocomplete="off" placeholder="Email" name="username" id="username" value="<?=$row->username?>"  required>
                                        <!-- <span class="help-block"><b>* serial will be generated automatically</b></span> -->
                                    </div>
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                            <img src="<?= base_url('assets/img/fotoanggota/').$row->foto; ?>" alt=""> </div>
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
                autoclose: true
            });
            $('.select2').select2();

        $('#ff').submit(function(e) {
            e.preventDefault();
            console.log('ok');
            // postData(url, data);
            $.ajax({
                url: '<?php echo base_url(); ?>pengurus/runggun/saveEdit',
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