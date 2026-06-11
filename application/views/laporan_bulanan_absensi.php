<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $this->load->view('include/base_css'); ?>
  <link rel="stylesheet" href="<?php echo base_url('assets'); ?>/plugins/datatables/dataTables.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini">
<?php $this->load->view('include/base_nav'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?php echo $title; ?></h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Filter Bulan</h3>
        </div>
        <div class="card-body">
          <form method="get" action="<?php echo base_url('admin/laporan_bulanan_absensi'); ?>">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Bulan</label>
                  <input type="month" name="bulan" class="form-control" value="<?php echo htmlspecialchars($selected_month, ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>
              </div>
              <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Tampilkan</button>
                <a href="<?php echo base_url('admin/laporan_bulanan_absensi'); ?>" class="btn btn-secondary ml-2">Reset</a>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card card-info">
            <div class="card-header"><h3 class="card-title">Ringkasan Per Karyawan</h3></div>
            <div class="card-body">
              <?php if (!empty($summary)): ?>
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Karyawan</th>
                        <th>Hadir</th>
                        <th>Tidak Hadir</th>
                        <th>Belum Absen</th>
                        <th>Total Scan</th>
                        <th>Total Record</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($summary as $item): ?>
                        <tr>
                          <td><?php echo htmlspecialchars($item['nama_admin'], ENT_QUOTES, 'UTF-8'); ?></td>
                          <td><?php echo (int)$item['hadir']; ?></td>
                          <td><?php echo (int)$item['tidak_hadir']; ?></td>
                          <td><?php echo (int)$item['belum_absen']; ?></td>
                          <td><?php echo (int)$item['total_scan']; ?></td>
                          <td><?php echo (int)$item['total_record']; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              <?php else: ?>
                <p class="mb-0">Belum ada data absensi untuk bulan yang dipilih.</p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>

      <div class="card card-default">
        <div class="card-header"><h3 class="card-title">Detail Absensi Bulanan</h3></div>
        <div class="card-body">
          <?php if (!empty($report)): ?>
            <div class="table-responsive">
              <table id="tableLaporanBulanan" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>Karyawan</th>
                    <th>Shift</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Total Scan</th>
                    <th>Kode Absensi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($report as $row): ?>
                    <tr>
                      <td><?php echo htmlspecialchars($row['tanggal'], ENT_QUOTES, 'UTF-8'); ?></td>
                      <td><?php echo htmlspecialchars($row['nama_admin'], ENT_QUOTES, 'UTF-8'); ?></td>
                      <td><?php echo htmlspecialchars($row['nama_shift'], ENT_QUOTES, 'UTF-8'); ?></td>
                      <td><?php echo htmlspecialchars($row['nama_lokasi'], ENT_QUOTES, 'UTF-8'); ?></td>
                      <td><?php echo htmlspecialchars(ucfirst($row['status_kehadiran']), ENT_QUOTES, 'UTF-8'); ?></td>
                      <td><?php echo (int)$row['total_scan']; ?></td>
                      <td><?php echo htmlspecialchars($row['kd_absensi'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          <?php else: ?>
            <p class="mb-0">Tidak ada data absensi pada bulan ini.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
</div>
<?php $this->load->view('include/base_footer'); ?>
<?php $this->load->view('include/base_js'); ?>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script>
  $(function () {
    $('#tableLaporanBulanan').DataTable();
  });
</script>
</body>
</html>
