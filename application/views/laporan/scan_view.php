<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Barcode dengan Instascan</title>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</head>
<body>

    <h2>Scan Barcode</h2>
    
    <!-- Dropdown untuk memilih kamera -->
    <label for="cameraSelect">Pilih Kamera:</label>
    <select id="cameraSelect"></select>

    <!-- Video preview dari kamera -->
    <video id="preview" style="width: 100%; max-width: 400px; border: 1px solid #000;"></video>

    <script>
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

        scanner.addListener('scan', function (content) {
            alert('Barcode Terdeteksi: ' + content);
            console.log('Hasil Scan:', content);
        });

        Instascan.Camera.getCameras().then(function (cameras) {
            let cameraSelect = document.getElementById("cameraSelect");

            if (cameras.length === 0) {
                alert("Kamera tidak ditemukan!");
            } else {
                cameras.forEach((camera, i) => {
                    let option = document.createElement("option");
                    option.value = i;
                    option.text = camera.name || `Camera ${i}`;
                    cameraSelect.appendChild(option);
                });

                // Gunakan kamera belakang jika tersedia
                let backCamera = cameras.find(cam => cam.name.toLowerCase().includes("back"));
                if (backCamera) {
                    scanner.start(backCamera);
                } else {
                    scanner.start(cameras[0]); // Gunakan kamera pertama jika kamera belakang tidak ditemukan
                }
            }

            // Jika user memilih kamera lain dari dropdown
            cameraSelect.addEventListener("change", function () {
                scanner.start(cameras[this.value]);
            });

        }).catch(function (e) {
            console.error(e);
            alert("Akses kamera ditolak! Pastikan izin kamera sudah diaktifkan.");
        });

    </script>

</body>
</html>
