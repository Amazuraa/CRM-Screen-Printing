<br>
<form action="<?php echo site_url('Welcome/Pembukuan_Insert'); ?>" method="post">
	<div class="table-responsive">
	    <table class="table table-hover">
	        <thead>
	        <tr>
	            <th class="bg-success text-center">#</th>
	            <th class="bg-success">ID. Transaksi</th>
				<th class="bg-success">Tanggal</th>
				<th class="bg-success">Jenis</th>
				<th class="bg-success">Pelanggan</th>
				<th class="bg-success text-center">Status</th>
				<th class="bg-success">INV</th>
				<th class="bg-success text-right">QTY</th>
				<th class="bg-success text-right">Harga</th>
				<th class="bg-success text-right">Produksi</th>
				<th class="bg-success text-right">Operasional</th>
				<th class="bg-success text-right">Gaji</th>
				<th class="bg-success text-right">Cash In</th>
				<th class="bg-success">Detail</th>
	        </tr>
	        </thead>
	        <tbody>
	        <?php
			if (!empty($DataTransaksi)) 
			{
				$i = 0;
				foreach ($DataTransaksi as $ReadDS) 
				{
			?>
				<tr style="background-color: <?php echo($ReadDS->status_transaksi == 1) ? "#f7f3e9" : ""; ?>">
					<td class="text-center"><input type="checkbox" name="check_pembukuan[]"
							   value='<?php echo $ReadDS->id_transaksi; ?>'></td>
					<td><?php echo $ReadDS->id_transaksi; ?>
					</td>
					<td>
						<?php 
							$json_transaksi = json_decode($ReadDS->data_transaksi, true);
							echo $json_transaksi['tgl_masuk'];
						?>
					</td>
					<td>Baju</td>
					<td><?php echo $ReadDS->nama_pelanggan; ?></td>
					<td class="text-center">
						<?php 
	                		switch ($ReadDS->status_transaksi) 
	                		{
	                			case 1:
	                				echo '<span class="label label-warning">BERLANGSUNG</span>';
	                				break;
	                			
	                			case 2:
	                				echo '<span class="label label-primary">SELESAI</span>';
	                				break;

	                			case 3:
	                				echo '<span class="label label-danger">DIBATALKAN</span>';
	                				break;
	                		}
	                	?>
					</td>
					<td class="text-center">
						<a href="<?php echo site_url('Welcome/PrintOut/Invoice/'.$ReadDS->id_transaksi) ?>" target="_blank" 
						   style="color: gray;"><i class="fa fa-print"></i></a>
					</td>
					<td class="text-right">
						<?php 
							$json_produksi = json_decode($ReadDS->data_produksi, true);
							echo $json_produksi['jumlah_pesanan'];
						?>
					</td>
					<td class="text-right">
						<?php
							$json_biaya = json_decode($ReadDS->data_biaya, true);
							echo number_format($json_biaya['total_harga_final'],0,",",",");
						?>
						<label class="data_biaya devMode"><?php 
							echo $json_biaya['total_harga_final']; ?></label>
					</td>
					<td class="text-right">
						<?php 
							echo number_format($json_biaya['total_biaya_produksi'],0,",",","); 
						?>
						<label class="data_produksi devMode"><?php
							echo $json_biaya['beban_produksi']; ?></label>
					</td>
					<td class="text-right">
						<?php 
							echo number_format($json_biaya['operasional_produksi'],0,",",",");
						?>
						<label class="data_operasional devMode"><?php
							echo $json_biaya['operasional_produksi']; ?></label>
					</td>
					<td class="text-right">
						<?php 
							echo number_format($json_biaya['biaya_borongan'],0,",",",");
						?>
						<label class="data_gaji devMode"><?php
							echo $json_biaya['biaya_borongan']; ?></label>
					</td>
					<td class="text-right">
						<?php 
							echo number_format($json_biaya['sisa_dana_produksi'],0,",",",");
						?>
						<label class="data_cash_in devMode"><?php
							echo $json_biaya['sisa_dana_produksi']; ?></label>
					</td>
					<td class="text-center">
						<a style="color: gray;" class="link_detail">
							<i class="fa fa-sign-out"></i></a>
					</td>
				</tr>	
			<?php
						$i++;
					}
				}
			?>
			<tr>
				<td class="text-right bg-primary" colspan="7">
					<h4>TOTAL NILAI JUAL BELI  &nbsp;&nbsp;</h4></td>
				<td class="text-right bg-primary">
					<h4><label id="quality_total">0</label></h4></td>
				<td class="text-right bg-primary">
					<h4><label id="harga_total">0</label></h4></td>
				<td class="text-right bg-primary">
					<h4><label id="produksi_total">0</label></h4></td>
				<td class="text-right bg-primary">
					<h4><label id="operasional_total">0</label></h4></td>
				<td class="text-right bg-primary">
					<h4><label id="gaji_total">0</label></h4></td>
				<td class="text-right bg-primary">
					<h4><label id="cash_in_total">0</label></h4></td>
				<td class="text-right bg-primary"></td>
			</tr>
	        </tbody>
	    </table>
	</div>

	<input type="text" id="input_harga_total" class="devMode" value="0">
	<input type="text" id="input_produksi_total" class="devMode" value="0">
	<input type="text" id="input_operasional_total" class="devMode" value="0">
	<input type="text" id="input_gaji_total" class="devMode" value="0">
	<input type="text" id="input_cash_in_total" class="devMode" value="0">

	<hr>
	<table align="center">
		<tr>
			<td style="width:160px;" class="border-right">
				&nbsp;&nbsp;<input type="submit" class="btn btn-info" name="btn_simpan" value="Tutup Pembukuan">
			</td>
			<td style="width:200px; padding-left: 15px;">
				<select class="form-control" name="input_child_folder">
					<option value="">- Pilih Bulan -</option>
					<option value="01_Januari">Januari</option>
					<option value="02_Februari">Februari</option>
					<option value="03_Maret">Maret</option>
					<option value="04_April">April</option>
					<option value="05_Mei">Mei</option>
					<option value="06_Juni">Juni</option>
					<option value="07_Juli">Juli</option>
					<option value="08_Agustus">Agustus</option>
					<option value="09_September">September</option>
					<option value="10_Oktober">Oktober</option>
					<option value="11_November">November</option>
					<option value="12_Desember">Desember</option>
				</select>		
			</td>
			<td style="width:100px; padding-left: 15px;">
				<input type="text" class="form-control text-center" name="input_parent_folder" value="<?php echo date('Y'); ?>">
			</td>
		</tr>
		
	</table>
	
	<textarea class="ipt-upah-pekerja devMode" name="input_upah_pekerja"></textarea>
</form>