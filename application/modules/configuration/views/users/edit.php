<style type="text/css">
	.wajib{
		color: red;
	}
</style>
<div class="col-md-8 col-md-offset-2">
	<div class="portlet box blue" id="box">
		<?php echo headerForm($title) ?>
		<div class="portlet-body">
			<?php echo form_open('configuration/users/action_edit', 'id="ff" autocomplete="on"'); ?>
			<div class="box-body">
				<div class="form-group">
					<div class="row">
						<div class="col-sm-4">
							<label>Username <span class="wajib">*</span></label>
							<input type="hidden" name="id" value="<?php echo $id ?>">
							<input type="hidden" name="username"  value="<?php echo $row->username ?>">
                            <input type="text" name="username2" class="form-control" placeholder="Username" required value="<?php echo $row->username ?>" disabled>
						</div>

						<div class="col-sm-4">
							<label>User Grup <span class="wajib">*</span> </label>
							<?php echo form_dropdown('user_group', $user_group, $row->user_group_id, 'class="form-control select2" required data-placeholder="Pilih User Grup" '); ?>
						</div>

						<div class="col-sm-4">
							<label>Nomor Handphone <span class="wajib">*</span></label>
							<input type="text" name="phone" class="form-control" placeholder="No Handphone" required value="<?php echo $row->phone ?>">
						</div>

					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-4">
							<label>Nama Depan <span class="wajib">*</span></label>
							<input type="text" name="first_name" class="form-control" placeholder="Nama Depan" required value="<?php echo $row->first_name ?>">
						</div>

						<div class="col-sm-4">
							<label>Nama Belakang</label>
							<input type="text" name="last_name" class="form-control" placeholder="Nama Belakang" value="<?php echo $row->last_name ?>">
						</div>

						<div class="col-sm-4">
							<label>Operator <span class="wajib">*</span> </label>
							<select class="form-control select2" name="operator">
								<option value="">Pilih</option>
								<?php foreach($operator as $key=>$value) {?>
									<option value="<?php echo $this->enc->encode($value->operator_cs_id)?>" <?php echo $value->operator_cs_id==$row->operator_cs_id?"selected":""?> ><?php echo strtoupper($value->operator_cs_name) ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="col-sm-4">
							<label>Email</label>
							<input type="email" name="email" class="form-control" placeholder="Email"  value="<?php echo $row->email ?>">
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
		$('.mfp-wrap').removeAttr('tabindex')
		$('.select2').select2()
		$('.select2').change(function(){
			$(this).valid();
		})

		validateForm('#ff',function(url,data){
			postData(url,data);
		});

		$('.allow').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'icheckbox_square-blue',
		});
	})

</script>