<!-- <style>
.input-group .select2-container--bootstrap {
    display: contents !important;
}
</style> -->
<style>
    select {
        font-family: fontAwesome
    }
</style>
<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2">
    <div class="portlet box blue" id="box">
        <?php echo headerForm($title) ?>
        <div class="portlet-body">
            <?php echo form_open('home/home/permit', 'id="ff" autocomplete="off"'); ?>
            <div class="box-body">
                <div class="form-group">
                    <div class="row">
                        <input type="hidden" value="<?= $id ?>" name="id" id="id">
                        <div class="col-md-12">
                            <div class="col-md-6 col-md-offset-2 col-sm-6 col-sm-offset-2 col-xs-8 col-xs-offset-2">
                                <div class="input-group select2-bootstrap-prepend">
                                    <select class="form-control" style='width:150%;border-radius: 25px !important;' id="permit" name="permit" required>
                                        <option value="">-PILIH-</option>
                                        <option value="1">&#xf0e0; Approve</option>
                                        <option value="-5">&#xf1fb; Not Approve</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-md-offset-2 col-sm-6 col-sm-offset-2 col-xs-8 col-xs-offset-2" style="margin-top: 10px;">
                                <div class="input-group select2-bootstrap-prepend">
                                    <select class="form-control" style='width:150%;border-radius: 25px !important;' id="status" name="status" required>
                                        <option value="">-PILIH-</option>
                                        <option value="AKTIF">&#xf0e0; AKTIF</option>
                                        <option value="TIDAK AKTIF">&#xf1fb; TIDAK AKTIF</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer text-right">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-sm btn-default" onclick="closeModal()"><i class="fa fa-close"></i> Cancel</button>
                        <button type="submit" class="btn btn-sm btn-primary" id="saveBtn" id="saveBtn"><i class="fa fa-check"></i> Save</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.datepicker').datepicker({
            startDate: new Date(),
            format: 'yyyy-mm-dd',
            autoclose: true
        });
        $('.form_datetime').datetimepicker('setStartDate', new Date());
        validateForm('#ff', function(url, data) {

            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                dataType: 'json',

                beforeSend: function() {
                    unBlockUiId('box')
                },

                success: function(json) {

                    closeModal();
                    toastr.success(json.message, 'Sukses');
                    $('#dataTables').DataTable().ajax.reload(null, false);
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