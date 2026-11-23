<?php $__env->startSection('title', 'Detail Tugas'); ?>
<?php $__env->startSection('breadcrumb', 'Tugas / Detail'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        /* Halaman ini: card menyesuaikan tinggi konten, tidak melar (hindari ruang kosong) */
        .card-panel {
            height: auto !important;
        }

        .tf-step {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            font-size: .68rem;
            font-weight: 500;
            background: #f3f4f6;
            color: var(--muted);
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

        /* Verifikasi sections */
        .vsec-title {
            font-size: .8rem;
            font-weight: 700;
            color: var(--maroon);
            text-transform: uppercase;
            letter-spacing: .03em;
            padding-bottom: 4px;
            margin: .25rem 0 .6rem;
            border-bottom: 1px solid var(--border);
        }

        .vsec-empty {
            font-size: .82rem;
            font-style: italic;
        }

        .vtable {
            font-size: .82rem;
        }

        .vtable thead th {
            font-size: .7rem;
            text-transform: uppercase;
            letter-spacing: .03em;
            color: var(--muted);
            background: rgba(106, 0, 0, .05);
            border-bottom: 1px solid var(--border);
        }

        .vtable td {
            vertical-align: middle;
        }

        .vbox {
            font-size: .86rem;
            line-height: 1.7;
            background: #fafafa;
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: .6rem .8rem;
            margin-top: 2px;
        }

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

        .vsaksi {
            font-size: .86rem;
            padding: .35rem .5rem;
            background: #fafafa;
            border: 1px solid var(--border);
            border-radius: 6px;
            margin-bottom: .4rem;
        }

        .vsaksi-no {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: var(--maroon);
            color: #fff;
            font-size: .72rem;
            font-weight: 600;
            flex-shrink: 0;
        }

        .vfoto {
            width: 100%;
            aspect-ratio: 1;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid var(--border);
            cursor: pointer;
            transition: transform .15s;
        }

        .vfoto:hover {
            transform: scale(1.03);
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-hd d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
        <div>
            <h1 class="page-ttl">Detail Tugas</h1>
            <p class="page-stl"><code><?php echo e($pengaduan->nomor_pengaduan); ?></code></p>
        </div>
        <div class="d-flex gap-2">
            <?php if(in_array($pengaduan->status, ['didisposisikan', 'verifikasi_lapangan']) && !$pengaduan->verifikasi): ?>
                <a href="<?php echo e(route('pengawas.verifikasi.create', ['pengaduan_id' => $pengaduan->id])); ?>"
                    class="btn btn-sm btn-maroon"><i class="bi bi-clipboard-check me-1"></i>Mulai Verifikasi</a>
            <?php endif; ?>
            <a href="<?php echo e(route('pengawas.tugas.index')); ?>" class="btn btn-sm btn-outline-secondary"><i
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
    ?>
    <div class="d-flex flex-wrap mb-3">
        <?php $__currentLoopData = $workflow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="tf-step <?php echo e($i < $currentIdx ? 'done' : ($i == $currentIdx ? 'current' : '')); ?>">
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
                            <div class="info-label">Tanggal</div>
                            <div class="info-value"><?php echo e($pengaduan->tanggal_pengaduan->format('d M Y')); ?></div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-label">Status</div>
                            <div class="info-value"><span
                                    class="badge bg-<?php echo e($pengaduan->status_badge); ?>"><?php echo e($pengaduan->status_label); ?></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-label">Kecamatan</div>
                            <div class="info-value"><?php echo e($pengaduan->kecamatan?->nama_kecamatan ?? '—'); ?></div>
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
                            <div class="info-label">Uraian</div>
                            <div class="info-value" style="white-space:pre-line"><?php echo e($pengaduan->uraian_pengaduan); ?></div>
                        </div>
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
                                <div class="info-label">Jadwal Verifikasi</div>
                                <div class="info-value"><?php echo e($pengaduan->disposisi->jadwal_verifikasi->format('d M Y')); ?>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-label">Didisposisikan Oleh</div>
                                <div class="info-value"><?php echo e($pengaduan->disposisi->pembuat?->name); ?></div>
                            </div>
                            <?php if($pengaduan->disposisi->catatan): ?>
                                <div class="col-md-4">
                                    <div class="info-label">Catatan</div>
                                    <div class="info-value"><?php echo e($pengaduan->disposisi->catatan); ?></div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            
            <?php if($pengaduan->verifikasi): ?>
                <?php
                    $v = $pengaduan->verifikasi;
                    $pj = $v->penanggungJawab;
                ?>
                <div class="card-panel mb-3">
                    <div class="cp-head">
                        <div class="cp-title"><i class="bi bi-clipboard-check me-1"></i>Verifikasi Lapangan</div>
                        <div class="d-flex gap-1">
                            <?php $isArsip = $pengaduan->status === \App\Models\Pengaduan::STATUS_ARSIP; ?>
                            <?php if(!$isArsip): ?>
                                <a href="<?php echo e(route('pengawas.verifikasi.edit', $v)); ?>"
                                    class="btn btn-xs btn-outline-maroon"><i class="bi bi-pencil"></i> Edit</a>
                                <?php if($v->status == 'draft'): ?>
                                    <form method="POST" action="<?php echo e(route('pengawas.verifikasi.finalize', $v)); ?>"
                                        class="d-inline"
                                        onsubmit="return confirm('Selesaikan verifikasi ini? Berita Acara akan dibuat otomatis.')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                        <button type="submit" class="btn btn-xs btn-success"><i
                                                class="bi bi-check2-all"></i>
                                            Selesaikan &amp; Buat BA</button>
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if($v->beritaAcara): ?>
                                <a href="<?php echo e(route('pengawas.berita-acara.show', $v->beritaAcara)); ?>"
                                    class="btn btn-xs btn-outline-maroon"><i class="bi bi-file-text"></i> Lihat BA</a>
                                <a href="<?php echo e(route('pengawas.berita-acara.pdf', $v->beritaAcara)); ?>"
                                    class="btn btn-xs btn-success"><i class="bi bi-download"></i> PDF</a>
                            <?php endif; ?>
                            <?php if($isArsip): ?>
                                <span class="badge bg-secondary"><i class="bi bi-lock-fill"></i> Diarsipkan —
                                    Terkunci</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="cp-body">

                        
                        <div class="vsec-title">Informasi Umum</div>
                        <div class="row gx-3 gy-1 mb-3">
                            <div class="col-6 col-md-3">
                                <div class="info-label">Tanggal</div>
                                <div class="info-value"><?php echo e($v->tanggal_verifikasi->format('d M Y')); ?></div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="info-label">Jam</div>
                                <div class="info-value">
                                    <?php echo e($v->jam_verifikasi ? \Illuminate\Support\Str::substr($v->jam_verifikasi, 0, 5) : '—'); ?>

                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="info-label">Status</div>
                                <div class="info-value"><span
                                        class="badge bg-<?php echo e($v->status == 'selesai' ? 'success' : 'warning'); ?>"><?php echo e(ucfirst($v->status)); ?></span>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="info-label">Tenggat TL</div>
                                <div class="info-value"><?php echo e($v->tenggat_tindak_lanjut?->format('d M Y') ?? '—'); ?></div>
                            </div>
                            <div class="col-12">
                                <div class="info-label">Koordinat</div>
                                <div class="info-value">
                                    <?php echo e($v->koordinat_lat && $v->koordinat_lng ? $v->koordinat_lat . ', ' . $v->koordinat_lng : '—'); ?>

                                </div>
                            </div>
                        </div>

                        
                        <div class="vsec-title">Tim Verifikator</div>
                        <?php if($v->timVerifikator->isNotEmpty()): ?>
                            <div class="table-responsive mb-3">
                                <table class="table table-sm vtable mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width:32px">#</th>
                                            <th>Nama</th>
                                            <th>NIP</th>
                                            <th>Pangkat</th>
                                            <th>Jabatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $v->timVerifikator; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($t->urutan); ?></td>
                                                <td class="fw-semibold"><?php echo e($t->nama); ?></td>
                                                <td><?php echo e($t->nip ?: '—'); ?></td>
                                                <td><?php echo e($t->pangkat ?: '—'); ?></td>
                                                <td><?php echo e($t->jabatan ?: '—'); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?><div class="text-muted vsec-empty mb-3">Belum ada tim verifikator</div>
                        <?php endif; ?>

                        
                        <div class="vsec-title">Penanggung Jawab Usaha / Kegiatan</div>
                        <?php if($pj): ?>
                            <div class="row gx-3 gy-1 mb-3">
                                <div class="col-6 col-md-3">
                                    <div class="info-label">Nama PJ</div>
                                    <div class="info-value"><?php echo e($pj->nama_pj ?: '—'); ?></div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="info-label">Jabatan</div>
                                    <div class="info-value"><?php echo e($pj->jabatan_pj ?: '—'); ?></div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="info-label">Perusahaan</div>
                                    <div class="info-value"><?php echo e($pj->nama_perusahaan ?: '—'); ?></div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="info-label">Bidang Usaha</div>
                                    <div class="info-value"><?php echo e($pj->bidang_usaha ?: '—'); ?></div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="info-label">KBLI</div>
                                    <div class="info-value"><?php echo e($pj->kbli_display ?: '—'); ?></div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="info-label">NIB</div>
                                    <div class="info-value"><?php echo e($pj->nib ?: '—'); ?></div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="info-label">Status Permodalan</div>
                                    <div class="info-value"><?php echo e($pj->status_permodalan ?: '—'); ?></div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="info-label">Telepon</div>
                                    <div class="info-value"><?php echo e($pj->no_telp ?: '—'); ?></div>
                                </div>
                                <?php if($pj->deskripsi_kegiatan): ?>
                                    <div class="col-12">
                                        <div class="info-label">Deskripsi Kegiatan</div>
                                        <div class="info-value"><?php echo e($pj->deskripsi_kegiatan); ?></div>
                                    </div>
                                <?php endif; ?>
                                <?php if($pj->alamat_perusahaan): ?>
                                    <div class="col-12">
                                        <div class="info-label">Alamat</div>
                                        <div class="info-value"><?php echo e($pj->alamat_perusahaan); ?></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php else: ?><div class="text-muted vsec-empty mb-3">Belum diisi</div>
                        <?php endif; ?>

                        
                        <div class="vsec-title">Temuan &amp; Kesimpulan</div>
                        <div class="mb-3">
                            <div class="info-label">C. Informasi Administrasi</div>
                            <div class="rte-content vbox"><?php echo $v->informasi_administrasi ?: '<span class="text-muted">—</span>'; ?></div>
                            <div class="info-label mt-2">D. Fakta Temuan Lapangan</div>
                            <div class="rte-content vbox"><?php echo $v->fakta_temuan ?: '<span class="text-muted">—</span>'; ?></div>
                            <div class="info-label mt-2">E. Saran Tindak Lanjut</div>
                            <div class="rte-content vbox"><?php echo $v->saran_tindak_lanjut ?: '<span class="text-muted">—</span>'; ?></div>
                        </div>

                        
                        <div class="vsec-title">Saksi-Saksi</div>
                        <?php if($v->saksi->isNotEmpty()): ?>
                            <div class="row gx-3 gy-1 mb-3">
                                <?php $__currentLoopData = $v->saksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center gap-2 vsaksi">
                                            <span class="vsaksi-no"><?php echo e($s->urutan); ?></span>
                                            <div><span class="fw-semibold"><?php echo e($s->nama); ?></span>
                                                <?php if($s->jabatan): ?>
                                                    <span class="text-muted"> — <?php echo e($s->jabatan); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?><div class="text-muted vsec-empty mb-3">Belum ada saksi</div>
                        <?php endif; ?>

                        
                        <div class="vsec-title">Foto Tersimpan</div>
                        <?php if($v->dokumentasiFoto->isNotEmpty()): ?>
                            <div class="row g-2">
                                <?php $__currentLoopData = $v->dokumentasiFoto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-4 col-md-2">
                                        <img src="<?php echo e(asset('storage/' . $foto->path_file)); ?>" class="vfoto"
                                            onclick="vOpenFoto(this.src,'<?php echo e($foto->keterangan); ?>')"
                                            alt="<?php echo e($foto->keterangan); ?>">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?><div class="text-muted vsec-empty">Belum ada foto</div>
                        <?php endif; ?>

                    </div>
                </div>
            <?php endif; ?>

            
            <?php if($pengaduan->tindakLanjut->isNotEmpty()): ?>
                <div class="card-panel">
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
                                <p class="mb-0"><?php echo e($tl->catatan); ?></p>
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
                    <?php if($pengaduan->pelapor?->no_telp): ?>
                        <div class="info-label">Telp</div>
                        <div class="info-value"><?php echo e($pengaduan->pelapor->no_telp); ?></div>
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
                    <?php if($pengaduan->terlapor?->alamat): ?>
                        <div class="info-label">Alamat</div>
                        <div class="info-value"><?php echo e($pengaduan->terlapor->alamat); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <div class="modal fade" id="vPhotoModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-dark border-0">
                <div class="modal-header border-0 pb-0">
                    <small id="vPhotoCap" class="text-white-50"></small>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-2 text-center">
                    <img id="vPhotoSrc" src="" style="max-width:100%;max-height:75vh;border-radius:4px">
                </div>
            </div>
        </div>
    </div>
    <script>
        function vOpenFoto(src, cap) {
            document.getElementById('vPhotoSrc').src = src;
            document.getElementById('vPhotoCap').textContent = cap || '';
            new bootstrap.Modal(document.getElementById('vPhotoModal')).show();
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.pengawas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/pengawas/tugas/show.blade.php ENDPATH**/ ?>