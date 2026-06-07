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
        $data['schedule'] = $this->Attendance_model->get_today_schedule($kd_admin);
        $data['scan_status'] = $this->Attendance_model->get_today_scan_status($kd_admin);
        $data['attendance'] = $this->Attendance_model->get_today_attendance($kd_admin);
        $data['allowed_stages'] = $this->Attendance_model->get_allowed_stages($user_level);
        $data['available_stage'] = $this->Attendance_model->get_available_stage($data['schedule'], $data['scan_status'], $user_level);
        $data['summary'] = $this->Attendance_model->build_summary($data['schedule'], $data['scan_status'], $user_level);
        $this->load->view('attendance/index', $data);
    }

    public function capture($stage = null) {
        $user_level = $this->session->userdata('level');
        $allowed = $this->Attendance_model->get_allowed_stages($user_level);
        if (!$stage || !in_array($stage, $allowed, true)) {
            redirect('attendance');
        }

        $kd_admin = $this->session->userdata('kd_admin');
        $schedule = $this->Attendance_model->get_today_schedule($kd_admin);
        if (!$schedule) {
            $this->session->set_flashdata('error', 'Tidak ada jadwal shift untuk hari ini.');
            redirect('attendance');
        }

        $scan_status = $this->Attendance_model->get_today_scan_status($kd_admin);
        $available = $this->Attendance_model->get_available_stage($schedule, $scan_status);
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
        $latitude = isset($post['latitude']) ? $post['latitude'] : null;
        $longitude = isset($post['longitude']) ? $post['longitude'] : null;
        $photo = isset($post['photo']) ? $post['photo'] : null;

        if (!$stage || !$latitude || !$longitude || !$photo) {
            echo json_encode(array('success' => false, 'message' => 'Data scan tidak lengkap.')); 
            return;
        }

        $kd_admin = $this->session->userdata('kd_admin');
        $save = $this->Attendance_model->save_scan($kd_admin, $stage, $latitude, $longitude, $photo);
        echo json_encode($save);
    }
}
