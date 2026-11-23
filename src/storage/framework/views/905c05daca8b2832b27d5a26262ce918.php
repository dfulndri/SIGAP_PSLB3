<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Berita Acara <?php echo e($ba->nomor_ba); ?></title>
    <style>
        @page {
            margin: 1.5cm 2cm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
            line-height: 1.45;
            color: #000;
            margin: 0;
        }

        p {
            margin: 0 0 8px;
        }

        .tc {
            text-align: center;
        }

        .tr {
            text-align: right;
        }

        .tj {
            text-align: justify;
        }

        .b {
            font-weight: bold;
        }

        .u {
            text-decoration: underline;
        }

        .mt10 {
            margin-top: 10px;
        }

        .mt15 {
            margin-top: 15px;
        }

        /* ── KOP SURAT ── */
        .kop {
            width: 100%;
            border-collapse: collapse;
        }

        .kop td {
            vertical-align: middle;
            padding: 0;
        }

        .kop .logo-cell {
            width: 90px;
            text-align: center;
        }

        .kop .logo-cell img {
            width: 80px;
            height: auto;
        }

        .kop .txt-cell {
            text-align: center;
        }

        .kop .txt-cell .l1 {
            font-size: 13pt;
            margin: 0;
        }

        .kop .txt-cell .l2 {
            font-size: 17pt;
            font-weight: bold;
            margin: 0;
            letter-spacing: .5px;
        }

        .kop .txt-cell .l3 {
            font-size: 8pt;
            margin: 3px 0 0;
            line-height: 1.3;
        }

        .kop-line {
            border-bottom: 3px solid #000;
            margin: 3px 0 2px;
        }

        .kop-line2 {
            border-bottom: 1px solid #000;
            margin: 0 0 14px;
        }

        /* ── JUDUL ── */
        .title {
            text-align: center;
            margin: 6px 0 14px;
        }

        .title h3 {
            font-size: 12pt;
            font-weight: bold;
            margin: 0;
            line-height: 1.35;
        }

        /* ── SECTION ── */
        .sec {
            font-weight: bold;
            font-size: 11pt;
            margin: 12px 0 6px;
        }

        /* ── Identitas Pengawas (A) ── */
        .idn {
            width: 100%;
            border-collapse: collapse;
        }

        .idn td {
            vertical-align: top;
            padding: 0 0 1px;
            font-size: 11pt;
        }

        .idn .no {
            width: 26px;
        }

        .idn .key {
            width: 120px;
        }

        .idn .sep {
            width: 12px;
        }

        /* ── Identitas PJ (B) ── */
        .pj {
            width: 100%;
            border-collapse: collapse;
        }

        .pj td {
            vertical-align: top;
            padding: 1px 0;
            font-size: 11pt;
        }

        .pj .no {
            width: 26px;
        }

        .pj .key {
            width: 210px;
        }

        .pj .sep {
            width: 12px;
        }

        /* ── Uraian box (C/D/E) ── */
        .box {
            border: 1px solid #000;
            padding: 8px 10px;
            min-height: 55px;
            font-size: 11pt;
            text-align: justify;
        }

        .box p {
            margin: 0 0 4px;
        }

        .box ul,
        .box ol {
            margin: 4px 0;
            padding-left: 22px;
        }

        .box img {
            max-width: 100%;
            height: auto;
        }

        .box table {
            border-collapse: collapse;
            width: 100%;
            margin: 4px 0;
        }

        .box table td,
        .box table th {
            border: 1px solid #555;
            padding: 3px 6px;
        }

        /* ── Tanda tangan ── */
        .ttd-block {
            margin-top: 10px;
        }

        .ttd-block .hdr {
            font-weight: bold;
            margin-bottom: 4px;
        }

        .ttd-item {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2px;
        }

        .ttd-item td {
            vertical-align: top;
            font-size: 11pt;
            padding: 0;
        }

        .ttd-item .no {
            width: 24px;
        }

        .ttd-item .key {
            width: 90px;
        }

        .ttd-item .sep {
            width: 10px;
        }

        .sign-gap {
            height: 55px;
        }

        /* ── Dokumentasi ── */
        .foto-grid {
            width: 100%;
            border-collapse: collapse;
        }

        .foto-grid td {
            width: 50%;
            padding: 6px;
            text-align: center;
            vertical-align: top;
        }

        .foto-grid img {
            max-width: 100%;
            max-height: 200px;
            border: 1px solid #999;
        }

        .foto-cap {
            font-size: 9pt;
            margin-top: 4px;
            color: #333;
        }

        /* ── QR ── */
        .qr {
            margin-top: 16px;
        }

        .qr img {
            width: 90px;
            height: 90px;
        }

        .qr .lbl {
            font-size: 7.5pt;
            color: #555;
        }

        .pb {
            page-break-before: always;
        }
    </style>
</head>

<body>

    <?php
        $v = $ba->verifikasi;
        $p = $v?->pengaduan;
        $pj = $v?->penanggungJawab;
        $tv = $v?->timVerifikator ?? collect();
        $sk = $v?->saksi ?? collect();
        $tgl = $v?->tanggal_verifikasi;
        $hari = $tgl?->locale('id')->isoFormat('dddd');
        $tglAngka = $tgl ? \App\Support\Terbilang::angka((int) $tgl->locale('id')->isoFormat('D')) : null;
        $bulan = $tgl?->locale('id')->isoFormat('MMMM');
        $tahun = $tgl?->isoFormat('Y');
        $jam = $v?->jam_verifikasi
            ? \Illuminate\Support\Str::of($v->jam_verifikasi)->substr(0, 5)->replace(':', '.')
            : '—';
        $zona = $profil->zona_waktu ?? 'WIB';
        $jenisAduan =
            is_array($p?->jenis_aduan) && count($p->jenis_aduan) ? implode(', ', $p->jenis_aduan_labels) : '—';
        $namaTerlapor = $pj?->nama_perusahaan ?? ($p?->terlapor?->nama ?? '—');
        $jenisTerlapor = $p?->terlapor?->jenis_terlapor ?? 'perorangan';
        $pjLabel = [
            'perorangan' => [
                'identitas' => null,
                'bidang' => 'Bidang Usaha',
                'deskripsi' => 'Deskripsi Kegiatan',
                'pj' => 'Penanggung Jawab',
            ],
            'lembaga' => [
                'identitas' => 'Nama Lembaga',
                'bidang' => 'Jenis/Kategori Lembaga',
                'deskripsi' => 'Deskripsi Kegiatan',
                'pj' => 'Penanggung Jawab',
            ],
            'badan_hukum' => [
                'identitas' => 'Nama Perusahaan',
                'bidang' => 'Bidang Usaha',
                'deskripsi' => 'Deskripsi Kegiatan',
                'pj' => 'Penanggung Jawab',
            ],
            'objek_lainnya' => [
                'identitas' => 'Nama/Identitas Objek',
                'bidang' => 'Jenis Objek',
                'deskripsi' => 'Deskripsi Objek',
                'pj' => 'Pemilik/Pengelola',
            ],
        ][$jenisTerlapor];
        $koord =
            $pj?->koordinat_lat ?? $v?->koordinat_lat
                ? ($pj?->koordinat_lat ?? $v?->koordinat_lat) . ',' . ($pj?->koordinat_lng ?? $v?->koordinat_lng)
                : '—';
    ?>

    
    <table class="kop">
        <tr>
            <td class="logo-cell">
                <?php if($logoPath): ?>
                    <img src="<?php echo e($logoPath); ?>" alt="Logo">
                <?php endif; ?>
            </td>
            <td class="txt-cell">
                <div class="l1">PEMERINTAH <?php echo e(strtoupper($profil->nama_kabupaten ?? 'KABUPATEN TANGERANG')); ?></div>
                <div class="l2"><?php echo e(strtoupper($profil->nama_instansi ?? 'DINAS LINGKUNGAN HIDUP DAN KEBERSIHAN')); ?>

                </div>
                <div class="l3">
                    <?php echo e($profil->alamat ?? 'Jl. Atik Soewardi Nomor 1, Gedung Lingkup PU LT Dasar-Puspem Tigaraksa, Tangerang, Banten, 15720'); ?><br>
                    Telepon <?php echo e($profil->telepon ?? '081188881398'); ?>, Laman
                    <?php echo e($profil->website ?? 'dlhk.tangerangkab.go.id'); ?>,<br>
                    Pos-el <?php echo e($profil->email ?? 'dlhk.kabtangerang1@gmail.com'); ?>

                </div>
            </td>
        </tr>
    </table>
    <div class="kop-line"></div>
    <div class="kop-line2"></div>

    
    <div class="title">
        <h3>BERITA ACARA HASIL VERIFIKASI LAPANGAN<br>
            PENGADUAN DUGAAN PENCEMARAN DAN/ATAU PERUSAKAN LINGKUNGAN HIDUP</h3>
    </div>

    
    <p class="tj">
        Pada hari ini <span class="b"><?php echo e($hari ?? '—'); ?></span> tanggal <span
            class="b"><?php echo e($tglAngka ?? '—'); ?></span>
        bulan <span class="b"><?php echo e($bulan ?? '—'); ?></span> tahun <span class="b"><?php echo e($tahun ?? '—'); ?></span>
        jam <span class="b"><?php echo e($jam); ?> <?php echo e($zona); ?></span><br>
        Kami yang bertanda tangan dibawah ini :
    </p>

    
    <p class="sec">A. Identitas Pengawas Lingkungan Hidup</p>
    <table class="idn">
        <?php $__empty_1 = true; $__currentLoopData = $tv; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td class="no"><?php echo e($i + 1); ?>.</td>
                <td class="key">Nama</td>
                <td class="sep">:</td>
                <td class="b"><?php echo e($t->nama); ?></td>
            </tr>
            <tr>
                <td></td>
                <td class="key">NIP</td>
                <td class="sep">:</td>
                <td><?php echo e($t->nip ?? '-'); ?></td>
            </tr>
            <tr>
                <td></td>
                <td class="key">Pangkat/Gol</td>
                <td class="sep">:</td>
                <td><?php echo e($t->pangkat ?? '-'); ?></td>
            </tr>
            <tr>
                <td></td>
                <td class="key">Jabatan</td>
                <td class="sep">:</td>
                <td><?php echo e($t->jabatan ?? '-'); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="4"><em>Belum ada data tim verifikator.</em></td>
            </tr>
        <?php endif; ?>
    </table>

    <p class="tj mt15">
        Telah melakukan verifikasi lapangan terkait pengaduan dugaan pencemaran dan/atau
        perusakan lingkungan hidup pada <span class="b"><?php echo e($hari); ?>,
            <?php echo e($tgl?->locale('id')->isoFormat('D MMMM Y')); ?></span>
        Pukul <span class="b"><?php echo e($jam); ?></span> dengan dugaan
        <span class="b"><?php echo e($jenisAduan); ?></span> terhadap :<br>
        <span class="b"><?php echo e($namaTerlapor); ?></span>
    </p>

    
    <p class="sec">B. Identitas Penanggung Jawab Usaha dan/atau Kegiatan</p>
    <?php
        $pjRows = collect();
        if ($pjLabel['identitas']) {
            $identitasValue =
                $jenisTerlapor === 'objek_lainnya' ? ($p?->terlapor?->nama ?: '-') : ($pj?->nama_perusahaan ?: '-');
            $pjRows->push([$pjLabel['identitas'], $identitasValue, true]);
        }
        if ($jenisTerlapor === 'badan_hukum') {
            $pjRows->push(['Jenis Kegiatan Utama (KBLI)', $pj?->kbli_display ?? '-']);
        }
        $pjRows->push([$pjLabel['bidang'], $pj?->bidang_usaha ?: '-']);
        $pjRows->push([$pjLabel['deskripsi'], $pj?->deskripsi_kegiatan ?: '-']);
        $pjRows->push(['Alamat Lokasi Kegiatan', $pj?->alamat_perusahaan ?? ($p?->terlapor?->alamat ?? '-')]);
        if ($jenisTerlapor === 'badan_hukum') {
            $pjRows->push(['NIB', $pj?->nib ?? ($p?->terlapor?->nib ?? '-')]);
            $pjRows->push(['Status Permodalan', $pj?->status_permodalan ?? '-']);
        }
        $pjRows->push(['No Tlp / Fax', $pj?->no_telp ?? ($p?->terlapor?->no_telp ?? '-')]);
        $pjRows->push(['Email', $pj?->email ?? '-']);
        $pjRows->push([$pjLabel['pj'], $pj?->nama_pj ?? ($v?->nama_penanggung_jawab ?? '-')]);
        $pjRows->push(['Jabatan', $pj?->jabatan_pj ?? ($v?->jabatan_pj ?? '-')]);
        $pjRows->push(['Titik Koordinat Lokasi Kegiatan', $koord]);
    ?>
    <table class="pj">
        <?php $__currentLoopData = $pjRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="no"><?php echo e($i + 1); ?>.</td>
                <td class="key"><?php echo e($row[0]); ?></td>
                <td class="sep">:</td>
                <td class="<?php echo e($row[2] ?? false ? 'b' : ''); ?>"><?php echo e($row[1]); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>

    
    <p class="sec">C. Informasi Administrasi Kegiatan</p>
    <div class="box"><?php echo $v?->informasi_administrasi ?: '-'; ?></div>

    
    <p class="sec">D. Fakta Temuan Lapangan Terkait Laporan Pengaduan</p>
    <div class="box"><?php echo $v?->fakta_temuan ?: '-'; ?></div>

    
    <p class="sec">E. Saran Tindak Lanjut</p>
    <div class="box"><?php echo $v?->saran_tindak_lanjut ?: '-'; ?></div>

    
    <p class="tj mt15">
        Pelaksanaan dan temuan fakta-fakta verifikasi pengaduan lingkungan hidup ini diketahui
        dan dibenarkan oleh pihak <span class="b">Terlapor</span> dan akan ditindaklanjuti
        selambat-lambatnya 14 (empat belas) hari setelah Berita Acara ini ditandatangani.
    </p>

    
    <div style="margin-top:12px;">
        
        <div class="ttd-block">
            <div class="hdr">Tim Penanggung Jawab Kegiatan</div>
            <?php
                $pjList = collect();
                if ($pj?->nama_pj) {
                    $pjList->push(['nama' => $pj->nama_pj, 'jabatan' => $pj->jabatan_pj]);
                } elseif ($v?->nama_penanggung_jawab) {
                    $pjList->push(['nama' => $v->nama_penanggung_jawab, 'jabatan' => $v->jabatan_pj]);
                }
                if ($pjList->isEmpty()) {
                    $pjList->push(['nama' => '........................', 'jabatan' => '']);
                }
            ?>
            <?php $__currentLoopData = $pjList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <table class="ttd-item">
                    <tr>
                        <td class="no"><?php echo e($i + 1); ?>.</td>
                        <td class="key">Nama</td>
                        <td class="sep">:</td>
                        <td class="b"><?php echo e($x['nama']); ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="key">Jabatan</td>
                        <td class="sep">:</td>
                        <td><?php echo e($x['jabatan'] ?: '-'); ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="key">Tanda Tangan</td>
                        <td class="sep">:</td>
                        <td></td>
                    </tr>
                </table>
                <div class="sign-gap"></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="ttd-block">
            <div class="hdr">Tim Verifikator</div>
            <?php $__empty_1 = true; $__currentLoopData = $tv; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <table class="ttd-item">
                    <tr>
                        <td class="no"><?php echo e($i + 1); ?>.</td>
                        <td class="key">Nama</td>
                        <td class="sep">:</td>
                        <td class="b"><?php echo e($t->nama); ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="key">Jabatan</td>
                        <td class="sep">:</td>
                        <td><?php echo e($t->jabatan ?: '-'); ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="key">Tanda Tangan</td>
                        <td class="sep">:</td>
                        <td></td>
                    </tr>
                </table>
                <div class="sign-gap"></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <em>-</em>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="ttd-block" style="margin-top:8px;">
        <div class="hdr">Saksi - Saksi</div>
        <table style="width:100%; border-collapse:collapse;">
            <tr>
                <?php $skList = $sk->isNotEmpty() ? $sk : collect([(object)['nama'=>'........................','jabatan'=>''],(object)['nama'=>'........................','jabatan'=>'']]); ?>
                <?php $__currentLoopData = $skList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td style="width:50%; vertical-align:top; padding:0 10px 0 0;">
                        <table class="ttd-item">
                            <tr>
                                <td class="no"><?php echo e($i + 1); ?>.</td>
                                <td class="key">Nama</td>
                                <td class="sep">:</td>
                                <td class="b"><?php echo e($s->nama); ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="key">Jabatan</td>
                                <td class="sep">:</td>
                                <td><?php echo e($s->jabatan ?: '-'); ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="key">Tanda Tangan</td>
                                <td class="sep">:</td>
                                <td></td>
                            </tr>
                        </table>
                        <div class="sign-gap"></div>
                    </td>
                    <?php if($i % 2 == 1): ?>
            </tr>
            <tr>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        </table>
    </div>

    <?php
        $qrBlock =
            '
  <table style="width:100%; margin-top:10px;"><tr>
    <td style="text-align:left; vertical-align:bottom; font-size:9pt;">
      Nomor BA: <span class="b">' .
            $ba->nomor_ba .
            '</span><br>
      ' .
            ($profil->nama_kabupaten ?? 'Kabupaten Tangerang') .
            ', ' .
            $ba->tanggal_terbit->locale('id')->isoFormat('D MMMM Y') .
            '
    </td>
    <td style="text-align:right;">
      <div class="qr">
        <img src="data:image/svg+xml;base64,' .
            $qrCode .
            '" alt="QR">
        <div class="lbl">Scan untuk verifikasi keaslian dokumen</div>
      </div>
    </td>
  </tr></table>';
    ?>

    
    <?php if(!empty($qrCode) && $v?->dokumentasiFoto->isEmpty()): ?>
        <?php echo $qrBlock; ?>

    <?php endif; ?>

    
    <?php if($v?->dokumentasiFoto->isNotEmpty()): ?>
        <div class="pb"></div>
        <div class="title">
            <h3>DOKUMENTASI KEGIATAN VERIFIKASI LAPANGAN<br>
                PENGADUAN DUGAAN PENCEMARAN DAN/ATAU PERUSAKAN LINGKUNGAN HIDUP</h3>
        </div>
        <table class="foto-grid">
            <?php $__currentLoopData = $v->dokumentasiFoto->chunk(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td>
                            <?php $fotoAbs = storage_path('app/public/' . $foto->path_file); ?>
                            <?php if(file_exists($fotoAbs)): ?>
                                <img src="<?php echo e(\App\Support\ImageResizer::forPdf($fotoAbs)); ?>" alt="foto">
                            <?php else: ?>
                                <div style="height:180px;border:1px dashed #bbb;color:#999;padding-top:80px;">Foto tidak
                                    ditemukan</div>
                            <?php endif; ?>
                            <div class="foto-cap"><?php echo e($foto->keterangan ?: 'Dokumentasi ' . $foto->urutan); ?></div>
                        </td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if($row->count() < 2): ?>
                        <td></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>

        
        <?php if(!empty($qrCode)): ?>
            <?php echo $qrBlock; ?>

        <?php endif; ?>
    <?php endif; ?>

</body>

</html>
<?php /**PATH /var/www/html/resources/views/pdf/berita-acara.blade.php ENDPATH**/ ?>