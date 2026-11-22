<?php

namespace Database\Seeders;

use App\Models\MasterJenisPengaduan;
use App\Models\MasterKategoriPengaduan;
use Illuminate\Database\Seeder;

/**
 * Data awal Kategori & Jenis Pengaduan (Divisi PSLB3).
 * Aman dijalankan berulang kali (updateOrCreate berdasarkan kode).
 *
 *   php artisan db:seed --class=JenisPengaduanSeeder
 */
class JenisPengaduanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode'   => 'sampah',
                'nama'   => 'Pengelolaan Sampah',
                'ikon'   => 'bi-trash3',
                'warna'  => '#3f7d58',
                'jenis'  => [
                    'sampah_liar'                => 'Pembuangan / Penumpukan Sampah Liar',
                    'pembakaran_sampah'          => 'Pembakaran Sampah',
                    'kerusakan_sarpras_sampah'   => 'Kerusakan Sarana Prasarana',
                    'pengangkutan_sampah_ilegal' => 'Pengangkutan Sampah Ilegal',
                ],
            ],
            [
                'kode'   => 'limbah_b3',
                'nama'   => 'Pengelolaan Limbah B3',
                'ikon'   => 'bi-radioactive',
                'warna'  => '#b3261e',
                'jenis'  => [
                    'pengangkutan_b3_tidak_berizin' => 'Pengangkutan Limbah B3 oleh Perorangan / Perusahaan Tidak Berizin',
                    'penumpukan_b3'                 => 'Penumpukan Limbah B3',
                    'pencemaran_b3'                 => 'Pencemaran Limbah B3',
                ],
            ],
        ];

        foreach ($data as $i => $k) {
            $kategori = MasterKategoriPengaduan::updateOrCreate(
                ['kode' => $k['kode']],
                [
                    'nama'      => $k['nama'],
                    'ikon'      => $k['ikon'],
                    'warna'     => $k['warna'],
                    'urutan'    => $i + 1,
                    'is_active' => true,
                ]
            );

            $urut = 1;
            foreach ($k['jenis'] as $kode => $nama) {
                MasterJenisPengaduan::updateOrCreate(
                    ['kode' => $kode],
                    [
                        'kategori_id' => $kategori->id,
                        'nama'        => $nama,
                        'urutan'      => $urut++,
                        'is_active'   => true,
                    ]
                );
            }

            $this->command?->line("  ✓ {$kategori->nama} (" . count($k['jenis']) . " jenis)");
        }
    }
}
