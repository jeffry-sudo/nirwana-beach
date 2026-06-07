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
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/shift') ?>">Shift Kerja</a></li>
            <li class="breadcrumb-item active"><?php echo $title ?></li>
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
              <h3 class="card-title"><?php echo $title ?></h3>
            </div>
            <form method="post" action="<?php echo isset($shift) && $shift ? base_url('admin/shift_edit/' . $shift['kd_shift']) : base_url('admin/shift_tambah'); ?>">
              <div class="card-body">
                <?php if (validation_errors()): ?>
                  <div class="alert alert-danger">
                    <?php echo validation_errors(); ?>
                  </div>
                <?php endif; ?>
                <div class="form-group">
                  <label>Nama Shift</label>
                  <input type="text" name="nama_shift" class="form-control" value="<?php echo set_value('nama_shift', $shift['nama_shift'] ?? ''); ?>" placeholder="Shift Pagi / Shift Malam" required>
                  <?php echo form_error('nama_shift', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                  <label>Jam Mulai</label>
                  <input type="time" name="jam_mulai" class="form-control" value="<?php echo set_value('jam_mulai', $shift['jam_mulai'] ?? ''); ?>" required>
                  <?php echo form_error('jam_mulai', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                  <label>Jam Selesai</label>
                  <input type="time" name="jam_selesai" class="form-control" value="<?php echo set_value('jam_selesai', $shift['jam_selesai'] ?? ''); ?>" required>
                  <?php echo form_error('jam_selesai', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <hr>
                <h5>Pengaturan Stage Absensi</h5>
                <div class="form-group">
                  <label>Masuk</label>
                  <div class="row">
                    <div class="col-md-6">
                      <input type="time" name="masuk_mulai" class="form-control" value="<?php echo set_value('masuk_mulai', $shift['masuk_mulai'] ?? ''); ?>" required>
                      <?php echo form_error('masuk_mulai', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="col-md-6">
                      <input type="time" name="masuk_selesai" class="form-control" value="<?php echo set_value('masuk_selesai', $shift['masuk_selesai'] ?? ''); ?>" required>
                      <?php echo form_error('masuk_selesai', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Tengah</label>
                  <div class="row">
                    <div class="col-md-6">
                      <input type="time" name="tengah_mulai" class="form-control" value="<?php echo set_value('tengah_mulai', $shift['tengah_mulai'] ?? ''); ?>" required>
                      <?php echo form_error('tengah_mulai', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="col-md-6">
                      <input type="time" name="tengah_selesai" class="form-control" value="<?php echo set_value('tengah_selesai', $shift['tengah_selesai'] ?? ''); ?>" required>
                      <?php echo form_error('tengah_selesai', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Pulang</label>
                  <div class="row">
                    <div class="col-md-6">
                      <input type="time" name="pulang_mulai" class="form-control" value="<?php echo set_value('pulang_mulai', $shift['pulang_mulai'] ?? ''); ?>" required>
                      <?php echo form_error('pulang_mulai', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="col-md-6">
                      <input type="time" name="pulang_selesai" class="form-control" value="<?php echo set_value('pulang_selesai', $shift['pulang_selesai'] ?? ''); ?>" required>
                      <?php echo form_error('pulang_selesai', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                  </div>
                </div>
                <a href="<?php echo base_url('admin/shift') ?>" class="btn btn-default">Batal</a>
                <button type="submit" class="btn btn-primary float-right">Simpan Shift</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php $this->load->view('include/base_footer'); ?>
<?php $this->load->view('include/base_js'); ?>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const segments = [
      { start: 'jam_mulai', end: 'jam_selesai' },
      { start: 'masuk_mulai', end: 'masuk_selesai' },
      { start: 'tengah_mulai', end: 'tengah_selesai' },
      { start: 'pulang_mulai', end: 'pulang_selesai' },
    ];

    segments.forEach(function (segment) {
      const startInput = document.querySelector('[name="' + segment.start + '"]');
      const endInput = document.querySelector('[name="' + segment.end + '"]');
      if (!startInput || !endInput) {
        return;
      }

      const updateEndConstraints = function () {
        if (startInput.value) {
          endInput.min = startInput.value;
          if (endInput.value && endInput.value < startInput.value) {
            endInput.value = startInput.value;
          }
        } else {
          endInput.removeAttribute('min');
        }
      };

      startInput.addEventListener('change', function () {
        updateEndConstraints();
      });

      endInput.addEventListener('input', function () {
        if (this.value && startInput.value && this.value < startInput.value) {
          this.setCustomValidity('Jam akhir harus sama atau lebih besar dari jam awal.');
        } else {
          this.setCustomValidity('');
        }
      });

      updateEndConstraints();
    });
  });
</script>
</body>
</html>