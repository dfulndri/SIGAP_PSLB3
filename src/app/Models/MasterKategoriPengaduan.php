<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterKategoriPengaduan extends Model
{
    protected $table    = 'master_kategori_pengaduan';
    protected $fillable = ['kode', 'nama', 'ikon', 'warna', 'urutan', 'is_active'];
    protected $casts    = ['is_active' => 'boolean', 'urutan' => 'integer'];

    /** Pilihan ikon yang boleh dipakai di form master. */
    public static array $ikonList = [
        'bi-trash3'                  => 'Sampah',
        'bi-radioactive'             => 'Limbah B3',
        'bi-exclamation-triangle'    => 'Peringatan',
        'bi-droplet'                 => 'Air / Cairan',
        'bi-wind'                    => 'Udara',
        'bi-tree'                    => 'Lingkungan',
        'bi-folder2-open'            => 'Umum',
    ];

    public function jenis()
    {
        return $this->hasMany(MasterJenisPengaduan::class, 'kategori_id')->orderBy('urutan')->orderBy('nama');
    }

    public function jenisAktif()
    {
        return $this->jenis()->where('is_active', true);
    }
}
