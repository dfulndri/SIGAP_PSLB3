@extends('layouts.admin')
@section('title', 'Jenis Pengaduan')
@section('breadcrumb', 'Master Data / Jenis Pengaduan')

@section('content')
    <div class="page-hd d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
        <div>
            <h1 class="page-ttl">Jenis Pengaduan</h1>
            <p class="page-stl">Kelola kategori dan jenis pengaduan yang muncul pada form pengaduan.</p>
        </div>
        <button class="btn btn-maroon" data-bs-toggle="modal" data-bs-target="#addKategoriModal">
            <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
        </button>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3"
            style="font-size:.85rem">
            <i class="bi bi-check-circle-fill flex-shrink-0"></i>{{ session('success') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-3"
            style="font-size:.85rem">
            <i class="bi bi-exclamation-triangle-fill flex-shrink-0"></i>{{ session('error') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-3" style="font-size:.85rem">
            <div class="fw-semibold mb-1"><i class="bi bi-exclamation-triangle-fill me-1"></i>Data belum tersimpan:</div>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="alert alert-light border d-flex gap-2 mb-3" style="font-size:.8rem">
        <i class="bi bi-info-circle flex-shrink-0 mt-1"></i>
        <div>
            Mengubah <strong>nama</strong> jenis akan ikut mengubah tampilan pada data pengaduan lama.
            Jenis yang <strong>sudah dipakai</strong> tidak dapat dihapus; <strong>nonaktifkan</strong> agar tidak muncul
            lagi di form pengaduan baru.
        </div>
    </div>

    @forelse($kategoris as $kat)
        @php
            $totalJenis = $kat->jenis->count();
            $aktifJenis = $kat->jenis->where('is_active', true)->count();
        @endphp
        <div class="card-panel mb-3" @if (!$kat->is_active) style="opacity:.75" @endif>
            <div class="cp-head">
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0"
                        style="width:40px;height:40px;border-radius:10px;background:{{ $kat->warna }}1f;color:{{ $kat->warna }};font-size:1.15rem">
                        <i class="bi {{ $kat->ikon }}"></i>
                    </div>
                    <div>
                        <div class="cp-title">
                            {{ $kat->nama }}
                            @unless ($kat->is_active)
                                <span class="badge bg-secondary ms-1">Nonaktif</span>
                            @endunless
                        </div>
                        <div class="cp-sub">{{ $totalJenis }} jenis pengaduan &middot; {{ $aktifJenis }} aktif</div>
                    </div>
                </div>
                <div class="d-flex gap-1 flex-wrap">
                    <button class="btn btn-sm btn-maroon" data-bs-toggle="modal"
                        data-bs-target="#addJenisModal{{ $kat->id }}">
                        <i class="bi bi-plus-lg me-1"></i>Tambah Jenis
                    </button>
                    <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                        data-bs-target="#editKategoriModal{{ $kat->id }}" title="Edit kategori">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <form action="{{ route('admin.jenis-pengaduan.kategori.destroy', $kat) }}" method="POST"
                        onsubmit="return confirm('Hapus kategori ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" title="Hapus kategori"><i
                                class="bi bi-trash"></i></button>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table sipplh-table">
                    <thead>
                        <tr>
                            <th style="width:60px">Urutan</th>
                            <th>Jenis Pengaduan</th>
                            <th style="width:150px">Dipakai</th>
                            <th style="width:100px">Status</th>
                            <th style="width:100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kat->jenis as $j)
                            @php $pakai = $dipakai[$j->kode] ?? 0; @endphp
                            <tr>
                                <td class="text-muted" style="font-size:.8rem">{{ $j->urutan }}</td>
                                <td>
                                    <strong style="font-size:.86rem">{{ $j->nama }}</strong>
                                    <div><code style="font-size:.7rem" class="text-muted">{{ $j->kode }}</code></div>
                                </td>
                                <td style="font-size:.82rem">
                                    @if ($pakai > 0)
                                        <span class="badge bg-secondary">{{ $pakai }} pengaduan</span>
                                    @else
                                        <span class="text-muted">Belum dipakai</span>
                                    @endif
                                </td>
                                <td><span
                                        class="badge bg-{{ $j->is_active ? 'success' : 'secondary' }}">{{ $j->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-xs btn-outline-secondary" data-bs-toggle="modal"
                                            data-bs-target="#editJenisModal{{ $j->id }}" title="Edit"><i
                                                class="bi bi-pencil"></i></button>
                                        <form action="{{ route('admin.jenis-pengaduan.jenis.destroy', $j) }}"
                                            method="POST" onsubmit="return confirm('Hapus jenis pengaduan ini?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-xs btn-outline-danger" title="Hapus"><i
                                                    class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state"><i class="bi bi-tags"></i>Belum ada jenis pengaduan pada
                                        kategori ini</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @empty
        <div class="card-panel">
            <div class="empty-state"><i class="bi bi-tags"></i>Belum ada kategori. Klik "Tambah Kategori" untuk memulai.
            </div>
        </div>
    @endforelse

    {{-- ══ MODAL: Tambah Kategori ══ --}}
    <div class="modal fade" id="addKategoriModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.jenis-pengaduan.kategori.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h6 class="modal-title">Tambah Kategori</h6><button type="button" class="btn-close"
                            data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" maxlength="150" required
                                placeholder="Contoh: Pengelolaan Sampah">
                        </div>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label">Ikon</label>
                                <select name="ikon" class="form-select">
                                    @foreach ($ikonList as $ikon => $label)
                                        <option value="{{ $ikon }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <label class="form-label">Warna</label>
                                <input type="color" name="warna" class="form-control form-control-color w-100"
                                    value="#273338">
                            </div>
                            <div class="col-3">
                                <label class="form-label">Urutan</label>
                                <input type="number" name="urutan" class="form-control" min="0" max="999"
                                    placeholder="Auto">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">Batal</button><button type="submit"
                            class="btn btn-maroon">Simpan</button></div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($kategoris as $kat)
        {{-- ══ MODAL: Edit Kategori ══ --}}
        <div class="modal fade" id="editKategoriModal{{ $kat->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.jenis-pengaduan.kategori.update', $kat) }}" method="POST">
                        @csrf @method('PATCH')
                        <div class="modal-header">
                            <h6 class="modal-title">Edit Kategori</h6><button type="button" class="btn-close"
                                data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control" maxlength="150"
                                    value="{{ $kat->nama }}" required>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-6">
                                    <label class="form-label">Ikon</label>
                                    <select name="ikon" class="form-select">
                                        @foreach ($ikonList as $ikon => $label)
                                            <option value="{{ $ikon }}"
                                                {{ $kat->ikon === $ikon ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label class="form-label">Warna</label>
                                    <input type="color" name="warna" class="form-control form-control-color w-100"
                                        value="{{ $kat->warna }}">
                                </div>
                                <div class="col-3">
                                    <label class="form-label">Urutan</label>
                                    <input type="number" name="urutan" class="form-control" min="0"
                                        max="999" value="{{ $kat->urutan }}">
                                </div>
                            </div>
                            <div class="form-check form-switch">
                                <input type="hidden" name="is_active" value="0">
                                <input class="form-check-input" type="checkbox" role="switch" name="is_active"
                                    value="1" id="katAktif{{ $kat->id }}"
                                    {{ $kat->is_active ? 'checked' : '' }}>
                                <label class="form-check-label" for="katAktif{{ $kat->id }}"
                                    style="font-size:.84rem">Aktif (tampil di form pengaduan)</label>
                            </div>
                        </div>
                        <div class="modal-footer"><button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Batal</button><button type="submit"
                                class="btn btn-maroon">Simpan</button></div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ══ MODAL: Tambah Jenis (pada kategori ini) ══ --}}
        <div class="modal fade" id="addJenisModal{{ $kat->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.jenis-pengaduan.jenis.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="kategori_id" value="{{ $kat->id }}">
                        <div class="modal-header">
                            <h6 class="modal-title">Tambah Jenis Pengaduan<div class="text-muted fw-normal"
                                    style="font-size:.76rem">{{ $kat->nama }}</div>
                            </h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nama Jenis Pengaduan <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control" maxlength="200" required>
                            </div>
                            <div class="mb-1">
                                <label class="form-label">Urutan</label>
                                <input type="number" name="urutan" class="form-control" min="0" max="999"
                                    placeholder="Otomatis di urutan terakhir">
                            </div>
                        </div>
                        <div class="modal-footer"><button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Batal</button><button type="submit"
                                class="btn btn-maroon">Simpan</button></div>
                    </form>
                </div>
            </div>
        </div>

        @foreach ($kat->jenis as $j)
            {{-- ══ MODAL: Edit Jenis ══ --}}
            <div class="modal fade" id="editJenisModal{{ $j->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('admin.jenis-pengaduan.jenis.update', $j) }}" method="POST">
                            @csrf @method('PATCH')
                            <div class="modal-header">
                                <h6 class="modal-title">Edit Jenis Pengaduan</h6><button type="button" class="btn-close"
                                    data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <select name="kategori_id" class="form-select" required>
                                        @foreach ($kategoris as $opt)
                                            <option value="{{ $opt->id }}"
                                                {{ $j->kategori_id === $opt->id ? 'selected' : '' }}>{{ $opt->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama Jenis Pengaduan <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="nama" class="form-control" maxlength="200"
                                        value="{{ $j->nama }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Urutan</label>
                                    <input type="number" name="urutan" class="form-control" min="0"
                                        max="999" value="{{ $j->urutan }}">
                                </div>
                                <div class="form-check form-switch">
                                    <input type="hidden" name="is_active" value="0">
                                    <input class="form-check-input" type="checkbox" role="switch" name="is_active"
                                        value="1" id="jenisAktif{{ $j->id }}"
                                        {{ $j->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="jenisAktif{{ $j->id }}"
                                        style="font-size:.84rem">Aktif (tampil di form pengaduan)</label>
                                </div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-outline-secondary"
                                    data-bs-dismiss="modal">Batal</button><button type="submit"
                                    class="btn btn-maroon">Simpan</button></div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
@endsection
