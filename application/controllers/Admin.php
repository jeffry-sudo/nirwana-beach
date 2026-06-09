<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct(){
	parent::__construct();

	if (!$this->session->userdata('logged_in')) {
		redirect('login');
	  }

	  $user_level = $this->session->userdata('level');
	  if ($user_level != '1') {
		show_error('You do not have permission to access this page.', 403); 
	  }

		$this->getsecurity();
		$this->load->library('form_validation');
		$this->load->model('Attendance_model');
		date_default_timezone_set("Asia/Makassar");
	}
	function get_kod(){
            $q = $this->db->query("SELECT MAX(RIGHT(kd_admin,3)) AS kd_max FROM tbl_admin");
            $kd = "";
            if($q->num_rows()>0){
                foreach($q->result() as $k){
                    $tmp = ((int)$k->kd_max)+1;
                    $kd = sprintf("%03s", $tmp);
                }
            }else{
                $kd = "001";
            }
            return "A".$kd;
        }
	function getsecurity($value=''){
		$username = $this->session->userdata('level');
		if ($username == '2') {
			// $this->session->sess_destroy();
			redirect('home');
		}
	}
	public function index(){
		$data['title'] = "List Admin";
		$data['admin'] = $this->db->query("SELECT * FROM tbl_admin")->result_array();
		// die(print_r($data));
		$this->load->view('admin', $data);
	}
	public function daftar(){
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|is_unique[tbl_admin.username_admin]',array(
			'required' => 'Email Wajib Di isi.',
			'is_unique' => 'Username Sudah Di Gunakan'
			 ));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email',array(
			'required' => 'Email Wajib Di isi.',
			 ));
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|matches[password2]',array(
			'matches' => 'Password Tidak Sama.',
			'min_length' => 'Password Minimal 8 Karakter.'
			 ));
		$this->form_validation->set_rules('password2', 'Password2', 'trim|required|matches[password]');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Tambah Admin';
			$this->load->view('tambahadmin',$data);
		} else {
			// die(print_r($_POST));
			$kode = $this->get_kod();
			$data = array(
				'kd_admin' => $kode,
				'nama_admin' => $this->input->post('name'),
				'email_admin'		 => $this->input->post('email'),
				'no_hp_admin'	=> $this->input->post('no_hp'),
				'img_admin'		=> 'assets/dist/img/default.png',
				'username_admin' => strtolower($this->input->post('username')),
				'password_admin' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
				'level_admin'	=> $this->input->post('level'),
				'create_date_admin' => date('Y-m-d H:i:s')
				 );
			// die(print_r($data));
			$this->db->insert('tbl_admin', $data);
    		redirect('admin');
		}

	}

	public function delete($id=''){
		$sqlcek = $this->db->query("SELECT * FROM tbl_admin WHERE kd_admin = '".$id."'")->row_array();
		if ($sqlcek) {
			$this->db->where('kd_admin', $id); 
			$this->db->delete('tbl_admin'); 
			$this->session->set_flashdata('alert', '$(function() {
                $.bootstrapGrowl("Pengguna Berhasil Dihapus",{
                		type: "danger",
                        align: "right",
                        width: "auto",
                        allow_dismiss: false
                });
            	});');
			redirect('admin');
		}else{
			$this->session->set_flashdata('alert', '$(function() {
                $.bootstrapGrowl("Pengguna Tidak Ada",{
                		type: "danger",
                        align: "right",
                        width: "auto",
                        allow_dismiss: false
                });
            	});');
			redirect('admin');
		}
	}
	public function lokasi() {
		$data['title'] = 'Lokasi Kerja';
		$data['lokasi'] = $this->db->order_by('kd_lokasi', 'ASC')->get('tbl_lokasi')->result_array();
		$this->load->view('lokasi', $data);
	}

	private function get_kode_lokasi() {
		$prefix = 'L';
		$q = $this->db->query("SELECT MAX(RIGHT(kd_lokasi,3)) AS kd_max FROM tbl_lokasi WHERE kd_lokasi LIKE 'L%'");
		$count = 1;
		if ($q->num_rows() > 0) {
			$row = $q->row_array();
			if (!empty($row['kd_max'])) {
				$count = (int)$row['kd_max'] + 1;
			}
		}

		do {
			$code = $prefix . str_pad($count, 3, '0', STR_PAD_LEFT);
			$exists = $this->db->where('kd_lokasi', $code)->count_all_results('tbl_lokasi') > 0;
			if ($exists) {
				$count++;
			}
		} while ($exists);

		return $code;
	}

	public function lokasi_tambah() {
		$this->form_validation->set_rules('nama_lokasi', 'Nama Lokasi', 'trim|required');
		$this->form_validation->set_rules('latitude', 'Latitude', 'trim|required|numeric');
		$this->form_validation->set_rules('longitude', 'Longitude', 'trim|required|numeric');
		$this->form_validation->set_rules('radius_meter', 'Radius', 'trim|required|integer');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Tambah Lokasi Kerja';
			$data['lokasi'] = null;
			$this->load->view('formlokasi', $data);
		} else {
			$kode = $this->get_kode_lokasi();
			$data = array(
				'kd_lokasi' => $kode,
				'nama_lokasi' => $this->input->post('nama_lokasi'),
				'latitude' => $this->input->post('latitude'),
				'longitude' => $this->input->post('longitude'),
				'radius_meter' => $this->input->post('radius_meter'),
				'created_at' => date('Y-m-d H:i:s'),
			);
			$this->db->insert('tbl_lokasi', $data);
			redirect('admin/lokasi');
		}
	}

	public function lokasi_edit($id = '') {
		$lokasi = $this->db->where('kd_lokasi', $id)->get('tbl_lokasi')->row_array();
		if (!$lokasi) {
			redirect('admin/lokasi');
		}

		$this->form_validation->set_rules('nama_lokasi', 'Nama Lokasi', 'trim|required');
		$this->form_validation->set_rules('latitude', 'Latitude', 'trim|required|numeric');
		$this->form_validation->set_rules('longitude', 'Longitude', 'trim|required|numeric');
		$this->form_validation->set_rules('radius_meter', 'Radius', 'trim|required|integer');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Edit Lokasi Kerja';
			$data['lokasi'] = $lokasi;
			$this->load->view('formlokasi', $data);
		} else {
			$update = array(
				'nama_lokasi' => $this->input->post('nama_lokasi'),
				'latitude' => $this->input->post('latitude'),
				'longitude' => $this->input->post('longitude'),
				'radius_meter' => $this->input->post('radius_meter'),
			);
			$this->db->where('kd_lokasi', $id)->update('tbl_lokasi', $update);
			redirect('admin/lokasi');
		}
	}

	public function lokasi_hapus($id = '') {
		$this->db->where('kd_lokasi', $id)->delete('tbl_lokasi');
		redirect('admin/lokasi');
	}

	private function get_kode_shift() {
		$prefix = 'S';
		$q = $this->db->query("SELECT MAX(RIGHT(kd_shift, 3)) AS kd_max FROM tbl_shift WHERE kd_shift LIKE 'S%'");
		$count = 1;
		if ($q->num_rows() > 0) {
			$row = $q->row_array();
			if (!empty($row['kd_max'])) {
				$count = (int)$row['kd_max'] + 1;
			}
		}

		do {
			$code = $prefix . str_pad($count, 3, '0', STR_PAD_LEFT);
			$exists = $this->db->where('kd_shift', $code)->count_all_results('tbl_shift') > 0;
			if ($exists) {
				$count++;
			}
		} while ($exists);

		return $code;
	}

	public function shift() {
		$data['title'] = 'Shift Kerja';
		$data['shift'] = $this->db->order_by('kd_shift', 'ASC')->get('tbl_shift')->result_array();
		$this->load->view('shift', $data);
	}

	public function shift_tambah() {
		$this->form_validation->set_rules('nama_shift', 'Nama Shift', 'trim|required');
		$this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'trim|required');
		$this->form_validation->set_rules('jam_selesai', 'Jam Selesai', 'trim|required|callback_time_after[jam_mulai]');
		$this->form_validation->set_rules('masuk_mulai', 'Masuk Mulai', 'trim|required');
		$this->form_validation->set_rules('masuk_selesai', 'Masuk Selesai', 'trim|required|callback_time_after[masuk_mulai]');
		$this->form_validation->set_rules('tengah_mulai', 'Tengah Mulai', 'trim|required');
		$this->form_validation->set_rules('tengah_selesai', 'Tengah Selesai', 'trim|required|callback_time_after[tengah_mulai]');
		$this->form_validation->set_rules('pulang_mulai', 'Pulang Mulai', 'trim|required');
		$this->form_validation->set_rules('pulang_selesai', 'Pulang Selesai', 'trim|required|callback_time_after[pulang_mulai]');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Tambah Shift Kerja';
			$data['shift'] = null;
			$this->load->view('formshift', $data);
		} else {
			$kode = $this->get_kode_shift();
			$data = array(
				'kd_shift' => $kode,
				'nama_shift' => $this->input->post('nama_shift'),
				'jam_mulai' => $this->input->post('jam_mulai'),
				'jam_selesai' => $this->input->post('jam_selesai'),
				'masuk_mulai' => $this->input->post('masuk_mulai'),
				'masuk_selesai' => $this->input->post('masuk_selesai'),
				'tengah_mulai' => $this->input->post('tengah_mulai'),
				'tengah_selesai' => $this->input->post('tengah_selesai'),
				'pulang_mulai' => $this->input->post('pulang_mulai'),
				'pulang_selesai' => $this->input->post('pulang_selesai'),
				'created_at' => date('Y-m-d H:i:s'),
			);
			$this->db->insert('tbl_shift', $data);
			redirect('admin/shift');
		}
	}

	public function shift_edit($id = '') {
		$shift = $this->db->where('kd_shift', $id)->get('tbl_shift')->row_array();
		if (!$shift) {
			redirect('admin/shift');
		}

		$this->form_validation->set_rules('nama_shift', 'Nama Shift', 'trim|required');
		$this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'trim|required');
		$this->form_validation->set_rules('jam_selesai', 'Jam Selesai', 'trim|required|callback_time_after[jam_mulai]');
		$this->form_validation->set_rules('masuk_mulai', 'Masuk Mulai', 'trim|required');
		$this->form_validation->set_rules('masuk_selesai', 'Masuk Selesai', 'trim|required|callback_time_after[masuk_mulai]');
		$this->form_validation->set_rules('tengah_mulai', 'Tengah Mulai', 'trim|required');
		$this->form_validation->set_rules('tengah_selesai', 'Tengah Selesai', 'trim|required|callback_time_after[tengah_mulai]');
		$this->form_validation->set_rules('pulang_mulai', 'Pulang Mulai', 'trim|required');
		$this->form_validation->set_rules('pulang_selesai', 'Pulang Selesai', 'trim|required|callback_time_after[pulang_mulai]');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Edit Shift Kerja';
			$data['shift'] = $shift;
			$this->load->view('formshift', $data);
		} else {
			$update = array(
				'nama_shift' => $this->input->post('nama_shift'),
				'jam_mulai' => $this->input->post('jam_mulai'),
				'jam_selesai' => $this->input->post('jam_selesai'),
				'masuk_mulai' => $this->input->post('masuk_mulai'),
				'masuk_selesai' => $this->input->post('masuk_selesai'),
				'tengah_mulai' => $this->input->post('tengah_mulai'),
				'tengah_selesai' => $this->input->post('tengah_selesai'),
				'pulang_mulai' => $this->input->post('pulang_mulai'),
				'pulang_selesai' => $this->input->post('pulang_selesai'),
			);
			$this->db->where('kd_shift', $id)->update('tbl_shift', $update);
			redirect('admin/shift');
		}
	}

	public function shift_hapus($id = '') {
		$this->db->where('kd_shift', $id)->delete('tbl_shift');
		redirect('admin/shift');
	}

	public function time_after($end_time, $start_field) {
		$start_time = $this->input->post($start_field);
		if (!$start_time || !$end_time) {
			return true;
		}
		if ($end_time < $start_time) {
			$this->form_validation->set_message('time_after', '%s harus sama atau lebih besar dari jam awal.');
			return false;
		}
		return true;
	}

	public function jadwal() {
		$start_date = $this->input->get('start_date');
		$end_date = $this->input->get('end_date');

		if (!$start_date && !$end_date) {
			$start_date = date('Y-m-d');
			$end_date = date('Y-m-d');
		} elseif ($start_date && !$end_date) {
			$end_date = $start_date;
		} elseif (!$start_date && $end_date) {
			$start_date = $end_date;
		}

		$data['title'] = 'Jadwal Shift';
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$query = $this->db
			->select('j.*, a.nama_admin, s.nama_shift, s.jam_mulai, s.jam_selesai, l.nama_lokasi')
			->from('tbl_absensi_jadwal j')
			->join('tbl_admin a', 'j.kd_admin = a.kd_admin', 'left')
			->join('tbl_shift s', 'j.kd_shift = s.kd_shift', 'left')
			->join('tbl_lokasi l', 'j.kd_lokasi = l.kd_lokasi', 'left');

		if ($start_date) {
			$query->where('j.tanggal >=', $start_date);
		}
		if ($end_date) {
			$query->where('j.tanggal <=', $end_date);
		}

		$data['jadwal'] = $query
			->order_by('j.tanggal', 'ASC')
			->order_by('j.kd_admin', 'ASC')
			->get()
			->result_array();

		$this->load->view('jadwal', $data);
	}

	public function jadwal_tambah() {
		$this->form_validation->set_rules('kd_admin', 'Karyawan', 'trim|required');
		$this->form_validation->set_rules('kd_shift', 'Shift', 'trim|required');
		$this->form_validation->set_rules('kd_lokasi', 'Lokasi', 'trim|required');
		$this->form_validation->set_rules('bulan', 'Bulan', 'trim|required');
		$this->form_validation->set_rules('tanggal[]', 'Tanggal', 'required');

		$data['shift'] = $this->db->order_by('kd_shift', 'ASC')->get('tbl_shift')->result_array();
		$data['lokasi'] = $this->db->order_by('kd_lokasi', 'ASC')->get('tbl_lokasi')->result_array();
		$data['admin_list'] = $this->db->order_by('nama_admin', 'ASC')->get('tbl_admin')->result_array();
		$data['selected_dates'] = array();
		$data['date_error'] = null;

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Tambah Jadwal Shift';
			$data['jadwal'] = null;
			$this->load->view('formjadwal', $data);
		} else {
			$selected_dates = $this->input->post('tanggal');
			if (!is_array($selected_dates) || count($selected_dates) === 0) {
				$data['title'] = 'Tambah Jadwal Shift';
				$data['jadwal'] = null;
				$data['selected_dates'] = is_array($selected_dates) ? $selected_dates : array();
				$data['date_error'] = 'Pilih minimal satu tanggal dalam bulan yang dipilih.';
				$this->load->view('formjadwal', $data);
				return;
			}

			$kd_admin = $this->input->post('kd_admin');
			$kd_shift = $this->input->post('kd_shift');
			$kd_lokasi = $this->input->post('kd_lokasi');
			$inserted = 0;
			foreach ($selected_dates as $tanggal_item) {
				$tanggal_item = trim($tanggal_item);
				if (!$tanggal_item) {
					continue;
				}
				$this->db->insert('tbl_absensi_jadwal', array(
					'kd_admin' => $kd_admin,
					'kd_shift' => $kd_shift,
					'kd_lokasi' => $kd_lokasi,
					'tanggal' => $tanggal_item,
					'created_at' => date('Y-m-d H:i:s'),
				));
				$inserted++;
			}

			$this->session->set_flashdata('success', $inserted > 0 ? $inserted . ' jadwal berhasil ditambahkan.' : 'Tidak ada jadwal baru yang ditambahkan karena duplikasi.');
			redirect('admin/jadwal');
		}
	}

	public function jadwal_edit($id = '') {
		$jadwal = $this->db->where('id', $id)->get('tbl_absensi_jadwal')->row_array();
		if (!$jadwal) {
			redirect('admin/jadwal');
		}

		$this->form_validation->set_rules('kd_admin', 'Karyawan', 'trim|required');
		$this->form_validation->set_rules('kd_shift', 'Shift', 'trim|required');
		$this->form_validation->set_rules('kd_lokasi', 'Lokasi', 'trim|required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');

		$data['shift'] = $this->db->order_by('kd_shift', 'ASC')->get('tbl_shift')->result_array();
		$data['lokasi'] = $this->db->order_by('kd_lokasi', 'ASC')->get('tbl_lokasi')->result_array();
		$data['admin_list'] = $this->db->order_by('nama_admin', 'ASC')->get('tbl_admin')->result_array();

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Edit Jadwal Shift';
			$data['jadwal'] = $jadwal;
			$this->load->view('formjadwal', $data);
		} else {
			$tanggal = $this->input->post('tanggal');
			if (is_array($tanggal)) {
				$tanggal = reset($tanggal);
			}
			$update = array(
				'kd_admin' => $this->input->post('kd_admin'),
				'kd_shift' => $this->input->post('kd_shift'),
				'kd_lokasi' => $this->input->post('kd_lokasi'),
				'tanggal' => $tanggal,
			);
			$this->db->where('id', $id)->update('tbl_absensi_jadwal', $update);
			redirect('admin/jadwal');
		}
	}

	public function jadwal_hapus($id = '') {
		$this->db->where('id', $id)->delete('tbl_absensi_jadwal');
		redirect('admin/jadwal');
	}

	public function history_absensi() {
		$kd_admin = $this->input->get('kd_admin');
		$tanggal = $this->input->get('tanggal');
		if (!$tanggal) {
			$tanggal = date('Y-m-d');
		}
		$data['title'] = 'History Absensi';
		$data['admin_list'] = $this->db->order_by('nama_admin', 'ASC')->get('tbl_admin')->result_array();
		$this->db->select('j.*, u.nama_admin, u.level_admin, s.nama_shift, l.nama_lokasi, a.kd_absensi, a.status_kehadiran')
			->from('tbl_absensi_jadwal j')
			->join('tbl_admin u', 'j.kd_admin = u.kd_admin', 'left')
			->join('tbl_shift s', 'j.kd_shift = s.kd_shift', 'left')
			->join('tbl_lokasi l', 'j.kd_lokasi = l.kd_lokasi', 'left')
			->join('tbl_absensi a', 'j.id = a.id_jadwal', 'left');
		if ($kd_admin) {
			$this->db->where('j.kd_admin', $kd_admin);
		}
		if ($tanggal) {
			$this->db->where('j.tanggal', $tanggal);
		}
		$data['history'] = $this->db->order_by('j.tanggal', 'DESC')->get()->result_array();
		foreach ($data['history'] as &$row) {
			if (empty($row['kd_absensi'])) {
				$row['rekap_kehadiran'] = 'Belum Absen';
			} elseif ($row['status_kehadiran'] === 'complete') {
				$row['rekap_kehadiran'] = 'Hadir';
			} else {
				$row['rekap_kehadiran'] = 'Tidak Hadir';
			}
		}
		unset($row);
		unset($row);
		$data['selected_admin'] = $kd_admin;
		$data['selected_date'] = $tanggal;
		$this->load->view('history_absensi', $data);
	}

	public function history_absensi_verify($kd_absensi = '') {
		$action = $this->input->post('verify_action');
		$reason = $this->input->post('reason');
		if (!$kd_absensi || !in_array($action, array('complete', 'incomplete'), true)) {
			redirect('admin/history_absensi');
		}

		$attendance = $this->db->where('kd_absensi', $kd_absensi)->get('tbl_absensi')->row_array();
		if (!$attendance) {
			redirect('admin/history_absensi');
		}

		$this->Attendance_model->ensure_reason_column_exists();
		$data = array('status_kehadiran' => $action === 'complete' ? 'complete' : 'in progress');
		if ($action === 'incomplete') {
			$data['reason_incomplete'] = $reason;
		} else {
			$data['reason_incomplete'] = null;
		}
		$this->db->where('kd_absensi', $kd_absensi)->update('tbl_absensi', array_merge($data, array('updated_at' => date('Y-m-d H:i:s'))));
		$this->session->set_flashdata('success', $action === 'complete' ? 'Absensi berhasil diverifikasi lengkap.' : 'Absensi ditandai tidak lengkap.');
		redirect('admin/history_absensi_detail/' . $kd_absensi);
	}

	public function history_absensi_detail($kd_absensi = '') {
		$attendance = $this->db
			->select('a.*, u.nama_admin, s.nama_shift, l.nama_lokasi')
			->from('tbl_absensi a')
			->join('tbl_admin u', 'a.kd_admin = u.kd_admin', 'left')
			->join('tbl_shift s', 'a.kd_shift = s.kd_shift', 'left')
			->join('tbl_lokasi l', 'a.kd_lokasi = l.kd_lokasi', 'left')
			->where('a.kd_absensi', $kd_absensi)
			->get()
			->row_array();

		if (!$attendance) {
			redirect('admin/history_absensi');
		}

		$data['title'] = 'Detail History Absensi';
		$attendance['scan_summary'] = 'Tidak ada scan';
		$scan_rows = $this->db
			->where('kd_absensi', $kd_absensi)
			->order_by('FIELD(stage, "masuk", "tengah", "pulang" )', null, false)
			->get('tbl_absensi_scan')
			->result_array();
		if (!empty($scan_rows)) {
			$stage_labels = array('masuk' => 'Pagi', 'tengah' => 'Siang', 'pulang' => 'Pulang');
			$stages = array();
			foreach ($scan_rows as $scan_row) {
				if (!in_array($scan_row['stage'], $stages, true)) {
					$stages[] = $scan_row['stage'];
				}
			}
			$labels = array();
			foreach ($stages as $stage) {
				if (isset($stage_labels[$stage])) {
					$labels[] = $stage_labels[$stage];
				}
			}
			if (!empty($labels)) {
				$attendance['scan_summary'] = 'Hadir ' . implode(', ', $labels);
			}
		}
		$data['attendance'] = $attendance;
		$data['scans'] = $scan_rows;
		$this->load->view('history_absensi_detail', $data);
	}

	public function history_absensi_scan_hapus($scan_id = '') {
		if (!$scan_id) {
			redirect('admin/history_absensi');
		}

		$scan = $this->db->where('id', $scan_id)->get('tbl_absensi_scan')->row_array();
		if ($scan) {
			$kd_absensi = $scan['kd_absensi'];
			$this->db->where('id', $scan_id)->delete('tbl_absensi_scan');

			$attendance = $this->db->where('kd_absensi', $kd_absensi)->get('tbl_absensi')->row_array();
			if ($attendance) {
				$complete = $this->Attendance_model->is_attendance_complete($kd_absensi, null);
				$this->db->where('kd_absensi', $kd_absensi)->update('tbl_absensi', array(
					'status_kehadiran' => $complete ? 'complete' : 'in progress',
					'updated_at' => date('Y-m-d H:i:s'),
				));
			}

			$this->session->set_flashdata('success', 'Scan absensi berhasil dihapus.');
			redirect('admin/history_absensi_detail/' . $kd_absensi);
		}

		redirect('admin/history_absensi');
	}

	public function history_absensi_hapus($kd_absensi = '') {
		if (!$kd_absensi) {
			redirect('admin/history_absensi');
		}

		$attendance = $this->db->where('kd_absensi', $kd_absensi)->get('tbl_absensi')->row_array();
		if ($attendance) {
			$this->db->where('kd_absensi', $kd_absensi)->delete('tbl_absensi_scan');
			$this->db->where('kd_absensi', $kd_absensi)->delete('tbl_absensi');
			$this->session->set_flashdata('success', 'Data absensi berhasil dihapus.');
		} else {
			$this->session->set_flashdata('success', 'Absensi tidak ditemukan.');
		}

		redirect('admin/history_absensi');

	}
}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */