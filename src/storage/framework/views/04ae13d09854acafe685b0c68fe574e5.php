
<?php
    $filterKategori = \App\Models\MasterKategoriPengaduan::with('jenis')->orderBy('urutan')->orderBy('nama')->get();
?>
<select name="jenis" class="form-select form-select-sm">
    <option value="">Semua Jenis</option>
    <?php $__currentLoopData = $filterKategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <optgroup label="<?php echo e($k->nama); ?>">
            <option value="kategori:<?php echo e($k->id); ?>"
                <?php echo e(request('jenis') === 'kategori:' . $k->id ? 'selected' : ''); ?>>
                Semua <?php echo e($k->nama); ?>

            </option>
            <?php $__currentLoopData = $k->jenis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($j->kode); ?>" <?php echo e(request('jenis') === $j->kode ? 'selected' : ''); ?>>
                    <?php echo e($j->nama); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </optgroup>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
<?php /**PATH /var/www/html/resources/views/partials/filter-jenis.blade.php ENDPATH**/ ?>