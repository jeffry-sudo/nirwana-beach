<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_today_schedule($kd_admin) {
        $today = date('Y-m-d');
        return $this->db
            ->select('j.*, s.nama_shift, s.jam_mulai, s.jam_selesai, s.masuk_mulai, s.masuk_selesai, s.tengah_mulai, s.tengah_selesai, s.pulang_mulai, s.pulang_selesai, l.nama_lokasi, l.latitude, l.longitude, l.radius_meter')
            ->from('tbl_absensi_jadwal j')
            ->join('tbl_shift s', 'j.kd_shift = s.kd_shift', 'left')
            ->join('tbl_lokasi l', 'j.kd_lokasi = l.kd_lokasi', 'left')
            ->where('j.kd_admin', $kd_admin)
            ->where('j.tanggal', $today)
            ->get()
            ->row_array();
    }

    public function get_today_scan_status($kd_admin) {
        $today = date('Y-m-d');
        $attendance = $this->db
            ->where('kd_admin', $kd_admin)
            ->where('tanggal', $today)
            ->get('tbl_absensi')
            ->row_array();

        if (empty($attendance)) {
            return array();
        }

        return $this->db
            ->where('kd_absensi', $attendance['kd_absensi'])
            ->order_by('stage', 'ASC')
            ->get('tbl_absensi_scan')
            ->result_array();
    }

    public function get_allowed_stages($level = null) {
        if ($level === null) {
            $level = $this->session->userdata('level');
        }

        if ((string)$level === '2' || (string)$level === '5') {
            return array('masuk', 'pulang');
        }

        return array('masuk', 'tengah', 'pulang');
    }

    public function ensure_reason_column_exists() {
        $column = $this->db->query("SHOW COLUMNS FROM tbl_absensi LIKE 'reason_incomplete'")->row_array();
        if (!$column) {
            $this->db->query("ALTER TABLE tbl_absensi ADD COLUMN reason_incomplete TEXT NULL AFTER updated_at");
        }
    }

    public function get_today_attendance($kd_admin) {
        $today = date('Y-m-d');
        $this->ensure_reason_column_exists();
        return $this->db
            ->where('kd_admin', $kd_admin)
            ->where('tanggal', $today)
            ->get('tbl_absensi')
            ->row_array();
    }

    public function is_attendance_complete($kd_absensi, $level) {
        $allowed_stages = $this->get_allowed_stages($level);
        $scan_records = $this->db
            ->select('stage')
            ->where('kd_absensi', $kd_absensi)
            ->get('tbl_absensi_scan')
            ->result_array();

        $scanned_stages = array_column($scan_records, 'stage');
        foreach ($allowed_stages as $stage) {
            if (!in_array($stage, $scanned_stages, true)) {
                return false;
            }
        }

        return true;
    }

    public function build_summary($schedule, $scan_status, $level = null) {
        if (!$schedule) {
            return array('text' => 'Tidak ada jadwal shift hari ini.', 'completed' => false);
        }

        $allowed_stages = $this->get_allowed_stages($level);
        $completed = count($scan_status);
        $required = count($allowed_stages);
        $text = sprintf('Shift %s (%s - %s) di %s. %d dari %d scan selesai.',
            strtoupper($schedule['kd_shift']),
            date('H:i', strtotime($schedule['jam_mulai'])),
            date('H:i', strtotime($schedule['jam_selesai'])),
            $schedule['nama_lokasi'],
            $completed,
            $required
        );

        if ($completed === $required) {
            $text = 'Absensi lengkap untuk hari ini. Terima kasih.';
        }

        return array('text' => $text, 'completed' => ($completed === $required));
    }

    public function get_available_stage($schedule, $scan_status, $level = null) {
        if (!$schedule) {
            return null;
        }

        $allowed_stages = $this->get_allowed_stages($level);
        $stages = array_column($scan_status, 'stage');
        $now = time();

        $windows = array(
            'masuk' => array(
                'from' => strtotime($schedule['masuk_mulai'] ?: $schedule['jam_mulai'] . ' -300 seconds'),
                'to' => strtotime($schedule['masuk_selesai'] ?: $schedule['jam_mulai'] . ' +1200 seconds'),
            ),
            'tengah' => array(
                'from' => strtotime($schedule['tengah_mulai'] ?: $schedule['jam_mulai'] . ' +7200 seconds'),
                'to' => strtotime($schedule['tengah_selesai'] ?: $schedule['jam_mulai'] . ' +8400 seconds'),
            ),
            'pulang' => array(
                'from' => strtotime($schedule['pulang_mulai'] ?: $schedule['jam_selesai'] . ' -900 seconds'),
                'to' => strtotime($schedule['pulang_selesai'] ?: $schedule['jam_selesai'] . ' +300 seconds'),
            ),
        );

        foreach ($allowed_stages as $stage) {
            if (!in_array($stage, $stages, true) && isset($windows[$stage])) {
                $range = $windows[$stage];
                if ($now >= $range['from'] && $now <= $range['to']) {
                    return $stage;
                }
            }
        }

        return null;
    }

    public function save_scan($kd_admin, $stage, $latitude, $longitude, $photo_base64) {
        $schedule = $this->get_today_schedule($kd_admin);
        if (!$schedule) {
            return array('success' => false, 'message' => 'Tidak ada jadwal shift untuk hari ini.');
        }

        $allowed_stages = $this->get_allowed_stages();
        if (!in_array($stage, $allowed_stages, true)) {
            return array('success' => false, 'message' => 'Tahap absen tidak valid untuk peran ini.');
        }

        $scan_status = $this->get_today_scan_status($kd_admin);
        $existing = array_column($scan_status, 'stage');
        if (in_array($stage, $existing, true)) {
            return array('success' => false, 'message' => 'Tahap absen ini sudah dilakukan.');
        }

        $current_stage = $this->get_available_stage($schedule, $scan_status);
        if ($current_stage !== $stage) {
            return array('success' => false, 'message' => 'Tahap absen tidak tersedia pada waktu ini.');
        }

        $location = $this->db
            ->where('kd_lokasi', $schedule['kd_lokasi'])
            ->get('tbl_lokasi')
            ->row_array();

        if (!$location) {
            return array('success' => false, 'message' => 'Lokasi absensi tidak ditemukan.');
        }

        $distance = $this->calculate_distance($latitude, $longitude, $location['latitude'], $location['longitude']);
        $valid_location = ($distance <= (int)$location['radius_meter']);

        $attendance = $this->db
            ->where('kd_admin', $kd_admin)
            ->where('tanggal', date('Y-m-d'))
            ->get('tbl_absensi')
            ->row_array();

        if (!$valid_location) {
            return array(
                'success' => false,
                'message' => 'Posisi Anda berada di luar radius lokasi. Jarak: ' . round($distance, 2) . ' meter. Pastikan berada dalam radius ' . (int)$location['radius_meter'] . ' meter.',
                'distance' => round($distance, 2),
                'valid_location' => false,
                'stage' => $stage,
            );
        }

        if (empty($attendance)) {
            $attendance = array(
                'kd_absensi' => $this->generate_absensi_code(),
                'kd_admin' => $kd_admin,
                'tanggal' => date('Y-m-d'),
                'kd_shift' => $schedule['kd_shift'],
                'kd_lokasi' => $schedule['kd_lokasi'],
                'status_kehadiran' => 'in progress',
                'created_at' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('tbl_absensi', $attendance);
        }

        $scan = array(
            'kd_absensi' => $attendance['kd_absensi'],
            'stage' => $stage,
            'waktu_scan' => date('Y-m-d H:i:s'),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'jarak_meter' => round($distance, 2),
            'status_valid' => 1,
            'message' => 'Lokasi valid',
            'photo_base64' => $photo_base64,
            'created_at' => date('Y-m-d H:i:s'),
        );

        $this->db->insert('tbl_absensi_scan', $scan);

        $done_scans = $this->db
            ->where('kd_absensi', $attendance['kd_absensi'])
            ->where('status_valid', 1)
            ->count_all_results('tbl_absensi_scan');

        $required_scans = count($this->get_allowed_stages());
        if ($done_scans >= $required_scans) {
            $this->db
                ->where('kd_absensi', $attendance['kd_absensi'])
                ->update('tbl_absensi', array('status_kehadiran' => 'complete', 'updated_at' => date('Y-m-d H:i:s')));
        }

        $message = $valid_location
            ? 'Scan ' . ucfirst($stage) . ' berhasil. Jarak: ' . round($distance, 2) . ' meter.'
            : 'Posisi Anda berada di luar radius lokasi. Jarak: ' . round($distance, 2) . ' meter. Pastikan berada dalam radius ' . (int)$location['radius_meter'] . ' meter.';

        return array(
            'success' => $valid_location,
            'message' => $message,
            'distance' => round($distance, 2),
            'valid_location' => $valid_location,
            'stage' => $stage,
        );
    }

    private function generate_absensi_code() {
        $prefix = 'ABS';
        $row = $this->db
            ->select('kd_absensi')
            ->like('kd_absensi', $prefix, 'after')
            ->order_by('kd_absensi', 'DESC')
            ->limit(1)
            ->get('tbl_absensi')
            ->row_array();

        $count = 1;
        if (!empty($row['kd_absensi']) && preg_match('/^ABS(\d+)$/', $row['kd_absensi'], $matches)) {
            $count = (int)$matches[1] + 1;
        }

        do {
            $code = $prefix . str_pad($count, 6, '0', STR_PAD_LEFT);
            $exists = $this->db->where('kd_absensi', $code)->count_all_results('tbl_absensi') > 0;
            if ($exists) {
                $count++;
            }
        } while ($exists);

        return $code;
    }

    private function calculate_distance($lat1, $lon1, $lat2, $lon2) {
        $earthRadius = 6371000;
        $lat1 = deg2rad((float)$lat1);
        $lon1 = deg2rad((float)$lon1);
        $lat2 = deg2rad((float)$lat2);
        $lon2 = deg2rad((float)$lon2);

        $latDelta = $lat2 - $lat1;
        $lonDelta = $lon2 - $lon1;
        $a = sin($latDelta / 2) ** 2 + cos($lat1) * cos($lat2) * sin($lonDelta / 2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $earthRadius * $c;
    }
}
