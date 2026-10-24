<nav id="sidebar">
    <div class="sb-brand">
        <div class="sb-icon"><i class="bi bi-shield-fill-check"></i></div>
        <div>
            <div class="sb-name">SIPPLH</div>
            <div class="sb-sub">DLHK Kab. Tangerang</div>
        </div>
    </div>
    <div class="sb-user">
        <div class="sb-av"><?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?></div>
        <div style="overflow:hidden">
            <div class="sb-uname text-truncate"><?php echo e(auth()->user()->name); ?></div>
            <div class="sb-urole"><?php echo e(ucfirst(auth()->user()->role)); ?></div>
        </div>
    </div>
    <div class="sb-nav">

        
        <div class="sb-sec">Utama</div>
        <a href="<?php echo e(route('admin.dashboard')); ?>"
            class="sb-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
            <i class="bi bi-speedometer2"></i><span>Dashboard</span>
        </a>

        
        <div class="sb-sec">Master Data</div>
        <a href="#pelaporCollapse" class="sb-link <?php echo e(request()->routeIs('admin.pelapor.*') ? 'active' : ''); ?>"
            data-bs-toggle="collapse" aria-expanded="<?php echo e(request()->routeIs('admin.pelapor.*') ? 'true' : 'false'); ?>">
            <i class="bi bi-person-badge-fill"></i>
            <span>Data Pelapor</span>
            <i class="bi bi-chevron-down sb-chevron"></i>
        </a>
        <div class="collapse <?php echo e(request()->routeIs('admin.pelapor.*') ? 'show' : ''); ?>" id="pelaporCollapse">
            <a href="<?php echo e(route('admin.pelapor.index', ['jenis' => 'perorangan'])); ?>"
                class="sb-link sb-link-sub <?php echo e(request()->is('admin/pelapor*') && request('jenis') == 'perorangan' ? 'active' : ''); ?>">
                <i class="bi bi-person"></i><span>Perorangan</span>
            </a>
            <a href="<?php echo e(route('admin.pelapor.index', ['jenis' => 'lembaga'])); ?>"
                class="sb-link sb-link-sub <?php echo e(request()->is('admin/pelapor*') && request('jenis') == 'lembaga' ? 'active' : ''); ?>">
                <i class="bi bi-people"></i><span>Lembaga</span>
            </a>
            <a href="<?php echo e(route('admin.pelapor.index', ['jenis' => 'badan_hukum'])); ?>"
                class="sb-link sb-link-sub <?php echo e(request()->is('admin/pelapor*') && request('jenis') == 'badan_hukum' ? 'active' : ''); ?>">
                <i class="bi bi-building"></i><span>Badan Hukum / Perusahaan</span>
            </a>
        </div>

        <a href="#terlaporCollapse" class="sb-link <?php echo e(request()->routeIs('admin.terlapor.*') ? 'active' : ''); ?>"
            data-bs-toggle="collapse" aria-expanded="<?php echo e(request()->routeIs('admin.terlapor.*') ? 'true' : 'false'); ?>">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <span>Data Terlapor</span>
            <i class="bi bi-chevron-down sb-chevron"></i>
        </a>
        <div class="collapse <?php echo e(request()->routeIs('admin.terlapor.*') ? 'show' : ''); ?>" id="terlaporCollapse">
            <a href="<?php echo e(route('admin.terlapor.index', ['jenis' => 'perorangan'])); ?>"
                class="sb-link sb-link-sub <?php echo e(request()->is('admin/terlapor*') && request('jenis') == 'perorangan' ? 'active' : ''); ?>">
                <i class="bi bi-person-x"></i><span>Kegiatan Perorangan</span>
            </a>
            <a href="<?php echo e(route('admin.terlapor.index', ['jenis' => 'lembaga'])); ?>"
                class="sb-link sb-link-sub <?php echo e(request()->is('admin/terlapor*') && request('jenis') == 'lembaga' ? 'active' : ''); ?>">
                <i class="bi bi-people-fill"></i><span>Lembaga / Organisasi</span>
            </a>
            <a href="<?php echo e(route('admin.terlapor.index', ['jenis' => 'badan_hukum'])); ?>"
                class="sb-link sb-link-sub <?php echo e(request()->is('admin/terlapor*') && request('jenis') == 'badan_hukum' ? 'active' : ''); ?>">
                <i class="bi bi-building-x"></i><span>Badan Hukum / Perusahaan</span>
            </a>
            <a href="<?php echo e(route('admin.terlapor.index', ['jenis' => 'objek_lainnya'])); ?>"
                class="sb-link sb-link-sub <?php echo e(request()->is('admin/terlapor*') && request('jenis') == 'objek_lainnya' ? 'active' : ''); ?>">
                <i class="bi bi-geo-alt"></i><span>Objek Lainnya</span>
            </a>
        </div>

        
        <div class="sb-sec">Pengaduan</div>
        <a href="<?php echo e(route('admin.pengaduan.index')); ?>"
            class="sb-link <?php echo e(request()->routeIs('admin.pengaduan.*') ? 'active' : ''); ?>">
            <i class="bi bi-envelope-open-fill"></i><span>Pengaduan Masuk</span>
            <?php $masuk = \App\Models\Pengaduan::whereIn('status',['pengaduan_baru','menunggu_disposisi'])->count(); ?>
            <?php if($masuk > 0): ?>
                <span class="sb-badge"><?php echo e($masuk); ?></span>
            <?php endif; ?>
        </a>
        <a href="<?php echo e(route('admin.disposisi.index')); ?>"
            class="sb-link <?php echo e(request()->routeIs('admin.disposisi.*') ? 'active' : ''); ?>">
            <i class="bi bi-send-fill"></i><span>Disposisi</span>
        </a>
        <a href="<?php echo e(route('admin.verifikasi.index')); ?>"
            class="sb-link <?php echo e(request()->routeIs('admin.verifikasi.*') ? 'active' : ''); ?>">
            <i class="bi bi-clipboard-check-fill"></i><span>Verifikasi Lapangan</span>
        </a>
        <a href="<?php echo e(route('admin.tindak-lanjut.index')); ?>"
            class="sb-link <?php echo e(request()->routeIs('admin.tindak-lanjut.*') ? 'active' : ''); ?>">
            <i class="bi bi-arrow-repeat"></i><span>Tindak Lanjut</span>
        </a>
        <a href="<?php echo e(route('admin.arsip.index')); ?>"
            class="sb-link <?php echo e(request()->routeIs('admin.arsip.*') ? 'active' : ''); ?>">
            <i class="bi bi-archive-fill"></i><span>Arsip</span>
        </a>

        
        <div class="sb-sec">Manajemen Wilayah</div>
        <a href="<?php echo e(route('admin.wilayah.index')); ?>#kecamatan"
            class="sb-link <?php echo e(request()->routeIs('admin.wilayah.*') ? 'active' : ''); ?>">
            <i class="bi bi-map-fill"></i><span>Kecamatan & Kelurahan</span>
        </a>

        
        <div class="sb-sec">Pengaturan</div>
        <a href="<?php echo e(route('admin.users.index')); ?>"
            class="sb-link <?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>">
            <i class="bi bi-people-fill"></i><span>Manajemen Pengguna</span>
        </a>
        <a href="<?php echo e(route('admin.berita-acara.index')); ?>"
            class="sb-link <?php echo e(request()->routeIs('admin.berita-acara.*') ? 'active' : ''); ?>">
            <i class="bi bi-file-earmark-text-fill"></i><span>Berita Acara</span>
        </a>
        <a href="<?php echo e(route('admin.profil-instansi.edit')); ?>"
            class="sb-link <?php echo e(request()->routeIs('admin.profil-instansi.*') ? 'active' : ''); ?>">
            <i class="bi bi-gear-fill"></i><span>Profil Instansi</span>
        </a>
    </div>

    <div class="sb-foot">
        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="sb-link w-100 border-0 bg-transparent text-start" style="cursor:pointer">
                <i class="bi bi-box-arrow-left"></i><span>Keluar</span>
            </button>
        </form>
        <div class="sb-ver">SIPPLH v2.0 &copy; <?php echo e(date('Y')); ?></div>
    </div>
</nav>
<div id="sidebar-overlay" onclick="closeSidebar()"
    style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:1049"></div>
<?php /**PATH /var/www/html/resources/views/layouts/partials/_sidebar.blade.php ENDPATH**/ ?>