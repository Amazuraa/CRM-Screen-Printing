<!-- TRANSAKSI -->
<?php
	$json_data_transaksi = json_decode($DataTransaksi->data_transaksi, true);
	$json_data_biaya = json_decode($DataTransaksi->data_biaya, true);
	$json_data_produksi = json_decode($DataTransaksi->data_produksi, true);
?>

<div class="row">
	<div class="col-sm-4">
		<table class="table table-bordered">
			<tr>
				<td colspan="2" class="text-center bg-warning tab-bayar-status-color">
					<b><?php echo $json_data_transaksi['pembayaran_status']; ?></b>
				</td>
			</tr>
			<tr>
				<td style="width: 250px;">&nbsp;&nbsp; Pembayaran Awal</td>
				<td class="text-right" style="background-color: #FFE194; color: #9E7777;">
					<b>Rp <?php echo number_format($json_data_transaksi['pembayaran_awal'],0,",",","); ?></b>
				</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp; <span class="txt-bayar-akhir">Pembayaran Akhir</span></td>
				<td class="text-right" style="background-color: #FFE194; color: #9E7777;">
					<b>Rp <?php echo number_format($json_data_transaksi['pembayaran_akhir'],0,",",","); ?></b>
				</td>
			</tr>
		</table>

		<table class="table table-bordered">
			<tr>
				<td style="width: 250px;">&nbsp;&nbsp; ID. Transaksi</td>
				<td style="background-color: #F5E8C7; color: #9E7777;">
					<b><?php echo $DataTransaksi->id_transaksi; ?></b>
				</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp; Brand</td>
				<td style="background-color: #F5E8C7; color: #9E7777;">
					<b><?php echo $json_data_produksi['brand']; ?></b>
				</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp; Pelanggan</td>
				<td style="background-color: #F5E8C7; color: #9E7777;">
					<b><?php echo $DataPelanggan->nama_pelanggan; ?></b>
				</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp; Tanggal Masuk</td>
				<td style="background-color: #F5E8C7; color: #9E7777;">
					<b><?php echo $json_data_transaksi['tgl_masuk']; ?></b>
				</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp; Tanggal Selesai</td>
				<td style="background-color: #F5E8C7; color: #9E7777;">
					<b><?php echo $json_data_transaksi['tgl_selesai']; ?></b>
				</td>
			</tr>
		</table>

		<table class="table table-bordered">
			<tr>
				<td style="width: 250px;">&nbsp;&nbsp; Jumlah Pesan</td>
				<td style="background-color: #F5E8C7; color: #9E7777;">
					<b><?php echo $json_data_produksi['jumlah_pesanan']; ?> PCS</b>
				</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp; Bahan Sablon</td>
				<td style="background-color: #F5E8C7; color: #9E7777;">
					<b><?php echo $json_data_produksi['nama_bahan']; ?></b>
				</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp; Jenis Tinta</td>
				<td style="background-color: #F5E8C7; color: #9E7777;">
					<b><?php echo $json_data_produksi['nama_tinta']; ?></b>
				</td>
			</tr>
		</table>

		<!-- TABLE DETAIL SABLON -->
		<table class="table table-bordered">
			<thead>
			<tr>
				<th class="bg-success text-center" style="vertical-align: middle;">Posisi Sablon</th>
				<th class="bg-success text-center" style="vertical-align: middle;">Ukuran Sablon</th>
				<th class="bg-success text-center" style="vertical-align: middle;">Jumlah Warna</th>
			</tr>
			</thead>
			<?php 
				$detail_sablon = json_decode($json_data_produksi['detail_sablon']);

				foreach ($detail_sablon as $read) 
				{
			?>
				<tr>
					<td class="text-center"><?php echo $read->posisi; ?></td>
					<td class="text-center"><?php echo $read->ukuran; ?></td>
					<td class="text-center"><?php echo $read->jumlah_warna; ?></td>
				</tr>
			<?php
				}
			?>
		</table>

		<!-- TABLE BIAYA POLYFILM -->
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="text-center" style="background-color: #A9F1DF; color: #34656D;">Polyfilm</th>
					<th class="text-right" style="background-color: #A9F1DF; color: #34656D;">Biaya</th>
					<th class="text-right" style="background-color: #A9F1DF; color: #34656D;">Total Biaya</th>
				</tr>
			</thead>
			<?php
				$polyfilm = json_decode($json_data_biaya['biaya_polyfilm']);

				foreach ($polyfilm as $read) 
				{
			?>
				<tr>
					<td class="text-center"><?php echo $read->posisi; ?></td>
					<td class="text-right"><?php echo number_format($read->biaya,0,",",","); ?></td>
					<td class="text-right"><?php echo number_format($read->total,0,",",","); ?></td>
				</tr>
			<?php
				}
			?>
			<tr>
				<td colspan="2" class="text-right"><h4>Total</h4></td>
				<td class="text-right">
					<h4><?php echo number_format($json_data_biaya['total_biaya_polyfilm'],0,",",","); ?></h4></td>
			</tr>
		</table>

		<!-- TABLE BIAYA TINTA -->
		<table class="table table-hover table-bordered" id="tab-biaya-tinta">
			<thead>
				<tr>
					<th class="text-center" style="background-color: #FFAEC0; color: #9B5151;">Tinta</th>
					<th class="text-right" style="background-color: #FFAEC0; color: #9B5151;">Biaya</th>
					<th class="text-right" style="background-color: #FFAEC0; color: #9B5151;">Total Biaya</th>
				</tr>
			</thead>
			<?php 
				$tinta = json_decode($json_data_biaya['biaya_tinta']);

				foreach ($tinta as $read) 
				{
			?>
				<tr>
					<td class="text-center"><?php echo $read->posisi; ?></td>
					<td class="text-right"><?php echo number_format($read->biaya,0,",",","); ?></td>
					<td class="text-right"><?php echo number_format($read->total,0,",",","); ?></td>
				</tr>
			<?php
				}
			?>
			<tr>
				<td class="text-right" colspan="2"><h4>Total</h4></td>
				<td class="text-right">
					<h4><?php echo number_format($json_data_biaya['total_biaya_tinta'],0,",",","); ?></h4>
				</td>
			</tr>
		</table>

		
	</div>

	<div class="col-sm-4">
		<!-- Sub-Content -->
		<?php 
			if ($Mode_Biaya != "Pemesanan")
			{
				$this->load->view($Sub_Biaya_Tab); 
			}
		?>
	</div>

	<div class="col-sm-4">
		<!-- TABLE FORMULA BIAYA -->
		<table class="table table-hover table-bordered" id="tab-formula-biaya">
			<thead>
				<tr>
					<th style="background-color: #FFBF86; color: #B85C38;">Formula Biaya</th>
					<th class="text-right" style="background-color: #FFBF86; color: #B85C38;">Biaya</th>
					<th class="text-right" style="background-color: #FFBF86; color: #B85C38;">Total Biaya</th>
				</tr>
			</thead>
			<?php
				$formula = json_decode($json_data_biaya['formula_biaya']);

				foreach ($formula as $read) 
				{
			?>
				<tr>
					<td><?php echo $read->rincian; ?></td>
					<td class="text-right"><?php echo number_format($read->biaya,0,",",","); ?></td>
					<td class="text-right"><?php echo number_format($read->total,0,",",","); ?></td>
				</tr>
			<?php
				}
			?>
			<tr>
				<td colspan="2" class="text-right" style="background-color: #FFBF86; color: #B85C38;"><h4>TOTAL BIAYA PRODUKSI</h4></td>
				<td class="text-right" style="background-color: #FFBF86; color: #B85C38;">
					<h4>Rp <?php echo number_format($json_data_biaya['total_biaya_produksi'],0,",",","); ?></h4>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="text-right" style="background-color: #FDE49C; color: #B85C38;">Beban Produksi</td>
				<td class="text-right" style="background-color: #FDE49C; color: #B85C38;">
					Rp <?php echo number_format($json_data_biaya['beban_produksi'],0,",",","); ?>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="text-right" style="background-color: #FDE49C; color: #B85C38;">Operasional Produksi</td>
				<td class="text-right" style="background-color: #FDE49C; color: #B85C38;">
					Rp <?php echo number_format($json_data_biaya['operasional_produksi'],0,",",","); ?>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="text-right" style="background-color: #FDE49C; color: #B85C38;">Biaya Borongan</td>
				<td class="text-right" style="background-color: #FDE49C; color: #B85C38;">
					Rp <?php echo number_format($json_data_biaya['biaya_borongan'],0,",",","); ?>
				</td>
			</tr>
		</table>
	</div>

	<!-- Perbandingan & Biaya Final -->
	<div class="col-sm-4 border-right m-t-md">
		<table class="table table-hover table-bordered">
			<tr class="text-right">
				<td><h4>Harga Kaos + Sablon &nbsp; &nbsp;</h4></td>
				<td><h4>Rp <?php echo number_format($json_data_biaya['harga_kaos_sablon'],0,",",","); ?></h4></td>
			</tr>
			<tr class="text-right">
				<td><h4>Harga Sablon Saja &nbsp; &nbsp;</h4></td>
				<td><h4>Rp <?php echo number_format($json_data_biaya['harga_sablon_saja'],0,",",","); ?></h4></td>
			</tr>
			<tr class="text-right" style="background-color: #845EC2; color: #F1F1F1;">
				<td><h4>TOTAL HARGA MINIMUM &nbsp; &nbsp;</h4></td>
				<td><h4>Rp <?php echo number_format($json_data_biaya['total_harga_minimum'],0,",",","); ?></h4></td>
			</tr>
		</table>
	</div>
	<div class="col-sm-4 m-t-md">
		<table class="table table-hover table-bordered">
			<tr class="text-right">
				<td><h4>Harga / PCS Final &nbsp; &nbsp;</h4></td>
				<td><h4>Rp <?php echo number_format($json_data_biaya['harga_final'],0,",",","); ?></h4></td>
			</tr>
			<tr class="text-right">
				<td><h4></h4></td>
				<td><h4>-</h4></td>
			</tr>
			<tr class="text-right" style="background-color: #C56183; color: #F1F1F1;">
				<td><h4>TOTAL HARGA FINAL &nbsp; &nbsp;</h4></td>
				<td><h4>Rp <?php echo number_format($json_data_biaya['total_harga_final'],0,",",","); ?></h4></td>
			</tr>
		</table>
	</div>

	<!-- <div class="col-sm-3"></div> -->
	<div class="col-sm-4 m-t-md">
		<table class="table table-bordered">
			<tr>
				<td> &nbsp; &nbsp; Persentase Usaha</td>
				<td class="text-right" style="background-color: #01A9B4; color: #F1F1F1;">
					<?php echo $json_data_biaya['persentase_usaha']; ?> %
				</td>
			</tr>
			<tr>
				<td> &nbsp; &nbsp; Selisih Harga / PCS</td>
				<td class="text-right" style="background-color: #01A9B4; color: #F1F1F1;">
					Rp <?php echo number_format($json_data_biaya['selisih_harga_satuan'],0,",",","); ?>
				</td>
			</tr>
			<tr>
				<td> &nbsp; &nbsp; Selisih Harga Jual</td>
				<td class="text-right" style="background-color: #01A9B4; color: #F1F1F1;">
					Rp <?php echo number_format($json_data_biaya['selisih_harga_jual'],0,",",","); ?>
				</td>
			</tr>
			<tr>
				<td> &nbsp; &nbsp; Infak Wajib</td>
				<td class="text-right" style="background-color: #01A9B4; color: #F1F1F1;">-</td>
			</tr>
		</table>
		<table class="table table-bordered">
			
			<tr>
				<td colspan="3">
					<table class="table m-t-md">
						<tr style="background-color: #7E7474; color: #FFFFFF;">
							<th colspan="2"><center>Biaya Overhead</center></th>
						</tr>
						<tr style="background-color: #7E7474; color: #FFFFFF;">
							<th>Keterangan</th>
							<th class="text-right">Total Biaya</th>
						</tr>

						<?php
							$overhead = json_decode($json_data_biaya['biaya_overhead']);
							$overhead_total = 0;

							if (!empty($overhead))
							{
								foreach ($overhead as $read)
								{
						?>
							<tr>
								<td><?php echo $read->keterangan; ?></td>
								<td class="text-right"><?php echo number_format($read->biaya,0,",",","); ?></td>
							</tr>
						<?php
									$overhead_total += $read->biaya;
								}
							}
						?>
						
						<tr>
							<td class="text-right"><b>Total</b></td>
							<td class="text-right"><b><?php echo number_format($overhead_total,0,",",","); ?></b></td>
							<td class="devMode"><input type="number" name="input_overhead_total" class="form-control"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2"><h4> &nbsp; &nbsp; Sisa Dana Produksi</h4></td>
				<td class="text-right" style="background-color: #01A9B4; color: #F1F1F1;">
					<h4>Rp <?php echo number_format($json_data_biaya['sisa_dana_produksi'],0,",",","); ?></h4>
				</td>
			</tr>
		</table>
	</div>
	<!-- <div class="col-sm-3"></div> -->
</div>