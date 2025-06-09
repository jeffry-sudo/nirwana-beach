<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scan extends CI_Controller {

    public function index() {
        $this->load->view('laporan/scan_view'); // Tampilkan halaman scan
    }

    public function simpan_scan() {
        $kode = $this->input->post('barcode');
        $data = array(
            'kode_barcode' => $kode,
            'waktu_scan' => date('Y-m-d H:i:s')
        );

        $this->db->insert('tbl_scan', $data);
        echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan']);
    }
}
