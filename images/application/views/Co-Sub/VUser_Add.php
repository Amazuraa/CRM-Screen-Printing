<div class="modal inmodal" id="<?php echo $Sub_Modal_IdAdd; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    	<div class="modal-content animated fadeInLeft">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                	<span aria-hidden="true">&times;</span>
                	<span class="sr-only">Close</span></button>
                <h4 class="modal-title">Tambah Pekerja Baru</h4>
            </div>
            <div class="modal-body">
            	<div class="m-t-md">

				<form action="<?php echo site_url('Welcome/User_Insert'); ?>" method="post">
					
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Nama Lengkap</label>
						<div class="col-sm-8">
							<!-- MAIN_INPUT -->
							<input type="text" class="form-control" name="input_nama_user">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">No. Handphone</label>
						<div class="col-sm-8">
							<!-- MAIN_INPUT -->
							<input type="text" class="form-control" name="input_telp_user">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">User - Pass</label>
						<div class="col-sm-8">
							<!-- MAIN_INPUT -->
							<input type="text" class="form-control" name="input_userpass">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Hak Akses</label>
						<div class="col-sm-8">
							<!-- MAIN_INPUT -->
							<!-- <input type="text" class="form-control" name="input_akses_user"> -->
							<select class="form-control" name="input_akses_user">
								<?php
									if(!empty($DataUserConfig))
									{
										foreach ($DataUserConfig as $read) 
										{
											echo "<option value='".$read->user_akses."'>".$read->user_akses."</option>";
										}
									}
								?>
								
							</select>
						</div>
					</div>

					<input class="btn btn-sm float-right btn-primary" type="submit" name="btn_simpan" value="Simpan">
				</form>

                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>