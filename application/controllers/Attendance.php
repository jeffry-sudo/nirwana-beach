<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $this->load->model('Attendance_model');
        date_default_timezone_set('Asia/Makassar');
    }

    public function index() {
        $kd_admin = $this->session->userdata('kd_admin');
        $user_level = $this->session->userdata('level');
        $data['title'] = 'Absensi Karyawan';

        $schedules = $this->Attendance_model->get_today_schedules($kd_admin);
        $data['schedules'] = array();
        $data['allowed_stages'] = $this->Attendance_model->get_allowed_stages($user_level);

        if (!empty($schedules)) {
            foreach ($schedules as $schedule) {
                $scan_status = $this->Attendance_model->get_today_scan_status($kd_admin, $schedule['id']);
                $attendance = $this->Attendance_model->get_today_attendance($kd_admin, $schedule['id']);
                $available_stage = $this->Attendance_model->get_available_stage($schedule, $scan_status, $user_level);

                $data['schedules'][] = array(
                    'schedule' => $schedule,
                    'scan_status' => $scan_status,
                    'attendance' => $attendance,
                    'available_stage' => $available_stage,
                    'summary' => $this->Attendance_model->build_summary($schedule, $scan_status, $user_level),
                );
            }

            $data['schedule'] = $data['schedules'][0]['schedule'];
            $data['scan_status'] = $data['schedules'][0]['scan_status'];
            $data['attendance'] = $data['schedules'][0]['attendance'];
            $data['available_stage'] = $data['schedules'][0]['available_stage'];
            $data['summary'] = $data['schedules'][0]['summary'];
        } else {
            $data['schedule'] = null;
            $data['scan_status'] = array();
            $data['attendance'] = null;
            $data['available_stage'] = null;
            $data['summary'] = array('text' => 'Tidak ada jadwal shift hari ini.', 'completed' => false);
        }

        $this->load->view('attendance/index', $data);
    }

    public function capture($stage = null, $schedule_id = null) {
        $user_level = $this->session->userdata('level');
        $allowed = $this->Attendance_model->get_allowed_stages($user_level);
        if (!$stage || !in_array($stage, $allowed, true)) {
            redirect('attendance');
        }

        $kd_admin = $this->session->userdata('kd_admin');
        $schedule = $schedule_id ? $this->Attendance_model->get_schedule_by_id($kd_admin, $schedule_id) : $this->Attendance_model->get_today_schedule($kd_admin);
        if (!$schedule) {
            $this->session->set_flashdata('error', 'Tidak ada jadwal shift untuk hari ini.');
            redirect('attendance');
        }

        $scan_status = $this->Attendance_model->get_today_scan_status($kd_admin, $schedule['id']);
        $available = $this->Attendance_model->get_available_stage($schedule, $scan_status, $user_level);
        if ($available !== $stage) {
            $this->session->set_flashdata('error', 'Tindakan absen untuk tahap ini belum tersedia.');
            redirect('attendance');
        }

        $data['title'] = 'Absen ' . ucfirst($stage);
        $data['stage'] = $stage;
        $data['schedule'] = $schedule;
        $data['scan_status'] = $scan_status;
        $data['available_stage'] = $available;
        $this->load->view('attendance/capture', $data);
    }

    public function submit_scan() {
        $this->output->set_content_type('application/json');

        $post = $this->input->post(null, false);
        $stage = isset($post['stage']) ? $post['stage'] : null;
        $schedule_id = isset($post['schedule_id']) ? $post['schedule_id'] : null;
        $latitude = isset($post['latitude']) ? $post['latitude'] : null;
        $longitude = isset($post['longitude']) ? $post['longitude'] : null;
        $photo = isset($post['photo']) ? $post['photo'] : null;

        if (!$stage || !$latitude || !$longitude || !$photo) {
            echo json_encode(array('success' => false, 'message' => 'Data scan tidak lengkap.')); 
            return;
        }

        $kd_admin = $this->session->userdata('kd_admin');
        $save = $this->Attendance_model->save_scan($kd_admin, $stage, $latitude, $longitude, $photo, $schedule_id);
        echo json_encode($save);
    }

    public function history() {
        $kd_admin = $this->session->userdata('kd_admin');

        $this->db->select('j.*, s.nama_shift, l.nama_lokasi, a.kd_absensi, a.status_kehadiran')
            ->from('tbl_absensi_jadwal j')
            ->join('tbl_shift s', 'j.kd_shift = s.kd_shift', 'left')
            ->join('tbl_lokasi l', 'j.kd_lokasi = l.kd_lokasi', 'left')
            ->join('tbl_absensi a', 'j.id = a.id_jadwal', 'left')
            ->where('j.kd_admin', $kd_admin)
            ->order_by('j.tanggal', 'DESC');

        $history = $this->db->get()->result_array();
        foreach ($history as &$row) {
            if (empty($row['kd_absensi'])) {
                $row['rekap_kehadiran'] = 'Belum Absen';
            } elseif ($row['status_kehadiran'] === 'complete') {
                $row['rekap_kehadiran'] = 'Hadir';
            } else {
                $row['rekap_kehadiran'] = 'Tidak Hadir';
            }
        }
        unset($row);

        $data['title'] = 'History Absensi Saya';
        $data['history'] = $history;
        $this->load->view('attendance/history', $data);
    }

    public function history_detail($kd_absensi = '') {
        $kd_admin = $this->session->userdata('kd_admin');

        $attendance = $this->db
            ->select('a.*, s.nama_shift, l.nama_lokasi')
            ->from('tbl_absensi a')
            ->join('tbl_shift s', 'a.kd_shift = s.kd_shift', 'left')
            ->join('tbl_lokasi l', 'a.kd_lokasi = l.kd_lokasi', 'left')
            ->where('a.kd_absensi', $kd_absensi)
            ->where('a.kd_admin', $kd_admin)
            ->get()
            ->row_array();

        if (!$attendance) {
            redirect('attendance/history');
        }

        $data['title'] = 'Detail History Absensi';
        $data['attendance'] = $attendance;
        $data['scans'] = $this->db
            ->where('kd_absensi', $kd_absensi)
            ->order_by('FIELD(stage, "masuk", "tengah", "pulang")', null, false)
            ->get('tbl_absensi_scan')
            ->result_array();

        $this->load->view('attendance/history_detail', $data);
    }
}
