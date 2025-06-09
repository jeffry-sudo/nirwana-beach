<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Parkir</title>
    <style>
        /* Ukuran kertas thermal 80mm */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            width: 58mm; /* Lebar kertas thermal */
        }
        .ticket {
            width: 100%; /* Sesuaikan dengan lebar kertas */
            padding: 5mm; /* Padding sekitar konten */
            box-sizing: border-box;
            text-align: center;
        }
        .ticket h1 {
            font-size: 18px;
            margin-bottom: 5px;
        }
        .ticket h2 {
            font-size: 14px;
            margin: 0;
        }
        .ticket p {
            font-size: 10px;
            line-height: 1.4;
            margin: 2px 0;
        }
        .ticket .barcode {
            margin: 10px 0;
        }
        .separator {
            margin: 10px 0;
            border-top: 1px dashed #000;
        }
    </style>
</head>
<body>
    <?php
    // Simulasi data
    $tipe = [
        'kd_kendaraan' => $tipe['kd_kendaraan'],
        'nama_kendaraan' => $tipe['nama_kendaraan']
    ];
    $cetak = [
        'create_keluar' => $cetak['create_keluar'],
        'tgl_jam_masuk' => $cetak['tgl_jam_masuk'],
        'tgl_jam_keluar' => $cetak['tgl_jam_keluar'],
        'lama_parkir_keluar' => $cetak['lama_parkir_keluar'],
        'total_keluar' => $cetak['total_keluar']
    ];
    ?>
    <div class="ticket">
        <!-- Nama Toko -->
        <h2>KOPERASI JASA NIRWANA MAHADA GROUP</h2>
        <p>AHU-0011146.AH.01.26.TAHUN 2021</p>
        <div class="separator"></div>
        <!-- Informasi Kendaraan -->
        <p><strong><?= $tipe['kd_kendaraan']; ?> / <?= strtoupper($tipe['nama_kendaraan']); ?></strong></p>

        <!-- Informasi Penjaga dan Waktu -->
        <p>Penjaga: <?= $cetak['create_keluar']; ?></p>
        <p>Masuk: <?= $cetak['tgl_jam_masuk']; ?></p>
        <p>Keluar: <?= $cetak['tgl_jam_keluar']; ?></p>
        <p>Lama Parkir: <?= $cetak['lama_parkir_keluar']; ?></p>
        <div class="separator"></div>

        <!-- Biaya Parkir -->
        <p><strong>Sewa Parkir:</strong> Rp <?= $cetak['total_keluar']; ?></p>
        <div class="separator"></div>

        <!-- Ucapan Terima Kasih -->
        <p class="footer">TERIMA KASIH ATAS KUNJUNGAN ANDA</p>
        <p class="footer">--------------------------------</p>
    </div>
    <script>
        // Cetak otomatis ketika halaman dimuat
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
