<h3 class="m-t-sm"><i class="fa fa-search"></i>&nbsp; 
	Detail Biaya Produksi
</h3>
<div class="hr-line-dashed m-t-none"></div>

<div class="row">
	<div class="col-sm-7">
		<!-- TABLE FORMULA BIAYA -->
        <table class="table table-hover">
            <thead>
            <tr style="height: 45px;">
                <th style="vertical-align: middle; text-align: center; background-color: #FFBF86; color: #B85C38;">
                	#</th>
                <th style="vertical-align: middle; background-color: #FFBF86; color: #B85C38;">
                	Formula Biaya-Biaya</th>
                <th class="text-right" style="vertical-align: middle; background-color: #FFBF86; color: #B85C38;">
                	Biaya</th>
                <th class="text-right" style="vertical-align: middle; background-color: #FFBF86; color: #B85C38; width: 120px;">
                	Total Biaya</th>
            </tr>
            </thead>
            <tbody>
            <?php
            	$FormulaBiaya = json_decode($DataFormula->biaya_formula, true);

				if(!empty($FormulaBiaya))
				{
					$i = 1;
					foreach($FormulaBiaya as $ReadDS)
					{
			?>
            <tr>
                <td style="<?php 
			            		if ($ReadDS['rincian'] == 'Biaya Bahan Kaos') 
			            			echo "background-color: #BCFFB9; color: #055052;";
			            		else if ($ReadDS['rincian'] == 'Biaya Polyfilm')
			            			echo "background-color: #A9F1DF; color: #34656D;";
			            		else if ($ReadDS['rincian'] == 'Biaya Tinta Sablon')
			            			echo "background-color: #FFAEC0; color: #9B5151;";
			            	?>"><center><?php echo $i; ?></center></td>
                <td style="<?php 
			            		if ($ReadDS['rincian'] == 'Biaya Bahan Kaos') 
			            			echo "background-color: #BCFFB9; color: #055052;";
			            		else if ($ReadDS['rincian'] == 'Biaya Polyfilm')
			            			echo "background-color: #A9F1DF; color: #34656D;";
			            		else if ($ReadDS['rincian'] == 'Biaya Tinta Sablon')
			            			echo "background-color: #FFAEC0; color: #9B5151;";
			            	?>">
                	<!-- MAIN INPUT -->
                	<input type="text" value="<?php echo $ReadDS['rincian']; ?>" 
                		   class="devMode" name="input_detail_rincian_biaya[]">

                	<?php echo $ReadDS['rincian']; ?>
                </td>
                <td class="text-right" style="<?php 
								            		if ($ReadDS['rincian'] == 'Biaya Bahan Kaos') 
								            			echo "background-color: #BCFFB9; color: #055052;";
								            		else if ($ReadDS['rincian'] == 'Biaya Polyfilm')
								            			echo "background-color: #A9F1DF; color: #34656D;";
								            		else if ($ReadDS['rincian'] == 'Biaya Tinta Sablon')
								            			echo "background-color: #FFAEC0; color: #9B5151;";
								            	?>">
                	<!-- MAIN INPUT -->
                	<input type="text" value="<?php echo $ReadDS['biaya']; ?>"
   						   class="devMode detail_biaya" name="input_detail_biaya[]">

                	<label class="show_detail_biaya"><?php 
                		echo number_format($ReadDS['biaya'],0,",",","); ?></label>
                </td>
                <td class="text-right" style="<?php 
								            		if ($ReadDS['rincian'] == 'Biaya Bahan Kaos') 
								            			echo "background-color: #BCFFB9; color: #055052;";
								            		else if ($ReadDS['rincian'] == 'Biaya Polyfilm')
								            			echo "background-color: #A9F1DF; color: #34656D;";
								            		else if ($ReadDS['rincian'] == 'Biaya Tinta Sablon')
								            			echo "background-color: #FFAEC0; color: #9B5151;";
								            	?>">
                	<!-- MAIN INPUT -->
                	<input type="text" value="0"
                		   class="devMode detail_total_biaya" name="input_detail_total_biaya[]">

                	<label class="show_detail_total_biaya">0</label>
                </td>
				<td class="devMode">
					<label class="rumus_biaya"><?php echo $ReadDS['rumus']; ?></label>
				</td>
            </tr>
            <?php
            			$i++;
            		}
            	}
            ?>
			<tr>
				<td colspan="3" style="text-align: right; background-color: #FFBF86; color: #B85C38;">
					<h4>TOTAL BIAYA PRODUKSI &nbsp;&nbsp; :</h4>
				</td>
				<td class="text-right" style="background-color: #FFBF86; color: #B85C38;">
					<!-- MAIN INPUT -->
					<input type="number" value="0"
						   class="devMode" id="total_biaya_produksi"
						   name="input_total_biaya_produksi">

					<h4 id="show_total_biaya_produksi">Rp 0</h4>
				</td>
			</tr>
			<tr>
				<td colspan="3" style="text-align: right; background-color: #FDE49C; color: #B85C38;">
					Beban Produksi &nbsp;&nbsp; :
				</td>
				<td class="text-right" style="background-color: #FDE49C; color: #B85C38;">
					<!-- MAIN INPUT -->
					<input type="number" value="0"
						   class="devMode" id="beban_produksi"
						   name="input_beban_produksi">

					<label id="show_beban_produksi">Rp 0</label>
				</td>
			</tr>
			<tr>
				<td colspan="3" style="text-align: right; background-color: #FDE49C; color: #B85C38;">
					Operasional Produksi &nbsp;&nbsp; :
				</td>
				<td class="text-right" style="background-color: #FDE49C; color: #B85C38;">
					<!-- MAIN INPUT -->
					<input type="number" value="0"
						   class="devMode" id="operasional_produksi"
						   name="input_operasional_produksi">

					<label id="show_operasional_produksi">Rp 0</label>
				</td>
			</tr>
			<tr>
				<td colspan="3" style="text-align: right; background-color: #FDE49C; color: #B85C38;">
					Biaya Borongan &nbsp;&nbsp; :
				</td>
				<td class="text-right" style="background-color: #FDE49C; color: #B85C38;">
					<!-- MAIN INPUT -->
					<input type="number" value="0"
						   class="devMode" id="biaya_borongan"
						   name="input_biaya_borongan">

					<label id="show_biaya_borongan">Rp 0</label>
				</td>
			</tr>
            </tbody>
        </table>
    </div>

    <div class="col-sm-5">
    	<!-- TABLE BAHAN BIAYA -->
    	<table class="table table-hover table-bordered">
            <thead>
            <tr style="height: 45px;">
                <th class="text-center" colspan="3" 
                	style="vertical-align: middle; background-color: #BCFFB9; color: #055052;">
                	Jenis Bahan
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
            	<td colspan="3" style="text-align: center;">
            		<label id="show_bahan">- - -</label>
            	</td>	
            </tr>
            </tbody>

            <thead>
            <tr style="height: 45px;">
                <th style="vertical-align: middle; background-color: #BCFFB9; color: #055052;">
                	Ukuran</th>
                <th class="text-right" style="vertical-align: middle; background-color: #BCFFB9; color: #055052;">
                	Biaya</th>
                <th class="text-right" style="vertical-align: middle; background-color: #BCFFB9; color: #055052;">
                	Total Biaya</th>
            </tr>
            </thead>
            <tbody>
			<?php
				$DetailBahan = json_decode($DataBahan->detail_bahan, true);
				if(!empty($DetailBahan))
				{
					$DetailUkuran = json_decode($DetailBahan[0]['ukuran'], true);

					foreach($DetailUkuran as $ReadDS)
					{
			?>
            <tr class="tab_harga_bahan devMode">
				<td><?php echo $ReadDS; ?></td>
				<td class="text-right">
					<label class="show_harga_bahan">0</label>
				</td>
				<td class="text-right">
					<label class="show_harga_total_bahan">0</label>
				</td>
			</tr>
			<?php
					}
				}
			?>
			<tr>
				<td colspan="2" class="text-right">
					<b>Total</b></td>
				<td class="text-right">
					<b><label id="show_total_bahan">0</label></b>
				</td>
			</tr>
            </tbody>
        </table>

        <br>

    	<!-- TABLE POLYFILM BIAYA -->
    	<table class="table table-hover table-bordered">
            <thead>
            <tr style="height: 45px;">
                <th style="vertical-align: middle; background-color: #A9F1DF; color: #34656D;">
                	Polyfilm</th>
                <th class="text-right" style="vertical-align: middle; background-color: #A9F1DF; color: #34656D;">
                	Biaya</th>
                <th class="text-right" style="vertical-align: middle; background-color: #A9F1DF; color: #34656D;">
                	Total Biaya</th>
            </tr>
            </thead>
            <tbody>
            <?php
            	$FormulaPosisi = json_decode($DataFormula->posisi_formula, true);

				if(!empty($FormulaPosisi))
				{
					foreach($FormulaPosisi as $ReadDS)
					{
			?>
            <tr class="tab_biaya_polyfilm devMode">

				<td><?php echo $ReadDS; ?></td>
				<td class="text-right" >
					<label class="show_biaya_polyfilm">0</label>
				</td>
				<td class="text-right">
					<label class="show_biaya_total_polyfilm">0</label>
				</td>
			</tr>
			<?php
					}
				}
			?>
			<tr>
				<td colspan="2" class="text-right"><b>Total</b></td>
				<td class="text-right">
					<b><label id="show_total_polyfilm">0</label></b>
				</td>
			</tr>
            </tbody>
        </table>

        <br>

        <!-- TABLE TINTA BIAYA -->
        <table class="table table-hover table-bordered">
            <thead>
            <tr style="height: 45px;">
                <th style="vertical-align: middle; background-color: #FFAEC0; color: #9B5151;">
                	Tinta Sablon</th>
                <th class="text-right" style="vertical-align: middle; background-color: #FFAEC0; color: #9B5151;">
                	Biaya</th>
                <th class="text-right" style="vertical-align: middle; background-color: #FFAEC0; color: #9B5151;">
                	Total Biaya</th>
            </tr>
            </thead>
            <tbody>
            <?php
				if(!empty($FormulaPosisi))
				{
					foreach($FormulaPosisi as $ReadDS)
					{
			?>
            <tr class="tab_biaya_tinta devMode">
				<td><?php echo $ReadDS; ?></td>
				<td class="text-right">
					<label class="show_biaya_tinta">0</label>
				</td>
				<td class="text-right">
					<label class="show_biaya_total_tinta">0</label>
				</td>
			</tr>
			<?php
					}
				}
			?>
			<tr>
				<td colspan="2" class="text-right"><b>Total</b></td>
				<td class="text-right">
					<b><label id="show_total_tinta">0</label></b>
				</td>
			</tr>
            </tbody>
        </table>
    </div>
</div>

<br><br>
<h3 class="m-t-xl"><i class="fa fa-paper-plane"></i>&nbsp; 
	Perbandingan & Biaya Final
</h3>
<div class="hr-line-dashed m-t-none"></div>

<div class="form-group row m-l-none">
	<label class="col-sm-3 col-form-label">Persentase Usaha</label>
	<div class="col-sm-5 m-l-n-sm">
		<div class="input-group m-b-sm">
            <div class="input-group-prepend">
                <button class="btn btn-outline btn-info" type="button"
                		style="width: 50px;"
                		id="button_persentase_usaha_show">
                <i class="fa fa-pencil"></i>
                </button>

                <button class="btn btn-warning devMode" type="button"
                		style="width: 50px;"
                		id="button_persentase_usaha_hide">
                <i class="fa fa-times"></i>
                </button>
            </div>

            <!-- MAIN_INPUT -->
    		<input type="text" class="form-control text-right" readonly="true" value="30"
    			   name="input_persentase" id="persentase">

    		<div class="input-group-append">
            	<span class="input-group-addon"> % </span>
            </div>
		</div>
	</div>
</div>

<div class="row">
    <div class="col-sm-6 ">
    	<!-- TABLE PERBANDINGAN BIAYA -->
        <table class="table table-hover text-right">
            <tbody>
            <tr>
				<td><h4 id="lab_kaos_sablon">Harga Kaos + Sablon &nbsp;&nbsp;</h4></td>
				<td style="width: 130px;">
					<!-- MAIN INPUT -->
					<input type="number" value="0"
						   name="input_harga_kaos_sablon" 
						   class="devMode" id="harga_kaos_sablon">

					<label id="show_harga_kaos_sablon">Rp 0</label> 
				</td>
			</tr>
			<tr>
				<td><h4>Harga Sablon Saja &nbsp;&nbsp;</h4></td>
				<td>
					<!-- MAIN INPUT -->
					<input type="number" value="0"
						   name="input_harga_sablon_saja" 
						   class="devMode" id="harga_sablon">

					<label id="show_harga_sablon">Rp 0</label>
				</td>
			</tr>
			<tr style="background-color: #845EC2; color: #F1F1F1;">
				<td><h4>TOTAL HARGA MINIMUM &nbsp;&nbsp;</h4></td>
				<td>
					<!-- MAIN INPUT -->
					<input type="number" value="0"
						   name="input_harga_minimum" 
						   class="devMode" id="harga_minimum">

					<h4 id="show_harga_minimum">Rp 0</h4>
				</td>
			</tr>
            </tbody>
        </table>
    </div>

    <div class="col-sm-6 border-left">
        <table class="table table-hover text-right">
            <tbody>
            <tr>
				<td><h4>Harga Final / PCS &nbsp;&nbsp;</h4></td>
				<td style="width: 140px;">
					<!-- MAIN_INPUT -->
					<input type="number" style="height: 30px;"
						   class="form-control text-right" min="0" value="0" 
						   name="input_harga_final" id="harga_final">
				</td>
			</tr>
			<tr>
				<td colspan="2" style="height: 45px;"><label></label></td>
			</tr>
			<tr style="background-color: #C56183; color: #F1F1F1;">
				<td><h4>TOTAL HARGA FINAL &nbsp;&nbsp;</h4></td>
				<td>
					<!-- MAIN INPUT -->
					<input type="number" value="0"
						   name="input_total_harga_final" 
						   class="devMode" id="total_harga_final">

					<h4 id="show_total_harga_final">Rp 0</h4>
				</td>
			</tr>
			<tr>
				<td><h4>Total Bayar  &nbsp;&nbsp;</h4></td>
				<td>
					<!-- MAIN INPUT -->
					<input type="number" style="height: 30px;"
						   class="form-control text-right" min="0" value="0" 
						   name="input_total_bayar" id="total_bayar">
				</td>
			</tr>
			<tr>
				<td><h4>Sisa Bayar  &nbsp;&nbsp;</h4></td>
				<td>
					<!-- MAIN INPUT -->
					<input type="number" value="0"
						   name="input_sisa_bayar" 
						   class="devMode" id="sisa_bayar">

					<h4 id="show_sisa_bayar">Rp 0</h4>
				</td>
			</tr>
			<tr>
				<td><h4>STATUS  &nbsp;&nbsp;</h4></td>
				<td id="color_status_bayar">
					<!-- MAIN INPUT -->
					<input type="text"
						   name="input_status_bayar" 
						   class="devMode" id="status_bayar">

					<center><h4 id="show_status_bayar">-</h4></center>
				</td>
			</tr>
            </tbody>
        </table>
    </div>
</div>

<br>
<div class="hr-line-dashed m-b-lg m-t"></div>
<br>

<div class="row">
    <div class="col-sm-3"></div>

    <div class="col-sm-7">
    	<center>
        <table class="table table-hover" style="width: 100%;">
            <tbody>
            <tr>
            	<td style="width: 10px;"><i class="fa fa-arrow-right"></i></td>
				<td><h4 class="p-w-sm">Selisih Harga / PCS &nbsp;&nbsp;</h4></td>
				<td class="text-right" style="width: 130px; background-color: #01A9B4; color: #F1F1F1;">
					<!-- MAIN INPUT -->
					<input type="number" value="0"
						   name="input_selisih_satuan" 
						   class="devMode" id="selisih_satuan">

					<h4 id="show_selisih_satuan">Rp 0</h4>
				</td>
			</tr>
			<tr>
				<td style="width: 10px;"><i class="fa fa-arrow-right"></i></td>
				<td><h4 class="p-w-sm">Selisih Harga JUAL &nbsp; &nbsp;</h4></td>
				<td class="text-right" style="background-color: #01A9B4; color: #F1F1F1;">
					<!-- MAIN INPUT -->
					<input type="number" value="0"
						   name="input_selisih_total" 
						   class="devMode" id="selisih_total">

					<h4 id="show_selisih_total">Rp 0</h4>
				</td>
			</tr>
			<tr>
				<td style="width: 10px;"><i class="fa fa-arrow-right"></i></td>
				<td><h4 class="p-w-sm">Sisa Dana Produksi &nbsp; &nbsp;</h4></td>
				<td class="text-right" style="background-color: #01A9B4; color: #F1F1F1;">
					<!-- MAIN INPUT -->
					<input type="number" value="0"
						   name="input_sisa_dana" 
						   class="devMode" id="sisa_dana">

					<h4 id="show_sisa_dana">Rp 0</h4>
				</td>
			</tr>

			<?php
				for($i = 0; $i < 10; $i++)
				{
			?>

			<tr class="tab_biaya_overhead">
				<td style="vertical-align: middle;"><i class="fa fa-minus"></i></td>
				<td>
					<input type="text" class="m-l-lg form-control" placeholder="Keterangan.." 
						   style="width: 85%;"
						   name="input_keterangan_overhead[]">
				</td>
				<td>
					<input type="number" value="0" min="0" 
						   name="input_biaya_overhead[]"
						   class="biaya_overhead form-control text-right">
				</td>
			</tr>

			<?php
				}
			?>
			
			<tr id="tab_sisa_dana_final">
				<td style="width: 10px;"><i class="fa fa-arrow-right"></i></td>
				<td><h4 class="p-w-sm">Sisa Dana FINAL &nbsp; &nbsp;</h4></td>
				<td class="bg-success text-right">
					<!-- MAIN INPUT -->
					<input type="number" value="0"
						   name="input_sisa_dana_final" 
						   class="" id="sisa_dana_final">

					<h4 id="show_sisa_dana_final">Rp 0</h4>
				</td>
			</tr>
            </tbody>
        </table>

        <br>
        
        <button type="button" class="btn btn-warning devMode" id="button_biaya_overhead">
			<i class="fa fa-plus"></i>&nbsp; Biaya Overhead
		</button>

    	</center>
    </div>
</div>

<div class="devMode tab_detail_produksi">
	<br><br>
	<h3 class="m-t-xl"><i class="fa fa-search"></i>&nbsp; 
		Detail Produksi
	</h3>
	<div class="hr-line-dashed m-t-none"></div>

	<div class="row">
		<div class="col-sm-10">
			<div class="form-group row m-l-none">
		        <label class="col-sm-3 col-form-label">Mulai Produksi</label>
		        <div class="col-sm-7">
		            <!-- MAIN_INPUT -->
		            <input type="date" class="form-control" name="input_tgl_mulai_produksi">
		        </div>
		    </div>
		    <div class="form-group row m-l-none">
		        <label class="col-sm-3 col-form-label">Selesai Produksi</label>
		        <div class="col-sm-7">
		            <!-- MAIN_INPUT -->
		            <input type="date" class="form-control" name="input_tgl_selesai_produksi">
		        </div>
		    </div>
		    <div class="form-group row m-l-none">
		    	<label class="col-sm-3 col-form-label">Tenaga Kerja</label>
		    	<div class="col-sm-7">
				    <select class="select2 form-control m-t-sm" multiple="multiple" style="width: 100%;" 
							data-placeholder="&nbsp&nbsp&nbsp- Pilih -&nbsp"
							name = "input_pekerja[]">

						<?php
						if(!empty($DataUser))
						{
							foreach($DataUser as $ReadDS)
							{
						?>
								<option value="<?php echo $ReadDS->id_user; ?>">
									<?php echo $ReadDS->nama_user; ?>
								</option>
						<?php
							}
						}
						?>
					</select>
				</div>
			</div>
		</div>
	</div>
</div>