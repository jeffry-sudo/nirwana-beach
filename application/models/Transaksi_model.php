<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

    public function get_all_transaksi() {
        // Menambahkan filter tanggal hari ini
        $this->db->where('DATE_FORMAT(tgl_trx, "%Y-%m-%d") =', 'CURDATE()', false);
        
        // Mengurutkan berdasarkan tanggal transaksi terbaru
        $this->db->order_by('tgl_trx', 'DESC');
        
        // Mengambil hasil query dan mengembalikannya dalam bentuk array
        return $this->db->get('tbl_transaksi')->result_array();
    }
    

    public function get_total_by_type($type) {
        $this->db->select_sum('nominal');
        $this->db->where('jenis_trx', $type);
        $this->db->where('DATE_FORMAT(tgl_trx, "%Y-%m-%d")=', 'CURDATE()', false);
        $result = $this->db->get('tbl_transaksi')->row();
        return $result->nominal ? $result->nominal : 0;
    }

    public function insertTransaksi($data) {
        // Masukkan data ke tabel tbl_transaksi
        $this->db->insert('tbl_transaksi', $data);
    }
}
