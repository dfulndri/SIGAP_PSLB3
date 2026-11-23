<?php $__env->startSection('title', 'Tindak Lanjut'); ?>
<?php $__env->startSection('breadcrumb', 'Tindak Lanjut'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-hd mb-3">
  <h1 class="page-ttl">Tindak Lanjut</h1>
  <p class="page-stl">Daftar tindak lanjut pengaduan yang ditugaskan kepada Anda</p>
</div>

<div class="card-panel">
  <div class="table-responsive">
    <table class="table sipplh-table">
      <thead><tr><th>No. Pengaduan</th><th>Terlapor</th><th>Tanggal</th><th>Catatan</th><th>Status</th></tr></thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $tindakLanjuts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td><code><?php echo e($tl->pengaduan?->nomor_pengaduan); ?></code></td>
          <td style="font-size:.82rem"><?php echo e($tl->pengaduan?->terlapor?->nama ?? '—'); ?></td>
          <td style="font-size:.82rem"><?php echo e($tl->tanggal->format('d M Y')); ?></td>
          <td style="font-size:.82rem;max-width:300px" class="text-truncate"><?php echo e($tl->catatan); ?></td>
          <td><span class="badge bg-<?php echo e($tl->status == 'selesai' ? 'success' : 'warning'); ?>"><?php echo e(ucfirst($tl->status)); ?></span></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="5"><div class="empty-state"><i class="bi bi-arrow-repeat"></i>Belum ada tindak lanjut</div></td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <div class="p-3"><?php echo e($tindakLanjuts->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.pengawas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/pengawas/tindak-lanjut/index.blade.php ENDPATH**/ ?>