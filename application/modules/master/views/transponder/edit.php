 <link href="<?php echo base_url(); ?>assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />

<style>
	.wajib{color: red}
</style>
<div class="col-md-4 col-md-offset-4">
	<div class="portlet box blue" id="box">
		<?php echo headerForm($title) ?>
		<div class="portlet-body">
			<?php echo form_open('master/transponder/action_edit', 'id="ff" autocomplete="on"'); ?>
			<div class="box-body">
				 <div class="form-group">
					<div class="row">

						<div class="col-sm-12 form-group">
							<label>Transponder Name <span class="wajib">*</span></label>
							<input type="text" class="form-control" name="transponder" id="transponder" value="<?php echo $detail->transponder_name ?>" placeholder="Transponder Name" required>
							<input type="hidden" value="<?php echo $this->enc->encode($detail->id) ?>" name="id">
						</div>

					</div>
				</div>
			</div>
			<?php echo createBtnForm('Edit') ?>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>

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