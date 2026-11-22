<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\MasterKecamatan;
use App\Models\MasterKategoriPengaduan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengaduan::with(['pelapor', 'terlapor', 'kecamatan', 'assignedTo'])->latest();
        if ($request->filled('dari'))         $query->whereDate('tanggal_pengaduan', '>=', $request->dari);
        if ($request->filled('sampai'))       $query->whereDate('tanggal_pengaduan', '<=', $request->sampai);
        if ($request->filled('status'))       $query->where('status', $request->status);
        if ($request->filled('kecamatan_id')) $query->where('kecamatan_id', $request->kecamatan_id);
        if ($request->filled('jenis'))        $query->filterJenis($request->jenis);

        $pengaduans = $query->paginate(20)->withQueryString();

        // Statistik
        $baseQuery = Pengaduan::query();
        if ($request->filled('dari'))         $baseQuery->whereDate('tanggal_pengaduan', '>=', $request->dari);
        if ($request->filled('sampai'))       $baseQuery->whereDate('tanggal_pengaduan', '<=', $request->sampai);
        if ($request->filled('kecamatan_id')) $baseQuery->where('kecamatan_id', $request->kecamatan_id);
        if ($request->filled('jenis'))        $baseQuery->filterJenis($request->jenis);

        $stats = [
            'total'      => (clone $baseQuery)->count(),
            'baru'       => (clone $baseQuery)->where('status', 'pengaduan_baru')->count(),
            'proses'     => (clone $baseQuery)->whereIn('status', ['menunggu_disposisi', 'didisposisikan', 'verifikasi_lapangan'])->count(),
            'verifikasi' => (clone $baseQuery)->where('status', 'verifikasi_selesai')->count(),
            'selesai'    => (clone $baseQuery)->whereIn('status', ['selesai', 'arsip'])->count(),
        ];

        // Per jenis pengaduan + ringkasan per kategori
        $hitung       = Pengaduan::hitungJenis((clone $baseQuery)->pluck('jenis_aduan'));
        $perJenis     = $hitung['jenis'];
        $perKategori  = $hitung['kategori'];
        $meta         = Pengaduan::jenisAduanMeta();
        $jenisLabels  = array_map(fn($k) => $meta[$k]['nama'] ?? ucwords(str_replace('_', ' ', $k)), array_keys($perJenis));
        $jenisColors  = array_map(fn($k) => $meta[$k]['warna'] ?? '#64748b', array_keys($perJenis));
        $kategoriList = MasterKategoriPengaduan::orderBy('urutan')->orderBy('nama')->get();

        // Per kecamatan
        $perKecamatan = (clone $baseQuery)
            ->selectRaw('kecamatan_id, COUNT(*) as total')
            ->with('kecamatan')
            ->whereNotNull('kecamatan_id')
            ->groupBy('kecamatan_id')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        $kecamatans = MasterKecamatan::orderBy('nama_kecamatan')->get();

        return view('admin.laporan.index', compact(
            'pengaduans',
            'stats',
            'perJenis',
            'jenisLabels',
            'jenisColors',
            'perKategori',
            'kategoriList',
            'perKecamatan',
            'kecamatans'
        ));
    }

    public function exportExcel(Request $request)
    {
        $filename = 'Laporan_Pengaduan_' . now()->format('Ymd_His') . '.xlsx';

        if (class_exists(\App\Exports\PengaduanExport::class)) {
            return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\PengaduanExport($request), $filename);
        }

        return back()->with('error', 'Export Excel belum dikonfigurasi.');
    }

    public function exportPdf(Request $request)
    {
        $query = Pengaduan::with(['pelapor', 'terlapor', 'kecamatan'])->latest();
        if ($request->filled('dari'))     $query->whereDate('tanggal_pengaduan', '>=', $request->dari);
        if ($request->filled('sampai'))   $query->whereDate('tanggal_pengaduan', '<=', $request->sampai);
        if ($request->filled('status'))   $query->where('status', $request->status);
        if ($request->filled('jenis'))    $query->filterJenis($request->jenis);

        $pengaduans = $query->get();

        $pdf = Pdf::loadView('pdf.laporan-pengaduan', compact('pengaduans', 'request'))
            ->setPaper('A4', 'landscape');

        return $pdf->download('Laporan_Pengaduan_' . now()->format('Ymd') . '.pdf');
    }
}
