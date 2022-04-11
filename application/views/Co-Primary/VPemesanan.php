<?php 
	$Mode = $this->uri->segment(3); 

    function generate_string($strength = 16) 
    {
        $input = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $input_length = strlen($input);
        $random_string = '';
        
        for($i = 0; $i < $strength; $i++) 
        {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
     
        return $random_string;
    }
?>

<script>
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

	$(document).ready(function()
	{
		// -------------------------------------------- DEV MODE
		var mode = '<?php echo $Mode; ?>';

		if (mode != 'Dev')
			$(".devMode").hide();


		// --------------------------------------------
		var warna = $(".jumlah_warna");

		warna.change(function(){
			var idx = warna.index(this);
			
			Polyfilm_Tinta_Total(idx);
			Polyfilm_Tinta_Hitung();
			Warna_Hitung();
			Formula_Biaya();
		});


		// --------------------------------------------
		var jumlah_pesanan = $("#jumlah_pesanan");

		jumlah_pesanan.change(function(){
			Formula_Biaya();
		});


		// -------------------------------------------- Tinta
		var jenis_tinta = $("#jenis_tinta");

		jenis_tinta.change(function(){

			var i_parent = $(this).prop('selectedIndex');

			// combobox ukuran sablon
			var ukuran_sablon = $(".ukuran_sablon");
			
			ukuran_sablon.each(function(i, j){
				var idx = $(j).prop('selectedIndex');

				if (i_parent != 0)
				{
					if (idx != 0)
					{
						// table daftar tinta..
						var parent = $(".daftar_tinta").eq(idx);
						var child = parent.children().eq(i_parent).html().replace(',',''); // clear commas

						Tinta_Biaya(i, child);
					}
				}
				else
					Tinta_Biaya(i, 0);

				Polyfilm_Tinta_Total(i);
				Polyfilm_Tinta_Hitung();
				Formula_Biaya();
			});
		});


		// -------------------------------------------- Detail Bahan
		var detail_bahan = $("#bahan");

		detail_bahan.change(function(){

			var jumlah_size_bahan = $(".jumlah_size_bahan");

			var i_parent = detail_bahan.prop('selectedIndex');
			var parent = $(".daftar_bahan").eq(i_parent);

			if (i_parent != 0)
			{
				parent.children().each(function(i, j){
					if (i != 0) 
					{
						var child = $(j).html().replace(',',''); // clear commas
						var idx = i - 1;

						Bahan_Harga(idx, child);

						var jumlah_bahan = $(".jumlah_size_bahan").eq(idx).val();
						var total = parseInt(child) * parseInt(jumlah_bahan);

						Bahan_Harga_Total(idx, total);
					}
					else
					{
						$("#show_bahan").html($(detail_bahan).val());
					}
				});
			}
			else
			{
				parent.children().each(function(i, j){
					if (i != 0) 
					{
						var idx = i - 1;

						Bahan_Harga(idx, 0);
						Bahan_Harga_Total(idx, 0);
					}
					else
					{
						$("#show_bahan").html("- - -");
					}
				});
			}

			Bahan_Hitung();
			Formula_Biaya();
		});


		// -------------------------------------------- Detail Bahan (Size)
		var jumlah_bahan = $(".jumlah_size_bahan");

		jumlah_bahan.change(function(){

			var i = jumlah_bahan.index(this);

			var harga_bahan = $(".harga_bahan").eq(i).val();
			var current = $(this).val();
			var total = parseInt(harga_bahan) * parseInt(current);

			Bahan_Harga_Total(i, total);

			Bahan_Hitung();
			Formula_Biaya();
		});


		// -------------------------------------------- Detail Sablon (Ukuran)
		var ukuran_sablon = $(".ukuran_sablon");

		ukuran_sablon.change(function(){
			// table daftar polyfilm..
			var i_parent = $(this).prop('selectedIndex');
			var parent = $(".daftar_polyfilm").eq(i_parent);

			// table daftar tinta..
			var i_parent2 = $("#jenis_tinta").prop('selectedIndex');
			var parent2 = $(".daftar_tinta").eq(i_parent);

			var idx = ukuran_sablon.index(this);

			if (i_parent != 0)
			{
				var child = parent.children().eq(1).html().replace(',',''); // clear commas
				Polyfilm_Biaya(idx, child);

				if (i_parent2 != 0)
				{
					var child2 = parent2.children().eq(i_parent2).html().replace(',',''); // clear commas
					Tinta_Biaya(idx, child2);
				}
				else
					Tinta_Biaya(idx, 0);
			}
			else
			{	
				Polyfilm_Biaya(idx, 0);
				Tinta_Biaya(idx, 0);
			}

			Polyfilm_Tinta_Total(idx);
			Polyfilm_Tinta_Hitung();
			Formula_Biaya();
		});


		// -------------------------------------------- Persentase Usaha
		var persentase = $("#persentase");

		persentase.change(function(){
			Harga_Minimum_Hitung();
			Perbandingan_Hitung();
		});


		// -------------------------------------------- Harga Final
		var harga_final = $("#harga_final");

		harga_final.change(function(){
			Harga_Final_Hitung();
			Pembayaran_Hitung();
			Perbandingan_Hitung();
		});


		// -------------------------------------------- Total Bayar
		var total_bayar = $("#total_bayar");

		total_bayar.change(function(){
			Pembayaran_Hitung()
		});


		// -------------------------------------------- Biaya Overhead
		var biaya_overhead = $(".biaya_overhead");

		$(".tab_biaya_overhead").hide();
		$("#tab_sisa_dana_final").hide();

		biaya_overhead.change(function(){

			var sisa_dana = parseInt($("#sisa_dana").val());
			var count = sisa_dana;

			biaya_overhead.each(function(i, j){
				count -= parseInt($(j).val());
			});

			var sisa_dana_final = $("#sisa_dana_final");

			sisa_dana_final.val(count);
			$("#show_sisa_dana_final").html( "Rp " + numFormat(count) );
		});


		// -------------------------------------------- Biaya Overhead (Button)
		var button_biaya_overhead = $("#button_biaya_overhead");

		button_biaya_overhead.click(function(){

			var tab_biaya_overhead = $(".tab_biaya_overhead");
			var tab_sisa_dana_final = $("#tab_sisa_dana_final");

			tab_biaya_overhead.each(function(i, j){

				if ($(this).is(":hidden"))
				{
					$(this).show();
					return false;
				}
			});

			if (tab_sisa_dana_final.is(":hidden"))
			{
				tab_sisa_dana_final.show();
			}
		});


		Formula_Biaya();
	});

	function Formula_Biaya()
	{
		var rumus_biaya = $(".rumus_biaya");
		var count_total = 0;

		var beban_produksi = [];
		var operasional_produksi = [];
		var biaya_borongan = [];

		rumus_biaya.each(function(i, prop)
		{
			var str = $(prop).html();
			var res = str.split(",");
			var count = 0;

			for (var j = 0; j < res.length; j++) 
			{
				switch(res[j])
				{
					case "=":
						var biaya = $("." + res[j + 1]).eq(i).val();
						count = parseInt(biaya);

						break;

					case "*":
						var biaya = $("#" + res[j + 1]).val();
						count *= parseInt(biaya);
						break;

					case "@":
						var biaya 	= $("." + res[j + 1]).eq(i);
						var show 	= $(".show_" + res[j + 1]).eq(i);
						var val 	= $("#" + res[j + 2]).val();
						
						biaya.val(val);
						show.html(numFormat(val));
						
						count = parseInt(val);
						break;

					case "#":
						var id = res[j + 1];

						if (id == "beban_produksi")
							beban_produksi.push( parseInt(count) );
						else if (id == "operasional_produksi")
							operasional_produksi.push( parseInt(count) );
						else if (id == "biaya_borongan")
							biaya_borongan.push( parseInt(count) );

						break;
				}
			}

			$(".detail_total_biaya").eq(i).val(parseInt(count));
			$(".show_detail_total_biaya").eq(i).html(numFormat(count));

			count_total += parseInt(count);	
		});

		// shortcut to count sum using array.reduce
		var total_beban_produksi 		= parseInt(beban_produksi.reduce((a, b) => a + b, 0));
		var total_operasional_produksi 	= parseInt(operasional_produksi.reduce((a, b) => a + b, 0));
		var total_biaya_borongan 		= parseInt(biaya_borongan.reduce((a, b) => a + b, 0));

		// -------------------------------------------------------- Total Produksi
		$("#total_biaya_produksi").val( parseInt(count_total) );
		
		$("#beban_produksi").val(total_beban_produksi);
		$("#operasional_produksi").val(total_operasional_produksi);
		$("#biaya_borongan").val(total_biaya_borongan);

		/// ============= ///
		$("#show_total_biaya_produksi").html("Rp " + numFormat(count_total));

		$("#show_beban_produksi").html("Rp " + numFormat(total_beban_produksi));
		$("#show_operasional_produksi").html("Rp " + numFormat(total_operasional_produksi));
		$("#show_biaya_borongan").html("Rp " + numFormat(total_biaya_borongan));


		// -------------------------------------------------------- Perbandingan & Final
		Harga_Minimum_Hitung();
	}

	function Warna_Hitung()
	{
		var warna 		= $(".jumlah_warna");
		var warna_total = $("#total_warna");
		var count = 0;

		warna.each(function(i, prop)
		{ count += parseInt($(prop).val()); });

		warna_total.val(count);
	}

	function Bahan_Harga(idx, val)
	{
		var harga_bahan = $(".harga_bahan").eq(idx);
		var show_harga_bahan = $(".show_harga_bahan").eq(idx);
		
		harga_bahan.val(val);
		show_harga_bahan.html(numFormat(val));
	}

	function Bahan_Harga_Total(idx, val)
	{
		var harga_total_bahan = $(".harga_total_bahan").eq(idx);
		var show_harga_total_bahan = $(".show_harga_total_bahan").eq(idx);

		harga_total_bahan.val(val);
		show_harga_total_bahan.html(numFormat(val));
	}

	function Bahan_Hitung()
	{
		var harga_total_bahan = $(".harga_total_bahan");
		var total_bahan = $("#total_bahan");
		var show_total_bahan = $("#show_total_bahan");

		var count = 0;

		var jumlah_pesanan = $("#jumlah_pesanan");
		var jumlah_size_bahan = $(".jumlah_size_bahan");
		var jumlah = 0;

		harga_total_bahan.each(function(i, j){
			// jumlah_pesanan
			jumlah += parseInt( jumlah_size_bahan.eq(i).val() );

			// total harga bahan
			count += parseInt( $(j).val() );
		});

		total_bahan.val(count);
		show_total_bahan.html(numFormat(count));

		jumlah_pesanan.val(jumlah);
	}

	function Polyfilm_Biaya(idx, val)
	{
		var biaya_polyfilm = $(".biaya_polyfilm").eq(idx);
		var show_biaya_polyfilm = $(".show_biaya_polyfilm").eq(idx);

		biaya_polyfilm.val(val);
		show_biaya_polyfilm.html(numFormat(val));
	}

	function Tinta_Biaya(idx, val)
	{
		var biaya_tinta = $(".biaya_tinta").eq(idx);
		var show_biaya_tinta = $(".show_biaya_tinta").eq(idx);

		biaya_tinta.val(val);
		show_biaya_tinta.html(numFormat(val));
	}

	function Polyfilm_Tinta_Total(idx)
	{
		var jumlah = parseInt($(".jumlah_warna").eq(idx).val());

		var biaya_tinta = parseInt($(".biaya_tinta").eq(idx).val());
		var biaya_polyfilm = parseInt($(".biaya_polyfilm").eq(idx).val());

		var biaya_total_tinta = $(".biaya_total_tinta").eq(idx);
		var biaya_total_polyfilm = $(".biaya_total_polyfilm").eq(idx);

		biaya_total_tinta.val(biaya_tinta * jumlah);
		biaya_total_polyfilm.val(biaya_polyfilm * jumlah);

		/// ============= ///
		$(".show_biaya_total_tinta").eq(idx).html(numFormat(biaya_tinta * jumlah));
		$(".show_biaya_total_polyfilm").eq(idx).html(numFormat(biaya_polyfilm * jumlah));
	}

	function Polyfilm_Tinta_Hitung()
	{
		var biaya_total_tinta = $(".biaya_total_tinta");
		var biaya_total_polyfilm = $(".biaya_total_polyfilm");

		var total_tinta = $("#total_tinta");
		var total_polyfilm = $("#total_polyfilm");

		var count_tinta = 0;
		var count_polyfilm = 0;

		biaya_total_tinta.each(function(i, j){
			count_tinta += parseInt($(j).val());
			count_polyfilm += parseInt(biaya_total_polyfilm.eq(i).val());
		});

		total_tinta.val(count_tinta);
		total_polyfilm.val(count_polyfilm);

		/// ============= ///
		$("#show_total_tinta").html(numFormat(count_tinta));
		$("#show_total_polyfilm").html(numFormat(count_polyfilm));
	}

	function Harga_Minimum_Hitung()
	{
		var harga_minimum 		= $("#harga_minimum");
		var harga_kaos_sablon 	= $("#harga_kaos_sablon");
		var harga_sablon 		= $("#harga_sablon");

		var persentase 				= parseInt($("#persentase").val());
		var total_biaya_produksi 	= parseInt($("#total_biaya_produksi").val());
		var total_bahan 			= parseInt($("#total_bahan").val());
		var jumlah_pesanan			= parseInt($("#jumlah_pesanan").val());


		var count_harga_minimum = total_biaya_produksi + (total_biaya_produksi * persentase / 100);
		var count_harga_kaos_sablon = (jumlah_pesanan == 0) ? 0 : count_harga_minimum / jumlah_pesanan;
		var count_harga_sablon = (jumlah_pesanan == 0) ? 0 : ((total_biaya_produksi - total_bahan) + 
								 ((total_biaya_produksi - total_bahan) * persentase / 100)) /
								 jumlah_pesanan;

		harga_minimum.val( parseInt(count_harga_minimum) );
		harga_kaos_sablon.val( parseInt(count_harga_kaos_sablon) );
		harga_sablon.val( parseInt(count_harga_sablon) );

		$("#show_harga_minimum").html( "Rp " + numFormat(Math.round(count_harga_minimum)) );
		$("#show_harga_kaos_sablon").html( "Rp " + numFormat(Math.round(count_harga_kaos_sablon)) );
		$("#show_harga_sablon").html( "Rp " + numFormat(Math.round(count_harga_sablon)) );
	}

	function Harga_Final_Hitung()
	{
		var harga_final 	= parseInt($("#harga_final").val());
		var jumlah_pesanan 	= parseInt($("#jumlah_pesanan").val());

		var total_harga_final = $("#total_harga_final");

		var count_total_harga_final = harga_final * jumlah_pesanan;

		total_harga_final.val( parseInt(count_total_harga_final) );
		$("#show_total_harga_final").html( "Rp " + numFormat(Math.round(count_total_harga_final)) );
	}

	function Perbandingan_Hitung()
	{
		var total_harga_final = parseInt($("#total_harga_final").val());
		var harga_minimum = parseInt($("#harga_minimum").val());
		var jumlah_pesanan = parseInt($("#jumlah_pesanan").val());
		var total_biaya_produksi = parseInt($("#total_biaya_produksi").val());

		var selisih_total = $("#selisih_total");
		var selisih_satuan = $("#selisih_satuan");
		var sisa_dana = $("#sisa_dana");


		var count_selisih_total = total_harga_final - harga_minimum;
		var count_selisih_satuan = count_selisih_total / jumlah_pesanan;
		var count_sisa_dana = total_harga_final - total_biaya_produksi;

		selisih_total.val( parseInt(count_selisih_total) );
		selisih_satuan.val( parseInt(count_selisih_satuan) );
		sisa_dana.val( parseInt(count_sisa_dana) );

		$("#show_selisih_total").html( "Rp " + numFormat(Math.round(count_selisih_total)) );
		$("#show_selisih_satuan").html( "Rp " + numFormat(Math.round(count_selisih_satuan)) );
		$("#show_sisa_dana").html( "Rp " + numFormat(Math.round(count_sisa_dana)) );
	}

	function Pembayaran_Hitung()
	{
		var total_bayar 		= parseInt($("#total_bayar").val());

		if (total_bayar != 0)
		{
			var total_harga_final 	= parseInt($("#total_harga_final").val());
			var sisa_bayar 			= $("#sisa_bayar");
			var status_bayar 		= $("#status_bayar");

			var count = total_harga_final - total_bayar;

			sisa_bayar.val(count);
			status_bayar.val((count == 0) ? "LUNAS" : "BELUM LUNAS");

			$("#show_sisa_bayar").html( "Rp " + numFormat(count) );
			$("#show_status_bayar").html(status_bayar.val());

			$("#color_status_bayar").removeClass( "bg-primary bg-warning" );
			$("#color_status_bayar").addClass( (count == 0) ? "bg-primary" : "bg-warning" );
		}
	}
</script>

<script>
	$(document).ready(function()
	{
		$(".select2").select2();

		// ----------------------------------------------------- Tanggal Transaksi
		var button_transaksi_tgl1 	= $("#button_transaksi_tgl1");
		var button_transaksi_tgl2 	= $("#button_transaksi_tgl2");

		var transaksi_id 		= $("#transaksi_id");
		var transaksi_tgl 		= $("#transaksi_tgl");
		var transaksi_lama		= $("#transaksi_lama");
		var tab_transaksi_lama 	= $("#tab_transaksi_lama");

		var button_biaya_overhead	= $("#button_biaya_overhead");
		var tab_detail_produksi		= $(".tab_detail_produksi");

		button_transaksi_tgl1.click(function(){
			transaksi_tgl.prop('readonly', false);
			transaksi_lama.prop('checked', true);

			tab_transaksi_lama.show();

			button_transaksi_tgl2.show();
			button_biaya_overhead.show();
			tab_detail_produksi.show();
			$(this).hide();
		});

		button_transaksi_tgl2.click(function(){
			var date 	= generate_date();
			var id 		= generate_id(date);

			transaksi_tgl.prop('readonly', true);
			transaksi_tgl.val(date);
			transaksi_lama.prop('checked', false);

			tab_transaksi_lama.hide();
			transaksi_id.val(id);

			button_transaksi_tgl1.show();
			button_biaya_overhead.hide();
			tab_detail_produksi.hide();
			$(this).hide();
		});

		transaksi_tgl.change(function(){
			var id = generate_id( $(this).val() );

			transaksi_id.val(id);
		});


		// ---------------------------------------------------- Data Pelanggan
		var button_pelanggan1 	= $("#button_pelanggan1");
		var button_pelanggan2 	= $("#button_pelanggan2");
		var pelanggan_id 		= $("#pelanggan_id");
		var pelanggan_nama 		= $("#pelanggan_nama");
		var pelanggan_hp 		= $("#pelanggan_hp");
		var pelanggan_hp_new 	= $("#pelanggan_hp_new");

		button_pelanggan1.click(function(){
			pelanggan_id.hide();
			
			pelanggan_nama.show();
			pelanggan_nama.val("");
			pelanggan_nama.prop('placeholder', '- cth : Andi -');

			pelanggan_hp_new.prop('readonly', false);
			pelanggan_hp_new.val("");
			pelanggan_hp_new.prop('placeholder', '- cth : 82100009999 -');

			button_pelanggan2.show();
			$(this).hide();
		});

		button_pelanggan2.click(function(){
			pelanggan_id.show();
			pelanggan_nama.hide();
			pelanggan_nama.val("");

			pelanggan_hp_new.prop('readonly', true);
			pelanggan_hp_new.removeAttr('placeholder');

			button_pelanggan1.show();
			$(this).hide();
		});

		pelanggan_id.change(function(){
			var i = $(this).prop('selectedIndex');
			pelanggan_hp.val(i);

			var text = $("#pelanggan_hp option:selected").text();
			pelanggan_hp_new.val(text);
		});

		// ---------------------------------------------------- Jumlah Pesanan (Button - Hanya Sablon)
		var button_jumlah_sablon = $("#button_jumlah_sablon");

		button_jumlah_sablon.click(function(){
			var lab_kaos_sablon		= $("#lab_kaos_sablon");
			var detail_bahan 		= $("#bahan");
			var show_bahan 			= $("#show_bahan");

			var input_kaos_ukuran 	= $("#input_kaos_ukuran");
			var kaos_warna 			= $("#kaos_warna");
			var jumlah_pesanan 		= $("#jumlah_pesanan");
			var prev_val 			= parseInt( jumlah_pesanan.val() );
			var jumlah_size_bahan 	= $(".jumlah_size_bahan");
			
			var harga_bahan 		= $(".harga_bahan");
			var show_harga_bahan  	= $(".show_harga_bahan");

			var harga_total_bahan 		= $(".harga_total_bahan");
			var show_harga_total_bahan 	= $(".show_harga_total_bahan");

			var button_kaos_sablon 	= $("#button_kaos_sablon");


			lab_kaos_sablon.html('Harga Sablon Saja &nbsp;&nbsp;');
			detail_bahan.val('');
			detail_bahan.prop('disabled', true);
			show_bahan.html("- - -");

			input_kaos_ukuran.prop('disabled', true);

			kaos_warna.val('');
			kaos_warna.prop('readonly', true);

			jumlah_pesanan.prop('readonly', false);

			jumlah_size_bahan.val(0);
			jumlah_size_bahan.prop('readonly', true);

			harga_bahan.val(0);
			show_harga_bahan.html(0);

			harga_total_bahan.val(0);
			show_harga_total_bahan.html(0);


			Bahan_Hitung();
			jumlah_pesanan.val(prev_val);
			Formula_Biaya();

			button_kaos_sablon.show();
			$(this).hide();
		});


		// ---------------------------------------------------- Jumlah Pesanan (Button - Hanya Sablon)
		var button_kaos_sablon = $("#button_kaos_sablon");

		button_kaos_sablon.click(function(){
			var lab_kaos_sablon		= $("#lab_kaos_sablon");
			var jumlah_pesanan 		= $("#jumlah_pesanan");
			var bahan 				= $("#bahan");
			var kaos_warna 			= $("#kaos_warna");
			var input_kaos_ukuran 	= $("#input_kaos_ukuran");
			var jumlah_size_bahan 	= $(".jumlah_size_bahan");
			var button_jumlah_sablon= $("#button_jumlah_sablon");


			lab_kaos_sablon.html('Harga Kaos + Sablon &nbsp;&nbsp;');
			jumlah_pesanan.val(0);
			jumlah_pesanan.prop('readonly', true);

			bahan.prop('disabled', false);
			kaos_warna.prop('readonly', false);
			input_kaos_ukuran.prop('disabled', false);

			jumlah_size_bahan.prop('readonly', false);

			Formula_Biaya();

			button_jumlah_sablon.show();
			$(this).hide();
		});


		// ---------------------------------------------------- Size Bahan (Multi Select)
		var input_kaos_ukuran = $("#input_kaos_ukuran");
		
		input_kaos_ukuran.change(function(){
			var options = input_kaos_ukuran.prop('selectedOptions');
			var values = Array.from(options).map(({ value }) => value);
			
			var input_kaos = $(".input_kaos");

			input_kaos.each(function(i, j){
				var num = i.toString();
				var check = values.includes(num);

				var tab_harga_bahan = $(".tab_harga_bahan").eq(i);

				if (check)
				{
					$(this).show();
					tab_harga_bahan.show();
				}
				else
				{
					$(this).hide();
					tab_harga_bahan.hide();

					$(".jumlah_size_bahan").eq(i).val(0);
					Bahan_Harga_Total(i, 0);
				}
			});
			
			Bahan_Hitung();
			Formula_Biaya();
		});	


		// ---------------------------------------------------- Posisi Bahan (Multi Select)
		var input_posisi_sablon = $("#input_posisi_sablon");

		input_posisi_sablon.change(function(){
			var options = input_posisi_sablon.prop('selectedOptions');
			var values = Array.from(options).map(({ value }) => value);

			var detail_sablon = $(".detail_sablon");

			detail_sablon.each(function(i, j){
				var num = i.toString();
				var check = values.includes(num);

				var tab_biaya_polyfilm = $(".tab_biaya_polyfilm").eq(i);
				var tab_biaya_tinta = $(".tab_biaya_tinta").eq(i);


				if (check)
				{
					$(this).show();

					tab_biaya_polyfilm.show();
					tab_biaya_tinta.show();
				}
				else
				{
					$(this).hide();

					// hide table
					tab_biaya_polyfilm.hide();
					tab_biaya_tinta.hide();

					// reset MAIN_INPUT
					$(".ukuran_sablon").eq(i).val('');
					$(".jumlah_warna").eq(i).val(0);

					// reset SIDE
					Polyfilm_Biaya(i, 0);
					Tinta_Biaya(i, 0);
					Polyfilm_Tinta_Total(i);
					Polyfilm_Tinta_Hitung();
					Warna_Hitung();
				}
			});

			Formula_Biaya();
		});


		// ---------------------------------------------------- Detail Sablon (IMAGE)
		var button_img_sablon1 = $(".button_img_sablon1");
		var button_img_sablon2 = $(".button_img_sablon2");
		var img_sablon_preview = $('.img_sablon_preview');

		button_img_sablon1.click(function(){
			var i = button_img_sablon1.index(this);
			img_sablon_preview.eq(i).show();

			button_img_sablon2.eq(i).show();
			$(this).hide();
		});

		button_img_sablon2.click(function(){
			var i = button_img_sablon2.index(this);
			img_sablon_preview.eq(i).hide();

			button_img_sablon1.eq(i).show();
			$(this).hide();
		});


		// ---------------------------------------------------- Persentase
		var persentase = $("#persentase");
		var button_persentase_usaha_show = $("#button_persentase_usaha_show");
		var button_persentase_usaha_hide = $("#button_persentase_usaha_hide");

		button_persentase_usaha_show.click(function(){
			persentase.prop('readonly', false);

			button_persentase_usaha_hide.show();
			$(this).hide();
		});

		button_persentase_usaha_hide.click(function(){
			persentase.prop('readonly', true);

			button_persentase_usaha_show.show();
			$(this).hide();
		});

	});
	
	
	function generate_date()
	{
		var now = new Date();

		var day = ("0" + now.getDate()).slice(-2);
		var month = ("0" + (now.getMonth() + 1)).slice(-2);
		var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

		return today;
	}

	function generate_it(length) 
	{
	    var result           = [];
	    var characters       = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    var charactersLength = characters.length;
	    for ( var i = 0; i < length; i++ ) {
	      result.push(characters.charAt(Math.floor(Math.random() * charactersLength)));
	   }
	   return result.join('');
	}

	function generate_id(val)
	{
		var date = val;
		var res = date.split("-");
		var newDate = "TRN" + res[0].substr(-2) + res[1] + res[2] + generate_it(3);

		return newDate;
	}
</script>

<form action="<?php echo site_url('Welcome/Insert_Transaksi'); ?>" method="post" enctype="multipart/form-data">

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
            	<div class="ibox-title">
                    <h2>Pemesanan</h2>
                    <div class="ibox-tools m-t-sm">
                        <input type="submit" name="btn_simpan" class="btn btn-sm btn-primary" value="Simpan">&nbsp;
                        <button type="button" class="btn btn-xs" style="border-radius: 100px;" 
                        		data-toggle="modal" data-target="#myModal">
                        	&nbsp;<i class="fa fa-info" style="font-size: 13px; color: gray;"></i>&nbsp;
                        </button>
                    </div>
        		</div>
        		<div class="ibox-content text-center sk-loading" 
        			 style="padding-top: 0px; padding-left: 18px;">

        			<!-- Sub-Content -->
                    <?php $this->load->view($Sub_Spinner); ?>

					<div class="fh-breadcrumb">
					    <div class="fh-column">
					        <div class="full-height">
					            <!-- Sub-Content -->
								<?php $this->load->view($Sub_Side_Menu); ?>
					        </div>
					    </div>

					    <div class="full-height-scroll text-left">
					        <div class="full-height white-bg border-left">

					            <div class="element-detail-box">
					                <div class="tab-content">
					                    <div id="tab-1" class="tab-pane active">
					              			<!-- Sub-Content -->
											<?php $this->load->view($Sub_Form_Tab); ?>
					                    </div>

					                    <div id="tab-2" class="tab-pane">
					                    	<!-- Sub-Content -->
											<?php $this->load->view($Sub_Formula_Tab); ?>
					                    </div>
</form>
					                    <div id="tab-3" class="tab-pane">
					                    	<h3 class="m-t-sm"><i class="fa fa-th-list"></i>&nbsp; 
												Daftar Biaya
											</h3>
											<div class="hr-line-dashed m-t-none"></div>
											
					                        <!-- Sub-Content -->
											<?php $this->load->view($Sub_Biaya_Tab); ?>
					                    </div>

					                    <div id="tab-4" class="tab-pane">
											<div class="m-t-md">
							    				<div class="tabs-container">
							                        <ul class="nav nav-tabs" role="tablist">
							                            <li><a id="link-1" class="nav-link active" data-toggle="tab" 
							                            	   href="#tab-trn-1">Transaksi</a></li>
							                            <li><a id="link-2" class="nav-link" data-toggle="tab" 
							                            	   href="#tab-trn-2">Detail</a></li>
							                        </ul>
							                        <div class="tab-content">
							                            <div role="tabpanel" id="tab-trn-1" class="tab-pane active">
							                                <div class="panel-body">
							                  					<!-- Sub-Content -->
																<?php $this->load->view($Sub_Transaksi_Tab); ?>
							                                </div>
							                            </div>
							                            <div role="tabpanel" id="tab-trn-2" class="tab-pane">
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

					        </div>
					    </div>
					</div>        			
				</div>
        	</div>
        </div>
    </div>
</div>


<!-- FAQ-Content -->
<?php $this->load->view($Sub_FAQ); ?>

<script>
	// ------ Previewing image before upload -------

    function readURL(input, num) 
    {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
          $('.img_sablon_preview').eq(num).attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
    }
    
  	$("#img_sablon_0").change(function(){ readURL(this, 0); });
    $("#img_sablon_1").change(function(){ readURL(this, 1); });
    $("#img_sablon_2").change(function(){ readURL(this, 2); });
    $("#img_sablon_3").change(function(){ readURL(this, 3); });
    $("#img_sablon_4").change(function(){ readURL(this, 4); });
    $("#img_sablon_5").change(function(){ readURL(this, 5); });
    $("#img_sablon_6").change(function(){ readURL(this, 6); });
    $("#img_sablon_7").change(function(){ readURL(this, 7); });
    $("#img_sablon_8").change(function(){ readURL(this, 8); });
    $("#img_sablon_9").change(function(){ readURL(this, 9); });

    // --------------------------------------------
</script>