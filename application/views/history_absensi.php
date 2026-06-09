<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $this->load->view('include/base_css'); ?>
  <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/datatables/dataTables.bootstrap4.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Filter User</h3>
        </div>
        <div class="card-body">
          <form method="get" action="<?php echo base_url('admin/history_absensi'); ?>">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Pilih Karyawan</label>
                  <select name="kd_admin" class="form-control">
                    <option value="">Semua Karyawan</option>
                    <?php foreach ($admin_list as $admin) : ?>
                      <option value="<?php echo $admin['kd_admin']; ?>" <?php echo $selected_admin == $admin['kd_admin'] ? 'selected' : ''; ?>><?php echo $admin['nama_admin']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Tanggal</label>
                  <input type="date" name="tanggal" value="<?php echo $selected_date; ?>" class="form-control" />
                </div>
              </div>
              <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                <a href="<?php echo base_url('admin/history_absensi'); ?>" class="btn btn-secondary ml-2">Reset</a>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Daftar Absensi</h3>
        </div>
        <div class="card-body">
          <table id="tableHistory" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Karyawan</th>
                <th>Shift</th>
                <th>Lokasi</th>
                <th>Rekap Kehadiran</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($history as $row) : ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $row['tanggal']; ?></td>
                  <td><?php echo $row['nama_admin']; ?></td>
                  <td><?php echo $row['nama_shift']; ?></td>
                  <td><?php echo $row['nama_lokasi']; ?></td>
                  <td>
                    <?php if ($row['rekap_kehadiran'] === 'Hadir') : ?>
                      <span class="badge badge-success">Hadir</span>
                    <?php elseif ($row['rekap_kehadiran'] === 'Belum Absen') : ?>
                      <span class="badge badge-secondary">Belum Absen</span>
                    <?php else : ?>
                      <span class="badge badge-danger">Tidak Hadir</span>
                    <?php endif; ?>
                  </td>
                  <td><?php echo !empty($row['status_kehadiran']) ? ucfirst($row['status_kehadiran']) : 'Belum Absen'; ?></td>
                  <td>
                    <?php if (!empty($row['kd_absensi'])) : ?>
                      <a href="<?php echo base_url('admin/history_absensi_detail/' . $row['kd_absensi']); ?>" class="btn btn-sm btn-info">Detail</a>
                      <a href="<?php echo base_url('admin/history_absensi_hapus/' . $row['kd_absensi']); ?>" class="btn btn-sm btn-danger swal-confirm-delete">Hapus</a>
                    <?php else : ?>
                      -
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
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
    $('#tableHistory').DataTable();

    document.querySelectorAll('.swal-confirm-delete').forEach(function (link) {
      link.addEventListener('click', function (event) {
        event.preventDefault();
        Swal.fire({
          title: 'Yakin ingin menghapus?',
          text: 'Data absensi ini beserta scan terkait akan dihapus permanen.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Ya, hapus!',
          cancelButtonText: 'Batal'
        }).then(function (result) {
          if (result.isConfirmed) {
            window.location.href = link.getAttribute('href');
          }
        });
      });
    });
  });
</script>
</body>
</html>