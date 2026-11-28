<?php $__env->startSection('title','Edit User — ' . $user->name); ?>
<?php $__env->startSection('breadcrumb','Edit User'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-hd d-flex align-items-center justify-content-between">
  <div>
    <h1 class="page-ttl">Edit Pengguna</h1>
    <p class="page-stl">Memperbarui data akun <strong><?php echo e($user->name); ?></strong></p>
  </div>
  <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-sm btn-outline-secondary">
    <i class="bi bi-arrow-left me-1"></i> Kembali
  </a>
</div>

<?php if($errors->any()): ?>
<div class="alert alert-danger alert-dismissible fade show mb-3" style="font-size:.85rem">
  <i class="bi bi-exclamation-circle-fill me-1"></i>
  <strong>Periksa kembali isian:</strong>
  <ul class="mb-0 mt-1 ps-4"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<div class="row g-3 justify-content-center">
  <div class="col-12 col-lg-8">
    <form method="POST" action="<?php echo e(route('admin.users.update', $user)); ?>">
    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>

    <div class="card-panel mb-3">
      <div class="cp-head">
        <div class="cp-title">Informasi Akun</div>
      </div>
      <div class="cp-body">
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
            <label class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
              value="<?php echo e(old('email', $user->email)); ?>">
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
          <div class="col-md-6">
            <label class="form-label">Password Baru
              <small class="text-muted">(kosongkan jika tidak ingin mengubah)</small>
            </label>
            <div class="input-group">
              <input type="password" name="password" id="passInput"
                class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                placeholder="Password baru...">
              <button type="button" class="btn btn-outline-secondary" onclick="togglePass()">
                <i class="bi bi-eye" id="passIcon"></i>
              </button>
            </div>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger mt-1" style="font-size:.78rem"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
          <div class="col-md-6">
            <label class="form-label">Role <span class="text-danger">*</span></label>
            <select name="role" class="form-select <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
              <?php echo e($user->id === auth()->id() ? 'disabled' : ''); ?>>
              <?php $__currentLoopData = ['admin'=>'Admin','pengawas'=>'Pengawas','viewer'=>'Viewer']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v => $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($v); ?>" <?php echo e(old('role', $user->role) == $v ? 'selected' : ''); ?>><?php echo e($l); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php if($user->id === auth()->id()): ?>
            <div class="form-text">Role tidak dapat diubah untuk akun yang sedang aktif.</div>
            <input type="hidden" name="role" value="<?php echo e($user->role); ?>">
            <?php endif; ?>
            <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
        </div>
      </div>
    </div>

    <div class="card-panel mb-3">
      <div class="cp-head"><div class="cp-title">Informasi Pegawai</div></div>
      <div class="cp-body">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">NIP</label>
            <input type="text" name="nip" class="form-control"
              value="<?php echo e(old('nip', $user->nip)); ?>">
          </div>
          <div class="col-md-6">
            <label class="form-label">No. Telepon</label>
            <input type="text" name="no_telp" class="form-control"
              value="<?php echo e(old('no_telp', $user->no_telp)); ?>">
          </div>
          <div class="col-12">
            <label class="form-label">Jabatan</label>
            <input type="text" name="jabatan" class="form-control"
              value="<?php echo e(old('jabatan', $user->jabatan)); ?>">
          </div>
          <?php if($user->id !== auth()->id()): ?>
          <div class="col-12">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="is_active"
                id="isActive" value="1"
                <?php echo e(old('is_active', $user->is_active) ? 'checked' : ''); ?>>
              <label class="form-check-label" for="isActive" style="font-size:.85rem">
                <i class="bi bi-check-circle me-1 text-success"></i> Akun aktif (bisa login)
              </label>
            </div>
          </div>
          <?php else: ?>
          <input type="hidden" name="is_active" value="1">
          <?php endif; ?>
        </div>
      </div>
    </div>

    
    <div class="card-panel mb-3">
      <div class="cp-body" style="font-size:.75rem;color:var(--muted);line-height:2">
        <div><strong>ID:</strong> #<?php echo e($user->id); ?></div>
        <div><strong>Dibuat:</strong> <?php echo e($user->created_at->format('d/m/Y H:i')); ?></div>
        <div><strong>Terakhir update:</strong> <?php echo e($user->updated_at->format('d/m/Y H:i')); ?></div>
      </div>
    </div>

    <div class="d-flex justify-content-between">
      <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-outline-secondary">
        <i class="bi bi-x-circle me-1"></i> Batal
      </a>
      <button type="submit" class="btn btn-maroon px-5">
        <i class="bi bi-save me-1"></i> Simpan Perubahan
      </button>
    </div>

    </form>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
function togglePass(){
  const inp = document.getElementById('passInput');
  const ico = document.getElementById('passIcon');
  inp.type = inp.type === 'password' ? 'text' : 'password';
  ico.className = inp.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/users/edit.blade.php ENDPATH**/ ?>