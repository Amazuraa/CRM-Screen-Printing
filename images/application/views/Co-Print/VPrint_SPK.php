<!-- SPK -->
<?php
	$json_data_produksi = json_decode($DataProduksi->data_produksi, true);
	$json_riwayat_produksi = json_decode($DataProduksi->riwayat_produksi, true);
?>

<table border="0px" width="100%">
	<tr style="">
		<td>		
			<img class=""
    			 src="<?php echo base_url('images/spk_matrogob.png');?>"  
    			 style="width: 230px;
    			 		object-fit: contain;" />
    		
    		<hr class="hr-line-dashed">
		</td>
	</tr>
</table>

<div class="row">
	<div class="col-sm-6">
		<table border="0px" width="100%">
        	<tr>
    			<td>
    				<table class="table table-hover">
    					<tbody>
    						<tr>
    							<th style="background-color: #000000 !important; color: #A02F00;" colspan="2">
    								<center>Area Sablon</center>
    							</th>
    							<th class="bg-success">
    								<center>Ukuran</center>
    							</th>
    							<th class="bg-success">
    								<center>Warna</center>
    							</th>
    						</tr>
    						<?php 
    							$detail_sablon = json_decode($json_data_produksi['detail_sablon'], true);

    							if (!empty($detail_sablon)) 
    							{
    								foreach ($detail_sablon as $Read) 
    								{
    						?>
    							<tr>
        							<td width="20px;"><i class="fa fa-delicious"></i></td>
        							<td width="120px;"><?php echo $Read['posisi']; ?></td>
        							<td><?php echo $Read['ukuran']; ?></td>
        							<td><center><?php echo $Read['jumlah_warna']; ?> &nbsp;</center></td>
        						</tr>
								<tr>
									<td colspan="4" class="tab-i-images devMode">
									<?php
										$l_warna = intval($Read['jumlah_warna']);

										for ($m = 0; $m < $l_warna; $m++) 
										{ 
									?>
										<input name="input_image_layer[]" type="file" class="form-control ipt-image-layer"/>
									<?php
										}
									?>
                                        <input name="input_image_name[]" type="text" class="ipt-image-name devMode">
                                        <input name="input_area_sablon[]" type="text" class="devMode" value="<?php echo $Read['posisi']; ?>">
									</td>
								</tr>
    						<?php
    								}
    							}
    						?>
    					</tbody>
    				</table>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				<center><b><h4>DESIGN / PRODAK</h4></b></center>
    				<img class=""
            			 src="<?php
                                    if ($json_data_produksi['design_sablon'] != '')
                                        echo base_url('images/'.$json_data_produksi['design_sablon']);
                                    else
                                        echo base_url('images/no_image.png');
                                ?>"  
            			 style="width: 100%;
                                height: 270px;
            			 		object-fit: contain;" />

					<input name="input_image_design[]" type="file" class="form-control tab-i-image-design devMode"/>
    			</td>
    		</tr>
    		<tr>
    			<td colspan="2">
                    <table class="table table-hover m-t-md">
                        <tbody>
                            <?php 
                                $detail_sablon = json_decode($json_data_produksi['detail_sablon'], true);

                                if (!empty($detail_sablon)) 
                                {
                                    foreach ($detail_sablon as $Read) 
                                    {
                            ?>
                                <tr>
                                    <td width="20px;"><i class="fa fa-cube"></td>
                                    <td><?php echo $Read['posisi']; ?></td>
                                    <td width="220px;">
                                        <?php
                                            $l_warna = intval($Read['jumlah_warna']);

                                            for ($m = 1; $m <= $l_warna; $m++) 
                                            { 
                                        ?>
                                            <span class="label" style="background-color: <?php echo (empty($Read['step_warna'])) ? '#968d8d' : $Read['step_warna'][($m - 1)]; ?>; 
                                                                       color: white;">
                                                <?php echo $m; ?></span>
                                        <?php
                                            }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
    			</td>
    		</tr>
        </table>		
	</div>
	<div class="col-sm-6">
		<table border="0px" width="100%">
    		<tr>
    			<td>
    				<table class="table table-hover">
    					<tbody>
    						<tr>
    							<th class="bg-success" colspan="3">
    								<center>Data Produksi</center>
    							</th>
    						</tr>
    						<tr>
    							<td width="20px;"><i class="fa fa-circle-o"></i></td>
    							<td width="150px;">ID. Produksi</td>
    							<td>: &nbsp;PRO-<?php echo substr($DataProduksi->id_produksi, 3, 6)."-".substr($DataProduksi->id_produksi, 9); ?></td>
    						</tr>
    						<tr>
    							<td><i class="fa fa-user"></i></td>
    							<td>Nama Pelanggan</td>
    							<td class="tab-pelanggan">: &nbsp;Test</td>
    						</tr>
    						<tr>
    							<td><i class="fa fa-shopping-cart"></i></td>
    							<td>Jumlah Pesan</td>
    							<td class="tab-jumlah-pesanan">: &nbsp;<?php echo $json_data_produksi['jumlah_pesanan']; ?> PCS</td>
    						</tr>
    						<tr>
    							<td><i class="fa fa-arrows"></i></td>
    							<td>Ukuran</td>
    							<td>
    								<table style="width: 90%;" class="table-bordered m-l-sm">
    									<?php 
                							$ukuran_bahan = json_decode($json_data_produksi['ukuran_bahan'], true);

                							if (!empty($ukuran_bahan)) 
                							{
                								foreach ($ukuran_bahan as $Read) 
                								{
                						?>
    									<tr class="small">
    										<!-- <td style="width: 10px;"><i class="fa fa-caret-right"></i></td> -->
    										<td><?php echo $Read['ukuran']; ?></td>
    										<td><?php echo $Read['jumlah']; ?> &nbsp;Pcs</td>
    									</tr>
    									<?php
                								}
                							}
                						?>
    								</table>
    							</td>
    						</tr>
    						<tr>
    							<td><i class="fa fa-star"></i></td>
    							<td>Brand</td>
    							<td class="tab-brand">: &nbsp;<?php echo $json_data_produksi['brand']; ?></td>
    						</tr>
    						<tr>
    							<td><i class="fa fa-tag"></i></td>
    							<td>Bahan</td>
    							<td class="tab-nama-bahan">: &nbsp;<?php echo $json_data_produksi['nama_bahan']; ?></td>
    						</tr>
    						<tr>
    							<td><i class="fa fa-cube"></i></td>
    							<td>Warna</td>
    							<td class="tab-warna-bahan">: &nbsp;<?php echo $json_data_produksi['warna_bahan']; ?></td>
    						</tr>
    						<tr>
    							<td><i class="fa fa-adjust"></i></td>
    							<td>Tinta</td>
    							<td class="tab-nama-tinta">: &nbsp;<?php echo $json_data_produksi['nama_tinta']; ?></td>
    						</tr>
    						<tr>
    							<td style="text-align: center;"><i class="fa fa-calendar-o"></i></td>
    							<td>Tanggal Produksi</td>
    							<td>: &nbsp;<?php 
                                                $tgl_produksi = $json_riwayat_produksi['tgl_mulai_produksi'];

                                                if ($tgl_produksi != '')
                                                {
                                                    $x = date_create($tgl_produksi);
                                                    echo "<b>".date_format($x, 'd M Y')."</b>";
                                                }
                                                else
                                                    echo "-";
                                            ?>
                                </td>
    						</tr>
                            <tr>
                                <td style="text-align: center;"><i class="fa fa-calendar-o"></i></td>
                                <td>Tanggal Selesai</td>
                                <td>: &nbsp;<?php 
                                                $tgl_selesai = $json_riwayat_produksi['tgl_selesai_produksi'];

                                                if ($tgl_selesai != '')
                                                {
                                                    $x = date_create($tgl_selesai);
                                                    echo "<b>".date_format($x, 'd M Y')."</b>";
                                                }
                                                else
                                                    echo "-";
                                            ?></td>
                            </tr>
                            <?php
                                if ($DataProduksi->status_produksi == 3)
                                {
                            ?>
                                <tr>
                                    <td style="text-align: center;"><i class="fa fa-history"></i></td>
                                    <td>Lama Produksi</td>
                                    <td>: &nbsp;<?php echo $json_riwayat_produksi['lama_produksi']; ?> Hari</td>
                                </tr>    
                            <?php
                                }
                            ?>
    						
    					</tbody>
    				</table>
                    <br>
    			</td>
    		</tr>
    		
    	</table>
	</div>
</div>