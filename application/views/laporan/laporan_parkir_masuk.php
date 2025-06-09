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
    <style>
  /* Tambahkan CSS untuk memperindah tabel */
  #example1,
  #example2 {
    width: 100%;
    border-collapse: collapse;
  }

  #example1 thead th,
  #example2 thead th {
    background-color: #007bff;
    color: white;
    text-align: center;
  }

  #example1 tbody tr:nth-child(odd),
  #example2 tbody tr:nth-child(odd) {
    background-color: #f8f9fa;
  }

  #example1 tbody tr:hover,
  #example2 tbody tr:hover {
    background-color: #e9ecef;
    cursor: pointer;
  }

  #example1 td, #example1 th,
  #example2 td, #example2 th {
    padding: 12px;
    border: 1px solid #dee2e6;
    text-align: center;
  }

  /* Responsif pada layar kecil */
  @media (max-width: 768px) {
    #example1,
    #example2 {
      display: block;
      overflow-x: auto;
      white-space: nowrap;
    }

  }
</style>
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
            <div class="col-sm-8">
              <h1>Laporan Parkir Masuk</h1>
              <h3 class="card-title" id="judul_tanggal">
                    Data Kendaraan Masuk Hari <?php echo hari_indo(date('N')).', '.tanggal_indo(date('Y-m-d')); ?>
                </h3>

            </div>
            <div class="col-sm-4">
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
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Pilih Tanggal</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                    <div class="card-body">
                        <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Dari Tanggal</label>
                            <input type="date" class="form-control" id="filter_dari_tanggal">
                            </div>
                            <div class="col-md-6">
                            <label class="form-label">Sampai Tanggal</label>
                            <input type="date" class="form-control" id="filter_sampai_tanggal">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-3 col-6 ">
                            <!-- small box -->
                            <div class="small-box bg-info d-flex flex-column" style="min-height:130px;">
                                <div class="inner flex-grow-1">
                                    <h3 id="total_penjualan"><?php echo ($total_penjualan); ?></h3>
                                    <p>Total Penjualan</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-arrow-circle-o-left"></i>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-lg-6 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3 id="total_keuntungan"><?php echo number_format($total_keuntungan); ?></h3>
                                    <p>Keuntungan</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-arrow-circle-o-right"></i>
                                </div>
                            </div>
                        </div> -->

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success d-flex flex-column" style="min-height:130px;">
                                <div class="inner flex-grow-1">
                                    <b><h4 id="jumlah_mobil"><?php echo ($jumlah_mobil); ?></h4></b>
                                    <p>Mobil</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-car"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning d-flex flex-column" style="min-height:130px;">
                                <div class="inner flex-grow-1">
                                    <b><h4 id="jumlah_motor"><?php echo ($jumlah_motor); ?></h4></b>
                                    <p>Motor</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-motorcycle"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger d-flex flex-column" style="min-height:130px;">
                                <div class="inner flex-grow-1">
                                    <b><h4 id="jumlah_orang"><?php echo ($jumlah_orang); ?></h4></b>
                                    <p>Jumlah Orang</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                            </div>
                        </div>
                    </div>



                <!-- /.card -->
              </div>
              

              <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-default">
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Nama Penjaga Loket</th>
                            <th>Penjualan</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($masuk_detail as $row) { ?>
                        <tr>
                            <td><?php echo strtoupper($row['create_masuk']) ?></td>
                            <td><?php echo $row['total_penjualan'] ?></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    </div>
                  </div>
                  <!-- /.card -->
                </div>
              </div>

              <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-default">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Kode Karcis</th>
                            <th>Jenis</th>
                            <th>Jml Org</th>
                            <th>Jam Masuk</th>
                            <th>Penjaga</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($masuk as $row) { ?>
                        <tr>
                            <td><?php echo $row['kd_masuk'] ?></td>
                            <td><?php echo strtoupper($row['nama_kendaraan']) ?></td>
                            <td><?php echo $row['jml_org'] ?></td>
                            <td><?php echo date('H:i:s', strtotime($row['tgl_masuk'])) ?></td>
                            <td><?php echo $row['create_masuk'] ?></td>
                        </tr>
                        <?php } ?>
                        </tbody>
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
      <script type='text/javascript' src='<?php echo base_url();?>assets/dist/js/jquery.autocomplete.js'></script>
      <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
      <script type="text/javascript">

$(document).ready(function () {
    $('#filter_dari_tanggal, #filter_sampai_tanggal').change(function() {
        var dariTanggal = $('#filter_dari_tanggal').val();
        var sampaiTanggal = $('#filter_sampai_tanggal').val();

        console.log("Dari Tanggal:", dariTanggal);
        console.log("Sampai Tanggal:", sampaiTanggal);

        if (dariTanggal && sampaiTanggal) {
            $.ajax({
                url: '<?php echo base_url('laporan/filter_data'); ?>',
                method: 'POST',
                data: {
                    dari_tanggal: dariTanggal,
                    sampai_tanggal: sampaiTanggal
                },
                success: function(response) {
                    console.log("Response dari server:", response);

                    let options = { year: 'numeric', month: 'long', day: 'numeric' };
                    let tanggalFormatted = new Date(dariTanggal).toLocaleDateString('id-ID', options) + 
                                           (dariTanggal !== sampaiTanggal 
                                            ? ' - ' + new Date(sampaiTanggal).toLocaleDateString('id-ID', options) 
                                            : '');

                    // Perbarui teks judul
                    $('#judul_tanggal').text('Data Kendaraan Masuk Tanggal ' + tanggalFormatted);

                    if (typeof response === "string") {
                        response = JSON.parse(response);
                    }

                    // Update kotak info
                    $('#total_penjualan').text(response.total_penjualan.replace(/,/g, ''));
                    $('#total_keuntungan').text(response.total_keuntungan.replace(/,/g, ''));
                    $('#jumlah_mobil').text(response.jumlah_mobil);
                    $('#jumlah_motor').text(response.jumlah_motor);
                    $('#jumlah_orang').text(response.jumlah_orang);

                    // **UPDATE DATATABLE example1**
                    if ($.fn.DataTable.isDataTable("#example1")) {
                        $('#example1').DataTable().clear().destroy();
                    }

                    var tableBody1 = $('#example1 tbody');
                    tableBody1.empty();

                    $.each(response.masuk, function(index, row) {
                        tableBody1.append(
                            '<tr>' +
                                '<td>' + row.kd_masuk + '</td>' +
                                '<td>' + row.nama_kendaraan.toUpperCase() + '</td>' +
                                '<td>' + row.jml_org + '</td>' +
                                '<td>' + row.tgl_masuk + '</td>' +
                                '<td>' + row.create_masuk + '</td>' +
                            '</tr>'
                        );
                    });

                    $('#example1').DataTable({
                        "paging": true,
                        "lengthChange": true,
                        "searching": false,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                        "order": [[0, "asc"]] // Urut berdasarkan tanggal masuk
                    });

                    // **UPDATE DATATABLE example2**
                    if ($.fn.DataTable.isDataTable("#example2")) {
                        $('#example2').DataTable().clear().destroy();
                    }

                    var tableBody2 = $('#example2 tbody');
                    tableBody2.empty();

                    $.each(response.masuk_detail, function(index, row) {
                        tableBody2.append(
                            '<tr>' +
                                '<td>' + row.create_masuk.toUpperCase() + '</td>' +
                                '<td>' + row.total_penjualan + '</td>' +
                            '</tr>'
                        );
                    });

                    $('#example2').DataTable({
                        "paging": true,
                        "lengthChange": true,
                        "searching": false,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                        "order": [[1, "desc"]] // Urut berdasarkan total penjualan
                    });
                }
            });
        }
    });
});



</script>

    </body>
  </html>