<div class="col-md-4 col-md-offset-4">
    <div class="portlet box blue" id="box">
        <?php echo headerForm($title) ?>
        <div class="portlet-body">
            <?php echo form_open('configuration/action/action_edit', 'id="ff" autocomplete="on"'); ?>
            <div class="box-body">
                 <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Nama Aksi</label>
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input type="text" name="name" class="form-control" placeholder="Nama Aksi" required value="<?php echo strtoupper($row->action_name) ?>">
                        </div>
                    </div>
                </div>
            </div>
            <?php echo createBtnForm('Update') ?>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        validateForm('#ff',function(url,data){
            postData(url,data);
        });
    })
</script>