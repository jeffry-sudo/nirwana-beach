<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $this->load->view('include/base_css'); ?>
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
        <div class="col-sm-6 text-right">
          <a href="<?php echo base_url('admin/history_absensi'); ?>" class="btn btn-secondary">Kembali</a>
        </div>
      </div>
      <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <?php echo $this->session->flashdata('success'); ?>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="card card-default">
        <div class="card-header"><h3 class="card-title">Informasi Absensi</h3></div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <dl class="row">
                <dt class="col-sm-5">Kode Absensi</dt>
                <dd class="col-sm-7"><?php echo $attendance['kd_absensi']; ?></dd>
                <dt class="col-sm-5">Tanggal</dt>
                <dd class="col-sm-7"><?php echo $attendance['tanggal']; ?></dd>
                <dt class="col-sm-5">Karyawan</dt>
                <dd class="col-sm-7"><?php echo $attendance['nama_admin']; ?></dd>
                <dt class="col-sm-5">Shift</dt>
                <dd class="col-sm-7"><?php echo $attendance['nama_shift']; ?></dd>
              </dl>
            </div>
            <div class="col-md-6">
              <dl class="row">
                <dt class="col-sm-5">Lokasi</dt>
                <dd class="col-sm-7"><?php echo $attendance['nama_lokasi']; ?></dd>
                <dt class="col-sm-5">Status Kehadiran</dt>
                <dd class="col-sm-7"><?php echo ucfirst($attendance['status_kehadiran']); ?></dd>
                <?php if (!empty($attendance['reason_incomplete'])): ?>
                  <dt class="col-sm-5">Alasan Tidak Hadir</dt>
                  <dd class="col-sm-7"><?php echo nl2br(htmlspecialchars($attendance['reason_incomplete'], ENT_QUOTES, 'UTF-8')); ?></dd>
                <?php endif; ?>
                <dt class="col-sm-5">Dibuat</dt>
                <dd class="col-sm-7"><?php echo $attendance['created_at']; ?></dd>
              </dl>
            </div>
          </div>
        </div>
      </div>

      <div class="card card-default">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h3 class="card-title">Verifikasi Absensi</h3>
          <div>
            <form method="post" action="<?php echo base_url('admin/history_absensi_verify/' . $attendance['kd_absensi']); ?>" class="d-inline">
              <input type="hidden" name="verify_action" value="complete" />
              <button type="submit" class="btn btn-success btn-sm">Tandai Complete</button>
            </form>
            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#incompleteReasonModal">Tandai Tidak Complete</button>
          </div>
        </div>
        <div class="card-body">
          <p class="mb-0">Gunakan tombol di atas untuk memverifikasi apakah absensi ini lengkap atau tidak. Jika tidak lengkap, status akan kembali menjadi <strong>in progress</strong>.</p>
        </div>
      </div>

      <div class="card card-default">
        <div class="card-header"><h3 class="card-title">Detail Scan</h3></div>
        <div class="card-body">
          <?php if (count($scans) === 0): ?>
            <p>Tidak ada scan tersedia untuk absensi ini.</p>
          <?php else: ?>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Stage</th>
                    <th>Waktu Scan</th>
                    <th>Jarak (m)</th>
                    <th>Status</th>
                    <th>Pesan</th>
                    <th>Foto</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; foreach ($scans as $scan): ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo ucfirst($scan['stage']); ?></td>
                      <td><?php echo $scan['waktu_scan']; ?></td>
                      <td><?php echo $scan['jarak_meter']; ?></td>
                      <td><?php echo $scan['status_valid'] ? 'Valid' : 'Tidak valid'; ?></td>
                      <td><?php echo $scan['message']; ?></td>
                      <td>
                        <?php if (!empty($scan['photo_base64'])): ?>
                          <?php $photoSrc = strpos($scan['photo_base64'], 'data:image/') === 0 ? $scan['photo_base64'] : 'data:image/jpeg;base64,' . $scan['photo_base64']; ?>
                          <a href="#" class="photo-preview-link" data-photo="<?php echo htmlspecialchars($photoSrc, ENT_QUOTES, 'UTF-8'); ?>">
                            <img src="<?php echo $photoSrc; ?>" alt="Foto Scan" style="max-width:120px; max-height:120px; object-fit:cover; border-radius:10px;" />
                          </a>
                        <?php else: ?>
                          -
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
</div>
<?php $this->load->view('include/base_footer'); ?>
<?php $this->load->view('include/base_js'); ?>

<div class="modal fade" id="incompleteReasonModal" tabindex="-1" role="dialog" aria-labelledby="incompleteReasonModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="incompleteReasonModalLabel">Alasan Tidak Complete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?php echo base_url('admin/history_absensi_verify/' . $attendance['kd_absensi']); ?>">
        <div class="modal-body">
          <input type="hidden" name="verify_action" value="incomplete" />
          <div class="form-group">
            <label for="reason">Alasan</label>
            <textarea name="reason" id="reason" class="form-control" rows="4" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Simpan Alasan dan Tandai Tidak Complete</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="photoPreviewModal" tabindex="-1" role="dialog" aria-labelledby="photoPreviewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="photoPreviewModalLabel">Preview Foto Scan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <img id="photoPreviewImage" src="" alt="Preview Foto Scan" class="img-fluid rounded" style="max-height:80vh;" />
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.photo-preview-link').forEach(function (link) {
      link.addEventListener('click', function (event) {
        event.preventDefault();
        var photo = this.getAttribute('data-photo');
        var previewImage = document.getElementById('photoPreviewImage');
        if (previewImage && photo) {
          previewImage.src = photo;
          $('#photoPreviewModal').modal('show');
        }
      });
    });
  });
</script>
</body>
</html>