<script>
    $(document).ready(function(){
        var biaya_mode = '<?php echo $Mode_Biaya; ?>';

        if (biaya_mode == "Pemesanan")
        {   Mode_Pemesanan();   }


    	var ipt_biaya = $(".ipt-overhead-biaya");

    	ipt_biaya.change(function(){

    		var sum = 0;
    		ipt_biaya.each(function(){
    			sum += parseInt($(this).val());
    		});

    		var current = parseInt($("#txt-sisa-dana").html());
    		$("#ipt-sisa-dana").val(current - sum);
    		$(".tc-over-total").html("Rp " + numFormat(current - sum));
    	});


    	// -------------------------------------------- Biaya Overhead (Button)
		var button_biaya_overhead = $(".btn-overhead");

		button_biaya_overhead.click(function(){

			var tab_biaya_overhead = $(".tab-over-input");

			tab_biaya_overhead.each(function(i, j){

				if ($(this).is(":hidden"))
				{
					$(this).show();
					return false;
				}
			});
		});
    });

    function Mode_Pemesanan()
    {
    	$(".tab-detail").toggleClass('col-lg-7');
    	$(".tab-detail").toggleClass('col-lg-12');
    }

    function numFormat(nStr)
	{
	    nStr += '';
	    x = nStr.split('.');
	    x1 = x[0];
	    x2 = x.length > 1 ? '.' + x[1] : '';
	    var rgx = /(\d+)(\d{3})/;
	    while (rgx.test(x1)) {
	        x1 = x1.replace(rgx, '$1' + ',' + '$2');
	    }
	    return x1 + x2;
	}
</script>

<?php
if (!empty($DataTransaksi)) 
{
	foreach ($DataTransaksi as $ReadDS) 
	{
?>
	<label class="tab-data devMode"><?php echo json_encode($ReadDS); ?></label>
<?php
	}
}
?>

<br>

<form action="<?php echo site_url('Welcome/Update_Transaksi'); ?>" method="post" enctype="multipart/form-data">
	<input type="submit" name="btn_simpan" class="btn btn-sm btn-info btn-update" value="Update Transaksi" style="float: right;">

	<a class="btn btn-white btn-outline" id="btn-link-SPK" href=""><i class="fa fa-print"></i>&nbsp; SPK</a>&nbsp;
	<a class="btn btn-white btn-outline" id="btn-link-Invoice" href=""><i class="fa fa-print"></i>&nbsp; Invoice</a>&nbsp;
	<a class="btn btn-white btn-outline" id="btn-link-Transaksi" href=""><i class="fa fa-print"></i>&nbsp; Transaksi</a>
<hr><br>

<div class="row">
	<div class="col-lg-6 tab-detail">
		<table class="table table-bordered">
			<tr>
				<td colspan="2" class="text-center bg-warning tab-bayar-status-color"><b id="tab-bayar-status">-</b></td>
			</tr>
			<tr>
				<td style="width: 250px;">&nbsp;&nbsp; Pembayaran Awal</td>
				<td class="text-right" style="background-color: #FFE194; color: #9E7777;"><b id="tab-bayar-awal">-</b></td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp; <span class="txt-bayar-akhir">Sisa Pembayaran</span></td>
				<td class="text-right" style="background-color: #FFE194; color: #9E7777;"><b id="tab-bayar-akhir">-</b></td>
			</tr>
			<tr class="tab-check-lunas devMode">
				<td colspan="2" class="text-center">
					<div class="i-checks m-t-xs">
						<label><input type="checkbox" name="input_check_lunas"> <i></i>&nbsp; Pembayaran LUNAS </label>
					</div>
				</td>
			</tr>
		</table>

		<table class="table table-bordered">
			<tr>
				<td style="width: 250px;">&nbsp;&nbsp; ID. Transaksi</td>
				<td style="background-color: #F5E8C7; color: #9E7777;"><b id="tab-id">-</b></td>
				<td class="devMode">
					<!-- MAIN INPUT -->
					<input type="text" name="input_id_transaksi" id="ipt-id">
				</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp; Brand</td>
				<td style="background-color: #F5E8C7; color: #9E7777;"><b id="tab-brand">-</b></td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp; Pelanggan</td>
				<td style="background-color: #F5E8C7; color: #9E7777;"><b id="tab-pelanggan">-</b></td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp; Tanggal Masuk</td>
				<td style="background-color: #F5E8C7; color: #9E7777;"><b id="tab-tgl-masuk">-</b></td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp; Tanggal Selesai</td>
				<td style="background-color: #F5E8C7; color: #9E7777;"><b id="tab-tgl-selesai">-</b></td>
			</tr>
		</table>

		<table class="table table-bordered">
			<tr>
				<td style="width: 250px;">&nbsp;&nbsp; Jumlah Pesan</td>
				<td style="background-color: #F5E8C7; color: #9E7777;"><b id="tab-jumlah-pesanan">-</b></td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp; Bahan Sablon</td>
				<td style="background-color: #F5E8C7; color: #9E7777;"><b id="tab-bahan">-</b></td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp; Jenis Tinta</td>
				<td style="background-color: #F5E8C7; color: #9E7777;"><b id="tab-tinta">-</b></td>
			</tr>
		</table>

		<!-- TABLE DETAIL SABLON -->
		<table class="table table-hover table-bordered" id="tab-detail-sablon">
			<thead>
			<tr style="height: 45px;">
				<th class="bg-success" style="vertical-align: middle;" colspan="3"><center>Detail Sablon</center></th>
			</tr>
			<tr>
				<th class="bg-success text-center" style="vertical-align: middle;">Posisi Sablon</th>
				<th class="bg-success text-center" style="vertical-align: middle;">Ukuran Sablon</th>
				<th class="bg-success text-center" style="vertical-align: middle;">Jumlah Warna</th>
			</tr>
			</thead>
			<?php 
				for ($i=0; $i <= 10; $i++) { 
			?>
				<tr class="tc-col devMode">
					<td class="tc-posisi text-center">-</td>
					<td class="tc-ukuran text-center">-</td>
					<td class="tc-warna text-center">-</td>
				</tr>
			<?php
				}
			?>
		</table>

		<!-- TABLE BIAYA POLYFILM -->
		<table class="table table-hover table-bordered" id="tab-biaya-polyfilm">
			<thead>
				<tr style="height: 45px;">
					<th style="vertical-align: middle; background-color: #A9F1DF; color: #34656D;" colspan="3">
						<center>Biaya Polyfilm</center></th>
				</tr>
				<tr>
					<th class="text-center" style="background-color: #A9F1DF; color: #34656D;">Ukuran</th>
					<th class="text-right" style="background-color: #A9F1DF; color: #34656D;">Biaya</th>
					<th class="text-right" style="background-color: #A9F1DF; color: #34656D;">Total Biaya</th>
				</tr>
			</thead>
			<?php 
				for ($i=0; $i <= 10; $i++) 
				{ 
			?>
				<tr class="tc-col devMode">
					<td class="tc-posisi text-center">-</td>
					<td class="tc-biaya text-right">-</td>
					<td class="tc-total text-right">-</td>
				</tr>
			<?php
				}
			?>
			<tr>
				<td colspan="2" class="text-right"><h4>Total</h4></td>
				<td class="text-right"><h4 id="tab-total-biaya-polyfilm">-</h4></td>
			</tr>
		</table>

		<!-- TABLE BIAYA TINTA -->
		<table class="table table-hover table-bordered" id="tab-biaya-tinta">
			<thead>
				<tr style="height: 45px;">
					<th style="vertical-align: middle; background-color: #FFAEC0; color: #9B5151;" colspan="3">
						<center>Biaya Tinta</center></th>
				</tr>
				<tr>
					<th class="text-center" style="background-color: #FFAEC0; color: #9B5151;">Posisi Sablon</th>
					<th class="text-right" style="background-color: #FFAEC0; color: #9B5151;">Biaya</th>
					<th class="text-right" style="background-color: #FFAEC0; color: #9B5151;">Total Biaya</th>
				</tr>
			</thead>
			<?php 
				for ($i=0; $i <= 10; $i++) { 
			?>
				<tr class="tc-col devMode">
					<td class="tc-posisi text-center">-</td>
					<td class="tc-biaya text-right">-</td>
					<td class="tc-total text-right">-</td>
				</tr>
			<?php
				}
			?>
			<tr>
				<td class="text-right" colspan="2"><h4>Total</h4></td>
				<td class="text-right"><h4 id="tab-total-biaya-tinta">-</h4></td>
			</tr>
		</table>

		<!-- TABLE FORMULA BIAYA -->
		<table class="table table-hover table-bordered" id="tab-formula-biaya">
			<thead>
				<tr style="height: 45px;">
					<th style="vertical-align: middle; background-color: #FFBF86; color: #B85C38;" colspan="3">
						<center>Formula Biaya</center></th>
				</tr>
				<tr>
					<th style="background-color: #FFBF86; color: #B85C38;">Rincian Biaya</th>
					<th class="text-right" style="background-color: #FFBF86; color: #B85C38;">Biaya</th>
					<th class="text-right" style="background-color: #FFBF86; color: #B85C38;">Total Biaya</th>
				</tr>
			</thead>
			<?php 
				for ($i=0; $i <= 20; $i++) { 
			?>
				<tr class="tc-col devMode">
					<td class="tc-rincian">-</td>
					<td class="tc-biaya text-right">-</td>
					<td class="tc-total text-right">-</td>
				</tr>
			<?php
				}
			?>
			<tr>
				<td colspan="2" class="text-right" style="background-color: #FFBF86; color: #B85C38;"><h4>TOTAL BIAYA PRODUKSI</h4></td>
				<td class="text-right" style="background-color: #FFBF86; color: #B85C38;"><h4 id="tab-total-biaya-produksi">-</h4></td>
			</tr>
			<tr>
				<td colspan="2" class="text-right" style="background-color: #FDE49C; color: #B85C38;">Beban Produksi</td>
				<td class="text-right" style="background-color: #FDE49C; color: #B85C38;" id="tab-beban-produksi">-</td>
			</tr>
			<tr>
				<td colspan="2" class="text-right" style="background-color: #FDE49C; color: #B85C38;">Operasional Produksi</td>
				<td class="text-right" style="background-color: #FDE49C; color: #B85C38;" id="tab-operasional-produksi">-</td>
			</tr>
			<tr>
				<td colspan="2" class="text-right" style="background-color: #FDE49C; color: #B85C38;">Biaya Borongan</td>
				<td class="text-right" style="background-color: #FDE49C; color: #B85C38;" id="tab-biaya-borongan">-</td>
			</tr>
		</table>
	</div>

	<div class="col-lg-6">
		<!-- Sub-Content -->
		<?php 
			if ($Mode_Biaya != "Pemesanan")
			{
				$this->load->view($Sub_Biaya_Tab); 
			}
		?>
	</div>

	<div class="col-sm-6 border-right m-t-md">
		<table class="table table-hover table-bordered">
			<tr class="text-right">
				<td><h4>Harga Kaos + Sablon &nbsp; &nbsp;</h4></td>
				<td><h4 id="tab-kaos-sablon">-</h4></td>
			</tr>
			<tr class="text-right">
				<td><h4>Harga Sablon Saja &nbsp; &nbsp;</h4></td>
				<td><h4 id="tab-sablon-saja">-</h4></td>
			</tr>
			<tr class="text-right" style="background-color: #845EC2; color: #F1F1F1;">
				<td><h4>TOTAL HARGA MINIMUM &nbsp; &nbsp;</h4></td>
				<td><h4 id="tab-harga-minimum">-</h4></td>
			</tr>
		</table>
	</div>
	<div class="col-sm-6 m-t-md">
		<table class="table table-hover table-bordered">
			<tr class="text-right">
				<td><h4>Harga / PCS Final &nbsp; &nbsp;</h4></td>
				<td><h4 id="tab-harga-final">-</h4></td>
			</tr>
			<tr class="text-right">
				<td><h4></h4></td>
				<td><h4>-</h4></td>
			</tr>
			<tr class="text-right" style="background-color: #C56183; color: #F1F1F1;">
				<td><h4>TOTAL HARGA FINAL &nbsp; &nbsp;</h4></td>
				<td><h4 id="tab-total-harga-final">-</h4></td>
			</tr>
		</table>
	</div>

	<div class="col-sm-3"></div>
	<div class="col-sm-6 m-t-md">
		<table class="table table-hover table-bordered">
			<tr>
				<td> &nbsp; &nbsp; Persentase Usaha</td>
				<td id="tab-persentase-usaha" class="text-right" style="background-color: #01A9B4; color: #F1F1F1;">-</td>
			</tr>
			<tr>
				<td> &nbsp; &nbsp; Selisih Harga / PCS</td>
				<td id="tab-selisih-harga-satuan" class="text-right" style="background-color: #01A9B4; color: #F1F1F1;">-</td>
			</tr>
			<tr>
				<td> &nbsp; &nbsp; Selisih Harga Jual</td>
				<td id="tab-selisih-harga-jual" class="text-right" style="background-color: #01A9B4; color: #F1F1F1;">-</td>
			</tr>
			<tr>
				<td> &nbsp; &nbsp; Infak Wajib</td>
				<td id="" class="text-right" style="background-color: #01A9B4; color: #F1F1F1;">-</td>
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
							for ($i = 0; $i < 10; $i++) 
							{ 
						?>
						<tr class="tab-over devMode">
							<td class="tc-over-ket">-</td>
							<td class="tc-over-biaya text-right">-</td>
						</tr>
						<?php
							}
						?>
						<!-- MAIN INPUT -->
						<?php
							for ($i = 0; $i < 10; $i++) 
							{ 
						?>
						<tr class="tab-over-input devMode">
							<td><input type="text" name="input_overhead_ket[]" class="form-control" placeholder="Keterangan.."></td>
							<td><input type="number" name="input_overhead_biaya[]" class="ipt-overhead-biaya form-control" value="0"></td>
						</tr>
						<?php
							}
						?>
						<tr>
							<td class="text-right"><b>Total</b></td>
							<td class="text-right"><b class="tc-over-total">-</b></td>
							<td class="devMode"><input type="number" name="input_overhead_total" class="form-control"></td>
						</tr>
						<tr class="tab-overhead-btn">
							<td colspan="2">
								<button type="button" class="btn btn-sm btn-warning btn-block btn-overhead">
									<i class="fa fa-plus"></i>&nbsp; Biaya Overhead
								</button>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2"><h4> &nbsp; &nbsp; Sisa Dana Produksi</h4></td>
				<td class="text-right" style="background-color: #01A9B4; color: #F1F1F1;">
					<h4 id="tab-sisa-dana-produksi">-</h4></td>
				<td class="devMode"><span id="txt-sisa-dana"></span><input type="text" name="input_sisa_dana_produksi" id="ipt-sisa-dana"></td>
			</tr>
		</table>
	</div>
	<div class="col-sm-3"></div>
</div>

</form>
