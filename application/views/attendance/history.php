<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 text-slate-900">
    <div class="max-w-6xl mx-auto p-6">
        <div class="mb-6 rounded-2xl bg-white p-6 shadow-md">
            <h1 class="text-3xl font-semibold"><?php echo $title; ?></h1>
            <p class="mt-2 text-slate-600">Riwayat absensi Anda berdasarkan jadwal yang tercatat.</p>
            <div class="mt-4 flex flex-wrap gap-3">
                <a href="<?php echo site_url('attendance'); ?>" class="inline-flex items-center justify-center rounded-xl bg-slate-200 px-4 py-2 text-slate-700 transition hover:bg-slate-300">Kembali ke Absensi</a>
                <a href="<?php echo site_url('home'); ?>" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2 text-white transition hover:bg-indigo-700">Dashboard</a>
            </div>
        </div>

        <div class="overflow-x-auto rounded-2xl bg-white p-6 shadow-sm">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="px-4 py-3 text-left font-medium">No</th>
                        <th class="px-4 py-3 text-left font-medium">Tanggal</th>
                        <th class="px-4 py-3 text-left font-medium">Shift</th>
                        <th class="px-4 py-3 text-left font-medium">Lokasi</th>
                        <th class="px-4 py-3 text-left font-medium">Rekap Kehadiran</th>
                        <th class="px-4 py-3 text-left font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    <?php if (empty($history)): ?>
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-slate-500">Belum ada riwayat absensi.</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($history as $row): ?>
                            <tr>
                                <td class="px-4 py-3"><?php echo $no++; ?></td>
                                <td class="px-4 py-3"><?php echo $row['tanggal']; ?></td>
                                <td class="px-4 py-3"><?php echo $row['nama_shift']; ?></td>
                                <td class="px-4 py-3"><?php echo $row['nama_lokasi']; ?></td>
                                <td class="px-4 py-3"><?php echo $row['rekap_kehadiran']; ?></td>
                                <td class="px-4 py-3">
                                    <?php if (!empty($row['kd_absensi'])): ?>
                                        <a href="<?php echo site_url('attendance/history_detail/' . $row['kd_absensi']); ?>" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-3 py-2 text-white transition hover:bg-indigo-700">Detail</a>
                                    <?php else: ?>
                                        <span class="inline-flex items-center justify-center rounded-xl bg-slate-200 px-3 py-2 text-slate-600">Belum</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
