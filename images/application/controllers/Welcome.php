<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		
		// Load 'MSudi' script
		$this->load->model('MSudi');
		$this->load->model('model_app');

		$id_user = $this->session->userdata('Login');
		$tampil = $this->MSudi->GetDataWhere('tbl_user', 'id_user', $id_user)->row();

		$this->IdUser = $id_user;
		$this->UA = $tampil->akses_user;
		$this->Nama = $tampil->nama_user;

		$page = $this->MSudi->GetDataWhere('tbl_user_config', 'user_akses', $this->UA)->row();
		$this->Page = $page->user_page;
	}

	public function index()
	{
		if($this->session->userdata('Login'))
		{
			date_default_timezone_set("Asia/Jakarta");
			$id = $this->IdUser;

			$presensi = $this->MSudi->GetDataWhere('tbl_user_presensi', 'id_user', $id)->row();
			$arr_data_presensi = json_decode($presensi->data_presensi, true);

			// Check if already present on same date...
			$now = date('Y-m-d');
			$check = array_count_values(array_column($arr_data_presensi, 'tanggal')); 	// count same array by tanggal
			$check2 = array_key_exists($now, $check);									// check if existed

			if (!$check2)
			{
				array_push($arr_data_presensi, array(
					'tanggal' 	=> $now,
					'jam' 		=> date('h:i:s')
				));

				$update['data_presensi'] 	= json_encode($arr_data_presensi, true);

				$query = $this->MSudi->UpdateData('tbl_user_presensi', 'id_user', $id, $update);
			}

			redirect('Welcome/Dashboard');
		}
		else
		{
			redirect('Login');
		}
	}

	public function UploadImage($dir, $input_name)
	{
		$config['upload_path'] = $dir;
		$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG';
		
		$this->load->library('upload', $config);

		if($this->upload->do_upload($input_name))	// input name
		{
			$upload_data = $this->upload->data();
			$file_name = $upload_data['file_name'];
			return $file_name;
		}
	}

	public function UploadImageMulti($dir, $input_name)
	{
		$this->load->library('upload');
		$dataInfo = array();
		$files = $_FILES;

		$cpt = count($_FILES[$input_name]['name']);
		for($i=0; $i<$cpt; $i++)
		{           
			$_FILES['file']['name']       = $_FILES[$input_name]['name'][$i];
            $_FILES['file']['type']       = $_FILES[$input_name]['type'][$i];
            $_FILES['file']['tmp_name']   = $_FILES[$input_name]['tmp_name'][$i];
            $_FILES['file']['error']      = $_FILES[$input_name]['error'][$i];
            $_FILES['file']['size']       = $_FILES[$input_name]['size'][$i];

			// File upload configuration
            $uploadPath = $dir;
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';

			// Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

			// Upload file to server
            if($this->upload->do_upload('file')){
                // Uploaded file data
                $imageData = $this->upload->data();
                // $uploadImgData[$i]['image_name'] = $imageData['file_name'];
				$dataInfo[] = $imageData['file_name'];
            }
		}

		return $dataInfo;
	}

	public function generate_id($strength = 16) 
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


	public function Dashboard()
	{
		$this->load->helper('directory');
		$data['Map'] = directory_map('./Pembukuan/', FALSE, TRUE);

		$data['content'] 	= 'Co-Primary/VDashboard';
		$data['menu'] 		= 'Co-Main/VTemplate_Menu';

		$data['userAkses'] 	= $this->UA;
		$data['userNama'] 	= $this->Nama;
		$data['userPage']	= $this->Page;

		$data['Sub_Spinner'] 			= 'Co-Sub/VSpinner';
		$data['Sub_FAQ'] 				= 'Co-FAQ/VFAQ_Modal';
		$data['Mode_FAQ'] 				= 'Pembukuan';

		$data['Sub_Presensi_User'] 		= 'Co-Sub/VUser_Presensi';
		$data['Sub_Chart_Penjualan'] 	= 'Co-Sub/VTransaksi_Chart_Penjualan';

		$data['DataUser'] 				= $this->MSudi->GetData('tbl_user');
		$data['DataPresensi'] 			= $this->MSudi->GetData('tbl_user_presensi');

		$this->load->view('Co-Main/VTemplate', $data);
	}

	public function PrintOut()
	{
		$page 	= $this->uri->segment(3);
		$id 	= $this->uri->segment(4);

		switch ($page) 
		{
			case 'Invoice':
				$Transaksi 	= $this->MSudi->GetDataWhere('tbl_transaksi', 'id_transaksi', $id)->row();
				$Pelanggan 	= $this->MSudi->GetDataWhere('tbl_pelanggan', 'id_pelanggan', $Transaksi->id_pelanggan)->row();

				$data['DataTransaksi'] 	= $Transaksi;
				$data['DataPelanggan'] 	= $Pelanggan;
				$data['Sub_Content']	= 'Co-Print/VPrint_Invoice';
				break;

			case 'SPK':
				$Produksi 	= $this->MSudi->GetDataWhere('tbl_produksi', 'id_produksi', $id)->row();
				$Pelanggan 	= $this->MSudi->GetDataWhere('tbl_pelanggan', 'id_pelanggan', $Produksi->id_pelanggan)->row();

				$data['DataProduksi'] 	= $Produksi;
				$data['DataPelanggan'] 	= $Pelanggan;
				$data['Sub_Content']	= 'Co-Print/VPrint_SPK';
				break;

			case 'Transaksi':
				$Transaksi 	= $this->MSudi->GetDataWhere('tbl_transaksi', 'id_transaksi', $id)->row();
				$Pelanggan 	= $this->MSudi->GetDataWhere('tbl_pelanggan', 'id_pelanggan', $Transaksi->id_pelanggan)->row();

				$data['DataTransaksi'] 	= $Transaksi;
				$data['DataPelanggan'] 	= $Pelanggan;
				$data['Sub_Content']	= 'Co-Print/VPrint_Transaksi';
				break;
		}


		$data['content'] 		= 'Co-Primary/VPrint';
		$data['menu'] 			= 'Co-Main/VTemplate_Menu';

		$data['userAkses'] 		= $this->UA;
		$data['userNama'] 		= $this->Nama;
		$data['userPage']		= $this->Page;

		$data['Sub_Spinner'] 	= 'Co-Sub/VSpinner';
		$data['Sub_FAQ'] 		= 'Co-FAQ/VFAQ_Modal';
		$data['Mode_FAQ'] 		= 'Pembukuan';

		// Biaya Data Extension
		$data['DataFormula'] 	= $this->MSudi->GetDataWhere('tbl_formula','id_formula','1')->row();
		$data['DataTinta'] 		= $this->MSudi->GetData('tbl_tinta');
		$data['DataBahan'] 		= $this->MSudi->GetDataWhere('tbl_bahan','id_bahan','1')->row();
		$data['Sub_Biaya_Tab'] 	= 'Co-Sub/VPemesanan_Biaya_Tab';
		$data['Mode_Biaya']		= 'Pembukuan';

		$this->load->view('Co-Main/VTemplate', $data);
	}



	public function Transaksi()
	{
		$transaksi = $this->MSudi->GetData('tbl_transaksi');

		if (!empty($transaksi))
		{
			$i = 0;
			foreach ($transaksi as $Read) {
				$pelanggan = $this->MSudi->GetDataWhere('tbl_pelanggan','id_pelanggan',$Read->id_pelanggan)->row();
				$Read->nama_pelanggan = $pelanggan->nama_pelanggan;
			}
		}

		$data['DataFormula'] 	= $this->MSudi->GetDataWhere('tbl_formula','id_formula','1')->row();
		$data['DataTinta'] 		= $this->MSudi->GetData('tbl_tinta');
		$data['DataBahan'] 		= $this->MSudi->GetDataWhere('tbl_bahan','id_bahan','1')->row();
		$data['DataPelanggan'] 	= $this->MSudi->GetData('tbl_pelanggan');
		$data['DataUser'] 		= $this->MSudi->GetData('tbl_user');
		$data['DataTransaksi'] 	= $transaksi;


		// assigning content to display
		$data['content'] 			= 'Co-Primary/VPemesanan';
		$data['menu'] 				= 'Co-Main/VTemplate_Menu';

		$data['userAkses'] 	= $this->UA;
		$data['userNama'] 	= $this->Nama;
		$data['userPage']	= $this->Page;


		$data['Sub_Spinner'] 		= 'Co-Sub/VSpinner';
		$data['Sub_FAQ'] 			= 'Co-FAQ/VFAQ_Modal';
		$data['Mode_FAQ'] 			= 'Transaksi';

		$data['Sub_Side_Menu'] 		= 'Co-Sub/VPemesanan_Side_Menu';
		$data['Sub_Form_Tab'] 		= 'Co-Sub/VPemesanan_Form_Tab';
		$data['Sub_Formula_Tab'] 	= 'Co-Sub/VPemesanan_Formula_Tab';

		$data['Sub_Biaya_Tab'] 		= 'Co-Sub/VPemesanan_Biaya_Tab';
		$data['Mode_Biaya']			= 'Pemesanan';

		$data['Sub_Transaksi_Tab'] 	= 'Co-Sub/VPemesanan_Transaksi_Tab';
		$data['Sub_Detail_Tab'] 	= 'Co-Sub/VTransaksi_Detail_Tab';
		
		$this->load->view('Co-Main/VTemplate',$data);
	}

	public function Insert_Transaksi()
	{
		// determine old transaction
		$old = ($this->input->post('input_transaksi_tgl') != date('Y-m-d')) ? 'true' : 'false';

		// field data transaksi -------------------------------------------------
		$arr_data_transaksi = array(
			'tgl_masuk' 			=> $this->input->post('input_transaksi_tgl'),
			'tgl_selesai' 			=> ($old == 'true') ? $this->input->post('input_transaksi_tgl_selesai') : '',
			'estimasi_selesai'		=> $this->input->post('input_estimasi'),
			'pembayaran_awal' 		=> $this->input->post('input_total_bayar'),
			'pembayaran_akhir' 		=> $this->input->post('input_sisa_bayar'),
			'pembayaran_status'		=> $this->input->post('input_status_bayar')
		);
		

		// field data biaya -----------------------------------------------------
		$arr_biaya_polyfilm = array();
		$arr_biaya_tinta = array();
		$arr_formula_biaya = array();
		$arr_biaya_overhead = array();

		if (!empty($this->input->post('input_detail_rincian_biaya')))
		{
			$i = 0;
			foreach ($this->input->post('input_detail_rincian_biaya') as $Read) 
			{
				array_push($arr_formula_biaya, array(
					'rincian' => $Read,
					'biaya' => $this->input->post('input_detail_biaya')[$i],
					'total' => $this->input->post('input_detail_total_biaya')[$i]
				));

				$i++;
			}
		}

		if (!empty($this->input->post('input_biaya_polyfilm')))
		{
			$i = 0;
			foreach ($this->input->post('input_biaya_polyfilm') as $Read) 
			{
				if ($Read != 0) 
				{
					array_push($arr_biaya_polyfilm, array(
						'posisi' => $this->input->post('input_posisi_sablon')[$i],
						'biaya' => $Read,
						'total' => $this->input->post('input_biaya_total_polyfilm')[$i]
					));

					array_push($arr_biaya_tinta, array(
						'posisi' => $this->input->post('input_posisi_sablon')[$i],
						'biaya' => $this->input->post('input_biaya_tinta')[$i],
						'total' => $this->input->post('input_biaya_total_tinta')[$i],
					));
				}
				
				$i++;
			}
		}

		$sisa_dana = $this->input->post('input_sisa_dana');

		if ($old == 'true')
		{
			$i = 0;
			foreach ($this->input->post('input_biaya_overhead') as $Read)
			{
				if ($Read != 0)
				{
					array_push($arr_biaya_overhead, array(
						'keterangan' => $this->input->post('input_keterangan_overhead')[$i],
						'biaya'		=> $Read
					));
				}

				$i++;
			}

			if ($this->input->post('input_sisa_dana_final') != 0)
				$sisa_dana = $this->input->post('input_sisa_dana_final');
		}

		$arr_data_biaya 	= array(
			'total_warna' 			=> $this->input->post('input_total_warna'),
			'biaya_polyfilm'		=> json_encode($arr_biaya_polyfilm, true),
			'total_biaya_polyfilm'	=> $this->input->post('input_total_polyfilm'),
			'biaya_tinta'			=> json_encode($arr_biaya_tinta, true),
			'total_biaya_tinta'		=> $this->input->post('input_total_tinta'),
			'formula_biaya'			=> json_encode($arr_formula_biaya, true),
			'total_biaya_produksi' 	=> $this->input->post('input_total_biaya_produksi'),
			'beban_produksi' 		=> $this->input->post('input_beban_produksi'),
			'operasional_produksi' 	=> $this->input->post('input_operasional_produksi'),
			'biaya_borongan' 		=> $this->input->post('input_biaya_borongan'),
			'persentase_usaha' 		=> $this->input->post('input_persentase'),
			'harga_kaos_sablon'		=> $this->input->post('input_harga_kaos_sablon'),
			'harga_sablon_saja'		=> $this->input->post('input_harga_sablon_saja'),
			'total_harga_minimum' 	=> $this->input->post('input_harga_minimum'),
			'harga_final' 			=> $this->input->post('input_harga_final'),
			'total_harga_final'		=> $this->input->post('input_total_harga_final'),
			'selisih_harga_satuan'	=> $this->input->post('input_selisih_satuan'),
			'selisih_harga_jual'	=> $this->input->post('input_selisih_total'),
			'biaya_overhead'		=> json_encode($arr_biaya_overhead, true),
			'sisa_dana_produksi'	=> $sisa_dana
		);


		// field data produksi --------------------------------------------------
		$arr_ukuran_kaos = array();
		$arr_detail_sablon = array();

		if (!empty($this->input->post('input_jumlah_size_bahan'))) 
		{
			$i = 0;
			foreach ($this->input->post('input_jumlah_size_bahan') as $Read) 
			{
				if ($Read != 0) 
				{
					array_push($arr_ukuran_kaos, array(
						'ukuran' => $this->input->post('input_size_bahan')[$i],
						'jumlah' => $Read
					));
				}
				$i++;
			}
		}

		if (!empty($this->input->post('input_jumlah_warna_sablon'))) 
		{
			$i = 0;
			foreach ($this->input->post('input_jumlah_warna_sablon') as $Read) 
			{
				if ($Read != 0) 
				{
					// $n = 'input_image'.$i;
					// $uptFile = $this->UploadImage('./images/', $n);

					array_push($arr_detail_sablon, array(
						'posisi' => $this->input->post('input_posisi_sablon')[$i],
						'ukuran' => $this->input->post('input_ukuran_sablon')[$i],
						'jumlah_warna' => $Read,
						'step_warna' => array(),
						'gambar' => array()
					));	
				}
				$i++;
			}
		}

		$arr_data_produksi 	= array(
			'brand' 			=> $this->input->post('input_brand'),
			'jumlah_pesanan' 	=> $this->input->post('input_jumlah_pesanan'),
			'nama_tinta' 		=> $this->input->post('input_jenis_tinta'),
			'nama_bahan' 		=> $this->input->post('input_bahan'),
			'warna_bahan'		=> $this->input->post('input_bahan_warna'),
			'ukuran_bahan'		=> json_encode($arr_ukuran_kaos, true),
			'detail_sablon'		=> json_encode($arr_detail_sablon, true),
			'design_sablon'		=> ''
		);


		$id_pelanggan = $this->input->post('input_pelanggan_id');

		// Add Pelanggan
		if ($this->input->post('input_pelanggan_nama_new') != "")
		{
			// New Id Pelanggan
			$id_pelanggan = "PLG".$this->generate_id(9);

			$add_pelanggan['id_pelanggan'] 		= $id_pelanggan;
			$add_pelanggan['nama_pelanggan'] 	= $this->input->post('input_pelanggan_nama_new');
			$add_pelanggan['telp_pelanggan'] 	= "62".$this->input->post('input_pelanggan_hp_new');

			// ADD new data to database
        	$this->MSudi->AddData('tbl_pelanggan', $add_pelanggan);
		}


		$id_produksi = 'PRO'.substr($this->input->post('input_transaksi_id'), 3);

		// set each data
		$add['id_transaksi'] 		= $this->input->post('input_transaksi_id');
        $add['id_pelanggan'] 		= $id_pelanggan;
        $add['data_transaksi'] 		= json_encode($arr_data_transaksi, true);
        $add['data_biaya'] 			= json_encode($arr_data_biaya, true);
        $add['data_produksi'] 		= json_encode($arr_data_produksi, true);
        $add['id_produksi'] 		= $id_produksi;
        $add['status_transaksi'] 	= ($old == 'true') ? 2 : 1;
		
		// ADD new data to database
        $this->MSudi->AddData('tbl_transaksi', $add);


        // ------------------------------------- PRODUKSI ----------------------------------------
        $arr_riwayat_produksi = array();
        $arr_karyawan_produksi = array();

		if ($old == 'true')
		{
			$datetime1 = date_create($this->input->post('input_tgl_mulai_produksi'));
			$datetime2 = date_create($this->input->post('input_tgl_selesai_produksi'));
			$interval = date_diff($datetime1, $datetime2);  /*  [= datetime2 - datetime1]  */

			$arr_riwayat_produksi = array(
	        	'pesanan_dibuat' 		=> $this->input->post('input_transaksi_tgl'),
	        	'tgl_mulai_produksi' 	=> $this->input->post('input_tgl_mulai_produksi'),
	        	'tgl_selesai_produksi' 	=> $this->input->post('input_tgl_selesai_produksi'),
	        	'lama_produksi' 		=> $interval->days + 1
	        );


			$DataUser = $this->MSudi->GetData('tbl_user');

			foreach ($this->input->post('input_pekerja') as $Read)
			{
				$num = intval($Read);

				foreach ($DataUser as $r) 
				{
					if ($r->id_user == $num)
					{
						array_push($arr_karyawan_produksi, array(
							'id_user'			=> $num,
							'nama_user'			=> $r->nama_user,
							'tgl_bergabung'		=> $this->input->post('input_tgl_mulai_produksi'),
							'akhir_presensi'	=> $this->input->post('input_tgl_mulai_produksi')
						));

						break;
					}
				}
			}
		}
		else
		{
			$arr_riwayat_produksi = array(
	        	'pesanan_dibuat' 		=> $this->input->post('input_transaksi_tgl'),
	        	'tgl_mulai_produksi' 	=> '',
	        	'tgl_selesai_produksi' 	=> '',
	        	'lama_produksi' 		=> 0
	        );	
		}

        // set each data
		$add_pro['id_produksi'] 		= $id_produksi;
		$add_pro['id_pelanggan'] 		= $id_pelanggan;
        $add_pro['riwayat_produksi'] 	= json_encode($arr_riwayat_produksi, true);
        $add_pro['karyawan_produksi'] 	= json_encode($arr_karyawan_produksi, true);
        $add_pro['data_produksi'] 		= json_encode($arr_data_produksi, true);
        $add_pro['status_produksi'] 	= ($old == 'true') ? 3 : 1;;

		// ADD new data to database
        $this->MSudi->AddData('tbl_produksi', $add_pro);


        // RE-DIRECT to page
        redirect(site_url('Welcome/PrintOut/Invoice/'.$this->input->post('input_transaksi_id')));
	}

	public function Update_Transaksi()
	{
		$id = $this->input->post('input_id_transaksi');

		$transaksi = $this->MSudi->GetDataWhere('tbl_transaksi','id_transaksi', $id)->row();
		
		$json_data_transaksi = json_decode($transaksi->data_transaksi, true);

		if ($this->input->post('input_check_lunas'))
		{
			$json_data_transaksi['tgl_selesai'] = date("Y-m-d");
			$json_data_transaksi['pembayaran_status'] = "LUNAS";
		}
		

		$json_data_biaya = json_decode($transaksi->data_biaya, true);
		$data_overhead = json_decode($json_data_biaya['biaya_overhead'], true);

		$i = 0;
		foreach ($this->input->post('input_overhead_biaya') as $read) 
		{
			if ($read != 0)
			{
				array_push($data_overhead, array(
					'keterangan' 	=> $this->input->post('input_overhead_ket')[$i],
					'biaya'			=> $read
				));
			}
			$i++;
		}

		
		$json_data_biaya['biaya_overhead'] = json_encode($data_overhead);
		$json_data_biaya['sisa_dana_produksi'] = $this->input->post('input_sisa_dana_produksi');


		if ($this->input->post('input_check_lunas'))
			$update['status_transaksi'] = '2';

		$update['data_transaksi'] 	= json_encode($json_data_transaksi);
		$update['data_biaya'] 		= json_encode($json_data_biaya);


		$query = $this->MSudi->UpdateData('tbl_transaksi', 'id_transaksi', $id, $update);


		// --- GANTI AJAX MODE NANTI! ---
        // echo json_encode($json_riwayat_produksi);
		redirect(site_url('Welcome/Pembukuan'));
	}

	public function Update_Biaya_Transaksi()
	{
		$arr_rincian_formula = array();
		$arr_posisi_formula = array();
		$arr_sablon_formula = array();

		// $formula = $this->MSudi->GetDataWhere('tbl_pelanggan','id_pelanggan',$Read->id_pelanggan)->row();

		// $update['biaya_formula'] 	= json_encode($json_);
		// $update['posisi_formula'] 	= json_encode($json_);
		// $update['sablon_formula'] 	= json_encode($json_);

		// $query = $this->MSudi->UpdateData('tbl_formula', 'id_formula', 1, $update);


		// --- GANTI AJAX MODE NANTI! ---
        // echo json_encode($json_riwayat_produksi);
		// redirect(site_url('Welcome/Transaksi'));
	}



	public function Produksi_Content()
	{
		$DataProduksi = $this->MSudi->GetData('tbl_produksi');

		if (!empty($DataProduksi)) 
		{
			foreach ($DataProduksi as $Read) 
			{
				// GET/SET nama pelanggan
				$nama_pelanggan = 
					$this->MSudi->SelectDataWhere('tbl_pelanggan','nama_pelanggan',
												  'id_pelanggan', $Read->id_pelanggan)->row();
				$Read->nama_pelanggan = $nama_pelanggan->nama_pelanggan;
			}
		}
		$data['DataProduksi'] = $DataProduksi;

		$this->load->view('VProduksi_Content',$data);
	}

	public function Produksi()
	{
		$DataProduksi = $this->MSudi->GetData('tbl_produksi');

		if (!empty($DataProduksi)) 
		{
			foreach ($DataProduksi as $Read) 
			{
				// GET/SET nama pelanggan
				$nama_pelanggan = $this->MSudi->SelectDataWhere('tbl_pelanggan','nama_pelanggan',
												  				'id_pelanggan', $Read->id_pelanggan)->row();
				$Read->nama_pelanggan = $nama_pelanggan->nama_pelanggan;
			}
		}

		$data['DataUser'] 			= $this->MSudi->GetData('tbl_user');
		$data['DataPresensi']		= $this->MSudi->SelectData2('tbl_user_presensi', 'id_user', 'data_presensi_produksi');

		$data['DataProduksi'] 		= $DataProduksi;
		$data['content'] 			= 'Co-Primary/VProduksi';
		$data['menu'] 				= 'Co-Main/VTemplate_Menu';

		$data['userAkses'] 			= $this->UA;
		$data['userNama'] 			= $this->Nama;
		$data['userPage']			= $this->Page;

		$data['Sub_Spinner'] 		= 'Co-Sub/VSpinner';
		$data['Sub_FAQ'] 			= 'Co-FAQ/VFAQ_Modal';
		$data['Mode_FAQ'] 			= 'Produksi';

		$data['Sub_Side_Menu'] 		= 'Co-Sub/VProduksi_Side_Menu';
		$data['Sub_Detail'] 		= 'Co-Sub/VProduksi_Detail';
		$data['Sub_Timeline'] 		= 'Co-Sub/VProduksi_Timeline';
		$data['Sub_Tenaga_Kerja'] 	= 'Co-Sub/VProduksi_Tenaga_Kerja';

		$this->load->view('Co-Main/VTemplate',$data);
	}
	
	public function Produksi_Update()
	{
		$status = $this->uri->segment(3);
		$id 	= $this->uri->segment(4);

		$produksi = $this->MSudi->GetDataWhere('tbl_produksi', 'id_produksi', $id)->row();

		$new_status = 1;
		$json_riwayat_produksi = json_decode($produksi->riwayat_produksi, true);
		

		switch ($status) 
		{
			case 1:
				$new_status = 2;
				$json_riwayat_produksi['tgl_mulai_produksi'] = date("Y-m-d");
				break;
			
			case 2:
				$datetime1 = date_create($json_riwayat_produksi['tgl_mulai_produksi']);
				$datetime2 = date_create(date("Y-m-d"));
				$interval = date_diff($datetime1, $datetime2);  /*  [= datetime2 - datetime1]  */

				$new_status = 3;
				$json_riwayat_produksi['tgl_selesai_produksi'] = date("Y-m-d");
				$json_riwayat_produksi['lama_produksi'] = $interval->days + 1;

				// get karyawan produksi
				$json_karyawan_produksi = json_decode($produksi->karyawan_produksi, true);

				// get data transaksi
				$id_transaksi 		= 'TRN'.substr($id, 3);
				$transaksi 			= $this->MSudi->SelectDataWhere('tbl_transaksi', 'data_biaya', 'id_transaksi', $id_transaksi)->row();
				$json_data_biaya	= json_decode($transaksi->data_biaya, true);

				// loop karyawan produki
				foreach ($json_karyawan_produksi as $read) 
				{
					// get user presensi
					$user_presensi	= $this->MSudi->SelectDataWhere('tbl_user_presensi', 'data_presensi_produksi', 'id_user', $read['id_user'])->row();
					$json_presensi	= json_decode($user_presensi->data_presensi_produksi, true);

					// loop presensi
					$i = 0;
					foreach ($json_presensi as $r)
					{
						// check id produksi
						if ($r['id_produksi'] == $id)
						{
							// set pendapatan =/ jumlah karyawan produksi
							$json_presensi[$i]['pendapatan'] = $json_data_biaya['biaya_borongan'] / count($json_karyawan_produksi);
							$i++;
						}
					}

					echo $read['id_user'];
					echo json_encode($json_presensi, true);
					
					$update_presensi['data_presensi_produksi'] = json_encode($json_presensi);
					$query = $this->MSudi->UpdateData('tbl_user_presensi', 'id_user', $read['id_user'], $update_presensi);
				}

				break;
		}
		

		$update['status_produksi'] = $new_status;
		$update['riwayat_produksi'] = json_encode($json_riwayat_produksi);

		$query = $this->MSudi->UpdateData('tbl_produksi', 'id_produksi', $id, $update);


		// --- GANTI AJAX MODE NANTI! ---
        // echo json_encode($json_riwayat_produksi);
		redirect(site_url('Welcome/Produksi'));
	}

	public function Produksi_UpdateData()
	{
		$id = $this->input->post('input_id_produksi');
		$idx = $this->input->post('input_idx');


		$produksi = $this->MSudi->GetDataWhere('tbl_produksi', 'id_produksi', $id)->row();
		$json_produksi = json_decode($produksi->data_produksi, true);


		$json_produksi['brand'] 			= $this->input->post('input_brand')[$idx];
		$json_produksi['jumlah_pesanan'] 	= $this->input->post('input_jumlah_pesanan')[$idx];
		$json_produksi['nama_tinta'] 		= $this->input->post('input_nama_tinta')[$idx];
		$json_produksi['nama_bahan'] 		= $this->input->post('input_nama_bahan')[$idx];
		$json_produksi['warna_bahan'] 		= $this->input->post('input_warna_bahan')[$idx];


		$i = 0;
		$detail_sablon = json_decode($json_produksi['detail_sablon'], true);

		// Loop image name
		foreach ($this->input->post('input_image_name') as $read)
		{
			// if value exist
			if ($read != "")
			{
				$j = 0;

				// Loop json detail sablon
				foreach ($detail_sablon as $ds)
				{
					// check if json value = input area
					if ($ds['posisi'] == $this->input->post('input_area_sablon')[$i])
						$detail_sablon[$j]['gambar'] = explode(",", $read);				// set gambar name

					$j++;
				}
			}

			$warna = $this->input->post('input_step_warna')[$i];

			if ($warna != "")
			{
				$j = 0;

				foreach ($detail_sablon as $ds) 
				{
					if ($ds['posisi'] == $this->input->post('input_area_warna')[$i])
						$detail_sablon[$j]['step_warna'] = explode(",", $warna);		// set step color

					$j++;
				}
			}

			$i++;
		}

		$json_produksi['detail_sablon'] 	= json_encode($detail_sablon, true);


		// upload images
		$image_design = 'input_image_design';
		$n_image_design = $this->UploadImageMulti('./images/', $image_design);

		$image_layer = 'input_image_layer';
		$n_image_layer = $this->UploadImageMulti('./images/', $image_layer);


		if (!empty($n_image_design))
			$json_produksi['design_sablon']	= $n_image_design[0];


		$update['data_produksi'] = json_encode($json_produksi, true);
		$query = $this->MSudi->UpdateData('tbl_produksi', 'id_produksi', $id, $update);

		// --- GANTI AJAX MODE NANTI! ---
        // echo json_encode($json_riwayat_produksi);
		redirect(site_url('Welcome/Produksi'));
	}

	public function Produksi_AddPekerja()
	{
		$DataProduksi 	= $this->MSudi->GetData('tbl_produksi');
		$DataUser 		= $this->MSudi->GetData('tbl_user');

		foreach ($DataProduksi as $r) 
		{
			if ($r->id_produksi == $this->input->post('input_id_produksi'))
			{
				$json_pekerja = json_decode($r->karyawan_produksi, true);
				break;
			}
		}

		foreach ($this->input->post('input_pekerja') as $Read)
		{
			$num = intval($Read);

			foreach ($DataUser as $r) 
			{
				if ($r->id_user == $num)
				{
					array_push($json_pekerja, array(
						'id_user'			=> $num,
						'nama_user'			=> $r->nama_user,
						'tgl_bergabung'		=> date("Y-m-d"),
						'akhir_presensi'	=> ''
					));

					// set user_presensi
					$DataUserPresensi = $this->MSudi->SelectDataWhere('tbl_user_presensi','data_presensi_produksi',
												  		      		  'id_user', $num)->row();

					$json_presensi_produksi = json_decode($DataUserPresensi->data_presensi_produksi, true);
					array_push($json_presensi_produksi, array(
						'id_produksi' 	=> $this->input->post('input_id_produksi'),
						'tanggal'		=> array(),
						'pendapatan'	=> ''
					));

					// update user presensi produksi
					$update_presensi['data_presensi_produksi'] = json_encode($json_presensi_produksi, true);
					$query = $this->MSudi->UpdateData('tbl_user_presensi', 'id_user', $num, $update_presensi);

					break;
				}
			}

		}

		$update['karyawan_produksi'] = json_encode($json_pekerja, true);

		$query = $this->MSudi->UpdateData('tbl_produksi', 'id_produksi', $this->input->post('input_id_produksi'), $update);

		// --- GANTI AJAX MODE NANTI! ---
        // echo json_encode($json_riwayat_produksi);
		redirect(site_url('Welcome/Produksi'));
	}

	public function Produksi_Presensi()
	{
		$id_produksi 	= $this->uri->segment(3);
		$id_user		= $this->IdUser;

		$presensi_produksi = $this->MSudi->SelectDataWhere('tbl_user_presensi','data_presensi_produksi',
												  		   'id_user', $id_user)->row();

		$json_produksi = json_decode($presensi_produksi->data_presensi_produksi, true);

		$i = 0;
		foreach ($json_produksi as $r)
		{
			if ($id_produksi == $r['id_produksi'])
			{
				// Check if already present on same date...
				$now = date('Y-m-d');

				array_push($json_produksi[$i]['tanggal'], date("Y-m-d"));	
				break;
			}

			$i++;
		}

		$update['data_presensi_produksi'] = json_encode($json_produksi, true);
		$query = $this->MSudi->UpdateData('tbl_user_presensi', 'id_user', $id_user, $update);


		// -------------------------------------------------------------------------------------


		$produksi = $this->MSudi->SelectDataWhere('tbl_produksi','karyawan_produksi',
												  'id_produksi', $id_produksi)->row();

		$json_pekerja = json_decode($produksi->karyawan_produksi, true);

		$i = 0;
		foreach ($json_pekerja as $r) 
		{
			if ($id_user == $r['id_user'])
				$json_pekerja[$i]['akhir_presensi'] = date('Y-m-d');

			$i++;
		}

		// print_r(json_encode($json_pekerja, true));

		$update_produksi['karyawan_produksi'] = json_encode($json_pekerja, true);
		$query = $this->MSudi->UpdateData('tbl_produksi', 'id_produksi', $id_produksi, $update_produksi);


		// --- GANTI AJAX MODE NANTI! ---
        // echo json_encode($json_riwayat_produksi);
		redirect(site_url('Welcome/Produksi'));
	}

	

	public function Pembukuan()
	{
		$this->load->helper('directory');
		$data['Map'] = directory_map('./Pembukuan/', FALSE, TRUE);

		$tahun = $this->uri->segment(3);
		$bulan = $this->uri->segment(4);

		if ($tahun != "")
		{
			// Get from JSON
			$file = directory_map('./Pembukuan/'.$tahun.'/'.$bulan, FALSE, TRUE);
			$Transaksi = file_get_contents("Pembukuan/".$tahun."/".$bulan."/".$file[0]);

			$data['DataTransaksi'] = json_decode($Transaksi);			
		}
		else
		{
			// Get from database
			$Transaksi = $this->MSudi->GetData('tbl_transaksi');

			if (!empty($Transaksi))
			{
				foreach ($Transaksi as $Read) 
				{
					// GET/SET nama pelanggan
					$nama_pelanggan = $this->MSudi->SelectDataWhere('tbl_pelanggan','nama_pelanggan','id_pelanggan', $Read->id_pelanggan)->row();
					$Read->nama_pelanggan = $nama_pelanggan->nama_pelanggan;
				}
			}

			$data['DataTransaksi'] = $Transaksi;
		}
		

		$data['content'] 				= 'Co-Primary/VTransaksi';
		$data['menu'] 					= 'Co-Main/VTemplate_Menu';

		$data['userAkses'] 	= $this->UA;
		$data['userNama'] 	= $this->Nama;
		$data['userPage']	= $this->Page;

		$data['Sub_Spinner'] 			= 'Co-Sub/VSpinner';
		$data['Sub_FAQ'] 				= 'Co-FAQ/VFAQ_Modal';
		$data['Mode_FAQ'] 				= 'Pembukuan';

		$data['Sub_File_Manager'] 		= 'Co-Sub/VTransaksi_File_Manager';
		$data['Sub_Chart_Penjualan'] 	= 'Co-Sub/VTransaksi_Chart_Penjualan';
		$data['Sub_Daftar_Tab'] 		= 'Co-Sub/VTransaksi_Daftar_Tab';
		$data['Sub_Detail_Tab'] 		= 'Co-Sub/VTransaksi_Detail_Tab';
		
		// User Data Extension
		$data['DataUser']				= $this->model_app->get('tbl_user')->result();
		$data['DataPresensi'] 			= $this->MSudi->GetData('tbl_user_presensi');
		$data['DataUserConfig'] 		= $this->MSudi->SelectDataWhere('tbl_user_config','user_gaji','user_akses', 'Pekerja')->row();
		$data['Sub_Daftar_User']    	= 'Co-Sub/VUser_Upah';

		// Biaya Data Extension
		$data['DataFormula'] 	= $this->MSudi->GetDataWhere('tbl_formula','id_formula','1')->row();
		$data['DataTinta'] 		= $this->MSudi->GetData('tbl_tinta');
		$data['DataBahan'] 		= $this->MSudi->GetDataWhere('tbl_bahan','id_bahan','1')->row();
		$data['Sub_Biaya_Tab'] 	= 'Co-Sub/VPemesanan_Biaya_Tab';
		$data['Mode_Biaya']		= 'Pembukuan';

		$this->load->view('Co-Main/VTemplate',$data);
	}

	public function Pembukuan_Insert()
	{
		$date = date('ym');

		$Transaksi = $this->MSudi->GetData('tbl_transaksi');
		$arr_transaksi = array();

		$arr_id_transaksi 	= array();
		$arr_id_produksi	= array();

		if (!empty($Transaksi))
		{
			$i = 0;

			// Loop Checkbox
			foreach ($this->input->post('check_pembukuan') as $Read)
			{
				// Loop Transaksi
				foreach ($Transaksi as $Reads)
				{
					// Check if id = Table's id
					if ($Read == $Reads->id_transaksi)
					{
						array_push($arr_id_transaksi, $Reads->id_transaksi);
						array_push($arr_id_produksi, $Reads->id_produksi);

						$Produksi 	= $this->MSudi->GetDataWhere('tbl_produksi','id_produksi',$Reads->id_produksi)->row();
						$Pelanggan 	= $this->MSudi->GetDataWhere('tbl_pelanggan','id_pelanggan',$Reads->id_pelanggan)->row();

						$json_data_biaya = json_decode($Reads->data_biaya);

						// Set Array
						$arr_data_transaksi = array(
							'id_transaksi' 			=> $Reads->id_transaksi,
							'id_pelanggan' 			=> $Reads->id_pelanggan,
							'nama_pelanggan'		=> $Pelanggan->nama_pelanggan,
							'data_transaksi' 		=> $Reads->data_transaksi,
							'data_biaya' 			=> $Reads->data_biaya,
							'total_biaya_produksi'	=> $json_data_biaya->total_biaya_produksi,
							'operasional_produksi'	=> $json_data_biaya->operasional_produksi,
							'biaya_borongan'		=> $json_data_biaya->biaya_borongan,
							'total_harga_final'		=> $json_data_biaya->total_harga_final,
							'sisa_dana_produksi'	=> $json_data_biaya->sisa_dana_produksi,
							'status_transaksi' 		=> $Reads->status_transaksi,
							'data_produksi' 		=> $Produksi->data_produksi,
							'riwayat_produksi' 		=> $Produksi->riwayat_produksi,
							'karyawan_produksi' 	=> $Produksi->karyawan_produksi,
						);

						array_push($arr_transaksi, $arr_data_transaksi);
					}
				}

				$i++;
			}
		}

		$year 	= 'Pembukuan/'.$this->input->post('input_parent_folder');
		$month	= $year.'/'.$this->input->post('input_child_folder');

		// check if parent folder (year) is exist
		if (!is_dir($year))											
			mkdir($year, 0777, TRUE); 

		// check if child folder (month) is exist
		if (!is_dir($month))
			mkdir($month, 0777, TRUE);

		$fp = fopen($month.'/Laporan_Transaksi.json', 'w');				// create file in child folder
    	fwrite($fp, json_encode($arr_transaksi, true));					// write content

    	$fu = fopen($month.'/Laporan_Upah_Pekerja.json', 'w');			// create file in child folder
    	fwrite($fu, $this->input->post('input_upah_pekerja'));			// write content

    	
    	$json_upah = json_decode($this->input->post('input_upah_pekerja'), true);

    	$update = array();

    	foreach ($json_upah as $r) {
    		array_push($update, array(
    			'id_user'					=> $r['id_user'],
    			'data_presensi'				=> "[]",
    			'data_presensi_produksi' 	=> "[]"
    		));
    	}

    	$query = $this->MSudi->UpdateDataBatch('tbl_user_presensi', $update, 'id_user');

    	// ------------------------------------------------------------------------------

		$query = $this->MSudi->DeleteDataBatch('tbl_transaksi', $arr_id_transaksi, 'id_transaksi');

		// ------------------------------------------------------------------------------

		$query = $this->MSudi->DeleteDataBatch('tbl_produksi', $arr_id_produksi, 'id_produksi');

    	// print_r($arr_id_transaksi);
    	// print_r($arr_id_produksi);
    	// echo "<br><br>";
    	// print_r($update);


        // RE-DIRECT to page
        redirect(site_url('Welcome/Pembukuan'));
	}



	public function User()
	{
		$data['DataUser'] 		= $this->MSudi->GetDataWhere('tbl_user','status','1')->result();
		$data['DataUserTrash'] 	= $this->MSudi->GetDataWhere('tbl_user','status','0')->result();
		$data['DataUserConfig'] = $this->MSudi->GetData('tbl_user_config');
		$data['DataUserGaji'] 	= $this->MSudi->GetDataWhere('tbl_user_config','user_akses','Pekerja')->row();

		$data['content'] 		= 'Co-Primary/VUser';
		$data['menu'] 			= 'Co-Main/VTemplate_Menu';

		$data['userAkses'] 		= $this->UA;
		$data['userNama'] 		= $this->Nama;
		$data['userPage']		= $this->Page;

		$data['Sub_Spinner'] 	= 'Co-Sub/VSpinner';
		$data['Sub_FAQ'] 		= 'Co-FAQ/VFAQ_Modal';
		$data['Mode_FAQ'] 		= 'User';

		$data['Sub_Daftar_User']    = 'Co-Sub/VUser_Daftar';
		$data['Sub_Trash_User']  	= 'Co-Sub/VUser_Trash';
		$data['Sub_Akses_User']  	= 'Co-Sub/VUser_Akses';
		$data['Sub_Gaji_User']  	= 'Co-Sub/VUser_Gaji';

		$data['Sub_Modal_Add'] 		= 'Co-Sub/VUser_Add';
		$data['Sub_Modal_IdAdd']	= 'Modal-Add';

		$data['Sub_Modal_Update'] 	= 'Co-Sub/VUser_Update';
		$data['Sub_Modal_IdUpdate']	= 'Modal-Update';

		$this->load->view('Co-Main/VTemplate',$data);
	}

	public function User_Insert()
	{
		// set each data
		$add['id_user'] 	= '';
        $add['nama_user'] 	= $this->input->post('input_nama_user');
        $add['telp_user'] 	= $this->input->post('input_telp_user');
        $add['username'] 	= $this->input->post('input_userpass');
        $add['password'] 	= $this->input->post('input_userpass');
        $add['akses_user'] 	= $this->input->post('input_akses_user');
        $add['status'] 		= 1;
		
		// ADD new data to database
        $this->MSudi->AddData('tbl_user', $add);

		$user = $this->MSudi->GetDataWhere('tbl_user','nama_user',$this->input->post('input_nama_user'))->row();

		$add_presensi['id_user'] = $user->id_user; 
		$add_presensi['data_presensi'] = "[]";
		$add_presensi['data_presensi_produksi'] = "[]"; 

		// ADD new data to database
        $this->MSudi->AddData('tbl_user_presensi', $add_presensi);

		// RE-DIRECT to page
        redirect(site_url('Welcome/User'));
	}

	public function User_Update()
	{
		$id_user = $this->input->post('input_id_user');

		$update['nama_user'] = $this->input->post('input_nama_user');
		$update['telp_user'] = $this->input->post('input_telp_user');

		$query = $this->MSudi->UpdateData('tbl_user', 'id_user', $id_user, $update);

		redirect(site_url('Welcome/User'));
	}

	public function User_Delete()
	{
		$id_user = $this->uri->segment(3);

		$update['status'] = 0;
		$query = $this->MSudi->UpdateData('tbl_user', 'id_user', $id_user, $update);

		redirect(site_url('Welcome/User'));
	}

	public function User_Restore()
	{
		$id_user = $this->uri->segment(3);

		$update['status'] = 1;
		$query = $this->MSudi->UpdateData('tbl_user', 'id_user', $id_user, $update);

		redirect(site_url('Welcome/User'));
	}


	
	public function Logout()
	{
		// Get & Reset session
		$this->load->library('session');
		$this->session->unset_userdata('Login');
		
		// RE-DIRECT to 'Login'
		redirect(site_url('Login'));
	}

}
