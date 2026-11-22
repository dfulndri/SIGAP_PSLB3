<?php $__env->startSection('title', 'Buat Verifikasi Lapangan'); ?>
<?php $__env->startSection('breadcrumb', 'Buat Verifikasi'); ?>

<?php $__env->startSection('content'); ?>

    <div class="page-hd d-flex align-items-center justify-content-between">
        <div>
            <h1 class="page-ttl">Buat Verifikasi Lapangan</h1>
            <p class="page-stl">Isi formulir berikut sesuai hasil verifikasi di lapangan.</p>
        </div>
        <a href="<?php echo e(route('admin.verifikasi.index')); ?>" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-3" style="font-size:.85rem">
            <strong><i class="bi bi-exclamation-circle-fill me-1"></i> Periksa kembali isian:</strong>
            <ul class="mb-0 mt-1 ps-4">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($e); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('admin.verifikasi.store')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        
        <div class="card-panel mb-3">
            <div class="cp-head">
                <div class="d-flex align-items-center gap-2">
                    <div
                        style="width:28px;height:28px;background:var(--maroon);color:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:600;flex-shrink:0">
                        0</div>
                    <div>
                        <div class="cp-title">Pengaduan yang Diverifikasi</div>
                        <div class="cp-sub">Pilih pengaduan yang menjadi dasar verifikasi lapangan ini</div>
                    </div>
                </div>
            </div>
            <div class="cp-body">
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">Pilih Pengaduan <span class="text-danger">*</span></label>
                        <?php if($pengaduan): ?>
                            
                            <div class="d-flex align-items-center gap-2 p-2 rounded"
                                style="background:var(--mint-bg);border:1px solid var(--mint)">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <div>
                                    <code><?php echo e($pengaduan->nomor_pengaduan); ?></code>
                                    <span class="ms-1" style="font-size:.82rem">— <?php echo e($pengaduan->terlapor?->nama); ?></span>
                                </div>
                            </div>
                            <input type="hidden" name="pengaduan_id" value="<?php echo e($pengaduan->id); ?>">
                        <?php else: ?>
                            <select name="pengaduan_id" class="form-select <?php $__errorArgs = ['pengaduan_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="">-- Pilih Pengaduan --</option>
                                <?php $__currentLoopData = $pengaduanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($p->id); ?>"
                                        <?php echo e(old('pengaduan_id') == $p->id ? 'selected' : ''); ?>>
                                        <?php echo e($p->nomor_pengaduan); ?> — <?php echo e($p->terlapor?->nama); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($pengaduanList->isEmpty()): ?>
                                <div class="form-text text-warning">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Tidak ada pengaduan yang siap diverifikasi. Pastikan ada pengaduan berstatus "Diproses".
                                </div>
                            <?php endif; ?>
                            <?php $__errorArgs = ['pengaduan_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Verifikasi <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_verifikasi"
                            class="form-control <?php $__errorArgs = ['tanggal_verifikasi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('tanggal_verifikasi', now()->format('Y-m-d'))); ?>">
                        <?php $__errorArgs = ['tanggal_verifikasi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Jam Verifikasi</label>
                        <input type="time" name="jam_verifikasi" class="form-control"
                            value="<?php echo e(old('jam_verifikasi', now()->format('H:i'))); ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tenggat Tindak Lanjut</label>
                        <input type="date" name="tenggat_tindak_lanjut" class="form-control"
                            value="<?php echo e(old('tenggat_tindak_lanjut', now()->addDays(14)->format('Y-m-d'))); ?>">
                        <div class="form-text">Default: 14 hari sejak tanggal verifikasi</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Koordinat Latitude</label>
                        <input type="number" step="any" name="koordinat_lat" class="form-control"
                            value="<?php echo e(old('koordinat_lat', $pengaduan->koordinat_lat)); ?>" placeholder="-6.154588">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Koordinat Longitude</label>
                        <input type="number" step="any" name="koordinat_lng" class="form-control"
                            value="<?php echo e(old('koordinat_lng', $pengaduan->koordinat_lng)); ?>" placeholder="106.574295">
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card-panel mb-3">
            <div class="cp-head">
                <div class="d-flex align-items-center gap-2">
                    <div
                        style="width:28px;height:28px;background:var(--maroon);color:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:600;flex-shrink:0">
                        A</div>
                    <div>
                        <div class="cp-title">Tim Verifikator (Identitas Pengawas LH)</div>
                        <div class="cp-sub">Daftar pegawai yang melaksanakan verifikasi lapangan</div>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-maroon" onclick="addTim()">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Anggota
                </button>
            </div>
            <div class="cp-body">
                
                <div class="row g-2 mb-1 d-none d-md-flex">
                    <div class="col-md-3"><span
                            style="font-size:.72rem;font-weight:600;color:var(--muted);text-transform:uppercase">Nama
                            Lengkap *</span></div>
                    <div class="col-md-3"><span
                            style="font-size:.72rem;font-weight:600;color:var(--muted);text-transform:uppercase">NIP</span>
                    </div>
                    <div class="col-md-2"><span
                            style="font-size:.72rem;font-weight:600;color:var(--muted);text-transform:uppercase">Pangkat/Gol</span>
                    </div>
                    <div class="col-md-3"><span
                            style="font-size:.72rem;font-weight:600;color:var(--muted);text-transform:uppercase">Jabatan</span>
                    </div>
                </div>
                <div id="tim-container">
                    
                    <div class="tim-row mb-2" data-index="0">
                        <div class="row g-2 align-items-center">
                            <div class="col-12 col-md-3">
                                <input type="text" name="tim[0][nama]" class="form-control form-control-sm"
                                    placeholder="Nama lengkap" value="<?php echo e(old('tim.0.nama')); ?>">
                            </div>
                            <div class="col-6 col-md-3">
                                <input type="text" name="tim[0][nip]" class="form-control form-control-sm"
                                    placeholder="NIP" value="<?php echo e(old('tim.0.nip')); ?>">
                            </div>
                            <div class="col-6 col-md-2">
                                <input type="text" name="tim[0][pangkat]" class="form-control form-control-sm"
                                    placeholder="III/a" value="<?php echo e(old('tim.0.pangkat')); ?>">
                            </div>
                            <div class="col-10 col-md-3">
                                <input type="text" name="tim[0][jabatan]" class="form-control form-control-sm"
                                    placeholder="Pengawas LH Muda" value="<?php echo e(old('tim.0.jabatan')); ?>">
                            </div>
                            <div class="col-2 col-md-1 text-end">
                                <button type="button" class="btn btn-xs btn-outline-danger" onclick="removeTim(this)"
                                    title="Hapus baris">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php if($pegawai->isNotEmpty()): ?>
                    <div class="mt-2 pt-2 border-top">
                        <div style="font-size:.78rem;color:var(--muted);margin-bottom:4px">
                            <i class="bi bi-lightning me-1"></i> Isi cepat dari data pegawai:
                        </div>
                        <div class="d-flex flex-wrap gap-1">
                            <?php $__currentLoopData = $pegawai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <button type="button" class="btn btn-xs btn-outline-secondary"
                                    onclick="addTimFromPegawai('<?php echo e($pg->name); ?>', '<?php echo e($pg->nip); ?>', '', '<?php echo e($pg->jabatan); ?>')">
                                    <?php echo e($pg->name); ?>

                                </button>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="card-panel mb-3">
            <div class="cp-head">
                <div class="d-flex align-items-center gap-2">
                    <div
                        style="width:28px;height:28px;background:var(--maroon-md);color:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:600;flex-shrink:0">
                        B</div>
                    <div>
                        <div class="cp-title">Identitas Penanggung Jawab Usaha / Kegiatan</div>
                        <div class="cp-sub">Pihak terlapor yang hadir saat verifikasi lapangan</div>
                    </div>
                </div>
            </div>
            <div class="cp-body">
                <?php
                    $jenisTerlapor = $pengaduan?->terlapor?->jenis_terlapor ?? 'perorangan';
                    $pjLabel = [
                        'perorangan' => [
                            'nama_pj' => 'Nama Penanggung Jawab',
                            'nama_perusahaan' => null,
                            'bidang' => 'Bidang Usaha / Kegiatan',
                            'deskripsi' => 'Deskripsi Kegiatan',
                        ],
                        'lembaga' => [
                            'nama_pj' => 'Nama Penanggung Jawab',
                            'nama_perusahaan' => 'Nama Lembaga',
                            'bidang' => 'Jenis/Kategori Lembaga',
                            'deskripsi' => 'Deskripsi Kegiatan',
                        ],
                        'badan_hukum' => [
                            'nama_pj' => 'Nama Penanggung Jawab',
                            'nama_perusahaan' => 'Nama Perusahaan / Kegiatan',
                            'bidang' => 'Bidang Usaha / Kegiatan',
                            'deskripsi' => 'Deskripsi Kegiatan',
                        ],
                        'objek_lainnya' => [
                            'nama_pj' => 'Pemilik/Pengelola',
                            'nama_perusahaan' => null,
                            'bidang' => 'Jenis Objek',
                            'deskripsi' => 'Deskripsi Objek',
                        ],
                    ][$jenisTerlapor];
                ?>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label"><?php echo e($pjLabel['nama_pj']); ?></label>
                        <input type="text" name="pj_nama_pj" class="form-control" value="<?php echo e(old('pj_nama_pj')); ?>"
                            placeholder="Nama lengkap PJ">
                    </div>
                    <?php if(in_array($jenisTerlapor, ['lembaga', 'badan_hukum'])): ?>
                        <div class="col-md-6">
                            <label class="form-label">Jabatan</label>
                            <input type="text" name="pj_jabatan_pj" class="form-control"
                                value="<?php echo e(old('pj_jabatan_pj')); ?>" placeholder="Direktur / Manajer / dll">
                        </div>
                    <?php endif; ?>
                    <?php if($pjLabel['nama_perusahaan']): ?>
                        <div class="col-md-6">
                            <label class="form-label"><?php echo e($pjLabel['nama_perusahaan']); ?></label>
                            <input type="text" name="pj_nama_perusahaan" class="form-control"
                                value="<?php echo e(old('pj_nama_perusahaan', $pengaduan?->terlapor?->nama)); ?>"
                                placeholder="Nama lengkap perusahaan">
                        </div>
                    <?php endif; ?>
                    <div class="col-md-6">
                        <label class="form-label"><?php echo e($pjLabel['bidang']); ?></label>
                        <input type="text" name="pj_bidang_usaha" class="form-control"
                            value="<?php echo e(old('pj_bidang_usaha', $pengaduan?->terlapor?->jenis_usaha)); ?>"
                            placeholder="Jenis bidang usaha">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><?php echo e($pjLabel['deskripsi']); ?></label>
                        <input type="text" name="pj_deskripsi_kegiatan" class="form-control"
                            value="<?php echo e(old('pj_deskripsi_kegiatan')); ?>" placeholder="Deskripsi kegiatan usaha">
                    </div>
                    <?php if($jenisTerlapor === 'badan_hukum'): ?>
                        <div class="col-md-6">
                            <label class="form-label">Status Permodalan</label>
                            <input type="text" name="pj_status_permodalan" class="form-control"
                                value="<?php echo e(old('pj_status_permodalan')); ?>" placeholder="PMDN / PMA">
                        </div>
                        <div class="col-md-3 position-relative">
                            <label class="form-label">KBLI</label>

                            <input type="text" id="kbliSearch" class="form-control" autocomplete="off"
                                placeholder="Ketik kode atau kata kunci, mis: kertas">

                            <input type="hidden" id="kbliInput" name="pj_kbli_id" value="<?php echo e(old('pj_kbli_id')); ?>">

                            <div id="kbliResults" class="list-group position-absolute w-100"
                                style="z-index:1000; max-height:240px; overflow-y:auto; display:none; font-size:.82rem;">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">NIB</label>
                            <input type="text" name="pj_nib" class="form-control" value="<?php echo e(old('pj_nib')); ?>"
                                placeholder="Nomor Induk Berusaha">
                        </div>
                    <?php endif; ?>
                    <?php if($jenisTerlapor !== 'objek_lainnya'): ?>
                        <div class="col-md-3">
                            <label class="form-label">No. Telepon</label>
                            <input type="text" name="pj_no_telp" class="form-control"
                                value="<?php echo e(old('pj_no_telp')); ?>" placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="pj_email" class="form-control" value="<?php echo e(old('pj_email')); ?>"
                                placeholder="email@perusahaan.com">
                        </div>
                    <?php endif; ?>
                    <div class="col-md-6">
                        <label class="form-label">Koordinat Latitude</label>
                        <input type="number" step="any" name="pj_koordinat_lat" class="form-control"
                            value="<?php echo e(old('pj_koordinat_lat')); ?>" placeholder="-6.xxxxxxx">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Koordinat Longitude</label>
                        <input type="number" step="any" name="pj_koordinat_lng" class="form-control"
                            value="<?php echo e(old('pj_koordinat_lng')); ?>" placeholder="106.xxxxxxx">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Alamat Perusahaan / Lokasi Usaha</label>
                        <textarea name="pj_alamat" class="form-control" rows="2" placeholder="Alamat lengkap lokasi usaha / kegiatan"><?php echo e(old('pj_alamat', $pengaduan?->terlapor?->alamat)); ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card-panel mb-3">
            <div class="cp-head">
                <div class="d-flex align-items-center gap-2">
                    <div
                        style="width:28px;height:28px;background:#10b981;color:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:600;flex-shrink:0">
                        C</div>
                    <div>
                        <div class="cp-title">Temuan & Kesimpulan Lapangan</div>
                        <div class="cp-sub">Hasil verifikasi dan rekomendasi tindak lanjut</div>
                    </div>
                </div>
            </div>
            <div class="cp-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">
                            <span class="badge me-1" style="background:var(--maroon)">C</span>
                            Informasi Administrasi
                        </label>
                        <textarea name="informasi_administrasi" class="rte-editor"
                            data-placeholder="Jelaskan status perizinan, dokumen lingkungan, dan informasi administrasi terkait usaha/kegiatan yang diverifikasi..."><?php echo e(old('informasi_administrasi')); ?></textarea>
                        <div class="form-text">Meliputi: status izin lingkungan, AMDAL/UKL-UPL, izin operasional, dll.
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">
                            <span class="badge me-1" style="background:var(--maroon-md)">D</span>
                            Fakta Temuan Lapangan
                        </label>
                        <textarea name="fakta_temuan" class="rte-editor"
                            data-placeholder="Uraikan secara rinci fakta-fakta yang ditemukan di lapangan selama verifikasi. Meliputi kondisi fisik, hasil pengukuran, observasi, dll..."><?php echo e(old('fakta_temuan')); ?></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">
                            <span class="badge me-1" style="background:#10b981">E</span>
                            Saran dan Rekomendasi Tindak Lanjut
                        </label>
                        <textarea name="saran_tindak_lanjut" class="rte-editor"
                            data-placeholder="Tuliskan saran, rekomendasi, dan langkah tindak lanjut yang harus dilakukan oleh pihak terlapor dalam jangka waktu yang telah ditentukan..."><?php echo e(old('saran_tindak_lanjut')); ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card-panel mb-3">
            <div class="cp-head">
                <div class="d-flex align-items-center gap-2">
                    <div class="cp-title"><i class="bi bi-people me-1 text-muted"></i> Saksi-Saksi</div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-maroon" onclick="addSaksi()">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Saksi
                </button>
            </div>
            <div class="cp-body">
                <div id="saksi-container">
                    <div class="saksi-row mb-2">
                        <div class="row g-2 align-items-center">
                            <div class="col-12 col-md-6">
                                <input type="text" name="saksi[0][nama]" class="form-control form-control-sm"
                                    placeholder="Nama saksi" value="<?php echo e(old('saksi.0.nama')); ?>">
                            </div>
                            <div class="col-10 col-md-5">
                                <input type="text" name="saksi[0][jabatan]" class="form-control form-control-sm"
                                    placeholder="Jabatan (mis. Kepala Desa, Ketua RT)"
                                    value="<?php echo e(old('saksi.0.jabatan')); ?>">
                            </div>
                            <div class="col-2 col-md-1 text-end">
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeSaksi(this)">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-text">Saksi yang hadir dan menyaksikan pelaksanaan verifikasi lapangan.</div>
            </div>
        </div>

        
        <div class="card-panel mb-3">
            <div class="cp-head">
                <div class="d-flex align-items-center gap-2">
                    <div
                        style="width:28px;height:28px;background:#3b82f6;color:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:600;flex-shrink:0">
                        <i class="bi bi-camera-fill" style="font-size:.7rem"></i>
                    </div>
                    <div>
                        <div class="cp-title">Dokumentasi Foto</div>
                        <div class="cp-sub">Upload foto dokumentasi kegiatan verifikasi lapangan</div>
                    </div>
                </div>
            </div>
            <div class="cp-body">
                <div id="foto-list">
                    <div class="foto-item mb-3 p-3 rounded" style="border:1px dashed var(--border)">
                        <div class="row g-2 align-items-center">
                            <div class="col-md-6">
                                <label class="form-label mb-1" style="font-size:.8rem">File Foto</label>
                                <input type="file" name="foto[]" class="form-control form-control-sm"
                                    accept="image/*" onchange="previewFoto(this)">
                                <div class="form-text">JPG/PNG, maks. 5MB</div>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label mb-1" style="font-size:.8rem">Keterangan</label>
                                <input type="text" name="foto_keterangan[]" class="form-control form-control-sm"
                                    placeholder="Keterangan foto...">
                            </div>
                            <div class="col-md-1 text-end d-flex align-items-end">
                                <button type="button" class="btn btn-xs btn-outline-danger" onclick="removeFoto(this)">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                            <div class="col-12">
                                <img src="" alt="" class="foto-preview d-none"
                                    style="max-height:120px;border-radius:4px;border:1px solid var(--border)">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="addFoto()">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Foto
                </button>
            </div>
        </div>

        
        <div class="d-flex justify-content-between align-items-center">
            <a href="<?php echo e(route('admin.verifikasi.index')); ?>" class="btn btn-outline-secondary">
                <i class="bi bi-x-circle me-1"></i> Batal
            </a>
            <div class="d-flex gap-2">
                <button type="submit" name="action" value="draft" class="btn btn-outline-maroon">
                    <i class="bi bi-save me-1"></i> Simpan Draft
                </button>
                <button type="submit" name="action" value="save" class="btn btn-maroon px-4">
                    <i class="bi bi-check2-circle me-1"></i> Simpan Verifikasi
                </button>
            </div>
        </div>

    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('partials.rte-assets', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        let timIdx = 1;

        let saksiIdx = document.querySelectorAll('.saksi-row').length;

        function addSaksi() {
            const i = saksiIdx++;
            const row = document.createElement('div');
            row.className = 'saksi-row mb-2';
            row.innerHTML = `
    <div class="row g-2 align-items-center">
      <div class="col-12 col-md-6">
        <input type="text" name="saksi[${i}][nama]" class="form-control form-control-sm" placeholder="Nama saksi">
      </div>
      <div class="col-10 col-md-5">
        <input type="text" name="saksi[${i}][jabatan]" class="form-control form-control-sm" placeholder="Jabatan">
      </div>
      <div class="col-2 col-md-1 text-end">
        <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeSaksi(this)"><i class="bi bi-trash"></i></button>
      </div>
    </div>`;
            document.getElementById('saksi-container').appendChild(row);
        }

        function removeSaksi(btn) {
            if (document.querySelectorAll('.saksi-row').length > 1) btn.closest('.saksi-row').remove();
        }

        function addTim() {
            const i = timIdx++;
            const row = document.createElement('div');
            row.className = 'tim-row mb-2';
            row.dataset.index = i;
            row.innerHTML = `
    <div class="row g-2 align-items-center">
      <div class="col-12 col-md-3">
        <input type="text" name="tim[${i}][nama]" class="form-control form-control-sm" placeholder="Nama lengkap">
      </div>
      <div class="col-6 col-md-3">
        <input type="text" name="tim[${i}][nip]" class="form-control form-control-sm" placeholder="NIP">
      </div>
      <div class="col-6 col-md-2">
        <input type="text" name="tim[${i}][pangkat]" class="form-control form-control-sm" placeholder="III/a">
      </div>
      <div class="col-10 col-md-3">
        <input type="text" name="tim[${i}][jabatan]" class="form-control form-control-sm" placeholder="Jabatan">
      </div>
      <div class="col-2 col-md-1 text-end">
        <button type="button" class="btn btn-xs btn-outline-danger" onclick="removeTim(this)">
          <i class="bi bi-trash"></i>
        </button>
      </div>
    </div>`;
            document.getElementById('tim-container').appendChild(row);
        }

        function addTimFromPegawai(nama, nip, pangkat, jabatan) {
            addTim();
            const rows = document.querySelectorAll('.tim-row');
            const last = rows[rows.length - 1];
            last.querySelector('[name*="[nama]"]').value = nama;
            last.querySelector('[name*="[nip]"]').value = nip;
            last.querySelector('[name*="[pangkat]"]').value = pangkat;
            last.querySelector('[name*="[jabatan]"]').value = jabatan;
        }

        function removeTim(btn) {
            const rows = document.querySelectorAll('.tim-row');
            if (rows.length > 1) {
                btn.closest('.tim-row').remove();
            }
        }

        function addFoto() {
            const tmpl = document.querySelector('.foto-item').cloneNode(true);
            tmpl.querySelector('input[type=file]').value = '';
            tmpl.querySelector('input[type=text]').value = '';
            const prev = tmpl.querySelector('.foto-preview');
            prev.src = '';
            prev.classList.add('d-none');
            document.getElementById('foto-list').appendChild(tmpl);
        }

        function removeFoto(btn) {
            const items = document.querySelectorAll('.foto-item');
            if (items.length > 1) btn.closest('.foto-item').remove();
        }

        function previewFoto(input) {
            const prev = input.closest('.foto-item').querySelector('.foto-preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    prev.src = e.target.result;
                    prev.classList.remove('d-none');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/verifikasi/create.blade.php ENDPATH**/ ?>