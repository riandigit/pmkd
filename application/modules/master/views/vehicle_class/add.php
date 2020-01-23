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
 			<?php echo form_open('master/vehicle_class/action_add', 'id="ff" autocomplete="off"'); ?>
 			<div class="box-body">
 				<div class="form-group">
 					<div class="row">
 						<div class="col-sm-12 form-group">
 							<label>Nama Golongan <span class="wajib">*</span></label>
 							<input type="text" class="form-control" name="name" id="name" placeholder="Nama Golongan" required>
 						</div>

 						<div class="col-sm-6 form-group">
 							<label>Panjang Min.</label>
 							<input type="text" class="form-control" name="min" id="min" placeholder="Minimal (mm)">
 						</div>

 						<div class="col-sm-6 form-group">
 							<label>Panjang Max.</label>
 							<input type="text" class="form-control" name="max" id="max" placeholder="Maksimal (mm)">
 						</div>

 						<div class="col-sm-12 form-group">
 							<label>Keterangan</label>
 							<textarea type="text" class="form-control" name="desc" id="desc" placeholder="Keterangan" style="resize: none;"></textarea>
 						</div>

 					</div>
 				</div>
 			</div>
 			<?php echo createBtnForm('Simpan'); ?>
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