<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->load->view('include/base_css'); ?>
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/datatables/dataTables.bootstrap4.min.css">
    <link href='<?php echo base_url();?>assets/dist/js/jquery.autocomplete.css' rel='stylesheet' />
    <script src="https://unpkg.com/@zxing/library@latest"></script>
    <!-- <script src="https://unpkg.com/html5-qrcode"></script> -->
 
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .floating-button { position: fixed; bottom: 20px; right: 20px; background-color: #28a745; color: white; padding: 12px 20px; border-radius: 50px; font-size: 16px; font-weight: bold; border: none; cursor: pointer; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); }
        .floating-button:hover { background-color: #218838; }
        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; }
        .modal-content { background: white; padding: 20px; border-radius: 8px; text-align: center; width: 80%; max-width: 400px; }
        .close-button { background-color: red; color: white; border: none; padding: 10px; border-radius: 5px; cursor: pointer; margin-top: 10px; }
    </style>
  </head>
  <body>
    <?php $this->load->view('include/base_nav'); ?>
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <h1><?php echo $title. ' (' .$_SESSION['nama_admin']. ')';?></h1>
          <h3 id="judul_tanggal">Data Parkir Hari <?php echo hari_indo(date('N')).', '.tanggal_indo(date('Y-m-d')); ?></h3>
        </div>
      </section>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Pilih Tanggal</h3>
                </div>
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
              </div>
              <div class="row">
              <div class="col-lg-4 col-12 ">
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

                        <div class="col-lg-4 col-12">
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

                        <div class="col-lg-4 col-12">
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
              </div>

              <div class="card card-default">
                <div class="table-responsive">
                  <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nama Petugas Parkir</th>
                        <th>Penjualan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($masuk_detail as $row) { ?>
                      <tr>
                        <td><?php echo strtoupper($row['nama_admin']) ?></td>
                        <td><?php echo $row['total_penjualan'] ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              
              <div class="card card-default">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Kode Karcis</th>
                        <th>Jenis</th>
                        <th>Jam Masuk</th>
                        <th>Penjaga</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($masuk as $row) { ?>
                      <tr>
                        <td><?php echo $row['kd_masuk'] ?></td>
                        <td><?php echo strtoupper($row['nama_kendaraan']) ?></td>
                        <td><?php echo date('H:i:s', strtotime($row['tgl_masuk'])) ?></td>
                        <td><?php echo $row['create_masuk'] ?></td>
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
    <button class="floating-button" id="scanButton">Scan Karcis</button>
    <div id="scanModal" class="modal">
      <div class="modal-content">
        <h3>Scan Barcode</h3>
        <video id="preview" style="width:100%;"></video>
        <input type="file" id="uploadImage" accept="image/*" class="form-control" />
        <p id="qr-result"></p>
        <button class="close-button" onclick="closeScanner()">Tutup</button>
      </div>
    </div>
    
    <?php $this->load->view('include/base_footer'); ?>
      <?php $this->load->view('include/base_js'); ?>
      <script type='text/javascript' src='<?php echo base_url();?>assets/dist/js/jquery.autocomplete.js'></script>
      <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    \
    <script>
 let codeReader = new ZXing.BrowserMultiFormatReader();
let isCameraRunning = false;

document.getElementById("scanButton").addEventListener("click", function () {
    document.getElementById("scanModal").style.display = "flex";
    startZXingScanner();
});

/* ==== START CAMERA SCAN ==== */
function startZXingScanner() {
    if (isCameraRunning) return; // cegah video play 2x
    isCameraRunning = true;

    codeReader.decodeFromVideoDevice(null, 'preview', (result, err) => {
        if (result) {
            let kd = result.text;
            document.getElementById("qr-result").innerHTML = "Hasil: " + kd;

            // Kirim kode ke server
            $.ajax({
                url: "<?php echo base_url('laporan/update_status_masuk'); ?>",
                type: "POST",
                data: { kd_masuk: kd },
                dataType: "json",
                success: function(response) {
                    alert(response.message);
                    if (response.status === "success") {
                        closeScanner();
                        location.reload();
                    }
                },
                error: function() {
                    alert("Gagal mengirim data ke server.");
                }
            });
        }
    });
}

/* ==== STOP CAMERA ==== */
function closeScanner() {
    document.getElementById("scanModal").style.display = "none";
    
    if (codeReader) {
        codeReader.reset();
    }
    isCameraRunning = false;
    document.getElementById("qr-result").innerHTML = "";
    document.getElementById("uploadImage").value = "";
}

/* ==== UPLOAD & SCAN IMAGE ==== */
document.getElementById("uploadImage").addEventListener("change", function (event) {
    let file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function () {
        scanImage(reader.result);
    };
    reader.readAsDataURL(file);
});

function scanImage(base64Image) {
    const imageReader = new ZXing.BrowserMultiFormatReader();

    imageReader.decodeFromImage(undefined, base64Image)
        .then(result => {
            let kd = result.text;
            document.getElementById("qr-result").innerHTML = "Hasil: " + kd;

            $.ajax({
                url: "<?php echo base_url('laporan/update_status_masuk'); ?>",
                type: "POST",
                data: { kd_masuk: kd },
                dataType: "json",
                success: function(response) {
                    alert(response.message);
                    if (response.status === "success") {
                        closeScanner();
                        location.reload();
                    }
                },
                error: function() {
                    alert("Gagal mengirim data ke server.");
                }
            });
        })
        .catch(err => {
            console.error(err);
            document.getElementById("qr-result").innerHTML =
                "<span style='color:red'>Barcode pada gambar tidak terdeteksi.</span>";
        });
}


$(document).ready(function () {
    $('#filter_dari_tanggal, #filter_sampai_tanggal').change(function() {
        var dariTanggal = $('#filter_dari_tanggal').val();
        var sampaiTanggal = $('#filter_sampai_tanggal').val();

        console.log("Dari Tanggal:", dariTanggal);
        console.log("Sampai Tanggal:", sampaiTanggal);

        if (dariTanggal && sampaiTanggal) {
            $.ajax({
                url: '<?php echo base_url('laporan/filter_data_parkir'); ?>',
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
                    $('#jumlah_mobil').text(response.jumlah_mobil);
                    $('#jumlah_motor').text(response.jumlah_motor);

                    /*** Update DataTable example1 ***/
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
                        "order": [[0, "asc"]]
                    });

                    /*** Update DataTable example2 ***/
                    if ($.fn.DataTable.isDataTable("#example2")) {
                        $('#example2').DataTable().clear().destroy();
                    }

                    var tableBody2 = $('#example2 tbody');
                    tableBody2.empty();

                    $.each(response.masuk_detail, function(index, row) {
                        tableBody2.append(
                            '<tr>' +
                                '<td>' + row.nama_admin.toUpperCase() + '</td>' +
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