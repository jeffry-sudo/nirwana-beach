<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $this->load->view('include/base_css'); ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
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
            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/jadwal') ?>">Jadwal Shift</a></li>
            <li class="breadcrumb-item active"><?php echo $title ?></li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8">
          <div class="card card-primary">
            <div class="card-header"><h3 class="card-title">Form Jadwal</h3></div>
            <form action="<?php echo isset($jadwal) && $jadwal ? base_url('admin/jadwal_edit/' . $jadwal['id']) : base_url('admin/jadwal_tambah'); ?>" method="post">
              <div class="card-body">
                <div class="form-group">
                  <label for="kd_admin">Karyawan</label>
                  <select class="form-control select2" name="kd_admin[]" id="kd_admin" multiple="multiple" data-placeholder="-- Pilih satu atau lebih karyawan --" required>
                    <?php foreach ($admin_list as $admin) : ?>
                      <option value="<?php echo $admin['kd_admin']; ?>" <?php echo set_select('kd_admin[]', $admin['kd_admin']); ?>><?php echo $admin['nama_admin']; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <small class="form-text text-muted">Bisa pilih lebih dari satu karyawan, dan gunakan pencarian untuk mencari nama.</small>
                </div>
                <div class="form-group">
                  <label for="kd_shift">Shift</label>
                  <select class="form-control" name="kd_shift" id="kd_shift" required>
                    <option value="">-- Pilih Shift --</option>
                    <?php foreach ($shift as $item) : ?>
                      <option value="<?php echo $item['kd_shift']; ?>" <?php echo set_select('kd_shift', $item['kd_shift'], isset($jadwal['kd_shift']) && $jadwal['kd_shift'] == $item['kd_shift']); ?>><?php echo $item['nama_shift']; ?> (<?php echo $item['jam_mulai']; ?> - <?php echo $item['jam_selesai']; ?>)</option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="kd_lokasi">Lokasi</label>
                  <select class="form-control" name="kd_lokasi" id="kd_lokasi" required>
                    <option value="">-- Pilih Lokasi --</option>
                    <?php foreach ($lokasi as $item) : ?>
                      <option value="<?php echo $item['kd_lokasi']; ?>" <?php echo set_select('kd_lokasi', $item['kd_lokasi'], isset($jadwal['kd_lokasi']) && $jadwal['kd_lokasi'] == $item['kd_lokasi']); ?>><?php echo $item['nama_lokasi']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <?php if (isset($jadwal) && $jadwal) : ?>
                  <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?php echo set_value('tanggal', $jadwal['tanggal']); ?>" required>
                  </div>
                <?php else : ?>
                  <div class="form-group">
                    <label for="bulan">Bulan</label>
                    <input type="month" class="form-control" name="bulan" id="bulan" value="<?php echo set_value('bulan', date('Y-m')); ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <div id="tanggal-container" class="row gap-2"></div>
                    <?php if (!empty($date_error)) : ?>
                      <small class="text-danger"><?php echo $date_error; ?></small>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?php echo base_url('admin/jadwal'); ?>" class="btn btn-default">Batal</a>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  function generateTanggalSelector(monthValue, selectedDates) {
    const container = document.getElementById('tanggal-container');
    container.innerHTML = '';
    if (!monthValue) {
      return;
    }
    const [year, month] = monthValue.split('-').map(Number);
    if (!year || !month) {
      return;
    }
    const daysInMonth = new Date(year, month, 0).getDate();

    for (let day = 1; day <= daysInMonth; day++) {
      const dayString = String(day).padStart(2, '0');
      const value = `${year}-${String(month).padStart(2, '0')}-${dayString}`;
      const checked = selectedDates.includes(value) ? 'checked' : '';

      const wrapper = document.createElement('div');
      wrapper.className = 'col-3';
      wrapper.innerHTML = `
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="tanggal[]" id="tanggal_${value}" value="${value}" ${checked}>
          <label class="form-check-label" for="tanggal_${value}">${day}</label>
        </div>
      `;
      container.appendChild(wrapper);
    }
  }

  document.addEventListener('DOMContentLoaded', function () {
    $('.select2').select2({
      width: '100%',
      allowClear: true
    });

    const monthInput = document.getElementById('bulan');
    if (!monthInput) {
      return;
    }
    const selectedDates = <?php echo json_encode(isset($selected_dates) ? $selected_dates : array()); ?>;
    generateTanggalSelector(monthInput.value, selectedDates);
    monthInput.addEventListener('change', function () {
      generateTanggalSelector(this.value, []);
    });
  });
</script>
</body>
</html>