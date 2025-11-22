<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- css -->
  <?php $this->load->view('include/base_css'); ?>
  <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/datatables/dataTables.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- navbar -->
<?php $this->load->view('include/base_nav'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List Kendaraan Yang Belum Keluar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('masuk/listkendaraanmasuk') ?>">List Kendaraan</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
       <div class="container-fluid">
            <div class="row">
              <!-- left column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-default">
                  <div class="card-header">
                    <h3 class="card-title">List Kendaraan Yang Belum Keluar</h3>
                  </div>
                  <!-- /.card-header -->
                   <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped responsive">
                    <thead>
                      <tr>
                        <th>Kode Karcis</th>
                        <!-- <th>Plat Nomor</th> -->
                        <th>Jenis</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Penjaga</th>
                        <?php if ($_SESSION['level'] == 1): ?> 
                        <th>Aksi</th>
                        <?php endif; ?>
                      </tr>
                    </thead>
                    <tbody>
                  <?php foreach ($masuk as $row) { ?>
                      <tr>
                        <td><?php echo $row['kd_masuk'] ?></td>
                        <!-- <td><?php echo $row['plat_masuk'] ?></td> -->
                        <td><?php echo strtoupper($row['nama_kendaraan']) ?></td>
                        <td><?php echo hari_indo(date('N',strtotime($row['tgl_masuk']))).', '.tanggal_indo(date('Y-m-d',strtotime(''.$row['tgl_masuk'].''))) ?></td>
                        <td><?php echo date('H:i:s',strtotime($row['tgl_masuk'])) ?></td>
                        <td><?php echo $row['create_masuk'] ?></td>
                        <?php if ($_SESSION['level'] == 1): ?> 
                        <td><a href="<?php echo base_url('masuk/cetakstruk/'.$row['kd_masuk']) ?>"><i class="fa fa-barcode"></i></a> | <a href="<?php echo base_url('masuk/delete/'.$row['kd_masuk']) ?>"><i class="fa fa-trash"></i></a></td>
                        <?php endif; ?>
                      
                      </tr>
                    <?php } ?>
                    </tfoot>
                    </table>
                        </div>
                  </div>
                  <!-- /.card -->
                </div>
              </div>
            </div>

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
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<!-- <script src="<?php echo base_url('assets') ?>/plugins/datatables/jquery.dataTables.min.js"></script> -->
<!-- <script src="<?php echo base_url('assets') ?>/plugins/datatables/dataTables.bootstrap4.min.js"></script> -->
      <!-- page script -->
 <script>
  $(document).ready(function () {
    // Inisialisasi DataTables dengan ID tabel
    $('#example1').DataTable({
      "paging": true,             // Pagination aktif
      "lengthChange": true,       // Opsi mengubah jumlah data per halaman
      "searching": true,          // Fitur pencarian
      "ordering": true,           // Fitur pengurutan
      "info": true,               // Menampilkan informasi jumlah data
      "autoWidth": false,         // Mengatur lebar kolom otomatis
      "responsive": true          // Membuat tabel responsif
    });
  });
</script>

</body>
</html>
