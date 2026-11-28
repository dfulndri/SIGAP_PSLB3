<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('breadcrumb', 'Dashboard'); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <style>
        #mapPengawas {
            height: 300px;
            border-radius: 8px;
            z-index: 0;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-hd mb-3">
        <h1 class="page-ttl">Dashboard Pengawas</h1>
        <p class="page-stl">Selamat datang, <strong><?php echo e(auth()->user()->name); ?></strong>. Berikut ringkasan tugas Anda.</p>
    </div>

    
    <div class="row g-3 mb-4">
        <?php $__currentLoopData = [['Total Tugas', $stats['total'], 'bi-folder2-open', 'var(--maroon)'], ['Menunggu Verifikasi', $stats['pending'], 'bi-hourglass-split', '#f59e0b'], ['Verifikasi Selesai', $stats['verifikasi'], 'bi-clipboard-check-fill', '#3b82f6'], ['Pengaduan Selesai', $stats['selesai'], 'bi-check-circle-fill', '#10b981']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$label, $val, $icon, $color]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6 col-md-3">
                <div class="stat-card" style="border-top-color:<?php echo e($color); ?>">
                    <div>
                        <div class="sc-num"><?php echo e($val); ?></div>
                        <div class="sc-lbl"><?php echo e($label); ?></div>
                    </div>
                    <i class="bi <?php echo e($icon); ?> sc-ic" style="color:<?php echo e($color); ?>"></i>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="row g-3 mb-4">
        
        <div class="col-md-7">
            <div class="card-panel h-100">
                <div class="cp-head">
                    <div class="cp-title">Tugas Terbaru</div>
                    <a href="<?php echo e(route('pengawas.tugas.index')); ?>" class="btn btn-xs btn-outline-maroon">Semua <i
                            class="bi bi-arrow-right"></i></a>
                </div>
                <div class="table-responsive">
                    <table class="table sipplh-table">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Terlapor</th>
                                <th>Jenis Pengaduan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $tugasTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><code style="font-size:.75rem"><?php echo e($t->nomor_pengaduan); ?></code></td>
                                    <td style="font-size:.82rem"><?php echo e($t->terlapor?->nama ?? '—'); ?></td>
                                    <td><?php echo $__env->make('partials.jenis-badges', ['pengaduan' => $t], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></td>
                                    <td><span class="badge bg-<?php echo e($t->status_badge); ?>"><?php echo e($t->status_label); ?></span></td>
                                    <td><a href="<?php echo e(route('pengawas.tugas.show', $t)); ?>"
                                            class="btn btn-xs btn-outline-secondary"><i class="bi bi-eye"></i></a></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5">
                                        <div class="empty-state"><i class="bi bi-inbox"></i>Belum ada tugas</div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        
        <div class="col-md-5">
            <div class="card-panel h-100">
                <div class="cp-head">
                    <div class="cp-title"><i class="bi bi-geo-alt-fill me-1" style="color:var(--maroon)"></i>Lokasi Tugas
                    </div>
                </div>
                <div class="cp-body p-0">
                    <div id="mapPengawas"></div>
                </div>
            </div>
        </div>
    </div>

    
    <?php if($verifikasiSaya->isNotEmpty()): ?>
        <div class="card-panel">
            <div class="cp-head">
                <div class="cp-title">Verifikasi Terakhir Saya</div>
            </div>
            <div class="table-responsive">
                <table class="table sipplh-table">
                    <thead>
                        <tr>
                            <th>No. Pengaduan</th>
                            <th>Terlapor</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $verifikasiSaya; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><code style="font-size:.75rem"><?php echo e($v->pengaduan?->nomor_pengaduan); ?></code></td>
                                <td style="font-size:.82rem"><?php echo e($v->pengaduan?->terlapor?->nama ?? '—'); ?></td>
                                <td style="font-size:.82rem"><?php echo e($v->tanggal_verifikasi->format('d M Y')); ?></td>
                                <td><span
                                        class="badge bg-<?php echo e($v->status == 'selesai' ? 'success' : 'warning'); ?>"><?php echo e(ucfirst($v->status)); ?></span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const map = L.map('mapPengawas').setView([-6.2, 106.63], 10);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OSM',
            maxZoom: 18
        }).addTo(map);
        const mapData = <?php echo json_encode($mapData, 15, 512) ?>;
        mapData.forEach(p => {
            const icon = L.divIcon({
                className: '',
                html: `<div style="width:12px;height:12px;border-radius:50%;background:var(--maroon);border:2px solid #fff;box-shadow:0 1px 3px rgba(0,0,0,.4)"></div>`,
                iconSize: [12, 12],
                iconAnchor: [6, 6]
            });
            L.marker([p.lat, p.lng], {
                icon
            }).addTo(map).bindPopup(
                `<strong>${p.nomor}</strong><br>${p.terlapor}<br><span class="badge" style="background:#6A0000;color:#fff;font-size:10px">${p.status}</span>`
                );
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.pengawas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/pengawas/dashboard/index.blade.php ENDPATH**/ ?>