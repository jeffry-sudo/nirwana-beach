
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css') ?>"> <!-- Custom CSS -->

  <!-- css -->
  <?php $this->load->view('include/base_css'); ?>
</head>
<body class="hold-transition sidebar-mini">
<!-- navbar -->
<?php $this->load->view('include/base_nav'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="row mb-4">
    <div class="col-md-12 text-center">
      <h1 class="fw-bold text-primary">Data Laporan Parkir Keluar</h1>
      <p class="text-muted">Pilih laporan yang ingin Anda cetak.</p>
    </div>
  </div>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="card shadow-lg border-0">
    <div class="card-body">
      <table class="table table-hover">
        <thead class="table-primary">
          <tr>
            <!-- <th style="text-align:center;width:40px;">No</th> -->
            <th>Laporan</th>
            <th style="text-align:center;width:150px;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <!-- <td class="text-center">1</td> -->
            <td>Laporan Data Karcis Pertanggal</td>
            <td class="text-center">
              <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#lap_jual_pertanggal">
                <i class="fa fa-calendar"></i> Pilih Tanggal
              </button>
            </td>
          </tr>
          <!-- <tr>
            <td class="text-center">2</td>
            <td>Laporan Data Karcis Perbulan</td>
            <td class="text-center">
              <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#lap_jual_perbulan">
                <i class="fas fa-calendar-alt"></i> Pilih Bulan
              </button>
            </td>
          </tr> -->
        </tbody>
      </table>
    </div>
  </div>
</div><div class="modal fade" id="lap_jual_pertanggal" tabindex="-1" aria-labelledby="modalTanggalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalTanggalLabel">Pilih Tanggal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" action="<?php echo base_url('laporan/laportanggal') ?>" target="_blank">
        <div class="modal-body">
          <div class="mb-3">
            <label for="start-date" class="form-label">Dari Tanggal</label>
            <input type="text" name="mulai" id="start-date" class="form-control datepicker" placeholder="YYYY-MM-DD" required>
          </div>
          <div class="mb-3">
            <label for="end-date" class="form-label">Sampai Tanggal</label>
            <input type="text" name="sampai" id="end-date" class="form-control datepicker" placeholder="YYYY-MM-DD" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Cetak</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal for Bulan -->
<div class="modal fade" id="lap_jual_perbulan" tabindex="-1" aria-labelledby="modalBulanLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalBulanLabel">Pilih Bulan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" action="<?php echo base_url('laporan/laporbulan') ?>" target="_blank">
        <div class="modal-body">
          <div class="mb-3">
            <label for="month" class="form-label">Pilih Bulan</label>
            <select name="bln" id="month" class="form-select" required>
              <option value="" selected disabled>Pilih Bulan</option>
              <?php foreach ($bulan as $row) { ?>
              <option value="<?php echo $row['bulan'] ?>"><?php echo $row['bulan'] ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Cetak</button>
        </div>
      </form>
    </div>
  </div>
</div>
    <!-- End of Main Content -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- footer -->
  <?php $this->load->view('include/base_footer'); ?>

</div>
<!-- ./wrapper -->

<!-- script -->
<?php $this->load->view('include/base_js'); ?>
<!-- Bootstrap JS and FontAwesome -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script>
  // Initialize Datepicker
  document.querySelectorAll('.datepicker').forEach(input => {
    input.addEventListener('focus', () => {
      input.type = 'date';
    });
  });
</script>
</body>
</html>
</body>
</html>
