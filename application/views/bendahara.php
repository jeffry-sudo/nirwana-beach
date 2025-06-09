
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href='<?php echo base_url();?>assets/dist/js/jquery.autocomplete.css' rel='stylesheet' />

  <!-- <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css') ?>">  -->
  <!-- Custom CSS -->

  <!-- css -->
  <?php $this->load->view('include/base_css'); ?>
  <?php $this->load->view('include/base_nav'); ?>
</head>
<body class="hold-transition sidebar-mini">
<!-- navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
    <div class="row mb-4">
    <div class="col-md-12 text-center">
      <h1 class="fw-bold text-primary">Manajemen Keuangan</h1>

    </div>
  </div>
    </section> -->

    <!-- Main content -->
    <section class="content">
    <div class="container">
      <div class="row mb-3">
        <div class="col-md-12">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-center">
                    <h5 class="text-primary fw-bold" id="judul_tanggal">Total Saldo <?php echo hari_indo(date('N')).', '.tanggal_indo(date('Y-m-d')); ?></h5>
                    <h2 class="text-primary total-saldo">Rp<?php echo number_format($total_pendapatan - $total_pengeluaran, 0, ',', '.'); ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-6">
          <label class="form-label">Dari Tanggal</label>
          <input type="date" class="form-control" id="filter_dari_tanggal">
        </div>
        <div class="col-md-6">
          <label class="form-label">Sampai Tanggal</label>
          <input type="date" class="form-control" id="filter_sampai_tanggal">
        </div>
      </div>

        <div class="row text-center mt-4">
            <div class="col-md-6">
                <div class="card border-success shadow-sm">
                    <div class="card-body">
                        <h4 class="text-success fw-bold">Penghasilan</h4>
                        <h3 class="text-success total-pendapatan">Rp<?php echo number_format($total_pendapatan, 0, ',', '.'); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-danger shadow-sm">
                    <div class="card-body">
                        <h4 class="text-danger fw-bold">Pengeluaran</h4>
                        <h3 class="text-danger total-pengeluaran">Rp<?php echo number_format($total_pengeluaran, 0, ',', '.'); ?></h3>
                    </div>
                </div>
            </div>
        </div>

      
      <div class="list-group mt-3">
    <?php foreach ($transaksi as $trx): ?>
        <div class="list-group-item <?php echo $trx['jenis_trx'] === 'pendapatan' ? 'list-group-item-info' : 'list-group-item-danger'; ?>">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">Tanggal: <?php echo date('d/m/Y', strtotime($trx['tgl_trx'])); ?></small>
                    <br>
                    <strong><?php echo $trx['keterangan']; ?></strong>
                </div>
                <div class="d-flex align-items-center">
                    <span class="me-3 fw-bold">
                        <?php echo $trx['jenis_trx'] === 'pengeluaran' ? '-' : ''; ?>Rp<?php echo number_format($trx['nominal'], 0, ',', '.'); ?>
                    </span>
                    <form action="<?php echo base_url('laporan/delete/' . $trx['id_trx']); ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                        <button type="submit" class="btn btn-sm btn-danger border-0">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

      <?php if ($_SESSION['level'] == 1): ?> 
        <button class="btn btn-primary rounded-circle position-fixed" 
                style="bottom: 20px; right: 20px; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center; font-size: 24px;" 
                data-bs-toggle="modal" data-bs-target="#modalTambah">
        +
        </button>
      <?php endif; ?>

    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <form action="<?php echo base_url('laporan/tambah'); ?>" method="post">
              <div class="mb-3">
                <label class="form-label">Jenis</label>
                <select class="form-select" name="jenis_trx" required>
                  <option value="pendapatan">Pendapatan</option>
                  <option value="pengeluaran">Pengeluaran</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <input type="text" class="form-control" name="keterangan" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Nominal</label>
                <input type="number" class="form-control" name="nominal" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" class="form-control" name="tgl_trx" required>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
    <!-- End of Main Content -->

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> -->
<script>
  // Initialize Datepicker
  document.querySelectorAll('.datepicker').forEach(input => {
    input.addEventListener('focus', () => {
      input.type = 'date';
    });
  });

  $(document).ready(function () {
    $("#filter_dari_tanggal, #filter_sampai_tanggal").on("change", function () {
      let dari = $("#filter_dari_tanggal").val();
      let sampai = $("#filter_sampai_tanggal").val();

      if (dari && sampai) {
        $.ajax({
          url: "<?php echo base_url('laporan/filter'); ?>",
          method: "POST",
          dataType: "json",  // Gunakan JSON agar lebih fleksibel
          data: { dari_tanggal: dari, sampai_tanggal: sampai },
          success: function (response) {
            let options = { year: 'numeric', month: 'long', day: 'numeric' };
                    let tanggalFormatted = new Date(dari).toLocaleDateString('id-ID', options) + 
                                           (dari !== sampai 
                                            ? ' - ' + new Date(sampai).toLocaleDateString('id-ID', options) 
                                            : '');

                    // Perbarui teks judul
                    $('#judul_tanggal').text('Total Saldo ' + tanggalFormatted);

            $(".list-group").html(response.transaksi_html); // Update daftar transaksi
            $(".total-saldo").text("Rp" + response.total_saldo.toLocaleString('id-ID'));
            $(".total-pendapatan").text("Rp" + response.total_pendapatan.toLocaleString('id-ID'));
            $(".total-pengeluaran").text("Rp" + response.total_pengeluaran.toLocaleString('id-ID'));
          }
        });
      }
    });
  });

</script>
</body>
</html>