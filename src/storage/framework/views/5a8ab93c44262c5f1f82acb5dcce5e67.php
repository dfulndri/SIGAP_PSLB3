<?php $__env->startSection('title','Profil Saya'); ?>
<?php $__env->startSection('breadcrumb','Profil Saya'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-hd"><h1 class="page-ttl">Profil Saya</h1><p class="page-stl">Perbarui informasi dan keamanan akun Anda.</p></div>

<?php if(session('success')): ?>
<div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3" style="font-size:.85rem">
  <i class="bi bi-check-circle-fill flex-shrink-0"></i> <?php echo e(session('success')); ?>

  <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<div class="row g-3 justify-content-center">
  <div class="col-12 col-lg-7">
    <form method="POST" action="<?php echo e(route('pengawas.profil.update')); ?>">
    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>

    <div class="card-panel mb-3">
      <div class="cp-head"><div class="cp-title">Informasi Pegawai</div></div>
      <div class="cp-body">
        
        <div class="d-flex align-items-center gap-3 mb-4 p-3 rounded" style="background:var(--mint-bg)">
          <div style="width:60px;height:60px;background:var(--maroon);color:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.5rem;font-weight:700;flex-shrink:0">
            <?php echo e(strtoupper(substr($user->name,0,1))); ?>

          </div>
          <div>
            <div style="font-size:1rem;font-weight:600"><?php echo e($user->name); ?></div>
            <div style="font-size:.82rem;color:var(--muted)"><?php echo e($user->email); ?></div>
            <span class="badge mt-1" style="background:var(--maroon);font-size:.72rem"><?php echo e(ucfirst($user->role)); ?></span>
          </div>
        </div>

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
              value="<?php echo e(old('name', $user->name)); ?>">
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
          <div class="col-md-6">
            <label class="form-label">No. Telepon / HP</label>
            <input type="text" name="no_telp" class="form-control"
              value="<?php echo e(old('no_telp', $user->no_telp)); ?>" placeholder="08xxxxxxxxxx">
          </div>
          <div class="col-12">
            <label class="form-label">Jabatan</label>
            <input type="text" name="jabatan" class="form-control"
              value="<?php echo e(old('jabatan', $user->jabatan)); ?>" placeholder="Jabatan resmi Anda">
          </div>
          <div class="col-md-6">
            <label class="form-label">NIP</label>
            <input type="text" class="form-control" value="<?php echo e($user->nip ?? '—'); ?>" disabled>
            <div class="form-text">NIP hanya dapat diubah oleh Administrator.</div>
          </div>
          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" value="<?php echo e($user->email); ?>" disabled>
          </div>
        </div>
      </div>
    </div>

    <div class="card-panel mb-3">
      <div class="cp-head">
        <div class="cp-title">Ubah Password</div>
        <div class="cp-sub">Kosongkan jika tidak ingin mengubah password</div>
      </div>
      <div class="cp-body">
        <div class="row g-3">
          <div class="col-12">
            <label class="form-label">Password Lama</label>
            <input type="password" name="old_password"
              class="form-control <?php $__errorArgs = ['old_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
              placeholder="Masukkan password saat ini">
            <?php $__errorArgs = ['old_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
          <div class="col-md-6">
            <label class="form-label">Password Baru</label>
            <input type="password" name="password"
              class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
              placeholder="Min. 8 karakter">
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
          <div class="col-md-6">
            <label class="form-label">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" class="form-control"
              placeholder="Ulangi password baru">
          </div>
        </div>
      </div>
    </div>

    <button type="submit" class="btn btn-maroon px-5">
      <i class="bi bi-save me-1"></i> Simpan Perubahan
    </button>

    </form>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.pengawas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/pengawas/profil/edit.blade.php ENDPATH**/ ?>