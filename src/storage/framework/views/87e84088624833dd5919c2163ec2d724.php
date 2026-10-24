<?php $__env->startSection('title', 'Daftar Pengaduan'); ?>
<?php $__env->startSection('breadcrumb', 'Pengaduan Masuk'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-hd d-flex align-items-center justify-content-between flex-wrap gap-2">
  <div>
    <h1 class="page-ttl">Pengaduan Masuk</h1>
    <p class="page-stl">Kelola seluruh pengaduan lingkungan hidup yang masuk ke sistem.</p>
  </div>
  <a href="<?php echo e(route('admin.pengaduan.create')); ?>" class="btn btn-maroon">
    <i class="bi bi-plus-circle me-1"></i> Tambah Pengaduan
  </a>
</div>

<?php if(session('success')): ?>
<div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3" style="font-size:.85rem">
  <i class="bi bi-check-circle-fill flex-shrink-0"></i><?php echo e(session('success')); ?>

  <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>


<div class="card-panel mb-3">
  <div class="cp-body py-3">
    <form method="GET" action="<?php echo e(route('admin.pengaduan.index')); ?>">
      <div class="row g-2 align-items-end">
        <div class="col-12 col-md-3">
          <label class="form-label mb-1" style="font-size:.78rem;font-weight:500">Cari</label>
          <div class="input-group input-group-sm">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input type="text" name="search" class="form-control" placeholder="Nomor / pelapor / terlapor..." value="<?php echo e(request('search')); ?>">
          </div>
        </div>
        <div class="col-6 col-md-2">
          <label class="form-label mb-1" style="font-size:.78rem;font-weight:500">Status</label>
          <select name="status" class="form-select form-select-sm">
            <option value="">Semua Status</option>
            <?php $__currentLoopData = \App\Models\Pengaduan::$statusList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($key); ?>" <?php echo e(request('status') == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
        <div class="col-6 col-md-2">
          <label class="form-label mb-1" style="font-size:.78rem;font-weight:500">Kecamatan</label>
          <select name="kecamatan_id" class="form-select form-select-sm">
            <option value="">Semua Kecamatan</option>
            <?php $__currentLoopData = $kecamatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($k->id); ?>" <?php echo e(request('kecamatan_id') == $k->id ? 'selected' : ''); ?>><?php echo e($k->nama_kecamatan); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
        <div class="col-6 col-md-3 d-flex gap-2">
          <button type="submit" class="btn btn-sm btn-maroon flex-fill"><i class="bi bi-funnel me-1"></i> Filter</button>
          <a href="<?php echo e(route('admin.pengaduan.index')); ?>" class="btn btn-sm btn-outline-secondary flex-fill"><i class="bi bi-x-circle me-1"></i> Reset</a>
        </div>
      </div>
    </form>
  </div>
</div>


<div class="card-panel">
  <div class="cp-head">
    <div>
      <div class="cp-title">Data Pengaduan</div>
      <div class="cp-sub">Total: <strong><?php echo e($pengaduans->total()); ?></strong> pengaduan ditemukan</div>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table sipplh-table">
      <thead>
        <tr>
          <th style="width:40px">#</th>
          <th>Nomor</th>
          <th>Tanggal</th>
          <th>Pelapor</th>
          <th>Terlapor</th>
          <th>Jenis Aduan</th>
          <th>Kecamatan</th>
          <th>Status</th>
          <th style="width:110px">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $pengaduans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td class="text-muted" style="font-size:.75rem"><?php echo e($pengaduans->firstItem() + $loop->index); ?></td>
          <td><code style="font-size:.78rem"><?php echo e($p->nomor_pengaduan); ?></code></td>
          <td style="font-size:.82rem"><?php echo e($p->tanggal_pengaduan->format('d M Y')); ?></td>
          <td style="font-size:.82rem">
            <?php echo e($p->pelapor?->nama_display ?? '—'); ?>

            <br><small class="text-muted"><?php echo e($p->pelapor?->jenis_label); ?></small>
          </td>
          <td style="font-size:.82rem"><?php echo e($p->terlapor?->nama ?? '—'); ?></td>
          <td>
            <?php $__currentLoopData = $p->jenis_aduan_labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ja): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <span class="badge-kat"><?php echo e($ja); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </td>
          <td style="font-size:.82rem"><?php echo e($p->kecamatan?->nama_kecamatan ?? '—'); ?></td>
          <td><span class="badge bg-<?php echo e($p->status_badge); ?>"><?php echo e($p->status_label); ?></span></td>
          <td>
            <div class="d-flex gap-1">
              <a href="<?php echo e(route('admin.pengaduan.show', $p)); ?>" class="btn btn-xs btn-outline-secondary" title="Detail"><i class="bi bi-eye"></i></a>
              <?php if(in_array($p->status, ['pengaduan_baru','menunggu_disposisi'])): ?>
              <a href="<?php echo e(route('admin.pengaduan.edit', $p)); ?>" class="btn btn-xs btn-outline-secondary" title="Edit"><i class="bi bi-pencil"></i></a>
              <a href="<?php echo e(route('admin.disposisi.create', ['pengaduan_id' => $p->id])); ?>" class="btn btn-xs btn-outline-maroon" title="Disposisi"><i class="bi bi-send"></i></a>
              <?php endif; ?>
            </div>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
          <td colspan="9"><div class="empty-state"><i class="bi bi-inbox"></i>Belum ada pengaduan masuk</div></td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <div class="p-3"><?php echo e($pengaduans->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/pengaduan/index.blade.php ENDPATH**/ ?>