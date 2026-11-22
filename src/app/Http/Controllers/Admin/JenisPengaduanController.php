<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterJenisPengaduan;
use App\Models\MasterKategoriPengaduan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * Master Data → Jenis Pengaduan
 * Kategori (mis. Pengelolaan Sampah) berisi beberapa Jenis Pengaduan.
 */
class JenisPengaduanController extends Controller
{
    public function index()
    {
        $kategoris = MasterKategoriPengaduan::with('jenis')
            ->orderBy('urutan')->orderBy('nama')->get();

        // Jumlah pengaduan per kode jenis (untuk info "Dipakai" dan pengaman hapus)
        $dipakai = Pengaduan::hitungJenis(Pengaduan::pluck('jenis_aduan'))['jenis'];

        return view('admin.jenis-pengaduan.index', [
            'kategoris' => $kategoris,
            'dipakai'   => $dipakai,
            'ikonList'  => MasterKategoriPengaduan::$ikonList,
        ]);
    }

    // ── Kategori ─────────────────────────────────────────────────
    public function storeKategori(Request $request)
    {
        $data = $request->validate([
            'nama'   => ['required', 'string', 'max:150', 'unique:master_kategori_pengaduan,nama'],
            'ikon'   => ['required', Rule::in(array_keys(MasterKategoriPengaduan::$ikonList))],
            'warna'  => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'urutan' => ['nullable', 'integer', 'min:0', 'max:999'],
        ]);

        MasterKategoriPengaduan::create([
            'kode'      => $this->kodeUnik(MasterKategoriPengaduan::class, $data['nama'], 50),
            'nama'      => $data['nama'],
            'ikon'      => $data['ikon'],
            'warna'     => $data['warna'],
            'urutan'    => $data['urutan'] ?? ((int) MasterKategoriPengaduan::max('urutan') + 1),
            'is_active' => true,
        ]);

        Pengaduan::flushJenisAduanCache();

        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function updateKategori(Request $request, MasterKategoriPengaduan $kategori)
    {
        $data = $request->validate([
            'nama'   => ['required', 'string', 'max:150',
                Rule::unique('master_kategori_pengaduan', 'nama')->ignore($kategori->id)],
            'ikon'   => ['required', Rule::in(array_keys(MasterKategoriPengaduan::$ikonList))],
            'warna'  => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'urutan' => ['nullable', 'integer', 'min:0', 'max:999'],
        ]);

        $kategori->update([
            'nama'      => $data['nama'],
            'ikon'      => $data['ikon'],
            'warna'     => $data['warna'],
            'urutan'    => $data['urutan'] ?? $kategori->urutan,
            'is_active' => $request->boolean('is_active'),
        ]);

        Pengaduan::flushJenisAduanCache();

        return back()->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroyKategori(MasterKategoriPengaduan $kategori)
    {
        if ($kategori->jenis()->exists()) {
            return back()->with('error', 'Kategori masih memiliki jenis pengaduan. Hapus atau pindahkan jenisnya terlebih dahulu, atau cukup nonaktifkan kategori ini.');
        }

        $kategori->delete();
        Pengaduan::flushJenisAduanCache();

        return back()->with('success', 'Kategori berhasil dihapus.');
    }

    // ── Jenis Pengaduan ──────────────────────────────────────────
    public function storeJenis(Request $request)
    {
        $data = $request->validate([
            'kategori_id' => ['required', 'exists:master_kategori_pengaduan,id'],
            'nama'        => ['required', 'string', 'max:200',
                Rule::unique('master_jenis_pengaduan', 'nama')->where('kategori_id', $request->kategori_id)],
            'urutan'      => ['nullable', 'integer', 'min:0', 'max:999'],
        ], [
            'nama.unique' => 'Jenis pengaduan dengan nama tersebut sudah ada pada kategori ini.',
        ]);

        MasterJenisPengaduan::create([
            'kategori_id' => $data['kategori_id'],
            'kode'        => $this->kodeUnik(MasterJenisPengaduan::class, $data['nama'], 80),
            'nama'        => $data['nama'],
            'urutan'      => $data['urutan']
                ?? ((int) MasterJenisPengaduan::where('kategori_id', $data['kategori_id'])->max('urutan') + 1),
            'is_active'   => true,
        ]);

        Pengaduan::flushJenisAduanCache();

        return back()->with('success', 'Jenis pengaduan berhasil ditambahkan.');
    }

    public function updateJenis(Request $request, MasterJenisPengaduan $jenis)
    {
        $data = $request->validate([
            'kategori_id' => ['required', 'exists:master_kategori_pengaduan,id'],
            'nama'        => ['required', 'string', 'max:200',
                Rule::unique('master_jenis_pengaduan', 'nama')
                    ->where('kategori_id', $request->kategori_id)->ignore($jenis->id)],
            'urutan'      => ['nullable', 'integer', 'min:0', 'max:999'],
        ], [
            'nama.unique' => 'Jenis pengaduan dengan nama tersebut sudah ada pada kategori ini.',
        ]);

        // "kode" sengaja tidak diubah: kode inilah yang tersimpan di data pengaduan.
        $jenis->update([
            'kategori_id' => $data['kategori_id'],
            'nama'        => $data['nama'],
            'urutan'      => $data['urutan'] ?? $jenis->urutan,
            'is_active'   => $request->boolean('is_active'),
        ]);

        Pengaduan::flushJenisAduanCache();

        return back()->with('success', 'Jenis pengaduan berhasil diperbarui.');
    }

    public function destroyJenis(MasterJenisPengaduan $jenis)
    {
        $jumlah = $jenis->jumlahDipakai();
        if ($jumlah > 0) {
            return back()->with('error', "Jenis \"{$jenis->nama}\" sudah dipakai pada {$jumlah} pengaduan sehingga tidak dapat dihapus. Nonaktifkan saja agar tidak muncul di form pengaduan baru.");
        }

        $jenis->delete();
        Pengaduan::flushJenisAduanCache();

        return back()->with('success', 'Jenis pengaduan berhasil dihapus.');
    }

    // ── Helper ───────────────────────────────────────────────────
    /** Buat kode unik (slug dengan underscore) dari nama. */
    private function kodeUnik(string $model, string $nama, int $maks): string
    {
        $dasar = Str::limit(Str::slug($nama, '_'), $maks - 5, '') ?: 'item';
        $kode  = $dasar;
        $i     = 2;

        while ($model::where('kode', $kode)->exists()) {
            $kode = $dasar . '_' . $i++;
        }

        return $kode;
    }
}
