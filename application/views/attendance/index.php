<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="min-h-screen bg-slate-100 text-slate-900">
    <div class="max-w-5xl mx-auto p-6">
        <div class="mb-6 rounded-2xl bg-white p-6 shadow-md">
            <h1 class="text-3xl font-semibold">Absensi Karyawan</h1>
            <p class="mt-2 text-slate-600">Halo, <?php echo $this->session->userdata('nama_admin'); ?>.</p>
            <div class="mt-4 flex flex-wrap gap-3">
                <a href="<?php echo site_url('home'); ?>" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2 text-white transition hover:bg-indigo-700">Menu Utama</a>
                <a href="<?php echo site_url('attendance'); ?>" class="inline-flex items-center justify-center rounded-xl bg-slate-200 px-4 py-2 text-slate-700 transition hover:bg-slate-300">Halaman Absensi</a>
                <a href="<?php echo site_url('attendance/history'); ?>" class="inline-flex items-center justify-center rounded-xl bg-slate-200 px-4 py-2 text-slate-700 transition hover:bg-slate-300">History Absensi</a>
            </div>
            <div class="mt-4 rounded-xl border border-slate-200 bg-slate-50 p-4">
                <p class="text-slate-700"><?php echo $summary['text']; ?></p>
            </div>
            <div class="mt-4 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h2 class="text-lg font-semibold">Status Absensi Hari Ini</h2>
                <?php if (count($scan_status) === 0): ?>
                    <p class="mt-2 text-slate-700">Anda belum melakukan absensi hari ini.</p>
                <?php else: ?>
                    <p class="mt-2 text-slate-700">Anda sudah melakukan absensi pada tahap berikut:</p>
                    <ul class="mt-3 list-disc pl-5 space-y-1 text-slate-700">
                        <?php foreach ($scan_status as $scan): ?>
                            <li><?php echo ucfirst($scan['stage']); ?> - <?php echo $scan['status_valid'] ? 'Valid' : 'Tidak valid'; ?> (<?php echo $scan['jarak_meter']; ?> m)</li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <?php if (!empty($attendance) && !empty($attendance['reason_incomplete'])): ?>
                    <div class="mt-4 rounded-2xl border border-rose-200 bg-rose-50 p-4 text-rose-700">
                        <h3 class="text-base font-semibold">Alasan Tidak Hadir</h3>
                        <p class="mt-2 whitespace-pre-line"><?php echo htmlspecialchars($attendance['reason_incomplete'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!empty($schedules)): ?>
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex flex-wrap gap-2">
                    <?php foreach ($schedules as $index => $item):
                        $schedule = $item['schedule'];
                    ?>
                        <button type="button" class="shift-tab-btn rounded-xl px-4 py-2 text-sm font-semibold transition <?php echo $index === 0 ? 'bg-indigo-600 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'; ?>" data-target="shift-panel-<?php echo (int)$schedule['id']; ?>">
                            Shift <?php echo htmlspecialchars($schedule['kd_shift'], ENT_QUOTES, 'UTF-8'); ?>
                            <span class="ml-1 text-xs opacity-80">(<?php echo date('H:i', strtotime($schedule['jam_mulai'])); ?> - <?php echo date('H:i', strtotime($schedule['jam_selesai'])); ?>)</span>
                        </button>
                    <?php endforeach; ?>
                </div>

                <div class="mt-4 space-y-4">
                    <?php foreach ($schedules as $index => $item):
                        $schedule = $item['schedule'];
                        $scan_status = $item['scan_status'];
                        $available_stage = $item['available_stage'];
                    ?>
                        <section id="shift-panel-<?php echo (int)$schedule['id']; ?>" class="shift-tab-panel rounded-2xl border border-slate-200 bg-slate-50 p-5 <?php echo $index === 0 ? 'block' : 'hidden'; ?>">
                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <div>
                                    <h2 class="text-xl font-semibold">Shift <?php echo htmlspecialchars($schedule['kd_shift'], ENT_QUOTES, 'UTF-8'); ?></h2>
                                    <p class="mt-1 text-slate-600"><?php echo htmlspecialchars($schedule['nama_lokasi'] ?? '-', ENT_QUOTES, 'UTF-8'); ?> · <?php echo date('H:i', strtotime($schedule['jam_mulai'])); ?> - <?php echo date('H:i', strtotime($schedule['jam_selesai'])); ?></p>
                                </div>
                                <span class="rounded-full bg-emerald-100 px-3 py-1 text-sm font-semibold text-emerald-700"><?php echo $item['summary']['completed'] ? 'Absensi lengkap' : 'Dalam proses'; ?></span>
                            </div>
                            <p class="mt-3 text-slate-700"><?php echo $item['summary']['text']; ?></p>

                            <div class="mt-4 grid gap-4 lg:grid-cols-3">
                                <?php
                                    $stageLabels = array(
                                        'masuk' => 'Absensi Masuk',
                                        'tengah' => 'Absensi Tengah',
                                        'pulang' => 'Absensi Pulang',
                                    );
                                    foreach ($allowed_stages as $stageKey):
                                        $label = isset($stageLabels[$stageKey]) ? $stageLabels[$stageKey] : ucfirst($stageKey);
                                ?>
                                    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                                        <h3 class="text-lg font-medium"><?php echo $label; ?></h3>
                                        <p class="mt-2 text-slate-600">Status:
                                            <?php
                                                $found = false;
                                                foreach ($scan_status as $scan) {
                                                    if ($scan['stage'] === $stageKey) {
                                                        echo $scan['status_valid'] ? '<span class="text-emerald-600">Tervalidasi</span>' : '<span class="text-amber-600">Tidak valid</span>';
                                                        $found = true;
                                                        break;
                                                    }
                                                }
                                                if (!$found) {
                                                    echo '<span class="text-slate-500">Belum</span>';
                                                }
                                            ?>
                                        </p>
                                        <div class="mt-4">
                                            <?php if ($available_stage === $stageKey): ?>
                                                <a href="<?php echo site_url('attendance/capture/' . $stageKey . '/' . (int)$schedule['id']); ?>" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2 text-white transition hover:bg-indigo-700">Lanjutkan</a>
                                            <?php else: ?>
                                                <button disabled class="inline-flex items-center justify-center rounded-xl bg-slate-200 px-4 py-2 text-slate-500">Tidak tersedia</button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </section>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="rounded-2xl border border-rose-200 bg-rose-50 p-5 text-rose-700">
                Jadwal shift belum diatur untuk hari ini. Silakan minta admin untuk menambahkan jadwal di menu <strong>Admin &gt; Jadwal Shift</strong>.
            </div>
        <?php endif; ?>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const flashError = <?php echo json_encode($this->session->flashdata('error')); ?>;
                const flashSuccess = <?php echo json_encode($this->session->flashdata('success')); ?>;

                if (flashError) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Perhatian',
                        text: flashError,
                        confirmButtonColor: '#4f46e5'
                    });
                }

                if (flashSuccess) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: flashSuccess,
                        confirmButtonColor: '#4f46e5'
                    });
                }

                const buttons = document.querySelectorAll('.shift-tab-btn');
                const panels = document.querySelectorAll('.shift-tab-panel');

                buttons.forEach(function (button) {
                    button.addEventListener('click', function () {
                        const target = this.getAttribute('data-target');

                        buttons.forEach(function (item) {
                            item.classList.remove('bg-indigo-600', 'text-white');
                            item.classList.add('bg-slate-100', 'text-slate-700');
                        });

                        this.classList.remove('bg-slate-100', 'text-slate-700');
                        this.classList.add('bg-indigo-600', 'text-white');

                        panels.forEach(function (panel) {
                            panel.classList.toggle('hidden', panel.id !== target);
                            panel.classList.toggle('block', panel.id === target);
                        });
                    });
                });
            });
        </script>

        <div class="mt-6 rounded-2xl bg-white p-5 shadow-sm">
            <h2 class="text-xl font-semibold">Ringkasan Scan</h2>
            <?php if (count($scan_status) === 0): ?>
                <p class="mt-3 text-slate-600">Belum ada scan hari ini.</p>
            <?php else: ?>
                <div class="mt-3 space-y-3">
                    <?php foreach ($scan_status as $scan): ?>
                        <div class="rounded-2xl border border-slate-200 p-4">
                            <p><strong>Tahap:</strong> <?php echo ucfirst($scan['stage']); ?></p>
                            <p><strong>Waktu:</strong> <?php echo $scan['waktu_scan']; ?></p>
                            <p><strong>Jarak:</strong> <?php echo $scan['jarak_meter']; ?> meter</p>
                            <p><strong>Status:</strong> <?php echo $scan['status_valid'] ? 'Valid' : 'Tidak valid'; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
