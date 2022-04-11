<table border="0px" width="97%" style="margin-left: 15px;">
	<tr>
	<td>

    <div class="form-group row m-l-none">
    	<label class="col-sm-3 col-form-label">ID. Transaksi</label>
    	<div class="col-sm-7">
    		<!-- MAIN_INPUT -->
    		<input type="text" class="form-control" readonly="true"
    			   name="input_transaksi_id"
    			   value="<?php echo "TRN".date('ymd').generate_string(3); ?>"
    			   id="transaksi_id">
    	</div>
    </div>

    <div class="form-group row m-l-none">
    	<label class="col-sm-3 col-form-label">Tanggal Transaksi</label>
    	<div class="col-sm-7">
    		<!-- TANGGAL_TRANSAKSI -->
    		<div class="input-group">
                <div class="input-group-prepend">
                    <button class="btn btn-outline btn-info" type="button" style="width: 50px;"
                    		id="button_transaksi_tgl1">
                    <i class="fa fa-pencil"></i>
                    </button>
                
                    <button class="btn btn-warning devMode" type="button" style="width: 50px;"
                    		id="button_transaksi_tgl2">
                    <i class="fa fa-times"></i>
                    </button>
                </div>

                <!-- MAIN_INPUT -->
                <input type="date" class="form-control" readonly="true"
                	   value="<?php echo date('Y-m-d'); ?>"
                	   id="transaksi_tgl" name="input_transaksi_tgl">
            </div>
    	</div>
    </div>

    <div class="form-group row m-l-none devMode" id="tab_transaksi_lama">
    	<label class="col-sm-3 col-form-label">Tanggal Selesai</label>
    	<div class="col-sm-7">
    		<!-- TRANSAKSI_LAMA -->
            <input type="date" class="form-control"
            	   id="transaksi_tgl_selesai" name="input_transaksi_tgl_selesai">

    	   	<!-- MAIN_INPUT -->
    		<!-- <input type="checkbox" class="devMode" 
    			   id="transaksi_lama" name="input_transaksi_lama"> -->
    	</div>
    </div>

    <div class="form-group row m-l-none">
        <label class="col-sm-3 col-form-label">Estimasi Selesai</label>
        <div class="col-sm-7">
            <!-- MAIN_INPUT -->
            <input type="date" class="form-control" name="input_estimasi">
        </div>
    </div>

    <br><br>
    <h3 class="m-t-xl"><i class="fa fa-user"></i>&nbsp; Data Pelanggan</h3>
    <div class="hr-line-dashed m-t-none"></div>

    <div class="form-group row m-l-none">
    	<label class="col-sm-3 col-form-label">Nama Pelanggan</label>
    	<div class="col-sm-7">
			<div class="input-group m-t-sm">
                <div class="input-group-prepend">
                    <button class="btn btn-outline btn-info" type="button" style="width: 50px;" 
                    		id="button_pelanggan1">
                    	<i class="fa fa-plus"></i>
                    </button>
                    <button class="btn btn-warning devMode" type="button" style="width: 50px;"
                    		id="button_pelanggan2">
                    	<i class="fa fa-times"></i>
                    </button>
                </div>

                <!-- MAIN_INPUT -->
                <select class="form-control" 
                		id="pelanggan_id" name="input_pelanggan_id">
                    <option value="">- Nama Pelanggan -</option>
                <?php
                	if(!empty($DataPelanggan))
                	{
                		foreach ($DataPelanggan as $ReadDS) 
                		{
                ?>
                		<option value="<?php echo $ReadDS->id_pelanggan; ?>">
                			<?php echo $ReadDS->nama_pelanggan; ?>
                		</option>
                <?php
                		}
                	}
                ?>
                </select>
                
                <!-- MAIN_INPUT -->
                <input type="text" class="form-control devMode"
                	   id="pelanggan_nama" name="input_pelanggan_nama_new">
            </div>
    	</div>
    </div>
    
    <div class="form-group row m-l-none">
    	<label class="col-sm-3 col-form-label">No. Handphone</label>
    	<div class="col-sm-7">
    		<div class="input-group m-b">
                <div class="input-group-prepend">
                    <span class="input-group-addon">+62</span>
                </div>

                <!-- MAIN_INPUT -->
                <select class="devMode" id="pelanggan_hp" name="input_pelanggan_hp">
                	<option value=""></option>
                <?php
                	if(!empty($DataPelanggan))
                	{	
                		$i = 1;
                		foreach ($DataPelanggan as $ReadDS) 
                		{
                ?>
                		<option value="<?php echo $i; ?>"><?php
                				$str = substr($ReadDS->telp_pelanggan, 2);
                				echo $str; 
                			?></option>
                <?php
                			$i++;
                		}
                	}
                ?>
                </select>

                <!-- MAIN_INPUT -->
                <input type="number" class="form-control" min="0" readonly="true"
                	   id="pelanggan_hp_new" name="input_pelanggan_hp_new">
            </div>
    	</div>
    </div>

    <br>
    <h3 class="m-t-xl"><i class="fa fa-delicious"></i>&nbsp; Data Produksi</h3>
    <div class="hr-line-dashed m-t-none"></div>

    <div class="form-group row m-l-none">
    	<label class="col-sm-3 col-form-label">Brand</label>
    	<div class="col-sm-7">
    		<!-- MAIN_INPUT -->
    		<input type="text" name="input_brand" class="form-control">
    	</div>
    </div>

    <div class="form-group row m-l-none">
    	<label class="col-sm-3 col-form-label">Jumlah Pesanan</label>
    	<div class="col-sm-7">

    		<div class="input-group">
                <!-- MAIN INPUT -->
    			<input type="number" class="form-control" value="0" min="0"
    			   	   id="jumlah_pesanan" name="input_jumlah_pesanan" readonly="true">

    			<div class="input-group-append">
                    <button class="btn btn-outline btn-info" type="button" 
                    		id="button_jumlah_sablon">
                    	Hanya Sablon
                    </button>
                </div>
                <div class="input-group-append">
                    <button class="btn btn-success devMode" type="button" 
                    		id="button_kaos_sablon">
                    	Kaos + Sablon
                    </button>
                </div>
            </div>
    	</div>
    </div>

    <div class="form-group row m-l-none">
    	<label class="col-sm-3 col-form-label">Jenis Tinta</label>
    	<div class="col-sm-7">
    		<!-- MAIN INPUT -->
    		<select class="form-control" name="input_jenis_tinta" id="jenis_tinta">
                <option value="">- Tinta -</option>
            <?php
				if(!empty($DataTinta))
				{
					foreach($DataTinta as $ReadDS)
					{
			?>
						<option value=<?php echo $ReadDS->detail_tinta; ?>>
							<?php echo $ReadDS->detail_tinta; ?>
						</option>	
			<?php
					}
				}
			?>
            </select>
    	</div>
    </div>

    <div class="form-group row m-l-none">
    	<label class="col-sm-3 col-form-label">Detail Bahan</label>
    	<div class="col-sm-7">
    		<!-- MAIN INPUT -->
    		<select class="form-control m-b-sm" 
    				id="bahan" name="input_bahan">
                <option value="">- Bahan -</option>
			<?php
				$DetailBahan = json_decode($DataBahan->detail_bahan, true);

				if(!empty($DetailBahan))
				{
					foreach($DetailBahan as $ReadDS)
					{
			?>
						<option value="<?php echo $ReadDS['nama']; ?>">
							<?php echo $ReadDS['nama']; ?>
						</option>
			<?php
					}
				}
			?>
			</select>

			<!-- MAIN INPUT -->
    		<input type="text" placeholder=" - Warna -" name="input_bahan_warna" 
    			   class="form-control m-b-sm" id="kaos_warna">

    		<select class="select2 form-control" multiple="multiple" 
    				style="width:400px;" data-placeholder="&nbsp&nbsp&nbsp- Ukuran -&nbsp"
    				id="input_kaos_ukuran">

            	<?php
            	if(!empty($DetailBahan))
				{
					$DetailUkuran = json_decode($DetailBahan[0]['ukuran'], true);
					$i = 0;

					foreach($DetailUkuran as $ReadDS)
					{
            	?>
            			<option value="<?php echo $i; ?>">
            				<?php echo $ReadDS; ?>
            			</option>
            	<?php
            			$i++;
            		}
            	}
            	?>
            </select>

			<br><br>

			<?php
        	if(!empty($DetailBahan))
			{
				$DetailUkuran = json_decode($DetailBahan[0]['ukuran'], true);

				foreach($DetailUkuran as $ReadDS)
				{
        	?>
        		<div class="input-group m-b-sm p-w-sm input_kaos devMode"
        			 style="margin-left: 15px;">
                    <div class="input-group-prepend">
                        <span class="input-group-addon bg-success" style="width: 60px;">
                        	<?php echo $ReadDS; ?>
                        </span>
                    </div>

                    <!-- MAIN INPUT -->
                    <input value="<?php echo $ReadDS; ?>"
                    	   class="devMode" 
                    	   name="input_size_bahan[]">

                    <input type="number" min="0" value="0" 
                    	   class="form-control jumlah_size_bahan" 
                    	   name="input_jumlah_size_bahan[]">

                    <input value="0" class="devMode harga_bahan"
                    	   name="input_harga_bahan[]">

                    <input value="0" class="devMode harga_total_bahan"
                    	   name="input_harga_total_bahan[]">
                </div>
            <?php
            	}
            }
            ?>
    	</div>
    </div>

    <div class="form-group row m-l-none">
    	<label class="col-sm-3 col-form-label">Detail Sablon</label>
    	<div class="col-sm-7">
    		<!-- MAIN_INPUT -->
    		<select class="select2 form-control" multiple="multiple" 
    				style="width:400px;" 
    				data-placeholder="&nbsp&nbsp&nbsp- Posisi Sablon -&nbsp"
    				id="input_posisi_sablon">
    		<?php
    			$FormulaPosisi = json_decode($DataFormula->posisi_formula, true);

				if(!empty($FormulaPosisi))
				{
					$i = 0;
					foreach($FormulaPosisi as $ReadDS)
					{
			?>        	
                <option value="<?php echo $i; ?>">
                	<?php echo $ReadDS; ?>
                </option>
            <?php
            			$i++;
            		}
            	}
            ?>
            </select>
        </div>
    </div>
	
	<div class="form-group row m-l-none">
    	<label class="col-sm-3 col-form-label"></label>
    	<div class="col-sm-7">
    		<?php
				if(!empty($FormulaPosisi))
				{
					$i = 0;
					
					foreach($FormulaPosisi as $ReadDS)
					{
            ?>
    		<div class="ibox m-b-sm detail_sablon devMode"  
    			 style="margin-bottom: 7px; margin-left: 30px;">

                <div class="ibox-title bg-success">
                    <b><?php echo $ReadDS; ?></b>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                        	<i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content border-bottom 
                			border-left border-right sk-loading"
                	 style="display: none;">

                	<!-- MAIN INPUT -->
                	<input type="text" value='<?php echo $ReadDS; ?>'
                		   class="devMode" name="input_posisi_sablon[]" >

                	<input type="text" value="0"
                		   class="devMode biaya_tinta" 
                		   name="input_biaya_tinta[]">

                	<input type="text" value="0"
                		   class="devMode biaya_polyfilm" 
                		   name="input_biaya_polyfilm[]">

                	<input type="text" value="0"
                		   class="devMode biaya_total_tinta" 
                		   name="input_biaya_total_tinta[]">

                	<input type="text" value="0"
                		   class="devMode biaya_total_polyfilm" 
                		   name="input_biaya_total_polyfilm[]">

                    <!-- MAIN_INPUT -->
                    <select class="form-control ukuran_sablon" name="input_ukuran_sablon[]">
                        <option value="">- Ukuran Sablon -</option>
                    <?php
                    	$FormulaSablon = json_decode($DataFormula->sablon_formula, true);

						if(!empty($FormulaSablon))
						{
							foreach($FormulaSablon as $ReadDS)
							{
                    ?>
                    		<option value="<?php echo $ReadDS['ukuran']; ?>">
                    			<?php echo $ReadDS['ukuran']; ?>
                    		</option>
                    <?php
                    		}
                    	}
                    ?>
                    </select>

                    <!-- MAIN_INPUT (WARNA) -->
                    <input type="number" class="form-control m-t-sm jumlah_warna" 
                    	   name="input_jumlah_warna_sablon[]" min="0" value="0">

            		<!-- <div class="input-group m-t-sm">
                        <input name="input_image<?php echo $i; ?>" type="file" class="form-control"
                        	   id="<?php echo "img_sablon_".$i; ?>" />

                    	<div class="input-group-append">
                        	<button class="btn btn-primary button_img_sablon1 devMode" 
                        			type="button"
                            		style="width: 40px;">
                            <i class="fa fa-chevron-down"></i>
                            </button>

                            <button class="btn btn-warning button_img_sablon2" 
                            		type="button"
                            		style="width: 40px;">
                            <i class="fa fa-chevron-up"></i>
                            </button>
                        </div>
                    </div> -->
            		
            		<!-- <img id=""
            			 class="form-control m-t-sm img_sablon_preview"
            			 src="<?php echo base_url('images/no_image.png');?>"  
            			 style="width: 100%;
            			 		height: 250px;
            			 		object-fit: contain;" /> -->
                </div>

            </div>
            <?php
            			$i++;
            		}
            	}
            ?>
    	</div>
    </div>

    <input type="number" value="0" 
    	   class="devMode" id="total_warna" name="input_total_warna">
    <input type="number" value="0" 
    	   class="devMode" id="total_bahan" name="input_total_bahan">
    <input type="number" value="0" 
    	   class="devMode"id="total_polyfilm" name="input_total_polyfilm">
    <input type="number" value="0" 
    	   class="devMode" id="total_tinta" name="input_total_tinta">

	</td>
	</tr>
</table>      

<br><br><br><br>
<br><br><br><br>