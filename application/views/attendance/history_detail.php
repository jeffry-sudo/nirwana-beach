<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 text-slate-900">
    <div class="max-w-5xl mx-auto p-6">
        <div class="mb-6 rounded-2xl bg-white p-6 shadow-md">
            <h1 class="text-3xl font-semibold"><?php echo $title; ?></h1>
            <p class="mt-2 text-slate-600">Detail absensi untuk kode <?php echo $attendance['kd_absensi']; ?>.</p>
            <div class="mt-4 flex flex-wrap gap-3">
                <a href="<?php echo site_url('attendance/history'); ?>" class="inline-flex items-center justify-center rounded-xl bg-slate-200 px-4 py-2 text-slate-700 transition hover:bg-slate-300">Kembali ke History</a>
                <a href="<?php echo site_url('attendance'); ?>" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2 text-white transition hover:bg-indigo-700">Halaman Absensi</a>
            </div>
        </div>

        <div class="grid gap-4 lg:grid-cols-2">
            <div class="rounded-2xl bg-white p-6 shadow-sm">
                <h2 class="text-xl font-semibold">Informasi Absensi</h2>
                <div class="mt-4 space-y-3 text-slate-700">
                    <p><strong>Tanggal:</strong> <?php echo $attendance['tanggal']; ?></p>
                    <p><strong>Shift:</strong> <?php echo $attendance['nama_shift']; ?></p>
                    <p><strong>Lokasi:</strong> <?php echo $attendance['nama_lokasi']; ?></p>
                    <p><strong>Status Kehadiran:</strong> <?php echo !empty($attendance['status_kehadiran']) ? ucfirst($attendance['status_kehadiran']) : 'Belum Absen'; ?></p>
                    <?php if (!empty($attendance['reason_incomplete'])): ?>
                        <p><strong>Alasan Tidak Hadir:</strong><br><?php echo nl2br(htmlspecialchars($attendance['reason_incomplete'], ENT_QUOTES, 'UTF-8')); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="rounded-2xl bg-white p-6 shadow-sm">
                <h2 class="text-xl font-semibold">Ringkasan Scan</h2>
                <?php if (empty($scans)): ?>
                    <p class="mt-4 text-slate-600">Belum ada scan untuk absensi ini.</p>
                <?php else: ?>
                    <div class="mt-4 space-y-4">
                        <?php foreach ($scans as $scan): ?>
                            <div class="rounded-2xl border border-slate-200 p-4">
                                <p><strong>Tahap:</strong> <?php echo ucfirst($scan['stage']); ?></p>
                                <p><strong>Waktu Scan:</strong> <?php echo $scan['waktu_scan']; ?></p>
                                <p><strong>Jarak:</strong> <?php echo $scan['jarak_meter']; ?> meter</p>
                                <p><strong>Status:</strong> <?php echo $scan['status_valid'] ? 'Valid' : 'Tidak valid'; ?></p>
                                <p><strong>Pesan:</strong> <?php echo $scan['message']; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
