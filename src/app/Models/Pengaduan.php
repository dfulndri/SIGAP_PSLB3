<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Pengaduan extends Model
{
    protected $table    = 'pengaduan';
    protected $fillable = [
        'nomor_pengaduan',
        'tanggal_pengaduan',
        'sumber_laporan',
        'jenis_aduan',
        'status',
        'uraian_pengaduan',
        'lokasi_kejadian',
        'kecamatan_id',
        'kelurahan_id',
        'koordinat_lat',
        'koordinat_lng',
        'pelapor_id',
        'terlapor_id',
        'assigned_to',
        'catatan_admin',
        'dokumen_pendukung',
    ];

    protected $casts = [
        'tanggal_pengaduan' => 'date',
        'jenis_aduan'       => 'array',
    ];

    // ── Status Constants ─────────────────────────────────────────
    const STATUS_PENGADUAN_BARU      = 'pengaduan_baru';
    const STATUS_MENUNGGU_DISPOSISI  = 'menunggu_disposisi';
    const STATUS_DIDISPOSISIKAN      = 'didisposisikan';
    const STATUS_VERIFIKASI_LAPANGAN = 'verifikasi_lapangan';
    const STATUS_VERIFIKASI_SELESAI  = 'verifikasi_selesai';
    const STATUS_TINDAK_LANJUT       = 'tindak_lanjut';
    const STATUS_SELESAI             = 'selesai';
    const STATUS_ARSIP               = 'arsip';

    public static array $statusList = [
        'pengaduan_baru'      => 'Pengaduan Baru',
        'menunggu_disposisi'  => 'Menunggu Disposisi',
        'didisposisikan'      => 'Didisposisikan',
        'verifikasi_lapangan' => 'Verifikasi Lapangan',
        'verifikasi_selesai'  => 'Verifikasi Selesai',
        'tindak_lanjut'       => 'Tindak Lanjut',
        'selesai'             => 'Selesai',
        'arsip'               => 'Arsip',
    ];

    // ── Accessors ────────────────────────────────────────────────
    public function getStatusLabelAttribute(): string
    {
        return self::$statusList[$this->status] ?? ucfirst($this->status);
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'pengaduan_baru'      => 'secondary',
            'menunggu_disposisi'  => 'warning',
            'didisposisikan'      => 'info',
            'verifikasi_lapangan' => 'primary',
            'verifikasi_selesai'  => 'success',
            'tindak_lanjut'       => 'dark',
            'selesai'             => 'success',
            'arsip'               => 'secondary',
            default               => 'secondary',
        };
    }

    /** Daftar nama jenis aduan, mis. ['Pembakaran Sampah', 'Penumpukan Limbah B3'] */
    public function getJenisAduanLabelsAttribute(): array
    {
        return array_column($this->jenis_aduan_items, 'nama');
    }

    /**
     * Detail tiap jenis aduan (nama, kategori, warna) untuk badge berwarna.
     * Kode yang sudah tidak ada di master tetap ditampilkan sebagai teks biasa.
     */
    public function getJenisAduanItemsAttribute(): array
    {
        $meta  = self::jenisAduanMeta();
        $items = [];
        foreach ($this->jenis_aduan ?? [] as $kode) {
            $m = $meta[$kode] ?? null;
            $items[] = [
                'kode'          => $kode,
                'nama'          => $m['nama'] ?? ucwords(str_replace('_', ' ', $kode)),
                'kategori_kode' => $m['kategori_kode'] ?? null,
                'kategori_nama' => $m['kategori_nama'] ?? null,
                'warna'         => $m['warna'] ?? '#64748b',
            ];
        }
        return $items;
    }

    /** Nama kategori yang tercakup, mis. ['Pengelolaan Sampah'] (unik, urut sesuai pilihan) */
    public function getKategoriLabelsAttribute(): array
    {
        $names = array_filter(array_column($this->jenis_aduan_items, 'kategori_nama'));
        return array_values(array_unique($names));
    }

    // ── Jenis Aduan (bersumber dari Master Data → Jenis Pengaduan) ─
    private static ?array $jenisMetaCache = null;

    /**
     * Semua jenis (termasuk yang nonaktif, agar data lama tetap terbaca),
     * urut sesuai kategori lalu urutan jenis.
     * @return array<string, array{nama:string,kategori_kode:string,kategori_nama:string,warna:string,ikon:string,is_active:bool}>
     */
    public static function jenisAduanMeta(): array
    {
        if (self::$jenisMetaCache !== null) {
            return self::$jenisMetaCache;
        }

        $meta = [];
        $kategoris = MasterKategoriPengaduan::with('jenis')->orderBy('urutan')->orderBy('nama')->get();
        foreach ($kategoris as $k) {
            foreach ($k->jenis as $j) {
                $meta[$j->kode] = [
                    'nama'          => $j->nama,
                    'kategori_kode' => $k->kode,
                    'kategori_nama' => $k->nama,
                    'warna'         => $k->warna,
                    'ikon'          => $k->ikon,
                    'is_active'     => $k->is_active && $j->is_active,
                ];
            }
        }

        return self::$jenisMetaCache = $meta;
    }

    /** [kode => nama] */
    public static function jenisAduanList(): array
    {
        return array_map(fn($m) => $m['nama'], self::jenisAduanMeta());
    }

    public static function flushJenisAduanCache(): void
    {
        self::$jenisMetaCache = null;
    }

    /**
     * Pilihan untuk form: kategori beserta jenis yang aktif.
     * Jenis nonaktif tetap muncul bila sudah dipilih pada pengaduan yang sedang diedit.
     */
    public static function jenisAduanOptions(array $selected = [])
    {
        return MasterKategoriPengaduan::with('jenis')
            ->orderBy('urutan')->orderBy('nama')->get()
            ->map(function ($k) use ($selected) {
                $k->setRelation('jenis', $k->jenis->filter(
                    fn($j) => in_array($j->kode, $selected, true) || ($k->is_active && $j->is_active)
                )->values());
                return $k;
            })
            ->filter(fn($k) => $k->jenis->isNotEmpty())
            ->values();
    }

    /**
     * Hitung statistik dari kumpulan nilai kolom jenis_aduan.
     * @return array{jenis: array<string,int>, kategori: array<string,int>}
     */
    public static function hitungJenis(iterable $rows): array
    {
        $meta = self::jenisAduanMeta();
        $jenis = [];
        $kategori = [];

        foreach ($rows as $list) {
            if (!is_array($list)) continue;
            $seen = [];
            foreach (array_unique($list) as $kode) {
                $jenis[$kode] = ($jenis[$kode] ?? 0) + 1;
                $kat = $meta[$kode]['kategori_kode'] ?? null;
                if ($kat && !isset($seen[$kat])) {
                    $seen[$kat] = true;
                    $kategori[$kat] = ($kategori[$kat] ?? 0) + 1;
                }
            }
        }
        arsort($jenis);

        return ['jenis' => $jenis, 'kategori' => $kategori];
    }

    // ── Auto-generate nomor: PGD/001/VII/2026 ────────────────────
    public static function generateNomor(): string
    {
        $bulanRomawi = [1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'];
        $bulan = $bulanRomawi[now()->month];
        $tahun = now()->year;
        $urut  = static::whereYear('created_at', $tahun)->count() + 1;
        return sprintf('PGD/%03d/%s/%d', $urut, $bulan, $tahun);
    }

    // ── Scopes ───────────────────────────────────────────────────
    public function scopeStatus(Builder $q, string $status): Builder
    {
        return $q->where('status', $status);
    }

    public function scopeTahun(Builder $q, int $tahun): Builder
    {
        return $q->whereYear('tanggal_pengaduan', $tahun);
    }

    /**
     * Filter berdasarkan jenis aduan.
     * Nilai "kategori:{id}" = semua jenis dalam kategori itu; selain itu = kode jenis.
     */
    public function scopeFilterJenis(Builder $q, ?string $value): Builder
    {
        if (!$value) {
            return $q;
        }

        if (str_starts_with($value, 'kategori:')) {
            $kodes = MasterJenisPengaduan::where('kategori_id', (int) substr($value, 9))->pluck('kode')->all();
            if (!$kodes) {
                return $q->whereRaw('1 = 0');
            }
            return $q->where(function (Builder $w) use ($kodes) {
                foreach ($kodes as $kode) {
                    $w->orWhereJsonContains('jenis_aduan', $kode);
                }
            });
        }

        return $q->whereJsonContains('jenis_aduan', $value);
    }

    // ── Relationships ────────────────────────────────────────────
    public function pelapor()
    {
        return $this->belongsTo(Pelapor::class);
    }
    public function terlapor()
    {
        return $this->belongsTo(Terlapor::class);
    }
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
    public function kecamatan()
    {
        return $this->belongsTo(MasterKecamatan::class, 'kecamatan_id');
    }
    public function kelurahan()
    {
        return $this->belongsTo(MasterKelurahan::class, 'kelurahan_id');
    }
    public function verifikasi()
    {
        return $this->hasOne(VerifikasiLapangan::class, 'pengaduan_id');
    }
    public function disposisi()
    {
        return $this->hasOne(Disposisi::class, 'pengaduan_id');
    }
    public function tindakLanjut()
    {
        return $this->hasMany(TindakLanjut::class, 'pengaduan_id');
    }
}
