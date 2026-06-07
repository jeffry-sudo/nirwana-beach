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
            <h1>List Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin') ?>">List Admin</a></li>
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
                    <h3 class="card-title"><a href="<?php echo base_url('admin/daftar') ?>" class="btn btn-primary">Tambah Admin</a></h3>
                  </div>
                  <!-- /.card-header -->
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kode Admin</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>AKSI</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1;foreach ($admin as $row) { ?>
                        <tr>
                          <td><?php echo $i++; ?></td>
                          <td><?php echo $row['kd_admin']; ?></td>
                          <td><?php echo $row['nama_admin']; ?></td>
                          <td><?php echo $row['username_admin']; ?></td>
                          <td><?php echo $row['email_admin']; ?></td>
                          <td><?php if ($row['level_admin'] == '1') { ?>
                            <p class="btn-info">OWNER</p>
                          <?php } else if ($row['level_admin'] == '2') { ?>
                            <p class="btn-success">Penjaga Palang</p>
                          <?php } else if ($row['level_admin'] == '3') { ?>
                            <p class="btn-warning">Petugas Parkir</p>
                          <?php } else if ($row['level_admin'] == '5') { ?>
                            <p class="btn-secondary">Kasir</p>
                          <?php } else { ?>
                            <p class="btn-danger">Pengawas</p>
                          <?php } ?>
                          </td>
                          <td><?php if ($row['level_admin'] == '1') { ?>
                            <a href="#" disabled><i class="fa fa-trash red"></i></a>
                          <?php }else{ ?>
                            <a href="#" onclick="confirmDelete('<?= base_url('admin/delete/' .$row['kd_admin']) ?>')" class="btn btn-danger btn-sm"><i class="fa fa-trash red"></i></a>
                          <?php } ?>
                          </td>
                        </tr>
                      <?php } ?>
                    </tfoot>
                    </table>
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
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <!-- page script -->
      <script>
        $(function () {
          $("#example1").DataTable();
          $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
          });
        });

    function confirmDelete(deleteUrl) {
        Swal.fire({
            title: "Yakin ingin menghapus?",
            text: "Data yang sudah dihapus tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = deleteUrl; // Redirect ke fungsi delete
            }
        });
    }
</script>
</body>
</html>
