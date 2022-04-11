<!-- INVOICE -->
<?php
	$json_data_transaksi = json_decode($DataTransaksi->data_transaksi, true);
	$json_data_biaya = json_decode($DataTransaksi->data_biaya, true);
	$json_data_produksi = json_decode($DataTransaksi->data_produksi, true);
?>

<div class="row">
    <div class="col-sm-6">
    	<img class="m-l"
			 src="<?php echo base_url('template/img/matrogoblogo.jpg');?>"  
			 style="width: 200px;
			 		object-fit: contain;" />
    </div>

    <div class="col-sm-6 text-right">
        <h4>Invoice No.</h4>
        <h4 class="text-navy"><strong>&nbsp; INV-<?php echo substr($DataTransaksi->id_transaksi, 3, 6)."-".substr($DataTransaksi->id_transaksi, 9); ?></strong></h4>
        <br>
        <table align="right">
        	<tr>
        		<td><strong>Atas Nama &nbsp;&nbsp; :</strong></td>
        		<td style="width: 150px;"><?php echo $DataPelanggan->nama_pelanggan; ?> &nbsp;</td>
        	</tr>
        	<tr>
        		<td><strong>No. Handphone &nbsp;&nbsp; :</strong></td>
        		<td>(+62) <?php echo substr($DataPelanggan->telp_pelanggan, 2, 3)."-".substr($DataPelanggan->telp_pelanggan, 4, 4)."-".substr($DataPelanggan->telp_pelanggan, 9); ?> &nbsp;</td>
        	</tr>
        	<tr>
        		<td><strong>Tanggal Pesan &nbsp;&nbsp; :</strong></td>
        		<td><?php echo $json_data_transaksi['tgl_masuk']; ?> &nbsp;</td>
        	</tr>
        	<tr>
        		<td><strong>Estimasi Pengambilan &nbsp;&nbsp; :</strong></td>
        		<td><?php echo $json_data_transaksi['estimasi_selesai']; ?> &nbsp;</td>
        	</tr>
        </table>
    </div>
</div>

<hr class="hr-line-dashed">

<div class="table-responsive m-t-xl">
    <table class="table table-hover">
        <thead>
        <tr>
        	<th class="text-center">No</th>
            <th class="text-left">Item List</th>
            <th class="text-center">Ukuran</th>
            <th class="text-center">Quantity</th>
            <th class="text-right">Harga Satuan</th>
            <th class="text-right">Harga Total</th>
        </tr>
        </thead>
        <tbody>
        <?php
        	$ukuran_bahan = json_decode($json_data_produksi['ukuran_bahan']);

        	if (!empty($ukuran_bahan))
        	{
        		$i = 1;
        		foreach ($ukuran_bahan as $read) 
        		{
        ?>
        	<tr>
            	<td class="text-center"><?php echo $i; ?></td>
                <th class="text-left"><div><strong>Sablon <?php echo $json_data_produksi['nama_bahan']; ?></strong></div></th>
                <td width="100px" class="text-center"><?php echo $read->ukuran; ?></td>
                <td width="100px" class="text-center"><?php echo $read->jumlah; ?></td>
                <td width="130px" class="text-right">Rp <?php echo number_format($json_data_biaya['harga_final'],0,",",","); ?></td>
                <td width="130px" class="text-right">Rp <?php
                											$harga = $json_data_biaya['harga_final'] * $read->jumlah;
                											echo number_format($harga,0,",",",");
                 										?></td>
            </tr>	
        <?php
        			$i++;
        		}
        	}
        ?>

        <tr height="60px">
        	<td colspan="4"></td>
        	<td class="text-right border-bottom" style="vertical-align: bottom;">
        		<strong><h4>TOTAL &nbsp; :</h4></strong>
        	</td>
        	<td class="text-right border-bottom" style="vertical-align: bottom;">
        		<strong><h4>Rp <?php echo number_format($json_data_biaya['total_harga_final'],0,",",","); ?></h4></strong>
        	</td>
        </tr>
        <tr>
        	<td colspan="4" style="border: none;"></td>
        	<td class="text-right border-bottom">
        		<strong><h4>Total Bayar &nbsp; :</h4></strong>
        	</td>
        	<td class="text-right border-bottom">
        		<strong><h4>Rp <?php echo number_format($json_data_transaksi['pembayaran_awal'],0,",",","); ?></h4></strong>
        	</td>
        </tr>
        <tr>
        	<td colspan="4" style="border: none;"></td>
        	<td class="text-right border-bottom">
        		<strong><h4>Sisa Bayar &nbsp; :</h4></strong>
        	</td>
        	<td class="text-right border-bottom">
        		<strong><h4>Rp <?php echo number_format($json_data_transaksi['pembayaran_akhir'],0,",",","); ?></h4></strong>
        	</td>
        </tr>

        </tbody>
    </table>
</div>

<div class="well m-t-xl">
	<center>
	<i>
    	<strong>Catatan : </strong>
        Pesanan yang sudah dipesan tidak dapat diubah kembali & Pesanan yang sudah diterima tidak dapat dikembalikan.
    </i>
	</center>
</div>