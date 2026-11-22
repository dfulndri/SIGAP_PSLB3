<?php $__env->startSection('title', 'Disposisi'); ?>
<?php $__env->startSection('breadcrumb', 'Disposisi'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-hd d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
  <div>
    <h1 class="page-ttl">Disposisi Pengaduan</h1>
    <p class="page-stl">Daftar pengaduan yang telah didisposisikan ke pengawas</p>
  </div>
  <a href="<?php echo e(route('admin.disposisi.create')); ?>" class="btn btn-sm btn-maroon"><i class="bi bi-plus-lg me-1"></i>Buat Disposisi</a>
</div>

<?php if(session('success')): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-size:.85rem">
  <i class="bi bi-check-circle me-1"></i><?php echo e(session('success')); ?>

  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<div class="card-panel">
  <div class="table-responsive">
    <table class="table sipplh-table">
      <thead><tr>
        <th>No. Pengaduan</th><th>Terlapor</th><th>Pengawas</th><th>Jadwal Verifikasi</th><th>Tgl Disposisi</th><th>Aksi</th>
      </tr></thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $disposisis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td><code><?php echo e($d->pengaduan?->nomor_pengaduan); ?></code></td>
          <td><?php echo e($d->pengaduan?->terlapor?->nama ?? '—'); ?></td>
          <td><span class="badge bg-info text-dark"><?php echo e($d->pengawas?->name); ?></span></td>
          <td><?php echo e($d->jadwal_verifikasi->format('d M Y')); ?></td>
          <td style="font-size:.82rem"><?php echo e($d->created_at->format('d M Y H:i')); ?></td>
          <td>
            <a href="<?php echo e(route('admin.disposisi.show', $d)); ?>" class="btn btn-xs btn-outline-secondary"><i class="bi bi-eye"></i></a>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="6"><div class="empty-state"><i class="bi bi-send"></i>Belum ada disposisi</div></td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <div class="p-3"><?php echo e($disposisis->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/disposisi/index.blade.php ENDPATH**/ ?>