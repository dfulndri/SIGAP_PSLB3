<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> — SIPPLH</title>

  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  
  <link href="<?php echo e(asset('css/sipplh.css')); ?>" rel="stylesheet">

  <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

  
  <?php echo $__env->make('layouts.partials._sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  
  <div id="main-wrap">

    
    <?php echo $__env->make('layouts.partials._topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <main class="page-content">
      <?php echo $__env->yieldContent('content'); ?>
    </main>

  </div>

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>

  <script>
    // Sidebar toggle for mobile
    function toggleSidebar() {
      const sb  = document.getElementById('sidebar');
      const ov  = document.getElementById('sidebar-overlay');
      const mw  = document.getElementById('main-wrap');
      sb.classList.toggle('show');
      ov.style.display = sb.classList.contains('show') ? 'block' : 'none';
    }

    function closeSidebar() {
      const sb = document.getElementById('sidebar');
      const ov = document.getElementById('sidebar-overlay');
      sb.classList.remove('show');
      ov.style.display = 'none';
    }

    // CSRF setup for AJAX
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  </script>

  <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /var/www/html/resources/views/layouts/admin.blade.php ENDPATH**/ ?>