<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masuk extends CI_Controller {
	function __construct(){
	parent::__construct();

	if (!$this->session->userdata('logged_in')) {
		redirect('login');
	  }

	  $user_level = $this->session->userdata('level');
		if ($user_level != '1' && $user_level != '2') {
			show_error('You do not have permission to access this page.', 403);
		}

		$this->load->helper('tglindo_helper');
		$this->getsecurity();
		date_default_timezone_set("Asia/Jakarta");
	}
	public function index(){
		$data['title'] = 'Parkir Masuk';
		$data['jenis'] = $this->db->query("SELECT * FROM tbl_kendaraan WHERE jenis_kendaraan = '1'")->result_array();
		$data['masuk'] = $this->db->query("SELECT * FROM tbl_masuk RIGHT JOIN tbl_kendaraan ON tbl_masuk.kd_kendaraan = tbl_kendaraan.kd_kendaraan WHERE tgl_masuk LIKE '".date('Y-m-d')."%' AND status_masuk = '1' order by tgl_masuk DESC, status_karcis asc ")->result_array();
		// die(print_r($data));
		$this->load->view('parkirmasuk', $data, FALSE);
	}
	function getsecurity($value=''){
		$username = $this->session->userdata('username_admin');
		if (empty($username)) {
			$this->session->sess_destroy();
			redirect('login');
		}
	}
	
	// function get_kod(){
	// 		$q = $this->db->query("SELECT MAX(RIGHT(kd_masuk,3)) AS kd_max FROM tbl_masuk");
	// 		$kd = "";
	// 		if($q->num_rows() > 0){
	// 		foreach($q->result() as $k){
	// 			$tmp = ((int)$k->kd_max) + 1;
	// 			$kd = sprintf("%03s", $tmp); // Menggunakan 3 digit angka
	// 		}
	// 	} else {
	// 		$kd = "001";
	// 	}
	
	// 	// Tambahkan komponen unik
	// 	$tanggal = date('ymd'); // Format YYMMDD
	// 	$random = substr(md5(uniqid(mt_rand(), true)), 0, 3); // String acak 4 karakter
	
	// 	return "M" . $tanggal . $random . $kd;
	// }
	
	function get_kod(){
		$prefix = 'MH';
		$max_attempts = 5;
		$attempt = 0;

		while ($attempt < $max_attempts) {
			try {
				// Start transaction to prevent race conditions
				$this->db->trans_start();

				// Lock the table for reading to get the max value
				$this->db->query("LOCK TABLES tbl_masuk WRITE");

				$q = $this->db->query("
					SELECT MAX(CAST(RIGHT(kd_masuk,8) AS UNSIGNED)) AS kd_max 
					FROM tbl_masuk 
					WHERE kd_masuk LIKE '".$prefix."%'
				");

				if ($q->num_rows() > 0 && $q->row()->kd_max != null) {
					$tmp = ((int)$q->row()->kd_max) + 1;
					$kd  = sprintf("%08d", $tmp);
				} else {
					$kd = "00000001";
				}

				$result = $prefix.$kd;

				// Unlock the table
				$this->db->query("UNLOCK TABLES");

				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					$attempt++;
					if ($attempt >= $max_attempts) {
						log_message('error', 'get_kod() failed after '.$max_attempts.' attempts');
						throw new Exception('Failed to generate unique ID');
					}
					usleep(100000); // Wait 100ms before retry
					continue;
				}

				return $result;

			} catch (Exception $e) {
				$this->db->query("UNLOCK TABLES");
				$this->db->trans_rollback();
				$attempt++;
				
				if ($attempt >= $max_attempts) {
					log_message('error', 'get_kod() exception: '.$e->getMessage());
					throw $e;
				}
				usleep(100000); // Wait 100ms before retry
			}
		}

		throw new Exception('Unable to generate unique ID after '.$max_attempts.' attempts');
	}

// function get_kod()
// {
//     $ym = date('ym'); // 2501
//     $random = $this->randomString(4);

//     $this->db->select('CAST(RIGHT(kd_masuk,3) AS UNSIGNED) AS seq', false);
//     $this->db->where('SUBSTRING(kd_masuk, 6, 4) =', $ym);
//     $this->db->order_by('seq', 'DESC');
//     $this->db->limit(1);
//     $q = $this->db->get('tbl_masuk');

//     if ($q->num_rows() > 0) {
//         $next = $q->row()->seq + 1;
//     } else {
//         $next = 1;
//     }

//     $seq = str_pad($next, 3, '0', STR_PAD_LEFT);

//     return $random . '_' . $ym . '_' . $seq;
// }



private function randomString($length)
{
    $chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $result = '';

    for ($i = 0; $i < $length; $i++) {
        $result .= $chars[random_int(0, strlen($chars) - 1)];
    }

    return $result;
}


private function isCombinationFull($length)
{
    // 26 huruf + 10 angka = 36 kombinasi
    $totalPossible = pow(36, $length);

    $totalUsed = $this->db->count_all('tbl_masuk');

    return $totalUsed >= $totalPossible;
}
	
	public function kendaraanmasuk(){
		// die(print_r($_POST));
		$jenis = $this->input->post('jenis');
		$plat = strtoupper($this->input->post('plat'));
		$nomor = strtoupper($this->input->post('nomor'));
		$back = strtoupper($this->input->post('back'));
		$member = $this->input->post('member');
		$jml_org = $this->input->post('jml_org');
		if ($member == NULL) {
			if ($jenis) {
			// 	if($jenis=="JK003")
			// 	{
			// 		$sqlcek_masuk==NULL;
			// 	}else{
			// 		$sqlcek_masuk = $this->db->query("SELECT * FROM tbl_masuk WHERE plat_masuk = '".$plat." ".$nomor." ".$back."' AND status_masuk = '1' ")->row_array();
			// 	}
			// if ($sqlcek_masuk == NULL) {
				$data = array(
			'kd_masuk' => $this->get_kod(),
			'kd_member' => 'NULL',
			'kd_kendaraan' => $this->input->post('jenis'),
			'plat_masuk' 	=> $plat." ".$nomor." ".$back,
			'tgl_masuk'		=> date('Y-m-d H:i:s'),
			'status_masuk' => 1,	
			'jml_org' => $jml_org,	
			'create_masuk' => $this->session->userdata('nama_admin')
			 );
			$this->db->insert('tbl_masuk', $data);
			$data['cetak'] = $data;
			$this->load->view('cetakparkir', $data);
			$this->session->set_flashdata('alert', [
				'msg'  => 'Karcis Sudah Dibuat',
				'type' => 'success'
			]);
			redirect('masuk');
			// }else{
			// 	$this->session->set_flashdata('alert', '$(function() {
			//                 $.bootstrapGrowl("Kode Plat Sudah Masuk",{
			//                 		type: "error",
			//                         align: "right",
			//                         width: "auto",
			//                         allow_dismiss: false
			//                 });
			//             	});');
			// 	redirect('masuk');	
			// }
			}else{
				$this->session->set_flashdata('alert', [
				'msg'  => 'Pilih Jenis Kendaraan',
				'type' => 'error'
				]);
				redirect('masuk');	
			}
		}else{
			$sqlcek = $this->db->query("SELECT * FROM tbl_member WHERE kd_member = '".$member."'")->row_array();
			if ($sqlcek) {
				$sqlcek_masuk = $this->db->query("SELECT * FROM tbl_masuk WHERE plat_masuk = '".$sqlcek['plat_member']."' AND status_masuk = '1' ")->row_array();
				if ($sqlcek_masuk == NULL) {
					$data = array(
					'kd_masuk' => $this->get_kod(),
					'kd_member' => $sqlcek['kd_member'],
					'kd_kendaraan' => $sqlcek['kd_kendaraan'],
					'plat_masuk' 	=> $sqlcek['plat_member'],
					'tgl_masuk'		=> date('Y-m-d H:i:s'),
					'jml_org' => $jml_org,	
					'status_masuk' => 1,	
					'create_masuk' => $this->session->userdata('nama_admin')
					 );
					// die(print_r($data));
					$this->db->insert('tbl_masuk', $data);
					$data['cetak'] = $data;
					// $this->load->view('cetakparkir', $data);
					$this->session->set_flashdata('alert', '$(function() {
			                $.bootstrapGrowl("Karcis Sudah Dibuat",{
			                		type: "success",
			                        align: "right",
			                        width: "auto",
			                        allow_dismiss: false
			                });
			            	});');
					redirect('masuk');
				}else{
					$this->session->set_flashdata('alert', '$(function() {
	                $.bootstrapGrowl("Member Sudah Masuk",{
	                		type: "error",
	                        align: "right",
	                        width: "auto",
	                        allow_dismiss: false
	                });
	            	});');
					redirect('masuk');
				}
			}else{
				$this->session->set_flashdata('alert', '$(function() {
	                $.bootstrapGrowl("Member Tidak Ada",{
	                		type: "error",
	                        align: "right",
	                        width: "auto",
	                        allow_dismiss: false
	                });
	            	});');
			redirect('masuk');
			}
		}
	}
	public function delete($id=''){
		$sqlcek = $this->db->query("SELECT * FROM tbl_masuk WHERE kd_masuk = '".$id."'")->row_array();
		if ($sqlcek) {
			$this->db->where('kd_masuk', $id); 
			$this->db->delete('tbl_masuk'); 
			$this->session->set_flashdata('alert', '$(function() {
                $.bootstrapGrowl("Kode Karcis Dihapus",{
                		type: "danger",
                        align: "right",
                        width: "auto",
                        allow_dismiss: false
                });
            	});');
			redirect('masuk');
		}else{
			$this->session->set_flashdata('alert', '$(function() {
                $.bootstrapGrowl("Kode Karcis Tidak Ada",{
                		type: "danger",
                        align: "right",
                        width: "auto",
                        allow_dismiss: false
                });
            	});');
			redirect('masuk');
		}
	}
	public function cetakstruk($id = '') {
		// Cek apakah kd_masuk valid
		$sqlcek = $this->db->query("
			SELECT * FROM tbl_masuk a 
			LEFT JOIN tbl_kendaraan b ON a.kd_kendaraan = b.kd_kendaraan 
			WHERE kd_masuk = '".$id."'
		")->row_array();
	
		if ($sqlcek) {
			// Jika status_karcis masih NULL, ubah menjadi 1
			if ($sqlcek['status_karcis'] === null) {
				$this->db->where('kd_masuk', $id);
				$this->db->update('tbl_masuk', ['status_karcis' => 1]);
			}
	
			// Load view cetak
			$data['cetak'] = $sqlcek;
			$this->load->view('cetakparkir', $data);
	
			// Set notifikasi sukses
			$this->session->set_flashdata('alert', '$(function() {
				$.bootstrapGrowl("Cetak Struk Selesai",{
					type: "success",
					align: "right",
					width: "auto",
					allow_dismiss: false
				});
			});');
	
		} else {
			// Jika kd_masuk tidak ditemukan, tampilkan notifikasi error
			$this->session->set_flashdata('alert', '$(function() {
				$.bootstrapGrowl("Kode Karcis Tidak Ada",{
					type: "danger",
					align: "right",
					width: "auto",
					allow_dismiss: false
				});
			});');
			redirect('masuk');
		}
	}

	public function cek_status_karcis() {
		$kd_masuk = $this->input->post('kd_masuk');
		$query = $this->db->get_where('tbl_masuk', ['kd_masuk' => $kd_masuk])->row_array();
	
		echo json_encode(['status_karcis' => $query['status_karcis']]);
	}

	
	public function listkendaraanmasuk($value=''){
		$data['title'] = 'List Kendaraan Yang Belum Keluar';
		$data['masuk'] = $this->db->query("SELECT * FROM tbl_masuk RIGHT JOIN tbl_kendaraan ON tbl_masuk.kd_kendaraan = tbl_kendaraan.kd_kendaraan WHERE status_masuk = '1'")->result_array();
		// die(print_r($data));
		$this->load->view('listkendaraan', $data, FALSE);
	}
	public function getmember($id=''){
		// tangkap variabel keyword dari URL
		$keyword = $this->uri->segment(3);

		// cari di database
		$data = $this->db->from('tbl_member')->like('kd_member',$keyword)->get();	

		// format keluaran di dalam array
		foreach($data->result() as $row)
		{
			$arr['query'] = $keyword;
			$arr['suggestions'][] = array(
				'plat_member'	=>$row->plat_member,
				'nama_member'	=>$row->nama_member,
				'kd_member'	=>$row->kd_member

			);
		}
		// minimal PHP 5.2
		echo json_encode($arr);
	}

		
}

/* End of file Masuk.php */
/* Location: ./application/controllers/Masuk.php */