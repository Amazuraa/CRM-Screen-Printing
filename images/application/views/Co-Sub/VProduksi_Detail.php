<script>

    $(document).ready(function()
    {   
        var b_pelanggan     = $(".btn-pelanggan");
        var bc_pelanggan    = $(".btn-c-pelanggan");
        var b_jumlah_pesanan    = $(".btn-jumlah-pesanan");
        var bc_jumlah_pesanan   = $(".btn-c-jumlah-pesanan");
        var b_ukuran        = $(".btn-ukuran");
        var bc_ukuran       = $(".btn-c-ukuran");
        var b_brand         = $(".btn-brand");
        var bc_brand        = $(".btn-c-brand");
        var b_nama_bahan    = $(".btn-nama-bahan");
        var bc_nama_bahan   = $(".btn-c-nama-bahan");
        var b_warna_bahan   = $(".btn-warna-bahan");
        var bc_warna_bahan  = $(".btn-c-warna-bahan");
        var b_nama_tinta    = $(".btn-nama-tinta");
        var bc_nama_tinta   = $(".btn-c-nama-tinta");

        var b_images        = $(".btn-images");
        var bc_images       = $(".btn-c-images");
        var b_image_design  = $(".btn-image-design");
        var bc_image_design = $(".btn-c-image-design");
        var b_color         = $(".btn-color");
        var bc_color        = $(".btn-c-color");

        var b_submit        = $(".btn-submit");

        var b_step_wana     = $(".btn-step-warna");
        var b_step_idx      = -1;

        var in_image_layer  = $(".ipt-image-layer");
        var in_color_picker = $(".ipt-picker");


        in_color_picker.change(function(){
            var idx         = parseInt(in_color_picker.index(this));
            var parent      = in_color_picker.eq(idx).parent();
            var input_color = parent.children(".ipt-step-warna");
            

            b_step_wana.eq(b_step_idx).css('background-color',$(this).val());
            $(".ipt-warna").eq(b_step_idx).html($(this).val());


            var i = 0;
            var input_value = "";

            parent.find(".ipt-warna").each(function(){                
                if (i == 0)
                    input_value = $(this).html();
                else
                    input_value = input_value + "," + $(this).html();

                i++;
            });

            input_color.val(input_value);
        });

        b_step_wana.click(function(){
            var idx         = parseInt(b_step_wana.index(this));
            var parent      = b_step_wana.eq(idx).parent();
            var color       = parent.children(".ipt-picker");
            
            b_step_idx      = idx;

            color.click();
            // alert(color.val());
        });

        in_image_layer.change(function(){
            var idx         = parseInt(in_image_layer.index(this));
            var parent      = in_image_layer.eq(idx).parent();
            var input_name  = parent.children(".ipt-image-name");
            var idx_val     = "";

            parent.children(".ipt-image-layer").each(function(){

                if (idx_val == "")
                    idx_val = $(this)[0].files[0]['name'];
                else
                    idx_val = idx_val + "," + $(this)[0].files[0]['name'];


                input_name.val(idx_val);
            });
            
        });


        b_pelanggan.click(function(){       
            var idx = parseInt(b_pelanggan.index(this));
            Click_Pelanggan(idx);

            b_submit.show();
        });

        bc_pelanggan.click(function(){
            var idx = parseInt(bc_pelanggan.index(this));    
            Close_Pelanggan(idx);
        });
        
        b_jumlah_pesanan.click(function(){       
            var idx = parseInt(b_jumlah_pesanan.index(this));
            Click_Jumlah_Pesanan(idx);

            b_submit.show();
        });

        bc_jumlah_pesanan.click(function(){       
            var idx = parseInt(bc_jumlah_pesanan.index(this));
            Close_Jumlah_Pesanan(idx);
        });

        b_ukuran.click(function(){       
            var idx = parseInt(b_ukuran.index(this));
            Click_Ukuran(idx);

            b_submit.show();
        });

        bc_ukuran.click(function(){       
            var idx = parseInt(bc_ukuran.index(this));
            Close_Ukuran(idx);
        });

        b_brand.click(function(){       
            var idx = parseInt(b_brand.index(this));
            Click_Brand(idx);

            b_submit.show();
        });

        bc_brand.click(function(){
            var idx = parseInt(bc_brand.index(this));
            Close_Brand(idx);
        });

        b_nama_bahan.click(function(){       
            var idx = parseInt(b_nama_bahan.index(this));
            Click_Bahan(idx);

            b_submit.show();
        });

        bc_nama_bahan.click(function(){       
            var idx = parseInt(bc_nama_bahan.index(this));
            Close_Bahan(idx);
        });

        b_warna_bahan.click(function(){       
            var idx = parseInt(b_warna_bahan.index(this));
            Click_Warna(idx);

            b_submit.show();
        });

        bc_warna_bahan.click(function(){       
            var idx = parseInt(bc_warna_bahan.index(this));
            Close_Warna(idx);
        });

        b_nama_tinta.click(function(){       
            var idx = parseInt(b_nama_tinta.index(this));
            Click_Tinta(idx);

            b_submit.show();
        });

        bc_nama_tinta.click(function(){       
            var idx = parseInt(bc_nama_tinta.index(this));
            Close_Tinta(idx);
        });

        b_images.click(function(){       
            var idx = parseInt(b_images.index(this));
            Click_Images(idx);

            b_submit.show();
        });

        bc_images.click(function(){       
            var idx = parseInt(bc_images.index(this));
            Close_Images(idx);
        });

        b_image_design.click(function(){       
            var idx = parseInt(b_image_design.index(this));
            Click_Image_Design(idx);

            b_submit.show();
        });

        bc_image_design.click(function(){
            var idx = parseInt(bc_image_design.index(this));
            Close_Image_Design(idx);
        });

        b_color.click(function(){       
            var idx = parseInt(b_color.index(this));
            Click_Color(idx);

            b_submit.show();
        });

        bc_color.click(function(){       
            var idx = parseInt(bc_color.index(this));
            Close_Color(idx);
        });
    });

    function Click_Pelanggan(idx)
    {
        $(".btn-pelanggan").eq(idx).hide();
        $(".btn-c-pelanggan").eq(idx).show();

        $('.tab-pelanggan').eq(idx).hide();
        $('.tab-i-pelanggan').eq(idx).show();
    }

    function Close_Pelanggan(idx)
    {
        $(".btn-pelanggan").eq(idx).show();
        $(".btn-c-pelanggan").eq(idx).hide();

        $('.tab-pelanggan').eq(idx).show();
        $('.tab-i-pelanggan').eq(idx).hide();
    }

    function Click_Jumlah_Pesanan(idx)
    {
        $(".btn-jumlah-pesanan").eq(idx).hide();
        $(".btn-c-jumlah-pesanan").eq(idx).show();

        $('.tab-jumlah-pesanan').eq(idx).hide();
        $('.tab-i-jumlah-pesanan').eq(idx).show();
    }

    function Close_Jumlah_Pesanan(idx)
    {
        $(".btn-jumlah-pesanan").eq(idx).show();
        $(".btn-c-jumlah-pesanan").eq(idx).hide();

        $('.tab-jumlah-pesanan').eq(idx).show();
        $('.tab-i-jumlah-pesanan').eq(idx).hide();
    }

    function Click_Ukuran(idx)
    {
        $(".btn-ukuran").eq(idx).hide();
        $(".btn-c-ukuran").eq(idx).show();
    }

    function Close_Ukuran(idx)
    {
        $(".btn-ukuran").eq(idx).show();
        $(".btn-c-ukuran").eq(idx).hide();
    }

    function Click_Brand(idx)
    {
        $(".btn-brand").eq(idx).hide();
        $(".btn-c-brand").eq(idx).show();

        $('.tab-brand').eq(idx).hide();
        $('.tab-i-brand').eq(idx).show();
    }

    function Close_Brand(idx)
    {
        $(".btn-brand").eq(idx).show();
        $(".btn-c-brand").eq(idx).hide();

        $('.tab-brand').eq(idx).show();
        $('.tab-i-brand').eq(idx).hide();
    }

    function Click_Bahan(idx)
    {
        $(".btn-nama-bahan").eq(idx).hide();
        $(".btn-c-nama-bahan").eq(idx).show();

        $('.tab-nama-bahan').eq(idx).hide();
        $('.tab-i-nama-bahan').eq(idx).show();
    }

    function Close_Bahan(idx)
    {
        $(".btn-nama-bahan").eq(idx).show();
        $(".btn-c-nama-bahan").eq(idx).hide();

        $('.tab-nama-bahan').eq(idx).show();
        $('.tab-i-nama-bahan').eq(idx).hide();
    }

    function Click_Warna(idx)
    {
        $(".btn-warna-bahan").eq(idx).hide();
        $(".btn-c-warna-bahan").eq(idx).show();

        $('.tab-warna-bahan').eq(idx).hide();
        $('.tab-i-warna-bahan').eq(idx).show();
    }

    function Close_Warna(idx)
    {
        $(".btn-warna-bahan").eq(idx).show();
        $(".btn-c-warna-bahan").eq(idx).hide();

        $('.tab-warna-bahan').eq(idx).show();
        $('.tab-i-warna-bahan').eq(idx).hide();
    }

    function Click_Tinta(idx)
    {
        $(".btn-nama-tinta").eq(idx).hide();
        $(".btn-c-nama-tinta").eq(idx).show();

        $('.tab-nama-tinta').eq(idx).hide();
        $('.tab-i-nama-tinta').eq(idx).show();
    }

    function Close_Tinta(idx)
    {
        $(".btn-nama-tinta").eq(idx).show();
        $(".btn-c-nama-tinta").eq(idx).hide();

        $('.tab-nama-tinta').eq(idx).show();
        $('.tab-i-nama-tinta').eq(idx).hide();
    }

    function Click_Images(idx)
    {
        $(".btn-images").eq(idx).hide();
        $(".btn-c-images").eq(idx).show();

        $('.tab-i-images').eq(idx).show();
    }

    function Close_Images(idx)
    {
        $(".btn-images").eq(idx).show();
        $(".btn-c-images").eq(idx).hide();

        $('.tab-i-images').eq(idx).hide();
    }

    function Click_Image_Design(idx)
    {
        $(".btn-image-design").eq(idx).hide();
        $(".btn-c-image-design").eq(idx).show();

        $('.tab-i-image-design').eq(idx).show();
    }

    function Close_Image_Design(idx)
    {
        $(".btn-image-design").eq(idx).show();
        $(".btn-c-image-design").eq(idx).hide();

        $('.tab-i-image-design').eq(idx).hide();
    }

    function Click_Color(idx)
    {
        $(".btn-color").eq(idx).hide();
        $(".btn-c-color").eq(idx).show();

        $('.tab-i-step-color').eq(idx).show();   
    }

    function Close_Color(idx)
    {
        $(".btn-color").eq(idx).show();
        $(".btn-c-color").eq(idx).hide();

        $('.tab-i-step-color').eq(idx).hide();   
    }
</script>    

<div class="element-detail-box">
    <div class="tab-content">

		<input type="text" name="input_id_produksi" class="devMode input_id_produksi">
        <input type="text" name="input_idx" class="devMode ipt-idx" value="0">
        

	<?php
    	if (!empty($DataProduksi)) 
    	{
    		$i = 1;

    		foreach ($DataProduksi as $ReadDS) 
    		{
    			$json_data_produksi = json_decode($ReadDS->data_produksi, true);
    			$json_riwayat_produksi = json_decode($ReadDS->riwayat_produksi, true);
    ?>
        <div id="<?php echo 'tab-'.$i; ?>" 
        	 class="<?php echo($i == 1) ? 'tab-pane active':'tab-pane' ;?>">

        	<table border="0px" width="100%">
        		<tr style="">
        			<td>
        				<br>
            			<label class="badge p-xs b-r-sm 
                                      <?php echo ($ReadDS->status_produksi == '2') ? 'badge-info' : ''; ?>">
            					No. PRO/<?php echo substr($ReadDS->id_produksi, 3, 6)."/".substr($ReadDS->id_produksi, 9); ?>
            			</label>
            			
        				<a class="btn btn-white btn-sm m-l-xs"
        				   href="<?php echo site_url('Welcome/PrintOut/SPK/'.$ReadDS->id_produksi) ?>" style="float: right;">
        				   <i class="fa fa-print"></i>&nbsp; Print
        				</a>

                        <?php
                            switch ($ReadDS->status_produksi) 
                            {
                                case 1:
                        ?>
                                <a class="btn btn-white btn-sm m-l-xs"
                                   href="<?php echo site_url('Welcome/Produksi_Update/1/'.$ReadDS->id_produksi) ?>"
                                   style="float: right;">
                                   <i class="fa fa-bolt"></i>&nbsp; Mulai   
                                </a>
                        <?php
                                    break;
                                
                                case 2:
                        ?>
                                <a class="btn btn-white btn-sm m-l-xs"
                                   href="<?php echo site_url('Welcome/Produksi_Update/2/'.$ReadDS->id_produksi) ?>"
                                   style="float: right;">
                                   <i class="fa fa-bolt"></i>&nbsp; Selesai
                                </a>
                        <?php
                                    break;
                            }
                        ?>

        				
        			</td>
        		</tr>
            </table>
            <table border="0px" width="100%" id="capture">
        		<tr>
        			<td>
        				<hr class="hr-line-dashed">
        				<center>
        				<img class="m-t-sm"
                			 src="<?php echo base_url('images/spk_matrogob.png');?>"  
                			 style="width: 230px;
                			 		object-fit: contain;" />
                		</center>
        			</td>
        		</tr>
        		
        		<tr>
        			<td>
        				<br>
        				<table class="table table-hover">
        					<tbody>
        						<tr>
        							<th class="bg-success" colspan="3">
        								<center>Data Produksi</center>
        							</th>
        						</tr>
        						<tr>
        							<td width="20px;">
                                        <button type="button" class="btn btn-xs btn-pelanggan" style="border-radius: 100px;">
                                            <i class="fa fa-user"></i>
                                        </button>
                                        <button type="button" class="btn btn-xs btn-warning btn-c-pelanggan devMode" style="border-radius: 100px;">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
        							<td width="150px;">Nama Pelanggan</td>
        							<td class="tab-pelanggan">: &nbsp;<?php echo $ReadDS->nama_pelanggan; ?></td>
                                    <td class="tab-i-pelanggan devMode"><input type="text" name="input_pelanggan[]" class="form-control" value="<?php echo $ReadDS->nama_pelanggan; ?>"></td>
        						</tr>
        						<tr>
        							<td>
                                        <button type="button" class="btn btn-xs btn-jumlah-pesanan" style="border-radius: 100px;">
                                            <i class="fa fa-shopping-cart"></i>
                                        </button>
                                        <button type="button" class="btn btn-xs btn-warning btn-c-jumlah-pesanan devMode" style="border-radius: 100px;">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
        							<td>Jumlah Pesan</td>
        							<td class="tab-jumlah-pesanan">: &nbsp;<?php echo $json_data_produksi['jumlah_pesanan']; ?> PCS</td>
                                    <td class="tab-i-jumlah-pesanan devMode"><input type="number" name="input_jumlah_pesanan[]" class="form-control" value="<?php echo $json_data_produksi['jumlah_pesanan']; ?>"></td>
        						</tr>
        						<tr>
        							<td>
                                        <button type="button" class="btn btn-xs btn-ukuran" style="border-radius: 100px;">
                                            <i class="fa fa-arrows"></i>
                                        </button>
                                        <button type="button" class="btn btn-xs btn-warning btn-c-ukuran devMode" style="border-radius: 100px;">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
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
        							<td>
                                        <button type="button" class="btn btn-xs btn-brand" style="border-radius: 100px;">
                                            <i class="fa fa-star"></i>
                                        </button>
                                        <button type="button" class="btn btn-xs btn-warning btn-c-brand devMode" style="border-radius: 100px;">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
        							<td>Brand</td>
        							<td class="tab-brand">: &nbsp;<?php echo $json_data_produksi['brand']; ?></td>
                                    <td class="tab-i-brand devMode"><input type="name" name="input_brand[]" class="form-control" value="<?php echo $json_data_produksi['brand']; ?>"></td>
        						</tr>
        						<tr>
        							<td>
                                        <button type="button" class="btn btn-xs btn-nama-bahan" style="border-radius: 100px;">
                                            <i class="fa fa-tag"></i>
                                        </button>
                                        <button type="button" class="btn btn-xs btn-warning btn-c-nama-bahan devMode" style="border-radius: 100px;">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
        							<td>Bahan</td>
        							<td class="tab-nama-bahan">: &nbsp;<?php echo $json_data_produksi['nama_bahan']; ?></td>
                                    <td class="tab-i-nama-bahan devMode"><input type="name" name="input_nama_bahan[]" class="form-control" value="<?php echo $json_data_produksi['nama_bahan']; ?>"></td>
        						</tr>
        						<tr>
        							<td>
                                        <button type="button" class="btn btn-xs btn-warna-bahan" style="border-radius: 100px;">
                                            <i class="fa fa-cube"></i>
                                        </button>
                                        <button type="button" class="btn btn-xs btn-warning btn-c-warna-bahan devMode" style="border-radius: 100px;">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
        							<td>Warna</td>
        							<td class="tab-warna-bahan">: &nbsp;<?php echo $json_data_produksi['warna_bahan']; ?></td>
                                    <td class="tab-i-warna-bahan devMode"><input type="name" name="input_warna_bahan[]" class="form-control" value="<?php echo $json_data_produksi['warna_bahan']; ?>"></td>
        						</tr>
        						<tr>
        							<td>
                                        <button type="button" class="btn btn-xs btn-nama-tinta" style="border-radius: 100px;">
                                            <i class="fa fa-adjust"></i>
                                        </button>
                                        <button type="button" class="btn btn-xs btn-warning btn-c-nama-tinta devMode" style="border-radius: 100px;">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
        							<td>Tinta</td>
        							<td class="tab-nama-tinta">: &nbsp;<?php echo $json_data_produksi['nama_tinta']; ?></td>
                                    <td class="tab-i-nama-tinta devMode"><input type="name" name="input_nama_tinta[]" class="form-control" value="<?php echo $json_data_produksi['nama_tinta']; ?>"></td>
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
                                    if ($ReadDS->status_produksi == 3)
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
        		<tr>
        			<td>
        				<table class="table table-hover">
        					<tbody>
        						<tr>
        							<th class="bg-success" colspan="2">
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
            							<td width="20px;">
                                            <button type="button" class="btn btn-xs btn-images" style="border-radius: 100px;">
                                                <i class="fa fa-delicious"></i>
                                            </button>
                                            <button type="button" class="btn btn-xs btn-warning btn-c-images devMode" style="border-radius: 100px;">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
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
        			<td >
        				<hr class="hr-line-dashed">
                        <button type="button" class="btn btn-xs m-l-sm btn-image-design" style="border-radius: 100px; float: left;">
                            <i class="fa fa-file-o"></i>
                        </button>
                        <button type="button" class="btn btn-xs m-l-sm btn-warning btn-c-image-design devMode" style="border-radius: 100px; float: left;">
                            <i class="fa fa-times"></i>
                        </button>
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
        				<br><hr class="hr-line-dashed">
        				<center><b><h4>STEP WARNA</h4></b></center>

                        <table class="table table-hover">
                            <tbody>
                                <?php 
                                    $detail_sablon = json_decode($json_data_produksi['detail_sablon'],
                                                                 true);

                                    if (!empty($detail_sablon)) 
                                    {
                                        foreach ($detail_sablon as $Read) 
                                        {
                                ?>
                                    <tr>
                                        <td width="20px;">
                                            <button type="button" class="btn btn-xs btn-color" style="border-radius: 100px;">
                                                <i class="fa fa-cube"></i>
                                            </button>
                                            <button type="button" class="btn btn-xs btn-warning btn-c-color devMode" style="border-radius: 100px;">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
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
                                    <tr class="tab-i-step-color devMode">
                                        <td colspan="2" style=" text-align: center;"></td>
                                        <td>
                                            <input type="color" value="#ffffff" class="ipt-picker" style="float: right; width: 0px; height: 0px; border: none; overflow: hidden;">
                                        <?php
                                            $l_warna = intval($Read['jumlah_warna']);

                                            for ($m = 1; $m <= $l_warna; $m++) 
                                            { 
                                        ?>
                                            <button type="button" class="btn btn-xs btn-step-warna m-b-xs" style="background-color: <?php echo (empty($Read['step_warna'])) ? '#968d8d' : $Read['step_warna'][($m - 1)]; ?>; 
                                                                                                                  color: white; width: 96%;">
                                                <span style="float: left;"><?php echo $m; ?></span>
                                                <span class="ipt-warna"><?php echo (empty($Read['step_warna'])) ? 'Tambah Warna' : $Read['step_warna'][($m - 1)]; ?></span>
                                            </button><br>
                                        <?php
                                            }
                                        ?>
                                            
                                            <input name="input_step_warna[]" type="text" class="ipt-step-warna devMode">
                                            <input name="input_area_warna[]" type="text" class="devMode" value="<?php echo $Read['posisi']; ?>">
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
    <?php
    			$i++;
    		}
    	}
    ?>
    </div>
</div>
