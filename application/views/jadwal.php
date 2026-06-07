<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $this->load->view('include/base_css'); ?>
  <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/datatables/dataTables.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini">
<?php $this->load->view('include/base_nav'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Jadwal Shift</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/jadwal') ?>">Jadwal Shift</a></li>
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
            <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
              <h3 class="card-title mb-2 mb-sm-0"><a href="<?php echo base_url('admin/jadwal_tambah') ?>" class="btn btn-primary">Tambah Jadwal</a></h3>
              <form class="form-inline" method="get" action="<?php echo base_url('admin/jadwal'); ?>">
                <div class="form-group mr-2">
                  <label for="start_date" class="mr-2">Dari</label>
                  <input type="date" class="form-control" name="start_date" id="start_date" value="<?php echo isset($start_date) ? $start_date : date('Y-m-d'); ?>">
                </div>
                <div class="form-group mr-2">
                  <label for="end_date" class="mr-2">Sampai</label>
                  <input type="date" class="form-control" name="end_date" id="end_date" value="<?php echo isset($end_date) ? $end_date : date('Y-m-d'); ?>">
                </div>
                <button type="submit" class="btn btn-info mr-2">Filter</button>
                <a href="<?php echo base_url('admin/jadwal'); ?>" class="btn btn-secondary">Reset</a>
              </form>
            </div>
            <div class="card-body">
              <table id="tableJadwal" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Karyawan</th>
                    <th>Shift</th>
                    <th>Jam</th>
                    <th>Lokasi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; foreach ($jadwal as $row) { ?>
                    <tr>
                      <td><?php echo $i++; ?></td>
                      <td><?php echo $row['tanggal']; ?></td>
                      <td><?php echo $row['nama_admin']; ?></td>
                      <td><?php echo $row['nama_shift']; ?></td>
                      <td><?php echo $row['jam_mulai']; ?> - <?php echo $row['jam_selesai']; ?></td>
                      <td><?php echo $row['nama_lokasi']; ?></td>
                      <td>
                        <a href="<?php echo base_url('admin/jadwal_edit/' . $row['id']); ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="<?php echo base_url('admin/jadwal_hapus/' . $row['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus jadwal ini?');">Hapus</a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
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
    $('#tableJadwal').DataTable({
      order: [[1, 'asc']]
    });
  });
</script>
</body>
</html>