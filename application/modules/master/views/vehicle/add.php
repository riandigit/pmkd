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
 			<?php echo form_open('master/vehicle/action_add', 'id="ff" autocomplete="off"'); ?>
 			<div class="box-body">
 				<div class="form-group">
 					<div class="row">
 						<div class="col-sm-6 form-group">
 							<label>Customer <span class="wajib">*</span></label>
 							<select class="form-control select2" required name="customer" id="customer">
 								<option value="">Pilih</option>
 								<?php foreach($customer as $key=>$value ) {?>
 									<option value="<?php echo $this->enc->encode($value->customer_id); ?>"><?php echo strtoupper($value->first_name . " " . $value->last_name) ?> (<?=$value->id_number ?>)</option>
 								<?php } ?>
 							</select>
 						</div>

 						<div class="col-sm-6 form-group">
 							<label>Plat Number <span class="wajib">*</span></label>
 							<input type="text" class="form-control" name="plate_number" id="plate_number" placeholder="Plat Number" required>
 						</div>

 						<div class="col-sm-6 form-group">
 							<label>STNK <span class="wajib">*</span></label>
 							<input type="text" class="form-control" name="stnk" id="stnk" placeholder="STNK" required>
 						</div>

 						<div class="col-sm-6 form-group">
 							<label>Brand <span class="wajib">*</span></label>
 							<input type="text" class="form-control" name="vehicle_brand" id="vehicle_brand" placeholder="Brand" required>
 						</div>

 						<div class="col-sm-6 form-group">
 							<label>Color <span class="wajib">*</span></label>
 							<input type="text" class="form-control" name="vehicle_color" id="vehicle_color" placeholder="Color" required>
 						</div>

 						<div class="col-sm-6 form-group">
 							<label>Year <span class="wajib">*</span></label>
 							<input type="text" class="form-control" name="manufacture_year" id="manufacture_year" placeholder="Manufacture Year" required>
 						</div>

 						<div class="col-sm-6 form-group">
 							<label>Cylinder <span class="wajib">*</span></label>
 							<input type="text" class="form-control" name="vehicle_cylinder" id="vehicle_cylinder" placeholder="Cylinder" required>
 						</div>

 						<div class="col-sm-6 form-group">
 							<label>Owner <span class="wajib">*</span></label>
 							<input type="text" class="form-control" name="owner_name" id="owner_name" placeholder="Owner Name" required>
 						</div>

 						<!-- <div class="col-sm-6 form-group">
 							<label>Vehicle Type <span class="wajib">*</span></label>
 							<select class="form-control select2" required name="vehicle_type" id="vehicle_type">
 								<option value="">Pilih</option>
 								<?php foreach($vehicle_class as $key=>$value ) {?>
 									<option value="<?php echo $this->enc->encode($value->vehicle_class_code); ?>"><?php echo strtoupper($value->vehicle_class_name) ?></option>
 								<?php } ?>
 							</select>
 						</div> -->

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