 <link href="<?php echo base_url(); ?>assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />

<style>
	.wajib{color: red}
</style>
<div class="col-md-6 col-md-offset-3">
	<div class="portlet box blue" id="box">
		<?php echo headerForm($title) ?>
		<div class="portlet-body">
			<?php echo form_open('master/supplier/action_edit', 'id="ff" autocomplete="on"'); ?>
			<div class="box-body">
				 <div class="form-group">
					<div class="row">
						<div class="col-sm-6 form-group">
							<label>Supplier Name <span class="wajib">*</span></label>
							<input type="text" class="form-control" name="supplier_name" id="supplier_name" placeholder="Supplier Name" value="<?=$detail->name ?>" required>
							<input type="hidden" value="<?=$this->enc->encode($detail->id) ?>" name="id">
						</div>

						<div class="col-sm-6 form-group">
							<label>Operator <span class="wajib">*</span></label>
							<select class="form-control select2" required name="operator" id="operator">
								<option value="">Select</option>
								<?php foreach($operator as $key=>$value ) { ?>
									<option value="<?php echo $this->enc->encode($value->operator_id) ?>" <?php echo $value->operator_id == $detail->operator_id?"selected":""; ?> ><?php echo strtoupper($value->operator_name); ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="col-sm-6 form-group">
							<label>Email <span class="wajib">*</span></label>
							<input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?=$detail->email ?>" required>
						</div>

						<div class="col-sm-6 form-group">
							<label>Mobile <span class="wajib">*</span></label>
							<input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number" value="<?=$detail->mobile ?>" required>
						</div>

						<div class="col-sm-6 form-group">
							<label>Phone <span class="wajib">*</span></label>
							<input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number" value="<?=$detail->phone ?>" required>
						</div>

						<div class="col-sm-6 form-group">
							<label>Fax <span class="wajib">*</span></label>
							<input type="text" class="form-control" name="fax" id="fax" placeholder="Fax Number" value="<?=$detail->fax_number ?>" required>
						</div>

						<div class="col-sm-6 form-group">
							<label>PIC <span class="wajib">*</span></label>
							<input type="text" class="form-control" name="pic" id="pic" placeholder="PIC" value="<?=$detail->pic ?>" required>
						</div>

						<div class="col-sm-6 form-group">
							<label>Address <span class="wajib">*</span></label>
							<textarea type="text" class="form-control" name="address" id="address" placeholder="Address" required style="resize: none;"><?=$detail->address ?></textarea>
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