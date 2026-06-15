<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Parkir</title>
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
            padding: 0; /* Padding sekitar konten */
            box-sizing: border-box;
            text-align: center;
        }
        .ticket h1 {
            font-size: 16px;
            margin-bottom: 5px;
        }
        .ticket h2 {
            font-size: 12px;
            margin: 0;
        }
        .ticket p {
            font-size: 10px;
            line-height: 1.4;
            margin: 2px 0;
        }
        .ticket .barcode {
            margin: 5px 0;
        }
        .separator {
            margin: 5px 0;
            border-top: 1px dashed #000;
        }
    </style>
</head>
<body>
    <?php
    // Data tiket
    $cetak = [
        'kd_masuk' => $cetak['kd_masuk'], // Contoh kode masuk
        'tgl_masuk' => $cetak['tgl_masuk'], // Tanggal masuk
        'nama_kendaraan' => $cetak['nama_kendaraan'], // Tanggal masuk
        'jml_org' => $cetak['jml_org'], // Tanggal masuk
        'harga_kendaraan' => $cetak['harga_kendaraan'], // Tanggal masuk
    ];

    // Data tambahan
    $jumlahOrang = $cetak['jml_org']; // Jumlah orang
    $jumlahMotor = 1; // Jumlah motor
    $hargaPerOrang = 2000; // Harga per orang
    $hargaPerMotor = $cetak['harga_kendaraan']; // Harga per motor
    // $totalHarga = ($jumlahOrang * $hargaPerOrang) + ($jumlahMotor * $hargaPerMotor); // Total harga

    if ($cetak['nama_kendaraan'] === 'Pejalan Kaki') {
        $totalHarga = $jumlahOrang * $hargaPerOrang; // Hanya hitung orang
        $jumlahMotor = 0; // Tidak ada motor
    } else {
        $totalHarga = ($jumlahOrang * $hargaPerOrang) + ($jumlahMotor * $hargaPerMotor); // Hitung orang dan motor
    }

    ?>
    <div class="ticket">
        <!-- Header -->
        <!-- <h2>KOPERASI JASA <br>NIRWANA MAHADA GROUP</h2>
        <p>AHU-0011146.AH.01.26.TAHUN 2021</p> -->
        <div class="separator"></div>
        <h2>KARCIS MASUK</h2>
        <p>KAWASAN WISATA PANTAI NIRWANA</p>
        <p><strong>Tanggal Masuk:</strong> <?= $cetak['tgl_masuk']; ?></p>
        <div class="separator"></div>
        
        <!-- Data Jumlah Orang dan Motor -->
        <!-- Data Jumlah Orang dan Motor -->
       
        <!-- Barcode -->
       <!-- Barcode -->
        <div class="barcode">
            <img src="https://barcode.tec-it.com/barcode.ashx?data=<?= urlencode($cetak['kd_masuk']); ?>&code=Code128&dpi=180&width=180&height=70" alt="Barcode" style="max-width: 100%; height: auto; display: block; margin: 0 auto;">
        </div>

         <p><strong>Jumlah Orang:</strong> <?= $jumlahOrang; ?> x Rp <?= number_format($hargaPerOrang, 0, ',', '.'); ?></p>

        <!-- Tampilkan jumlah motor hanya jika bukan Pejalan Kaki -->
        <?php if ($jumlahMotor > 0): ?>
        <p><strong>Parkir <?= $cetak['nama_kendaraan']; ?>:</strong> <?= $jumlahMotor; ?> x Rp <?= number_format($hargaPerMotor, 0, ',', '.'); ?></p>
        <?php endif; ?>

        <h1><strong>Total Harga:</strong> Rp <?= number_format($totalHarga, 0, ',', '.'); ?></h1>
        <div class="separator"></div>


        <p>SIMPANLAH TIKET DENGAN AMAN</p>
        <!-- <p>KERUSAKAN DAN KEHILANGAN BARANG BUKAN TANGGUNG JAWAB PENGELOLA</p> -->
        <!-- <p>KEHILANGAN TIKET PARKIR DIKENAKAN DENDA Rp.10.000,-</p> -->
        <div class="separator"></div>
    </div>

    <script>
        window.onload = function() {
            window.print(); 
        }
    </script>

</body>
</html>
