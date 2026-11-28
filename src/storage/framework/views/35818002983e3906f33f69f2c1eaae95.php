<?php $__env->startSection('title', 'Profil Instansi'); ?>
<?php $__env->startSection('breadcrumb', 'Pengaturan / Profil Instansi'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-hd mb-3">
  <h1 class="page-ttl">Profil Instansi</h1>
  <p class="page-stl">Kelola informasi instansi yang ditampilkan pada dokumen resmi</p>
</div>

<?php if(session('success')): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-size:.85rem">
  <i class="bi bi-check-circle me-1"></i><?php echo e(session('success')); ?>

  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<form action="<?php echo e(route('admin.profil-instansi.update')); ?>" method="POST" enctype="multipart/form-data">
  <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>

  <div class="row g-3">
    
    <div class="col-md-8">
      <div class="card-panel">
        <div class="cp-head"><div class="cp-title"><i class="bi bi-building me-1"></i>Informasi Instansi</div></div>
        <div class="cp-body">
          <div class="row g-3">
            <div class="col-12">
              <label class="form-label">Nama Instansi <span class="text-danger">*</span></label>
              <input type="text" name="nama_instansi" class="form-control <?php $__errorArgs = ['nama_instansi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('nama_instansi', $profil->nama_instansi)); ?>" required>
              <?php $__errorArgs = ['nama_instansi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6">
              <label class="form-label">Nama Kabupaten/Kota <span class="text-danger">*</span></label>
              <input type="text" name="nama_kabupaten" class="form-control" value="<?php echo e(old('nama_kabupaten', $profil->nama_kabupaten)); ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Provinsi <span class="text-danger">*</span></label>
              <input type="text" name="nama_provinsi" class="form-control" value="<?php echo e(old('nama_provinsi', $profil->nama_provinsi)); ?>" required>
            </div>
            <div class="col-12">
              <label class="form-label">Alamat Lengkap</label>
              <textarea name="alamat" class="form-control" rows="2"><?php echo e(old('alamat', $profil->alamat)); ?></textarea>
            </div>
            <div class="col-md-4">
              <label class="form-label">Kode Pos</label>
              <input type="text" name="kode_pos" class="form-control" value="<?php echo e(old('kode_pos', $profil->kode_pos)); ?>" maxlength="10">
            </div>
            <div class="col-md-4">
              <label class="form-label">Telepon</label>
              <input type="text" name="telepon" class="form-control" value="<?php echo e(old('telepon', $profil->telepon)); ?>">
            </div>
            <div class="col-md-4">
              <label class="form-label">Fax</label>
              <input type="text" name="fax" class="form-control" value="<?php echo e(old('fax', $profil->fax)); ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" value="<?php echo e(old('email', $profil->email)); ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label">Website</label>
              <input type="text" name="website" class="form-control" value="<?php echo e(old('website', $profil->website)); ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label">Kode Instansi</label>
              <input type="text" name="kode_instansi" class="form-control" value="<?php echo e(old('kode_instansi', $profil->kode_instansi)); ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label">Zona Waktu</label>
              <select name="zona_waktu" class="form-select">
                <option value="WIB" <?php echo e($profil->zona_waktu == 'WIB' ? 'selected' : ''); ?>>WIB</option>
                <option value="WITA" <?php echo e($profil->zona_waktu == 'WITA' ? 'selected' : ''); ?>>WITA</option>
                <option value="WIT" <?php echo e($profil->zona_waktu == 'WIT' ? 'selected' : ''); ?>>WIT</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <div class="col-md-4">
      <div class="card-panel mb-3">
        <div class="cp-head"><div class="cp-title"><i class="bi bi-image me-1"></i>Logo</div></div>
        <div class="cp-body text-center">
          <?php if($profil->logo_path): ?>
            <img src="<?php echo e(asset($profil->logo_path)); ?>" alt="Logo" style="max-height:120px;max-width:100%" class="mb-3">
          <?php else: ?>
            <div class="text-muted mb-3" style="font-size:.82rem"><i class="bi bi-image d-block fs-1 opacity-25 mb-1"></i>Belum ada logo</div>
          <?php endif; ?>
          <input type="file" name="logo" class="form-control form-control-sm" accept="image/*">
          <small class="text-muted">Maks. 2MB, format: JPG, PNG, SVG</small>
        </div>
      </div>
      <div class="card-panel">
        <div class="cp-head"><div class="cp-title"><i class="bi bi-person-badge me-1"></i>Kepala Dinas</div></div>
        <div class="cp-body">
          <div class="mb-3"><label class="form-label">Nama</label><input type="text" name="nama_kepala_dinas" class="form-control" value="<?php echo e(old('nama_kepala_dinas', $profil->nama_kepala_dinas)); ?>"></div>
          <div class="mb-3"><label class="form-label">NIP</label><input type="text" name="nip_kepala_dinas" class="form-control" value="<?php echo e(old('nip_kepala_dinas', $profil->nip_kepala_dinas)); ?>"></div>
          <div class="mb-3"><label class="form-label">Jabatan</label><input type="text" name="jabatan_kepala_dinas" class="form-control" value="<?php echo e(old('jabatan_kepala_dinas', $profil->jabatan_kepala_dinas)); ?>"></div>
          <div class="mb-0"><label class="form-label">Pangkat/Golongan</label><input type="text" name="pangkat_kepala_dinas" class="form-control" value="<?php echo e(old('pangkat_kepala_dinas', $profil->pangkat_kepala_dinas)); ?>"></div>
        </div>
      </div>
    </div>

    
    <div class="col-12">
      <div class="card-panel">
        <div class="cp-head"><div class="cp-title"><i class="bi bi-lightbulb me-1"></i>Visi, Misi & Deskripsi</div></div>
        <div class="cp-body">
          <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Visi</label><textarea name="visi" class="form-control" rows="3"><?php echo e(old('visi', $profil->visi)); ?></textarea></div>
            <div class="col-md-6"><label class="form-label">Misi</label><textarea name="misi" class="form-control" rows="3"><?php echo e(old('misi', $profil->misi)); ?></textarea></div>
            <div class="col-12"><label class="form-label">Deskripsi</label><textarea name="deskripsi" class="form-control" rows="3"><?php echo e(old('deskripsi', $profil->deskripsi)); ?></textarea></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="mt-3">
    <button type="submit" class="btn btn-maroon"><i class="bi bi-save me-1"></i>Simpan Perubahan</button>
  </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/pengaturan/profil-instansi.blade.php ENDPATH**/ ?>