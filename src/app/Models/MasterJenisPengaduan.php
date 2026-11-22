<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterJenisPengaduan extends Model
{
    protected $table    = 'master_jenis_pengaduan';
    protected $fillable = ['kategori_id', 'kode', 'nama', 'urutan', 'is_active'];
    protected $casts    = ['is_active' => 'boolean', 'urutan' => 'integer'];

    public function kategori()
    {
        return $this->belongsTo(MasterKategoriPengaduan::class, 'kategori_id');
    }

    /** Jumlah pengaduan yang memakai jenis ini (kolom pengaduan.jenis_aduan berisi array kode). */
    public function jumlahDipakai(): int
    {
        return Pengaduan::whereJsonContains('jenis_aduan', $this->kode)->count();
    }
}
