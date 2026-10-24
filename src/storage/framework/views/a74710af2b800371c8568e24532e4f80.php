<?php $__env->startSection('title', 'Manajemen Wilayah'); ?>
<?php $__env->startSection('breadcrumb', 'Manajemen Wilayah'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-hd mb-3">
  <h1 class="page-ttl">Manajemen Wilayah</h1>
  <p class="page-stl">Kelola data kecamatan dan kelurahan</p>
</div>

<?php if(session('success')): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-size:.85rem">
  <i class="bi bi-check-circle me-1"></i><?php echo e(session('success')); ?>

  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<ul class="nav nav-tabs mb-3" id="wilayahTab" role="tablist" style="font-size:.84rem">
  <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#kecamatanTab">Kecamatan (<?php echo e($kecamatans->count()); ?>)</a></li>
  <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#kelurahanTab">Kelurahan</a></li>
</ul>

<div class="tab-content">
  
  <div class="tab-pane fade show active" id="kecamatanTab">
    <div class="card-panel">
      <div class="cp-head">
        <div class="cp-title">Daftar Kecamatan</div>
        <button class="btn btn-sm btn-maroon" data-bs-toggle="modal" data-bs-target="#addKecModal"><i class="bi bi-plus-lg me-1"></i>Tambah</button>
      </div>
      <div class="table-responsive">
        <table class="table sipplh-table">
          <thead><tr><th>Nama Kecamatan</th><th>Kode</th><th>Kelurahan</th><th>Status</th><th>Aksi</th></tr></thead>
          <tbody>
            <?php $__currentLoopData = $kecamatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><strong><?php echo e($kec->nama_kecamatan); ?></strong></td>
              <td style="font-size:.82rem"><?php echo e($kec->kode_kecamatan ?? '—'); ?></td>
              <td><span class="badge bg-secondary"><?php echo e($kec->kelurahan_count); ?></span></td>
              <td><span class="badge bg-<?php echo e($kec->is_active ? 'success' : 'secondary'); ?>"><?php echo e($kec->is_active ? 'Aktif' : 'Nonaktif'); ?></span></td>
              <td>
                <div class="d-flex gap-1">
                  <button class="btn btn-xs btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editKecModal<?php echo e($kec->id); ?>"><i class="bi bi-pencil"></i></button>
                  <form action="<?php echo e(route('admin.wilayah.kecamatan.destroy', $kec)); ?>" method="POST" onsubmit="return confirm('Hapus kecamatan ini beserta kelurahannya?')">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-xs btn-outline-danger"><i class="bi bi-trash"></i></button>
                  </form>
                </div>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  
  <div class="tab-pane fade" id="kelurahanTab">
    <div class="card-panel">
      <div class="cp-head">
        <div class="cp-title">Daftar Kelurahan</div>
        <button class="btn btn-sm btn-maroon" data-bs-toggle="modal" data-bs-target="#addKelModal"><i class="bi bi-plus-lg me-1"></i>Tambah</button>
      </div>
      <div class="table-responsive">
        <table class="table sipplh-table">
          <thead><tr><th>Nama Kelurahan</th><th>Kecamatan</th><th>Kode</th><th>Status</th><th>Aksi</th></tr></thead>
          <tbody>
            <?php $__currentLoopData = $kelurahans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><strong><?php echo e($kel->nama_kelurahan); ?></strong></td>
              <td style="font-size:.82rem"><?php echo e($kel->kecamatan?->nama_kecamatan); ?></td>
              <td style="font-size:.82rem"><?php echo e($kel->kode_kelurahan ?? '—'); ?></td>
              <td><span class="badge bg-<?php echo e($kel->is_active ? 'success' : 'secondary'); ?>"><?php echo e($kel->is_active ? 'Aktif' : 'Nonaktif'); ?></span></td>
              <td>
                <div class="d-flex gap-1">
                  <button class="btn btn-xs btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editKelModal<?php echo e($kel->id); ?>"><i class="bi bi-pencil"></i></button>
                  <form action="<?php echo e(route('admin.wilayah.kelurahan.destroy', $kel)); ?>" method="POST" onsubmit="return confirm('Hapus kelurahan ini?')">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-xs btn-outline-danger"><i class="bi bi-trash"></i></button>
                  </form>
                </div>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
      <div class="p-3"><?php echo e($kelurahans->links()); ?></div>
    </div>
  </div>
</div>


<div class="modal fade" id="addKecModal" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <form action="<?php echo e(route('admin.wilayah.kecamatan.store')); ?>" method="POST">
      <?php echo csrf_field(); ?>
      <div class="modal-header"><h6 class="modal-title">Tambah Kecamatan</h6><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body">
        <div class="mb-3"><label class="form-label">Nama Kecamatan <span class="text-danger">*</span></label><input type="text" name="nama_kecamatan" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Kode</label><input type="text" name="kode_kecamatan" class="form-control" maxlength="10"></div>
      </div>
      <div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-maroon">Simpan</button></div>
    </form>
  </div></div>
</div>


<div class="modal fade" id="addKelModal" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <form action="<?php echo e(route('admin.wilayah.kelurahan.store')); ?>" method="POST">
      <?php echo csrf_field(); ?>
      <div class="modal-header"><h6 class="modal-title">Tambah Kelurahan</h6><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
          <select name="kecamatan_id" class="form-select" required>
            <option value="">— Pilih —</option>
            <?php $__currentLoopData = $kecamatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($kec->id); ?>"><?php echo e($kec->nama_kecamatan); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
        <div class="mb-3"><label class="form-label">Nama Kelurahan <span class="text-danger">*</span></label><input type="text" name="nama_kelurahan" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Kode</label><input type="text" name="kode_kelurahan" class="form-control" maxlength="10"></div>
      </div>
      <div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-maroon">Simpan</button></div>
    </form>
  </div></div>
</div>


<?php $__currentLoopData = $kecamatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="editKecModal<?php echo e($kec->id); ?>" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <form action="<?php echo e(route('admin.wilayah.kecamatan.update', $kec)); ?>" method="POST">
      <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
      <div class="modal-header"><h6 class="modal-title">Edit Kecamatan</h6><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body">
        <div class="mb-3"><label class="form-label">Nama <span class="text-danger">*</span></label><input type="text" name="nama_kecamatan" class="form-control" value="<?php echo e($kec->nama_kecamatan); ?>" required></div>
        <div class="mb-3"><label class="form-label">Kode</label><input type="text" name="kode_kecamatan" class="form-control" value="<?php echo e($kec->kode_kecamatan); ?>"></div>
      </div>
      <div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-maroon">Simpan</button></div>
    </form>
  </div></div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__currentLoopData = $kelurahans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="editKelModal<?php echo e($kel->id); ?>" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <form action="<?php echo e(route('admin.wilayah.kelurahan.update', $kel)); ?>" method="POST">
      <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
      <div class="modal-header"><h6 class="modal-title">Edit Kelurahan</h6><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Kecamatan</label>
          <select name="kecamatan_id" class="form-select">
            <?php $__currentLoopData = $kecamatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($k->id); ?>" <?php echo e($kel->kecamatan_id == $k->id ? 'selected' : ''); ?>><?php echo e($k->nama_kecamatan); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
        <div class="mb-3"><label class="form-label">Nama <span class="text-danger">*</span></label><input type="text" name="nama_kelurahan" class="form-control" value="<?php echo e($kel->nama_kelurahan); ?>" required></div>
        <div class="mb-3"><label class="form-label">Kode</label><input type="text" name="kode_kelurahan" class="form-control" value="<?php echo e($kel->kode_kelurahan); ?>"></div>
      </div>
      <div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-maroon">Simpan</button></div>
    </form>
  </div></div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/wilayah/index.blade.php ENDPATH**/ ?>