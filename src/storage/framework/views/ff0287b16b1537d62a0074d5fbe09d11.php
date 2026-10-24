<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login — SIPPLH DLHK Kab. Tangerang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="<?php echo e(asset('css/sipplh.css')); ?>" rel="stylesheet">
</head>
<body>
<div class="login-wrap">

  
  <div class="login-left">
    <div>
      <div class="d-flex align-items-center gap-2 mb-4">
        <div style="width:42px;height:42px;background:var(--mint);border-radius:10px;display:flex;align-items:center;justify-content:center;color:var(--maroon);font-size:1.3rem;">
          <i class="bi bi-leaf-fill"></i>
        </div>
        <div>
          <div style="font-size:1.1rem;font-weight:700;color:#fff;letter-spacing:.03em">SIPPLH</div>
          <div style="font-size:.65rem;color:rgba(255,255,255,.45)">DLHK Kab. Tangerang</div>
        </div>
      </div>

      <h2 style="font-size:1.6rem;font-weight:700;color:#fff;line-height:1.3;margin-bottom:.75rem">
        Sistem Informasi Pengaduan & Verifikasi Lingkungan Hidup
      </h2>

      <p style="font-size:.85rem;color:rgba(255,255,255,.55);line-height:1.7">
        Platform digital pengelolaan pengaduan lingkungan hidup dan laporan verifikasi lapangan
        Dinas Lingkungan Hidup dan Kebersihan Kabupaten Tangerang.
      </p>

      <div class="mt-4 d-flex flex-column gap-2" style="position:relative;z-index:1">
        <?php $__currentLoopData = [
          ['bi-file-check-fill','Pengaduan tercatat & tertelusur'],
          ['bi-clipboard2-check-fill','Berita Acara otomatis & valid'],
          ['bi-qr-code-scan','Verifikasi dokumen via QR Code'],
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="d-flex align-items-center gap-2" style="font-size:.8rem;color:rgba(255,255,255,.7)">
          <i class="bi <?php echo e($f[0]); ?>" style="color:var(--mint);font-size:.9rem"></i>
          <?php echo e($f[1]); ?>

        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>

    <div style="font-size:.68rem;color:rgba(255,255,255,.25);position:relative;z-index:1">
      &copy; <?php echo e(date('Y')); ?> DLHK Kabupaten Tangerang. All rights reserved.
    </div>
  </div>

  
  <div class="login-right">
    <div class="login-card">
      <div class="login-icon">
        <i class="bi bi-person-lock"></i>
      </div>

      <h5 style="font-weight:700;margin-bottom:4px">Selamat Datang</h5>
      <p style="font-size:.82rem;color:var(--muted);margin-bottom:1.5rem">
        Masuk untuk mengakses sistem SIPPLH
      </p>

      <?php if($errors->any()): ?>
      <div class="alert alert-danger d-flex align-items-center gap-2 py-2" style="font-size:.82rem">
        <i class="bi bi-exclamation-circle-fill"></i>
        <?php echo e($errors->first()); ?>

      </div>
      <?php endif; ?>

      <form method="POST" action="<?php echo e(route('login.post')); ?>">
        <?php echo csrf_field(); ?>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
            value="<?php echo e(old('email')); ?>" placeholder="nama@sipplh.go.id" required autofocus>
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <div class="pass-wrap">
            <input type="password" name="password" id="passInput"
              class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
              placeholder="••••••••" required style="padding-right:2.5rem">
            <button type="button" class="pass-toggle" onclick="togglePass()">
              <i class="bi bi-eye" id="passEyeIcon"></i>
            </button>
          </div>
        </div>

        <div class="d-flex align-items-center justify-content-between mb-4">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label" for="remember" style="font-size:.8rem">Ingat saya</label>
          </div>
        </div>

        <button type="submit" class="btn btn-maroon w-100 py-2" style="font-weight:500">
          <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
        </button>
      </form>

      <div class="mt-4 p-3 rounded" style="background:var(--mint-bg);font-size:.75rem;color:var(--muted)">
        <i class="bi bi-info-circle me-1"></i>
        Hanya pengguna yang terdaftar dan aktif yang dapat mengakses sistem ini.
        Hubungi Administrator jika mengalami kendala.
      </div>
    </div>
  </div>

</div>
<script>
function togglePass(){
  const inp = document.getElementById('passInput');
  const ico = document.getElementById('passEyeIcon');
  if(inp.type === 'password'){
    inp.type = 'text';
    ico.className = 'bi bi-eye-slash';
  } else {
    inp.type = 'password';
    ico.className = 'bi bi-eye';
  }
}
</script>
</body>
</html>
<?php /**PATH /var/www/html/resources/views/auth/login.blade.php ENDPATH**/ ?>