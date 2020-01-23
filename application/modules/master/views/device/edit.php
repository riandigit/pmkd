 <link href="<?php echo base_url(); ?>assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />

<style>
	.wajib{color: red}
</style>
<div class="col-md-6 col-md-offset-3">
	<div class="portlet box blue" id="box">
		<?php echo headerForm($title) ?>
		<div class="portlet-body">
			<?php echo form_open('master/device/action_edit', 'id="ff" autocomplete="on"'); ?>
			<div class="box-body">
				 <div class="form-group">
					<div class="row">
						<div class="col-sm-6 form-group">
							<label>Nama Perangkat <span class="wajib">*</span></label>
							<input type="text" class="form-control" required name="name" id="name" placeholder="Nama Perangkat" value="<?=$detail->device_name ?>">
							<input type="hidden" name="id" id="id" value="<?php echo $this->enc->encode($detail->id) ?>">
						</div>

						<div class="col-sm-6 form-group">
							<label>Tipe Perangkat <span class="wajib">*</span></label>
							<select class="form-control select2" required name="device_type" id="device_type">
								<option value="">Pilih</option>
								<?php foreach($device_type as $key=>$value ) { ?>
									<option value="<?php echo $this->enc->encode($value->id) ?>" <?php echo $value->id == $detail->device_type_id?"selected":""; ?> ><?php echo strtoupper($value->name); ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="col-sm-6 form-group">
							<label>Operator <span class="wajib">*</span></label>
							<select class="form-control select2" required name="operator" id="operator">
								<option value="">Pilih</option>
								<?php foreach($operator as $key=>$value ) { ?>
									<option value="<?php echo $this->enc->encode($value->operator_id) ?>" <?php echo $value->operator_id == $detail->operator_id?"selected":""; ?> ><?php echo strtoupper($value->operator_name); ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="col-sm-6 form-group">
							<label>Jalur <span class="wajib">*</span></label>
							<select class="form-control select2" required name="lane" id="lane">
								<option value="">Pilih</option>
								<?php foreach($lane as $key=>$value ) { ?>
									<option value="<?php echo $this->enc->encode($value->id_seq) ?>" <?php echo $value->id_seq == $detail->lane_id?"selected":""; ?> ><?= strtoupper($value->lane_name) ?> ( <?= strtoupper($value->plaza_name) ?> )</option>
								<?php } ?>
							</select>
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