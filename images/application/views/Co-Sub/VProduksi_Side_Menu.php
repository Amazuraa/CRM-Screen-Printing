<ul class="list-group elements-list text-left">

<?php
	if (!empty($DataProduksi)) 
	{
		$i = 1;

		foreach ($DataProduksi as $ReadDS) 
		{
			$json_data_produksi = json_decode($ReadDS->data_produksi, true);
			$json_riwayat_produksi = json_decode($ReadDS->riwayat_produksi, true);
?>
    	<li class="list-group-item">
            <a class="<?php echo($i == 1) ? 'nav-link active':'nav-link' ;?> Test"
               data-toggle="tab" href="<?php echo '#tab-'.$i; ?>">

        		<i class="fa fa-user"></i> &nbsp;
        		<strong><?php echo $ReadDS->nama_pelanggan; ?></strong>
            	
            	<hr class="m-t-xs">

                <div class="small m-t-xs">
                	<table >
                		<tr>
                			<td width="50px">Jumlah</td>
                			<td>: &nbsp;<strong>
                				<?php echo $json_data_produksi['jumlah_pesanan']; ?>
                				 PCS</strong></td>
                		</tr>
                		<tr>
                			<td>Bahan</td>
                			<td>: &nbsp;<strong>
                				<?php echo $json_data_produksi['nama_bahan']; ?>
                			</strong></td>
                		</tr>
                	</table>
                	<br>
                    <p class="m-b-none">
                    	<?php 
                    		switch ($ReadDS->status_produksi) 
                    		{
                    			case 1:
                    				echo '<span class="label float-right 
                    								   label-warning">MENUNGGU</span>';
                    				break;
                    			
                    			case 2:
                    				echo '<span class="label float-right
                    				 				   label-primary">DIKERJAKAN</span>';
                    				break;

                    			case 3:
                    				echo '<span class="label float-right 
                    								   label-success">SELESAI</span>';
                    				break;

                    			case 4:
                    				echo '<span class="label float-right 
                    								   label-danger">DIBATALKAN</span>';
                    				break;
                    		}
                    	?>
                    	
                        <i class="fa fa-calendar-o"></i> &nbsp;
                        	<?php 
                        		$x = date_create($json_riwayat_produksi['pesanan_dibuat']);
                        		echo date_format($x, 'd M Y'); 
                        	?>
                    </p>
                </div>
            </a>
        </li>
<?php
			$i++;
		}
	}
?>

</ul>