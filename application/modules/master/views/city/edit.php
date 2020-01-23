<link href="<?php echo base_url(); ?>assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />

<style type="text/css">
   .wajib{
       color:red;
   }
</style>

<div class="col-md-6 col-md-offset-3">
   <div class="portlet box blue" id="box">
       <?php echo headerForm($title) ?>
       <div class="portlet-body">
           <?php echo form_open('master/city/action_edit', 'id="ff" autocomplete="off"'); ?>
           <div class="box-body">
              <div class="form-group">
               <div class="row">
                   <div class="col-sm-6 form-group">
                   <input type="hidden" name="id" id="id" value="<?php echo $this->enc->encode($row->id_seq) ?>">

                       <label>Island <span class="wajib">*</span></label>
                       <select class="form-control select2" required onChange="getProvince(this.value)" name="island" id="island">
                           <option value="">Select</option>
                           <?php foreach($island as $key=>$value ) { 
                                $selected = '';
                                  if ($value->id_seq == $row->id_island) {
                                      $selected = "selected";
                                  } ?>

                               <option value="<?php echo $this->enc->encode($value->id_seq); ?>" <?php echo $selected ?>><?php echo strtoupper($value->name) ?></option>
                           <?php } ?>
                       </select>
                   </div>
                   <div class="col-sm-6 form-group">
                       <label>Province <span class="wajib">*</span></label>
                       <select class="form-control select2" required name="province" id="province">
                           <option value="">Select</option>
                           <?php foreach($province as $key=>$value ) {
                                $selected = '';
                                if ($value->id_seq == $row->id_province) {
                                    $selected = "selected";
                                } ?>
                               <option value="<?php echo $this->enc->encode($value->id_seq); ?>" <?php echo $selected ?>><?php echo strtoupper($value->name) ?></option>
                           <?php } ?>
                       </select>
                   </div>
                   <div class="col-sm-6 form-group">
                       <label>City <span class="wajib">*</span></label>
                       <input type="text" class="form-control" name="city" id="city" placeholder="City" value="<?=$row->name ?>" required>
                   </div>
               </div>
           </div>
       </div>
       <?php echo createBtnForm('Save'); ?>
       <?php echo form_close(); ?> 
   </div>
</div>
</div>
<script src="<?php echo base_url() ?>assets/js/jquery-easyui-1.5.3/jquery.easyui.min.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
       validateForm('#ff',function(url,data){
           postData(url,data);
       });

       $('.select2:not(.normal)').each(function () {
           $(this).select2({
               dropdownParent: $(this).parent()
           });
       });
   });
   function getProvince(stateID) {
        if (stateID) {
            $.ajax({
                url: '<?php echo site_url() ?>master/city/getProvince/' + stateID,
                type: "GET",
                dataType: "json",
                beforeSend: function() {
                    unBlockUiId('box')
                },
                success: function(data) {
                    unBlockUiId('box')
                    console.log(data);
                    $('select[name="province"]').empty();

                    $('select[name="province"]').append('<option value="">PILIH</option>');
                    $.each(data, function(key, value) {
                        $('select[name="province"]').append('<option value="' + value.id_seq + '">' + value.name + '</option>');
                    });
                },
                error: function() {
                    toastr.error('Silahkan Hubungi Administrator', 'Gagal');
                },

                complete: function() {
                    $('#box').unblock();
                }
            });
        } else {
            console.log('ok');
            $('select[name="province"]').empty();
            $('select[name="province"]').append('<option value="">--SELECT--</option>');
        }
    }
</script>