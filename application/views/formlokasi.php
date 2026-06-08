<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $this->load->view('include/base_css'); ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.css" />
  <style>
    #mapLokasi { height: 420px; width: 100%; border: 1px solid #d2d6de; border-radius: 0.5rem; }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<?php $this->load->view('include/base_nav'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?php echo $title ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/lokasi') ?>">Lokasi Kerja</a></li>
            <li class="breadcrumb-item active"><?php echo $title ?></li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title"><?php echo $title ?></h3>
            </div>
            <form method="post" action="<?php echo isset($lokasi) && $lokasi ? base_url('admin/lokasi_edit/' . $lokasi['kd_lokasi']) : base_url('admin/lokasi_tambah'); ?>">
              <div class="card-body">
                <div class="form-group">
                  <label>Nama Lokasi</label>
                  <input type="text" name="nama_lokasi" class="form-control" value="<?php echo set_value('nama_lokasi', $lokasi['nama_lokasi'] ?? ''); ?>" placeholder="Loket / Pintu keluar / Pos pendakian" required>
                  <?php echo form_error('nama_lokasi', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                  <label>Latitude</label>
                  <input type="text" name="latitude" class="form-control" value="<?php echo set_value('latitude', $lokasi['latitude'] ?? ''); ?>" placeholder="-6.200000" required>
                  <?php echo form_error('latitude', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                  <label>Longitude</label>
                  <input type="text" name="longitude" class="form-control" value="<?php echo set_value('longitude', $lokasi['longitude'] ?? ''); ?>" placeholder="106.816666" required>
                  <?php echo form_error('longitude', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                  <label>Radius (meter)</label>
                  <input type="number" name="radius_meter" class="form-control" value="<?php echo set_value('radius_meter', $lokasi['radius_meter'] ?? '30'); ?>" placeholder="30" required>
                  <?php echo form_error('radius_meter', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                  <label>Pencarian Lokasi</label>
                  <div class="input-group mb-2">
                    <input type="text" id="searchLocation" class="form-control" placeholder="Cari alamat atau nama tempat...">
                    <div class="input-group-append">
                      <button type="button" id="currentLocationButton" class="btn btn-secondary">Lokasi Saat Ini</button>
                      <button type="button" id="searchButton" class="btn btn-primary">Cari</button>
                    </div>
                  </div>
                  <div id="locationStatus" class="text-sm text-muted mb-2"></div>
                  <div id="searchResults" class="list-group mb-2" style="max-height: 200px; overflow:auto;"></div>
                  <label>Map Titik Lokasi</label>
                  <div id="mapLokasi"></div>
                  <small class="form-text text-muted">Klik pada peta atau pilih hasil pencarian untuk menentukan titik lokasi.</small>
                </div>
                <a href="<?php echo base_url('admin/lokasi') ?>" class="btn btn-default">Batal</a>
                <button type="submit" class="btn btn-primary float-right">Simpan Lokasi</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php $this->load->view('include/base_footer'); ?>
<?php $this->load->view('include/base_js'); ?>
<script src="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
  const formLatitude = document.querySelector('input[name="latitude"]');
  const formLongitude = document.querySelector('input[name="longitude"]');
  const radiusField = document.querySelector('input[name="radius_meter"]');
  const hasExistingCoords = formLatitude.value.trim() !== '' && formLongitude.value.trim() !== '';
  const defaultLat = parseFloat(formLatitude.value) || -6.200000;
  const defaultLng = parseFloat(formLongitude.value) || 106.816666;
  const defaultRadius = parseInt(radiusField.value, 10) || 30;

  const map = L.map('mapLokasi').setView([defaultLat, defaultLng], 16);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);

  const marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);
  const circle = L.circle([defaultLat, defaultLng], { radius: defaultRadius, color: '#007bff', fillOpacity: 0.1 }).addTo(map);

  function updateLocation(lat, lng) {
    formLatitude.value = lat.toFixed(6);
    formLongitude.value = lng.toFixed(6);
    marker.setLatLng([lat, lng]);
    circle.setLatLng([lat, lng]);
  }

  function setInitialLocation(lat, lng) {
    updateLocation(lat, lng);
    map.setView([lat, lng], 16);
  }

  async function searchLocation(query) {
    const encoded = encodeURIComponent(query);
    const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encoded}&limit=5`;
    const response = await fetch(url, { headers: { 'Accept': 'application/json' } });
    return response.json();
  }

  function showSearchResults(results) {
    const container = document.getElementById('searchResults');
    container.innerHTML = '';
    if (!results || results.length === 0) {
      const item = document.createElement('div');
      item.className = 'list-group-item list-group-item-secondary';
      item.textContent = 'Tidak ada hasil ditemukan.';
      container.appendChild(item);
      return;
    }
    results.forEach(result => {
      const item = document.createElement('button');
      item.type = 'button';
      item.className = 'list-group-item list-group-item-action';
      item.textContent = result.display_name;
      item.addEventListener('click', function() {
        const lat = parseFloat(result.lat);
        const lon = parseFloat(result.lon);
        setInitialLocation(lat, lon);
      });
      container.appendChild(item);
    });
  }

  document.getElementById('searchButton').addEventListener('click', async function() {
    const query = document.getElementById('searchLocation').value.trim();
    if (!query) return;
    document.getElementById('searchResults').innerHTML = '<div class="list-group-item">Mencari...</div>';
    try {
      const results = await searchLocation(query);
      showSearchResults(results);
    } catch (err) {
      document.getElementById('searchResults').innerHTML = '<div class="list-group-item list-group-item-danger">Gagal mencari lokasi.</div>';
    }
  });

  document.getElementById('searchLocation').addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
      e.preventDefault();
      document.getElementById('searchButton').click();
    }
  });

  function setLocationStatus(message, isError = false) {
    const status = document.getElementById('locationStatus');
    status.textContent = message;
    status.classList.toggle('text-danger', isError);
    status.classList.toggle('text-muted', !isError);
  }

  function handleGeolocationError(error) {
    let message = 'Tidak dapat mengambil lokasi perangkat. Pastikan GPS dan izin lokasi diaktifkan.';
    if (error.code === 1) {
      message = 'Izin lokasi ditolak. Izinkan lokasi di browser untuk menggunakan fitur ini.';
    } else if (error.code === 2) {
      message = 'Lokasi tidak tersedia. Coba lagi di area dengan sinyal GPS yang lebih baik.';
    } else if (error.code === 3) {
      message = 'Waktu tunggu lokasi habis. Pastikan GPS aktif dan ulangi.';
    }
    setLocationStatus(message, true);
  }

  function locateDevice() {
    if (!navigator.geolocation) {
      setLocationStatus('Geolocation tidak didukung oleh browser ini.', true);
      return;
    }

    setLocationStatus('Mencari lokasi perangkat dengan akurasi tinggi...', false);
    let bestPosition = null;
    const maxDuration = 15000;
    const watchId = navigator.geolocation.watchPosition(function(position) {
      const accuracy = position.coords.accuracy || 0;
      const lat = position.coords.latitude;
      const lon = position.coords.longitude;
      if (!bestPosition || accuracy < bestPosition.coords.accuracy) {
        bestPosition = position;
        setInitialLocation(lat, lon);
      }
      if (accuracy <= 100) {
        setLocationStatus(`Lokasi perangkat ditemukan dengan akurasi ${accuracy.toFixed(1)}m.`, false);
        navigator.geolocation.clearWatch(watchId);
      } else {
        setLocationStatus(`Lokasi ditemukan, akurasi ${accuracy.toFixed(1)}m. Tunggu untuk hasil lebih baik atau ulangi jika perlu.`, false);
      }
    }, function(error) {
      navigator.geolocation.clearWatch(watchId);
      handleGeolocationError(error);
    }, {
      enableHighAccuracy: true,
      maximumAge: 0,
      timeout: maxDuration
    });

    setTimeout(function() {
      if (watchId !== null) {
        navigator.geolocation.clearWatch(watchId);
      }
      if (bestPosition) {
        const accuracy = bestPosition.coords.accuracy || 0;
        setLocationStatus(`Lokasi diset dengan akurasi ${accuracy.toFixed(1)}m. Jika tidak akurat, coba ulangi dan pastikan GPS/izin lokasi aktif.`, accuracy > 150);
      } else {
        setLocationStatus('Tidak dapat mengambil lokasi perangkat. Pastikan GPS dan izin lokasi diaktifkan.', true);
      }
    }, maxDuration + 500);
  }

  if (!hasExistingCoords && navigator.geolocation) {
    locateDevice();
  }

  document.getElementById('currentLocationButton').addEventListener('click', function() {
    locateDevice();
  });

  map.on('click', function(e) {
    updateLocation(e.latlng.lat, e.latlng.lng);
  });

  marker.on('dragend', function(e) {
    const pos = e.target.getLatLng();
    updateLocation(pos.lat, pos.lng);
  });

  formLatitude.addEventListener('change', function() {
    const lat = parseFloat(this.value);
    const lng = parseFloat(formLongitude.value);
    if (!Number.isNaN(lat) && !Number.isNaN(lng)) {
      updateLocation(lat, lng);
      map.setView([lat, lng], map.getZoom());
    }
  });

  formLongitude.addEventListener('change', function() {
    const lat = parseFloat(formLatitude.value);
    const lng = parseFloat(this.value);
    if (!Number.isNaN(lat) && !Number.isNaN(lng)) {
      updateLocation(lat, lng);
      map.setView([lat, lng], map.getZoom());
    }
  });

  radiusField.addEventListener('change', function() {
    const radius = parseInt(this.value, 10) || 30;
    circle.setRadius(radius);
  });
</script>
</body>
</html>