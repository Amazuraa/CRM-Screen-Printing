<?php $Mode = $this->uri->segment(3); ?>

<script>
	$(document).ready(function()
	{
		// -------------------------------------------- DEV MODE
		var mode = '<?php echo $Mode; ?>';

		if (mode != 'Dev')
			$(".devMode").hide();
	});
</script>

<script>
	$(document).ready(function()
	{
		var check = $("input[name='check_pembukuan[]']");
		
		check.click(function()
		{
			var total_harga = 0;
			var total_produksi = 0;
			var total_operasional = 0;
			var total_gaji = 0;
			var total_cash_in = 0;

			// Loop all
			check.each(function(i, j)
			{
				// Check if its checked
				if($(j).is(':checked'))
				{
					total_harga += parseInt($('.data_biaya').eq(i).html());
					total_produksi += parseInt($('.data_produksi').eq(i).html());
					total_operasional += parseInt($('.data_operasional').eq(i).html());
					total_gaji += parseInt($('.data_gaji').eq(i).html());
					total_cash_in += parseInt($('.data_cash_in').eq(i).html());
				}
			});
			
			$('#input_harga_total').val(total_harga);
			$('#harga_total').text(numFormat(total_harga));

			$('#input_produksi_total').val(total_produksi);
			$('#produksi_total').text(numFormat(total_produksi));

			$('#input_operasional_total').val(total_operasional);
			$('#operasional_total').text(numFormat(total_operasional));

			$('#input_gaji_total').val(total_gaji);
			$('#gaji_total').text(numFormat(total_gaji));

			$('#input_cash_in_total').val(total_cash_in);
			$('#cash_in_total').text(numFormat(total_cash_in));
			// alert(total);
		});

		var link_detail = $(".link_detail");
		var tab_data = $(".tab-data");

		link_detail.click(function(){
			var i = link_detail.index(this);

			var obj 				= JSON.parse(tab_data.eq(i).text());
			var obj_data_transaksi	= JSON.parse(obj.data_transaksi);
			var obj_data_biaya		= JSON.parse(obj.data_biaya);
			var obj_data_produksi 	= JSON.parse(obj.data_produksi);


			var obj_detail_sablon	= JSON.parse(obj_data_produksi.detail_sablon);
			var obj_biaya_polyfilm	= JSON.parse(obj_data_biaya.biaya_polyfilm);
			var obj_biaya_tinta		= JSON.parse(obj_data_biaya.biaya_tinta);
			var obj_formula_biaya	= JSON.parse(obj_data_biaya.formula_biaya);
			var obj_biaya_overhead	= JSON.parse(obj_data_biaya.biaya_overhead);

			// Assigning tabs value..
			var status = parseInt(obj.status_transaksi);

			switch(status){
				case 1:
					$(".btn-update").show();
					$(".tab-overhead-btn").show();
					break;

				case 2:
					$(".btn-update").hide();
					$(".tab-overhead-btn").hide();
					break;
			}
			
			$("#tab-bayar-awal").text("Rp " + numFormat(obj_data_transaksi.pembayaran_awal));
			$("#tab-bayar-akhir").text("Rp " + numFormat(obj_data_transaksi.pembayaran_akhir));
			$("#tab-bayar-status").text(obj_data_transaksi.pembayaran_status);


			if (obj_data_transaksi.pembayaran_status == "LUNAS")
			{
				$(".tab-bayar-status-color").toggleClass('bg-warning');
				$(".tab-bayar-status-color").toggleClass('bg-info');
				$(".tab-check-lunas").hide();
				$(".txt-bayar-akhir").html('Pembayaran Akhir');
			}
			else
			{
				$(".tab-check-lunas").show();
				$(".txt-bayar-akhir").html('Sisa Pembayaran');
			}

			$("#btn-link-SPK").attr("href", "PrintOut/SPK/" + obj.id_produksi);
			$("#btn-link-Invoice").attr("href", "PrintOut/Invoice/" + obj.id_transaksi);
			$("#btn-link-Transaksi").attr("href", "PrintOut/Transaksi/" + obj.id_transaksi);

			$("#tab-id").text(obj.id_transaksi);
			$("#ipt-id").val(obj.id_transaksi);
			$("#tab-brand").text(obj_data_produksi.brand);
			$("#tab-pelanggan").text(obj.nama_pelanggan);
			$("#tab-tgl-masuk").text(obj_data_transaksi.tgl_masuk);
			$("#tab-tgl-selesai").text(obj_data_transaksi.tgl_selesai);

			$("#tab-jumlah-pesanan").text(obj_data_produksi.jumlah_pesanan + " PCS");
			$("#tab-bahan").text(obj_data_produksi.nama_bahan);
			$("#tab-tinta").text(obj_data_produksi.nama_tinta);

			$(".tc-col").hide();
			obj_detail_sablon.forEach(function(itm, idx){
				$("#tab-detail-sablon").find(".tc-col").eq(idx).show();
				$("#tab-detail-sablon").find(".tc-posisi").eq(idx).text(itm.posisi);
				$("#tab-detail-sablon").find(".tc-ukuran").eq(idx).text(itm.ukuran);
				$("#tab-detail-sablon").find(".tc-warna").eq(idx).text(itm.jumlah_warna);
			});

			obj_biaya_polyfilm.forEach(function(itm, idx){
				$("#tab-biaya-polyfilm").find(".tc-col").eq(idx).show();
				$("#tab-biaya-polyfilm").find(".tc-posisi").eq(idx).text(itm.posisi);
				$("#tab-biaya-polyfilm").find(".tc-biaya").eq(idx).text(numFormat(itm.biaya));
				$("#tab-biaya-polyfilm").find(".tc-total").eq(idx).text(numFormat(itm.total));
			});

			$("#tab-total-biaya-polyfilm").text(numFormat(obj_data_biaya.total_biaya_polyfilm));

			obj_biaya_tinta.forEach(function(itm, idx){
				$("#tab-biaya-tinta").find(".tc-col").eq(idx).show();
				$("#tab-biaya-tinta").find(".tc-posisi").eq(idx).text(itm.posisi);
				$("#tab-biaya-tinta").find(".tc-biaya").eq(idx).text(numFormat(itm.biaya));
				$("#tab-biaya-tinta").find(".tc-total").eq(idx).text(numFormat(itm.total));
			});

			$("#tab-total-biaya-tinta").text(numFormat(obj_data_biaya.total_biaya_tinta));

			obj_formula_biaya.forEach(function(itm, idx){
				$("#tab-formula-biaya").find(".tc-col").eq(idx).show();
				$("#tab-formula-biaya").find(".tc-rincian").eq(idx).text(itm.rincian);
				$("#tab-formula-biaya").find(".tc-biaya").eq(idx).text(numFormat(itm.biaya));
				$("#tab-formula-biaya").find(".tc-total").eq(idx).text(numFormat(itm.total));
			});

			// biaya overhead
			var total_overhead = 0;

			$(".tab-over").hide();
			obj_biaya_overhead.forEach(function(itm, idx){
				$(".tab-over").eq(idx).show();
				$(".tc-over-ket").eq(idx).text(itm.keterangan);
				$(".tc-over-biaya").eq(idx).text("- " + numFormat(itm.biaya));
				total_overhead += parseInt(itm.biaya);
			});

			$(".tc-over-total").text("Rp " + numFormat(total_overhead));
			
			$("#tab-total-biaya-produksi").text("Rp " + numFormat(obj_data_biaya.total_biaya_produksi));
			$("#tab-beban-produksi").text("Rp " + numFormat(obj_data_biaya.beban_produksi));
			$("#tab-operasional-produksi").text("Rp " + numFormat(obj_data_biaya.operasional_produksi));
			$("#tab-biaya-borongan").text("Rp " + numFormat(obj_data_biaya.biaya_borongan));

			$("#tab-kaos-sablon").text("Rp " + numFormat(obj_data_biaya.harga_kaos_sablon));
			$("#tab-sablon-saja").text("Rp " + numFormat(obj_data_biaya.harga_sablon_saja));
			$("#tab-harga-minimum").text("Rp " +  numFormat(obj_data_biaya.total_harga_minimum));


			$("#tab-harga-final").text("Rp " + numFormat(obj_data_biaya.harga_final));
			$("#tab-total-harga-final").text("Rp " + numFormat(obj_data_biaya.total_harga_final));

			$("#tab-persentase-usaha").text(obj_data_biaya.persentase_usaha + " %");

			$("#tab-selisih-harga-satuan").text("Rp " + numFormat(obj_data_biaya.selisih_harga_satuan));
			$("#tab-selisih-harga-jual").text("Rp " + numFormat(obj_data_biaya.selisih_harga_jual));
			$("#tab-sisa-dana-produksi").text("Rp " + numFormat(obj_data_biaya.sisa_dana_produksi));
			$("#txt-sisa-dana").html(obj_data_biaya.sisa_dana_produksi);
			$("#ipt-sisa-dana").val(obj_data_biaya.sisa_dana_produksi);
			
			// alert(obj_data_biaya.biaya_tinta);

			


			$("#tab-1").toggleClass("active");
			$("#tab-2").toggleClass("active");

			$("#link-1").toggleClass("active");
			$("#link-2").toggleClass("active");

			// alert($("#tab-1").attr('class'));
		});
		
		var upah_pekerja = $(".txt-upah-pekerja").text();
		$(".ipt-upah-pekerja").text(upah_pekerja);
	});

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

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-4">
            <div class="ibox ">
            	<div class="ibox-title">
                    <h2>File Manager</h2>
                    <div class="ibox-tools m-t-sm">
                        <button type="button" class="btn btn-xs" style="border-radius: 100px;" 
                        		data-toggle="modal" data-target="#myModal">
                        	&nbsp;<i class="fa fa-info" style="font-size: 13px; color: gray;"></i>&nbsp;
                        </button>
                    </div>
        		</div>
                <div class="ibox-content sk-loading" style="padding-top: 0px; padding-left: 18px;">
                	<!-- Sub-Content -->
    				<?php $this->load->view($Sub_Spinner); ?>

                	<!-- Sub-Content -->
                	<?php $this->load->view($Sub_File_Manager); ?>
				</div>
			</div>
		</div>

		<div class="col-lg-8">
            <div class="ibox ">
            	<div class="ibox-title">
                    <h2>Chart Penjualan</h2>
                    <div class="ibox-tools m-t-sm">
                        <button type="button" class="btn btn-xs" style="border-radius: 100px;" 
                        		data-toggle="modal" data-target="#myModal">
                        	&nbsp;<i class="fa fa-info" style="font-size: 13px; color: gray;"></i>&nbsp;
                        </button>
                    </div>
        		</div>
                <div class="ibox-content sk-loading" style="padding-top: 0px; padding-left: 18px;">
                	<!-- Sub-Content -->
    				<?php $this->load->view($Sub_Spinner); ?>

                	<!-- Sub-Content -->
                	<?php $this->load->view($Sub_Chart_Penjualan); ?>
				</div>
			</div>
		</div>

		<div class="col-lg-12">
            <div class="ibox ">
            	<div class="ibox-title">
                    <h2>Daftar Transaksi</h2>
                    <div class="ibox-tools m-t-sm">
                        <button type="button" class="btn btn-xs" style="border-radius: 100px;" 
                        		data-toggle="modal" data-target="#myModal">
                        	&nbsp;<i class="fa fa-info" style="font-size: 13px; color: gray;"></i>&nbsp;
                        </button>
                    </div>
        		</div>
                <div class="ibox-content sk-loading">
	    			<!-- Sub-Content -->
    				<?php $this->load->view($Sub_Spinner); ?>
    				
	    			<div class="m-t-md">
	    				<div class="tabs-container">
	                        <ul class="nav nav-tabs" role="tablist">
	                            <li><a id="link-1" class="nav-link active" data-toggle="tab" 
	                            	   href="#tab-1">Transaksi</a></li>
	                            <li><a id="link-2" class="nav-link" data-toggle="tab" 
	                            	   href="#tab-2">Detail</a></li>
	                        </ul>
	                        <div class="tab-content">
	                            <div role="tabpanel" id="tab-1" class="tab-pane active">
	                                <div class="panel-body">
	                  					<!-- Sub-Content -->
                						<?php $this->load->view($Sub_Daftar_Tab); ?> 
	                                </div>
	                            </div>
	                            <div role="tabpanel" id="tab-2" class="tab-pane">
	                                <div class="panel-body">
	                                	<!-- Sub-Content -->
                						<?php $this->load->view($Sub_Detail_Tab); ?> 
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="ibox ">
            	<div class="ibox-title">
                    <h2>Daftar Upah Tenaga Kerja</h2>
                    <div class="ibox-tools m-t-sm">
                        <button type="button" class="btn btn-xs" style="border-radius: 100px;" 
                        		data-toggle="modal" data-target="#myModal">
                        	&nbsp;<i class="fa fa-info" style="font-size: 13px; color: gray;"></i>&nbsp;
                        </button>
                    </div>
        		</div>
                <div class="ibox-content sk-loading">
                	<!-- Sub-Content -->
					<?php $this->load->view($Sub_Daftar_User); ?> 
                </div>
            </div>
        </div>

	</div>
</div>

<!-- FAQ-Content -->
<?php $this->load->view($Sub_FAQ); ?>