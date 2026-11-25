
<?php
    $selected = array_values((array) ($selected ?? []));
    $opsi = \App\Models\Pengaduan::jenisAduanOptions($selected);
    $kolom = $opsi->count() === 1 ? 12 : 6;
?>

<label class="form-label">Jenis Pengaduan <span class="text-danger">*</span></label>
<div class="text-muted mb-2" style="font-size:.76rem">Pilih satu atau lebih jenis pengaduan sesuai laporan yang diterima.
</div>

<div class="row g-3">
    <?php $__empty_1 = true; $__currentLoopData = $opsi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-12 col-lg-<?php echo e($kolom); ?>">
            <div class="h-100" style="border:1px solid <?php echo e($kat->warna); ?>55;border-radius:10px;overflow:hidden">
                <div class="d-flex align-items-center gap-2 px-3 py-2"
                    style="background:<?php echo e($kat->warna); ?>14;border-bottom:1px solid <?php echo e($kat->warna); ?>33">
                    <i class="bi <?php echo e($kat->ikon); ?>" style="color:<?php echo e($kat->warna); ?>"></i>
                    <strong style="font-size:.84rem;color:<?php echo e($kat->warna); ?>"><?php echo e($kat->nama); ?></strong>
                </div>
                <div class="px-3 py-2">
                    <?php $__currentLoopData = $kat->jenis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-check py-1">
                            <input class="form-check-input" type="checkbox" name="jenis_aduan[]"
                                value="<?php echo e($j->kode); ?>" id="ja_<?php echo e($j->kode); ?>"
                                <?php echo e(in_array($j->kode, $selected, true) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="ja_<?php echo e($j->kode); ?>" style="font-size:.84rem">
                                <?php echo e($j->nama); ?>

                                <?php if(!$j->is_active || !$kat->is_active): ?>
                                    <span class="badge bg-secondary ms-1">nonaktif</span>
                                <?php endif; ?>
                            </label>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12">
            <div class="alert alert-warning mb-0" style="font-size:.82rem">
                Belum ada jenis pengaduan yang aktif. Tambahkan terlebih dahulu di
                <a href="<?php echo e(route('admin.jenis-pengaduan.index')); ?>">Master Data → Jenis Pengaduan</a>.
            </div>
        </div>
    <?php endif; ?>
</div>

<?php $__errorArgs = ['jenis_aduan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="text-danger mt-2" style="font-size:.82rem"><?php echo e($message); ?></div>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
<?php $__errorArgs = ['jenis_aduan.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="text-danger mt-2" style="font-size:.82rem"><?php echo e($message); ?></div>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
<?php /**PATH /var/www/html/resources/views/admin/pengaduan/_jenis-aduan.blade.php ENDPATH**/ ?>