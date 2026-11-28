<?php $__env->startSection('title', 'Buat Disposisi'); ?>
<?php $__env->startSection('breadcrumb', 'Disposisi / Buat Baru'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-hd mb-3">
  <h1 class="page-ttl">Buat Disposisi Pengaduan</h1>
  <p class="page-stl">Disposisikan pengaduan ke pengawas lapangan untuk verifikasi</p>
</div>

<div class="card-panel">
  <div class="cp-head"><div class="cp-title">Form Disposisi</div></div>
  <div class="cp-body">
    <form action="<?php echo e(route('admin.disposisi.store')); ?>" method="POST">
      <?php echo csrf_field(); ?>

      <div class="mb-3">
        <label class="form-label">Pilih Pengaduan <span class="text-danger">*</span></label>
        <select name="pengaduan_id" class="form-select <?php $__errorArgs = ['pengaduan_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
          <option value="">— Pilih pengaduan —</option>
          <?php $__currentLoopData = $pengaduanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($pg->id); ?>" <?php echo e(($pengaduan?->id == $pg->id || old('pengaduan_id') == $pg->id) ? 'selected' : ''); ?>>
              <?php echo e($pg->nomor_pengaduan); ?> — <?php echo e($pg->terlapor?->nama ?? 'N/A'); ?>

            </option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php $__errorArgs = ['pengaduan_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="row g-3 mb-3">
        <div class="col-md-6">
          <label class="form-label">Pengawas Lapangan <span class="text-danger">*</span></label>
          <select name="pengawas_id" class="form-select <?php $__errorArgs = ['pengawas_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
            <option value="">— Pilih pengawas —</option>
            <?php $__currentLoopData = $pengawas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($p->id); ?>" <?php echo e(old('pengawas_id') == $p->id ? 'selected' : ''); ?>><?php echo e($p->name); ?> (<?php echo e($p->nip ?? '-'); ?>)</option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <?php $__errorArgs = ['pengawas_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="col-md-6">
          <label class="form-label">Jadwal Verifikasi <span class="text-danger">*</span></label>
          <input type="date" name="jadwal_verifikasi" class="form-control <?php $__errorArgs = ['jadwal_verifikasi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('jadwal_verifikasi')); ?>" required>
          <?php $__errorArgs = ['jadwal_verifikasi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Catatan Disposisi</label>
        <textarea name="catatan" class="form-control" rows="3" placeholder="Catatan atau arahan khusus..."><?php echo e(old('catatan')); ?></textarea>
      </div>

      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-maroon"><i class="bi bi-send-fill me-1"></i>Disposisikan</button>
        <a href="<?php echo e(route('admin.disposisi.index')); ?>" class="btn btn-outline-secondary">Batal</a>
      </div>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/disposisi/create.blade.php ENDPATH**/ ?>