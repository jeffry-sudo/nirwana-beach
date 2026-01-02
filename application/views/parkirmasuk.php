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
    <!-- Memanggil file .css untuk style saat data dicari dalam filed -->
    <link href='<?php echo base_url();?>assets/dist/js/jquery.autocomplete.css' rel='stylesheet' />
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
              <h1>Parkir Masuk</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('Masuk') ?>">Parkir Masuk</a></li>
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
              <div class="col-md-4">
                <!-- general form elements -->
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Input Kendaraan Masuk</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form action="<?php echo base_url('masuk/kendaraanmasuk') ?>" method="post">
                    <div class="card-body">
                      <div class="hidden">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Jenis Kendaraan</label>
                        <select class="form-control" name="jenis" >
                          <option value="" selected disabled="">Pilih Kendaraan</option>
                          <?php foreach ($jenis as $row) { ?>
                          <option value="<?php echo $row['kd_kendaraan'] ?>"><?php echo strtoupper($row['nama_kendaraan']) ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Orang</label>
                            <input type="number" class="form-control" id="" placeholder="Jumlah Orang" name="jml_org" value=1>
                      </div>
                      <div class="form-group" hidden>
                        <label for="">Nomor Plat</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><input class="form-control" type="text" name="plat" size="5" value="DT"></span>
                            <input type="number" class="form-control" id="" placeholder="Nomor Plat" name="nomor">
                            <span class="input-group-text"><input class="form-control" type="text" name="back" size="5" ></span>
                          </div>
                        </div>
                        <?php echo $this->session->flashdata('pesan') ?>
                      </div>
                      </div>
                      <!-- <div class="form-group">
                        <label for="exampleInputEmail1">Member Masuk ? </label>
                        <div class="row"><div class="col">
                          <input type="radio" class="tampil" name="yes"> Yes
                        </div>
                        <div class="col">
                          <input type="radio" class="sembunyi" name="yes">No
                        </div>
                      </div>
                      </div> -->
                      <!-- <div class="form-group gambar">
                        <label for="">Kode Member</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-barcode"></i></span>
                            <input type="text" class="form-control" placeholder="Kode Member" name="member">
                          </div>
                        </div>
                    </div> -->
                    </div>
                    
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                    </div>
                  </form>
                </div>
                <!-- /.card -->
              </div>
              <div class="col-md-8">
                <!-- general form elements -->
                <div class="card card-default">
                  <div class="card-header">
                    <h3 class="card-title">Data Kendaraan Masuk Hari <?php echo hari_indo(date('N',strtotime(date('Y-m-d')))).', '.tanggal_indo(date('Y-m-d',strtotime(''.date('Y-m-d').''))) ?></h3>
                  </div>
                  <!-- /.card-header -->
                  <table id="example1" class="table table-bordered table-striped table-responsive">
                  <thead>
                      <tr>
                        <th>Cetak Karcis</th>
                        <th>Kode Karcis</th>
                        <th>Jenis</th>
                        <th>Jml Org</th>
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
                      <td>
                          <a href="javascript:void(0)" 
                              onclick="cekStatusKarcis('<?php echo $row['kd_masuk']; ?>')">
                              <i class="fa fa-barcode" id="barcode-<?php echo $row['kd_masuk']; ?>" 
                                style="color: <?php echo ($row['status_karcis'] == 1) ? 'red' : 'black'; ?>;">
                              </i>
                          </a>
                      </td>


                        <td><?php echo $row['kd_masuk'] ?></td>
                        <!-- <td><?php echo $row['plat_masuk'] ?></td> -->
                        <td><?php echo strtoupper($row['nama_kendaraan']) ?></td>
                        <td><?php echo $row['jml_org'] ?></td>
                        <td><?php echo date('H:i:s',strtotime($row['tgl_masuk'])) ?></td>
                        <td><?php echo $row['create_masuk'] ?></td>
                        <?php if ($_SESSION['level'] == 1): ?> 
                           <td>
                              <a href="javascript:void(0)"
                                onclick="confirmDelete('<?php echo base_url('masuk/delete/'.$row['kd_masuk']) ?>')">
                                <i class="fa fa-trash text-danger"></i>
                              </a>
                          </td>
                        <?php endif; ?>
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

      <?php if ($alert = $this->session->flashdata('alert')): ?>
<script>
$(function(){
    $.bootstrapGrowl("<?= $alert['msg'] ?>",{
        type: "<?= $alert['type'] ?>",
        align: "right",
        width: "auto",
        allow_dismiss: false
    });
});
</script>
<?php endif; ?>

      <script type='text/javascript' src='<?php echo base_url();?>assets/dist/js/jquery.autocomplete.js'></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
      <!-- <script src="<?php echo base_url('assets') ?>/plugins/datatables/jquery.dataTables.min.js"></script> -->
      <!-- <script src="<?php echo base_url('assets') ?>/plugins/datatables/dataTables.bootstrap4.min.js"></script> -->
      <script type="text/javascript">
        //Pertama sembunyikan elemen class gambar
        $('.gambar').hide();        
        //Ketika elemen class tampil di klik maka elemen class gambar tampil
        $('.tampil').click(function(){
            $('.gambar').show();
            $('.hidden').hide()
        });
        //Ketika elemen class sembunyi di klik maka elemen class gambar sembunyi
        $('.sembunyi').click(function(){
        //Sembunyikan elemen class gambar
        $('.gambar').hide();
                    $('.hidden').show()        
        });
      </script>
      <script>
      $(function () {
      $('#example1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      // "order": [[1, "desc"]]
      });
      });

      function bukaPopup(url) {
    // Buka URL dalam tab baru dengan ukuran menyerupai popup window
          window.open(url, 'CetakStruk', 'width=800,height=600,scrollbars=yes');
      }

      function cekStatusKarcis(kd_masuk) {
          $.ajax({
              url: "<?php echo base_url('masuk/cek_status_karcis'); ?>",
              type: "POST",
              data: { kd_masuk: kd_masuk },
              dataType: "json",
              success: function(response) {
                  if (response.status_karcis == 1) {
                      alert("Karcis sudah dicetak!");
                      $("#barcode-" + kd_masuk).css("color", "red"); // Ubah warna icon jika sudah dicetak
                  } else {
                      $("#barcode-" + kd_masuk).css("color", "red"); // Ubah warna icon jika sudah dicetak
                      bukaPopup("<?php echo base_url('masuk/cetakstruk/'); ?>" + kd_masuk);
                  }
              }
          });
      }


      function confirmDelete(url) {
          Swal.fire({
              title: 'Yakin hapus?',
              text: 'Data parkir akan dihapus permanen!',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Ya, hapus',
              cancelButtonText: 'Batal'
          }).then((result) => {
              if (result.isConfirmed) {
                  window.location.href = url;
              }
          });
      }
        
      </script>
    </body>
  </html>