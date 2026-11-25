<?php $__env->startSection('title','Berita Acara'); ?>
<?php $__env->startSection('breadcrumb','Berita Acara'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-hd d-flex align-items-center justify-content-between flex-wrap gap-2">
  <div>
    <h1 class="page-ttl">Berita Acara</h1>
    <p class="page-stl">Daftar seluruh Berita Acara Hasil Verifikasi Lapangan yang telah diterbitkan.</p>
  </div>
</div>

<?php if(session('success')): ?>
<div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3" style="font-size:.85rem">
  <i class="bi bi-check-circle-fill flex-shrink-0"></i> <?php echo e(session('success')); ?>

  <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<div class="card-panel mb-3">
  <div class="cp-body py-3">
    <form method="GET">
      <div class="row g-2 align-items-end">
        <div class="col-6 col-md-3">
          <label class="form-label mb-1" style="font-size:.78rem;font-weight:500">Status</label>
          <select name="status" class="form-select form-select-sm">
            <option value="">Semua</option>
            <option value="draft"  <?php echo e(request('status')=='draft'  ? 'selected':''); ?>>Draft</option>
            <option value="final"  <?php echo e(request('status')=='final'  ? 'selected':''); ?>>Final</option>
          </select>
        </div>
        <div class="col-6 col-md-2 d-flex gap-2">
          <button type="submit" class="btn btn-sm btn-maroon flex-fill">Filter</button>
          <a href="<?php echo e(route('admin.berita-acara.index')); ?>" class="btn btn-sm btn-outline-secondary flex-fill">Reset</a>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="card-panel">
  <div class="cp-head">
    <div class="cp-title">Data Berita Acara</div>
    <div class="cp-sub">Total: <?php echo e($beritaAcaras->total()); ?> BA</div>
  </div>
  <div class="table-responsive">
    <table class="table sipplh-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Nomor BA</th>
          <th>Tanggal Terbit</th>
          <th>Nomor Pengaduan</th>
          <th>Terlapor</th>
          <th>Dibuat oleh</th>
          <th>QR Token</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $beritaAcaras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ba): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td class="text-muted" style="font-size:.75rem"><?php echo e($beritaAcaras->firstItem() + $loop->index); ?></td>
          <td><code style="font-size:.78rem"><?php echo e($ba->nomor_ba); ?></code></td>
          <td style="font-size:.82rem;white-space:nowrap"><?php echo e($ba->tanggal_terbit->format('d M Y')); ?></td>
          <td>
            <?php if($ba->verifikasi?->pengaduan): ?>
            <a href="<?php echo e(route('admin.pengaduan.show', $ba->verifikasi->pengaduan)); ?>" style="font-size:.78rem">
              <code><?php echo e($ba->verifikasi->pengaduan->nomor_pengaduan); ?></code>
            </a>
            <?php else: ?> —
            <?php endif; ?>
          </td>
          <td style="font-size:.82rem"><?php echo e($ba->verifikasi?->pengaduan?->terlapor?->nama ?? '—'); ?></td>
          <td style="font-size:.82rem"><?php echo e($ba->pembuat?->name ?? '—'); ?></td>
          <td>
            <span title="<?php echo e($ba->qr_code_token); ?>" style="font-size:.7rem;color:var(--muted);font-family:var(--font-mono)">
              <?php echo e(substr($ba->qr_code_token,0,8)); ?>...
            </span>
          </td>
          <td>
            <span class="badge bg-<?php echo e($ba->status === 'final' ? 'success' : 'warning'); ?>">
              <?php echo e(ucfirst($ba->status)); ?>

            </span>
          </td>
          <td>
            <div class="d-flex gap-1">
              <a href="<?php echo e(route('admin.berita-acara.show', $ba)); ?>" class="btn btn-xs btn-outline-secondary" title="Detail">
                <i class="bi bi-eye"></i>
              </a>
              <a href="<?php echo e(route('admin.berita-acara.pdf', $ba)); ?>" class="btn btn-xs btn-outline-danger" title="Download PDF" target="_blank">
                <i class="bi bi-file-earmark-pdf"></i>
              </a>
              <?php if($ba->status === 'draft'): ?>
              <form method="POST" action="<?php echo e(route('admin.berita-acara.finalize', $ba)); ?>" class="d-inline">
                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                <button type="submit" class="btn btn-xs btn-outline-success" title="Finalisasi"
                  onclick="return confirm('Finalisasi BA ini? Status tidak bisa dikembalikan ke draft.')">
                  <i class="bi bi-check-all"></i>
                </button>
              </form>
              <?php endif; ?>
            </div>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
          <td colspan="9">
            <div class="empty-state">
              <i class="bi bi-file-earmark-x"></i>
              Belum ada Berita Acara. Selesaikan verifikasi lapangan untuk membuat BA otomatis.
            </div>
          </td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <?php if($beritaAcaras->hasPages()): ?>
  <div class="p-3 border-top"><?php echo e($beritaAcaras->links()); ?></div>
  <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/berita-acara/index.blade.php ENDPATH**/ ?>