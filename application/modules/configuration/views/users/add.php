 <link href="<?php echo base_url(); ?>assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />
 <style type="text/css">
 	.wajib{
 		color: red;
 	}
 </style>
 <div class="col-md-8 col-md-offset-2">
 	<div class="portlet box blue" id="box">
 		<?php echo headerForm($title) ?>
 		<div class="portlet-body">
 			<?php echo form_open('configuration/users/action_add', 'id="ff" autocomplete="on"'); ?>
 			<div class="box-body">
 				<div class="form-group">
 					<div class="row">
 						<div class="col-sm-4">
 							<label>Username <span class="wajib">*</span></label>
 							<input type="text" name="username" class="form-control" placeholder="Username" required>
 						</div>
 						<div class="col-sm-4">
 							<label>User Grup <span class="wajib">*</span></label>                                
 							<select class="form-control select2"  required  name="user_group">
 								<option value="">Pilih</option>
 								<?php foreach($user_group as $key=>$value) {?>
 									<option value="<?php echo $this->enc->encode($value->id)?>"> <?php echo $value->name ?></option>
 								<?php } ?>
 							</select>
 						</div>

 						<div class="col-sm-4">
 							<label>No Handphone</label>
 							<input type="text" name="phone" class="form-control" placeholder="No Handphone" onkeypress="return isNumberKey(event)" minlength="10" >
 						</div>
 					</div>
 				</div>
 				<div class="form-group">
 					<div class="row">
 						<div class="col-sm-4">
 							<label>Nama Depan <span class="wajib">*</span></label>
 							<input type="text" name="first_name" class="form-control" placeholder="Nama Depan" required>
 						</div>
 						<div class="col-sm-4">
 							<label>Nama Belakang</label>
 							<input type="text" name="last_name" class="form-control" placeholder="Nama Belakang" >
 						</div>

 						<div class="col-sm-4">
 							<label>Operator / Merchant</label>
 							<select class="form-control select2"  name="operator">
 								<option value="">Pilih</option>
 								<?php foreach($operator as $key=>$value) {?>
 									<option value="<?php echo $this->enc->encode($value->operator_cs_id)?>"><?php echo strtoupper($value->operator_cs_name) ?></option>
 								<?php } ?>
 							</select>
 						</div>

 					</div>
 				</div>
 				<div class="form-group">
 					<div class="row">

 						<div class="col-sm-4">
 							<label>Email</label>
 							<input type="email" name="email" class="form-control" placeholder="Email" >
 						</div>
 					</div>
 				</div>

 				<?php echo createBtnForm('Simpan') ?>
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