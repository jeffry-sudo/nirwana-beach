<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 text-slate-900">
    <div class="max-w-4xl mx-auto p-6">
        <div class="mb-6 rounded-3xl bg-white p-6 shadow-lg">
            <h1 class="text-3xl font-semibold"><?php echo $title; ?></h1>
            <p class="mt-2 text-slate-600">Shift: <?php echo $schedule['kd_shift']; ?> — Lokasi: <?php echo $schedule['nama_lokasi']; ?></p>
            <p class="mt-2 text-slate-600">Pastikan GPS dan kamera diaktifkan. Lokasi valid jika berada dalam radius <?php echo $schedule['radius_meter'] ?? 'lokasi'; ?> meter.</p>
            <div class="mt-4 flex flex-wrap gap-3">
                <a href="<?php echo site_url('attendance'); ?>" class="inline-flex items-center justify-center rounded-xl bg-slate-200 px-4 py-2 text-slate-700 transition hover:bg-slate-300">Kembali ke Halaman Absensi</a>
                <a href="<?php echo site_url('home'); ?>" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2 text-white transition hover:bg-indigo-700">Menu Utama</a>
            </div>
            <p class="mt-3 text-sm text-slate-500">Foto harus diambil langsung dari kamera perangkat. Upload dari galeri tidak diperbolehkan.</p>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <div class="rounded-3xl bg-white p-6 shadow-lg">
                <div class="relative mb-4 overflow-hidden rounded-3xl border border-slate-200 bg-black">
                    <video id="video" class="h-72 w-full object-cover" autoplay muted playsinline></video>
                    <div class="pointer-events-none absolute inset-0 border-2 border-dashed border-slate-300"></div>
                </div>

                <div class="flex flex-col gap-3">
                    <button id="captureButton" class="rounded-2xl bg-indigo-600 px-4 py-3 text-white transition hover:bg-indigo-700">Ambil Foto</button>
                    <button id="submitButton" disabled class="rounded-2xl bg-emerald-600 px-4 py-3 text-white transition hover:bg-emerald-700">Kirim Scan</button>
                    <p id="statusText" class="text-sm text-slate-600"></p>
                    <div id="locationHelper" class="mt-3 hidden rounded-2xl border border-amber-300 bg-amber-50 p-4 text-amber-900">
                        <p id="locationHelperText" class="text-sm"></p>
                        <div class="mt-3 flex flex-wrap gap-2">
                            <button id="retryLocationButton" type="button" class="inline-flex items-center justify-center rounded-xl bg-white border border-amber-300 px-4 py-2 text-amber-900 transition hover:bg-amber-100">Coba Lagi Lokasi</button>
                            <button id="openHelpButton" type="button" class="inline-flex items-center justify-center rounded-xl bg-amber-600 px-4 py-2 text-white transition hover:bg-amber-700">Cara Izinkan Lokasi</button>
                        </div>
                    </div>
                    <p class="text-sm text-rose-600">Catatan: Tidak ada opsi upload galeri. Foto harus diambil langsung dari kamera.</p>
                </div>
            </div>

            <div class="rounded-3xl bg-white p-6 shadow-lg">
                <h2 class="text-xl font-semibold">Detail Scan</h2>
                <ul class="mt-4 space-y-3 text-slate-700">
                    <li><strong>Tahap:</strong> <?php echo ucfirst($stage); ?></li>
                    <li><strong>Jam mulai:</strong> <?php echo date('H:i', strtotime($schedule['jam_mulai'])); ?></li>
                    <li><strong>Jam selesai:</strong> <?php echo date('H:i', strtotime($schedule['jam_selesai'])); ?></li>
                    <li><strong>Lokasi:</strong> <?php echo $schedule['nama_lokasi']; ?></li>
                </ul>
                <div class="mt-6 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <p class="font-medium">Panduan:</p>
                    <ol class="mt-3 list-decimal space-y-2 pl-5 text-slate-600">
                        <li>Pastikan akses kamera dan lokasi diizinkan.</li>
                        <li>Pilih lokasi yang sesuai dan ambil foto wajah / kondisi sekeliling.</li>
                        <li>Kirim scan saat tombol sudah aktif.</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="mt-6 rounded-3xl bg-white p-6 shadow-lg">
            <h2 class="text-xl font-semibold">Preview Foto</h2>
            <div class="mt-4 rounded-3xl border border-slate-200 bg-slate-100 p-4 text-center">
                <canvas id="previewCanvas" class="mx-auto h-72 w-full max-w-full rounded-3xl bg-black"></canvas>
            </div>
        </div>
    </div>

    <script>
        const video = document.getElementById('video');
        const captureButton = document.getElementById('captureButton');
        const submitButton = document.getElementById('submitButton');
        const statusText = document.getElementById('statusText');
        const locationHelper = document.getElementById('locationHelper');
        const locationHelperText = document.getElementById('locationHelperText');
        const retryLocationButton = document.getElementById('retryLocationButton');
        const openHelpButton = document.getElementById('openHelpButton');
        const previewCanvas = document.getElementById('previewCanvas');
        const previewContext = previewCanvas.getContext('2d');
        let capturedData = null;
        let currentPosition = null;

        async function startCamera() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' }, audio: false });
                video.srcObject = stream;
                await video.play();
            } catch (error) {
                setStatus('Tidak dapat mengakses kamera. Pastikan izin kamera diberikan.', true);
            }
        }

        function showLocationHelper(message) {
            locationHelperText.textContent = message;
            locationHelper.classList.remove('hidden');
        }

        function hideLocationHelper() {
            locationHelper.classList.add('hidden');
            locationHelperText.textContent = '';
        }

        function refreshLocation() {
            if (!navigator.geolocation) {
                setStatus('Geolocation tidak didukung oleh browser ini.', true);
                showLocationHelper('Gunakan browser modern dengan dukungan lokasi, dan jalankan dari koneksi HTTPS.');
                return;
            }

            setStatus('Mencari lokasi perangkat...', false);
            hideLocationHelper();

            navigator.geolocation.getCurrentPosition((position) => {
                currentPosition = position.coords;
                setStatus(`Lokasi ditemukan: ${currentPosition.latitude.toFixed(6)}, ${currentPosition.longitude.toFixed(6)}.`, false);
            }, (error) => {
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        setStatus('Izin lokasi ditolak. Absensi tidak dapat dilanjutkan tanpa izin GPS.', true);
                        showLocationHelper('Klik Izinkan Lokasi di browser Anda, lalu muat ulang halaman. Jika sudah ditolak, buka pengaturan situs di browser dan aktifkan lokasi untuk alamat ini.');
                        break;
                    case error.POSITION_UNAVAILABLE:
                        setStatus('Lokasi perangkat tidak tersedia. Pastikan GPS aktif atau berada di area terbuka.', true);
                        showLocationHelper('Coba lagi di area yang lebih terbuka atau dekat jendela, lalu tekan "Coba Lagi Lokasi".');
                        break;
                    case error.TIMEOUT:
                        setStatus('Permintaan lokasi timeout. Coba lagi.', true);
                        showLocationHelper('Tekan tombol "Coba Lagi Lokasi" untuk mencoba kembali.');
                        break;
                    default:
                        setStatus('Gagal mengambil lokasi. Pastikan izin lokasi sudah diberikan.', true);
                        showLocationHelper('Periksa izin lokasi di browser dan coba lagi.');
                        break;
                }
            }, { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 });
        }

        function setStatus(message, isError = false) {
            statusText.textContent = message;
            statusText.classList.toggle('text-rose-600', isError);
            statusText.classList.toggle('text-slate-600', !isError);
        }

        captureButton.addEventListener('click', () => {
            if (!video.videoWidth || !video.videoHeight) {
                setStatus('Kamera belum siap. Tunggu sebentar.', true);
                return;
            }
            previewCanvas.width = video.videoWidth;
            previewCanvas.height = video.videoHeight;
            previewContext.drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
            capturedData = previewCanvas.toDataURL('image/jpeg', 0.82);
            submitButton.disabled = false;
            setStatus('Foto berhasil diambil. Siap untuk dikirim.', false);
        });

        retryLocationButton.addEventListener('click', () => {
            refreshLocation();
        });

        openHelpButton.addEventListener('click', () => {
            showLocationHelper('Jika izin lokasi belum aktif, buka ikon gembok di address bar browser Anda, set Location/Lokasi menjadi Allow/Izinkan, lalu muat ulang halaman.');
        });

        submitButton.addEventListener('click', async () => {
            if (!capturedData || !currentPosition) {
                setStatus('Pastikan Anda sudah mengambil foto dan GPS aktif.', true);
                return;
            }

            submitButton.disabled = true;
            statusText.textContent = 'Mengirim scan...';

            const formData = new FormData();
            formData.append('stage', '<?php echo $stage; ?>');
            formData.append('latitude', currentPosition.latitude);
            formData.append('longitude', currentPosition.longitude);
            formData.append('photo', capturedData);

            try {
                const response = await fetch('<?php echo base_url('attendance/submit_scan'); ?>', {
                    method: 'POST',
                    body: formData,
                });
                const result = await response.json();
                if (result.success) {
                    setStatus(result.message, false);
                    window.location.href = '<?php echo site_url('attendance'); ?>';
                } else {
                    setStatus(result.message, true);
                    submitButton.disabled = false;
                }
            } catch (error) {
                setStatus('Gagal mengirim scan. Coba lagi.', true);
                submitButton.disabled = false;
            }
        });

        startCamera();
        refreshLocation();
    </script>
</body>
</html>
