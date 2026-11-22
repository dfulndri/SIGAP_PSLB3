<?php $__env->startSection('title', 'Jenis Pengaduan'); ?>
<?php $__env->startSection('breadcrumb', 'Master Data / Jenis Pengaduan'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-hd d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
        <div>
            <h1 class="page-ttl">Jenis Pengaduan</h1>
            <p class="page-stl">Kelola kategori dan jenis pengaduan yang muncul pada form pengaduan.</p>
        </div>
        <button class="btn btn-maroon" data-bs-toggle="modal" data-bs-target="#addKategoriModal">
            <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
        </button>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3"
            style="font-size:.85rem">
            <i class="bi bi-check-circle-fill flex-shrink-0"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-3"
            style="font-size:.85rem">
            <i class="bi bi-exclamation-triangle-fill flex-shrink-0"></i><?php echo e(session('error')); ?>

            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if($errors->any()): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-3" style="font-size:.85rem">
            <div class="fw-semibold mb-1"><i class="bi bi-exclamation-triangle-fill me-1"></i>Data belum tersimpan:</div>
            <ul class="mb-0 ps-3">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($err); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="alert alert-light border d-flex gap-2 mb-3" style="font-size:.8rem">
        <i class="bi bi-info-circle flex-shrink-0 mt-1"></i>
        <div>
            Mengubah <strong>nama</strong> jenis akan ikut mengubah tampilan pada data pengaduan lama.
            Jenis yang <strong>sudah dipakai</strong> tidak dapat dihapus; <strong>nonaktifkan</strong> agar tidak muncul
            lagi di form pengaduan baru.
        </div>
    </div>

    <?php $__empty_1 = true; $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
            $totalJenis = $kat->jenis->count();
            $aktifJenis = $kat->jenis->where('is_active', true)->count();
        ?>
        <div class="card-panel mb-3" <?php if(!$kat->is_active): ?> style="opacity:.75" <?php endif; ?>>
            <div class="cp-head">
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0"
                        style="width:40px;height:40px;border-radius:10px;background:<?php echo e($kat->warna); ?>1f;color:<?php echo e($kat->warna); ?>;font-size:1.15rem">
                        <i class="bi <?php echo e($kat->ikon); ?>"></i>
                    </div>
                    <div>
                        <div class="cp-title">
                            <?php echo e($kat->nama); ?>

                            <?php if (! ($kat->is_active)): ?>
                                <span class="badge bg-secondary ms-1">Nonaktif</span>
                            <?php endif; ?>
                        </div>
                        <div class="cp-sub"><?php echo e($totalJenis); ?> jenis pengaduan &middot; <?php echo e($aktifJenis); ?> aktif</div>
                    </div>
                </div>
                <div class="d-flex gap-1 flex-wrap">
                    <button class="btn btn-sm btn-maroon" data-bs-toggle="modal"
                        data-bs-target="#addJenisModal<?php echo e($kat->id); ?>">
                        <i class="bi bi-plus-lg me-1"></i>Tambah Jenis
                    </button>
                    <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                        data-bs-target="#editKategoriModal<?php echo e($kat->id); ?>" title="Edit kategori">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <form action="<?php echo e(route('admin.jenis-pengaduan.kategori.destroy', $kat)); ?>" method="POST"
                        onsubmit="return confirm('Hapus kategori ini?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-sm btn-outline-danger" title="Hapus kategori"><i
                                class="bi bi-trash"></i></button>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table sipplh-table">
                    <thead>
                        <tr>
                            <th style="width:60px">Urutan</th>
                            <th>Jenis Pengaduan</th>
                            <th style="width:150px">Dipakai</th>
                            <th style="width:100px">Status</th>
                            <th style="width:100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_2 = true; $__currentLoopData = $kat->jenis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                            <?php $pakai = $dipakai[$j->kode] ?? 0; ?>
                            <tr>
                                <td class="text-muted" style="font-size:.8rem"><?php echo e($j->urutan); ?></td>
                                <td>
                                    <strong style="font-size:.86rem"><?php echo e($j->nama); ?></strong>
                                    <div><code style="font-size:.7rem" class="text-muted"><?php echo e($j->kode); ?></code></div>
                                </td>
                                <td style="font-size:.82rem">
                                    <?php if($pakai > 0): ?>
                                        <span class="badge bg-secondary"><?php echo e($pakai); ?> pengaduan</span>
                                    <?php else: ?>
                                        <span class="text-muted">Belum dipakai</span>
                                    <?php endif; ?>
                                </td>
                                <td><span
                                        class="badge bg-<?php echo e($j->is_active ? 'success' : 'secondary'); ?>"><?php echo e($j->is_active ? 'Aktif' : 'Nonaktif'); ?></span>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-xs btn-outline-secondary" data-bs-toggle="modal"
                                            data-bs-target="#editJenisModal<?php echo e($j->id); ?>" title="Edit"><i
                                                class="bi bi-pencil"></i></button>
                                        <form action="<?php echo e(route('admin.jenis-pengaduan.jenis.destroy', $j)); ?>"
                                            method="POST" onsubmit="return confirm('Hapus jenis pengaduan ini?')">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button class="btn btn-xs btn-outline-danger" title="Hapus"><i
                                                    class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state"><i class="bi bi-tags"></i>Belum ada jenis pengaduan pada
                                        kategori ini</div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="card-panel">
            <div class="empty-state"><i class="bi bi-tags"></i>Belum ada kategori. Klik "Tambah Kategori" untuk memulai.
            </div>
        </div>
    <?php endif; ?>

    
    <div class="modal fade" id="addKategoriModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo e(route('admin.jenis-pengaduan.kategori.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header">
                        <h6 class="modal-title">Tambah Kategori</h6><button type="button" class="btn-close"
                            data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" maxlength="150" required
                                placeholder="Contoh: Pengelolaan Sampah">
                        </div>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label">Ikon</label>
                                <select name="ikon" class="form-select">
                                    <?php $__currentLoopData = $ikonList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ikon => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($ikon); ?>"><?php echo e($label); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-3">
                                <label class="form-label">Warna</label>
                                <input type="color" name="warna" class="form-control form-control-color w-100"
                                    value="#273338">
                            </div>
                            <div class="col-3">
                                <label class="form-label">Urutan</label>
                                <input type="number" name="urutan" class="form-control" min="0" max="999"
                                    placeholder="Auto">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">Batal</button><button type="submit"
                            class="btn btn-maroon">Simpan</button></div>
                </form>
            </div>
        </div>
    </div>

    <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
        <div class="modal fade" id="editKategoriModal<?php echo e($kat->id); ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?php echo e(route('admin.jenis-pengaduan.kategori.update', $kat)); ?>" method="POST">
                        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                        <div class="modal-header">
                            <h6 class="modal-title">Edit Kategori</h6><button type="button" class="btn-close"
                                data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control" maxlength="150"
                                    value="<?php echo e($kat->nama); ?>" required>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-6">
                                    <label class="form-label">Ikon</label>
                                    <select name="ikon" class="form-select">
                                        <?php $__currentLoopData = $ikonList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ikon => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($ikon); ?>"
                                                <?php echo e($kat->ikon === $ikon ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label class="form-label">Warna</label>
                                    <input type="color" name="warna" class="form-control form-control-color w-100"
                                        value="<?php echo e($kat->warna); ?>">
                                </div>
                                <div class="col-3">
                                    <label class="form-label">Urutan</label>
                                    <input type="number" name="urutan" class="form-control" min="0"
                                        max="999" value="<?php echo e($kat->urutan); ?>">
                                </div>
                            </div>
                            <div class="form-check form-switch">
                                <input type="hidden" name="is_active" value="0">
                                <input class="form-check-input" type="checkbox" role="switch" name="is_active"
                                    value="1" id="katAktif<?php echo e($kat->id); ?>"
                                    <?php echo e($kat->is_active ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="katAktif<?php echo e($kat->id); ?>"
                                    style="font-size:.84rem">Aktif (tampil di form pengaduan)</label>
                            </div>
                        </div>
                        <div class="modal-footer"><button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Batal</button><button type="submit"
                                class="btn btn-maroon">Simpan</button></div>
                    </form>
                </div>
            </div>
        </div>

        
        <div class="modal fade" id="addJenisModal<?php echo e($kat->id); ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?php echo e(route('admin.jenis-pengaduan.jenis.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="kategori_id" value="<?php echo e($kat->id); ?>">
                        <div class="modal-header">
                            <h6 class="modal-title">Tambah Jenis Pengaduan<div class="text-muted fw-normal"
                                    style="font-size:.76rem"><?php echo e($kat->nama); ?></div>
                            </h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nama Jenis Pengaduan <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control" maxlength="200" required>
                            </div>
                            <div class="mb-1">
                                <label class="form-label">Urutan</label>
                                <input type="number" name="urutan" class="form-control" min="0" max="999"
                                    placeholder="Otomatis di urutan terakhir">
                            </div>
                        </div>
                        <div class="modal-footer"><button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Batal</button><button type="submit"
                                class="btn btn-maroon">Simpan</button></div>
                    </form>
                </div>
            </div>
        </div>

        <?php $__currentLoopData = $kat->jenis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <div class="modal fade" id="editJenisModal<?php echo e($j->id); ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="<?php echo e(route('admin.jenis-pengaduan.jenis.update', $j)); ?>" method="POST">
                            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                            <div class="modal-header">
                                <h6 class="modal-title">Edit Jenis Pengaduan</h6><button type="button" class="btn-close"
                                    data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <select name="kategori_id" class="form-select" required>
                                        <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($opt->id); ?>"
                                                <?php echo e($j->kategori_id === $opt->id ? 'selected' : ''); ?>><?php echo e($opt->nama); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama Jenis Pengaduan <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="nama" class="form-control" maxlength="200"
                                        value="<?php echo e($j->nama); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Urutan</label>
                                    <input type="number" name="urutan" class="form-control" min="0"
                                        max="999" value="<?php echo e($j->urutan); ?>">
                                </div>
                                <div class="form-check form-switch">
                                    <input type="hidden" name="is_active" value="0">
                                    <input class="form-check-input" type="checkbox" role="switch" name="is_active"
                                        value="1" id="jenisAktif<?php echo e($j->id); ?>"
                                        <?php echo e($j->is_active ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="jenisAktif<?php echo e($j->id); ?>"
                                        style="font-size:.84rem">Aktif (tampil di form pengaduan)</label>
                                </div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-outline-secondary"
                                    data-bs-dismiss="modal">Batal</button><button type="submit"
                                    class="btn btn-maroon">Simpan</button></div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/jenis-pengaduan/index.blade.php ENDPATH**/ ?>