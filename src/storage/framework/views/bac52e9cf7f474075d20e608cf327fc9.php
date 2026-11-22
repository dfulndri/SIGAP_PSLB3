<?php $__env->startSection('title', 'Detail Pengaduan'); ?>
<?php $__env->startSection('breadcrumb', 'Pengaduan / Detail'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .timeline-flow {
            display: flex;
            gap: 0;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .tf-step {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            font-size: .72rem;
            font-weight: 500;
            background: #f3f4f6;
            color: var(--muted);
            border-radius: 0;
            position: relative;
        }

        .tf-step:first-child {
            border-radius: 6px 0 0 6px;
        }

        .tf-step:last-child {
            border-radius: 0 6px 6px 0;
        }

        .tf-step.done {
            background: var(--maroon);
            color: #fff;
        }

        .tf-step.current {
            background: #10b981;
            color: #fff;
        }

        .tf-step i {
            font-size: .85rem;
        }

        .info-label {
            font-size: .78rem;
            color: var(--muted);
            font-weight: 500;
            margin-bottom: 2px;
        }

        .info-value {
            font-size: .88rem;
            color: var(--text);
            margin-bottom: .75rem;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-hd d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
        <div>
            <h1 class="page-ttl">Detail Pengaduan</h1>
            <p class="page-stl"><code><?php echo e($pengaduan->nomor_pengaduan); ?></code></p>
        </div>
        <div class="d-flex gap-2">
            <?php if(in_array($pengaduan->status, ['pengaduan_baru', 'menunggu_disposisi'])): ?>
                <a href="<?php echo e(route('admin.pengaduan.edit', $pengaduan)); ?>" class="btn btn-sm btn-outline-secondary"><i
                        class="bi bi-pencil me-1"></i>Edit</a>
                <a href="<?php echo e(route('admin.disposisi.create', ['pengaduan_id' => $pengaduan->id])); ?>"
                    class="btn btn-sm btn-maroon"><i class="bi bi-send me-1"></i>Disposisikan</a>
            <?php endif; ?>
            <a href="<?php echo e(route('admin.pengaduan.index')); ?>" class="btn btn-sm btn-outline-secondary"><i
                    class="bi bi-arrow-left me-1"></i>Kembali</a>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="font-size:.85rem">
            <i class="bi bi-check-circle me-1"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    
    <?php
        $workflow = [
            'pengaduan_baru',
            'menunggu_disposisi',
            'didisposisikan',
            'verifikasi_lapangan',
            'verifikasi_selesai',
            'tindak_lanjut',
            'selesai',
            'arsip',
        ];
        $currentIdx = array_search($pengaduan->status, $workflow);
        $icons = [
            'bi-plus-circle',
            'bi-hourglass',
            'bi-send',
            'bi-clipboard-check',
            'bi-check-circle',
            'bi-arrow-repeat',
            'bi-check-all',
            'bi-archive',
        ];
    ?>
    <div class="timeline-flow">
        <?php $__currentLoopData = $workflow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="tf-step <?php echo e($i < $currentIdx ? 'done' : ($i == $currentIdx ? 'current' : '')); ?>">
                <i class="bi <?php echo e($icons[$i]); ?>"></i>
                <?php echo e(\App\Models\Pengaduan::$statusList[$step]); ?>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="row g-3 align-items-start">
        
        <div class="col-md-8">
            <div class="card-panel mb-3">
                <div class="cp-head">
                    <div class="cp-title"><i class="bi bi-file-earmark-text me-1"></i>Informasi Pengaduan</div>
                </div>
                <div class="cp-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="info-label">Tanggal Pengaduan</div>
                            <div class="info-value"><?php echo e($pengaduan->tanggal_pengaduan->format('d M Y')); ?></div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-label">Sumber Laporan</div>
                            <div class="info-value"><span
                                    class="badge bg-<?php echo e($pengaduan->sumber_laporan == 'span_lapor' ? 'info' : 'secondary'); ?>"><?php echo e($pengaduan->sumber_laporan == 'span_lapor' ? 'SPAN LAPOR' : 'Manual'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-label">Status</div>
                            <div class="info-value"><span
                                    class="badge bg-<?php echo e($pengaduan->status_badge); ?>"><?php echo e($pengaduan->status_label); ?></span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="info-label">Jenis Pengaduan</div>
                            <div class="info-value">
                                <?php echo $__env->make('partials.jenis-badges', [
                                    'pengaduan' => $pengaduan,
                                    'stack' => false,
                                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="info-label">Uraian Pengaduan</div>
                            <div class="info-value" style="white-space:pre-line"><?php echo e($pengaduan->uraian_pengaduan); ?></div>
                        </div>
                        <?php if($pengaduan->lokasi_kejadian): ?>
                            <div class="col-12">
                                <div class="info-label">Lokasi Kejadian</div>
                                <div class="info-value"><?php echo e($pengaduan->lokasi_kejadian); ?></div>
                            </div>
                        <?php endif; ?>
                        <div class="col-md-4">
                            <div class="info-label">Kecamatan</div>
                            <div class="info-value"><?php echo e($pengaduan->kecamatan?->nama_kecamatan ?? '—'); ?></div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-label">Kelurahan</div>
                            <div class="info-value"><?php echo e($pengaduan->kelurahan?->nama_kelurahan ?? '—'); ?></div>
                        </div>
                        <?php if($pengaduan->koordinat_lat): ?>
                            <div class="col-md-4">
                                <div class="info-label">Koordinat</div>
                                <div class="info-value"><?php echo e($pengaduan->koordinat_lat); ?>, <?php echo e($pengaduan->koordinat_lng); ?>

                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if($pengaduan->dokumen_pendukung): ?>
                            <div class="col-12">
                                <div class="info-label">Dokumen Pendukung</div>
                                <div class="info-value"><a href="<?php echo e(asset('storage/' . $pengaduan->dokumen_pendukung)); ?>"
                                        target="_blank" class="btn btn-xs btn-outline-maroon"><i
                                            class="bi bi-download me-1"></i>Unduh Dokumen</a></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            
            <?php if($pengaduan->disposisi): ?>
                <div class="card-panel mb-3">
                    <div class="cp-head">
                        <div class="cp-title"><i class="bi bi-send-fill me-1"></i>Disposisi</div>
                    </div>
                    <div class="cp-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="info-label">Pengawas</div>
                                <div class="info-value"><strong><?php echo e($pengaduan->disposisi->pengawas?->name); ?></strong></div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-label">Jadwal Verifikasi</div>
                                <div class="info-value"><?php echo e($pengaduan->disposisi->jadwal_verifikasi->format('d M Y')); ?>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-label">Didisposisikan Oleh</div>
                                <div class="info-value"><?php echo e($pengaduan->disposisi->pembuat?->name); ?></div>
                            </div>
                            <?php if($pengaduan->disposisi->catatan): ?>
                                <div class="col-12">
                                    <div class="info-label">Catatan</div>
                                    <div class="info-value"><?php echo e($pengaduan->disposisi->catatan); ?></div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            
            <?php if($pengaduan->verifikasi): ?>
                <div class="card-panel mb-3">
                    <div class="cp-head">
                        <div class="cp-title"><i class="bi bi-clipboard-check-fill me-1"></i>Verifikasi Lapangan</div>
                        <a href="<?php echo e(route('admin.verifikasi.show', $pengaduan->verifikasi)); ?>"
                            class="btn btn-xs btn-outline-maroon">Detail <i class="bi bi-arrow-right"></i></a>
                    </div>
                    <div class="cp-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="info-label">Tanggal</div>
                                <div class="info-value"><?php echo e($pengaduan->verifikasi->tanggal_verifikasi->format('d M Y')); ?>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="info-label">Status</div>
                                <div class="info-value"><span
                                        class="badge bg-<?php echo e($pengaduan->verifikasi->status == 'selesai' ? 'success' : 'warning'); ?>"><?php echo e(ucfirst($pengaduan->verifikasi->status)); ?></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="info-label">Verifikator</div>
                                <div class="info-value"><?php echo e($pengaduan->verifikasi->pembuat?->name); ?></div>
                            </div>
                            <?php if($pengaduan->verifikasi->beritaAcara): ?>
                                <div class="col-md-3">
                                    <div class="info-label">Berita Acara</div>
                                    <div class="info-value"><a
                                            href="<?php echo e(route('admin.berita-acara.show', $pengaduan->verifikasi->beritaAcara)); ?>"
                                            class="btn btn-xs btn-outline-maroon"><?php echo e($pengaduan->verifikasi->beritaAcara->nomor_ba); ?></a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            
            <?php if($pengaduan->tindakLanjut->isNotEmpty()): ?>
                <div class="card-panel mb-3">
                    <div class="cp-head">
                        <div class="cp-title"><i class="bi bi-arrow-repeat me-1"></i>Tindak Lanjut</div>
                    </div>
                    <div class="cp-body">
                        <?php $__currentLoopData = $pengaduan->tindakLanjut; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="border rounded p-3 mb-2" style="font-size:.84rem">
                                <div class="d-flex justify-content-between mb-1">
                                    <strong><?php echo e($tl->tanggal->format('d M Y')); ?></strong>
                                    <span
                                        class="badge bg-<?php echo e($tl->status == 'selesai' ? 'success' : 'warning'); ?>"><?php echo e(ucfirst($tl->status)); ?></span>
                                </div>
                                <p class="mb-1"><?php echo e($tl->catatan); ?></p>
                                <?php if($tl->hasil): ?>
                                    <p class="text-muted mb-0"><strong>Hasil:</strong> <?php echo e($tl->hasil); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        
        <div class="col-md-4">
            <div class="card-panel mb-3">
                <div class="cp-head">
                    <div class="cp-title"><i class="bi bi-person-badge me-1"></i>Pelapor</div>
                </div>
                <div class="cp-body">
                    <div class="info-label">Nama</div>
                    <div class="info-value"><?php echo e($pengaduan->pelapor?->nama_display); ?></div>
                    <div class="info-label">Jenis</div>
                    <div class="info-value"><span
                            class="badge bg-info text-dark"><?php echo e($pengaduan->pelapor?->jenis_label); ?></span></div>
                    <?php if($pengaduan->pelapor?->nik): ?>
                        <div class="info-label">NIK</div>
                        <div class="info-value"><?php echo e($pengaduan->pelapor->nik); ?></div>
                    <?php endif; ?>
                    <?php if($pengaduan->pelapor?->no_telp): ?>
                        <div class="info-label">No. Telp</div>
                        <div class="info-value"><?php echo e($pengaduan->pelapor->no_telp); ?></div>
                    <?php endif; ?>
                    <?php if($pengaduan->pelapor?->email): ?>
                        <div class="info-label">Email</div>
                        <div class="info-value"><?php echo e($pengaduan->pelapor->email); ?></div>
                    <?php endif; ?>
                    <?php if($pengaduan->pelapor?->alamat): ?>
                        <div class="info-label">Alamat</div>
                        <div class="info-value"><?php echo e($pengaduan->pelapor->alamat); ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card-panel mb-3">
                <div class="cp-head">
                    <div class="cp-title"><i class="bi bi-exclamation-triangle me-1"></i>Terlapor</div>
                </div>
                <div class="cp-body">
                    <div class="info-label">Nama</div>
                    <div class="info-value"><?php echo e($pengaduan->terlapor?->nama ?? '—'); ?></div>
                    <div class="info-label">Jenis</div>
                    <div class="info-value"><span
                            class="badge bg-warning text-dark"><?php echo e($pengaduan->terlapor?->jenis_label); ?></span></div>
                    <?php if($pengaduan->terlapor?->jenis_usaha): ?>
                        <div class="info-label">Jenis Usaha</div>
                        <div class="info-value"><?php echo e($pengaduan->terlapor->jenis_usaha); ?></div>
                    <?php endif; ?>
                    <?php if($pengaduan->terlapor?->alamat): ?>
                        <div class="info-label">Alamat</div>
                        <div class="info-value"><?php echo e($pengaduan->terlapor->alamat); ?></div>
                    <?php endif; ?>
                    <?php if($pengaduan->terlapor?->no_telp): ?>
                        <div class="info-label">No. Telp</div>
                        <div class="info-value"><?php echo e($pengaduan->terlapor->no_telp); ?></div>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="card-panel">
                <div class="cp-head">
                    <div class="cp-title"><i class="bi bi-lightning me-1"></i>Aksi Cepat</div>
                </div>
                <div class="cp-body">
                    <form action="<?php echo e(route('admin.pengaduan.status', $pengaduan)); ?>" method="POST">
                        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                        <div class="mb-2">
                            <label class="form-label">Ubah Status</label>
                            <select name="status" class="form-select form-select-sm">
                                <?php $__currentLoopData = \App\Models\Pengaduan::$statusList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>"
                                        <?php echo e($pengaduan->status == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Catatan (opsional)</label>
                            <textarea name="catatan_admin" class="form-control form-control-sm" rows="2"><?php echo e($pengaduan->catatan_admin); ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-sm btn-maroon w-100"><i
                                class="bi bi-save me-1"></i>Update</button>
                    </form>

                    <hr>
                    <?php if(!$pengaduan->disposisi && in_array($pengaduan->status, ['pengaduan_baru', 'menunggu_disposisi'])): ?>
                        <a href="<?php echo e(route('admin.disposisi.create', ['pengaduan_id' => $pengaduan->id])); ?>"
                            class="btn btn-sm btn-outline-maroon w-100 mb-2"><i
                                class="bi bi-send me-1"></i>Disposisikan</a>
                    <?php endif; ?>
                    <?php if(!$pengaduan->verifikasi && in_array($pengaduan->status, ['didisposisikan'])): ?>
                        <a href="<?php echo e(route('admin.verifikasi.create', ['pengaduan_id' => $pengaduan->id])); ?>"
                            class="btn btn-sm btn-outline-maroon w-100 mb-2"><i
                                class="bi bi-clipboard-check me-1"></i>Buat Verifikasi</a>
                    <?php endif; ?>
                    <?php if(in_array($pengaduan->status, ['verifikasi_selesai', 'tindak_lanjut'])): ?>
                        <a href="<?php echo e(route('admin.tindak-lanjut.create', ['pengaduan_id' => $pengaduan->id])); ?>"
                            class="btn btn-sm btn-outline-maroon w-100 mb-2"><i class="bi bi-arrow-repeat me-1"></i>Tindak
                            Lanjut</a>
                    <?php endif; ?>

                    <form action="<?php echo e(route('admin.pengaduan.destroy', $pengaduan)); ?>" method="POST"
                        onsubmit="return confirm('Hapus pengaduan ini secara permanen?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100"><i
                                class="bi bi-trash me-1"></i>Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/pengaduan/show.blade.php ENDPATH**/ ?>