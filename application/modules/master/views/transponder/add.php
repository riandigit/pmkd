 <link href="<?php echo base_url(); ?>assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />

 <style type="text/css">
	.wajib{
		color:red;
	}
</style>

<div class="col-md-4 col-md-offset-4">
	<div class="portlet box blue" id="box">
		<?php echo headerForm($title) ?>
		<div class="portlet-body">
			<?php echo form_open('master/transponder/action_add', 'id="ff" autocomplete="off"'); ?>
			<div class="box-body">
			   <div class="form-group">
				<div class="row">
					<div class="col-sm-12 form-group">
						<label>Transponder Name<span class="wajib">*</span></label>
						<input type="text" class="form-control" name="transponder" id="transponder" placeholder="Transponder Name" required>
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