<?php $Mode = $this->uri->segment(3); ?>

<script>
	$(document).ready(function()
	{
		// -------------------------------------------- DEV MODE
		var mode = '<?php echo $Mode; ?>';

		if (mode != 'Dev')
			$(".devMode").hide();
		
		$(".select2").select2();
	});
</script>

<script>
	$(document).ready(function()
	{
		var status_produksi_parent = $("#status_produksi_parent");
		// status_produksi_parent.hide();
		// Status_Produksi();

		// ---------------------------------------------------------
		setTimeout(Aktivitas_Produksi_0, 1700);
		setTimeout(Tenaga_Kerja_0, 1700);
		setTimeout(ID_Produksi_0, 1700);
		setTimeout(Produksi_Length, 1700);

		// ---------------------------------------------------------
		var navigation = $(".Test");

		navigation.click(function(){
			var idx = parseInt(navigation.index(this));
			$(".btn-presensi").hide();

			Aktivitas_Produksi(idx);
			Tenaga_Kerja(idx);
			ID_Produksi(idx);

			Reset_Images();
			$(".ipt-idx").val(idx);

			$(".btn-submit").hide();
		});
	});

	function Produksi_Length()
	{ 	$(".input_length").val($(".length_produksi").html()); }

	function ID_Produksi_0()
	{ 	ID_Produksi(0); }

	function ID_Produksi(idx)
	{	$(".input_id_produksi").val( $(".id_produksi").eq(idx).html() ); }
	
	function Tenaga_Kerja_0()
	{ 	Tenaga_Kerja(0); }

	function Tenaga_Kerja(idx)
	{
		$(".Pekerja-List").hide();
		$(".Pekerja-Nama").html('-');

		$(".tab-presensi").hide()
		$(".tab-presensi-tgl").html('-');
		
		// JSON Decode in javascript..
		var arr_pekerja = JSON.parse($(".karyawan_produksi").eq(idx).html());
		var len = arr_pekerja.length;

		for (var i = 0; i < len; i++)
		{
			// Show Pekerja
			$(".Pekerja-List").eq(i).show();
			$(".Pekerja-Nama").eq(i).html( arr_pekerja[i].nama_user );
			$(".Pekerja-Tanggal").eq(i).html( arr_pekerja[i].tgl_bergabung );


			// Check if already present
			if (arr_pekerja[i].nama_user == $(".acc_nama").html())
			{
				$(".btn-presensi").eq(idx).show();
				$(".sp-no").eq(idx).show();

				var today = generate_date();

				// already did presensi
				if (arr_pekerja[i].akhir_presensi == today)
				{
					$(".btn-presensi").eq(idx).css('pointer-events', 'none');
					$(".btn-presensi").eq(idx).removeClass('btn-info');
					$(".btn-presensi").eq(idx).addClass('btn-secondary');
					
					$(".sp-no").eq(idx).hide();
					$(".sp-yes").eq(idx).show();
				}
			}


			// Show Pekerja Presensi
			var arr_presensi = JSON.parse($(".lab-karyawan-presensi").html());
			var len_presensi = arr_presensi.length;

			// Loop Presensi
			for (var j = 0; j < len_presensi; j++)
			{
				// Check if id_user is equal
				if (arr_pekerja[i].id_user == arr_presensi[j].id_user)
				{
					// Decode data_presensi_produksi
					var arr_data_presensi = JSON.parse(arr_presensi[j].data_presensi_produksi);

					// Loop data_presensi_produksi by length
					for (var k = 0; k < arr_data_presensi.length; k++) 
					{
						// check if id_produksi is equal
						if (arr_data_presensi[k].id_produksi == $(".id_produksi").eq(idx).html())
						{
							if (arr_data_presensi[k].tanggal.length != 0)
							{
								var l = 0;
								var parent = $(".tab-presensi-parent").eq(i);

								// Loop all tab-presensi in parent
								parent.find(".tab-presensi").each(function()
								{
									$(this).show();											// show tab
									$(this).find(".tab-presensi-tgl").each(function(){		// loop grandchild
										$(this).html(arr_data_presensi[k].tanggal[l]);		// show tanggal
									});

									l++;

									if (l == arr_data_presensi[k].tanggal.length)			// break, if has reached limit
										return false;
								});
							}

							break;
						}					
					}

					break;
				}
			}
		}
	}

	function generate_date()
	{
		var now = new Date();

		var day = ("0" + now.getDate()).slice(-2);
		var month = ("0" + (now.getMonth() + 1)).slice(-2);
		var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

		return today;
	}

	function Status_Produksi_Parent()
	{
		var status_produksi_parent = $("#status_produksi_parent");
		status_produksi_parent.show();

		var status_produksi_break = $("#status_produksi_break");
		status_produksi_break.hide();
	}

	function Status_Produksi()
	{
		var status_produksi_content = $("#status_produksi_content");
		status_produksi_content.load("<?php echo base_url().'Welcome/Produksi_Content'; ?>");	
	}

	function Aktivitas_Produksi_0()
	{	Aktivitas_Produksi(0);	}

	function Aktivitas_Produksi(idx)
	{
		var pesanan_dibuat 			= $(".pesanan_dibuat").eq(idx);
		var tgl_mulai_produksi 		= $(".tgl_mulai_produksi").eq(idx);
		var tgl_selesai_produksi 	= $(".tgl_selesai_produksi").eq(idx);

		var timeline_pesanan_dibuat 		= $("#timeline_pesanan_dibuat");
		var timeline_tgl_mulai_produksi 	= $("#timeline_tgl_mulai_produksi");
		var timeline_tgl_selesai_produksi 	= $("#timeline_tgl_selesai_produksi");

		// --------------------------------------------------------------
		var icon_pesanan_dibuat = $(".icon_pesanan_dibuat");
		var val_pesanan_dibuat;

		if (pesanan_dibuat.html() != '') {
			val_pesanan_dibuat = pesanan_dibuat.html() + " - Admin";
			icon_pesanan_dibuat.removeClass("gray-bg");
			icon_pesanan_dibuat.addClass("navy-bg");
		}
		else{
			val_pesanan_dibuat = " - ";
			icon_pesanan_dibuat.removeClass("navy-bg");
			icon_pesanan_dibuat.addClass("gray-bg");
		}

		// --------------------------------------------------------------
		var icon_tgl_mulai_produksi = $(".icon_tgl_mulai_produksi");
		var val_tgl_mulai_produksi;

		if (tgl_mulai_produksi.html() != ''){
			val_tgl_mulai_produksi = tgl_mulai_produksi.html() + " - Admin";
			icon_tgl_mulai_produksi.removeClass("gray-bg");
			icon_tgl_mulai_produksi.addClass("navy-bg");
		}
		else{
			val_tgl_mulai_produksi = " - ";
			icon_tgl_mulai_produksi.removeClass("navy-bg");
			icon_tgl_mulai_produksi.addClass("gray-bg");
		}

		// --------------------------------------------------------------
		var icon_tgl_selesai_produksi = $(".icon_tgl_selesai_produksi");
		var val_tgl_selesai_produksi;

		if (tgl_selesai_produksi.html() != ''){
			val_tgl_selesai_produksi = tgl_selesai_produksi.html() + " - Admin";
			icon_tgl_selesai_produksi.removeClass("gray-bg");
			icon_tgl_selesai_produksi.addClass("navy-bg");	
		}
		else{
			val_tgl_selesai_produksi = " - ";
			icon_tgl_selesai_produksi.removeClass("navy-bg");
			icon_tgl_selesai_produksi.addClass("gray-bg");		
		}

		

		timeline_pesanan_dibuat.html(val_pesanan_dibuat);
		timeline_tgl_mulai_produksi.html(val_tgl_mulai_produksi);
		timeline_tgl_selesai_produksi.html(val_tgl_selesai_produksi);
	}

	function Reset_Images()
	{
		$(".ipt-image-layer").val("");
		$(".tab-i-image-design").val("");
		$(".ipt-image-name").val("");
		$(".ipt-step-warna").val("");
	}
</script>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox ">

            	<form action="<?php echo site_url('Welcome/Produksi_UpdateData'); ?>" method="post" enctype="multipart/form-data">
            	<div class="ibox-title">
                    <h2>Daftar Produksi</h2>
                    <div class="ibox-tools m-t-sm">
                        <input type="submit" name="btn_simpan" class="btn btn-warning btn-xs btn-submit m-l-sm devMode" value="Ubah Data">
                        <button type="button" class="btn btn-xs" style="border-radius: 100px;" 
                        		data-toggle="modal" data-target="#myModal">
                        	&nbsp;<i class="fa fa-info" style="font-size: 13px; color: gray;"></i>&nbsp;
                        </button>

                    </div>
        		</div>
                <div class="ibox-content text-center sk-loading" style="padding-top: 0px; 
                														padding-left: 18px;">
                	<!-- <div id="status_produksi_break" style="margin: 100px;"></div> -->
                	<!-- Sub-Content -->
    				<?php $this->load->view($Sub_Spinner); ?>

					<div class="fh-breadcrumb" id="status_produksi_parent">
						<div class="fh-column">
						    <div class="full-height">
						        <!-- Sub-Content -->
                				<?php $this->load->view($Sub_Side_Menu); ?>
						    </div>
						</div>

						<div class="full-height-scroll text-left">
						    <div class="full-height white-bg border-left">
						    	<!-- Sub-Content -->
                				<?php $this->load->view($Sub_Detail); ?>
						    </div>
						</div>
					</div>
				</div>
				</form>

			</div>
		</div>

		<div class="col-lg-4">
			<!-- TIMELINE -->
			<div class="">
	            <div class="ibox ">
	            	<div class="ibox-title">
	                    <h2>Aktivitas Produksi</h2>
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
                        
		                <!-- Sub-Content -->
        				<?php $this->load->view($Sub_Timeline); ?>
	                </div>
	            </div>
	        </div>

			<!-- TENAGA KERJA -->
			<div class="">
	            <div class="ibox ">
	            	<div class="ibox-title">
	                    <h2>Tenaga Kerja</h2>
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
		    			
		                <!-- Sub-Content -->
        				<?php $this->load->view($Sub_Tenaga_Kerja); ?>
	                </div>
	            </div>
	        </div>
    	</div>
	</div>
</div>

<!-- FAQ-Content -->
<?php $this->load->view($Sub_FAQ); ?>


<label class="devMode length_produksi"><?php echo count($DataProduksi); ?></label>

<?php
if (!empty($DataProduksi))
{
	foreach ($DataProduksi as $ReadDS) 
	{
		$json_riwayat_produksi = json_decode($ReadDS->riwayat_produksi, true);

    	if(!empty($json_riwayat_produksi))
    	{
    		$i = 1;
    		foreach ($json_riwayat_produksi as $key => $value)
    		{
?>
        	<label class="devMode <?php echo $key; ?>"><?php
										        			if ($i != 4 && $value != '')
										        			{
										        				$x = date_create($value);
																echo date_format($x, 'd M Y');     	
										        			}
										        		?></label>
<?php
				$i++;
    		}
    	}
?>
		<label class="devMode id_produksi"><?php echo $ReadDS->id_produksi; ?></label>
		<label class="devMode karyawan_produksi"><?php echo $ReadDS->karyawan_produksi; ?></label>
		<label class="devMode acc_nama"><?php echo $userNama; ?></label>
<?php
	}
}
?>
		<label class="devMode lab-karyawan-presensi"><?php print_r(json_encode($DataPresensi)); ?></label>
