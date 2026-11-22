<?php $__env->startSection('title', 'Tambah Pengaduan'); ?>
<?php $__env->startSection('breadcrumb', 'Pengaduan / Tambah'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-hd mb-3">
        <h1 class="page-ttl">Tambah Pengaduan Baru</h1>
        <p class="page-stl">Input data pengaduan lingkungan hidup</p>
    </div>

    <form action="<?php echo e(route('admin.pengaduan.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        
        <div class="card-panel mb-3">
            <div class="cp-head">
                <div class="cp-title"><i class="bi bi-info-circle me-1"></i>Informasi Pengaduan</div>
            </div>
            <div class="cp-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Pengaduan <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_pengaduan"
                            class="form-control <?php $__errorArgs = ['tanggal_pengaduan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('tanggal_pengaduan', now()->toDateString())); ?>" required>
                        <?php $__errorArgs = ['tanggal_pengaduan'];
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
                        <label class="form-label">Sumber Laporan <span class="text-danger">*</span></label>
                        <select name="sumber_laporan" class="form-select <?php $__errorArgs = ['sumber_laporan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            required>
                            <option value="manual" <?php echo e(old('sumber_laporan') == 'manual' ? 'selected' : ''); ?>>Manual</option>
                            <option value="span_lapor" <?php echo e(old('sumber_laporan') == 'span_lapor' ? 'selected' : ''); ?>>SPAN
                                LAPOR</option>
                        </select>
                        <?php $__errorArgs = ['sumber_laporan'];
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
                    <div class="col-12">
                        <?php echo $__env->make('admin.pengaduan._jenis-aduan', ['selected' => old('jenis_aduan', [])], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Uraian Pengaduan <span class="text-danger">*</span></label>
                        <textarea name="uraian_pengaduan" class="form-control <?php $__errorArgs = ['uraian_pengaduan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="4"
                            required placeholder="Jelaskan kronologi pengaduan secara detail (min. 20 karakter)..."><?php echo e(old('uraian_pengaduan')); ?></textarea>
                        <?php $__errorArgs = ['uraian_pengaduan'];
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
                </div>
            </div>
        </div>

        <div class="row g-3 mb-3">
            
            <div class="col-md-6">
                <div class="card-panel h-100">
                    <div class="cp-head">
                        <div class="cp-title"><i class="bi bi-person-badge me-1"></i>Data Pelapor</div>
                    </div>
                    <div class="cp-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Jenis Pelapor <span class="text-danger">*</span></label>
                                <select name="jenis_pelapor" class="form-select" id="jenisPelapor" required>
                                    <?php $__currentLoopData = \App\Models\Pelapor::$jenisList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key); ?>"
                                            <?php echo e(old('jenis_pelapor') == $key ? 'selected' : ''); ?>><?php echo e($label); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            
                            <div class="col-md-6 pelapor-extra" data-pelapor-show="lembaga,badan_hukum"
                                style="display:none">
                                <label class="form-label" id="labelNamaLembagaPelapor">Nama Lembaga/Organisasi <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="nama_lembaga" id="inputNamaLembagaPelapor"
                                    class="form-control <?php $__errorArgs = ['nama_lembaga'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e(old('nama_lembaga')); ?>">
                                <?php $__errorArgs = ['nama_lembaga'];
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
                            <div class="col-md-6">
                                <label class="form-label" id="labelNamaPelapor">Nama Pelapor <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="nama_pelapor"
                                    class="form-control <?php $__errorArgs = ['nama_pelapor'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e(old('nama_pelapor')); ?>" required>
                                <?php $__errorArgs = ['nama_pelapor'];
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
                            <div class="col-md-6 pelapor-extra" data-pelapor-show="lembaga,badan_hukum"
                                style="display:none">
                                <label class="form-label">Jabatan</label>
                                <input type="text" name="jabatan_di_lembaga" class="form-control"
                                    value="<?php echo e(old('jabatan_di_lembaga')); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. Telp</label>
                                <input type="text" name="no_telp_pelapor" class="form-control"
                                    value="<?php echo e(old('no_telp_pelapor')); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email_pelapor" class="form-control"
                                    value="<?php echo e(old('email_pelapor')); ?>">
                            </div>

                            <div class="col-md-6 pelapor-extra" data-pelapor-show="lembaga,badan_hukum"
                                style="display:none">
                                <label class="form-label">NPWP <small class="text-muted">(opsional)</small></label>
                                <input type="text" name="npwp_pelapor" class="form-control"
                                    value="<?php echo e(old('npwp_pelapor')); ?>">
                            </div>
                            <div class="col-md-6 pelapor-extra" data-pelapor-show="badan_hukum" style="display:none">
                                <label class="form-label">NIB <small class="text-muted">(opsional)</small></label>
                                <input type="text" name="nib_pelapor" class="form-control"
                                    value="<?php echo e(old('nib_pelapor')); ?>">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat_pelapor" class="form-control" rows="2"><?php echo e(old('alamat_pelapor')); ?></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kecamatan</label>
                                <select name="kecamatan_pelapor" class="form-select kec-select-pelapor">
                                    <option value="">— Pilih —</option>
                                    <?php $__currentLoopData = $kecamatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($k->id); ?>"
                                            <?php echo e(old('kecamatan_pelapor') == $k->id ? 'selected' : ''); ?>>
                                            <?php echo e($k->nama_kecamatan); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check mt-4">
                                    <input class="form-check-input" type="checkbox" name="anonim" value="1"
                                        id="anonim" <?php echo e(old('anonim') ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="anonim">Pelapor Anonim</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-md-6">
                <div class="card-panel h-100">
                    <div class="cp-head">
                        <div class="cp-title"><i class="bi bi-exclamation-triangle me-1"></i>Data Terlapor</div>
                    </div>
                    <div class="cp-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Jenis Terlapor <span class="text-danger">*</span></label>
                                <select name="jenis_terlapor" class="form-select" id="jenisTerlaporSelect" required>
                                    <?php $__currentLoopData = \App\Models\Terlapor::$jenisList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key); ?>"
                                            <?php echo e(old('jenis_terlapor') == $key ? 'selected' : ''); ?>><?php echo e($label); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" id="labelIdentitasTerlapor">Nama Terlapor <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="nama_terlapor"
                                    class="form-control <?php $__errorArgs = ['nama_terlapor'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e(old('nama_terlapor')); ?>" required>
                                <?php $__errorArgs = ['nama_terlapor'];
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
                            <div class="col-md-6">
                                <label class="form-label" id="labelJenisUsahaTerlapor">Jenis Usaha</label>
                                <input type="text" name="jenis_usaha" class="form-control"
                                    value="<?php echo e(old('jenis_usaha')); ?>">
                            </div>

                            
                            <div class="col-md-6 terlapor-extra" data-terlapor-show="lembaga,badan_hukum,objek_lainnya"
                                style="display:none">
                                <label class="form-label" id="labelPicTerlapor">Nama PIC/Penanggung Jawab</label>
                                <input type="text" name="penanggung_jawab_terlapor" class="form-control"
                                    value="<?php echo e(old('penanggung_jawab_terlapor')); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. Telp</label>
                                <input type="text" name="no_telp_terlapor" class="form-control"
                                    value="<?php echo e(old('no_telp_terlapor')); ?>">
                            </div>
                            
                            <div class="col-md-6 terlapor-extra" data-terlapor-show="badan_hukum" style="display:none">
                                <label class="form-label">NIB</label>
                                <input type="text" name="nib_terlapor" class="form-control"
                                    value="<?php echo e(old('nib_terlapor')); ?>">
                            </div>
                            <div class="col-md-6 terlapor-extra" data-terlapor-show="badan_hukum,lembaga"
                                style="display:none">
                                <label class="form-label">NPWP <span class="npwp-optional-tag text-muted"
                                        style="font-size:.75rem"></span></label>
                                <input type="text" name="npwp_terlapor" class="form-control"
                                    value="<?php echo e(old('npwp_terlapor')); ?>">
                            </div>
                            <div class="col-12">
                                <label class="form-label" id="labelAlamatTerlapor">Alamat Terlapor</label>
                                <textarea name="alamat_terlapor" class="form-control" rows="2"><?php echo e(old('alamat_terlapor')); ?></textarea>
                            </div>
                            
                            <div class="col-12 terlapor-extra" data-terlapor-show="objek_lainnya" style="display:none">
                                <label class="form-label">Deskripsi Objek</label>
                                <textarea name="bidang_usaha_terlapor" class="form-control" rows="2"
                                    placeholder="Jelaskan objek yang diadukan..."><?php echo e(old('bidang_usaha_terlapor')); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card-panel mb-3">
            <div class="cp-head">
                <div class="cp-title"><i class="bi bi-geo-alt me-1"></i>Lokasi Kejadian</div>
            </div>
            <div class="cp-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Alamat Lokasi Kejadian</label>
                        <textarea name="lokasi_kejadian" class="form-control" rows="2" placeholder="Deskripsi lokasi kejadian..."><?php echo e(old('lokasi_kejadian')); ?></textarea>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Kecamatan</label>
                        <select name="kecamatan_id" class="form-select kec-select">
                            <option value="">— Pilih —</option>
                            <?php $__currentLoopData = $kecamatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($k->id); ?>"
                                    <?php echo e(old('kecamatan_id') == $k->id ? 'selected' : ''); ?>><?php echo e($k->nama_kecamatan); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Kelurahan</label>
                        <select name="kelurahan_id" class="form-select" id="kelurahanSelect">
                            <option value="">— Pilih kecamatan dulu —</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Latitude</label>
                        <input type="number" name="koordinat_lat" class="form-control" step="any"
                            value="<?php echo e(old('koordinat_lat')); ?>" placeholder="-6.xxxx">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Longitude</label>
                        <input type="number" name="koordinat_lng" class="form-control" step="any"
                            value="<?php echo e(old('koordinat_lng')); ?>" placeholder="106.xxxx">
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card-panel mb-3">
            <div class="cp-head">
                <div class="cp-title"><i class="bi bi-paperclip me-1"></i>Dokumen Pendukung</div>
            </div>
            <div class="cp-body">
                <input type="file" name="dokumen_pendukung"
                    class="form-control <?php $__errorArgs = ['dokumen_pendukung'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept=".pdf,.jpg,.jpeg,.png">
                <?php $__errorArgs = ['dokumen_pendukung'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <small class="text-muted">Format: PDF, JPG, PNG. Maks 5MB.</small>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-maroon"><i class="bi bi-save me-1"></i>Simpan Pengaduan</button>
            <a href="<?php echo e(route('admin.pengaduan.index')); ?>" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        // ── Field dinamis Pelapor & Terlapor (Poin 1 & 3 revisi) ─────────────
        const PELAPOR_LABELS = {
            perorangan: 'Nama Pelapor',
            lembaga: 'Nama PIC/Penanggung Jawab',
            badan_hukum: 'Nama PIC/Penanggung Jawab',
        };
        const NAMA_LEMBAGA_LABELS = {
            lembaga: 'Nama Lembaga/Organisasi',
            badan_hukum: 'Nama Perusahaan',
        };
        const TERLAPOR_LABELS = {
            perorangan: {
                identitas: 'Nama Usaha/Kegiatan',
                alamat: 'Alamat Terlapor',
                jenisUsaha: 'Jenis Usaha/Kegiatan',
                pic: ''
            },
            lembaga: {
                identitas: 'Nama Lembaga/Organisasi',
                alamat: 'Alamat Terlapor',
                jenisUsaha: 'Jenis/Kategori Lembaga',
                pic: 'Nama PIC/Penanggung Jawab'
            },
            badan_hukum: {
                identitas: 'Nama Perusahaan',
                alamat: 'Alamat Terlapor',
                jenisUsaha: 'Jenis Usaha/Kegiatan',
                pic: 'Nama PIC/Penanggung Jawab'
            },
            objek_lainnya: {
                identitas: 'Nama/Identitas Objek',
                alamat: 'Alamat/Lokasi',
                jenisUsaha: 'Jenis Objek',
                pic: 'Pemilik/Pengelola'
            },
        };

        function updatePelaporFields() {
            const jenis = document.getElementById('jenisPelapor')?.value;

            document.querySelectorAll('.pelapor-extra').forEach(el => {
                const allow = el.dataset.pelaporShow.split(',');
                el.style.display = allow.includes(jenis) ? '' : 'none';
            });

            // Label "Nama Pelapor" berubah jadi "Nama PIC/Penanggung Jawab" untuk Lembaga/Perusahaan
            const labelNamaPelapor = document.getElementById('labelNamaPelapor');
            if (labelNamaPelapor) {
                labelNamaPelapor.innerHTML = (PELAPOR_LABELS[jenis] || 'Nama Pelapor') +
                    ' <span class="text-danger">*</span>';
            }

            // Label & wajib-tidaknya Nama Lembaga/Perusahaan
            const labelNamaLembaga = document.getElementById('labelNamaLembagaPelapor');
            const inputNamaLembaga = document.getElementById('inputNamaLembagaPelapor');
            const isLembagaOrBadanHukum = (jenis === 'lembaga' || jenis === 'badan_hukum');
            if (labelNamaLembaga) {
                labelNamaLembaga.innerHTML = (NAMA_LEMBAGA_LABELS[jenis] || 'Nama Lembaga/Organisasi') +
                    ' <span class="text-danger">*</span>';
            }
            if (inputNamaLembaga) {
                inputNamaLembaga.required = isLembagaOrBadanHukum;
            }
        }

        function updateTerlaporFields() {
            const jenis = document.getElementById('jenisTerlaporSelect')?.value;
            const label = TERLAPOR_LABELS[jenis] || TERLAPOR_LABELS.perorangan;

            const labelIdEl = document.getElementById('labelIdentitasTerlapor');
            if (labelIdEl) labelIdEl.innerHTML = label.identitas + ' <span class="text-danger">*</span>';

            const labelAlamatEl = document.getElementById('labelAlamatTerlapor');
            if (labelAlamatEl) labelAlamatEl.textContent = label.alamat;

            const labelJenisUsahaEl = document.getElementById('labelJenisUsahaTerlapor');
            if (labelJenisUsahaEl) labelJenisUsahaEl.textContent = label.jenisUsaha;

            const labelPicEl = document.getElementById('labelPicTerlapor');
            if (labelPicEl) labelPicEl.textContent = label.pic;

            document.querySelectorAll('.terlapor-extra').forEach(el => {
                const allow = el.dataset.terlaporShow.split(',');
                el.style.display = allow.includes(jenis) ? '' : 'none';
            });

            // NPWP wajib untuk Badan Hukum, opsional untuk Lembaga
            const npwpTag = document.querySelector('.npwp-optional-tag');
            if (npwpTag) npwpTag.textContent = jenis === 'lembaga' ? '(opsional)' : '';
        }

        document.getElementById('jenisPelapor')?.addEventListener('change', updatePelaporFields);
        document.getElementById('jenisTerlaporSelect')?.addEventListener('change', updateTerlaporFields);
        updatePelaporFields();
        updateTerlaporFields();

        // Dynamic kelurahan loading
        document.querySelector('.kec-select')?.addEventListener('change', function() {
            const kelSelect = document.getElementById('kelurahanSelect');
            kelSelect.innerHTML = '<option value="">Memuat...</option>';
            if (!this.value) {
                kelSelect.innerHTML = '<option value="">— Pilih kecamatan dulu —</option>';
                return;
            }
            fetch(`/admin/master/kelurahan-json/${this.value}`)
                .then(r => r.json())
                .then(data => {
                    kelSelect.innerHTML = '<option value="">— Pilih —</option>';
                    data.forEach(k => {
                        kelSelect.innerHTML += `<option value="${k.id}">${k.nama_kelurahan}</option>`;
                    });
                });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/pengaduan/create.blade.php ENDPATH**/ ?>