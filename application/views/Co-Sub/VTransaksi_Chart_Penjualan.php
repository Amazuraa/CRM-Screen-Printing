<div class="m-t-lg m-b-md">
    <canvas id="myChart" height="140"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.1/dist/chart.js"></script>
	<!-- <script src="<?php echo base_url('template/js/plugins/chartJs/Chart.min.js') ?>"></script> -->

	<?php
		if (!empty($Map)) 
		{
			$tahun 		= date('Y');
			$keys 		= array_keys($Map);							// group all keys in Map
			$idx		= array_search($tahun."\\", $keys);			// find current year index on keys

			$arr_tahun 	= array_reverse($Map[$keys[$idx]]);
			$length		= count($arr_tahun) - 1;


			$arr_bulan 		= array();
			$arr_penjualan	= array();
			$arr_produksi	= array();
			$arr_gaji		= array();
			$arr_cash_in	= array();

			foreach ($arr_tahun as $key => $value)					// loop map based on index
			{
				if (!empty($value) && count($arr_bulan) != 4)
				{
					$bulan 			= stripslashes($key);
					$transaksi 		= file_get_contents("Pembukuan/".$tahun."/".$bulan."/".$value[0]);
					$json_transaksi	= json_decode($transaksi);

					$total_biaya_produksi 	= 0;
					$biaya_borongan			= 0;
					$total_harga_final		= 0;
					$sisa_dana_produksi		= 0;

					foreach ($json_transaksi as $read)
					{
						$total_biaya_produksi += $read->total_biaya_produksi;
						$biaya_borongan += $read->biaya_borongan;
						$total_harga_final += $read->total_harga_final;
						$sisa_dana_produksi += $read->sisa_dana_produksi;
					}

					$ex_bulan = explode("_", $bulan);

					array_push($arr_bulan, $ex_bulan[1]);
					array_push($arr_penjualan, $total_harga_final);
					array_push($arr_produksi, $total_biaya_produksi);
					array_push($arr_gaji, $biaya_borongan);
					array_push($arr_cash_in, $sisa_dana_produksi);
				}
			}

			$arr_bulan 		= array_reverse($arr_bulan);
			$arr_penjualan	= array_reverse($arr_penjualan);
			$arr_produksi	= array_reverse($arr_produksi);
			$arr_gaji		= array_reverse($arr_gaji);
			$arr_cash_in	= array_reverse($arr_cash_in);
		}
	?>

	<script>
		Chart.defaults.font.family = 'Ubuntu';	// Overrride global chart's font 
		// Chart.defaults.font.size = '13';

		var delayed;
	    var ctx = document.getElementById('myChart').getContext('2d');
	    var chart = new Chart(ctx, {
	    type: 'bar',
	    options: {
	        responsive: true,
	        animation: {
		      onComplete: () => {
		        delayed = true;
		      },
		      delay: (context) => {
		        let delay = 0;
		        if (context.type === 'data' && context.mode === 'default' && !delayed) {
		          delay = context.dataIndex * 400 + context.datasetIndex * 250;
		        }
		        return delay;
		      },
		    }
	    },
	    data: {
	        labels: [<?php foreach ($arr_bulan as $read) { echo "'".$read."',"; } ?>],
	        datasets: 
	        [
	        	{
	                label: "Penjualan",
	                backgroundColor: '#ff8474',
	                borderColor: "rgba(26,179,148,0.7)",
	                pointBackgroundColor: "rgba(26,179,148,1)",
	                pointBorderColor: "#fff",
	                data: [<?php foreach ($arr_penjualan as $read) { echo "'".$read."',"; } ?>]
	            },{
	                label: "Produksi",
	                backgroundColor: '#ffc996',
	                pointBorderColor: "#fff",
	                data: [<?php foreach ($arr_produksi as $read) { echo "'".$read."',"; } ?>]
	            },{
	                label: "Gaji",
	                backgroundColor: '#ffe5e2',
	                pointBorderColor: "#fff",
	                data: [<?php foreach ($arr_gaji as $read) { echo "'".$read."',"; } ?>]
	            },{
	                label: "Cash In",
	                backgroundColor: '#b6c9f0',
	                pointBorderColor: "#fff",
	                data: [<?php foreach ($arr_cash_in as $read) { echo "'".$read."',"; } ?>]
	            }
	        ]
		    },
		});
	</script>
</div>