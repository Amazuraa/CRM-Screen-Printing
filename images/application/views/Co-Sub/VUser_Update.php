<div class="modal inmodal" id="<?php echo $Sub_Modal_IdUpdate; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    	<div class="modal-content animated fadeInLeft">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                	<span aria-hidden="true">&times;</span>
                	<span class="sr-only">Close</span></button>
                <h4 class="modal-title">Ubah Data Pekerja</h4>
            </div>
            <div class="modal-body">
            	<div class="m-t-md">
					<form action="<?php echo site_url('Welcome/User_Update'); ?>" method="post">			
						<!-- MAIN_INPUT -->
						<input type="text" class="form-control input-id-user" name="input_id_user" hidden>

						<div class="form-group row">
							<label class="col-sm-4 col-form-label">Nama Lengkap</label>
							<div class="col-sm-8">
								<!-- MAIN_INPUT -->
								<input type="text" class="form-control input-nama-user" name="input_nama_user">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4 col-form-label">No. Handphone</label>
							<div class="col-sm-8">
								<!-- MAIN_INPUT -->
								<input type="text" class="form-control input-telp-user" name="input_telp_user">
							</div>
						</div>

						<input class="btn btn-sm float-right btn-primary" type="submit" name="btn_simpan" value="Ubah">
					</form>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>