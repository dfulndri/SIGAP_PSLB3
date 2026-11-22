
<?php $stack = $stack ?? true; ?>
<?php $__currentLoopData = $pengaduan->jenis_aduan_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ja): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <span class="badge-kat <?php echo e($stack ? 'd-table mb-1' : 'me-1'); ?>"
        style="background:<?php echo e($ja['warna']); ?>1a;color:<?php echo e($ja['warna']); ?>"
        <?php if($ja['kategori_nama']): ?> title="<?php echo e($ja['kategori_nama']); ?>" <?php endif; ?>><?php echo e($ja['nama']); ?></span>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /var/www/html/resources/views/partials/jenis-badges.blade.php ENDPATH**/ ?>