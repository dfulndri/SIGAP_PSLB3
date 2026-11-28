<?php $__env->startSection('title','Verifikasi Lapangan'); ?>
<?php $__env->startSection('breadcrumb','Verifikasi Lapangan'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-hd d-flex align-items-center justify-content-between flex-wrap gap-2">
  <div>
    <h1 class="page-ttl">Verifikasi Lapangan</h1>
    <p class="page-stl">Daftar seluruh kegiatan verifikasi lapangan yang telah dilakukan.</p>
  </div>
  <a href="<?php echo e(route('admin.verifikasi.create')); ?>" class="btn btn-maroon">
    <i class="bi bi-plus-circle me-1"></i> Buat Verifikasi
  </a>
</div>

<?php if(session('success')): ?>
<div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3" style="font-size:.85rem">
  <i class="bi bi-check-circle-fill flex-shrink-0"></i> <?php echo e(session('success')); ?>

  <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>


<div class="card-panel mb-3">
  <div class="cp-body py-3">
    <form method="GET" action="<?php echo e(route('admin.verifikasi.index')); ?>">
      <div class="row g-2 align-items-end">
        <div class="col-6 col-md-3">
          <label class="form-label mb-1" style="font-size:.78rem;font-weight:500">Status</label>
          <select name="status" class="form-select form-select-sm">
            <option value="">Semua Status</option>
            <option value="draft"   <?php echo e(request('status')=='draft'   ? 'selected' : ''); ?>>Draft</option>
            <option value="selesai" <?php echo e(request('status')=='selesai' ? 'selected' : ''); ?>>Selesai</option>
          </select>
        </div>
        <div class="col-6 col-md-3 d-flex gap-2">
          <button type="submit" class="btn btn-sm btn-maroon flex-fill">
            <i class="bi bi-funnel me-1"></i> Filter
          </button>
          <a href="<?php echo e(route('admin.verifikasi.index')); ?>" class="btn btn-sm btn-outline-secondary flex-fill">Reset</a>
        </div>
      </div>
    </form>
  </div>
</div>


<div class="card-panel">
  <div class="cp-head">
    <div>
      <div class="cp-title">Data Verifikasi Lapangan</div>
      <div class="cp-sub">Total: <strong><?php echo e($verifikasis->total()); ?></strong> verifikasi</div>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table sipplh-table">
      <thead>
        <tr>
          <th style="width:40px">#</th>
          <th>Tanggal Verifikasi</th>
          <th>Nomor Pengaduan</th>
          <th>Terlapor</th>
          <th>Tim Verifikator</th>
          <th>Dibuat oleh</th>
          <th>Tenggat</th>
          <th>Status</th>
          <th style="width:100px">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $verifikasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td class="text-muted" style="font-size:.75rem"><?php echo e($verifikasis->firstItem() + $loop->index); ?></td>
          <td style="white-space:nowrap;font-size:.82rem">
            <?php echo e($v->tanggal_verifikasi->format('d M Y')); ?>

          </td>
          <td>
            <?php if($v->pengaduan): ?>
            <a href="<?php echo e(route('admin.pengaduan.show', $v->pengaduan)); ?>" style="font-size:.78rem">
              <code><?php echo e($v->pengaduan->nomor_pengaduan); ?></code>
            </a>
            <?php else: ?>
            <span class="text-muted">—</span>
            <?php endif; ?>
          </td>
          <td style="font-size:.82rem"><?php echo e($v->pengaduan?->terlapor?->nama ?? '—'); ?></td>
          <td>
            <span class="badge" style="background:rgba(106,0,0,.08);color:var(--maroon);font-size:.72rem">
              <?php echo e($v->timVerifikator->count() ?? '?'); ?> orang
            </span>
          </td>
          <td style="font-size:.82rem"><?php echo e($v->pembuat?->name ?? '—'); ?></td>
          <td style="font-size:.82rem;white-space:nowrap">
            <?php if($v->tenggat_tindak_lanjut): ?>
              <?php $lewat = $v->tenggat_tindak_lanjut->isPast(); ?>
              <span class="<?php echo e($lewat ? 'text-danger' : 'text-muted'); ?>">
                <?php echo e($v->tenggat_tindak_lanjut->format('d M Y')); ?>

                <?php if($lewat): ?> <i class="bi bi-exclamation-circle-fill" title="Sudah lewat tenggat"></i> <?php endif; ?>
              </span>
            <?php else: ?>
              <span class="text-muted">—</span>
            <?php endif; ?>
          </td>
          <td>
            <span class="badge bg-<?php echo e($v->status === 'selesai' ? 'success' : 'warning'); ?>">
              <?php echo e(ucfirst($v->status)); ?>

            </span>
          </td>
          <td>
            <div class="d-flex gap-1">
              <a href="<?php echo e(route('admin.verifikasi.show', $v)); ?>"
                class="btn btn-xs btn-outline-secondary" title="Detail">
                <i class="bi bi-eye"></i>
              </a>
              <?php if($v->status === 'draft'): ?>
              <a href="<?php echo e(route('admin.verifikasi.edit', $v)); ?>"
                class="btn btn-xs btn-outline-warning" title="Edit">
                <i class="bi bi-pencil"></i>
              </a>
              <?php endif; ?>
            </div>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
          <td colspan="9">
            <div class="empty-state">
              <i class="bi bi-clipboard-x"></i>
              Belum ada data verifikasi lapangan.
            </div>
          </td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <?php if($verifikasis->hasPages()): ?>
  <div class="p-3 border-top"><?php echo e($verifikasis->links()); ?></div>
  <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/verifikasi/index.blade.php ENDPATH**/ ?>