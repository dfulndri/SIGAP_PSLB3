<?php $__env->startSection('title', 'Data Pelapor'); ?>
<?php $__env->startSection('breadcrumb', 'Master Data / Pelapor'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-hd d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
        <div>
            <h1 class="page-ttl">Data Pelapor — <?php echo e(\App\Models\Pelapor::$jenisList[$jenis] ?? ucfirst($jenis)); ?></h1>
            <p class="page-stl">Kelola data pelapor yang terdaftar dalam sistem</p>
        </div>
        <button class="btn btn-sm btn-maroon" data-bs-toggle="modal" data-bs-target="#tambahModal"><i
                class="bi bi-plus-lg me-1"></i>Tambah Pelapor</button>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="font-size:.85rem">
            <i class="bi bi-check-circle me-1"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    
    <ul class="nav nav-tabs mb-3" style="font-size:.84rem">
        <?php $__currentLoopData = \App\Models\Pelapor::$jenisList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="nav-item">
                <a class="nav-link <?php echo e($jenis == $key ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.pelapor.index', ['jenis' => $key])); ?>">
                    <?php echo e($label); ?>

                </a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>

    <div class="card-panel">
        <div class="cp-head">
            <div class="cp-title"><?php echo e($pelapors->total()); ?> data ditemukan</div>
            <form method="GET" class="d-flex gap-2">
                <input type="hidden" name="jenis" value="<?php echo e($jenis); ?>">
                <input type="text" name="search" class="form-control form-control-sm" style="width:200px"
                    placeholder="Cari nama, telp..." value="<?php echo e(request('search')); ?>">
                <button class="btn btn-sm btn-outline-maroon"><i class="bi bi-search"></i></button>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table sipplh-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>No. Telp</th>
                        <th>Email</th>
                        <th>Kecamatan</th>
                        <th>Pengaduan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $pelapors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td style="font-size:.84rem">
                                <strong><?php echo e($p->nama_pelapor); ?></strong>
                                <?php if($p->anonim): ?>
                                    <span class="badge bg-secondary" style="font-size:.62rem">Anonim</span>
                                <?php endif; ?>
                                <?php if($p->nama_lembaga): ?>
                                    <br><small class="text-muted"><?php echo e($p->nama_lembaga); ?></small>
                                <?php endif; ?>
                            </td>
                            <td style="font-size:.82rem"><?php echo e($p->no_telp ?? '—'); ?></td>
                            <td style="font-size:.82rem"><?php echo e($p->email ?? '—'); ?></td>
                            <td style="font-size:.82rem"><?php echo e($p->kecamatan?->nama_kecamatan ?? '—'); ?></td>
                            <td><span class="badge bg-secondary"><?php echo e($p->pengaduan_count); ?></span></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button class="btn btn-xs btn-outline-secondary" data-bs-toggle="modal"
                                        data-bs-target="#editModal<?php echo e($p->id); ?>"><i
                                            class="bi bi-pencil"></i></button>
                                    <form action="<?php echo e(route('admin.pelapor.destroy', $p)); ?>" method="POST"
                                        onsubmit="return confirm('Hapus data pelapor ini?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button class="btn btn-xs btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7">
                                <div class="empty-state"><i class="bi bi-person-badge"></i>Belum ada data pelapor</div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="p-3"><?php echo e($pelapors->links()); ?></div>
    </div>

    
    <div class="modal fade" id="tambahModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?php echo e(route('admin.pelapor.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header">
                        <h6 class="modal-title">Tambah Pelapor</h6><button type="button" class="btn-close"
                            data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="jenis_pelapor" value="<?php echo e($jenis); ?>">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Pelapor <span class="text-danger">*</span></label>
                                <input type="text" name="nama_pelapor" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. Telp</label>
                                <input type="text" name="no_telp" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control" rows="2"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kecamatan</label>
                                <select name="kecamatan_id" class="form-select kec-select">
                                    <option value="">— Pilih —</option>
                                    <?php $__currentLoopData = $kecamatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($kec->id); ?>"><?php echo e($kec->nama_kecamatan); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <?php if($jenis !== 'perorangan'): ?>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lembaga/Perusahaan</label>
                                    <input type="text" name="nama_lembaga" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jabatan</label>
                                    <input type="text" name="jabatan_di_lembaga" class="form-control">
                                </div>
                            <?php endif; ?>
                            <?php if($jenis === 'badan_hukum'): ?>
                                <div class="col-md-6">
                                    <label class="form-label">NPWP</label>
                                    <input type="text" name="npwp" class="form-control" maxlength="25">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">Batal</button><button type="submit"
                            class="btn btn-maroon">Simpan</button></div>
                </form>
            </div>
        </div>
    </div>

    
    <?php $__currentLoopData = $pelapors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="modal fade" id="editModal<?php echo e($p->id); ?>" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="<?php echo e(route('admin.pelapor.update', $p)); ?>" method="POST">
                        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                        <div class="modal-header">
                            <h6 class="modal-title">Edit Pelapor</h6><button type="button" class="btn-close"
                                data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="jenis_pelapor" value="<?php echo e($jenis); ?>">
                            <div class="row g-3">
                                <div class="col-md-6"><label class="form-label">Nama <span
                                            class="text-danger">*</span></label><input type="text" name="nama_pelapor"
                                        class="form-control" value="<?php echo e($p->nama_pelapor); ?>" required></div>
                                <div class="col-md-6"><label class="form-label">No. Telp</label><input type="text"
                                        name="no_telp" class="form-control" value="<?php echo e($p->no_telp); ?>"></div>
                                <div class="col-md-6"><label class="form-label">Email</label><input type="email"
                                        name="email" class="form-control" value="<?php echo e($p->email); ?>"></div>
                                <div class="col-12"><label class="form-label">Alamat</label>
                                    <textarea name="alamat" class="form-control" rows="2"><?php echo e($p->alamat); ?></textarea>
                                </div>
                                <?php if($jenis !== 'perorangan'): ?>
                                    <div class="col-md-6"><label class="form-label">Nama Lembaga</label><input
                                            type="text" name="nama_lembaga" class="form-control"
                                            value="<?php echo e($p->nama_lembaga); ?>"></div>
                                    <div class="col-md-6"><label class="form-label">Jabatan</label><input type="text"
                                            name="jabatan_di_lembaga" class="form-control"
                                            value="<?php echo e($p->jabatan_di_lembaga); ?>"></div>
                                <?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/master-data/pelapor/index.blade.php ENDPATH**/ ?>