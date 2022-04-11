
<!-- <h3>Daftar Transaksi</h3> -->

<?php
	// print_r($DataTransaksi)

	if (!empty($DataTransaksi))
	{
		$i = 1;
		foreach ($DataTransaksi as $ReadDS) 
		{
?>
<div class="ibox-content sk-loading no-padding m-sm m-b-md">
    <!-- <div class="table-responsive"> -->
        <table class="table shoping-cart-table m-t">
            <tbody>
            <tr>
                <td width="90" style="text-align: center;">
                	<img src="<?php echo base_url('images/no_image.png');?>" 
                		 style="height: 115px; width: 200px; object-fit: contain;"
                		 class="m-b-xs">

                	<?php $data_transaksi = json_decode($ReadDS->data_transaksi, true); ?>
                	<span class="label label-muted"><?php echo $data_transaksi['tgl_masuk']; ?></span> ~ 
                	<span class="label label-muted">x</span>
                </td>
                <td class="desc">
                    <h3 class="m-b-none">
	                    <a href="#" class="text-navy">
	                        <?php 
	                        	$data_produksi = json_decode($ReadDS->data_produksi, true);

	                        	echo $ReadDS->nama_pelanggan.' - '.$data_produksi['brand']; 
	                        ?>
	                    </a>
                    </h3>
                    
                    <b>ID. TRN/<?php echo substr($ReadDS->id_transaksi, 3, 6)."/".substr($ReadDS->id_transaksi, 9); ?>
                    </b>

                    
                    <p class="m-t-sm">
                    	<i class="fa fa-circle"></i>&nbsp; <?php echo $data_produksi['jumlah_pesanan'].' PCS'; ?><br>
                    	<i class="fa fa-circle"></i>&nbsp; <?php echo $data_produksi['nama_bahan']; ?><br>
                    	<i class="fa fa-circle"></i>&nbsp; <?php echo $data_produksi['nama_tinta']; ?>
                    </p>

                    <div class="m-t-sm">
                        <i class="fa fa-star"></i>&nbsp;
                        <b><a href="<?php echo site_url('Welcome/Invoice_Transaksi') ?>" 
                        	  target="_blank" 
                        	  class="text-navy"> 
                        	No. INV/<?php echo substr($ReadDS->id_transaksi, 3, 6)."/".substr($ReadDS->id_transaksi, 9); ?>
                        </a></b>
                    </div>
                </td>
                <td style="width: 100px;">
                	<?php
                		switch ($ReadDS->status_transaksi) {
                			case 1:
                				echo "<span class='label label-warning'>Menunggu Produksi</span>";
                				break;
                			
                			case 2:
                				echo "<span class='label label-success'>Produksi Berlangsung</span>";
                				break;

                			case 3:
                				echo "<span class='label label-primary'>Penyelesaian Transaksi</span>";
                				break;

                			case 4:
                				echo "<span class='label label-primary'>Selesai</span>";
                				break;
                		}
                	?>
                	
                	
                	<label class="m-t-lg">Total
	                	<h4>
	                		<?php
	                			$data_biaya = json_decode($ReadDS->data_biaya, true);
	                			echo 'Rp '.number_format($data_biaya['total_harga_final'],0,",",",");
	                		?>
	                	</h4>
	                </label>
                    
                </td>
            </tr>
            </tbody>
        </table>
    <!-- </div> -->
</div>
<?php
		}
	}
?>