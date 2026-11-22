<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> — SIPPLH Pengawas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="<?php echo e(asset('css/sipplh.css')); ?>" rel="stylesheet">
  <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

  <?php echo $__env->make('layouts.partials._sidebar_pengawas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <div id="main-wrap">
    
    <header id="topbar">
      <div class="tb-left">
        <button class="btn-sb-tog" onclick="toggleSidebar()"><i class="bi bi-list"></i></button>
        <div class="tb-crumb">
          <span>SIPPLH</span>
          <span class="mx-1 text-muted">/</span>
          <span class="cur"><?php echo $__env->yieldContent('breadcrumb','Dashboard'); ?></span>
        </div>
      </div>
      <div class="tb-right">
        <div class="dropdown">
          <button class="tb-user" data-bs-toggle="dropdown">
            <div class="tb-av"><?php echo e(strtoupper(substr(auth()->user()->name,0,1))); ?></div>
            <span class="d-none d-md-block ms-1"><?php echo e(auth()->user()->name); ?></span>
            <i class="bi bi-chevron-down ms-1" style="font-size:.65rem;color:var(--muted)"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end" style="min-width:200px">
            <li>
              <div class="px-3 py-2">
                <div style="font-size:.82rem;font-weight:600"><?php echo e(auth()->user()->name); ?></div>
                <div style="font-size:.72rem;color:var(--muted)"><?php echo e(auth()->user()->jabatan ?? 'Pengawas'); ?></div>
              </div>
            </li>
            <li><hr class="dropdown-divider my-1"></li>
            <li><a class="dropdown-item" href="<?php echo e(route('pengawas.profil.edit')); ?>"><i class="bi bi-person me-2"></i>Profil Saya</a></li>
            <li><hr class="dropdown-divider my-1"></li>
            <li>
              <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="dropdown-item text-danger">
                  <i class="bi bi-box-arrow-right me-2"></i>Keluar
                </button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </header>

    <main class="page-content">
      <?php echo $__env->yieldContent('content'); ?>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
  <script>
    function toggleSidebar(){
      const sb=document.getElementById('sidebar'),ov=document.getElementById('sidebar-overlay');
      sb.classList.toggle('show');
      ov.style.display=sb.classList.contains('show')?'block':'none';
    }
    function closeSidebar(){
      document.getElementById('sidebar').classList.remove('show');
      document.getElementById('sidebar-overlay').style.display='none';
    }
  </script>
  <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH /var/www/html/resources/views/layouts/pengawas.blade.php ENDPATH**/ ?>