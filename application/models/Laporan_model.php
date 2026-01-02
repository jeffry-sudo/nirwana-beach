<?php
class Laporan_model extends CI_Model {

    public function get_filtered_data($dari_tanggal, $sampai_tanggal) {
        // Select the summary data (e.g. total penjualan, keuntungan, etc.)
        $this->db->select('SUM(
            CASE 
                WHEN a.kd_kendaraan = "JK003" THEN 0 
                ELSE a.harga_kendaraan 
            END + (b.jml_org * 2000)
        ) AS total_penjualan');
        $this->db->select('SUM(harga_kendaraan * jml_org) AS total_keuntungan');
        $this->db->select('COUNT(CASE WHEN b.kd_kendaraan = "JK002" THEN 1 END) AS jumlah_mobil');
        $this->db->select('COUNT(CASE WHEN b.kd_kendaraan = "JK001" THEN 1 END) AS jumlah_motor');
        $this->db->select('SUM(jml_org) AS jumlah_orang');
        $this->db->from('tbl_kendaraan a');
        $this->db->join('tbl_masuk b', 'a.kd_kendaraan = b.kd_kendaraan');
        
        // Filter by the date range
        if ($dari_tanggal != null) {
            $this->db->where('DATE(b.tgl_masuk) >=', $dari_tanggal);
            $this->db->where('DATE(b.tgl_masuk) <=', $sampai_tanggal);
        } else {
            // $this->db->where('DATE_FORMAT(b.tgl_masuk, "%Y-%m-%d")=', 'CURDATE()', false);
             $this->db->where('b.tgl_masuk >=', date('Y-m-d 00:00:00'));
             $this->db->where('b.tgl_masuk <=', date('Y-m-d 23:59:59'));
        }
    
        // Get the summary data
        $query = $this->db->get();
        $result = $query->row_array();
    
        // Hitung total harga untuk jumlah mobil
        $harga_per_mobil = 5000;
        $harga_per_motor = 3000;
        $harga_per_orang = 2000;
        $jumlah_mobil = $result['jumlah_mobil'];
        $jumlah_motor = $result['jumlah_motor'];
        $jumlah_orang = $result['jumlah_orang'];
        $total_harga_mobil = $jumlah_mobil * $harga_per_mobil;
        $total_harga_motor = $jumlah_motor * $harga_per_motor;
        $total_harga_orang = $jumlah_orang * $harga_per_orang;
    
        // Format output sesuai yang diinginkan
        $formatted_jumlah_mobil = $jumlah_mobil . "xRp. " . number_format($harga_per_mobil, 0, ',', '.') . " = Rp. " . number_format($total_harga_mobil, 0, ',', '.');
        $formatted_jumlah_motor = $jumlah_motor . "xRp. " . number_format($harga_per_motor, 0, ',', '.') . " = Rp. " . number_format($total_harga_motor, 0, ',', '.');
        $formatted_jumlah_orang = $jumlah_orang . "xRp. " . number_format($harga_per_orang, 0, ',', '.') . " = Rp. " . number_format($total_harga_orang, 0, ',', '.');
        $formatted_total_penjualan = "Rp. " . number_format($result['total_penjualan'], 0, ',', '.');
        
        // Get the detailed rows (masuk data)
        $this->db->select('nama_kendaraan, jml_org, tgl_masuk, create_masuk, a.kd_masuk');
        $this->db->from('tbl_masuk a');
        $this->db->join('tbl_kendaraan b', 'a.kd_kendaraan = b.kd_kendaraan');
        
        // Filter by the same date range for detailed data
        if ($dari_tanggal != null) {
            $this->db->where('DATE(a.tgl_masuk) >=', $dari_tanggal);
            $this->db->where('DATE(a.tgl_masuk) <=', $sampai_tanggal);
        } else {
             $this->db->where('b.tgl_masuk >=', date('Y-m-d 00:00:00'));
             $this->db->where('b.tgl_masuk <=', date('Y-m-d 23:59:59'));
            // $this->db->where('DATE_FORMAT(a.tgl_masuk, "%Y-%m-%d")=', 'CURDATE()', false);
        }
    
        // Get the masuk data
        $query_masuk = $this->db->get();
        $masuk_data = $query_masuk->result_array();
    
        $this->db->select('a.create_masuk, SUM(
            CASE 
                WHEN a.kd_kendaraan = "JK003" THEN 0 
                ELSE b.harga_kendaraan 
            END + (a.jml_org * 2000)
        ) AS total_penjualan');
        
        $this->db->from('tbl_masuk a');
        $this->db->join('tbl_kendaraan b', 'a.kd_kendaraan = b.kd_kendaraan', 'left');
        $this->db->group_by('a.create_masuk');
        
        if ($dari_tanggal != null) {
            $this->db->where('DATE(a.tgl_masuk) >=', $dari_tanggal);
            $this->db->where('DATE(a.tgl_masuk) <=', $sampai_tanggal);
        } else {
            $this->db->where('b.tgl_masuk >=', date('Y-m-d 00:00:00'));
            $this->db->where('b.tgl_masuk <=', date('Y-m-d 23:59:59'));
            // $this->db->where('DATE_FORMAT(a.tgl_masuk, "%Y-%m-%d")=', 'CURDATE()', false);
        }
        
        $query_masuk_detail = $this->db->get();
        $masuk_data_detail = $query_masuk_detail->result_array();

        // Return the combined data
        return [
            'total_penjualan' => $formatted_total_penjualan,
            'total_keuntungan' => $result['total_keuntungan'],
            'jumlah_mobil' => $formatted_jumlah_mobil, // Sudah dalam format yang diminta
            'jumlah_motor' => $formatted_jumlah_motor,
            'jumlah_orang' => $formatted_jumlah_orang,
            'masuk' => $masuk_data,
            'masuk_detail' => $masuk_data_detail
        ];
    }   
    
    // Fungsi untuk mendapatkan Total Penjualan
    // public function get_total_penjualan() {
    //     $this->db->select('SUM(
    //         CASE 
    //             WHEN a.kd_kendaraan = "JK003" THEN 0 
    //             ELSE b.harga_kendaraan 
    //         END + (a.jml_org * 2000)
    //     ) AS total_penjualan');
        
    //     $this->db->from('tbl_masuk a');
    //     $this->db->join('tbl_kendaraan b', 'a.kd_kendaraan = b.kd_kendaraan', 'left');
    //     $this->db->where('DATE_FORMAT(a.tgl_masuk, "%Y-%m-%d") = CURDATE()', false, false);
        
    //     $query = $this->db->get();
    //     $total_penjualan = $query->row()->total_penjualan ?? 0; // Pastikan tidak null
    
    //     // Format output dengan "Rp" dan pemisah ribuan
    //     return "Rp. " . number_format($total_penjualan, 0, ',', '.');
    // }

    public function get_total_penjualan() {

    $this->db->select('SUM(
        CASE 
            WHEN a.kd_kendaraan = "JK003" THEN 0 
            ELSE b.harga_kendaraan 
        END + (a.jml_org * 2000)
    ) AS total_penjualan', false);

    $this->db->from('tbl_masuk a');
    $this->db->join('tbl_kendaraan b', 'a.kd_kendaraan = b.kd_kendaraan', 'left');

    // FILTER HARI INI
    $this->db->where('a.tgl_masuk >=', date('Y-m-d 00:00:00'));
    $this->db->where('a.tgl_masuk <=', date('Y-m-d 23:59:59'));

    $query = $this->db->get();
    $total_penjualan = $query->row()->total_penjualan ?? 0;

    return "Rp. " . number_format($total_penjualan, 0, ',', '.');
}


    // public function get_total_penjualan_detail() {
    //     $this->db->select('a.create_masuk, SUM(
    //         CASE 
    //             WHEN a.kd_kendaraan = "JK003" THEN 0 
    //             ELSE b.harga_kendaraan 
    //         END + (a.jml_org * 2000)
    //     ) AS total_penjualan');
        
    //     $this->db->from('tbl_masuk a');
    //     $this->db->join('tbl_kendaraan b', 'a.kd_kendaraan = b.kd_kendaraan', 'left');
    //     $this->db->where('DATE_FORMAT(a.tgl_masuk, "%Y-%m-%d") = CURDATE()', false, false);
    //     $this->db->group_by('a.create_masuk');
    //     $query = $this->db->get();
    //     $total_penjualan = $query->row()->total_penjualan ?? 0; // Pastikan tidak null
    
    //     // Format output dengan "Rp" dan pemisah ribuan
    //     return "Rp. " . number_format($total_penjualan, 0, ',', '.');
    // }
    
    public function get_total_penjualan_detail() {

    $this->db->select('
        a.create_masuk,
        SUM(
            CASE 
                WHEN a.kd_kendaraan = "JK003" THEN 0 
                ELSE b.harga_kendaraan 
            END + (a.jml_org * 2000)
        ) AS total_penjualan
    ', false);

    $this->db->from('tbl_masuk a');
    $this->db->join('tbl_kendaraan b', 'a.kd_kendaraan = b.kd_kendaraan', 'left');

    // FILTER HARI INI (RANGE WAKTU)
    $this->db->where('a.tgl_masuk >=', date('Y-m-d 00:00:00'));
    $this->db->where('a.tgl_masuk <=', date('Y-m-d 23:59:59'));

    $this->db->group_by('a.create_masuk');

    return $this->db->get()->result_array();
}

    
    // Fungsi untuk mendapatkan Total Keuntungan (asumsi: keuntungan sama dengan total penjualan)
    // public function get_total_keuntungan() {
    //     $this->db->select('sum(harga_kendaraan * jml_org) as total_keuntungan');
    //     $this->db->from('tbl_kendaraan');
    //     $this->db->join('tbl_masuk', 'tbl_kendaraan.kd_kendaraan = tbl_masuk.kd_kendaraan');
    //     $this->db->where('DATE_FORMAT(tgl_masuk, "%Y-%m-%d")=', 'CURDATE()', false);
    //     $query = $this->db->get();
    //     return $query->row()->total_keuntungan;
    // }

    public function get_total_keuntungan() {

    $this->db->select('SUM(b.harga_kendaraan * a.jml_org) AS total_keuntungan', false);
    $this->db->from('tbl_masuk a');
    $this->db->join('tbl_kendaraan b', 'a.kd_kendaraan = b.kd_kendaraan');

    // FILTER HARI INI (RANGE WAKTU)
    $this->db->where('a.tgl_masuk >=', date('Y-m-d 00:00:00'));
    $this->db->where('a.tgl_masuk <=', date('Y-m-d 23:59:59'));

    $query = $this->db->get();
    return $query->row()->total_keuntungan ?? 0;
}


    // Fungsi untuk mendapatkan Jumlah Mobil yang Masuk
    // public function get_jumlah_mobil() {
    //     $this->db->select('COUNT(nama_kendaraan) as jumlah_mobil');
    //     $this->db->from('tbl_masuk a');
    //     $this->db->join('tbl_kendaraan b', 'a.kd_kendaraan = b.kd_kendaraan', 'left');
    //     $this->db->where('a.kd_kendaraan', 'JK002');
    //     $this->db->where('DATE_FORMAT(a.tgl_masuk, "%Y-%m-%d") = CURDATE()', false, false);
        
    //     $query = $this->db->get();
    //     $jumlah_mobil = $query->row()->jumlah_mobil ?? 0; // Pastikan tidak null
    
    //     // Hitung total biaya (misalnya Rp. 5.000 per mobil)
    //     $harga_per_mobil = 5000;
    //     $total_harga = $jumlah_mobil * $harga_per_mobil;
    
    //     // Format output dalam bentuk yang diminta
    //     return $jumlah_mobil . "xRp. " . number_format($harga_per_mobil, 0, ',', '.') . " = Rp. " . number_format($total_harga, 0, ',', '.');
    // }
    
    public function get_jumlah_mobil() {

    $this->db->select('COUNT(*) AS jumlah_mobil', false);
    $this->db->from('tbl_masuk a');
    $this->db->where('a.kd_kendaraan', 'JK002');
    $this->db->where('a.tgl_masuk >=', date('Y-m-d 00:00:00'));
    $this->db->where('a.tgl_masuk <=', date('Y-m-d 23:59:59'));

    $query = $this->db->get();
    $jumlah = $query->row()->jumlah_mobil ?? 0;

    $harga = 5000;
    $total = $jumlah * $harga;

    return $jumlah . " x Rp. " . number_format($harga, 0, ',', '.') .
           " = Rp. " . number_format($total, 0, ',', '.');
}


    // Fungsi untuk mendapatkan Jumlah Motor yang Masuk
    // public function get_jumlah_motor() {
    //     $this->db->select('COUNT(nama_kendaraan) as jumlah_motor');
    //     $this->db->from('tbl_masuk a');
    //     $this->db->join('tbl_kendaraan b', 'a.kd_kendaraan = b.kd_kendaraan', 'left');
    //     $this->db->where('a.kd_kendaraan', 'JK001');
    //     $this->db->where('DATE_FORMAT(a.tgl_masuk, "%Y-%m-%d") = CURDATE()', false, false);
        
    //     $query = $this->db->get();
    //     $jumlah_motor = $query->row()->jumlah_motor ?? 0; // Pastikan tidak null
    
    //     // Hitung total biaya (misalnya Rp. 2.000 per motor)
    //     $harga_per_motor = 3000;
    //     $total_harga = $jumlah_motor * $harga_per_motor;
    
    //     // Format output dalam bentuk yang diminta
    //     return $jumlah_motor . "xRp. " . number_format($harga_per_motor, 0, ',', '.') . " = Rp. " . number_format($total_harga, 0, ',', '.');
    // }

    public function get_jumlah_motor() {

    $this->db->select('COUNT(*) AS jumlah_motor', false);
    $this->db->from('tbl_masuk a');
    $this->db->where('a.kd_kendaraan', 'JK001');
    $this->db->where('a.tgl_masuk >=', date('Y-m-d 00:00:00'));
    $this->db->where('a.tgl_masuk <=', date('Y-m-d 23:59:59'));

    $query = $this->db->get();
    $jumlah = $query->row()->jumlah_motor ?? 0;

    $harga = 3000;
    $total = $jumlah * $harga;

    return $jumlah . " x Rp. " . number_format($harga, 0, ',', '.') .
           " = Rp. " . number_format($total, 0, ',', '.');
}

    

    // Fungsi untuk mendapatkan Jumlah Orang
    // public function get_jumlah_orang() {
    //     $this->db->select_sum('jml_org', 'jumlah_orang');
    //     $this->db->from('tbl_masuk a');
    //     $this->db->where('DATE_FORMAT(a.tgl_masuk, "%Y-%m-%d") = CURDATE()', false, false);
        
    //     $query = $this->db->get();
    //     $jumlah_orang = $query->row()->jumlah_orang ?? 0; // Pastikan tidak null
    
    //     // Hitung total biaya (misalnya Rp. 10.000 per orang)
    //     $harga_per_orang = 2000;
    //     $total_harga = $jumlah_orang * $harga_per_orang;
    
    //     // Format output dalam bentuk yang diminta
    //     return $jumlah_orang . "xRp. " . number_format($harga_per_orang, 0, ',', '.') . " = Rp. " . number_format($total_harga, 0, ',', '.');
    // }
    
    public function get_jumlah_orang() {

        $this->db->select('SUM(jml_org) AS jumlah_orang', false);
        $this->db->from('tbl_masuk a');
        $this->db->where('a.tgl_masuk >=', date('Y-m-d 00:00:00'));
        $this->db->where('a.tgl_masuk <=', date('Y-m-d 23:59:59'));

        $query = $this->db->get();
        $jumlah = $query->row()->jumlah_orang ?? 0;

        $harga = 2000;
        $total = $jumlah * $harga;

        return $jumlah . " x Rp. " . number_format($harga, 0, ',', '.') .
            " = Rp. " . number_format($total, 0, ',', '.');
    }

}
