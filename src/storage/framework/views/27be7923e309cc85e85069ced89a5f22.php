<?php $__env->startSection('title', 'Berita Acara'); ?>
<?php $__env->startSection('breadcrumb', 'Berita Acara'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-hd mb-3">
        <h1 class="page-ttl">Berita Acara Saya</h1>
        <p class="page-stl">Daftar berita acara dari verifikasi yang Anda lakukan</p>
    </div>

    <div class="card-panel">
        <div class="table-responsive">
            <table class="table sipplh-table">
                <thead>
                    <tr>
                        <th>Nomor BA</th>
                        <th>No. Pengaduan</th>
                        <th>Terlapor</th>
                        <th>Tanggal Terbit</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $beritaAcaras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ba): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><code><?php echo e($ba->nomor_ba); ?></code></td>
                            <td style="font-size:.82rem"><?php echo e($ba->verifikasi?->pengaduan?->nomor_pengaduan); ?></td>
                            <td style="font-size:.82rem"><?php echo e($ba->verifikasi?->pengaduan?->terlapor?->nama ?? '—'); ?></td>
                            <td style="font-size:.82rem"><?php echo e($ba->tanggal_terbit->format('d M Y')); ?></td>
                            <td><span
                                    class="badge bg-<?php echo e($ba->status == 'final' ? 'success' : 'warning'); ?>"><?php echo e(ucfirst($ba->status)); ?></span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="<?php echo e(route('pengawas.berita-acara.show', $ba)); ?>"
                                        class="btn btn-xs btn-outline-secondary"><i class="bi bi-eye"></i></a>
                                    <a href="<?php echo e(route('pengawas.berita-acara.pdf', $ba)); ?>"
                                        class="btn btn-xs btn-outline-success"><i class="bi bi-download"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6">
                                <div class="empty-state"><i class="bi bi-file-earmark-text"></i>Belum ada berita acara</div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="p-3"><?php echo e($beritaAcaras->links()); ?></div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.pengawas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/pengawas/berita-acara/index.blade.php ENDPATH**/ ?>