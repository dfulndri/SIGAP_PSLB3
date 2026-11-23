<?php $__env->startSection('title', 'Verifikasi Saya'); ?>
<?php $__env->startSection('breadcrumb', 'Verifikasi Lapangan'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-hd mb-3">
        <h1 class="page-ttl">Verifikasi Lapangan Saya</h1>
        <p class="page-stl">Daftar verifikasi lapangan yang Anda lakukan</p>
    </div>

    <div class="card-panel">
        <div class="table-responsive">
            <table class="table sipplh-table">
                <thead>
                    <tr>
                        <th>No. Pengaduan</th>
                        <th>Terlapor</th>
                        <th>Tanggal Verifikasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $verifikasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><code><?php echo e($v->pengaduan?->nomor_pengaduan); ?></code></td>
                            <td style="font-size:.82rem"><?php echo e($v->pengaduan?->terlapor?->nama ?? '—'); ?></td>
                            <td style="font-size:.82rem"><?php echo e($v->tanggal_verifikasi->format('d M Y')); ?></td>
                            <td><span
                                    class="badge bg-<?php echo e($v->status == 'selesai' ? 'success' : 'warning'); ?>"><?php echo e(ucfirst($v->status)); ?></span>
                            </td>
                            <td>
                                <?php if($v->pengaduan?->status !== \App\Models\Pengaduan::STATUS_ARSIP): ?>
                                    <a href="<?php echo e(route('pengawas.verifikasi.edit', $v)); ?>"
                                        class="btn btn-xs btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                                <?php endif; ?>
                                <a href="<?php echo e(route('pengawas.tugas.show', $v->pengaduan_id)); ?>"
                                    class="btn btn-xs btn-outline-secondary"><i class="bi bi-eye"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5">
                                <div class="empty-state"><i class="bi bi-clipboard-check"></i>Belum ada verifikasi</div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="p-3"><?php echo e($verifikasis->links()); ?></div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.pengawas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/pengawas/verifikasi/index.blade.php ENDPATH**/ ?>