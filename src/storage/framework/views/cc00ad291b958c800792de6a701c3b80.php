<?php $__env->startSection('title', 'Pengaduan Saya'); ?>
<?php $__env->startSection('breadcrumb', 'Pengaduan Saya'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-hd d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
  <div>
    <h1 class="page-ttl">Pengaduan Saya</h1>
    <p class="page-stl">Daftar pengaduan yang ditugaskan kepada Anda</p>
  </div>
</div>


<div class="d-flex gap-2 mb-3 flex-wrap">
  <a href="<?php echo e(route('pengawas.tugas.index')); ?>" class="btn btn-sm <?php echo e(!request('status') ? 'btn-maroon' : 'btn-outline-secondary'); ?>">Semua</a>
  <?php $__currentLoopData = ['didisposisikan' => 'Didisposisikan', 'verifikasi_lapangan' => 'Verifikasi', 'verifikasi_selesai' => 'Selesai Verif', 'tindak_lanjut' => 'Tindak Lanjut', 'selesai' => 'Selesai']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <a href="<?php echo e(route('pengawas.tugas.index', ['status' => $key])); ?>" class="btn btn-sm <?php echo e(request('status') == $key ? 'btn-maroon' : 'btn-outline-secondary'); ?>"><?php echo e($label); ?></a>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="card-panel">
  <div class="table-responsive">
    <table class="table sipplh-table">
      <thead><tr>
        <th>Nomor</th><th>Tanggal</th><th>Pelapor</th><th>Terlapor</th><th>Kecamatan</th><th>Status</th><th>Aksi</th>
      </tr></thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $pengaduans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td><code style="font-size:.78rem"><?php echo e($p->nomor_pengaduan); ?></code></td>
          <td style="font-size:.82rem"><?php echo e($p->tanggal_pengaduan->format('d M Y')); ?></td>
          <td style="font-size:.82rem"><?php echo e($p->pelapor?->nama_display ?? '—'); ?></td>
          <td style="font-size:.82rem"><?php echo e($p->terlapor?->nama ?? '—'); ?></td>
          <td style="font-size:.82rem"><?php echo e($p->kecamatan?->nama_kecamatan ?? '—'); ?></td>
          <td><span class="badge bg-<?php echo e($p->status_badge); ?>"><?php echo e($p->status_label); ?></span></td>
          <td>
            <a href="<?php echo e(route('pengawas.tugas.show', $p)); ?>" class="btn btn-xs btn-outline-secondary"><i class="bi bi-eye"></i></a>
            <?php if(in_array($p->status, ['didisposisikan','verifikasi_lapangan']) && !$p->verifikasi): ?>
            <a href="<?php echo e(route('pengawas.verifikasi.create', ['pengaduan_id' => $p->id])); ?>" class="btn btn-xs btn-outline-maroon" title="Mulai Verifikasi"><i class="bi bi-clipboard-check"></i></a>
            <?php endif; ?>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="7"><div class="empty-state"><i class="bi bi-inbox"></i>Belum ada tugas yang ditugaskan</div></td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <div class="p-3"><?php echo e($pengaduans->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.pengawas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/pengawas/tugas/index.blade.php ENDPATH**/ ?>