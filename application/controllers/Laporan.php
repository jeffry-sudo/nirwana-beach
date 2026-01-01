<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	function __construct(){
	parent::__construct();

	if (!$this->session->userdata('logged_in')) {
		redirect('login');
	  }

		$this->load->helper('tglindo_helper');
		$this->getsecurity();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Transaksi_model');
		$this->load->model('Laporan_model');
		$this->load->model('Laporan_model_parkir');
	}
	function getsecurity($value=''){
		$username = $this->session->userdata('username_admin');
		if (empty($username)) {
			$this->session->sess_destroy();
			redirect('login');
		}
	}
	public function index(){
		$user_level = $this->session->userdata('level');
    
		if ($user_level != '1') {
		  show_error('You do not have permission to access this page.', 403); // Error 403 jika level tidak sesuai
		}

		$data['title'] = 'Laporan';
		$data['bulan'] = $this->db->query("SELECT DISTINCT DATE_FORMAT(tgl_jam_keluar,'%M %Y') AS bulan FROM tbl_keluar")->result_array();
		$this->load->view('laporan', $data);
	}
	public function laportanggal($value=''){
		$user_level = $this->session->userdata('level');
    
		if ($user_level != '1') {
		  show_error('You do not have permission to access this page.', 403); // Error 403 jika level tidak sesuai
		}
		$data['mulai'] = $this->input->post('mulai');
		$data['sampai'] = $this->input->post('sampai');
		$data['laporan'] = $this->db->query("SELECT * FROM tbl_keluar RIGHT JOIN tbl_masuk ON tbl_keluar.kd_masuk = tbl_masuk.kd_masuk left join tbl_kendaraan on tbl_kendaraan.kd_kendaraan=tbl_masuk.kd_kendaraan WHERE (tgl_jam_keluar BETWEEN '".$data['mulai']."' AND '".$data['sampai']."')")->result_array();
		$total = isset($total) ? $total : []; // Jika $total belum ada, inisialisasi sebagai array kosong
		$total_sum = array_sum($total); // Menghitung total hanya jika $total adalah array

		for ($i=0; $i < count($data['laporan']) ; $i++) { 
			$total[$i] = $data['laporan'][$i]['total_keluar'];
		}
		$data['total'] = array_sum($total);
		// die(print_r($data));
		$this->load->view('laporan/laporan_pertanggal', $data);		
	}
	// public function laporbulan($value=''){
	// 	$data['bulan'] = $this->input->post('bln');
	// 	$data['laporan'] = $this->db->query("SELECT create_tgl_tiket,DATE_FORMAT(create_tgl_tiket,'%M %Y') AS bulan,DATE_FORMAT(create_tgl_tiket,'%d %M %Y') FROM tbl_tiket  WHERE DATE_FORMAT(jual_tanggal,'%M %Y')='".$data['bulan']."' ORDER BY kd_tiket DESC");
	// 	// die(print_r($data));
	// 	for ($i=0; $i < count($data['laporan']) ; $i++) { 
	// 		$total[$i] = $data['laporan'][$i]['harga_tiket'];
	// 	}
	// 	$data['total'] = array_sum($total);
	// 	$this->load->view('laporan/laporan_pertanggal', $data);
	// }

	public function bendahara(){
		$user_level = $this->session->userdata('level');
		if ($user_level != '1' && $user_level != '4') {
			show_error('You do not have permission to access this page.', 403);
		}

		$data['title'] = 'Bendahara';
		$data['transaksi'] = $this->Transaksi_model->get_all_transaksi();
        $data['total_pendapatan'] = $this->Transaksi_model->get_total_by_type('pendapatan');
        $data['total_pengeluaran'] = $this->Transaksi_model->get_total_by_type('pengeluaran');
		$this->load->view('bendahara', $data);
	}

	public function tambah() {
		$user_level = $this->session->userdata('level');
		if ($user_level != '1' && $user_level != '4') {
			show_error('You do not have permission to access this page.', 403);
		}
        // Validasi input
        $this->form_validation->set_rules('jenis_trx', 'Jenis Transaksi', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('nominal', 'Nominal', 'required|numeric');
        $this->form_validation->set_rules('tgl_trx', 'Tanggal Transaksi', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
        } else {
            // Data untuk disimpan
            $data = [
                'jenis_trx' => $this->input->post('jenis_trx'),
                'keterangan' => $this->input->post('keterangan'),
                'nominal' => $this->input->post('nominal'),
                'tgl_trx' => $this->input->post('tgl_trx')
            ];

            // Simpan data ke database
            $this->Transaksi_model->insertTransaksi($data);

			$this->session->set_flashdata('alert', '$(function() {
				$.bootstrapGrowl("Data berhasil disimpan",{
						type: "success",
						align: "right",
						width: "auto",
						allow_dismiss: false
				});
				});');
			redirect('laporan/bendahara');

            // echo json_encode(['status' => 'success', 'message' => 'Data berhasil ditambahkan.']);
        }
    }

	public function delete($id=''){
		
		$sqlcek = $this->db->query("SELECT * FROM tbl_transaksi WHERE id_trx = '".$id."'")->row_array();
		if ($sqlcek) {
			$this->db->where('id_trx', $id); 
			$this->db->delete('tbl_transaksi'); 
			$this->session->set_flashdata('alert', '$(function() {
                $.bootstrapGrowl("Data Berhasil Dihapus",{
                		type: "danger",
                        align: "right",
                        width: "auto",
                        allow_dismiss: false
                });
            	});');
			redirect('laporan/bendahara');
		}else{
			$this->session->set_flashdata('alert', '$(function() {
                $.bootstrapGrowl("Data Tidak Ada",{
                		type: "danger",
                        align: "right",
                        width: "auto",
                        allow_dismiss: false
                });
            	});');
			redirect('laporan/bendahara');
		}
	}

	public function filter() {
		$dari_tanggal = $this->input->post('dari_tanggal');
		$sampai_tanggal = $this->input->post('sampai_tanggal');
	
		$this->db->select('*');
		$this->db->from('tbl_transaksi');
	
		if (!empty($dari_tanggal) && !empty($sampai_tanggal)) {
			$this->db->where('tgl_trx >=', $dari_tanggal);
			$this->db->where('tgl_trx <=', $sampai_tanggal);
		}
	
		$query = $this->db->get();
		$transaksi = $query->result_array();
	
		// Hitung total pendapatan dan pengeluaran
		$total_pendapatan = 0;
		$total_pengeluaran = 0;
	
		foreach ($transaksi as $trx) {
			if ($trx['jenis_trx'] === 'pendapatan') {
				$total_pendapatan += $trx['nominal'];
			} else {
				$total_pengeluaran += $trx['nominal'];
			}
		}
	
		$total_saldo = $total_pendapatan - $total_pengeluaran;
	
		// Generate HTML untuk transaksi
		$html = '';
		foreach ($transaksi as $trx) {
			$class = ($trx['jenis_trx'] === 'pendapatan') ? 'list-group-item-success' : 'list-group-item-danger';
			$nominal = ($trx['jenis_trx'] === 'pengeluaran' ? '-' : '') . 'Rp' . number_format($trx['nominal'], 0, ',', '.');

			// BUTTON HANYA UNTUK LEVEL 1
			$btnDelete = '';
			if (isset($_SESSION['level']) && (int)$_SESSION['level'] === 1) {
				$btnDelete = '
					<form action="' . base_url('laporan/delete/' . $trx['id_trx']) . '" method="post" onsubmit="return confirm(\'Apakah Anda yakin ingin menghapus transaksi ini?\');">
						<button type="submit" class="btn btn-sm btn-danger border-0">
							<i class="fa fa-trash"></i>
						</button>
					</form>
				';
			}

			$html .= '
				<div class="list-group-item ' . $class . '">
					<div class="d-flex justify-content-between align-items-center">
						<div>
							<small class="text-muted">Tanggal: ' . date('d/m/Y', strtotime($trx['tgl_trx'])) . '</small>
							<br>
							<strong>' . $trx['keterangan'] . '</strong>
						</div>
						<div class="d-flex align-items-center">
							<span class="me-3 fw-bold">' . $nominal . '</span>
							' . $btnDelete . '
						</div>
					</div>
				</div>';
		}

	
		// Kirim data dalam format JSON
		echo json_encode([
			"transaksi_html" => $html,
			"total_saldo" => $total_saldo,
			"total_pendapatan" => $total_pendapatan,
			"total_pengeluaran" => $total_pengeluaran
		]);
	}
	
	public function parkir_masuk(){
		$user_level = $this->session->userdata('level');
		if ($user_level != '1' && $user_level != '2' && $user_level != '4') {
			show_error('You do not have permission to access this page.', 403);
		}
		$data['title'] = 'Laporan Parkir Masuk';
		$data['total_penjualan'] = $this->Laporan_model->get_total_penjualan();
        // $data['total_keuntungan'] = $this->Laporan_model->get_total_keuntungan();
        $data['jumlah_mobil'] = $this->Laporan_model->get_jumlah_mobil();
        $data['jumlah_motor'] = $this->Laporan_model->get_jumlah_motor();
        $data['jumlah_orang'] = $this->Laporan_model->get_jumlah_orang();
		$data['masuk'] = $this->db->query("SELECT * FROM tbl_masuk LEFT JOIN tbl_kendaraan ON tbl_masuk.kd_kendaraan = tbl_kendaraan.kd_kendaraan WHERE DATE_FORMAT(tgl_masuk, '%Y-%m-%d')=CURDATE() ")->result_array();
		$data['masuk_detail'] = $this->db->query("SELECT a.create_masuk, SUM( CASE WHEN a.kd_kendaraan = 'JK003' THEN 0 ELSE b.harga_kendaraan END + (a.jml_org * 2000) ) AS total_penjualan FROM `tbl_masuk` `a` LEFT JOIN `tbl_kendaraan` `b` ON `a`.`kd_kendaraan` = `b`.`kd_kendaraan` WHERE DATE_FORMAT(a.tgl_masuk, '%Y-%m-%d') = CURDATE() group by 1")->result_array();

        $this->load->view('laporan/laporan_parkir_masuk', $data);
	}

	  
		public function filter_data() {
		  // Get the input values
		  $dari_tanggal = $this->input->post('dari_tanggal');
		  $sampai_tanggal = $this->input->post('sampai_tanggal');
	  
		  // Load the model
		  $this->load->model('Laporan_model');
	  
		  // Get the filtered data from the model
		  $data = $this->Laporan_model->get_filtered_data($dari_tanggal, $sampai_tanggal);
	  
		  // Prepare the response
		  $response = [
			'total_penjualan' => $data['total_penjualan'],
			'total_keuntungan' => number_format($data['total_keuntungan']),
			'jumlah_mobil' => $data['jumlah_mobil'],
			'jumlah_motor' => $data['jumlah_motor'],
			'jumlah_orang' => $data['jumlah_orang'],
			'masuk' => $data['masuk'],
			'masuk_detail' => $data['masuk_detail']
		  ];
	  
		  // Send the response back to the view
		  echo json_encode($response);
		}
	  
	  
		public function dashboard_petugas_parkir(){
			$data['title'] = 'Laporan Petugas Parkir';
			$data['total_penjualan'] = $this->Laporan_model_parkir->get_total_penjualan();
			// $data['total_keuntungan'] = $this->Laporan_model->get_total_keuntungan();
			$data['jumlah_mobil'] = $this->Laporan_model_parkir->get_jumlah_mobil();
			$data['jumlah_motor'] = $this->Laporan_model_parkir->get_jumlah_motor();
			$data['jumlah_orang'] = $this->Laporan_model_parkir->get_jumlah_orang();
			if($this->session->userdata('level')==1){
				$data['masuk'] = $this->db->query("SELECT * FROM tbl_masuk LEFT JOIN tbl_kendaraan ON tbl_masuk.kd_kendaraan = tbl_kendaraan.kd_kendaraan WHERE DATE_FORMAT(tgl_masuk, '%Y-%m-%d')=CURDATE() and tbl_masuk.kd_kendaraan in ('JK001','JK002') and kd_admin is not null")->result_array();
				$data['masuk_detail'] = $this->db->query('SELECT c.nama_admin, SUM( CASE WHEN a.kd_kendaraan = "JK002" THEN 1000 WHEN a.kd_kendaraan = "JK001" THEN 1000 ELSE 0 END ) AS total_penjualan 
					FROM `tbl_masuk` `a` 
					LEFT JOIN `tbl_kendaraan` `b` ON `a`.`kd_kendaraan` = `b`.`kd_kendaraan` 
					LEFT JOIN tbl_admin c on a.kd_admin=c.kd_admin
					WHERE DATE_FORMAT(a.tgl_masuk, "%Y-%m-%d") = CURDATE() 
					AND a.kd_admin is not null
					group by 1')->result_array();
			}else{
				$data['masuk_detail'] = $this->db->query('SELECT c.nama_admin, SUM( CASE WHEN a.kd_kendaraan = "JK002" THEN 1000 WHEN a.kd_kendaraan = "JK001" THEN 1000 ELSE 0 END ) AS total_penjualan 
					FROM `tbl_masuk` `a` 
					LEFT JOIN `tbl_kendaraan` `b` ON `a`.`kd_kendaraan` = `b`.`kd_kendaraan` 
					LEFT JOIN tbl_admin c on a.kd_admin=c.kd_admin
					WHERE DATE_FORMAT(a.tgl_masuk, "%Y-%m-%d") = CURDATE() 
					AND a.kd_admin="'.$this->session->userdata('kd_admin').'"
					group by 1')->result_array();
				$data['masuk'] = $this->db->query("SELECT * FROM tbl_masuk LEFT JOIN tbl_kendaraan ON tbl_masuk.kd_kendaraan = tbl_kendaraan.kd_kendaraan WHERE DATE_FORMAT(tgl_masuk, '%Y-%m-%d')=CURDATE() and tbl_masuk.kd_kendaraan in ('JK001','JK002') and kd_admin='".$this->session->userdata('kd_admin')."'")->result_array();
			}
	
			$this->load->view('laporan/laporan_petugas_parkir', $data);
		}

		public function filter_data_parkir() {
			// Get the input values
			$dari_tanggal = $this->input->post('dari_tanggal');
			$sampai_tanggal = $this->input->post('sampai_tanggal');
		
			// Load the model
			$this->load->model('Laporan_model_parkir');
		
			// Get the filtered data from the model
			$data = $this->Laporan_model_parkir->get_filtered_data($dari_tanggal, $sampai_tanggal);
		
			// Prepare the response
			$response = [
			  'total_penjualan' => $data['total_penjualan'],
			  'total_keuntungan' => number_format($data['total_keuntungan']),
			  'jumlah_mobil' => $data['jumlah_mobil'],
			  'jumlah_motor' => $data['jumlah_motor'],
			  'jumlah_orang' => $data['jumlah_orang'],
			  'masuk' => $data['masuk'],
			  'masuk_detail' => $data['masuk_detail']
			];
		
			// Send the response back to the view
			echo json_encode($response);
		  }

		//   function get_kod(){
        //     $q = $this->db->query("SELECT MAX(RIGHT(kd_keluar,3)) AS kd_max FROM tbl_keluar");
        //     $kd = "";
        //     if($q->num_rows()>0){
        //         foreach($q->result() as $k){
        //             $tmp = ((int)$k->kd_max)+1;
        //             $kd = sprintf("%08s", $tmp);
        //         }
        //     }else{
        //         $kd = "001";
        //     }
        //     return "K".$kd;
        // }

			function get_kod(){
            $q = $this->db->query("SELECT MAX(RIGHT(kd_masuk,8)) AS kd_max FROM tbl_masuk");
            $kd = "";
            if($q->num_rows()>0){
                foreach($q->result() as $k){
                    $tmp = ((int)$k->kd_max)+1;
                    $kd = sprintf("%08s", $tmp);
                }
            }else{
                $kd = "001";
            }
            return "K".$kd;
        }

		  public function update_status_masuk()
{
    $kd_masuk = $this->input->post('kd_masuk');
    $kd_admin = $this->session->userdata('kd_admin');

    if (!$kd_masuk || !$kd_admin) {
        echo json_encode(["status" => "error", "message" => "Data tidak valid"]);
        return;
    }

    // Ambil data karcis saat masuk
    $sqlcek = $this->db->query("
        SELECT * FROM tbl_masuk 
        JOIN tbl_kendaraan ON tbl_masuk.kd_kendaraan = tbl_kendaraan.kd_kendaraan
        WHERE kd_masuk = '$kd_masuk'
    ")->row_array();

    if (!$sqlcek) {
        echo json_encode(["status" => "error", "message" => "Kode tidak ditemukan"]);
        return;
    }

    // Cek apakah sudah pernah diklaim
    if ($sqlcek['kd_admin'] !== null) {
        echo json_encode(["status" => "error", "message" => "Karcis sudah diklaim"]);
        return;
    }

    // Hitung durasi
    $awal  = strtotime($sqlcek['tgl_masuk']);
    $akhir = strtotime(date('Y-m-d H:i:s'));
    $diff  = $akhir - $awal;

    $jam   = floor($diff / 3600);
    $menit = floor(($diff % 3600) / 60);

    $lama_parkir = "$jam Jam, $menit Menit";

    // Hitung total
    $total = $sqlcek['harga_kendaraan'] * $sqlcek['jml_org'];

    // Update status masuk + tambahkan admin yg memproses
    $this->db->where('kd_masuk', $kd_masuk);
    $this->db->update('tbl_masuk', [
        'kd_admin' => $kd_admin,
        'status_masuk' => 2
    ]);

    // Insert ke tabel keluar
    $data_keluar = [
        'kd_keluar' => $this->get_kod(),
        'kd_masuk' => $kd_masuk,
        'kd_member' => null,
        'tgl_jam_masuk' => $sqlcek['tgl_masuk'],
        'tgl_jam_keluar' => date("Y-m-d H:i:s", $akhir),
        'lama_parkir_keluar' => $lama_parkir,
        'tarif_keluar' => $sqlcek['harga_kendaraan'],
        'total_keluar' => $total,
        'status_keluar' => 1,
        'create_keluar' => $this->session->userdata('nama_admin')
    ];

    $this->db->insert('tbl_keluar', $data_keluar);

    if ($this->db->affected_rows() > 0) {
        echo json_encode(["status" => "success", "message" => "Karcis berhasil diklaim"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Terjadi kesalahan, coba lagi"]);
    }
}


		
	
}

/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */