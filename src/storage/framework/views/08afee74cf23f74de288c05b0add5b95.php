<?php $__env->startSection('title', 'Detail BA — ' . $ba->nomor_ba); ?>
<?php $__env->startSection('breadcrumb', 'Berita Acara / Detail'); ?>

<?php $__env->startSection('content'); ?>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3"
            style="font-size:.85rem">
            <i class="bi bi-check-circle-fill flex-shrink-0"></i> <?php echo e(session('success')); ?>

            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="page-hd d-flex align-items-start justify-content-between flex-wrap gap-3">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <span class="badge bg-<?php echo e($ba->status === 'final' ? 'success' : 'warning'); ?> px-3 py-2"
                    style="font-size:.82rem">
                    <?php echo e(ucfirst($ba->status)); ?>

                </span>
                <code style="font-size:.95rem;color:var(--maroon)"><?php echo e($ba->nomor_ba); ?></code>
            </div>
            <h1 class="page-ttl">Berita Acara Verifikasi Lapangan</h1>
            <p class="page-stl">Diterbitkan <?php echo e($ba->tanggal_terbit->format('d F Y')); ?> &middot; oleh
                <?php echo e($ba->pembuat?->name); ?></p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <a href="<?php echo e(route('pengawas.berita-acara.pdf', $ba)); ?>" class="btn btn-sm btn-maroon" target="_blank">
                <i class="bi bi-file-earmark-pdf me-1"></i> Download PDF
            </a>
            <a href="<?php echo e(route('pengawas.tugas.show', $ba->verifikasi->pengaduan_id)); ?>"
                class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-clipboard-check me-1"></i> Lihat Verifikasi
            </a>
            <a href="<?php echo e(route('pengawas.berita-acara.index')); ?>" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    
    <div class="card-panel mb-3" style="border:2px solid var(--maroon)">
        
        <div class="cp-body" style="border-bottom:2px solid var(--maroon);padding-bottom:1rem;text-align:center">
            <div style="font-size:.8rem;font-weight:500;color:var(--muted)">PEMERINTAH KABUPATEN TANGERANG</div>
            <div style="font-size:1.1rem;font-weight:700;color:var(--maroon)">DINAS LINGKUNGAN HIDUP DAN KEBERSIHAN</div>
            <div style="font-size:.78rem;color:var(--muted)">Kabupaten Tangerang, Provinsi Banten</div>
        </div>
        <div class="cp-body">
            <h2
                style="text-align:center;font-size:1rem;font-weight:700;text-transform:uppercase;margin:1rem 0;letter-spacing:.05em">
                BERITA ACARA HASIL VERIFIKASI LAPANGAN<br>
                PENGADUAN DUGAAN PENCEMARAN DAN/ATAU PERUSAKAN LINGKUNGAN HIDUP
            </h2>
            <div class="d-flex justify-content-between" style="font-size:.82rem;margin-bottom:1.5rem">
                <span><strong>Nomor:</strong> <?php echo e($ba->nomor_ba); ?></span>
                <span><strong>Tanggal:</strong> <?php echo e($ba->tanggal_terbit->isoFormat('D MMMM Y')); ?></span>
            </div>

            
            <h6
                style="font-weight:700;color:var(--maroon);border-bottom:1px solid var(--border);padding-bottom:4px;margin-bottom:10px">
                A. IDENTITAS PENGAWAS LINGKUNGAN HIDUP
            </h6>
            <div class="table-responsive mb-4">
                <table class="table table-bordered sipplh-table" style="font-size:.82rem">
                    <thead style="background:rgba(106,0,0,.07)">
                        <tr>
                            <th style="width:40px">No</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Pangkat / Gol</th>
                            <th>Jabatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $ba->verifikasi?->timVerifikator ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="text-center"><?php echo e($t->urutan); ?></td>
                                <td><strong><?php echo e($t->nama); ?></strong></td>
                                <td><code style="font-size:.78rem"><?php echo e($t->nip ?: '—'); ?></code></td>
                                <td><?php echo e($t->pangkat ?: '—'); ?></td>
                                <td><?php echo e($t->jabatan ?: '—'); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted">—</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            
            <h6
                style="font-weight:700;color:var(--maroon);border-bottom:1px solid var(--border);padding-bottom:4px;margin-bottom:10px">
                B. IDENTITAS PENANGGUNG JAWAB USAHA / KEGIATAN
            </h6>
            <?php $pj = $ba->verifikasi?->penanggungJawab; ?>
            <?php if($pj): ?>
                <div class="row g-2 mb-4" style="font-size:.82rem">
                    <?php $__currentLoopData = [['Nama Penanggung Jawab', $pj->nama_pj], ['Jabatan', $pj->jabatan_pj ?: '—'], ['Nama Perusahaan', $pj->nama_perusahaan], ['Bidang Usaha / Kegiatan', $pj->bidang_usaha ?: '—'], ['Kode KBLI', $pj->kbli_display ?: '—'], ['NIB', $pj->nib ?: '—'], ['No. Telepon', $pj->no_telp ?: '—'], ['Email', $pj->email ?: '—']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$lbl, $val]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-6 col-md-3">
                            <div style="font-size:.68rem;color:var(--muted);text-transform:uppercase;letter-spacing:.04em">
                                <?php echo e($lbl); ?></div>
                            <div style="margin-top:2px;border-bottom:1px solid var(--border);padding-bottom:3px">
                                <?php echo e($val); ?></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if($pj->alamat_perusahaan): ?>
                        <div class="col-12">
                            <div style="font-size:.68rem;color:var(--muted);text-transform:uppercase;letter-spacing:.04em">
                                Alamat Perusahaan</div>
                            <div style="margin-top:2px;border-bottom:1px solid var(--border);padding-bottom:3px">
                                <?php echo e($pj->alamat_perusahaan); ?></div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <p class="text-muted mb-4" style="font-size:.82rem">— Data penanggung jawab belum diisi</p>
            <?php endif; ?>

            
            <h6
                style="font-weight:700;color:var(--maroon);border-bottom:1px solid var(--border);padding-bottom:4px;margin-bottom:10px">
                C. INFORMASI ADMINISTRASI
            </h6>
            <div class="mb-4 p-3 rounded rte-content"
                style="background:#fafafa;border:1px solid var(--border);font-size:.875rem;line-height:1.8;min-height:80px">
                <?php echo $ba->verifikasi?->informasi_administrasi ?: '—'; ?>

            </div>

            
            <h6
                style="font-weight:700;color:var(--maroon);border-bottom:1px solid var(--border);padding-bottom:4px;margin-bottom:10px">
                D. FAKTA TEMUAN LAPANGAN
            </h6>
            <div class="mb-4 p-3 rounded rte-content"
                style="background:#fafafa;border:1px solid var(--border);font-size:.875rem;line-height:1.8;min-height:80px">
                <?php echo $ba->verifikasi?->fakta_temuan ?: '—'; ?>

            </div>

            
            <h6
                style="font-weight:700;color:var(--maroon);border-bottom:1px solid var(--border);padding-bottom:4px;margin-bottom:10px">
                E. SARAN DAN REKOMENDASI TINDAK LANJUT
            </h6>
            <div class="mb-4 p-3 rounded rte-content"
                style="background:#fafafa;border:1px solid var(--border);font-size:.875rem;line-height:1.8;min-height:80px">
                <?php echo $ba->verifikasi?->saran_tindak_lanjut ?: '—'; ?>

            </div>

            
            <?php if($ba->verifikasi?->tenggat_tindak_lanjut): ?>
                <div class="p-3 rounded mb-4"
                    style="background:rgba(106,0,0,.04);border:1px solid rgba(106,0,0,.15);font-size:.82rem;line-height:1.7">
                    <i class="bi bi-info-circle-fill me-1" style="color:var(--maroon)"></i>
                    Berdasarkan hasil verifikasi lapangan di atas, penanggung jawab usaha/kegiatan <strong>wajib
                        menindaklanjuti
                        rekomendasi tersebut dalam jangka waktu 14 (empat belas) hari kalender</strong>, paling lambat
                    tanggal
                    <strong><?php echo e($ba->verifikasi->tenggat_tindak_lanjut->isoFormat('D MMMM Y')); ?></strong>.
                </div>
            <?php endif; ?>

            
            <div class="row g-4 mt-2">
                <div class="col-12 col-md-5">
                    <div style="text-align:center">
                        <div style="font-size:.82rem;font-weight:500;margin-bottom:4px">Tim Verifikator DLHK</div>
                        <?php $__empty_1 = true; $__currentLoopData = $ba->verifikasi?->timVerifikator ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div style="margin-top:50px;border-top:1px solid #333;padding-top:4px;font-size:.78rem">
                                <strong><?php echo e($t->nama); ?></strong>
                                <?php if($t->nip): ?>
                                    <div style="color:var(--muted)">NIP: <?php echo e($t->nip); ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div style="margin-top:60px;border-top:1px solid #ccc"></div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-12 col-md-2 text-center d-none d-md-flex align-items-end justify-content-center">
                    <div style="font-size:.78rem;color:var(--muted)">dan</div>
                </div>
                <div class="col-12 col-md-5">
                    <div style="text-align:center">
                        <div style="font-size:.82rem;font-weight:500;margin-bottom:4px">Penanggung Jawab Usaha</div>
                        <div style="margin-top:50px;border-top:1px solid #333;padding-top:4px;font-size:.78rem">
                            <strong><?php echo e($pj?->nama_pj ?? '.................................'); ?></strong>
                            <?php if($pj?->jabatan_pj): ?>
                                <div style="color:var(--muted)"><?php echo e($pj->jabatan_pj); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="mt-4 pt-3 border-top text-center" style="font-size:.72rem;color:var(--muted)">
                <i class="bi bi-qr-code me-1"></i>
                Token validasi: <code><?php echo e($ba->qr_code_token); ?></code> &mdash;
                Verifikasi di: <a href="<?php echo e(route('ba.verify', $ba->qr_code_token)); ?>"
                    target="_blank"><?php echo e(url('/verify/' . $ba->qr_code_token)); ?></a>
            </div>
        </div>
    </div>

    
    <?php if($ba->verifikasi?->dokumentasiFoto?->isNotEmpty()): ?>
        <div class="card-panel">
            <div class="cp-head">
                <div class="cp-title"><i class="bi bi-images me-1 text-muted"></i> Dokumentasi Foto</div>
            </div>
            <div class="cp-body">
                <div class="row g-2">
                    <?php $__currentLoopData = $ba->verifikasi->dokumentasiFoto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-6 col-md-3 col-lg-2">
                            <div style="border-radius:6px;overflow:hidden;border:1px solid var(--border)">
                                <img src="<?php echo e(Storage::url($foto->path_file)); ?>" alt="<?php echo e($foto->keterangan); ?>"
                                    style="width:100%;aspect-ratio:1;object-fit:cover;cursor:pointer"
                                    onclick="openPhoto(this.src,'<?php echo e($foto->keterangan); ?>')">
                                <?php if($foto->keterangan): ?>
                                    <div style="padding:3px 6px;font-size:.65rem;color:var(--muted)">
                                        <?php echo e($foto->keterangan); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="modal fade" id="photoModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-dark border-0">
                <div class="modal-header border-0 pb-0">
                    <small id="photoCaption" class="text-white-50"></small>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-2 text-center">
                    <img id="photoSrc" src="" style="max-width:100%;max-height:75vh;border-radius:4px">
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
    <style>
        .rte-content p {
            margin: 0 0 .5rem;
        }

        .rte-content ul,
        .rte-content ol {
            margin: .25rem 0 .5rem;
            padding-left: 1.4rem;
        }

        .rte-content img {
            max-width: 100%;
            height: auto;
        }

        .rte-content table {
            border-collapse: collapse;
            width: 100%;
            margin: .5rem 0;
        }

        .rte-content table td,
        .rte-content table th {
            border: 1px solid #bbb;
            padding: 4px 8px;
        }

        .rte-content .ql-align-center,
        .rte-content [style*="text-align:center"] {
            text-align: center;
        }

        .rte-content .ql-align-right {
            text-align: right;
        }

        .rte-content .ql-align-justify {
            text-align: justify;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        function openPhoto(src, cap) {
            document.getElementById('photoSrc').src = src;
            document.getElementById('photoCaption').textContent = cap || '';
            new bootstrap.Modal(document.getElementById('photoModal')).show();
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.pengawas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/pengawas/berita-acara/show.blade.php ENDPATH**/ ?>