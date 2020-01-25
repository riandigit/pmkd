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
           <?php echo form_open('master/gbkp/action_edit', 'id="ff" autocomplete="off"'); ?>
           <div class="box-body">
              <div class="form-group">
               <div class="row">
                   <div class="col-sm-6 form-group">
                   <input type="hidden" name="id" id="id" value="<?php echo $this->enc->encode($row->id_seq) ?>">

                       <label>Nama :<span class="wajib">*</span></label>
                       <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?=$row->nama?>" required>
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
   })
</script>