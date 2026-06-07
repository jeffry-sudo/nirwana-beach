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
          <h1>Lokasi Kerja</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/lokasi') ?>">Lokasi Kerja</a></li>
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
              <h3 class="card-title"><a href="<?php echo base_url('admin/lokasi_tambah') ?>" class="btn btn-primary">Tambah Lokasi</a></h3>
            </div>
            <div class="card-body">
              <table id="tableLokasi" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Lokasi</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Radius (m)</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; foreach ($lokasi as $row) { ?>
                    <tr>
                      <td><?php echo $i++; ?></td>
                      <td><?php echo $row['kd_lokasi']; ?></td>
                      <td><?php echo $row['nama_lokasi']; ?></td>
                      <td><?php echo $row['latitude']; ?></td>
                      <td><?php echo $row['longitude']; ?></td>
                      <td><?php echo $row['radius_meter']; ?></td>
                      <td>
                        <a href="<?php echo base_url('admin/lokasi_edit/' . $row['kd_lokasi']); ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="<?php echo base_url('admin/lokasi_hapus/' . $row['kd_lokasi']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus lokasi ini?');">Hapus</a>
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
  $(function() {
    $('#tableLokasi').DataTable();
  });
</script>
</body>
</html>